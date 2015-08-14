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