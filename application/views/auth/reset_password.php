<form action="<?= BASEURL . 'auth/verifyResetPassword/' . $player['playerId'] ?>" method="POST">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<label><?= lang('forgot.08'); ?></label>
		</div>
	</div>

	<br/>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<span for="new_password"><?= lang('forgot.09'); ?>: </span>
			<input type="password" name="new_password" class="form-control"/>
			<span class="input-sm" style="color: red;"><?= form_error('new_password'); ?></span>
		</div>
	</div>

	<br/>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<span for="confirm_password"><?= lang('forgot.10'); ?>: </span>
			<input type="password" name="confirm_password" class="form-control"/>
			<span class="input-sm" style="color: red;"><?= form_error('confirm_password'); ?></span>
		</div>
	</div>

	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<input type="hidden" name="playerId" value="<?= $player['playerId'] ?>"/>
			<input type="hidden" name="username" value="<?= $player['username'] ?>"/>
			<input type="submit" class="btn btn-success" value="<?= lang('forgot.08'); ?>"/>
		</div>
	</div>

	<br/>
</form>