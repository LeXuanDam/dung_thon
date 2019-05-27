<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ServiceRequest;
use App\Models\Services;
use App\Models\User;
use App\Models\UserServices;
use Illuminate\Http\Request;
use App\Helper\JsonWebToken as JWT;
use Validator;
use App\Services\ResponseService;
use Illuminate\Support\Facades\DB;
use App\Helper\SendMail;

class UserController extends Controller
{

    const MESS_LOGIN_ERROR = 'IDまたはパスワードが間違っています。';
    const MESS_PHONE_EXISTS = '「携帯電話番号」:携帯電話番号が既に登録されています。';
    const MESS_EMAIL_NOT_EXISTS = 'メールアドレスが登録されていません。';
    const MESS_EMAIL_EXISTS = '「メールアドレス」:メールアドレスが既に登録されています。';
    const MESS_SUCCESS = 'Success';
    const MESS_SERVICE_NOT_EXISTS = 'Service not exists';
    const MESS_REGISTER_SERVICE_SUCCESS = 'Register service success';
    const MESS_REGISTER_SERVICE_ERROR = 'Registered service error';
    const KEY_HASH = "hataraclub@hash_2018";
    const UPDATE_PROFILE_SUCCESS = 'update profile success';
    const MESS_FORMAT_FILE_WRONG = 'The certificate image must be a file of type: jpeg, png, jpg, gif';
    const MESS_FORMAT_TEL_WRONG = '「携帯電話番号」:携帯電話番号を正しく入力してください。';
    const MESS_USER_NOT_EXISTS = 'user not exists';
    protected $response;

    function __construct(ResponseService $response)
    {
        $this->response = $response;
    }

    /**
     * @OA\Post(
     *   path="/api/register",
     *   tags={"User"},
     *   summary="Register",
     *   operationId="register",
     *   @OA\Parameter(
     *     name="company",
     *     in="query",
     *     required=true,
     *     description="会社名",
     *     @OA\Schema(
     *      type="string",
     *     example="株式会社〇〇〇〇",
     *     ),
     *   ),
     *     @OA\Parameter(
     *     name="represent",
     *     description=" 代表者名",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="〇〇〇〇",
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="メールアドレス",
     *     required=false,
     *     @OA\Schema(
     *      type="string",
     *     example="〇〇〇〇@example.com",
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="tel",
     *     in="query",
     *     description="携帯電話番号",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="09012345678",
     *     ),
     *   ),
     *    @OA\Parameter(
     *     name="postcodeA",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="000",
     *     ),
     *   ),
     *     @OA\Parameter(
     *     name="postcodeB",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="0000",
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="address",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="東京都〇〇区〇〇町",
     *     ),
     *   ),
     *     @OA\Parameter(
     *     name="address_number",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="1-2-34",
     *     ),
     *   ),
     *    @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="certificate_image",
     *                     type="file",
     *                     format="file",
     *                 ),
     *                 required={"file"}
     *             )
     *         )
     *   ),
     *    @OA\Parameter(
     *     name="services[]",
     *     in="query",
     *     description="サービス",
     *     required=false,
     *     @OA\Schema(
     *     type="array",
     *     @OA\Items(
     *          enum={1,2,3,4,5,6,7,8,9,10,11},
     *     ),
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\MediaType(
     *      mediaType="application/json",
     *     )
     *   )
     * )
     */

    public function register(RegisterRequest $request)
    {
        $validateFileCertificate = $this->validateFileCertificate($request);
        if($validateFileCertificate) return $validateFileCertificate;
        $validatePhoneNumberStart0 = $this->validatePhoneNumberStart0($request->tel);
        if($validatePhoneNumberStart0) return $validatePhoneNumberStart0;
        $params = $request->all();
        if(!empty($params['services'])) {
            $services = Services::whereIn('id', ($params['services']))->get();
            if (count($services) != count(($params['services']))) {
                return $this->response->json(false, self::MESS_SERVICE_NOT_EXISTS);
            }
        }
        $params['postcode'] = $params['postcodeA'] . '-' . $params['postcodeB'];
        $params['email'] = isset($params['email']) ? $params['email'] : null;
        $userFindEmail = User::where('email', $params['email'])->exists();
        $userFindPhone = User::where('user_name', $params['tel'])->exists();
        if (isset($params['email']) && $userFindEmail && $userFindPhone) {
            return $this->response->json(false, [self::MESS_EMAIL_EXISTS, self::MESS_PHONE_EXISTS]);
        }
        if (isset($params['email']) && $userFindEmail) {
            return $this->response->json(false, self::MESS_EMAIL_EXISTS);
        }
        if ($userFindPhone) {
            return $this->response->json(false, self::MESS_PHONE_EXISTS);
        }
        $params['services'] = isset($params['services']) ? $params['services'] : [];
        $params['user_name'] = $params['tel'];
        $params['password'] = User::getHashPassword($params);
        $params['confirm'] = isset($params['confirm']) ? $params['confirm'] : 0;
        DB::beginTransaction();
        $certificateImg = User::uploadFile($request);
        $user = User::insertUser($certificateImg, $params);
        UserServices::insertUserServices($params, $user);
        if (!empty($params['services'])) {
            $params['servicesSelect'] = Services::whereIn('id', ($params['services']))->get();
        }
        SendMail::SendMailUserRegister($params);
        return $this->response->json(true, 'Register success', [
            'access_token' => JWT::encode($user)
        ]);
    }

    /**
     * @OA\Post(
     *   path="/api/login",
     *   tags={"User"},
     *   summary="Login",
     *   operationId="login",
     *   @OA\Parameter(
     *     name="user_name",
     *     description="ID",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="09012345678",
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="password",
     *     in="query",
     *     description="パスワード",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *      format="password",
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\MediaType(
     *      mediaType="application/json",
     *     )
     *   )
     * )
     */

    public function login(LoginRequest $request)
    {
        $params = $request->all();
        $user = User::where('user_name', $params['user_name'])
            ->first();
        if (!$user) {
            return $this->response->json(false, self::MESS_LOGIN_ERROR);
        }
        if (User::getHashPassword($params) != $user->password) {
            return $this->response->json(false, self::MESS_LOGIN_ERROR);
        }
        return $this->response->json(true, 'Login success', [
            'access_token' => JWT::encode($user)
        ]);
    }

    /**
     * @OA\Put(
     *   path="/api/profile",
     *   tags={"User"},
     *   summary="Profile",
     *   operationId="profile",
     *   @OA\Parameter(
     *     name="company",
     *     in="query",
     *     required=true,
     *     description="会社名",
     *     @OA\Schema(
     *      type="string",
     *     example="株式会社〇〇〇〇",
     *     ),
     *   ),
     *     @OA\Parameter(
     *     name="represent",
     *     description=" 代表者名",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="〇〇〇〇",
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="email",
     *     in="query",
     *     description="メールアドレス",
     *     required=false,
     *     @OA\Schema(
     *      type="string",
     *     example="〇〇〇〇@example.com",
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="tel",
     *     in="query",
     *     description="携帯電話番号",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="09012345678",
     *     ),
     *   ),
     *    @OA\Parameter(
     *     name="postcodeA",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="000",
     *     ),
     *   ),
     *     @OA\Parameter(
     *     name="postcodeB",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="0000",
     *     ),
     *   ),
     *   @OA\Parameter(
     *     name="address",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="東京都〇〇区〇〇町",
     *     ),
     *   ),
     *     @OA\Parameter(
     *     name="address_number",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="1-2-34",
     *     ),
     *   ),
     *    @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="file to upload",
     *                     property="certificate_image",
     *                     type="file",
     *                     format="file",
     *                 ),
     *                 required={"file"}
     *             )
     *         )
     *   ),
     *    @OA\Parameter(
     *     name="user_funds",
     *     in="query",
     *     description="資本金",
     *     required=false,
     *     @OA\Schema(
     *      type="string",
     *     ),
     *   ),
     *    @OA\Parameter(
     *     name="number_of_staff",
     *     in="query",
     *     description="従業員数",
     *     required=false,
     *     @OA\Schema(
     *      type="string",
     *     enum={"01~05","06~09","10~14","15~19","20~29","30~49","50~99","100~199","200~299","300~399","400~499"},
     *     ),
     *   ),
     *    @OA\Parameter(
     *     name="business_type",
     *     in="query",
     *     description="業種",
     *     required=false,
     *     @OA\Schema(
     *      type="string",
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\MediaType(
     *      mediaType="application/json",
     *     )
     *   ),
     *   @OA\Parameter(
     *     name="password",
     *     in="query",
     *     description="パスワード変更",
     *     @OA\Schema(
     *      type="string",
     *      format="password",
     *     ),
     *   ),
     *   security={ {"jwt": {}, "check-version" : {}} },
     * )
     */

    public function profile(RegisterRequest $request)
    {
        $validateFileCertificate = $this->validateFileCertificate($request);
        if($validateFileCertificate) return $validateFileCertificate;
        $validatePhoneNumberStart0 = $this->validatePhoneNumberStart0($request->tel);
        if($validatePhoneNumberStart0) return $validatePhoneNumberStart0;
        $params = $request->all();
        $token = JWT::user();
        $certificateImg = User::uploadFile($request);
        User::updateUser($certificateImg, $params, $token);
        return $this->response->json(true, self::UPDATE_PROFILE_SUCCESS);
    }

    /**
     * @OA\Post(
     *   path="/api/service",
     *   tags={"User"},
     *   summary="Register Service",
     *   operationId="service",
     *   @OA\Parameter(
     *     name="service_id",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="integer",
     *     enum={"1","2","3","4","5","6","7","8","9","10","11"},
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\MediaType(
     *      mediaType="application/json",
     *     )
     *   ),
     *   security={ {"jwt": {}, "check-version" : {}} },
     * )
     */

    public function RegisterService(ServiceRequest $request)
    {
        $token = JWT::user();
        $params = $request->all();
        $payment_status = $token->payment_status;
        if(!Services::where('id',$params['service_id'])->exists()){
            return $this->response->json(true, self::MESS_SERVICE_NOT_EXISTS);
        }
        $service = UserServices::where('user_id', $token->id)
            ->where('service_id', $params['service_id'])
            ->first();
        if ($service && $service->status != UserServices::SERVICE_USING) {
            $service->update([
                'status' => UserServices::SERVICE_USING,
                'stop_at' => null,
                'request_stop_at' => null,
            ]);
        }

        if (!$service) {
            UserServices::insert([
                'user_id' => $token->id,
                'service_id' => $params['service_id'],
                'status' => UserServices::SERVICE_USING,
                'created_at' => date('Y/m/d H:i:s', time())
            ]);
        }
        $service = Services::find($params['service_id']);
        if ($payment_status == 1 && $token->role_id == User::ROLE_USER) {
            if (!empty($service)) {
                if (!empty($token->email)) {
//                    mail no 5
                    SendMail::SendMailRegisterService($token, $service);
                } else {
                    $params = $token;
                    $service['checked'] = date('Y-m-d H:i:s');
                    // chua test duoc
                    SendMail::SendMailPaymentDone($token, $params, [$service]); // for service company
                }
            }
        }
        return $this->response->json(true, self::MESS_REGISTER_SERVICE_SUCCESS);
    }

    /**
     * @OA\Post(
     *   path="/api/forgotpassword",
     *   tags={"User"},
     *   summary="Forgot password",
     *   operationId="forgotpassword",
     *   @OA\Parameter(
     *     name="email",
     *     in="query",
     *     required=true,
     *     description="メールアドレス",
     *     example="〇〇〇〇@example.com",
     *     @OA\Schema(
     *      type="string",
     *     ),
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\MediaType(
     *      mediaType="application/json",
     *     )
     *   )
     * )
     */

    public function forgotpassword(Request $request)
    {
        $params = $request->all();
        $user_email = $params['email'];
        $forgot_token = JWT::issuePasswordResetToken($user_email);

        // Update password reset token

        $result = User::where('email', $user_email)
            ->update(['forgot_token' => $forgot_token]);

        if ($result == 1) {
            SendMail::SendMailForgotPassword($user_email, $forgot_token);
            return $this->response->json(true,self::MESS_SUCCESS);
        } else {
            return $this->response->json(true,self::MESS_EMAIL_NOT_EXISTS);
        }
    }

    /**
     * @OA\Get(
     *   path="/api/profile",
     *   tags={"User"},
     *   summary="Get Profile",
     *   operationId="profile",
     *   @OA\Response(
     *     response=200,
     *     description="Success",
     *     @OA\MediaType(
     *      mediaType="application/json",
     *     )
     *   ),
     *   security={ {"jwt": {}, "check-version" : {}} },
     * )
     */

    public function getProfile(Request $request){
        $token = JWT::user();
        $user = User::find($token->id);
        if($user) {
            return $this->response->json(true, self::MESS_SUCCESS, $user);
        }
        return $this->response->json(true, self::MESS_USER_NOT_EXISTS);
    }

    public function validateFileCertificate($request){
        if($request->hasFile('certificate_image')){
            $arrTailFile = [1=>'jpeg','jpg','png','gif'];
            $tailFile = strtolower($request->certificate_image->getClientOriginalExtension());
            if(!array_search($tailFile, $arrTailFile)){
                return $this->response->json(false, self::MESS_FORMAT_FILE_WRONG);
            }
        }
    }
    public function validatePhoneNumberStart0($phoneNumber)
    {
        if(preg_match('/^[0]+[0-9]*$/', $phoneNumber) == 0){
            return $this->response->json(false,self::MESS_FORMAT_TEL_WRONG);
        }
    }
}
