<?php
// PRESENTATION LAYER EXAMPLE

// we will include business layer to load business logic
include("business/" . DB_OBJECT . ".php");

// initialize City Model from Business Logic
$city = new City();
// now load all cities
$data = $city->getAllCities();

// prepare HTML Table, and create HTML Table Structure
function getHTMLTable($tabledata) {
  $html = '<table id="citiestable">';
  $html .= '<thead><tr>';
  $html .= '<th>name</th>';
  $html .= '</tr></thead>';

  foreach($tabledata as $city) {
    $html .= '<tbody><tr>';
    $html .= '<td>' . $city['cityname'] . '</td>';
    // $html .= '<td>' . $city['major'] . '</td>'; // TODO: Extend example with other city information and extend city table
    $html .= '</tr></tbody>';
  }

  $html .= '</table>';

  return $html;
}

// the follow HTML Script has only a few php calls, benefit => clear structure, easy to read
?>
<html>
 <head> 
   <title>Cities</title>
 </head>
 <body>
 
 
 <h2>List of all cities</h2>
 <?php echo getHTMLTable($data); ?><br />
 
 <h2>Insert new City</h2>
 <form method="post" >
   <input type="text" name="cityname" placeholder="type in new cityname" />
	<input type="submit" value="Submit"/>
 </form>
 </body>
</html>