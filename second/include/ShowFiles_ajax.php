<?php
    require_once('../module/loader.php');

    use Store\fileManager;

    $fileManager = new fileManager;
    $files = $fileManager->show();

    if (empty($files)){
        echo '<p><b>В хранилище нет файлов</b></p>';
    } else {
        foreach ($files as $file){

            $stat = $fileManager->getLocalFile($file);
            $size = $stat["size"]/1024;
            $size = round($size, 2);
    
            echo "<div class='file uk-flex uk-width-1-1' data-read='$file'>
                    <div class='info'>
                        <h4 class='name'>$file</h4>
                        <div class='description'>
                            <p>Размер в Кбайт</p>
                            <small><b>$size</b></small>
                        </div>
                    </div>
                    
                    <div class='remove' data-remove='$file'>
                        <span class='uk-margin-small-right' uk-icon='icon: close; ratio: 2'></span>
                    </div>
                </div>
            ";
            
        }
    }

    

?>