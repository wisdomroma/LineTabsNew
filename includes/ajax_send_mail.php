<?php


if (isset($_POST["send_mail"])) {

    // несколько получателей
    $to = 'lineatabs.uk@gmail.com';
    $to .= ', akvamiris@yahoo.com'; // обратите внимание на запятую

    // тема письма

    $subject = "Новый заказ!";
    // текст письма


    $error = array();

    if (empty($_POST['name']))
        $error[] = "Введите Ф.И.О";
    if (empty($_POST['town']))
        $error[] = "Введите город";
    if (empty($_POST['address']))
        $error[] = "Введите адрес";
    if (empty($_POST['phone']))
        $error[] = "Введите телефон";
    if (empty($_POST['count']))
        $error[] = "Введите количество";
    if (empty($_POST['mail']))
        $error[] = "Введите e-mail";

    if (count($error) == 0) {
        $message = "<span>Ф.И.О: </span>" . htmlspecialchars($_POST['name']) . '<br>';
        $message .= "<span>Город: </span>" .htmlspecialchars($_POST['town']) . '<br>';
        $message .= "<span>Адрес: </span>" .htmlspecialchars($_POST['address']) . '<br>';
        $message .= "<span>E-mail: </span>" .htmlspecialchars($_POST['mail']) . '<br>';
        $message .= "<span>телефон: </span>" .htmlspecialchars($_POST['phone']) . '<br>';
        $message .= "<span>Количество: </span>" .htmlspecialchars($_POST['count']) . '<br>';
        $message .= "<span>Стоимость товара: </span>" . htmlspecialchars($_POST['sum']) . '<br>';
        $message .= "<span>Стоимость доставки: </span>" . htmlspecialchars($_POST['sum_dost']) . '<br>';
        $message .= "<span>Итого: </span>" . (($_POST['count']*$_POST['sum']) + $_POST['sum_dost']) . '<br>';

        // Для отправки HTML-письма должен быть установлен заголовок Content-type
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

        // Дополнительные заголовки
        //$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
        //$headers .= 'From: Birthday Reminder <birthday@example.com>' . "\r\n";
        //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
        //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

        // Отправляем
        if (mail($to, $subject, $message, $headers)) {
            echo '
                <html>
                    <head>
                    <title>Спасибо за Ваш заказ!</title>
                    </head>
                    <body>
                        <center>Спасибо за Ваш заказ!<br>Наш менеджер скоро свяжется с Вами!</center>
                    </body>
                    <script type="text/javascript">
                        var t = setTimeout(killPage(),15*10000);
                        function killPage(){
                            window.location="/";
                        }
                    </script>

            </html>';
        } else {
            echo '
                <html>
                    <head>
                    <title>Ошибка заказа!</title>
                    </head>
                    <body>
                        <center>Во время обработки заказа произошла ошибка! Попробуйте еще раз.</center>
                        <div><?=$message?></div>
                    </body>
                    <script type="text/javascript">
                        var t = setTimeout(killPage(),15*10000);
                        function killPage(){
                            window.location="/";
                        }
                    </script>
                </html>';
        }
        exit;
    }

}


?>

