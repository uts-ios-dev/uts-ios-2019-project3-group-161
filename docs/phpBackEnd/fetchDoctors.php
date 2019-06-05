<?php
require_once 'DBOperation.php';
 
$responseDoc = array();
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
   $fetch = $_POST['fetch'];
   if($fetch){
       $db = new DbOperation();
       $stmt = $db->fetchDocInfo();
       if($stmt){
        $stmt->bind_result($name,$description);   
           	while ($stmt->fetch()) {                                   
		       	$responseDoc[] = Array($name,$description);
		    }
       }
   }
}

echo json_encode($responseDoc);