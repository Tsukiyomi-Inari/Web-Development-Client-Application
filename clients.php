         <?php
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: October 12, 2021
 * 
 */
?>

<?php
$title = "WEBD3201 Clients";
$author = "bellmank";
$description = "Clients page for WEBD3201 course project";

include "./includes/header.php";
//var_dump($_SESSION['user']);
//var_dump($user);
//var_dump( getMessage());
if(!isset($_SESSION['user']))
{
    redirect("sign-in.php");
}
else{
    $login_victory = "Welcome back, ".$_SESSION['first_name']." you last logged in ".$_SESSION['last_access'];
    setMessage($login_victory);
}
?>   


<?php
include "./includes/footer.php";
?>    