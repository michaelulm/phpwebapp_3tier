<?php
// DATABASE LAYER EXAMPLE

// include database connection only once,
// it could be possible that the connection will be loaded at another DAO => include_ONCE
include_once "database.php";

// Database Layer for City
class CityDAO {
	private $connection = null;
	
	// Initializing the DB-Connection for the further CRUD-Operations
	public function __construct() {
		$db = new DB();
		$this->connection = $db->connect();

        if(! $this->connection) {
			die( 'ERROR while connecting' );
		}

        // better to prepare all needed statements at beginning, because we only need to define it once
        pg_prepare($this->connection, "city_insert", "INSERT INTO city (cityname, countryid) VALUES ($1, $2);" );
        pg_prepare($this->connection, "city_select",  "SELECT * FROM city WHERE cityid = $1;" );
        pg_prepare($this->connection, "city_all", "SELECT * FROM city" );
        pg_prepare($this->connection, "city_update", "UPDATE city SET cityname=$1, countryid=$2 WHERE cityid = $3;" );
    }
	
	/*
	 * Create a new City with cityname
	 */
	public function createCity($cityname, $countryid) {
		
		// use of prepare connection to prevent SQL INJECTION
		pg_execute($this->connection, "city_insert", array($cityname, $countryid));
	}
	
	/*
	 * Get all data of a City by its name
	 */
	public function readCity($cityid) {
		// use of prepare connection to prevent SQL INJECTION
		$result = pg_execute($this->connection, "city_select", array($cityid));

		$toFetch = true;
		while($toFetch){
			$item = pg_fetch_array($result);
			if($item == null)
				$toFetch = false;
			else
				return $item;
		}
	}
	
	/*
	 * Get all Cities in the Database
	 */
	public function readAll() {
		$result = pg_execute ($this->connection, "city_all", array() );
		
		// handling data from result
		$toFetch = true;
		
		while($toFetch){
			$item = pg_fetch_array($result);
			
			if($item == null)
				$toFetch = false;
			else
				$items[] = $item;
		}
		return $items;
	}

    /*
     * Update data of a City, identified by its name.
     */
    public function updateCity($cityid, $cityname, $countryid) {
        $result = pg_execute( $this->connection, "city_update", array($cityname, $countryid, $cityid));
    }

    /*
     * Deletes selected city
     */
    public function deleteCity($cityid)
    {
        // 1. TODO FOR STUDENTS, Try To do a SQL INJECTION
        // 2. TODO FOR STUDENTS, improve this part of code to prevent SQL INJECTION
        $delete ="DELETE FROM city WHERE cityid = '$cityid'";
        $result = pg_query($delete);
    }
}
