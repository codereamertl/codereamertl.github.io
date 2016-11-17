<?php

$recaptcha = $_POST['g-recaptcha-response'];

if (!empty($recaptcha)) {
    $google_url = "https://www.google.com/recaptcha/api/siteverify";
    $secret = '6LeTEwwUAAAAAEfjidTZ0wYWQZQDQs-qAqWsW8rA'; //registered by mrmysql.90@gmail.com
    $ip = $_SERVER['REMOTE_ADDR'];
    $url = $google_url . "?secret=" . $secret . "&response=" . $recaptcha . "&remoteip=" . $ip;
    $res = getCurlData($url);
    $res = json_decode($res, true);

    if ($res['success']) {
        $fn = htmlspecialchars($_POST['fn']);
        $ln = htmlspecialchars($_POST['ln']);
        $email = htmlspecialchars($_POST['email']);
        $company = htmlspecialchars($_POST['company']);
        $phone = htmlspecialchars($_POST['phone']);
        $m = htmlspecialchars($_POST['message']);

        $to = 'info@codereamertl.com';

        $subject = 'Codereamer Contant Form';

        $message = "
		<html>
		<head>
		  <title>Codereamer Contant Form</title>
		</head>
		<body>
		First Name: $fn<br>
		Last Name: $ln<br>
		Email: $email<br>
		Company: $company<br>
		Phone Number: $phone<br>
		Message:  $m<br>
		</body>
		</html>";

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        $headers .= 'To: Codereamer <info@codereamertl.com>' . "\r\n";
        $headers .= 'Cc: ' . $fn . ' ' . $ln . ' <' . $email . ">\r\n";
        $headers .= 'From: ' . $fn . ' ' . $ln . ' <' . $email . ">\r\n";
        $headers .= 'Reply-To: ' . $fn . ' ' . $ln . ' <' . $email . ">\r\n";
        $headers .= "X-Mailer: PHP/".phpversion();

        mail($to, $subject, $message, $headers);

        echo "Thank you for email!";
    } else {
        echo "Please repeat captcha.";
    }
} else {
    echo "Please repeat captcha.";
}

function getCurlData($url)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 10);
    curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
    $curlData = curl_exec($curl);
    curl_close($curl);
    return $curlData;
}