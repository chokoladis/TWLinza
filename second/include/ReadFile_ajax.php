<?
    require_once('../module/loader.php');

    use Store\fileManager;

    $fileManager = new fileManager;
    
    echo '<div id="modal-close-default" uk-modal class="uk-vissible">
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title">Default</h2>
            '.$fileManager->read($_POST["file"]).'
        </div>
    </div>';
?>