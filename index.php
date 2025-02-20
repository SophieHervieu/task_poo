<?php
session_start();

include './env.php';
include './utils/utils.php';
include './abstract/abstractController.php';
include './abstract/abstractModel.php';
include './interface/interfaceView.php';
include './interface/interfaceBDD.php';
include './utils/mySQLBDD.php';
include './view/viewHeader.php';
include './view/viewFooter.php';

$url = parse_url($_SERVER['REQUEST_URI']);

$path = isset($url['path']) ? $url['path'] : '/task_poo/';

switch($path) {
    case '/task_poo/':
        include './model/accountModel.php';
        include './controller/accountController.php';
        include './view/viewAccount.php';

        $home = new AccountController(['accountModel'=>new accountModel(new mySQLBDD())], ['header'=> new ViewHeader(), 'footer' => new ViewFooter(), 'accueil' => new ViewAccount()]);
        $home->render();
        break;

    case '/task_poo/categories':
        include './model/categoryModel.php';
        include './controller/categoryController.php';
        include './view/viewCategory.php';

        $category = new CategoryController(['categoryModel' => new categoryModel(new mySQLBDD())], ['header'=> new ViewHeader(), 'footer' => new ViewFooter(), 'category' => new ViewCategory()]);
        $category->render();
        break;

    case '/task_poo/moncompte':
        include './controller/myAccountController.php';
        include './view/viewMyAccount.php';

        $myAccount = new MyAccountController(null, ['header'=> new ViewHeader(), 'footer' => new ViewFooter(), 'moncompte' => new ViewMyAccount()]);
        $myAccount->render();
        break;

    case '/task_poo/deconnexion':
        include './controller/decoController.php';

        $deconnexion = new DecoController(null, null);
        $deconnexion->deconnexion();
        break;

    default:
        include './controller/errorController.php';
        include './view/viewError.php';

        $error = new errorController(null, ['header'=> new ViewHeader(), 'footer' => new ViewFooter(), 'error' => new ViewError()]);
        $error->render();
}