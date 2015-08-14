<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * Member_Functions
 *
 * Member_Functions library for FHI OG System
 *
 * @package     Member_Functions
 * @author      ASRII
 * @version     1.0.0
 */

class Member_Functions {
	function __construct() {
		$this->ci = &get_instance();
		$this->ci->load->database();
		$this->ci->load->library(array('session'));
		$this->ci->load->model(array('member'));
	}

	/**
	 * applyFreelanceJob
	 *
	 * @param   array
	 */
	public function applyFreelanceJob($data) {
		$this->ci->member->applyFreelanceJob($data);
	}

	/**
	 * applyJob
	 *
	 * @param   array
	 */
	public function applyJob($data) {
		$this->ci->member->applyJob($data);
	}

	/**
	 * saveFreelanceJob
	 *
	 * @param   array
	 */
	public function saveFreelanceJob($data) {
		$this->ci->member->saveFreelanceJob($data);
	}

	/**
	 * saveJob
	 *
	 * @param   array
	 */
	public function saveJob($data) {
		$this->ci->member->saveJob($data);
	}

	/**
	 * isFreelanceJobExists
	 *
	 * @param   array
	 */
	public function isFreelanceJobExists($jobId, $memberId) {
		return $this->ci->member->isFreelanceJobExists($jobId, $memberId);
	}

	/**
	 * isJobExists
	 *
	 * @param   array
	 */
	public function isJobExists($jobId, $memberId) {
		return $this->ci->member->isJobExists($jobId, $memberId);
	}

	/**
	 * isFreelanceJobSaveExists
	 *
	 * @param   array
	 */
	public function isFreelanceJobSaveExists($jobId, $memberId) {
		return $this->ci->member->isFreelanceJobSaveExists($jobId, $memberId);
	}

	/**
	 * isJobSaveExists
	 *
	 * @param   array
	 */
	public function isJobSaveExists($jobId, $memberId) {
		return $this->ci->member->isJobSaveExists($jobId, $memberId);
	}

	/**
	 * getPlayer by Username
	 *
	 * @return  rendered template
	 */
	public function logViewJob($jobId) {
		return $this->ci->member->logViewJob($jobId);
	}

	/**
	 * getRandomVerificationCode
	 *
	 * @return  rendered template
	 */
	public function getRandomVerificationCode() {
		$seed = str_split('abcdefghijklmnopqrstuvwxyz'
			. 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
			. '0123456789'); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$verification_code = '';
		foreach (array_rand($seed, 32) as $k) {
			$verification_code .= $seed[$k];
		}

		return $verification_code;
	}

	/**
	 * Will check if the username is already existing
	 *
	 * @param   string
	 * @return  array
	 */
	public function checkUsernameExist($username) {
		$result = $this->ci->member->checkUsernameExist($username);
		return $result;
	}

	/**
	 * Will check if the email is already existing
	 *
	 * @param   string
	 * @return  array
	 */
	public function checkEmailExist($email) {
		$result = $this->ci->member->checkEmailExist($email);
		return $result;
	}

	/**
	 * Will create new player using the parameter data
	 *
	 * @param   array
	 */
	public function insertMember($data) {
		$hasher = new PasswordHash('8', TRUE);
		$data['password'] = $hasher->HashPassword($data['password']);
		//var_dump($data);exit();
		$this->ci->member->insertMember($data);
	}

	/**
	 * Will create new player details using the parameter data
	 *
	 * @param   array
	 */
	public function insertMemberDetails($data) {
		$this->ci->member->insertMemberDetails($data);
	}

	/**
	 * Will get member personal info
	 *
	 * @param   array
	 */
	public function getMemberPersonalInfo($member_id) {
		return $this->ci->member->getMemberPersonalInfo($member_id);
	}

	/**
	 * Will get member work expi
	 *
	 * @param   array
	 */
	public function getMemberWorkExpi($member_id) {
		return $this->ci->member->getMemberWorkExpi($member_id);
	}

	/**
	 * Will get member additional info
	 *
	 * @param   array
	 */
	public function getMemberAdditionalInfo($member_id) {
		return $this->ci->member->getMemberAdditionalInfo($member_id);
	}

	/**
	 * Will get member social media
	 *
	 * @param   array
	 */
	public function getMemberSocialMedia($member_id) {
		return $this->ci->member->getMemberSocialMedia($member_id);
	}

	/**
	 * Will get member skills
	 *
	 * @param   array
	 */
	public function getMemberSkills($member_id) {
		return $this->ci->member->getMemberSkills($member_id);
	}

	/**
	 * Will get member education
	 *
	 * @param   array
	 */
	public function getMemberEducation($member_id) {
		return $this->ci->member->getMemberEducation($member_id);
	}

	/**
	 * Will get member language
	 *
	 * @param   array
	 */
	public function getMemberLanguage($member_id) {
		return $this->ci->member->getMemberLanguage($member_id);
	}

	/**
	 * Will get member certification
	 *
	 * @param   array
	 */
	public function getMemberCertification($member_id) {
		return $this->ci->member->getMemberCertification($member_id);
	}

	/**
	 * Will get member additional info
	 *
	 * @param   array
	 */
	public function insertMemberAdditionalInfo($member_id) {
		return $this->ci->member->insertMemberAdditionalInfo($member_id);
	}

	/**
	 * Will get member application
	 *
	 * @param   array
	 */
	public function getMemberFulltimeJobApplication($member_id) {
		return $this->ci->member->getMemberFulltimeJobApplication($member_id);
	}

	/**
	 * Will get member application
	 *
	 * @param   array
	 */
	public function getMemberFreelanceJobApplication($member_id) {
		return $this->ci->member->getMemberFreelanceJobApplication($member_id);
	}

}

/* End of file user_functions.php */
/* Location: ./application/libraries/player_functions.php */