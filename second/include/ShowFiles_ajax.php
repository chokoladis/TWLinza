<?php
    require_once('../module/script.php');

    $files = $FileManager->get_files();

    if (empty($files)){
        echo '<p><b>В хранилище нет файлов</b></p>';
    } else {

        foreach ($files as $file => $value){

            $name = $value["name"];
            $size = $value["size"]/1024;
            $size = round($size, 2);
    
            echo "<div class='file uk-flex uk-width-1-1'>
                    <div class='info'>
                        <h4 class='name'>$name</h4>
                        <div class='description'>
                            <p>Размер в Кбайт</p>
                            <small><b>$size</b></small>
                        </div>
                    </div>
                    
                    <div class='remove' data-remove='$name'>
                        <span class='uk-margin-small-right' uk-icon='icon: close; ratio: 2'></span>
                    </div>
                </div>
            ";
            
        }
    }
?>