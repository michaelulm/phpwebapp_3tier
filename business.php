<?php
// Business Layer

// now include database layer
include("database.php");

// City Model
class City {
	private $cityDAO = null;
	
	public function __construct() {
		$this->cityDAO = new CityDAO();
	}
	public function getAllCities() {
		$data = $this->cityDAO->readAll();
		return $data;
	}
	public function createCity($cityname) {
		$data = $this->cityDAO->create($cityname);
		return $data;
	}

}