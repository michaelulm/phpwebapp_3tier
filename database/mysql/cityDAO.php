<?php
// include database connection only once,
// it could be possible that the connection will be loaded at another DAO
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
		$stmt = $this->connection->prepare( "INSERT INTO city (cityname) VALUES (?);" );
		$stmt->bind_param( 's', $cityname );
		if ($stmt->execute()) {
			echo "Insert complete";
			return 1;
		} else {
			echo "City-Create-ERROR: INSERT STATEMENT<br>" . mysqli_error ( $this->connection );
			return - 1;
		}
	}
	
	/*
	 * Get all informations of a City by its name
	 */
	public function readCity($cityname) {
		$stmt = $this->connection->prepare( "SELECT * FROM person WHERE cityname = ?;" );
		$stmt->bind_param( 's', $cityname );
		
		if ($stmt->execute ()) {
			$stmt->bind_result( $cityname);
			while ( $stmt->fetch() ) {
				$row['cityname'] = $cityname;
			}
			return $row;
		} else {
			echo "0 results";
			return - 1;
		}
	}
	
	/*
	 * Get all Cities in the Database
	 */
	public function readAllCities() {
		$select = "SELECT * FROM city;";
		if ($this->connection == null) {
			echo "Connection not initialized!";
		} else if ($result = mysqli_query ( $this->connection, $select )) {
			$items = null;
			if (mysqli_num_rows ( $result ) > 0) {
				while ( $row = mysqli_fetch_assoc ( $result ) ) {
					$items [] = $row;
				}
				return $items;
			} else {
				echo "</br>0 results";
			}
		} else {
			echo "Resultset leer/nicht definiert!";
		}
	}
	
}
