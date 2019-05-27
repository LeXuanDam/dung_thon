<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>お問い合わせ　詳細情報</title>
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
    <?php  if ( isset($userInfo->company) && ($userInfo->company == $params['company']) ) : ?>
    <p>組合員の{{$userInfo->company }}様からのお問い合わせが届きました。
    <p>
    <?php else: ?>
    <p>非組合員の{{$params['company'] }}様からのお問い合わせが届きました。
    <p>
    <?php endif;?>
    <table>
        <tbody>
        <tr>
            <td>
                <div><strong>会社名</strong></div>
                <div>{{$params['company'] }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div><strong>お名前</strong></div>
                <div>{{$params['represent']}}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div><strong>メールアドレス</strong></div>
                <div>{{$params['email'] }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div><strong>電話番号</strong></div>
                <div>{{$params['tel'] }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div><strong>お問合せ項目</strong></div>
                <div>{{$params['inquiry'] }}</div>
            </td>
        </tr>
        <tr>
            <td>
                <div><strong>お問合せ内容</strong></div>
                <div>{{$params['note'] }}</div>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>
