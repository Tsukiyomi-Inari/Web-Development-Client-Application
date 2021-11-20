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

if(!(isset($_SESSION['type'])&&($_SESSION['type']==AGENT || $_SESSION['type']==ADMIN)))
{
    $shall_not_pass = '<div style="text-align: center;" class="alert alert-warning" role="alert">You do not have access to that page. Error: Incorrect User Type Found </div>';
    $_SESSION['message'] = setMessage($shall_not_pass);
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
    redirect("sign-in.php");
}
unset($_SESSION['message']);
$error ="";
if($_SERVER["REQUEST_METHOD"] == "GET"){
    $fName = "";
    $lName = "";
    $phone_number = "";
    $extension = "";
    $email_address = "";

}elseif($_SERVER["REQUEST_METHOD"] == "POST")
{
    $fName = trim($_POST["inputFName"]);
    $lName = trim($_POST["inputLName"]);
    $phone_number = trim($_POST["inputPhone"]);
    $extension = trim($_POST["inputExtension"]);
    $email_address = trim($_POST["inputEmail"]);
    $sales_person = $_POST['sales_person'];


    //validate first name
    if(!isset($fName) || $fName == "")
    {
        $error .= "You must enter your first name.<br/>";
    }
    //validate last name
    if(!isset($lName) || $lName == "")
    {
        $error .= "You must enter your last name.<br/>";
    }
    //validate phone number
    if(!isset($phone_number) || $phone_number == "")
    {
        $error .= "You must enter a phone number.<br/>";
    }
    elseif(!(validate_phone_number($phone_number)))
    {
        $error .= " You must enter a valid 10 digit(local) phone number. <br/>";
    }
    if((validate_extension_number($extension)==false))
    {
        $error .= "Extensions can only be max 4 digits. <br/>";
    }
    if($extension == "")
    {
        $extension = "null";
    }
    if(!isset($email_address) || $email_address == "")
    {
        $error .= "You must enter your e-mail.<br/>";
    }
    elseif(!(filter_var($email_address, FILTER_VALIDATE_EMAIL)))
    {
        $error .= "<em>".$email_address."</em> is not a valid e-mail address.<br/>";
        $email_address = "";
    }
    if(isset($sales_person) && $sales_person==-1)
    {
        $error .= "You must select sales person. <br/>";
    }
 if (count($_FILES) > 0) {
     $logo_url = $_FILES['logo']['name'];
    //File validation
    if($_FILES['logo']['error'] != 0)
    {
        $error .= "Problem uploading your file.";
    }
    elseif($_FILES['logo']['type'] != "image/jpeg" && $_FILES['logo']['type'] != "image/pjpeg" && $_FILES['logo']['type'] != "image/jpg")
    {
        $error .= "Your profile pictures must be of type JPEG";
    }
    elseif($_FILES['logo']['size'] > MAX_FILE_SIZE) // in bytes
    {
        $error .= "File selected is too big, file must be smaller than 3MB (".ini_get("upload_max_filesize")."B)";
    }
    else //valid file for processing! YEY
    {

        $logo_url = "./files_uploaded/" . $email_address . "new_file.jpg";
        //Move the file from temp to the appropriate folder with new file name
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo_url);
    }
 }
    if($error == "")
    {
        if(isset($_SESSION['type'])&&($_SESSION['type']==AGENT))
        {
            $user_id = $_SESSION['id'];
        }
        else
        {
            $user_id = $sales_person;
        }
        insert_client($fName, $lName, $phone_number, $extension, $email_address,$logo_url, $user_id);
        global $client_reg;
        setMessage($client_reg);
        $fName = "";
        $lName = "";
        $phone_number = "";
        $extension = "";
        $email = "";
    }
    else
    {
        //concatenation errors, show try again
        if($error !="")
        {
        $error .= "<br/> <strong><em>Please Try Again</em></strong>";
        $error2 = '<div style="text-align: center;" class="alert alert-warning" role="alert"> '.$error.' </div>';
        setMessage($error2);
        $error = "";
        $error2 = "";
        }
    }
    if(isset($_SESSION['message']))
    {
        $message = $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

?>
  <?php   
    //Client form array
$form_client = array( //outter array
                        array(//inner array [0]
                            "type" => "text",
                            "name" => "inputFName",
                            "value" => "",
                            "label" => "First Name",
                        ),
                        array(//inner array [1]
                            "type" => "text",
                            "name" => "inputLName",
                            "value" => "",
                            "label" => "Last Name",
                        ),
                        array(//inner array [2]
                            "type" => "email",
                            "name" => "inputEmail",
                            "value" => "",
                            "label" => "Email",
                        ),
                        array(//inner array [3]
                            "type" => "phone",
                            "name" => "inputPhone",
                            "value" => "",
                            "label" => "Phone Number",
                        ),
                        array(//inner array [4]
                            "type" => "extension",
                            "name" => "inputExtension",
                            "value" => "",
                            "label" => "Extension",
                        ),
                        array(//inner array [5]
                            "type" => "file",
                            "name" => "uploadfileName",
                            "value" => "",
                            "label" => "Select file for upload",
                        ),
                        array(//inner array [6]
                            "type" => "select",
                            "name" => "sales_person",
                            "value" => "",
                            "label" => "Select Salesperson",
                        ),
                        array(//inner array [7]
                            "type" => "submit",
                            "name" => "",
                            "value" => "",
                            "label" => "Register",
                        ),
                        array(//inner array [8]
                            "type" => "reset",
                            "name" => "",
                            "value" => "",
                            "label" => "Clear",
                        ),
                    );

    display_form($form_client);

    if(isset($_GET['page']))
    {
        $page = $_GET['page'];
    }
    else
    {
        $page = 1;
    }
    // FULL client table view for ADMIN
    if($_SESSION['type']==ADMIN)
    {
         display_table( array(
                "client_id" => "ID",
                "email_address" => "Email",
                "first_name" => "First Name",
                "last_name" => "Last Name",
                "phone_number" => "Phone Number",
                "logo_path" => "Logo"),
            client_select_all($page),
            client_count(),
            $page
        );
    }
    //Salesperson specific table view
    else
    {
         display_table(
            array(
                "client_id" => "ID",
                "email_address" => "Email",
                "first_name" => "First Name",
                "last_name" => "Last Name",
                "phone_number" => "Phone Number",
                "logo_path" => "Logo",
            ),
            salesperson_client_select_all($page,$_SESSION['id']),
            salesperson_client_count($_SESSION['id']),
            $page
        );

    }

?>
<?php
include "./includes/footer.php";
?>    