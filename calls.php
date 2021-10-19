         <?php
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: October 12 , 2021
 * 
 */
?>

<?php
$title = "WEBD3201 Calls";
$author = "bellmank";
$description = "Calls page for WEBD3201 course project";

include "./includes/header.php";
var_dump($_SESSION['name']($_SESSION['type']));
//var_dump($user);
//var_dump( getMessage());
if(!isset($_SESSION['user']))
{
    redirect("sign-in.php");
}

?>   

<?php 
    echo $message; 
    //calls array
    $form_calls = array( //outter array
                                array(//inner array [0]
                                    "type" => "text",
                                    "name" => "client_name",
                                    "value" => "",
                                    "label" => "Client Name",
                                ),
                                array(//inner array [1]
                                    "type" => "text",
                                    "name" => "call_time",
                                    "value" => "",
                                    "label" => "Call Time",
                                )
                            );

    display_form($form_calls);
    ?>


<?php
include "./includes/footer.php";
?>    