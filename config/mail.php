<?php
$serviceMailTest = [
    'to' => ['viet.nguyen@fujitechjsc.com'],
    'cc' => [],
    'bcc' => [
        'thao.do@fujitechjsc.com',
        'anh.tran@fujitechjsc.com',
        'viet.nguyen@fujitechjsc.com',
        'namaizawa2018@gmail.com',
        'misaki.dohi@fujitechjsc.com'
    ]
];

// with a name
$mailServiceId8 = [
    'to' => [
        'viet.nguyen@fujitechjsc.com' => 'wakatsuki'
    ],
    'cc' => [
       'lexuandam96@gmail.com'
    ]
];
return [

    'mail_service_id8' => $mailServiceId8,
    'service_mail_test' => $serviceMailTest,
    'admin_email' => 'sys-test@hatara-club.jp',
    'admin_name' => 'ハタラクラブ',
    'contact_email' => 'mail@hatara-club.jp',
    'contact_name' => 'ハタラクラブ',
    'mail_from' => 'lexuandam96@gmail.com',
//    'mail_from' => 'hatara-club@www3739.sakura.ne.jp',
    'mail_from_name' => 'ハタラクラブ',
    'forgot_password_subject' => '【パスワード再発行のご案内】',
    'contact_subject' => '【お問い合わせ】',
    'register_subject' => '【入会申請】',
    'register_funds_subject' => '【ハタラクラブ】ご入会申請完了のご案内',
    'add_service_subject' => '【サービス申込み】',
    'update_profile' => '【ハタラクラブ】プロフィール変更',
    'payment_done' => '【ハタラクラブ】組合員様からサービスのお申込み',
    /*
    |--------------------------------------------------------------------------
    | Mail Driver
    |--------------------------------------------------------------------------
    |
    | Laravel supports both SMTP and PHP's "mail" function as drivers for the
    | sending of e-mail. You may specify which one you're using throughout
    | your application here. By default, Laravel is setup for SMTP mail.
    |
    | Supported: "smtp", "sendmail", "mailgun", "mandrill", "ses",
    |            "sparkpost", "postmark", "log", "array"
    |
    */

    'driver' => env('MAIL_DRIVER', 'smtp'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Host Address
    |--------------------------------------------------------------------------
    |
    | Here you may provide the host address of the SMTP server used by your
    | applications. A default option is provided that is compatible with
    | the Mailgun mail service which will provide reliable deliveries.
    |
    */

    'host' => env('MAIL_HOST', 'smtp.mailgun.org'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Host Port
    |--------------------------------------------------------------------------
    |
    | This is the SMTP port used by your application to deliver e-mails to
    | users of the application. Like the host we have set this value to
    | stay compatible with the Mailgun e-mail application by default.
    |
    */

    'port' => env('MAIL_PORT', 587),

    /*
    |--------------------------------------------------------------------------
    | Global "From" Address
    |--------------------------------------------------------------------------
    |
    | You may wish for all e-mails sent by your application to be sent from
    | the same address. Here, you may specify a name and address that is
    | used globally for all e-mails that are sent by your application.
    |
    */

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
        'name' => env('MAIL_FROM_NAME', 'Example'),
    ],

    /*
    |--------------------------------------------------------------------------
    | E-Mail Encryption Protocol
    |--------------------------------------------------------------------------
    |
    | Here you may specify the encryption protocol that should be used when
    | the application send e-mail messages. A sensible default using the
    | transport layer security protocol should provide great security.
    |
    */

    'encryption' => env('MAIL_ENCRYPTION', 'tls'),

    /*
    |--------------------------------------------------------------------------
    | SMTP Server Username
    |--------------------------------------------------------------------------
    |
    | If your SMTP server requires a username for authentication, you should
    | set it here. This will get used to authenticate with your server on
    | connection. You may also set the "password" value below this one.
    |
    */

    'username' => env('MAIL_USERNAME'),

    'password' => env('MAIL_PASSWORD'),

    /*
    |--------------------------------------------------------------------------
    | Sendmail System Path
    |--------------------------------------------------------------------------
    |
    | When using the "sendmail" driver to send e-mails, we will need to know
    | the path to where Sendmail lives on this server. A default path has
    | been provided here, which will work well on most of your systems.
    |
    */

    'sendmail' => '/usr/sbin/sendmail -bs',

    /*
    |--------------------------------------------------------------------------
    | Markdown Mail Settings
    |--------------------------------------------------------------------------
    |
    | If you are using Markdown based email rendering, you may configure your
    | theme and component paths here, allowing you to customize the design
    | of the emails. Or, you may simply stick with the Laravel defaults!
    |
    */

    'markdown' => [
        'theme' => 'default',

        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Log Channel
    |--------------------------------------------------------------------------
    |
    | If you are using the "log" driver, you may specify the logging channel
    | if you prefer to keep mail messages separate from other log entries
    | for simpler reading. Otherwise, the default channel will be used.
    |
    */

    'log_channel' => env('MAIL_LOG_CHANNEL'),

];
