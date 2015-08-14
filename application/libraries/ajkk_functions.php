<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Ajkk_functions
 *
 * Ajkk_functions library for FHI OG System
 *
 * @package     Ajkk_functions
 * @author      ASRII
 * @version     1.0.0
 */

class Ajkk_functions
{
    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->library(array('session'));
        $this->ci->load->model(array('player'));
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
    public function checkIfReferralCodeExist($referral_code) {
        $result = $this->ci->player->checkIfReferralCodeExist($referral_code);
        return $result;
    }


    /**
     * Will create new player details using the parameter data
     *
     * @param   array
     */
    public function createPlayerReferral($data) {
        $this->ci->player->createPlayerReferral($data);
    }

    /**
     * Will create new player details using the parameter data
     *
     * @param   array
     */
    public function createPlayerReferralDetails($data) {
        $this->ci->player->createPlayerReferralDetails($data);
    }



    /**
     * Will check if the username is already existing
     *
     * @param   string
     * @return  array
     */
    public function checkUsernameExist($username) {
        $result = $this->ci->player->checkUsernameExist($username);
        return $result;
    }

    /**
     * Will check if the email is already existing
     *
     * @param   string
     * @return  array
     */
    public function checkEmailExist($email) {
        $result = $this->ci->player->checkEmailExist($email);
        return $result;
    }

    /**
     * Will create new player using the parameter data
     *
     * @param   array
     */
    public function insertPlayer($data) {
        $hasher = new PasswordHash('8', TRUE);
        $data['password'] = $hasher->HashPassword($data['password']);
        //var_dump($data);exit();
        $this->ci->player->insertPlayer($data);
    }

    /**
     * Will create new player using the parameter data
     *
     * @param   array
     */
    public function editPlayer($data, $player_id) {        
        $this->ci->player->editPlayer($data, $player_id);
    }

    /**
     * compare changes
     *
     * @param   array
     * @return  boolean
     */
    public function compareChanges($data, $player_id) {
        $current_player_details = $this->ci->player->getPlayerDetails($player_id);
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
     * Will create new player details using the parameter data
     *
     * @param   array
     */
    public function insertPlayerDetails($data) {
        $this->ci->player->insertPlayerDetails($data);
    }

    /**
     * Will create new player details using the parameter data
     *
     * @param   array
     */
    public function editPlayerDetails($data, $player_id) {
        $this->ci->player->editPlayerDetails($data, $player_id);
    }

    /**
     * Will get player account given the Id
     *
     * @param   int
     * @return  array
     */
    public function getPlayerAccount($player_id) {
        $result = $this->ci->player->getPlayerAccount($player_id);
        return $result;
    }

    /**
     * Will get player main wallet at given playerId
     *
     * @param   int
     * @return  array
     */
    public function getPlayerMainWallet($player_id) {
        $result = $this->ci->player->getPlayerMainWallet($player_id);
        return $result;
    }

    /**
     * Will get player account given the Id
     *
     * @param   int
     * @return  array
     */
    public function getPlayerAccountByPlayerId($player_id) {
        $result = $this->ci->player->getPlayerAccountByPlayerId($player_id);
        return $result;
    }

    /**
     * Will get player account given the Id
     *
     * @param   int
     * @return  array
     */
    public function getPlayerAccountByPlayerIdOnly($player_id) {
        $result = $this->ci->player->getPlayerAccountByPlayerIdOnly($player_id);
        return $result;
    }

    /**
     * Will get player account given the Id
     *
     * @param   int
     * @return  array
     */
    public function getPlayerAccountDetails($player_id) {
        $result = $this->ci->player->getPlayerAccountDetails($player_id);
        return $result;
    }

    /**
     * Will get player account given the Id
     *
     * @param   int
     * @return  array
     */
    public function getPlayerAccountHistory($player_id) {
        $result = $this->ci->player->getPlayerAccountHistory($player_id);
        return $result;
    }

    /**
     * Will get player given the Id
     *
     * @param   int
     * @return  array
     */
    public function getPlayerById($player_id) {
        $result = $this->ci->player->getPlayerById($player_id);
        return $result;
    }

    /**
     * Will get player username
     *
     * @param   int
     * @return  array
     */
    public function getPlayerUsername($player_id) {
        $result = $this->ci->player->getPlayerUsername($player_id);
        return $result;
    }

    

    /**
     * Will get player given the Id
     *
     * @param   int
     * @return  array
     */
    public function updatePlayerAccount($player_id, $player_account_id, $data) {
        $this->ci->player->updatePlayerAccount($player_id, $player_account_id, $data);
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
     * Will get player given the Id
     *
     * @param   int
     * @return  array
     */
    public function getAllTransactionHistoryByPlayerId($player_id) {
        $result = $this->ci->player->getAllTransactionHistoryByPlayerId($player_id);
        return $result;
    }

    

    public function getTransactionId() {
        $seed = str_split('ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                             .'0123456789'); // and any other characters
        shuffle($seed); // probably optional since array_is randomized; this may be redundant
        $transaction_id = '';
        foreach (array_rand($seed, 18) as $k) $transaction_id .= $seed[$k];

        return $transaction_id;
    }

    
    function checkInrange($dt_start, $dt_end, $dt_check){
        if(strtotime($dt_check) > strtotime($dt_start) && strtotime($dt_check) < strtotime($dt_end))
            return "true";
        return "false";
    }

    
    /**
     * get email in email table
     *
     * @return  array
     */
    public function getEmail() {
        return $this->ci->player->getEmail();
    }

    
    /**
     * get list of games
     *
     * @return  array
     */
    public function getGames() {
        return $this->ci->player->getGames();
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
     * Will get all news
     *
     * @return  array
     */
    public function getAllNews() {
        return $this->ci->player->getAllNews();
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
     * getPlayerAdjustmentHistory
     * 
     * @return  rendered template
     */
    public function getPlayerAdjustmentHistory($playerId) {
        return $this->ci->player->getPlayerAdjustmentHistory($playerId);
    }

     /**
     * getPlayerAdjustmentHistory
     * 
     * @return  rendered template
     */
    public function getPlayerAdjustmentHistoryWLimit($playerId, $limit, $offset) {
        return $this->ci->player->getPlayerAdjustmentHistoryWLimit($playerId, $limit, $offset);
    }

    

    /**
     * getPlayer by Username
     * 
     * @return  rendered template
     */
    public function getPlayerByUsername($username) {
        return $this->ci->player->getPlayerByUsername($username);
    }
}

/* End of file user_functions.php */
/* Location: ./application/libraries/player_functions.php */