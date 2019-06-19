<!DOCTYPE html>
<html>
<head>
	<title>TEST FIVAA</title>
</head>
<body>
	<form action="" method="POST">
		<input type="text" name="angka">
		<input type="submit" name="masuk">
		
	</form>
</body>
</html>

<?php
	if(isset($_POST['masuk'])){
		$angkanya = $_POST['angka'];
		echo "input : ".$angkanya."<br>";
		$temp = $angkanya;
		for($i = $angkanya;$i>0;$i--){
			echo $i-1;
			echo $i-1;
			for($j = $temp; $j>0; $j--){
				echo $i+1;
			}
			$temp--;
			echo "<br>";
		}
	}
?>