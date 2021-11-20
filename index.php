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


?> 


<?php $message; ?>
<div>
 <h1 class="cover-heading"><object style="opacity:0.5;" data="./images/cpu.svg" width="80" height="80"> </object><br/><strong>WEBD <br/> 3201</strong></h1>

<p class="lead index-p ">&nbsp;&nbsp;Course project for Computer Programming and Analysis (CPA) at Durham College. Study focus is on PHP,
                 PostgreSQL, java script and creating a user interface through session. <a href="https://durhamcollege.ca/programs/computer-programming-analyst-three-year" class="btn btn-sm btn-secondary">Learn more </a>
</p><p class="justify-content-center">
  <?php
   if(isset($_SESSION['user'])){
       echo  '<a href="logout.php" class="btn btn-lg btn-dark">Log out</a>';
   }
   else{
       echo  '<a href="sign-in.php" class="btn btn-lg btn-dark">Sign-in</a>';
   }
    ?>
</p>
</div>


<?php
include "./includes/footer.php";
?>    