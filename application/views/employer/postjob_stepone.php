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
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> JOB SUMMARY</h4>
	                
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body">
						<form method="post" action="<?= BASEURL . 'employers/postNewJob'?>" autocomplete="off" role="form" class="form-inline" name="form">
							<?php //echo $this->tinyMce;?>
							<div class="col-md-12">
									<br />
									<label for="job_title"><strong>Job Title</strong> <span class="required">*</span></label>
									<?php echo form_error('job_title'); ?>
									<br /><input id="job_title" type="text" class="form-control" style="width:100%" required name="job_title" value="<?= $this->session->userdata('job_title') == '' ? '' : $this->session->userdata('job_title'); ?>" />
									<br />
							</div>
							
							<div class="col-md-12">
								<br />
									<label for="job_overview"><strong>Job Overview</strong> <span class="required">*</span></label>
								<?php echo form_error('job_overview'); ?>
								<br />
								<textarea style="width:100%" rows='2' maxLength='300' name='job_overview' class="form-control" id='job_overview'></textarea>
								<br />
							</div>
							
							<div class="col-md-12">
								<br />
									<strong>Location</strong> <span class="required">*</span>
									<?php echo form_error('location_region'); ?>
			                        <br />
			                        <select style="width:100%" data-placeholder="Location" class="chosen-select-deselect form-control" required name="location_region">
			                                <option value="">--Select Location--</option>
			                                <optgroup label="Local">
			                                  <option value="1" >ARMM</option>
			                                  <option value="2" >Bicol Region</option>
			                                  <option value="3" >C.A.R</option>
			                                  <option value="4" >Cagayan Valley</option>
			                                  <option value="5" >Calabarzon</option>
			                                  <option value="6" >Caraga</option>
			                                  <option value="7" >Central Luzon</option>
			                                  <option value="32" >Central Mindanao</option>
			                                  <option value="8" >Central Visayas</option>                                     
			                                  <option value="9" >Eastern Visayas</option>
			                                  <option value="10" >Ilocos Region</option>
			                                  <option value="11" >N.C.R</option>
			                                  <option value="12" >Nothern Mindanao</option>                          
			                                  <option value="13" >Southern Mindanao</option>
			                                  <option value="14" >Southern Tagalog</option>
			                                  <option value="15" >Western Mindanao</option>
			                                  <option value="16" >Western Visayas</option>                                                                               
			                                </optgroup>
			        
			                                <optgroup label="Abroad (Asia)">
			                                  <option value="17" >China</option>
			                                  <option value="18" >Hongkong</option>
			                                  <option value="19" >India</option>
			                                  <option value="20" >Indonesia</option>
			                                  <option value="21" >Japan</option>
			                                  <option value="22" >Malaysia</option>
			                                  <option value="23" >Singapore</option>
			                                  <option value="24" >Thailand</option>
			                                  <option value="25" >Vietnam</option>
			                                </optgroup>
			        
			                                <optgroup label="Abroad (Other)">
			                                  <option value="26" >Africa</option>
			                                  <option value="27" >Middle East</option>
			                                  <option value="28" >Australia & New Zealand</option>
			                                  <option value="29" >Europe</option>
			                                  <option value="30" >North America</option>
			                                  <option value="31" >South America</option>                                  
			                                </optgroup>                                           
			                        </select>
			                        <br />
							</div>                                             

							<div class="col-md-12">
								<br />
									<strong>City</strong> <span class="required">*</span>
									<?php echo form_error('location_city'); ?>
			                        <br />
			                        <input type="text" style="width:100%" name="location_city" class="form-control" required />
			                        <br />
							</div>
													
							<div class="col-md-12">
								<br />
									<label for="company_name"><strong>Company Name</strong> <span class="required">*</span></label>
									<?php echo form_error('company_name'); ?>
									<br /><input id="company_name" style="width:100%" class="form-control" required type="text" name="company_name" maxlength="30" size="40" value="<?php  echo ucwords($comp_name['comp_name']); ?>" />
									<br/><br/><br/>
							</div>
							
							<div class="col-md-2"></div>
							<div class="col-md-4">
					            <a href="<?= BASEURL . 'employers/home' ?>" class="btn btn-block btn-md btn-danger" >Cancel</a>
					            <br />
					    	</div>
			                <div class="col-md-4">
									
									<input type="submit" value="Next" class="btn btn-block btn-md btn-primary" />
									<br />
							</div>	
							<div class="col-md-2"></div>				
						</form>
				</div>
		</div>
	</div>
	<div class="col-lg-2"></div>
</div> <!-- main -->