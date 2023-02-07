<?php
    require_once('../module/loader.php');

    use Store\fileManager;

    $fileManager = new fileManager;

    $fileManager->delete($_POST['file']);
?>