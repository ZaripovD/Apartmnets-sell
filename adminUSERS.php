
<!DOCTYPE html>
<?php include ("includes/session.php");
include ("includes/sideadmin.php");

$sql = mysqli_query($connection, "SELECT login, _family, _name, _father, phone FROM user");

if (!$sql) {
	echo mysqli_error($connection);
}
echo "<section id='apartment-story'>
	<div class='container admin'>";

while ($result = mysqli_fetch_array($sql)) {
echo "
		<div class='row'>
			<div class='col-md-1'>
				<h4>Логин</h4>
				<p>{$result['login']}</p>
			</div>
			<div class='col-md-1'>
				<h4>Фамилия</h4>
				<p>{$result['_family']}</p>
			</div>
			<div class='col-md-2'>
				<h4>Имя</h4>
				<p>{$result['_name']}</p>
			</div>
			<div class='col-md-2'>
				<h4>Отчество</h4>
				<p>{$result['_father']}</p>
			</div>		
			<div class='col-md-2'>
				<h4>Телефон</h4>
				<p>{$result['phone']}</p>
			</div>		
		</div>
		<div class='row btn'>
			<div class='col-md-12'>
				<a href=''>
					Удалить
				</a>
			</div>
		</div>";
}
echo "</div>
</section>";
?>

<?php include ("includes/footer.php") ?>