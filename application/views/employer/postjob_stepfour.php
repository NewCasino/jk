<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			Step 1 - Job Summary / Step 2 - Job Details / Step 3 - Preview / <b>Step 4 - Finalized</b>
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<?php if($jobPaymentDetails[0]['status']!=1){ ?>
<div class="row">
	<div class="col-lg-2"></div>
		<div class="col-lg-8">
			<div class="panel panel-default" style="overflow: auto">
			    	<div class="panel-heading">
			            <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-list"></span> Payment Details</h4>
			            <div class="pull-right">
		            		<a href="#main" style="color: white;" id="button_list_toggle4" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up4"></i></a>
		            	</div>
			            <div class="clearfix"></div>
			        </div>
			        <div class="panel-body" id="list_panel_body4">
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
													foreach ($jobPaymentDetails as $key ) { ?>
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
												<td><b>Total <?= $totalAmountDue ?>.00 PHP</b><br/> Tax included.
												</td>
											</tr>
			                            </table>
			                            <hr/>

			                            <p>Dear Customer,</p>			                            
			                    		
			                            <br/>
			                            <p>Please pay the total amount of <strong><?= $totalAmountDue ?>.00 PHP</strong> to process promo request immediately.<br/>Thank you!</p>
			                            <br/>
			                            <p>Job Title: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?= strtoupper($jobPreview['jobDetails']['job_title']) ?></strong></p>
			                    		<p>Job Order ID: &nbsp;&nbsp;&nbsp;&nbsp;<strong><?= $jobPreview['jobDetails']['joborderid'] ?></strong></p>
			                    		<p>Ordered on: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><?= $jobPreview['jobDetails']['created_on'] ?></strong></p>
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
		            		<a href="#main" style="color: white;" id="button_list_toggle5" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up5"></i></a>
		            	</div>
			            <div class="clearfix"></div>
			        </div>
			        <div class="panel-body" id="list_panel_body5">
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
						<h2>Great! Your Job post has been sent for review!</h2>					
					</center>
				</div>
				
				<div class="col-md-12">
						<hr/>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
						
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<a href="javascript:void(0);" onclick="window.open('<?= BASEURL . 'employers/jobPreview/'.$jobId?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" class="btn btn-block btn-md btn-info" >Preview</a>
						</div>
						<div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
							<a href="<?= BASEURL . 'employers/home'?>" class="btn btn-block btn-md btn-success" >Finish</a>
						</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2"></div>
						<br /><br />
				</div>					
			</form>
		</div>
	</div>
	<div class="col-lg-2"></div>
</div> <!-- main -->