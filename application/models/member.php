<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/**
 * Member
 *
 * This model represents ip data. It operates the following tables:
 * - Member
 *
 * @author	ASRII
 */

class Member extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
	}

	/**
	 * Will edit member using the passed parameter
	 *
	 * @param 	array
	 * @param 	int
	 */
	public function editMember($data, $member_id) {
		$this->db->where('playerId', $member_id);
		$this->db->update('player', $data);
	}

	/**
	 * applyFreelanceJob
	 *
	 * @param 	array
	 */
	public function applyFreelanceJob($data) {
		$this->db->insert('freelancejob_applicant', $data);
	}

	/**
	 * applyJob
	 *
	 * @param 	array
	 */
	public function applyJob($data) {
		$this->db->insert('job_applicant', $data);
	}

	/**
	 * saveFreelanceJob
	 *
	 * @param 	array
	 */
	public function saveFreelanceJob($data) {
		$this->db->insert('freelancejob_save', $data);
	}

	/**
	 * saveJob
	 *
	 * @param 	array
	 */
	public function saveJob($data) {
		$this->db->insert('job_save', $data);
	}

	/**
	 * isFreelanceJobExists
	 *
	 * @param 	array
	 */
	public function isFreelanceJobExists($flJobId, $member_id) {
		$query = $this->db->select('flJobId')->from('freelancejob_applicant');
		$this->db->where('flJobId', $flJobId);
		$this->db->where('applicantId', $member_id);
		$query = $this->db->get();
		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * isJobExists
	 *
	 * @param 	array
	 */
	public function isJobExists($jobId, $member_id) {
		$query = $this->db->select('jobId')->from('job_applicant');
		$this->db->where('jobId', $jobId);
		$this->db->where('applicantId', $member_id);
		$query = $this->db->get();
		if (!$query->row_array()) {
			return false;
		} else {
			return $query->row_array();
		}
	}

	/**
	 * isFreelanceJobExists
	 *
	 * @param 	array
	 */
	public function isFreelanceJobSaveExists($flJobId, $member_id) {
		$query = $this->db->select('flJobId')->from('freelancejob_save');
		$this->db->where('flJobId', $flJobId);
		$this->db->where('member_id', $member_id);
		$query = $this->db->get();
		if (!$query->row_array()) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * isJobSaveExists
	 *
	 * @param 	array
	 */
	public function isJobSaveExists($jobId, $member_id) {
		$query = $this->db->select('jobId')->from('job_save');
		$this->db->where('jobId', $jobId);
		$this->db->where('member_id', $member_id);
		$query = $this->db->get();
		if (!$query->row_array()) {
			return false;
		} else {
			return true;
		}
	}

	/**
	 * logViewJob
	 *
	 * @param 	array
	 */
	public function logViewJob($data) {
		$this->db->insert('jobviewlog', $data);
	}

	public function checkUsernameExist($username) {
		$query = $this->db->query("SELECT * FROM player WHERE username = '" . $username . "'");
		return $query->row_array();
	}

	public function checkEmailExist($email) {
		$query = $this->db->query("SELECT * FROM player WHERE email = '" . $email . "'");
		return $query->row_array();
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertMember($data) {
		$this->db->insert('player', $data);
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertMemberDetails($data) {
		$this->db->insert('playerdetails', $data);
	}

	/**
	 * get members personal info
	 *
	 * @param 	array
	 */
	public function getMemberPersonalInfo($member_id) {
		$query = $this->db->select('playerdetails.*,country.name as country')->from('playerdetails');
		$this->db->join('player', 'player.playerId = playerdetails.playerId','left');
		$this->db->join('country', 'country.countryId = playerdetails.country','left');
		$this->db->where('player.playerId', $member_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	/**
	 * get members work expi
	 *
	 * @param 	array
	 */
	public function getMemberWorkExpi($member_id) {
		$query = $this->db->select('member_work_expi.*,currency.symbol as currency_symbol')->from('member_work_expi');
		$this->db->join('currency', 'currency.id = member_work_expi.currency','left');
		$this->db->where('member_work_expi.member_id', $member_id);
		$this->db->order_by('member_work_expi.date_joined_to', 'desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$row['date_joined_from'] = mdate('%M, %Y', strtotime($row['date_joined_from']));
				$row['date_joined_to'] = mdate('%M, %Y', strtotime($row['date_joined_to']));
				$data[] = $row;
			}
			return $data;
		}

	}

	/**
	 * get members additional info
	 *
	 * @param 	array
	 */
	public function getMemberAdditionalInfo($member_id) {
		$query = $this->db->select('member_additional_info.*,currency.symbol as currency_symbol')->from('member_additional_info');
		$this->db->join('currency', 'currency.id = member_additional_info.currency','left');
		$this->db->where('member_additional_info.member_id', $member_id);
		$query = $this->db->get();
		return $query->row_array();
	}

	/**
	 * get members social media
	 *
	 * @param 	array
	 */
	public function getMemberSocialMedia($member_id) {
		$query = $this->db->select('*')->from('member_social_media');
		$this->db->where('member_id', $member_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * get members skills
	 *
	 * @param 	array
	 */
	public function getMemberSkills($member_id) {
		$query = $this->db->select('*')->from('member_skills');
		$this->db->where('member_id', $member_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * get members education
	 *
	 * @param 	array
	 */
	public function getMemberEducation($member_id) {
		$query = $this->db->select('*')->from('member_education');
		$this->db->where('member_id', $member_id);
		$this->db->order_by('grad_date', 'desc');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$row['grad_date'] = mdate('%M %d, %Y ', strtotime($row['grad_date']));
				$data[] = $row;
			}
			return $data;
		}
	}

	/**
	 * get members language
	 *
	 * @param 	array
	 */
	public function getMemberLanguage($member_id) {
		$query = $this->db->select('*')->from('member_language');
		$this->db->where('member_id', $member_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * get members certification
	 *
	 * @param 	array
	 */
	public function getMemberCertification($member_id) {
		$query = $this->db->select('*')->from('member_certification');
		$this->db->where('member_id', $member_id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row) {
				$row['acquired_on'] = mdate('%M %d, %Y ', strtotime($row['acquired_on']));
				$data[] = $row;
			}
			return $data;
		}
	}

	/**
	 * Inserts member additional info
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertMemberAdditionalInfo($data) {
		$this->db->insert('member_additional_info', $data);
	}

	/**
	 * get members full time job application
	 *
	 * @param 	array
	 */
	public function getMemberFulltimeJobApplication($member_id) {
		$query = $this->db->select('job_applicant.*,
									jobs.*,
							')->from('job_applicant');
		$this->db->join('jobs', 'jobs.jobId = job_applicant.jobId','left');
		$this->db->where('applicantId', $member_id);
		$query = $this->db->get();
		return $query->result_array();
	}

	/**
	 * get members freelance job application
	 *
	 * @param 	array
	 */
	public function getMemberFreelanceJobApplication($member_id) {
		$query = $this->db->select('*')->from('freelancejob_apply');
		$this->db->where('member_id', $member_id);
		$query = $this->db->get();
		return $query->result_array();
	}
}