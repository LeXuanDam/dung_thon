<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register new member</title>
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
    <div id="htr-registeration">
        <table>
            <tbody>
                <tr>
                    <td>
                        <div><strong>会社名</strong></div>
                        <div>{{ $params['company'] }}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>代表者名</strong></div>
                        <div>{{ $params['represent']}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>携帯電話番号</strong></div>
                        <div>{{ $params['tel']}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>所在地</strong></div>
                        <div>{{ '〒'.$params['postcode']}}</div>
                        <div>{{ $params['address'].$params['address_number']}}</div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>サービス</strong></div>
                        <?php
                        if (isset($params['services_name'])) {
                            foreach ($params['services_name'] as $services_name) {
                                ?> <div>{{ ' - '. $services_name}}</div> <?php
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div><strong>建設業許可証明書</strong></div>
                        <?php if(isset($params['certificate_image']) && !empty($params['certificate_image'])):?>
                        <div>
                            <a href="{{ url('/') . 'uploads/' . $params['certificate_image']}}">
                                {{ $params['certificate_image']}}
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
</body>
</html>
