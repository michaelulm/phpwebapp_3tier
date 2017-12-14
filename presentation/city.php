<?php
// PRESENTATION LAYER EXAMPLE

// we will include business layer to load business logic, prepared for easy copy paste
include("business/" . DB_OBJECT . ".php");

// manually include country object because of using country information for visualization
include("business/country.php");

// prepare form title
$formTitle = (isset($_GET["cityid"]) ? "Edit" : "Insert" ) . " City";
// prepare checkbox for delete city
$deleteCheckbox = (isset($_GET["cityid"]) ? "<div class=\"row\"><div class=\"col-4\"><input type=\"checkbox\" name=\"citydelete\" value=\"anyvalue\"> <small>(check to delete current city)</small></div></div>" : "" );

// initialize City Model from Business Logic
$city = new City();
// now load all cities
$data = $city->getAllCities();


// initialize Country Model from Business Logic
$country = new Country();
// now load all cities
$dataCountry = $country->getAllCountries();

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

    if(count($data) > 0) {
        // iterate over all current stored cities, we get data from Model, see above
        foreach ($data as $city) {

            $url = "?";
            $urlParams["cityid"] = $city["cityid"];
            foreach ($urlParams as $key => $value) {
                $url .= "$key=$value&";
            }

            $html .= '<a class="list-group-item" href="' . $url . '"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> ' . $city['cityname'] . '</a>';
        }
    }

    $html .= '</div>';

    return $html;
}

// prepare HTML DropDown
// TODO prepare "Module" / "Element" for easier integration to other views
function getCountryDropDown( $data, $countryid ){

    $html = "<div class=\"row\">
                <div class=\"col-2\">";
    $html .="Country: ";
    $html .= "   </div>
                <div class=\"col-2\">";
    $html .="<select name=\"countryid\">";
    foreach($data as $country){
        $selected = "";
        // is the same country
        if($country["countryid"] == $countryid)
            $selected = "selected"; // we mark this value to be selected for output
        // prepare options
        $html .="<option $selected value='{$country["countryid"]}'>{$country["countryname"]}</option>";
    }
    $html .="</select>";
    $html .= "   </div>
              </div>";

    return $html;
}

// the follow HTML Script has only a few php calls, benefit => clear structure, easy to read
?>

    <h2>List of all cities</h2>
    <?php echo getHTMLOutput($data); ?><br />

    <h2><?php echo $formTitle;?></h2>
    <form method="post" >
        <div class="row">
            <div class="col-2">
                <input type="hidden" name="cityid" value="<?php echo isset($_GET["cityid"]) ? $_GET["cityid"] : "";?>" />
                City:
            </div>
            <div class="col-2">
                <input type="text" name="cityname" placeholder="type in new cityname" <?php echo strlen($editValue) > 0 ? "value='$editValue'" : "";?> />
            </div>
        </div>
        <?php echo getCountryDropDown($dataCountry, isset($_GET["cityid"]) ? $city->getCountryId($_GET["cityid"]) : 0); ?>

        <?php echo $deleteCheckbox; // only print if it's really needed ?>
            </div>
        </div>
        <br/><input type="submit" value="Submit"/>
    </form>