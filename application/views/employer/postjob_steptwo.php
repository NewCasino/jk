<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			Step 1 - Job Summary / <b>Step 2 - Job Details </b> /  Step 3 - Preview / Step 4 - Finalized
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<form method="post" action="<?= BASEURL . 'employers/postNewJobDetails'?>" autocomplete="off" role="form" class="form-inline" name="form">
	<div class="row">
		<div class="col-lg-2"></div>
	    <div class="col-lg-8">
	        <div class="panel panel-default" style="overflow: auto">
	        	<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> JOB REQUIREMENTS</h4>
	                <div class="pull-right">
	            		<a href="#main" style="color: white;" id="button_list_toggle1" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up1"></i></a>
	            	</div>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body" id="list_panel_body1">
						<div class="row">
							<div class="col-md-12">
				                    <div class="col-md-4">
				                            <label for="vacancy_num"><strong>Number of Vacancy</strong><span class="">*</span></label>
				                            <br />
				                            <input type="number" style="width:100%" min='1' required name="vacancy_num" class="form-control" value="">
				                    </div>
				                                            
				                    <div class="col-md-8">		                    		
				                            <label for="position_level"><strong>Position Level</strong></label>
				                            <br />
				                            <select name="position_level" class="form-control" style="width:100%" required>
				                              <option value="1">1-4 Years Experience</option>
				                              <option value="2">5-10 Years Experience</option>
				                              <option value="3">Managerial</option>
				                              <option value="4">OIC/CEO/SVP/AVP/VP/Director</option>
				                              <option value="5">Fresh Graduate/1 yrs less experience</option>
				                              <option value="6">No experience</option>
				                            </select>
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
			                                      <option value="1">Accounting Management</option>
			                                      <option value="2">General Accounting</option>
			                                      <option value="3">Consulating</option>
			                                      <option value="4">Financial Analyst</option>
			                                      <option value="5">Treasurer</option>
			                                      <option value="6">Audit & Taxation</option>
			                                      <option value="7">Credit Control</option>
			                                      <option value="8">Financial Control</option>
			                                      <option value="9">Liquidation</option>                 
			                                    </optgroup>
			            
			                                    <optgroup label="Banking & Finance">
			                                      <option value="10">Banking Services</option>
			                                      <option value="11">Credit Collection</option>
			                                      <option value="12">Security Services</option>
			                                      <option value="13">Financial Services</option>
			                                    </optgroup>
			            
			                                    <optgroup label="HR/Admin">
			                                      <option value="14">Admin Management</option>
			                                      <option value="15">Admin Staff</option>
			                                      <option value="16">Admin Secretarial</option>
			                                      <option value="17">HR Management</option>
			                                      <option value="18">HR Staff</option>
			                                      <option value="19">HR Secretarial</option>                               
			                                    </optgroup>         
			                                    
			                                    <optgroup label="Beauty Care and Health Service">
			                                      <option value="20">Sports and Recreation Service</option>
			                                      <option value="21">Nutrionist</option>
			                                      <option value="22">Beauty Service</option>   
			                                      <option value="23">All Beauty Care and Health Service</option>                                                        
			                                    </optgroup> 
			                                         
			                                    <optgroup label="Building and Construction">
			                                      <option value="24">Architectural</option>
			                                      <option value="25">Civil</option>
			                                      <option value="26">Builder/Construction</option>  
			                                      <option value="27">All Building/Construction</option>                                                         
			                                    </optgroup>  
			                                    
			                                    <optgroup label="Designing">
			                                      <option value="28">Multimedia</option>
			                                      <option value="29">Fine Arts</option>
			                                      <option value="30">Online</option>   
			                                      <option value="31">Fashion</option>  
			                                      <option value="32">Product</option>                                                     
			                                    </optgroup>    
			                                    
			                                    <optgroup label="Education">
			                                      <option value="33">Education</option>
			                                      <option value="34">Professor</option>
			                                      <option value="35">Teacher</option>   
			                                      <option value="36">Instructor</option>  
			                                      <option value="37">Lecturer</option>  
			                                      <option value="38">Tutor</option>     
			                                      <option value="39">Mentor</option>                                                    
			                                    </optgroup>      
			                                    
			                                    <optgroup label="Engineering">
			                                      <option value="40">Civil</option>
			                                      <option value="41">Chemical</option>
			                                      <option value="42">Electrical</option>   
			                                      <option value="43">Mechanical</option>  
			                                      <option value="44">System</option>  
			                                      <option value="45">Computer</option>                                                     
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Hotel, Restaurant, Food & Travel">
			                                      <option value="46" >Food & Beverages</option>
			                                      <option value="47">Hotel Services</option>
			                                      <option value="48">Travel Agency</option>                                                                                            
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Information Technology">
			                                      <option value="49">Consultancy</option>
			                                      <option value="50">Software</option>
			                                      <option value="51">Hardware</option>                                           
			                                      <option value="52">Web/online</option>    
			                                      <option value="53">Analyst</option>
			                                      <option value="54">Mobile</option>                                           
			                                      <option value="55">Networking</option> 
			                                      <option value="56">Security</option>
			                                      <option value="57">Technical Writing</option>
			                                      <option value="58">Tester/QA</option>                                           
			                                      <option value="59">SEO</option>                                          
			                                      <option value="60">Technical Support</option> 
			                                      <option value="61">MIS/IT Manager/Director/Consultant</option>
			                                      <option value="62">Project Manager</option>
			                                      <option value="63">DBA</option>                                                                                     
			                                    </optgroup>       
			                                    
			                                    <optgroup label="Insurance">
			                                      <option value="64">Agent/Broker</option>
			                                      <option value="65">Underwriter</option>
			                                      <option value="66">CSR</option>   
			                                      <option value="67">Claims Representative</option>  
			                                      <option value="68">Adjuster</option>  
			                                      <option value="69">Actuarial</option>     
			                                      <option value="70">Regulator</option>                                                 
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Management">
			                                      <option value="71">Gen. Management</option>
			                                      <option value="72">Top Level Management (Exec/OIC/CEO/CTO))</option>                                  
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Manufacturing">
			                                      		<option value="73">Gen. Manufacturing</option>
			                                          <option value="74">Production Worker</option>
			                                          <option value="75">Development (planning/testing/control)</option>   
			                                          <option value="76">Quality Assurance</option>                                         
			                                    </optgroup>              
			                                           
			                                     <optgroup label="Marketing/PR/Sales/CS">
			                                      <option value="77">Marketing</option>
			                                      <option value="78">Public Relation</option>
			                                      <option value="79">Sales (CS/Direct/Telemarketing/Tech Sales/Real State)</option>                                     
			                                      </optgroup>  
			                                    
			                                    <optgroup label="Media & Advertising">
			                                      <option value="80">Journalism</option>
			                                      <option value="81">Media Broadcasting TV/Radio/Newspaper</option>
			                                      <option value="82">Media Production</option>                                        
			                                      <option value="83">Advertising and Editorial</option> 
			                                      <option value="84">Media Planner</option>
			                                      <option value="85">Director and Creatives</option>
			                                      <option value="86">Media Buyer</option>                                    
			                                    </optgroup>   
			                                    
			                                    <optgroup label="Medical">
			                                      <option value="87">Doctors</option>
			                                      <option value="88">Nursing</option>
			                                      <option value="89">Specialist</option>                                        
			                                      <option value="90">Dentist</option> 
			                                      <option value="91">Veterinarian</option>
			                                      <option value="92">Medical Service Technician</option>
			                                      <option value="93">Pharmaceutical<option value="Banking">        
			                                      <option value="94">Therapist<option value="Banking">                                                                            
			                                    </optgroup> 
			                                    
			                                    <optgroup label="Merchandising & Purchasing">
			                                      <option value="95">Electronics</option>
			                                      <option value="96">All Accesories</option>
			                                      <option value="97">All Garments</option>                                        
			                                      <option value="98">Appliances</option> 
			                                      <option value="99">All Merchandising</option>                                                                                
			                                    </optgroup>                                                                                                                           
			                                    <optgroup label="Professional Services">
			                                      <option value="100">Property</option>
			                                      <option value="101">Consultancy & Management</option>
			                                    </optgroup>
			                                    
			                                     <optgroup label="Public/Civil">
			                                      <option value="102">Civil Services</option>
			                                      <option value="103">Foreign Affairs</option>
			                                      <option value="104">Government Bodies</option>                                        
			                                      <option value="105">Military/Defense</option> 
			                                      <option value="106">Social Services</option>     
			                                      <option value="107">Utilities</option>  
			                                    </optgroup>
			                                    
			                                    <optgroup label="Sales/Customer Service">
			                                      <option value="108">CSR/TSR</option>
			                                      <option value="109">Retail/Wholesaler</option>                              
			                                    </optgroup>
			                                    
			                                    <optgroup label="Science/Laboratory/Research & Development">
			                                      <option value="110">Research & Development</option>
			                                      <option value="111">All laboratory jobs</option>                                      
			                                    </optgroup>
			                                    
			                                    <optgroup label="Telecomm">
			                                      <option value="112">Engineering</option>
			                                      <option value="113">Administration</option>
			                                      <option value="114">Staff</option>                                                                       
			                                    </optgroup>
			                                    
			                                    <optgroup label="Transpo & Logistics">
			                                      <option value="115">Land</option>
			                                      <option value="116">Aerial</option>
			                                      <option value="117">Maritime Services</option>                                                                      
			                                    </optgroup>
			                                    <optgroup label="Others">
			                                      <option value="118">Skill Worker</option>
			                                      <option value="119">Artist</option>
			                                      <option value="120">Modelling</option>
			                                      <option value="121">Singers</option>                                        
			                                      <option value="122">Musicians</option>  
			                                      <option value="123">Entertainer</option>  
			                                      <option value="124">Creative Artist</option>  
			                                      <option value="125">All Others</option>                                    
			                                    </optgroup>
		                            </select> 
		                            <br/> 
					            </div>
					            <div class="col-md-4">
					            	<br />
			                        <label for="yr_exp"><strong>Job yrs of experience</strong><br/></label>                                                  
			                            <select name="yr_exp" class="form-control"  style="width:100%" required>
			                              <option value="1-2">1-2 yrs</option>
			                              <option value="2-3">2-3 yrs</option>
			                              <option value="3-4">3-4 yrs</option>
			                              <option value="4-5">4-5 yrs</option>
			                              <option value="5-6">5-6 yrs</option>
			                              <option value="6-7">6-7 yrs</option>
			                              <option value="7-8">7-8 yrs</option>
			                              <option value="8-9">8-9 yrs</option>
			                              <option value="9-10">9-10 yrs</option>
			                            </select>
			                            <br/><br />
			                    </div>  
					        </div>                                                      
	                    </div> 
		                <div class="row">            
		                    <div class="col-md-12">
		                    	<div class="col-md-12">
			                        <label for="job_description"><strong>Job Description</strong><span class="">*</span></label>                        
			                        <?php echo '<span class="form_error">'.form_error('job_description').'</span>'; ?>
			                        <br />
			                        <textarea name='job_description' required style="width:100%" class="form-control" id='job_description'></textarea>
			                    </div>
		                    </div>                                                      
	                    </div>
	                    <div class="col-md-12">
	                        <br/>
	                        <label for="experience_req"><strong>Experience Requirements</strong></label>
	                        <?php echo '<span class="form_error">'.form_error('experience_req').'</span>'; ?>                                                       
	                        <br />
	                        <textarea name='experience_req' required style="width:100%" class="form-control" id='experience_req'></textarea>
	                    </div>                                            
	                                            
	                    <div class="col-md-12">
	                        <br/>
	                        <label for="additional_job_req"><strong>Additional Job Requirements</strong></label>                       		                         	
	                        <br />
	                        <textarea name='additional_job_req' style="width:100%" class="form-control" id='additional_job_req'></textarea>
	                        <br/>
	                        <br/>
	                    </div>
	                     
	                    <div class="col-md-12">
	                    	<div class="panel">
	                    		<div class="panel-head">
	                            	<strong>Education Requirements</strong>
	                            </div>
	                            <div class="panel-body">
			                            <table class="table">
			                                <tr>
			                                  <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" value="1" onclick="setEducReqAttr()" class="educational_req" <?php echo set_checkbox('educational_req', 'High School Undergraduate'); ?>>
					                            <label for="educational_req">High School Undergraduate</label>
					                          </td>
					                          <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" value="2" class="educational_req" <?php echo set_checkbox('educational_req', 'Degree Holder'); ?>>
					                            <label for="educational_req">Degree Holder</label>
					                          </td>
					                        </tr>
					                        <tr>
			                                  <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" value="3" class="educational_req" <?php echo set_checkbox('educational_req', 'College Graduate'); ?>>
					                            <label for="educational_req">High School Graduate</label>
					                          </td>
					                          <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" value="4" class="educational_req" <?php echo set_checkbox('educational_req', 'Master Degree Holder'); ?>>
					                            <label for="educational_req">Master Degree Holder</label>		                            		
					                          </td>
					                        </tr>
					                        <tr>
			                                  <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" value="5" class="educational_req" <?php echo set_checkbox('educational_req', 'Vocational / Short Courses / Diploma'); ?>>
					                            <label for="educational_req">Vocational / Short Courses / Diploma</label>	
					                          </td>
					                          <td>
					                            <input type="checkbox" id="educational_req" name="educational_req[]" value="6" class="educational_req" <?php echo set_checkbox('educational_req', 'PhD / Doctorate Holder'); ?>>
					                            <label for="educational_req">PhD / Doctorate Holder</label>
					                          </td>
					                        </tr>
										</table>
		                        </div>
	                        </div>
	                    </div> 
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
			                              <option value="/mo">Monthly Rate</option>
			                              <option value="/week">Weekly Rate</option>
			                              <option value="/day">Daily Rate</option>
			                              <option value="/hr">Hourly Rate</option>
			                            </select>
			                            <br />
			                    </div>

			                    <div class="col-md-2">     
			                                <label for="currency">Currency</label>
			                                <select name="currency" class="form-control" required>
			                                  <option value="PHP">PHP</option>
			                                  <option value="USD">USD</option>
			                                </select>
			                                <br />
			                    </div>
		                
			                    <div class="col-md-3">
			                                <label for="salary_range">From</label>                                                                                
			                                <select name="salary_min" class="form-control" style="width:100%">
			                                  <option value="10000">10,000</option>
			                                  <option value="20000">20,000</option>
			                                  <option value="30000">30,000</option>
			                                  <option value="40000">40,000</option>
			                                  <option value="50000">50,000</option>
			                                  <option value="60000">60,000</option>
			                                  <option value="70000">70,000</option>
			                                  <option value="80000">80,000</option>
			                                  <option value="90000">90,000</option>
			                                  <option value="100000">100,000</option>
			                                  <option value="150000">150,000</option>
			                                  <option value="200000">200,000</option>
			                                  <option value="250000">250,000</option>
			                                  <option value="300000">300,000</option>
			                                </select>
			                                <br />
			                    </div>
				                <div class="col-md-4">
				                            <label for="salary_range">To</label>
				                            <select name="salary_max" class="form-control" style="width:100%">
				                              <option value="20000">20,000</option>
				                              <option value="30000">30,000</option>
				                              <option value="40000">40,000</option>
				                              <option value="50000">50,000</option>
				                              <option value="60000">60,000</option>
				                              <option value="70000">70,000</option>
				                              <option value="80000">80,000</option>
				                              <option value="90000">90,000</option>
				                              <option value="100000">100,000</option>
				                              <option value="150000">150,000</option>
				                              <option value="200000">200,000</option>
				                              <option value="250000">250,000</option>
				                              <option value="500000">500,000</option>
				                            </select>
				                            <br />
				                </div>
				            </div>
			            	<div class="row">
			            		<br />
			                    <div class="col-md-12">
			                    	<strong>Salary Type:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong> 
                                    <input id="salary_type" name="salary_type" type="radio" class="" value="1" checked="true" <?php echo $this->form_validation->set_radio('salary_type', '1'); ?> />
                                    <label for="salary_type" class="">Negotiable</label>
                    				&nbsp;&nbsp;&nbsp;
                                    <input id="salary_type" name="salary_type" type="radio" class="" value="2" <?php echo $this->form_validation->set_radio('salary_type', '2'); ?> />
                                    <label for="salary_type" class="">Commission w/ base salary</label>
                                    &nbsp;&nbsp;&nbsp;
                                    <input id="salary_type" name="salary_type" type="radio" class="" value="3" <?php echo $this->form_validation->set_radio('salary_type', '3'); ?> />
                                    <label for="salary_type" class="">None</label>
		                        </div>

			                    <div class="col-md-5">
		                            <strong>Display Salary:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>                           
                                    <input id="show_salary" name="show_salary" type="radio" class="" value="0" checked="true" <?php echo $this->form_validation->set_radio('show_salary', '0'); ?> />
                                    <label for="show_salary" class="">Yes</label>
                    				&nbsp;&nbsp;&nbsp;
                                    <input id="show_salary" name="show_salary" type="radio" class="" value="1" <?php echo $this->form_validation->set_radio('show_salary', '1'); ?> />
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
	                                    <input type="checkbox" id="benefits" checked name="benefits[]" value="1" >                                        
	                                    <label for="benefits">SSS</label>                        
	                                  </td>
	                                  <td>
	                                  	<input type="checkbox" id="benefits" name="benefits[]" value="2" >                                      
	                                    <label for="benefits">Rice Allowance</label>
	                                  </td>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="3" >                                        
	                                    <label for="benefits">Performance Bonus</label>  
	                                  </td>
	                                </tr>
	                                
	                                <tr>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="4"> 
	                                    <label for="benefits">GSIS</label>
	                                  </td>
	                                  <td>
	                                  	  <input type="checkbox" id="benefits" name="benefits[]" value="5"> 
	                                    <label for="benefits">Meal Allowance</label>
	                                  </td>
	                                  <td>                                                   
	                                    
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="6">                                       
	                                    <label for="benefits">Life Insurance</label>
	                                  </td>
	                                </tr>

	                                <tr>
	                                  <td>
	                                    <input type="checkbox" id="benefits" checked name="benefits[]" value="7"> 
	                                    <label for="benefits">Pagibig</label>
	                                  </td>           
	                              	  <td>
	                              	  	<input type="checkbox" id="benefits" name="benefits[]" value="8"> 
	                                    <label for="benefits">Education Allowance&nbsp;&nbsp;&nbsp;</label>
	                                  </td>
	                                  <td>
	                                  	<input type="checkbox" id="benefits" checked name="benefits[]" value="9" > 
	                                    <label for="benefits">Sick & Vacation Leave</label>
	                                  </td>
	                                </tr>

	                                <tr>
	                                  <td>
	                                    <input type="checkbox" id="benefits" checked name="benefits[]" value="10"> 
	                                    <label for="benefits">Philhealth</label>
	                                  </td>                        
	                                  <td>
	                                  	<input type="checkbox" id="benefits" name="benefits[]" value="11" > 
	                                    <label for="benefits">Transpo Allowance</label>  
	                                  </td>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="12" >                                        
	                                    <label for="benefits">Annual Outing</label>
	                                  </td>
	                                </tr>

	                                <tr>
	                                  <td>
	                                    <input type="checkbox" id="benefits" checked name="benefits[]" value="13">                                       
	                                    <label for="benefits">13th Month Pay</label>
	                                  </td>
	                              	  <td>
	                              	  	<input type="checkbox" id="benefits" name="benefits[]" value="14">                                       
	                                    <label for="benefits">Team Building Allowance</label>
	                                  </td>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="15" > 
	                                    <label for="benefits">14th Month Pay</label>
	                                  </td>
	                                </tr>
	                                <tr>
	                                  <td>
	                                    
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="16"> 
	                                    <label for="benefits">Health & Dental Care</label>
	                                  </td>
	                                  <td>
	                                  	<input type="checkbox" id="benefits" name="benefits[]" value="17"> 
	                                    <label for="benefits">Commision</label>
	                                  </td>
	                                  <td>
	                                    <input type="checkbox" id="benefits" name="benefits[]" value="18"> 
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
			                          <input type="checkbox" id="emp_type" name="emp_type[]" class="emp_type" value="1"> 
			                          <label for="emp_type">Full Time</label>
			                        </td>
			                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                        </td>
			                        <td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" class="emp_type" value="2"> 
			                          <label for="emp_type">Permanent</label>
			                    	</td>
			                    </tr>       
			                    <tr>
			                        <td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" class="emp_type" value="3"> 
			                          <label for="emp_type">Part Time/Temporary</label>
			                    	</td>
			                    	<td>
			                    	</td>
			                    	<td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" class="emp_type" value="4"> 
			                          <label for="emp_type">Agency</label>
			                    	</td>
			                    </tr>  
			                    
			                    <tr>
			                        <td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" class="emp_type" value="5"> 
			                          <label for="emp_type">Contract/Project-Based</label>
			                    	</td>
			                    	<td>
			                    	</td>
			                    	<td> 
			                          <input type="checkbox" id="emp_type" name="emp_type[]" class="emp_type" value="6"> 
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
				                <strong>Schedule Type</strong><span class="">*</span>
				                <select name="sked_type" class="form-control"  style="width:100%" required>
				                  <option value="Day Shift">Day Shift</option>
				                  <option value="Mid Shift">Mid Shift</option>
				                  <option value="Night Shift">Night Shift</option>
				                  <option value="Graveyard Shift">Graveyard Shift</option>
				                  <option value="Flexi">Flexi</option>
				                  <option value="Shifting">Shifting</option>
				                </select>
				                <br /><br />
				            </div>

			                <div class="col-md-6">
			                        <label for="date_posted"><strong>Hiring Date Start</strong> <span class="">*</span></label>
			                        <?php echo '<span class="form_error">'.form_error('date_posted').'</span>'; ?>                            
			                        <br />
			                        <input class='form-control'  style="width:100%" type="date" name="date_posted" value="<?php echo date('Y-m-d'); ?>"  required/>
			                        
			                </div>
			                
			                <div class="col-md-6">
			                        <label for="date_expiry"><strong>Hiring Date End</strong><span class="">*</span></label>
			                        <?php echo '<span class="form_error">'.form_error('date_expiry').'</span>'; ?>                            
			                        <br />
			                        <input class='form-control'  style="width:100%" type="date" name="date_expiry"  value="<?php echo date('Y-m-d'); ?>"  required/>			                        
			                </div>			                
			            </div>
		            </div>
		        </div>
	        </div>
	        <div class="col-md-3"></div>
            <div class="col-md-6">
                    <input type="submit" value="Next" onClick="valthis()" class="btn btn-block btn-md btn-success" />
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

	//checkbox validation
	function valthis() {
		var educational_req = document.getElementsByClassName( 'educational_req' );
		var emp_type = document.getElementsByClassName( 'emp_type' );
		
		var isChecked_educational_req = false;
	    for (var i = 0; i < educational_req.length; i++) {
	        if ( educational_req[i].checked ) {
	            isChecked_educational_req = true;
	        };
	    };
	    if ( isChecked_educational_req ) {
        	$('.educational_req').attr('required',false);
        } else {
            //alert( 'Please, check at least one checkbox!' );
            $('.educational_req').attr('required',true);
        }   

        var isChecked_emp_type = false;
	    for (var i = 0; i < emp_type.length; i++) {
	        if ( emp_type[i].checked ) {
	            isChecked_emp_type = true;
	        };
	    };
	    if ( isChecked_emp_type ) {
        	$('.emp_type').attr('required',false);
        } else {
            //alert( 'Please, check at least one checkbox!' );
            $('.emp_type').attr('required',true);
        }   
	}
</script>