<div class="row">
    <div class="col-lg-12">
     <div class="col-lg-12">
        <div class="panel panel-og">
            <div class="panel-heading">
                Payment Details (Please complete the form below and upload your deposit slip.)
            </div>
            <form  class="form-horizontal" action="<?= BASEURL . 'employers/submitPaymentUpload/'.$jobId ?>" method="post" enctype="multipart/form-data">
                <div class="panel-body" style="border-top: 3px solid #366903; background-color:#f1f0f0;">
                    
                    <div class="col-sm-12 col-md-12 col-lg-10">
                        <center>
                            <table class="table borderless">
                                <tr>
                                    <td style="text-align:right; border-top: none !important;">Account Type&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="border-top: none !important;">
                                        <select class="form-control" name="bankaccount" required>
                                            <option value="">Select Bank</option>        
                                            <option value="1" <?= $this->session->userdata('bankaccount')==1 ? 'selected' : '' ?>>BPI - Asrii</option>
                                            <option value="2" <?= $this->session->userdata('bankaccount')==2 ? 'selected' : '' ?>>EASTWEST - Asrii</option>
                                            <option value="3" <?= $this->session->userdata('bankaccount')==3 ? 'selected' : '' ?>>BDO - Asrii</option>
                                            <option value="4" <?= $this->session->userdata('bankaccount')==4 ? 'selected' : '' ?>>CHINABANK - Asrii</option>
                                            <option value="5" <?= $this->session->userdata('bankaccount')==5 ? 'selected' : '' ?>>METROBANK - Asrii</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="text-align:right; border-top: none !important;">Deposit Amount&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="border-top: none !important;">
                                        <input type="number" min="1" class="form-control" name="depositAmount" value="<?= $this->session->userdata('depositAmount') ?>" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="text-align:right; border-top: none !important;">Deposit Date & Time&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="border-top: none !important;">
                                        <input type="datetime-local" min="1" class="form-control" name="depositDateTime" required value="<?= $this->session->userdata('depositDateTime') ?>">
                                        
                                    </td>
                                </tr>

                                <tr>
                                    <td style="text-align:right; border-top: none !important;">Transaction Reference #&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="border-top: none !important;">
                                        <input type="number" min="1" class="form-control" name="depositTransactionRef" value="<?= $this->session->userdata('depositTransRefNo') ?>">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="text-align:right; border-top: none !important;">Upload Bank Deposit Slip (.jpg/.jpeg/.gif/.png)&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="border-top: none !important;">
                                        <input type="hidden" name="depositJobId" id="jobId" value="<?= $jobId ?>">
                                        <input type="hidden" name="paymentIp" id="paymentIp" value="<?= $this->input->ip_address(); ?>">
                                        <input type="file" name="userfile" id="userfile" class="form-control" size="50" onchange="setURL(this.value);" value="<?= set_value('userfile'); ?>" required>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border-top: none !important;">
                                    </td>
                                    <td colspan="2" style="text-align:left; border-top: none !important;">
                                        <label>Add your contact information for confirmation.</label>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right; border-top: none !important;">Name&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="border-top: none !important;">
                                        <input type="text" class="form-control" name="contactName" value="<?= $this->session->userdata('contactName') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right; border-top: none !important;">Contact # (CP/Landline)&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="border-top: none !important;">
                                        <input type="number" class="form-control" name="contactNo" value="<?= $this->session->userdata('contactNo') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:right; border-top: none !important;">Email&nbsp;&nbsp;&nbsp;
                                    </td>
                                    <td style="border-top: none !important;">
                                        <input type="email" class="form-control" name="contactEmail" value="<?= $this->session->userdata('contactEmail') ?>">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="border-top: none !important;">
                                    </td>
                                    <td style="border-top: none !important; text-align:center">
                                        <input type="submit" value="Send" class="form-control btn btn-primary" style="width:50%">
                                    </td>
                                </tr>
                            </table>
                        </center>
                    </div>
                    
                </div>
            </form>
        </div>
      </div>    
    </div>    
</div>
<script type="text/javascript">
    function setURL(value) {
        var val = value;
        var res = val.split("\\");
        console.log('res: '+res);

        document.getElementById('banner_url').value = base_url + 'resources/images/depositslip/' + res[2];
    }
</script>
