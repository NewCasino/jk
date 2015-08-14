<div class="row">
    <div class="col-md-12">
        <div class="panel panel-og">
            <div class="panel-heading">
                <h4 class="panel-title pull-left"><?= lang('lang.forgotpasswd'); ?></h4>
                <div class="clearfix"></div>
            </div>

            <div class="panel panel-body" id="add_player_panel_body">
                <span class="help-block" style="color:#ff6666;"><?= lang('reg.02'); ?></span>


					<form action="<?= BASEURL . 'auth/resetPassword/' . $player['playerId'] ?>" method="POST">
						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<label><?= lang('forgot.04'); ?></label>
							</div>
						</div>

						<br/>

						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<span for="secret_answer"><?= lang('forgot.05'); ?>: <i><?= $player['secretQuestion'] ?></i> </span>
							</div>
						</div>

						<br/>

						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<span for="secret_answer"><?= lang('forgot.06'); ?>: </span>
								<input type="password" name="secret_answer" class="form-control"/>
								<span class="input-sm" style="color: red;"><?= form_error('secret_answer'); ?></span>
							</div>
						</div>

						<br/>

						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<span for="confirm_secret_answer"><?= lang('forgot.07'); ?>: </span>
								<input type="password" name="confirm_secret_answer" class="form-control"/>
								<span class="input-sm" style="color: red;"><?= form_error('confirm_secret_answer'); ?></span>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<i>Forgot your secret answer? Ask administrator to reset your password. <a href="<?= BASEURL . 'online/contactus' ?>">Contact Us</a></i>
							</div>
						</div>

						<br/>

						<div class="row">
							<div class="col-md-6 col-md-offset-3">
								<input type="hidden" name="playerId" value="<?= $player['playerId'] ?>"/>
								<input type="hidden" name="username" value="<?= $player['username'] ?>"/>
								<input type="submit" class="btn btn-success" value="<?= lang('forgot.03'); ?>"/>
							</div>
						</div>

						<br/>
					</form>

				</div>
		</div>
	</div>
</div>