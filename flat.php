<!DOCTYPE html>

<?php include("includes/session.php");
error_reporting(0);
$sql = mysqli_query($connection, "
	SELECT id, number, floor, rooms, square, price, living_space, bathroom, kitchen 
	FROM apartments
	WHERE id = {$_GET['id']}");

if (isset($_POST['once']) ) {

	$sql = mysqli_query($connection, "
	SELECT id, number, floor, rooms, square, price, living_space, bathroom, kitchen 
	FROM apartments	
	WHERE id = '{$_POST['idi']}'");

} elseif (isset($_POST['mortgage'])) {

$sql = mysqli_query($connection, "
	SELECT id, number, floor, rooms, square, price, living_space, bathroom, kitchen 
	FROM apartments
	WHERE id = {$_POST['idi']}");
	} else
if (isset($_POST['accept_2'])) {
	$sql = mysqli_query($connection, "
	SELECT id, number, floor, rooms, square, price, living_space, bathroom, kitchen 
	FROM apartments	
	WHERE id = '{$_POST['idi1']}'");
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
	<section id='listing'>
	<div class='container lists'>

	<div class='row card'>
		<div class='col-md-2 col-md-offset-1'>
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
	<div class='col-md-12 text-center'>
		<img src='img/schemes/{$result['rooms']}-room.png' alt='Схема квартиры' class='flatIMG'>
	</div>
	</div>
<form action='flat.php' method='post'>
	<div class='row method'>
	<input type='hidden' value='{$result['id']}' name='idi'>
	<input type='hidden' value='{$result['price']}' name='summary'>
		<div class='col-md-6'>
			<button name='once'>
				Единоразовый платеж
			</button>
		</div>
		<div class='col-md-6'>
			<button name='mortgage'>
				Ипотека
			</button>
		</div>
	</div>
</form>
	</div>
</section>";
}

if (isset($_POST['once'])) {

	echo "
<div class='container buying'>
<form action='flat.php' method='post'>
<input type='hidden' value='{$_POST['summary']}' name='sum'>
<input type='hidden' value='{$_POST['idi']}' name='idi1'>
	<div class='row'>
		<div class='col-md-5'>
			<input type='text' name='passport' placeholder='Серия и номер паспорта'>
		</div>
		<div class='col-md-5'>
			<span>Внести платёж в течение месяца!</span>
		</div>
		<div class='col-md-2'>
			<button name='accept_1' type='submit'>
				Оформить
			</button>
		</div>
	</div>
</form>
</div>";
}

if (isset($_POST['accept_1'])) {

	if (strlen($_POST['passport']) > 11 || strlen($_POST['passport']) <10) {
		$errors[] = 'Введите корректные паспортные данные';
	} else{
		$deal = date("Y-m-d");
		$oper = mysqli_query($connection, "
			INSERT INTO `operations` (`login_user`,`id_appartment`,`summary`,`id_method`,`date_deal`)
			VALUES ('{$_SESSION['logged_user']->login}', '{$_POST['idi1']}', '{$_POST['sum']}', '1', '$deal')
			");

		$pass = mysqli_query($connection, "
			UPDATE `user` SET Passport = '{$_POST['passport']}'

			WHERE login = '{$_SESSION['logged_user']->login}'");
		
		echo '<div class="row text-center" id="errors" style="color:red; padding-top: 50px; ">Ваша заявка находится на рассмотрении. Ожидайте звонка в ближайшее время</div>';
	}

	
	}

if (isset($_POST['mortgage'])){
	echo "
<div class='container buying'>
<form action='flat.php' method='post'>
<input type='hidden' value='{$_POST['summary']}' name='sum'>
<input type='hidden' value='{$_POST['idi']}' name='idi1'>
	<div class='row'>
		<div class='col-md-2'>
			<input type='text' name='passport' placeholder='Серия и номер паспорта'>
		</div>
		<div class='col-md-2'>
			<input type='text' name='years' placeholder='На сколько лет?'>
		</div>
		<div class='col-md-3'>
			<p>Взносы строго каждый месяц! </p>
		</div>
		<div class='col-md-2'>
			<button name='accept_2' type='submit'>
				Расчитать
			</button>
		</div>
	</div>
</form>
</div>";
}

if (isset($_POST['accept_2'])) {

	$errors = array();
	if (strlen($_POST['passport']) > 11 || strlen($_POST['passport']) <10) {
		$errors[] = 'Введите корректные паспортные данные';
	}

	if ($_POST['years'] > 35 || $_POST['years'] < 2){
		$errors[] = 'Ипотеку возможно оформить на срок от 2-х до 35-ти лет!';
	}

	if ((empty($errors))) {
		
	
	$price = $_POST['sum'];
	$duration = $_POST['years'];
	$totalMonths = 12 * $duration;
	$monthlyCharge = $price / $totalMonths;
	$monthlyPercents = $price * 0.06 / 12;
	$monthlySum = $monthlyCharge + $monthlyPercents;
	$finalCost = $monthlySum * $totalMonths;

global $price;
global $duration;
global $totalMonths;
global $monthlyCharge;
global $monthlyPercents;
global $monthlySum;
global $finalCost;



	$pass = mysqli_query($connection, "
		UPDATE `user` SET Passport = '{$_POST['passport']}'

		WHERE login = '{$_SESSION['logged_user']->login}'");

	echo "
	<div class='container'>
	<form action='flat.php' method='post'>
		<div class='row'>
			<div class='col-md-3'>
				<h4>Ежемесячный платеж</h4>
				<p>".round($monthlySum, 3)." Рублей</p>
			</div>
			<div class='col-md-3'>
				<h4>Итоговая сумма</h4>
				<p>".round($finalCost, 3)." Рублей</p>
			</div>
			<div class='col-md-3'>
			<h4>
<input type='hidden' value='{$_POST['idi1']}' name='idi2'>
<input type='hidden' value='$finalCost' name='finalCost'></h4>
				<button name='accept_3'>
					Оформить
				</button>
			</div>
		</div>
	</form>
</div>";
	} else {
		echo '<div class="row text-center" id="errors" style="color:red; padding-top: 50px; ">' .array_shift($errors). '</div>';
	}

}

if (isset($_POST['accept_3'])) {

	$deal = date("Y-m-d");
	$oper = mysqli_query($connection, "
			INSERT INTO `operations` (`login_user`,`id_appartment`,`summary`,`id_method`,`date_deal`)
			VALUES ('{$_SESSION['logged_user']->login}', '{$_POST['idi2']}', '{$_POST['finalCost']}', '2', '$deal')
			");
	
	echo '<div class="row text-center" id="errors" style="color:red; padding-top: 50px; ">Ваша заявка находится на рассмотрении. Ожидайте звонка в ближайшее время</div>';

	}
?>




<?php include("includes/footer.php") ?>