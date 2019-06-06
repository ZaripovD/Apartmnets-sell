<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Заголовок </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>    
    <header>
      <div class="container">
        <div class="row">
          <div class="col-md-2"><img src="img/logo.png" alt="Лого">
          </div>
          <div class="col-md-6 ">
            <nav>
              <ul class="list-inline">
                <li><a href="index.php">Главная</a></li>
                <li><a href="list.php">Список квартир</a></li>
                <li><a href="#contacts">Контакты</a></li>
              </ul>
            </nav>
          </div>
          <div class="col-md-3 login">
            <a href="registration.php">Регистрация</a> /
            <a href="signin.php">Вход</a>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <?php echo '<div class="col-md-4 col-md-offset-8">Вы вошли как гость</div>';  ?>
          </div>
        </div>
      </div>  
    </header>