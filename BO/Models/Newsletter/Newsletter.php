<?php

namespace TeissierYannis\Newsletter\BO;

use PHPMailer\PHPMailer\Exception;
use TeissierYannis\Database\BO\Database_Newsletter;
use TeissierYannis\Utils\BO\Mail;

class Newsletter{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Contient les erreurs
     * @var string
     */
    private string $errors;

    /**
     * Newsletter constructor.
     */
    private function __construct(){
        $this->errors = "";
    }

    /**
     * Retourne la liste des abonnés à la newsletter
     * @return array
     */
    public function getSubscribers(): array {
        return Database_Newsletter::getInstance()->getSubscribers();
    }

    /**
     * Supprime un abonné de la newsletter
     * @param int $id
     */
    public function deleteSubscriber(int $id){
        if (!empty($id)) {
            if (Database_Newsletter::getInstance()->deleteSubscriber($id)) {
                $this->errors = "Suppression réussie";
            } else $this->errors = "Une erreur est survenue";
        }else $this->errors = "Une erreur est survenue, impossible de trouver l'ulitisateur";
        header("Location:index.php?cas=BO_Newsletter&action=ViewSubscribers&error={$this->errors}");
    }

    /**
     * Envoi de la newsletter
     * @param string $to
     * @param string $content
     */
    public function sendNewsletter(string $to, string $content){
        if(!empty($to)){
            if(!empty($content)){
                try {
                    Mail::sendEmail($to, $content);
                    $this->errors = "Newsletter envoyée !";
                } catch (Exception $e) {
                    $this->errors = "Une erreur est survenue " . $e;
                }
            }else $this->errors = "Le contenu de la newsletter ne peux être vide";
        }else $this->errors = "Il n'y à pas de destinataire à votre newsletter";
        header("Location:index.php?cas=BO_Newsletter&action=ViewSubscribers&error={$this->errors}");
    }

    /**
     * Singleton Newsletter
     * @return Newsletter|null
     */
    public static function getInstance(): Newsletter {
        self::$_instance = is_null(self::$_instance) ? new Newsletter() : self::$_instance;
        return self::$_instance;
    }
}