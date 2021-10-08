<?php 
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: October 6th, 2021
 * 
 */

$title = "WEBD3201 Sales People Registration";
$author = "bellmank";
$description = "Sales People Registration page for WEBD3201 course project";

include "./includes/header.php";
$error ="";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $email_address = "";
    $fName = "";
    $lName = "";
    $password = "";
    $password2 = "";

}else if($_SERVER["REQUEST_METHOD"] == "POST"){
    $fName = trim($_POST["inputFName"]);
    $lName = trim($_POST["inputLName"]);
    $email_address = trim($_POST["inputEmail"]);
    $password = trim($_POST["inputPassword"]);
    $password2 = trim($_POST["confirmPassword"]);
    //validate first name
    if(!isset($fName) || $fName == ""){
        $error .= "error message";
    }
    //validate last name
    if(!isset($lName) || $lName == ""){
        $error .= "error message";
    }
    if(!isset($email_address) || $email_address == ""){
        $error .= "error message";
    }
    elseif(!(filter_var($email_address, FILTER_VALIDATE_EMAIL))){
        $error .= " error message";
        $email_address = "";
    }
    /* elseif(user_exists($email_address)){
        $error .= "error message";
        $email_address = "";
    } */
    if(!isset($password) || $password == "" || !isset($password2) || $password2 == ""){
        $error .="message";
        
    }
    elseif(strcmp($password, $password2) == 0){
        $error = "";
    }
    if($error !=""){
        $error .= "Try again";
        setMessage($error);
    }
    if(){
        
    }
}

?>



<form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <?php echo $message ?>

    <label for="inputFName" class="sr-only">First Name</label>
    <input type="text" name="inputFName" id="inputFName" value="<?php echo $fName?>"class="form-control" placeholder="First Name" required autofocus>
    <label for="inputLName" class="sr-only">Last Name</label>
    <input type="text" name="inputLName" id="inputLName" value="<?php echo $lName?>" class="form-control" placeholder="Last Name" required autofocus>
    
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="inputEmail" id="inputEmail" value="<?php echo $email_address?>" class="form-control" placeholder="Email address" required autofocus>

    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
    <label for="confirmPassword" class="sr-only">Reenter Password</label>
    <input type="password" name="confirmPassword" id="confirmPassword" class="form-control" placeholder="Re-enter Password" required>
   
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
    <button class="btn btn-lg btn-primary btn-block" type="reset">Clear</button>
</form>

                    
                     
<?php
include "./includes/footer.php";
?>