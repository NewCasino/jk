<script type="text/javascript" src="<?= JSPATH ?>home/employer.js"></script>
<div class="row">
    <div class="col-lg-12">
        <!-- <div class="well" style="overflow: auto"> -->
                    <!-- start dashboard notification -->                    
                    <a class='notificationRefreshList' href="<?= BASEURL.'employers/jobDetails/'.$jobInfodetails[0]['fljobId'].'/0/2' ?>">
                        <div class="col-sm-2 col-md-2 col-lg-2 notificationDashboardInner hover-shadow <?= $this->session->userdata('freelancejobApplicantCurrentPage') == 0 ? 'notDboard-active' : ''?>" >
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-request-deposit"><?= count($applicantCnt) ?></span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-request-deposit">NEW APPLICANT</span>
                        </div>
                    </a>
                    
                    <a class='notificationRefreshList' href="<?= BASEURL.'employers/jobDetails/'.$jobInfodetails[0]['fljobId'].'/1/2' ?>">
                        <div class="col-sm-2 col-md-2 col-lg-2 notificationDashboardInner hover-shadow  <?= $this->session->userdata('freelancejobApplicantCurrentPage') == 1 ? 'notDboard-active' : ''?>" >
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-declined-deposit"><?= count($shortlistedCnt) ?></span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-declined-deposit">SHORTLIST</span>
                        </div>
                    </a>

                    <a class='notificationRefreshList' href="<?= BASEURL.'employers/jobDetails/'.$jobInfodetails[0]['fljobId'].'/2/2' ?>">
                        <div class="col-sm-2 col-md-2 col-lg-2 notificationDashboardInner hover-shadow  <?= $this->session->userdata('freelancejobApplicantCurrentPage') == 2 ? 'notDboard-active' : ''?>" >
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-approved-deposit"><?= count($forInterviewCnt) ?></span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-approved-deposit">FOR INTERVIEW</span>
                        </div>
                    </a>

                    <a class='notificationRefreshList' href="<?= BASEURL.'employers/jobDetails/'.$jobInfodetails[0]['fljobId'].'/3/2' ?>">
                        <div class="col-sm-2 col-md-2 col-lg-2 notificationDashboardInner hover-shadow  <?= $this->session->userdata('freelancejobApplicantCurrentPage') == 3 ? 'notDboard-active' : ''?>" >
                            TOTAL<br/><span class="notificationDashboardTxt" id="notificationDashboard-approved-deposit"><?= count($unqualifiedCnt) ?></span><br/>
                            <span class="notificationDashboardLabel" id="notificationDashboard-approved-deposit">ASSESSED</span>
                        </div>
                    </a>                            
        <!-- </div> -->
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
        <div class="panel panel-og">
            <div class="panel-heading">
                <?= strtoupper($jobInfodetails[0]['project_name']); ?>
            </div>

            <div class="panel-body" style="border-top: 3px solid #366903;">
                <div id="jobs_table" class="table-responsive">
                         <table class="table table-striped table-hover" style="margin: 0px 0 0 0; width: 100%;" id='applicantTable'>
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>#</th>
                                    <th>Applicant Name</th>
                                    <th>Applied On</th>
                                    <?php if($status < 3){ ?>  
                                        <th>Action</th>
                                    <?php }else{ ?>
                                        <th>Assessment</th>
                                    <?php } ?>                                    
                                </tr>
                            </thead>
                            <tbody>
                                 <?php $ctr = 1; ?>
                                    <?php //var_dump($jobInfodetails[0]['freelancejobApplicants']);
                                        if(!empty($jobInfodetails[0]['freelancejobApplicants'])) {  ?>
                                        <?php foreach ($jobInfodetails[0]['freelancejobApplicants'] as $key) { ?>    
                                            <tr>
                                                <td></td>
                                                <td><?= $ctr ?></td>
                                                <td><?= strtoupper($key['firstName'].' '.$key['lastName']) ?></td>
                                                <td><?= $key['applied_on'] ?></td>
                                                <td>
                                                    <?php if($status == 0){//apply ?>
                                                            <a href="<?= BASEURL.'employers/assessFJApplicant/1/'.$key['fljobId'].'/'.$key['applicantId'] ?>" class="btn btn-success btn-xs">Shortlist</a>
                                                            <a href="<?= BASEURL.'employers/assessFJApplicant/2/'.$key['fljobId'].'/'.$key['applicantId'] ?>" class="btn btn-primary btn-xs">Set Interview</a>
                                                            <a href="<?= BASEURL.'employers/assessFJApplicant/3/'.$key['fljobId'].'/'.$key['applicantId'] ?>" class="btn btn-danger btn-xs">Unqualified</a>
                                                    <?php }elseif($status == 1){//shortlisted ?>
                                                            <a href="<?= BASEURL.'employers/assessFJApplicant/2/'.$key['fljobId'].'/'.$key['applicantId'].'/1' ?>" class="btn btn-primary btn-xs">Set Interview</a>
                                                    <?php }elseif($status == 2){//interview ?>
                                                            <a href="<?= BASEURL.'employers/assessFJApplicant/4/'.$key['fljobId'].'/'.$key['applicantId'] ?>" class="btn btn-success btn-xs">Hired</a>
                                                            <a href="<?= BASEURL.'employers/assessFJApplicant/5/'.$key['fljobId'].'/'.$key['applicantId'] ?>" class="btn btn-danger btn-xs">Failed</a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php $ctr++; ?>
                                <?php } ?>
                            <?php } ?>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('#applicantTable').DataTable( {
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