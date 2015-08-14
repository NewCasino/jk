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
					<div class="row">
						<form action="<?= BASEURL. 'ajkk/searchFreelanceJob' ?>" method="post">
							<div class="col-md-12">
								<div class="col-md-4">
									<label for='projectType'>Search</label>
									<input type="text" name="search" class="form-control input-sm" placeholder='project,skills..' value="<?= $this->session->userdata('searchfreelancejobs')['search'] ?>">
								</div>
								<div class="col-md-3">
									<label for='projectType'>Project Type</label>
									<select name="project_type" class="form-control input-sm" style="width:100%">
										  <option value="" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == '' ? 'selected' : '' ?>>--Select All--</option>
		                                  <option value="1" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 1 ? 'selected' : '' ?>>Website Application</option>
		                                  <option value="2" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 2 ? 'selected' : '' ?>>Mobile Application</option>
		                                  <option value="3" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 3 ? 'selected' : '' ?>>Desktop Application</option>
		                                  <option value="4" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 4 ? 'selected' : '' ?>>Website Design</option>
		                                  <option value="5" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 5 ? 'selected' : '' ?>>Mobile Design</option>
		                                  <option value="6" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 6 ? 'selected' : '' ?>>Desktop Design</option>
		                                  <option value="7" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 7 ? 'selected' : '' ?>>Content Writing</option>
		                                  <option value="8" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 8 ? 'selected' : '' ?>>Graphic Artwork</option>
		                                  <option value="9" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 9 ? 'selected' : '' ?>>Data Entry</option>
		                                  <option value="10" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 10 ? 'selected' : '' ?>>Database</option>
		                                  <option value="11" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 11 ? 'selected' : '' ?>>Sales / Marketing</option>
		                                  <option value="12" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 12 ? 'selected' : '' ?>>Consulting</option>
		                                  <option value="13" <?= $this->session->userdata('searchfreelancejobs')['project_type'] == 13 ? 'selected' : '' ?>>Others</option>
		                                </select>
								</div>
								<div class="col-md-3">
									<label for='budget_range'>Budget Range</label>
									<select name="budget_range" class="form-control input-sm" style="width:100%">
										  <option value="" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == '' ? 'selected' : '' ?>>--Select All--</option>
		                                  <option value="1" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == 1 ? 'selected' : '' ?>>1-10,000</option>
		                                  <option value="2" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == 2 ? 'selected' : '' ?>>10,000-50,000</option>
		                                  <option value="3" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == 3 ? 'selected' : '' ?>>50,000-100,000</option>
		                                  <option value="4" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == 4 ? 'selected' : '' ?>>100,000-150,000</option>
		                                  <option value="5" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == 5 ? 'selected' : '' ?>>150,000-200,000</option>
		                                  <option value="6" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == 6 ? 'selected' : '' ?>>200,000-300,000</option>
		                                  <option value="7" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == 7 ? 'selected' : '' ?>>300,000-400,000</option>
		                                  <option value="8" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == 8 ? 'selected' : '' ?>>400,000-500,000</option>
		                                  <option value="9" <?= $this->session->userdata('searchfreelancejobs')['budget_range'] == 9 ? 'selected' : '' ?>>500,000-1M</option>
		                                </select>
								</div>
								<div class="col-md-2">
									<br/>
									<input type="submit" value="Search Now" class="btn btn-sm btn-block btn-primary">
								</div>
							</div>
						</form>
					</div>
			</div>
		</div>
		<div class="panel panel-og">
			<div class="panel-heading">FREELANCE JOBS</div>
			<div class="panel-body">
					<div class="row">
						<div class="col-md-12 position">
							<input type="hidden" id="count_post" value="<?=$count_post;?>" />
							<?php //var_dump($freelancejobs);
								if(!empty($freelancejobs)){
									foreach ($freelancejobs as $key) { ?>
							<div class="col-md-12" id="search_item_holder">
								
								<div class="col-md-9" style="border-right:1px solid #ddd;">
									<span style='font-size:18px; font-weight:bold; color:#5656bf'>
										<a href="javascript:void(0);" onclick="window.open('<?= BASEURL . 'ajkk/freelancejobDetails/'.$key['fljobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" ><?= strtoupper($key['project_name']); ?></a>
									</span>
									<p style='font-size:12px; font-weight:bold; color:#333'>
										Project Type: <?= $key['project_type']; ?>
									</p>
									<p>
										<?php 
												 if(strlen($key['project_overview']) > 30)
												{
													echo $string = trim(substr($key['project_overview'], 0, 200))."...";
												}else{
													echo $key['project_overview'];	
												}
										?>		
									</p>

									<p>
										<span style='font-size:12px; font-weight:bold;overflow:hidden;'>Skills Required:</span>
										<br/>
										<?php //var_dump(count($key['skills_req']));
											$skillsList='';
											if(!empty($key['skills_req'])){
												if(count($key['skills_req']) > 1){ 
													foreach ($key['skills_req'] as $skills) { 
														//echo $key['skills']; 
														$skillsList .= $skills['skills'].',';
													}
													//echo $key['skills_req'][0]['skills'];
												}else{
													$skillsList = $key['skills_req'][0]['skills'];													
												} 
											}
											echo $skillsList;
										?>		
									</p>
								</div>

								<div class="col-md-3">
									<table style="margin-bottom:5px; margin-top:10px;">
										<tr>
											<td>
												<i class="icon-price-tag" data-toggle="tooltip" data-placement="left" title='Budget'></i>&nbsp;
											</td>
											<td>
												<span style='font-size:13px;'>
												<?= '<b>'.$key['min_budget'].' - '
													.$key['max_budget'].' '
													.$key['payment_currency'].'</b> '
													.$key['payment_type']; ?>
												</span>
											</td>
										</tr>
										<tr>
											<td>
												<i class="icon-alarm" data-toggle="tooltip" data-placement="left" title='Project Duration'></i>
											</td>
											<td>
												<span style='font-size:11px;'>
													<?= $key['project_duration']; ?>
												</span>
											</td>
										</tr>
										<tr>
											<td>
												<i class="icon-clock" data-toggle="tooltip" data-placement="left" title='Required Working Hrs'></i>
											</td>
											<td>
												<span style='font-size:11px;'>
													<?= $key['hrs_work'].' hrs /'.$key['project_duration_per']; ?>
												</span>
											</td>
										</tr>
										<tr>
											<td>
												<i class="icon-calendar" data-toggle="tooltip" data-placement="left" title='Date Posted'></i>
											</td>
											<td>
												<span style='font-size:11px;'>
													<?= $key['created_on']; ?>
												</span>
											</td>
										</tr>
									</table>
									<?php if($this->session->userdata('usertype') != 'employer'){
                    							if($this->session->userdata('usertype') == 'member'){ ?>
													<table>
														<tr>
															<td>
																<a href="javascript:void(0);" onclick="window.open('<?= BASEURL . 'ajkk/freelancejobDetails/'.$key['fljobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" class="btn btn-xs btn-info"><i class="icon-ticket"></i>Apply</a>&nbsp;
															</td>
															<td>
																<a href="<?= BASEURL . 'members/saveFreelanceJob/'.$key['fljobId'] ?>" class="btn btn-xs btn-success"><i class="icon-drive"></i>&nbsp;Save</a>
															</td>
														</tr>
													</table>
										<?php }else{ ?>
													<table>
														<tr>
															<td>
																<a href="<?= BASEURL . 'auth/register/member' ?>" class="btn btn-xs btn-info"><i class="icon-ticket"></i>Apply</a>&nbsp;
															</td>
															<td>
																<a href="<?= BASEURL . 'auth/register/member' ?>" class="btn btn-xs btn-success"><i class="icon-drive"></i>&nbsp;Save</a>
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
						<?php if(!empty($freelancejobs)){ ?>
						<div class="col-md-4" ></div>						
						<div class="showmore col-md-4">
							<br/>
							<button class="btn btn-sm btn-warning btn-block" id="btn">
								<img src="<?= AJKKIMGPATH . 'loader.gif'; ?>" width='15' height='15' class="loader">
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