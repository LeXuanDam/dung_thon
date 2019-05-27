<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>出資金についてのご案内</title>
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
        <p>{{ isset($info_data['company']) ? $info_data['company'] : ''}}</p>
        <p>{{ isset($info_data['represent']) ? $info_data['represent'].'様' : ''}}</p>
        <br/>
        <p>ハタラクラブ事務局でございます。</p>
        <p>このたびはハタラクラブ事業協同組合にお申し込みいただき、</p>
        <p>誠にありがとうございます。</p><br/>

        <p>以下の内容でハタラクラブ事業協同組合に入会の申込み(登録)されました。</p>
        <br/>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div><strong>代表者名</strong></div>
                            <div>{{$info_data['represent']}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>会社名</strong></div>
                            <div>{{$info_data['company']}}</div>
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
                                         && (int)$info_data['number_of_staff'] > 0)  {
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
                            <div>{{ isset($info_data['business_type']) ? $info_data['business_type'] : ''}}</div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div><strong>メールアドレス</strong></div>
                            <div>{{ isset($info_data['email']) ? $info_data['email'] : ''}}</div>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div><strong>携帯電話番号</strong></div>
                            <div>{{ isset($info_data['tel']) ? $info_data['tel'] : ''}}</div>
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
                            <?php
                                if(!empty($info_data['servicesSelect'])){
                            foreach ($info_data['servicesSelect'] as $key => $value) {
                                if ($value['checked'] == 1) {
                                    ?> <div> <?php echo $value['name'];?></div>
                            <?php    }
                            }
                            }?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>建設業許可証明書</strong></div>
                            <?php if(isset($info_data['certificate_image']) && !empty($info_data['certificate_image'])):?>
                            <div>
                                <a href="{{ url('/') . '/storage/app/' . $info_data['certificate_image']}}">
                                    {{ $info_data['certificate_image']}}
                                </a>
                            </div>
                            <?php endif;?>
                        </td>
                    </tr>
                </tbody>
            </table>
        <br/>

        <p>プロフィール画面からご確認・ご変更が可能です。</p><br/>

        <p>サービスのご利用につきましては、</p>
        <p>理事会にて承認を得たのち、出資金のご入金確認をもって、</p>
        <p>サービスのご利用が可能となります。</p><br/>

        <p>サービスは、<a href="{{url('/')}}">【ハタラクラブのメニューサイト】</a>から</p>
        <p>いつでも追加のお申込みができます。</p>
            <br/>
        <p>---------------------</p>
            <br/>
        <p>このメールはシステムより自動送信しております。</p>
        <p>本メールへの返信はご遠慮ください。</p><br/>

        <p>ご不明な点がありましたら、以下のページからお問合せください。</p>
        <p><a href="{{config('app.url_web_hataraclub').'/pages/contact'}}">【お問合せページへ】</a></p><br/>

        <p>今後ともよろしくお願い申し上げます。</p>
        <p>---------------------</p>
        <p>ハタラクラブ事務局</p>
        <p>---------------------</p>

    </div>
</body>
</html>
