<?php
    require_once('../config/config.php');



if ($_POST && !empty($_FILES)) {
    if($_FILES['resume']['error'] == 0) {
        $email = $_POST['resumeId'];
        $type = $conn->real_escape_string($_FILES['resume']['type']);
        $data = $conn->real_escape_string(file_get_contents($_FILES  ['resume']['tmp_name']));
        $size = intval($_FILES['resume']['size']);
 
 if ( in_array($type, array('application/pdf'))) {
     if ( $size < 500000) {
        
        $query = "update user set resume='$data' where email='$email'";
 
        $result = $conn->query($query);
 
        if($result) {
            header ("location:../student-portal/");
        }
        else {
            echo 'Error! Failed to insert the file'
               . "<pre>{$conn->error}</pre>";
        }
        }else{echo "file size too large. Size Limit is 500kb only.";}
    }else{echo "choose pdf format";}
}
    else {
        echo 'An error accured while the file was being uploaded. '
           . 'Error code: '. intval($_FILES['resume']['error']);
    }
 
    $conn->close();
}
else {
    echo 'Error! A file was not sent!';
}
 



?>