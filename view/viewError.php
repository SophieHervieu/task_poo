<?php
class ViewError implements InterfaceView{
    public function displayView(): string {
        ob_start()
?>

        <h1>Error 404 : Not found !</h1>
<?php
        ob_get_clean();
    }
}