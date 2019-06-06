<!DOCTYPE html>
<?php include("includes/session.php") ?>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="col-md-4">
          <img src="img/main.jpg" alt="рис1">
        </div>
        <div class="col-md-6">
          <p>Застройщик, величайший во всех вселенных. Всего один дом, один подъезд, одна планировка на каждую из видов квартир! Мечта, но не сказка, чистая реальность.</p>
        </div>
      </div>
    </div>
  </section>

  <section id="why">
    <div class="container">
      <div class="row">
        <div class="col-md-5 box">
          <h2>Наши услуги</h2>
          <ul>
            <li>Продажа квартир</li>
            <li>Страховка жилья</li>
            <li>Перепланировка</li>
            <li>Предоставление домработников</li>
          </ul>
        </div>
        <div class="col-md-5 col-md-offset-1 box">
          <h2>Почему это выгодно</h2>
          <ul>
            <li>Низкие цены</li>
            <li>Удобные архитектурные решения</li>
            <li>Низкие проценты на ипотеку</li>
            <li>Удобное расположение</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <section id="partners">
    <div class="container">
      <div class="row">
      <h2>Наши партнеры</h2>
        <div class="col-md-2 col-md-offset-1">
          <a href="https://www.ooomegalit.ru/" target="_blank">
          <img src="img/partners/1.png" alt="partner" class="large">
        </a>
        </div>
        <div class="col-md-2">         
        </div>
        <div class="col-md-2">
          <a href="https://www.yell.ru/kazan/com/ehkspert-nedvizhimost_11942840/" target="_blank">
          <img src="img/partners/5.png" alt="partner" class="hidden-xs">
        </a>
        </div>
        <div class="col-md-2">
          <a href="http://vavilonrielt.ru/" target="_blank">
          <img src="img/partners/6.png" alt="partner">
        </a>
        </div>
      </div>

      <div class="row">
        <div class="col-md-2 col-md-offset-1">
          <a href="http://www.temakazan.ru/" target="_blank">
            <img src="img/partners/7.png" alt="partner" class="large">
        </a>          
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-2">
          <a href="http://legendakazan.ru/about/" target="_blank">
          <img src="img/partners/2.png" alt="partner">
        </a>          
        </div>
        <div class="col-md-2">
          <a href="http://reportal.ru/rating-of-agencies/ratingtop.php" target="_blank">
          <img src="img/partners/8.png" alt="partner" class="hidden-xs">
        </a>
          
        </div>
      </div>
    </div>
  </section>

<?php 

if (isset($_POST['sending'])) {

  if (!$_SESSION['logged_user']) {     
   echo "<div class='col-md-7 col-md-offset-3'>Отправка комментариев доступна только авторизованным пользователям!</div>";
   }else 
   if ( strlen($_POST['comment']) < 10 || strlen($_POST['comment']) > 140) {
   echo "<div class='col-md-7 col-md-offset-3'>Комментарий не может быть короче 10 символов и длиннее 140!</div>";
  } else {

  $now = date("Y-m-d H:i:s");
  $idu = $_SESSION['logged_user']->login;

  $sql = mysqli_query($connection, "
    INSERT INTO comments (`login`, `text`, `date`)
    VALUES
    ('$idu', '{$_POST['comment']}', '$now')");
  } 
}
?>


<section id="comments">    
    <div class="container">
      <form action="index.php" method="post">
      <div class="row input">
        <h2>Комментарии</h2>        
        <div class="col-md-10 col-md-offset-1">
          <input name="comment" placeholder= "Введите комментарий">
        </div>
        <div class="col-md-11 sendcom">
          <button name="sending">
            Отправить
          </button>
        </div>        
      </div>
    </form>
    <?php
    $comm = mysqli_query($connection, "SELECT comments.text as 'text', user._name as 'name', user._family as 'fam', comments.date as 'when'
      FROM comments
      LEFT JOIN user on comments.login = user.login
      ORDER BY comments.id DESC
      LIMIT 3");

    while ($result = mysqli_fetch_array($comm)) {
      echo "
      <div class='row output'>
        <div class='col-md-7 col-md-offset-1 com'>
          <h3>{$result['fam']} {$result['name']}</h3>
          <p>{$result['text']}</p>
        </div>
        <div class='col-md-2'>
          <h3></h3>
          <p>{$result['when']}</p>
        </div>
      </div>
      ";
    }


    ?>

  </div>
</section>

<?php include("includes/footer.php") ?>