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
include './view/viewAccount.php';
include './view/viewMyAccount.php';
include './view/viewCategory.php';
include './view/viewError.php';
include './view/viewFooter.php';
include './model/accountModel.php';
include './model/categoryModel.php';
include './controller/accountController.php';
include './controller/myAccountController.php';
include './controller/decoController.php';

$url = parse_url($_SERVER['REQUEST_URI']);

$path = isset($url['path']) ? $url['path'] : '/task_poo/';

switch($path) {
    case '/task_poo/':
        $home = new AccountController(['accountModel'=>new accountModel(new mySQLBDD())], ['header'=> new ViewHeader(), 'footer' => new ViewFooter(), 'accueil' => new ViewAccount()]);
        $home->render();
        break;

    case '/task_poo/moncompte':
        $myAccount = new MyAccountController(null, ['header'=> new ViewHeader(), 'footer' => new ViewFooter(), 'moncompte' => new ViewMyAccount()]);
        $myAccount->render();
        break;

    case '/task_poo/deconnexion':
        $deconnexion = new DecoController(null, null);
        $deconnexion->deconnexion();
        break;

    default:
        
}