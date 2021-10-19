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

?>   

<?php 
    echo $message; 
    //Client form array
    $form_client = array( //outter array
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
                                "type" => "number",
                                "name" => "phone_number",
                                "value" => "",
                                "label" => "Phone Number",
                            ),
                            array(//inner array [3]
                                "type" => "number",
                                "name" => "extension",
                                "value" => "",
                                "label" => "Extension",
                            ),
                            array(//inner array [4]
                                "type" => "email",
                                "name" => "email",
                                "value" => "",
                                "label" => "Email",
                            )
                        );


    display_form($form_client);

    ?>

<?php
include "./includes/footer.php";
?>    