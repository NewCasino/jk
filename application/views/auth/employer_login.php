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
    <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
        <div class="panel panel-og">
            <div class="panel-heading">IT Tutorial</div>
            <img class="img-responsive" src="<?= IMAGEPATH.'contactus/customer-support.jpg' ?>" style="width: 100%"/>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-og">
            <div class="panel-heading">
                Employer's Login
            </div>
            <div class="panel-body">
            <form method="post" action="<?= BASEURL . 'auth/loginEmployer'?>">
                <div class="col-md-12" style="margin-top:10px; ">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                                <input type="email" name="login" class="form-control" placeholder="Username" required/>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-lock"></span>
                            </div>
                                <input type="password" style="width:100%" name="password" class="form-control" placeholder="Password" required/>
                        </div>
                    </div>
                        <div class="form-group form-block">
                            <div id="container" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align:right">
                                <input type="submit" name="submit" value="&nbsp;&nbsp;&nbsp;&nbsp;Submit&nbsp;&nbsp;" class="form-control btn btn-block btn-hotel" placeholder="Username" />
                            </div>
                            <div id="container" class="col-xs-6 col-sm-6 col-md-6 col-lg-6" style="text-align:center">
                                <a href="<?= BASEURL . 'auth/register/employer' ?>" class="form-control btn btn-block btn-success">Register</a>
                            </div>
                        </div>
                </div>
                </form>                

            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
    <div class="col-md-3 col-lg-3 hidden-xs hidden-sm">
        <div class="panel panel-og">
            <div class="panel-heading">Hot Deals</div>
            <img class="img-responsive" src="<?= IMAGEPATH.'contactus/customer-support.jpg' ?>" style="width: 100%"/>
        </div>
    </div>
</div>