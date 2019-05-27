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
        <?php if (isset($params['company'])) { ?>
        <p><?=  $params['company'] ?></p>
        <p><?=  $params['represent'] ?>様</p>
        <?php } ?>

        <p>いつもお世話になっております。</p>
        <p>ハタラクラブ事務局でございます。  </p>
        <p>日頃よりハタラククラブをご愛顧いただき誠にありがとうございます。</p>
        <br>
        <p>ご入会に際し、出資金のお振込み口座をご案内申し上げます。</p>

        <p>-----------------------------------------</p>
		
        <table>
            <tbody>
                <tr>
                    <td>金融機関</td>
                    <td>千葉銀行</td>
                </tr>
                <tr>
                    <td>支店</td>
                    <td>松戸支店</td>
                </tr>
                <tr>
                    <td>口座種別</td>
                    <td>普通口座</td>
                </tr>
                <tr>
                    <td>口座番号</td>
                    <td>4331514</td>
                </tr>
                <tr>
                    <td>口座名義</td>
                    <td>ハタラクラブ事業協同組合 <br>　代表理事　高橋宰</td>
                </tr>
                <tr>
                    <td>お振込金額</td>
                    <td>10,000円</td>
                </tr>
            </tbody>
        </table>
      
        <p>-----------------------------------------</p>

		<p>ご入金確認後、電子メールにて貴殿の組合員番号をご通知いたします。 </p>
        <p>ご確認いただきますようお願い申し上げます。</p>
        <br>
        <p>※振込手数料はお客様ご負担でお願い致します。</p>
        <br>
        <p>※メール受信日より7日以内にお手続きいただきますようお願い致します。</p>


        <p>--------------------------------</p><br>

        <p>このメールはシステムを使って送信しております。</p>
        <br>
        <p>お手続きに関してご不明な点がありましたら、</p>

        <p>以下のページからお問合せください。</p>

		<p><a href="<?=Uri::base(false).'pages/contact'?>">【お問合せページへ】</a></p>

        <p>-----------------------------------------</p>
        <p>ハタラクラブ事務局</p>
        <p>-----------------------------------------</p>

    </div>
</body>
</html>