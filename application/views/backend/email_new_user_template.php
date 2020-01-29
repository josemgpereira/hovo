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
</style>
<body>
<div>
	<p class="email">
		<b>E-mail:</b> <?php echo $email; ?><br>
		<b>Senha:</b> <?php echo $password; ?><br>
		<b>URL:</b> <?php echo base_url(); ?>
	</p>
</div>
</body>
</html>
