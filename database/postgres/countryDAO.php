<?php
// DATABASE LAYER EXAMPLE

// include database connection only once,
// it could be possible that the connection will be loaded at another DAO => include_ONCE
include_once "database.php";

// Database Layer for Country
class CountryDAO {
	private $connection = null;
	
	// Initializing the DB-Connection for the further CRUD-Operations
	public function __construct() {
		$db = new DB();
		$this->connection = $db->connect();
		
		if(! $this->connection) {
			die( 'ERROR while connecting' );
		}

        // better to prepare all needed statements at beginning, because we only need to define it once
        pg_prepare($this->connection, "country_insert", "INSERT INTO country (countryname) VALUES ($1);" );
        pg_prepare($this->connection, "country_select",  "SELECT * FROM country WHERE countryid = $1;" );
        pg_prepare($this->connection, "country_all", "SELECT * FROM country" );
        pg_prepare($this->connection, "country_update", "UPDATE country SET countryname=$1 WHERE countryid = $2;" );

    }
	
	/*
	 * Create a new Country with countryname
	 */
	public function createCountry($countryname) {
		// use of prepare connection to prevent SQL INJECTION
		pg_execute($this->connection, "country_insert", array($countryname));
	}
	
	/*
	 * Get all data of a Country by its name
	 */
	public function readCountry($countryid) {
		// use of prepare connection to prevent SQL INJECTION
		$result = pg_execute($this->connection, "country_select", array($countryid));

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
	 * Get all Countries in the Database
	 */
	public function readAll() {
		$result = pg_execute ($this->connection, "country_all", array() );
		
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
     * Update data of a Country, identified by its name.
     */
    public function updateCountry($countryid, $countryname) {
        $result = pg_execute( $this->connection, "country_update", array($countryname, $countryid));
    }

    /*
     * Deletes selected country
     */
    public function deleteCountry($countryid)
    {
        // 1. TODO FOR STUDENTS, Try To do a SQL INJECTION
        // 2. TODO FOR STUDENTS, improve this part of code to prevent SQL INJECTION
        $delete ="DELETE FROM country WHERE countryid = '$countryid'";
        $result = pg_query($delete);
    }
}
