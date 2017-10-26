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

<form method="post" action="index.php" name="insert">  
  Color: <input type="text" name="color_name" >

  <br><br>
  Hex: <input type="text" name="color_hex">
 
  <br><br>
  <input type="submit">  
</form>

<?php

// DATABASE FUNCTIONS
// function getDb() {
//         $db = pg_connect("host=localhost port=5432 dbname=colorpicker user=coloruser password=colorcolorcolor");
  
//         return $db;
//     }
// 	//Make a request.
// 	function getInventory() {
// 	    $request = pg_query(getDb(), "
// 	        SELECT *
// 	        FROM colors	        
// 	    ");
// 	    // Return a fetch to use the data.
// 	    return pg_fetch_all($request);
// 	}

	if ($_POST['submit']) {
		
		$db = pg_connect("host=localhost port=5432 dbname=colorpicker user=coloruser password=colorcolorcolor");


    	if (!$db) {

        	die("Error in connection: " . pg_last_error());	
        }

        $color_name = pg_escape_string($_POST['color_name']);

        $color_hex = pg_escape_string($_POST['color_hex'])
	
		//$stuff = "INSERT INTO colors (color_name, color_hex) VALUES ('$color_name', '$color_hex');";

		$result = pg_query($db, "INSERT INTO 'colors' ('color_name', 'color_hex') VALUES ('$color_name', '$color_hex');");
	
		if (!$result) {
			 die("Error in SQL query: " . pg_last_error());
		}
		 echo "Data successfully inserted!";

		 pg_free_result($result);

		 pg_close($db);
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