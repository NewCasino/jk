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
		<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
			<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-edit"></i>Edit</a>
		</div>
		<div class='col-md-3'>
			<div class="resume_pic">
				<img src="http://cdn.bavotasan.com/wp-content/uploads/2011/02/desktop.jpg" alt="">
			</div>
			<div class='col-md-12'>
				<br/>
				<center>
					<?php
foreach ($socialMedia as $key) {
	if ($key['social_media_type'] == 'fb') {?>
								<div class="resume_sm"><a href='<?=$key['social_media_link']?>'><span class="icon-facebook2"></span></a></div>
					<?php } elseif ($key['social_media_type'] == 'li') {?>
								<div class="resume_sm"><a href='<?=$key['social_media_link']?>'><span class="icon-linkedin"></span></a></div>
					<?php } elseif ($key['social_media_type'] == 'tw') {?>
								<div class="resume_sm"><a href='<?=$key['social_media_link']?>'><span class="icon-twitter"></span></a></div>
					<?php } elseif ($key['social_media_type'] == 'gp') {?>
								<div class="resume_sm"><a href='<?=$key['social_media_link']?>'><span class="icon-google-plus"></span></a></div>
					<?php }
}
?>
				</center>
			</div>
		</div>
		<div class='col-md-9'>
			<center>
				<label style='font-size:18px;'><?=ucwords($personalInfo['firstName'] . ' ' . $personalInfo['lastName'])?></label>
				<br/>
				<label style='font-size:14px;'>Last Job Position: <?=ucwords(!$workExpi[0]['job_title'] ? 'No Record' : $workExpi[0]['job_title'])?></label>
				<br/>
				<label style='font-size:14px;'>Job Status: <?php
if ($additionalInfo['job_status'] == 1) {
	echo 'Employed/Regular - (but open with other opportunies)';
} elseif ($additionalInfo['job_status'] == 2) {
	echo 'Employed/Regular - (currently not exploring)';
} elseif ($additionalInfo['job_status'] == 3) {
	echo 'Employed/Contractual - (but open with other opportunies)';
} elseif ($additionalInfo['job_status'] == 4) {
	echo 'Employed/Contractual - (currently not exploring)';
} elseif ($additionalInfo['job_status'] == 5) {
	echo 'Freelancer - (currently exploring)';
} elseif ($additionalInfo['job_status'] == 6) {
	echo 'Freelancer - (currently not exploring)';
} elseif ($additionalInfo['job_status'] == 7) {
	echo 'Fresh Graduate - (currently exploring)';
} elseif ($additionalInfo['job_status'] == 8) {
	echo 'Vacant - (currently exploring)';
} elseif ($additionalInfo['job_status'] == 0) {
	echo 'No Record';
}
?><!-- Employed - (Open with other opportunies) --></label>

			</center>
			<!-- currently exploring, open with other opportunities, available to freelance job, all -->
			<br/>
			<div class='col-md-4'>
				<span class="icon-location"></span><label style='font-size:16px;'>Live in</label>
				<p><?=ucwords($personalInfo['address'] . ' ' . $personalInfo['city'] . ' ' . $personalInfo['region'] . ' ' . $personalInfo['country'])?></p>
			</div>
			<div class='col-md-4'>
				<span class="icon-phone"></span><label style='font-size:16px;'>Phone #</label>
				<p><?=$personalInfo['phone'] == '' ? 'No Record' : $personalInfo['phone']?></p>
			</div>
			<div class='col-md-4'>
				<span class="icon-mobile"></span><label style='font-size:16px;'>Mobile #</label>
				<p><?=$personalInfo['contactNumber'] == '' ? 'No Record' : $personalInfo['contactNumber']?></p>
			</div>
		</div>
		<div class='clear-fix'></div>
		<br/><br/>
	</div>
	<div class='col-md-12 record_sec'>
		<div class='col-md-12' style='text-align:center;font-weight:bold; font-size:15px;'>
			<label style='font-size:18px;'>Work Experience</label>
			<!-- <a href="" class="btn btn-xs btn-default pull-center"><i class="glyphicon glyphicon-plus"></i>Add</a> -->
		</div>
		<?php
if (!empty($skills)) {
	foreach ($workExpi as $key) {?>
			<div class='col-md-12 record_sec_we'>
				<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
					<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i>Delete</a>
					<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-edit"></i>Edit</a>
				</div>
				<div class='col-md-6'>
					<table>
						<tr>
							<td><label>Company Name:</label> <?=ucwords($key['company_name'])?></td>
						</tr>
						<tr>
							<td><label>Location:</label> <?=ucwords($key['location'])?></td>
						</tr>
						<tr>
							<td><label>Industry:</label> <?=ucwords($key['industry'])?></td>
						</tr>
					</table>
				</div>
				<div class='col-md-6'>
					<table>
						<tr>
							<td><label>Job Title:</label> <?=ucwords($key['job_title'])?></td>
						</tr>
						<tr>
							<td><label>Position Level:</label> <?=ucwords($key['position_lvl'])?></td>
						</tr>
						<tr>
							<td><label>Specialization:</label> <?=ucwords($key['specialization'])?></td>
						</tr>
					</table>
				</div>
				<div class='col-md-12'>
					<table>
						<tr>
							<td><hr/><label>Job Role:</label></td>
						</tr>
						<tr>
							<td><?=$key['job_role']?></td>
						</tr>
						<tr>
							<td><hr/><label>Job Description:</label></td>
						</tr>
						<tr>
							<td><?=$key['job_desc']?></td>
						</tr>
						<tr>
							<td><hr/>
								<label>Monthly Salary:&nbsp;</label><?=$key['currency_symbol'] . ' ' . $key['monthly_sal']?>
								<br/>
								<label>Reason For Leaving:&nbsp;</label>
								<?=$key['reason_for_leaving'] == '' ? 'No Record' : $key['reason_for_leaving']?>
							</td>
						</tr>
						<tr>
							<td>
								<span style='text-align:right;font-weight:bold; font-size:15px;'>

								</span>
							</td>
						</tr>
					</table>

				</div>
				<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
					<?=$key['date_joined_from'] . ' - ' . $key['date_joined_to']?>
				</div>
			</div>
		<?php }
} else {
	echo "No Record";
}
?>
		<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
			<a href="" class="btn btn-sm btn-default pull-center"><i class="glyphicon glyphicon-plus"></i>Add Work Experience</a>
		</div>
	</div>
	<div class='col-md-12 record_sec'>
		<div class='col-md-12' style='text-align:center;font-weight:bold; font-size:15px;'>
			<label style='font-size:18px;'>Skills</label>
		</div>
		<?php
if (!empty($skills)) {
	foreach ($skills as $key) {?>

			<div class='col-md-12 record_sec_we'>
				<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
					<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i>Delete</a>
					<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-edit"></i>Edit</a>
				</div>
				<div class='col-md-6'>
					<table>
						<tr>
							<td><label>Skill:</label> <?=ucwords($key['skills'])?></td>
						</tr>
						<tr>
							<td><label>Proficiency:</label> <?=ucwords($key['proficiency'])?></td>
						</tr>
					</table>
				</div>
			</div>
		<?php }
} else {
	echo "No Record";
}
?>
		<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
			<a href="" class="btn btn-sm btn-default pull-center"><i class="glyphicon glyphicon-plus"></i>Add Skills</a>
		</div>
	</div>
	<div class='col-md-12 record_sec'>
		<div class='col-md-12' style='text-align:center;font-weight:bold; font-size:15px;'>
			<label style='font-size:18px;'>Education</label>
		</div>
		<?php
if (!empty($education)) {
	foreach ($education as $key) {
		?>
				<div class='col-md-12 record_sec_we'>
					<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
						<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i>Delete</a>
						<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-edit"></i>Edit</a>
					</div>
					<div class='col-md-6'>
						<table>
							<tr>
								<td><label>School:</label> <?=ucwords($key['school'])?></td>
							</tr>
							<tr>
								<td><label>Location:</label> <?=ucwords($key['school_loc'])?></td>
							</tr>
							<tr>
								<td><label>Educational Level:</label> <?=ucwords($key['educ_lvl'])?></td>
							</tr>
							<?php if ($key['fieldofstudy']) {?>
							<tr>
								<td><label>Field of Study:</label> <?=ucwords(!$key['fieldofstudy'] ? 'N.A.' : $key['fieldofstudy'])?></td>
							</tr>
							<?php }
		if ($key['fieldofstudy']) {?>
							<tr>
								<td><label>Major:</label> <?=ucwords($key['major'])?></td>
							</tr>
							<?php }
		?>
							<tr>
								<td><label>Grade Average:</label> <?=ucwords($key['grade_ave'])?></td>
							</tr>
							<tr>
								<td><label>Graduation Date:</label> <?=ucwords($key['grad_date'])?></td>
							</tr>
						</table>
					</div>
				</div>
		<?php }
} else {
	echo "No Record";
}
?>
		<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
			<a href="" class="btn btn-sm btn-default pull-center"><i class="glyphicon glyphicon-plus"></i>Add Education</a>
		</div>
	</div>
	<div class='col-md-12 record_sec'>
		<div class='col-md-12' style='text-align:center;font-weight:bold; font-size:15px;'>
			<label style='font-size:18px;'>Language</label>
		</div>
		<?php
if (!empty($language)) {
	foreach ($language as $key) {?>
				<div class='col-md-12 record_sec_we'>
					<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
						<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i>Delete</a>
						<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-edit"></i>Edit</a>
					</div>
					<div class='col-md-6'>
						<table>
							<tr>
								<td><label>Language:</label> <?=ucwords($key['language'])?></td>
							</tr>
							<tr>
								<td><label>Proficiency Reading:</label> <?=ucwords($key['reading_prof'])?></td>
							</tr>
							<tr>
								<td><label>Proficiency Writing:</label> <?=ucwords($key['writing_prof'])?></td>
							</tr>
							<tr>
								<td><label>Proficiency Speaking:</label> <?=ucwords($key['speaking_prof'])?></td>
							</tr>
						</table>
					</div>
				</div>
		<?php }
} else {
	echo "No Record";
}
?>
			<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
				<a href="" class="btn btn-sm btn-default pull-center"><i class="glyphicon glyphicon-plus"></i>Add Language</a>
			</div>
	</div>

	<div class='col-md-12 record_sec'>
		<div class='col-md-12' style='text-align:center;font-weight:bold; font-size:15px;'>
			<label style='font-size:18px;'>Certification</label>
		</div>
		<?php
if (!empty($certification)) {
	foreach ($certification as $key) {?>
				<div class='col-md-12 record_sec_we'>
					<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
						<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-trash"></i>Delete</a>
						<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-edit"></i>Edit</a>
					</div>
					<div class='col-md-6'>
						<table>
							<tr>
								<td><label>Certification:</label> <?=ucwords($key['certification'])?></td>
							</tr>
							<tr>
								<td><label>Acquired On:</label> <?=ucwords($key['acquired_on'])?></td>
							</tr>
						</table>
					</div>
				</div>
		<?php }
} else {
	echo "No Record";
}
?>
			<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
				<a href="" class="btn btn-sm btn-default pull-center"><i class="glyphicon glyphicon-plus"></i>Add Certification</a>
			</div>
	</div>

	<div class='col-md-12 record_sec'>
			<div class='col-md-12' style='text-align:center;font-weight:bold; font-size:15px;'>
				<label style='font-size:18px;'>Additional Info</label>
			</div>
				<div class='col-md-12 record_sec_we'>
					<div class='col-md-12' style='text-align:right;font-weight:bold; font-size:15px;'>
						<a href="" class="btn btn-xs btn-default pull-right"><i class="glyphicon glyphicon-edit"></i>Edit</a>
					</div>
					<div class='col-md-6'>
						<table>
							<tr>
								<td><label>Expected Salary:</label>
									<?php
if (!$additionalInfo['expected_sal']) {
	echo 'No Record';
} else {
	if ($additionalInfo['negotiable'] == 0) {
		echo $additionalInfo['currency_symbol'] . $additionalInfo['expected_sal'] . ' Negotiable';
	} elseif ($additionalInfo['negotiable'] == 1) {
		echo $additionalInfo['currency_symbol'] . $additionalInfo['expected_sal'] . ' Non-negotiable';
	}
}
?>
								</td>
							</tr>
							<tr>
								<td><label>Preferred Location 1:</label> <?=ucwords(!$additionalInfo['pref_loc1'] ? 'No Record' : $additionalInfo['pref_loc1'])?></td>
							</tr>
							<tr>
								<td><label>Preferred Location 2:</label> <?=ucwords(!$additionalInfo['pref_loc2'] ? 'No Record' : $additionalInfo['pref_loc2'])?></td>
							</tr>
							<tr>
								<td><label>Preferred Location 3:</label> <?=ucwords(!$additionalInfo['pref_loc3'] ? 'No Record' : $additionalInfo['pref_loc3'])?></td>
							</tr>
							<tr>
								<td><label>Can work abroad:</label> <?php if ($additionalInfo['overseas']) {
	if ($additionalInfo['overseas'] == 1) {
		echo 'Yes';
	} else {
		echo 'No';
	}
} else {
	echo 'No Record';
}
?></td>
							</tr>

						</table>
					</div>
				</div>

	</div>
</div>