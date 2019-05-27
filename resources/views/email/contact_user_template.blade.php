<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>【ハタラクラブ】お問合せを受け付けました</title>
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
    <p>
        {{ isset($params['company']) ? $params['company'] : ''}}
        <br>
        {{ isset($params['represent']) ? $params['represent'].'様' : ''}}
    </p>
    <p>この度はお問合せいただきありがとうございます。<br>以下の内容でお問合せを受け付けいたしました。</p>
    <p>順次ご連絡させていただいておりますので、<br>今しばらくお待ち下さいませ。</p>
    <p>１週間以上経ってもハタラクラブよりご連絡がない場合は、<br>お手数ですが、再度ご連絡いただけますようお願いいたします。</p>
    <p>
    <table>
        <tbody>
        <tr>
            <td>
                <div><strong>お問合せ項目</strong></div>
                <div>{{ isset($params['inquiry']) ? $params['inquiry'] : ''}}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div><strong>お問合せ内容</strong></div>
                <div>{{ isset($params['note']) ? $params['note'] : ''}}</div>
            </td>
        </tr>
        </tbody>
    </table>
    </p>
    <p>---------------------</p>
    <p>このメールはシステムより自動送信しております。<br>本メールへの返信はご遠慮ください。</p>
    <p>ご不明な点がありましたら、以下のページから再度お問合せください。<br><a href="{{url('/').'pages/contact'}}">【お問合せページへ】</a></p>
    <p>
        今後ともよろしくお願い申し上げます。<br>
        ---------------------<br>
        ハタラクラブ事務局<br>
        ---------------------<br>
    </p>
</div>
</body>
</html>
