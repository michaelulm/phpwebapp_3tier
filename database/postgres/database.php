<?php
// DATABASE Connection
// TODO introduce Singleton

class DB{

	public function __construct() {}

	/**
	 * connects to the database and returns current reference of database connection
	 */
	public function connect() {    
		$dbConn = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DB_NAME." user=".DB_USER." password=".DB_PW);
		return $dbConn;
	}
}
