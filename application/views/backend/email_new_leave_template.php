<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title>Hovo Comunicativo</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<p style="font-size: 20px;">O seguinte pedido de férias foi efetuado:</p>
<div>
	<table style="width: 100%;border: 1px solid black;">
		<tbody>
		<tr>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><b>Nome do Funcionário:</td>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><?php echo $first_name . ' ' . $last_name; ?></td>
		</tr>
		<tr>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><b>Data de Requerimento:</td>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><?php echo date('d-m-Y',strtotime($applydate)); ?></td>
		</tr>
		<tr>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><b>Data Inicial:</td>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><?php echo date('d-m-Y',strtotime($startdate)); ?></td>
		</tr>
		<tr>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><b>Data Final:</td>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><?php echo date('d-m-Y',strtotime($enddate)); ?></td>
		</tr>
		<tr>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><b>Duração:</td>
			<td style="width: 50%;text-align: left;border: 1px solid black;font-size: 20px;"><?php echo ($duration/8) . ' dias'; ?></td>
		</tr>
		</tbody>
	</table>
</div>
</body>
</html>
