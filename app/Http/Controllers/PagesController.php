<?php

namespace App\Http\Controllers;

use App\Helper\SendMail;
use App\Helper\JsonWebToken as JWT;
use Illuminate\Http\Request;
use App\Services\ResponseService;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\GetAddressRequest;
use App\Http\Requests\ServiceInforRequest;
use App\Http\Requests\GetCouponRequest;
use App\Models\Services;
use App\Models\UserServices;
use App\Models\Coupon;
use App\Models\LogShare;

class PagesController extends Controller
{

    protected $response;
    const MESS_SENDMAIL_SUCCESS = 'Send mail success';
    const MESS_SENDMAIL_ERROR = 'Send mail error';
    const MESS_SUCCESS = 'Success';
    const MESS_POSTCODE_NOT_EXIST = 'Postcode not exist';
    const MESS_SERVICE_NOT_EXIST = 'Service not exist';

    function __construct(ResponseService $response)
    {
        $this->response = $response;
    }

    /**
     * @OA\Post(
     *   path="/api/contact",
     *   tags={"User"},
     *   summary="Contact",
     *   operationId="contact",
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
     *     name="inquiry",
     *     in="query",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     enum={"入会について","サービスについて","その他"},
     *     ),
     *   ),
     *     @OA\Parameter(
     *     name="note",
     *     in="query",
     *     description="お問合せ内容",
     *     required=true,
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

    public function SendMailContact(ContactRequest $request)
    {
        $params = $request->all();
        $params['type'] = isset($params['type']) ? $params['type'] : '';

        // Send mail to user and admin
        if (SendMail::sendMailUserContact($params) &&
            SendMail::sendMailAdminContact($params)) {
            return $this->response->json(true, self::MESS_SENDMAIL_SUCCESS);
        } else {
            return $this->response->json(true, self::MESS_SENDMAIL_ERROR);
        }
    }

    /**
     * @OA\Get(
     *   path="/api/addressByPostcode",
     *   tags={"User"},
     *   summary="Get address by post code",
     *   operationId="addressByPostcode",
     *   @OA\Parameter(
     *     name="postcodeA",
     *     in="query",
     *     description="000",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="100",
     *     ),
     *   ),
     *     @OA\Parameter(
     *     name="postcodeB",
     *     in="query",
     *     description="0000",
     *     required=true,
     *     @OA\Schema(
     *      type="string",
     *     example="0000",
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

    public function GetAddressByPostcode(GetAddressRequest $request){
        $postcode = $request->postcodeA.$request->postcodeB;
        $filePostcode = file_get_contents('https://yubinbango.github.io/yubinbango-data/data/'.$request->postcodeA.'.js', true);
        if($filePostcode) {
            $filePostcode = json_decode(substr($filePostcode, 7, strlen($filePostcode) - 10));
            if (!empty($filePostcode->$postcode)) {
                return $this->response->json(true, self::MESS_SUCCESS, $filePostcode->$postcode);
            }
        }
        return $this->response->json(false, self::MESS_POSTCODE_NOT_EXIST);
    }

    /**
     * @OA\Get(
     *   path="/api/serviceInfor",
     *   tags={"User"},
     *   summary="Get service infor",
     *   operationId="serviceInfor",
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
     *   )
     * )
     */

    public function getServiceInfo(ServiceInforRequest $request)
    {
        $service = Services::find($request->service_id);
        if ($service) {
            return $this->response->json(true, self::MESS_SUCCESS, $service);
        }
        return $this->response->json(false, self::MESS_SERVICE_NOT_EXIST);

    }

    /**
     * @OA\Get(
     *   path="/api/coupon",
     *   tags={"User"},
     *   summary="Get coupon",
     *   operationId="coupon",
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

    public function GetCoupon(GetCouponRequest $request)
    {
        $token = JWT::user();
        $UserService = UserServices::where('user_id', $token->id)
            ->where('service_id', $request->service_id)
            ->exists();
        if ($UserService) {
            $coupons = Coupon::select('id', 'code')
                ->where('from_date', '<=', date('Y/m/d H:i:s', time()))
                ->where('to_date', '>=', date('Y/m/d H:i:s', time()))
                ->get();
            return $this->response->json(true, self::MESS_SUCCESS, $coupons);
        }
        return $this->response->json(true, self::MESS_SUCCESS);
    }

    /**
     * @OA\Get(
     *   path="/api/sharedCompanies",
     *   tags={"User"},
     *   summary="Get list shared Company",
     *   operationId="sharedCompanies",
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

    public function SharedCompanies(Request $request)
    {
        $user = (array)JWT::user();
        $introF1 = [];
        $f1 =  LogShare::getListShareCompany([$user['id']]);
        $introF1 = self::addFieldToKeyArr($f1, 'registered_by');
        $f1IdList = array_keys($introF1);

        // F2
        $f2 = [];
        if (!empty($f1IdList)) {
            $f2 = LogShare::getListShareCompany($f1IdList);
        }
        $f2 = self::addFieldToKeyArr($f2, 'registered_by');
        $introF2 = self::addFieldIdtoArr($f2);
        $f2IdList = $introF2[1];
        $introF2 = $introF2[0];

        // F3
        $f3 = [];
        if (!empty($f2IdList)) {
            $f3 = LogShare::getListShareCompany($f2IdList);
        }
        $f3 = self::addFieldToKeyArr($f3, 'registered_by');
        $introF3 = self::addFieldIdtoArr($f3)[0];

        // Total
        $totalF1Share = count($introF1);
        $totalShare = count($f1) + count($f2) + count($f3);
        self::calTotalChildShare($introF1,$introF2,$introF3);

        $data = [
            'introF1' => $introF1,
            'introF2' => $introF2,
            'introF3' => $introF3,
            'totalShare' => $totalShare,
            'totalF1Share' => $totalF1Share
        ];
        return $this->response->json(true, self::MESS_SUCCESS, $data);
    }

    public static function calTotalChildShare(&$introF1,&$introF2,&$introF3){
        foreach ($introF1 as $f1Id => $f1Val) {
            $introF1[$f1Id]['total_child_share'] = 0;
            if (isset($introF2[$f1Id])) {
                $introF1[$f1Id]['total_child_share'] = count($introF2[$f1Id]);

                foreach ($introF2[$f1Id] as $f2Id => $f2Val) {
                    $introF2[$f1Id][$f2Id]['total_child_share'] = 0;
                    if (isset($introF3[$f2Id])) {
                        $introF2[$f1Id][$f2Id]['total_child_share'] = count($introF3[$f2Id]);
                    }
                }
            }
        }
    }

    public static function addFieldIdtoArr($arr){
        $intro = [];
        $idList = [];
        foreach ($arr as $val) {
            $id = $val['registered_by'];
            $idList[] = $id;
            $beforeId = $val['shared_by'];
            if (!isset($intro[$beforeId])) {
                $intro[$beforeId] = [];
            }
            $intro[$beforeId][$id] = $val;
        }
        return array($intro, $idList);
    }

    public static function addFieldToKeyArr($arr, $field)
    {
        $temp = [];
        foreach ($arr as $val) {
            if (isset($val[$field])) {
                $temp[$val[$field]] = $val;
            }
        }
        $temp = empty($temp) ? $arr : $temp;
        return $temp;
    }
}
