<div class="row">
    <div class="col-md-12">
        <div class="panel panel-og">
            <div class="panel-heading">
                <h4 class="panel-title pull-left"><?= lang('lang.forgotpasswd'); ?></h4>
                <div class="clearfix"></div>
            </div>

            <div class="panel panel-body" id="add_player_panel_body">
                <span class="help-block" style="color:#ff6666;"><?= lang('reg.02'); ?></span>

					<form action="<?= BASEURL . 'auth/securityQuestion' ?>" method="POST">
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<label><?= lang('forgot.01'); ?></label>
							</div>
						</div>

						<br/>

						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<span for="username"><?= lang('forgot.02'); ?>: </span>
								<input type="text" name="username" class="form-control"/>
								<span class="input-sm" style="color: red;"><?= form_error('username'); ?></span>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<input type="submit" class="btn btn-success" value="<?= lang('forgot.03'); ?>"/>
							</div>
						</div>

						<br/>
					</form>
			</div>
		</div>
	</div>
</div>