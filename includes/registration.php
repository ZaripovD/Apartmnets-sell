<!DOCTYPE html>

<?php include("includes/header.php"); ?>
<?php 
  require 'php/db.php';

  $data = $_POST;


  //если кликнули на button
  if ( isset($data['do_signup']) )
  {
    // проверка формы на пустоту полей
    $errors = array();    

    if ( trim($data['login']) == '' )
    {
      $errors[] = 'Введите логин';
    }

    if ( trim($data['email']) == '' )
    {
      $errors[] = 'Введите Email';
    }

    if ( $data['password'] == '' )
    {
      $errors[] = 'Введите пароль';
    }

    if ( $data['passwordcheck'] != $data['password'] )
    {
      $errors[] = 'Повторный пароль введен не верно!';
    }    

    if (strlen($data['password']) < 7 or strlen($data['password']) > 15) 
    {
      $errors[] = 'Укажите пароль от 7 до 15 символов!';
    }

    if ( trim($data['phone']) == '' )
    {
      $errors[] = 'Введите номер телефона';
    }

    //проверка на существование одинакового логина
    if ( R::count('user', "login = ?", array($data['login'])) > 0)
    {
      $errors[] = 'Пользователь с таким логином уже существует!';
    }
    
    //проверка на существование одинакового email
    if ( R::count('user', "email = ?", array($data['email'])) > 0)
    {
      $errors[] = 'Пользователь с таким Email уже существует!';
    }





    if ( empty($errors) )
    {
      //ошибок нет, теперь регистрируем
      $user = R::dispense('user');
      $user->family = $data['family'];
      $user->name = $data['name'];
      $user->father = $data['father'];
      $user->login = $data['login'];
      $user->email = $data['email'];
      
      $user->password = password_hash($data['password'], PASSWORD_DEFAULT); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6

      R::store($user);
      echo '<div class="row text-center" id="success" style="color:green; padding-top: 50px;;">Вы успешно зарегистрированы!</div><hr>';
    }else
    {
      echo '<div class="row text-center" id="errors" style="color:red; padding-top: 50px; ">' .array_shift($errors). '</div><hr>';
    }

  }

?>

<form action="registration.php" method="post" class="text-center" class="reg">
  <div class="row">
    <h2>Регистрация</h2>
  </div>
  <div class="row">
    <div class="col-md-12">
      
        <input type="text" name="family" placeholder="Фамилия">
          
        
    </div>
    <div class="col-md-12">
      
        <input type="text" name="name" placeholder="Имя">
          
        
    </div>
    <div class="col-md-12">
      
        <input type="text" name="father" placeholder="Отчество">
        
      
  </div>
    <div class="col-md-12">
      
        <input type="text" name="login" placeholder="Логин">
          
      </div>
    <div class="col-md-12">
      
        <input type="password" name="password" placeholder="Пароль">
          
      </div>
      <div class="col-md-12">
      
        <input type="password" name="passwordcheck" placeholder="Подтвердите пароль">
          
      </div>
      <div class="col-md-12">
      
        <input type="text" name="phone" placeholder="Номер телефона">
          
      </div>
    
    <div class="col-md-12">
      
        <input type="email" name="email" placeholder="Email">
          
      </div>
      
     </div>
     <div class="col-md-12">
      
        <h4><input type="checkbox" name="check" required><a data-toggle="modal" href="#policy_modal">Я согласен на обработку персональных данных и принимаю условия договора</a></h4>
          
      </div>
     <div class="row">
        <a href="signin.php"><button type="button">Уже есть аккаунт?</button></a><br>
        <button name="do_signup" type="submit">Продолжить</button>
          
     </div> 
</form>

<?php include("includes/footer.php"); ?>