<?php 
require_once '../config/config.php';
	$facultyId = $_POST['facultyId'];
	$studentId  = $_POST['studentId'];

	$sql100 = "SELECT spriority2 from user where id=?";
				if($stmt1 = mysqli_prepare($conn, $sql100)){
		            mysqli_stmt_bind_param($stmt1, "i", $param_id);
		            
		            $param_id = $studentId;
		            
		            if(mysqli_stmt_execute($stmt1)){
		                mysqli_stmt_store_result($stmt1);

		                if(!mysqli_stmt_num_rows($stmt1) == 0){                    
		                    mysqli_stmt_bind_result($stmt1, $spriority2);
		                    if(mysqli_stmt_fetch($stmt1)){
	
								if($spriority2==NULL){
								$sql101 = "UPDATE user set spriority2=? where id=?";
         
							        if($stmt = mysqli_prepare($conn, $sql101)){
							            mysqli_stmt_bind_param($stmt, "ii",$param_facultyId, $param_studentId);
							            $param_facultyId = $facultyId;
							            $param_studentId = $studentId;
							            if(mysqli_stmt_execute($stmt)){
							                echo 'true';
							            } else{
							                echo 'false';
							            }
							        }else {echo 'hello';}
							         
							        mysqli_stmt_close($stmt);
							        
							    }else{
						    	echo 'already present';
						    	}
						    }

						    
						}
					}mysqli_stmt_close($stmt1);
				}else{echo "string";}
			



            // mysqli_close($conn);


?>