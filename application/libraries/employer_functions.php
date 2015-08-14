<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Employer_Functions
 *
 * Employer_Functions library for FHI OG System
 *
 * @package     Employer_Functions
 * @author      ASRII
 * @version     1.0.0
 */

class Employer_Functions
{
    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->library(array('session'));
        $this->ci->load->model(array('employer'));
    }

    /**
     * Adds user to the database
     *
     * @return  boolean
     */
    function register($data) {
        $hasher = new PasswordHash('8', TRUE);
        $data['password'] = $hasher->HashPassword($data['password']);

        $result = $this->ci->player->insertUser($data);
        return $result;
    }

    public function getJobRandOrderId() {
        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                             .'0123456789'
                             ); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $randomPassword = '';
        foreach (array_rand($seed, 3) as $k) $randomPassword .= $seed[$k];

        return $randomPassword;
    }

    public function randomizer($username) {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                             .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                             .'0123456789!@#$%^&*()'
                             .$username); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $randomPassword = '';
        foreach (array_rand($seed, 9) as $k) $randomPassword .= $seed[$k];

        return $randomPassword;
    }

    public function generateReferralCode($player_id) {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                             .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                             .'0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $referral_code = '';
        foreach (array_rand($seed, 5) as $k) $referral_code .= $seed[$k];

        return $player_id . $referral_code . "OG";
    }

    public function getRandomVerificationCode() {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                             .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                             .'0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $verification_code = '';
        foreach (array_rand($seed, 32) as $k) $verification_code .= $seed[$k];

        return $verification_code;
    }

    public function getRandomTransactionCode() {
        $max = $this->ci->player->getMaxNumberOfWalletAccount();
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                             .'0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $transaction_code = '';
        foreach (array_rand($seed, 14) as $k) $transaction_code .= $seed[$k];
        return $transaction_code;
    }

    /**
     * Will check if the username is already existing
     *
     * @param   string
     * @return  array
     */
    public function checkUsernameExist($username) {
        $result = $this->ci->employer->checkUsernameExist($username);
        return $result;
    }

    /**
     * Will check if the email is already existing
     *
     * @param   string
     * @return  array
     */
    public function checkEmailExist($email) {
        $result = $this->ci->employer->checkEmailExist($email);
        return $result;
    }

    /**
     * Will create new player using the parameter data
     *
     * @param   array
     */
    public function insertEmployer($data,$additional_data) {
        $hasher = new PasswordHash('8', TRUE);
        $data['password'] = $hasher->HashPassword($data['password']);
        //var_dump($data);exit();
        $this->ci->employer->insertEmployer($data,$additional_data);
    }

    /**
     * Will create new player using the parameter data
     *
     * @param   array
     */
    public function editEmployer($data, $player_id) {        
        $this->ci->employer->editEmployer($data, $player_id);
    }

    /**
     * compare changes
     *
     * @param   array
     * @return  boolean
     */
    public function compareChanges($data, $player_id) {
        $current_player_details = $this->ci->employer->getPlayerDetails($player_id);
        $changes = array();

        foreach ($data as $key => $value) {
            if($value[$key] != $current_player_details[$key]) {
                array_push($changes, $key);
            }
        }

        print_r($changes);
        exit();
    }

    /**
     * Will create new employer details using the parameter data
     *
     * @param   array
     */
    public function insertEmployerDetails($data) {
        $this->ci->employer->insertEmployerDetails($data);
    }

    /**
     * Will create new employer details using the parameter data
     *
     * @param   array
     */
    public function editEmployerDetails($data, $employer_id) {
        $this->ci->employer->editEmployerDetails($data, $employer_id);
    }

     
    /**
     * Will get employer given the Id
     *
     * @param   int
     * @return  array
     */
    public function getEmployerById($employer_id) {
        $result = $this->ci->employer->getEmployerById($employer_id);
        return $result;
    }

    /**
     * Will get employer username
     *
     * @param   int
     * @return  array
     */
    public function getEmployerUsername($employer_id) {
        $result = $this->ci->employer->getEmployerUsername($employer_id);
        return $result;
    }

    /**
     * Will get employer billing
     *
     * @param   int
     * @return  array
     */
    public function getEmpBilling($employer_id,$status=0) {
        $result = $this->ci->employer->getEmpBilling($employer_id,$status);
        return $result;
    }

    /**
     * Will get employer billing
     *
     * @param   int
     * @return  array
     */
    public function getFLEmpBilling($employer_id,$status=0) {
        $result = $this->ci->employer->getFLEmpBilling($employer_id,$status);
        return $result;
    }

    function get_age($birth_date){
        return floor((time() - strtotime($birth_date))/31556926);
    }

    /**
     * Get error message.
     * Can be invoked after any failed operation such as login or register.
     *
     * @return  string
     */
    public function checkPassword($password, $playerPassword)
    {
        $hasher = new PasswordHash('8', TRUE);
        return $hasher->CheckPassword($password, $playerPassword);
    }

    
    /**
     * get email in email table
     *
     * @return  array
     */
    public function getEmail() {
        return $this->ci->employer->getEmail();
    }
    
    /**
     * Will randomize alphanumeric and special characters
     *
     * @param   string
     * @return  string
     */
    public function generateRandomCode() {
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                             .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                             .'0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $generatePromoCode = '';
        foreach (array_rand($seed, 7) as $k) $generatePromoCode .= $seed[$k];

        return $generatePromoCode;
    }

   
    /**
     * Resets Password of a user
     *
     * @return  boolean
     */
    function resetPassword($player_id, $data) {
        $hasher = new PasswordHash('8', TRUE);
        $data['password'] = $hasher->HashPassword($data['password']);
        $this->ci->player->resetPassword($player_id, $data);
    }

    /**
     * Checks if user is already existing
     *
     * @return  boolean
     */
    function isValidPassword($player_id, $opassword) {
        $hasher = new PasswordHash('8', TRUE);
        $player = $this->getPlayerById($player_id);
        $password = $player['password'];

        if($hasher->CheckPassword($opassword, $password)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * getPlayer by Username
     * 
     * @return  rendered template
     */
    public function getEmployerByUsername($username) {
        return $this->ci->employer->getEmployerByUsername($username);
    }

    /**
     * getEmployerCompName by Username
     * 
     * @return  rendered template
     */
    public function getEmployerCompName($username) {
        return $this->ci->employer->getEmployerCompName($username);
    }

    /**
     * getEmployerMembershipInfo by Username
     * 
     * @return  rendered template
     */
    public function getEmployerMembershipInfo($username) {
        return $this->ci->employer->getEmployerMembershipInfo($username);
    }

    /**
     * getEmployerInfo
     * 
     * @return  rendered template
     */
    public function getEmployerInfo($employerId) {
        return $this->ci->employer->getEmployerInfo($employerId);
    }

    /**
     * getEmployerDetails
     * 
     * @return  rendered template
     */
    public function getEmployerDetails($employerId) {
        return $this->ci->employer->getEmployerDetails($employerId);
    }

    /**
     * postJob by jobSummary
     * 
     * @return  rendered template
     */
    public function postJob($jobSummary) {
        return $this->ci->employer->postJob($jobSummary);
    }

    /**
     * insert_table_details
     * 
     * @return  rendered template
     */
    public function insert_table_details($table_name,$details) {
        return $this->ci->employer->insert_table_details($table_name,$details);
    }

    /**
     * insert_table_details
     * 
     * @return  rendered template
     */
    public function update_fltable_details($table_name,$details) {
        return $this->ci->employer->update_fltable_details($table_name,$details);
    }

    /**
     * postJob by jobSummary
     * 
     * @return  rendered template
     */
    public function update_table_details($table_name,$form_data ) {
        return $this->ci->employer->update_table_details($table_name,$form_data);
    }

    /**
     * update_jobtable
     * 
     * @return  rendered template
     */
    public function update_jobtable($table_name,$form_data) {
        return $this->ci->employer->update_jobtable($table_name,$form_data);
    }

    /**
     * update_jobtable_details
     * 
     * @return  rendered template
     */
    public function update_jobtable_details($table_name,$form_data) {
        return $this->ci->employer->update_jobtable_details($table_name,$form_data);
    }

    /**
     * getJobInfo
     * 
     * @return  rendered template
     */
    public function getJobInfo($jobId) {
        return $this->ci->employer->getJobInfo($jobId);
    }

    /**
     * getJobInfo
     * 
     * @return  rendered template
     */
    public function getJobInfoDetailed($jobId) {
        return $this->ci->employer->getJobInfoDetailed($jobId);
    }

    /**
     * getJobInfo
     * 
     * @return  rendered template
     */
    public function delete_jobtable_details($table_name, $user_id){
        return $this->ci->employer->delete_jobtable_details($table_name, $user_id);   
    }

    /**
     * delete freelance job skills req
     * 
     * @return  rendered template
     */
    public function delete_fljob_reqskills($flJobId){
        return $this->ci->employer->delete_fljob_reqskills($flJobId);   
    }

    /**
     * getFreelanceJobInfo
     * 
     * @return  rendered template
     */
    public function getFreelanceJobInfo($jobId) {
        return $this->ci->employer->getFreelanceJobInfo($jobId);
    }

    /**
     * getJobDetails
     * 
     * @return  rendered template
     */
    public function getJobDetails($jobId) {
        return $this->ci->employer->getJobDetails($jobId);
    }

    /**
     * getJobPost
     * 
     * @return  rendered template
     */
    public function getJobPost($jobId) {
        return $this->ci->employer->getJobPost($jobId);
    }

    /**
     * isFreelanceJobAvailedPromo
     * 
     * @return  rendered template
     */
    public function isFreelanceJobAvailedPromo($fljobId) {
        return $this->ci->employer->isFreelanceJobAvailedPromo($fljobId);
    }

    /**
     * getPostedJobs
     * 
     * @return  rendered template
     */
    public function getPostedJobs($sort,$limit, $offset,$empId) {
        return $this->ci->employer->getPostedJobs($sort,$limit, $offset,$empId);
    }

    /**
     * getPostedJobs
     * 
     * @return  rendered template
     */
    public function getAllPostedJobs($sort,$empId) {
        return $this->ci->employer->getAllPostedJobs($sort,$empId);
    }

    /**
     * getPostedJobs
     * 
     * @return  rendered template
     */
    public function getJobInfoDetails($jobId,$status) {
        return $this->ci->employer->getJobInfoDetails($jobId,$status);
    }

    /**
     * getFreelanceJobInfoDetails
     * 
     * @return  rendered template
     */
    public function getFreelanceJobInfoDetails($jobId,$status) {
        return $this->ci->employer->getFreelanceJobInfoDetails($jobId,$status);
    }

    /**
     * getPostedFLJobs
     * 
     * @return  rendered template
     */
    public function getPostedFLJobs($sort,$empId) {
        return $this->ci->employer->getPostedFLJobs($sort,$empId);
    }

    /**
     * updateJobPostStatus
     *
     * @param   string
     * @return  array
     */
    public function updateJobPostStatus($data) {
        return $this->ci->employer->updateJobPostStatus($data);
    }

    /**
     * updateFLJobPostStatus
     *
     * @param   string
     * @return  array
     */
    public function updateFLJobPostStatus($data) {
        return $this->ci->employer->updateFLJobPostStatus($data);
    }

    /**
     * assess applicant
     *
     * @param   string
     * @return  array
     */
    public function assessFJApplicant($data,$fljobId,$applicantId) {
        return $this->ci->employer->assessFJApplicant($data,$fljobId,$applicantId);
    }

    /**
     * assess applicant
     *
     * @param   string
     * @return  array
     */
    public function assessJobApplicant($data,$jobId,$applicantId) {
        return $this->ci->employer->assessJobApplicant($data,$jobId,$applicantId);
    }

    /**
     * activatedDeactivateFLJobPost
     *
     * @param   string
     * @return  array
     */
    public function activatedDeactivateFLJobPost($data) {
        return $this->ci->employer->activatedDeactivateFLJobPost($data);
    }

    /**
     * activatedDeactivateJobPost
     *
     * @param   string
     * @return  array
     */
    public function activatedDeactivateJobPost($data) {
        return $this->ci->employer->activatedDeactivateJobPost($data);
    }

    /**
     * getJobsCnt
     * 
     * @return  rendered template
     */
    public function getJobsCnt($empId,$type) {
        return $this->ci->employer->getJobsCnt($empId,$type);
    }

    /**
     * getFLJobsCnt
     * 
     * @return  rendered template
     */
    public function getFLJobsCnt($empId,$type) {
        return $this->ci->employer->getFLJobsCnt($empId,$type);
    }

    /**
     * jobApplicantCnt
     * 
     * @return  rendered template
     */
    public function getApplicantCnt($jobId,$status,$type) {
        return $this->ci->employer->getApplicantCnt($jobId,$status,$type);
    }

    /**
     * addEmpLogo
     *
     * @param   $array
     * @return  $void
     */
    public function addEmpLogo($data) {
        $this->ci->employer->addEmpLogo($data);
    }

    /**
     * addEmpLogo
     *
     * @param   $array
     * @return  $void
     */
    public function editEmpLogo($data) {
        $this->ci->employer->editEmpLogo($data);
    }

    /**
     * add job details doc
     *
     * @param   $array
     * @return  $void
     */
    public function addFreelanceJobDetails($data) {
        $this->ci->employer->addFreelanceJobDetails($data);
    }

    /**
     * getFreelanceJob
     *
     * @param   $array
     * @return  $void
     */
    public function getFreelanceJob($fljobId) {
        return $this->ci->employer->getFreelanceJob($fljobId);
    }

    /**
     * getFreelanceJobs
     *
     * @param   $array
     * @return  $void
     */
    public function getFreelanceJobs() {
        return $this->ci->employer->getFreelanceJobs();
    }

    /**
     * getFulltimeJobs
     *
     * @param   $array
     * @return  $void
     */
    public function getFulltimeJobs() {
        return $this->ci->employer->getFulltimeJobs();
    }

    /**
     * searchFreelanceJobs
     *
     * @param   $array
     * @return  $void
     */
    public function searchFreelanceJobs() {
        return $this->ci->employer->searchFreelanceJobs();
    }

    /**
     * searchFulltimeJobs
     *
     * @param   $array
     * @return  $void
     */
    public function searchFulltimeJobs() {
        return $this->ci->employer->searchFulltimeJobs();
    }

    /**
     * searchParttimeJobs
     *
     * @param   $array
     * @return  $void
     */
    public function searchParttimeJobs() {
        return $this->ci->employer->searchParttimeJobs();
    }

    /**
     * searchAgencyJobs
     *
     * @param   $array
     * @return  $void
     */
    public function searchAgencyJobs() {
        return $this->ci->employer->searchAgencyJobs();
    }

    /**
     * getFreelanceJobsAjax
     *
     * @param   $array
     * @return  $void
     */
    public function getFreelanceJobsAjax($load) {
        return $this->ci->employer->getFreelanceJobsAjax($load);
    }

    /**
     * getFulltimeJobsAjax
     *
     * @param   $array
     * @return  $void
     */
    public function getFulltimeJobsAjax($load) {
        return $this->ci->employer->getFulltimeJobsAjax($load);
    }

    /**
     * getParttimeJobsAjax
     *
     * @param   $array
     * @return  $void
     */
    public function getParttimeJobsAjax($load) {
        return $this->ci->employer->getParttimeJobsAjax($load);
    }

    /**
     * getAgencyJobsAjax
     *
     * @param   $array
     * @return  $void
     */
    public function getAgencyJobsAjax($load) {
        return $this->ci->employer->getAgencyJobsAjax($load);
    }

    /**
     * getTotalJobsCnt
     *
     * @param   $array
     * @return  $void
     */
    public function getTotalJobsCnt($type,$status) {
        return $this->ci->employer->getTotalJobsCnt($type,$status);
    }

    
    /**
     * getFreelanceJob
     *
     * @param   $array
     * @return  $void
     */
    public function getJobPaymentDetails($jobId) {
        return $this->ci->employer->getJobPaymentDetails($jobId);
    }

    /**
     * getFreelanceJobPaymentDetails
     *
     * @param   $array
     * @return  $void
     */
    public function getFreelanceJobPaymentDetails($fljobId) {
        return $this->ci->employer->getFreelanceJobPaymentDetails($fljobId);
    }

    /**
     * isFreelanceJobExists
     *
     * @param   $array
     * @return  $void
     */
    public function isFreelanceJobExists($fljobId) {
        return $this->ci->employer->isFreelanceJobExists($fljobId);
    }

    /**
     * isJobExistsPromo
     *
     * @param   $array
     * @return  $void
     */
    public function isJobExistsPromo($jobId) {
        return $this->ci->employer->isJobExistsPromo($jobId);
    }

    /**
     * getEmpLogo
     * 
     * @return  rendered template
     */
    public function getEmpLogo($empId) {
        return $this->ci->employer->getEmpLogo($empId);
    }

    public function getSkills($keyword) { 
        return $this->ci->employer->getSkills($keyword);
        //var_dump($keyword);               
    }

    public function getActiveFreelanceJobDetails($flJobId) { 
        return $this->ci->employer->getActiveFreelanceJobDetails($flJobId);
    }

    public function getPublishedJobDetailed($jobId) { 
        return $this->ci->employer->getPublishedJobDetailed($jobId);
    }
    
    /**
     * Will sendPaymentRequest
     *
     * @param   int
     * @return  array
     */
    public function sendPaymentRequest($data) {
        $this->ci->employer->sendPaymentRequest($data);
    }

    
    /**
     * Will getAllApplicant
     *
     * @param   int
     * @return  array
     */
    public function getAllApplicant($status,$empId) {
        return $this->ci->employer->getAllApplicant($status,$empId);
    }

    /**
     * Will getAllFreelanceJobApplicant
     *
     * @param   int
     * @return  array
     */
    public function getAllFreelanceJobApplicant($status,$empId) {
        return $this->ci->employer->getAllFreelanceJobApplicant($status,$empId);
    }
}

/* End of file user_functions.php */
/* Location: ./application/libraries/player_functions.php */