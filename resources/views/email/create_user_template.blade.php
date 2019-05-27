<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>【ハタラクラブ】サービスのお申込み完了</title>
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
		<p>以下のお客様から入会申請が送信されました。</p>
		<br/>
		<p>----------</p>
        <br/>

            <table>
                <tbody>
                    <tr>
                        <td>
                            <div><strong>会社名</strong></div>
                            <div>{{ $info_data['company']}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>代表者名</strong></div>
                            <div>{{ $info_data['represent']}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>資本金</strong></div>
                            <div>{{ isset($info_data['user_funds']) ? $info_data['user_funds']. '万円' : ''}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>従業員数</strong></div>
                            <div>
                                <?php
                                    if (isset($info_data['number_of_staff'] )
                                         && (int)$info_data['number_of_staff'] > 0) {
                                        if ( null != Utilities::STAFF_NUMBER_LIST[$info_data['number_of_staff']] ) {
                                            echo Utilities::STAFF_NUMBER_LIST[$info_data['number_of_staff']]['name'] . '人';
                                        }
                                    }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>業種</strong></div>
                            <div>{{ isset($info_data['business_type']) ? $info_data['business_type'] : '';?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>メールアドレス</strong></div>
                            <div>{{ isset($info_data['email']) ? $info_data['email'] : '';?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>携帯電話番号</strong></div>
                            <div>{{ isset($info_data['tel']) ? $info_data['tel'] : '';?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>所在地</strong></div>
                            <div>{{ '〒'.$info_data['postcode']}}</div>
                            <div>{{ $info_data['address'].$info_data['address_number']}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>サービス</strong></div>
                            <?php foreach ($info_data['servicesSelect'] as $key => $value) {
                                if ($value['checked'] == 1) {
                                    ?> <div> <?php echo $value['name']."<br/>";?></div>
                            <?php   }
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>建設業許可証明書</strong></div>
                            <?php if(isset($info_data['certificate_image']) && !empty($info_data['certificate_image'])):?>
                            <div>
                                <a href="{{ url('/') . 'uploads/' . $info_data['certificate_image']}}">
                                    {{ $info_data['certificate_image']}}
                                </a>
                            </div>
                            <?php endif;?>
                        </td>
                    </tr>
                </tbody>
            </table>

		<br/>
        <p>以下の１〜４の規約に同意する</p>
        <div>
            <a class="acceptance-member" target="_blank" href="<?php echo Uri::base(false) . 'pages/policy02'; ?>">１. 加入規約</a>
            <a class="acceptance-member" target="_blank" href="<?php echo Uri::base(false) . 'pages/service_terms'; ?>">２.利用規約</a>
            <a class="acceptance-member" target="_blank" href="<?php echo Uri::base(false) . 'pages/privacy_policy'; ?>">３.反社会的勢力排除に関する誓約書</a>
            <a class="acceptance-member" target="_blank" href="<?php echo Uri::base(false) . 'pages/policy'; ?>">４.プライバシーポリシー</a>
        </div>
        <br/>
		<p>----------</p>
        <br/>
		<p>このメールはシステムより自動送信しております。</p>
    </div>
</body>
</html>
