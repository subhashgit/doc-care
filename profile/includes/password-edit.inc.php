<?php
session_start();

require '../../assets/includes/security_functions.php';
require '../../assets/includes/auth_functions.php';
check_logged_in();
require '../../assets/vendor/PHPMailer/src/Exception.php';
require '../../assets/vendor/PHPMailer/src/PHPMailer.php';
require '../../assets/vendor/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['update-password'])) {

    foreach($_POST as $key => $value){

        $_POST[$key] = _cleaninjections(trim($value));
    }

    /*
    * -------------------------------------------------------------------------------
    *   Verifying CSRF token
    * -------------------------------------------------------------------------------
    */

    if (!verify_csrf_token()){

        $_SESSION['STATUS']['editstatus'] = 'Request could not be validated';
        header("Location: ../");
        exit();
    }


    require '../../assets/setup/db.inc.php';
    require '../../assets/includes/datacheck.php';

    $oldPassword = $_POST['password'];
    $newpassword = $_POST['newpassword'];
    $passwordrepeat  = $_POST['confirmpassword'];


    if( !empty($oldPassword) && !empty($newpassword) && !empty($passwordrepeat)){

        $sql = "SELECT password FROM users WHERE id=?;";
        $stmt = mysqli_stmt_init($conn);
        
        if (!mysqli_stmt_prepare($stmt, $sql)) {

            $_SESSION['ERRORS']['sqlerror'] = 'SQL ERROR';
            header("Location: ../");
            exit();
        }
        else {

            mysqli_stmt_bind_param($stmt, "s", $_SESSION['id']);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if($row = mysqli_fetch_assoc($result)){

                $pwdCheck = password_verify($oldPassword, $row['password']);

                if ($pwdCheck == false){

                    $_SESSION['ERRORS']['passworderror'] = 'incorrect current password';
                    header("Location: ../");
                    exit();
                }
                if ($oldPassword == $newpassword){

                    $_SESSION['ERRORS']['passworderror'] = 'new password cannot be same as old password';
                    header("Location: ../");
                    exit();
                }
                if ($newpassword !== $passwordrepeat){

                    $_SESSION['ERRORS']['passworderror'] = 'confirmed password does not match new password';
                    header("Location: ../");
                    exit();
                }




                    $to = $_SESSION['email'];
                    $subject = 'Password Updated';
                  
        
                    $mail_variables = array();
        
                    $mail_variables['APP_NAME'] = APP_NAME;
                    $mail_variables['email'] = $_SESSION['email'];
        
                    $message = file_get_contents("./template_notificationemail.php");
        
                    foreach($mail_variables as $key => $value) {
                        
                        $message = str_replace('{{ '.$key.' }}', $value, $message);
                    }
                
                    $mail = new PHPMailer(true);
                
                    try {
                
                        $mail->isSMTP();
                        $mail->Host = MAIL_HOST;
                        $mail->SMTPAuth = true;
                        $mail->Username = MAIL_USERNAME;
                        $mail->Password = MAIL_PASSWORD;
                        $mail->SMTPSecure = MAIL_ENCRYPTION;
                        $mail->Port = MAIL_PORT;
                
                        $mail->setFrom(MAIL_USERNAME, APP_NAME);
                        $mail->addAddress($to, APP_NAME);
                
                        $mail->isHTML(true);
                        $mail->Subject = $subject;
                        $mail->Body    = $message;
                
                        $mail->send();
                    } 
                    catch (Exception $e) {
                
                        
                    }

                    $sql = "UPDATE users 
                    SET password=? 
                            WHERE id=?;";
             
                            $stmt = mysqli_stmt_init($conn);

                            if (!mysqli_stmt_prepare($stmt, $sql)) {
                    
                                $_SESSION['ERRORS']['scripterror'] = 'SQL ERROR';
                                header("Location: ../?profile=password");
                                exit();
                            } 

                            else {

                                $hashedPwd = password_hash($newpassword, PASSWORD_DEFAULT);
                mysqli_stmt_bind_param($stmt, "ss", 
                    $hashedPwd,
                    $_SESSION['id']
                );

                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);    
                $_SESSION['STATUS']['editpstatus'] = 'profile successfully updated';
                header("Location: ../?profile=password");
                exit();             
        
            }
        }
    }
}
    else{

        $_SESSION['ERRORS']['passworderror'] = 'password fields cannot be empty for password updation';
        header("Location: ../?profile=password");
        exit();
    }  
} 
else {

    header("Location: ../?profile=password");
    exit();
}

