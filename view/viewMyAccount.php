<?php
class ViewMyAccount implements interfaceView{
    public function displayView(): string{
        ob_start();
?>
        <h1>Mon Compte</h1>
        <h2>Nom Prénom : <?php echo $_SESSION['lastname']." ".$_SESSION['firstname']?></h2>
        <p>Email : <?php echo $_SESSION['email']?></p>
<?php
        return ob_get_clean();
    }
}