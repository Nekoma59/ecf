<?php
// Set the sender email address
require_once('../Controller/Config.php');
require_once('../PHPMailer-master/src/PHPMailer.php');
require_once('../PHPMailer-master/src/SMTP.php');
require_once('../PHPMailer-master/src/Exception.php');
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$sender_email = "cinephoria.cinema@gmail.com";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the recipient email address from the form
    $email = $_POST['email'];
    $recipient_email = Config::getUserEmail($email);
    $mdp=Config::getUserPassword($email);
    if ($recipient_email) {
        // Set the subject line for the email
        $subject = "Password of your account";

        // Set the message body for the email
        $message = "Dear user,\r\n\r\n";
        $message .= "We have received a request to get the password of your account.\r\n";
        $message .= "Here is your password: '".$mdp."'\r\n";
       
        $message .= "If you did not request a password retake, please ignore this email.\r\n\r\n";
        $message .= "Best regards,\r\n";
        $message .= "Your website team Cinephoria";

        // Set SMTP server and credentials
        $smtpHost = 'smtp.gmail.com';
        $smtpUsername = 'cinephoria.cinema@gmail.com';
        $smtpPassword = 'jwbszzvjqtxrzqwf';
        $smtpPort = "587";
        $smtpAuth = true;
        $smtpStartTLS = false;

        // Create PHPMailer instance
        $mail = new PHPMailer();
        try {
            // Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = $smtpHost;
            $mail->SMTPAuth = $smtpAuth;
            $mail->Username = $smtpUsername;
            $mail->Password = $smtpPassword;
            $mail->SMTPSecure = $smtpStartTLS ? PHPMailer::ENCRYPTION_STARTTLS : '';
            $mail->SMTPSecure = 'tls';
            $mail->Port = $smtpPort;

            // Recipients
            $mail->setFrom($sender_email);
            $mail->addAddress($recipient_email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            echo '<script type="text/javascript">';
            echo 'alert("Email sent successfully!");';
            echo '</script>';
        } catch (Exception $e) {
            echo "Password sending failed: " . $mail->ErrorInfo;
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Invalid user account");';
        echo '</script>';
    }
    error_reporting(0);
}
?>

<style>
    .send {
       background-color: white; 
       color: rgb(0, 173, 173);
       border-radius: 10px;
       border-width: 1px;
       height: 32px;
       border-color: aquamarine;
       border-style: solid;
       cursor: pointer;
       margin-right: 8px;
    }
    .send:hover{
        background-color: blue;
        color: white;
    }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="../login.css">
  <title>Get password</title>
</head>
<body>
    
    <section >
        <div class="form-box">
            <div class="form-value">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <h2>Password Forgotten ?</h2>
                    
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" id="email" name="email" required>
                        <label for="email">Email</label>
                    </div>
                       
                    <button type="submit" name="send" class="send">SEND</button>

                </form>
            </div>
        </div>
    </section>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>
