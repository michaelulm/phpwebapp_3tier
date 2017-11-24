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
	}
	
	/*
	 * Create a new City with cityname
	 */
	public function createCity($cityname) {
		
		// use of prepare connection to prevent SQL INJECTION
		pg_prepare($this->connection, "my_insert", "INSERT INTO city (cityname) VALUES ($1);" );
		pg_execute($this->connection, "my_insert", array($cityname));
	}
	
	/*
	 * Get all data of a City by its name
	 */
	public function readCity($cityid) {
		// use of prepare connection to prevent SQL INJECTION
		pg_prepare($this->connection, "my_select",  "SELECT * FROM city WHERE cityid = $1;" );
		$result = pg_execute($this->connection, "my_select", array($cityid));

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
		$query = "SELECT * FROM city";
		$result = pg_prepare ($this->connection, "select_all", $query );
		$result = pg_execute ($this->connection, "select_all", array() );
		
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
    public function updateCity($cityid, $cityname) {
		$stmt   = pg_prepare( $this->connection, "my_update", "UPDATE city SET cityname=$1 WHERE cityid = $2;" );
        $result = pg_execute( $this->connection, "my_update", array($cityname, $cityid));
    }

    /*
     * Deletes selected city
     */
    public function deleteCity($cityid)
    {

        // TODO FOR STUDENTS, Try To do a SQL INJECTION
        $delete ="DELETE FROM city WHERE cityid = '$cityid'";
        $result = pg_query($delete);
    }
}
