<script type="text/javascript" src="<?= JSPATH ?>home/employer.js"></script>
<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-12">
    <div class="col-lg-8" style="align:center">
        
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
                FREELANCE JOB LIST
            </div>

            <div class="panel-body" style="border-top: 3px solid #366903;">
                <div id="fljobs_table" class="table-responsive">
                    <table class="table table-striped table-hover table-condensed">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Project Name</th>                            
                                <th>Job Order ID</th>
                                <th>Posted On</th>            
                                <th>Applicant Count</th>
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
                                        <td><a href="<?= BASEURL . 'employers/activeFreelanceJobDetails/'.$key['fljobId'] ?>"><?= strtoupper($key['project_name']) ?></a>
                                        </td>
                                        <td><?= $key['joborderid'] ?>
                                        </td>
                                        <td>
                                            <?php echo mdate('%M %d, %Y',strtotime($key['created_on'])) ?>
                                         </td>
                                        <td>

                                        </td>
                                        <td>

                                        </td>                                        
                                    </tr>
                                    <?php $ctr++; ?>
                                <?php } ?>
                            <?php } else { ?>
                                    <tr>
                                        <td colspan="8" style="text-align:center"><span class="help-block"><?= lang('cashier.32'); ?></span></td>
                                    </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
    
</script>