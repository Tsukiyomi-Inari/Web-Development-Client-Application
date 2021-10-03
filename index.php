<?php
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: September 12, 2021
 * 
 */

$title = "WEBD3201 Home Page";
$author = "bellmank";
$description = "Main landing page for WEBD3201 course project";

include "./includes/header.php";


//are they logged in?
/*                                                         
if ((! isset($_SESSION['token'])) || ($_POST['token'] != $_SESSION['token']))
{
    
    redirect("./sign-in.php");
    ob_flush();
} else {
/* Continue.   confirm same user????
}*/
?> 


<?php $message; ?> 
 <h1 class="cover-heading "><object style="opacity:0.5;" data="./images/cpu.svg" width="80" height="80"> </object>WEBD 3201</h1>
<p class="lead ">Course project for Computer Programming and Analysis (CPA) at Durham College. Study focus is on PHP,
                 PostgreSQL, java script and creating a user interface through session. </p>
<p class="lead">
    <a href="https://durhamcollege.ca/programs/computer-programming-analyst-three-year" class="btn btn-lg btn-secondary">Learn more </a>
</p>


<?php
include "./includes/footer.php";
?>    