<?php

class Myresume extends CI_Controller {

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
		redirect(BASEURL . 'myresume/mypage');
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

	/**
	 * view cancel promo
	 *
	 * @return void
	 */
	public function mypage() {
		if ($this->authentication->getPlayerId()) {
			$data['footerlinks'] = $this->cms_function->getCmsFooterLinks();
			$data['footerData'] = $this->cms_function->getCmsFooterContentData();

			$memberId = $this->authentication->getPlayerId();
			$data['personalInfo'] = $this->member_functions->getMemberPersonalInfo($memberId);
			$data['workExpi'] = $this->member_functions->getMemberWorkExpi($memberId);
			$data['additionalInfo'] = $this->member_functions->getMemberAdditionalInfo($memberId);
			$data['socialMedia'] = $this->member_functions->getMemberSocialMedia($memberId);
			$data['skills'] = $this->member_functions->getMemberSkills($memberId);
			$data['education'] = $this->member_functions->getMemberEducation($memberId);
			$data['language'] = $this->member_functions->getMemberLanguage($memberId);
			$data['certification'] = $this->member_functions->getMemberCertification($memberId);

			//var_dump($data['personalInfo']);exit();
			$this->loadTemplate('Job Konek', '', '', 'Resume');
			$this->template->write_view('main_content', 'member/resume/myresume_page', $data);
			$this->template->write_view('footer_content', 'template/footer_template');
			$this->template->render();
		} else {
			redirect('ajkk/welcome', 'refresh');
		}
	}
}