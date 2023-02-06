<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.15.23/dist/css/uikit.min.css" />
    <link rel="stylesheet" href="/first/css/style.css">
    <title>Linza work 1</title>
</head>
<body>
    <section class="content">
        <div class="uk-container">
            <h2 class="uk-margin-medium-top">Задание 1</h2>
            <form action="#" method="post" class="uk-flex uk-flex-column uk-margin-medium-top">
                <div class="form_control">
                    <input type="text" name="name" placeholder="Имя" class="uk-input">
                    <div class="uk-alert-danger uk-hidden" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p></p>
                    </div>
                </div>
                <div class="form_control">
                    <input type="text" name="sname" placeholder="Фамилия" class="uk-input">
                    <div class="uk-alert-danger uk-hidden" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p></p>
                    </div>
                </div>
                <div class="form_control">
                    <input type="email" name="email" placeholder="Email" class="uk-input"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,12}$">
                    <div class="uk-alert-danger uk-hidden" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p></p>
                    </div>
                </div>
                <div class="form_control">
                    <input type="tel" name="phone" id="phone" placeholder="+7 (123) 456-78-91" class="uk-input">
                    <div class="uk-alert-danger uk-hidden" uk-alert>
                        <a class="uk-alert-close" uk-close></a>
                        <p></p>
                    </div>
                </div>
                <div class="form_control">
                    <input type="submit" value="Отправить" class="uk-input">
                </div>
            </form>
        </div>
    </section>
    
    

    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.23/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.15.23/dist/js/uikit-icons.min.js"></script>
    <script src="/includes/jquery.min.js"></script>
    <script src="/includes/jquery.mask.min.js"></script>
    <script src="/first/js/script.js"></script>
</body>
</html>