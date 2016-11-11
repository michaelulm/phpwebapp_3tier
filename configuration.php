<?php

	// simple configuration file for currently easier modifing db configs

	// defines current db handler, could be replaced with mysql
	define( "DB_HANDLER", "postgres" );
	// TODO currently not tested with mysql
	// $dbHandler = "mysql";

	// define database constants
	define( "DB_HOST", 	"127.0.0.1" );
	define( "DB_NAME", 	"phptestg1" );
	define( "DB_PORT", 	"5432" );
	define( "DB_USER", 	"postgres" );
	define( "DB_PW", 	"postgres" );