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
 * Function that returns information script in order to connect to database
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
        {   $_SESSION['email'] = $user['email_address']; //for email
            $_SESSION['last_access'] = $user['last_access']; //for flash message use
            $_SESSION['first_name'] = $user['first_name']; // for flash message use
            $_SESSION['id'] = $user['id'];
            $_SESSION['type'] = $user['type']; //attempt to grab their user type
            $_SESSION['user'] = $user['user'];
            $_SESSION['user'] = $is_verified; // add the user info to session
            $authenticated = true; //user is valid/authenticated

        }
    }
    return $authenticated;
} 

/**
 * Confirms if user exists
 * @return bool if exists
 */
function user_exists($email){
    $result = user_select($email);
    return (pg_num_rows($result) >=1)?true:false;
}

///////////////////////////USER LOGIN FORM ///////////////////////////////////
$user_update_login_time = pg_prepare($conn, "user_login_time", "UPDATE users SET last_access=$1 WHERE email_address=$2");

function user_update_login_time($email){
    //update user's record to change last login timestamp to the current timestamp
    global $conn;
    $now = date("Y-m-d G:i:s");
    return pg_execute($conn, "user_login_time", array($now, $email));
}

/////////////////AGENT REGISTER FORM  //////////////////////////////
$user_insert = pg_prepare($conn, "user_insert","INSERT INTO users(email_address, password, first_name, last_name, enrol_date, enable, type) VALUES ($1, $2, $3, $4, $5, true, 'a')");

function insert_user($email, $password, $fname, $lname, $enroldate)
{
    global $conn;

    return pg_execute($conn, "user_insert", array($email,password_hash($password, PASSWORD_BCRYPT),$fname, $lname, $enroldate));
}

///////////// CLIENT REGISTER FORM //////////////////////////////
$client_insert = pg_prepare($conn, "client_insert", "INSERT INTO clients(first_name, last_name, phone_number, extension, email_address, logo_path,salesperson_id ) VALUES ($1, $2, $3, $4, $5, $6, $7)");

function insert_client($fname, $lname, $phone, $extension, $email, $logo_path, $salesID){
    global $conn;
    return pg_execute($conn, "client_insert", array($fname, $lname, $phone, $extension, $email, $logo_path, $salesID));
}

/**
 * @return message string for confirming succesful signin
 *          set to $_SESSION['message']
 */
function sign_in_msg()
{
    $login_victory = "<br/>Welcome back, ".$_SESSION['first_name']."!<br/> You last logged in [".$_SESSION['last_access']."]";
    
    $sign_in = '<div style="text-align: center;" class="alert alert-success" role="alert">Sign in succesful'.$login_victory.'</div>';

   
    return  setMessage($sign_in);
}


//////////////////OBTAIN USER TYPE FOR PAGE ACCESS AND SPECIAL VIEWS////////////////////////////////////
$user_type_select = pg_prepare($conn, "user_type_select", "SELECT * FROM users WHERE type=$1");

/**
 *  for getting the type of user from
 * type column in table
 */
function user_type_select($type){
    global $conn;
    return pg_execute($conn, "user_type_select", array($type));
}
/////////////////////////OBTAIN CLIENT ASSOCIATED WITH SALESPERSON DROPDOWN ON FORM//////////////////////////
$salesperson_client_select = pg_prepare($conn, "salesperson_client_select", "SELECT * FROM clients WHERE salesperson_id=$1");

/**
 *  for getting salespersons client
 * type column in table
 */
function salesperson_client_select($salesID){
    global $conn;
    return pg_execute($conn, "salesperson_client_select", array($salesID));
}

/**
 * @param $salesID
 * @return clients associated with specific sales person
*/
function get_client_id($salesID){
    ;
    if(pg_num_rows(salesperson_client_select($salesID)))
    {
        $raw_client = salesperson_client_select($salesID);
        $result = pg_fetch_assoc($raw_client,0);
        $client_id = $result['client_id'];
     }
     return $client_id;
}


/////////////////INSERT A CALL BY SALESPERSON/////////////////////////////////

$insert_call = pg_prepare($conn, "insert_call", "INSERT INTO calls(client_id, call_time, call_note ) VALUES ($1, $2, $3)");

/**
 * @params $client $call_time, $call_note
 * @return enters call data into table
*/
function insert_call($client, $call_time, $call_note){
    global $conn;
    return pg_execute($conn, "insert_call", array($client, $call_time ,$call_note));
}

////////////CLient Table ///////////////////////

$my_clients_select_all =  pg_prepare($conn, "my_clients_select_all", "SELECT client_id, email_address, first_name, last_name, phone_number, extension, logo_path FROM clients WHERE salesperson_id=$1" );
$client_select_all =  pg_prepare($conn, "client_select_all", "SELECT client_id, email_address, first_name, last_name, phone_number, extension, logo_path FROM clients");


/**
 * @param $page
 * builds table with ALL clients for ADMIN
 */
function   client_select_all($page)
{
    global $conn;

    $result = pg_execute($conn,"client_select_all", array());
    $count = pg_num_rows($result);
    $arr = array();
    for($i = ($page-1)*RECORDS; $i < $count && $i <$page*RECORDS; $i++)
    {
        array_push($arr,pg_fetch_assoc($result, $i));
    }
    return $arr;
}

/**
 * @return table for clients of specific salesperson
*/
function   salesperson_client_select_all($page, $salesID)
{
    global $conn;
    $result = pg_execute($conn,"my_clients_select_all", array($salesID));
    $count = pg_num_rows($result);
    $arr = array();
    for($i = ($page-1)*RECORDS; $i < $count && $i <$page*RECORDS; $i++)
    {
        array_push($arr,pg_fetch_assoc($result, $i));
    }
    return $arr;
}


/**
 * @return total count of clients in table
 */
function client_count()
{
    global $conn;
    return pg_execute($conn, "client_select_all", array());
}

/**
 * @return total clients of specific salesperson
*/
function salesperson_client_count($salesID)
{
    global $conn;

    return pg_execute($conn, "my_clients_select_all", array($salesID));
}


///////////////////// AGENT Table////////////////////////////////

$user_select_all = pg_prepare($conn, "user_select_all", "SELECT id,email_address,first_name, last_name, enrol_date FROM users WHERE type=$1");

/**
 * @return records that are only of specified user type
*/
function user_select_all($type)
{
    global $conn;
    return pg_execute($conn, "user_select_all", array($type));
}

/**
 * @param $page
 * @return array() with each part of records
 * for display in pagination
*/
function agent_select_all($page)
{
//    $result = user_select_all($page);

    $result = user_select_all('a');
    $count = pg_num_rows($result);
    $arr = array();
    for ($i = ($page-1)*RECORDS; $i < $count && $i <$page*RECORDS; $i++)
    {
        array_push($arr, pg_fetch_assoc($result, $i));
    }
    return $arr;
}

/**
 * @return total count of users with type AGENT
*/
function agent_count()
{
    return pg_num_rows(user_select_all(AGENT));
}

////////////////////////// Change Password ///////////////////////////////////////////////////////
$user_update_password = pg_prepare($conn, "user_update_password", "UPDATE users SET password = $1 WHERE email_address = $2");

function user_update_password($password)
{
    global $conn;
    return pg_execute($conn, "user_update_password", array(password_hash($password, PASSWORD_BCRYPT), $_SESSION['email']));
}

?>