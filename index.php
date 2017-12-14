<?php
	// includes standard configuration about DB and DB Handler
	include_once("configuration.php");

    if(isset($_GET["view"])){
        // get required view otherwise define standard view, e.g. city
        // TODO create FALLBACK mechanism
        // TODO improve this handling -> because at using multiple models in view this doesn't so well
        define('DB_OBJECT', isset($_GET["view"]) ? $_GET["view"] : "FALLBACK");
    }

    include("template/header.php");
    if(isset($_GET["view"])) {
        // dynamic include of required presentation and followed 3-tier-architecture
        include("presentation/" . DB_OBJECT . ".php");
    }
    include("template/footer.php");


/*****************************************************************************
		Information for students of Internettechnik (3th semester, Database Applications)
		
		this example is an extended 3-tier-architecture example which is based on the example of the basic course example
		
		FOLDER STRUCTURE:
		/business		=> BUSINESS LAYER FILES
		/database		=> DATABASE LAYER FILES and general Database Handler 
		  /mysql 		=> DB Layer for MySQL Usage
		  /postgres		=> DB Layer for Postgres Usage
		/presentation	=> PRESENTATION LAYER FILES
        /template       => TEMPLATE FILES
          /bootstrap    => Bootstrap Version 4 Beta
          /css          => own CSS Files
		
		NAMING CONVENTION, for dynamic includes
		object.php		=> for Presentation and Business Layer Files 
		objectDAO.php	=> Database Access Object File 
		
		TODO in Class:
		- second example, e.g. country
		- extend city example with more columns
		
		TODO:
		- Use of php autoload
		- define some helper files, e.g. general getHTMLTable Method
        - simplify building html elements
		- OOP with abstract base class
		- add singleton at database connection handling
		- postgres error handling
		
	*****************************************************************************/