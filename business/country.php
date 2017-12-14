<?php
// BUSINESS LAYER EXAMPLE

// include database layer of current object
//include("database/" . DB_HANDLER . "/" . DB_OBJECT . "DAO.php");
include("database/" . DB_HANDLER . "/countryDAO.php");

// Country Model
class Country {
	private $countryDAO = null;
	
	/**
	 * init variables and call necessary methods at initialization of object
	 */
	public function __construct() {
		$this->countryDAO = new CountryDAO();
		
		// insert new country if post data exists
		// should be in business logic, and not in presentation,
		// because we decide here what methods will be called
		if(isset($_POST["countryname"]) && $_POST["countryname"]){
            $destination = "index.php?view=country";

		    // decide to modify or to insert a new country
		    if(isset($_POST["countryid"])
                && is_numeric($_POST["countryid"])
                && $_POST["countryid"] > 0
                ){ //
		        // now check, if user decided to delete a country
                if(isset($_POST['countrydelete'])){
                    $this->deleteCountry($_POST["countryid"]);
                }
                else {
                    $this->updateCountry($_POST["countryid"], $_POST["countryname"]);
                }
            }
            else{
                $this->createCountry($_POST["countryname"]);
            }

            header("Location: $destination");
            die();
        }
	}
	
	/**
	 * returns prepared array of all countries existing in the database
	 */
	public function getAllCountries() {
		$data = $this->countryDAO->readAll();
		return $data;
	}

	/**
	 * returns prepared countryname of country item
	 */
	public function getCountryName($countryid) {
		$data = $this->countryDAO->readCountry($countryid);
		return $data["countryname"];
	}
	
	/**
	 * creates a new country, called by constructor if request was sent
	 */
	public function createCountry($countryname) {
		$data = $this->countryDAO->createCountry($countryname);
		return $data;
	}

	/**
	 * modifies an existing country, called by constructor if request was sent
	 */
	public function updateCountry($countryid, $countryname) {
		$data = $this->countryDAO->updateCountry($countryid, $countryname);
		return $data;
	}

	/**
	 * deletes an existing country, called by constructor if request was sent
	 */
	public function deleteCountry($countryid) {
		$data = $this->countryDAO->deleteCountry($countryid);
		return $data;
	}
}