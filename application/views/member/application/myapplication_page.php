<style type="text/css">
	.resume_pic {
        border-radius: 50%;
        overflow: hidden;
        width: 150px;
        height: 150px;
        border:2px solid #fff;
    }
    .resume_pic img {
        display: block;
    	min-width: 100%;
    	min-height: 100%;
    }
    .record_sec{
    	background-color: #ddd;
    	border-radius: 25px;
    	margin-bottom: 25px;
    	padding: 15px;
    }
    .record_sec_we{
    	background-color: #eee;
    	border-radius: 25px;
    	margin-bottom: 25px;
    	padding: 15px;
    }

    .sidebar_sec{
    	background-color: #ddd;
    	border-radius: 25px;
    	margin-bottom: 25px;
    	padding: 15px;
    }
    .sidebar_links li{
    	list-style: none;
    	padding: 5px;
    }
    .sidebar_links li a{
    	color: #333;
    	font-size: 15px;
    	font-family: arial;
    }
    .resume_sm {
        border-radius: 50%;
        /*overflow: hidden;*/
        float: left;
        width: 27px;
        height: 27px;
        border:2px solid #fff;
        background-color: #ccc;
        padding-top: 2px;
        margin-right: 3px;
    }
    .resume_sm a{
    	color: #333;
    }
    .resume_sm a:link{
    	text-decoration: none;
    }
</style>
<div class='col-md-3'>
	<div class='col-md-12 sidebar_sec'>
			<ul class='sidebar_links'>
				<li><span class="icon-profile">&nbsp;</span><a href="<?=BASEURL . '/myresume'?>">Resume</a></li>
				<li><span class="icon-file-text">&nbsp;<a href="<?=BASEURL . '/myapplication'?>">Application</a></li>
				<li><span class="icon-folder">&nbsp;<a href="<?=BASEURL . '/mysavedjobs'?>">Saved Jobs</a></li>
				<li><span class="icon-cogs">&nbsp;<a href="<?=BASEURL . '/mysettings'?>">Settings</a></li>
			</ul>

	</div>
</div>
<div class='col-md-9'>
	<div class='col-md-12 record_sec'>
		<div class='col-md-12' style='text-align:center;font-weight:bold; font-size:15px;'>
			<label style='font-size:18px;'>My Application</label>
		</div>
		<?php
if (!empty($fulltimeApplication)) {
	foreach ($fulltimeApplication as $key) {?>
						<div class='col-md-12 record_sec_we'>
							<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
								<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i>Delete</a>
								<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-edit"></i>Edit</a>
							</div>
							<div class='col-md-6'>
								<span style='font-size:20px;font-weight:.5;'>
									<?=ucwords($key['job_title'])?>
								</span>
								<br/>
								<span style='font-size:16px;'>
									<?=ucwords($key['company_name'])?>
								</span>
								<br/>
								<span style='font-size:12px;'>
									<span class="icon-share"></span>
									<?=ucwords($key['location_city'] . ' - ' . $key['location_region'])?>
								</span>
							</div>

						</div>
					<?php }
} else {
	echo "No Record";
}
?>
	</div>
</div>