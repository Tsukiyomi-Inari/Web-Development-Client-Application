
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


?>

