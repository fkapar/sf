<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// PHPMailer nesnesi oluştur
$mail = new PHPMailer(true);

try {
    // SMTP ayarları
    $mail->isSMTP();
    $mail->Host = 'mail.socialfern.com'; // SMTP sunucu adresi
    $mail->SMTPAuth = true; // SMTP kimlik doğrulama
    $mail->Username = 'info@socialfern.com'; // SMTP kullanıcı adı
    $mail->Password = 'frt-kpr1'; // SMTP şifre
    $mail->SMTPSecure = 'tls'; // Güvenli bağlantı türü: tls veya ssl
    $mail->Port = 465; // SMTP port numarası

    // Gönderen bilgileri
    $mail->setFrom($_POST["email"], $_POST["name"]);

    // Alıcı bilgileri
    $mail->addAddress('socialfernsite@gmail.com', 'Social Fern');

    // Konu ve içerik
    $mail->Subject = 'Test Email';
    $mail->Body = 'Bu bir test e-postasıdır.';

    // E-posta gönderme işlemi
    $mail->send();

    echo 'E-posta başarıyla gönderildi.';
} catch (Exception $e) {
    echo 'E-posta gönderme hatası: ' . $mail->ErrorInfo;
}
?>
