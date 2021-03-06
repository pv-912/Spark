<?php
ob_start();
session_start();

/* logout after 10min. */

     if(time()-$_SESSION['time']>24*60*60){
        if(isset($_COOKIE['username'])):
            setcookie('username', '', time()-7000000, '/');
        endif;
        if(isset($_COOKIE['name'])):
            setcookie('name', '', time()-7000000, '/');
        endif;if(isset($_COOKIE['role'])):
            setcookie('role', '', time()-7000000, '/');
        endif;
        
        unset($_SESSION['time']);
        session_unset();
        session_destroy();
        setcookie("username", null, time()-3600);
        setcookie("role", null, time()-3600);
        setcookie("name", null, time()-3600);
        header("location: ../index.php");}
    else{
        $_SESSION['time']=time();
    }

require '../config/config.php';
$studentRealId = $name = $email1 = $contact = $department = $college = $sparkId = ""; 

if($_SESSION['role']=='student')
{

	$role = $_SESSION['role'];

    $sql = "SELECT id,name,email,contact,department,college,recommendStatus,recommendedFaculty,fundingType,adminRemark,sparkId FROM student WHERE email = ? and role = ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        mysqli_stmt_bind_param($stmt, "ss", $param_username,$param_role);

        $param_username = $_SESSION['username'];
        $param_role = $_SESSION['role'];

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);

            if(!mysqli_stmt_num_rows($stmt) == 0){                    
                mysqli_stmt_bind_result($stmt, $studentRealId ,$name,$email1,$contact,$department,$college,$recommendStatus,$recommendedFaculty,$fundingType,$adminRemark,$sparkId);
                if(mysqli_stmt_fetch($stmt)){

                    require_once '../header.php';

                    ?>

                    <div class="container-fluid">
                       <div class="row">
                          <div class="col-sm-2  studentProfileContainer">
                             <div class="row">
                               <div class="col-sm-12" style="text-align: center;">
                                   <img src="<?php echo base_url; ?>uploadFiles/showProfileImage.php?email=<?=$email1 ?>" class="studentProfileImg" alt="Please Upload Image">
                               </div>
                               <div class="col-sm-12 col-xs-12">
                                  <form action="<?php echo base_url; ?>uploadFiles/imageUpload.php" id="imageForm" method="post" enctype="multipart/form-data">
                                   <input type="hidden" name="imageId" value="<?php echo $email1; ?>">
                                   <input type="hidden" name="imageRole" value="<?php echo $role; ?>">
                                   <div class="selectImageButtonMobFix" >
                                    <input type="file" name="image" id="profileImageUpload" class="inputimage" />
                                    <label for="profileImageUpload" class="selectImageButton"><span class="glyphicon glyphicon-folder-open hidden-sm hidden-xs selectImageButtonTabFix selectImageButtonMobFix" ></span>Change Image</label>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row studentDetails">
                        <p class="studentProfileDetailsTag  studentProfileUpperMargin">SPARK ID</p>
                        <p class="studentProfileDetails"><?php echo $sparkId; ?></p>
                        <p class="studentProfileDetailsTag">NAME</p>
                        <p class="studentProfileDetails"><?php echo $name; ?></p>

                        <p class="studentProfileDetailsTag">DEPARTMENT</p>
                        <p class="studentProfileDetails"><?php echo $department; ?></p>

                        <p class="studentProfileDetailsTag">COLLEGE</p>
                        <p class="studentProfileDetails"><?php echo $college; ?></p>

                        <p class="studentProfileDetailsTag">EMAIL</p>
                        <p class="studentProfileDetails"><?php echo $email1; ?></p>

                        <p class="studentProfileDetailsTag">CONTACT NO.</p>
                        <p class="studentProfileDetails"><?php echo $contact; ?></p></div>
                        <a href="#resetPwd" data-toggle="modal" data-target="#resetPwd" class="footerResetPwd " style="margin-left: 5%; margin-top: -2vh;margin-bottom: 2vh">Reset password</a>

                        <a class="btn btn-default studentProfileLogoutButton" href="<?php echo base_url; ?>logout.php" >Logout</a>
                    </div>
                    <div class="col-sm-9 rightContainerStudent">
                     <div class="row">
                        <div class="col-sm-12">
                           <div class="container-fluid">
                             <div class="row" style="margin-top: 0vh;">
                                 <div class="col-sm-6">
                                     <p class="studentProjectTag"><b>PROJECTS</b></p>
                                 </div>
			                    <!-- <div class="col-sm-4 col-sm-offset-2" style="margin-top: -2.5vh">
			                        <input class="form-control projectSearchingInput" id="myInput" type="text" placeholder="Search Projects..">
			                    </div> -->
			                </div>
			            </div>
                       <div class="TableDiv">
                           <ul class="nav nav-tabs" role="tablist">
                             <li role="presentation" class="active col-sm-4 col-xs-4"><a href="#available" class="navTabs" aria-controls="profile" role="tab" data-toggle="tab">Available Projects</a></li>
                             <li role="presentation" class="col-sm-4 col-xs-4"><a href="#applied" aria-controls="home" role="tab" data-toggle="tab">Applied Projects</a></li>
                             <li class="col-sm-4 col-xs-4" ><input class="form-control studentSearchingInput" id="myInput" type="text" placeholder="Search Projects.."></li>
                         </ul>

                         <div class="tab-content studentTabContentDiv">
                            <div role="tabpanel" class="tab-pane fade in" id="applied">

                               <?php require_once('appliedProject.php');  ?>

                           </div>


                           <div role="tabpanel" class="tab-pane fade in active" id="available">

                               <?php require_once('availableProject.php');  ?>

                           </div>
                       </div>
                   </div>
               </div>
           </div>
           <div class="row" style="margin-top: 4vh">
            <div class="col-sm-6 col-xs-6">
               <form action="../uploadFiles/uploadResume.php" method="post" enctype="multipart/form-data" id="resumeFrom">
                   <input type="hidden" name="resumeId" value="<?php echo $email1; ?>" />
                   <div class="col-sm-6 col-xs-6 uploadResume" ">
                    <!-- <input type="file" name="resume" id="resume" class="inputfile" /> -->
                    <!-- <label for="resume"><span class="glyphicon glyphicon-folder-open uploadResumeButtonMobFix" style="padding-right: 7px;"></span></span >Upload Resume</label> -->
                </div>
            </form>
            <div class=" studentProfileSeeTranscriptsButton col-xs-6 col-sm-6" >
                <a href="../uploadFiles/showResume.php?email=<?=$email1 ?>&param=<?=$studentRealId ?>" target="_blank"><input type="button" class="btn btn-default studentProfileSeeTranscriptsButtonInput " value="See Resume" id="showResumeButton"></a>
            </div>
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
           <form action="../uploadFiles/uploadNOC.php" id="nocForm" method="post" enctype="multipart/form-data">
               <input type="hidden" name="nocId" value="<?php echo $email1; ?>" />
               <div class="col-md-6 col-sm-6 col-xs-6 uploadNOC"> 
                <!-- <input type="file" name="noc" id="noc" class="inputfile"/> -->
               <!--  <label for="noc"><span class="glyphicon glyphicon-folder-open uploadResumeButtonMobFix" style="padding-right: 7px"></span></span>Upload Transcript</label> -->
            </div>
        </form>
        <div class="studentProfileSeeTranscriptsButton col-xs-6 col-sm-6" >
            <a href="../uploadFiles/showNOC.php?email=<?=$email1 ?>&param=<?=$studentRealId ?>" target="_blank"><input type="button"  class="btn btn-default studentProfileSeeTranscriptsButtonInput" value="See Transcript" id="showNOCButton"></a>
        </div>
    </div>
</div>
                <!-- <div class="row"  style="margin-top: 1vh">
                    <div class="col-sm-12 col-xs-12 viewFile " style="margin-top:4vh; text-align: center; ">
                        <a href="../uploadFiles/showNOC.php?email=<?=$email1 ?>&id=<?=$studentRealId ?>" target="_blank">hello</a>
                        <a target="_blank"><embed src="../uploadFiles/showNOC.php?email=<?=$email1 ?>" type="application/pdf"  class="pdfDisplay"  width="100%" id="showNOC" style="display:none; "></a>
                    </div>
                </div> -->
            </div>
        </div>

        <div class="container-fluid" style="margin-top: 4vh;">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="alert alert-success studentProfileInstructionBox " role="alert">
                        <ul><p class="studentProfileInstructionsTag"> <strong>Instructions :</strong> </p>
                            <li>There are two sections for uploading Documents. The left one is for uploading <strong>Resume</strong>  (Compulsary for all students) .</li>
                            <li>The other section for uploading documents is for <strong>Transcript.</strong> and the Research Statement.</li>
                            <li>The above two things are to be combined in a single pdf format file with size less than 500KB.</li>
                            <li>The Research statement is general and not specific. It must contain your research interests and also the work(projects) done before, if any </li>
                            <li>Each student have five choices to select their project according to his/her priority.</li>
                            <li>Once the priorities are selected you will not be able to change it. So, choose priorities carefully after inspecting all the projects.</li>
                            <li>Size of profile image should be less than 500 KB.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid" style="margin-top: 5vh">
            <div class="row">
                <div class="col-sm-10 col-sm-offset-1">
                    <div class="alert alert-warning studentProfileStatusBox">
                        <p class="studentProfileStatusTag"><strong>Status : </strong></p>
                        <ul>

                            <?php if($recommendStatus==1){ ?>

                            <span style="font-weight: 800;color: green"><h3>Application Accepted</h1></span>


                                <?php	$query    = "SELECT name from faculty where id=$recommendedFaculty";
                                $result5 = $conn->query($query);
                                if($result5) {
                                    if(!$result5->num_rows == 0) {
                                        while($row5 = $result5->fetch_assoc()) {
                                            ?><li><span style="font-weight: 800">Faculty Recommended : </span> <?php echo $row5['name']; ?></li>
                                            <?php 
                                        }  
                                    }
                                } 
                                ?>

                                <li><span style="font-weight: 800">Funding Type/Stipend : </span> <?php echo $fundingType; ?></li>

                                <?php }else{ ?>

                                <span class="studentProfileStatus"><h3 class="studentProfileStatus"> Yet not recommended by any faculty. </h3></span>

                                <?php } ?>

                                <?php if($adminRemark){ ?>
                                <span style="font-weight: 800">Remark : </span><ul style="margin-left: 5%"> <?php echo $adminRemark; ?></ul>
                                <?php } ?>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid" >
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1">
                        <p class="studentProfileComplaintTag" style="text-align: center;">Problems / Complaints / Suggestions: </p>
                        <div class="row">
                            <textarea class="form-control studentProfileComplaintBox" rows="5" name="complaintText" id="complaintText" placeholder="Text here .. "></textarea>
                        </div>
                        <div style="text-align: center;">
                            <input type="submit" class="btn studentProfileComplaintButton" name="complaintSubmit" onclick="student_complaint('<?php echo $email1; ?>');">
                        </div>
                        <div id="complaintDiv">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div style="height:5vh;"> </div>
        <?php require_once('../footer.php');?>
        <?php require_once('resetPassword_modal.php'); ?>

        <?php
    }

} 
} 
}
mysqli_stmt_close($stmt);
mysqli_close($conn);
}
?>

<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#myTable tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>

<script>

    function student_complaint(data){

        var id = data;
        var complaint = $('#complaintText').val();
        // alert(id);
        if(complaint!=''){
            var a = confirm(" Do you want to submit complaint/suggestion ? ");
            if(a==true){
               $.ajax({
                url: '../complaint.php',
                data: {"complaintId":id,"complaintText":complaint},
                async: true,
                type: 'POST',          

                success: function(data){
            // alert(data);
            $('#complaintDiv').html(data);
            $('#complaintText').val('');
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            alert(errorThrown);
        }
    });
           }else{

           }
       }else{
        $('#complaintDiv').html('Insert text');
    }
}


</script>

<script>
    $(document).ready(function(){
        $("#showResumeButton").click(function(){
            $("#showResume").css("display", "");
            $("#showNOC").css("display","none");
        });
    });
    $(document).ready(function(){
        $("#showNOCButton").click(function(){
            $("#showResume").css("display", "none");
            $("#showNOC").css("display","");
        });
    });
</script>

<script>
    $('#resume').on('change', function () {
        $('#resumeFrom').submit();
    });
    $('#noc').on('change', function () {
        $('#nocForm').submit();
    });
    $('#profileImageUpload').on('change', function () {
        $('#imageForm').submit();
    });

    function resetPassword(){
        var email = "<?php echo $email1; ?>";
        var oldPassword = $('#oldPassword').val();
        var newPassword = $('#newPassword').val();
        var confirmPassword = $('#confirmPassword').val();
        // alert(oldPassword);
        // alert(newPassword);
        // alert(confirmPassword);
        // alert(email);
            $.ajax({
                url: 'resetPassword.php',
                data: {"oldPassword":oldPassword,"newPassword":newPassword,"confirmPassword":confirmPassword,"email":email},
                async: false,
                type: 'POST',          

                success: function(data){
                    $("#resetPasswordDiv").html(data);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown+ ' Set.');
                }
            });
        }

    function spriority1(data){

        var facultyId = data;
        var studentId = <?php echo $studentRealId; ?> ;
        con = confirm("Are you sure to set him/her as 1st priority. You won't be able to change.");
        if(con==true ){
            $.ajax({
                url: 'spriority1.php',
                data: {"studentId":studentId,"facultyId":facultyId},
                async: false,
                type: 'POST',          

                success: function(data){
                    $("#spriority1Div").html(data);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown+ 'Priority Set.');
                }
            });
        }
    }

    function spriority2(data){

        var facultyId = data;
        var studentId = <?php echo $studentRealId; ?> ;
        con = confirm("Are you sure to set him/her as 2nd priority. You won't be able to change.");
        if(con==true ){
            $.ajax({
                url: 'spriority2.php',
                data: {"studentId":studentId,"facultyId":facultyId},
                async: true,
                type: 'POST',          

                success: function(data){
                    $("#spriority1Div").html(data);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown+ 'Priority Set.');
                }
            });
        }
    }

    function spriority3(data){

        var facultyId = data;
        var studentId = <?php echo $studentRealId; ?> ;
        con = confirm("Are you sure to set him/her as 3rd priority. You won't be able to change.");
        if(con==true ){
            $.ajax({
                url: 'spriority3.php',
                data: {"studentId":studentId,"facultyId":facultyId},
                async: true,
                type: 'POST',          

                success: function(data){
                    $("#spriority1Div").html(data);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown+ 'Priority Set.');
                }
            });
        }
    }

    function spriority4(data){

        var facultyId = data;
        var studentId = <?php echo $studentRealId; ?> ;
        con = confirm("Are you sure to set him/her as 4th priority. You won't be able to change.");
        if(con==true ){
            $.ajax({
                url: 'spriority4.php',
                data: {"studentId":studentId,"facultyId":facultyId},
                async: true,
                type: 'POST',          

                success: function(data){
                    $("#spriority1Div").html(data);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown+ 'Priority Set.');
                }
            });
        }
    }

    function spriority5(data){

        var facultyId = data;
        var studentId = <?php echo $studentRealId; ?> ;
        con = confirm("Are you sure to set him/her as 5th priority. You won't be able to change.");
        if(con==true ){
            $.ajax({
                url: 'spriority5.php',
                data: {"studentId":studentId,"facultyId":facultyId},
                async: true,
                type: 'POST',          

                success: function(data){
                    $("#spriority1Div").html(data);
                },
                error : function(XMLHttpRequest, textStatus, errorThrown) {
                    alert(errorThrown+ 'Priority Set.');
                }
            });
        }
    }

</script>

