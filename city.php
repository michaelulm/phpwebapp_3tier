<?php
// we now in presentation layer
// we will include business layer to load business logic
include("business.php");

// init City Model from Business Logic
$city = new City();

// insert new city if post data exists
if(isset($_POST["cityname"]) && $_POST["cityname"]){
	$city->createCity($_POST["cityname"]);
}

// now load all cities
$data = $city->getAllCities();

// prepare HTML Table
function getHTMLTable($tabledata) {
  $html = '<table id="citiestable">';
  $html .= '<thead><tr>';
  $html .= '<th>Stadtname</th>';
  $html .= '</tr></thead>';

  foreach($tabledata as $city) {
    $html .= '<tbody><tr>';
    $html .= '<td>' . $city['cityname'] . '</td>';
    $html .= '</tr></tbody>';
  }

  $html .= '</table>';

  return $html;
}

// now we can clearly output the requested data
?>
<html>
 <head> 
   <title>Städte</title>
 </head>
 <body>
 
 <form method="post" >
   neue Stadt: <input type="text" name="cityname" />
	<input type="submit" value="Submit"/>
 </form>
 
 <?php echo getHTMLTable($data); ?><br />
 
 </body>
</html>