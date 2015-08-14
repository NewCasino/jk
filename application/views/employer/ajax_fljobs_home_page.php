<table class="table table-striped table-hover table-condensed">
    <thead>
        <tr>
            <th colspan="8" style="text-align:center; font-size:17px;"><?= $fljobTitleSort ?> </th>
        </tr>
        <tr>
            <th>#</th>
            <th>Project Name</th>                            
            <th>Job Order ID</th>
            <th>Posted On</th>            
            <th>Promo Status</th>
            <th>Post Status</th>
            <?php if($fljobType == 1){ ?>
                <th>Applicant Count</th>    
            <?php } ?>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php //var_dump($fljobs);
            $ctr = 1; ?>
        <?php if(!empty($fljobs)) {  ?>
            <?php foreach ($fljobs as $key) { ?>
                <tr>
                    <td><?= $ctr ?></td>
                    <td>
                        <!-- <a href="<?= BASEURL . 'employers/postFreelanceJob/5/'.$key['fljobId'] ?>"><?= strtoupper($key['project_name']) ?></a> -->
                        <a href="javascript:void(0);" data-toggle="tooltip" title="Job Preview" data-placement="top" onclick="window.open('<?= BASEURL . 'employers/freelancejobPreview/'.$key['fljobId']?>', '_blank', 'width=1030,height=685,scrollbars=yes,status=yes,resizable=no,screenx=0,screeny=0');" >
                        <?= strtoupper($key['project_name']) ?></a>
                    </td>
                    <td><?= $key['joborderid'] ?>
                    </td>
                    <td>
                        <?php echo mdate('%M %d, %Y',strtotime($key['created_on'])) ?>
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
                            <?php if($key['is_approved'] == 0){//under review ?>
                                Under Review
                            <?php }elseif($key['is_approved'] == 1){//active ?>
                                Active
                            <?php }elseif($key['is_approved'] == 2){//deactivated ?>
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
<div class="col-md-12 col-offset-0">
    <ul class="pagination pagination-sm" style="margin: 0; padding: 0;"> <?php echo $this->pagination->create_links(); ?> </ul>
</div>