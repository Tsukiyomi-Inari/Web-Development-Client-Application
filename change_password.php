<?php
/*
* @author Katherine Bellman <katherine.bellman@dcmail.ca>
* @Student Id:100325825
* @course: WEBD3201
* @Date: September 12, 2021
*
*/


 ?>


<?php
$title = "WEBD3201 Clients";
$author = "bellmank";
$description = "Clients page for WEBD3201 course project";
$filename = basename(__FILE__, $_SERVER['PHP_SELF']) . "\n";

include "./includes/header.php";


if(!isset($_SESSION['user']))
{
    global $denied;
    setMessage($denied);
    redirect("sign-in.php");
}
else
{
    if(isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
}
// $message is echoed within the display_form function
display_form(
        array( //outter array
            array(//inner array [0]
                "type" => "password",
                "name" => "password",
                "value" => "",
                "label" => "New Password",
            ),
            array(//inner array [1]
                "type" => "password",
                "name" => "confirm",
                "value" => "",
                "label" => "Re-type password",
            ),
              array(//inner array [2]
              "type" => "submit",
              "name" => "",
              "value" => "",
             "label" => "Submit",
            ),
            array(//inner array [3]
             "type" => "reset",
             "name" => "",
            "value" => "",
             "label" => "Clear",
        )
    )
);

$error ="";
if($_SERVER["REQUEST_METHOD"] == "GET") {
 $password = "";
 $confirm = "";
}
elseif($_SERVER["REQUEST_METHOD"] == "POST") {
 $password = trim($_POST["password"]);
 $confirm = trim($_POST["confirm"]);
    if(isset($password) || !isset($confirm) || $confirm == ""){
     $error .="You must confirm your new password. <br/>";

    }
    elseif(strcmp($password, $confirm) == 1){
     $error .= "Submitted password and confirm password should be the same. <br/>";
    }
    if($error !=""){
     $error .= "<br/> <strong><em>Please Try Again</em></strong>";
     $error2 = '<div style="text-align: center;" class="alert alert-warning" role="alert"> '.$error.' </div>';
     setMessage($error2);
     $error = "";
     $error2 = "";
    }
    else{
     user_update_password($password);

    global $user_password_change;
     setMessage($user_password_change) ;
     $message = getMessage();
     redirect("./dashboard.php");
    }
}

?>
<?php
include "./includes/footer.php";
?>  