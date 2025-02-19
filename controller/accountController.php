<?php
class AccountController extends AbstractController {
    //METHOD
    public function displayForm(?string $message='',?string $messageSignIn=''):string{
        if(!isset($_SESSION['id'])){
            return '
            <section>
                <h1>Inscription</h1>
                <form action="" method="post">
                    <input type="text" name="lastname" placeholder="Le Nom de Famille">
                    <input type="text" name="firstname" placeholder="Le Prénom">
                    <input type="text" name="email" placeholder="L\'Email">
                    <input type="password" name="password" placeholder="Le Mot de Passe">
                    <input type="submit" name="submitSignUp">
                </form>
                <p>'. $message .'</p>
            </section>
            <section>
                <h1>Connexion</h1>
                <form action="" method="post">
                    <input type="text" name="emailSignIn" placeholder="L\'Email">
                    <input type="password" name="passwordSignIn" placeholder="Le Mot de Passe">
                    <input type="submit" name="submitSignIn">
                </form>
                <p>'.$messageSignIn.'</p>
            </section>';
        }
        return '';
    }

    public function displayAccount():string{
        //Récupération de la liste des utilisateurs
        $data = $this->getListModels()["accountModel"]->getAll();
        // $data = [];


        $listUsers = "";
        foreach($data as $account){
            $listUsers = $listUsers."<li><h2>".$account['firstname'] ." ". $account['lastname']."</h2>      <p>".$account['email']."</p></li>";
        }
        return $listUsers;
    }

    function signUp():string{
        if(isset($_POST['submitSignUp'])){
            if(empty($_POST['lastname']) || empty($_POST['firstname']) || empty($_POST['email']) || empty($_POST['password'])){
                return "Veuillez remplir les champs !";
            }
    
            if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
                return "Email pas au bon format !";
            }
    
            $lastname = sanitize($_POST['lastname']);
            $firstname = sanitize($_POST['firstname']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
    
            $password = password_hash($password, PASSWORD_BCRYPT);

            if(!empty($this->getListModels()['accountModel']->setEmail($email)->getAccountByEmail())){
                return "Cet email existe déjà !";
            }
    
            $account = [$firstname, $lastname, $email, $password];
            $this->getListModels()['accountModel']->setAccount($account)->add();
        
            return "$firstname $lastname a été enregistré avec succès !";
        }
        return '';
    }

    function signIn(){
        if(isset($_POST['submitSignIn'])){
            if(empty($_POST['emailSignIn']) || empty($_POST['passwordSignIn']) ){
                return 'Veuillez remplir tous les champs';
            }
    
            if(!filter_var($_POST['emailSignIn'],FILTER_VALIDATE_EMAIL)){
                return "Email pas au bon format !";
            }
    
            $email = sanitize($_POST['emailSignIn']);
            $password = sanitize($_POST['passwordSignIn']);

            $data = $this->getListModels()['accountModel']->setEmail($email)->getAccountByEmail();
    
            if(empty($data)){
                return 'Email et/ou Mot de Passe incorrect !';
            }
    
            if(!password_verify($password, $data['password'])){
                return 'Email et/ou Mot de Passe incorrect !';
            }
    
            $_SESSION['id'] = $data['id_account'];
            $_SESSION['firstname']= $data['firstname'];
            $_SESSION['lastname']= $data['lastname'];
            $_SESSION['email']= $data['email'];
    
            header('location:/task_poo/');
            exit;
    
            return $_SESSION['firstname']. " ".$_SESSION['lastname']." est connecté !";
        }
        return '';
    }

    public function render():void{
        $this->renderHeader();
        echo $this->getListViews()['accueil']->setForm($this->displayForm($this->signUp(),$this->signIn()))->setListUsers($this->displayAccount())->displayView();
        $this->renderFooter();
    }
}