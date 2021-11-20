<?php
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: September 30, 2021
 * 
 */

$title = "WEBD3201 Sign-In";
$author = "bellmank";
$description = "Sign-in page for WEBD3201 course project";

include "./includes/header.php";

if(isset($_SESSION['message'])){
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
if(isset($_SESSION['user'])){
    redirect("dashboard.php");
}

if($_SERVER['REQUEST_METHOD']=="POST"){
    $email_address = trim($_POST['inputEmail']);
    $password = trim($_POST['inputPassword']);

    $today = date('Ymd');
    $now = date('Y-m-d G:i:s');

    $handle =fopen("./logs/".$today."_log.txt",'a');


    //determine if sucessfully signed in
    if(user_authenticate($email_address, $password))
    {
        //var_dump(user_update_login_time($email_address));
        fwrite($handle, "Sign in  at [".$now."] by user [".$email_address."] success.\n");

        //message for if successful, that includes welcome message from variable
        
        sign_in_msg();
        //setMessage($sign_in);
        $message = getMessage();
        user_update_login_time($email_address);
        redirect("./dashboard.php");
         
    }
    else{
        fwrite($handle, "Sign in attempt at [".$now."] by user [".$email_address."] fail.\n");
        global $sign_in_fail ;
        setMessage($sign_in_fail);
        $message = getMessage();
        unset($_SESSION['message']);
    }
    
    fclose($handle);
    
}

?>   



<form class="form-signin" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <?php echo $message ?>
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="inputEmail" id="inputEmail" class="form-control focus" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="inputPassword" id="inputPassword" class="form-control focus" placeholder="Password" required>
    <button class="btn btn-lg btn-dark btn-block" type="submit">Sign in</button>
</form>

<?php
include "./includes/footer.php";
?>    