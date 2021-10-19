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



//$user_select_all = pg_prepare($conn,"user_select_all" ,"SELECT * FROM users ");



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
        $is_verified = password_verify($plain_password, $user["password"]);
        if($is_verified == 1)  //check that password and user correct pair
        {   $_SESSION['email'] = $user['email_address']; //for
            $_SESSION['last_access'] = $user['last_access']; //for flash message use
            $_SESSION['first_name'] = $user['first_name']; // for flash message use
            $_SESSION['type'] = $user['type']; 
            $_SESSION['user'] = $is_verified; // add the user info to session
            $authenticated = true; //user is valid/authenticated

        }
    }
    return $authenticated;
} 

function user_exists($email){
    $result = user_select($email);
    return (pg_num_rows($result) >=1)?true:false;
}

$user_update_login_time = pg_prepare($conn, "user_login_time", "UPDATE users SET last_access=$1 WHERE email_address=$2");

function user_update_login_time($email){
    //update user's record to change last login timestamp to the current timestamp
    global $conn;
    $now = date("Y-m-d G:i:s");
    $result = pg_execute($conn, "update_login_time", array($now, $email));
}

//"User" but actually sales person
$user_insert = pg_prepare($conn, "user_insert","INSERT INTO users(email_address, password, first_name, last_name, enrol_date, enable, type) VALUES ($1, $2, $3, $4, $5, true, 'a')");

function insert_user($email, $password, $fname, $lname, $enroldate)
{
    global $conn;

    return pg_execute($conn, "user_insert", array($email,password_hash($password, PASSWORD_BCRYPT),$fname, $lname, $enroldate));
}

//"CLIENT"
function insert_client($email, $fname, $lname, $phone, $extension, $salesID){
    global $conn;
    return pg_execute($conn, "client_insert", array($email,$fname, $lname, $phone, $extension, $salesID));
}

/**
 * @return message string for confirming succesful signin
 *          set to $_SESSION['message']
 */
function sign_in_msg()
{
    $login_victory = "<br/>Welcome back, ".$_SESSION['first_name']."!<br/> You last logged in [".$_SESSION['last_access']."]";
    
    $sign_in = '<div style="text-align: center;" class="alert alert-success" role="alert">Sign in succesful'.$login_victory.'</div>';

    return setMessage($sign_in);
}


?>