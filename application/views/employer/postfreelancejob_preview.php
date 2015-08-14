<!-- Bootstrap -->
<link href="<?= CSSPATH ?>bootstrap.min.css" rel="stylesheet">
<link href="<?= CSSPATH ?>bootstrap-theme.min.css" rel="stylesheet">
<link href="<?= CSSPATH ?>home/jk_features.css" rel="stylesheet"> 
<link href="<?= CSSPATH ?>employer/dashboard.css" rel="stylesheet"> 
<link rel="stylesheet" type="text/css" href="<?= CSSPATH ?>icons.css">
<!-- Bootstrap core CSS -->
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<script type="text/javascript" src="<?= JSPATH ?>jquery-2.1.1.js"></script>
<script type="text/javascript" src="<?= JSPATH ?>bootstrap.js"></script>
<script type="text/javascript" src="<?= JSPATH ?>home/employer.js"></script>
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
                <div class="col-md-12 panel homeBannerBg" style="padding:20px; background-color:#fff">
                    
                    <div class="col-md-10">
                        <h3><?= '<b>'.strtoupper($jobInfo['freelanceJobDetails']['project_name']).'</b> '; ?></h3> 
                        <table>
                            <tr>
                                <td><!-- <img data-toggle="tooltip" title="Budget" data-placement="bottom" src="<?= AJKKIMGPATH.'search_sal_icon.png' ?>"> -->
                                <i class="icon-price-tag" data-toggle="tooltip" data-placement="bottom" title='Budget'></i>
                                </td>
                                <td>&nbsp;<?= $jobInfo['freelanceJobDetails']['payment_currency'].' '.$jobInfo['freelanceJobDetails']['min_budget'].' - '.$jobInfo['freelanceJobDetails']['max_budget'].'<span style="font-size:11px;"> '.$jobInfo['freelanceJobDetails']['payment_type'].'</span>' ?>
                                </td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td><!-- <img data-toggle="tooltip" title="Project Type" data-placement="bottom" src="<?= AJKKIMGPATH.'search_expi_icon.png' ?>"> -->
                                <i class="icon-laptop" data-toggle="tooltip" data-placement="bottom" title='Project Type'></i>
                                </td>
                                <td>&nbsp;<?= $jobInfo['freelanceJobDetails']['project_type'] ?>
                                </td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td><!-- <img data-toggle="tooltip" title="Project Duration" data-placement="bottom" src="<?= AJKKIMGPATH.'search_duration_icon.png' ?>"> -->
                                <i class="icon-alarm" data-toggle="tooltip" data-placement="bottom" title='Project Duration'></i>
                                </td>
                                <td>&nbsp;<?= $jobInfo['freelanceJobDetails']['project_duration'] ?>
                                </td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                </td>
                                <td><!-- <img data-toggle="tooltip" title="Required Working Hours" data-placement="bottom" src="<?= AJKKIMGPATH.'search_duration_icon.png' ?>"> -->
                                <i class="icon-clock" data-toggle="tooltip" data-placement="bottom" title='Required Working Hrs'></i>
                                </td>
                                <td>&nbsp;<?= $jobInfo['freelanceJobDetails']['hrs_work'].' hrs. per '.$jobInfo['freelanceJobDetails']['project_duration_per']  ?>
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
    
        <div class="col-md-12">
            <div class="panel panel-og">
                <div class="panel-heading">
                    PROJECT DETAILS
                    <span class='pull-right'>Posted On: <?= $jobInfo['freelanceJobDetails']['created_on'] ?></span>
                </div>

                <div class="panel-body" style="border-top: 3px solid #366903; min-height: 100px;">
                    <div class="row">
                        <div align="left">
                            <span style='font-size:16px;'><strong>Description:</strong></span>
                            <br/>
                            <p style="margin-top:5px;">
                                <?= $jobInfo['freelanceJobDetails']['project_overview']; ?>
                            </p>
                            <p>
                            <strong>Skills Required:</strong>
                                <br/>
                                <ul>
                            <?php $skillsList='';
                                            if(!empty($jobInfo['freelanceJobDetails']['skills_req'])){
                                                foreach ($jobInfo['freelanceJobDetails']['skills_req'] as $key) {
                                                    echo '<li>'.$key['skills'].'</li>';
                                                }
                                            }
                                        ?>      
                                </ul>
                            </p>
                            <p>
                                <?php if($jobInfo['freelanceJobDetails']['freelanceJobDoc']){ ?>
                                    <a href="<?= BASEURL . 'members/downloadDocs/'. rawurlencode($jobInfo['freelanceJobDetails']['freelanceJobDoc']['mediaName']) ?>" data-toggle="tooltip" title="<?= lang('ban.download'); ?>"><i class="glyphicon glyphicon-download-alt"></i>Download Specification</a>
                                <?php } ?>
                            </p>
                        </div>

                    </div>

                </div>
            </div>

            <?php if($this->session->userdata('usertype') != 'employer'){
                    if($this->session->userdata('usertype') == 'member'){ ?>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4">
                            <?php if($jobApplyExists){ ?>
                                <a href="#" class="btn btn-default btn-block" disabled>APPLICATION EXISTS</a>    
                            <?php }else{ ?>
                                <a href="<?= BASEURL . 'members/applyFreelanceJob/'.$jobInfo['freelanceJobDetails']['fljobId'].'/'.$jobInfo['freelanceJobDetails']['empId'] ?>" class="btn btn-primary btn-block">APPLY</a>
                            <?php } ?>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4 col-lg-4"></div>
                    <?php }else{ ?>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><a href="<?= BASEURL . 'auth/login/member' ?>" class="btn btn-primary btn-block">You must login first to apply!</a></div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"><a href="<?= BASEURL . 'auth/register/member' ?>" class="btn btn-success btn-block">Bookmark!</a></div>
                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3"></div>
            <?php }
            } ?>

        </div>

    </div>
</div>
<br/>  
<script type='text/javascript'>
    //tooltip
    $('body').tooltip({
        selector: '[data-toggle="tooltip"]'
    });
</script>