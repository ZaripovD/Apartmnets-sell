<!DOCTYPE html>

<?php include("includes/session.php");?>

<div class="container filter">
	<form action="list.php" method="post">
		<div class="row text-center">
			<h3>Количество комнат</h3>
			<div class="col-md-4">
				<select name="rooms" class="zzz">
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>  
					</select>
			</div>
			<div class="col-md-4">
				<button type="submit" name="sort">Показать</button>
			</div>
			<div class="col-md-4">
				<button type="submit" name="reset">Сбросить</button>	
			</div>		
		</div>	
	</form>
</div>

<section id="listing">
	<div class="container lists">

<?php 
$sql = mysqli_query($connection, "
	SELECT id, number, floor, rooms, square, price, living_space, bathroom, kitchen 
	FROM apartments
	WHERE id_status = '4' or id_status = '3'
	ORDER BY rooms");

if (isset($_POST['sort'])) {
	$sql = mysqli_query($connection, "
	SELECT id, number, floor, rooms, square, price, living_space, bathroom, kitchen 
	FROM apartments
	WHERE (id_status = '4' or id_status = '3') and rooms = '{$_POST['rooms']}'");
} else if (isset($_POST['reset'])) {
	header('location:list.php');
}

while ($result = mysqli_fetch_array($sql)) {

	if ($result['rooms'] == 1) {
	$room = 'one';
} elseif ($result['rooms'] == 2) {
	$room = 'two';
} elseif ($result['rooms'] == 3) {
	$room = 'three';
} elseif ($result['rooms'] == 4) {
	$room = 'four';
} 

echo "

<a href='flat.php?id={$result['id']}'>
	<div class='row card'>
		<div class='col-md-1'>
			<img src='img/schemes/{$result['rooms']}-room.png' alt='Схема квартиры' id='".$room."_room'>
		</div>

		<div class='col-md-2 col-md-offset-3'>
			<h3>Номер кв</h3>
			<h4>{$result['number']}</h4>
		</div>

		<div class='col-md-2 col-md-offset-1'>
			<h3>Площадь</h3>
			<h4>{$result['square']}</h4>
			<h3>Ванная</h3>
			<h4>{$result['bathroom']}</h4>

			<h3>Этаж</h3>
			<h4>{$result['floor']}</h4>			
			
		</div>

		<div class='col-md-2 col-md-offset-1'>
			
			<h3>Жилплощадь</h3>
			<h4>{$result['living_space']}</h4>
			
			<h3>Кухня</h3>
			<h4>{$result['kitchen']}</h4>

			<h3>Комнат</h3>
			<h4>{$result['rooms']}</h4>
		</div>
			
		<div class='col-md-12'>
			<h2>Стоимость: {$result['price']} Руб</h2>
			
		</div>
	</div>		
</a>

";}

?>
		
	</div>
</section>



 <?php include("includes/footer.php") ?>