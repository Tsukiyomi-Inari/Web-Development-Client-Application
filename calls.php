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


//var_dump( getMessage());
if(!(isset($_SESSION['type'])&&($_SESSION['type']==AGENT)))
{
    $shall_not_pass = '<div style="text-align: center;" class="alert alert-warning" role="alert">You do not have access to that page. Error: Incorrect User Type Found </div>';
    $_SESSION['message'] = setMessage($shall_not_pass);
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
    redirect("sign-in.php");
}
 

$error ="";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $date_time = date('Y-m-d G:i:s');
    $call_note = "";

}elseif($_SERVER["REQUEST_METHOD"] == "POST"){
    $date_time = trim($_POST["call_time"]);
    $call_note = trim($_POST["call_note"]);
    $client = $_POST['client_name'];
    if(isset($client) && $client==-1){
        $error .= "You must select your client.<br/>";
	}
    //validate date and time
    if(!isset($date_time) || $date_time == ""){
        $error .= "You must enter call date and time.<br/>";
		$date_time = date('Y-m-d G:i:s');
    }
    if($error == ""){
        $client_id = get_client_id($_SESSION['id']);
        //$client_id = $client;
        //var_dump($client_id);
        insert_call($client_id, $date_time, $call_note);
        $call_reg = '<div style="text-align: center;" class="alert alert-success" role="alert">Successfully registered a call</div>';
        setMessage($call_reg);
        
        $date_time = date('Y-m-d G:i:s');
        $call_note = "";
    }else{
        //concatenation errors, show try again
        if($error !=""){
        $error .= "<br/> <strong><em>Please Try Again</em></strong>";
        $error2 = '<div style="text-align: center;" class="alert alert-warning" role="alert"> '.$error.' </div>';
        setMessage($error2);
        $error = "";
        $error2 = "";
        }
    }
    if(isset($_SESSION['message'])){
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
}
?>

<?php 
    //calls array
    $form_calls = array( //outter array
                                array(//inner array [0]
                                    "type" => "client", 
                                    "name" => "client_name",
                                    "value" => "",
                                    "label" => "Select Client",
                                ),
                                array(//inner array [1]
                                    "type" => "datetime-local",
                                    "name" => "call_time",
                                    "value" => "",
                                    "label" => "Call Time",
                                ),
                                array(//inner array [2]
                                    "type" => "text",
                                    "name" => "call_note",
                                    "value" => "",
                                    "label" => "Call Notes",
                                ),array(//inner array [3]
                                    "type" => "submit",
                                    "name" => "",
                                    "value" => "",
                                    "label" => "Register",
                                ),
                                array(//inner array [4]
                                    "type" => "reset",
                                    "name" => "",
                                    "value" => "",
                                    "label" => "Clear",
                                ),
                            );

    display_form($form_calls);
    ?>


<?php
include "./includes/footer.php";
?>    