<?php

/*
 * @Short Description: Database functions  to use throughout website
 *
 * @author Katherine Bellman <katherine.bellman@dcmail.ca>
 * @course: WEBD3201
 * @Date: September 12, 2021
 * 
 */



/**
 * Function that returns information script inoter to connect to database
 * 
 * @return conn for connecting to database server
 */
function db_connect(){
    $conn = pg_connect("host=".DB_HOST." port=".DB_PORT." dbname=".DATABASE." user=".DB_ADMIN." password=".DB_PASSWORD);
    return $conn;
}


$conn = db_connect();



$user_select_all = pg_prepare($conn,"user_select_all" ,"SELECT * FROM users ");



$user_select = pg_prepare($conn, "user_select", "SELECT * FROM users WHERE email_Address = $1");

/**
 * User selection function
 * @param takes 
 * @return associated 
 */
function user_select($email)
{
    global $conn;
    return pg_execute($conn, "user_select", array($email));
}


/**
 * User authentication function
 * @param Takes $email and $password
 * @return associated array with user information if exists
 *  if record is found, last login time is updated
 */
function user_authenticate($email, $plain_password)
{
    $result = user_select($email);
    $authenticated = false;
    if(pg_num_rows($result)==1)
    {
        $user = pg_fetch_assoc($result,0);
        if(password_verify($plain_password, $user["password"]))  //check that password and user correct pair
        {
            $_SESSION['user'] = $user; // add the user info to session
            $authenticated = true; //user is valid/authenticated
        }
    }
    return $authenticated;
} 

function user_exists($email){
    $result = user_select($email);
    return (pg_num_rows($result) >= True);

}


?>