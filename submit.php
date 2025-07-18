
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mail = new PHPMailer(true);

$full_name = $_POST['full_name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$address = $_POST['address'];
$reason = $_POST['reason'];

$photo_path = 'uploads/photos/' . time() . '_' . basename($_FILES['photo']['name']);
move_uploaded_file($_FILES['photo']['tmp_name'], $photo_path);

$signature_path = 'uploads/signatures/' . time() . '_' . basename($_FILES['signature']['name']);
move_uploaded_file($_FILES['signature']['tmp_name'], $signature_path);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'your_email@gmail.com';
    $mail->Password = 'your_app_password';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('your_email@gmail.com', 'LGBTQIA+ Registration');
    $mail->addAddress('jorenzmelo21@gmail.com');

    $mail->Subject = "New LGBTQIA+ 2025 Registration from $full_name";
    $mail->Body = "
    Full Name: $full_name
    Age: $age
    Gender: $gender
    Contact: $contact
    Email: $email
    Address: $address
    Reason: $reason
    ";

    $mail->addAttachment($photo_path);
    $mail->addAttachment($signature_path);

    $mail->send();
    echo "<h2>Thank you, $full_name!</h2><p>Email sent to admin.</p>";
} catch (Exception $e) {
    echo "Mailer Error: {$mail->ErrorInfo}";
}
?>
