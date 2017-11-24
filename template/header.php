<?php

    // https://stackoverflow.com/questions/3429262/get-base-directory-of-current-script
    define( "BASE_PATH", "http://" . $_SERVER[HTTP_HOST] . dirname($_SERVER['REQUEST_URI']));

    // integrated bootstrap starter template
    // https://getbootstrap.com/docs/4.0/examples/starter-template/

    // integrated fontawesome icons
    // http://fontawesome.io/

    // to create dynamic navigation menu
    $navItems["Home"]           = "home";
    $navItems["City"]           = "city";
    $navItems["Measurements"]   = "measurements";


    $headerTitle    = APP_NAME;
    $navBarItems    = "";
    // dynamic create navigation menu
    foreach($navItems as $key => $value){
        $isActive = "";
        if($value == DB_OBJECT) {
            $isActive       =  "active";
            $headerTitle    .= " $key";
        }

        $navigateTo = "";
        if(strlen($value) > 0)
            $navigateTo .= "?view=$value";

        $navBarItems .= "
                          <li class=\"nav-item $isActive\">
                            <a class=\"nav-link\" href=\"$navigateTo\">$key</a>
                          </li>
                          ";
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $headerTitle; ?></title>
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>/template/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>/template/css/starter-template.css">
    <link rel="stylesheet" href="<?php echo BASE_PATH;?>/template/fontawesome/css/font-awesome.css">
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#"><?php
            // display app name
            echo APP_NAME;?>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">

                <?php echo $navBarItems; ?>

            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" placeholder="Search" aria-label="Search" type="text">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <main role="main" class="container">