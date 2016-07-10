<?php
	if(isset($_FILES["mapfile"],$_POST["x"],$_POST["y"],$_POST["z"]))
	{
		$mapfile = fopen($_FILES["mapfile"]["tmp_name"], "rb");
		$x = (float)$_POST["x"];
		$y = (float)$_POST["y"];
		$z = (float)$_POST["z"];

		$contents = "";

		while (($line = fgets($mapfile)) !== FALSE) 
		{
			$tmp_x = (float)getStringBetween($line, "posX=\"","\"");
			$tmp_y = (float)getStringBetween($line, "posY=\"","\"");
			$tmp_z = (float)getStringBetween($line, "posZ=\"","\"");
		    $contents .= str_replace(array($tmp_x, $tmp_y, $tmp_z), array($tmp_x+$x, $tmp_y+$y, $tmp_z+$z), $line);
		}
		fclose($mapfile);

		header("Content-type: text/plain");
		header("Content-Disposition: attachment; filename={$_FILES["mapfile"]["name"]}");
		echo $contents;

		die();
	}

	function getStringBetween($str,$from,$to)
	{
	    $sub = substr($str, strpos($str,$from)+strlen($from),strlen($str));
	    return substr($sub,0,strpos($sub,$to));
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
	<body>
		<form action="#" enctype="multipart/form-data" method="post">
			<input type="file" name="mapfile" id="mapfile" class="form-control" /><br>
			<input type="number" name="x" id="x" placeholder="offset x" /><br>
			<input type="number" name="y" id="y" placeholder="offset y" /><br>
			<input type="number" name="z" id="z" placeholder="offset z" /><br>
			<input type="submit" name="Submit">
		</form>
	</body>
</html>
