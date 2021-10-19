<!DOCTYPE html PUBLIC 
"-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"> 
  <head>
<?php
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: September 12, 2021
 * 
 * @Modified:   October 10th 2021 - re:messaging
 *              October 18th 2021 - Re: favicon 
 */

    ob_start();
    session_start();
    require "./includes/constants.php";
    require "./includes/db.php";
    require "./includes/functions.php";

    $message = flashMessage();
?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="<?php echo $description ?>">
    <meta name="author" content="<?php echo $author ?>">
    <!-- Favicon scripts -->
    <link rel="apple-touch-icon" sizes="180x180" href="./images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon-16x16.png">
    <link rel="manifest" href="./images/site.webmanifest">
    <link rel="mask-icon" href="./images/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="./images/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="./images/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <title> <?php echo $title ?> </title>

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">
    <link href="./css/_alert.scss" rel="stylesheet">
    <link href="./css/_utilities.scss" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="./css/styles.css" rel="stylesheet">
	

  </head>
  <body>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php"><object style="opacity:0.5; z-index:-2;" data="./images/cpu.svg" width="25" height="25"> </object>WEBD 3201</a>
        <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <?php if(isset($_SESSION['user']))
                    {
                        echo '<a class="nav-link" href="logout.php">Sign out</a>';
                    }
                    else
                    {
                        echo '<a class="nav-link" href="sign-in.php">Sign in</a>';
                    }
                    ?>
        </li>
        </ul>
    </nav>
    <div class="container-fluid">
      <div class="row">
        
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
            <ul class="nav flex-column">
                <li class="nav-item">

                <?php
                 if(isset($_SESSION['user']))
                 {

                     echo '<a class="nav-link active" href="dashboard.php">
                        <span data-feather="home"></span>
                        Dashboard <span class="sr-only">(current)</span>
                        </a>';
                 }
                 else
                 {
                    echo '<a class="nav-link active" href="sign-in.php">
                    <span data-feather="home"></span>
                    Sign-In <span class="sr-only">(current)</span>
                    </a>';
                 }
                ?>
                </li>
                <li class="nav-item">
                <?php
                if(isset($_SESSION['user']['type'])&&($_SESSION['type']==ADMIN))
                {

                    echo '<a class="nav-link active" href="salespeople.php">
                        <span data-feather="home"></span>
                        Salespeople Registration <span class="sr-only">(current)</span>
                        </a>';
                }
                ?>
                </li>   
                <li class="nav-item">
                <?php
                if(isset($_SESSION['user']['type'])&&($_SESSION['type']==ADMIN))
                {

                    echo '<a class="nav-link active" href="clients.php">
                        <span data-feather="home"></span>
                        Clients Registration <span class="sr-only">(current)</span>
                        </a>';
                }
                ?>
                </li>   
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file"></span>
                    Orders
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="shopping-cart"></span>
                    Products
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="users"></span>
                    Customers
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="bar-chart-2"></span>
                    Reports
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="layers"></span>
                    Integrations
                </a>
                </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Saved reports</span>
                <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Current month
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Last quarter
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Social engagement
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="#">
                    <span data-feather="file-text"></span>
                    Year-end sale
                </a>
                </li>
            </ul>
            </div>
        </nav>

        <main class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4 bg-transparent ">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 bg-transparent text-dark ">