<?php
	// includes standard configuration about DB and DB Handler
	include_once("configuration.php");

	// get required view otherwise define standard view, e.g. city 
	define('DB_OBJECT', isset($_GET["view"]) ? $_GET["view"] : "city");

	// dynamic include of required presentation and followed 3-tier-architecture
	include("presentation/" . DB_OBJECT . ".php");
	
	
	/*****************************************************************************
		Information for students of Internettechnik (3th semester, Database Applications)
		
		this example is an extended 3-tier-architecture example which is based on the example of the basic course example
		
		FOLDER STRUCTURE:
		/business		=> BUSINESS LAYER FILES
		/database		=> DATABASE LAYER FILES and general Database Handler 
		  /mysql 		=> DB Layer for MySQL Usage
		  /postgres		=> DB Layer for Postgres Usage
		/presentation	=> PRESENTATION LAYER FILES 
		
		NAMING CONVENTION, for dynamic includes
		object.php		=> for Presentation and Business Layer Files 
		objectDAO.php	=> Database Access Object File 
		
		
		TODO:
		- Use of php autoload
		- second example, e.g. country
		- define some helper files, e.g. general getHTMLTable Method
		- extend city example with more columns
		- OOP with abstract base class
		- add singleton at database connection handling
		- postgres error handling
		- include update
		- include delete
		
	*****************************************************************************/