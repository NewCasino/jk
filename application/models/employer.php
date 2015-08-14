<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employer
 *
 * This model represents ip data. It operates the following tables:
 * - employer
 * - employerdetails
 *
 * @author	ASRII
 */

class Employer extends CI_Model
{

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('date');
	}

	public function checkUsernameExist($username) {
		$query = $this->db->query("SELECT * FROM employer WHERE username = '" . $username . "'");
		return $query->row_array();
	}

	public function checkEmailExist($email) {
		$query = $this->db->query("SELECT * FROM employer WHERE email = '" . $email . "'");
		return $query->row_array();
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertEmployer($data,$additional_data) {
		
		$this->db->insert('employer', $data);
		$employerId = $this->db->insert_id();

		$playerLevel['emp_id'] = $employerId;

		$emp_data['contact_person'] = $additional_data['contact_person'];
		$emp_data['comp_name'] = $additional_data['comp_name'];
		$emp_data['email'] =  $additional_data['comp_email'];
		$emp_data['emp_id'] = $employerId;
								
		//$emp_data = array('email' => $email,'emp_id' => $id);
		$this->db->insert('employer_details', $emp_data);
		
		//add userid to other tables related to emp
		$form_data["emp_id"] = $employerId;			
		$this->db->insert('employer_self', $form_data);
		$this->db->insert('emp_notification', $form_data);
		
		$form_data["createdOn"] = date("Y-m-d H:i:s");		
		$form_data["mediaCategory"] = 'comp_logo';
		$form_data["status"] = 'active';
		$this->db->insert('employer_media', $form_data);
		
		//add employer membeship status
		$emp_mem_data["emp_id"] = $employerId;	
		$emp_mem_data["membership_type"] = 0;
				
		$timezone = "Asia/Manila";
		if(function_exists('date_default_timezone_set')) date_default_timezone_set($timezone);
		//echo date("Y-m-d H:i:s").'<br/>';
		//echo date("Y-m-d H:i:s", strtotime("+1 months")).'<br/>';
		$emp_mem_data["jobpost_activation_date"] = date("Y-m-d H:i:s");	
		$emp_mem_data["jobpost_expiration_date"] = date("Y-m-d H:i:s", strtotime("+1 months"));			
		$this->db->insert('employer_membership', $emp_mem_data);
	}

	function getEmployerByLogin($login)
	{
		$this->db->where('LOWER(username)=', strtolower($login));

		$query = $this->db->get('employer');
		if ($query->num_rows() == 1) return $query->row();
		return NULL;
	}

	/**
	 * Will edit employerId using the passed parameter
	 *
	 * @param 	array
	 * @param 	int
	 */
	public function editEmployer($data, $employerId) {
		$this->db->where('employerId', $employerId);
		$this->db->update('employer', $data);
	}


	/**
	 * Update user login info, such as IP-address or login time, and
	 * clear previously generated (but not activated) passwords.
	 *
	 * @param	int
	 * @param	bool
	 * @param	bool
	 * @return	void
	 */
	function updateLoginInfo($employer_id, $record_ip, $record_time,$online)
	{
		if ($record_ip)		$this->db->set('lastLoginIp', $this->input->ip_address());
		if ($record_time)	$this->db->set('lastLoginTime', date('Y-m-d H:i:s'));
		if ($online) $this->db->set('online', '0');

		$this->db->where('employerId', $employer_id);
		$this->db->update('employer');
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function editEmployerDetails($data, $employerId) {
		$this->db->where('employerId', $employerId);
		$this->db->update('employer', $data);
	}

	/**
	 * Inserts data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function insertEmployerDetails($data) {
		$this->db->insert('employerdetails', $data);
	}

	/** 
       * function get_emp_comp_name()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getEmployerCompName($emp_id) 
	{		
    	$query = $this->db->select('comp_name')->from('employer_details')->where('emp_id', $emp_id);
	    $query = $this->db->get();		
	    return $query->row_array();
  	}

  	/** 
       * function get_emp_membership_info()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	
	function getEmployerMembershipInfo($emp_id) 
	{		
    	$query = $this->db->select('*')->from('employer_membership')->where('emp_id', $emp_id);
	    $query = $this->db->get();		
	    return $query->result();
  	}
  	
  	/** 
       * function insert_job_data()
       *
       * insert data to tables
	   * @param $form_data - array
	   * @param $table_name - string
	   * @return Bool - TRUE or FALSE
       */
	
	function postJob($jobSummary)
	{
		$this->db->insert('jobs', $jobSummary);		
		$jobId = $this->db->insert_id();		
		//$this->db->insert('job_details', $jobDetails);	

		//set_lastid_info($jd_data['job_id']);
		
		//checker		
		if ($this->db->affected_rows() == '1')
		{			
			return $jobId;
		}
		
		return FALSE;
	}	

	/** 
       * function insert_table_details()
       *
       * insert data to tables
	   * @param $form_data - array
	   * @param $table_name - string
	   * @return Bool - TRUE or FALSE
       */
	
	function insert_table_details($table_name,$form_data)
	{
		$this->db->insert($table_name, $form_data);				
		
		//checker		
		if ($this->db->affected_rows() == '1')
		{			
			//return TRUE;
			return $this->db->insert_id();
		}
		
		return FALSE;
	}

	/**
	 * update_table_details
	 *
	 * @param 	table_name array
	 * @param 	array
	 * @param 	int
	 */
	public function update_fltable_details($table_name,$form_data) {
		$this->db->where('fljobId', $form_data['fljobId']);
		$this->db->update('freelance_job', $form_data);
	}

	/** 
       * function update_jobtable()
       *
       * insert data to tables
	   * @param $form_data - array
	   * @param $table_name - string
	   * @return Bool - TRUE or FALSE
       */
	
	function update_jobtable($table_name,$form_data)
	{
		//var_dump($form_data);exit();
		//$this->db->insert($table_name, $form_data);				
		$this->db->where('jobId', $form_data['jobId']);
		$this->db->update($table_name, $form_data);
		//checker		
		if ($this->db->affected_rows() == '1')
		{			
			return TRUE;
		}
		
		return FALSE;
	}

	/** 
       * function update_jobtable_details()
       *
       * insert data to tables
	   * @param $form_data - array
	   * @param $table_name - string
	   * @return Bool - TRUE or FALSE
       */
	
	function update_jobtable_details($table_name,$form_data)
	{
		//var_dump($form_data);exit();
		//$this->db->insert($table_name, $form_data);				
		$this->db->where('job_id', $form_data['job_id']);
		$this->db->update($table_name, $form_data);
		//checker		
		if ($this->db->affected_rows() == '1')
		{			
			return TRUE;
		}
		
		return FALSE;
	}

	/**
	 * Delete data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function delete_jobtable_details($table_name, $job_id) {
		//$where = "job_id = '" . $job_id . "'";
		$this->db->where('job_id',$job_id);
		$this->db->delete($table_name);

		if ($this->db->affected_rows() == '1')
		{			
			return TRUE;
		}
		
		return FALSE;
	}

	/**
	 * Delete data to database
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function delete_fljob_reqskills($flJobId) {
		$this->db->where('flJobId',$flJobId);
		$this->db->delete('freelance_skill_req');

		if ($this->db->affected_rows() == '1')
		{			
			return TRUE;
		}
		
		return FALSE;
	}

	/** 
       * function update_table_details()
       *
       * insert data to tables
	   * @param $form_data - array
	   * @param $table_name - string
	   * @return Bool - TRUE or FALSE
       */
	
	function update_table_details($table_name,$form_data)
	{
		//$this->db->insert($table_name, $form_data);				
		$this->db->where('emp_id', $form_data['emp_id']);
		$this->db->update($table_name, $form_data);
		//checker		
		if ($this->db->affected_rows() == '1')
		{			
			return TRUE;
		}
		
		return FALSE;
	}

	/**
	 * addEmpLogo
	 *
	 * @param	array
	 * @return	boolean
	 */
	public function addEmpLogo($data) {
		$this->db->insert('employer_media', $data);
	}

	/** 
       * function get_emp_comp_name()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getJobInfo($jobId) 
	{		
    	$query = $this->db->select('jobs.*,job_details.*')->from('jobs')
    	->join('job_details', 'job_details.job_id = jobs.jobId','left');		
		$this->db->where('jobId', $jobId);

		//var_dump($data);exit();

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['date_posted'] = mdate('%Y-%m-%d',strtotime($row['date_posted']));
				$row['date_expiry'] = mdate('%Y-%m-%d',strtotime($row['date_expiry']));
				$row['jobEducReq'] = $this->getEducRequirements($row['jobId']);
				$row['jobBenefits'] = $this->getJobBenefits($row['jobId']);
				//$row['salary_type'] = $this->getSalaryType($row['salary_type']);
				$row['emp_type'] = $this->getEmpType($row['jobId']);

				//$row['specialization'] = $this->getSpecializationType($row['specialization']);
				$data['jobDetails'] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	    // $query = $this->db->get();		
	    // return $query->row_array();
  	}

  	/** 
       * function getJobInfoDetailed
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getJobInfoDetailed($jobId) 
	{		
    	$query = $this->db->select('jobs.*,job_details.*')->from('jobs')
    	->join('job_details', 'job_details.job_id = jobs.jobId','left');		
		$this->db->where('jobId', $jobId);

		//var_dump($data);exit();

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['date_posted'] = mdate('%M %d, %Y',strtotime($row['date_posted']));
				$row['date_expiry'] = mdate('%M %d, %Y',strtotime($row['date_expiry']));
				$row['jobEducReq'] = $this->getEducRequirementsDetails($row['jobId']);
				$row['jobBenefits'] = $this->getJobBenefitsDetails($row['jobId']);
				$row['salary_type'] = $this->getSalaryType($row['salary_type']);
				$row['emp_type'] = $this->getEmpTypeDetails($row['jobId']);
				$row['specialization'] = $this->getSpecializationType($row['specialization']);
				$row['location_region'] = $this->getLocationRegion($row['location_region']);
				$row['position_level'] = $this->getPosLevel($row['position_level']);
				$data['jobDetails'] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	    // $query = $this->db->get();		
	    // return $query->row_array();
  	}

  	/** 
       * function getPublishedJobDetailed
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getPublishedJobDetailed($jobId) 
	{		
    	$query = $this->db->select('jobs.*,job_details.*,employer.employerId as empId,
    								employer_details.*'
    								)->from('jobs');
    	$this->db->join('job_details', 'job_details.job_id = jobs.jobId','left');
    	$this->db->join('employer','employer.employerId = jobs.emp_id','left');		
    	$this->db->join('employer_details','employer_details.emp_id = employer.employerId','left');
    	$this->db->join('employer_media','employer_media.emp_id = employer.employerId','left');
		$this->db->where('jobId', $jobId);

		//var_dump($data);exit();

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['date_posted'] = mdate('%M %d, %Y',strtotime($row['date_posted']));
				$row['date_expiry'] = mdate('%M %d, %Y',strtotime($row['date_expiry']));
				$row['jobEducReq'] = $this->getEducRequirementsDetails($row['jobId']);
				$row['jobBenefits'] = $this->getJobBenefitsDetails($row['jobId']);
				$row['salary_type'] = $this->getSalaryType($row['salary_type']);
				$row['emp_type'] = $this->getEmpTypeDetails($row['jobId']);
				$row['specialization'] = $this->getSpecializationType($row['specialization']);
				$row['location_region'] = $this->getLocationRegion($row['location_region']);
				$row['position_level'] = $this->getPosLevel($row['position_level']);
				$row['comp_size'] = $this->getCompSize($row['comp_size']);
				$row['dress_code'] = $this->getDressCode($row['dress_code']);
				$row['working_hrs'] = $this->getWorkingHours($row['working_hrs']);
				$row['spoken_lang'] = $this->getSpokenLang($row['spoken_lang']);
				$row['comp_type'] = $this->getCompType($row['comp_type']);
				$row['comp_nature'] = $this->getCompNature($row['comp_nature']);
				$data['jobDetails'] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	    // $query = $this->db->get();		
	    // return $query->row_array();
  	}

  	/** 
       * function getFreelanceJobInfo()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getFreelanceJobInfo($jobId) 
	{		
    	$query = $this->db->select('freelance_job.*,freelance_job_doc.mediaName')->from('freelance_job')
    	->join('freelance_job_doc', 'freelance_job_doc.fljob_id = freelance_job.fljobId','left');		
		$this->db->where('fljobId', $jobId);

		//var_dump($data);exit();

		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$data['jobDetails'] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	    // $query = $this->db->get();		
	    // return $query->row_array();
  	}

  	/** 
       * function getSalaryType()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getSalaryType($type) 
	{
		switch ($type) {
			case 1:
				return 'Negotiable';
				break;
			case 2:
				return 'Commission w/ base salary';
				break;
			// case 3:
			// 	return 'None';
			// 	break;
			
			default:
				# code...
				break;
		}
	}

	/** 
       * function getCompNature()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getCompType($type) 
	{
		switch ($type) {
			case 1:
				return 'Sole Propritorship';
				break;
			case 2:
				return 'Partnership';
				break;
			case 3:
				return 'Corporation';
				break;
			case 4:
				return 'Government-Agency';
				break;
			case 5:
				return 'Non Goverrment Organization (NGO)';
				break;
			case 6:
				return 'Multinational';
				break;
			default:
				# code...
				break;
		}
	}

	/** 
       * function getPosLevel()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getPosLevel($type) 
	{
		switch ($type) {
			case 1:
				return '1-4 Years Experience';
				break;
			case 2:
				return '5-10 Years Experience';
				break;
			case 3:
				return 'Managerial';
				break;
			case 4:
				return 'OIC/CEO/SVP/AVP/VP/Director';
				break;
			case 5:
				return 'Fresh Graduate/1 yrs less experience';
				break;
			case 6:
				return 'No experience';
				break;
			default:
				# code...
				break;
		}
	}

	/** 
       * function getCompNature()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getLocationRegion($type) 
	{
		switch ($type) {
			case 1:
				return 'ARMM';
				break;
			case 2:
				return 'Bicol Region';
				break;
			case 3:
				return 'C.A.R';
				break;
			case 4:
				return 'Cagayan Valley';
				break;
			case 5:
				return 'Calabarzon';
				break;
			case 6:
				return 'Caraga';
				break;
			case 7:
				return 'Central Luzon';
				break;
			case 8:
				return 'Central Visayas';
				break;
			case 9:
				return 'Eastern Visayas';
				break;
			case 10:
				return 'Ilocos Region';
				break;
			case 11:
				return 'N.C.R';
				break;
			case 12:
				return 'Nothern Mindanao';
				break;
			case 13:
				return 'Southern Mindanao';
				break;
			case 14:
				return 'Southern Tagalog';
				break;
			case 15:
				return 'Western Mindanao';
				break;
			case 16:
				return 'Western Visayas';
				break;
			case 17:
				return 'China';
				break;
			case 18:
				return 'Hongkong';
				break;
			case 19:
				return 'India';
				break;
			case 20:
				return 'Indonesia';
				break;
			case 21:
				return 'Japan';
				break;
			case 22:
				return 'Malaysia';
				break;
			case 23:
				return 'Singapore';
				break;
			case 24:
				return 'Thailand';
				break;
			case 25:
				return 'Vietnam';
				break;
			case 26:
				return 'Africa';
				break;
			case 27:
				return 'Middle East';
				break;
			case 28:
				return 'Australia & New Zealand';
				break;
			case 29:
				return 'Europe';
				break;
			case 30:
				return 'North America';
				break;
			case 31:
				return 'South America';
				break;
			default:
				# code...
				break;
		}
	}

	/** 
       * function getSpecializationType()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getSpecializationType($type) 
	{
		switch ($type) {
			case 1:
				return 'Accounting - Accounting Management';
				break;
			case 2:
				return 'Accounting - Gen Accounting';
				break;
			case 3:
				return 'Accounting - Consulating';
				break;
			case 4:
				return 'Accounting - Financial Analyst';
				break;
			case 5:
				return 'Accounting - Treasurer';
				break;
			case 6:
				return 'Accounting - Audit & Taxation';
				break;
			case 7:
				return 'Accounting - Credit Control';
				break;
			case 8:
				return 'Accounting - Financial Control';
				break;
			case 9:
				return 'Accounting - Liquidation';
				break;
			case 10:
				return 'Banking & Finance - Banking Services';
				break;
			case 11:
				return 'Banking & Finance - Credit Collection';
				break;
			case 12:
				return 'Banking & Finance - Security Services';
				break;
			case 13:
				return 'Banking & Finance - Financial Services';
				break;
			case 14:
				return 'HR/Admin - Admin Management';
				break;
			case 15:
				return 'HR/Admin - Admin Staff';
				break;
			case 16:
				return 'HR/Admin - Admin Secretarial';
				break;
			case 17:
				return 'HR/Admin - HR Management';
				break;
			case 18:
				return 'HR/Admin - HR Staff';
				break;
			case 19:
				return 'HR/Admin - HR Secretarial';
				break;
			case 20:
				return 'Sports and Recreation Service';
				break;
			case 21:
				return 'Nutrionist';
				break;
			case 22:
				return 'Beauty Service';
				break;
			case 23:
				return 'All Beauty Care and Health Service';
				break;
			case 24:
				return 'Architectural';
				break;
			case 25:
				return 'Civil';
				break;
			case 26:
				return 'Builder/Construction';
				break;
			case 27:
				return 'All Building/Construction';
				break;
			case 28:
				return 'Designing - Multimedia';
				break;
			case 29:
				return 'Designing - Fine Arts';
				break;
			case 30:
				return 'Designing - Online';
				break;
			case 31:
				return 'Designing - Fashion';
				break;
			case 32:
				return 'Designing - Product';
				break;
			case 33:
				return 'Education';
				break;
			case 34:
				return 'Education - Professor';
				break;
			case 35:
				return 'Education - Teacher';
				break;
			case 36:
				return 'Education - Instructor';
				break;
			case 37:
				return 'Education - Lecturer';
				break;
			case 38:
				return 'Education - Tutor';
				break;
			case 39:
				return 'Education - Mentor';
				break;
			case 40:
				return 'Engineering - Civil';
				break;
			case 41:
				return 'Engineering - Chemical';
				break;
			case 42:
				return 'Engineering - Electrical';
				break;
			case 43:
				return 'Engineering - Mechanical';
				break;
			case 44:
				return 'Engineering - System';
				break;
			case 45:
				return 'Engineering - Computer';
				break;
			case 46:
				return 'Food & Beverages';
				break;
			case 47:
				return 'Hotel Services';
				break;
			case 48:
				return 'Travel Agency';
				break;
			case 49:
				return 'IT - Consultancy';
				break;
			case 50:
				return 'IT - Software';
				break;
			case 51:
				return 'IT - Hardware';
				break;
			case 52:
				return 'IT - Web/online';
				break;
			case 53:
				return 'IT - Analyst';
				break;
			case 54:
				return 'IT - Mobile';
				break;
			case 55:
				return 'IT - Networking';
				break;
			case 56:
				return 'IT - Security';
				break;
			case 57:
				return 'IT - Technical Writing';
				break;
			case 58:
				return 'IT - Tester/QA';
				break;
			case 59:
				return 'IT - SEO';
				break;
			case 60:
				return 'IT - Technical Support';
				break;
			case 61:
				return 'MIS/IT Manager/Director/Consultant';
				break;
			case 62:
				return 'IT - Project Manager';
				break;
			case 63:
				return 'IT - DBA';
				break;
			case 64:
				return 'Insurance - Agent/Broker';
				break;
			case 65:
				return 'Insurance - Underwriter';
				break;
			case 66:
				return 'Insurance - CSR';
				break;
			case 67:
				return 'Insurance - Claims Representative';
				break;
			case 68:
				return 'Insurance - Adjuster';
				break;
			case 69:
				return 'Insurance - Actuarial';
				break;
			case 70:
				return 'Insurance - Regulator';
				break;
			case 71:
				return 'Management - Gen. Management';
				break;
			case 72:
				return 'Management - Top Level Management';
				break;
			case 73:
				return 'Gen. Manufacturing';
				break;
			case 74:
				return 'Production Worker';
				break;
			case 75:
				return 'Manufacturing - Development';
				break;
			case 76:
				return 'Manufacturing - Quality Assurance';
				break;
			case 77:
				return 'Marketing';
				break;
			case 78:
				return 'Public Relation';
				break;
			case 79:
				return 'Sales';
				break;
			case 80:
				return 'Media & Advertising - Journalism';
				break;
			case 81:
				return 'Media & Advertising - Media Broadcasting';
				break;
			case 82:
				return 'Media & Advertising - Media Production';
				break;
			case 83:
				return 'Media & Advertising - Advertising and Editorial';
				break;
			case 84:
				return 'Media & Advertising - Media Planner';
				break;
			case 85:
				return 'Media & Advertising - Director and Creatives';
				break;
			case 86:
				return 'Media & Advertising - Media Buyer';
				break;
			case 87:
				return 'Medical - Doctors';
				break;
			case 88:
				return 'Medical - Nursing';
				break;
			case 89:
				return 'Medical - Specialist';
				break;
			case 90:
				return 'Medical - Dentist';
				break;
			case 91:
				return 'Medical - Veterinarian';
				break;
			case 92:
				return 'Medical - Medical Service Technician';
				break;
			case 93:
				return 'Medical - Pharmaceutical';
				break;
			case 94:
				return 'Medical - Therapist';
				break;
			case 95:
				return 'Merchandising & Purchasing - Electronics';
				break;
			case 96:
				return 'Merchandising & Purchasing - All Accesories';
				break;
			case 97:
				return 'Merchandising & Purchasing - All Garments';
				break;
			case 98:
				return 'Merchandising & Purchasing - Appliances';
				break;
			case 99:
				return 'Merchandising & Purchasing - All Merchandising';
				break;
			case 100:
				return 'Professional Services - Property';
				break;
			case 101:
				return 'Professional Services - Consultancy & Management';
				break;
			case 102:
				return 'Public/Civil - Civil Services';
				break;
			case 103:
				return 'Public/Civil - Foreign Affairs';
				break;
			case 104:
				return 'Public/Civil - Government Bodies';
				break;
			case 105:
				return 'Public/Civil - Military/Defense';
				break;
			case 106:
				return 'Public/Civil - Social Services';
				break;
			case 107:
				return 'Public/Civil - Utilities';
				break;
			case 108:
				return 'Sales/Customer Service - CSR/TSR';
				break;
			case 109:
				return 'Sales/Customer Service - Retail/Wholesaler';
				break;
			case 110:
				return 'Research & Development';
				break;
			case 111:
				return 'All laboratory jobs';
				break;
			case 112:
				return 'Telecomm - Engineering';
				break;
			case 113:
				return 'Telecomm - Administration';
				break;
			case 114:
				return 'Telecomm - Staff';
				break;
			case 115:
				return 'Transpo & Logistics - Land';
				break;
			case 116:
				return 'Transpo & Logistics - Aerial';
				break;
			case 117:
				return 'Transpo & Logistics - Maritime Services';
				break;
			case 118:
				return 'Skill Worker';
				break;
			case 119:
				return 'Artist';
				break;
			case 120:
				return 'Modelling';
				break;
			case 121:
				return 'Singers';
				break;
			case 122:
				return 'Musicians';
				break;
			case 123:
				return 'Entertainer';
				break;
			case 124:
				return 'Creative Artist';
				break;
			case 125:
				return 'All Others';
				break;
			
			default:
				# code...
				break;
		}
	}

	/** 
       * function getEducRequirements()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getEducRequirements($jobId) 
	{		
    	$query = $this->db->select('education')->from('job_educ_reqs');
		$this->db->where('job_id', $jobId);
		$query = $this->db->get();
		return $query->result_array();
	}

  	/** 
       * function getEducRequirements()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getEducRequirementsDetails($jobId) 
	{		
    	$query = $this->db->select('education')->from('job_educ_reqs');
		$this->db->where('job_id', $jobId);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['education'] = $this->getEducRecDetails($row['education']);
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/** 
       * function getEducRecDetails()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getEducRecDetails($type) 
	{
		switch ($type) {
			case 1:
				return 'High School Undergraduate';
				break;
			case 2:
				return 'Degree Holder';
				break;
			case 3:
				return 'College Graduate';
				break;
			case 4:
				return 'Master Degree Holder';
				break;
			case 5:
				return 'Vocational / Short Courses / Diploma';
				break;
			case 6:
				return 'PhD / Doctorate Holder';
				break;
			default:
				# code...
				break;
		}
	}

	/** 
       * function getEmpType()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getEmpType($jobId) 
	{		
    	$query = $this->db->select('emp_type')->from('job_employment_type');
		$this->db->where('job_id', $jobId);
		$query = $this->db->get();		
	    return $query->result_array();
	}

	/** 
       * function getEmpTypeDetails()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getEmpTypeDetails($jobId) 
	{		
    	$query = $this->db->select('emp_type')->from('job_employment_type');
		$this->db->where('job_id', $jobId);
		$query = $this->db->get();		
	    if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['emp_type'] = $this->getEmploymentType($row['emp_type']);
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/** 
       * function getEmploymentType()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getEmploymentType($type) 
	{
		switch ($type) {
			case 1:
				return 'Full Time';
				break;
			case 2:
				return 'Permanent';
				break;
			case 3:
				return 'Part Time/Temporary';
				break;
			case 4:
				return 'Agency';
				break;
			case 5:
				return 'Contract/Project-Based';
				break;
			case 6:
				return 'Internship/OJT';
				break;
			default:
				# code...
				break;
		}
	}

	/** 
       * function getJobBenefits()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getJobBenefits($jobId) 
	{		
    	$query = $this->db->select('benefits')->from('job_other_benefits');
		$this->db->where('job_id', $jobId);
		$query = $this->db->get();		
	    return $query->result_array();
	}

	/** 
       * function getBenefitsDetails()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getBenefitsDetails($type) 
	{
		switch ($type) {
			case 1:
				return 'SSS';
				break;
			case 2:
				return 'Rice Allowance';
				break;
			case 3:
				return 'Performance Bonus';
				break;
			case 4:
				return 'GSIS';
				break;
			case 5:
				return 'Meal Allowance';
				break;
			case 6:
				return 'Health & Dental Care';
				break;
			case 7:
				return 'Pagibig';
				break;
			case 8:
				return 'Education Allowance';
				break;
			case 9:
				return 'Sick & Vacation Leave';
				break;
			case 10:
				return 'Philhealth';
				break;
			case 11:
				return 'Transpo Allowance';
				break;
			case 12:
				return 'Annual Outing';
				break;
			case 13:
				return '13th Month Pay';
				break;
			case 14:
				return 'Team Building Allowance';
				break;
			case 15:
				return '14th Month Pay';
				break;
			case 16:
				return 'Health & Dental Care';
				break;
			case 17:
				return 'Commision';
				break;
			case 18:
				return 'Profit Sharing';
				break;
			default:
				# code...
				break;
		}
	}

	/** 
       * function getJobBenefitsDetails()
       *
       * get table info
	   * @param $job_id - int
       * @return array
       */
  	function getJobBenefitsDetails($jobId) 
	{		
    	$query = $this->db->select('benefits')->from('job_other_benefits');
		$this->db->where('job_id', $jobId);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['benefits'] = $this->getBenefitsDetails($row['benefits']);
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/** 
       * function getEmployerInfo()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getEmployerInfo($empId) 
	{		
    	$query = $this->db->select('employer_details.*,country.name as country')->from('employer_details');
    	$this->db->join('country','country.countryId = employer_details.country','left');
		$this->db->where('emp_id', $empId);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['comp_size'] = $this->getCompSize($row['comp_size']);
				$row['dress_code'] = $this->getDressCode($row['dress_code']);
				$row['working_hrs'] = $this->getWorkingHours($row['working_hrs']);
				$row['spoken_lang'] = $this->getSpokenLang($row['spoken_lang']);
				$row['comp_type'] = $this->getCompType($row['comp_type']);
				$row['comp_nature'] = $this->getCompNature($row['comp_nature']);
				$data['empDetails'] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/** 
       * function getEmpBilling()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getEmpBilling($empId,$status='') 
	{		
		//var_dump($status);exit();
    	$query = $this->db->select('avail_jobpromo.job_id,avail_jobpromo.promo,avail_jobpromo.status,
    								jobs.job_title,
    								jobs.joborderid,
    								jobs.created_on')
    	->from('avail_jobpromo');
    	$this->db->join('jobs','jobs.jobId = avail_jobpromo.job_id','left');
		$this->db->where('avail_jobpromo.emp_id', $empId);
		$this->db->where('avail_jobpromo.status', $status);	
		$this->db->group_by('avail_jobpromo.job_id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['promo'] = $this->getJobPromo($row['job_id']);
				$row['jobBill'] = $this->getBill($row['job_id'],'avail_jobpromo');				
				$data[] = $row;
			}
			// echo "<pre>";
			// print_r($data);exit();
			// echo "</pre>";
			return $data;
		}
		return false;
	}

	/** 
       * function getFLEmpBilling()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getFLEmpBilling($empId,$status='') 
	{		
    	$query = $this->db->select('avail_flpromo.job_id,avail_flpromo.promo,avail_flpromo.status,
    								freelance_job.project_name as job_title,
    								freelance_job.joborderid,
    								freelance_job.created_on')
    	->from('avail_flpromo');
    	$this->db->join('freelance_job','freelance_job.fljobId = avail_flpromo.job_id','left');
		$this->db->where('avail_flpromo.emp_id', $empId);
		$this->db->where('avail_flpromo.status', $status);	
		$this->db->group_by('avail_flpromo.job_id');
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['promo'] = $this->getFLJobPromo($row['job_id']);
				$row['jobBill'] = $this->getFLJobBill($row['job_id'],'avail_flpromo');				
				$data[] = $row;
			}
			// echo "<pre>";
			// print_r($data);exit();
			// echo "</pre>";
			return $data;
		}
		return false;
	}

	/** 
       * function getBill()
       *
       * get table info
	   * @param $jobId - int
       * @return array
       */
  	function getBill($jobId,$tableName) 
	{		
    	$query = $this->db->select('promo')->from($tableName);
		$this->db->where('job_id', $jobId);
		$query = $this->db->get();		
	    if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['total'] = $this->getJobBillAmount($row['promo']);
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/** 
       * function getBill()
       *
       * get table info
	   * @param $jobId - int
       * @return array
       */
  	function getFLJobBill($jobId,$tableName) 
	{		
    	$query = $this->db->select('promo')->from($tableName);
		$this->db->where('job_id', $jobId);
		$query = $this->db->get();		
	    if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['total'] = $this->getFLJobBillAmount($row['promo']);
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/** 
       * function getJobBillAmount()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getJobBillAmount($promo) 
	{		
    	switch ($promo) {
			case 1:
				return JOBPROMO1;
				break;
			case 2:
				return JOBPROMO2;
				break;
			case 3:
				return JOBPROMO3;
				break;
			default:
				# code...
				break;
		}
  	}

  	/** 
       * function getJobBillAmount()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getFLJobBillAmount($promo) 
	{		
    	switch ($promo) {
			case 1:
				return FLJOBPROMO1;
				break;
			case 2:
				return FLJOBPROMO2;
				break;
			case 3:
				return FLJOBPROMO3;
				break;
			case 4:
				return FLJOBPROMO3;
				break;
			case 5:
				return FLJOBPROMO3;
				break;
			case 6:
				return FLJOBPROMO3;
				break;			
			default:
				# code...
				break;
		}
  	}

	/** 
       * function getCompSize()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getCompSize($type) 
	{
		switch ($type) {
			case 1:
				return '1-10 employees';
				break;
			case 2:
				return '1-20 employees';
				break;
			case 3:
				return '1-30 employees';
				break;
			case 4:
				return '1-50 employees';
				break;
			case 5:
				return '50-100 employees';
				break;
			case 6:
				return '100-200 employees';
				break;
			case 7:
				return '200-500 employees';
				break;
			case 8:
				return '500-1000 employees';
				break;
			default:
				# code...
				break;
		}
	}

	/** 
       * function getCompSize()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getCompNature($type) 
	{
		switch ($type) {
			case 1:
				return 'Accounting / Audit / Tax Services';
				break;
			case 2:
				return 'Advertising / Public Relations / Marketing Services';
				break;
			case 3:
				return 'Agriculture / Forestry / Fishing';
				break;
			case 4:
				return 'Animal / Livestock / Poultry Production';
				break;
			case 5:
				return 'Architecture / Building / Construction';
				break;
			case 6:
				return 'Photography / Videography / Arts';
				break;
			case 7:
				return 'Athletics / Sports';
				break;
			case 8:
				return 'Contact Center / BPO';
				break;
			case 9:
				return 'Charity / Social Services / Non-Profit Organisation';
				break;
			case 10:
				return 'Civil Services (Government, Armed Forces)';
				break;
			case 11:
				return 'Education';
				break;
			case 12:
				return 'Energy / Power / Water / Oil &amp; Gas / Waste Management';
				break;
			case 13:
				return 'Engineering - Building, Civil, Construction / Quantity Survey';
				break;
			case 14:
				return 'Engineering - Electrical / Electronic / Mechanical';
				break;
			case 15:
				return 'Engineering - Others';
				break;
			case 16:
				return 'Entertainment / Recreation';
				break;
			case 17:
				return 'Environmental Science';
				break;
			case 18:
				return 'Export';
				break;
			case 19:
				return 'Financial Services';
				break;
			case 20:
				return 'FMCG';
				break;
			case 21:
				return 'Food and Catering Services';
				break;
			case 22:
				return 'Freight Forwarding / Delivery / Shipping';
				break;
			case 23:
				return 'General Business Services';
				break;
			case 24:
				return 'General Engineering Services';
				break;
			case 25:
				return 'Health Services &amp; Beauty Care';
				break;
			case 26:
				return 'Hospitality / Hotel Services';
				break;
			case 27:
				return 'Information Technology';
				break;
			case 28:
				return 'Insurance / Pension Funding';
				break;
			case 29:
				return 'Design';
				break;
			case 30:
				return 'Legal Services';
				break;
			case 31:
				return 'Life Sciences';
				break;
			case 32:
				return 'Manpower / Personnel Recruitment';
				break;
			case 33:
				return 'Manufacturing';
				break;
			case 34:
				return 'Mass Transportation (Land, Air, Sea)';
				break;
			case 35:
				return 'Media / Publishing / Printing';
				break;
			case 36:
				return 'Medical / Pharmaceutical';
				break;
			case 37:
				return 'Mining and Quarrying';
				break;
			case 38:
				return 'Property Management / Consultancy';
				break;
			case 39:
				return 'Security / Protection Services';
				break;
			case 40:
				return 'Telecommunication';
				break;
			case 41:
				return 'Tourism / Travel Agency';
				break;
			case 42:
				return 'Trading and Distribution';
				break;
			
			default:
				# code...
				break;
		}
	}

	/** 
       * function dress_code()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getDressCode($type) 
	{
		switch ($type) {
			case 1:
				return 'Formal Business Attire';
				break;
			case 2:
				return 'Casual Attire';
				break;
			case 3:
				return 'Formal Business Attire (M-TH) Casual (F)';
				break;			
			default:
				# code...
				break;
		}
	}

	/** 
       * function getWorkingHours()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getWorkingHours($type) 
	{
		switch ($type) {
			case 1:
				return '5 days a week, Day Shift';
				break;
			case 2:
				return '5 days a week, Night Shift';
				break;
			case 3:
				return '6 days a week, Day Shift';
				break;	
			case 4:
				return '6 days a week, Night Shift';
				break;		
			case 5:
				return '5 days a week, Shifting Schedule';
				break;	
			case 6:
				return '6 days a week, Shifting Schedule';
				break;		
			default:
				# code...
				break;
		}
	}

	/** 
       * function getSpokenLang()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getSpokenLang($type) 
	{
		switch ($type) {
			case 1:
				return 'English';
				break;
			case 2:
				return 'Tagalog';
				break;
			case 3:
				return 'Taglish';
				break;	
			case 4:
				return 'Chinese';
				break;		
			case 5:
				return 'Japanese';
				break;	
			case 6:
				return 'English & Tagalog';
				break;	
			case 7:
				return 'English & Chinese';
				break;
			case 8:
				return 'English & Japanese';
				break;
			case 9:
				return 'Multilingual';
				break;	
			default:
				# code...
				break;
		}
	}

	/** 
       * function getEmployerDetails()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getEmployerDetails($empId) 
	{		
    	$query = $this->db->select('*')->from('employer_details');
		$this->db->where('emp_id', $empId);
		$query = $this->db->get();		
	    return $query->result_array();
	}

	/** 
       * function getJobsCnt()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getJobsCnt($empId,$status) 
	{		
    	$query = $this->db->select('COUNT(job_title) AS cnt')->from('jobs');
		$this->db->where('emp_id', $empId);
		$this->db->where('active', $status);
		$this->db->where('is_removed', 0);
		$query = $this->db->get();		
	    return $query->row_array();
	}

	/** 
       * function getFLJobsCnt()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
  	function getFLJobsCnt($empId,$status) 
	{		
    	$query = $this->db->select('COUNT(project_name) AS cnt')->from('freelance_job');
		$this->db->where('emp_id', $empId);
		$this->db->where('is_approved', $status);
		$this->db->where('is_removed', 0);
		$query = $this->db->get();		
	    return $query->row_array();
	}

	/**
	 * Get all cms banner
	 *
	 * @return	$array
	 */
	public function getPostedJobs($sort,$limit, $offset,$empId) {	
		$query = $this->db->select('jobs.jobId,jobs.emp_id,jobs.job_title,jobs.active,
									jobs.created_on,job_details.date_posted,job_details.date_expiry')->
						from('jobs')
						->join('job_details','job_details.job_id = jobs.jobId','left');
		$this->db->where('jobs.emp_id', $empId);
		$this->db->where('jobs.active', $sort['status']);
		$this->db->where('jobs.is_removed', 0);
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['job_promo'] = $this->getJobPromo($row['jobId']);
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	/**
	 * getAllPostedJobsr
	 *
	 * @return	$array
	 */
	public function getAllPostedJobs($sort,$empId) {	
		$query = $this->db->select('jobs.joborderid,jobs.jobId,jobs.emp_id,jobs.job_title,jobs.active,
									jobs.created_on,job_details.date_posted,job_details.date_expiry')->
						from('jobs')
						->join('job_details','job_details.job_id = jobs.jobId','left');
		$this->db->where('jobs.emp_id', $empId);
		$this->db->where('jobs.active', $sort['status']);
		$this->db->where('jobs.is_removed', 0);
		//$this->db->limit(5);
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['job_promo'] = $this->getJobPromo($row['jobId']);
				$row['applicantCnt'] = $this->getApplicantCnt($row['jobId'],0,1);
				$row['shortlistCnt'] = $this->getApplicantCnt($row['jobId'],1,1);
				$row['forInterviewCnt'] = $this->getApplicantCnt($row['jobId'],2,1);
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	/**
	 * getAllPostedJobsr
	 *
	 * @return	$array
	 */
	public function getJobInfoDetails($jobId,$status) {	
		$query = $this->db->select('jobs.jobId,jobs.emp_id,jobs.job_title,jobs.active,									
									')->from('jobs');
		$this->db->where('jobs.jobId', $jobId);
		//$this->db->limit(5);
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				//$row['applied_on'] = mdate('%M %d, %Y',strtotime($row['applied_on']));
				$row['jobApplicants'] = $this->getJobApplicants($row['jobId'],$status);
				$data[] = $row;
				//var_dump($data);exit();
			}
			return $data;
		}
		return false;
	}

	/**
	 * getAllPostedJobsr
	 *
	 * @return	$array
	 */
	public function getJobApplicants($jobId,$status) {	
		$query = $this->db->select('job_applicant.jobId,
									job_applicant.applied_on,
									job_applicant.applicantId,
									player.username,
									playerdetails.firstName,
									playerdetails.lastName')->
						from('job_applicant')
						->join('jobs','jobs.jobId = job_applicant.jobId','left')
						->join('job_details','job_details.job_id = jobs.jobId','left')
						->join('player','player.playerId = job_applicant.applicantId','left')
						->join('playerdetails','playerdetails.playerId = player.playerId','left');
		$this->db->where('job_applicant.jobId', $jobId);
		if($status < 3){
			$this->db->where('job_applicant.candidate_status', $status);
		}elseif($status > 2){
			$this->db->where('job_applicant.candidate_status >', 2);
		}
		
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['applied_on'] = mdate('%M %d, %Y',strtotime($row['applied_on']));
				//$row['job_promo'] = $this->getJobPromo($row['jobId']);
				$data[] = $row;
				//var_dump($data);exit();
			}
			return $data;
		}
		return false;
	}

		/**
	 * getAllPostedJobsr
	 *
	 * @return	$array
	 */
	public function getFreelanceJobInfoDetails($fljobId,$status) {	
		$query = $this->db->select('freelance_job.project_name,
									freelance_job.fljobId									')
						->from('freelance_job');
		$this->db->where('freelance_job.fljobId', $fljobId);
		$this->db->limit(5);
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				//$row['applied_on'] = mdate('%M %d, %Y',strtotime($row['applied_on']));
				//$row['job_promo'] = $this->getJobPromo($row['jobId']);

				$row['freelancejobApplicants'] = $this->getFreelanceJobApplicants($row['fljobId'],$status);
				$data[] = $row;
				//var_dump($data);exit();
			}
			return $data;
		}
		return false;
	}

	

	/**
	 * getAllPostedJobsr
	 *
	 * @return	$array
	 */
	public function getFreelanceJobApplicants($fljobId,$status) {	
		$query = $this->db->select('freelancejob_applicant.jobApplicantId,
									freelancejob_applicant.applicantId,
									freelancejob_applicant.applied_on,
									freelancejob_applicant.candidate_status,
									freelancejob_applicant.fljobId,
									player.username,
									playerdetails.firstName,
									playerdetails.lastName')->
						from('freelance_job')
						->join('freelancejob_applicant','freelancejob_applicant.fljobId = freelance_job.fljobId','left')
						->join('player','player.playerId = freelancejob_applicant.jobApplicantId','left')
						->join('playerdetails','playerdetails.playerId = player.playerId','left');
		$this->db->where('freelance_job.fljobId', $fljobId);
		if($status < 3){
			$this->db->where('freelancejob_applicant.candidate_status', $status);
		}elseif($status > 2){
			$this->db->where('freelancejob_applicant.candidate_status >', 2);
		}
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['applied_on'] = mdate('%M %d, %Y',strtotime($row['applied_on']));
				//$row['job_promo'] = $this->getJobPromo($row['jobId']);
				$data[] = $row;
				//var_dump($data);exit();
			}
			return $data;
		}
		return false;
	}

	/**
	 * Get fl jobs
	 *
	 * @return	$array
	 */
	public function getPostedFLJobs($sort,$empId) {

		$query = $this->db->select('*')
						->from('freelance_job');
		$this->db->where('freelance_job.emp_id', $empId);
		$this->db->where('freelance_job.is_approved', $sort['is_approved']);
		$this->db->where('freelance_job.is_removed', 0);
		$this->db->order_by('freelance_job.created_on','DESC');
		//$this->db->limit(5);
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['job_promo'] = $this->getFLJobPromo($row['fljobId']);
				$row['applicantCnt'] = $this->getApplicantCnt($row['fljobId'],0,2);
				$row['shortlistCnt'] = $this->getApplicantCnt($row['fljobId'],1,2);
				$row['forInterviewCnt'] = $this->getApplicantCnt($row['fljobId'],2,2);
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	/**
       * getFLJobPromo
       *
       * @return array
       */

	public function getFLJobPromo($fljobId) {
		$this->db->select('promo')
		->from('avail_flpromo');
		$this->db->where('avail_flpromo.job_id', $fljobId);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['promo_type'] = $this->getFreelanceJobDetails($row['promo']);
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	/**
       * getFLJobPromo
       *
       * @return array
       */

	public function getJobPromo($jobId) {
		$this->db->select('promo')
		->from('avail_jobpromo');
		$this->db->where('avail_jobpromo.job_id', $jobId);

		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['promo_type'] = $this->getJobDetails($row['promo']);
				$data[] = $row;
			}
			return $data;
		}
		return false;
	}

	
	/**
	 * updateFLJobPostStatus
	 *
	 * @return	$array
	 */
	public function updateFLJobPostStatus($data) {
		$this->db->where('fljobId', $data['fljobId']);
		$this->db->update('freelance_job', $data);
	}

	/**
	 * assessApplicant
	 *
	 * @return	$array
	 */
	public function assessFJApplicant($data,$fljobId,$applicantId) {
		$this->db->where('applicantId', $applicantId);
		$this->db->where('fljobId', $fljobId);
		$this->db->update('freelancejob_applicant', $data);
	}

	/**
	 * assessJobApplicant
	 *
	 * @return	$array
	 */
	public function assessJobApplicant($data,$jobId,$applicantId) {
		$this->db->where('applicantId', $applicantId);
		$this->db->where('jobId', $jobId);
		$this->db->update('job_applicant', $data);
	}

	/**
	 * updateJobPostStatus
	 *
	 * @return	$array
	 */
	public function updateJobPostStatus($data) {
		$this->db->where('jobId', $data['jobId']);
		$this->db->update('jobs', $data);
	}	

	/**
	 * activatedDeactivateFLJobPost
	 *
	 * @return	$array
	 */
	public function activatedDeactivateFLJobPost($data) {
		$this->db->where('fljobId', $data['fljobId']);
		$this->db->update('freelance_job', $data);
	}

	/**
	 * activatedDeactivateJobPost
	 *
	 * @return	$array
	 */
	public function activatedDeactivateJobPost($data) {
		$this->db->where('jobId', $data['jobId']);
		$this->db->update('jobs', $data);
	}

	/**
	 * edit employer media
	 *
	 * @param	array
	 * @param	int
	 */
	public function editEmpLogo($data) {
		$this->db->where('emp_id', $data['emp_id']);
		$this->db->update('employer_media', $data);
	}

	/**
	 * edit employer media
	 *
	 * @param	array
	 * @param	int
	 */
	public function addFreelanceJobDetails($data) {
		$this->db->insert('freelance_job_doc', $data);
	}

	/** 
       * function get_emp_comp_name()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getEmpLogo($emp_id) 
	{		
    	$query = $this->db->select('mediaName')->from('employer_media')
    	->where('emp_id', $emp_id)
    	->where('mediaCategory', 'comp_logo');
	    $query = $this->db->get();		
	    return $query->row_array();
  	}

  	/** 
       * function getJobPaymentDetails()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getJobPaymentDetails($job_id) 
	{		
    	$query = $this->db->select('job_id,promo,status')->from('avail_jobpromo')->where('job_id', $job_id);
	    // $query = $this->db->get();		
	    // return $query->result_array();
	    $query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['amount'] = $this->getJobAmount($row['promo']);
				$row['details'] = $this->getJobDetails($row['promo']);
				$row['desc'] = $this->getJobDesc($row['promo']);
				
				$data[] = $row;
			}
			// var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function getFreelanceJobPaymentDetails()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getFreelanceJobPaymentDetails($job_id) 
	{		
    	$query = $this->db->select('job_id,promo,status')->from('avail_flpromo')->where('job_id', $job_id);
	    // $query = $this->db->get();		
	    // return $query->result_array();
	    $query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['amount'] = $this->getFreelanceJobAmount($row['promo']);
				$row['details'] = $this->getFreelanceJobDetails($row['promo']);
				$row['desc'] = $this->getFreelanceJobDesc($row['promo']);
				
				$data[] = $row;
			}
			// var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function getJobAmount()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getJobAmount($type) 
	{
		switch ($type) {
			case 1:
				return '5000';
				break;
			case 2:
				return '500';
				break;
			case 3:
				return '500';
				break;			
		}
	}

  	/** 
       * function getSpokenLang()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getFreelanceJobAmount($type) 
	{
		switch ($type) {
			case 1:
				return '1100';
				break;
			case 2:
				return '300';
				break;
			case 3:
				return '300';
				break;
			case 4:
				return '300';
				break;
			case 5:
				return '700';
				break;
			case 6:
				return '700';
				break;
		}
	}

	/** 
       * function getJobDetails()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getJobDetails($type) 
	{
		switch ($type) {
			case 1:
				return 'JK Agent';
				break;
			case 2:
				return 'JK Featured';
				break;
			case 3:
				return 'JK Urgent';
				break;			
		}
	}

	/** 
       * function getFreelanceJobDetails()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getFreelanceJobDetails($type) 
	{
		switch ($type) {
			case 1:
				return 'JK Agent';
				break;
			case 2:
				return 'JK Featured';
				break;
			case 3:
				return 'JK Urgent';
				break;
			case 4:
				return 'JK Locked';
				break;
			case 5:
				return 'JK VIP 1';
				break;
			case 6:
				return 'JK VIP 2';
				break;
		}
	}

	function getFreelanceJobDesc($type) 
	{
		switch ($type) {
			case 1:
				return 'We will help you find the best candidates for your project. ';
				break;
			case 2:
				return 'This will add to our featured section and will attract more bidders.';
				break;
			case 3:
				return 'This will add to our urgent section and will attract more bidders.';
				break;
			case 4:
				return 'Make bidders bid invisible to other bidders. ';
				break;
			case 5:
				return 'This will make your project secured with confidentiality and only choosen bidders can only see the project details. ';
				break;
			case 6:
				return 'This project must be signed with a Non-disclosure Aggrement to work on your project.';
				break;
		}
	}

	function getJobDesc($type) 
	{
		switch ($type) {
			case 1:
				return 'We will help you find the best candidates for your project. ';
				break;
			case 2:
				return 'This will add to our featured section and will attract more applicant.';
				break;
			case 3:
				return 'This will add to our urgent section and will attract more applicant.';
				break;
		}
	}

  	/** 
       * function getFreelanceJob()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getFreelanceJob($fljobId) 
	{		
    	$query = $this->db->select('freelance_job.*,freelance_skill_req.skills,employer.employerId as empId')
    			->from('freelance_job')
    			->join('employer','employer.employerId = freelance_job.emp_id','left')
    			->join('freelance_skill_req','freelance_skill_req.flJobId = freelance_job.fljobId','left')
    			->where('freelance_job.fljobId', $fljobId);
	    $query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$row['payment_currency'] = $this->getCurrency($row['payment_currency']);
				$row['project_duration'] = $this->getProjectDuration($row['project_duration']);
				$row['project_duration_per'] = $this->getProjectDurationPer($row['project_duration_per']);
				$row['project_type'] = $this->getProjectType($row['project_type']);
				$row['payment_type'] = $this->getPaymentType($row['payment_type']);
				$row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$row['freelanceJobDoc'] = $this->getFreelanceJobsDoc($row['fljobId']);
				$data['freelanceJobDetails'] = $row;
			}
			//var_dump($data['freelanceJobDetails']['skills_req']);exit();
			return $data;
		}
		return false;
	    //return $query->row_array();
  	}

  	/** 
       * function getFreelanceJobs()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getFreelanceJobs() 
	{
		$query = $this->db->query("SELECT * FROM freelance_job WHERE is_approved = 1 ORDER BY created_on ASC LIMIT 0,5");		

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$row['payment_currency'] = $this->getCurrency($row['payment_currency']);
				$row['project_duration'] = $this->getProjectDuration($row['project_duration']);
				$row['project_duration_per'] = $this->getProjectDurationPer($row['project_duration_per']);
				$row['project_type'] = $this->getProjectType($row['project_type']);
				$row['payment_type'] = $this->getPaymentType($row['payment_type']);
				$row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function getFreelanceJobsDoc()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getFreelanceJobsDoc($flJobId) 
	{
		$query = $this->db->select("mediaName");		
		$this->db->from('freelance_job_doc');
		$this->db->where('fljob_id',$flJobId);
		$query = $this->db->get();	
		return $query->row_array();
	}

  	/** 
       * function searchFreelanceJobs()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function searchFreelanceJobs() 
	{
		$searchdata = $this->session->userdata('searchfreelancejobs');
		//$query = $this->db->query("SELECT * FROM freelance_job WHERE is_approved = 1 ORDER BY created_on ASC LIMIT 0,5");		
		$this->db->select('*')->from('freelance_job');
	 	$this->db->where('is_approved', 1);
	 	if($searchdata['search']!=''){
	 		$this->db->like('project_name', $searchdata['search']);	
	 	}
	 	if($searchdata['project_type']!=''){
	 		$this->db->where('project_type', $searchdata['project_type']);
	 	}
	 	if($searchdata['budget_range']!=''){
	 		$budgetRange = $this->getBudgetRange($searchdata['budget_range']);
	 		//var_dump($budgetRange);exit();
	 		$this->db->where('min_budget >= ', $budgetRange['minBudget']);
	 		$this->db->where('min_budget <= ', $budgetRange['maxBudget']); 
	 	}
	 	$this->db->order_by('created_on','desc');
	 	$this->db->limit('5');
	 	$this->db->offset('0');
		$query = $this->db->get();
		

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$row['payment_currency'] = $this->getCurrency($row['payment_currency']);
				$row['project_duration'] = $this->getProjectDuration($row['project_duration']);
				$row['project_duration_per'] = $this->getProjectDurationPer($row['project_duration_per']);
				$row['project_type'] = $this->getProjectType($row['project_type']);
				$row['payment_type'] = $this->getPaymentType($row['payment_type']);
				$row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function searchFulltimeJobs()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function searchFulltimeJobs() 
	{
		$searchdata = $this->session->userdata('searchfulltimejobs');
		//$query = $this->db->query("SELECT * FROM freelance_job WHERE is_approved = 1 ORDER BY created_on ASC LIMIT 0,5");		

	 	$query = $this->db->select('jobs.jobId,jobs.emp_id,jobs.job_title,jobs.active,
	 								jobs.location_region,
	 								jobs.location_city,
	 								jobs.company_name,
									jobs.created_on,
									job_details.job_desc,
									job_details.vacancy_num,
								    job_details.specialization,
								    job_details.position_level,
								    job_details.yr_exp,
								    job_details.salary_min,
								    job_details.salary_max,
								    job_details.salary_base,
								    job_details.currency,
								    job_details.show_salary,
								    job_details.salary_type,
								    job_details.date_posted,
								    job_details.date_expiry,
									job_details.sked_type,
									')
	 						->from('jobs')
						    ->join('job_details','job_details.job_id = jobs.jobId','left');
				$this->db->where('jobs.active', 1);
				$this->db->where('jobs.is_removed', 0);

	 	if($searchdata['search']!=''){
	 		$this->db->like('jobs.job_title', $searchdata['search']);	
	 		$this->db->or_like('jobs.company_name', $searchdata['search']);
	 	}
	 	if($searchdata['location']!=''){
	 		
	 		if($searchdata['location'] == 1){
	 			$this->db->like('jobs.location_city', 'caloocan');
	 			$this->db->or_like('jobs.location_city', 'pasay');	
	 			$this->db->or_like('jobs.location_city', 'las pinas');
	 			$this->db->or_like('jobs.location_city', 'makati');
	 			$this->db->or_like('jobs.location_city', 'malabon');
	 			$this->db->or_like('jobs.location_city', 'mandaluyong');
	 			$this->db->or_like('jobs.location_city', 'manila');
	 			$this->db->or_like('jobs.location_city', 'marikina');
	 			$this->db->or_like('jobs.location_city', 'muntinlupa');
	 			$this->db->or_like('jobs.location_city', 'navotas');
	 			$this->db->or_like('jobs.location_city', 'paranaque');
	 			$this->db->or_like('jobs.location_city', 'pasay');
	 			$this->db->or_like('jobs.location_city', 'pasig');
	 			$this->db->or_like('jobs.location_city', 'pateros');
	 			$this->db->or_like('jobs.location_city', 'quezon city');
	 			$this->db->or_like('jobs.location_city', 'san juan');
	 			$this->db->or_like('jobs.location_city', 'taguig');
	 			$this->db->or_like('jobs.location_city', 'valenzuela');
	 		}
	 		elseif($searchdata['location'] == 2){
	 			$this->db->where('jobs.location_region', 11);
	 		}
	 		elseif($searchdata['location'] == 3){
	 			$this->db->where('jobs.location_region', 1);
	 		}
	 		elseif($searchdata['location'] == 4){
	 			$this->db->where('jobs.location_region', 2);
	 		}
	 		elseif($searchdata['location'] == 5){
	 			$this->db->where('jobs.location_region', 3);
	 		}
	 		elseif($searchdata['location'] == 6){
	 			$this->db->where('jobs.location_region', 4);
	 		}
	 		elseif($searchdata['location'] == 7){
	 			$this->db->where('jobs.location_region', 6);
	 		}
	 		elseif($searchdata['location'] == 8){
	 			$this->db->where('jobs.location_region', 7);
	 		}
	 		elseif($searchdata['location'] == 9){
	 			$this->db->where('jobs.location_region', 32);
	 		}
	 		elseif($searchdata['location'] == 10){
	 			$this->db->where('jobs.location_region', 8);
	 		}
	 		elseif($searchdata['location'] == 11){
	 			$this->db->where('jobs.location_region', 9);
	 		}
	 		elseif($searchdata['location'] == 12){
	 			$this->db->where('jobs.location_region', 10);
	 		}
	 		elseif($searchdata['location'] == 13){
	 			$this->db->where('jobs.location_region', 12);
	 		}
	 		elseif($searchdata['location'] == 14){
	 			$this->db->where('jobs.location_region', 13);
	 		}
	 		elseif($searchdata['location'] == 15){
	 			$this->db->where('jobs.location_region', 14);
	 		}
	 		elseif($searchdata['location'] == 16){
	 			$this->db->where('jobs.location_region', 15);
	 		}
	 		elseif($searchdata['location'] == 17){
	 			$this->db->where('jobs.location_region', 16);
	 		}
	 		elseif($searchdata['location'] == 18){
	 			$this->db->where('jobs.location_region', 17);
	 		}
	 		elseif($searchdata['location'] == 19){
	 			$this->db->where('jobs.location_region', 18);
	 		}
	 		elseif($searchdata['location'] == 20){
	 			$this->db->where('jobs.location_region', 19);
	 		}
	 		elseif($searchdata['location'] == 21){
	 			$this->db->where('jobs.location_region', 20);
	 		}
	 		elseif($searchdata['location'] == 22){
	 			$this->db->where('jobs.location_region', 21);
	 		}
	 		elseif($searchdata['location'] == 23){
	 			$this->db->where('jobs.location_region', 22);
	 		}
	 		elseif($searchdata['location'] == 24){
	 			$this->db->where('jobs.location_region', 23);
	 		}
	 		elseif($searchdata['location'] == 25){
	 			$this->db->where('jobs.location_region', 24);
	 		}
	 		elseif($searchdata['location'] == 26){
	 			$this->db->where('jobs.location_region', 25);
	 		}
	 		elseif($searchdata['location'] == 27){
	 			$this->db->where('jobs.location_region', 26);
	 		}
	 		elseif($searchdata['location'] == 28){
	 			$this->db->where('jobs.location_region', 27);
	 		}
	 		elseif($searchdata['location'] == 29){
	 			$this->db->where('jobs.location_region', 28);
	 		}
	 		elseif($searchdata['location'] == 30){
	 			$this->db->where('jobs.location_region', 29);
	 		}
	 		elseif($searchdata['location'] == 31){
	 			$this->db->where('jobs.location_region', 30);
	 		}
	 		elseif($searchdata['location'] == 32){
	 			$this->db->where('jobs.location_region', 31);
	 		}
	 		else{
	 			$this->db->where('jobs.location_city', $searchdata['location']);
	 		}	 		
	 	}
	 	if($searchdata['location_region']!=''){
	 		$this->db->where('jobs.location_region', $searchdata['location_region']);
	 	}
	 	if($searchdata['budget_range']!=''){
	 		$budgetRange = $this->getBudgetRange($searchdata['budget_range']);
	 		//var_dump($budgetRange);exit();
	 		$this->db->where('job_details.salary_min >= ', $budgetRange['minBudget']);
	 		$this->db->where('job_details.salary_min <= ', $budgetRange['maxBudget']); 
	 	}

	 	$this->db->order_by('created_on','desc');
	 	$this->db->limit('5');
	 	$this->db->offset('0');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				// $row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				// $row['payment_currency'] = $this->getCurrency($row['payment_currency']);
				// $row['project_duration'] = $this->getProjectDuration($row['project_duration']);
				// $row['project_duration_per'] = $this->getProjectDurationPer($row['project_duration_per']);
				// $row['project_type'] = $this->getProjectType($row['project_type']);
				$row['location_region'] = $this->getLocationRegion($row['location_region']);
				 $row['salary_type'] = $this->getSalaryType($row['salary_type']);
				 $row['specialization'] = $this->getSpecializationType($row['specialization']);
				 $row['date_posted'] = mdate('%M %d, %Y',strtotime($row['date_posted']));
				 $row['date_expiry'] = mdate('%M %d, %Y',strtotime($row['date_expiry']));
				 $row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				// $row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function searchParttimeJobs()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function searchParttimeJobs() 
	{
		$searchdata = $this->session->userdata('searchparttimejobs');
		//$query = $this->db->query("SELECT * FROM freelance_job WHERE is_approved = 1 ORDER BY created_on ASC LIMIT 0,5");		

	 	$query = $this->db->select('jobs.jobId,jobs.emp_id,jobs.job_title,jobs.active,
	 								jobs.location_region,
	 								jobs.location_city,
	 								jobs.company_name,
									jobs.created_on,
									jobs.active,
									job_details.job_desc,
									job_details.vacancy_num,
								    job_details.specialization,
								    job_details.position_level,
								    job_details.yr_exp,
								    job_details.salary_min,
								    job_details.salary_max,
								    job_details.salary_base,
								    job_details.currency,
								    job_details.show_salary,
								    job_details.salary_type,
								    job_details.date_posted,
								    job_details.date_expiry,
									job_details.sked_type,
									')
	 						->from('job_employment_type')
	 						->join('jobs','jobs.jobId = job_employment_type.job_id','left')
						    ->join('job_details','job_details.job_id = jobs.jobId','left');
				
				
				$this->db->where('jobs.active', '1');
				$this->db->where('jobs.is_removed', 0);

	 	if($searchdata['search']!=''){
	 		$this->db->like('jobs.job_title', $searchdata['search']);	
	 		//$this->db->or_like('jobs.company_name', $searchdata['search']);
	 	}
	 	if($searchdata['location']!=''){	 		
	 		if($searchdata['location'] == 1){
	 			$this->db->like('jobs.location_city', 'caloocan');
	 			$this->db->or_like('jobs.location_city', 'pasay');	
	 			$this->db->or_like('jobs.location_city', 'las pinas');
	 			$this->db->or_like('jobs.location_city', 'makati');
	 			$this->db->or_like('jobs.location_city', 'malabon');
	 			$this->db->or_like('jobs.location_city', 'mandaluyong');
	 			$this->db->or_like('jobs.location_city', 'manila');
	 			$this->db->or_like('jobs.location_city', 'marikina');
	 			$this->db->or_like('jobs.location_city', 'muntinlupa');
	 			$this->db->or_like('jobs.location_city', 'navotas');
	 			$this->db->or_like('jobs.location_city', 'paranaque');
	 			$this->db->or_like('jobs.location_city', 'pasay');
	 			$this->db->or_like('jobs.location_city', 'pasig');
	 			$this->db->or_like('jobs.location_city', 'pateros');
	 			$this->db->or_like('jobs.location_city', 'quezon city');
	 			$this->db->or_like('jobs.location_city', 'san juan');
	 			$this->db->or_like('jobs.location_city', 'taguig');
	 			$this->db->or_like('jobs.location_city', 'valenzuela');
	 		}
	 		elseif($searchdata['location'] == 2){
	 			$this->db->where('jobs.location_region', 11);
	 		}
	 		elseif($searchdata['location'] == 3){
	 			$this->db->where('jobs.location_region', 1);
	 		}
	 		elseif($searchdata['location'] == 4){
	 			$this->db->where('jobs.location_region', 2);
	 		}
	 		elseif($searchdata['location'] == 5){
	 			$this->db->where('jobs.location_region', 3);
	 		}
	 		elseif($searchdata['location'] == 6){
	 			$this->db->where('jobs.location_region', 4);
	 		}
	 		elseif($searchdata['location'] == 7){
	 			$this->db->where('jobs.location_region', 6);
	 		}
	 		elseif($searchdata['location'] == 8){
	 			$this->db->where('jobs.location_region', 7);
	 		}
	 		elseif($searchdata['location'] == 9){
	 			$this->db->where('jobs.location_region', 32);
	 		}
	 		elseif($searchdata['location'] == 10){
	 			$this->db->where('jobs.location_region', 8);
	 		}
	 		elseif($searchdata['location'] == 11){
	 			$this->db->where('jobs.location_region', 9);
	 		}
	 		elseif($searchdata['location'] == 12){
	 			$this->db->where('jobs.location_region', 10);
	 		}
	 		elseif($searchdata['location'] == 13){
	 			$this->db->where('jobs.location_region', 12);
	 		}
	 		elseif($searchdata['location'] == 14){
	 			$this->db->where('jobs.location_region', 13);
	 		}
	 		elseif($searchdata['location'] == 15){
	 			$this->db->where('jobs.location_region', 14);
	 		}
	 		elseif($searchdata['location'] == 16){
	 			$this->db->where('jobs.location_region', 15);
	 		}
	 		elseif($searchdata['location'] == 17){
	 			$this->db->where('jobs.location_region', 16);
	 		}
	 		elseif($searchdata['location'] == 18){
	 			$this->db->where('jobs.location_region', 17);
	 		}
	 		elseif($searchdata['location'] == 19){
	 			$this->db->where('jobs.location_region', 18);
	 		}
	 		elseif($searchdata['location'] == 20){
	 			$this->db->where('jobs.location_region', 19);
	 		}
	 		elseif($searchdata['location'] == 21){
	 			$this->db->where('jobs.location_region', 20);
	 		}
	 		elseif($searchdata['location'] == 22){
	 			$this->db->where('jobs.location_region', 21);
	 		}
	 		elseif($searchdata['location'] == 23){
	 			$this->db->where('jobs.location_region', 22);
	 		}
	 		elseif($searchdata['location'] == 24){
	 			$this->db->where('jobs.location_region', 23);
	 		}
	 		elseif($searchdata['location'] == 25){
	 			$this->db->where('jobs.location_region', 24);
	 		}
	 		elseif($searchdata['location'] == 26){
	 			$this->db->where('jobs.location_region', 25);
	 		}
	 		elseif($searchdata['location'] == 27){
	 			$this->db->where('jobs.location_region', 26);
	 		}
	 		elseif($searchdata['location'] == 28){
	 			$this->db->where('jobs.location_region', 27);
	 		}
	 		elseif($searchdata['location'] == 29){
	 			$this->db->where('jobs.location_region', 28);
	 		}
	 		elseif($searchdata['location'] == 30){
	 			$this->db->where('jobs.location_region', 29);
	 		}
	 		elseif($searchdata['location'] == 31){
	 			$this->db->where('jobs.location_region', 30);
	 		}
	 		elseif($searchdata['location'] == 32){
	 			$this->db->where('jobs.location_region', 31);
	 		}
	 		else{
	 			$this->db->where('jobs.location_city', $searchdata['location']);
	 		}	 		
	 	}
	 	if($searchdata['location_region']!=''){
	 		$this->db->where('jobs.location_region', $searchdata['location_region']);
	 	}
	 	if($searchdata['budget_range']!=''){
	 		$budgetRange = $this->getBudgetRange($searchdata['budget_range']);
	 		//var_dump($budgetRange);exit();
	 		$this->db->where('job_details.salary_min >= ', $budgetRange['minBudget']);
	 		$this->db->where('job_details.salary_min <= ', $budgetRange['maxBudget']); 
	 	}
	 	$this->db->where('job_employment_type.emp_type', 3);
	 	//$this->db->order_by('created_on','desc');
	 	$this->db->limit('5');
	 	$this->db->offset('0');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){				
				 $row['location_region'] = $this->getLocationRegion($row['location_region']);
				 $row['salary_type'] = $this->getSalaryType($row['salary_type']);
				 $row['specialization'] = $this->getSpecializationType($row['specialization']);
				 $row['date_posted'] = mdate('%M %d, %Y',strtotime($row['date_posted']));
				 $row['date_expiry'] = mdate('%M %d, %Y',strtotime($row['date_expiry']));
				 $row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function searchAgencyJobs()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function searchAgencyJobs() 
	{
		$searchdata = $this->session->userdata('searchagencyjobs');
		//$query = $this->db->query("SELECT * FROM freelance_job WHERE is_approved = 1 ORDER BY created_on ASC LIMIT 0,5");		

	 	$query = $this->db->select('jobs.jobId,jobs.emp_id,jobs.job_title,jobs.active,
	 								jobs.location_region,
	 								jobs.location_city,
	 								jobs.company_name,
									jobs.created_on,
									jobs.active,
									job_details.job_desc,
									job_details.vacancy_num,
								    job_details.specialization,
								    job_details.position_level,
								    job_details.yr_exp,
								    job_details.salary_min,
								    job_details.salary_max,
								    job_details.salary_base,
								    job_details.currency,
								    job_details.show_salary,
								    job_details.salary_type,
								    job_details.date_posted,
								    job_details.date_expiry,
									job_details.sked_type,
									')
	 						->from('job_employment_type')
	 						->join('jobs','jobs.jobId = job_employment_type.job_id','left')
						    ->join('job_details','job_details.job_id = jobs.jobId','left');
				
				
				$this->db->where('jobs.active', '1');
				$this->db->where('jobs.is_removed', 0);

	 	if($searchdata['search']!=''){
	 		$this->db->like('jobs.job_title', $searchdata['search']);	
	 		//$this->db->or_like('jobs.company_name', $searchdata['search']);
	 	}
	 	if($searchdata['location']!=''){	 		
	 		if($searchdata['location'] == 1){
	 			$this->db->like('jobs.location_city', 'caloocan');
	 			$this->db->or_like('jobs.location_city', 'pasay');	
	 			$this->db->or_like('jobs.location_city', 'las pinas');
	 			$this->db->or_like('jobs.location_city', 'makati');
	 			$this->db->or_like('jobs.location_city', 'malabon');
	 			$this->db->or_like('jobs.location_city', 'mandaluyong');
	 			$this->db->or_like('jobs.location_city', 'manila');
	 			$this->db->or_like('jobs.location_city', 'marikina');
	 			$this->db->or_like('jobs.location_city', 'muntinlupa');
	 			$this->db->or_like('jobs.location_city', 'navotas');
	 			$this->db->or_like('jobs.location_city', 'paranaque');
	 			$this->db->or_like('jobs.location_city', 'pasay');
	 			$this->db->or_like('jobs.location_city', 'pasig');
	 			$this->db->or_like('jobs.location_city', 'pateros');
	 			$this->db->or_like('jobs.location_city', 'quezon city');
	 			$this->db->or_like('jobs.location_city', 'san juan');
	 			$this->db->or_like('jobs.location_city', 'taguig');
	 			$this->db->or_like('jobs.location_city', 'valenzuela');
	 		}
	 		elseif($searchdata['location'] == 2){
	 			$this->db->where('jobs.location_region', 11);
	 		}
	 		elseif($searchdata['location'] == 3){
	 			$this->db->where('jobs.location_region', 1);
	 		}
	 		elseif($searchdata['location'] == 4){
	 			$this->db->where('jobs.location_region', 2);
	 		}
	 		elseif($searchdata['location'] == 5){
	 			$this->db->where('jobs.location_region', 3);
	 		}
	 		elseif($searchdata['location'] == 6){
	 			$this->db->where('jobs.location_region', 4);
	 		}
	 		elseif($searchdata['location'] == 7){
	 			$this->db->where('jobs.location_region', 6);
	 		}
	 		elseif($searchdata['location'] == 8){
	 			$this->db->where('jobs.location_region', 7);
	 		}
	 		elseif($searchdata['location'] == 9){
	 			$this->db->where('jobs.location_region', 32);
	 		}
	 		elseif($searchdata['location'] == 10){
	 			$this->db->where('jobs.location_region', 8);
	 		}
	 		elseif($searchdata['location'] == 11){
	 			$this->db->where('jobs.location_region', 9);
	 		}
	 		elseif($searchdata['location'] == 12){
	 			$this->db->where('jobs.location_region', 10);
	 		}
	 		elseif($searchdata['location'] == 13){
	 			$this->db->where('jobs.location_region', 12);
	 		}
	 		elseif($searchdata['location'] == 14){
	 			$this->db->where('jobs.location_region', 13);
	 		}
	 		elseif($searchdata['location'] == 15){
	 			$this->db->where('jobs.location_region', 14);
	 		}
	 		elseif($searchdata['location'] == 16){
	 			$this->db->where('jobs.location_region', 15);
	 		}
	 		elseif($searchdata['location'] == 17){
	 			$this->db->where('jobs.location_region', 16);
	 		}
	 		elseif($searchdata['location'] == 18){
	 			$this->db->where('jobs.location_region', 17);
	 		}
	 		elseif($searchdata['location'] == 19){
	 			$this->db->where('jobs.location_region', 18);
	 		}
	 		elseif($searchdata['location'] == 20){
	 			$this->db->where('jobs.location_region', 19);
	 		}
	 		elseif($searchdata['location'] == 21){
	 			$this->db->where('jobs.location_region', 20);
	 		}
	 		elseif($searchdata['location'] == 22){
	 			$this->db->where('jobs.location_region', 21);
	 		}
	 		elseif($searchdata['location'] == 23){
	 			$this->db->where('jobs.location_region', 22);
	 		}
	 		elseif($searchdata['location'] == 24){
	 			$this->db->where('jobs.location_region', 23);
	 		}
	 		elseif($searchdata['location'] == 25){
	 			$this->db->where('jobs.location_region', 24);
	 		}
	 		elseif($searchdata['location'] == 26){
	 			$this->db->where('jobs.location_region', 25);
	 		}
	 		elseif($searchdata['location'] == 27){
	 			$this->db->where('jobs.location_region', 26);
	 		}
	 		elseif($searchdata['location'] == 28){
	 			$this->db->where('jobs.location_region', 27);
	 		}
	 		elseif($searchdata['location'] == 29){
	 			$this->db->where('jobs.location_region', 28);
	 		}
	 		elseif($searchdata['location'] == 30){
	 			$this->db->where('jobs.location_region', 29);
	 		}
	 		elseif($searchdata['location'] == 31){
	 			$this->db->where('jobs.location_region', 30);
	 		}
	 		elseif($searchdata['location'] == 32){
	 			$this->db->where('jobs.location_region', 31);
	 		}
	 		else{
	 			$this->db->where('jobs.location_city', $searchdata['location']);
	 		}	 		
	 	}
	 	if($searchdata['location_region']!=''){
	 		$this->db->where('jobs.location_region', $searchdata['location_region']);
	 	}
	 	if($searchdata['budget_range']!=''){
	 		$budgetRange = $this->getBudgetRange($searchdata['budget_range']);
	 		//var_dump($budgetRange);exit();
	 		$this->db->where('job_details.salary_min >= ', $budgetRange['minBudget']);
	 		$this->db->where('job_details.salary_min <= ', $budgetRange['maxBudget']); 
	 	}
	 	$this->db->where('job_employment_type.emp_type', 4);
	 	//$this->db->order_by('created_on','desc');
	 	$this->db->limit('5');
	 	$this->db->offset('0');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){				
				 $row['location_region'] = $this->getLocationRegion($row['location_region']);
				 $row['salary_type'] = $this->getSalaryType($row['salary_type']);
				 $row['specialization'] = $this->getSpecializationType($row['specialization']);
				 $row['date_posted'] = mdate('%M %d, %Y',strtotime($row['date_posted']));
				 $row['date_expiry'] = mdate('%M %d, %Y',strtotime($row['date_expiry']));
				 $row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	function getBudgetRange($budgetType){
  		switch ($budgetType) {
  			case 1:
  				$budget = array('minBudget' => 1,
  										   'maxBudget' => 10000 );
  				return $budget;
  				break;
  			case 2:
  				$budget = array('minBudget' => 10000,
  										   'maxBudget' => 50000 );
  				return $budget;
  				break;
  			case 3:
  				$budget = array('minBudget' => 50000,
  										   'maxBudget' => 100000 );
  				return $budget;
  				break;
  			case 4:
  				$budget = array('minBudget' => 100000,
  										   'maxBudget' => 150000 );
  				return $budget;
  				break;
  			case 5:
  				$budget = array('minBudget' => 150000,
  										   'maxBudget' => 200000 );
  				return $budget;
  				break;
  			case 6:
  				$budget = array('minBudget' => 200000,
  										   'maxBudget' => 300000 );
  				return $budget;
  				break;
  			case 7:
  				$budget = array('minBudget' => 300000,
  										   'maxBudget' => 400000 );
  				return $budget;
  				break;
  			case 8:
  				$budget = array('minBudget' => 400000,
  										   'maxBudget' => 500000 );
  				return $budget;
  				break;
  			case 9:
  				$budget = array('minBudget' => 500000,
  										   'maxBudget' => 10000000 );
  				return $budget;
  				break;
  			
  			default:
  				# code...
  				break;
  		}
  	}

  	/** 
       * function getFreelanceJobs()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getFreelanceJobsAjax($load) 
	{
		$searchdata = $this->session->userdata('searchfreelancejobs');
		//$query = $this->db->query("SELECT * FROM freelance_job WHERE is_approved = 1 ORDER BY created_on ASC LIMIT 0,5");		
		$this->db->select('*')->from('freelance_job');
	 	$this->db->where('is_approved', 1);
	 	if($searchdata['search']!=''){
	 		$this->db->like('project_name', $searchdata['search']);	
	 	}
	 	if($searchdata['project_type']!=''){
	 		$this->db->where('project_type', $searchdata['project_type']);
	 	}
	 	if($searchdata['budget_range']!=''){
	 		$budgetRange = $this->getBudgetRange($searchdata['budget_range']);
	 		//var_dump($budgetRange);exit();
	 		$this->db->where('min_budget >= ', $budgetRange['minBudget']);
	 		$this->db->where('min_budget <= ', $budgetRange['maxBudget']); 
	 	}
	 	$this->db->order_by('created_on','desc');
	 	$this->db->limit('5');
	 	$this->db->offset($load);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$row['payment_currency'] = $this->getCurrency($row['payment_currency']);
				$row['project_duration'] = $this->getProjectDuration($row['project_duration']);
				$row['project_duration_per'] = $this->getProjectDurationPer($row['project_duration_per']);
				$row['project_type'] = $this->getProjectType($row['project_type']);
				$row['payment_type'] = $this->getPaymentType($row['payment_type']);
				$row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function getFulltimeJobsAjax()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getFulltimeJobsAjax($load) 
	{
		$searchdata = $this->session->userdata('searchfulltimejobs');
		$query = $this->db->select('jobs.jobId,jobs.emp_id,jobs.job_title,jobs.active,
	 								jobs.location_region,
	 								jobs.location_city,
	 								jobs.company_name,
									jobs.created_on,
									job_details.job_desc,
									job_details.vacancy_num,
								    job_details.specialization,
								    job_details.position_level,
								    job_details.yr_exp,
								    job_details.salary_min,
								    job_details.salary_max,
								    job_details.salary_base,
								    job_details.currency,
								    job_details.show_salary,
								    job_details.salary_type,
								    job_details.date_posted,
								    job_details.date_expiry,
									job_details.sked_type,
									')
	 						->from('jobs')
						    ->join('job_details','job_details.job_id = jobs.jobId','left');
				$this->db->where('jobs.active', 1);
				$this->db->where('jobs.is_removed', 0);
	 	if($searchdata['search']!=''){
	 		$this->db->like('jobs.job_title', $searchdata['search']);	
	 		$this->db->or_like('jobs.company_name', $searchdata['search']);
	 	}
	 	if($searchdata['location']!=''){
	 		
	 		if($searchdata['location'] == 1){
	 			$this->db->like('jobs.location_city', 'caloocan');
	 			$this->db->or_like('jobs.location_city', 'pasay');	
	 			$this->db->or_like('jobs.location_city', 'las pinas');
	 			$this->db->or_like('jobs.location_city', 'makati');
	 			$this->db->or_like('jobs.location_city', 'malabon');
	 			$this->db->or_like('jobs.location_city', 'mandaluyong');
	 			$this->db->or_like('jobs.location_city', 'manila');
	 			$this->db->or_like('jobs.location_city', 'marikina');
	 			$this->db->or_like('jobs.location_city', 'muntinlupa');
	 			$this->db->or_like('jobs.location_city', 'navotas');
	 			$this->db->or_like('jobs.location_city', 'paranaque');
	 			$this->db->or_like('jobs.location_city', 'pasay');
	 			$this->db->or_like('jobs.location_city', 'pasig');
	 			$this->db->or_like('jobs.location_city', 'pateros');
	 			$this->db->or_like('jobs.location_city', 'quezon city');
	 			$this->db->or_like('jobs.location_city', 'san juan');
	 			$this->db->or_like('jobs.location_city', 'taguig');
	 			$this->db->or_like('jobs.location_city', 'valenzuela');
	 		}
	 		elseif($searchdata['location'] == 2){
	 			$this->db->where('jobs.location_region', 11);
	 		}
	 		elseif($searchdata['location'] == 3){
	 			$this->db->where('jobs.location_region', 1);
	 		}
	 		elseif($searchdata['location'] == 4){
	 			$this->db->where('jobs.location_region', 2);
	 		}
	 		elseif($searchdata['location'] == 5){
	 			$this->db->where('jobs.location_region', 3);
	 		}
	 		elseif($searchdata['location'] == 6){
	 			$this->db->where('jobs.location_region', 4);
	 		}
	 		elseif($searchdata['location'] == 7){
	 			$this->db->where('jobs.location_region', 6);
	 		}
	 		elseif($searchdata['location'] == 8){
	 			$this->db->where('jobs.location_region', 7);
	 		}
	 		elseif($searchdata['location'] == 9){
	 			$this->db->where('jobs.location_region', 32);
	 		}
	 		elseif($searchdata['location'] == 10){
	 			$this->db->where('jobs.location_region', 8);
	 		}
	 		elseif($searchdata['location'] == 11){
	 			$this->db->where('jobs.location_region', 9);
	 		}
	 		elseif($searchdata['location'] == 12){
	 			$this->db->where('jobs.location_region', 10);
	 		}
	 		elseif($searchdata['location'] == 13){
	 			$this->db->where('jobs.location_region', 12);
	 		}
	 		elseif($searchdata['location'] == 14){
	 			$this->db->where('jobs.location_region', 13);
	 		}
	 		elseif($searchdata['location'] == 15){
	 			$this->db->where('jobs.location_region', 14);
	 		}
	 		elseif($searchdata['location'] == 16){
	 			$this->db->where('jobs.location_region', 15);
	 		}
	 		elseif($searchdata['location'] == 17){
	 			$this->db->where('jobs.location_region', 16);
	 		}
	 		elseif($searchdata['location'] == 18){
	 			$this->db->where('jobs.location_region', 17);
	 		}
	 		elseif($searchdata['location'] == 19){
	 			$this->db->where('jobs.location_region', 18);
	 		}
	 		elseif($searchdata['location'] == 20){
	 			$this->db->where('jobs.location_region', 19);
	 		}
	 		elseif($searchdata['location'] == 21){
	 			$this->db->where('jobs.location_region', 20);
	 		}
	 		elseif($searchdata['location'] == 22){
	 			$this->db->where('jobs.location_region', 21);
	 		}
	 		elseif($searchdata['location'] == 23){
	 			$this->db->where('jobs.location_region', 22);
	 		}
	 		elseif($searchdata['location'] == 24){
	 			$this->db->where('jobs.location_region', 23);
	 		}
	 		elseif($searchdata['location'] == 25){
	 			$this->db->where('jobs.location_region', 24);
	 		}
	 		elseif($searchdata['location'] == 26){
	 			$this->db->where('jobs.location_region', 25);
	 		}
	 		elseif($searchdata['location'] == 27){
	 			$this->db->where('jobs.location_region', 26);
	 		}
	 		elseif($searchdata['location'] == 28){
	 			$this->db->where('jobs.location_region', 27);
	 		}
	 		elseif($searchdata['location'] == 29){
	 			$this->db->where('jobs.location_region', 28);
	 		}
	 		elseif($searchdata['location'] == 30){
	 			$this->db->where('jobs.location_region', 29);
	 		}
	 		elseif($searchdata['location'] == 31){
	 			$this->db->where('jobs.location_region', 30);
	 		}
	 		elseif($searchdata['location'] == 32){
	 			$this->db->where('jobs.location_region', 31);
	 		}
	 		else{
	 			$this->db->where('jobs.location_city', $searchdata['location']);
	 		}	 		
	 	}
	 	if($searchdata['location_region']!=''){
	 		$this->db->where('jobs.location_region', $searchdata['location_region']);
	 	}
	 	if($searchdata['budget_range']!=''){
	 		$budgetRange = $this->getBudgetRange($searchdata['budget_range']);
	 		//var_dump($budgetRange);exit();
	 		$this->db->where('job_details.salary_min >= ', $budgetRange['minBudget']);
	 		$this->db->where('job_details.salary_min <= ', $budgetRange['maxBudget']); 
	 	}
	 	$this->db->order_by('created_on','desc');
	 	$this->db->limit('5');
	 	$this->db->offset($load);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['location_region'] = $this->getLocationRegion($row['location_region']);
				 $row['salary_type'] = $this->getSalaryType($row['salary_type']);
				 $row['specialization'] = $this->getSpecializationType($row['specialization']);
				 $row['date_posted'] = mdate('%M %d, %Y',strtotime($row['date_posted']));
				 $row['date_expiry'] = mdate('%M %d, %Y',strtotime($row['date_expiry']));
				 $row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function getParttimeJobsAjax()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getParttimeJobsAjax($load) 
	{
		$searchdata = $this->session->userdata('searchparttimejobs');
		//$query = $this->db->query("SELECT * FROM freelance_job WHERE is_approved = 1 ORDER BY created_on ASC LIMIT 0,5");		

	 	$query = $this->db->select('jobs.jobId,jobs.emp_id,jobs.job_title,jobs.active,
	 								jobs.location_region,
	 								jobs.location_city,
	 								jobs.company_name,
									jobs.created_on,
									jobs.active,
									job_details.job_desc,
									job_details.vacancy_num,
								    job_details.specialization,
								    job_details.position_level,
								    job_details.yr_exp,
								    job_details.salary_min,
								    job_details.salary_max,
								    job_details.salary_base,
								    job_details.currency,
								    job_details.show_salary,
								    job_details.salary_type,
								    job_details.date_posted,
								    job_details.date_expiry,
									job_details.sked_type,
									')
	 						->from('job_employment_type')
	 						->join('jobs','jobs.jobId = job_employment_type.job_id','left')
						    ->join('job_details','job_details.job_id = jobs.jobId','left');
				
				
				$this->db->where('jobs.active', '1');
				$this->db->where('jobs.is_removed', 0);

	 	if($searchdata['search']!=''){
	 		$this->db->like('jobs.job_title', $searchdata['search']);	
	 		//$this->db->or_like('jobs.company_name', $searchdata['search']);
	 	}
	 	if($searchdata['location']!=''){	 		
	 		if($searchdata['location'] == 1){
	 			$this->db->like('jobs.location_city', 'caloocan');
	 			$this->db->or_like('jobs.location_city', 'pasay');	
	 			$this->db->or_like('jobs.location_city', 'las pinas');
	 			$this->db->or_like('jobs.location_city', 'makati');
	 			$this->db->or_like('jobs.location_city', 'malabon');
	 			$this->db->or_like('jobs.location_city', 'mandaluyong');
	 			$this->db->or_like('jobs.location_city', 'manila');
	 			$this->db->or_like('jobs.location_city', 'marikina');
	 			$this->db->or_like('jobs.location_city', 'muntinlupa');
	 			$this->db->or_like('jobs.location_city', 'navotas');
	 			$this->db->or_like('jobs.location_city', 'paranaque');
	 			$this->db->or_like('jobs.location_city', 'pasay');
	 			$this->db->or_like('jobs.location_city', 'pasig');
	 			$this->db->or_like('jobs.location_city', 'pateros');
	 			$this->db->or_like('jobs.location_city', 'quezon city');
	 			$this->db->or_like('jobs.location_city', 'san juan');
	 			$this->db->or_like('jobs.location_city', 'taguig');
	 			$this->db->or_like('jobs.location_city', 'valenzuela');
	 		}
	 		elseif($searchdata['location'] == 2){
	 			$this->db->where('jobs.location_region', 11);
	 		}
	 		elseif($searchdata['location'] == 3){
	 			$this->db->where('jobs.location_region', 1);
	 		}
	 		elseif($searchdata['location'] == 4){
	 			$this->db->where('jobs.location_region', 2);
	 		}
	 		elseif($searchdata['location'] == 5){
	 			$this->db->where('jobs.location_region', 3);
	 		}
	 		elseif($searchdata['location'] == 6){
	 			$this->db->where('jobs.location_region', 4);
	 		}
	 		elseif($searchdata['location'] == 7){
	 			$this->db->where('jobs.location_region', 6);
	 		}
	 		elseif($searchdata['location'] == 8){
	 			$this->db->where('jobs.location_region', 7);
	 		}
	 		elseif($searchdata['location'] == 9){
	 			$this->db->where('jobs.location_region', 32);
	 		}
	 		elseif($searchdata['location'] == 10){
	 			$this->db->where('jobs.location_region', 8);
	 		}
	 		elseif($searchdata['location'] == 11){
	 			$this->db->where('jobs.location_region', 9);
	 		}
	 		elseif($searchdata['location'] == 12){
	 			$this->db->where('jobs.location_region', 10);
	 		}
	 		elseif($searchdata['location'] == 13){
	 			$this->db->where('jobs.location_region', 12);
	 		}
	 		elseif($searchdata['location'] == 14){
	 			$this->db->where('jobs.location_region', 13);
	 		}
	 		elseif($searchdata['location'] == 15){
	 			$this->db->where('jobs.location_region', 14);
	 		}
	 		elseif($searchdata['location'] == 16){
	 			$this->db->where('jobs.location_region', 15);
	 		}
	 		elseif($searchdata['location'] == 17){
	 			$this->db->where('jobs.location_region', 16);
	 		}
	 		elseif($searchdata['location'] == 18){
	 			$this->db->where('jobs.location_region', 17);
	 		}
	 		elseif($searchdata['location'] == 19){
	 			$this->db->where('jobs.location_region', 18);
	 		}
	 		elseif($searchdata['location'] == 20){
	 			$this->db->where('jobs.location_region', 19);
	 		}
	 		elseif($searchdata['location'] == 21){
	 			$this->db->where('jobs.location_region', 20);
	 		}
	 		elseif($searchdata['location'] == 22){
	 			$this->db->where('jobs.location_region', 21);
	 		}
	 		elseif($searchdata['location'] == 23){
	 			$this->db->where('jobs.location_region', 22);
	 		}
	 		elseif($searchdata['location'] == 24){
	 			$this->db->where('jobs.location_region', 23);
	 		}
	 		elseif($searchdata['location'] == 25){
	 			$this->db->where('jobs.location_region', 24);
	 		}
	 		elseif($searchdata['location'] == 26){
	 			$this->db->where('jobs.location_region', 25);
	 		}
	 		elseif($searchdata['location'] == 27){
	 			$this->db->where('jobs.location_region', 26);
	 		}
	 		elseif($searchdata['location'] == 28){
	 			$this->db->where('jobs.location_region', 27);
	 		}
	 		elseif($searchdata['location'] == 29){
	 			$this->db->where('jobs.location_region', 28);
	 		}
	 		elseif($searchdata['location'] == 30){
	 			$this->db->where('jobs.location_region', 29);
	 		}
	 		elseif($searchdata['location'] == 31){
	 			$this->db->where('jobs.location_region', 30);
	 		}
	 		elseif($searchdata['location'] == 32){
	 			$this->db->where('jobs.location_region', 31);
	 		}
	 		else{
	 			$this->db->where('jobs.location_city', $searchdata['location']);
	 		}	 		
	 	}
	 	if($searchdata['location_region']!=''){
	 		$this->db->where('jobs.location_region', $searchdata['location_region']);
	 	}
	 	if($searchdata['budget_range']!=''){
	 		$budgetRange = $this->getBudgetRange($searchdata['budget_range']);
	 		//var_dump($budgetRange);exit();
	 		$this->db->where('job_details.salary_min >= ', $budgetRange['minBudget']);
	 		$this->db->where('job_details.salary_min <= ', $budgetRange['maxBudget']); 
	 	}
	 	$this->db->where('job_employment_type.emp_type', 3);
	 	//$this->db->order_by('created_on','desc');
	 	$this->db->limit('5');
	 	$this->db->offset($load);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				// $row['skills_req'] = $this->getSkillsRequirement($row['fljobId']);
				// $row['payment_currency'] = $this->getCurrency($row['payment_currency']);
				// $row['project_duration'] = $this->getProjectDuration($row['project_duration']);
				// $row['project_duration_per'] = $this->getProjectDurationPer($row['project_duration_per']);
				// $row['project_type'] = $this->getProjectType($row['project_type']);
				 $row['location_region'] = $this->getLocationRegion($row['location_region']);
				 $row['salary_type'] = $this->getSalaryType($row['salary_type']);
				 $row['specialization'] = $this->getSpecializationType($row['specialization']);
				 $row['date_posted'] = mdate('%M %d, %Y',strtotime($row['date_posted']));
				 $row['date_expiry'] = mdate('%M %d, %Y',strtotime($row['date_expiry']));
				 $row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function getAgencyJobsAjax()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getAgencyJobsAjax($load) 
	{
		$searchdata = $this->session->userdata('searchagencyjobs');
		//$query = $this->db->query("SELECT * FROM freelance_job WHERE is_approved = 1 ORDER BY created_on ASC LIMIT 0,5");		

	 	$query = $this->db->select('jobs.jobId,jobs.emp_id,jobs.job_title,jobs.active,
	 								jobs.location_region,
	 								jobs.location_city,
	 								jobs.company_name,
									jobs.created_on,
									jobs.active,
									job_details.job_desc,
									job_details.vacancy_num,
								    job_details.specialization,
								    job_details.position_level,
								    job_details.yr_exp,
								    job_details.salary_min,
								    job_details.salary_max,
								    job_details.salary_base,
								    job_details.currency,
								    job_details.show_salary,
								    job_details.salary_type,
								    job_details.date_posted,
								    job_details.date_expiry,
									job_details.sked_type,
									')
	 						->from('job_employment_type')
	 						->join('jobs','jobs.jobId = job_employment_type.job_id','left')
						    ->join('job_details','job_details.job_id = jobs.jobId','left');
				
				
				$this->db->where('jobs.active', '1');
				$this->db->where('jobs.is_removed', 0);

	 	if($searchdata['search']!=''){
	 		$this->db->like('jobs.job_title', $searchdata['search']);	
	 		//$this->db->or_like('jobs.company_name', $searchdata['search']);
	 	}
	 	if($searchdata['location']!=''){	 		
	 		if($searchdata['location'] == 1){
	 			$this->db->like('jobs.location_city', 'caloocan');
	 			$this->db->or_like('jobs.location_city', 'pasay');	
	 			$this->db->or_like('jobs.location_city', 'las pinas');
	 			$this->db->or_like('jobs.location_city', 'makati');
	 			$this->db->or_like('jobs.location_city', 'malabon');
	 			$this->db->or_like('jobs.location_city', 'mandaluyong');
	 			$this->db->or_like('jobs.location_city', 'manila');
	 			$this->db->or_like('jobs.location_city', 'marikina');
	 			$this->db->or_like('jobs.location_city', 'muntinlupa');
	 			$this->db->or_like('jobs.location_city', 'navotas');
	 			$this->db->or_like('jobs.location_city', 'paranaque');
	 			$this->db->or_like('jobs.location_city', 'pasay');
	 			$this->db->or_like('jobs.location_city', 'pasig');
	 			$this->db->or_like('jobs.location_city', 'pateros');
	 			$this->db->or_like('jobs.location_city', 'quezon city');
	 			$this->db->or_like('jobs.location_city', 'san juan');
	 			$this->db->or_like('jobs.location_city', 'taguig');
	 			$this->db->or_like('jobs.location_city', 'valenzuela');
	 		}
	 		elseif($searchdata['location'] == 2){
	 			$this->db->where('jobs.location_region', 11);
	 		}
	 		elseif($searchdata['location'] == 3){
	 			$this->db->where('jobs.location_region', 1);
	 		}
	 		elseif($searchdata['location'] == 4){
	 			$this->db->where('jobs.location_region', 2);
	 		}
	 		elseif($searchdata['location'] == 5){
	 			$this->db->where('jobs.location_region', 3);
	 		}
	 		elseif($searchdata['location'] == 6){
	 			$this->db->where('jobs.location_region', 4);
	 		}
	 		elseif($searchdata['location'] == 7){
	 			$this->db->where('jobs.location_region', 6);
	 		}
	 		elseif($searchdata['location'] == 8){
	 			$this->db->where('jobs.location_region', 7);
	 		}
	 		elseif($searchdata['location'] == 9){
	 			$this->db->where('jobs.location_region', 32);
	 		}
	 		elseif($searchdata['location'] == 10){
	 			$this->db->where('jobs.location_region', 8);
	 		}
	 		elseif($searchdata['location'] == 11){
	 			$this->db->where('jobs.location_region', 9);
	 		}
	 		elseif($searchdata['location'] == 12){
	 			$this->db->where('jobs.location_region', 10);
	 		}
	 		elseif($searchdata['location'] == 13){
	 			$this->db->where('jobs.location_region', 12);
	 		}
	 		elseif($searchdata['location'] == 14){
	 			$this->db->where('jobs.location_region', 13);
	 		}
	 		elseif($searchdata['location'] == 15){
	 			$this->db->where('jobs.location_region', 14);
	 		}
	 		elseif($searchdata['location'] == 16){
	 			$this->db->where('jobs.location_region', 15);
	 		}
	 		elseif($searchdata['location'] == 17){
	 			$this->db->where('jobs.location_region', 16);
	 		}
	 		elseif($searchdata['location'] == 18){
	 			$this->db->where('jobs.location_region', 17);
	 		}
	 		elseif($searchdata['location'] == 19){
	 			$this->db->where('jobs.location_region', 18);
	 		}
	 		elseif($searchdata['location'] == 20){
	 			$this->db->where('jobs.location_region', 19);
	 		}
	 		elseif($searchdata['location'] == 21){
	 			$this->db->where('jobs.location_region', 20);
	 		}
	 		elseif($searchdata['location'] == 22){
	 			$this->db->where('jobs.location_region', 21);
	 		}
	 		elseif($searchdata['location'] == 23){
	 			$this->db->where('jobs.location_region', 22);
	 		}
	 		elseif($searchdata['location'] == 24){
	 			$this->db->where('jobs.location_region', 23);
	 		}
	 		elseif($searchdata['location'] == 25){
	 			$this->db->where('jobs.location_region', 24);
	 		}
	 		elseif($searchdata['location'] == 26){
	 			$this->db->where('jobs.location_region', 25);
	 		}
	 		elseif($searchdata['location'] == 27){
	 			$this->db->where('jobs.location_region', 26);
	 		}
	 		elseif($searchdata['location'] == 28){
	 			$this->db->where('jobs.location_region', 27);
	 		}
	 		elseif($searchdata['location'] == 29){
	 			$this->db->where('jobs.location_region', 28);
	 		}
	 		elseif($searchdata['location'] == 30){
	 			$this->db->where('jobs.location_region', 29);
	 		}
	 		elseif($searchdata['location'] == 31){
	 			$this->db->where('jobs.location_region', 30);
	 		}
	 		elseif($searchdata['location'] == 32){
	 			$this->db->where('jobs.location_region', 31);
	 		}
	 		else{
	 			$this->db->where('jobs.location_city', $searchdata['location']);
	 		}	 		
	 	}
	 	if($searchdata['location_region']!=''){
	 		$this->db->where('jobs.location_region', $searchdata['location_region']);
	 	}
	 	if($searchdata['budget_range']!=''){
	 		$budgetRange = $this->getBudgetRange($searchdata['budget_range']);
	 		//var_dump($budgetRange);exit();
	 		$this->db->where('job_details.salary_min >= ', $budgetRange['minBudget']);
	 		$this->db->where('job_details.salary_min <= ', $budgetRange['maxBudget']); 
	 	}
	 	$this->db->where('job_employment_type.emp_type', 4);
	 	//$this->db->order_by('created_on','desc');
	 	$this->db->limit('5');
	 	$this->db->offset($load);
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				 $row['location_region'] = $this->getLocationRegion($row['location_region']);
				 $row['salary_type'] = $this->getSalaryType($row['salary_type']);
				 $row['specialization'] = $this->getSpecializationType($row['specialization']);
				 $row['date_posted'] = mdate('%M %d, %Y',strtotime($row['date_posted']));
				 $row['date_expiry'] = mdate('%M %d, %Y',strtotime($row['date_expiry']));
				 $row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
  	}

  	/** 
       * function getFreelanceJobs()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getTotalJobsCnt($type,$status=0) 
	{
		if($type == 1){//jobs
			$query = $this->db->select('job_title')->from('jobs');
			$this->db->where('jobs.active',$status);		
		}elseif($type == 2){//freelance
			$query = $this->db->select('project_name')->from('freelance_job');
			$this->db->where('freelance_job.is_approved',$status);			
		}elseif($type == 3){//part time
			$query = $this->db->select('job_id')->from('job_employment_type');
			$this->db->join('jobs','jobs.jobId = job_employment_type.job_id','left');
			$this->db->where('job_employment_type.emp_type',$status);			
			$this->db->where('jobs.active',1);
		}elseif($type == 4){//agancy jobs
			$query = $this->db->select('job_id')->from('job_employment_type');
			$this->db->join('jobs','jobs.jobId = job_employment_type.job_id','left');
			$this->db->where('job_employment_type.emp_type',$status);			
			$this->db->where('jobs.active',1);						
		}
		$query = $this->db->get();		
	    return $query->result_array();
	}

	/** 
       * function getFreelanceJobs()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getApplicantCnt($itemId,$status,$type) 
	{
		if($type == 1){//jobs
			$query = $this->db->select('applicantId')->from('job_applicant');
			$this->db->where('job_applicant.jobId',$itemId);	
			if($status < 3){
				$this->db->where('job_applicant.candidate_status',$status);
			}else{
				$this->db->where('job_applicant.candidate_status >',2);
			}
		}elseif($type == 2){
			$query = $this->db->select('applicantId')->from('freelancejob_applicant');
			$this->db->where('freelancejob_applicant.flJobId',$itemId);	
			if($status < 3){
				$this->db->where('freelancejob_applicant.candidate_status',$status);
			}else{
				$this->db->where('freelancejob_applicant.candidate_status > ',2);
			}
			
		}
		$query = $this->db->get();		
	    return $query->result_array();
	}

  	function getSkillsRequirement($flJobId){
  		$query = $this->db->query("SELECT skills FROM freelance_skill_req WHERE flJobId = '" . $flJobId . "'");
		return $query->result_array();
  	}

  	/** 
       * function getFreelanceJob()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function getJobPost($jobId) 
	{		
    	$query = $this->db->select('job_title,joborderid,created_on')->from('jobs')->where('jobId', $jobId);
	    $query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$data['jobDetails'] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	    //return $query->row_array();
  	}

  	/** 
       * function isFreelanceJobAvailedPromo()
       *
       * get table info
	   * @param $emp_id - int
       * @return array
       */
	function isFreelanceJobAvailedPromo($fljobId) 
	{		
    	$this->db->select('fljobId')->where('fljobId', $fljobId);
		$query = $this->db->get('avail_flpromo');
	
		if ($query->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
  	}

  	
  	/** 
       * function isFreelanceJobExists()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function isFreelanceJobExists($fljobId) 
	{
		$this->db->select('job_id')->where('job_id', $fljobId);
		$query = $this->db->get('avail_flpromo');
	
		if ($query->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	/** 
       * function isFreelanceJobExists()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function isJobExistsPromo($jobId) 
	{
		$this->db->select('job_id')->where('job_id', $jobId);
		$query = $this->db->get('avail_jobpromo');
	
		if ($query->num_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

  	/** 
       * function getSpokenLang()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getCurrency($type) 
	{
		switch ($type) {
			case 1:
				return 'USD';
				break;
			case 2:
				return 'NZD';
				break;
			case 3:
				return 'AUD';
				break;
			case 4:
				return 'GBP';
				break;
			case 5:
				return 'HKD';
				break;
			case 6:
				return 'SGD';
				break;
			case 7:
				return 'PHP';
				break;
			case 8:
				return 'EUR';
				break;
			case 9:
				return 'CAD';
				break;
			case 10:
				return 'ZAR';
				break;
			case 11:
				return 'INR';
				break;
			case 12:
				return 'JMD';
				break;
			case 13:
				return 'CLP';
				break;
			case 14:
				return 'MXN';
				break;
			case 15:
				return 'IDR';
				break;
			case 16:
				return 'MYR';
				break;
			case 17:
				return 'SEK';
				break;
			case 18:
				return 'JPY';
				break;
			case 19:
				return 'PLN';
				break;
		}
	}

	/** 
       * function getProjectDuration()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getProjectDuration($type) 
	{
		switch ($type) {
			case 1:
				return 'Less thank 1 week';
				break;
			case 2:
				return '1 week - 4 weeks';
				break;
			case 3:
				return '1 month - 3 months';
				break;
			case 4:
				return '3 months - 6 months / ongoing';
				break;
			case 5:
				return 'Not sure';
				break;
			}
	}

	/** 
       * function getProjectDuration()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getProjectType($type) 
	{
		switch ($type) {
			case 1:
				return 'Website Application';
				break;
			case 2:
				return 'Mobile Application';
				break;
			case 3:
				return 'Desktop Application';
				break;
			case 4:
				return 'Website Design';
				break;
			case 5:
				return 'Mobile Design';
				break;
			case 6:
				return 'Desktop Design';
				break;
			case 7:
				return 'Content Writing';
				break;
			case 8:
				return 'Graphic Artwork';
				break;
			case 9:
				return 'Data Entry';
				break;
			case 10:
				return 'Data Base';
				break;
			case 11:
				return 'Sales / Marketing';
				break;
			case 12:
				return 'Consulting';
				break;
			}
	}

	/** 
       * function getPaymentType()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getPaymentType($type) 
	{
		switch ($type) {
			case 1:
				return 'fixed';
				break;
			case 2:
				return '/hr';
				break;
			}
	}

	/** 
       * function getProjectDuration()
       *
       * get table info
	   * @param $type - int
       * @return array
       */
	function getProjectDurationPer($type) 
	{
		switch ($type) {
			case 1:
				return 'week';
				break;
			case 2:
				return 'month';
				break;
			}
	}

	public function getSkills($keyword){
		$this->db->order_by('id', 'DESC');
        $this->db->like("name", $keyword);
        return $this->db->get('automcomplete')->result_array();
	}

	public function getActiveFreelanceJobDetails($flJobId){
		$this->db->select('*')->from('freelance_job');
		$this->db->where('fljobId',$flJobId);
	 	$this->db->order_by('created_on','desc');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['created_on'] = mdate('%M %d, %Y',strtotime($row['created_on']));
				$data[] = $row;
			}
			//var_dump($data);exit();
			return $data;
		}
		return false;
	}

	/**
	 * sendPaymentRequest
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function sendPaymentRequest($data) {
		$this->db->insert('localbankdepositdetails', $data);
	}

	/**
	 * getAllApplicant
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function getAllApplicant($status,$empId) {
		$query = $this->db->select('job_applicant.jobId,
									job_applicant.applied_on,
									job_applicant.applicantId,
									job_applicant.candidate_status,
									jobs.job_title,
									player.username,
									playerdetails.firstName,
									playerdetails.lastName')
						->from('job_applicant')
						->join('jobs','jobs.jobId = job_applicant.jobId','left')
						->join('job_details','job_details.job_id = jobs.jobId','left')
						->join('player','player.playerId = job_applicant.applicantId','left')
						->join('playerdetails','playerdetails.playerId = player.playerId','left');
		$this->db->where('job_applicant.empId', $empId);
		//$this->db->group_by('job_applicant.jobId');
		if($status < 3){
			$this->db->where('job_applicant.candidate_status', $status);
		}elseif($status > 2){
			$this->db->where('job_applicant.candidate_status >', 2);
		}
		
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['applied_on'] = mdate('%M %d, %Y %h:%i:%s %A',strtotime($row['applied_on']));
				//$row['job_promo'] = $this->getJobPromo($row['jobId']);
				$data[] = $row;
				//var_dump($data);exit();
			}
			return $data;
		}
		return false;
	}	

	/**
	 * getAllFreelanceJobApplicant
	 *
	 * @param 	array
	 * @return 	void
	 */
	public function getAllFreelanceJobApplicant($status,$empId) {
		$query = $this->db->select('freelancejob_applicant.jobApplicantId,
									freelancejob_applicant.applicantId,
									freelancejob_applicant.applied_on,
									freelancejob_applicant.candidate_status,
									freelancejob_applicant.fljobId as jobId,
									freelance_job.project_name as job_title,
									player.username,
									playerdetails.firstName,
									playerdetails.lastName')->
						from('freelancejob_applicant')
						->join('freelance_job','freelance_job.fljobId = freelancejob_applicant.fljobId','left')
						->join('player','player.playerId = freelancejob_applicant.jobApplicantId','left')
						->join('playerdetails','playerdetails.playerId = player.playerId','left');
		$this->db->where('freelancejob_applicant.empId', $empId);
		if($status < 3){
			$this->db->where('freelancejob_applicant.candidate_status', $status);
		}elseif($status > 2){
			$this->db->where('freelancejob_applicant.candidate_status >', 2);
		}
		$query = $this->db->get();		
		if ($query->num_rows() > 0) {
			foreach ($query->result_array() as $row){
				$row['applied_on'] = mdate('%M %d, %Y',strtotime($row['applied_on']));
				//$row['job_promo'] = $this->getJobPromo($row['jobId']);
				$data[] = $row;
				var_dump($data);exit();
			}
			return $data;
		}
		return false;
	}
}
