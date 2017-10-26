<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <title>Color Picker</title>
</head>
<body class="container">

<h1>Color Picker</h1>

<!-- <form action="index.php" method="post">
Color: <input type="text" name="Color"><br>
Hex: <input type="text" name="Hex"><br>
<input type="submit">
</form> -->

<?php
$colorErr = $hexErr = "";
$color_input = $hex_input = "";
?>

<form method="post" action="index.php" name="insert">  
  Color: <input type="text" name="color_name" >

  <br><br>
  Hex: <input type="text" name="color_hex">
 
  <br><br>
  <input type="submit">  
</form>

<?php




// DATABASE FUNCTIONS
function getDb() {
        $db = pg_connect("host=localhost port=5432 dbname=colorpicker user=coloruser password=colorcolorcolor");
  
        return $db;
    }
	//Make a request.
	function getInventory() {
	    $request = pg_query(getDb(), "
	        SELECT *
	        FROM colors	        
	    ");
	    // Return a fetch to use the data.
	    return pg_fetch_all($request);
	}
	   //var_dump(getInventory());

?>
	<div>
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Hex</th>
			</tr>
		
	</div> 

<?php 

	foreach (getInventory() as $color) {

		echo "<tr>";
		echo "<td>" . $color['color_name'] . "</td>";
		echo "<td>" . $color['color_hex'] . "</td>";
		echo "</tr>\n";
	}

?>
</table>
</body>
</html>