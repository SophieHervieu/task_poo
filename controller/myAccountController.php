<?php
class MyAccountController extends AbstractController{
    public function render():void{
        $this->renderHeader();
        echo $this->getListViews()['moncompte']->displayView();
        $this->renderFooter();
    }
}