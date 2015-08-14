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
    <div class="col-lg-3 hidden-xs hidden-sm col-md-3">
        <div class="panel panel-og">
            <div class="panel-heading">ADS</div>
            <img class="img-responsive" src="<?= IMAGEPATH.'contactus/customer-support.jpg' ?>" style="width: 100%"/>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
        <div class="panel panel-og">
            <div class="panel-heading">
                <span class="panel-title"><?= lang('reg.01'); ?></span>
                <span class="help-block pull-right" style="color:#ff6666;"><?= lang('reg.02'); ?></span>
                <div class="clearfix"></div>
            </div>

            <div class="panel panel-body" id="add_player_panel_body">
                <form method="post" action="<?= BASEURL . 'auth/postRegisterMember'?>" id="my_form" autocomplete="off" roel="form" class="form-inline" name="form">
                    <input type="hidden" value="normal" name="level">
                    <div class="row" style="text-align:center">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <br/>
                            <label for="email"><i style="color:#ff6666;">*</i> <?= lang('reg.18'); ?>: </label> <br/>
                            <input type="email" name="email" style="width:100%" class="form-control emails_only" data-toggle="tooltip" title="<?= lang('reg.19'); ?>" value="<?php echo set_value('email') ?>" placeholder="Your email address" required>
                            <?php echo form_error('email', '<span class="help-block" style="color:#ff6666;">', '</span>'); ?>
                            <br/>
                            <br/>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" id="passwordField">
                            <label for="password"><i style="color:#ff6666;">*</i> <?= lang('reg.05'); ?>: </label> <br/>
                            <input type="password" name="password" style="width:100%" id="password" class="form-control"  data-toggle="tooltip" title="<?= lang('reg.05'); ?>" placeholder="<?= lang('reg.05'); ?>" required>
                            <?php echo form_error('password', '<span class="help-block" style="color:#ff6666;">', '</span>'); ?>
                            <br/>
                            <br/>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="cpassword"><i style="color:#ff6666;">*</i> <?= lang('reg.07'); ?>: </label> <br/>
                            <input type="password" name="cpassword" style="width:100%" id="cpassword" class="form-control" data-toggle="tooltip" title="<?= lang('reg.08'); ?>" placeholder="<?= lang('reg.09'); ?>" required>
                            <?php echo form_error('cpassword', '<span class="help-block" style="color:#ff6666;">', '</span>'); ?> <span class="help-block" id="lcpassword"></span>
                            <br/>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="first_name"><i style="color:#ff6666;">*</i> <?= lang('reg.10'); ?>: </label> <br/>                            
                            <input type="text" name="first_name" style="width:100%" id="first_name" class="form-control letters_only" value="<?php echo set_value('first_name') ?>" placeholder="<?= lang('reg.10'); ?>" required>
                            <?php echo form_error('first_name', '<span class="help-block" style="color:#ff6666;">', '</span>'); ?>
                            <br/>
                            <br/>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <label for="last_name"><i style="color:#ff6666;">*</i> <?= lang('reg.11'); ?>: </label> <br/>                            
                            <input type="text" name="last_name" style="width:100%" id="last_name" class="form-control letters_only" value="<?php echo set_value('last_name') ?>" placeholder="<?= lang('reg.11'); ?>" required>
                            <?php echo form_error('last_name', '<span class="help-block" style="color:#ff6666;">', '</span>'); ?>
                            <br/>
                            <br/>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading" >
                                    <div class="row" >
                                        <div class="col-md-12" style="text-align:center" >
                                            <input type="submit" value="Sign up" id="accept" class="btn btn-hotel btn-md btn-block">
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="col-lg-3 hidden-xs hidden-sm col-md-3">
        <div class="panel panel-og">
            <div class="panel-heading">ADS</div>
            <img class="img-responsive" src="<?= IMAGEPATH.'contactus/customer-support.jpg' ?>" style="width: 100%"/>
        </div>
    </div>
</div>