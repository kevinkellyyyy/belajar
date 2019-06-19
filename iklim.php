<?php
	$json = file_get_contents('http://api.openweathermap.org/data/2.5/forecast?id=1642911&units=metric&appid=271da6b323b05ebaf2b4aaa0f3378f89');
	$data = json_decode($json,true);

	if(isset($_POST['pilihan'])){
		//echo $_POST['lokasi'];
		$lokCari = $_POST['lokasi'];
		$urlBaru = 'http://api.openweathermap.org/data/2.5/forecast?id='.$lokCari.'&units=metric&appid=271da6b323b05ebaf2b4aaa0f3378f89';

		$json = file_get_contents($urlBaru);
	 	$data = json_decode($json,true);
	}
?> 

<!DOCTYPE html>
<html>
<head>
	<title>TEST FE IKLIM PHP</title>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<script>
    	console.log(<?php echo json_encode($json); ?>);
	</script>

	<div class="container">

		<form class="form-group" action="" method="POST">
			<select onchange="this.form.submit()" class="form-control" name="lokasi" >
				<option>Pilih Lokasi</option>
				<option value="1642911" >Jakarta</option>
				<option value="1880252" >Singapore</option>
				<option value="1609350" >Bangkok</option>
				
			</select>
			<input type="hidden" name="pilihan">
		</form>
		
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th> <?php echo $data['city']['name'] ?> </th>
					<th> Suhu </th>
					<th> Perbedaan </th>
				</tr>
			</thead>

			<tbody>
				<?php
				$totalSuhu = 0;
				$totalSelisihSuhu = 0;
				$counter = 0;
					foreach($data['list'] as $row){
						$epoch2 = $row['dt'];
						$dt2 = new DateTime("@$epoch2");

						if($dt2->format('H:i:s') == '12:00:00'){
							$epoch = $row['dt'];
							$dt = new DateTime("@$epoch");
							echo "<tr>";
							echo "<td>".$dt->format('Y-m-d')."</td>";
							echo "<td>".$row['main']['temp']."&deg;C</td>";
							echo "<td>".($row['main']['temp_max']-$row['main']['temp_min'])."&deg;C</td>";
							echo "</tr>";

							$totalSuhu += $row['main']['temp'];
							$totalSelisihSuhu += ($row['main']['temp_max']-$row['main']['temp_min']);
							$counter += 1;
						}
					}
				?>
			</tbody>

			<tfoot>
				<tr>
					<th> Rata-rata</th>
					<th> <?php $avg = $totalSuhu/$counter; echo $avg."&deg;C"; ?></th>
					<th> <?php $avg2 = $totalSelisihSuhu/$counter; echo $avg2."&deg;C"; ?></th>
				</tr>
			</tfoot>
		</table>
	</div>
</body>
</html>