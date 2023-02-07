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
                <p><b>В хранилище пусто</b></p>
            </div>

            <form action="#" method="post" enctype="multipart/form-data" class="uk-width-1-2">
                <h4>Раздел загрузки</h4>
                <hr>
                <div class="uk-margin">
                    <input type="file" name="file" id="file">
                </div>
                <div class="uk-margin">
                    <input type="submit" value="Загрузить" class="uk-input">
                </div>
            </form>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.23/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.23/dist/js/uikit-icons.min.js"></script>
    <script src="/includes/jquery.min.js"></script>
    <script src="/second/js/script.js"></script>
</body>
</html>