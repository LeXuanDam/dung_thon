<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>[パスワード再発行]　詳細情報</title>
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
        @media screen and (max-width: 767px) {
            #htr-registeration table {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div id="htr-registeration">
        <p><strong>{{$data['represent_name']}}</strong> 様</p>
        <p>
            <div>日頃よりハタラククラブのサービスをご愛顧いただきありがとうございます。</div>
            <div>ハタラクラブ事務局でございます。</div>
        </p>
        <p>
            <div>-----------------------</div>
            <div>以下のURLをクリックして、パスワードの再発行をしてください。</div>
        </p>
        <p>{{$data['url']}}</p>
        <p>
            <div>※上記URLは、メール送信時間より48時間有効です。</div>
            <div>※有効期限を過ぎた場合、お手数ですがパスワード再発行申請が必要となりますのでご注意ください。</div>
            <div>-----------------------</div>
        </p>
        <p>
            <div>このメールはシステムより自動送信しております。</div>
            <div>本メールへの返信はご遠慮ください。</div>
        </p> 
        
        <p>
            <div>ご不明な点がありましたら、以下のページからお問合せください。</div>
            <div><a href="<?php echo config('app.url_web_hataraclub').'/pages/contact'; ?>">【お問合せページへ】</a></div>
        </p>
        <p>
            今後ともよろしくお願い申し上げます。
        </p>
        <p>
            <div>-----------------------</div>
            <div>ハタラクラブ事務局</div>
            <div>-----------------------</div>
        </p>
    </div>
</body>
</html>
