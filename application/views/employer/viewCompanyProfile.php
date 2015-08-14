<div class="row">
	<div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="panel panel-default" style="overflow: auto">
	        	<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-cog"></span> COMPANY PROFILE</h4>
	                <div class="pull-right"><a href="<?= BASEURL.'employers/employerProfile' ?>" class="btn btn-info btn-xs"><i class="glyphicon glyphicon-edit"></i>&nbsp;Edit</a></div>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body">
						<div class="col-md-12">
								<label for="company_name"><strong>Company Name</strong> <span class="required">*</span></label>
								<br />
								<input id="company_name" style="width:100%" class="form-control" required type="text" name="company_name" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['comp_name']); ?>" readonly/>						
						</div>

						<div class="col-md-12">
							<br />	
							<label for="comp_desc"><strong>Description</strong> <span class="required">*</span></label>
							<br />
							<textarea style="width:100%" rows='5' name='comp_desc' class="form-control" id='comp_desc' readonly><?= $empInfo['empDetails']['comp_desc']; ?></textarea>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
									<br />							
									<label for="comp_nature"><strong>Nature of Business</strong> <span class="required">*</span></label>
									<br />
									<input id="company_name" style="width:100%" class="form-control" required type="text" name="company_name" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['comp_nature']); ?>" readonly/>
								</div>

								<div class="col-md-6">
									<br />
									<label for="comp_type"><strong>Company Type</strong> <span class="required">*</span></label>
									<br />
									<input id="company_name" style="width:100%" class="form-control" required type="text" name="company_name" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['comp_type']); ?>" readonly/>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<br />	
							<label for="address"><strong>Company Address</strong> <span class="required">*</span></label>
							<textarea style="width:100%" rows='2' name='address' class="form-control" id='address' readonly><?= $empInfo['empDetails']['address']; ?></textarea>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
									<br />
									<label for="city"><strong>City</strong> <span class="required">*</span></label>
									<br />
									<input id="city" style="width:100%" class="form-control" required type="text" name="city" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['city']); ?>" readonly />
								</div>

								<div class="col-md-6">
										<br />
										<strong>Region/State</strong> <span class="required">*</span>
				                        <br />
				                        <input id="city" style="width:100%" class="form-control" required type="text" name="city" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['state']); ?>" readonly />
								</div> 

							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<br/>
								<div class="col-md-6">
										<strong>Country</strong> <span class="required">*</span>
				                        <br />
				                        <input id="city" style="width:100%" class="form-control" required type="text" name="country" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['country']); ?>" readonly />
				                        <br />
								</div>

								<div class="col-md-6">
									<label for="zipcode"><strong>Zip Code</strong></label>
									<br /><input id="zipcode" style="width:100%" class="form-control" type="number" name="zipcode" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['zipcode']); ?>" readonly />
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
									<div class="col-md-6">
										<br />							
										<label for="phone"><strong>Phone/Mobile Number</strong> <span class="required">*</span></label>
										<br />
										<input id="phone" placeholder="landline or mobile" style="width:100%" class="form-control" required type="number" name="phone" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['phone']); ?>" readonly />				
									</div>

									<div class="col-md-6">
										<br />
										<label for="email"><strong>Email</strong> <span class="required">*</span></label>
										<br /><input id="email" style="width:100%" class="form-control" required type="email" name="email" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['email']); ?>" readonly />
									</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-md-12">
									<div class="col-md-4">
										<br />
										<label for="fax"><strong>Fax</strong></label>
										<br /><input id="fax" style="width:100%" class="form-control" type="number" name="fax" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['fax']); ?>" readonly />												
									</div>

									<div class="col-md-4">
										<br />
										<label for="business_regno"><strong>Business Registration #</strong></label>
										<br /><input id="business_regno" style="width:100%" class="form-control" type="number" name="business_regno" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['business_regno']); ?>" readonly />
										
									</div>

									<div class="col-md-4">
										<br />
										<label for="organization"><strong>Organization</strong></label>
										<br />
										<input id="organization" style="width:100%" class="form-control" type="text" name="organization" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['organization']); ?>" readonly />
									</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
									<div class="col-md-4">
										<br />	
										<label for="comp_size"><strong>Company Size</strong><span class="required">*</span></label>
										<input id="organization" style="width:100%" class="form-control" type="text" name="comp_size" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['comp_size']); ?>" readonly />
										<br />
									</div>

									<div class="col-md-4">
										<br />	
										<label for="dress_code"><strong>Dress Code</strong><span class="required">*</span></label>
										<?php echo form_error('dress_code'); ?>
										<br />
										<input id="organization" style="width:100%" class="form-control" type="text" name="dress_code" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['dress_code']); ?>" readonly />
									</div>

									<div class="col-md-4">
										<br />	
										<label for="working_hrs"><strong>Working Hrs</strong></label>
										<?php echo form_error('working_hrs'); ?>
										<br />
										<input id="organization" style="width:100%" class="form-control" type="text" name="working_hrs" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['working_hrs']); ?>" readonly />
									</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
									<div class="col-md-4">
										<br />
										<label for="spoken_lang"><strong>Spoken Language</strong><span class="required">*</span></label>
										<?php echo form_error('spoken_lang'); ?>
										<br />
										<input id="organization" style="width:100%" class="form-control" type="text" name="working_hrs" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['spoken_lang']); ?>" readonly />
									</div>

									<div class="col-md-8">
										<br />
										<label for="website"><strong>Website</strong></label>
										<?php echo form_error('website'); ?>
										<br />
										<input id="website" style="width:100%" placeholder='Ex: www.jobkonek.com' class="form-control" type="text" name="website" maxlength="30" value="<?php echo $empInfo['empDetails']['website']; ?>" readonly />
									</div>							
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">						
									<div class="col-md-4">
										<br />
										<label for="contact_person"><strong>Contact Person</strong><span class="required">*</span></label>
										<?php echo form_error('contact_person'); ?>
										<br /><input id="contact_person" style="width:100%" class="form-control" required type="text" name="contact_person" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['contact_person']); ?>" readonly />				
										<br />
									</div>

									<div class="col-md-8">
										<br />
										<label for="contact_person_mobilenum"><strong>Contact Person Number</strong><span class="required">*</span></label>
										<?php echo form_error('contact_person_mobilenum'); ?>
										<br /><input id="contact_person_mobilenum" placeholder='landline or cellphone' style="width:100%" class="form-control" required type="number" name="contact_person_mobilenum" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['contact_person_mobilenum']); ?>" readonly />
										<br />
									</div>									
							</div>												
						</div>
				</div>				
		</div>
		
	</div>
	<div class="col-lg-2"></div>
</div> <!-- main -->