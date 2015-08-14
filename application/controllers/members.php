<?php

class Members extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(array('form_validation', 'authentication', 'member_functions', 'template', 'pagination', 'cms_function'));
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
		redirect(BASEURL . 'online/welcome');
	}

	/**
	 * Loads template for view based on regions in
	 * config > template.php
	 *
	 */
	private function loadTemplate($title, $description, $keywords, $activenav) {
		$this->template->add_js('resources/js/player/player.js');
		//$this->template->add_js('resources/js/jquery.numeric.min.js');
		$this->template->write('skin', 'template1.css');
		$this->template->write('title', $title);
		$this->template->write('description', $description);
		$this->template->write('keywords', $keywords);
		$this->template->write('activenav', $activenav);
		$this->template->write('username', $this->authentication->getUsername());
		$this->template->write('player_id', $this->authentication->getPlayerId());
	}

	function postEditPlayer() {
		$this->form_validation->set_rules('language', 'Language', 'trim|required|xss_clean');
		$this->form_validation->set_rules('contact_number', 'Contact Number', 'trim|required|xss_clean|is_numeric');
		$this->form_validation->set_rules('im_account', 'Messenger Account', 'trim|xss_clean');
		$this->form_validation->set_rules('im_type', 'Messenger', 'trim|xss_clean');
		$this->form_validation->set_rules('im_account2', 'Messenger Account', 'trim|xss_clean');
		$this->form_validation->set_rules('im_type2', 'Messenger 2', 'trim|xss_clean');
		$this->form_validation->set_rules('country', 'Country', 'trim|required|xss_clean');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|xss_clean');
		$this->form_validation->set_rules('city', 'City', 'trim|required|xss_clean');
		$this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required|xss_clean');

		if (!empty($this->input->post('im_type'))) {
			if ($this->input->post('im_type') == 'QQ') {
				$this->form_validation->set_rules('im_account', 'IM 1', 'trim|required|xss_clean|numeric');
			} elseif ($this->input->post('im_type') == 'Skype' || $this->input->post('im_type') == 'MSN') {
				$this->form_validation->set_rules('im_account', 'IM 1', 'trim|required|xss_clean');
			} else {
				$this->form_validation->set_rules('im_account', 'IM 1', 'trim|required|xss_clean');
			}
		}

		if (!empty($this->input->post('im_type2'))) {
			if ($this->input->post('im_type2') == 'QQ') {
				$this->form_validation->set_rules('im_account2', 'IM 2', 'trim|required|xss_clean|numeric');
			} elseif ($this->input->post('im_type2') == 'Skype' || $this->input->post('im_type2') == 'MSN') {
				$this->form_validation->set_rules('im_account2', 'IM 2', 'trim|required|xss_clean');
			} else {
				$this->form_validation->set_rules('im_account2', 'IM 2', 'trim|required|xss_clean');
			}
		}

		if ($this->form_validation->run() == false) {
			//$message = "Some fields didnt meet the requirements. Please check again";
			$message = lang('notify.22');
			$this->alertMessage(2, $message);
			$this->playerSettings();
		} else {
			$country = $this->input->post('country');
			$address = $this->input->post('address');
			$city = $this->input->post('city');
			$zipcode = $this->input->post('zipcode');
			$language = $this->input->post('language');
			$contact_number = $this->input->post('contact_number');
			$im_account = $this->input->post('im_account');
			$im_type = $this->input->post('im_type');
			$im_account2 = $this->input->post('im_account2');
			$im_type2 = $this->input->post('im_type2');
			$today = date("Y-m-d H:i:s");

			$player = $this->player_functions->getPlayerById($this->authentication->getPlayerId());

			if (!empty($im_type) && !empty($im_account) && !empty($im_type2) && !empty($im_account2) && $im_account == $im_account2) {
				//$message = "Your IM Account 1 should be different to IM Account 2";
				$message = lang('notify.23');
				$this->alertMessage(2, $message);
				$this->playerSettings();
			} else {
				$data = array(
					'updatedOn' => $today,
				);

				$this->player_functions->editPlayer($data, $this->authentication->getPlayerId());

				//$new_player = $this->player_functions->checkUsernameExist($username);

				$data = array(
					'language' => $language,
					'country' => $country,
					'address' => $address,
					'city' => $city,
					'zipcode' => $zipcode,
					'contactNumber' => $contact_number,
					'imAccount' => $im_account,
					'imAccountType' => $im_type,
					'imAccount2' => $im_account2,
					'imAccountType2' => $im_type2,
				);

				//$this->player_functions->compareChanges($data, $this->authentication->getPlayerId());
				$this->player_functions->editPlayerDetails($data, $this->authentication->getPlayerId());

				//$message = "Your account has been edited";
				$message = lang('notify.24');
				$this->alertMessage(1, $message);
				redirect(BASEURL . 'player_controller/playerSettings/' . $this->authentication->getPlayerId());
			}
		}
	}

	/**
	 * view cancel promo
	 *
	 * @return void
	 */
	public function changePassword() {
		$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
		$data['footerData'] = $this->cms_function->getCmsFooterContentData();
		$this->loadTemplate('Player Settings', '', '', 'settings');
		$this->template->write_view('main_content', 'player/change_password', $data);
		$this->template->render();
	}

	/**
	 * view bank details
	 *
	 * @return void
	 */
	// public function bankDetails() {
	//     $data['bank_details'] = $this->player_functions->getBankDetails($this->authentication->getPlayerId());
	//     $this->loadTemplate('Player Settings', '', '', 'settings');
	//     $this->template->write_view('main_content', 'player/bank_details', $data);
	//     $this->template->render();
	// }

	/**
	 * view cancel promo
	 *
	 * @return void
	 */
	public function postResetPassword() {

		$this->form_validation->set_rules('opassword', 'Current Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'New Password', 'trim|required|xss_clean');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean|matches[password]');

		if ($this->form_validation->run() == false) {
			//$message = "Please input correct details when resetting your password";
			$message = lang('notify.25');
			$this->alertMessage(1, $message);
			$this->changePassword();
		} else {
			$opassword = $this->input->post('opassword');
			$password = $this->input->post('password');

			$check = $this->player_functions->isValidPassword($this->authentication->getPlayerId(), $opassword);
			if (!$check) {
				// if password is incorrect
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

	/**
	 * applyFreelanceJob
	 *
	 * @return void
	 */
	public function applyFreelanceJob($flJobId, $empId) {

		$jobExists = $this->member_functions->isFreelanceJobExists($flJobId, $this->authentication->getPlayerId());

		if ($jobExists) {
			$message = "You have an existing application to this job already.";
			$this->alertMessage(2, $message);
			redirect(BASEURL . 'members/freelanceJobsExistPage');
		}

		$data = array(
			'flJobId' => $flJobId,
			'empId' => $empId,
			'applicantId' => $this->authentication->getPlayerId(),
			'candidate_status' => 0,
		);

		$this->member_functions->applyFreelanceJob($data);

		redirect(BASEURL . 'members/freelanceJobsApplicationSuccess');
	}

	/**
	 * applyJob
	 *
	 * @return void
	 */
	public function applyJob($jobId, $empId) {

		$jobExists = $this->member_functions->isJobExists($jobId, $this->authentication->getPlayerId());

		if ($jobExists) {
			$message = "You have an existing application to this job already.";
			$this->alertMessage(2, $message);
			redirect(BASEURL . 'members/jobsExistPage');
		}

		$data = array(
			'jobId' => $jobId,
			'empId' => $empId,
			'applicantId' => $this->authentication->getPlayerId(),
			'candidate_status' => 0,
		);

		$this->member_functions->applyJob($data);

		redirect(BASEURL . 'members/jobsApplicationSuccess');
	}

	/**
	 * saveFreelanceJob
	 *
	 * @return void
	 */
	public function saveFreelanceJob($flJobId) {

		$jobExists = $this->member_functions->isFreelanceJobSaveExists($flJobId, $this->authentication->getPlayerId());
		//var_dump($jobExists);exit();
		if ($jobExists) {
			$message = "You saved this job already.";
			$this->alertMessage(2, $message);
			redirect(BASEURL . 'ajkk/jobs/freelancejobs');
		}

		$data = array(
			'flJobId' => $flJobId,
			'member_id' => $this->authentication->getPlayerId(),
			'status' => 0,
		);

		$message = "Job has been save!";
		$this->alertMessage(1, $message);

		$this->member_functions->saveFreelanceJob($data);

		redirect(BASEURL . 'ajkk/jobs/freelancejobs');
	}

	/**
	 * saveFreelanceJob
	 *
	 * @return void
	 */
	public function saveJob($jobId) {

		$jobExists = $this->member_functions->isJobSaveExists($jobId, $this->authentication->getPlayerId());
		//var_dump($jobExists);exit();
		if ($jobExists) {
			$message = "You saved this job already.";
			$this->alertMessage(2, $message);
			redirect(BASEURL . 'ajkk/jobs/fulltimejobs');
		}

		$data = array(
			'jobId' => $jobId,
			'member_id' => $this->authentication->getPlayerId(),
			'status' => 0,
		);

		$message = "Job has been save!";
		$this->alertMessage(1, $message);

		$this->member_functions->saveJob($data);

		redirect(BASEURL . 'ajkk/jobs/fulltimejobs');
	}

	/**
	 * apply job
	 *
	 * @return void
	 */
	function freelanceJobsExistPage() {
		$data = '';
		$this->load->view('member/isExistsPage', $data);
	}

	/**
	 * apply job
	 *
	 * @return void
	 */
	function freelanceJobsApplicationSuccess() {
		$data = '';
		$this->load->view('member/isApplicationSuccessPage', $data);
	}

	/**
	 * apply job
	 *
	 * @return void
	 */
	function jobsApplicationSuccess() {
		$data = '';
		$this->load->view('member/isApplicationSuccessPage', $data);
	}

	/**
	 * downloadBanner
	 *
	 * @return void
	 */
	public function downloadDocs($name) {
		$this->load->helper('download');
		$doc_name = rawurldecode($name);
		//$doc_path = 'http://' . rawurldecode($path) . '/resources/images/banner/' . $doc_name;
		$doc_path = BASEURL . 'resources/docs/freelancejob/' . $doc_name;
		// $mime = explode('.', $doc_name);

		// header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document' . $mime[1]);
		// header("Content-Disposition: attachment; filename=$doc_name");
		// readfile($doc_path);

		$data = file_get_contents($doc_path); // Read the file's contents
		$name = $doc_path;

		force_download($name, $data);
	}
}