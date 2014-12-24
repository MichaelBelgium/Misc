<?php
    /* UPDATE 24/12/2014:
     * Fixed the using_table part
     * Added another table using more server info from SACNR monitor
     * */

	include "ucp/includes/SACNRMonitor.php";
	
	$serverid = 1638985; // SACNR Server ID | http://monitor.sacnr.com/server-<here is an id>.html
	$hours = 24; // how much past hours should the graph show the playerbase. Max value = 44 !
	$using_table = true; //Display a detailed table under it ? true or false

	$monitor = new SACNRMonitor;

	$query = (array)$monitor->get_query_by_id($serverid);
    $info = (array)$monitor->get_info_by_id($serverid);

	$json_query = json_encode($query);
    $json_info = json_encode($info);


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

			var datavalues = <? echo $json_query ?>;
			var date = [];
			for (i = datavalues.length-(<? echo $hours ?>* 4), j = datavalues.length; i < j; i++)
			{
				date[0] = new Date(parseInt(datavalues[i]["Timestamp"])*1000);
				date[1] = ((date[0].getDate() < 10) ? "0"+date[0].getDate() : date[0].getDate()) + "/" + (date[0].getMonth()+1) + "/" + date[0].getFullYear();
				date[2] = date[0].getHours() + ":" + ((date[0].getMinutes() < 10) ? "0"+date[0].getMinutes() : date[0].getMinutes());
				
				data.addRow([date[1] + " " + date[2], parseInt(datavalues[i]["PlayersOnline"])]);
			}

            var data_ = new google.visualization.DataTable();
            datavalues = <? echo $json_info ?>;

            data_.addColumn('string','Info');
            data_.addColumn('string','Value');

            data_.addRows([
                ['Map', datavalues["Map"]],
                ['Players', datavalues["Players"] + "/" + datavalues["MaxPlayers"]],
                ['Average', datavalues["AvgPlayers"]],
                ['Time', datavalues["Time"]],
                ['Version', datavalues["Version"]],
                ['Website', '<a href="http://'+ datavalues["WebURL"] +'">Click</a>'],
                ['Password', (datavalues["Password"] === '0') ? 'No' : 'Yes'],
                ['Host-tab', (datavalues["HostTab"] === '0') ? 'No' : 'Yes']
            ]);

            var enabled =  <? echo empty($using_table) ? 0 : 1 ?>;
			if(enabled === 1)
			{
				var table = new google.visualization.Table(document.getElementById('table'));
				table.draw(data, {showRowNumber: true, width: 600});
                table = new google.visualization.Table(document.getElementById('info'));
                table.draw(data_, {showRowNumber: false, width: 400, allowHtml: true});
			}

			var options = {
				title:  datavalues["Hostname"] + " (" + datavalues["Gamemode"] + ")",
				height: 400, 
				legend: {position: 'bottom'},
				orientation: 'horizontal'
			};

			var chart = new google.visualization.LineChart(document.getElementById('chart'));
			chart.draw(data, options);
		}
	    </script>
        <style type="text/css">
            #table, #info { display: inline-block;  vertical-align: top;}
            #chart { margin-bottom: 10px; }
        </style>
	</head>
	<body>
		<div id="chart"></div>
		<div id="table"></div>
        <div id="info"></div>
	</body>
</html>
