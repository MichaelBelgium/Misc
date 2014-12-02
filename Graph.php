<?php
	include "SACNRMonitor.php"; // http://monitor.sacnr.com/api/php/SACNRMonitor.php
	
	$serverid = 1638985; // SACNR Server ID | http://monitor.sacnr.com/server-<here is an id>.html
	$hours = 44; // how much past hours should the graph show the playerbase. Max value = 44 !
	$using_table = false; //Display a detailed table under it ? true or false


	$monitor = new SACNRMonitor;
	$query = $monitor->get_query_by_id($serverid);
	$json = json_encode((array)$query);
	
	if($hours > 44 || $hours < 1) die("Invalid value: $hours");
?>

<!DOCTYPE html>
<html>
	<head>
		<title>SA:MP Server Graph</title>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
		<script type="text/javascript">
		google.load('visualization', '1.0', {'packages':['corechart','table']});
		google.setOnLoadCallback(drawChart);
		
		function drawChart()
		{
			var data = new google.visualization.DataTable();
			data.addColumn('string', 'Date');
			data.addColumn('number', 'Playercount');

			var datavalues = <? echo $json ?>;
			var date = [];
			for (i = datavalues.length-(<? echo $hours ?>* 4), j = datavalues.length; i < j; i++)
			{
				date[0] = new Date(parseInt(datavalues[i]["Timestamp"])*1000);
				date[1] = ((date[0].getDate() < 10) ? "0"+date[0].getDate() : date[0].getDate()) + "/" + (date[0].getMonth()+1) + "/" + date[0].getFullYear();
				date[2] = date[0].getHours() + ":" + ((date[0].getMinutes() < 10) ? "0"+date[0].getMinutes() : date[0].getMinutes());
				
				data.addRow([date[1] + " " + date[2], parseInt(datavalues[i]["PlayersOnline"])]);
			}
			
			if(<? echo $using_table ?> === 1)
			{
				var table = new google.visualization.Table(document.getElementById('table'));
				table.draw(data, {showRowNumber: true, width: 600});
			}
			
			var options = {
				title: "Players Online",
				height: 400, 
				legend: {position: 'bottom'},
				orientation: 'horizontal'
			};
			
			var chart = new google.visualization.LineChart(document.getElementById('chart'));
			chart.draw(data, options);
		}
	</script>
	</head>
	<body>
		<div id="chart"></div>
		<div id="table"></div>
	</body>
</html>
