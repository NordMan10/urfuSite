<?php
session_start();
include ("connection.php");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>УРФУ ПОМОЩНИК || РЕЙТИНГ АБИТУРИЕНТА</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/fontAwesome/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="css/images/logo.png">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/media.css">
</head>
<body>
<section class="header">
    <div class="container">
        <div class="logo">
            <img src="css/images/logo.png" alt="" id="logo">
            <p id="logotext">Урфу абитуриенту</p>
        </div>
    </div>
</section>
<section class="main">
    <div class="container">
        <div class="description">
            <h1 class="uzn">Узнать свой рейтинг сейчас!</h1>
            <div class="line"></div>
        </div>
        <div class="inputnumber">
            <input type="number" id="input" placeholder="Введите свой регистрационный номер" required>
            <button id="inputbutton"><i class="fa fa-search fa-1.5x"></i></button>
        </div>
        <div class="selectbox">

        </div>
        <div class="selectradio">

        </div>
        <div class="information">

        </div>
    </div>
</section>

<section class="footer">

</section>


<script src="js/jquery-3.3.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<!--form mask-->
<script src="js/jquery.maskedinput.min.js"></script>
<!--end form mask-->
<script src="js/script.js"></script>
<script src="js/select.js"></script>
</body>
</html>