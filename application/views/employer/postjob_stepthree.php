<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			Step 1 - Job Summary / Step 2 - Job Details / <b>Step 3 - Preview</b> / Step 3 - Finalized
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<form method="post" action="<?= BASEURL . 'employers/availJobPromo'?>" autocomplete="off" role="form" class="form-inline" name="form">
	<div class="row">
		<div class="col-lg-2"></div>
	    <div class="col-lg-8">
	        <div class="panel panel-default" style="overflow: auto">
	        	<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-list-alt"></span> JOB REVIEW</h4>
	                <a href="<?= BASEURL . 'employers/postJob/5/'.$jobInfo['jobDetails']['jobId'] ?>">
	                	<span class='pull-right btn btn-sm btn-info glyphicon glyphicon-edit' data-toggle="tooltip" title="Edit Project" data-placement="top"></span>
	                </a>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body">
	            <table class="table table-striped table-hover">
	            	<tr>
	            		<td style="padding-right:10px; width:25%;"><label for="job title">Job Title</label></td>
	            		<td><?= strtoupper($jobInfo['jobDetails']['job_title']); ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="location">Job Location</label></td>
	            		<td style="padding-right:10px; maxWidth:80%;"><?= ucwords($jobInfo['jobDetails']['location_city'].', '.$jobInfo['jobDetails']['location_region']); ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="description">Job Overview</label></td>
	            		<td><?= $jobInfo['jobDetails']['job_overview']; ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="job_desc">Job Description </label></td>
	            		<td><?= $jobInfo['jobDetails']['job_desc'] ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="company_name">Company Name</label></td>
	            		<td><?= strtoupper($jobInfo['jobDetails']['company_name']) ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="vacancy_num">Vacancy #</label></td>
	            		<td><?= $jobInfo['jobDetails']['vacancy_num'] ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="specialization">Specialization </label></td>
	            		<td><?= $jobInfo['jobDetails']['specialization'] ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="position_level">Position Level </label></td>
	            		<td><?= $jobInfo['jobDetails']['position_level'] ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="sked_type">Schedule Type </label></td>
	            		<td><?= $jobInfo['jobDetails']['sked_type'] ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="yr_exp">Yrs of Experience </label></td>
	            		<td><?= $jobInfo['jobDetails']['yr_exp'] ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="experience_req">Experience Requirements</label></td>
	            		<td><?= $jobInfo['jobDetails']['experience_req'] ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="additional_job_req">Additional Job Requirements</label></td>
	            		<td><?php if($jobInfo['jobDetails']['additional_job_req'] != ''){
	            			 		echo $jobInfo['jobDetails']['additional_job_req'];
	            			 	}else{
	            			 		echo 'No Additional Requirements';
	            			 	}
	            		    ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="salary">Salary</label></td>
	            		<td><?= $jobInfo['jobDetails']['currency'].' '.$jobInfo['jobDetails']['salary_min'].' - '.$jobInfo['jobDetails']['salary_max'].' '.$jobInfo['jobDetails']['salary_base'].', '.$jobInfo['jobDetails']['salary_type'] ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="salary">Show Salary</label></td>
	            		<td><?= $jobInfo['jobDetails']['show_salary'] == 0 ? 'Yes' : 'No' ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="salary">Hiring Duration</label></td>
	            		<td><?= $jobInfo['jobDetails']['date_posted'].' to '.$jobInfo['jobDetails']['date_expiry']  ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="salary">Education Requirements</label></td>
	            		<td><?php if(count($jobInfo['jobDetails']['jobEducReq'])!=0){ ?>
		            			<ul>
		            			<?php //var_dump($jobInfo['jobDetails']['jobEducReq']); 
		            				foreach ($jobInfo['jobDetails']['jobEducReq'] as $key) { ?>
		            				<li><?= ucwords($key['education']) ?></li>
				            	<?php }	?>
				            	</ul>
			            	<?php }else{ ?>
			            		No Education Requirement Selected
			            	<?php }	?>
			            </td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="salary">Employment Type</label></td>
	            		<td><?php if(count($jobInfo['jobDetails']['emp_type'])!=0){ ?>
		            			<ul>
		            			<?php //var_dump($jobInfo['jobDetails']['jobEducReq']); 
		            				foreach ($jobInfo['jobDetails']['emp_type'] as $key) { ?>
		            				<li><?= ucwords($key['emp_type']) ?></li>
				            	<?php }	?>
				            	</ul>
				            <?php }else{ ?>
			            		No Employement Type Requirement Selected
			            	<?php }	?>
			            </td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="salary">Benefits</label></td>
	            		<td>
	            			<?php 
	            				if(count($jobInfo['jobDetails']['jobBenefits'])!=0){ ?>
		            			<ul>
		            			<?php //var_dump($jobInfo['jobDetails']['jobEducReq']); 
		            				foreach ($jobInfo['jobDetails']['jobBenefits'] as $key) { ?>
		            				<li><?= ucwords($key['benefits']) ?></li>
				            	<?php }	?>
				            	</ul>
				            <?php }else{ ?>
			            		No Benefits Selected
			            	<?php }	?>
			            </td>
	            	</tr>
	            	
	            </table>
	            </div>        
			</div>
			<?php if(!$isJobAvailedPromo){ ?>
		        <div class="panel panel-default" style="overflow: auto">
			        	<div class="panel-heading">
			                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> AVAIL OUR PROMO! (optional)</h4>
			                <div class="clearfix"></div>
			            </div>
			            <div class="panel-body">
				            <div class="row">
		                        <div class="col-md-12">    
			                        <div class="col-md-12">
											<table class="table">
				                                <tr>
				                                  <td>
				                                  	<input type="hidden" name="jobId" value="<?= $jobInfo['jobDetails']['jobId'] ?>">
				                                    <input type="checkbox" onclick="checkAvail()" id="jobPromo1" name="jobPromo[]" value="1" class="" <?php echo set_checkbox('benefits', 'enter_value_here'); ?>>                                        
				                                                          
				                                  </td>
				                                  <td><label for="jkpromo">JK Agent</label>  
				                                  </td>
				                                  <td>
				                                    We will help you find the best candidates for your project.
				                                  </td>
				                                  <td>
				                                    PHP 5,000.00 only
				                                  </td>
				                                </tr>
				                                
				                                <tr>
				                                  <td>
				                                    <input type="checkbox" onclick="checkAvail()" id="jobPromo2" name="jobPromo[]" value="2" class="" <?php echo set_checkbox('benefits', 'enter_value_here'); ?>>                                        
				                                                          
				                                  </td>
				                                  <td><label for="jkpromo">JK Featured</label>  
				                                  </td>
				                                  <td>
				                                    This will add to our featured section and will attract more applicant.
				                                  </td>
				                                  <td>
				                                    PHP 500.00 only
				                                  </td>
				                                </tr>

				                                <tr>
				                                  <td>
				                                    <input type="checkbox" onclick="checkAvail()" id="jobPromo3" name="jobPromo[]" value="3" class="" <?php echo set_checkbox('benefits', 'enter_value_here'); ?>>                                        
				                                                          
				                                  </td>
				                                  <td><label for="jkpromo">JK Urgent</label>  
				                                  </td>
				                                  <td>
				                                    This will add to our urgent section and will attract more applicant.
				                                  </td>
				                                  <td>
				                                    PHP 500.00 only
				                                  </td>
				                                </tr>				                                
				                            </table>
									</div>
								</div>
							</div>
						</div>
						<hr/>
				</div>
			<?php } ?>
		</div>
			
		<div class="col-lg-2"></div>
		<div class="col-md-3"></div>
		<?php if(!$isJobAvailedPromo){ ?>
	        <div class="col-md-3">
	                <a id="notAvailBtn" href="<?= BASEURL . 'employers/postJob/7/'.$jobInfo['jobDetails']['jobId'] ?>" class="btn btn-block btn-md btn-danger" >I will not avail the promo, continue..</a>
	                <br />
	        </div>
	        <div class="col-md-3">
	                <input type="submit" value="I will avail the promo" class="btn btn-block btn-md btn-primary" />
	                <br />
	        </div>
        <?php }else{ ?>
        	<div class="col-md-6">
	                <a href="<?= BASEURL . 'employers/postJob/4/'.$jobInfo['jobDetails']['jobId'] ?>" class="btn btn-block btn-md btn-primary" >Next</a>
	                <br />
	        </div>
	    <?php } ?>
        <div class="col-md-4"></div>
	</div>
</form>

<script type="text/javascript">
	// var notAvailBtn = document.getElementById("notAvailBtn");
	 //notAvailBtn.hide();
	$('#notAvailBtn').show();
	function checkAvail() {
	    var jobPromo1 = document.getElementById("jobPromo1");
	    var jobPromo2 = document.getElementById("jobPromo2");
	    var jobPromo3 = document.getElementById("jobPromo3");
	    
	    if (jobPromo1.checked == true || jobPromo2.checked == true || jobPromo3.checked == true )
	    {
	        $('#notAvailBtn').hide();
	    }
	    else
	    {
	        $('#notAvailBtn').show();
	    }
	}
</script>
