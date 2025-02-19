<?php
class DecoController extends AbstractController{
    public function deconnexion(): void {
        session_start();

        session_destroy();

        header('location:/task_poo/');
        exit;
    }

    public function render():void{
        $this->deconnexion();
    }
}