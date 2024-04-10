<?php
include_once('classes.php');

$page = false;
if (isset($_GET['page']))  $page = $_GET['page'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Телефонный справочник</title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <h3 class="text-primary">Телефонный справочник (мини)</h3>
        <div class="row">

            <!-- Верхнее меню -->
            <nav class="col-12">
                <?php include_once('pages/menu.php'); ?>
            </nav>

            <!-- Контент страницы -->
            <section class="col-12">
                <?php
                if ($page) {
                    if ($page == 1) include_once('pages/book.php');
                    if ($page == 2) include_once('pages/add_contact.php');
                }
                ?>
            </section>

            <hr>
            <footer class="text-primary">@Irina Sirenko</footer>
        </div>
    </div>

</body>

</html>



