<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Hovo Comunicativo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<style>
	p.email {
		Margin-top: 0;
		color: #565656;
		font-family: Georgia,serif;
		font-size: 16px;
		line-height: 50px;
		Margin-bottom: 25px;
	}
	.status {
		color: red;
	}
</style>
<body>
<div>
	<p class="email">
		<b>Nome do Funcionário:</b> <?php echo $first_name . ' ' . $last_name; ?><br>
		<b>Data de Requerimento:</b> <?php echo $applydate; ?><br>
		<b>Data Inicial:</b> <?php echo $startdate; ?><br>
		<b>Data Final:</b> <?php echo $enddate; ?><br>
		<b>Duração:</b> <?php echo ($duration/8) . ' dias'; ?><br>
	</p>
</div>
</body>
</html>
