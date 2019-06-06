<!DOCTYPE html>

<?php 
  require 'php/db.php';

  $data = $_POST;
  if ( isset($data['do_login']) )
  {
    $user = R::findOne('user', 'login = ?', array($data['login']));
    if ( $user )
    {
      //логин существует
      if ( md5($data['password'], $user->password) )
      {
        //если пароль совпадает, то нужно авторизовать пользователя
        $_SESSION['logged_user'] = $user;
          header('location: persarea.php');
      }else
      {
        $errors[] = 'Неверно введен пароль!';
      }

    }else
    {
      $errors[] = 'Пользователь с таким логином не найден!';
    }
    
    if ( ! empty($errors) )
    {
      //выводим ошибки авторизации
      echo '<div id="errors" style="color:red;">' .array_shift($errors). '</div><hr>';
    }

  }

?>
<?php include("includes/header.php"); ?>

  
<form action="signin.php" class="text-center" method="POST" id="reg">
  <div class="row">
    <h2>Авторизация</h2>
  </div>
  <div class="row">
    <div class="col-md-12">
        <input type="text" placeholder="Логин" name="login" value="<?php echo @$data['login']; ?>">
      </div>
    <div class="col-md-12">
        <input type="password" placeholder="Пароль" name="password" value="<?php echo @$data['password']; ?>">
      </div>
     </div>
     <div class="row">
        <button type="submit" name="do_login">Войти</button><br>
        <p class="link"><a href="registration.php">Нет аккаунта?</a></p>
     </div> 
</form>

  <?php include("includes/footer.php"); ?>