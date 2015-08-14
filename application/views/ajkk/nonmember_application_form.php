<style type="text/css">
.tooltip-inner {
    /* If max-width does not work, try using width instead */
    width: 350px;
}

.popover {
    width: 250px;
}

.popover-footer {
  margin: 0;
  padding: 1px 14px;
  font-size: 14px;
  font-weight: 400;
  line-height: 18px;
  background-color: #F7F7F7;
  border-bottom: 1px solid #EBEBEB;
  border-radius: 5px 5px 0 0;
}

</style>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="panel panel-og">
            <div class="panel-heading">
                <span class="panel-title">APPLICATION FOR <?= strtoupper($jobInfo['jobDetails']['job_title']) ?></span>
                <span class="help-block pull-right" style="color:#ff6666;"><?= lang('reg.02'); ?></span>
                <div class="clearfix"></div>
            </div>

            <div class="panel panel-body" id="add_player_panel_body">
                
                <form method="post" action="<?= BASEURL . 'ajkk/sendNonMemberApplication'?>" id="my_form" autocomplete="off" roel="form" class="form-inline" name="form">
                    <input type="hidden" value="normal" name="level">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <br/>
                            <label for="uploadResume"><i style="color:#ff6666;">*</i> Upload Resume: (.pdf/.doc/.docx)</label>
                            <br/>
                            <input type="hidden" name="doc_url" id="doc_url" class="form-control" readonly>
                            <input type="file" name="userfile" id="userfile" class="form-control" onchange="setURLEditBannerCms(this,this.value);" style="" required>
                            <br/>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <br/>
                            <label for="fname"><i style="color:#ff6666;">*</i> First Name: </label> <br/>
                            <input type="hidden" value="<?= $jobInfo['jobDetails']['jobId'] ?>" name="jobId">
                            <input type="hidden" value="<?= $jobInfo['jobDetails']['empId'] ?>" name="empId">
                            <input type="text" name="fname" style="width:100%" class="form-control emails_only" value="" placeholder="First Name" required>
                            <?php echo form_error('email', '<span class="help-block" style="color:#ff6666;">', '</span>'); ?>
                            <br/>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <br/>
                            <label for="fname"><i style="color:#ff6666;">*</i> Last Name: </label> <br/>
                            <input type="text" name="lname" style="width:100%" class="form-control emails_only" value="" placeholder="Last Name" required>
                            <br/>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <br/>
                            <label for="email"><i style="color:#ff6666;">*</i> <?= lang('reg.18'); ?>: </label> <br/>
                            <input type="email" name="email" style="width:100%" class="form-control emails_only" data-toggle="tooltip" title="<?= lang('reg.19'); ?>" value="<?php echo set_value('email') ?>" placeholder="Your email address" required>
                            <br/>
                            <br/>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                            <br/>
                            <label for="contactNo"><i style="color:#ff6666;">*</i> Contact #: </label> <br/>
                            <input type="contactNo" name="contactNo" style="width:100%" class="form-control emails_only" data-toggle="tooltip" title="<?= lang('reg.19'); ?>" value="<?php echo set_value('email') ?>" placeholder="Mobile or Landline" required>
                            <br/>
                            <br/>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pwField" id="passwordField">
                            <label for="password"><i style="color:#ff6666;">*</i> <?= lang('reg.05'); ?>: </label> <br/>
                            <input type="password" name="password" style="width:100%" id="password" class="form-control"  data-toggle="tooltip" title="<?= lang('reg.05'); ?>" placeholder="<?= lang('reg.05'); ?>" >
                            <?php echo form_error('password', '<span class="help-block" style="color:#ff6666;">', '</span>'); ?>
                            <br/>
                            <br/>
                        </div>

                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 pwField">
                            <label for="cpassword"><i style="color:#ff6666;">*</i> <?= lang('reg.07'); ?>: </label> <br/>
                            <input type="password" name="cpassword" style="width:100%" id="cpassword" class="form-control" data-toggle="tooltip" title="<?= lang('reg.08'); ?>" placeholder="<?= lang('reg.09'); ?>" >
                            <?php echo form_error('cpassword', '<span class="help-block" style="color:#ff6666;">', '</span>'); ?> <span class="help-block" id="lcpassword"></span>
                            <br/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading" >
                                    <div class="row" >
                                        <div class="col-md-4">
                                            <div class="newAcct_cbx">
                                            <input type="checkbox" name="newAcct" value="1" onclick="createMeAccount()">&nbsp;Create Me JobKonek account!
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="submit" value="Send My Application" class="btn btn-hotel btn-md btn-block sendApplicationBtn" />
                                        </div>
                                        <div class="col-md-4"></div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="col-lg-3 hidden-xs hidden-sm hidden-md">
        <div class="panel panel-og">
            <div class="panel-heading">ADS</div>
            <img class="img-responsive" src="<?= IMAGEPATH.'contactus/customer-support.jpg' ?>" style="width: 100%"/>
        </div>
    </div>
</div>

<script type="text/javascript">        
        $('.pwField').hide();        
        var pwFieldFlag = false;
        function createMeAccount(){
            if(!pwFieldFlag){
                $('.pwField').show();
                $('#password').attr('required',true);
                $('#cpassword').attr('required',true);
                
                $('.newAcct_cbx').hide();
                pwFieldFlag = true;   
                $('.sendApplicationBtn').attr('disabled',true);
            }else{

                $('.pwField').hide(); 
                pwFieldFlag = false;  
                $('#password').attr('required',false);
                $('#cpassword').attr('required',false); 

            }
        }

    $(document).ready(function() {
        //password press
        $("#cpassword").keyup(checkPass);
        $("#password").keyup(checkPass);

        //check if passwords match
        function checkPass() {
            //Store the password field objects into variables ...
            var pass1 = document.getElementById('password');
            var pass2 = document.getElementById('cpassword');
            //Store the Confimation Message Object ...
            var message = document.getElementById('lcpassword');
            //Set the colors we will be using ...
            var goodColor = "#66cc66";
            var badColor = "#ff6666";
            //Compare the values in the password field
            //and the confirmation field
            if (pass1.value == "" || pass2.value == "") {
                pass2.style.backgroundColor = "";
                message.innerHTML = "";
            } else if (pass1.value == pass2.value) {
                //The passwords match.
                //Set the color to the good color and inform
                //the user that they have entered the correct password
                //pass2.style.backgroundColor = goodColor;
                message.style.color = goodColor;
                message.innerHTML = "Passwords match!"
                $('.sendApplicationBtn').attr('disabled',false);
            } else {
                //The passwords do not match.
                //Set the color to the bad color and
                //notify the user.
                //pass2.style.backgroundColor = badColor;
                message.style.color = badColor;
                message.innerHTML = "Passwords do not match!"
                
            }
        }
    });
    
</script>