<?php


namespace TeissierYannis\Headings\BO;

use TeissierYannis\Database\BO\Database_Headings;

class Headings{

    /**
     * Instance de la classe
     * @var null
     */
    private static $_instance = null;

    /**
     * Messages d'erreur
     */
    private string $errors;

    /**
     * Stats constructor.
     */
    private function __construct(){}

    /**
     * Recupere les rubriques
     * @param string $quantity
     * @param int|null $id
     * @return array
     */
    public function getHeadings(string $quantity = 'all', int $id = null): array {

        return ($quantity == 'all') ? Database_Headings::getInstance()->getAllHeadings() : Database_Headings::getInstance()->getHeadingByID($id);
    }

    /**
     * Supprime une rubrique
     * @param int $id
     * @return bool
     */
    public function deleteHeading(int $id): bool{

        if(!$this->haveSubHeadings($id)):
            if(Database_Headings::getInstance()->deleteHeading($id))
                $this->errors = "La rubrique à été supprimé";
            else $this->errors = "Une erreur est survenue.";
        else:
            $this->errors = "Vous ne pouvez pas supprimer une rubrique si elle comprends des articles";
        endif;

        header("Location:index.php?cas=BO_Headings&action=ViewHeading&error={$this->errors}");
    }

    /**
     * Retourne une rubrique en fonction de son ID
     * @param $id
     * @return array
     */
    public function getHeading($id): array {
        return Database_Headings::getInstance()->getHeadingByID(intval($id));
    }

    /**
     * Verifie si la rubrique contient des sous rubriques
     * @param $id
     * @return bool
     */
    private function haveSubHeadings($id): bool{
        $subHeadings = Database_Headings::getInstance()->getSubHeadings($id);
        return empty($subHeadings) ? false : true;
    }

    /**
     * Ajoute une rubrique
     * @param $datas
     * @return bool
     */
    public function addHeading(array $datas): bool{
        if(isset($datas['title']) && !empty($datas['title'])){
            if(Database_Headings::getInstance()->addHeading($datas['title'], $datas['content']))
                $this->errors = "Ajout de la rubrique réussi !";
            else
                $this->errors = "Impossible d'ajouter la nouvelle rubrique";
        }else $this->errors = "Une rubrique doit contenir au minimum un title";
        header("Location: index.php?cas=BO_Headings&action=ViewHeading&error={$this->errors}");
    }

    /**
     * Modifie une rubrique
     * @param array $datas
     * @return void
     */
    public function editHeading(array $datas){
        if (isset($datas["id"]) && isset($datas["title"]) && isset($datas["content"]) && $datas['title'] != "") {
            if(Database_Headings::getInstance()->editHeading($datas["title"], $datas["content"], $datas["id"]))
               $this->errors = "Modification de la rubrique réussie";
             else $this->errors = "Une erreur est survenue";
        } else $this->errors = "Erreur, les champs ne peuvent pas être vide";
        header("Location: index.php?cas=BO_Headings&action=ViewHeading&error={$this->errors}");
    }

    /**
     * Recupere les sous-rubrique par ID rubrique
     * @param int $id
     * @return array
     */
    public function getSubHeadings(int $id): array {
        return Database_Headings::getInstance()->getSubHeadings($id);
    }

    /**
     * Recupere une sous rubrique par son ID
     * @param int $id
     * @return array
     */
    public function getSubHeading(int $id): array {
        return Database_Headings::getInstance()->getSubHeading($id);
    }

    /**
     * Edite une sous-rubrique
     * @param array $datas
     */
    public function editSubHeading(array $datas){
        if (isset($datas["idSubHeading"]) && isset($datas["title"]) && isset($datas["content"]) && !empty($datas["idSubHeading"]) && !empty($datas["title"])) {

            if (Database_Headings::getInstance()->editSubHeading($datas["title"], $datas["content"], $datas["idSubHeading"]))
                $this->errors = "Edition de la sous-rubrique effectuée";
            else $this->errors = "Erreur";
        } else $this->errors = "Erreur, les champs ne peuvent pas être vide";
        header("Location: index.php?cas=BO_Headings&action=ViewHeading&error={$this->errors}");
    }

    /**
     * Ajoute une sous-rubrique
     * @param array $datas
     */
    public function addSubHeading(array $datas){
            if(isset($datas["title"]) && isset($datas["content"]) && isset($datas["idHeading"]) && !empty($datas["title"]) && !empty($datas["idHeading"]))
                $idSubHeading = explode(" " ,$datas["idHeading"])[0]; // Retourne l'ID rubrique
            if(is_numeric($idSubHeading)){ // Si modification via Console WEB de l'HTML, vérifier que id est numérique
                if(Database_Headings::getInstance()->getHeadingByID($idSubHeading)) { // Tester si l'ID existe en cas de modification
                    if(Database_Headings::getInstance()->addSubHeading($idSubHeading, $datas["title"], $datas["content"]))
                        $this->errors = "Ajout réussi";
                    else
                        $this->errors = "L'ajout à échoué...";
                }else
                    $this->errors = "La rubrique sélectionné n'existe pas.";
            }else
                $this->errors = "Une erreur est survenue. La rubrique n'existe pas.";
        header("Location: index.php?cas=BO_Headings&action=ViewHeading&error={$this->errors}");
    }

    /**
     * Supprime une sous-rubrique
     * @param int $id
     * @return bool
     */
    public function deleteSubHeading(int $id): bool{
        if(Database_Headings::getInstance()->deleteSubHeading($id))
            $this->errors = "La sous-rubrique à été supprimé";
        else $this->errors = "Une erreur est survenue.";
        header("Location:index.php?cas=BO_Headings&action=ViewHeading&error={$this->errors}");
    }


    /**
     * Singleton Headings
     * @return Headings|null
     */
    public static function getInstance(): Headings {
        self::$_instance = is_null(self::$_instance) ? new Headings() : self::$_instance;
        return self::$_instance;
    }
}