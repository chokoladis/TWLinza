<?php

    $error = '';

    // Некие запрещенные/уже успользуемые почты на сайте
    $email_banned = [
        'admin@mail.ru', 'admin@gmail.com', 'test@gmail.com', 'test@mail.ru'
    ];

    $name = $_POST["name"];
    $sname = $_POST["sname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    if ($name == '' && $sname == '' && $email == '' && $phone == ''){
        $error = [ 'status' => 'ERROR', 'message' => 'Вы не заполнили все поля.' ];
    } elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $error = [ 'status' => 'ERROR', 'message' => 'Ваш Email не валиден.' ];
    } elseif (in_array($email,$email_banned)){
        $error = [ 'status' => 'ERROR', 'message' => 'Данный Email запрещен.' ];
    } else {
        $response = [
            'status' => 'OK',
            'message' => 'Данные успешно отправлены.',
            'data' => [
                'name' => $_POST["name"],
                'sname' => $_POST["sname"],
                'email' => $_POST["email"],
                'phone' => $_POST["phone"]
            ]
        ];
    }

    if ($error == ''){
        echo json_encode($response);
    } else {
        echo json_encode($error);
    }

?>