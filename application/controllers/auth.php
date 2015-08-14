<?php

class Auth extends CI_Controller {

	function __construct() {
		parent::__construct();

		$this->load->helper('url');
		$this->load->library(array('form_validation', 'authentication', 'player_functions', 'employer_functions', 'template', 'email', 'cms_function','member_functions'));
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
	 * set language
	 *
	 * @return  rendered Template with array of data
	 */
	public function setCurrentLanguage($language) {
		$this->language_function->setCurrentLanguage($language);

		$language == 1 ? $this->session->set_userdata('currentLanguage', 'en') : $this->session->set_userdata('currentLanguage', 'ch');
		$arr = array('status' => 'success');

		echo json_encode($arr);
	}

	public function index() {
		$this->login();
	}

	/**
	 * Loads template for view based on regions in
	 * config > template.php
	 *
	 */
	private function loadTemplate($title, $description, $keywords, $activenav) {
		$this->template->add_js('resources/js/player/player.js');
		$this->template->add_css(CSSPATH . 'bootstrap.css');
		$this->template->add_css(CSSPATH . 'template.css');

		$this->template->write('skin', 'template1.css');
		$this->template->write('title', $title);
		$this->template->write('description', $description);
		$this->template->write('keywords', $keywords);
		$this->template->write('activenav', $activenav);
		$this->template->write('username', $this->authentication->getUsername());
		$this->template->write('player_id', $this->authentication->getPlayerId());
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */
	public function login() {

		if ($this->authentication->isLoggedIn()) {
			redirect(BASEURL . 'player_controller');
		} else {
			//echo 'test';exit();
			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			$data['errors'] = array();

			if ($this->form_validation->run()) {
				// validation ok
				if ($this->authentication->login($this->form_validation->set_value('login'), $this->form_validation->set_value('password'))) {
					// success
					$message = "";

					// update player online status
					$data = array(
						'online' => '0',
					);
					$this->player_functions->editPlayer($data, $this->session->userdata('player_id'));

					//setting of preferred language
					$player = $this->player_functions->getPlayerById($this->authentication->getPlayerId());
					if ($player['language'] == 'English') {
						$this->setCurrentLanguage('1');
					} else if ($player['language'] == 'Chinese') {
						$this->setCurrentLanguage('2');
					}

					$this->session->set_userdata('usertype', 'member');

					//$message = "Your account has successfully login.". $message;
					$message = lang('notify.1') . $message;

					$this->alertMessage(1, $message);
					redirect(BASEURL . 'ajkk/welcome');
				} else {
					$errors = $this->authentication->get_error_message(); // fail
					foreach ($errors as $k => $v) {
						$data['errors'][$k] = $v;
						$message = $data['errors'][$k];
					} //$data['errors'][$k] = $this->lang->line($v);

					$this->alertMessage(2, $message);
				}
			}

			redirect(site_url('ajkk/login/member'));
		}
	}

	/**
	 * Login employer on the site
	 *
	 * @return void
	 */
	public function loginEmployer() {

		if ($this->authentication->isLoggedIn()) {
			redirect(BASEURL . 'employers/home');
		} else {
			//echo 'test';exit();
			$this->form_validation->set_rules('login', 'Login', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			//$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			$data['errors'] = array();

			if ($this->form_validation->run()) {
				// validation ok
				if ($this->authentication->loginEmployer($this->form_validation->set_value('login'), $this->form_validation->set_value('password'))) {
					// success
					$message = "";

					//setting of preferred language
					//$player = $this->employer_functions->getEmployerById($this->authentication->getEmployerId());
					if ($player['language'] == 'English') {
						$this->setCurrentLanguage('1');
					} else if ($player['language'] == 'Chinese') {
						$this->setCurrentLanguage('2');
					}

					$this->session->set_userdata('usertype', 'employer');

					//$message = "Your account has successfully login.". $message;
					$message = lang('notify.1') . $message;

					$this->alertMessage(1, $message);
					redirect(BASEURL . 'employers/home');
				} else {
					$errors = $this->authentication->get_error_message(); // fail
					foreach ($errors as $k => $v) {
						$data['errors'][$k] = $v;
						$message = $data['errors'][$k];
					} //$data['errors'][$k] = $this->lang->line($v);

					$this->alertMessage(2, $message);
				}
			}

			redirect(BASEURL . 'ajkk/login/employer');
		}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	public function logout() {
		if ($this->session->userdata('usertype') == 'member') {
			$this->authentication->logout();
		} elseif ($this->session->userdata('usertype') == 'employer') {
			$this->authentication->logoutEmployer();
		}

		//logout player in pt games
		//$this->logoutPlayerPTGame();
		$message = 'Thank you for dropping by!';
		$this->alertMessage(1, $message);
		redirect(BASEURL . 'ajkk/welcome');
	}

	/**
	 * Register user
	 *
	 * @return void
	 */
	public function register($type = 'member') {
		if ($this->authentication->isLoggedIn()) {
			redirect(BASEURL . 'player_controller');
		} else {
			$username = '';
			$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
			$data['footerData'] = $this->cms_function->getCmsFooterContentData();
			//$data['hiddenPassword'] = $this->player_functions->randomizer($username);
			//$data['currency'] = $this->player_functions->getActiveCurrency();
			//$data['tracking_code'] = (isset($_GET['aff']) == true) ?  $_GET['aff']:$this->session->userdata('tracking_code');
			//$this->session->set_userdata('tracking_code', $data['tracking_code']);

			$this->loadTemplate('Register', '', '', 'player');
			if ($type == 'employer') {
				$this->template->write_view('main_content', 'auth/register_employer', $data);
				$this->template->write_view('footer_content', 'template/footer_template');
			} else {
				$this->template->write_view('main_content', 'auth/register_member', $data);
				$this->template->write_view('footer_content', 'template/footer_template');
			}

			$this->template->render();
		}
	}

	/**
	 * Register user
	 *
	 * @return void
	 */
	public function registerVip() {
		if ($this->authentication->isLoggedIn()) {
			redirect(BASEURL . 'player_controller');
		} else {
			$username = '';
			$data['hiddenPassword'] = $this->player_functions->randomizer($username);
			$data['currency'] = $this->player_functions->getActiveCurrency();
			$data['tracking_code'] = (isset($_GET['aff'])) ? $_GET['aff'] : $this->session->userdata('tracking_code');
			$this->session->userdata('tracking_code', $data['tracking_code']);

			$this->loadTemplate('Register', '', '', 'player');
			$this->template->write_view('main_content', 'auth/register_vip', $data);
			$this->template->write_view('footer_content', 'template/footer_template');
			$this->template->render();
		}
	}

	/**
	 * Validates and verifies inputs from
	 * the end user and add a player
	 *
	 * @return  redirect page
	 */
	public function postRegisterMember() {
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]|max_length[34]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean|min_length[6]|max_length[34]|matches[password]');

		if ($this->form_validation->run() == false) {
			//$message = "Some fields didnt meet the requirements. Please check again";
			$message = lang('notify.2');
			$this->alertMessage(2, $message);
			$this->register('member');
		} else {
			$email = $this->input->post('email');
			$forbidden_names = array('admin', 'moderator', 'hoster', 'administrator', 'mod');

			$checkUsernameExist = $this->player_functions->checkUsernameExist($email);
			$checkEmailExist = $this->player_functions->checkEmailExist($email);

			if ($checkUsernameExist) {
				$message = "<b>" . $email . "</b> " . lang('notify.3');
				$this->alertMessage(2, $message);
				$this->register('member');
			} elseif (in_array($email, $forbidden_names)) {
				$message = "<b>" . $email . "</b> " . lang('notify.4');
				$this->alertMessage(2, $message);
				$this->register('member');
			} elseif ($checkEmailExist) {
				//$message = "<b>" . $email . "</b> Email is already existed, Please choose another email";
				$message = "<b>" . $email . "</b> " . lang('notify.5');
				$this->alertMessage(2, $message);
				$this->register('member');
			} else {
				$password = $this->input->post('password');
				$first_name = $this->input->post('first_name');
				$last_name = $this->input->post('last_name');

				$today = date("Y-m-d H:i:s");

				$data = array(
					'username' => $email,
					'email' => $email,
					'password' => $password,
					'verify' => $this->player_functions->getRandomVerificationCode(),
					'createdOn' => $today,
				);

				//var_dump($data);exit();
				$this->player_functions->insertPlayer($data);

				$player = $this->player_functions->checkUsernameExist($email);

				// $this->player_functions->editPlayer($data, $player['playerId']);

				$data = array(
					'playerId' => $player['playerId'],
					'firstName' => $first_name,
					'lastName' => $last_name,
					'registrationIp' => $this->input->ip_address(),
					'registrationWebsite' => BASEURL,
				);
				$this->player_functions->insertPlayerDetails($data);

				$data = array(
					'member_id' => $player['playerId']
				);
				$this->member_functions->insertMemberAdditionalInfo($data);

				$this->authentication->login($email, $password);
				$this->session->set_userdata('new_user', true);

				//$message .= " Thank you for signing up";
				$applyJobMsg = '';
				if ($this->session->userdata('applyJobId') != '') {
					$applyJobMsg = 'Your application has been sent!';
					$this->session->unset_userdata('applyJobId');
				}
				$message = lang('notify.9') . '. ' . $applyJobMsg;
				$this->alertMessage(1, $message);

				$this->session->set_userdata('usertype', 'member');

				redirect(BASEURL . 'ajkk/welcome/' . $player['playerId']);
			}
		}
	}

	/**
	 * Validates and verifies inputs from
	 * the end user and add a player
	 *
	 * @return  redirect page
	 */
	public function postRegisterEmployer() {
		$this->form_validation->set_rules('contact_person', 'Contact Person', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email', 'Email Address', 'trim|required|xss_clean|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length[6]|max_length[34]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|xss_clean|min_length[6]|max_length[34]|matches[password]');
		$this->form_validation->set_rules('company_name', 'Company Name', 'trim|required|xss_clean');

		if ($this->form_validation->run() == false) {
			//$message = "Some fields didnt meet the requirements. Please check again";
			$message = lang('notify.2');
			$this->alertMessage(2, $message);
			$this->register('employer');
		} else {
			$email = $this->input->post('email');
			$forbidden_names = array('admin', 'moderator', 'hoster', 'administrator', 'mod');

			$checkUsernameExist = $this->employer_functions->checkUsernameExist($email);
			$checkEmailExist = $this->employer_functions->checkEmailExist($email);

			if ($checkUsernameExist) {
				$message = "<b>" . $email . "</b> " . lang('notify.3');
				$this->alertMessage(2, $message);
				$this->register('employer');
			} elseif (in_array($email, $forbidden_names)) {
				$message = "<b>" . $email . "</b> " . lang('notify.4');
				$this->alertMessage(2, $message);
				$this->register('employer');
			} elseif ($checkEmailExist) {
				//$message = "<b>" . $email . "</b> Email is already existed, Please choose another email";
				$message = "<b>" . $email . "</b> " . lang('notify.5');
				$this->alertMessage(2, $message);
				$this->register('employer');
			} else {
				$password = $this->input->post('password');

				$today = date("Y-m-d H:i:s");
				$geolocation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $this->input->ip_address()));
				$data = array(
					'username' => $email,
					'email' => $email,
					'password' => $password,
					'verify' => $this->employer_functions->getRandomVerificationCode(),
					'createdOn' => $today,
					'registerLocation' => $geolocation['geoplugin_city'] . ',' . $geolocation['geoplugin_countryName'],
					'registerIp' => $this->input->ip_address(),
				);

				$additional_data = array(
					'comp_email' => $email,
					'comp_name' => $this->input->post('company_name'),
					'contact_person' => $this->input->post('contact_person'),
					'contact_person_mobile_number' => $this->input->post('contact_person_no'),
				);
				//var_dump($data);exit();
				$this->employer_functions->insertEmployer($data, $additional_data);

				$this->authentication->loginEmployer($email, $password);
				$this->session->set_userdata('new_user', true);

				//$message .= " Thank you for signing up";
				$message = lang('notify.9');
				$this->alertMessage(1, $message);

				$this->session->set_userdata('usertype', 'employer');

				redirect(BASEURL . 'employers/employerProfile');
			}
		}
	}

	/**
	 * send email
	 *
	 * @return  void
	 */
	public function send_email($type, $email, &$data) {
		include_once realpath(APPPATH . '/libraries/PHPMailer/class.phpmailer.php');

		$mail = new PHPMailer();
		$data['random_verification_code'] = $this->player_functions->getPlayerById($this->session->userdata('player_id'))['verify'];
		$data['site_name'] = "OG Website";

		$body = $this->load->view('email/' . $type . '-html', $data, TRUE);

		$mail->Username = $data['email_sender'];
		$mail->Password = $data['email_sender_pass'];

		$mail->From = 'johnrendell21@gmail.com';
		$mail->FromName = 'OG Team';

		$mail->Subject = $type;

		$mail->AltBody = $this->load->view('email/' . $type . '-txt', $data, TRUE);
		$mail->WordWrap = 50;

		$mail->MsgHTML($body);
		$mail->AddAddress($email, '');

		$mail->CharSet = "UTF-8";
		$mail->Encoding = "8bit";

		$mail->IsHTML(true);

		//var_dump($mail);exit();

		try {
			while (!$mail->Send()) {
				$mail->Send();
			}

			//return $message = " Check your email address to verify your account!";
			return $message = lang('notify.10');
		} catch (Exception $e) {
			echo $mail->ErrorInfo;
		}

	}

	public function verify($verification_code) {
		if ($this->player_functions->getPlayerById($this->session->userdata('player_id'))['verify'] == $verification_code) {
			$data = array(
				'verify' => 'verified',
			);

			$this->player_functions->editPlayer($data, $this->session->userdata('player_id'));
			//$message = "Your account has been verified!";
			$message = lang('notify.11');
			$this->alertMessage(1, $message);
			redirect(BASEURL);
		} else {
			//$message = "You have already verified your account!";
			$message = lang('notify.12');
			$this->alertMessage(2, $message);
			redirect(BASEURL);
		}
	}

	public function resendEmail($player_id) {
		$player = $this->player_functions->getPlayerById($player_id);
		$email_settings = $this->player_functions->getEmail();

		$data['email_sender'] = (string) $email_settings['email'];
		$data['email_sender_pass'] = (string) base64_decode($email_settings['password']);

		$send_email = $this->send_email('verification', $player['email'], $data);

		//$message = "New verification message was sent to your email";
		$message = lang('notify.14');
		$this->alertMessage(1, $message);
		redirect(BASEURL . 'player_controller/playerSettings/' . $player_id);
	}

	/**
	 * Forgot Password
	 *
	 * @return void
	 */
	public function forgotPassword() {
		if ($this->authentication->isLoggedIn()) {
			redirect(BASEURL . 'player_controller');
		} else {
			$username = '';
			$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
			$data['footerData'] = $this->cms_function->getCmsFooterContentData();
			$data['hiddenPassword'] = $this->player_functions->randomizer($username);
			$data['currency'] = $this->player_functions->getActiveCurrency();
			$data['tracking_code'] = (isset($_GET['aff']) == true) ? $_GET['aff'] : $this->session->userdata('tracking_code');
			$this->session->set_userdata('tracking_code', $data['tracking_code']);

			$this->loadTemplate('Forgot Password', '', '', 'player');
			$this->template->write_view('main_content', 'auth/forgot_password', $data);
			$this->template->write_view('footer_content', 'template/footer_template');
			$this->template->render();
		}
	}

	/**
	 * Security Question
	 *
	 * @return void
	 */
	public function securityQuestion($back = "") {
		if ($this->authentication->isLoggedIn()) {
			redirect(BASEURL . 'player_controller');
		} else {
			if (!empty($back)) {
				$username = $this->input->post('username');
				$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
				$data['footerData'] = $this->cms_function->getCmsFooterContentData();
				$data['player'] = $this->player_functions->getPlayerByUsername($username);

				$this->loadTemplate('Forgot Password', '', '', 'player');
				$this->template->write_view('main_content', 'auth/secret_question', $data);
				$this->template->write_view('footer_content', 'template/footer_template');
				$this->template->render();
			}

			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');

			if ($this->form_validation->run() == false) {
				$this->forgotPassword();
			} else {
				$username = $this->input->post('username');

				$data['player'] = $this->player_functions->getPlayerByUsername($username);

				if (empty($data['player'])) {
					$message = lang('notify.68');
					$this->alertMessage(1, $message);
					redirect(BASEURL . 'auth/forgotPassword');
				} else {
					$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
					$data['footerData'] = $this->cms_function->getCmsFooterContentData();
					$this->loadTemplate('Forgot Password', '', '', 'player');
					$this->template->write_view('main_content', 'auth/secret_question', $data);
					$this->template->write_view('footer_content', 'template/footer_template');
					$this->template->render();
				}
			}
		}
	}

	/**
	 * Reset Password
	 *
	 * @return void
	 */
	public function resetPassword($playerId) {
		if ($this->authentication->isLoggedIn()) {
			redirect(BASEURL . 'player_controller');
		} else {
			$this->form_validation->set_rules('secret_answer', 'Secret Answer', 'trim|required|xss_clean');
			$this->form_validation->set_rules('confirm_secret_answer', 'Confirm Secret Answer', 'trim|required|xss_clean|matches[secret_answer]|callback_checkAnswer');

			if ($this->form_validation->run() == false) {
				$this->securityQuestion($playerId);
			} else {
				$username = $this->input->post('username');

				$data['player'] = $this->player_functions->getPlayerByUsername($username);

				$this->loadTemplate('Forgot Password', '', '', 'player');
				$this->template->write_view('main_content', 'auth/reset_password', $data);
				$this->template->write_view('footer_content', 'template/footer_template');
				$this->template->render();
			}
		}
	}

	/**
	 * call back for check Answer
	 *
	 * @return  bool
	 */
	public function checkAnswer() {
		$username = $this->input->post('username');
		$answer = $this->input->post('secret_answer');

		$player = $this->player_functions->getPlayerByUsername($username);

		if ($answer != $player['secretAnswer']) {
			$this->form_validation->set_message('checkAnswer', lang('forgot.11'));
			return false;
		}

		return true;
	}

	/**
	 * Verify Reset Password
	 *
	 * @return void
	 */
	public function verifyResetPassword($playerId) {
		if ($this->authentication->isLoggedIn()) {
			redirect(BASEURL . 'player_controller');
		} else {
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length[6]|max_length[34]');
			$this->form_validation->set_rules('confirm_password', 'Confirm New Password', 'trim|required|xss_clean|min_length[6]|max_length[34]|matches[new_password]');

			if ($this->form_validation->run() == false) {
				$username = $this->input->post('username');

				$data['player'] = $this->player_functions->getPlayerByUsername($username);

				$this->loadTemplate('Forgot Password', '', '', 'player');
				$this->template->write_view('main_content', 'auth/reset_password', $data);
				$this->template->write_view('footer_content', 'template/footer_template');
				$this->template->render();
			} else {
				$hasher = new PasswordHash('8', TRUE);
				$password = $hasher->HashPassword($this->input->post('new_password'));

				$data = array(
					'password' => $password,
				);

				$this->player_functions->editPlayer($data, $playerId);

				$message = lang('forgot.12');
				$this->alertMessage(1, $message);
				redirect(BASEURL . 'online/welcome', 'refresh');
			}
		}
	}

}