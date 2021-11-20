
<?php
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: September 12, 2021
 *
 * @Description: collection of non-database connection functions
 */

/**
 * Echos a copyright symbol followed by the current year and the authors name
 * 
 *  @echo copyright string with current year
 */ 
function displayCopyrightInfo(){

    $copyright = '&copy;'.date('Y ')." Katherine Bellman";

    echo $copyright;
}
/**
 * Prints code for validation buttons in footer
 * 
 * @printz validation code string to display icon links for valid XHTML and  valid CSS
 */
function displayValidationInfo(){
    $validation = ' 	<a href="http://validator.w3.org/check?uri=referer">
					<img 	style="width:44px;
								height:15.25px;"
							src="https://www.w3.org/Icons/valid-xhtml10-blue" 
							alt="Valid XHTML 1.0 Strict" />
				</a>
  			   	<a href="http://jigsaw.w3.org/css-validator/check/referer">
			        	<img 	style="width:44px;
								height:15.25px;"
        			    		src="http://jigsaw.w3.org/css-validator/images/vcss-blue"
								alt="Valid CSS!" /></a>';
    echo $validation;
}

// Flash messaging lines for global use
$denied = '<div class="alert alert-warning " role="alert">You must sign in.</div>';
$shall_not_pass = '<div style="text-align: center;" class="alert alert-warning" role="alert">You do not have access to that page. Error: Incorrect User Type Found </div>';
$sign_in_fail ='<div class="alert alert-warning" role="alert"> Login unsucessful </div>';
$sales_person_success_register = '<div style="text-align: center;" class="alert alert-success" role="alert">You succesfully registered<br/> the sales person</div>';
$logout = '<div class="alert alert-success" role="alert">You sucessfully logged out.</div>';
$user_password_change = '<div style="text-align: center;" class="alert alert-success" role="alert">You successfully changed your<br/> password</div>';
$client_reg = '<div style="text-align: center;" class="alert alert-success" role="alert">Successfully registered a client</div>';
/**
 * Redirect to another page
 */
function redirect($url){
    header("Location:".$url);
    ob_flush();
}

/**
 * 
 */
function setMessage($msg){
    $_SESSION['message']= $msg;
}

/**
 *  Gets the set message
 */
function getMessage()
{
    $message = $_SESSION['message'];
    return $message;
}

/**
 *  Checks if there is a message set or not
 */
function isMessage(){
    return isset($_SESSION['message'])?true:false;
}

/**
 * unsets the message
 */
function removeMessage(){
    unset($_SESSION['']);
}

/**
 * 
 */
function flashMessage(){
    $message = "";
    if(isMessage())
    {
        $message = getMessage();
        removeMessage();
    }
    return $message;   
}

/**
 * prints a formated version of its argument
 */
function dump($arg){
    echo "<pre>";
    print_r($arg);
    echo "</pre>";
}

//Template for creating associative arrays for display_form() function
/* $arrForm(
    array( //outter array
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
            "type" => "number",
            "name" => "extension",
            "value" => "",
            "label" => "Extension",
        )
    )
);
 */

/**
 * Displays a form based on passed in array
*/
function display_form($arrForm)
{
    global $message;
    //Start of form
    echo '<form class="form-signin" enctrype="multipart/form-data" method="POST" action="'.$_SERVER['PHP_SELF'].'">';
    //form header message prompt
    echo '<h1 class="h3 mb-3 font-weight-normal text-nowrap">Please fill in the following </h1>';
    //always have message echoed should it have one in the session
    echo $message;
    //create each field for form
    foreach($arrForm as $element){
        if( $element['type'] == "text" || $element['type'] == "email" || $element['type'] == "password" || $element['type'] == "phone" || $element['type'] == "datetime-local" ){
            echo '<label for="'.$element['name'].'" class="sr-only">'.$element['label'].'</label>';
            echo '<input type="'.$element['type'].'" name="'.$element['name'].'" id="'.$element['name'].'" value="'.$element['value'].'"class="form-control" placeholder="'.$element['label'].'">';
        }
        elseif(($element['type']=="client")){
            if((isset($_SESSION['type'])&&($_SESSION['type']==AGENT))){
                echo '<select name="'.$element['name'].'" id="'.$element['name'].'" class="form-control" >';
                $result = salesperson_client_select($_SESSION['id']);
                echo '<option value="-1"> Select Client </option>';
                for($i=0; $i < pg_numrows($result); $i++){
                    $client = pg_fetch_assoc($result,$i);
                    echo '<option value="'.$client['id'].'"> '.$client["first_name"].' '.$client["last_name"].'</option>';
                } 
                echo '</select>';
            
            }
        }
        elseif(($element['type']=="extension")){
            echo '<label for="'.$element['name'].'" class="sr-only">'.$element['label'].'</label>';
            echo '<input type="'.$element['type'].'" name="'.$element['name'].'" id="'.$element['name'].'" value="'.$element['value'].'"class="form-control" placeholder="'.$element['label'].'">';
        }

            //file upload box
        elseif ($element['type'] =="file"){
            echo '<label for="'.$element['name'].'" class="sr-only">'.$element['label'].'</label>';
            echo '<input type="'.$element['type'].'" name="'.$element['name'].'" id="'.$element['name'].'" class="form-control" placeholder="'.$element['label'].'">';
        }
        //selecting the salesperson for ADMIN
        elseif(($element['type']=="select")){
            if((isset($_SESSION['type'])&&($_SESSION['type']==ADMIN))){
                echo '<select name="'.$element['name'].'" id="'.$element['name'].'" class="form-control" >';
                $result = user_type_select(AGENT);
                echo '<option value="-1"> Select Sales Person </option>';
                for($i=0; $i < pg_numrows($result); $i++){
                    $user = pg_fetch_assoc($result,$i);
                    echo '<option value="'.$user['id'].'"> '.$user["first_name"].' '.$user["last_name"].': [ '.$user["email_address"].' ]</option>';
                }
                echo '</select>';


            }
        }
        // buttons
        elseif($element['type'] == "submit" || $element['type']=="reset"){
            echo '<button class="btn btn-lg btn-dark btn-block" type="'.$element['type'].'">'.$element['label'].'</button>';
        }
    }
    
    echo '</form>';
    echo '';
}

/**
 * @return if valid phone number
 */
function validate_phone_number($phone){
    $clean_phone = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
    $no_phone_dash = str_replace("-", "", $clean_phone);

    if(strlen($no_phone_dash) < 10){
        return false; //aka too long aka not localish
    }else{
        return true; // it's a phone number!
    }
}

function validate_extension_number($extension){
    $clean_extension = filter_var($extension, FILTER_SANITIZE_NUMBER_INT);
    $no_extension_dash = str_replace("-", "", $clean_extension);
    $no_extesnsion_plus = str_replace("+", "", $no_extension_dash);

    if(strlen($no_extesnsion_plus) < 4){
        return false; // extension number too long!
    }else{
        return true; // it's a valid extension number!
    }
}

/**
 * @param array, SQL query, count of agents and $page
*/
function display_table($arrfieldtable,$client_select_all, $agent_count,$page)
{
    //begin table
    echo '<div class="table-responsive">';
    echo  '<table class="table table-striped table-sm">';
    echo '<thread>';
    echo '<tr>';
    foreach($arrfieldtable as $key => $value){
        echo '<th>'.$value.'</th>';
    }
    echo '</tr>';
    echo '</thread>';
    echo '<tbody>';
    echo '<tr>';
    for ($i = 0, $i < count($client_select_all); $i++;){
        foreach($client_select_all[$i] as $key1 => $value1)
        {
            if($key1 == 'logo_path')
            {
                echo '<td> <img src="'.$value1.'" alt="No LOGO available" width="30"></td>';
            }
            else
            {
                echo '<td>'.$value1.'</td>';
            }
        }
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '<nav aria-label="Page navigation">';
    echo '<ul class="pagination">';
    echo '<li class="page-item"><a class="page-link" href="#">Previous<</a></li>';
    for($i = 0; $i < $agent_count/RECORDS; $i++)
    {
        echo '<li class="page-item"><a class="page-link" href="'.$_SERVER['PHP_SELF'].'?page='.($i+1).'">'.($i+1).'</a></li>';
    }
    echo '<li class="page-item"><a class="page-link" href="#">Next</a></li>';
    echo '</ul>';
    echo '</nav>';
    echo '</div>';

}




//Template for table creation for each page

/*
    $page = 1
    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }

    display_table( array( //outer array
        array(//inner array [0]
            "id" => "ID",
            "email_address" => "Email",
            "first_name" => "First Name",
            "last_name" => "Last Name",
            "phone_number" => "Phone Number",
            "extension" => "Extension",
            "logo_path" => "Logo",
        ),
        client_select_all($page),
        client_count(),
        $page;
    ));
*/

?>

