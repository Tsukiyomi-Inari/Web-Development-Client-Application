<?php 
/*
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @Student Id:100325825
 * @course: WEBD3201
 * @Date: September 12, 2021
 * 
 * @Modified: October 18th - correcting lab 1 components
 */

$title = "WEBD3201 Sign-Out";
$author = "bellmank";
$description = "Logout page for WEBD3201 course project";

include "./includes/header.php";
$today = date('Ymd');
$now = date('Y-m-d G:i:s');
$handle =fopen("./logs/".$today."_log.txt",'a');

 if(isset($_SESSION['user']))
                    {
                        
                        fwrite($handle, "Logged out at [".$now."] by user [".$_SESSION['email']."] .\n");
                         fclose($handle);
                        //unset the session
                        session_unset();
                        //destory the session
                        session_destroy();
                        //cookie
                        setCookie("login_id", null, time() + COOKIE_LIFESPAN);
                        //start the session
                        session_start();
                        global $logout;
                        setMessage($logout);
                        //$message = getMessage();
                        //unset($_SESSION['message']);
                        
                        //redirect user to sign in page
                        redirect("sign-in.php");
                    }
                    else
                    {
                        redirect("sign-in.php");
                    }

                    
                     

include "./includes/footer.php";
?>