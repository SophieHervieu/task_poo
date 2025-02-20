<?php
class CategoryController extends AbstractController{
    public function addCategory(): ?string {
        if(isset($_POST["submit"])) {
            if(!empty($_POST["name"])) {
                $name = sanitize($_POST["name"]);

                $categorie = $this->getListModels()['categoryModel']->setName($name)->getCategoryByName();
                
                if(empty($categorie)) {
                    $this->getListModels()['categoryModel']->add();
                    return "la catégorie a été ajoutée";
                }
                else {
                    return "La catégorie existe déja en BDD";
                }
            } else {
                return "Le nom de la catégorie est vide !";
            }
        }
        return '';
    }
    public function render():void{
        if(!isset($_SESSION['id'])){
            header('location:/task_poo/');
            exit;
        }
        $ajout = $this ->addCategory();

        $this->renderHeader();
        echo $this->getListViews()['category']->setMessage($ajout)->displayView();
        $this->renderFooter();
    }
}