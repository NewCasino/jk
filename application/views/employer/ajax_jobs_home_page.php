<table class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th colspan="8" style="text-align:center; font-size:17px;"><?= $jobTitleSort ?> </th>
                            </tr>
                            <tr>
                                <th>#</th>
                                <th>Job Title</th>
                                <th>Recruitment Duration</th>  
                                <th>Days Left</th>                       
                                <th>Posted On</th>
                                <th>Expiration</th>
                                <th>Promo</th>
                                <th>Job Status</th>
                                <?php if($fljobType == 1){ ?>
                                    <th>Applicant Count</th>
                                <?php } ?>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $ctr = 1; ?>
                            <?php if(!empty($jobs)) {  ?>
                                <?php foreach ($jobs as $key) { ?>
                                    <tr>
                                        <td><?= $ctr ?></td>
                                        <td>
                                            <?php if($key['active'] == 1){//under review ?>
                                                <a href="<?= BASEURL.'employers/jobDetails/'.$key['jobId'] ?>" data-toggle="tooltip" title="Show Details"><?= strtoupper($key['job_title']) ?></a>
                                            <?php }else{ ?>
                                                <?= strtoupper($key['job_title']) ?>
                                            <?php } ?>                                            
                                        </td>

                                        <td><?php   $date_array = explode(',', timespan($key['created_on'], time()));  
                                                 $date = $date_array[0] . ' ago ';   
                                                //echo $date;
                                                                                                                                                                                                                        
                                                echo $this->ci_date->get_num_work_days(mdate('%M %d, %Y',strtotime($key['date_posted'])),mdate('%M %d, %Y',strtotime($key['date_expiry']))).' working day/s';
                                                //echo date($data['date_posted'],'m-d-Y');  
                                                //echo $data['date_posted'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php   $date_array = explode(',', timespan($key['created_on'], time()));  
                                                     $date = $date_array[0] . ' ago ';   
                                                    //echo $date;
                                                    //echo mdate('%M %d, %Y');
                                                    //var_dump($date_array);
                                                    
                                                    if(mdate('%M %d, %Y') >= mdate('%M %d, %Y',strtotime($key['date_posted']))){
                                                        echo $this->ci_date->get_num_work_days(mdate('%M %d, %Y'),mdate('%M %d, %Y',strtotime($key['date_expiry']))).' working day/s';                                                                                                                                                                 
                                                    }
                                                    else{
                                                        echo 'Did not start yet';
                                                    }                                                                                                                           
                                            ?>
                                        </td> 
                                        <td>
                                            <?php echo mdate('%M %d, %Y',strtotime($key['date_posted'])) ?>
                                         </td>
                                                                                    
                                        <td><? //=anchor('job/emp_jobs/deactivate_job/'.$data['id'], 'Deactivate')?>
                                            <?php echo mdate('%M %d, %Y',strtotime($key['date_expiry'])) ?>
                                        </td>
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
                                        <?php if($fljobType == 1){ ?>
                                            <td>
                                            </td>
                                        <?php } ?>
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
                                    <tr>
                                        <td colspan="10" style="text-align:center"><span class="help-block"><?= lang('cashier.32'); ?></span></td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="col-md-12 col-offset-0">
                        <ul class="pagination pagination-sm" style="margin: 0; padding: 0;"> <?php echo $this->pagination->create_links(); ?> </ul>
                    </div>