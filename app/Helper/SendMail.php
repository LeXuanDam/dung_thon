<?php
namespace App\Helper;

use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterService;
use App\Mail\PaymentDone;
use App\Mail\UserRegister;
use App\Mail\Contact;
use App\Mail\ForgotPassword;
use App\Models\User;
class SendMail
{
    public static function SendMailRegisterService($user, $service)
    {
        $email_subject = '【ハタラクラブ】' . $service->service_id . 'のお申込み完了';
        $from = config('mail.mail_from');
        $from_name = config('mail.mail_from_name');
        $to = config('mail.admin_email');
        $to_name = config('mail.admin_name');
        $service_mail_test = config('mail.service_mail_test');
        $arr_mail_bcc = $service_mail_test['bcc'];
        try {
            Mail::to($user->email, $user->company)
//                ->bcc($arr_mail_bcc)
                ->send(new RegisterService($user, $service, $email_subject, $from_name));

        } catch (\Exception $e) {
        }
    }

    public static function SendMailPaymentDone($user, $params, $services)
    {
        $service_mail_test = config('mail.service_mail_test');
        try {
            foreach ($services as $id => $service) {
                if (!empty($service['checked'])
                    && empty($service['stop_at'])
                    && empty($service['request_stop_at'])
                    && $service['allowed_sending'] == '0'
                ) {
                    $email_subject = '【ハタラクラブ】組合員様から' . $service['name'] . 'のお申込み';
                    $arr_mail_to = $arr_mail_cc = $arr_mail_bcc = array();
                    if (isset($service['mail_to']) && !empty($service['mail_to'])) {
                        $arr_mail_to = self::getReceiver($service['mail_to']);

                        if (isset($service['mail_cc']) && !empty($service['mail_cc'])) {
                            $arr_mail_cc = self::getReceiver($service['mail_cc']);
                        }

                        if (isset($service['mail_bcc']) && !empty($service['mail_bcc'])) {
                            $arr_mail_bcc = self::getReceiver($service['mail_bcc']);
                        }
                    }
                    // Send mail to service's manager when sid = 8
                    // Service name: 助成金制度活用

                    if ($id == 8) {
                        $mail_service_id8 = config('mail.mail_service_id8');
                        $arr_mail_to = $mail_service_id8['to'];
                        $arr_mail_cc = $mail_service_id8['cc'];
                        $arr_mail_bcc = config('mail.admin_email');
                    }
                    if (count($arr_mail_to) > 0) {

                        Mail::to($arr_mail_to)
                            ->cc($arr_mail_cc)
//                          ->bcc($arr_mail_bcc)
                            ->send(new PaymentDone($user, $service, $params, $email_subject));
                    }
                }
            }
        } catch (\Exception $e) {
        }
    }

    public static function SendMailUserRegister($params)
    {

        $email_subject = '【ハタラクラブ】ご入会申請完了のご案内';
        $service_mail_test = config('mail.service_mail_test');
        $arr_mail_bcc = $service_mail_test['bcc'];
        try {
            if (!empty($params['email'])) {
                Mail::to($params['email'])
//                  ->bcc($arr_mail_bcc)
                    ->send(new UserRegister($params, $email_subject));
            } else {
                return false;
            }

        } catch (\Exception $e) {
        }
    }

    public static function getReceiver($list_mails = '')
    {
        $mails = array();

        $a_mails = explode(',', $list_mails);
        foreach ($a_mails as $mail) {
            $mail = trim($mail);
            $name = '';
            $mail_address = '';
            $rex = '/<(.*?)>/s';

            $t = preg_match($rex, $mail, $matches);
            if (count($matches) > 1) {
                $name = $matches[1];
            }
            $mail_address = preg_replace($rex, '', $mail);
            $mail_address = trim($mail_address);

            $mails[$mail_address] = $name;
        }
        return $mails;
    }



    // Mail 11 - send to user at contact page if email
    public static function sendMailUserContact($params)
    {
        if (!empty($params['email'])) {
            $email_subject = '【ハタラクラブ】お問合せを受け付けました';
            $to = $params['email'];
            $to_name = '';

            $service_mail_test = config('mail.service_mail_test');
            $arr_mail_bcc = $service_mail_test['bcc'];
            $params['is_admin'] = false;
            try {
                Mail::to($to, $to_name)
//                    ->cc($arr_mail_cc)
//                    ->bcc($arr_mail_bcc)
                    ->send(new Contact($params, $email_subject));
                return true;
            } catch (\Exception $e) {
                return false;
            }
        }
    }

    // Mail 12 - send to admin at contact page
    public static function sendMailAdminContact($params)
    {
        $email_subject = config('mail.contact_subject');
        $email_subject .= $params['company'];

        $to = config('mail.contact_email');
        $to_name = config('mail.contact_name');
        $service_mail_test = config('mail.service_mail_test');
        $arr_mail_bcc = $service_mail_test['bcc'];
        $params['is_admin'] = true;
        try {
            Mail::to($to, $to_name)
//                ->cc($arr_mail_cc)
//                ->bcc($arr_mail_bcc)
                ->send(new Contact($params, $email_subject));
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    public static function SendMailForgotPassword($user_email, $forgot_token){
        $represent_name = 'あなた';
        $user = User::where('email', $user_email)->get();
        if (count($user) > 0) {
            $represent_name = $user[0]['represent'];
        }
        // If there is a row affected, send mail to that user with new password
        $reset_link = config('app.url_web_hataraclub') . '/user/recover_password?reset_token=' . $forgot_token;
        $data['represent_name'] = $represent_name;
        $data['url'] = $reset_link;

        $email_subject = config('mail.forgot_password_subject');

        try {
            Mail::to($user_email, $represent_name)
//                ->cc($arr_mail_cc)
//                ->bcc($arr_mail_bcc)
                ->send(new ForgotPassword($data, $email_subject));
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }


}
