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