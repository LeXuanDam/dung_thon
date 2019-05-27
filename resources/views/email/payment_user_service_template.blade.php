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
        <p>{{ isset($info_data['company']) ? $info_data['company'] : ''}}</p>
        <p>{{ isset($info_data['represent']) ? $info_data['represent'].'様' : ''}}</p>
		<br/>
		<p>ハタラクラブ事務局でございます。</p>
		<p>このたびはハタラクラブ事業協同組合に出資金をご入金いただき、</p>
		<p>誠にありがとうございます。</p>
		<br/>
		<p>ハタラクラブの組合員としての登録が完了いたしました。</p>
		<p>---------------------</p>
		<br/>
		<p>{{ isset($info_data['represent']) ? $info_data['represent'].'様の組合員番号' : ''}}</p>
		<p>No.{{ isset($info_data['user_code']) ? $info_data['user_code'] : ''}}</p>
		<br/>
		<p>---------------------</p>
		<br/>
		<p>ハタラクラブでは、様々なサービスをご提供しております！</p>
		<br/>
		<p>サービスのお申込みはこちらから！</p>
		<p><a href="{{Uri::base(false).'index'}}">【ハタラクラブのメニューサイト】 から</a></p>
		<br/>
		<p>---------------------</p>
		<br/>
		<p>このメールはシステムより自動送信しております。</p>
		<p>本メールへの返信はご遠慮ください。</p>
    	<br/>
		<p>ご不明な点がありましたら、以下のページからお問合せください。</p>
		<p><a href="{{Uri::base(false).'pages/contact'}}">【お問合せページへ】</a></p><br/>
		<br/>
		<p>今後ともよろしくお願い申し上げます。</p>
		<p>---------------------</p>
		<p>ハタラクラブ事務局</p>
		<p>---------------------</p>
    </div>
</body>
</html>
