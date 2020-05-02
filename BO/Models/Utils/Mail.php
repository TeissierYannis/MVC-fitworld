<?php

namespace TeissierYannis\Utils\BO;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../public/PHPMailer/src/Exception.php';
require '../public//PHPMailer/src/PHPMailer.php';
require '../public/PHPMailer/src/SMTP.php';

class Mail{


    private static string $host = "ssl0.ovh.net";
    private static int $port = 587;
    private static string $username = "fitworld@teissieryannis.com";
    private static string $password = "RtQqE3k8BQ5p";

    /**
     * Mail constructor.
     */
    public function __construct(){}

    /**
     * Défini les parametres de bases pour l'envoi d'email
     * @return PHPMailer
     */
    private static function setMail(){
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->CharSet = 'UTF-8';
        $mail->Host = self::$host;       // SMTP server example
        $mail->SMTPDebug = 0;                 // enables SMTP debug information (for testing)
        $mail->SMTPAuth = true;              // enable SMTP authentication
        $mail->Port = self::$port;       // set the SMTP port for the GMAIL server
        $mail->Username = self::$username;   // SMTP account username example
        $mail->Password = self::$password;   // SMTP account password example
        return $mail;
    }

    /**
     * Envoi un email
     * @param $to Correspondants
     * @param $content Contenu
     * @return string
     * @throws Exception
     */
    public static function sendEmail($to, $content){
        $to = json_decode($to, true);
        $i = 0;
        foreach ($to as $u) {
            if (!filter_var($u['mail'], FILTER_VALIDATE_EMAIL)) {
                $emailErr = "L'adresse email n'est pas valide...";
            }

            $mail = Mail::setMail();

            if (isset($emailErr)) {
                return "Une erreur est survenue :" . $emailErr . "avec l'email ". $u['mail'];
            } else {
                $mail->setFrom('newsletter@fitworld.fr', 'FitWorld');
                $mail->addAddress($u['mail'], '');
                $mail->isHTML(true);
                $mail->Subject = 'newsletter FitWorld';
                $mail->Body = $content;
                $mail->AltBody = strip_tags($content);
                $mail->send();
            }
            $i++;
        }
    }
}
