<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Hovo Comunicativo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<p style="font-size: 20px;">Os seus dados de acesso são os seguintes:</p>
<div>
	<table style="width: 100%;border: 1px solid black;">
		<tbody>
		<tr>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><b>URL:</td>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><?php echo base_url(); ?></td>
		</tr>
		<tr>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><b>E-mail:</td>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><?php echo $email; ?></td>
		</tr>
		<tr>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><b>Senha:</td>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><?php echo $password; ?></td>
		</tr>
		</tbody>
	</table>
</div>
</body>
</html>
