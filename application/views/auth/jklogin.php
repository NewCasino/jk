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
    <div class="col-lg-3 hidden-xs hidden-sm hidden-md">
        <div class="panel panel-og">
            <div class="panel-heading">IT Tutorial</div>
            <img class="img-responsive" src="<?= IMAGEPATH.'contactus/customer-support.jpg' ?>" style="width: 100%"/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-og">
            <div class="panel-heading">
                Member Login
            </div>
            <div class="panel-body">
                <?php echo form_open(BASEURL . $this->uri->uri_string()); ?>

                <div class="col-md-12" style="margin-top:10px; ">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                                <input type="text" name="username" class="form-control" placeholder="Username" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                                <input type="text" style="width:100%" name="password" class="form-control" placeholder="Password" />
                        </div>
                    </div>
                    <center>
                        <div class="form-group form-inline">
                            <div id="container" class="col-md-5 pull-right" style="text-align:right">
                                <input type="submit" name="username" value="Submit" class="form-control btn btn-hotel" placeholder="Username" />
                                <a href="<?= BASEURL . 'auth/register' ?>" class="form-control btn btn-hotel">Register</a>
                            </div>
                            <div id="container" class="col-md-5" style="text-align:center">
                                
                            </div>
                        </div>
                    </center>
                </div>
                

                <?php echo form_close(); ?>
            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
    <div class="col-lg-3 hidden-xs hidden-sm hidden-md">
        <div class="panel panel-og">
            <div class="panel-heading">Hot Deals</div>
            <img class="img-responsive" src="<?= IMAGEPATH.'contactus/customer-support.jpg' ?>" style="width: 100%"/>
        </div>
    </div>
</div>