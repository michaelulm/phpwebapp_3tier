<?php
// BUSINESS LAYER EXAMPLE

// include database layer of current object
//include("database/" . DB_HANDLER . "/" . DB_OBJECT . "DAO.php"); // TODO Bugfix at using multiple objects in one view
include("database/" . DB_HANDLER . "/cityDAO.php"); // not possible to use Constant for current session

// City Model
class City {
	private $cityDAO = null;
	
	/**
	 * init variables and call necessary methods at initialization of object
	 */
	public function __construct() {
		$this->cityDAO = new CityDAO();
		
		// insert new city if post data exists
		// should be in business logic, and not in presentation,
		// because we decide here what methods will be called
		if(isset($_POST["cityname"]) && $_POST["cityname"]){
            $destination = "index.php?view=city";

		    // decide to modify or to insert a new city
		    if(isset($_POST["cityid"])
                //&& is_numeric($_POST["cityid"]) // TODO REACTIVATE this line after SQL Injection Test
                && ($_POST["cityid"] > 0
                || $_POST["cityid"] != "" // TODO REMOVE this line after SQL Injection Test
                )
                ){ //
		        // now check, if user decided to delete a city
                if(isset($_POST['citydelete'])){
                    $this->deleteCity($_POST["cityid"]);
                }
                else {
                    $this->updateCity($_POST["cityid"], $_POST["cityname"], $_POST["countryid"]);
                }
            }
            else{
                $this->createCity($_POST["cityname"], $_POST["countryid"]);
            }

            header("Location: $destination");
            die();
        }
	}
	
	/**
	 * returns prepared array of all cities existing in the database
	 */
	public function getAllCities() {
		$data = $this->cityDAO->readAll();
		return $data;
	}

	/**
	 * returns prepared cityname of city item
	 */
	public function getCityName($cityid) {
		$data = $this->cityDAO->readCity($cityid);
		return $data["cityname"];
	}

	public function getCountryId($cityid){
        $data = $this->cityDAO->readCity($cityid);
        return $data["countryid"];
    }
	
	/**
	 * creates a new city, called by constructor if request was sent
	 */
	public function createCity($cityname, $countryid) {
		$data = $this->cityDAO->createCity($cityname, $countryid);
		return $data;
	}

	/**
	 * modifies an existing city, called by constructor if request was sent
	 */
	public function updateCity($cityid, $cityname, $countryid) {
		$data = $this->cityDAO->updateCity($cityid, $cityname, $countryid);
		return $data;
	}

	/**
	 * deletes an existing city, called by constructor if request was sent
	 */
	public function deleteCity($cityid) {
		$data = $this->cityDAO->deleteCity($cityid);
		return $data;
	}
}