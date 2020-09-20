<?php
include('env.php');
include('Class/Xml.php');
$filename = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
?>
<!doctype html>
<html>
    <head>
        <title>PHP CRUD Operations using XML</title>
        <link rel="stylesheet" href="<?php echo CSS_FILE_PATH;?>/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="<?php echo JS_FILE_PATH; ?>/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo JS_FILE_PATH; ?>/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-3">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse">
            <a class="navbar-brand" href="index.php">Home</a>
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item <?php echo ($filename == 'manage_employees.php') ? 'active' : ''; ?>">
                    <a class="nav-link" href="index.php">Employees</a>
                </li>
            </ul>
        </div>
    </nav>    
