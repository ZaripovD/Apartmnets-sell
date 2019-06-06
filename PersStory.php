<!DOCTYPE html>
<title>Личный кабинет</title>

<?php include("includes/session.php");
include("includes/sidebar.php");  ?>

<div class="container-fluid" >      

     <section id="description">
      <div class="container">
        <div class="text-center">
            <h1>История операций</h1>
            <div class="col-md-1 col-md-offset-11">
      </div>
    <?php 
$sesid = $_SESSION['logged_user']->id;

$sql = mysqli_query($connection, "SELECT operations.id as 'ID', user.login as 'login', apartments.number as 'number', summary, methods.name as 'method', status.name as 'status', date_deal
 FROM operations
 LEFT JOIN user on operations.login_user = user.login
 LEFT JOIN apartments on operations.id_appartment = apartments.id
 LEFT JOIN methods on operations.id_method = methods.id
 LEFT JOIN status on operations.id_status = status.id");
  if (!$sql) {
  echo "raaaz". mysqli_error($connection);
}

echo "<section id='apartment-story'>
  <div class='container admin'>";

while ($result = mysqli_fetch_array($sql)) {

  echo "
  <div class='row story'>
      <div class='col-md-1'>
      </div>
      <div class='col-md-2'>
        <h4>Номер квартиры</h4>
        <p>{$result['number']}</p>
      </div>
      <div class='col-md-2'>
        <h4>Сумма</h4>
        <p>{$result['summary']}</p>
      </div>
      <div class='col-md-2'>
        <h4>Метод</h4>
        <p>{$result['method']}</p>
      </div>    
      <div class='col-md-2'>
        <h4>Статус</h4>
        <p>{$result['status']}</p>
      </div>
      <div class='col-md-2'>
        <h4>Дата сделки</h4>
        <p>{$result['date_deal']}</p>
      </div>
 </div>";
}
echo "</div>
</section>";
 ?>
        
    </div>
 
    </section>
</div>

 <?php include("includes/footer.php"); ?>