<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="icon" href="../../favicon.ico">

    <title><?=$title?></title>
    <meta name="description" content="<?=$description?>"/>
    <meta content="<?=$keywords?>" name="keywords" />
    <!-- Bootstrap -->
	<link href="<?=CSSPATH?>bootstrap.min.css" rel="stylesheet">
    <link href="<?=CSSPATH?>bootstrap-theme.min.css" rel="stylesheet">
	<link href="<?=CSSPATH?>home/jk_features.css" rel="stylesheet">
	<link href="<?=CSSPATH?>employer/dashboard.css" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <!-- <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css"> -->

    <script type="text/javascript" src="<?=JSPATH?>jquery-2.1.1.js"></script>
	<script type="text/javascript" src="<?=JSPATH?>bootstrap.js"></script>

	<link rel="stylesheet" type="text/css" href="<?=CSSPATH?>icons.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.6/css/jquery.dataTables.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/responsive/1.0.5/css/dataTables.responsive.css">
	<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/tabletools/2.2.4/css/dataTables.tableTools.css">


    <?=$_scripts?>

    <!-- Custom styles for this template -->

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top navbar-jobpreview">
		<div class="container">
			<div class="navbar-header">
				<br/>
				<?php if (!$this->session->userdata('usertype') == 'member') {?>
				<a class="navbar-brand" href="<?=BASEURL . 'ajkk/welcome'?>" style="margin: -30px 0px 30px 30px; margin-bottom:35px;">
					<img alt="ajkk" src="<?=AJKKIMGPATH . 'jobkonek_logo-sm.png'?>">
				</a>
				<?php } else {?>
				<a class="navbar-brand" href="<?=BASEURL . 'ajkk/welcome'?>" style="margin: -30px 0px 30px 30px; margin-bottom:35px;">
					<img alt="ajkk" src="<?=AJKKIMGPATH . 'jobkonek_logo-sm.png'?>">
				</a>
				<?php }
?>
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse" id="navbarcollapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="pull-right">

				</div>
			</div>
			<br/>
			<div class="navbar-collapse collapse">
				<?php //var_dump($this->session->userdata('usertype'));
if ($this->authentication->isLoggedIn()) {
	?>
					<?php if ($this->session->userdata('usertype') == 'member') {?>
						<ul class="nav navbar-nav text-uppercase">
							<li><a href="<?=BASEURL . 'ajkk/welcome'?>"><?=lang('header.home');?><!-- Home --></a></li>
							<li class="nav-divider"></li>
							<li><a href="<?=BASEURL . 'ajkk/jobs/fulltimejobs'?>">FULLTIME JOBS</a></li>
							<li class="nav-divider"></li>
							<li><a href="<?=BASEURL . 'ajkk/jobs/freelancejobs'?>">FREELANCE JOBS</a></li>
							<li class="nav-divider"></li>
							<li><a href="<?=BASEURL . 'ajkk/jobs/parttimejobs'?>">PART TIME JOBS</a></li>
							<li class="nav-divider"></li>

							<li><a href="<?=BASEURL . 'ajkk/jobs/agencyjobs'?>">AGENCY JOBS</a></li>
							<li class="nav-divider"></li>
						</ul>

						<ul class="nav navbar-nav navbar-right">
							<li class="dropdown">
			                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?=strtoupper(explode("@", $username)[0]) . ' - JobKonek'?><span class="caret"></span></a>
			                <ul class="dropdown-menu" role="menu">
			                  <li><a href="<?=BASEURL . 'myresume'?>">MyResume</a></li>
			                  <!-- <li><a href="#">Interview</a></li> -->
			                  <li class="divider"></li>
			                  <li><a href="#">My Application</a></li>
			                  <li><a href="#">Saved Jobs</a></li>
			                  <li class="divider"></li>
			                  <li><a href="#">Settings</a></li>
			                  <li class="divider"></li>
			                  <li><a href="<?=BASEURL . 'auth/logout'?>"><strong>LOGOUT</strong></a></li>

			                </ul>
			              </li>
			            </ul>

			        <?php } else {?>
			        	<ul class="nav navbar-nav text-uppercase">
							<li><a href="<?=BASEURL . 'employers/home'?>">DASHBOARD<!-- Home --></a></li>
							<li class="nav-divider"></li>
							<li class="dropdown">
				                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">JOB MANAGER<span class="caret"></span></a>
				                <ul class="dropdown-menu" role="menu">
				                  <li><a href="<?=BASEURL . 'employers/postNewJob'?>">Create New Job</a></li>
				                  <li><a href="<?=BASEURL . 'employers/home'?>">Job List</a></li>
				                  <li><a href="<?=BASEURL . 'employers/applicantManager/0/1'?>">New Applicant</a></li>
				                  <li><a href="<?=BASEURL . 'employers/applicantManager/1/1'?>">Shortlisted Applicant</a></li>
				                  <li><a href="<?=BASEURL . 'employers/applicantManager/2/1'?>">Scheduled Interview</a></li>
				                  <li><a href="<?=BASEURL . 'employers/applicantManager/3/1'?>">Assessed Applicant</a></li>
				                </ul>
				            </li>
							<li class="nav-divider"></li>

							<li class="dropdown">
				                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">FREELANCE JOB MANAGER<span class="caret"></span></a>
				                <ul class="dropdown-menu" role="menu">
				                  <li><a href="<?=BASEURL . 'employers/postNewFreelanceJob'?>">Create New Freelance Job</a></li>
				                  <li><a href="<?=BASEURL . 'employers/activeFreelanceJob'?>">Freelance Job List</a></li>
				                  <li><a href="<?=BASEURL . 'employers/applicantManager/0/2'?>">New Applicant</a></li>
				                  <li><a href="<?=BASEURL . 'employers/applicantManager/1/2'?>">Shortlisted Applicant</a></li>
				                  <li><a href="<?=BASEURL . 'employers/applicantManager/2/2'?>">Scheduled Interview</a></li>
				                  <li><a href="<?=BASEURL . 'employers/applicantManager/3/2'?>">Assessed Applicant</a></li>

				                </ul>
				            </li>

							<li class="nav-divider"></li>
							<li class="dropdown">
				                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">BILLING<span class="caret"></span></a>
				                <ul class="dropdown-menu" role="menu">
				                  <li><a href="<?=BASEURL . 'employers/employerBilling/1'?>">PAID BILL</a></li>
				                  <li><a href="<?=BASEURL . 'employers/employerBilling/0'?>">UNPAID BILL</a></li>
				                </ul>
				            </li>

				            <li class="nav-divider"></li>
							<li class="dropdown">
				                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MYJOBKONEK CMS<span class="caret"></span></a>
				                <ul class="dropdown-menu" role="menu">
				                  <li><a href="#">Manage Content</a></li>
				                  <li><a href="#">Manage Theme</a></li>
				                  <li><a href="#">Post Blog</a></li>
				                  <li><a href="#">Upload Company Photo</a></li>
				                  <li class="divider"></li>
				                  <li><a href="#">Search Resume</a></li>
				                </ul>
				            </li>
							<!-- <li><a href="<?=BASEURL . 'employers/home'?>"><?=lang('header.contactus');?></a></li> -->
						</ul>

							<ul class="nav navbar-nav navbar-right">
								<li class="dropdown">
				                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">MyJobKonek <span class="caret"></span></a>
				                <ul class="dropdown-menu" role="menu">
				                  <li><a href="<?=BASEURL . 'employers/viewEmployerProfile'?>">Company Profile</a></li>
				                  <li><a href="#">Reports</a></li>
				                  <li><a href="<?=BASEURL . 'employers/employerBilling'?>">Billing</a></li>
				                  <!-- <li><a href="#">Account User</a></li> -->
				                  <li><a href="#">Setting</a></li>
				                  <li class="divider"></li>

				                  <li><a href="<?=BASEURL . 'auth/logout'?>"><b>LOGOUT</b></a></li>
				                </ul>
				              </li>
				            </ul>

			        <?php }
	?>
			    <?php } else {?>
			    	<ul class="nav navbar-nav text-uppercase">
						<li><a href="<?=BASEURL . 'ajkk/welcome'?>"><?=lang('header.home');?><!-- Home --></a></li>
						<li class="nav-divider"></li>
						<li><a href="<?=BASEURL . 'ajkk/jobs/fulltimejobs'?>">FULLTIME JOBS</a></li>
						<li class="nav-divider"></li>
						<li><a href="<?=BASEURL . 'ajkk/jobs/freelancejobs'?>">FREELANCE JOBS</a></li>
						<li class="nav-divider"></li>
						<li><a href="<?=BASEURL . 'ajkk/jobs/parttimejobs'?>">PART TIME JOBS</a></li>
						<li class="nav-divider"></li>
						<li><a href="<?=BASEURL . 'ajkk/jobs/agencyjobs'?>">AGENCY JOBS</a></li>
						<li class="nav-divider"></li>
					</ul>
				<?php }
?>
			</div>
		</div>
	</nav>

    <?php
if ($this->session->userdata('result') == 'success') {
	?>
			<div class="alert alert-success alert-dismissible" id="alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<?=$this->session->userdata('message')?>
				<span id="message"></span>
			</div>
	<?php
$this->session->unset_userdata('result');
	$this->session->unset_userdata('promoMessage');

} elseif ($this->session->userdata('result') == 'danger') {
	?>
			<div class="alert alert-danger alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<?=$this->session->userdata('message')?>
			</div>
	<?php
$this->session->unset_userdata('result');
	$this->session->unset_userdata('promoMessage');
} elseif ($this->session->userdata('result') == 'warning') {
	?>
			<div class="alert alert-warning alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<?=$this->session->userdata('message')?>
			</div>
	<?php
$this->session->unset_userdata('result');
	$this->session->unset_userdata('promoMessage');
}
?>
	<div class="container homeBannerBg" >
		<?=$main_content?>
	</div>

	<div class="container homeBannerBg" style="background-color: #fff; padding: 0;">
		<nav class="navbar navbar-og">
			<ul class="nav navbar-nav navbar-center">
				<?php
$atts_popup = array(
	'width' => '1030',
	'height' => '600',
	'scrollbars' => 'yes',
	'status' => 'yes',
	'resizable' => 'no',
	'screenx' => '0',
	'screeny' => '0',
	'background-color' => '#fff',
);
?>
				<?php if (!empty($footerlinks)): ?>
					<?php foreach ($footerlinks as $key => $value): ?>
						<li>
							<?php // anchor_popup(BASEURL.'online/viewContentDetails/'.$value['footercontentId'], $value['footercontentName'], $atts_popup) ?>
							<a href="<?=BASEURL . 'online/viewContentDetails/' . $value['footercontentId']?>"><?=$value['footercontentName']?></a>
						</li>
					<?php endforeach?>
				<?php endif?>
			</ul>
		</nav>
	</div>

	<div class="container" style="background-color: #fff;">
		<div class="row">
			<div class="col-sm-offset-2 col-md-offset-2 col-lg-offset-2 col-sm-8 col-md-8 col-lg-8">
				<div class="text-center" style="font-size: 13px; color: #767676; margin-bottom: 79px;">

					<div style="margin-bottom: 30px;">
						<ul class="list-inline">
							<li><img src="<?=IMAGEPATH . '/home/footer-1.png'?>"></li>
							<li><img src="<?=IMAGEPATH . '/home/footer-2.png'?>"></li>
							<li><img src="<?=IMAGEPATH . '/home/footer-3.png'?>"></li>
							<li><img src="<?=IMAGEPATH . '/home/footer-4.png'?>"></li>
							<li><img src="<?=IMAGEPATH . '/home/footer-5.png'?>"></li>
							<li><img src="<?=IMAGEPATH . '/home/footer-6.png'?>"></li>
							<li><img src="<?=IMAGEPATH . '/home/footer-7.png'?>"></li>
						</ul>
					</div>
						<p>Welcome to Philippine’s favourite job hunting website, JK, where you’ll find the widest range of job openings awaits for you.
						JobKonek founded by ASRII in 2014, his mission to help people gets jobs easily and hassle free and improving employment participation of people living outside the city.</p>
				</div>
			</div>
		</div>
	</div>

	<nav class="navbar navbar-inverse navbar-static-bottom">
		<div class="container">
			<p class="navbar-text" style="color: #fff; font-size: 13px; float: center; text-align: center;">Copyright &copy; AJKK Tech Co. Inc <?=date('Y');?></p>
		</div>
	</nav>

	<?=$footer_content?>


  </body>
</html>
