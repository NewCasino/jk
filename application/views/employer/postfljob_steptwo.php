<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			Step 1 - Project Summary / <b>Step 2 - Project Review</b> / Step 3 - Finalized
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<form method="post" action="<?= BASEURL . 'employers/availFreelancePromo'?>" autocomplete="off" role="form" class="form-inline" name="form">
	<div class="row">
		<div class="col-lg-2"></div>
	    <div class="col-lg-8">
	        <div class="panel panel-default" style="overflow: auto">
	        	<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-list-alt"></span> PROJECT REVIEW</h4>
	                <a href="<?= BASEURL . 'employers/postFreelanceJob/5/'.$fljobPreview['freelanceJobDetails']['fljobId'] ?>">
	                	<span class='pull-right btn btn-sm btn-info glyphicon glyphicon-edit' data-toggle="tooltip" title="Edit Project" data-placement="top"></span>
	                </a>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body">
	            <table class="table table-striped table-hover">
	            	<tr>
	            		<td style="padding-right:10px; width:25%;"><label for="project_name">Project Name</label></td>
	            		<td><?= strtoupper($fljobPreview['freelanceJobDetails']['project_name']); ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="project_overview">Project Overview</label></td>
	            		<td style="padding-right:10px; maxWidth:80%;"><?= $fljobPreview['freelanceJobDetails']['project_overview']; ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="project_type">Project Type</label></td>
	            		<td><?= strtoupper($fljobPreview['freelanceJobDetails']['project_type']); ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="skills_required">Skills Required</label></td>
	            		<td>
	            			
	            			<?php 
	            				//var_dump(count($fljobPreview['freelanceJobDetails']['skills_req']));
	            				if(count($fljobPreview['freelanceJobDetails']['skills_req']) > 1){  ?>
	            					<ul>
	            					<?php	
			            				foreach ($fljobPreview['freelanceJobDetails']['skills_req'] as $key) {
			            					echo '<li>'.$key['skills'].'</li>';
			            				}
		            				?>
		            				</ul>
	            				<?php
		            				}else{
		            					echo $fljobPreview['freelanceJobDetails']['skills_req'][0]['skills'];
		            				}
	            			?>
	            			
	            		</td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="project_budget">Budget</label></td>
	            		<td><?= $fljobPreview['freelanceJobDetails']['payment_currency'].' '.$fljobPreview['freelanceJobDetails']['min_budget'].' - '.$fljobPreview['freelanceJobDetails']['max_budget'].' '.$fljobPreview['freelanceJobDetails']['payment_type']; ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="project_budget">Project Duration</label></td>
	            		<td><?= $fljobPreview['freelanceJobDetails']['project_duration'] ?></td>
	            	</tr>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="project_budget">Required Hrs </label></td>
	            		<td><?= $fljobPreview['freelanceJobDetails']['hrs_work'].' hrs. per '.$fljobPreview['freelanceJobDetails']['project_duration_per'] ?></td>
	            	</tr>
	            	<?php if($fljobPreview['freelanceJobDetails']['freelanceJobDoc']){ ?>
	            	<tr>
	            		<td style="padding-right:10px;"><label for="project_budget">Downloadable Specs </label></td>
	            		<td>
	            			<a href="<?= BASEURL . 'members/downloadDocs/'. rawurlencode($fljobPreview['freelanceJobDetails']['freelanceJobDoc']['mediaName']) ?>" data-toggle="tooltip" title="<?= lang('ban.download'); ?>"><i class="glyphicon glyphicon-download-alt"></i>Download Specification</a>
	            		</td>
	            	</tr>
                    <?php } ?>
	            </table>
	            </div>        
			</div>
			<?php if(!$isfljobAvailedPromo){ ?>
		        <div class="panel panel-default" style="overflow: auto">
			        	<div class="panel-heading">
			                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> AVAIL OUR PROMO! (optional)</h4>
			                <div class="pull-right">
			            		<a href="#main" style="color: white;" id="button_list_toggle3" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up3"></i></a>
			            	</div>
			                <div class="clearfix"></div>
			            </div>
			            <div class="panel-body" id="list_panel_body3">
				            <div class="row">
		                        <div class="col-md-12">    
			                        <div class="col-md-12">
											<table class="table">
				                                <tr>
				                                  <td>
				                                  	<input type="hidden" name="fljobId" value="<?= $fljobPreview['freelanceJobDetails']['fljobId'] ?>">
				                                    <input type="checkbox" id="flPromo1" onclick="checkAvailFL()" name="flPromo[]" value="1" class="" <?php echo set_checkbox('benefits', 'enter_value_here'); ?>>                                        
				                                                          
				                                  </td>
				                                  <td><label for="jkpromo">JK Agent</label>  
				                                  </td>
				                                  <td>
				                                    We will help you find the best candidates for your project.
				                                  </td>
				                                  <td>
				                                    PHP 1,100.00 only
				                                  </td>
				                                </tr>
				                                
				                                <tr>
				                                  <td>
				                                    <input type="checkbox" id="flPromo2" onclick="checkAvailFL()" name="flPromo[]" value="2" class="" <?php echo set_checkbox('benefits', 'enter_value_here'); ?>>                                        
				                                                          
				                                  </td>
				                                  <td><label for="jkpromo">JK Featured</label>  
				                                  </td>
				                                  <td>
				                                    This will add to our featured section and will attract more bidders.
				                                  </td>
				                                  <td>
				                                    PHP 300.00 only
				                                  </td>
				                                </tr>

				                                <tr>
				                                  <td>
				                                    <input type="checkbox" id="flPromo3" onclick="checkAvailFL()" name="flPromo[]" value="3" class="" <?php echo set_checkbox('benefits', 'enter_value_here'); ?>>                                        
				                                                          
				                                  </td>
				                                  <td><label for="jkpromo">JK Urgent</label>  
				                                  </td>
				                                  <td>
				                                    This will add to our urgent section and will attract more bidders.
				                                  </td>
				                                  <td>
				                                    PHP 300.00 only
				                                  </td>
				                                </tr>

				                                <tr>
				                                  <td>
				                                    <input type="checkbox" id="flPromo4" onclick="checkAvailFL()" name="flPromo[]" value="4" class="" <?php echo set_checkbox('benefits', 'enter_value_here'); ?>>                                        
				                                                          
				                                  </td>
				                                  <td><label for="jkpromo">JK Locked</label>  
				                                  </td>
				                                  <td>
				                                    Make bidders bid invisible to other bidders.
				                                  </td>
				                                  <td>
				                                    PHP 300.00 only
				                                  </td>
				                                </tr>

				                                <tr>
				                                  <td>
				                                    <input type="checkbox" id="flPromo5" onclick="checkAvailFL()" name="flPromo[]" value="5" class="" <?php echo set_checkbox('benefits', 'enter_value_here'); ?>>                                        
				                                                          
				                                  </td>
				                                  <td><label for="jkpromo">JK VIP 1</label>  
				                                  </td>
				                                  <td>
				                                    This will make your project secured with confidentiality and only choosen bidders can only see the project details.
				                                  </td>
				                                  <td>
				                                    PHP 700.00 only
				                                  </td>
				                                </tr>

				                                <tr>
				                                  <td>
				                                    <input type="checkbox" id="flPromo6" onclick="checkAvailFL()" name="flPromo[]" value="6" class="" <?php echo set_checkbox('benefits', 'enter_value_here'); ?>>                                        
				                                                          
				                                  </td>
				                                  <td><label for="jkpromo">JK VIP 2</label>  
				                                  </td>
				                                  <td>
				                                    This project must be signed with a Non-disclosure Aggrement to work on your project.
				                                  </td>
				                                  <td>
				                                    PHP 700.00 only
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
		<?php if(!$isfljobAvailedPromo){ ?>
	        <div class="col-md-3">
	                <a id='notFLAvailBtn' href="<?= BASEURL . 'employers/postFreelanceJob/4/'.$fljobPreview['freelanceJobDetails']['fljobId'] ?>" class="btn btn-block btn-md btn-danger" >I will not avail the promo, continue..</a>
	                <br />
	        </div>
	        <div class="col-md-3">
	                <input type="submit" value="I will avail the promo" class="btn btn-block btn-md btn-primary" />
	                <br />
	        </div>
        <?php }else{ ?>
        	<div class="col-md-6">
	                <a href="<?= BASEURL . 'employers/postFreelanceJob/4/'.$fljobPreview['freelanceJobDetails']['fljobId'] ?>" class="btn btn-block btn-md btn-primary" >Next</a>
	                <br />
	        </div>
	    <?php } ?>
        <div class="col-md-4"></div>
	</div>
</form>

