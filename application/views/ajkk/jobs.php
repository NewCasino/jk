<div class="row">
	<div class="col-lg-3">
		<div class="panel panel-og">
			<div class="panel-heading"><?= lang('cu.15'); ?></div>
			<img class="img-responsive" src="<?= IMAGEPATH.'contactus/customer-support.jpg' ?>" style="width: 100%"/>
		</div>

		<!-- <div class="panel panel-og">
			<div class="panel-heading"><?= lang('cashier.16'); ?></div>
			<div class="panel-body">
				<form>
					<div class="form-group">
						<label class="control-label required"><?= lang('cu.10'); ?></label>
						<input type="text" class="form-control" />
					</div>
					<div class="form-group">
						<label class="control-label required"><?= lang('cu.11'); ?></label>
						<input type="text" class="form-control" />
					</div>
					<div class="form-group">
						<label class="control-label required"><?= lang('cu.12'); ?></label>
						<input type="text" class="form-control" />
					</div>
					<div class="form-group">
						<label class="control-label required"><?= lang('cu.13'); ?></label>
						<input type="text" class="form-control" />
					</div>
					<div class="form-group">
					<button type="submit" class="btn btn-sm btn-default"><?= lang('cu.14'); ?></button>
					</div>
				</form>
			</div>
		</div> -->
	</div>

	<div class="col-lg-9">
		<div class="panel panel-og">
			<div class="panel-heading">FREELANCE JOBS</div>
			<div class="panel-body">
				<p><?= lang('cashier.2'); ?></p>
				<p><?= lang('cashier.3'); ?></p>
				<hr/>
				<form class="form-horizontal" action="<?= BASEURL . 'online/sendMessage'?>" method="POST">
					<div class="form-group">
						<label class="col-sm-2 control-label required" style="text-align: left;"><?= lang('cu.4'); ?></label>
						<div class="col-sm-6">
							<input type="text" class="form-control contact_name" name="name" placeholder="<?= lang('cu.17'); ?>" />
							<label class="input-sm" style="color:red"><?= form_error('name');?></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label required" style="text-align: left;"><?= lang('cu.5'); ?></label>
						<div class="col-sm-6">
							<input type="text" class="form-control contact_email" name="email" placeholder="<?= lang('cu.18'); ?>" />
							<label class="input-sm" style="color:red"><?= form_error('email');?></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label required" style="text-align: left;"><?= lang('cu.13'); ?></label>
						<div class="col-sm-6">
							<input type="text" class="form-control contact_subject" name="subject" placeholder='<?= lang('cu.13'); ?>' />
							<label class="input-sm" style="color:red"><?= form_error('subject');?></label>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label required" style="text-align: left;"><?= lang('cu.7'); ?></label>
						<div class="col-sm-6">
							<textarea class="form-control contact_msg" name="message" placeholder='<?= lang('cu.8'); ?>'></textarea>  
							<label class="input-sm" style="color:red"><?= form_error('message');?></label>
						</div>
					</div>

					<div class="form-group form-inline">
						<div class="col-sm-offset-2 col-sm-7">
							<input type="submit" value="<?= lang('cu.19'); ?>" class="btn btn-default" />                                
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>