<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajkk extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(array('form_validation', 'authentication', 'ajkk_functions', 'cms_function', 'pagination', 'employer_functions', 'member_functions', 'ci_date', 'template'));
	}

	/**
	 * set message for users
	 *
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

	/**
	 * Loads template for view based on regions in
	 * config > template.php
	 *
	 */
	private function loadTemplate($title, $description, $keywords, $activenav) {
		$this->template->add_css(CSSPATH . 'bootstrap.min.css');
		$this->template->add_css(CSSPATH . 'bootstrap-theme.min.css');
		$this->template->add_js('resources/js/player/player.js');
		$this->template->add_js('resources/js/home/toucheffects.js');
		$this->template->write('skin', 'template1.css');
		$this->template->write('title', $title);
		$this->template->write('description', $description);
		$this->template->write('keywords', $keywords);
		$this->template->write('activenav', $activenav);
		$this->template->write('username', $this->authentication->getUsername());
		$this->template->write('player_id', $this->authentication->getPlayerId());
		$this->template->write('user_type', 'member');
		//var_dump($data['data']['mainwallet']['totalBalanceAmount']);exit();
	}

	function index() {
		//var_dump(BASEURL);
		redirect('ajkk/welcome');
	}

	/**
	 * view welcome/homepage
	 *
	 * @return void
	 */
	public function welcome() {
		$this->session->userdata('currentLanguage') == '' ? $this->session->userdata('currentLanguage') == '1' : '';
		if ($this->authentication->isLoggedIn()) {

			$data['player'] = $this->ajkk_functions->getPlayerById($this->authentication->getPlayerId());
			//$data['playeraccount'] = $this->player_functions->getPlayerAccount($this->authentication->getPlayerId());

			$data['news'] = $this->ajkk_functions->getAllNews();
			//$data['playermainwallet'] = $this->player_functions->getAllNews();
			//var_dump($data['playermainwallet'])exit();

			$bannerType = 1; //home banner big
			$data['homemainbanner'] = $this->cms_function->getCmsBanner($bannerType);

			$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
			$data['footerData'] = $this->cms_function->getCmsFooterContentData();
			//var_dump($data['footerlinks']);exit();
			//var_dump($data['footerData']); exit();
			$this->loadTemplate('Welcome To OG Website', '', '', 'home');
			$this->template->write_view('main_content', 'ajkk/welcome', $data);
			$this->template->write_view('footer_content', 'template/footer_template');
			$this->template->render();
		} else {

			$data['news'] = $this->ajkk_functions->getAllNews();

			$bannerType = 1; //home banner big
			$data['homemainbanner'] = $this->cms_function->getCmsBanner($bannerType);

			$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
			$data['footerData'] = $this->cms_function->getCmsFooterContentData();
			//var_dump($data['footerData']); exit();
			$this->loadTemplate('Welcome To OG Website', '', '', 'home');

			$this->template->write_view('main_content', 'ajkk/welcome', $data);
			$this->template->write_view('footer_content', 'template/footer_template');

			$this->template->render();
		}
	}

	/**
	 * view contact us
	 *
	 * @return void
	 */
	function jobs($type) {
		$this->loadTemplate('Jobs', '', '', 'Jobs');
		$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
		$data['footerData'] = $this->cms_function->getCmsFooterContentData();
		switch ($type) {
			case 'freelancejobs':
				// $data['count_post'] = count($this->employer_functions->getTotalJobsCnt(2,1));
				// $data['freelancejobs'] = $this->employer_functions->getFreelanceJobs();
				// $this->template->write_view('main_content', 'ajkk/freelancejobs',$data);
				$searchdata = array('search' => '',
					'project_type' => '',
					'budget_range' => '');

				$this->session->set_userdata('searchfreelancejobs', $searchdata);
				//$this->jobs('searchfreelancejobs');
				redirect(BASEURL . 'ajkk/jobs/searchfreelancejobs', 'refresh');
				break;

			case 'searchfreelancejobs':
				$searchdata = $this->session->userdata('searchfreelancejobs');
				if ($searchdata['search'] == '' && $searchdata['project_type'] == '' && $searchdata['budget_range'] == '') {
					$data['count_post'] = count($this->employer_functions->getTotalJobsCnt(2, 1));
				} else {
					$data['count_post'] = count($this->employer_functions->searchFreelanceJobs());
				}

				$data['freelancejobs'] = $this->employer_functions->searchFreelanceJobs();
				$this->template->write_view('main_content', 'ajkk/freelancejobs', $data);
				break;

			case 'fulltimejobs':

				$searchdata = array('search' => '',
					'location' => '',
					'location_region' => '',
					'budget_range' => '');

				$this->session->set_userdata('searchfulltimejobs', $searchdata);
				//$this->jobs('searchfulltimejobs');
				redirect(BASEURL . 'ajkk/jobs/searchfulltimejobs', 'refresh');

				break;

			case 'searchfulltimejobs':
				$searchdata = $this->session->userdata('searchfulltimejobs');
				if ($searchdata['search'] == '' && $searchdata['location_region'] == '' && $searchdata['budget_range'] == '') {
					$data['count_post'] = count($this->employer_functions->getTotalJobsCnt(1, 1));
				} else {
					$data['count_post'] = count($this->employer_functions->searchFulltimeJobs());
				}

				$data['fulltimejobs'] = $this->employer_functions->searchFulltimeJobs();
				$this->template->write_view('main_content', 'ajkk/fulltimejobs', $data);
				break;

			case 'parttimejobs':
				$searchdata = array('search' => '',
					'location' => '',
					'location_region' => '',
					'budget_range' => '');

				$this->session->set_userdata('searchparttimejobs', $searchdata);
				//$this->jobs('searchfulltimejobs');
				redirect(BASEURL . 'ajkk/jobs/searchparttimejobs', 'refresh');

				break;

			case 'searchparttimejobs':
				$searchdata = $this->session->userdata('searchparttimejobs');
				if ($searchdata['search'] == '' && $searchdata['location_region'] == '' && $searchdata['budget_range'] == '') {
					$data['count_post'] = count($this->employer_functions->getTotalJobsCnt(3, 3));
				} else {
					$data['count_post'] = count($this->employer_functions->searchParttimeJobs());
				}

				$data['parttimejobs'] = $this->employer_functions->searchParttimeJobs();
				$this->template->write_view('main_content', 'ajkk/parttimejobs', $data);
				break;

			case 'agencyjobs':
				$searchdata = array('search' => '',
					'location' => '',
					'location_region' => '',
					'budget_range' => '');

				$this->session->set_userdata('searchagencyjobs', $searchdata);
				//$this->jobs('searchfulltimejobs');
				redirect(BASEURL . 'ajkk/jobs/searchagencyjobs', 'refresh');

				break;

			case 'searchagencyjobs':
				$searchdata = $this->session->userdata('searchagencyjobs');
				if ($searchdata['search'] == '' && $searchdata['location_region'] == '' && $searchdata['budget_range'] == '') {
					$data['count_post'] = count($this->employer_functions->getTotalJobsCnt(4, 4));
				} else {
					$data['count_post'] = count($this->employer_functions->searchAgencyJobs());
				}

				$data['agencyjobs'] = $this->employer_functions->searchAgencyJobs();
				//var_dump($data['agencyjobs']);exit();
				$this->template->write_view('main_content', 'ajkk/agencyjobs', $data);
				break;

			default:
				# code...
				break;
		}

		$this->template->write_view('footer_content', 'template/footer_template');
		$this->template->render();
	}

	/**
	 * @description:    Ajax for getting other posts by show more btn
	 * @param:          int - last job_id
	 */
	function getFreelancePosts() {
		$load = htmlentities(strip_tags($_POST['load'])) * 5;
		$data['freelancejobs'] = $this->employer_functions->getFreelanceJobsAjax($load);
		$this->load->view('ajkk/freelancejobs_ajax', $data);
	}

	/**
	 * @description:    Ajax for getting other posts by show more btn
	 * @param:          int - last job_id
	 */
	function getJobPosts() {
		$load = htmlentities(strip_tags($_POST['load'])) * 5;
		$data['fulltimejobs'] = $this->employer_functions->getFulltimeJobsAjax($load);
		//echo json_encode($data);
		$this->load->view('ajkk/fulltimejobs_ajax', $data);
	}

	/**
	 * @description:    Ajax for getting other posts by show more btn
	 * @param:          int - last job_id
	 */
	function getParttimeJobPosts() {
		$load = htmlentities(strip_tags($_POST['load'])) * 5;
		$data['parttimejobs'] = $this->employer_functions->getParttimeJobsAjax($load);
		//echo json_encode($data);
		$this->load->view('ajkk/parttimejobs_ajax', $data);
	}

	/**
	 * @description:    Ajax for getting other posts by show more btn
	 * @param:          int - last job_id
	 */
	function getAgencyJobPosts() {
		$load = htmlentities(strip_tags($_POST['load'])) * 5;
		$data['agencyjobs'] = $this->employer_functions->getAgencyJobsAjax($load);
		//echo json_encode($data);
		$this->load->view('ajkk/agencyjobs_ajax', $data);
	}

	/**
	 * login
	 *
	 * @return void
	 */
	function login($type) {
		$this->loadTemplate('Jobs', '', '', 'Jobs');
		$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
		$data['footerData'] = $this->cms_function->getCmsFooterContentData();
		if ($type == 'member') {
			$this->template->write_view('main_content', 'auth/member_login', $data);
		} else {
			$this->template->write_view('main_content', 'auth/employer_login', $data);
		}

		$this->template->write_view('footer_content', 'template/footer_template');
		$this->template->render();
	}

	/**
	 * view freelancejobDetails
	 *
	 * @return void
	 */
	function freelancejobDetails($flJobId) {

		$data['jobInfo'] = $this->employer_functions->getFreelanceJob($flJobId);
		//$data['empInfo'] = $this->employer_functions->getEmployerInfo($this->authentication->getEmployerId());
		//$data['empLogo'] = $this->employer_functions->getEmpLogo($this->authentication->getEmployerId());
		$data['jobApplyExists'] = $this->member_functions->isFreelanceJobExists($flJobId, $this->authentication->getPlayerId());
		$data['jobSaveExists'] = $this->member_functions->isFreelanceJobSaveExists($flJobId, $this->authentication->getPlayerId());

		$memberId = $this->authentication->getPlayerId();
		$logData = array('jobId' => $flJobId, 'member_id' => $memberId, 'jobtype' => 2);
		$this->member_functions->logViewJob($logData);

		//var_dump($data['jobExists']); exit();
		//$this->loadTemplate('Welcome To JobKonek', '', '', 'home');

		$this->load->view('employer/postfreelancejob_preview', $data);

		//$this->template->render();
	}

	/**
	 * view jobPreview
	 *
	 * @return void
	 */
	function jobDetails($jobId) {
		$data['jobInfo'] = $this->employer_functions->getPublishedJobDetailed($jobId);
		$data['jobApplyExists'] = $this->member_functions->isJobExists($jobId, $this->authentication->getPlayerId());
		$data['jobSaveExists'] = $this->member_functions->isJobSaveExists($jobId, $this->authentication->getPlayerId());
		//var_dump($data['jobApplyExists']);exit();
		$memberId = $this->authentication->getPlayerId();
		$logData = array('jobId' => $jobId, 'member_id' => $memberId, 'jobtype' => 1);
		$this->member_functions->logViewJob($logData);

		$this->load->view('employer/publishedjob_details', $data);
	}

	/**
	 * apply job
	 *
	 * @return void
	 */
	function applyNow($jobId = '') {
		// if($jobId !=''){
		//     //$this->session->set_userdata('applyJobId',$jobId);
		//     redirect(BASEURL . 'ajkk/applyNonMember/'.$jobId);
		// }
		$this->session->set_userdata('applyJobId', $jobId);
		redirect(BASEURL . 'auth/login');
	}

	/**
	 * applyNonMember
	 *
	 * @return void
	 */
	function applyNonMember($jobId = '') {
		$data['jobId'] = $jobId;
		$data['jobInfo'] = $this->employer_functions->getPublishedJobDetailed($jobId);
		$this->template->write_view('main_content', 'ajkk/nonmember_application_form', $data);
		$this->template->write_view('footer_content', 'template/footer_template');
		$this->template->render();
	}

	/**
	 * sendNonMemberApplication
	 *
	 * @return void
	 */
	function sendNonMemberApplication() {
		$jobId = $this->input->post('jobId');
		$empId = $this->input->post('empId');
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$email = $this->input->post('email');
		$contactNo = $this->input->post('contactNo');
		$password = $this->input->post('password');
		//var_dump($fname);exit();

		if ($password != '') {

			$forbidden_names = array('admin', 'moderator', 'hoster', 'administrator', 'mod');
			$checkUsernameExist = $this->member_functions->checkUsernameExist($email);
			$checkEmailExist = $this->member_functions->checkEmailExist($email);

			if ($checkUsernameExist) {
				$message = "<b>" . $email . "</b> " . lang('notify.3');
				$this->alertMessage(2, $message);
				$this->applyNonMember($jobId);
			} elseif (in_array($email, $forbidden_names)) {
				$message = "<b>" . $email . "</b> " . lang('notify.4');
				$this->alertMessage(2, $message);
				$this->applyNonMember($jobId);
			} elseif ($checkEmailExist) {
				//$message = "<b>" . $email . "</b> Email is already existed, Please choose another email";
				$message = "<b>" . $email . "</b> " . lang('notify.5');
				$this->alertMessage(2, $message);
				$this->applyNonMember($jobId);
			} else {
				$today = date("Y-m-d H:i:s");
				$data = array(
					'username' => $email,
					'email' => $email,
					'password' => $password,
					'verify' => $this->member_functions->getRandomVerificationCode(),
					'createdOn' => $today,
				);

				//var_dump($data);exit();
				$this->member_functions->insertMember($data);

				$player = $this->member_functions->checkUsernameExist($email);

				// $this->player_functions->editPlayer($data, $player['playerId']);

				$data = array(
					'playerId' => $player['playerId'],
					'firstName' => $fname,
					'lastName' => $lname,
					'registrationIp' => $this->input->ip_address(),
					'registrationWebsite' => BASEURL,
				);
				$this->member_functions->insertMemberDetails($data);

				$this->authentication->login($email, $password);
				$this->session->set_userdata('new_user', true);

				$data = array(
					'jobId' => $jobId,
					'empId' => $empId,
					'applicantId' => $player['playerId'],
					'candidate_status' => 0,
				);

				$this->member_functions->applyJob($data);

				$applyJobMsg = 'Your application has been sent!';
				$message = lang('notify.9') . '. ' . $applyJobMsg;
				$this->alertMessage(1, $message);

				$this->session->set_userdata('usertype', 'member');

				redirect(BASEURL . 'ajkk/welcome/' . $player['playerId']);
			}
		} else {
			$data = array(
				'jobId' => $jobId,
				'empId' => $empId,
				'candidate_status' => 0,
			);

			$this->member_functions->applyJob($data);

			$applyJobMsg = 'Your application has been sent!';
			$message = lang('notify.9') . '. ' . $applyJobMsg;
			$this->alertMessage(1, $message);

			redirect(BASEURL . 'ajkk/welcome/' . $player['playerId']);
		}
		// $data['jobId'] = $jobId;
		// $data['jobInfo'] = $this->employer_functions->getPublishedJobDetailed($jobId);
		// $this->template->write_view('main_content', 'ajkk/nonmember_application_form',$data);
		// $this->template->write_view('footer_content', 'template/footer_template');
		// $this->template->render();
	}

	/**
	 * apply job
	 *
	 * @return void
	 */
	function searchFreelanceJob() {
		$data = array('search' => $this->input->post('search'),
			'project_type' => $this->input->post('project_type'),
			'budget_range' => $this->input->post('budget_range'));

		$this->session->set_userdata('searchfreelancejobs', $data);
		$this->jobs('searchfreelancejobs');
		//var_dump($data);exit();
	}

	/**
	 * apply job
	 *
	 * @return void
	 */
	function searchFulltimeJob() {
		$data = array('search' => $this->input->post('search'),
			'location' => $this->input->post('location'),
			'location_region' => $this->input->post('location_region'),
			'budget_range' => $this->input->post('budget_range'));

		$this->session->set_userdata('searchfulltimejobs', $data);
		$this->jobs('searchfulltimejobs');
		//var_dump($data);exit();
	}

	/**
	 * searchParttimeJob
	 *
	 * @return void
	 */
	function searchParttimeJob() {
		$data = array('search' => $this->input->post('search'),
			'location' => $this->input->post('location'),
			'location_region' => $this->input->post('location_region'),
			'budget_range' => $this->input->post('budget_range'));

		$this->session->set_userdata('searchparttimejobs', $data);
		$this->jobs('searchparttimejobs');
		//var_dump($data);exit();
	}

	/**
	 * searchAgencyJob
	 *
	 * @return void
	 */
	function searchAgencyJob() {
		$data = array('search' => $this->input->post('search'),
			'location' => $this->input->post('location'),
			'location_region' => $this->input->post('location_region'),
			'budget_range' => $this->input->post('budget_range'));

		$this->session->set_userdata('searchagencyjobs', $data);
		$this->jobs('searchagencyjobs');
		//var_dump($data);exit();
	}
}