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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $colorErr = "Color is required";
  } else {
    $color_input = test_input($_POST["color_name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$color_input)) {
      $colorErr = "Only letters and white space allowed"; 
    }
  }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["hex_input"])) {
    $hexErr = "Hex is required";
  } else {
    $hex_input = test_input($_POST["color_hex"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z ]*$/",$hex_input)) {
      $hexErr = "Only letters and white space allowed"; 
    }
  }
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Color: <input type="text" name="Color" value="<?php echo $color_input;?>">
  <span class="error">* <?php echo $colorErr;?></span>
  <br><br>
  Hex: <input type="text" name="hex" value="<?php echo $hex_input;?>">
  <span class="error">* <?php echo $hexErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
function getDb() {
        $db = pg_connect("host=localhost port=5432 dbname=colorpicker user=coloruser password=colorcolorcolor");
  
        return $db;
    }
Make a request.
	function getInventory() {
	    $request = pg_query(getDb(), "
	        SELECT *
	        FROM colors	        
	    ");
	    // Return a fetch to use the data.
	    return pg_fetch_all($request);
	}
	   var_dump(getInventory());

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