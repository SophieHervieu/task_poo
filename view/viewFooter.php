<?php
class ViewFooter implements InterfaceView {
    public function displayView(): ?string {
        ob_start();
?>
            <footer>
                <p>Mentions légales</p>
            </footer>
        </body>
        </html>
<?php
        return ob_get_clean();
    }
}