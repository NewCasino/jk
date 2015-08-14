<!-- Bootstrap -->
<link href="<?= CSSPATH ?>bootstrap.min.css" rel="stylesheet">
<link href="<?= CSSPATH ?>bootstrap-theme.min.css" rel="stylesheet">
<link href="<?= CSSPATH ?>home/jk_features.css" rel="stylesheet"> 
<link href="<?= CSSPATH ?>employer/dashboard.css" rel="stylesheet"> 
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script type="text/javascript" src="<?= JSPATH ?>jquery-2.1.1.js"></script>
<script type="text/javascript" src="<?= JSPATH ?>bootstrap.js"></script>
<script type="text/javascript" src="<?= JSPATH ?>home/employer.js"></script>
<style type="text/css">
    body{
        background-image:url('../../resources/images/ajkk/home_banner-bg.jpg');
    }
</style>
<!-- Fixed navbar -->
<nav class="navbar navbar-inverse navbar-jobpreview">
    <div class="container">
            <br/>
            <div class="col-md-12" >
                <div class="col-md-12" align="center">
                        <img src="<?= AJKKIMGPATH.'jobkonek_logo-sm.png' ?>"> <br/>
                        <span style='color:#ddd'>www.jobkonek.com</span> <br/>
                        <span style='color:#eee; font-size:8px;'>powered by: ASRII</span>
                        <br/><br/>
                </div>
                <!-- <div class="col-md-2">
                    www.jobkonek.com
                </div> -->
                <br/>
            </div>
    </div>

</nav>

<div class="row">
    <div class="col-md-12" >
        <div class="col-md-12">
                <div class="col-md-12 panel" style="padding:20px; background-color:#fff">
                    <div class="col-md-2">
                        <!-- <img id="editBannerCmsImg" src="<?php echo BASEURL.'resources/images/comp_logo/'.$empLogo['mediaName'] ?>" style="align: left; valign= middle; width: 150px; height: 150px; margin: 0 1px 0 0; display:block;"/> -->
                        <?php if(!empty($empLogo)){ ?>
                                <img id="editBannerCmsImg" src="<?php echo BASEURL.'resources/images/comp_logo/'.$empLogo['mediaName'] ?>" style="align: left; valign= middle; width: 150px; height: 150px; margin: 0 1px 0 0; display:block;"/>
                        <?php }else{ ?>
                            <img id="editBannerCmsImg" src="<?php echo BASEURL.'resources/images/comp_logo/default.jpg' ?>" style="align: left; valign= middle; width: 150px; height: 150px; margin: 0 1px 0 0; display:block;"/>
                        <?php } ?>
                    </div>
                    <div class="col-md-10">
                        <h3><?= '<b>'.strtoupper($jobInfo['jobDetails']['job_title']).'</b> - '.ucwords($jobInfo['jobDetails']['location_region'].'('.$jobInfo['jobDetails']['location_city'].')'); ?></h3> 
                            <?= $jobInfo['jobDetails']['specialization'] ?><br/><br/>
                        <table>
                            <tr>
                                <td><img data-toggle="tooltip" title="Salary" data-placement="bottom" src="<?= AJKKIMGPATH.'search_sal_icon.png' ?>">
                                </td>
                                <td><?= $jobInfo['jobDetails']['currency'].' '.$jobInfo['jobDetails']['salary_min'].' - '.$jobInfo['jobDetails']['salary_max'].'<br/><span style="font-size:11px;"> '.$jobInfo['jobDetails']['salary_type'].'</span>' ?>
                                </td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td><img data-toggle="tooltip" title="Years of experience" data-placement="bottom" src="<?= AJKKIMGPATH.'search_expi_icon.png' ?>">
                                </td>
                                <td><?= $jobInfo['jobDetails']['yr_exp'].' yrs of experience.' ?>
                                </td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td><img data-toggle="tooltip" title="Hiring Period" data-placement="bottom" src="<?= AJKKIMGPATH.'search_duration_icon.png' ?>">
                                </td>
                                <td><?= $jobInfo['jobDetails']['date_posted'].' - '.$jobInfo['jobDetails']['date_expiry'] ?>
                                </td>
                            </tr>                          
                        </table>
                    </div>

                </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="col-md-8">
            <div class="panel panel-og">
                <div class="panel-heading">
                    JOB DETAILS
                </div>
                <div class="panel-body" style="border-top: 3px solid #366903; min-height: 100px;">
                    <div class="row">
                        <div align="left">
                            <h5><strong>Description</strong></h5>
                            <p>
                                <?= $jobInfo['jobDetails']['job_desc']; ?>
                            </p>
                        </div>
                    </div>
                    <?php if($jobInfo['jobDetails']['experience_req'] != ''){ ?>
                    <div class="row">
                        <div align="left">
                            <h5><strong>Experience Requirements</strong></h5>
                            <p>
                                <?= $jobInfo['jobDetails']['experience_req']; ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($jobInfo['jobDetails']['additional_job_req'] != ''){ ?>
                    <div class="row">
                        <div align="left">
                            <h5><strong>Additional Requirements</strong></h5>
                            <p>
                                <?= $jobInfo['jobDetails']['experience_req']; ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($jobInfo['jobDetails']['jobEducReq'] != ''){ ?>
                    <div class="row">
                        <div align="left">
                            <h5><strong>Educational Requirements</strong></h5>
                            <p>
                                <?php foreach ($jobInfo['jobDetails']['jobEducReq'] as $key => $value) { ?>
                                    <ul>
                                        <li><?= ucwords($value['education']) ?></li>
                                    </ul>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($jobInfo['jobDetails']['jobBenefits'] != ''){ ?>
                    <div class="row">
                        <div align="left">
                            <h5><strong>Benefits</strong></h5>
                            <p>
                                <?php foreach ($jobInfo['jobDetails']['jobBenefits'] as $key => $value) { ?>
                                    <ul>
                                        <li><?= ucwords($value['benefits']) ?></li>
                                    </ul>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                    <?php if($jobInfo['jobDetails']['emp_type'] != ''){ ?>
                    <div class="row">
                        <div align="left">
                            <h5><strong>Employment</strong></h5>
                            <p>
                                <?php foreach ($jobInfo['jobDetails']['emp_type'] as $key => $value) { ?>
                                    <ul>
                                        <li><?= ucwords($value['emp_type']) ?></li>
                                    </ul>
                                <?php } ?>
                            </p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-og">
                <div class="panel-heading text-uppercase">Company Details</div>
                <div class="panel-body">
                    <div class="media">
                        <div class="media-body">
                            <h4 class="media-heading page-header text-uppercase">Company Name:</h4> <?= strtoupper($empInfo['empDetails']['comp_name']) ?><br/><br/>
                            <h4 class="media-heading page-header text-uppercase">Nature of Business:</h4> <?= ucwords($empInfo['empDetails']['comp_nature']) ?><br/><br/>
                            <h4 class="media-heading page-header text-uppercase">Business Reg #:</h4> <?= ucwords($empInfo['empDetails']['business_regno']) ?><br/><br/>
                            <h4 class="media-heading page-header text-uppercase">Company Type:</h4> <?= ucwords($empInfo['empDetails']['comp_type']) ?><br/><br/>
                            <h4 class="media-heading page-header text-uppercase">Company Size:</h4> <?= ucwords($empInfo['empDetails']['comp_size']) ?><br/><br/>
                            <h4 class="media-heading page-header text-uppercase">Dress Code:</h4> <?= ucwords($empInfo['empDetails']['dress_code']) ?><br/><br/>
                            <h4 class="media-heading page-header text-uppercase">Working Hrs:</h4> <?= ucwords($empInfo['empDetails']['working_hrs']) ?><br/><br/>
                            <h4 class="media-heading page-header text-uppercase">Spoken Language:</h4> <?= ucwords($empInfo['empDetails']['spoken_lang']) ?><br/><br/>
                            <?php if($empInfo['empDetails']['organization'] != ''){ ?><h4 class="media-heading page-header text-uppercase">Organization:</h4> <?= ucwords($empInfo['empDetails']['organization']) ?><br/><br/><?php } ?>
                            <?php if($empInfo['empDetails']['website'] != ''){ ?><h4 class="media-heading page-header">Website:</h4> <?= $empInfo['empDetails']['website'] ?><br/><br/><?php } ?>
                            <h4 class="media-heading page-header text-uppercase">Address:</h4> <?= ucwords($empInfo['empDetails']['address'].','.$empInfo['empDetails']['city'].', '.$empInfo['empDetails']['country']) ?><br/><br/>
                            <h4 class="media-heading page-header text-uppercase">About Us:</h4>
                            <strong><?= $empInfo['empDetails']['comp_desc'] ?></strong></div>
                            <!-- <a href="<?= BASEURL.'online/casino' ?>" class="btn btn-og text-uppercase"><?= lang('wc.11'); ?></a> -->
                        </div>
                        <!-- <div class="media-right media-top">
                            <img class="media-object" src="<?= IMAGEPATH.'/home/jackpot.png' ?>">
                        </div> -->
                    </div>
                </div>
            </div>

            
        </div>
    </div>
</div>
<script type='text/javascript'>
    //tooltip
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]'
    });
</script>