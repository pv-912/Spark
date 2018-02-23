
 <!-- reset modal -->
   <div class="modal fade" id="resetPwd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
     <div class="modal-dialog modal-md loginModalWidth" role="document">
       <div class="modal-content">
         <div class="modal-header" style="background-color: #aaa">
           <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
           <h4 class="modal-title loginModalHeader">Log In</h4>
         </div>
         <div class="modal-body">
           <form class="form-horizontal" method="post" action="resetPassword.php" id="resetPwdForm">
           <div class="form-group  <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
             <label for="inputEmail3" class="col-sm-2 control-label">Email<sup>*</sup></label>
             <div class="col-sm-10">
               <input type="email" name="email" class="form-control" placeholder="Email" id="loginEmail" value="<?php echo $email; ?>">

                <span class="help-block"><?php echo $email_err; ?></span>
             </div>
           </div>
           <div class="form-group  <?php echo (!empty($pass_err)) ? 'has-error' : ''; ?>"">
             <label for="inputpass3" class="col-sm-2 control-label">New Password<sup>*</sup></label>
             <div class="col-sm-10">
               <input type="password" name="passWord" class="form-control" id="newloginPassword" placeholder="Password" autocomplete="off">
               <span class="help-block"><?php echo $pass_err; ?></span>
             </div>
           </div>
           <div class="form-group">
             <div class="col-sm-offset-2 col-sm-10">
               <button type="submit" class="btn btn-primary loginModalSignupButton">Reset Password</button>
             </div>
           </div>
           <!-- <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <a href="resetPassword.php">Don't Have Account (Only For Student.)</a>
            </div>
           </div>  -->
         </form>
         </div>
      </div>
     </div>
   </div>
