<!-- Latest compiled and minified CSS -->

<script type="text/javascript">
	function setURLEditBannerCms(input,imageName) {
		var val = imageName;
	    var res = val.split("\\");
	    //console.log("res:"+res);
	    document.getElementById('doc_url').value = base_url + 'resources/docs/freelancejob/' + res;

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

<link rel="stylesheet" href="http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="http://code.jquery.com/jquery-1.10.2.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script>
  $(function() {
    var availableTags = [
      "ActionScript","AppleScript","Asp","BASIC","C","C++","Clojure","COBOL","ColdFusion","Erlang",
      "Fortran","Groovy","Haskell","Java","JavaScript","Lisp","Perl","PHP","Python","Ruby","Scala",
      "Scheme",
      "Analytics","Applications","Application Development","Attention to Detail","Architecture","Business Analytics",
      "Business Intelligence","Business Process Modeling","Cloud","Code","Coding","Communication","Configuration",
      "Customer Support","Database","Data Analysis","Data Analytics","Data Intelligence","Data Mining","Data Science",
      "Data Strategy","Data Storage","Design","Desktop Support","Developer","Development","Documentation",
      "Emerging Technologies","File Systems","Flexibility","Hardware","Help Desk","Implementation","Internet",
      "Information Systems","Installation","Integrated Technologies","IT Optimization","IT Security","IT Solutions",
      "IT Support","Languages","Leadership","Linux","Maintenance","Management","Messaging","Methodology","Metrics",
      "Microsoft Office","Mobile Applications","Motivation","Networks","Network Operations","Networking",
      "Operating Systems","Operations","Organization","Presentation","Programming","Problem Solving","Product Development",
      "Product Support","Product Management","Product Training","Project Management","Repairs","Reporting","Security",
      "Self Motivated","Self Starting","Servers","Software","Software Development","Storage","Support","Systems Software",
      "Team Oriented","Teamwork","Technology","Technical Services","Technical Support","Technical Writing",
      "Web","Web Development","Work Independently",
      "Adobe Illustrator","Adobe InDesign","Adobe Photoshop","Analytics","Android","APIs","Art Design","AutoCAD",
      "Backup Management","Certifications","C#",".NET","Client Server","Client Support","Configuration","Content Management Systems",
      "Corel Draw","Corel Word Perfec","CSS","Data Analytics","Desktop Publishing","Diagnostics","End User Support",
      "Email","Engineering","Excel","FileMaker Pro","Graphic Design","Hardware","HTML","iOS","iPhone","Java","Mac",
      "Matlab","Maya","Microsoft Office","Microsoft Visual","MySQL","Open Source","Oracle","Presentations","Processing",
      "PT Modeler","Quick Books Pro","Ruby","Shade","Spreadsheet","Systems Administration","Troubleshooting","Unix",
      "Web Page Design","Windows","XML","XHTML","HTML5","Boostrap","JavaScript Framework","jquery","PHP Unit","Laravel",
      "PHP Framework","MVC","OOP","Scrum","Agile","QA","Testing","Mathematician","Android Platform Expert","Critical Thinking",
      "Git and Github","Node.js","Team Player","Test and Debug Code","Algorithms","Analysis","Analytics","Architecture",
      "Browsers","Collaboration","","","","","","","","","","","","","","","","","","","","","",
    ];
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#skills" )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  });
  </script>
<div class="row">
	<div class="col-lg-2"></div>
	<div class="col-lg-8">
		<div class="well" style="overflow: auto">
			<b>Step 1 - Project Summary </b> / Step 2 - Project Review / Step 3 - Finalized
		</div>
	</div>
	<div class="col-lg-2"></div>
</div>
<!-- <form method="post" action="<?= BASEURL . 'employers/postNewFreelanceJob'?>" role="form" class="form-inline" name="form"> -->
<form action="<?= BASEURL . 'employers/postNewFreelanceJob' ?>" method="post" role="form" id="form-editcmspromo"  accept-charset="utf-8" enctype="multipart/form-data">
<div class="row">
	<div class="col-lg-2"></div>
    <div class="col-lg-8">
        <div class="panel panel-default" style="overflow: auto">
	        	<div class="panel-heading">
	                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> EDIT PROJECT SUMMARY</h4>
	                <div class="pull-right">
	            		<a href="#main" style="color: white;" id="button_list_toggle4" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up4"></i></a>
	            	</div>
	                <div class="clearfix"></div>
	            </div>
	            <div class="panel-body" id="list_panel_body4">						
							<?php //echo $this->tinyMce;
							?>
							<div class="col-md-12">
									<br />
									<input id="fljobId" type="hidden" class="form-control" style="width:100%" required name="fljobId" maxlength="64" value="<?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['fljobId'] : '' ?>" />
									<input id="isApproved" type="hidden" class="form-control" style="width:100%" required name="isApproved" maxlength="64" value="<?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['is_approved'] : '' ?>" />
									<label for="project_name"><strong>Project Name</strong> <span class="required">*</span></label>
									<?php echo form_error('project_name'); ?>
									<br /><input id="project_name" type="text" class="form-control" style="width:100%" required name="project_name" maxlength="64" value="<?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['project_name'] : '' ?>" />
									<br />
							</div>

							<div class="col-md-12">
									<br />
									<label for="project_type"><strong>Project Type</strong> <span class="required">*</span></label>
									<?php echo form_error('project_type'); ?>
									<br />
									<select name="project_type" value='<?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['project_type'] : '' ?>' class="form-control" style="width:100%" required>
									  <option value="" <?= $fljobPreview['jobDetails']['project_type'] == '' ? 'selected' : ''?>>Select Project Type</option>
	                                  <option value="1" <?= $fljobPreview['jobDetails']['project_type'] == 1 ? 'selected' : ''?>>Website Application</option>
	                                  <option value="2" <?= $fljobPreview['jobDetails']['project_type'] == 2 ? 'selected' : ''?>>Mobile Application</option>
	                                  <option value="3" <?= $fljobPreview['jobDetails']['project_type'] == 3 ? 'selected' : ''?>>Desktop Application</option>
	                                  <option value="4" <?= $fljobPreview['jobDetails']['project_type'] == 4 ? 'selected' : ''?>>Website Design</option>
	                                  <option value="5" <?= $fljobPreview['jobDetails']['project_type'] == 5 ? 'selected' : ''?>>Mobile Design</option>
	                                  <option value="6" <?= $fljobPreview['jobDetails']['project_type'] == 6 ? 'selected' : ''?>>Desktop Design</option>
	                                  <option value="7" <?= $fljobPreview['jobDetails']['project_type'] == 7 ? 'selected' : ''?>>Content Writing</option>
	                                  <option value="8" <?= $fljobPreview['jobDetails']['project_type'] == 8 ? 'selected' : ''?>>Graphic Artwork</option>
	                                  <option value="9" <?= $fljobPreview['jobDetails']['project_type'] == 9 ? 'selected' : ''?>>Data Entry</option>
	                                  <option value="10" <?= $fljobPreview['jobDetails']['project_type'] == 10 ? 'selected' : ''?>>Database</option>
	                                  <option value="11" <?= $fljobPreview['jobDetails']['project_type'] == 11 ? 'selected' : ''?>>Sales / Marketing</option>
	                                  <option value="12" <?= $fljobPreview['jobDetails']['project_type'] == 12 ? 'selected' : ''?>>Consulting</option>
	                                  <option value="" <?= $fljobPreview['jobDetails']['project_type'] == '' ? 'selected' : ''?>>Others</option>
	                                </select>
									<br />
							</div>
							<div class="col-md-12">
									<br />
									<label for="project_type"><strong>Skills Required (Just type the skills seperated by comma)</strong> <span class="required">*</span></label>
									<?php echo form_error('project_type'); ?>
									<?php $skillsList='';
												if(count($fljobPreview['jobDetails']['skills_req']) > 1){ 
													foreach ($fljobPreview['jobDetails']['skills_req'] as $key) { 
														//echo $key['skills']; 
														$skillsList .= $key['skills'].',';
													}
												}else{
													$skillsList = $fljobPreview['jobDetails']['skills_req'][0]['skills'];													
												} 

											?>
									<input id="skills" class="form-control" name="skills_required" value="<?= $skillsList ?>">
							</div>

							<div class="col-md-12">
								<br />
									<label for="project_overview"><strong>Project Details</strong> <span class="required">*</span></label>
								<?php echo form_error('project_overview'); ?>
								<br />
								<textarea style="width:100%" rows='5' required name='project_overview' class="form-control" id='project_overview'><?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['project_overview'] : '' ?></textarea>
								<br /><br />
							</div>

							<div class="col-md-12">
	                          	<label for="upload_doc"><strong>Upload Document (.pdf/.doc/.docx)</strong></label>
	                            <br/>
	                            <input type="hidden" name="editBannerCms" id="editBannerCms" >
	                          	<input type="hidden" name="doc_url" id="doc_url" class="form-control" readonly>
	                            <input type="file" name="userfile" id="userfile" class="form-control" onchange="setURLEditBannerCms(this,this.value);" value="">
	                            
	                        </div>

				</div>
				<br/>
		</div>

		<div class="row">
			<div class="col-lg-12">
		        <div class="panel panel-default" style="overflow: auto">
			        	<div class="panel-heading">
			                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> PROJECT BUDGET</h4>
			                <div class="pull-right">
			            		<a href="#main" style="color: white;" id="button_list_toggle5" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up5"></i></a>
			            	</div>
			                <div class="clearfix"></div>
			            </div>
			            <div class="panel-body" id="list_panel_body5">
				            <div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
		                                <br/>

		                                <input type="radio" name="payment_type" id="payment_type" value="1" <?= $fljobPreview['jobDetails']['payment_type'] == 1 ? 'checked' : ''?>>
		                                <label for="">Fixed Amount</label>
		                            </div>
		                            <div class="col-md-3">
		                            	<br/>
		                                <input type="radio" name="payment_type" id="payment_type" value="2" <?= $fljobPreview['jobDetails']['payment_type'] == 2 ? 'checked' : ''?>>
		                                <label for="">Per Hour</label>
		                            </div>
		                        </div>
		                        <div class="col-md-12">    
			                        <div class="col-md-2">
											<br />
											<label for="payment_currency"><strong>Currency</strong> <span class="required">*</span></label>
											<?php echo form_error('payment_currency'); ?>
											<br />
											<select id="payment_currency" class='form-control' name='payment_currency' value='<?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['payment_currency'] : '' ?>'>
			                                    <option value="1" title="$" <?= $fljobPreview['jobDetails']['payment_currency'] == '1' ? 'selected' : ''?>>USD</option>
			                                    <option value="3" title="$" <?= $fljobPreview['jobDetails']['payment_currency'] == '3' ? 'selected' : ''?>>AUD</option>
			                                    <option value="9" title="$" <?= $fljobPreview['jobDetails']['payment_currency'] == '9' ? 'selected' : ''?>>CAD</option>
			                                    <option value="8" title="€" <?= $fljobPreview['jobDetails']['payment_currency'] == '8' ? 'selected' : ''?>>EUR</option>
			                                    <option value="4" title="£" <?= $fljobPreview['jobDetails']['payment_currency'] == '4' ? 'selected' : ''?>>GBP</option>
			                                    <option value="5" title="$" <?= $fljobPreview['jobDetails']['payment_currency'] == '6' ? 'selected' : ''?>>HKD</option>
			                                    <option value="11" title="₹" <?= $fljobPreview['jobDetails']['payment_currency'] == '11' ? 'selected' : ''?>>INR</option>
			                                    <option value="13" title="$" <?= $fljobPreview['jobDetails']['payment_currency'] == '13' ? 'selected' : ''?>>CLP</option>
			                                    <option value="12" title="$" <?= $fljobPreview['jobDetails']['payment_currency'] == '12' ? 'selected' : ''?>>JMD</option>
			                                    <option value="15" title="Rp" <?= $fljobPreview['jobDetails']['payment_currency'] == '15' ? 'selected' : ''?>>IDR</option>
			                                    <option value="14" title="$" <?= $fljobPreview['jobDetails']['payment_currency'] == '14' ? 'selected' : ''?>>MXN</option>
			                                    <option value="17" title="kr" <?= $fljobPreview['jobDetails']['payment_currency'] == '17' ? 'selected' : ''?>>SEK</option>
			                                    <option value="18" title="¥" <?= $fljobPreview['jobDetails']['payment_currency'] == '18' ? 'selected' : ''?>>JPY</option>
			                                    <option value="16" title="RM" <?= $fljobPreview['jobDetails']['payment_currency'] == '16' ? 'selected' : ''?>>MYR</option>
			                                    <option value="2" title="$" <?= $fljobPreview['jobDetails']['payment_currency'] == '2' ? 'selected' : ''?>>NZD</option>
			                                    <option value="7" title="₱" <?= $fljobPreview['jobDetails']['payment_currency'] == '7' ? 'selected' : ''?>>PHP</option>
			                                    <option value="19" title="zł" <?= $fljobPreview['jobDetails']['payment_currency'] == '19' ? 'selected' : ''?>>PLN</option>
			                                    <option value="6" title="$" <?= $fljobPreview['jobDetails']['payment_currency'] == '6' ? 'selected' : ''?>>SGD</option>
			                                    <option value="10" title="R" <?= $fljobPreview['jobDetails']['payment_currency'] == '10' ? 'selected' : ''?>>ZAR</option>
			                                </select>
											<br />
									</div>
									<div class="col-md-4">
											<br />
											<label for="min_budget"><strong>Minimum Budget</strong> <span class="required">*</span></label>
											<?php echo form_error('min_budget'); ?>
											<br /><input id="min_budget" type="number" min='1' class="form-control" style="width:100%" required name="min_budget" value="<?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['min_budget'] : '' ?>" />
											<br />
									</div>
									<div class="col-md-4">
											<br />
											<label for="max_budget"><strong>Maximum Budget</strong> <span class="required">*</span></label>
											<?php echo form_error('max_budget'); ?>
											<br /><input id="max_budget" type="number" min='1' class="form-control" style="width:100%" required name="max_budget" maxlength="64" value="<?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['max_budget'] : '' ?>" />
											<br />

									</div>

								</div>

							</div>
						</div>
						<br/>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
		        <div class="panel panel-default" style="overflow: auto">
			        	<div class="panel-heading">
			                <h4 class="panel-title pull-left"><span class="glyphicon glyphicon-edit"></span> PROJECT DURATION</h4>
			                <div class="pull-right">
			            		<a href="#main" style="color: white;" id="button_list_toggle6" class="btn btn-info btn-sm"> <i class="glyphicon glyphicon-chevron-up" id="button_span_list_up6"></i></a>
			            	</div>
			                <div class="clearfix"></div>
			            </div>
			            <div class="panel-body" id="list_panel_body6">
				            <div class="row">
		                        <div class="col-md-12">    
			                        <div class="col-md-4">
											<br />
											<?php echo form_error('project_duration'); ?>
											<label for="project_duration"><strong>Duration</strong> <span class="required">*</span></label>
											<select id="project_duration" style="width:100%" class='form-control' name='project_duration' value='<?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['project_duration'] : '' ?>'>
			                                    <option value="1" <?= $fljobPreview['jobDetails']['project_duration'] == '1' ? 'selected' : ''?>>Less than 1 week</option>
			                                    <option value="2" <?= $fljobPreview['jobDetails']['project_duration'] == '2' ? 'selected' : ''?>>1 week - 4 weeks</option>
			                                    <option value="3" <?= $fljobPreview['jobDetails']['project_duration'] == '3' ? 'selected' : ''?>>1 month - 3 months</option>
			                                    <option value="4" <?= $fljobPreview['jobDetails']['project_duration'] == '4' ? 'selected' : ''?>>3 month - 6 months/ Ongoing</option>
			                                    <option value="5" <?= $fljobPreview['jobDetails']['project_duration'] == '5' ? 'selected' : ''?>>Not sure</option>
			                                </select>
											<br />
									</div>
									<div class="col-md-4">
											<br />
											<label for="hrs_work"><strong>Hours of work required</strong> <span class="required">*</span></label>
											<?php echo form_error('hrs_work'); ?>
											<br />
											<input id="hrs_work" type="number" placeholder="enter number of hour" class="form-control" style="width:100%" min='1' required name="hrs_work" value="<?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['hrs_work'] : '' ?>" />
											<br />
									</div>
									<div class="col-md-4">
											<br />
											<label for="project_duration_per"><strong>Per</strong> <span class="required">*</span></label>
											<?php echo form_error('project_duration_per'); ?>
											<br />
											<select id="project_duration_per" style="width:100%" class='form-control' name='project_duration_per' <?= isset($fljobPreview) == TRUE ? $fljobPreview['jobDetails']['project_duration_per'] : '' ?>>
			                                    <option value="1" <?= $fljobPreview['jobDetails']['project_duration_per'] == '1' ? 'selected' : ''?>>Week</option>
			                                    <option value="2" <?= $fljobPreview['jobDetails']['project_duration_per'] == '2' ? 'selected' : ''?>>Month</option>
			                                </select>
											<br />
									</div>
								</div>
							</div>
						</div>
						<br/>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12">
				<div class="col-md-2"></div>
				<div class="col-md-4">
		            <a href="<?= BASEURL . 'employers/home' ?>" class="btn btn-block btn-md btn-danger" >Cancel</a>
		            <br />
		    	</div>
                <div class="col-md-4">
					<input type="submit" value="Next" class="btn btn-block btn-md btn-primary" />
					<br />
				</div>	
				<div class="col-md-2"></div>	
			</div>

		</div>	
	</div>
	<div class="col-lg-2"></div>
</div> <!-- main -->
</form>