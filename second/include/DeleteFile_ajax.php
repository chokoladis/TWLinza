<?php
    require_once('../module/script.php');

    echo $FileManager->delete($_POST['file']);
?>