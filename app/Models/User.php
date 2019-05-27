<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class User extends Model
{
    const KEY_HASH = "hataraclub@hash_2018";
    const ROLE_USER = 0;
    const ROLE_SALE = 1;
    const ROLE_MANAGER = 5;
    const ROLE_ADMIN = 10;
    protected $table = 'users';
    protected $hidden = ['password','created_at','deleted_at','updated_at'];

    /**
     * [insertUser                insert user]
     * @param       [object]      $params: user account
     * @param       [object]      $certificateImg: path file certificate
     * @return      [object]      return user infor
     */
    public static function insertUser($certificateImg, $params)
    {
        $user = new User();
        $user->company = $params['company'];
        $user->user_name = $params['user_name'];
        $user->password = $params['password'];
        $user->represent = $params['represent'];
        $user->email = $params['email'];
        $user->tel = $params['tel'];
        $user->postcode = $params['postcode'];
        $user->address = $params['address'];
        $user->address_number = $params['address_number'];
        $user->confirm = $params['confirm'];
        $user->certificate_image = $certificateImg;
        $user->save();
        return $user;
    }

    /**
     * [insertUser                update user]
     * @param       [string]      $token: access_token
     * @param       [object]      $params: user account
     * @param       [object]      $certificateImg: path file certificate
     */
    public static function updateUser($certificateImg, $params,$token)
    {
        $params['postcode'] = $params['postcodeA'] .'-'. $params['postcodeB'];
        $update_data = [
            'company' => $params['company'],
            'represent' => $params['represent'],
            'tel' => $params['tel'],
            'postcode' => $params['postcode'],
            'address' => $params['address'],
            'address_number' => $params['address_number']
        ];

        $update_data['user_funds'] = isset($params['user_funds']) ? $params['user_funds'] : null;
        $update_data['number_of_staff'] = isset($params['number_of_staff']) ? $params['number_of_staff'] : null;
        $update_data['business_type'] = isset($params['business_type']) ? $params['business_type'] : null;
        $update_data['email'] = isset($params['email']) ? $params['email'] : null;
        $update_data['certificate_image'] = $certificateImg;
        if(isset($params['password'])){
            $update_data['password'] = static::getHashPassword($params);
        }
        User::where('id',$token->id)->update($update_data);
    }

    public static function getHashPassword($params)
    {
        $params['password'] = isset($params['password']) ? $params['password'] : $params['user_name'];
        return hash('sha512', $params['user_name'].$params['password'].self::KEY_HASH);
    }

    /**
     * [uploadFile                upload file certificate image]
     * @param       [object]      user account
     * @return      [string]      return path after file upload
     */

    public static function uploadFile($request)
    {
        if ($request->hasFile('certificate_image')) {

            $path = Storage::putFile('certificateImg', $request->file('certificate_image'));
            return $path;
        }
        return null;
    }
}

