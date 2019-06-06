<!DOCTYPE html>

<?php include ("includes/session.php");
include ("includes/sideadmin.php");?>

<form action="adminstory.php" method="post">
    <aside class="adminopertaions">   
      <ul class="nav bd-sidenav">
        <li>
            <select name="status">
        <?php
    $query ="SELECT * FROM status WHERE id <> '4'";
    $status = mysqli_query($connection, $query) or die("Ошибка " . mysqli_error($connection));
    if($status)

    {
    $statusrows = mysqli_num_rows($status); // количество полученных строк

    for ($i = 0 ; $i < $statusrows ; ++$i)
    {
        $statusrow = mysqli_fetch_row($status);
        echo " <option>$statusrow[0] $statusrow[1] </option>";
    }
    }
     ?>
      </select>
              <button type="submit" name="sort">Показать</button>
            </a>
          </li>
      </ul>
  </aside>
</form>

<?php

if (isset($_POST['sort'])) {

	$stat = $_POST['status'];
	$sql = mysqli_query($connection, "SELECT operations.id as 'ID', user.login as 'login', apartments.number as 'number', summary, methods.name as 'method', status.name as 'status', date_deal
 FROM operations
 LEFT JOIN user on operations.login_user = user.login
 LEFT JOIN apartments on operations.id_appartment = apartments.id
 LEFT JOIN methods on operations.id_method = methods.id
 LEFT JOIN status on operations.id_status = status.id
 WHERE operations.id_status = '$stat'");

	if (!$sql) {
	echo "raz". mysqli_error($connection);
}

echo "<section id='apartment-story'>
	<div class='container admin'>";

while ($result = mysqli_fetch_array($sql)) {

echo "
	<div class='row story'>
			<div class='col-md-2'>
				<h4>Логин</h4>
				<p>{$result['login']}</p>
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
			</div>";
			
	if ($stat == 2 || $stat == 3) {
		echo "</div>";
	} else {
		echo "
<div class='row deal_buttons'>
  <div class='col-md-10'> 		
 		<button id='reject'>
 			<a href='?reject_id={$result['ID']}'>Отказать</a>
 		</button>
 	</div>
 	<div class='col-md-1'>
 		<button id='accept'>
 			<a href='?accept_id={$result['ID']}'>Одобрить</a>
 		</button>
 	</div>
  </div>
 </div>";
	}

	
}		

echo "</div>
</section>";

}else {
	$sql = mysqli_query($connection, "SELECT operations.id as 'ID', user.login as 'login', apartments.number as 'number', summary, methods.name as 'method', status.name as 'status', date_deal
 FROM operations
 LEFT JOIN user on operations.login_user = user.login
 LEFT JOIN apartments on operations.id_appartment = apartments.id
 LEFT JOIN methods on operations.id_method = methods.id
 LEFT JOIN status on operations.id_status = status.id");
	if (!$sql) {
	echo "raaaz". mysqli_error($connection);
}
}



if (isset($_GET['accept_id'])) {
	$update = mysqli_query($connection, "UPDATE `operations` SET `id_status` = 2 WHERE operations.id = {$_GET['accept_id']}");
	header("location: adminstory.php");
}

if (isset($_GET['reject_id'])) {
	$update = mysqli_query($connection, "UPDATE `operations` SET `id_status` = 3 WHERE operations.id = {$_GET['reject_id']}");
	header("location: adminstory.php");
}

echo "<section id='apartment-story'>
	<div class='container admin'>";

while ($result = mysqli_fetch_array($sql)) {

	echo "
	<div class='row story'>
			<div class='col-md-2'>
				<h4>Логин</h4>
				<p>{$result['login']}</p>
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
	
	<div class='row deal_buttons'>
 	<div class='col-md-10'> 		
 		<button id='reject'>
 			<a href='?reject_id={$result['ID']}'>Отказать</a>
 		</button>
 	</div>
 	<div class='col-md-1'>
 		<button id='accept'>
 			<a href='?accept_id={$result['ID']}'>Одобрить</a>
 		</button>
 	</div>
 </div>
 </div>";
}
		

echo "</div>
</section>";	
	

 ?>


<?php include ("includes/footer.php") ?>