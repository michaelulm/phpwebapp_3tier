<?php
// PRESENTATION LAYER EXAMPLE

// we will include business layer to load business logic
include("business/" . DB_OBJECT . ".php");

// prepare form title
$formTitle = (isset($_GET["countryid"]) ? "Edit" : "Insert" ) . " Country";
// prepare checkbox for delete country
$deleteCheckbox = (isset($_GET["countryid"]) ? "<div class=\"row\"><div class=\"col-4\"><input type=\"checkbox\" name=\"countrydelete\" value=\"anyvalue\"> <small>(check to delete current country)</small></div></div>" : "" );

// initialize Country Model from Business Logic
$country = new Country();
// now load all cities
$data = $country->getAllCountries();

// load possible current country to edit countryname
$editValue = "";
if($_GET["countryid"]){
    $editValue = $country->getCountryName($_GET["countryid"]);
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
        foreach ($data as $country) {

            $url = "?";
            $urlParams["countryid"] = $country["countryid"];
            foreach ($urlParams as $key => $value) {
                $url .= "$key=$value&";
            }

            $html .= '<a class="list-group-item" href="' . $url . '"><i class="fa fa-pencil fa-fw" aria-hidden="true"></i> ' . $country['countryname'] . '</a>';
        }
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
        <div class="row">
            <div class="col-2">
                <input type="hidden" name="countryid" value="<?php echo isset($_GET["countryid"]) ? $_GET["countryid"] : "";?>" />
                Country:
            </div>

            <div class="col-2">
                <input type="text" name="countryname" placeholder="type in new countryname" <?php echo strlen($editValue) > 0 ? "value='$editValue'" : "";?> />
            </div>
        </div>
        <?php echo $deleteCheckbox; // only print if it's really needed ?>

        <br/><input type="submit" value="Submit"/>
    </form>