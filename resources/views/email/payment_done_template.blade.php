<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>【ハタラクラブ】組合員様からサービスのお申込み</title>
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
        <p>{{ isset($service['company_name']) ? $service['company_name'] : ''}}<br>ご担当者様</p>
        <p>ハタラクラブ事務局でございます。</p>
        <p>以下の組合員様から【{{$service['name']}}】にお申込みがありました。<br>
        ご対応のほど、よろしくお願い申し上げます。</p>
        <p>ご契約成立後は、以下のメールアドレスにご連絡をお願いいたします。<br>
        entry@hatara-club.jp</p>
        <p>ご不明な点につきましては各担当者窓口まで<br>ご連絡いただきますようよろしくお願い申し上げます。</p>
        <p>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div><strong>会社名</strong></div>
                            <div>{{ $params['company']}}</div>
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
                            <div><strong>資本金</strong></div>
                            <div>{{ $params['user_funds'] . '万円'}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>従業員数</strong></div>
                            <div>
                                <?php
                                if ((int)$params['number_of_staff'] > 0) {
                                    if ( null != Utilities::STAFF_NUMBER_LIST[$params['number_of_staff']] ) {
                                        echo Utilities::STAFF_NUMBER_LIST[$params['number_of_staff']]['name'] . '人';
                                    }
                                }
                                ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>業種</strong></div>
                            <div>{{ $params['business_type']}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>メールアドレス</strong></div>
                            <div>{{ $params['email']}}</div>
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
                            <div>{{ '〒'.$user['postcode']}}</div>
                            <div>{{ $user['address'].$user['address_number']}}</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>建設業許可証明書</strong></div>
                            <?php if(isset($params['certificate_image']) && !empty($params['certificate_image'])):?>
                            <div>
                                <a href="{{ Uri::base(false) . 'uploads/' . $params['certificate_image']}}">
                                    {{ $params['certificate_image']}}
                                </a>
                            </div>
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>サービスお申込み日</strong></div>
                            <div>{{$service['checked']}}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </p>
        <p clas>このメールはシステムより自動送信しております。</p>
        <p>本メールへの返信はご遠慮ください。<br>今後ともよろしくお願い申し上げます。</p>
        <p>-----------------------</p>
        <p>ハタラクラブ事務局<br>mail@hatara-club.jp</p>
        <p>ハタラクラブ事業協同組合<br>〒104-0032<br>東京都中央区八丁堀3-18-6 PMO京橋東 6階</p>
        <p>TEL：03-6262-8395<br>FAX：03-6262-8396</p>
        <p>-----------------------</p>
    </div>
</body>
</html>
