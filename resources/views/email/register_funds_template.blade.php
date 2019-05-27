<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>【ハタラクラブ】ご入会申請完了のご案内</title>
    <style>
        #htr-registeration table {
            border-spacing: 0;
            border-collapse: collapse;
            min-width: 50%;
        }
        #htr-registeration table td {
            padding: 10px 20px;
            border: 1px solid #7d7d7d;
        }
        #htr-registeration .acceptance-member {
            color: #00a4e3;
            margin-bottom: 10px;
            display: block;
        }
        @media screen and (max-width: 767px) {
            #htr-registeration table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div style="margin-bottom: 30px;">{{ $user['company'] . '  ' . $user['represent'] . '様' }}</div>
    <div>ハタラクラブ事務局でございます。</div>
    <div style="margin-bottom: 30px;">このたびはハタラクラブ事業協同組合にお申し込みいただき、誠にありがとうございます。</div>
    <div>以下の内容でハタラクラブに申込み（登録）されました。</div>
    <div>-----------------------</div>
    <div id="htr-registeration">
        <table>
            <tbody>
                <tr>
                    <td>
                        <div><strong>会社名</strong></div>
                        <div>{{ $user['company']}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>代表者名</strong></div>
                        <div>{{ $user['represent']}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>携帯電話番号</strong></div>
                        <div>{{ $user['tel']}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>メールアドレス</strong></div>
                        <div>{{ isset($params['email'])? $params['email'] : ''}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>所在地</strong></div>
                        <div>{{ '〒'.$user['postcode']}}</div>
                        <div>{{ $user['address'].$user['address_number']}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>サービス</strong></div>
                        <?php
                        if (isset($user['services_name'])) {
                            foreach ($user['services_name'] as $services_name) {
                                ?> <div>{{ ' - '. $services_name}}</div> <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>建設業許可証明書</strong></div>
                        <?php if(isset($user['certificate_image']) && !empty($user['certificate_image'])):?>
                        <div>
                            <a href="{{ Uri::base(false) . 'uploads/' . $user['certificate_image']}}">
                                {{ $user['certificate_image']}}
                            </a>
                        </div>
                        <?php endif;?>
                    </td>
                </tr>
                <tr>
                    <p>以下の１〜４の規約に同意する</p>
                    <div>
                        <a class="acceptance-member" target="_blank" href="<?php echo Uri::base(false) . 'pages/policy02'; ?>">１. 加入規約</a>
                        <a class="acceptance-member" target="_blank" href="<?php echo Uri::base(false) . 'pages/service_terms'; ?>">２.利用規約</a>
                        <a class="acceptance-member" target="_blank" href="<?php echo Uri::base(false) . 'pages/privacy_policy'; ?>">３.反社会的勢力排除に関する誓約書</a>
                        <a class="acceptance-member" target="_blank" href="<?php echo Uri::base(false) . 'pages/policy'; ?>">４.プライバシーポリシー</a>
                    </div>
                </tr>
            </tbody>
        </table>
    </div>

    <div>-----------------------</div>
    <div style="margin-bottom: 30px;">プロフィール画面からご確認・ご変更が可能です。</div>
    
    <div>このメールはシステムより自動送信しております。</div>
    <div style="margin-bottom: 30px;">本メールへの返信はご遠慮ください。</div>

    <div>ご不明な点がありましたら、以下のページからお問合せください。</div>
    <div style="margin-bottom: 30px;"><a href="{{Uri::base(false) . 'pages/contact'}}">【お問合せページへ】</a></div>

    <div  style="margin-bottom: 30px;">今後ともよろしくお願い申し上げます。</div>

    <div>-----------------------</div>
    <div>ハタラクラブ事務局</div>
    <div>-----------------------</div>
</body>
</html>
