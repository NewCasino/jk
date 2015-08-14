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