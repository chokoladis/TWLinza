<?
    require_once('../module/loader.php');

    use Store\fileManager;

    $fileManager = new fileManager;
    
    echo $fileManager->upload($_FILES);
?>