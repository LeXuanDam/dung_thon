<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>【サービス申込み】</title>
    <style>
        #htr-registeration table {
            border-spacing: 0;
            border-collapse: collapse;
            min-width: 50%;
        }

        #htr-registeration table td, #htr-registeration table th {
            padding: 10px 20px;
            border: 1px solid #7d7d7d;
        }

        #htr-registeration table th {
            text-align: left;
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
    <p>サービスの申し込みが届きました。</p>
    <p>
    <table>
        <tbody>
        <tr>
            <th>会社名</th>
            <td>{{ isset($params['company']) ? $params['company'] : '' }}</td>
        </tr>
        <tr>
            <th>所在地</th>
            <td>
                〒{{ isset($params['postcode']) ? $params['postcode'] : '' }} {{ isset($params['address']) ? $params['address'] : '' }}</td>
        </tr>
        <tr>
            <th>携帯電話番号</th>
            <td>{{ isset($params['tel']) ? $params['tel'] : '' }}</td>
        </tr>
        <tr>
            <th>代表者名</th>
            <td>{{ isset($params['represent']) ? $params['represent'] : '' }}</td>
        </tr>
        <tr>
            <th>サービス名</th>
            <td>{{ isset($params['service_name']) ? $params['service_name'] : '' }}</td>
        </tr>
        </tbody>
    </table>
    </p>

    <?php
    if ( isset($params['service_url']) ) : ?>
    <p>
        以下のリンクを参考: <a class="acceptance-member" target="_blank"
                      href="{{ $params['service_url'] }}">
            {{ $params['service_name'] }}
        </a>
    </p>
    <?php
    endif
    ?>
</div>
</body>
</html>
