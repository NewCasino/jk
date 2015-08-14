<script type="text/javascript" src="<?= JSPATH ?>home/employer.js"></script>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="col-lg-8" style="align:center">
        <div class="col-sm-12 col-md-12 col-lg-12">
                    <!-- start dashboard notification -->                    
                    <a class='notificationRefreshList' href="<?= BASEURL . 'employers/sortJobBy/1' ?>">
                        <div class="col-md-2 col-sm-2 col-lg-2 notificationDashboard hover-shadow <?= $this->session->userdata('currentEmpPage') == 'joblist' ? 'notDboard-active' : ''?>" id="notificationDashboard-joblist">
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-joblist"><?= $activeJobs['cnt'] ?></span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-joblist">ACTIVE JOB POST</span>
                        </div>
                    </a>

                    <a class='notificationRefreshList' href="<?= BASEURL . 'employers/sortFLJobBy/1' ?>">
                        <div class="col-md-2 col-sm-2  col-lg-2 notificationDashboard hover-shadow <?= $this->session->userdata('currentEmpPage') == 'freelancejoblist' ? 'notDboard-active' : ''?>" id="notificationDashboard-freelancejoblist">
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-freelancejoblist"><?= $activeFLJobs['cnt'] ?></span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-freelancejoblist">ACTIVE FREELANCE JOB</span>
                        </div>
                    </a>

                    <a class='notificationRefreshList' href="<?= BASEURL . 'payment_management/refreshList/depositApproved' ?>">
                        <div class="col-md-2 col-sm-2  col-lg-2 notificationDashboard hover-shadow <?= $this->session->userdata('currentEmpPage') == 'saveresume' ? 'notDboard-active' : ''?>" id="notificationDashboard-savedresume">
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-savedresume">12</span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-savedresume">SAVED RESUME</span>
                        </div>
                    </a>
                    <a class='notificationRefreshList' href="<?= BASEURL . 'payment_management/refreshList/depositDeclined' ?>">
                        <div class="col-md-2 col-sm-2  col-lg-2 notificationDashboard hover-shadow <?= $this->session->userdata('currentEmpPage') == 'shortlisted' ? 'notDboard-active' : ''?>" id="notificationDashboard-shortlisted">
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-shortlisted">15</span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-shortlisted">SHORTLISTED</span>
                        </div>
                    </a>
        </div>
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4">
            <p>Search Resume</p>
            <table>
            <tr>
            <td>
            <input type="text" name="searchCv" class="form-control" style="width:100%;" />
            </td>
            <td>&nbsp;
            <input type="submit" value="GO" name="searchCv" class="btn btn-md btn-success">
            </td>
            </tr>
            </table>
    </div>
    </div>
</div>
<div class="row">
    <?php 
         if(!empty($homesmallbanner)){
            foreach ($homesmallbanner as $key) { ?>
                <div class="col-lg-3">
                    <a href="<?= BASEURL . 'online/casino' ?>"><img class="" src="<?= PROMOCMSBANNERPATH.$key['bannerName']; ?>" alt="Generic placeholder image" style=""></a>
                </div>
    <?php }
         } ?>
</div>
<br/>
<div class="row">
    <div class="col-lg-12">
    <div class="col-lg-8">
        <div class="panel panel-og">
            <div class="panel-heading">
                <?= $fljobTitleSort ?>
                <a href="<?= BASEURL . 'employers/postNewFreelanceJob' ?>" class="btn btn-xs btn-success pull-right"><i class="glyphicon glyphicon-plus-sign"></i> POST NEW FL JOB</a>
                <div class="btn-group pull-right">
                  <button type="button btn-sm" class="btn btn-xs btn-info btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    TOTAL FREELANCE JOB [<strong> <?= $activeFLJobs['cnt']+$inactiveFLJobs['cnt']+$expiredFLJobs['cnt']+$underReviewFLJobs['cnt'] ?> </strong>] <span class="caret"></span>
                  </button>
                  &nbsp;
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?= BASEURL . 'employers/sortFLJobBy/1' ?>"><?= ' Active <strong>[ '.$activeFLJobs['cnt'].' ]</strong>'; ?></span></a></li>
                    <li><a href="<?= BASEURL . 'employers/sortFLJobBy/2' ?>"><?= ' Inactive <strong>[ '.$inactiveFLJobs['cnt'].' ]</strong>'; ?></span></a></li>
                    <li><a href="<?= BASEURL . 'employers/sortFLJobBy/3' ?>"><?= ' Expired <strong>[ '.$expiredFLJobs['cnt'].' ]</strong>'; ?></span></a></li>
                    <li><a href="<?= BASEURL . 'employers/sortFLJobBy/0' ?>"><?= ' Under Review <strong>[ '.$underReviewFLJobs['cnt'].' ]</strong>'; ?></span></a></li>
                    <li class="divider"></li>
                  </ul>
                </div>
            </div>

            <div class="panel-body" style="border-top: 3px solid #366903;">
                <table class="table table-striped table-hover" style="margin: 0px 0 0 0; width: 100%;" id="flJobsTable">
                    <thead>
                        <tr>
                            <th colspan="8" style="text-align:center; font-size:17px;"> </th>
                        </tr>
                        <tr>
                            <th></th>
                            <th>#</th>
                            <th>Project Name</th>                            
                            <th>Job Order ID</th>
                            <th>Posted On</th>            
                            <?php if($fljobType == 1){ ?>
                                <th>New Applicant</th>    
                                <th>Shortlist</th>    
                                <th>For Interview</th>    
                            <?php } ?>
                            <th>Promo</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php //var_dump($fljobs);
                            $ctr = 1; ?>
                        <?php if(!empty($fljobs)) {  ?>
                            <?php foreach ($fljobs as $key) { ?>
                                <tr>
                                    <td></td>
                                    <td><?= $ctr ?></td>
                                    <td>
                                        <?php if($key['is_approved'] == 1){//under review ?>
                                                <a href="<?= BASEURL.'employers/jobDetails/'.$key['fljobId'].'/0/2' ?>" data-toggle="tooltip" title="Show Applicants"><?= strtoupper($key['project_name']) ?></a>
                                        <?php }else{ ?>
                                                <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/freelancejobPreview/'.$key['fljobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                    <?= strtoupper($key['project_name']) ?>
                                                </a>
                                        <?php } ?> 
                                    </td>
                                    <td><?= $key['joborderid'] ?>
                                    </td>
                                    <td>
                                        <?php echo mdate('%M %d, %Y',strtotime($key['created_on'])) ?>
                                     </td>
                                    
                                  
                                    <?php if($fljobType == 1){ ?>
                                        <td>
                                            <?php 
                                                if(count($key['applicantCnt'])!=0){ ?>
                                                    <a href="<?= BASEURL.'employers/jobDetails/'.$key['fljobId'].'/0/2' ?>" data-toggle="tooltip" title="Show New Applicant"><?= count($key['applicantCnt']); ?></a>
                                            <?php }else{ ?>
                                                    <?= count($key['applicantCnt']); ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if(count($key['shortlistCnt'])!=0){ ?>
                                                    <a href="<?= BASEURL.'employers/jobDetails/'.$key['fljobId'].'/1/2' ?>" data-toggle="tooltip" title="Show Shortlist Applicant"><?= count($key['shortlistCnt']); ?></a>
                                            <?php }else{ ?>
                                                    <?= count($key['shortlistCnt']); ?>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php 
                                                if(count($key['forInterviewCnt'])!=0){ ?>
                                                    <a href="<?= BASEURL.'employers/jobDetails/'.$key['fljobId'].'/2/2' ?>" data-toggle="tooltip" title="Show For Interview Applicant"><?= count($key['applicantCnt']); ?></a>
                                            <?php }else{ ?>
                                                    <?= count($key['forInterviewCnt']); ?>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>

                                    <td>
                                        <?php //var_dump($key['job_promo']);
                                            if($key['job_promo']){
                                                foreach ($key['job_promo'] as $data) {
                                                    if(count($key['job_promo']) == 1){
                                                        echo $data['promo_type'];    
                                                    } else{
                                                        echo $data['promo_type'];
                                                        echo ',';
                                                    }
                                                } 
                                            }else{
                                                echo '<i>No Promo</i>';
                                            }
                                        ?>
                                    </td>
                                    
                                    <td>
                                        <?php if($key['is_approved'] == 0){//expired ?>
                                            <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/freelancejobPreview/'.$key['fljobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                <i class="glyphicon glyphicon-list-alt"></i>
                                            </a> 
                                            
                                            <a href="<?= BASEURL . 'employers/postFreelanceJob/5/'.$key['fljobId'] ?>">
                                                <span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit Post" data-placement="top">
                                                </span>  
                                            </a>
                                            
                                            <a href="<?= BASEURL . 'employers/updateFLJobPostStatus/'.$key['fljobId'].'/1' ?>">
                                                <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Post" data-placement="top">
                                                </span>
                                            </a>
                                         <?php }elseif($key['is_approved'] == '1'){ ?>
                                                <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/freelancejobPreview/'.$key['fljobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                    <i class="glyphicon glyphicon-list-alt"></i>
                                                </a>
                                                <a href="<?= BASEURL . 'employers/activatedDeactivateFLJobPost/'.$key['fljobId'].'/2'.'inactive' ?>">
                                                    <span data-toggle="tooltip" title="Close this post!" class="glyphicon glyphicon-remove-circle" data-placement="top">
                                                    </span>
                                                </a>
                                                <a href="<?= BASEURL . 'employers/updateFLJobPostStatus/'.$key['fljobId'].'/1' ?>">
                                                    <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Post" data-placement="top">
                                                    </span>
                                                </a>
                                        <?php }elseif($key['is_approved'] == '2'){ ?>
                                                <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/freelancejobPreview/'.$key['fljobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                    <i class="glyphicon glyphicon-list-alt"></i>
                                                </a>
                                                <a href="<?= BASEURL . 'employers/activatedDeactivateFLJobPost/'.$key['fljobId'].'/1'.'active' ?>">
                                                    <span data-toggle="tooltip" title="Reopen this post!" class="glyphicon glyphicon-ok-sign" data-placement="top">
                                                    </span>
                                                </a>
                                                <a href="<?= BASEURL . 'employers/updateFLJobPostStatus/'.$key['fljobId'].'/1' ?>">
                                                    <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Post" data-placement="top">
                                                    </span>
                                                </a>
                                         <?php }elseif($key['is_approved'] == '3'){ ?>
                                                <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/freelancejobPreview/'.$key['fljobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                    <i class="glyphicon glyphicon-list-alt"></i>
                                                </a> 
                                                <a href="<?= BASEURL . 'employers/updateFLJobPostStatus/'.$key['fljobId'].'/1' ?>">
                                                    <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Post" data-placement="top">
                                                    </span>
                                                </a>
                                        <?php } ?>

                                    </td>
                                </tr>
                                <?php $ctr++; ?>
                            <?php } ?>
                        <?php } else { ?>
                                <tr>
                                    <td colspan="9" style="text-align:center"><span class="help-block"><?= lang('cashier.32'); ?></span></td>
                                </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-og">
            <div class="panel-heading text-uppercase">POSTED ARTICLES</div>
            <div class="panel-body">
                <div class="media">
                    <div class="media-body">
                        <h4 class="media-heading page-header text-uppercase">Profile Total Views</h4>
                        <div style="font-size: 14px; color: #305e04; margin-bottom: 5px;"><strong>10</strong></div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading page-header text-uppercase">Post Total View</h4>
                        <div style="font-size: 14px; color: #305e04; margin-bottom: 5px;"><strong>10</strong></div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading page-header text-uppercase">Post Total Like</h4>
                        <div style="font-size: 14px; color: #305e04; margin-bottom: 5px;"><strong>10</strong></div>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading page-header text-uppercase">Total Follower</h4>
                        <div style="font-size: 14px; color: #305e04; margin-bottom: 5px;"><strong>10</strong></div>
                    </div>
                    <div class="media-right media-top">
                        <img class="media-object" src="<?= IMAGEPATH.'/home/jackpot.png' ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</div>

<script type="text/javascript">
    // $(document).ready(function(){       
    //     flJobList(0);
    // });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        <?php if($fljobs){ ?>
        $('#flJobsTable').DataTable( {
            "responsive": {
                details: {
                    type: 'column'
                }
            },
            "columnDefs": [ {
                className: 'control',
                orderable: false,
                targets:   0
            } ],
            "order": [ 1, 'asc' ]
        } );
        <?php } ?>
    });

</script>