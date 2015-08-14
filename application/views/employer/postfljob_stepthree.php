<script type="text/javascript">
	 // view_player_list.php MAIN
	 console.log('test');
	 $("#main_panel_body").hide();
    $("#hide_main").click(function() {
    	console.log('test');
        $("#main_panel_body").slideToggle();
        $("#hide_main_up", this).toggleClass("glyphicon glyphicon-chevron-down glyphicon glyphicon-chevron-up");
    });
</script>
<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			Step 1 - Job Summary / Step 2 - Job Details / <b>Step 3 - Finalized</b>
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<?php if($fljobPaymentDetails[0]['status']!=1){ ?>
<div class="row">
	<div class="col-lg-2"></div>
		<div class="col-lg-8">
			<div class="panel panel-default" style="overflow: auto">
			    	<div class="panel-heading">
			            <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-list"></span> Payment Details</h4>
			            <div class="pull-right">
			            		<a href="#main" style="color: white;" id="button_list_toggle1" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up1"></i></a>
			            </div>
			            <div class="clearfix"></div>
			        </div>
			        <div class="panel-body" id="list_panel_body1">
			            <div class="row">
			                <div class="col-md-12">    
			                    <div class="col-md-12">			                    		
										<table class="table">
											<th>Promo
											</th>
											<th>Description
											</th>
											<th>Amount
											</th>
											<?php $totalAmountDue = 0;
													foreach ($fljobPaymentDetails as $key ) { ?>
												<tr>
				                                  <td><?= $key['details'] ?>
				                                  </td>
				                                  <td><?= $key['desc'] ?>
				                                  </td>
				                                  <td><?= $key['amount'] ?>
				                                  </td>
				                                </tr>
											<?php $totalAmountDue += $key['amount'];
													} ?>
											<tr>
												<td>
												</td>
												<td>
												</td>		
												<td><b>Total <?= $totalAmountDue ?>.00 PHP</b> Tax included.
												</td>
											</tr>
			                            </table>
			                            <hr/>

			                            <p>Dear Customer,</p>			                            
			                    		
			                            <br/>
			                            <p>Please pay the total amount of <strong><?= $totalAmountDue ?>.00 PHP</strong> to process promo request immediately.<br/>Thank you!</p>
			                            <br/>
			                            <p>Project Name: &nbsp;&nbsp;&nbsp;&nbsp;<strong><?= strtoupper($fljobPreview['freelanceJobDetails']['project_name']) ?></strong></p>
			                    		<p>Job Order ID: &nbsp;&nbsp;&nbsp;&nbsp;<strong><?= $fljobPreview['freelanceJobDetails']['joborderid'] ?></strong></p>
			                    		<p>Ordered on: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?= $fljobPreview['freelanceJobDetails']['created_on'] ?></strong></p>
			                    		<br/>
			                            <p>For more Inquiries you may contact our customer service.<br/><br/>
			                               Godbless,<br/><strong>Jona</strong>
			                            </p>
			                    </div>
			                </div>
			            </div>
			        </div>
			</div>
		</div>
		<div class="col-lg-2"></div>
</div>
<div class="row">
	<div class="col-lg-2"></div>
		<div class="col-lg-8">
			<div class="panel panel-default" style="overflow: auto">
			    	<div class="panel-heading">
			            <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-list"></span> HOW TO PAY?</h4>
			            <div class="pull-right">
			            		<a href="#main" style="color: white;" id="button_list_toggle2" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up2"></i></a>
			            </div>
			            <div class="clearfix"></div>
			        </div>
			        <div class="panel-body" id="list_panel_body2">
			            <div class="row">
			                <div class="col-md-12">    
			                    <div class="col-md-12">
			                    		<div class="panel panel-default" style="overflow: auto">
									    	<div class="panel-heading">
									            <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-list"></span> Via Local Bank Deposit</h4>
									            <div class="clearfix"></div>
									        </div>
									     	<div class="panel-body">
									     			<table class="table">
														<th>Bank Name
														</th>
														<th>Account Name
														</th>
														<th>Account Number
														</th>
														<tr>
						                                  <td>BDO
						                                  </td>
						                                  <td>Juan Dela Cruz
						                                  </td>
						                                  <td>BDO-12334455656
						                                  </td>
						                                </tr>
						                                <tr>
						                                  <td>BPI
						                                  </td>
						                                  <td>Juan Dela Cruz
						                                  </td>
						                                  <td>BPI-12334455656
						                                  </td>
						                                </tr>
						                                <tr>
						                                  <td>EASTWEST
						                                  </td>
						                                  <td>Juan Dela Cruz
						                                  </td>
						                                  <td>EW-12334455656
						                                  </td>
						                                </tr>
													</table>
													<center><label>2 STEPS</label></center>
													<table class="table">
														<tr>
															<td style="width:70px;"><i>Step 1:</i>
															</td>
															<td>Go to your preferred bank and deposit your total amount due.<br/>		
															</td>
														</tr>
														<tr>
															<td><i>Step 2:</i>
															</td>
															<td>Once deposited, you may call or text our hotline number (123456) to confirm your deposit, or you may upload your deposit slip here and our customer service will immediately verify your deposit.
															</td>
														</tr>
													</table>													
									     	</div>   
									     </div>

									     <div class="panel panel-default" style="overflow: auto">
									    	<div class="panel-heading">
									            <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-list"></span> Via Remittance (Cebuana,Mlhulier,LBC, etc..)</h4>
									            <div class="clearfix"></div>
									        </div>
									     	<div class="panel-body">
									     			<table class="table">
														<th>Receiver Name
														</th>
														<th>Receiver Location
														</th>
														<th>Contact Number
														</th>
						                                <tr>
						                                  <td>Juan Dela Cruz
						                                  </td>
						                                  <td>Makati
						                                  </td>
						                                  <td>123456789
						                                  </td>
						                                </tr>
													</table>
													<center><label>2 STEPS</label></center>
													<table class="table">
														<tr>
															<td style="width:70px;"><i>Step 1:</i>
															</td>
															<td>Go to your preferred remittance establishment and remit the total amount due.<br/>		
															</td>
														</tr>
														<tr>
															<td><i>Step 2:</i>
															</td>
															<td>Once remitted, you may call or text our hotline number (123456) to confirm your remittance and give the remittance details, or you may upload your remittance slip here and our customer service will immediately verify your remittance.
															</td>
														</tr>
													</table>
									     	</div>   
									     </div>

									     <div class="panel panel-default" style="overflow: auto">
									    	<div class="panel-heading">
									            <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-list"></span> Via Smart Padala</h4>
									            <div class="clearfix"></div>
									        </div>
									     	<div class="panel-body">
									     			<table class="table">
														<th>Receiver Name
														</th>
														<th>Receiver Smart #
														</th>
														<th>Contact Number
														</th>
						                                <tr>
						                                  <td>Juan Dela Cruz
						                                  </td>
						                                  <td>Makati
						                                  </td>
						                                  <td>123456789
						                                  </td>
						                                </tr>
													</table>

													<center><label>2 STEPS</label></center>
													<table class="table">
														<tr>
															<td style="width:70px;"><i>Step 1:</i>
															</td>
															<td>Go to your preferred smart padala remittance branch and remit the total amount due.<br/>		
															</td>
														</tr>
														<tr>
															<td><i>Step 2:</i>
															</td>
															<td>Once remitted, you may call or text our hotline number (123456) to confirm your remittance and give the remittance details, or you may upload your remittance slip here and our customer service will immediately verify your remittance.
															</td>
														</tr>
													</table>
									     	</div>   
									     </div>										
			                    </div>
			                </div>
			            </div>
			        </div>
			</div>
		</div>
		<div class="col-lg-2"></div>
</div>
<?php } ?>
<div class="row">
	<div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="well" style="overflow: auto">
			<form method="post" action="<?= BASEURL . 'employers/postNewJob'?>" autocomplete="off" role="form" class="form-inline" name="form">
				<?php //echo $jobId; ?>
										
				<div class="col-md-12">
					<center>
						<h3>Great! Your Freelance Job post has been sent for review!</h3>					
					</center>
				</div>
				
				<div class="col-md-12">
						<hr/>
						<div class="col-md-2"></div>
						
						<div class="col-md-4">
							<a href="javascript:void(0);" onclick="window.open('<?= BASEURL . 'employers/freelancejobPreview/'.$fljobPreview['freelanceJobDetails']['fljobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" class="btn btn-block btn-md btn-info" >Preview</a>
						</div>
						<div class="col-md-4">
							<a href="<?= BASEURL . 'employers/activeFreelanceJob'?>" class="btn btn-block btn-md btn-success" >Finish</a>
						</div>
						<div class="col-md-2"></div>
						<br /><br />
				</div>					
			</form>
		</div>
	</div>
	<div class="col-lg-2"></div>
</div> <!-- main -->