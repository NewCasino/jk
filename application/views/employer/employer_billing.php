<div class="row">
    <div class="col-lg-12">
     <div class="col-lg-12">
        <div class="panel panel-og">
            <div class="panel-heading">
                <?= strtoupper($billingType) ?> BILLING LIST

                <div class="btn-group pull-right">
                  <button type="button btn-md" class="btn btn-xs btn-info btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    Bill Type </strong> <span class="caret"></span>
                  </button>
                  &nbsp;
                  <ul class="dropdown-menu" role="menu">
                    <li><a href="<?= BASEURL . 'employers/employerBilling/1' ?>"><?= ' Paid'; ?></span></a></li>
                    <li><a href="<?= BASEURL . 'employers/employerBilling/0' ?>"><?= ' Unpaid '; ?></span></a></li>
                    <li class="divider"></li>
                  </ul>
                </div>
            </div>
            <div class="panel-body" style="border-top: 3px solid #366903;">
                <div id="jobs_table" class="table-responsive">
                    <table class="table table-striped table-hover" style="margin: 0px 0 0 0; width: 100%;" id="billingTable">
                        <thead>
                            <tr>
                                <th></th>
                                <th>#</th>
                                <th>Job Title</th>
                                <th>Job Order ID</th>
                                <th>Requested On</th>
                                <th>Promo</th>
                                <th>Total Amount</th>
                                <th>Payment Status</th>
                                <?php if($billingType == 'unpaid'){ ?>
                                <th>Action</th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                             <?php $ctr = 1; ?>
                                    <?php //var_dump($jobInfodetails[0]['freelancejobApplicants']);
                                        if(!empty($billing)) {  ?>
                                        <?php foreach ($billing as $key) { ?>    
                                            <tr>
                                                <td></td>
                                                <td><?= $ctr ?></td>
                                                <td><?= $key['job_title']; ?></td>
                                                <td><?= $key['joborderid']; ?></td>
                                                <td><?= $key['created_on']; ?></td>
                                                <td>
                                                    <ul>
                                                    <?php if(!empty($key['promo'])){
                                                        foreach ($key['promo'] as $promo) { ?>
                                                         <li><?= $promo['promo_type']; ?></li>   
                                                    
                                                    <?php } 
                                                        }?>
                                                    </ul>
                                                </td>
                                                <td>
                                                    <?php if(!empty($key['jobBill'])){
                                                        $totalJobBill = 0;
                                                        foreach ($key['jobBill'] as $jobBill) { 
                                                            $totalJobBill += intval($jobBill['total']);                                                    
                                                         } 
                                                        }?>
                                                    <?= $totalJobBill; ?>
                                                </td>
                                                <td>
                                                    <?= $key['status'] == 0 ? 'request' : 'approved' ?>
                                                </td>
                                                <?php if($billingType == 'unpaid'){ ?>
                                                <td>
                                                    <a href='<?= BASEURL. 'employers/paymentUpload/'.$key['job_id'] ?>' class="btn btn-info btn-xs">Upload Payment</a>
                                                </td>
                                                <?php } ?>
                                            </tr>
                                        <?php $ctr++; ?>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                    <div class="col-md-12 col-offset-0">
                        <ul class="pagination pagination-sm" style="margin: 0; padding: 0;"> <?php echo $this->pagination->create_links(); ?> </ul>
                    </div>
                </div>
            </div>
        </div>
      </div>    
    </div>    
</div>
<script type="text/javascript">
    $(document).ready(function(){
        <?php if($billing){ ?>
        $('#billingTable').DataTable( {
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