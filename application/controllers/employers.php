<?php

class Employers extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library(array('form_validation','ajkk_functions','authentication','employer_functions','template','pagination','cms_function','CI_Date'));
        $this->tinyMce = '
            <!-- TinyMCE -->
            <script type="text/javascript" src="'.JSPATH.'tiny_mce/tiny_mce.js"></script>
            <script type="text/javascript">
                tinyMCE.init({
                    // General options
                    mode : "textareas",
                    theme : "simple"

                });
            </script>
            <!-- /TinyMCE -->
            ';
    }

    /**
     * set message for users
     * tryagainagainagain
     * @param   int
     * @param   string
     * @return  set session user data
     */
    public function alertMessage($type, $message) {
        switch ($type) {
            case '1':
                $show_message = array(
                    'result' => 'success',
                    'message' => $message,
                );
                $this->session->set_userdata($show_message);
                break;

            case '2':
                $show_message = array(
                    'result' => 'danger',
                    'message' => $message,
                );
                $this->session->set_userdata($show_message);
                break;

            case '3':
                $show_message = array(
                    'result' => 'warning',
                    'message' => $message,
                );
                $this->session->set_userdata($show_message);
                break;
        }
    }

    function index() {
       redirect(BASEURL . 'employers/home');
    }

    /**
     * view welcome/homepage
     *
     * @return void
     */
    function home() {
        //$this->session->userdata('currentLanguage') == '' ? $this->session->userdata('currentLanguage') = '1' : '';
        $this->session->set_userdata('currentEmpPage','joblist');
        if (!$this->authentication->isLoggedIn()) {
            
            //$data['employer'] = $this->employer_functions->getEmployerById($this->authentication->getEmployerId());
            //$data['playeraccount'] = $this->player_functions->getPlayerAccount($this->authentication->getPlayerId());

            redirect(BASEURL . 'ajkk/login/employer');
        } else {
            
            $data['news'] = $this->ajkk_functions->getAllNews();
            //$data['jobs'] = $this->employer_functions->getPostedJobs($this->authentication->getEmployerId());
            //var_dump($data['jobs']);exit();
            $bannerType = 1; //home banner big
            $data['homemainbanner'] = $this->cms_function->getCmsBanner($bannerType);

            $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
            $data['footerData'] = $this->cms_function->getCmsFooterContentData();
            
            $data['underReviewJobs'] = $this->employer_functions->getJobsCnt($this->authentication->getEmployerId(),0);
            $data['activeJobs'] = $this->employer_functions->getJobsCnt($this->authentication->getEmployerId(),1);
            $data['inactiveJobs'] = $this->employer_functions->getJobsCnt($this->authentication->getEmployerId(),2);
            $data['expiredJobs'] = $this->employer_functions->getJobsCnt($this->authentication->getEmployerId(),3);

            $data['underReviewFLJobs'] = $this->employer_functions->getFLJobsCnt($this->authentication->getEmployerId(),0);
            $data['activeFLJobs'] = $this->employer_functions->getFLJobsCnt($this->authentication->getEmployerId(),1);
            $data['inactiveFLJobs'] = $this->employer_functions->getFLJobsCnt($this->authentication->getEmployerId(),2);
            $data['expiredFLJobs'] = $this->employer_functions->getFLJobsCnt($this->authentication->getEmployerId(),3);
            //var_dump($data); exit();
            $this->loadTemplate('Welcome To JobKonek', '', '', 'home');

            $jobStatusSort = $this->session->userdata('jobStatusSort');
            
            $empId = $this->authentication->getEmployerId();
            $sort['sort_by'] = "created_on";
            $sort['status'] = $jobStatusSort != '' ? $jobStatusSort : $jobStatusSort = 1;
            $data['fljobType'] = 0;
            if($jobStatusSort == 0){
                $data['jobTitleSort'] = 'Under Review Job List';
                $data['fljobType'] = 0;
            }elseif($jobStatusSort == 1){
                $data['jobTitleSort'] = 'Active Job List';
                $data['fljobType'] = 1;
            }elseif($jobStatusSort == 2){
                $data['jobTitleSort'] = 'Inactive Job List';
                $data['fljobType'] = 2;
            }elseif($jobStatusSort == 3){
                $data['jobTitleSort'] = 'Expired Job List';
                $data['fljobType'] = 3;
            }

            $data['alljobs'] = $this->employer_functions->getAllPostedJobs($sort,$empId);
            //var_dump($data['alljobs']);exit();
            $this->template->write_view('main_content', 'employer/home', $data);
            $this->template->write_view('footer_content', 'template/footer_template');

            $this->template->render();
        }
    }

    /**
     * job_details
     *
     * @return void
     */
    function activeFreelanceJob() {
        //$this->session->userdata('currentLanguage') == '' ? $this->session->userdata('currentLanguage') == '1' : '';
        $this->session->set_userdata('currentEmpPage','freelancejoblist');
        if (!$this->authentication->isLoggedIn()) {
            redirect(BASEURL . 'ajkk/login/employer');
        }else{
            $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
            $data['footerData'] = $this->cms_function->getCmsFooterContentData();

            $data['activeJobs'] = $this->employer_functions->getJobsCnt($this->authentication->getEmployerId(),1);
            $data['underReviewFLJobs'] = $this->employer_functions->getFLJobsCnt($this->authentication->getEmployerId(),0);
            $data['activeFLJobs'] = $this->employer_functions->getFLJobsCnt($this->authentication->getEmployerId(),1);
            $data['inactiveFLJobs'] = $this->employer_functions->getFLJobsCnt($this->authentication->getEmployerId(),2);
            $data['expiredFLJobs'] = $this->employer_functions->getFLJobsCnt($this->authentication->getEmployerId(),3);           
            
            $fljobStatusSort = $this->session->userdata('fljobStatusSort');
            $empId = $this->authentication->getEmployerId();
            $sort['sort_by'] = "created_on";
            $sort['is_approved'] = $fljobStatusSort != '' ? $fljobStatusSort : $fljobStatusSort = 0;
            $data['fljobType'] = 0;

            if($fljobStatusSort == 0){
                $data['fljobTitleSort'] = 'Under Review Freelance Job List';
                $data['fljobType'] = 0;
            }elseif($fljobStatusSort == 1){
                $data['fljobTitleSort'] = 'Active Freelance Job List';
                $data['fljobType'] = 1;
            }elseif($fljobStatusSort == 2){
                $data['fljobTitleSort'] = 'Inactive Freelance Job List';
                $data['fljobType'] = 2;
            }elseif($fljobStatusSort == 3){
                $data['fljobTitleSort'] = 'Expired Freelance Job List';
                $data['fljobType'] = 3;
            }

            $data['fljobs'] = $this->employer_functions->getPostedFLJobs($sort, $empId);
            //var_dump($data['fljobs']);exit();
            $this->loadTemplate('Welcome To JobKonek', '', '', 'home');
            $this->template->write_view('main_content', 'employer/freelancejob', $data);
            $this->template->write_view('footer_content', 'template/footer_template');

            $this->template->render();
        }
    }

    /**
     * job_details
     *
     * @return void
     */
    function activeFreelanceJobDetails($flJobId) {
        //$this->session->userdata('currentLanguage') == '' ? $this->session->userdata('currentLanguage') == '1' : '';

        if (!$this->authentication->isLoggedIn()) {
            redirect(BASEURL . 'ajkk/login/employer');
        }else{
            $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
            $data['footerData'] = $this->cms_function->getCmsFooterContentData();

            $data['fljobs'] = $this->employer_functions->getActiveFreelanceJobDetails($flJobId);
            //var_dump($data['fljobs']);exit();
            $this->loadTemplate('Welcome To JobKonek', '', '', 'Freelance');
            $this->template->write_view('main_content', 'employer/freelancejob_details', $data);
            $this->template->write_view('footer_content', 'template/footer_template');

            $this->template->render();
        }
    }

    /**
     * job_details
     *
     * @return void
     */
    function jobDetails($jobId,$status=0,$type=1) {
        $this->session->userdata('currentLanguage') == '' ? $this->session->userdata('currentLanguage') == '1' : '';
        if (!$this->authentication->isLoggedIn()) {
            redirect(BASEURL . 'ajkk/login/employer');
        }else{
            $this->loadTemplate('Job Application', '', '', 'Applicant');
            $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
            $data['footerData'] = $this->cms_function->getCmsFooterContentData();

            $data['applicantCnt'] = $this->employer_functions->getApplicantCnt($jobId,0,$type);
            $data['shortlistedCnt'] = $this->employer_functions->getApplicantCnt($jobId,1,$type);
            $data['forInterviewCnt'] = $this->employer_functions->getApplicantCnt($jobId,2,$type);
            $data['unqualifiedCnt'] = $this->employer_functions->getApplicantCnt($jobId,3,$type);
            $data['status'] = $status;
            if($type == 1){ //jobs
                $data['jobInfodetails'] = $this->employer_functions->getJobInfoDetails($jobId,$status);
                $data['jobtype'] = 1;                
                $this->session->set_userdata('jobDetailsCurrentPage',$status);
                $this->template->write_view('main_content', 'employer/job_details', $data);
                //var_dump($data['jobInfodetails']);exit();
            }elseif($type == 2){  //freelance jobs
                $data['jobInfodetails'] = $this->employer_functions->getFreelanceJobInfoDetails($jobId,$status);
                //var_dump($data['jobInfodetails']);exit();
                $data['jobtype'] = 2;
                $this->session->set_userdata('freelancejobApplicantCurrentPage',$status);
                $this->template->write_view('main_content', 'employer/freelancejob_applicant', $data);
            }            
            
            $this->template->write_view('footer_content', 'template/footer_template');

            $this->template->render();
        }
    }


    /**
     * add/edit banner setting
     *
     * @return  array
     */
    public function editEmpLogo() {
                //var_dump($promoCategory);exit();
                $empLogoId = $this->input->post('compLogoId');
                $empLogoURL = $this->input->post('logo_url');
                
                $fileType = substr($empLogoURL, strrpos($empLogoURL, '.') + 1); 
                //var_dump($fileType);exit();               
                $path = realpath(APPPATH . '../public/resources/images/comp_logo');
                $today = date("Y-m-d H:i:s");

                //upload image
                $empLogoName = 'complogo-'.$this->authentication->getEmployerId();
                $config = array(
                    'allowed_types' => 'jpg|jpeg|gif|png',
                    'upload_path' => $path,
                    'max_size' => 100000,
                    'overwrite' => true,
                    'file_name' => $empLogoName
                );

                $this->load->library('upload', $config);
                $this->upload->do_upload();
                    
                $data = array(
                    'mediaCategory' => 'comp_logo',
                    'emp_id' => $this->authentication->getEmployerId(),
                    'createdOn' => $today,
                    'mediaName' => $empLogoName.'.'.$fileType,                          
                    'status' => 'active'
                );

                $this->employer_functions->editEmpLogo($data);

                redirect(BASEURL . 'employers/employerFinalized');
    }

    /**
     * sort job by
     *
     * @return void
     */
    public function sortJobBy($sortJobBy) {
        $this->session->set_userdata('jobStatusSort',$sortJobBy);
        redirect(BASEURL . 'employers/home');
    }

    /**
     * sort job by
     *
     * @return void
     */
    public function sortFLJobBy($sortJobBy) {
        $this->session->set_userdata('fljobStatusSort',$sortJobBy);
        redirect(BASEURL . 'employers/activeFreelanceJob');
    }

    /**
     * assessFJApplicant
     *
     * @return void
     */
    public function assessFJApplicant($assessment,$fljobId,$applicantId,$forInterview='') {
        $data = array(                           
                        'candidate_status' => $assessment,                     
                        );

        $this->employer_functions->assessFJApplicant($data,$fljobId,$applicantId);

        if($assessment == 1 || $assessment == 2 || $assessment == 3){
            if($forInterview!=''){
                redirect(BASEURL . 'employers/jobDetails/'.$fljobId.'/1/2');    
            }else{
                redirect(BASEURL . 'employers/jobDetails/'.$fljobId.'/0/2');
            }            
        }elseif($assessment == 4 || $assessment == 5){
            redirect(BASEURL . 'employers/jobDetails/'.$fljobId.'/2/2');
        }

    }

    /**
     * assessJobApplicant
     *
     * @return void
     */
    public function assessJobApplicant($assessment,$jobId,$applicantId,$forInterview='') {
        $data = array(                           
                        'candidate_status' => $assessment,                     
                        );

        $this->employer_functions->assessJobApplicant($data,$jobId,$applicantId);

        if($assessment == 1 || $assessment == 2 || $assessment == 3){
            if($forInterview!=''){
                redirect(BASEURL . 'employers/jobDetails/'.$jobId.'/1/2');
            }else{
                redirect(BASEURL . 'employers/jobDetails/'.$jobId.'/0/1');
            }
        }
        elseif($assessment == 4 || $assessment == 5){
            redirect(BASEURL . 'employers/jobDetails/'.$jobId.'/2/1');
        }
    }

    /**
     * View a Sorted Users
     *
     *
     * @param int
     * @return  rendered Template with array of data
     */
    public function get_jobs($segment = '') {
        $jobStatusSort = $this->session->userdata('jobStatusSort');
        $empId = $this->authentication->getEmployerId();
        $sort['sort_by'] = "created_on";
        $sort['status'] = $jobStatusSort != '' ? $jobStatusSort : $jobStatusSort = 1;
        if($jobStatusSort == 0){
            $data['jobTitleSort'] = 'Under Review Job List';
        }elseif($jobStatusSort == 1){
            $data['jobTitleSort'] = 'Active Job List';
        }elseif($jobStatusSort == 2){
            $data['jobTitleSort'] = 'Inactive Job List';
        }elseif($jobStatusSort == 3){
            $data['jobTitleSort'] = 'Expired Job List';
        }

        $data['count_all'] = count($this->employer_functions->getPostedJobs($sort, null, null, $empId));
        $config['base_url'] = "javascript:get_jobs_home_page(";
        $config['total_rows'] = $data['count_all'];
        $config['per_page'] = '5';
        $config['num_links'] = '1';

        $config['first_tag_open'] = '<li>';
        $config['last_tag_open']= '<li>';
        $config['next_tag_open']= '<li>';
        $config['prev_tag_open'] = '<li>';
        $config['num_tag_open'] = '<li>';

        $config['first_tag_close'] = '</li>';
        $config['last_tag_close']= '</li>';
        $config['next_tag_close']= '</li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

        $this->pagination->initialize($config);

        $data['total_pages'] = ceil($data['count_all'] / $config['per_page']);
        $data['jobs'] = $this->employer_functions->getPostedJobs($sort, $config['per_page'], $segment, $empId);

        $this->load->view('employer/ajax_jobs_home_page', $data);
    }

    /**
     * View a Sorted Users
     *
     *
     * @param int
     * @return  rendered Template with array of data
     */
    public function get_fljobs() {
        $fljobStatusSort = $this->session->userdata('fljobStatusSort');
        $empId = $this->authentication->getEmployerId();
        $sort['sort_by'] = "created_on";
        $sort['is_approved'] = $fljobStatusSort != '' ? $fljobStatusSort : $fljobStatusSort = 0;
        $data['fljobType'] = 0;
        if($fljobStatusSort == 0){
            $data['fljobTitleSort'] = 'Under Review Freelance Job List';
            $data['fljobType'] = 0;
        }elseif($fljobStatusSort == 1){
            $data['fljobTitleSort'] = 'Active Freelance Job List';
            $data['fljobType'] = 1;
        }elseif($fljobStatusSort == 2){
            $data['fljobTitleSort'] = 'Inactive Freelance Job List';
            $data['fljobType'] = 2;
        }elseif($fljobStatusSort == 3){
            $data['fljobTitleSort'] = 'Expired Freelance Job List';
            $data['fljobType'] = 3;
        }

        $data['count_all'] = count($this->employer_functions->getPostedFLJobs($sort, null, null, $empId));
        $config['base_url'] = "javascript:get_fljobs_home_page(";
        $config['total_rows'] = $data['count_all'];
        $config['per_page'] = '5';
        $config['num_links'] = '1';

        $config['first_tag_open'] = '<li>';
        $config['last_tag_open']= '<li>';
        $config['next_tag_open']= '<li>';
        $config['prev_tag_open'] = '<li>';
        $config['num_tag_open'] = '<li>';

        $config['first_tag_close'] = '</li>';
        $config['last_tag_close']= '</li>';
        $config['next_tag_close']= '</li>';
        $config['prev_tag_close'] = '</li>';
        $config['num_tag_close'] = '</li>';

        $config['cur_tag_open'] = "<li><span><b>";
        $config['cur_tag_close'] = "</b></span></li>";

        $this->pagination->initialize($config);

        $data['total_pages'] = ceil($data['count_all'] / $config['per_page']);
        $data['fljobs'] = $this->employer_functions->getPostedFLJobs($sort, $config['per_page'], $segment, $empId);

        $this->load->view('employer/ajax_fljobs_home_page', $data);
    }

    /**
     * updateFLJobPostStatus 
     *
     * @param   promocmsId
     * @param   status
     * @return  redirect
     */
    public function updateFLJobPostStatus($fljobId,$status) {
        $data = array(                           
                        'updated_on' => date("Y-m-d H:i:s"),
                        'is_removed' => $status,
                        'fljobId' => $fljobId                         
                        );

        $this->employer_functions->updateFLJobPostStatus($data);

        redirect(BASEURL . 'employers/home');
    }

    /**
     * activatedDeactivateFLJobPost 
     *
     * @param   fljobId
     * @param   status
     * @return  redirect
     */
    public function activatedDeactivateFLJobPost($fljobId,$status) {
        $data = array(                           
                        'updated_on' => date("Y-m-d H:i:s"),
                        'is_approved' => $status,
                        'fljobId' => $fljobId                         
                        );

        $this->employer_functions->activatedDeactivateFLJobPost($data);

        redirect(BASEURL . 'employers/home');
    }

    /**
     * activatedDeactivateJobPost 
     *
     * @param   fljobId
     * @param   status
     * @return  redirect
     */
    public function activatedDeactivateJobPost($jobId,$status) {
        $data = array(                           
                        'updated_on' => date("Y-m-d H:i:s"),
                        'active' => $status,
                        'jobId' => $jobId                         
                        );

        $this->employer_functions->activatedDeactivateJobPost($data);

        redirect(BASEURL . 'employers/home');
    }

    /**
     * updateFLJobPostStatus 
     *
     * @param   promocmsId
     * @param   status
     * @return  redirect
     */
    public function updateJobPostStatus($jobId,$status) {
        $data = array(                           
                        'updated_on' => date("Y-m-d H:i:s"),
                        'is_removed' => $status,
                        'fljobId' => $jobId                         
                        );

        $this->employer_functions->updateFLJobPostStatus($data);

        redirect(BASEURL . 'employers/home');
    }

    /**
     * Loads template for view based on regions in
     * config > template.php
     *
     */
    private function loadTemplate($title, $description, $keywords, $activenav) {
        $this->template->add_js('resources/js/player/player.js');
        $this->template->add_js('resources/js/home/employer.js');
        $this->template->add_css('resources/css/employer/dashboard.css');
        $this->template->add_css('resources/css/employer/employer.css');

        $this->template->add_css('resources/css/summernote/font-awesome.min.css');
        $this->template->add_css('resources/css/summernote/summernote-bs3.css');
        $this->template->add_css('resources/css/summernote/summernote.css');

         // $this->template->add_js('resources/js/jquery-1.11.1.min.js');
        $this->template->add_js('resources/js/jquery.dataTables.min.js');
        $this->template->add_js('resources/js/dataTables.responsive.min.js');

        $this->template->add_css('resources/css/jquery.dataTables.css');
        $this->template->add_css('resources/css/dataTables.responsive.css');

        //$this->template->add_js('resources/js/jquery.numeric.min.js');
        $this->template->write('skin', 'template1.css');
        $this->template->write('title', $title);
        $this->template->write('description', $description);
        $this->template->write('keywords', $keywords);
        $this->template->write('activenav', $activenav);
        $this->template->write('username', $this->authentication->getUsername());
        $this->template->write('employer_id', $this->authentication->getEmployerId());
        $this->template->write('user_type', 'employer');
    }

    /**
     * view cancel promo
     *
     * @return void
     */
    public function postResetPassword() {

        $this->form_validation->set_rules('opassword', 'Current Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'New Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

        if($this->form_validation->run() == false) {
            //$message = "Please input correct details when resetting your password";
            $message = lang('notify.25');
            $this->alertMessage(1, $message);
            $this->changePassword();
        } else {
            $opassword = $this->input->post('opassword');
            $password = $this->input->post('password');

            $check = $this->player_functions->isValidPassword($this->authentication->getPlayerId(), $opassword);
            if(!$check) { // if password is incorrect
                //$message = "Your Password is incorrect. New Password cannot be save";
                $message = lang('notify.26');
                $this->alertMessage(2, $message);
                $this->changePassword();
            } else {
                $data = array('password' => $password);
                $this->player_functions->resetPassword($this->authentication->getPlayerId(), $data);

                //$message = "Your Password has successfully changed";
                $message = lang('notify.27');
                $this->alertMessage(1, $message);
                redirect(BASEURL . 'player_controller/changePassword/');
            }
        }
    }

   function postNewJob()
   {
        if ($this->authentication->isLoggedIn()) {                            
            //get membership info
            $mem_info = $this->employer_functions->getEmployerMembershipInfo($this->authentication->getEmployerId());                                     
            
            $timezone = "Asia/Manila";
            if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
            //echo 'Now: '.date("Y-m-d H:i:s");
            //$date_now = '2014-07-08 00:00:01';
            //$expi_date = '2014-07-07 00:00:01';
            
            $date_now = date("Y-m-d H:i:s");
            $expi_date = $mem_info[0]->jobpost_expiration_date;
                
            if($date_now >= $expi_date){            
                //$this->load->view('backend/employer/expired_membership',$data);
                $message = 'Membership expired already! Pls. contact admin for more info.';
                $this->alertMessage(2, $message);
                redirect(BASEURL . 'employers/membershipExpired');
            }
            else {
                $this->form_validation->set_rules('job_title', 'Job Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('job_overview', 'Job Overview', 'trim|required|xss_clean');
                $this->form_validation->set_rules('location_region', 'Region', 'trim|required|xss_clean');
                $this->form_validation->set_rules('location_city', 'City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');

                if (!$this->form_validation->run()) // validation hasn't been passed
                {
                    redirect(BASEURL . 'employers/postJob/1');
                }
                else // passed validation proceed to post success logic
                {                                       
                    $jobSummary["emp_id"] = $this->authentication->getEmployerId();
                    $jobSummary["job_title"] = strtolower($this->input->post("job_title"));
                    $jobSummary["job_overview"] = strtolower($this->input->post("job_overview"));
                    $jobSummary["location_region"] = $this->input->post("location_region");  
                    $jobSummary["location_city"] = $this->input->post("location_city");                  
                    $jobSummary["company_name"] = strtolower($this->input->post("company_name"));
                    $jobSummary["created_on"] = date('Y-m-d H:i:s');
                    $jobSummary['joborderid'] = 'JKJP-'.$this->authentication->getEmployerId().'-'.$this->employer_functions->getJobRandOrderId();
                    $this->session->set_userdata('postjob_step1',$jobSummary);           
                    redirect(BASEURL . 'employers/postJob/2');                    
                }
            }  
        }else{
            redirect(BASEURL . 'employers/home','refresh');
        }     
    }

    function postJobUpdate()
   {
        if ($this->authentication->isLoggedIn()) {                            
            //get membership info
            $mem_info = $this->employer_functions->getEmployerMembershipInfo($this->authentication->getEmployerId());                                     
            
            $timezone = "Asia/Manila";
            if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
            //echo 'Now: '.date("Y-m-d H:i:s");
            //$date_now = '2014-07-08 00:00:01';
            //$expi_date = '2014-07-07 00:00:01';
            
            $date_now = date("Y-m-d H:i:s");
            $expi_date = $mem_info[0]->jobpost_expiration_date;
                
            if($date_now >= $expi_date){            
                //$this->load->view('backend/employer/expired_membership',$data);
                $message = 'Membership expired already! Pls. contact admin for more info.';
                $this->alertMessage(2, $message);
                redirect(BASEURL . 'employers/membershipExpired');
            }
            else {
                $this->form_validation->set_rules('job_title', 'Job Title', 'trim|required|xss_clean');
                $this->form_validation->set_rules('job_overview', 'Job Overview', 'trim|required|xss_clean');
                $this->form_validation->set_rules('location_region', 'Region', 'trim|required|xss_clean');
                $this->form_validation->set_rules('location_city', 'City', 'trim|required|xss_clean');
                $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');

                if (!$this->form_validation->run()) // validation hasn't been passed
                {
                    redirect(BASEURL . 'employers/postJob/5');
                }
                else // passed validation proceed to post success logic
                {   
                    $jobSummary["jobId"] = strtolower($this->input->post("jobId"));                                    
                    $jobSummary["emp_id"] = $this->authentication->getEmployerId();
                    $jobSummary["job_title"] = strtolower($this->input->post("job_title"));
                    $jobSummary["job_overview"] = strtolower($this->input->post("job_overview"));
                    $jobSummary["location_region"] = $this->input->post("location_region");  
                    $jobSummary["location_city"] = $this->input->post("location_city");                  
                    $jobSummary["company_name"] = strtolower($this->input->post("company_name"));

                    $this->employer_functions->update_jobtable('jobs',$jobSummary);
                    
                    redirect(BASEURL . 'employers/postJob/6/'.$this->input->post("jobId"));                    
                }
            }  
        }else{
            redirect(BASEURL . 'employers/home','refresh');
        }     
    }

    function postNewFreelanceJob()
    {
        if ($this->authentication->isLoggedIn()) {                            
            //get membership info
            $mem_info = $this->employer_functions->getEmployerMembershipInfo($this->authentication->getEmployerId());                                     
            
            $timezone = "Asia/Manila";
            if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
            //echo 'Now: '.date("Y-m-d H:i:s");
            //$date_now = '2014-07-08 00:00:01';
            //$expi_date = '2014-07-07 00:00:01';
            
            $date_now = date("Y-m-d H:i:s");
            $expi_date = $mem_info[0]->jobpost_expiration_date;
                
            if($date_now >= $expi_date){            
                //$this->load->view('backend/employer/expired_membership',$data);
                $message = 'Membership expired already! Pls. contact admin for more info.';
                $this->alertMessage(2, $message);
                redirect(BASEURL . 'employers/membershipExpired');
            }
            else {
                $this->form_validation->set_rules('project_name', 'Project Name', 'trim|required|xss_clean');
                $this->form_validation->set_rules('project_type', 'Project Type', 'trim|required|xss_clean');
                $this->form_validation->set_rules('project_overview', 'Job Overview', 'trim|required|xss_clean');
                $this->form_validation->set_rules('payment_type', 'Payment Type', 'trim|required|xss_clean');
                $this->form_validation->set_rules('payment_currency', 'Payment Currency', 'trim|required|xss_clean');
                $this->form_validation->set_rules('min_budget', 'Minimum Budget', 'trim|required|xss_clean');
                $this->form_validation->set_rules('max_budget', 'Maximum Budget', 'trim|required|xss_clean');
                $this->form_validation->set_rules('project_duration', 'Project Duration', 'trim|required|xss_clean');
                $this->form_validation->set_rules('hrs_work', 'Required Hours of work', 'trim|required|xss_clean');
                $this->form_validation->set_rules('project_duration_per', 'Duration Per', 'trim|required|xss_clean');

                $this->session->set_userdata('skills_required',$this->input->post('skills_required'));
                $this->session->set_userdata('project_name',$this->input->post('project_name'));
                $this->session->set_userdata('project_type',$this->input->post('project_type'));
                $this->session->set_userdata('project_overview',$this->input->post('project_overview'));
                $this->session->set_userdata('payment_currency',$this->input->post('payment_currency'));
                $this->session->set_userdata('payment_type',$this->input->post('payment_type'));
                $this->session->set_userdata('hrs_work',$this->input->post('hrs_work'));
                $this->session->set_userdata('project_duration_per',$this->input->post('project_duration_per'));
                $this->session->set_userdata('project_duration',$this->input->post('project_duration'));
                $this->session->set_userdata('min_budget',$this->input->post('min_budget'));
                $this->session->set_userdata('max_budget',$this->input->post('max_budget'));

                if (!$this->form_validation->run()) // validation hasn't been passed
                {
                    // $message = 'Pls. check all fields are correct!';
                    // $this->alertMessage(2, $message);
                    redirect(BASEURL . 'employers/postFreelanceJob/1');
                }
                else // passed validation proceed to post success logic
                {         
                     $today = date("Y-m-d H:i:s");
                     $flDetails['fljobId'] = $this->input->post("fljobId");
                     $flDetails['is_approved'] = 0;                                                             
                     $flDetails['payment_type'] = $this->input->post("payment_type");
                     $flDetails['emp_id'] = $this->authentication->getEmployerId();
                     $flDetails['min_budget'] = $this->input->post("min_budget");
                     $flDetails['max_budget'] = $this->input->post("max_budget");
                     $flDetails['project_name'] = $this->input->post("project_name");
                     $flDetails['project_overview'] = $this->input->post("project_overview");
                     $flDetails['project_type'] = $this->input->post("project_type");
                     $flDetails['payment_currency'] = $this->input->post("payment_currency");
                     $flDetails['project_duration'] = $this->input->post("project_duration");
                     $flDetails['hrs_work'] = $this->input->post("hrs_work");
                     $flDetails['project_duration_per'] = $this->input->post("project_duration_per");
                     $flDetails['created_on'] = $today;
                     //array_filer = delete empty array value
                     //array_map('trim',$value) = removes white space in the value of array
                     //explode = split string to array
                     
                    //var_dump($skillsRequired['skills']);exit();
                    if($flDetails['min_budget'] > $flDetails['max_budget']){
                        $message = 'Minimum Budget must be lower than Maximum Budget!';
                        $this->alertMessage(2, $message);
                        redirect(BASEURL . 'employers/postFreelanceJob/1');
                    }
                     
                    if($this->input->post("fljobId") == ''){
                        //var_dump($this->input->post("benefits"));exit();
                        $flDetails['joborderid'] = 'JKFJ-'.$this->authentication->getEmployerId().'-'.$this->employer_functions->getJobRandOrderId();
                        $flJobId = $this->employer_functions->insert_table_details('freelance_job',$flDetails);

                        //insert freelance job skill requirements
                        $skillsRequired['skills'] = array_unique(array_filter(array_map('trim',explode(',' , $this->input->post('skills_required').','))));
                        foreach($skillsRequired['skills'] as $sk)
                        {                                
                             $sk_data['flJobId'] = $flJobId;
                             $sk_data['skills']= $sk;
                             $this->employer_functions->insert_table_details('freelance_skill_req',$sk_data);
                        }  

                        $empDocURL = $this->input->post('doc_url');
                        $fileType = substr($empDocURL, strrpos($empDocURL, '.') + 1); 
                        //var_dump($fileType);exit();               
                        $path = realpath(APPPATH . '../public/resources/docs/freelancejob');
                        
                        if($empDocURL!=''){                            
                            if(strcasecmp($fileType, 'pdf') != 0 && strcasecmp($fileType, 'doc') != 0  && strcasecmp($fileType, 'docx') != 0) {
                                $message = 'Uploaded document is not allowed!';
                                $this->alertMessage(2, $message);
                                redirect(BASEURL . 'employers/postFreelanceJob/1');
                            } else {

                                //upload image
                                $freelancejobdetailsName = 'freelancejobdetails-'.$flJobId.'-'.$this->authentication->getEmployerId();
                                $config = array(
                                    'allowed_types' => 'pdf|doc|docx',
                                    'upload_path' => $path,
                                    'max_size' => 100000,
                                    'overwrite' => true,
                                    'file_name' => $freelancejobdetailsName
                                );

                                $this->load->library('upload', $config);
                                $this->upload->do_upload();

                                $data = array(
                                    'mediaCategory' => 'comp_fljob_docs',
                                    'fljob_id' => $flJobId,
                                    'createdOn' => $today,
                                    'mediaName' => $freelancejobdetailsName.'.'.$fileType,                          
                                    'status' => 'active'
                                );

                                $this->employer_functions->addFreelanceJobDetails($data);
                            }        
                        }

                        $message = 'Your project has been sent for review!';
                        $this->alertMessage(1, $message);
                        redirect(BASEURL . 'employers/postFreelanceJob/2/'.$flJobId);                         
                    }else{
                        $flJobId = $this->input->post("fljobId");
                        $this->employer_functions->update_fltable_details('freelance_job',$flDetails);

                        $this->employer_functions->delete_fljob_reqskills($flJobId);

                            //insert freelance job skill requirements
                            $skillsRequired['skills'] = array_unique(array_filter(array_map('trim',explode(',' , $this->input->post('skills_required').','))));
                            foreach($skillsRequired['skills'] as $sk)
                            {                                
                                 $sk_data['flJobId'] = $flJobId;
                                 $sk_data['skills']= $sk;
                                 $this->employer_functions->insert_table_details('freelance_skill_req',$sk_data);
                            }  
                        

                        $empDocURL = $this->input->post('doc_url');
                        $fileType = substr($empDocURL, strrpos($empDocURL, '.') + 1); 
                        //var_dump($fileType);exit();               
                        $path = realpath(APPPATH . '../public/resources/docs/freelancejob');
                        
                        if($empDocURL!=''){                            
                            if(strcasecmp($fileType, 'pdf') != 0 && strcasecmp($fileType, 'doc') != 0  && strcasecmp($fileType, 'docx') != 0) {
                                $message = 'Uploaded document is not allowed!';
                                $this->alertMessage(2, $message);
                                redirect(BASEURL . 'employers/postFreelanceJob/1');
                            } else {

                                //upload image
                                $freelancejobdetailsName = 'freelancejobdetails-'.$flJobId.'-'.$this->authentication->getEmployerId();
                                $config = array(
                                    'allowed_types' => 'pdf|doc|docx',
                                    'upload_path' => $path,
                                    'max_size' => 100000,
                                    'overwrite' => true,
                                    'file_name' => $freelancejobdetailsName
                                );

                                $this->load->library('upload', $config);
                                $this->upload->do_upload();

                                $data = array(
                                    'mediaCategory' => 'comp_fljob_docs',
                                    'fljob_id' => $flJobId,
                                    'createdOn' => $today,
                                    'mediaName' => $freelancejobdetailsName.'.'.$fileType,                          
                                    'status' => 'active'
                                );

                                $this->employer_functions->addFreelanceJobDetails($data);
                            }        
                        }
                        $message = 'Your project has been updated and sent for review!';
                        $this->alertMessage(1, $message);
                        redirect(BASEURL . 'employers/postFreelanceJob/2/'.$flJobId);  
                    }
                            
                }
            }  
        }else{
            redirect(BASEURL . 'employers/home','refresh');
        }     
    }

    function postNewJobDetails()
    { 
            $this->form_validation->set_rules('job_description', 'Job Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('vacancy_num', 'Vacancy Number', 'trim|required|is_numeric');
            $this->form_validation->set_rules('experience_req', 'Experience requirements', 'trim|xss_clean');
            $this->form_validation->set_rules('additional_job_req', 'Additional Job Requirements', 'trim|xss_clean');

            if (!$this->form_validation->run()) // validation hasn't been passed
            {
                redirect(BASEURL . 'employers/postJob/2');
            }
            else // passed validation proceed to post success logic
            {
                $jobSummary = $this->session->userdata('postjob_step1');
                $job_id = $this->employer_functions->postJob($jobSummary);
                
                $form_data['job_id'] = $job_id;
                $form_data["salary_type"] = $this->input->post("salary_type");                      
                $form_data["show_salary"] = $this->input->post("show_salary");                      
                $form_data["vacancy_num"] = $this->input->post("vacancy_num");          
                $form_data["specialization"] = $this->input->post("specialization");            
                $form_data["position_level"] = $this->input->post("position_level");            
                $form_data["job_desc"] = $this->input->post("job_description");                     
                $form_data["sked_type"] = $this->input->post("sked_type");      
                $form_data["yr_exp"] = $this->input->post("yr_exp");        
                $form_data["experience_req"] = $this->input->post("experience_req");                                            
                $form_data["additional_job_req"] = $this->input->post("additional_job_req");            
                $form_data["salary_base"] = $this->input->post("salary_base");              
                $form_data["currency"] = $this->input->post("currency");    
                $form_data["salary_min"] = $this->input->post("salary_min");    
                $form_data["salary_max"] = $this->input->post("salary_max");    
                $form_data["date_posted"] = $this->input->post("date_posted").' 00:00:00';  
                $form_data["date_expiry"] = $this->input->post("date_expiry").' 00:00:00';  
                $this->employer_functions->insert_table_details('job_details',$form_data);

                //insert job educ requrements
                foreach($this->input->post("educational_req") as $jer)
                {
                     $jer_data['job_id'] = $job_id;
                     $jer_data['education']= strtolower($jer);
                     $this->employer_functions->insert_table_details('job_educ_reqs',$jer_data);
                }
                
                //insert benefits data
                foreach($this->input->post("benefits") as $jb)
                {
                     $jb_data['job_id'] = $job_id;
                     $jb_data['benefits']= strtolower($jb);
                     $this->employer_functions->insert_table_details('job_other_benefits',$jb_data);
                }   
                
                //insert employment type
                foreach($this->input->post("emp_type") as $et)
                {
                     $et_data['job_id'] = $job_id;
                     $et_data['emp_type']= strtolower($et);
                     $this->employer_functions->insert_table_details('job_employment_type',$et_data);
                }                

                //clear session
                $this->session->unset_userdata('postjob_step1');

                redirect(BASEURL . 'employers/postJob/3/'.$job_id);
            }
    }

    function postJobDetailsUpdate()
    { 
            $this->form_validation->set_rules('job_description', 'Job Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('vacancy_num', 'Vacancy Number', 'trim|required|is_numeric');
            $this->form_validation->set_rules('experience_req', 'Experience requirements', 'trim|xss_clean');
            $this->form_validation->set_rules('additional_job_req', 'Additional Job Requirements', 'trim|xss_clean');

            $job_id = $this->input->post("jobId");
            $form_data["job_id"] = $job_id;

            if (!$this->form_validation->run()) // validation hasn't been passed
            {
                redirect(BASEURL . 'employers/postJob/6/'.$form_data["job_id"]);
            }
            else // passed validation proceed to post success logic
            {
                //$jobSummary = $this->session->userdata('postjob_step1');
                //$job_id = $this->employer_functions->postJob($jobSummary);
                
                $form_data["salary_type"] = $this->input->post("salary_type");                      
                $form_data["show_salary"] = $this->input->post("show_salary");                      
                $form_data["vacancy_num"] = $this->input->post("vacancy_num");          
                $form_data["specialization"] = $this->input->post("specialization");            
                $form_data["position_level"] = $this->input->post("position_level");            
                $form_data["job_desc"] = $this->input->post("job_description");                     
                $form_data["sked_type"] = $this->input->post("sked_type");      
                $form_data["yr_exp"] = $this->input->post("yr_exp");        
                $form_data["experience_req"] = $this->input->post("experience_req");                                            
                $form_data["additional_job_req"] = $this->input->post("additional_job_req");            
                $form_data["salary_base"] = $this->input->post("salary_base");              
                $form_data["currency"] = $this->input->post("currency");    
                $form_data["salary_min"] = $this->input->post("salary_min");    
                $form_data["salary_max"] = $this->input->post("salary_max");    
                $form_data["date_posted"] = $this->input->post("date_posted").' 00:00:00';  
                $form_data["date_expiry"] = $this->input->post("date_expiry").' 00:00:00';  
                $this->employer_functions->update_jobtable_details('job_details',$form_data);

                //insert job educ requrements
                if($this->input->post("educational_req") != ''){
                   $this->employer_functions->delete_jobtable_details('job_educ_reqs',$job_id);
                       foreach($this->input->post("educational_req") as $jer)
                        {
                            $jer_data['job_id'] = $job_id;
                            $jer_data['education']= strtolower($jer);
                            $this->employer_functions->insert_table_details('job_educ_reqs',$jer_data);
                        } 
                    
                }
                
                //insert benefits data
                if($this->input->post("benefits") != ''){
                    $this->employer_functions->delete_jobtable_details('job_other_benefits',$job_id);
                        foreach($this->input->post("benefits") as $jb)
                        {
                             $jb_data['job_id'] = $job_id;
                             $jb_data['benefits']= strtolower($jb);
                             $this->employer_functions->insert_table_details('job_other_benefits',$jb_data);
                        }   
                }

                //insert employment type
                if($this->input->post("emp_type") != ''){
                    $this->employer_functions->delete_jobtable_details('job_employment_type',$job_id);
                        foreach($this->input->post("emp_type") as $et)
                        {
                             $et_data['job_id'] = $job_id;
                             $et_data['emp_type']= strtolower($et);
                             $this->employer_functions->insert_table_details('job_employment_type',$et_data);
                        } 
                    
                }             

                //clear session
                //$this->session->unset_userdata('postjob_step1');

                redirect(BASEURL . 'employers/postJob/3/'.$job_id);
            }
    }


    function postEmployerDetails()
    { 
            $this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');
            $this->form_validation->set_rules('comp_desc', 'Company Description', 'trim|required|xss_clean');
            $this->form_validation->set_rules('comp_nature', 'Nature of Business', 'trim|required|xss_clean');
            $this->form_validation->set_rules('comp_type', 'Company Type', 'trim|required|xss_clean');
            $this->form_validation->set_rules('address', 'Company Address', 'trim|required|xss_clean');
            $this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
            $this->form_validation->set_rules('state', 'Region/State', 'trim|required|xss_clean');
            $this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
            $this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|xss_clean|is_numeric');
            $this->form_validation->set_rules('phone', 'Phone/Mobile Number', 'trim|required|xss_clean|is_numeric');
            $this->form_validation->set_rules('email', 'Phone/Mobile Number', 'trim|required|xss_clean');
            $this->form_validation->set_rules('fax', 'Phone/Mobile Number', 'trim|xss_clean');
            $this->form_validation->set_rules('business_regno', 'Business Registration #', 'trim|xss_clean|is_numeric');
            $this->form_validation->set_rules('organization', 'Organization', 'trim|xss_clean');
            $this->form_validation->set_rules('website', 'Phone/Mobile Number', 'trim|xss_clean');
            $this->form_validation->set_rules('contact_person', 'Contact Person', 'trim|required|xss_clean');
            $this->form_validation->set_rules('contact_person_mobilenum', 'Contact Person Phone/Mobile Number', 'trim|required|xss_clean|is_numeric');

            if (!$this->form_validation->run()) // validation hasn't been passed
            {
                redirect(BASEURL . 'employers/employerProfile');
            }
            else // passed validation proceed to post success logic
            {
                $form_data['emp_id'] = $this->authentication->getEmployerId();
                $form_data["comp_name"] = $this->input->post("company_name");                      
                $form_data["comp_desc"] = $this->input->post("comp_desc");          
                $form_data["comp_nature"] = $this->input->post("comp_nature");            
                $form_data["comp_type"] = $this->input->post("comp_type");            
                $form_data["address"] = $this->input->post("address");                     
                $form_data["city"] = $this->input->post("city");      
                $form_data["state"] = $this->input->post("state");        
                $form_data["country"] = $this->input->post("country");                                            
                $form_data["zipcode"] = $this->input->post("zipcode");            
                $form_data["phone"] = $this->input->post("phone");              
                $form_data["email"] = $this->input->post("email");    
                $form_data["fax"] = $this->input->post("fax");    
                $form_data["business_regno"] = $this->input->post("business_regno");    
                $form_data["organization"] = $this->input->post("organization");  
                $form_data["website"] = $this->input->post("website");  
                $form_data["comp_size"] = $this->input->post("comp_size");
                $form_data["dress_code"] = $this->input->post("dress_code");
                $form_data["working_hrs"] = $this->input->post("working_hrs");
                $form_data["spoken_lang"] = $this->input->post("spoken_lang");
                $form_data["contact_person"] = $this->input->post("contact_person");
                $form_data["contact_person_mobilenum"] = $this->input->post("contact_person_mobilenum");
                $this->session->set_userdata('employerProfile',$form_data);
                $this->employer_functions->update_table_details('employer_details',$form_data);

                $message = 'Profile has been updated!';
                $this->alertMessage(1, $message);
                redirect(BASEURL . 'employers/employerUpload','refresh');
            }
    }

    /**
     * view cancel promo
     *
     * @return void
     */
    public function employerUpload() {
        if ($this->authentication->isLoggedIn()) { 
            $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
            $data['footerData'] = $this->cms_function->getCmsFooterContentData();
            $data['empLogo'] = $this->employer_functions->getEmpLogo($this->authentication->getEmployerId());
            //var_dump($data['empLogo']);exit();
            $this->loadTemplate('Employer Upload', '', '', 'upload');
            $this->template->write_view('main_content', 'employer/employer_upload',$data);
            $this->template->write_view('footer_content', 'template/footer_template');
            $this->template->render();
        }else{
            redirect(BASEURL . 'ajkk/login/employer','refresh');
        }
    }

    /**
     * employerFinalized
     *
     * @return void
     */
    public function employerFinalized() {
        $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
        $data['footerData'] = $this->cms_function->getCmsFooterContentData();
        $this->loadTemplate('Employer Finalized', '', '', 'Finalized');
        $this->template->write_view('main_content', 'employer/employer_finalized',$data);
        $this->template->write_view('footer_content', 'template/footer_template');
        $this->template->render();
    }

    /**
     * employerBilling
     *
     * @return void
     */
    public function employerBilling($type=0) {
        $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
        $data['footerData'] = $this->cms_function->getCmsFooterContentData();
        $data['jobbilling'] = $this->employer_functions->getEmpBilling($this->authentication->getEmployerId(),$type);
        $data['fljbilling'] = $this->employer_functions->getFLEmpBilling($this->authentication->getEmployerId(),$type);
        if($type == 0){
            $data['billingType'] = 'unpaid';
        }else{
            $data['billingType'] = 'paid';
        }
        //var_dump($data['fljbilling']);exit();
        if($data['fljbilling'] == TRUE && $data['jobbilling'] == TRUE){
            $data['billing'] = array_merge($data['jobbilling'],$data['fljbilling']);     
        }elseif($data['fljbilling'] == TRUE && $data['jobbilling'] == FALSE){
            $data['billing'] = $data['fljbilling'];
        }elseif($data['fljbilling'] == FALSE && $data['jobbilling'] == TRUE){
            $data['billing'] = $data['jobbilling'];
        }
        
        //var_dump($billing);exit();
        $this->loadTemplate('Employer Billing', '', '', 'Billing');
        $this->template->write_view('main_content', 'employer/employer_billing',$data);
        $this->template->write_view('footer_content', 'template/footer_template');
        $this->template->render();
    }

    /**
     * paymentUpload
     *
     * @return void
     */
    public function paymentUpload($jobId='') {
        $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
        $data['footerData'] = $this->cms_function->getCmsFooterContentData();
        $data['jobId'] = $jobId;
        //var_dump($billing);exit();
        $this->loadTemplate('Employer Billing', '', '', 'Payment');
        $this->template->write_view('main_content', 'employer/payment_upload',$data);
        $this->template->write_view('footer_content', 'template/footer_template');
        $this->template->render();
    }

    /**
     * view cancel promo
     *
     * @return void
     */
    public function membershipExpired() {
        $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
        $data['footerData'] = $this->cms_function->getCmsFooterContentData();
        $this->loadTemplate('Job Konek', '', '', 'post job');
        $this->template->write_view('main_content', 'employer/expired_membership',$data);
        $this->template->write_view('footer_content', 'template/footer_template');
        $this->template->render();
    }

    /**
     * view postJob
     *
     * @return void
     */
    public function postJob($step,$jobId='') {
        if ($this->authentication->isLoggedIn()) {   
            $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
            $data['footerData'] = $this->cms_function->getCmsFooterContentData();
            $data['comp_name'] = $this->employer_functions->getEmployerCompName($this->authentication->getEmployerId());
            if($jobId!=''){
                $data['jobId'] = $jobId;
            }
            //var_dump($cn);exit();
            $this->loadTemplate('Job Konek', '', '', 'post job');
            switch ($step) {
                case 1:
                    $this->template->write_view('main_content', 'employer/postjob_stepone',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;
                
                case 2:
                    $this->template->write_view('main_content', 'employer/postjob_steptwo',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                case 3:
                    $data['jobInfo'] = $this->employer_functions->getJobInfoDetailed($jobId);
                    $data['isJobAvailedPromo'] = $this->employer_functions->isJobExistsPromo($jobId);
                    //var_dump($data['jobInfo']);exit();
                    $this->template->write_view('main_content', 'employer/postjob_stepthree',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                case 4: //job preview
                    $data['jobPreview'] = $this->employer_functions->getJobPost($jobId);
                    $data['jobPaymentDetails'] = $this->employer_functions->getJobPaymentDetails($jobId);
                    //var_dump($data['jobPaymentDetails']);exit();
                    $this->template->write_view('main_content', 'employer/postjob_stepfour',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                case 5: //edit
                    $data['jobInfo'] = $this->employer_functions->getJobInfo($jobId);
                    $this->session->set_userdata('location_region',$data['jobInfo']['jobDetails']['location_region']);
                    //var_dump($data['jobInfo']);exit();
                    $this->template->write_view('main_content', 'employer/postjob_stepone_edit',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                case 6: //edit jobdetails
                    $data['jobInfo'] = $this->employer_functions->getJobInfo($jobId);
                    //var_dump($data['jobInfo']);exit();
                    $this->session->set_userdata('sked_type',$data['jobInfo']['jobDetails']['sked_type']);
                    $this->session->set_userdata('position_level',$data['jobInfo']['jobDetails']['position_level']);
                    $this->session->set_userdata('yr_exp',$data['jobInfo']['jobDetails']['yr_exp']);
                    $this->session->set_userdata('specialization',$data['jobInfo']['jobDetails']['specialization']);
                    $this->session->set_userdata('salary_base',$data['jobInfo']['jobDetails']['salary_base']);
                    $this->session->set_userdata('currency',$data['jobInfo']['jobDetails']['currency']);
                    $this->session->set_userdata('salary_min',$data['jobInfo']['jobDetails']['salary_min']);
                    $this->session->set_userdata('salary_max',$data['jobInfo']['jobDetails']['salary_max']);
                    $this->session->set_userdata('salary_type',$data['jobInfo']['jobDetails']['salary_type']);
                    $this->session->set_userdata('show_salary',$data['jobInfo']['jobDetails']['show_salary']);
                    $this->session->set_userdata('jobEducReq',$data['jobInfo']['jobDetails']['jobEducReq']);
                    //var_dump($this->session->userdata('jobEducReq'));exit();
                    $this->template->write_view('main_content', 'employer/postjob_steptwo_edit',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                case 7: //last step
                    $data['jobInfo'] = $this->employer_functions->getJobInfo($jobId);
                    $this->template->write_view('main_content', 'employer/postjob_laststep',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                default:
                    # code...
                    break;
            }
            $this->template->render();
        }else{
            redirect(BASEURL . 'ajkk/login/employer','refresh');
        }
    }

    /**
     * view availFreelancePromo
     *
     * @return void
     */
    public function availFreelancePromo() {
        if (!$this->authentication->isLoggedIn()) { 
            redirect(BASEURL . 'ajkk/login/employer','refresh');
        }else{
            //insert project promo
            $flJobId = $this->input->post("fljobId");
            if(!$this->employer_functions->isFreelanceJobExists($flJobId)){
                if($this->input->post("flPromo") != ''){
                    foreach($this->input->post("flPromo") as $fp)
                    {
                         $fl_data['job_id'] = $flJobId;
                         $fl_data['emp_id'] = $this->authentication->getEmployerId();
                         $fl_data['promo']= strtolower($fp);
                         $this->employer_functions->insert_table_details('avail_flpromo',$fl_data);
                    }

                    redirect(BASEURL . 'employers/postFreelanceJob/3/'.$flJobId);
                }else{
                    $message = 'You must select atleast choose one in the promo list, thank you!';
                    $this->alertMessage(2, $message);
                    redirect(BASEURL . 'employers/postFreelanceJob/2/'.$flJobId);
                }
            }
            else{
                redirect(BASEURL . 'employers/home','refresh');
            }
        }
    }

    /**
     * view availJobPromo
     *
     * @return void
     */
    public function availJobPromo() {
        if (!$this->authentication->isLoggedIn()) { 
            redirect(BASEURL . 'ajkk/login/employer','refresh');
        }else{
            //insert project promo
            $jobId = $this->input->post("jobId");
            if(!$this->employer_functions->isJobExistsPromo($jobId)){
                if($this->input->post("jobPromo") != ''){
                    foreach($this->input->post("jobPromo") as $jp)
                    {
                         $jp_data['job_id'] = $jobId;
                         $jp_data['emp_id'] = $this->authentication->getEmployerId();
                         $jp_data['promo']= strtolower($jp);
                         $this->employer_functions->insert_table_details('avail_jobpromo',$jp_data);
                    }

                    redirect(BASEURL . 'employers/postJob/4/'.$jobId);
                }else{
                    $message = 'You must select atleast choose one in the promo list, thank you!';
                    $this->alertMessage(2, $message);
                    redirect(BASEURL . 'employers/postJob/3/'.$jobId);
                }
            }
            else{
                redirect(BASEURL . 'employers/home','refresh');
            }
        }
    }

    /**
     * view postFreelanceJob
     *
     * @return void
     */
    public function postFreelanceJob($step,$fljobId='') {
        if ($this->authentication->isLoggedIn()) {   
            $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
            $data['footerData'] = $this->cms_function->getCmsFooterContentData();
            $data['comp_name'] = $this->employer_functions->getEmployerCompName($this->authentication->getEmployerId());

            if($fljobId!=''){
                $data['fljobId'] = $fljobId;
            }
            //var_dump($cn);exit();
            $this->loadTemplate('JobKonek', '', '', 'create freelance job');
            switch ($step) {
                case 1:
                    $this->template->write_view('main_content', 'employer/postfljob_stepone',$data);
                    //$this->template->write_view('footer_content', 'template/footer_template');
                    break;
                
                case 2:
                    $data['fljobPreview'] = $this->employer_functions->getFreelanceJob($fljobId);
                    $data['isfljobAvailedPromo'] = $this->employer_functions->isFreelanceJobExists($fljobId);
                    //var_dump($data['isfljobAvailedPromo']);exit();
                    $this->template->write_view('main_content', 'employer/postfljob_steptwo',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                case 3:
                    $data['fljobPreview'] = $this->employer_functions->getFreelanceJob($fljobId);
                    $data['fljobPaymentDetails'] = $this->employer_functions->getFreelanceJobPaymentDetails($fljobId);
                    //var_dump($data['fljobPaymentDetails']);exit();
                    $this->template->write_view('main_content', 'employer/postfljob_stepthree',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                case 4:
                    $data['fljobPreview'] = $this->employer_functions->getFreelanceJob($fljobId);
                    $data['fljobPaymentDetails'] = $this->employer_functions->getFreelanceJobPaymentDetails($fljobId);
                    //var_dump($data['fljobPaymentDetails']);exit();
                    $this->template->write_view('main_content', 'employer/postfljob_laststep',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                case 5:
                    $data['fljobPreview'] = $this->employer_functions->getFreelanceJobInfo($fljobId);

                    //$this->session->set_userdata('payment_type',$data['fljobPreview']['jobDetails']['payment_type']);

                    //var_dump($data['fljobPreview']);exit();
                    $this->template->write_view('main_content', 'employer/postfljob_stepone_edit',$data);
                    $this->template->write_view('footer_content', 'template/footer_template');
                    break;

                default:
                    # code...
                    break;
            }
            $this->template->render();
        }else{
            redirect(BASEURL . 'employers/home','refresh');
        }
    }

    /**
     * view jobPreview
     *
     * @return void
     */
    function jobPreview($jobId) {
        if (!$this->authentication->isLoggedIn()) {
            
            //$data['employer'] = $this->employer_functions->getEmployerById($this->authentication->getEmployerId());
            //$data['playeraccount'] = $this->player_functions->getPlayerAccount($this->authentication->getPlayerId());

            redirect(BASEURL . 'ajkk/login/employer');
        } else {
            
            $data['jobInfo'] = $this->employer_functions->getJobInfoDetailed($jobId);
            $data['empInfo'] = $this->employer_functions->getEmployerInfo($this->authentication->getEmployerId());
            $data['empLogo'] = $this->employer_functions->getEmpLogo($this->authentication->getEmployerId());
            //var_dump($data['empLogo']); exit();
            //$this->loadTemplate('Welcome To JobKonek', '', '', 'home');

            $this->load->view('employer/postjob_preview', $data);

            //$this->template->render();
        }
    }

    /**
     * view jobPreview
     *
     * @return void
     */
    function freelancejobPreview($jobId) {
        if (!$this->authentication->isLoggedIn()) {
            
            //$data['employer'] = $this->employer_functions->getEmployerById($this->authentication->getEmployerId());
            //$data['playeraccount'] = $this->player_functions->getPlayerAccount($this->authentication->getPlayerId());

            redirect(BASEURL . 'ajkk/login/employer');
        } else {
            
            $data['jobInfo'] = $this->employer_functions->getFreelanceJob($jobId);
            $data['empInfo'] = $this->employer_functions->getEmployerInfo($this->authentication->getEmployerId());
            $data['empLogo'] = $this->employer_functions->getEmpLogo($this->authentication->getEmployerId());
            //var_dump($data['jobInfo']); exit();
            //$this->loadTemplate('Welcome To JobKonek', '', '', 'home');

            $this->load->view('employer/postfreelancejob_preview', $data);

            //$this->template->render();
        }
    }

    /**
     * employerProfile
     *
     * @return void
     */
    function employerProfile() {
        if (!$this->authentication->isLoggedIn()) {
            
            //$data['employer'] = $this->employer_functions->getEmployerById($this->authentication->getEmployerId());
            //$data['playeraccount'] = $this->player_functions->getPlayerAccount($this->authentication->getPlayerId());

            redirect(BASEURL . 'ajkk/login/employer');
        } else {
            
            //$data['jobInfo'] = $this->employer_functions->getJobInfo($jobId);
            $data['empInfo'] = $this->employer_functions->getEmployerInfo($this->authentication->getEmployerId());
            //var_dump($data['empInfo']);exit();
            //var_dump($data['footerData']); exit();
            $this->loadTemplate('Edit Employer Profile', '', '', 'employer profile');

            $this->template->write_view('main_content', 'employer/employer_editprofile', $data);
            $this->template->write_view('footer_content', 'template/footer_template');
            $this->template->render();
        }
    }

    /**
     * viewEmployerProfile
     *
     * @return void
     */
    function viewEmployerProfile() {
        if (!$this->authentication->isLoggedIn()) {
            
            //$data['employer'] = $this->employer_functions->getEmployerById($this->authentication->getEmployerId());
            //$data['playeraccount'] = $this->player_functions->getPlayerAccount($this->authentication->getPlayerId());

            redirect(BASEURL . 'ajkk/login/employer');
        } else {
            
            //$data['jobInfo'] = $this->employer_functions->getJobInfo($jobId);
            $data['empInfo'] = $this->employer_functions->getEmployerInfo($this->authentication->getEmployerId());
            //var_dump($data['empInfo']);exit();
            //var_dump($data['footerData']); exit();
            $this->loadTemplate('View Employer Profile', '', '', 'Employer Profile');

            $this->template->write_view('main_content', 'employer/viewCompanyProfile', $data);
            $this->template->write_view('footer_content', 'template/footer_template');
            $this->template->render();
        }
    }

    /**
     * getSkills
     *
     * @return void
     */
    public function getSkills(){
        $keyword=$this->input->post('keyword');
        //eyword='apple';
        $data=$this->employer_functions->getSkills($keyword);   
        //var_dump($data);exit();
        echo json_encode($data);
    }

    /**
     * submitPaymentUpload
     *
     * @return  rendered template
     */
    public function submitPaymentUpload() {
        $bankaccount = $this->input->post('bankaccount');
        $depositJobId = $this->input->post('depositJobId');
        $depositAmount = $this->input->post('depositAmount');
        $depositDateTime = $this->input->post('depositDateTime');
        $depositTransRefNo = $this->input->post('depositTransactionRef');
        $contactName = $this->input->post('contactName');
        $contactNo = $this->input->post('contactNo');
        $contactEmail = $this->input->post('contactEmail');
        $paymentIp = $this->input->post('paymentIp');
        $geolocation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$paymentIp));        

        $this->session->set_userdata('bankaccount',$bankaccount);
        $this->session->set_userdata('depositJobId',$depositJobId);
        $this->session->set_userdata('depositAmount',$depositAmount);
        $this->session->set_userdata('depositDateTime',$depositDateTime);
        $this->session->set_userdata('depositTransRefNo',$depositTransRefNo);
        $this->session->set_userdata('contactName',$contactName);
        $this->session->set_userdata('contactNo',$contactNo);
        $this->session->set_userdata('contactEmail',$contactEmail);

        $today = date("Y-m-d H:i:s");
        $employerId = $this->authentication->getEmployerId();

        $depositSlipURL = $this->input->post('banner_url');
        $fileType = substr($depositSlipURL, strrpos($depositSlipURL, '.') + 1);                
        $path = realpath(APPPATH . '../public/resources/images/depositslip');

        //upload image
        $path_image = $_FILES['userfile']['name'];
        $ext = pathinfo($path_image, PATHINFO_EXTENSION);

        if(strcasecmp($ext, 'jpg') != 0 && strcasecmp($ext, 'jpeg') != 0  && strcasecmp($ext, 'gif') != 0  && strcasecmp($ext, 'png') != 0 ) {
            $this->alertMessage(2, 'Only Image is allowed for upload');
            redirect(BASEURL . 'employers/paymentUpload/'.$depositJobId);
        } else {
            $depositSlipName = 'localbank-deposit-slip-'.$employerId.'-'.$this->employer_functions->generateRandomCode();
            $config = array(
                'allowed_types' => 'jpg|jpeg|gif|png',
                'upload_path' => $path,
                'max_size' => 100000,
                'overwrite' => true,
                'file_name' => $depositSlipName
            );

            $this->load->library('upload', $config);
            $this->upload->do_upload();

            $localBankDepositDetails = array(
                    'employerId' => $employerId,
                    'depositJobId' => $depositJobId,
                    'bankaccountId' => $bankaccount,
                    'depositSlipName' => $depositSlipName.'.'.$fileType,
                    'depositAmount' => $depositAmount,                    
                    'depositTransRefNo' => $depositTransRefNo,
                    'depositDateTime' => $depositDateTime,
                    'contactName' => $contactName, 
                    'contactNo' => $contactNo, 
                    'contactEmail' => $contactEmail,
                    'depositLocation' => $geolocation['geoplugin_city'].','.$geolocation['geoplugin_countryName'],
                    'transactionTime' => $today,
                    'status' => 1
                );

            $this->employer_functions->sendPaymentRequest($localBankDepositDetails);

            $this->alertMessage(1, 'Your Payment Has Been Sent, we will review your payment and get back to you asap! Thank you!');
            redirect(BASEURL . 'employers/employerBilling');
        }
    }

     /**
     * job_details
     *
     * @return void
     */
    public function applicantManager($status=0,$jobType=1) {
        $this->session->userdata('currentLanguage') == '' ? $this->session->userdata('currentLanguage') == '1' : '';
        if (!$this->authentication->isLoggedIn()) {
            redirect(BASEURL . 'ajkk/login/employer');
        }else{
            $this->loadTemplate('Applicant Manager', '', '', 'New Applicant');
            $data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
            $data['footerData'] = $this->cms_function->getCmsFooterContentData();
            $data['status']= $status;
            $this->session->set_userdata('applicantManagerCurrentPage',$status);

            $empId = $this->authentication->getEmployerId();
            if($jobType == 1){
                $data['newApplicantCnt'] = $this->employer_functions->getAllApplicant(0,$empId);
                $data['shortlistedCnt'] = $this->employer_functions->getAllApplicant(1,$empId);
                $data['forInterviewCnt'] = $this->employer_functions->getAllApplicant(2,$empId);
                $data['unqualifiedCnt'] = $this->employer_functions->getAllApplicant(3,$empId);
                $data['allApplicant'] = $this->employer_functions->getAllApplicant($status,$empId); 
                $data['jobType'] = 'POSTED JOB APPLICANTS';
                $this->template->write_view('main_content', 'employer/manage_applicant', $data);
            }elseif($jobType == 2){
                
                $data['newApplicantCnt'] = $this->employer_functions->getAllFreelanceJobApplicant(0,$empId);
                $data['shortlistedCnt'] = $this->employer_functions->getAllFreelanceJobApplicant(1,$empId);
                $data['forInterviewCnt'] = $this->employer_functions->getAllFreelanceJobApplicant(2,$empId);
                $data['unqualifiedCnt'] = $this->employer_functions->getAllFreelanceJobApplicant(3,$empId);
                $data['allApplicant'] = $this->employer_functions->getAllFreelanceJobApplicant($status,$empId);    
                $data['jobType'] = 'FREELANCE JOB APPLICANTS';
                $this->template->write_view('main_content', 'employer/managefreelance_applicant', $data);
            }

            
            $this->template->write_view('footer_content', 'template/footer_template');
            $this->template->render();
        }
    }
}