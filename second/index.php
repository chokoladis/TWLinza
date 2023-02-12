<?php
    require_once 'module/script.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.23/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="/second/css/style.css">
    <title>Store</title>
</head>
<body>

    <section class="content">
        <div class="uk-container">
            <h2 class="uk-margin-medium-top">Задание 2 - Хранилище</h2>
            
            <div class="uk-flex uk-flex-column" id="files">
                <?php
                    $page = $_GET['page'];

                    if ($page == NULL){
                        $page = 1;
                    }

                    echo $FileManager->show($page);                    
                ?>
            </div>

            <ul class="uk-pagination uk-flex-center" uk-margin>

                <?php
                    $count = $FileManager->get_count_page();
                    
                    $i = 1;
                    $html = '';

                    while($i <= $count){

                        if($i == $page){
                            $html .= '<li class="uk-active"><span>'.$i.'</span></li>';
                        } else {
                            $html .= '<li><a href="/second/?page='.$i.'">'.$i.'</a></li>';
                        }
                        
                        $i++;
                    }

                    echo $html;
                ?>
               
            </ul>

            <form action="#" method="post" enctype="multipart/form-data" class="uk-width-1-2">
                <h4>Раздел загрузки</h4>
                <hr>
                <div class="uk-margin">
                    <p><i>В эту область вы можете переносить файл</i></p>
                    <input type="file" name="file" id="file">
                </div>
                <div class="uk-margin">
                    <input type="submit" value="Загрузить" class="uk-input">
                </div>
            </form>
        </div>
    </section>
    <!-- class="uk-vissible" -->
    <div id="modal-file" uk-modal >
        <div class="uk-modal-dialog uk-modal-body">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <h2 class="uk-modal-title">Default</h2>
            <img src="" alt="Если файл - картинка, то она отобразиться здесь">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.23/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.23/dist/js/uikit-icons.min.js"></script>
    <script src="/includes/jquery.min.js"></script>
    <script src="/second/js/script.js"></script>
</body>
</html>