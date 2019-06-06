<!DOCTYPE html>

<?php include ("includes/session.php");
include ("includes/sideadmin.php");

	$sql = mysqli_query($connection, "SELECT id, number, floor, rooms, square, price, living_space, bathroom, kitchen FROM apartments");

if (isset($_GET['del_id'])) { //проверяем, есть ли переменная    
  
  $delu = mysqli_query($connection, "DELETE FROM `apartments` WHERE `id` = {$_GET['del_id']}");
     
    if ($delu) {
      echo "Квартира удалена!";
    } else {
      echo '<p>Произошла ошибка: ' . mysqli_error($connection) . '</p>';

  }
  }  

echo "<section id='apartment-list'>
	<div class='container admin'>";

while ($result = mysqli_fetch_array($sql)) {
echo "
	<div class='row'>
		<div class='col-md-1'>
			<h4>Номер</h4>
			<p>{$result['number']}</p>
		</div>
		<div class='col-md-1'>
			<h4>Этаж</h4>
			<p>{$result['floor']}</p>
		</div>
		<div class='col-md-2'>
			<h4>Комнаты</h4>
			<p>{$result['rooms']}</p>
		</div>
		<div class='col-md-2'>
			<h4>Площадь</h4>
			<p>{$result['square']}</p>
		</div>		
		<div class='col-md-2'>
			<h4>Жилплощадь</h4>
			<p>{$result['living_space']}</p>
		</div>
		<div class='col-md-1'>
			<h4>Ванная</h4>
			<p>{$result['bathroom']}</p>
		</div>
		<div class='col-md-1'>
			<h4>Кухня</h4>
			<p>{$result['kitchen']}</p>
		</div>
		<div class='col-md-2'>
			<h4>Стоимость</h4>
			<p>{$result['price']}</p>
		</div>
	</div>
	<div class='row'>
		<div class='col-md-12'>
			<button id='deleteAP'>
				<a href='?del_id={$result['id']}'>УДАЛИТЬ КВАРТИРУ</a>
			</button>
		</div>
	</div>";
}

echo "</div>
</section>";

?>
<?php include ("includes/footer.php") ?>