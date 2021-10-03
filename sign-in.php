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



if($_SERVER['REQUEST_METHOD']=="POST"){
    $email_address = trim($_POST['inputEmail']);
    $password = trim($_POST['inputPassword']);

    $today = date('Ymd');
    $now = date('Y-m-d G:i:s');

    $handle =fopen("./logs/".$today."_log.txt",'a');


    //determine if sucessfully signed in
    if(user_authenticate($email_address, $password))
    {
        //message for if successful
        $sign_in = '<div class="alert alert-success" role="alert">You sucessfully signed in.</div>';
        setMessage($sign_in);
        redirect("./dashboard.php");
        fwrite($handle, "Sign in  at [".$now."] by user [".$email_address."] success.\n");
         
    }
    else{
        $sign_in_fail ='<div class="alert alert-warning" role="alert"> Login unsucessful </div>';
        setMessage($sign_in_fail);
        
        fwrite($handle, "Sign in attempt at [".$now."] by user [".$email_address."] fail.\n");
        redirect("./sign-in.php");

    }

    fclose($handle);
}



?>   



<form class="form-signin" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
    <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
    <?php echo $message ?>
    <label for="inputEmail" class="sr-only">Email address</label>
    <input type="email" name="inputEmail" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
</form>

<?php
include "./includes/footer.php";
?>    