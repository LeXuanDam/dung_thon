<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>プロフィール変更</title>
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
        <p>ユーザーがプロフィール変更をしました。</p>
        <p>登録情報を確認してください。</p>
        <p>----------</p>
        
        <p class="mt20">【変更後のプロフィール内容】</p>
        <p>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div><strong>会社名</strong></div>
                            <div><?= $update_data['company']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>代表者名</strong></div>
                            <div><?= $update_data['represent'];?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>資本金</strong></div>
                            <div><?= isset($update_data['user_funds']) ? $update_data['user_funds'] : 0;?>万円</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>従業員数</strong></div>
                            <div><?= isset($update_data['number_of_staff']) ? $update_data['number_of_staff'] : '';?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>業種</strong></div>
                            <div><?= isset($update_data['business_type']) ? $update_data['business_type'] : '';?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>メールアドレス</strong></div>
                            <div><?= isset($update_data['email']) ? $update_data['email'] : '';?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>携帯電話番号</strong></div>
                            <div><?= $update_data['tel']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>所在地</strong></div>
                            <div><?= '〒'.$update_data['postcode']; ?></div>
                            <div><?= $update_data['address'].$update_data['address_number']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>建設業許可証明書</strong></div>
                            <?php if(isset($update_data['certificate_image']) && !empty($update_data['certificate_image'])):?>
                            <div>
                                <a href="<?= Uri::base(false) . 'uploads/' . $update_data['certificate_image']; ?>">
                                    <?= $update_data['certificate_image']; ?>
                                </a>
                            </div>
                            <?php endif;?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </p>

        <p>--------------------------------</p>

        <p class="mt20">【変更前のプロフィール内容】</p>
        <p>
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div><strong>会社名</strong></div>
                            <div><?= $params['company']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>代表者名</strong></div>
                            <div><?= $params['represent'];?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>資本金</strong></div>
                            <div><?= isset($params['user_funds']) ? $params['user_funds'] : 0;?>万円</div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>従業員数</strong></div>
                            <div><?= isset($params['number_of_staff']) ? $params['number_of_staff'] : '';?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>業種</strong></div>
                            <div><?= isset($params['business_type']) ? $params['business_type'] : '';?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>メールアドレス</strong></div>
                            <div><?= isset($params['email']) ? $params['email'] : '';?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>携帯電話番号</strong></div>
                            <div><?= $params['tel']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>所在地</strong></div>
                            <div><?= '〒'.$params['postcode']; ?></div>
                            <div><?= $params['address'].$params['address_number']; ?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><strong>建設業許可証明書</strong></div>
                            <?php if(isset($params['certificate_image']) && !empty($params['certificate_image'])):?>
                            <div>
                                <a href="<?= Uri::base(false) . 'uploads/' . $params['certificate_image']; ?>">
                                    <?= $params['certificate_image']; ?>
                                </a>
                            </div>
                            <?php endif;?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </p>     

        <p>--------------------------------</p>

        <p>このメールはシステムより自動送信しております。</p>
    </div>
</body>
</html>