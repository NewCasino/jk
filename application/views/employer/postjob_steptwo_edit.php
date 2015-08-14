<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			Step 1 - Job Summary / <b>Step 2 - Job Details </b> /  Step 3 - Preview / Step 4 - Finalized
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<form method="post" action="<?= BASEURL . 'employers/postJobDetailsUpdate'?>" autocomplete="off" role="form" class="form-inline" name="form">
	<div class="row">
		<div class="col-lg-2"></div>
	    <div class="col-lg-8">
	        <div class="panel panel-default" style="overflow: auto">
	        	<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> EDIT JOB REQUIREMENTS</h4>
	                <div class="pull-right">
	            		<a href="#main" style="color: white;" id="button_list_toggle1" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up1"></i></a>
	            	</div>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body" id="list_panel_body1">
						<?php //echo $this->tinyMce;?>
						<div class="row">
							<div class="col-md-12">
			                    <div class="col-md-4">
			                    		<input id="jobId" type="hidden" class="form-control" style="width:100%" required name="jobId" maxlength="64" value="<?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['jobId'] : '' ?>" />
			                            <label for="vacancy_num"><strong>Number of Vacancy</strong><span class="">*</span></label>
			                            <?php echo form_error('vacancy_num'); ?>
			                            <br />
			                            <input id="vacancy_num" type="number" min='1' required name="vacancy_num" class="form-control" value="<?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['vacancy_num'] : '' ?>"  />
			                            <br />
			                    </div>
			                                            
			                    <div class="col-md-8">		                    		
			                            <label for="position_level"><strong>Position Level</strong></label>
			                            <?php echo '<span class="form_error">'.form_error('position_level').'</span>'; ?>
			                            <br />
			                            <select name="position_level" class="form-control" style="width:100%" required>
			                              <option value="1" <?= $this->session->userdata('position_level') == '1' ? 'selected' : ''?>>1-4 Years Experience</option>
			                              <option value="2" <?= $this->session->userdata('position_level') == '2' ? 'selected' : ''?>>5-10 Years Experience</option>
			                              <option value="3" <?= $this->session->userdata('position_level') == '3' ? 'selected' : ''?>>Managerial</option>
			                              <option value="4" <?= $this->session->userdata('position_level') == '4' ? 'selected' : ''?>>OIC/CEO/SVP/AVP/VP/Director</option>
			                              <option value="5" <?= $this->session->userdata('position_level') == '5' ? 'selected' : ''?>>Fresh Graduate/1 yrs less experience</option>
			                              <option value="6" <?= $this->session->userdata('position_level') == '6' ? 'selected' : ''?>>No experience</option>
			                            </select>
			                            <br />
			                    </div>
		                    </div>
		                </div>
		                <div class="row">            
		                    <div class="col-md-12">
				                <div class="col-md-8">
				                	<br />
		                            <label for="specialization"><strong>Specialization</strong> <span class="">*</span></label>
		                            <?php echo form_error('specialization'); ?>                                                        
		                            <br />
		                            <select data-placeholder="Specialization"  style="width:100%" class="chosen-select-deselect form-control"  name="specialization" required>
		                                    <option value="">--Select Specialization--</option>
			                                    <optgroup label="Accounting">
			                                      <option value="1" <?= $this->session->userdata('specialization') == '1' ? 'selected' : ''?>>Accounting Management</option>
			                                      <option value="2" <?= $this->session->userdata('specialization') == '2' ? 'selected' : ''?>>General Accounting</option>
			                                      <option value="3" <?= $this->session->userdata('specialization') == '3' ? 'selected' : ''?>>Consulating</option>
			                                      <option value="4" <?= $this->session->userdata('specialization') == '4' ? 'selected' : ''?>>Financial Analyst</option>
			                                      <option value="5" <?= $this->session->userdata('specialization') == '5' ? 'selected' : ''?>>Treasurer</option>
			                                      <option value="6" <?= $this->session->userdata('specialization') == '6' ? 'selected' : ''?>>Audit & Taxation</option>
			                                      <option value="7" <?= $this->session->userdata('specialization') == '7' ? 'selected' : ''?>>Credit Control</option>
			                                      <option value="8" <?= $this->session->userdata('specialization') == '8' ? 'selected' : ''?>>Financial Control</option>
			                                      <option value="9" <?= $this->session->userdata('specialization') == '9' ? 'selected' : ''?>>Liquidation</option>                 
			                                    </optgroup>
			            
			                                    <optgroup label="Banking & Finance">
			                                      <option value="10" <?= $this->session->userdata('specialization') == '10' ? 'selected' : ''?>>Banking Services</option>
			                                      <option value="11" <?= $this->session->userdata('specialization') == '11' ? 'selected' : ''?>>Credit Collection</option>
			                                      <option value="12" <?= $this->session->userdata('specialization') == '12' ? 'selected' : ''?>>Security Services</option>
			                                      <option value="13" <?= $this->session->userdata('specialization') == '13' ? 'selected' : ''?>>Financial Services</option>
			                                    </optgroup>
			            
			                                    <optgroup label="HR/Admin">
			                                      <option value="14" <?= $this->session->userdata('specialization') == '14' ? 'selected' : ''?>>Admin Management</option>
			                                      <option value="15" <?= $this->session->userdata('specialization') == '15' ? 'selected' : ''?>>Admin Staff</option>
			                                      <option value="16" <?= $this->session->userdata('specialization') == '16' ? 'selected' : ''?>>Admin Secretarial</option>
			                                      <option value="17" <?= $this->session->userdata('specialization') == '17' ? 'selected' : ''?>>HR Management</option>
			                                      <option value="18" <?= $this->session->userdata('specialization') == '18' ? 'selected' : ''?>>HR Staff</option>
			                                      <option value="19" <?= $this->session->userdata('specialization') == '19' ? 'selected' : ''?>>HR Secretarial</option>                               
			                                    </optgroup>         
			                                    
			                                    <optgroup label="Beauty Care and Health Service">
			                                      <option value="20" <?= $this->session->userdata('specialization') == '20' ? 'selected' : ''?>>Sports and Recreation Service</option>
			                                      <option value="21" <?= $this->session->userdata('specialization') == '21' ? 'selected' : ''?>>Nutrionist</option>
			                                      <option value="22" <?= $this->session->userdata('specialization') == '22' ? 'selected' : ''?>>Beauty Service</option>   
			                                      <option value="23" <?= $this->session->userdata('specialization') == '23' ? 'selected' : ''?>>All Beauty Care and Health Service</option>                                                        
			                                    </optgroup> 
			                                         
			                                    <optgroup label="Building and Construction">
			                                      <option value="24" <?= $this->session->userdata('specialization') == '24' ? 'selected' : ''?>>Architectural</option>
			                                      <option value="25" <?= $this->session->userdata('specialization') == '25' ? 'selected' : ''?>>Civil</option>
			                                      <option value="26" <?= $this->session->userdata('specialization') == '26' ? 'selected' : ''?>>Builder/Construction</option>  
			                                      <option value="27" <?= $this->session->userdata('specialization') == '27' ? 'selected' : ''?>>All Building/Construction</option>                                                         
			                                    </optgroup>  
			                                    
			                                    <optgroup label="Designing">
			                                      <option value="28" <?= $this->session->userdata('specialization') == '28' ? 'selected' : ''?>>Multimedia</option>
			                                      <option value="29" <?= $this->session->userdata('specialization') == '29' ? 'selected' : ''?>>Fine Arts</option>
			                                      <option value="30" <?= $this->session->userdata('specialization') == '30' ? 'selected' : ''?>>Online</option>   
			                                      <option value="31" <?= $this->session->userdata('specialization') == '31' ? 'selected' : ''?>>Fashion</option>  
			                                      <option value="32" <?= $this->session->userdata('specialization') == '32' ? 'selected' : ''?>>Product</option>                                                     
			                                    </optgroup>    
			                                    
			                                    <optgroup label="Education">
			                                      <option value="33" <?= $this->session->userdata('specialization') == '33' ? 'selected' : ''?>>Education</option>
			                                      <option value="34" <?= $this->session->userdata('specialization') == '34' ? 'selected' : ''?>>Professor</option>
			                                      <option value="35" <?= $this->session->userdata('specialization') == '35' ? 'selected' : ''?>>Teacher</option>   
			                                      <option value="36" <?= $this->session->userdata('specialization') == '36' ? 'selected' : ''?>>Instructor</option>  
			                                      <option value="37" <?= $this->session->userdata('specialization') == '37' ? 'selected' : ''?>>Lecturer</option>  
			                                      <option value="38" <?= $this->session->userdata('specialization') == '38' ? 'selected' : ''?>>Tutor</option>     
			                                      <option value="39" <?= $this->session->userdata('specialization') == '39' ? 'selected' : ''?>>Mentor</option>                                                    
			                                    </optgroup>      
			                                    
			                                    <optgroup label="Engineering">
			                                      <option value="40" <?= $this->session->userdata('specialization') == '40' ? 'selected' : ''?>>Civil</option>
			                                      <option value="41" <?= $this->session->userdata('specialization') == '41' ? 'selected' : ''?>>Chemical</option>
			                                      <option value="42" <?= $this->session->userdata('specialization') == '42' ? 'selected' : ''?>>Electrical</option>   
			                                      <option value="43" <?= $this->session->userdata('specialization') == '43' ? 'selected' : ''?>>Mechanical</option>  
			                                      <option value="44" <?= $this->session->userdata('specialization') == '44' ? 'selected' : ''?>>System</option>  
			                                      <option value="45" <?= $this->session->userdata('specialization') == '45' ? 'selected' : ''?>>Computer</option>                                                     
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Hotel, Restaurant, Food & Travel">
			                                      <option value="46" <?= $this->session->userdata('specialization') == '46' ? 'selected' : ''?>>Food & Beverages</option>
			                                      <option value="47" <?= $this->session->userdata('specialization') == '47' ? 'selected' : ''?>>Hotel Services</option>
			                                      <option value="48" <?= $this->session->userdata('specialization') == '48' ? 'selected' : ''?>>Travel Agency</option>                                                                                            
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Information Technology">
			                                      <option value="49" <?= $this->session->userdata('specialization') == '49' ? 'selected' : ''?>>Consultancy</option>
			                                      <option value="50" <?= $this->session->userdata('specialization') == '50' ? 'selected' : ''?>>Software</option>
			                                      <option value="51" <?= $this->session->userdata('specialization') == '51' ? 'selected' : ''?>>Hardware</option>                                           
			                                      <option value="52" <?= $this->session->userdata('specialization') == '52' ? 'selected' : ''?>>Web/online</option>    
			                                      <option value="53" <?= $this->session->userdata('specialization') == '53' ? 'selected' : ''?>>Analyst</option>
			                                      <option value="54" <?= $this->session->userdata('specialization') == '54' ? 'selected' : ''?>>Mobile</option>                                           
			                                      <option value="55" <?= $this->session->userdata('specialization') == '55' ? 'selected' : ''?>>Networking</option> 
			                                      <option value="56" <?= $this->session->userdata('specialization') == '56' ? 'selected' : ''?>>Security</option>
			                                      <option value="57" <?= $this->session->userdata('specialization') == '57' ? 'selected' : ''?>>Technical Writing</option>
			                                      <option value="58" <?= $this->session->userdata('specialization') == '58' ? 'selected' : ''?>>Tester/QA</option>                                           
			                                      <option value="59" <?= $this->session->userdata('specialization') == '59' ? 'selected' : ''?>>SEO</option>                                          
			                                      <option value="60" <?= $this->session->userdata('specialization') == '60' ? 'selected' : ''?>>Technical Support</option> 
			                                      <option value="61" <?= $this->session->userdata('specialization') == '61' ? 'selected' : ''?>>MIS/IT Manager/Director/Consultant</option>
			                                      <option value="62" <?= $this->session->userdata('specialization') == '62' ? 'selected' : ''?>>Project Manager</option>
			                                      <option value="63" <?= $this->session->userdata('specialization') == '63' ? 'selected' : ''?>>DBA</option>                                                                                     
			                                    </optgroup>       
			                                    
			                                    <optgroup label="Insurance">
			                                      <option value="64" <?= $this->session->userdata('specialization') == '64' ? 'selected' : ''?>>Agent/Broker</option>
			                                      <option value="65" <?= $this->session->userdata('specialization') == '65' ? 'selected' : ''?>>Underwriter</option>
			                                      <option value="66" <?= $this->session->userdata('specialization') == '66' ? 'selected' : ''?>>CSR</option>   
			                                      <option value="67" <?= $this->session->userdata('specialization') == '67' ? 'selected' : ''?>>Claims Representative</option>  
			                                      <option value="68" <?= $this->session->userdata('specialization') == '68' ? 'selected' : ''?>>Adjuster</option>  
			                                      <option value="69" <?= $this->session->userdata('specialization') == '69' ? 'selected' : ''?>>Actuarial</option>     
			                                      <option value="70" <?= $this->session->userdata('specialization') == '70' ? 'selected' : ''?>>Regulator</option>                                                 
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Management">
			                                      <option value="71" <?= $this->session->userdata('specialization') == '71' ? 'selected' : ''?>>Gen. Management</option>
			                                      <option value="72" <?= $this->session->userdata('specialization') == '72' ? 'selected' : ''?>>Top Level Management (Exec/OIC/CEO/CTO))</option>                                  
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Manufacturing">
			                                      		<option value="73" <?= $this->session->userdata('specialization') == '73' ? 'selected' : ''?>>Gen. Manufacturing</option>
			                                          <option value="74" <?= $this->session->userdata('specialization') == '74' ? 'selected' : ''?>>Production Worker</option>
			                                          <option value="75" <?= $this->session->userdata('specialization') == '75' ? 'selected' : ''?>>Development (planning/testing/control)</option>   
			                                          <option value="76" <?= $this->session->userdata('specialization') == '76' ? 'selected' : ''?>>Quality Assurance</option>                                         
			                                    </optgroup>              
			                                           
			                                     <optgroup label="Marketing/PR/Sales/CS">
			                                      <option value="77" <?= $this->session->userdata('specialization') == '77' ? 'selected' : ''?>>Marketing</option>
			                                      <option value="78" <?= $this->session->userdata('specialization') == '78' ? 'selected' : ''?>>Public Relation</option>
			                                      <option value="79" <?= $this->session->userdata('specialization') == '79' ? 'selected' : ''?>>Sales (CS/Direct/Telemarketing/Tech Sales/Real State)</option>                                     
			                                      </optgroup>  
			                                    
			                                    <optgroup label="Media & Advertising">
			                                      <option value="80" <?= $this->session->userdata('specialization') == '80' ? 'selected' : ''?>>Journalism</option>
			                                      <option value="81" <?= $this->session->userdata('specialization') == '81' ? 'selected' : ''?>>Media Broadcasting TV/Radio/Newspaper</option>
			                                      <option value="82" <?= $this->session->userdata('specialization') == '82' ? 'selected' : ''?>>Media Production</option>                                        
			                                      <option value="83" <?= $this->session->userdata('specialization') == '83' ? 'selected' : ''?>>Advertising and Editorial</option> 
			                                      <option value="84" <?= $this->session->userdata('specialization') == '84' ? 'selected' : ''?>>Media Planner</option>
			                                      <option value="85" <?= $this->session->userdata('specialization') == '85' ? 'selected' : ''?>>Director and Creatives</option>
			                                      <option value="86" <?= $this->session->userdata('specialization') == '86' ? 'selected' : ''?>>Media Buyer</option>                                    
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Medical">
			                                      <option value="87" <?= $this->session->userdata('specialization') == '87' ? 'selected' : ''?>>Doctors</option>
			                                      <option value="88" <?= $this->session->userdata('specialization') == '88' ? 'selected' : ''?>>Nursing</option>
			                                      <option value="89" <?= $this->session->userdata('specialization') == '89' ? 'selected' : ''?>>Specialist</option>                                        
			                                      <option value="90" <?= $this->session->userdata('specialization') == '90' ? 'selected' : ''?>>Dentist</option> 
			                                      <option value="91" <?= $this->session->userdata('specialization') == '91' ? 'selected' : ''?>>Veterinarian</option>
			                                      <option value="92" <?= $this->session->userdata('specialization') == '92' ? 'selected' : ''?>>Medical Service Technician</option>
			                                      <option value="93" <?= $this->session->userdata('specialization') == '93' ? 'selected' : ''?>>Pharmaceutical<option value="Banking">        
			                                      <option value="94" <?= $this->session->userdata('specialization') == '94' ? 'selected' : ''?>>Therapist<option value="Banking">                                                                            
			                                    </optgroup> 
			                                    
			                                    <optgroup label="Merchandising & Purchasing">
			                                      <option value="95" <?= $this->session->userdata('specialization') == '95' ? 'selected' : ''?>>Electronics</option>
			                                      <option value="96" <?= $this->session->userdata('specialization') == '96' ? 'selected' : ''?>>All Accesories</option>
			                                      <option value="97" <?= $this->session->userdata('specialization') == '97' ? 'selected' : ''?>>All Garments</option>                                        
			                                      <option value="98" <?= $this->session->userdata('specialization') == '98' ? 'selected' : ''?>>Appliances</option> 
			                                      <option value="99" <?= $this->session->userdata('specialization') == '99' ? 'selected' : ''?>>All Merchandising</option>                                                                                
			                                    </optgroup>                                                                                                                           
			                                    <optgroup label="Professional Services">
			                                      <option value="100" <?= $this->session->userdata('specialization') == '100' ? 'selected' : ''?>>Property</option>
			                                      <option value="101" <?= $this->session->userdata('specialization') == '101' ? 'selected' : ''?>>Consultancy & Management</option>
			                                    </optgroup>
			                                    
			                                     <optgroup label="Public/Civil">
			                                      <option value="102" <?= $this->session->userdata('specialization') == '102' ? 'selected' : ''?>>Civil Services</option>
			                                      <option value="103" <?= $this->session->userdata('specialization') == '103' ? 'selected' : ''?>>Foreign Affairs</option>
			                                      <option value="104" <?= $this->session->userdata('specialization') == '104' ? 'selected' : ''?>>Government Bodies</option>                                        
			                                      <option value="105" <?= $this->session->userdata('specialization') == '105' ? 'selected' : ''?>>Military/Defense</option> 
			                                      <option value="106" <?= $this->session->userdata('specialization') == '106' ? 'selected' : ''?>>Social Services</option>     
			                                      <option value="107" <?= $this->session->userdata('specialization') == '107' ? 'selected' : ''?>>Utilities</option>  
			                                    </optgroup>
			                                    
			                                    <optgroup label="Sales/Customer Service">
			                                      <option value="108" <?= $this->session->userdata('specialization') == '108' ? 'selected' : ''?>>CSR/TSR</option>
			                                      <option value="109" <?= $this->session->userdata('specialization') == '109' ? 'selected' : ''?>>Retail/Wholesaler</option>                              
			                                    </optgroup>
			                                    
			                                    <optgroup label="Science/Laboratory/Research & Development">
			                                      <option value="110" <?= $this->session->userdata('specialization') == '110' ? 'selected' : ''?>>Research & Development</option>
			                                      <option value="111" <?= $this->session->userdata('specialization') == '111' ? 'selected' : ''?>>All laboratory jobs</option>                                      
			                                    </optgroup>
			                                    
			                                    <optgroup label="Telecomm">
			                                      <option value="112" <?= $this->session->userdata('specialization') == '112' ? 'selected' : ''?>>Engineering</option>
			                                      <option value="113" <?= $this->session->userdata('specialization') == '113' ? 'selected' : ''?>>Administration</option>
			                                      <option value="114" <?= $this->session->userdata('specialization') == '114' ? 'selected' : ''?>>Staff</option>                                                                       
			                                    </optgroup>
			                                    
			                                    <optgroup label="Transpo & Logistics">
			                                      <option value="115" <?= $this->session->userdata('specialization') == '115' ? 'selected' : ''?>>Land</option>
			                                      <option value="116" <?= $this->session->userdata('specialization') == '116' ? 'selected' : ''?>>Aerial</option>
			                                      <option value="117" <?= $this->session->userdata('specialization') == '117' ? 'selected' : ''?>>Maritime Services</option>                                                                      
			                                    </optgroup>
			                                    <optgroup label="Others">
			                                      <option value="118" <?= $this->session->userdata('specialization') == '118' ? 'selected' : ''?>>Skill Worker</option>
			                                      <option value="119" <?= $this->session->userdata('specialization') == '119' ? 'selected' : ''?>>Artist</option>
			                                      <option value="120" <?= $this->session->userdata('specialization') == '120' ? 'selected' : ''?>>Modelling</option>
			                                      <option value="121" <?= $this->session->userdata('specialization') == '121' ? 'selected' : ''?>>Singers</option>                                        
			                                      <option value="122" <?= $this->session->userdata('specialization') == '122' ? 'selected' : ''?>>Musicians</option>  
			                                      <option value="123" <?= $this->session->userdata('specialization') == '123' ? 'selected' : ''?>>Entertainer</option>  
			                                      <option value="124" <?= $this->session->userdata('specialization') == '124' ? 'selected' : ''?>>Creative Artist</option>  
			                                      <option value="125" <?= $this->session->userdata('specialization') == '125' ? 'selected' : ''?>>All Others</option>                                    
			                                    </optgroup>
		                            </select> 
		                            <br/> 
					            </div>
					            <div class="col-md-4">
					            	<br />
			                        <label for="yr_exp"><strong>Job yrs of experience</strong><br/></label>                                                  
			                            <select name="yr_exp" class="form-control"  style="width:100%" required>
			                              <option value="1-2" <?= $this->session->userdata('yr_exp') == '1-2' ? 'selected' : ''?>>1-2 yrs</option>
			                              <option value="2-3" <?= $this->session->userdata('yr_exp') == '2-3' ? 'selected' : ''?>>2-3 yrs</option>
			                              <option value="3-4" <?= $this->session->userdata('yr_exp') == '3-4' ? 'selected' : ''?>>3-4 yrs</option>
			                              <option value="4-5" <?= $this->session->userdata('yr_exp') == '4-5' ? 'selected' : ''?>>4-5 yrs</option>
			                              <option value="5-6" <?= $this->session->userdata('yr_exp') == '5-6' ? 'selected' : ''?>>5-6 yrs</option>
			                              <option value="6-7" <?= $this->session->userdata('yr_exp') == '6-7' ? 'selected' : ''?>>6-7 yrs</option>
			                              <option value="7-8" <?= $this->session->userdata('yr_exp') == '7-8' ? 'selected' : ''?>>7-8 yrs</option>
			                              <option value="8-9" <?= $this->session->userdata('yr_exp') == '8-9' ? 'selected' : ''?>>8-9 yrs</option>
			                              <option value="9-10" <?= $this->session->userdata('yr_exp') == '9-10' ? 'selected' : ''?>>9-10 yrs</option>
			                            </select>
			                            <br/>
			                    </div>   
					        </div>                                                      
	                    </div> 
		                <div class="row">            
		                    <div class="col-md-12">
		                    	<div class="col-md-12">
			                        <br/>
			                            <label for="job_description"><strong>Job Description</strong><span class="">*</span></label>                        
			                        <?php echo '<span class="form_error">'.form_error('job_description').'</span>'; ?>
			                        <br />
			                        <textarea name='job_description' style="width:100%" class="form-control" id='job_description'><?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['job_desc'] : '' ?></textarea>
			                    </div>
		                    </div>                                                      
	                    </div>
	                    <div class="col-md-12">
	                        <br/>
	                        <label for="experience_req"><strong>Experience Requirements</strong></label>
	                        <?php echo '<span class="form_error">'.form_error('experience_req').'</span>'; ?>                                                       
	                        <br />
	                        <textarea name='experience_req' style="width:100%" class="form-control" id='experience_req'><?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['experience_req'] : '' ?></textarea>
	                    </div>                                            
	                                            
	                    <div class="col-md-12">
	                        <br/>
	                        <label for="additional_job_req"><strong>Additional Job Requirements</strong></label>                       		                         	
	                        <br />
	                        <textarea name='additional_job_req' style="width:100%" class="form-control" id='additional_job_req'><?= isset($jobInfo) == TRUE ? $jobInfo['jobDetails']['additional_job_req'] : '' ?></textarea>
	                        <br/>
	                    </div>
                     
	                    <div class="col-md-12">
	                    	<div class="panel">
	                    		<div class="panel-head">
	                    			<br/>
	                            	<strong>Education Requirements</strong>
	                            </div>
	                            <div class="panel-body">
		                            <table class="table">
			                                <tr>
			                                  <td><?php //var_dump($jobInfo['jobDetails']['jobEducReq']);
			                                  			$educ1 = FALSE;
		                                  				$educ2 = FALSE;
		                                  				$educ3 = FALSE;
		                                  				$educ4 = FALSE;
		                                  				$educ5 = FALSE;
		                                  				$educ6 = FALSE;
			                                  			foreach ($jobInfo['jobDetails']['jobEducReq'] as $key) {
			                                  				if($key['education'] == 1){
			                                  					$educ1 = TRUE;
			                                  				}elseif($key['education'] == 2){
			                                  					$educ2 = TRUE;
			                                  				}elseif($key['education'] == 3){
			                                  					$educ3 = TRUE;
			                                  				}elseif($key['education'] == 4){
			                                  					$educ4 = TRUE;
			                                  				}elseif($key['education'] == 5){
			                                  					$educ5 = TRUE;
			                                  				}elseif($key['education'] == 6){
			                                  					$educ6 = TRUE;
			                                  				}
			                                  			}
			                                  		 ?>			                                  		
					                            <input type="checkbox" id="educational_req" name="educational_req[]" <?= $educ1 == TRUE ? 'checked' : ''?> value="1">
					                            <label for="educational_req">High School Undergraduate</label>
					                          </td>
					                          <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" <?= $educ2 == TRUE ? 'checked' : ''?> value="2" >
					                            <label for="educational_req">Degree Holder</label>
					                          </td>
					                        </tr>
					                        <tr>
			                                  <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" <?= $educ3 == TRUE ? 'checked' : ''?> value="3">
					                            <label for="educational_req">High School Graduate</label>
					                          </td>
					                          <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" <?= $educ4 == TRUE ? 'checked' : ''?> value="4">
					                            <label for="educational_req">Master Degree Holder</label>		                            		
					                          </td>
					                        </tr>
					                        <tr>
			                                  <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" <?= $educ5 == TRUE ? 'checked' : ''?> value="5">
					                            <label for="educational_req">Vocational / Short Courses / Diploma</label>	
					                          </td>
					                          <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" <?= $educ6 == TRUE ? 'checked' : ''?> value="6">
					                            <label for="educational_req">PhD / Doctorate Holder</label>
					                          </td>
					                        </tr>
										</table>
		                        </div>
	                        </div>
	                    </div> 
	                    <br/>
	         	</div>           
			</div>

			<div class="panel panel-default" style="overflow: auto">
				<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> SALARY DETAILS</h4>
	                <div class="pull-right">
	            		<a href="#main" style="color: white;" id="button_list_toggle2" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up2"></i></a>
	            	</div>
	                <div class="clearfix"></div>
	            </div>

	            <div class="panel-body" id="list_panel_body2">
					<div class="col-md-12">  
		                    <div class="row">
		                    	<div class="col-md-3">
			                            <label for="salary_base">Per&nbsp;&nbsp;&nbsp;</label>                                                        
			                            <select name="salary_base" class="form-control">
			                              <option value="/mo" <?= $this->session->userdata('salary_base') == '/mo' ? 'selected' : ''?>>Monthly Rate</option>
			                              <option value="/week" <?= $this->session->userdata('salary_base') == '/week' ? 'selected' : ''?>>Weekly Rate</option>
			                              <option value="/day" <?= $this->session->userdata('salary_base') == '/day' ? 'selected' : ''?>>Daily Rate</option>
			                              <option value="/hr" <?= $this->session->userdata('salary_base') == '/hr' ? 'selected' : ''?>>Hourly Rate</option>
			                            </select>
			                            <br />
			                    </div>

			                    <div class="col-md-2">     
			                                <label for="currency">Currency</label>
			                                <select name="currency" class="form-control" required>
			                                  <option value="PHP" <?= $this->session->userdata('currency') == 'PHP' ? 'selected' : ''?>>PHP</option>
			                                  <option value="USD" <?= $this->session->userdata('currency') == 'USD' ? 'selected' : ''?>>USD</option>
			                                </select>
			                                <br />
			                    </div>
		                
			                    <div class="col-md-3">
			                                <label for="salary_range">From</label>                                                                                
			                                <select name="salary_min" class="form-control" style="width:100%">
			                                  <option value="10000" <?= $this->session->userdata('salary_min') == '10000' ? 'selected' : ''?>>10,000</option>
			                                  <option value="20000" <?= $this->session->userdata('salary_min') == '20000' ? 'selected' : ''?>>20,000</option>
			                                  <option value="30000" <?= $this->session->userdata('salary_min') == '30000' ? 'selected' : ''?>>30,000</option>
			                                  <option value="40000" <?= $this->session->userdata('salary_min') == '40000' ? 'selected' : ''?>>40,000</option>
			                                  <option value="50000" <?= $this->session->userdata('salary_min') == '50000' ? 'selected' : ''?>>50,000</option>
			                                  <option value="60000" <?= $this->session->userdata('salary_min') == '60000' ? 'selected' : ''?>>60,000</option>
			                                  <option value="70000" <?= $this->session->userdata('salary_min') == '70000' ? 'selected' : ''?>>70,000</option>
			                                  <option value="80000" <?= $this->session->userdata('salary_min') == '80000' ? 'selected' : ''?>>80,000</option>
			                                  <option value="90000" <?= $this->session->userdata('salary_min') == '90000' ? 'selected' : ''?>>90,000</option>
			                                  <option value="100000" <?= $this->session->userdata('salary_min') == '100000' ? 'selected' : ''?>>100,000</option>
			                                  <option value="150000" <?= $this->session->userdata('salary_min') == '150000' ? 'selected' : ''?>>150,000</option>
			                                  <option value="200000" <?= $this->session->userdata('salary_min') == '200000' ? 'selected' : ''?>>200,000</option>
			                                  <option value="250000" <?= $this->session->userdata('salary_min') == '250000' ? 'selected' : ''?>>250,000</option>
			                                  <option value="300000" <?= $this->session->userdata('salary_min') == '300000' ? 'selected' : ''?>>300,000</option>
			                                </select>
			                                <br />
			                    </div>
				                <div class="col-md-4">
				                            <label for="salary_range">To</label>
				                            <select name="salary_max" class="form-control" style="width:100%">
				                              <option value="20000" <?= $this->session->userdata('salary_max') == '20000' ? 'selected' : ''?>>20,000</option>
				                              <option value="30000" <?= $this->session->userdata('salary_max') == '30000' ? 'selected' : ''?>>30,000</option>
				                              <option value="40000" <?= $this->session->userdata('salary_max') == '40000' ? 'selected' : ''?>>40,000</option>
				                              <option value="50000" <?= $this->session->userdata('salary_max') == '50000' ? 'selected' : ''?>>50,000</option>
				                              <option value="60000" <?= $this->session->userdata('salary_max') == '60000' ? 'selected' : ''?>>60,000</option>
				                              <option value="70000" <?= $this->session->userdata('salary_max') == '70000' ? 'selected' : ''?>>70,000</option>
				                              <option value="80000" <?= $this->session->userdata('salary_max') == '80000' ? 'selected' : ''?>>80,000</option>
				                              <option value="90000" <?= $this->session->userdata('salary_max') == '90000' ? 'selected' : ''?>>90,000</option>
				                              <option value="100000" <?= $this->session->userdata('salary_max') == '100000' ? 'selected' : ''?>>100,000</option>
				                              <option value="150000" <?= $this->session->userdata('salary_max') == '150000' ? 'selected' : ''?>>150,000</option>
				                              <option value="200000" <?= $this->session->userdata('salary_max') == '200000' ? 'selected' : ''?>>200,000</option>
				                              <option value="250000" <?= $this->session->userdata('salary_max') == '250000' ? 'selected' : ''?>>250,000</option>
				                              <option value="500000" <?= $this->session->userdata('salary_max') == '500000' ? 'selected' : ''?>>500,000</option>
				                            </select>
				                            <br />
				                </div>
				            </div>
			            	<div class="row">
			            		<br />
			                    <div class="col-md-12">
			                    	<strong>Salary Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> 
                                    <input id="salary_type" name="salary_type" type="radio" class="" value="1" <?= $this->session->userdata('salary_type') == 1 ? 'checked' : ''?> />
                                    <label for="salary_type" class="">Negotiable</label>
                    				&nbsp;&nbsp;&nbsp;
                                    <input id="salary_type" name="salary_type" type="radio" class="" value="2" <?= $this->session->userdata('salary_type') == 2 ? 'checked' : ''?> />
                                    <label for="salary_type" class="">Commission w/ base salary</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input id="salary_type" name="salary_type" type="radio" class="" value="3" <?= $this->session->userdata('salary_type') == 3 ? 'checked' : ''?> />
                                    <label for="salary_type" class="">None</label>
		                        </div>
		                        <br/><br/>
			                    <div class="col-md-5">
		                            <strong>Display Salary:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>                           
                                    <input id="show_salary" name="show_salary" type="radio" class="" value="0" checked="true" <?= $this->session->userdata('show_salary') == 0 ? 'checked' : ''?> />
                                    <label for="show_salary" class="">Yes</label>
                    				&nbsp;&nbsp;&nbsp;
                                    <input id="show_salary" name="show_salary" type="radio" class="" value="1" <?= $this->session->userdata('show_salary') == 1 ? 'checked' : ''?> />
                                    <label for="show_salary" class="">No</label>
		                        </div>
		                        
		                    </div>
		                    <br />
		            </div> 
		        </div>      
		    </div>     
	                       
			<div class="panel panel-default" style="overflow: auto">
				<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> BENEFITS DETAILS</h4>
	                <div class="pull-right">
	            		<a href="#main" style="color: white;" id="button_list_toggle3" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up3"></i></a>
	            	</div>
	                <div class="clearfix"></div>
	            </div>

	            <div class="panel-body" id="list_panel_body3">                       
	                    <div class="col-md-12">
	                        <div class="col-md-12">                          
	                            <table class="table">
	                                <tr>
	                                  <td>
	                                  	<?php //var_dump($jobInfo['jobDetails']['jobBenefits']);
			                                  			$benefits1 = FALSE;
		                                  				$benefits2 = FALSE;
		                                  				$benefits3 = FALSE;
		                                  				$benefits4 = FALSE;
		                                  				$benefits5 = FALSE;
		                                  				$benefits6 = FALSE;
		                                  				$benefits7 = FALSE;
		                                  				$benefits8 = FALSE;
		                                  				$benefits9 = FALSE;
		                                  				$benefits10 = FALSE;
		                                  				$benefits11 = FALSE;
		                                  				$benefits12 = FALSE;
		                                  				$benefits13 = FALSE;
		                                  				$benefits14 = FALSE;
		                                  				$benefits15 = FALSE;
		                                  				$benefits16 = FALSE;
		                                  				$benefits17 = FALSE;
		                                  				$benefits18 = FALSE;

			                                  			foreach ($jobInfo['jobDetails']['jobBenefits'] as $key) {
			                                  				if($key['benefits'] == 1){
			                                  					$benefits1 = TRUE;
			                                  				}elseif($key['benefits'] == 2){
			                                  					$benefits2 = TRUE;
			                                  				}elseif($key['benefits'] == 3){
			                                  					$benefits3 = TRUE;
			                                  				}elseif($key['benefits'] == 4){
			                                  					$benefits4 = TRUE;
			                                  				}elseif($key['benefits'] == 5){
			                                  					$benefits5 = TRUE;
			                                  				}elseif($key['benefits'] == 6){
			                                  					$benefits6 = TRUE;
			                                  				}elseif($key['benefits'] == 7){
			                                  					$benefits7 = TRUE;
			                                  				}elseif($key['benefits'] == 8){
			                                  					$benefits8 = TRUE;
			                                  				}elseif($key['benefits'] == 9){
			                                  					$benefits9 = TRUE;
			                                  				}elseif($key['benefits'] == 10){
			                                  					$benefits10 = TRUE;
			                                  				}elseif($key['benefits'] == 11){
			                                  					$benefits11 = TRUE;
			                                  				}elseif($key['benefits'] == 12){
			                                  					$benefits12 = TRUE;			                                  				
			                                  				}elseif($key['benefits'] == 13){
			                                  					$benefits13 = TRUE;
			                                  				}elseif($key['benefits'] == 14){
			                                  					$benefits14 = TRUE;
			                                  				}elseif($key['benefits'] == 15){
			                                  					$benefits15 = TRUE;
			                                  				}elseif($key['benefits'] == 16){
			                                  					$benefits16 = TRUE;
			                                  				}elseif($key['benefits'] == 17){
			                                  					$benefits17 = TRUE;
			                                  				}elseif($key['benefits'] == 18){
			                                  					$benefits18 = TRUE;
			                                  				}
			                                  			}
			                                  		 ?>
			                                  		
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="1" <?= $benefits1 == TRUE ? 'checked' : ''?>>                                        
	                                    <label for="benefits">SSS</label>                        
	                                  </td>
	                                  <td>
	                                  	<input type="checkbox" id="benefits" name="benefits[]" value="2" <?= $benefits2 == TRUE ? 'checked' : ''?>>                                      
	                                    <label for="benefits">Rice Allowance</label>
	                                  </td>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="3" <?= $benefits3 == TRUE ? 'checked' : ''?>>                                        
	                                    <label for="benefits">Performance Bonus</label>  
	                                  </td>
	                                </tr>
	                                
	                                <tr>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="4" <?= $benefits4 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">GSIS</label>
	                                  </td>
	                                  <td>
	                                  	  <input type="checkbox" id="benefits" name="benefits[]" value="5" <?= $benefits5 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">Meal Allowance</label>
	                                  </td>
	                                  <td>                                                   
	                                    
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="6" <?= $benefits6 == TRUE ? 'checked' : ''?>>                                       
	                                    <label for="benefits">Life Insurance</label>
	                                  </td>
	                                </tr>

	                                <tr>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="7" <?= $benefits7 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">Pagibig</label>
	                                  </td>           
	                              	  <td>
	                              	  	<input type="checkbox" id="benefits" name="benefits[]" value="8" <?= $benefits8 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">Education Allowance&nbsp;&nbsp;&nbsp;</label>
	                                  </td>
	                                  <td>
	                                  	<input type="checkbox" id="benefits" name="benefits[]" value="9" class="" <?= $benefits9 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">Sick & Vacation Leave</label>
	                                  </td>
	                                </tr>

	                                <tr>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="10" <?= $benefits10 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">Philhealth</label>
	                                  </td>                        
	                                  <td>
	                                  	<input type="checkbox" id="benefits" name="benefits[]" value="11" <?= $benefits11 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">Transpo Allowance</label>  
	                                  </td>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="12" <?= $benefits12 == TRUE ? 'checked' : ''?>>                                        
	                                    <label for="benefits">Annual Outing</label>
	                                  </td>
	                                </tr>

	                                <tr>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="13" <?= $benefits13 == TRUE ? 'checked' : ''?>>                                       
	                                    <label for="benefits">13th Month Pay</label>
	                                  </td>
	                              	  <td>
	                              	  	<input type="checkbox" id="benefits" name="benefits[]" value="14" <?= $benefits14 == TRUE ? 'checked' : ''?>>                                       
	                                    <label for="benefits">Team Building Allowance</label>
	                                  </td>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="15" <?= $benefits15 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">14th Month Pay</label>
	                                  </td>
	                                </tr>
	                                <tr>
	                                  <td>
	                                    
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="16" <?= $benefits16 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">Health & Dental Care</label>
	                                  </td>
	                                  <td>
	                                  	<input type="checkbox" id="benefits" name="benefits[]" value="17" <?= $benefits17 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">Commision</label>
	                                  </td>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="18" <?= $benefits18 == TRUE ? 'checked' : ''?>> 
	                                    <label for="benefits">Profit Sharing</label>
	                                  </td>
	                                </tr>
	                            </table>
	                        </div> 
	                    </div>
	            </div>
	       	</div>

	       	<div class="panel panel-default" style="overflow: auto">
				<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> EMPLOYEMENT TYPE</h4>
	                <div class="pull-right">
	            		<a href="#main" style="color: white;" id="button_list_toggle4" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up4"></i></a>
	            	</div>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body" id="list_panel_body4">  
		            <div class="col-md-12">
		            	<div class="col-md-12">
			            	<table class="table">
			                    <tr>
			                        <td>
			                          <?php //var_dump($jobInfo['jobDetails']['jobEducReq']);
			                                  			$emp_type1 = FALSE;
		                                  				$emp_type2 = FALSE;
		                                  				$emp_type3 = FALSE;
		                                  				$emp_type4 = FALSE;
		                                  				$emp_type5 = FALSE;
		                                  				$emp_type6 = FALSE;

			                                  			foreach ($jobInfo['jobDetails']['emp_type'] as $key) {
			                                  				if($key['emp_type'] == 1){
			                                  					$emp_type1 = TRUE;
			                                  				}elseif($key['emp_type'] == 2){
			                                  					$emp_type2 = TRUE;
			                                  				}elseif($key['emp_type'] == 3){
			                                  					$emp_type3 = TRUE;
			                                  				}elseif($key['emp_type'] == 4){
			                                  					$emp_type4 = TRUE;
			                                  				}elseif($key['emp_type'] == 5){
			                                  					$emp_type5 = TRUE;
			                                  				}elseif($key['emp_type'] == 6){
			                                  					$emp_type6 = TRUE;
			                                  				}
			                                  			}
			                                  		 ?>                           
			                          <input type="checkbox" id="emp_type" name="emp_type[]" value="1" <?= $emp_type1 == TRUE ? 'checked' : ''?>> 
			                          <label for="emp_type">Full Time</label>
			                        </td>
			                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                        </td>
			                        <td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" value="2" <?= $emp_type2 == TRUE ? 'checked' : ''?>> 
			                          <label for="emp_type">Permanent</label>
			                    	</td>
			                    </tr>       
			                    <tr>
			                        <td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" value="3" <?= $emp_type3 == TRUE ? 'checked' : ''?>> 
			                          <label for="emp_type">Part Time/Temporary</label>
			                    	</td>
			                    	<td>
			                    	</td>
			                    	<td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" value="4" <?= $emp_type4 == TRUE ? 'checked' : ''?>> 
			                          <label for="emp_type">Freelance</label>
			                    	</td>
			                    </tr>  
			                    
			                    <tr>
			                        <td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" value="5" <?= $emp_type5 == TRUE ? 'checked' : ''?>> 
			                          <label for="emp_type">Contract/Project-Based</label>
			                    	</td>
			                    	<td>
			                    	</td>
			                    	<td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" value="6" <?= $emp_type6 == TRUE ? 'checked' : ''?>> 
			                          <label for="emp_type">Internship/OJT</label>
			                    	</td>
			                    </tr>                    
			                </table>
		                </div>
		            </div>
		        </div>
	        </div>

	       	<div class="panel panel-default">
				<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> OTHER DETAILS</h4>
	                <div class="pull-right">
	            		<a href="#main" style="color: white;" id="button_list_toggle5" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up5"></i></a>
	            	</div>
	                <div class="clearfix"></div>
	            </div>
	           	<div class="panel-body" id="list_panel_body5">
		            <div class="row">
		            	<div class="col-md-12">	
			            	<div class="col-md-12">
				                <strong>Schedule Type</strong><span class="">*</span><br/>
				                <select name="sked_type" class="form-control"  style="width:100%" required>
				                  <option value="Day Shift" <?= $this->session->userdata('sked_type') == '' ? 'selected' : ''?>>Day Shift</option>
				                  <option value="Mid Shift" <?= $this->session->userdata('sked_type') == 'Mid Shift' ? 'selected' : ''?>>Mid Shift</option>
				                  <option value="Night Shift" <?= $this->session->userdata('sked_type') == 'Night Shift' ? 'selected' : ''?>>Night Shift</option>
				                  <option value="Graveyard Shift" <?= $this->session->userdata('sked_type') == 'Graveyard Shift' ? 'selected' : ''?>>Graveyard Shift</option>
				                  <option value="Flexi" <?= $this->session->userdata('sked_type') == 'Flexi' ? 'selected' : ''?>>Flexi</option>
				                  <option value="Shifting" <?= $this->session->userdata('sked_type') == 'Shifting' ? 'selected' : ''?>>Shifting</option>
				                </select>
				                <br /><br />
				            </div>

			                <div class="col-md-6">
			                        <label for="date_posted"><strong>Hiring Date Start</strong> <span class="">*</span></label>
			                        <?php echo '<span class="form_error">'.form_error('date_posted').'</span>'; ?>                            
			                        <br />
			                        <input class='form-control'  style="width:100%" type="date" name="date_posted"  value="<?= $jobInfo['jobDetails']['date_posted'] ?>"  required/>
			                        
			                </div>
			                
			                <div class="col-md-6">
			                        <label for="date_expiry"><strong>Hiring Date End</strong><span class="">*</span></label>
			                        <?php echo '<span class="form_error">'.form_error('date_expiry').'</span>'; ?>                            
			                        <br />
			                        <input class='form-control'  style="width:100%" type="date" name="date_expiry"  value="<?= $jobInfo['jobDetails']['date_expiry'] ?>"  required/>
			                        
			                </div>

			                
			            </div>

		            </div>

		        </div>

	        </div>
	        <div class="col-md-3"></div>
            <div class="col-md-6">
                    <input type="submit" value="Save" class="btn btn-block btn-md btn-success" />
                    <br />
            </div>
            <div class="col-md-3"></div>
		</div>
		<div class="col-lg-2"></div>
	</div>
</form>
<script src="//cdn.jsdelivr.net/webshim/1.14.5/polyfiller.js"></script>
<script>
    webshims.setOptions('forms-ext', {types: 'date'});
    webshims.polyfill('forms forms-ext');
</script>
