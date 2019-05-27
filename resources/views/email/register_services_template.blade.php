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
        <p>{{ isset($info_user->company) ? $info_user->company : ''}}</p>
        <p>{{ isset($info_user->represent) ? $info_user->represent. '様' : ''}}</p>
		<p>ハタラクラブ事務局でございます。</p>
		<p>日頃よりハタラククラブのサービスをご愛顧いただきありがとうございます。</p>
        <br/>
		<p>---------------------</p>
        <br/>
		<p>以下のサービスの利用お申込みが完了いたしました。</p>
		<p>{{ isset($info_services->name) ? $info_services->name : ''}}</p>
		<p>{{ isset($info_services->company_name) ? $info_services->company_name : ''}} 様からのご連絡をお待ちください。</p>
        <br/>
		<p>---------------------</p>
        <br/>
		<p>このメールはシステムより自動送信しております。</p>
		<p>本メールへの返信はご遠慮ください。</p>
        <br/>
		<p>ご不明な点がありましたら、以下のページからお問合せください。</p>
		<p><a href="{{config('app.url_web_hataraclub') . '/pages/contact'}}">【お問合せページへ】</a></p>
        <br/>
		<p>今後ともよろしくお願い申し上げます。</p>
		<p>---------------------</p>
		<p>ハタラクラブ事務局</p>
		<p>---------------------</p>
    </div>
</body>
</html>
