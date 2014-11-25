<html lang="it-IT">
<?php
setlocale(LC_TIME, 'ita', 'it_IT');
$no_search = empty($_GET);
function therm($temp){
	$temp = intval($temp / 10);
	switch ($temp) {
		case -1: $res = 'very_cold';
			break;
		case 0: $res = 'cold.png';
			break;
		case 1: $res = 'moderate.png';
			break;
		case 2: $res = 'hot.png';
			break;
		case 3: $res = 'very_hot.png';
			break;
		case 4: $res = 'very_hot.png';
			break;
		default: $res = 'moderate.png';
		}
	return $res;
}		
$weatherCode =  array(395 => 'Neve moderata o pesante in zona con tuoni ',
					392 => 'Neve leggera in zona con tuoni ',
					389 => 'Soleggiato o poco nuvoloso zona con ',
					386 => 'Soleggiato in zona con tuoni ',
					377 => 'Rovesci moderati o forti di pellets di ghiaccio ',
					374 => 'Rovesci di pellets di ghiaccio ',
					371 => 'Nevicate moderate o pesanti ',
					368 => 'Rovesci di neve leggeri ',
					365 => 'Cadute moderati o pesanti ',
					362 => 'Rovesci deboli rovesci ',
					359 => 'Torrenziale pioggia ',
					356 => 'Sereno o poco nuvoloso ',
					353 => 'Soleggiato ',
					350 => 'Pellets di ghiaccio ',
					338 => 'Nevicata ',
					335 => 'Neve pesante Sereno ',
					332 => 'neve moderata ',
					329 => 'Neve moderata Sereno ',
					326 => 'Pioggia ',
					323 => 'Neve leggera ',
					320 => 'Nevischio moderata o pesante ',
					317 => 'nevischio luce ',
					314 => 'Sereno o Heavy Rain congelamento ',
					311 => 'Pioggia di congelamento ',
					308 => 'pioggia ',
					305 => 'Pioggia a tratti ',
					302 => 'Soleggiato ',
					299 => 'Soleggiato ',
					296 => 'Rovesci ',
					293 => 'Soleggiato ',
					284 => 'Il congelamento Heavy nuvoloso ',
					281 => 'Pioggia di congelamento ',
					266 => 'Nebbia ',
					263 => 'Pioggia leggera ',
					260 => 'Nebbia di congelamento ',
					248 => 'Nebbia ',
					230 => 'Bufera di neve ',
					227 => 'Soffia neve ',
					200 => 'Soleggiato nella vicina ',
					185 => 'Rovesci di congelamento nevischio nelle vicinanze ',
					182 => 'Nevischio Sereno nelle vicinanze ',
					179 => 'Rovesci di neve nelle vicinanze ',
					176 => 'Soleggiato ',
					143 => 'Nebbia ',
					122 => 'Nuvoloso ',
					119 => 'Nuvoloso ',
					116 => 'Parzialmente nuvoloso ',
					113 => 'Cielo sereno / soleggiato');
			
if ($no_search){
		$q = "Pisa, Italy";
	}
	else {
		$q = $_GET['location'];
	}
	
$q =  preg_replace("/ /", '+', $q);

$json = file_get_contents("http://api.worldweatheronline.com/free/v1/weather.ashx?q=%22".$q."%22&format=json&num_of_days=5&key=1863723714ef679d495a8346caf37262f4650630");
$data =  json_decode($json, true);
$query = $data['data']['request'][0]['query'];
$cloudcover = $data['data']['current_condition'][0]['cloudcover'];
if ( $cloudcover > 50) 
	{
	$image = "cloudy.jpg";
	}
else {
	$image = "sunny.jpg";
	}
	
//background retrieve
/////////////////////////////////////////////////////////////////////////////////////////////////////////////
/* 
$posttit = 'Roma';
function get_url_contents($url) {
$crl = curl_init();

curl_setopt($crl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT        5.1; .NET CLR 1.1.4322)');
curl_setopt($crl, CURLOPT_URL, $url);
curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($crl, CURLOPT_CONNECTTIMEOUT, 5);

$ret = curl_exec($crl);
curl_close($crl);
return $ret;
}

$json = get_url_contents('http://ajax.googleapis.com/ajax/services/search/images?v=1.0&q='.$q.'&imgsz=xlarge');

$data_img = json_decode($json);

foreach ($data_img->responseData->results as $result) {
$results[] = array('url' => $result->url, 'alt' => $result->title);

}
$i = rand(0,3)
 */
/////////////////////////////////////////////////////////////////////////////////////////////////////////////	
?>

<?php
		$t = strtotime('now');
		//$now = date('d M Y', $t);
		$now = strftime("%A %d %B", $t);
		$now_h = date('H:i', $t);
		
		//$weatherIconUrl = '<img src="'.$data['data']['current_condition'][0]['weatherIconUrl'][0]['value'].'" style="width:120px"/>';
		$weatherIconUrl = '<img src="icons/'.$data['data']['current_condition'][0]['weatherCode'].'.png'.'" style="width:120px"/>';
		
		$weatherDesc = $weatherCode[$data['data']['current_condition'][0]['weatherCode']];
		$temp_C = $data['data']['current_condition'][0]['temp_C'].'°';
		$thTemp = therm($data['data']['current_condition'][0]['temp_C']);
		$visibility = $data['data']['current_condition'][0]['visibility'].' Km';
		$humidity = $data['data']['current_condition'][0]['humidity'].'%';
		$cloudcover = $data['data']['current_condition'][0]['cloudcover'].'%';
		$winddir16Point =  $data['data']['current_condition'][0]['winddir16Point'];
		$winddirDegree = $data['data']['current_condition'][0]['winddirDegree'].' Gradi';
	    $windspeedKmph = $data['data']['current_condition'][0]['windspeedKmph'].' Km/h';
		$precipMM = $data['data']['current_condition'][0]['precipMM'].' mm';
		$pressure = $data['data']['current_condition'][0]['pressure'].' hPa';
?>

	<head>
		<!-- <meta charset="UTF-8"> -->
		<meta http-equiv="Content-Type" content="text/html;charset=ISO-8859-1">
		<!-- <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"> -->
		<title>Condizioni atmosferiche per: <?=$query?></title>
	    <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Tangerine">
		<link href='http://fonts.googleapis.com/css?family=PT+Sans' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Roboto:100,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body background="<?=$image?>">
		<!--<div id="contents" class="center">-->
			<div class="center">
				<h1><?=$query?></h1>
			</div>
			
			<div class="center">
				<strong><?='<h4>'.$now_h.'</h4><br />'.$now?></strong> 
			</div>
			<br />
			<div id="current-condition" class="center">
				<div>
					<div style="float: left; text-align: left;">
						<ul>
							<li>Vento: <strong><?=$windspeedKmph?> da <?=$winddir16Point?></strong></li>
							<li>Pressione Atmosferica: <strong><?=$pressure?></strong></li>
							<li>Umidit&agrave;: <strong><?=$humidity?></strong></li>
							<li>Copertura Nuvolosa: <strong><?=$cloudcover?></strong></li>
							<li>Visibilit&agrave;<strong> <?=$visibility?></strong></li>
							<li>Precipitazioni <strong> <?=$precipMM?></strong></li>
						</ul>
					</div>
					<div style="float: left;">
						<ul>
						<li><?=$weatherIconUrl?></li>

						</ul>
					</div>
					<div style="float: right;margin-right:10%;text-align:right;">
						<ul>
						<li><strong><h4><?=$temp_C?>C</h4></strong></li>
						<li><strong style="font-size:1.5em"><?=$weatherDesc?></strong></li>
						</ul>
					</div>
					<div style="clear: both;">
					</div>
				</div>
			</div>
			<br />
		<!-- 	<div class="center">
				<table>
					<tr>
						<td><?=$weatherIconUrl?></td>
						<td><p style="width:80px;"></p></td>
						<td><strong>Vento </strong> <?=$windspeedKmph?> da <?=$winddir16Point?></td>
						<td><p style="width:80px;"></p></td>
						<td><strong>Precipitazioni </strong> <?=$precipMM?></td>
					</tr>
					<tr>
						<td><strong><?=$weatherDesc?></strong></td>
						<td><p style="width:80px;"></p></td>
						<td><strong>Visibilit&agrave;</strong> <?=$visibility?></td>
						<td><p style="width:80px;"></p></td>
						<td><strong>Umidit&agrave; </strong><?=$humidity?></td>
					</tr>
					<tr>	
						<td><span style="font-size:3em;"><?=$temp_C?></span><img src="images/<?=$thTemp?>" style="width:45px;height:45px;"/></td>
						<td><p style="width:80px;"></p></td>
						<td><strong>Copertura Nuvolosa </strong><?=$cloudcover?></td>
						<td><p style="width:80px;"></p></td>
						<td><strong>Pressione Atmosferica </strong><?=$pressure?></td>
					</tr>
				</table> 
			</div> -->
				
				<div id="next-days" class="center">

				<?php
					foreach ($data['data']['weather'] as $day) {	
						$date = "<b>".strftime("%A", strtotime($day['date']))."</b>";
						$date = $date.'<br />'.strftime("%d %B", strtotime($day['date']));
						//$date = strftime("%A %d %B", strtotime($day['date']));
						//$weatherIconUrl = '<img src="'.$day['weatherIconUrl'][0]['value'].'"/>';
						$weatherIconUrl = '<img src="icons/'.$day['weatherCode'].'.png'.'" style="width:80px"/>';

						$weatherDesc = $weatherCode[$day['weatherCode']];
						$tempMaxC = $day['tempMaxC'].'°C';
						$thMax = therm($day['tempMaxC']);
						//$tempMaxF = $day['tempMaxF'].'°F';
						$tempMinC = $day['tempMinC'].'°C';
						$thMin = therm($day['tempMinC']);
						//$tempMinF = $day['tempMinF'].'°F';
						$windspeedKmph = $day['windspeedKmph'].' Km/h';
						$winddir16Point = $day['winddir16Point'];
						$precipMM = $day['precipMM'].' mm';
				?>		
					<div style="float:left;width:20%">
						<p><?=$date?></p>
						<p><?=$weatherIconUrl?></p>
						<!-- <p><?=$weatherDesc?></p> -->
						<p><?=$tempMaxC?></p><!--<img src="images/<?=$thMax?>" style="width:25px;height:25px;"/></p>-->
						<p><?=$tempMinC?></p><!--<img src="images/<?=$thMin?>" style="width:25px;height:25px;"/></p>-->
						<p><?=$windspeedKmph?></p>
						<p><?=$winddir16Point?></p>
						<p><?=$precipMM?></p>
					</div>
				<?php
					}	
				?>  

			</div>
				
		</div> <!--contents -->
	</body>
</html>


					