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
            min-width: 30%;
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
        <p>組合員様が以下のサービス契約を解除されましたので、</p>
        <p>管理画面にてサービス停止日を入力しました。</p>
        <p>----------</p>
        <p>組合員No.<?= isset($params['user_code']) ? $params['user_code'] : '';?><p>
        <p>会社名: <?= isset($params['company']) ? $params['company'] : '';?></p>
        <p>代表者名:<?= isset($params['represent']) ? $params['represent'] : '';?></p>
        <p>----------</p>
        <p>停止したサービス</p>
        <table>
          <tr>
            <th>サービス名</th>
            <th>停止日</th>
          </tr>
          <?php foreach ($services as $value): ?>
              <tr>
                <td style="text-align: center;"><?= $value['name']?></td>
                <td style="text-align: center;"><?= $value[4]?></td>
              </tr>
          <?php endforeach ?>
        </table>
        <p>--------</p>
        <p>このメールはシステムより自動送信しております。</p>
    </div>
</body>
</html>