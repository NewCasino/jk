<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			<b>Step 1 - Job Summary </b> / Step 2 - Job Details / Step 3 - Finalized
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<div class="row">
	<div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="panel panel-default" style="overflow: auto">
	        	<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> EDIT JOB SUMMARY</h4>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body">
						<form method="post" action="<?= BASEURL . 'employers/postJobUpdate'?>" autocomplete="off" role="form" class="form-inline" name="form">
							<?php //echo $this->tinyMce;?>
							<div class="col-md-12">
									<br />
									<label for="job_title"><strong>Job Title</strong> <span class="required">*</span></label>
									<?php echo form_error('job_title'); ?>
									<br />
									<input id="jobId" type="hidden" class="form-control" style="width:100%" required name="jobId" maxlength="64" value="<?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['jobId'] : '' ?>" />
									<input id="job_title" type="text" class="form-control" style="width:100%" required name="job_title" value="<?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['job_title'] : '' ?>" />
									<br />
							</div>
							
							<div class="col-md-12">
								<br />
									<label for="job_overview"><strong>Job Overview</strong> <span class="required">*</span></label>
								<?php echo form_error('job_overview'); ?>
								<br />
								<textarea style="width:100%" rows='2' maxLength='300' name='job_overview' class="form-control" id='job_overview'><?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['job_overview'] : '' ?></textarea>
								<br />
							</div>
							
							<div class="col-md-12">
								<br />
									<strong>Region</strong> <span class="required">*</span>
									<?php echo form_error('location_region'); ?>
			                        <br />
			                        <select style="width:100%" data-placeholder="Location" class="chosen-select-deselect form-control" required name="location_region">
			                                <option value="">Select Region</option>
			                                <optgroup label="Local">
			                                  <option value="1" <?= $this->session->userdata('location_region') == '1' ? 'selected' : ''?>>ARMM</option>
			                                  <option value="2" <?= $this->session->userdata('location_region') == '2' ? 'selected' : ''?>>Bicol Region</option>
			                                  <option value="3" <?= $this->session->userdata('location_region') == '3' ? 'selected' : ''?>>C.A.R</option>
			                                  <option value="4" <?= $this->session->userdata('location_region') == '4' ? 'selected' : ''?>>Cagayan Valley</option>
			                                  <option value="5" <?= $this->session->userdata('location_region') == '5' ? 'selected' : ''?>>Calabarzon</option>
			                                  <option value="6" <?= $this->session->userdata('location_region') == '6' ? 'selected' : ''?>>Caraga</option>
			                                  <option value="7" <?= $this->session->userdata('location_region') == '7' ? 'selected' : ''?>>Central Luzon</option>
			                                  <option value="8" <?= $this->session->userdata('location_region') == '8' ? 'selected' : ''?>>Central Visayas</option>                                     
			                                  <option value="9" <?= $this->session->userdata('location_region') == '9' ? 'selected' : ''?>>Eastern Visayas</option>
			                                  <option value="10" <?= $this->session->userdata('location_region') == '10' ? 'selected' : ''?>>Ilocos Region</option>
			                                  <option value="11" <?= $this->session->userdata('location_region') == '11' ? 'selected' : ''?>>N.C.R</option>
			                                  <option value="12" <?= $this->session->userdata('location_region') == '12' ? 'selected' : ''?>>Nothern Mindanao</option>                          
			                                  <option value="13" <?= $this->session->userdata('location_region') == '13' ? 'selected' : ''?>>Southern Mindanao</option>
			                                  <option value="14" <?= $this->session->userdata('location_region') == '14' ? 'selected' : ''?>>Southern Tagalog</option>
			                                  <option value="15" <?= $this->session->userdata('location_region') == '15' ? 'selected' : ''?>>Western Mindanao</option>
			                                  <option value="16" <?= $this->session->userdata('location_region') == '16' ? 'selected' : ''?>>Western Visayas</option>                                                                               
			                                </optgroup>
			        
			                                <optgroup label="Abroad (Asia)">
			                                  <option value="17" <?= $this->session->userdata('location_region') == '17' ? 'selected' : ''?>>China</option>
			                                  <option value="18" <?= $this->session->userdata('location_region') == '18' ? 'selected' : ''?>>Hongkong</option>
			                                  <option value="19" <?= $this->session->userdata('location_region') == '19' ? 'selected' : ''?>>India</option>
			                                  <option value="20" <?= $this->session->userdata('location_region') == '20' ? 'selected' : ''?>>Indonesia</option>
			                                  <option value="21" <?= $this->session->userdata('location_region') == '21' ? 'selected' : ''?>>Japan</option>
			                                  <option value="22" <?= $this->session->userdata('location_region') == '22' ? 'selected' : ''?>>Malaysia</option>
			                                  <option value="23" <?= $this->session->userdata('location_region') == '23' ? 'selected' : ''?>>Singapore</option>
			                                  <option value="24" <?= $this->session->userdata('location_region') == '24' ? 'selected' : ''?>>Thailand</option>
			                                  <option value="25" <?= $this->session->userdata('location_region') == '25' ? 'selected' : ''?>>Vietnam</option>
			                                </optgroup>
			        
			                                <optgroup label="Abroad (Other)">
			                                  <option value="26" <?= $this->session->userdata('location_region') == '26' ? 'selected' : ''?>>Africa</option>
			                                  <option value="27" <?= $this->session->userdata('location_region') == '27' ? 'selected' : ''?>>Middle East</option>
			                                  <option value="28" <?= $this->session->userdata('location_region') == '28' ? 'selected' : ''?>>Australia & New Zealand</option>
			                                  <option value="29" <?= $this->session->userdata('location_region') == '29' ? 'selected' : ''?>>Europe</option>
			                                  <option value="30" <?= $this->session->userdata('location_region') == '30' ? 'selected' : ''?>>North America</option>
			                                  <option value="31" <?= $this->session->userdata('location_region') == '31' ? 'selected' : ''?>>South America</option>                                  
			                                </optgroup>                                           
			                        </select>
			                        <br />
							</div>                                             

							<div class="col-md-12">
								<br />
									<strong>City</strong> <span class="required">*</span>
									<?php echo form_error('location_city'); ?>
			                        <br />
			                        <input type="text" style="width:100%" name="location_city" class="form-control" required value="<?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['location_city'] : '' ?>" />
			                        <br />
							</div>
													
							<div class="col-md-12">
								<br />
									<label for="company_name"><strong>Company Name</strong> <span class="required">*</span></label>
									<?php echo form_error('company_name'); ?>
									<br /><input id="company_name" style="width:100%" class="form-control" required type="text" name="company_name" maxlength="30" size="40" value="<?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['company_name'] : '' ?>" />
									<br/><br/><br/>
							</div>
							
							<div class="col-md-2"></div>
							<div class="col-md-4">
					            <a href="<?= BASEURL . 'employers/home' ?>" class="btn btn-block btn-md btn-danger" >Cancel</a>
					            <br />
					    	</div>
			                <div class="col-md-4">
									
									<input type="submit" value="Save" class="btn btn-block btn-md btn-primary" />
									<br />
							</div>	
							<div class="col-md-2"></div>				
						</form>
				</div>
		</div>
	</div>
	<div class="col-lg-2"></div>
</div> <!-- main -->