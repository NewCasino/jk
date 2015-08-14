<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			Step 1 - Job Summary / Step 2 - Job Details / Step 3 - Preview / <b>Step 4 - Finalized</b>
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>

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