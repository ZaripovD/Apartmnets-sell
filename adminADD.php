<!DOCTYPE html>

<?php include ("includes/session.php");
include ("includes/sideadmin.php");

if (isset($_POST['add'])) {

	// проверка формы на пустоту полей
    $errors = array();   

    if ( trim($_POST['number']) < 1 || trim($_POST['number']) > 135)
    {
      $errors[] = 'Введите номер квартиры от 1 до 135';
    }

    if ($_POST['rooms'] == 1) {
    	if ($_POST['square'] < 40 || $_POST['square'] > 50) {
    		$errors[] = 'В 1 комнатной квартире общая площадь не должна выходить за пределы диапазона от 40м до 50м';
    	}
     	if ($_POST['living_space'] < 30 || $_POST['living_space'] > 40 ) {
     		$errors[] = 'В 1 комнатной квартире жилая площадь не должна выходить за пределы диапазона от 30м до 40м ';
     	}
     	if ($_POST['bathroom'] < 5 || $_POST['bathroom'] > 8 ) {
     		$errors[] = 'В 1 комнатной квартире площадь ванной не должна выходить за пределы диапазона от 5м до 8м ';
     	}
     	if ($_POST['kitchen'] < 8 || $_POST['kitchen'] > 12 ) {
     		$errors[] = 'В 1 комнатной квартире площадь кухни не должна выходить за пределы диапазона от 8м до 12м ';
     	}
     	if ($_POST[''] < 1000000 || $_POST[''] > 1900000 ) {
     		$errors[] = 'Стоимость 1 комнатной квартиры не должна выходить за пределы диапазона от 1.000.000 Р до 1.900.000 Р ';
     	}
     }

     if ($_POST['rooms'] == 2) {
    	if ($_POST['square'] < 50 || $_POST['square'] > 60) {
    		$errors[] = 'В 2-х комнатной квартире общая площадь не должна выходить за пределы диапазона от 50м до 60м ';
    	}
     	if ($_POST['living_space'] < 40 || $_POST['living_space'] > 50 ) {
     		$errors[] = 'В 2-х комнатной квартире жилая площадь не должна выходить за пределы диапазона от 40м до 50м';
     	}
     	if ($_POST['bathroom'] < 8 || $_POST['bathroom'] > 11 ) {
     		$errors[] = 'В 2-х комнатной квартире площадь ванной не должна выходить за пределы диапазона от 8м до 11м';
     	}
     	if ($_POST['kitchen'] < 11 || $_POST['kitchen'] > 14 ) {
     		$errors[] = 'В 2-х комнатной квартире площадь кухни не должна выходить за пределы диапазона от 11м до 14м ';
     	}
     	if ($_POST[''] < 2000000 || $_POST[''] > 2900000 ) {
     		$errors[] = 'Стоимость 2-х комнатной квартиры не должна выходить за пределы диапазона от 2.000.000 Р до 2.900.000 Р ';
     	}
     } 

     if ($_POST['rooms'] == 3) {
    	if ($_POST['square'] < 60 || $_POST['square'] > 70) {
    		$errors[] = 'В 3-х комнатной квартире общая площадь не должна выходить за пределы диапазона от 60м до 70м ';
    	}
     	if ($_POST['living_space'] < 50 || $_POST['living_space'] > 60 ) {
     		$errors[] = 'В 3-х комнатной квартире жилая площадь не должна выходить за пределы диапазона от 50м до 60м ';
     	}
     	if ($_POST['bathroom'] < 11 || $_POST['bathroom'] > 14 ) {
     		$errors[] = 'В 3-х комнатной квартире площадь ванной не должна выходить за пределы диапазона от 11м до 14м ';
     	}
     	if ($_POST['kitchen'] < 14 || $_POST['kitchen'] > 17 ) {
     		$errors[] = 'В 3-х комнатной квартире площадь кухни не должна выходить за пределы диапазона от 14м до 17м ';
     	}
     	if ($_POST[''] < 3000000 || $_POST[''] > 3900000 ) {
     		$errors[] = 'Стоимость 3-х комнатной квартиры не должна выходить за пределы диапазона от 3.000.000 Р до 3.900.000 Р ';
     	}
     } 

     if ($_POST['rooms'] == 4) {
    	if ($_POST['square'] < 70 || $_POST['square'] > 80) {
    		$errors[] = 'В 4-х комнатной квартире общая площадь не должна выходить за пределы диапазона от 70м до 80м ';
    	}
     	if ($_POST['living_space'] < 60 || $_POST['living_space'] > 70 ) {
     		$errors[] = 'В 4-х комнатной квартире жилая площадь не должна выходить за пределы диапазона от 60м до 70м ';
     	}
     	if ($_POST['bathroom'] < 14 || $_POST['bathroom'] > 17 ) {
     		$errors[] = 'В 4-х комнатной квартире площадь ванной не должна выходить за пределы диапазона от 14м до 17м ';
     	}
     	if ($_POST['kitchen'] < 17 || $_POST['kitchen'] > 20 ) {
     		$errors[] = 'В 4-х комнатной квартире площадь кухни не должна выходить за пределы диапазона от 17м до 20м ';
     	}
     	if ($_POST[''] < 4000000 || $_POST[''] > 4900000 ) {
     		$errors[] = 'Стоимость 4-х комнатной квартиры не должна выходить за пределы диапазона от 4.000.000 Р до 4.900.000 Р ';
     	}
     } 

  
	
}


?>


<form method="POST" action="adminADD.php" id="apartment-add">
	<div class="container admin">
		<div class="row">
			<div class="col-md-1">
				<h4>Номер</h4>
				<input type="text" name="number" size="3">
			</div>
			<div class="col-md-1">
				<h4>Этаж</h4>
				<select name="floor" class="apartment-selection">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
					<option>5</option>
					<option>6</option>
					<option>7</option>
					<option>8</option>
					<option>9</option>
				<select>
			</div>
			<div class="col-md-1">
				<h4>Комнаты</h4>
				<select name="rooms" class="apartment-selection">
					<option>1</option>
					<option>2</option>
					<option>3</option>
					<option>4</option>
				</select>
			</div>
			<div class="col-md-2">
				<h4>Площадь</h4>
				<input type="text" name="square" size="3">
			</div>		
			<div class="col-md-2">
				<h4>Жилплощадь</h4>
				<input type="text" name="living_space" size="3">
			</div>
			<div class="col-md-1">
				<h4>Ванная</h4>
				<input type="text" name="bathroom" size="3">
			</div>
			<div class="col-md-1">
				<h4>Кухня</h4>
				<input type="text" name="kitchen" size="3">
			</div>
			<div class="col-md-2">
				<h4>Стоимость</h4>
				<input type="text" name="price" size="3">
			</div>
		</div>
		<div class="row ">
			<div class="col-md-10 click">
				<button id="addAP" name="add">
					Добавить
				</button>
			</div>
		</div>
	</div>
</form>

<div class="row result">
    <div class="col-md-12 text-center">
        <?php if ($errors[] = "") {
    $adding = mysqli_query($connection, "
        INSERT INTO apartments ( `number`, `floor`, `rooms`, `square`, `price`, `living_space`, `bathroom`, `kitchen`)
        VALUES 
        ('{$_POST['number']}', '{$_POST['floor']}', '{$_POST['rooms']}', '{$_POST['square']}', '{$_POST['price']}', '{$_POST['living_space']}', '{$_POST['bathroom']}', '{$_POST['kitchen']}')");
    echo "Квартира добавлена!";
  }else{
    echo array_shift($errors);
  } ?>
    </div>
</div>

<?php include ("includes/footer.php") ?>