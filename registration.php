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

    if ( trim($data['family']) == '' || trim($data['name']) == '' || trim($data['father']) == '' )
    {
      $errors[] = 'Введите полное имя';
    } 

    if ( strlen($data['password']) < 5 || strlen($data['password']) > 15)
    {
      $errors[] = 'Введите логин от 5 до 15 символов';
    }

    if (strlen($data['password']) < 7 || strlen($data['password']) > 15) 
    {
      $errors[] = 'Укажите пароль от 7 до 15 символов!';
    }

    if ( $data['passwordcheck'] != $data['password'] )
    {
      $errors[] = 'Повторный пароль введен не верно!';
    }    

    if ( !filter_var($data['email'], FILTER_VALIDATE_EMAIL) )
    {
      $errors[] = 'Введите корректный Email';
    } 

    if ( trim($data['phone']) == '')
    {
      $errors[] = 'Введите номер телефона';
    }
    
    if ( trim($data['city']) == '' || trim($data['street']) == '' || trim($data['house']) == '' )
    {
      $errors[] = 'Введите полный адрес';
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

    //проверка на существование одинакового телефона
    if ( R::count('user', "_phone = ?", array($data['phone'])) > 0)
    {
      $errors[] = 'Номер телефона уже зарегистрирован в системе!';
    }





    if ( empty($errors) )
    {
      //ошибок нет, теперь регистрируем
      $user = R::dispense('user');
      $user->Family = $data['family'];
      $user->Name = $data['name'];
      $user->Father = $data['father'];
      $user->login = $data['login'];      
      $user->Password = MD5($data['password']); //пароль нельзя хранить в открытом виде, мы его шифруем при помощи функции password_hash для php > 5.6
      $user->phone = $data['phone'];
      $user->mail = $data['email'];
      $user->id_city = $data['city'];
      $user->id_street = $data['street'];
      $user->house = $data['house'];
      R::store($user);
      echo '<div class="row text-center" id="success" style="color:green; padding-top: 50px;;">Вы успешно зарегистрированы!</div><hr>';
    }else
    {
      echo '<div class="row text-center" id="errors" style="color:red; padding-top: 50px; ">' .array_shift($errors). '</div><hr>';
    }

  }

?>

<form action="registration.php" method="post" class="text-center" id="reg">
  <div class="container text-center">
  <div class="row">
    <h2>Регистрация</h2>
  </div>
  <div class="row">
    <div class="col-md-12">
      
        <input type="text" name="family" placeholder="Фамилия" value="<?php echo @$data['family']; ?>">
          
        
    </div>
    <div class="col-md-12">
      
        <input type="text" name="name" placeholder="Имя" value="<?php echo @$data['name']; ?>">
          
        
    </div>
    <div class="col-md-12">
      
        <input type="text" name="father" placeholder="Отчество" value="<?php echo @$data['father']; ?>">
        
      
  </div>
    <div class="col-md-12">
      
        <input type="text" name="login" placeholder="Логин" value="<?php echo @$data['login']; ?>">
          
      </div>
    <div class="col-md-12">
      
        <input type="password" name="password" placeholder="Пароль">
          
      </div>
      <div class="col-md-12">
      
        <input type="password" name="passwordcheck" placeholder="Подтвердите пароль">
          
      </div>
      <div class="col-md-12">
      
        <input type="tel" name="phone" placeholder="Номер телефона" value="<?php echo @$data['phone']; ?>">
          
      </div>
    
    <div class="col-md-12">
      
        <input type="email" name="email" placeholder="Email" value="<?php echo @$data['email']; ?>">
          
      </div>
      <div class="col-md-12">
      
        <input name="city" placeholder="Город" list="cities" class="lists" value="<?php echo @$data['city']; ?>">
          <datalist id="cities">            
            <?php
              $query ="SELECT * FROM cities";
              $mark = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($connection));
              if($mark)          
              {
                $markrows = mysqli_num_rows($mark); // количество полученных строк     

               for ($i = 0 ; $i < $markrows ; ++$i)
                {
                  $markrow = mysqli_fetch_row($mark);
                  echo " <option>$markrow[0] $markrow[1] </option>";
                }
              }
            ?>
          </datalist>

          <input class="lists" name="street" list="streets" placeholder="Улица" value="<?php echo @$data['street']; ?>">
            <datalist id="streets">
              <?php
              $query ="SELECT * FROM streets";
              $mark = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($connection));
              if($mark)          
              {
                $markrows = mysqli_num_rows($mark); // количество полученных строк     

               for ($i = 0 ; $i < $markrows ; ++$i)
                {
                  $markrow = mysqli_fetch_row($mark);
                  echo " <option>$markrow[0] $markrow[1] </option>";
                }
              }
            ?>
            </datalist>

            <input class="lists" placeholder="Дом" name="house" value="<?php echo @$data['house']; ?>">
          
      </div>
     </div>
     <div class="col-md-12">
      
        <h4><input type="checkbox" class="check"><a data-toggle="modal" href="#policy_modal">Я согласен на обработку персональных данных и принимаю условия договора</a></h4>
          
      </div>
     <div class="row">
      <button name="do_signup" type="submit">Продолжить</button><br>
      <p class="link"><a href="signin.php" >Уже есть аккаунт?</a></p>
     </div> 
     </div>
</form>

<?php include("includes/footer.php"); ?>