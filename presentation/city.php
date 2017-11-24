<?php
// PRESENTATION LAYER EXAMPLE

// we will include business layer to load business logic
include("business/" . DB_OBJECT . ".php");

// prepare form title
$formTitle = (isset($_GET["cityid"]) ? "Edit" : "Insert" ) . " City";

// initialize City Model from Business Logic
$city = new City();

// now load all cities
$data = $city->getAllCities();

// load possible current city to edit cityname
$editValue = "";
if($_GET["cityid"]){
    $editValue = $city->getCityName($_GET["cityid"]);
}


// prepare HTML Output
function getHTMLOutput( $data ) {
    $html = "";
    $html .= '<div class="list-group">';

    $urlParams = array();
    foreach($_GET as $key => $value) {
        $urlParams[$key] = $value;
    }

    foreach($data as $city) {

        $url = "?";
        $urlParams["cityid"] = $city["cityid"];
        foreach($urlParams as $key => $value) {
            $url .= "$key=$value&";
        }

        $html .= '
					<a class="list-group-item" href="'.$url.'"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> '.$city['cityname'].'</a>
                    ';
    }

    $html .= '</div>';

    return $html;
}

// the follow HTML Script has only a few php calls, benefit => clear structure, easy to read
 ?>


    <h2>List of all cities</h2>
    <?php echo getHTMLOutput($data); ?><br />

    <h2><?php echo $formTitle;?></h2>
    <form method="post" >
        <input type="hidden" name="cityid" value="<?php echo isset($_GET["cityid"]) ? $_GET["cityid"] : "";?>" />
        <input type="text" name="cityname" placeholder="type in new cityname" <?php echo strlen($editValue) > 0 ? "value='$editValue'" : "";?> />
        <input type="checkbox" name="citydelete" value="anyvalue">
        <input type="submit" value="Submit"/>
    </form>