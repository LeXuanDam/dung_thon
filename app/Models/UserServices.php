<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UserServices extends Model
{
    const SERVICE_NOT_REGIST = 0;
    const SERVICE_STOP = 1;
    const SERVICE_USING = 2;
    const SERVICE_REQUEST_STOP = 3;
    protected $table = 'user_services';
    protected $hidden = ['created_at','deleted_at','updated_at'];
    protected $fillable = ['status','stop_at','request_stop_at','service_id','user_id'];
    public $timestamps = false;

    public static function insertUserServices($params, $user)
    {
        try {
            if (count($params['services']) > 0) {
                $insert = [];
                foreach ($params['services'] as $entry) {
                    $insert[] = [
                        'user_id' => $user->id,
                        'service_id' => $entry,
                        'status' => 2,
                        'created_at' => date('Y/m/d H:i:s',time())];
                }
                static::insert($insert);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
//            return $this->response->json(false, 'insert database error');
        }
        return true;
    }
}
