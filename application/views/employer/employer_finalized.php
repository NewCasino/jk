<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			Step 1 - <a href="<?= BASEURL . 'employers/employerProfile'?>" >Employer Details</a> / Step 2 - <a href="<?= BASEURL . 'employers/employerUpload'?>" >Upload</a> / <b>Step 3 - Finalized</b>
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
						<h2>Great! Your Profile has been updated!</h2>					
					</center>
				</div>
				
				<div class="col-md-12">
						<hr/>
						<div class="col-md-2"></div>
						
						<div class="col-md-4">
							<a href="<?= BASEURL . 'employers/postJob/1'?>" class="btn btn-block btn-md btn-success" >Post Job Now!</a>
						</div>
						<div class="col-md-4">
							<a href="<?= BASEURL . 'employers/home'?>" class="btn btn-block btn-md btn-info" >Finish!</a>
						</div>
						<div class="col-md-2"></div>
						<br /><br />
				</div>					
			</form>
		</div>
	</div>
	<div class="col-lg-2"></div>
</div> <!-- main -->