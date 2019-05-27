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
        <p>{{ isset($user['company']) ? $user['company'] : ''}}<br/>{{ isset($user['represent']) ? $user['represent'].'様' : ''}}</p>
        
        <p>ハタラクラブ事務局でございます。</p>
        <p>このたびはハタラクラブのサービスにお申し込みいただき、<br/>
        誠にありがとうございます。</p>
        
        <p>以下のサービスに利用お申込みが完了いたしました。<br/>
        サービス会社の担当者からのご連絡をお待ちください。</p>
        
        <?php $i = 0; ?>
        <?php foreach($services as $service) {?>
            <?php if($service['status'] == Utilities::SERVICE_USING) {?>
                <?php if(++$i == 1){ ?>
                <p>-----------------------</p>
                <?php }?>
                <div>{{$service['name']}}</div>
                <div>{{$service['company_name']}}</div>
                <div>
                    <a href="{{ Uri::base(false) . 'pages/' . $service['id']}}">
                        【サービス紹介ページへ】
                    </a>
                </div>
                <p>-----------------------</p>
            <?php }?>
        <?php } ?>
        
        <p clas>このメールはシステムより自動送信しております。
        <br/>本メールへの返信はご遠慮ください。</p>
        
        <p>ご不明な点がありましたら、以下のページからお問合せください。<br>
            <a href="{{ Uri::base(false) . 'pages/contact'}}">
                【お問合せページへ】
            </a>
        </p>
        
        <p>今後ともよろしくお願い申し上げます。</p>
        
        <p>-----------------------</p>
        <div>ハタラクラブ事務局</div>
        <p>-----------------------</p>
    </div>
</body>
</html>
