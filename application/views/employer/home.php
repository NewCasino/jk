<script type="text/javascript" src="<?= JSPATH ?>home/employer.js"></script>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="col-sm-8 col-md-8 col-lg-8" style="align:center">
        <div class="col-sm-12 col-md-12 col-lg-12">
                    <!-- start dashboard notification -->                    
                    <a class='notificationRefreshList' href="<?= BASEURL . 'employers/sortJobBy/1' ?>">
                        <div class="col-md-2 col-sm-2 col-lg-2 notificationDashboard hover-shadow <?= $this->session->userdata('currentEmpPage') == 'joblist' ? 'notDboard-active' : ''?>" id="notificationDashboard-request-deposit">
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-joblist"><?= $activeJobs['cnt'] ?></span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-joblist">ACTIVE JOB POST</span>
                        </div>
                    </a>

                    <a class='notificationRefreshList' href="<?= BASEURL . 'employers/sortFLJobBy/1' ?>">
                        <div class="col-md-2 col-sm-2  col-lg-2 notificationDashboard hover-shadow <?= $this->session->userdata('currentEmpPage') == 'freelancejoblist' ? 'notDboard-active' : ''?>" id="notificationDashboard-request-deposit">
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-freelancejoblist"><?= $activeFLJobs['cnt'] ?></span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-freelancejoblist">ACTIVE FREELANCE JOB</span>
                        </div>
                    </a>

                    <a class='notificationRefreshList' href="<?= BASEURL . 'payment_management/refreshList/depositApproved' ?>">
                        <div class="col-md-2 col-sm-2  col-lg-2 notificationDashboard hover-shadow <?= $this->session->userdata('currentEmpPage') == 'saveresume' ? 'notDboard-active' : ''?>" id="notificationDashboard-approved-deposit">
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-savedresume">12</span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-savedresume">SAVED RESUME</span>
                        </div>
                    </a>
                    <a class='notificationRefreshList' href="<?= BASEURL . 'payment_management/refreshList/depositDeclined' ?>">
                        <div class="col-md-2 col-sm-2  col-lg-2 notificationDashboard hover-shadow <?= $this->session->userdata('currentEmpPage') == 'shortlisted' ? 'notDboard-active' : ''?>" id="notificationDashboard-declined-deposit">
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
                <?= $jobTitleSort ?>
                <a href="<?= BASEURL . 'employers/postNewJob' ?>" class="btn btn-xs btn-success pull-right"><i class="glyphicon glyphicon-plus-sign"></i> POST NEW JOB</a>
                <div class="btn-group pull-right">
                  <button type="button btn-sm" class="btn btn-xs btn-info btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    TOTAL JOB POST [<strong> <?= $activeJobs['cnt']+$inactiveJobs['cnt']+$expiredJobs['cnt']+$underReviewJobs['cnt'] ?> </strong>] <span class="caret"></span>
                  </button>
                  &nbsp;
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?= BASEURL . 'employers/sortJobBy/1' ?>"><?= ' Active <strong>[ '.$activeJobs['cnt'].' ]</strong>'; ?></span></a></li>
                    <li><a href="<?= BASEURL . 'employers/sortJobBy/2' ?>"><?= ' Inactive <strong>[ '.$inactiveJobs['cnt'].' ]</strong>'; ?></span></a></li>
                    <li><a href="<?= BASEURL . 'employers/sortJobBy/3' ?>"><?= ' Expired <strong>[ '.$expiredJobs['cnt'].' ]</strong>'; ?></span></a></li>
                    <li><a href="<?= BASEURL . 'employers/sortJobBy/0' ?>"><?= ' Under Review <strong>[ '.$underReviewJobs['cnt'].' ]</strong>'; ?></span></a></li>
                    <li class="divider"></li>
                  </ul>
                </div>
            </div>

            <div class="panel-body" style="border-top: 3px solid #366903;">
                <div id="jobs_table" class="table-responsive">
                    <table class="table table-striped table-hover" style="margin: 0px 0 0 0; width: 100%;" id='jobsTable'>
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Job Title</th>
                                <th>Job Order Id</th>
                                <!-- <th>Recruitment Duration</th>  
                                <th>Days Left</th> -->                       
                                <th>Posted On</th>
                                <?php if($fljobType == 1){ ?>
                                    <th>New Applicant</th>
                                    <th>Shortlist</th>
                                    <th>For Interview</th>                                    
                                <?php } ?>
                                <th>Promo</th>
                                <th>Job Status</th>
                                <th>Expiration</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $ctr = 1; ?>
                            <?php 
                                if(!empty($alljobs)) {  ?>
                                <?php foreach ($alljobs as $key) { ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $ctr ?></td>
                                        <td>
                                            <?php if($key['active'] == 1){//under review ?>
                                                <a href="<?= BASEURL.'employers/jobDetails/'.$key['jobId'].'/0/1' ?>" data-toggle="tooltip" title="Show Applicants"><?= strtoupper($key['job_title']) ?></a>
                                            <?php }else{ ?>
                                                
                                                <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/jobPreview/'.$key['jobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                    <?= strtoupper($key['job_title']) ?>
                                                </a> 
                                            <?php } ?>                                            
                                        </td>
                                        <td>
                                            <?= $key['joborderid'] ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo mdate('%M %d, %Y',strtotime($key['date_posted'])) ?>
                                         </td>
                                                                                    
                                        <?php if($fljobType == 1){ ?>
                                            <td>
                                                <?php 
                                                    if(count($key['applicantCnt'])!=0){ ?>
                                                        <a href='<?= BASEURL.'employers/jobDetails/'.$key['jobId'].'/0/1' ?>' data-toggle="tooltip" title="Show New Applicant"><?= count($key['applicantCnt']); ?></a>
                                                <?php }else{ ?>
                                                        <?= count($key['applicantCnt']); ?>
                                                <?php }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if(count($key['shortlistCnt'])!=0){ ?>
                                                        <a href='<?= BASEURL.'employers/jobDetails/'.$key['jobId'].'/1/1' ?>' data-toggle="tooltip" title="Show Shortlist Applicant"><?= count($key['shortlistCnt']); ?></a>
                                                <?php }else{ ?>
                                                        <?= count($key['shortlistCnt']); ?>
                                                <?php }
                                                ?>
                                            </td>
                                            <td>
                                                <?php 
                                                    if(count($key['forInterviewCnt'])!=0){ ?>
                                                        <a href='<?= BASEURL.'employers/jobDetails/'.$key['jobId'].'/2/1' ?>' data-toggle="tooltip" title="Show For Interview Applicant"><?= count($key['forInterviewCnt']); ?></a>
                                                <?php }else{ ?>
                                                        <?= count($key['forInterviewCnt']); ?>
                                                <?php }
                                                ?>
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
                                                <?php if($key['active'] == 0){//under review ?>
                                                    Under Review
                                                <?php }elseif($key['active'] == 1){//active ?>
                                                    Active
                                                <?php }elseif($key['active'] == 2){//deactivated ?>
                                                    Deactivated
                                                <?php }else{ ?>
                                                    Expired
                                                <?php } ?>                                           
                                        </td>
                                        
                                        <td><? //=anchor('job/emp_jobs/deactivate_job/'.$data['id'], 'Deactivate')?>
                                            <?php echo mdate('%M %d, %Y',strtotime($key['date_expiry'])) ?>
                                        </td>
                                        <td>
                                            <?php if($key['active'] == 0){//expired ?>
                                                <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/jobPreview/'.$key['jobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                    <i class="glyphicon glyphicon-list-alt"></i>
                                                </a> 
                                                
                                                <a href="<?= BASEURL . 'employers/postJob/5/'.$key['jobId'] ?>">
                                                    <span class="glyphicon glyphicon-edit" data-toggle="tooltip" title="Edit Job Post" data-placement="top">
                                                    </span>  
                                                </a>
                                               
                                                <a href="">
                                                    <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Job Post" data-placement="top">
                                                    </span>
                                                </a>
                                             <?php }elseif($key['active'] == '1'){ ?>
                                                    <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/jobPreview/'.$key['jobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                        <i class="glyphicon glyphicon-list-alt"></i>
                                                    </a>                                                               
                                                    <a href="<?= BASEURL . 'employers/activatedDeactivateJobPost/'.$key['jobId'].'/2' ?>">
                                                        <span data-toggle="tooltip" title="Deactivate" class="glyphicon glyphicon-remove-circle" data-placement="top">
                                                        </span>
                                                    </a>
                                                    <a href="">
                                                        <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Job Post" data-placement="top">
                                                        </span>
                                                    </a>
                                            <?php }elseif($key['active'] == '2'){ ?>
                                                    <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/jobPreview/'.$key['jobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                        <i class="glyphicon glyphicon-list-alt"></i>
                                                    </a>
                                                    <a href="<?= BASEURL . 'employers/activatedDeactivateJobPost/'.$key['jobId'].'/1' ?>">
                                                        <span data-toggle="tooltip" title="Activate" class="glyphicon glyphicon-ok-sign" data-placement="top">
                                                        </span>
                                                    </a>
                                                    <a href="">
                                                        <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Job Post" data-placement="top">
                                                        </span>
                                                    </a>
                                             <?php }elseif($key['active'] == '3'){ ?>
                                                    <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/jobPreview/'.$key['jobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                                                        <i class="glyphicon glyphicon-list-alt"></i>
                                                    </a> 
                                                    <a href="">
                                                        <span class="glyphicon glyphicon-trash" data-toggle="tooltip" title="Delete Job Post" data-placement="top">
                                                        </span>
                                                    </a>
                                            <?php } ?>

                                        </td>
                                    </tr>
                                    <?php $ctr++; ?>
                                <?php } ?>
                            <?php } else { ?>
                                    <!-- <tr>
                                        <td colspan="10" style="text-align:center"><span class="help-block"><?= lang('cashier.32'); ?></span></td>
                                    </tr> -->
                            <?php } ?>
                        </tbody>
                    </table>
                    <!-- <div class="col-md-12 col-offset-0">
                        <ul class="pagination pagination-sm" style="margin: 0; padding: 0;"> <?php echo $this->pagination->create_links(); ?> </ul>
                    </div> -->
                </div>
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
    $(document).ready(function(){
        $('#jobsTable').DataTable( {
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
    });

</script>