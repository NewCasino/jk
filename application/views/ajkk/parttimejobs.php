<div class="row">
	<div class="col-lg-3 hidden-xs hidden-sm hidden-md">
		<div class="panel panel-og">
			<div class="panel-heading">ADS</div>
			<img class="img-responsive" src="<?= IMAGEPATH.'contactus/customer-support.jpg' ?>" style="width: 100%"/>
		</div>
	</div>

	<div class="col-lg-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<form action="<?= BASEURL. 'ajkk/searchParttimeJob' ?>" method="post">
					<div class="row">
							<div class="col-md-12">
								<div class="col-md-4">
									<label for='projectType'>Search</label>
									<input type="hidden" name="location" value="" />
									<input type="text" name="search" class="form-control input-sm" placeholder='job,skills,company,etc..' value="<?= $this->session->userdata('searchfulltimejobs')['search'] ?>">
								</div>
								<div class="col-md-3">
									<label for='projectType'>Location</label>
		                            <select class="form-control input-sm" style="width:100%" data-placeholder="Location" class="chosen-select-deselect form-control" name="location_region">
			                                <option value="">--Select All--</option>
			                                <optgroup label="Local">
			                                  <option value="1" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '1' ? 'selected' : '' ?>>ARMM</option>
			                                  <option value="2" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '2' ? 'selected' : '' ?>>Bicol Region</option>
			                                  <option value="3" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '3' ? 'selected' : '' ?>>C.A.R</option>
			                                  <option value="4" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '4' ? 'selected' : '' ?>>Cagayan Valley</option>
			                                  <option value="5" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '5' ? 'selected' : '' ?>>Calabarzon</option>
			                                  <option value="6" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '6' ? 'selected' : '' ?>>Caraga</option>
			                                  <option value="7" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '7' ? 'selected' : '' ?>>Central Luzon</option>
			                                  <option value="32" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '32' ? 'selected' : '' ?>>Central Mindanao</option>
			                                  <option value="8" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '8' ? 'selected' : '' ?>>Central Visayas</option>                                     
			                                  <option value="9" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '9' ? 'selected' : '' ?>>Eastern Visayas</option>
			                                  <option value="10" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '10' ? 'selected' : '' ?>>Ilocos Region</option>
			                                  <option value="11" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '11' ? 'selected' : '' ?>>N.C.R</option>
			                                  <option value="12" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '12' ? 'selected' : '' ?>>Nothern Mindanao</option>                          
			                                  <option value="13" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '13' ? 'selected' : '' ?>>Southern Mindanao</option>
			                                  <option value="14" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '14' ? 'selected' : '' ?>>Southern Tagalog</option>
			                                  <option value="15" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '15' ? 'selected' : '' ?>>Western Mindanao</option>
			                                  <option value="16" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '16' ? 'selected' : '' ?>>Western Visayas</option>                                                                               
			                                </optgroup>
			        
			                                <optgroup label="Abroad (Asia)">
			                                  <option value="17" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '17' ? 'selected' : '' ?>>China</option>
			                                  <option value="18" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '18' ? 'selected' : '' ?>>Hongkong</option>
			                                  <option value="19" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '19' ? 'selected' : '' ?>>India</option>
			                                  <option value="20" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '20' ? 'selected' : '' ?>>Indonesia</option>
			                                  <option value="21" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '21' ? 'selected' : '' ?>>Japan</option>
			                                  <option value="21" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '22' ? 'selected' : '' ?>>Malaysia</option>
			                                  <option value="23" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '23' ? 'selected' : '' ?>>Singapore</option>
			                                  <option value="24" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '24' ? 'selected' : '' ?>>Thailand</option>
			                                  <option value="25" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '25' ? 'selected' : '' ?>>Vietnam</option>
			                                </optgroup>
			        
			                                <optgroup label="Abroad (Other)">
			                                  <option value="26" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '26' ? 'selected' : '' ?>>Africa</option>
			                                  <option value="27" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '27' ? 'selected' : '' ?>>Middle East</option>
			                                  <option value="28" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '28' ? 'selected' : '' ?>>Australia & New Zealand</option>
			                                  <option value="29" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '29' ? 'selected' : '' ?>>Europe</option>
			                                  <option value="30" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '30' ? 'selected' : '' ?>>North America</option>
			                                  <option value="31" <?= $this->session->userdata('searchfulltimejobs')['location_region'] == '31' ? 'selected' : '' ?>>South America</option>                                  
			                                </optgroup>                                           
			                        </select>
								</div>
								<div class="col-md-3">
									<label for='budget_range'>Budget Range</label>
									<select name="budget_range" class="form-control input-sm" style="width:100%">
										  <option value="" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == '' ? 'selected' : '' ?>>--Select All--</option>
		                                  <option value="1" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == 1 ? 'selected' : '' ?>>1-10,000</option>
		                                  <option value="2" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == 2 ? 'selected' : '' ?>>10,000-50,000</option>
		                                  <option value="3" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == 3 ? 'selected' : '' ?>>50,000-100,000</option>
		                                  <option value="4" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == 4 ? 'selected' : '' ?>>100,000-150,000</option>
		                                  <option value="5" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == 5 ? 'selected' : '' ?>>150,000-200,000</option>
		                                  <option value="6" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == 6 ? 'selected' : '' ?>>200,000-300,000</option>
		                                  <option value="7" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == 7 ? 'selected' : '' ?>>300,000-400,000</option>
		                                  <option value="8" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == 8 ? 'selected' : '' ?>>400,000-500,000</option>
		                                  <option value="9" <?= $this->session->userdata('searchfulltimejobs')['budget_range'] == 9 ? 'selected' : '' ?>>500,000-1M</option>
		                                </select>
								</div>
								<div class="col-md-2">
										<br/>
										<input type="submit" value="Search" class="btn btn-sm btn-block btn-primary">
								</div>
							</div>						
					</div>
					<!-- <div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
							<br/>
								<a href="">[Show Advanced Search]</a>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-4">
							</div>
						</div>
					</div> -->
				</form>
			</div>

		</div>
		<div class="panel panel-og">
			<div class="panel-heading">PART TIME JOBS</div>
			<div class="panel-body">
					<div class="row">
						<div class="col-md-12 position">
							<input type="hidden" id="count_post" value="<?=$count_post;?>" />
							<?php //var_dump($fulltimejobs);
								if(!empty($parttimejobs)){
									foreach ($parttimejobs as $key) { ?>
							<div class="col-md-12" id="search_item_holder">
								
								<div class="col-md-9" >
									<span style='font-size:18px; font-weight:bold; color:#5656bf'>
										<a href="javascript:void(0);" onclick="window.open('<?= BASEURL . 'ajkk/jobDetails/'.$key['jobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" ><?= strtoupper($key['job_title']).' ('.ucwords($key['location_region']).'-'.ucwords($key['location_city']).')'; ?></a>
									</span>
									<p style='font-size:12px; font-weight:bold; color:#333'>
										Specialization: <?= $key['specialization']; ?>
									</p>
									<p>
										<?php 
												 if(strlen($key['job_desc']) > 30)
												{
													echo $string = trim(substr($key['job_desc'], 0, 200))."...";
												}else{
													echo $key['job_desc'];	
												}
										?>		
									</p>
								</div>

								<div class="col-md-3" style="border-left:1px solid #ddd;">
									<table style="margin-bottom:5px; margin-top:10px;">
										<tr>
											<td>
												<i class="icon-price-tag" data-toggle="tooltip" data-placement="left" title='Salary'></i>&nbsp;
											</td>
											<td>
												<span style='font-size:13px;'>
												<?= '<b>'.$key['salary_min'].' - '
													.$key['salary_max'].' '
													.$key['currency'].'</b> '
													.$key['salary_type']; ?>
												</span>
											</td>
										</tr>
										<tr>
											<td>
												<i class="icon-alarm" data-toggle="tooltip" data-placement="left" title='Recruitment Duration'></i>
											</td>
											<td>
												<span style='font-size:11px;'>
												<?= $key['date_posted'].' - '.$key['date_expiry']; ?>
												</span>
											</td>
										</tr>
										<tr>
											<td>
												<i class="icon-stopwatch" data-toggle="tooltip" data-placement="left" title='Schedule Type'></i>
											</td>
											<td>
												<span style='font-size:11px;'>
													<?= $key['sked_type'] ?>
												</span>
											</td>
										</tr>
										<tr>
											<td>
												<i class="icon-office" data-toggle="tooltip" data-placement="left" title='Company Name'></i>
											</td>
											<td>
												<span style='font-size:11px;'>
												<?= ucwords($key['company_name']); ?>
									 			</span>
											</td>
										</tr>
									</table>
									<?php if($this->session->userdata('usertype') != 'employer'){
                    							if($this->session->userdata('usertype') == 'member'){ ?>
													<table>
														<tr>
															<td>
																<a href="javascript:void(0);" onclick="window.open('<?= BASEURL . 'ajkk/jobDetails/'.$key['jobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" class="btn btn-xs btn-info"><i class="icon-ticket"></i>Apply</a>&nbsp;
															</td>
															<td>
																<a href="<?= BASEURL . 'members/saveJob/'.$key['jobId'] ?>" class="btn btn-xs btn-success"><i class="icon-drive"></i>&nbsp;Save</a>
															</td>
														</tr>
													</table>
										<?php }else{ ?>
													<table>
														<tr>
															<td>
																<a href="<?= BASEURL . 'auth/login/member' ?>" class="btn btn-xs btn-info"><i class="icon-ticket"></i>Apply</a>&nbsp;
															</td>
															<td>
																<a href="<?= BASEURL . 'auth/login/member' ?>" class="btn btn-xs btn-success"><i class="icon-drive"></i>&nbsp;Save</a>
															</td>
														</tr>
													</table>
										<?php }
            								} ?>
								</div>
							</div>
							<?php }
							} ?>
							
						</div>
						<?php if(!empty($parttimejobs)){ ?>
						<div class="col-md-4" ></div>						
						<div class="showmore col-md-4">
							<br/>
							<button class="btn btn-sm btn-warning btn-block" id="parttimejobbtn">
								<img src="<?= AJKKIMGPATH . 'loader.gif'; ?>" width='15' height='15' class="parttimejobsloader">
								SHOW MORE&nbsp;&nbsp;
								<span class="glyphicon glyphicon-chevron-down"></span>
							</button>
							<br/>
						</div>
						<div class="col-md-4" ></div>
						<?php } ?>
					</div>
			</div>
				<p><?= lang('cashier.2'); ?></p>
				<p><?= lang('cashier.3'); ?></p>
		</div>
	
	</div>
</div>
<script type="text/javascript" src="<?= JSPATH ?>home/ajkk.js"></script>