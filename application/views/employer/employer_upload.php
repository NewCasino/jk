<script type="text/javascript">
	function setURLEditBannerCms(input,imageName) {
		var val = imageName;
	    var res = val.split("\\");
	    //console.log("res:"+res);
	    document.getElementById('logo_url').value = base_url + 'resources/images/logo/' + res;

	    if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {
	            console.log(e.target.result);
	            $('#editBannerCmsImg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
</script>
<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			Step 1 - <a href="<?= BASEURL . 'employers/employerProfile'?>" >Employer Details</a> / <b>Step 2 - Upload</b> / Step 3 - Finalized
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<div class="row">
	<div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="panel panel-default" style="overflow: auto">
	        	<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> UPLOAD COMPANY LOGO</h4>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body">
					<form action="<?= BASEURL . 'employers/editEmpLogo' ?>" method="post" role="form" id="form-editcmspromo"  accept-charset="utf-8" enctype="multipart/form-data">
						<?php //echo $this->tinyMce;?>
												
						<!-- <div class="col-md-12">			
								<img id="editBannerCmsImg" src="" style="align: left; valign= middle; width: 150px; height: 150px; margin: 0 1px 0 0; display:block;"/>
								<br/>					
								<strong>Upload</strong>
                              	<input type="hidden" name="banner_url" id="banner_url" class="form-control" readonly>
                                <input type="file" id="userfile" name="userfile" class="form-control input-sm" onchange="setURL(this.value);" value="<?= set_value('userfile'); ?>" required>
                                <br /><br />
						</div> -->

						<div class="col-md-12">
                          	<h6><label for="editBannerCmsImg">Upload Logo: </label></h6>
                          	<?php 
                          		if(!empty($empLogo['mediaName'])){ ?>
                          		<img id="editBannerCmsImg" src="<?php echo BASEURL.'resources/images/comp_logo/'.$empLogo['mediaName'] ?>" style="align: left; valign= middle; width: 150px; height: 150px; margin: 0 1px 0 0; display:block;"/>
                          	<?php }else{ ?>
                          		<img id="editBannerCmsImg" src="<?php echo BASEURL.'resources/images/comp_logo/default.jpg' ?>" style="align: left; valign= middle; width: 150px; height: 150px; margin: 0 1px 0 0; display:block;"/>
                          	<?php } ?>
                            <br/>
                            <input type="hidden" name="editBannerCms" id="editBannerCms" >
                          	<input type="hidden" name="logo_url" id="logo_url" class="form-control" readonly>
                            <input type="file" name="userfile" id="userfile" class="form-control" onchange="setURLEditBannerCms(this,this.value);" value="<?= set_value('editEmpLogo'); ?>" required>
                            <br/><br/><hr/>
                        </div>

						<div class="col-md-3"></div>
						<div class="col-md-3">
								<a href="<?= BASEURL . 'employers/employerFinalized'?>" class="btn btn-block btn-md btn-danger" >Skip >></a>
								<br />
						</div>	
		                <div class="col-md-3">
								<input type="submit" value="Next" class="btn btn-block btn-md btn-info" />
								<br />
						</div>	
						<div class="col-md-3"></div>				
					</form>
				</div>				
		</div>
	</div>
	<div class="col-lg-2"></div>
</div> <!-- main -->