<?php
require_once 'DBOperation.php';
 
$response = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!verifyRequiredParams(array('usernamelog', 'passwordlog'))) {
        //getting values
        $username = $_POST['usernamelog'];
        $password = $_POST['passwordlog'];
 
        //creating db operation object
        $db = new DbOperation();
 
        //adding user to database
        $result = $db->userLogin($username, $password);
 
        //making the response accordingly
        if ($result) {
            $responselog['errorlog'] = false;
            $responselog['messagelog'] = 'User log in successfully';
        } 
        else {
            $responselog['errorlog'] = true;
            $responselog['messagelog'] = 'Log in fail!';
        }
    } 
    else {
        $responselog['errorlog'] = true;
        $responselog['messagelog'] = 'Required parameters are missing';
    }
} else {
    $responselog['errorlog'] = true;
    $responselog['messagelog'] = 'Invalid request';
}
 
//function to validate the required parameter in request
function verifyRequiredParams($required_fields)
{
 
    //Getting the request parameters
    $request_params = $_REQUEST;
 
    //Looping through all the parameters
    foreach ($required_fields as $field) {
        //if any requred parameter is missing
        if (!isset($request_params[$field]) || strlen(trim($request_params[$field])) <= 0) {
 
            //returning true;
            return true;
        }
    }
    return false;
}
 
echo json_encode($responselog);