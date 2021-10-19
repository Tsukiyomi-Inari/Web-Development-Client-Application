
<?php
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: September 12, 2021
 * 
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
					<img 	style="width:66px;
								height:25.25px;"
							src="http://www.w3.org/Icons/valid-xhtml10" 
							alt="Valid XHTML 1.0 Strict" />
				</a>
  			   	<a href="http://jigsaw.w3.org/css-validator/check/referer">
			        	<img 	style="width:66px;
									height:25.25px;"
        			    		src="http://jigsaw.w3.org/css-validator/images/vcss"
								alt="Valid CSS!" /></a>';
    echo $validation;
}



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
function getMessage(){
    return $_SESSION['message']; 
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
function display_form($arrForm)
{
    echo '<form class="form-signin" method="POST" action="'.$_SERVER['PHP_SELF'].'">'; 
    echo '<h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>';
    foreach($arrForm as $element){
        echo '<label for="'.$element['name'].'" class="sr-only">'.$element['label'].'</label>';
        echo '<input type="'.$element['type'].'" name="'.$element['name'].'" id="'.$element['name'].'" value="'.$element['value'].'"class="form-control" placeholder="'.$element['label'].'" required autofocus>';
        
    }
    echo '<button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>';
    echo '<button class="btn btn-lg btn-primary btn-block" type="reset">Clear</button>';
    echo '</form>';
}

?>

