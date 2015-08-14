<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			<b>Step 1 - Employer Details</b> / Step 2 - Upload / Step 3 - Finalized
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<div class="row">
	<div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="panel panel-default" style="overflow: auto">
	        	<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> EMPLOYER DETAILS</h4>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body">
					<form method="post" action="<?= BASEURL . 'employers/postEmployerDetails'?>" autocomplete="off" role="form" class="form-inline" name="form">
						<?php //echo $this->tinyMce;?>
						<div class="col-md-12">
								<br />
								<label for="company_name"><strong>Company Name</strong> <span class="required">*</span></label>
								<?php //var_dump($this->session->userdata('employerProfile')); //echo form_error('company_name'); ?>
								<br /><input id="company_name" style="width:100%" class="form-control" required type="text" name="company_name" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['comp_name']); ?>" />						
						</div>

						<div class="col-md-12">
							<br />	
							<label for="comp_desc"><strong>Description</strong> <span class="required">*</span></label>
							<?php echo form_error('comp_desc'); ?>
							<br />
							<textarea style="width:100%" rows='5' name='comp_desc' class="form-control" id='comp_desc'><?= $empInfo['empDetails']['comp_desc']; ?></textarea>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
									<br />							
									<label for="comp_nature"><strong>Nature of Business</strong> <span class="required">*</span></label>
									<?php echo form_error('comp_nature'); ?>					
									<br />
									<!-- <input id="comp_nature" style="width:100%" class="form-control" required type="text" name="comp_nature" maxlength="30" size="40" value="<?php echo ucwords($this->session->userdata('employerProfile')['comp_nature']); ?>" /> -->
									<select id="comp_nature" style="width:100%" class="form-control" required name="comp_nature"> <!-- pls set position:absolute in css -->
				                    	<option value="" <?= $this->session->userdata('employerProfile')['comp_nature']=='' ? 'selected' : ''; ?>>Select Nature of Business</option>
					                    <option value="1" <?= $this->session->userdata('employerProfile')['comp_nature']=='1' ? 'selected' : ''; ?>>Accounting / Audit / Tax Services</option>
					                    <option value="2" <?= $this->session->userdata('employerProfile')['comp_nature']=='2' ? 'selected' : ''; ?>>Advertising / Public Relations / Marketing Services</option>
					                    <option value="3" <?= $this->session->userdata('employerProfile')['comp_nature']=='3' ? 'selected' : ''; ?>>Agriculture / Forestry / Fishing</option>
					                    <option value="4" <?= $this->session->userdata('employerProfile')['comp_nature']=='4' ? 'selected' : ''; ?>>Animal / Livestock / Poultry Production</option>
					                    <option value="5" <?= $this->session->userdata('employerProfile')['comp_nature']=='5' ? 'selected' : ''; ?>>Architecture / Building / Construction</option>
					                    <option value="6" <?= $this->session->userdata('employerProfile')['comp_nature']=='6' ? 'selected' : ''; ?>>Photography / Videography / Arts</option>
					                    <option value="7" <?= $this->session->userdata('employerProfile')['comp_nature']=='7' ? 'selected' : ''; ?>>Athletics / Sports</option>
					                    <option value="8" <?= $this->session->userdata('employerProfile')['comp_nature']=='8' ? 'selected' : ''; ?>>Contact Center / BPO</option>
					                    <option value="9" <?= $this->session->userdata('employerProfile')['comp_nature']=='9' ? 'selected' : ''; ?>>Charity / Social Services / Non-Profit Organisation</option>
					                    <option value="10" <?= $this->session->userdata('employerProfile')['comp_nature']=='10' ? 'selected' : ''; ?>>Civil Services (Government, Armed Forces)</option>
					                    <option value="11" <?= $this->session->userdata('employerProfile')['comp_nature']=='11' ? 'selected' : ''; ?>>Education</option>
					                    <option value="12" <?= $this->session->userdata('employerProfile')['comp_nature']=='12' ? 'selected' : ''; ?>>Energy / Power / Water / Oil &amp; Gas / Waste Management</option>
					                    <option value="13" <?= $this->session->userdata('employerProfile')['comp_nature']=='13' ? 'selected' : ''; ?>>Engineering - Building, Civil, Construction / Quantity Survey</option>
					                    <option value="14" <?= $this->session->userdata('employerProfile')['comp_nature']=='14' ? 'selected' : ''; ?>>Engineering - Electrical / Electronic / Mechanical</option>
					                    <option value="15" <?= $this->session->userdata('employerProfile')['comp_nature']=='15' ? 'selected' : ''; ?>>Engineering - Others</option>
					                    <option value="16" <?= $this->session->userdata('employerProfile')['comp_nature']=='16' ? 'selected' : ''; ?>>Entertainment / Recreation</option>
					                    <option value="17" <?= $this->session->userdata('employerProfile')['comp_nature']=='17' ? 'selected' : ''; ?>>Environmental Science</option>
					                    <option value="18" <?= $this->session->userdata('employerProfile')['comp_nature']=='18' ? 'selected' : ''; ?>>Export</option>
					                    <option value="19" <?= $this->session->userdata('employerProfile')['comp_nature']=='19' ? 'selected' : ''; ?>>Financial Services</option>
					                    <option value="20" <?= $this->session->userdata('employerProfile')['comp_nature']=='20' ? 'selected' : ''; ?>>FMCG</option>
					                    <option value="21" <?= $this->session->userdata('employerProfile')['comp_nature']=='21' ? 'selected' : ''; ?>>Food and Catering Services</option>
					                    <option value="22" <?= $this->session->userdata('employerProfile')['comp_nature']=='22' ? 'selected' : ''; ?>>Freight Forwarding / Delivery / Shipping</option>
					                    <option value="23" <?= $this->session->userdata('employerProfile')['comp_nature']=='23' ? 'selected' : ''; ?>>General Business Services</option>
					                    <option value="24" <?= $this->session->userdata('employerProfile')['comp_nature']=='24' ? 'selected' : ''; ?>>General Engineering Services</option>
					                    <option value="25" <?= $this->session->userdata('employerProfile')['comp_nature']=='25' ? 'selected' : ''; ?>>Health Services &amp; Beauty Care</option>
					                    <option value="26" <?= $this->session->userdata('employerProfile')['comp_nature']=='26' ? 'selected' : ''; ?>>Hospitality / Hotel Services</option>
					                    <option value="27" <?= $this->session->userdata('employerProfile')['comp_nature']=='27' ? 'selected' : ''; ?>>Information Technology</option>
					                    <option value="28" <?= $this->session->userdata('employerProfile')['comp_nature']=='28' ? 'selected' : ''; ?>>Insurance / Pension Funding</option>
					                    <option value="29" <?= $this->session->userdata('employerProfile')['comp_nature']=='29' ? 'selected' : ''; ?>>Design</option>
					                    <option value="30" <?= $this->session->userdata('employerProfile')['comp_nature']=='30' ? 'selected' : ''; ?>>Legal Services</option>
					                    <option value="31" <?= $this->session->userdata('employerProfile')['comp_nature']=='31' ? 'selected' : ''; ?>>Life Sciences</option>
					                    <option value="32" <?= $this->session->userdata('employerProfile')['comp_nature']=='32' ? 'selected' : ''; ?>>Manpower / Personnel Recruitment</option>
					                    <option value="33" <?= $this->session->userdata('employerProfile')['comp_nature']=='33' ? 'selected' : ''; ?>>Manufacturing</option>
					                    <option value="34" <?= $this->session->userdata('employerProfile')['comp_nature']=='34' ? 'selected' : ''; ?>>Mass Transportation (Land, Air, Sea)</option>
					                    <option value="35" <?= $this->session->userdata('employerProfile')['comp_nature']=='35' ? 'selected' : ''; ?>>Media / Publishing / Printing</option>
					                    <option value="36" <?= $this->session->userdata('employerProfile')['comp_nature']=='36' ? 'selected' : ''; ?>>Medical / Pharmaceutical</option>
					                    <option value="37" <?= $this->session->userdata('employerProfile')['comp_nature']=='37' ? 'selected' : ''; ?>>Mining and Quarrying</option>
					                    <option value="38" <?= $this->session->userdata('employerProfile')['comp_nature']=='38' ? 'selected' : ''; ?>>Property Management / Consultancy</option>
					                    <option value="39" <?= $this->session->userdata('employerProfile')['comp_nature']=='39' ? 'selected' : ''; ?>>Security / Protection Services</option>
					                    <option value="40" <?= $this->session->userdata('employerProfile')['comp_nature']=='40' ? 'selected' : ''; ?>>Telecommunication</option>
					                    <option value="41" <?= $this->session->userdata('employerProfile')['comp_nature']=='41' ? 'selected' : ''; ?>>Tourism / Travel Agency</option>
					                    <option value="42" <?= $this->session->userdata('employerProfile')['comp_nature']=='42' ? 'selected' : ''; ?>>Trading and Distribution</option>
					                    <option value="43" <?= $this->session->userdata('employerProfile')['comp_nature']=='43' ? 'selected' : ''; ?>>Others</option>
								    </select>
								</div>

								<div class="col-md-6">
									<br />
									<label for="comp_type"><strong>Company Type</strong> <span class="required">*</span></label>
									<?php echo form_error('comp_type'); ?>
									<br />
									<!-- <input id="comp_type" style="width:100%" class="form-control" required type="text" name="comp_type" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['comp_type']); ?>" /> -->
									<select id="comp_type" style="width:100%" class="form-control" required name="comp_type"> <!-- pls set position:absolute in css -->
				                    	<option value="" <?= $this->session->userdata('employerProfile')['comp_type']=='' ? 'selected' : ''; ?>>Select Company Type</option>
				                    	<option value="1" <?= $this->session->userdata('employerProfile')['comp_type']=='1' ? 'selected' : ''; ?>>Sole Proprietorship</option>
				                    	<option value="2" <?= $this->session->userdata('employerProfile')['comp_type']=='2' ? 'selected' : ''; ?>>Partnership</option>
				                    	<option value="3" <?= $this->session->userdata('employerProfile')['comp_type']=='3' ? 'selected' : ''; ?>>Corporation</option>
				                    	<option value="4" <?= $this->session->userdata('employerProfile')['comp_type']=='4' ? 'selected' : ''; ?>>Government-Agency</option>
				                    	<option value="5" <?= $this->session->userdata('employerProfile')['comp_type']=='5' ? 'selected' : ''; ?>>Non Goverrment Organization (NGO)</option>
				                    	<option value="6" <?= $this->session->userdata('employerProfile')['comp_type']=='6' ? 'selected' : ''; ?>>Multinational</option>
				                    </select>
								</div>
							</div>
						</div>

						<div class="col-md-12">
							<br />	
							<label for="address"><strong>Company Address</strong> <span class="required">*</span></label>
							<?php echo form_error('address'); ?>
							<textarea style="width:100%" rows='2' name='address' class="form-control" id='address'><?= $empInfo['empDetails']['address']; ?></textarea>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="col-md-6">
									<br />
									<label for="city"><strong>City</strong> <span class="required">*</span></label>
									<?php echo form_error('city'); ?>
									<br /><input id="city" style="width:100%" class="form-control" required type="text" name="city" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['city']); ?>" />
								</div>

								<div class="col-md-6">
										<br />
										<strong>Region/State</strong> <span class="required">*</span>
										<?php echo form_error('state'); ?>
				                        <br />
				                        <select style="width:100%" class="chosen-select-deselect form-control" required name="state">
				                                <option value="">Select Region</option>
				                                <optgroup label="Local">
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='ARMM' ? 'selected' : ''; ?>>ARMM</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Bicol Region' ? 'selected' : ''; ?>>Bicol Region</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='C.A.R' ? 'selected' : ''; ?>>C.A.R</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Cagayan Valley' ? 'selected' : ''; ?>>Cagayan Valley</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Calabarzon' ? 'selected' : ''; ?>>Calabarzon</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Caraga' ? 'selected' : ''; ?>>Caraga</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Central Luzon' ? 'selected' : ''; ?>>Central Luzon</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Central Visayas' ? 'selected' : ''; ?>>Central Visayas</option>                                     
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Eastern Visayas' ? 'selected' : ''; ?>>Eastern Visayas</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Ilocos Region' ? 'selected' : ''; ?>>Ilocos Region</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='N.C.R' ? 'selected' : ''; ?>>N.C.R</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Nothern Mindanao' ? 'selected' : ''; ?>>Nothern Mindanao</option>                          
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Southern Mindanao' ? 'selected' : ''; ?>>Southern Mindanao</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Southern Tagalog' ? 'selected' : ''; ?>>Southern Tagalog</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Western Mindanao' ? 'selected' : ''; ?>>Western Mindanao</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Western Visayas' ? 'selected' : ''; ?>>Western Visayas</option>                                                                               
				                                </optgroup>
				        
				                                <optgroup label="Abroad (Asia)">
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='China' ? 'selected' : ''; ?>>China</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Hongkong' ? 'selected' : ''; ?>>Hongkong</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='India' ? 'selected' : ''; ?>>India</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Indonesia' ? 'selected' : ''; ?>>Indonesia</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Japan' ? 'selected' : ''; ?>>Japan</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Malaysia' ? 'selected' : ''; ?>>Malaysia</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Singapore' ? 'selected' : ''; ?>>Singapore</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Thailand' ? 'selected' : ''; ?>>Thailand</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Vietnam' ? 'selected' : ''; ?>>Vietnam</option>
				                                </optgroup>
				        
				                                <optgroup label="Abroad (Other)">
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Africa' ? 'selected' : ''; ?>>Africa</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Middle East' ? 'selected' : ''; ?>>Middle East</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Australia & New Zealand' ? 'selected' : ''; ?>>Australia & New Zealand</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='Europe' ? 'selected' : ''; ?>>Europe</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='North America' ? 'selected' : ''; ?>>North America</option>
				                                  <option <?= $this->session->userdata('employerProfile')['state']=='South America' ? 'selected' : ''; ?>>South America</option>                                  
				                                </optgroup>                                           
				                        </select>
								</div> 

							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<br/>
								<div class="col-md-6">
										<strong>Country</strong> <span class="required">*</span>
										<?php echo form_error('country'); ?>
				                        <br />
				                        <select style="width:100%" class="chosen-select-deselect form-control" required name="country">
											<option value="">Select</option>
											<option value="1">Afghanistan</option>
											<option value="2">Aland Islands</option>
											<option value="3">Albania</option>
											<option value="4">Algeria</option>
											<option value="5">American Samoa</option>
											<option value="6">Andorra</option>
											<option value="7">Angola</option>
											<option value="8">Anguilla</option>
											<option value="9">Antarctica</option>
											<option value="10">Antigua and Barbuda</option>
											<option value="11">Argentina</option>
											<option value="12">Armenia</option>
											<option value="13">Aruba</option>
											<option value="14">Australia</option>
											<option value="15">Austria</option>
											<option value="16">Azerbaijan</option>
											<option value="17">Bahamas</option>
											<option value="18">Bahrain</option>
											<option value="19">Bangladesh</option>
											<option value="20">Barbados</option>
											<option value="21">Belarus</option>
											<option value="22">Belgium</option>
											<option value="23">Belize</option>
											<option value="24">Benin</option>
											<option value="25">Bermuda</option>
											<option value="26">Bhutan</option>
											<option value="27">Bolivia</option>
											<option value="28">Bonaire, San Eustaquio and Saba</option>
											<option value="29">Bosnia and Herzegovina</option>
											<option value="30">Botswana</option>
											<option value="31">Bouvet Island</option>
											<option value="32">Brazil</option>
											<option value="33">British Indian Ocean Territory</option>
											<option value="34">Brunei Darussalam</option>
											<option value="35">Bulgaria</option>
											<option value="36">Burkina Faso</option>
											<option value="37">Burundi</option>
											<option value="38">Caicos and Turcas Islands</option>
											<option value="39">Cambodia</option>
											<option value="40">Cameroon</option>
											<option value="41">Canada</option>
											<option value="42">Cape Verde</option>
											<option value="43">Cayman Islands</option>
											<option value="44">Central African Republic</option>
											<option value="45">Chad</option>
											<option value="46">Chile</option>
											<option value="47">China</option>
											<option value="48">Christmas Island</option>
											<option value="49">Cocos Islands</option>
											<option value="50">Colombia</option>
											<option value="51">Comoros</option>
											<option value="52">Congo</option>
											<option value="53">Congo, Democratic Republic of the</option>
											<option value="54">Cook Islands</option>
											<option value="55">Costa Rica</option>
											<option value="56">Croatia</option>
											<option value="57">Cuba</option>
											<option value="58">Curacao</option>
											<option value="59">Cyprus</option>
											<option value="60">Czech Republic</option>
											<option value="61">Denmark</option>
											<option value="62">Dominica</option>
											<option value="63">Dominican Republic</option>
											<option value="64">Ecuador</option>
											<option value="65">Egypt</option>
											<option value="66">El Salvador</option>
											<option value="67">Equatorial Guinea</option>
											<option value="68">Eritrea</option>
											<option value="69">Estonia</option>
											<option value="70">Ethiopia</option>
											<option value="71">Feroe Islands</option>
											<option value="72">Fiji</option>
											<option value="73">Finland</option>
											<option value="74">France</option>
											<option value="75">French Guiana</option>
											<option value="76">French Polynesia</option>
											<option value="77">French Southern Territories</option>
											<option value="78">Gabon</option>
											<option value="79">Gambia</option>
											<option value="80">Georgia</option>
											<option value="81">Germany</option>
											<option value="82">Ghana</option>
											<option value="83">Gibraltar</option>
											<option value="84">Granada</option>
											<option value="85">Greece</option>
											<option value="86">Greenland</option>
											<option value="87">Guadeloupe</option>
											<option value="88">Guam</option>
											<option value="89">Guatemala</option>
											<option value="90">Guernsey</option>
											<option value="91">Guinea</option>
											<option value="92">Guinea-Bissau</option>
											<option value="93">Guyana</option>
											<option value="94">Haiti</option>
											<option value="95">Heard Island and Mcdonald Island</option>
											<option value="96">Honduras</option>
											<option value="97">Hong Kong</option>
											<option value="98">Hungary</option>
											<option value="99">Iceland</option>
											<option value="100">India</option>
											<option value="101">Indonesia</option>
											<option value="102">Iran</option>
											<option value="103">Iraq</option>
											<option value="104">Ireland</option>
											<option value="105">Isle of Man</option>
											<option value="106">Israel</option>
											<option value="107">Italy</option>
											<option value="108">Ivory Coast</option>
											<option value="109">Jamaica</option>
											<option value="110">Japan</option>
											<option value="111">Jersey</option>
											<option value="112">Jordan</option>
											<option value="113">Kazakhstan</option>
											<option value="114">Kenya</option>
											<option value="115">Kirguistan</option>
											<option value="116">Kiribati</option>
											<option value="117">Korea</option>
											<option value="118">Kuwait</option>
											<option value="119">Lao</option>
											<option value="120">Latvia</option>
											<option value="121">Lebanon</option>
											<option value="122">Lesotho</option>
											<option value="123">Liberia</option>
											<option value="124">Libya</option>
											<option value="125">Liechtenstein</option>
											<option value="126">Lithuania</option>
											<option value="127">Luxembourg</option>
											<option value="128">Macau</option>
											<option value="129">Macedonia</option>
											<option value="130">Madagascar</option>
											<option value="131">Malawi</option>
											<option value="132">Malaysia</option>
											<option value="133">Maldives</option>
											<option value="134">Maldives</option>
											<option value="135">Mali</option>
											<option value="136">Malta</option>
											<option value="137">Marshall Islands</option>
											<option value="138">Martinique</option>
											<option value="139">Mauritania</option>
											<option value="140">Mauritius</option>
											<option value="141">Mayotte</option>
											<option value="142">Mexico</option>
											<option value="143">Micronesia</option>
											<option value="144">Moldova</option>
											<option value="145">Monaco</option>
											<option value="146">Mongolia</option>
											<option value="147">Montenegro</option>
											<option value="148">Montserrat</option>
											<option value="149">Morocco</option>
											<option value="150">Mozambique</option>
											<option value="151">Myanmar</option>
											<option value="152">Namibia</option>
											<option value="153">Nauru</option>
											<option value="154">Nepal</option>
											<option value="155">Netherlands</option>
											<option value="156">New Caledonia</option>
											<option value="157">New Zealand</option>
											<option value="158">Nicaragua</option>
											<option value="159">Níger</option>
											<option value="160">Nigeria</option>
											<option value="161">Niue</option>
											<option value="162">Norfolk Island</option>
											<option value="163">North Korea</option>
											<option value="164">Northern Mariana</option>
											<option value="165">Norway</option>
											<option value="166">Oman</option>
											<option value="167">Pakistan</option>
											<option value="168">Palau</option>
											<option value="169">Palestina</option>
											<option value="170">Panama</option>
											<option value="171">Papua New Guinea</option>
											<option value="172">Paraguay</option>
											<option value="173">Peru</option>
											<option selected="selected" value="249">Philippines</option>
											<option value="174">Pitcairn</option>
											<option value="175">Poland</option>
											<option value="176">Portugal</option>
											<option value="177">Puerto Rico</option>
											<option value="178">Qatar</option>
											<option value="179">Reunion</option>
											<option value="180">Rumania</option>
											<option value="181">Russia</option>
											<option value="182">Rwanda</option>
											<option value="183">Saint Bartolomé</option>
											<option value="184">Saint Helena</option>
											<option value="185">Saint Kitts and Nevis</option>
											<option value="186">Saint Lucia</option>
											<option value="187">Saint Pierre and Miquelon</option>
											<option value="188">Saint Vincent and the Grenadines</option>
											<option value="189">Salomon Islands</option>
											<option value="190">Samoa</option>
											<option value="191">San Marino</option>
											<option value="192">San Martin</option>
											<option value="193">Sao Tome and Principe</option>
											<option value="194">Saudi Arabia</option>
											<option value="195">Senegal</option>
											<option value="196">Serbia</option>
											<option value="197">Seychelles</option>
											<option value="198">Sierra Leone</option>
											<option value="199">Singapore</option>
											<option value="200">Sint Maarten</option>
											<option value="201">Slovakia</option>
											<option value="202">Slovenia</option>
											<option value="203">Somalia</option>
											<option value="204">South Africa</option>
											<option value="205">South Georgia and the South Sandwich Islands</option>
											<option value="206">South of Sudan</option>
											<option value="207">Spain</option>
											<option value="208">Sri Lanka</option>
											<option value="209">Sudan</option>
											<option value="210">Suriname</option>
											<option value="211">Svalbard and Jan Mayen</option>
											<option value="212">Swaziland</option>
											<option value="213">Sweden</option>
											<option value="214">Switzerland</option>
											<option value="215">Syria</option>
											<option value="216">Taiwan</option>
											<option value="217">Tajikistan</option>
											<option value="218">Tanzania</option>
											<option value="219">Thailand</option>
											<option value="220">Timor-Leste</option>
											<option value="221">Togo</option>
											<option value="222">Tokelau</option>
											<option value="223">Tonga</option>
											<option value="224">Trinidad and Tobago</option>
											<option value="225">Tunisia</option>
											<option value="226">Turkey</option>
											<option value="227">Turkmenistan</option>
											<option value="228">Tuvalu</option>
											<option value="229">Uganda</option>
											<option value="230">Ukraine</option>
											<option value="231">United Arab Emirates</option>
											<option value="232">United Kingdom</option>
											<option value="233">United States</option>
											<option value="234">United States Minor Outlying Islands</option>
											<option value="235">Uruguay</option>
											<option value="236">Uzbekistan</option>
											<option value="237">Vanuatu</option>
											<option value="238">Vaticano</option>
											<option value="239">Venezuela</option>
											<option value="240">Vietnam</option>
											<option value="241">Virgin Islands of the United Kingdom</option>
											<option value="242">Virgin Islands of the United States</option>
											<option value="243">Wallis and Futuna</option>
											<option value="244">Western Sahara</option>
											<option value="245">Yemen</option>
											<option value="246">Yibuti</option>
											<option value="247">Zambia</option>
											<option value="248">Zimbabwe</option>
										</select>
				                        
				                        <br />
								</div>

								<div class="col-md-6">
									<label for="zipcode"><strong>Zip Code</strong></label>
									<?php echo form_error('zipcode'); ?>
									<br /><input id="zipcode" style="width:100%" class="form-control" type="number" name="zipcode" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['zipcode']); ?>" />
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
									<div class="col-md-6">
										<br />							
										<label for="phone"><strong>Phone/Mobile Number</strong> <span class="required">*</span></label>
										<?php echo form_error('phone'); ?>
										<br /><input id="phone" placeholder="landline or mobile" style="width:100%" class="form-control" required type="number" name="phone" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['phone']); ?>" />				
									</div>

									<div class="col-md-6">
										<br />
										<label for="email"><strong>Email</strong> <span class="required">*</span></label>
										<?php echo form_error('email'); ?>
										<br /><input id="email" style="width:100%" class="form-control" required type="email" name="email" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['email']); ?>" />
									</div>
							</div>
						</div>	
						
						<div class="row">
							<div class="col-md-12">
									<div class="col-md-4">
										<br />
										<label for="fax"><strong>Fax</strong></label>
										<?php echo form_error('fax'); ?>
										<br /><input id="fax" style="width:100%" class="form-control" type="number" name="fax" maxlength="30" size="40" value="<?php echo ucwords($empInfo['empDetails']['fax']); ?>" />												
									</div>

									<div class="col-md-4">
										<br />
										<label for="business_regno"><strong>Business Registration #</strong></label>
										<?php echo form_error('business_regno'); ?>
										<br /><input id="business_regno" style="width:100%" class="form-control" type="number" name="business_regno" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['business_regno']); ?>" />
										
									</div>

									<div class="col-md-4">
										<br />
										<label for="organization"><strong>Organization</strong></label>
										<?php echo form_error('organization'); ?>
										<br /><input id="organization" style="width:100%" class="form-control" type="text" name="organization" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['organization']); ?>" />

									</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
									<div class="col-md-4">
										<br />	
										<label for="comp_size"><strong>Company Size</strong><span class="required">*</span></label>
										<?php echo form_error('comp_size'); ?>
										<br />
										<select style="width:100%" class="chosen-select-deselect form-control" required name="comp_size">
			                                <option value="1" <?= $this->session->userdata('employerProfile')['comp_size']=='1' ? 'selected' : ''; ?>>1-10 employees</option>
			                                <option value="2" <?= $this->session->userdata('employerProfile')['comp_size']=='2' ? 'selected' : ''; ?>>1-20 employees</option>
			                                <option value="3" <?= $this->session->userdata('employerProfile')['comp_size']=='3' ? 'selected' : ''; ?>>1-30 employees</option>
			                                <option value="4" <?= $this->session->userdata('employerProfile')['comp_size']=='4' ? 'selected' : ''; ?>>1-50 employees</option>				                        
			                                <option value="5" <?= $this->session->userdata('employerProfile')['comp_size']=='5' ? 'selected' : ''; ?>>50-100 employees</option>
			                                <option value="6" <?= $this->session->userdata('employerProfile')['comp_size']=='6' ? 'selected' : ''; ?>>100-200 employees</option>
			                                <option value="7" <?= $this->session->userdata('employerProfile')['comp_size']=='7' ? 'selected' : ''; ?>>200-500 employees</option>
			                                <option value="8" <?= $this->session->userdata('employerProfile')['comp_size']=='8' ? 'selected' : ''; ?>>500-1000 employees</option>
				                       	</select>				
									</div>

									<div class="col-md-4">
										<br />	
										<label for="dress_code"><strong>Dress Code</strong><span class="required">*</span></label>
										<?php echo form_error('dress_code'); ?>
										<br />
										<select style="width:100%" class="chosen-select-deselect form-control" required name="dress_code">
			                                <option value="1" <?= $this->session->userdata('employerProfile')['dress_code']=='1' ? 'selected' : ''; ?> >Formal Business Attire</option>
			                                <option value="2" <?= $this->session->userdata('employerProfile')['dress_code']=='2' ? 'selected' : ''; ?> >Casual Attire</option>
			                                <option value="3" <?= $this->session->userdata('employerProfile')['dress_code']=='3' ? 'selected' : ''; ?> >Formal Business Attire (M-TH) Casual (F)</option>				                        
				                       	</select>
									</div>

									<div class="col-md-4">
										<br />	
										<label for="working_hrs"><strong>Working Hrs</strong></label>
										<?php echo form_error('working_hrs'); ?>
										<br />
										<select style="width:100%" class="chosen-select-deselect form-control" required name="working_hrs">
			                                <option value="1" <?= $this->session->userdata('employerProfile')['working_hrs']=='1' ? 'selected' : ''; ?>>5 days a week day shift</option>
			                                <option value="2" <?= $this->session->userdata('employerProfile')['working_hrs']=='2' ? 'selected' : ''; ?>>5 days a week night shift</option>
			                                <option value="3" <?= $this->session->userdata('employerProfile')['working_hrs']=='3' ? 'selected' : ''; ?>>6 days a week day shift</option>
			                                <option value="4" <?= $this->session->userdata('employerProfile')['working_hrs']=='4' ? 'selected' : ''; ?>>6 days a week night shift</option>
			                                <option value="5" <?= $this->session->userdata('employerProfile')['working_hrs']=='5' ? 'selected' : ''; ?>>5 days a week shifting schedule</option>				                        
			                                <option value="6" <?= $this->session->userdata('employerProfile')['working_hrs']=='6' ? 'selected' : ''; ?>>6 days a week shifting schedule</option>
				                       	</select>
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
										<select style="width:100%" class="chosen-select-deselect form-control" required name="spoken_lang" value='<?= $empInfo['empDetails']['spoken_lang']; ?>'>
			                                <option value="1" <?= $this->session->userdata('employerProfile')['spoken_lang']=='1' ? 'selected' : ''; ?>>English</option>
			                                <option value="2" <?= $this->session->userdata('employerProfile')['spoken_lang']=='2' ? 'selected' : ''; ?>>Tagalog</option>
			                                <option value="3" <?= $this->session->userdata('employerProfile')['spoken_lang']=='3' ? 'selected' : ''; ?>>Taglish</option>				                        
			                                <option value="4" <?= $this->session->userdata('employerProfile')['spoken_lang']=='4' ? 'selected' : ''; ?>>Chinese</option>
			                                <option value="5" <?= $this->session->userdata('employerProfile')['spoken_lang']=='5' ? 'selected' : ''; ?>>Japanese</option>
			                                <option value="6" <?= $this->session->userdata('employerProfile')['spoken_lang']=='6' ? 'selected' : ''; ?>>English & Tagalog</option>
			                                <option value="7" <?= $this->session->userdata('employerProfile')['spoken_lang']=='7' ? 'selected' : ''; ?>>English & Chinese</option>
			                                <option value="8" <?= $this->session->userdata('employerProfile')['spoken_lang']=='8' ? 'selected' : ''; ?>>English & Japanese</option>
			                                <option value="9" <?= $this->session->userdata('employerProfile')['spoken_lang']=='9' ? 'selected' : ''; ?>>Multilingual</option>
				                       	</select>
									</div>

									<div class="col-md-8">
										<br />
										<label for="website"><strong>Website</strong></label>
										<?php echo form_error('website'); ?>
										<br /><input id="website" style="width:100%" placeholder='Ex: www.jobkonek.com' class="form-control" type="text" name="website" maxlength="30" value="<?php echo $empInfo['empDetails']['website']; ?>" />
									</div>							
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">						
									<div class="col-md-4">
										<br />
										<label for="contact_person"><strong>Contact Person</strong><span class="required">*</span></label>
										<?php echo form_error('contact_person'); ?>
										<br /><input id="contact_person" style="width:100%" class="form-control" required type="text" name="contact_person" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['contact_person']); ?>" />				
										<br />
									</div>

									<div class="col-md-8">
										<br />
										<label for="contact_person_mobilenum"><strong>Contact Person Number</strong><span class="required">*</span></label>
										<?php echo form_error('contact_person_mobilenum'); ?>
										<br /><input id="contact_person_mobilenum" placeholder='landline or cellphone' style="width:100%" class="form-control" required type="number" name="contact_person_mobilenum" maxlength="30" value="<?php echo ucwords($empInfo['empDetails']['contact_person_mobilenum']); ?>" />
										<br />
									</div>									
							</div>												
						</div>
				</div>				
		</div>
		<div class="row">
			<div class="col-md-12">	
				<div class="col-md-2"></div>
				<div class="col-md-4">
					<a href="<?= BASEURL . 'employers/employerUpload'?>" class="btn btn-block btn-md btn-danger" >Skip >></a>
					<br/>
				</div>
                <div class="col-md-4">
					<input type="submit" value="Next" class="btn btn-block btn-md btn-info" />
					<br/>
				</div>	
				<div class="col-md-2"></div>		
			</div>
		</div>
	</div>
	</form>
	<div class="col-lg-2"></div>
</div> <!-- main -->