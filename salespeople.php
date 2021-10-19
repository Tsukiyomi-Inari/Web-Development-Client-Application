<?php 
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date:       October 6th, 2021
 *
 * @Modified:   October 10th - 18th - Lab 2 requirements
 */

$title = "WEBD3201 Sales People Registration";
$author = "bellmank";
$description = "Sales People Registration page for WEBD3201 course project";

include "./includes/header.php";

if(!(isset($_SESSION['user']['type'])&&($_SESSION['user']['type']==ADMIN))){
    redirect("sign-in.php");
}

$error ="";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $email_address = "";
    $fName = "";
    $lName = "";
    $password = "";
    $password2 = "";

}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    $fName = trim($_POST["inputFName"]);
    $lName = trim($_POST["inputLName"]);
    $email_address = trim($_POST["inputEmail"]);
    $password = trim($_POST["inputPassword"]);
    $password2 = trim($_POST["confirmPassword"]);
    //validate first name
    if(!isset($fName) || $fName == ""){
        $error .= "You must enter your first name.<br/>";
    }
    //validate last name
    if(!isset($lName) || $lName == ""){
        $error .= "You must enter your last name.<br/>";
    }
    if(!isset($email_address) || $email_address == ""){
        $error .= "You must enter your e-mail.<br/>";
    }
    elseif(!(filter_var($email_address, FILTER_VALIDATE_EMAIL))){
        $error .= "<em>".$email_address."</em> is not a valid e-mail address.<br/>";
        $email_address = "";
    }
    elseif(user_exists($email_address)){
        $error .= "<em>(".$email_address.")</em> alredy exists. <br/>";
        $email_address = "";
    }
    if(!isset($password) || $password == "" || !isset($password2) || $password2 == ""){
        $error .="You must enter a password. <br/>";
        
    }
    elseif(strcmp($password, $password2) == 1){
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
        insert_user($email_address, $password, $fName, $lName, date('Y-m-d G:i:s'));
        setMessage('<div style="text-align: center;" class="alert alert-success" role="alert">You succesfully registered<br/> the sales person</div>') ;
    }

    if(isset($_SESSION['message'])){
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

?>



    <?php 
    echo $message; 
    //salesperson = user
    $form_salesperson = array( //outter array
                                array(//inner array [0]
                                    "type" => "text",
                                    "name" => "first_name",
                                    "value" => "",
                                    "label" => "First Name",
                                ),
                                array(//inner array [1]
                                    "type" => "text",
                                    "name" => "last_name",
                                    "value" => "",
                                    "label" => "Last Name",
                                ),
                                array(//inner array [2]
                                    "type" => "email",
                                    "name" => "email",
                                    "value" => "",
                                    "label" => "Email",
                                ),
                                array(//inner array [3]
                                    "type" => "password",
                                    "name" => "password",
                                    "value" => "",
                                    "label" => "Password",
                                ),
                                array(//inner array [4]
                                    "type" => "password",
                                    "name" => "password2",
                                    "value" => "",
                                    "label" => "Confirm Password",
                                )
                            );

    display_form($form_salesperson);

    ?>

                    
                     
<?php
include "./includes/footer.php";
?>