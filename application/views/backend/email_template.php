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
		<b>Data Inicial:</b> <?php echo $startdate; ?><br>
		<b>Data Final:</b> <?php echo $enddate; ?><br>
		<?php if($status=='Approve'){ ?>
		<b>Estado:</b><span class="status"> Aprovado</span><br>
		<?php } else { ?>
		<b>Estado:</b><span class="status"> Rejeitado</span><br>
		<b>Motivo de Rejeição:</b> <?php echo $rejectreason; ?>
		<?php } ?>
	</p>
</div>
</body>
</html>
