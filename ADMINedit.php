<!DOCTYPE html>
<?php 
include("includes/session.php");
include("includes/sideadmin.php");?>

<?php


  $sql = mysqli_query($connection, "SELECT number, rooms, square, price
    FROM apartments");

  while ($result = mysqli_fetch_array($sql)) {
    echo "<form action='ADMINedit.php' method='post' class='text-center'>
  <section id='description'>
    <div class='container text-center'>
      <h2>Изменение стоимости квартиры</h2>
      <div class='row'>
        <div class='col-md-2'>
          <h4>Номер квартиры</h4>
          <p>{$result['number']}</p>
          <input type='hidden' value='{$result['number']}' name='number'>
        </div>
        <div class='col-md-3'>
          <h4>Количество комнат</h4>
          <p>{$result['rooms']}</p>
        </div>
        <div class='col-md-1'>
          <h4>Площадь</h4>
          <p>{$result['square']}</p>
        </div>
        <div class='col-md-3'>
          <h4>Новая стоимость</h4>
          <input type='text' name='price' value='{$result['price']}'>
        </div>
        <div class='col-md-1'>
          <h4> </h4>
          <button name='new_price'>
            Обновить
          </button>
        </div>
      </div>    
    </div>
  </section>
</form>";
  }
     if ( isset($data['new_price']) )
  {
    $price = mysqli_query($connection, "UPDATE apartments SET price = '{$_POST['price']}' WHERE number = '{$_POST['number']}'");
    if ($price){
        echo "<div class='row text-center'><h4>Стоимость успешно изменена!</h4></div>";
      }else{
        echo "Ошибка:". mysqli_error($connection);
      }
  }
?>




<?php include("includes/footer.php"); ?><?php