<?php
// BUSINESS LAYER EXAMPLE

// include database layer of current object
include("database/" . DB_HANDLER . "/" . DB_OBJECT . "DAO.php");

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
			$this->createCity($_POST["cityname"]);
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
	 * creates a new city, called by constructor if request was sent
	 */
	public function createCity($cityname) {
		$data = $this->cityDAO->create($cityname);
		return $data;
	}
}