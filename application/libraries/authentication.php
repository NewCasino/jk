<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('phpass-0.1/PasswordHash.php');

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');


/**
 * Authentication
 *
 * Authentication library for FHI OG System
 *
 * @package     Authentication
 * @author      ASRII
 * @version     1.0.0
 */

class Authentication
{
    private $error = array();

    function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load->database();
        $this->ci->load->library(array('session','language_function'));
        $this->ci->load->model(array('player'));

        $this->initiateLang();
    }

    /**
     * initiate Language
     *
     * @return  void
     */
    public function initiateLang(){
        $language = $this->ci->language_function->getCurrentLanguage();    
        $langCode = $this->ci->language_function->getLanguageCode($language);
        $language = $this->ci->language_function->getLanguage($language);
        $this->ci->lang->load($langCode, $language);
    }

    /**
     * Login player on the site. Return TRUE if login is successful
     * (player exists and password is correct), otherwise FALSE.
     *
     * @param   string  (username)
     * @param   string  (password)
     * @param   bool
     * @return  bool
     */
    public function login($login, $password)
    {
        if ((strlen($login) > 0) AND (strlen($password) > 0)) {

            if (!is_null($player = $this->ci->player->getPlayerByLogin($login))) {   // login ok

                if($player->status == 0) {                                                 // normal account ok

                    // Does password match hash in database?
                    $hasher = new PasswordHash('8', TRUE);

                    if ($hasher->CheckPassword($password, $player->password)) {       // password ok

                        $this->ci->session->set_userdata(array(
                                'player_id'   => $player->playerId,
                                'username'  => $player->username,
                                'status'    => STATUS_ACTIVATED,
                        ));

                        $this->ci->player->updateLoginInfo($player->playerId, TRUE, TRUE);

                        return TRUE;

                    } else {                                                            // fail - wrong password
                        $this->error = array('password' => 'incorrect password');
                    }
                } else {                                                            // fail - locked account
                    $today = date("Y-m-d H:i:s");

                    if(strtotime($today) > strtotime($player->lockedStart) && strtotime($today) < strtotime($player->lockedEnd) ) {
                        $days = floor((strtotime($player->lockedEnd) - strtotime($today))/(60*60*24));
                        if($days == 0) $days = '1';
                        $this->error = array('login' => "You're account has been locked for " . $days . " day/s, You're not allowed to login");
                    } else {

                        $data = array(
                                'lockedStart' => '0000-00-00 00:00:00',
                                'lockedEnd' => '0000-00-00 00:00:00',
                                'status' => '0',
                                'online' => '0',
                            );

                        $this->ci->player->editPlayer($data, $player->playerId);

                        // Does password match hash in database?
                        $hasher = new PasswordHash('8', TRUE);

                        if ($hasher->CheckPassword($password, $player->password)) {       // password ok

                            $this->ci->session->set_userdata(array(
                                    'player_id'   => $player->playerId,
                                    'username'  => $player->username,
                                    'status'    => STATUS_ACTIVATED,
                            ));

                            $this->ci->player->updateLoginInfo($player->playerId, TRUE, TRUE);

                            return TRUE;

                        } else {                                                            // fail - wrong password
                            $this->error = array('password' => 'Incorrect password');
                        }
                    }
                }
            } else {                                                            // fail - wrong login
                $this->error = array('login' => 'Incorrect login details');
            }
        }

        return FALSE;
    }

    /**
     * Login employer on the site. Return TRUE if login is successful
     * (employer exists and password is correct), otherwise FALSE.
     *
     * @param   string  (username)
     * @param   string  (password)
     * @param   bool
     * @return  bool
     */
    public function loginEmployer($login, $password)
    {
        if ((strlen($login) > 0) AND (strlen($password) > 0)) {

            if (!is_null($employer = $this->ci->employer->getEmployerByLogin($login))) {   // login ok

                if($employer->status == 0) {                                                 // normal account ok

                    // Does password match hash in database?
                    $hasher = new PasswordHash('8', TRUE);

                    if ($hasher->CheckPassword($password, $employer->password)) {       // password ok

                        $this->ci->session->set_userdata(array(
                                'employer_id'   => $employer->employerId,
                                'username'  => $employer->username,
                                'status'    => STATUS_ACTIVATED,                                
                        ));

                        $this->ci->employer->updateLoginInfo($employer->employerId, TRUE, TRUE, TRUE);

                        return TRUE;

                    } else {                                                            // fail - wrong password
                        $this->error = array('password' => 'incorrect password');
                    }
                } else {                                                            // fail - locked account
                    $today = date("Y-m-d H:i:s");

                    if(strtotime($today) > strtotime($employer->lockedStart) && strtotime($today) < strtotime($employer->lockedEnd) ) {
                        $days = floor((strtotime($employer->lockedEnd) - strtotime($today))/(60*60*24));
                        if($days == 0) $days = '1';
                        $this->error = array('login' => "You're account has been locked for " . $days . " day/s, You're not allowed to login");
                    } else {

                        $data = array(
                                'lockedStart' => '0000-00-00 00:00:00',
                                'lockedEnd' => '0000-00-00 00:00:00',
                                'status' => '0',

                            );

                        $this->ci->employer->editEmployer($data, $employer->employerId);

                        // Does password match hash in database?
                        $hasher = new PasswordHash('8', TRUE);

                        if ($hasher->CheckPassword($password, $employer->password)) {       // password ok

                            $this->ci->session->set_userdata(array(
                                    'employer_id'   => $employer->employerId,
                                    'username'  => $employer->username,
                                    'status'    => STATUS_ACTIVATED,
                                    
                            ));

                            $this->ci->employer->updateLoginInfo($employer->employerId, TRUE, TRUE, TRUE);

                            return TRUE;

                        } else {                                                            // fail - wrong password
                            $this->error = array('password' => 'Incorrect password');
                        }
                    }
                }
            } else {                                                            // fail - wrong login
                $this->error = array('login' => 'Incorrect login details');
            }
        }

        return FALSE;
    }

    /**
     * Logout player from the site
     *
     * @return  void
     */
    public function logout()
    {
        $data = array(
            'online' => '1',
        );
        $this->ci->player->editPlayer($data, $this->getPlayerId());

        $data = array(
            'lastLogoutTime' => date("Y-m-d H:i:s")
        );

        $this->ci->player->setLogout($this->getPlayerId(), $data);

        $this->ci->session->unset_userdata(array('player_id' => '', 'username' => '', 'status' => '', 'usertype' => ''));

        $this->ci->session->sess_destroy();
    }

    /**
     * Logout player from the site
     *
     * @return  void
     */
    public function logoutEmployer()
    {
        $data = array(
            'online' => '1',
        );
        $this->ci->employer->editEmployer($data, $this->getEmployerId());

        $data = array(
            'lastLogoutTime' => date("Y-m-d H:i:s")
        );

        $this->ci->player->setLogout($this->getEmployerId(), $data);

        $this->ci->session->unset_userdata(array('employer_id' => '', 'username' => '', 'status' => '', 'usertype' => ''));

        $this->ci->session->sess_destroy();
    }

    /**
     * Check if player logged in.
     *
     * @param   bool
     * @return  bool
     */
    public function isLoggedIn($activated = TRUE)
    {
        return $this->ci->session->userdata('status') === ($activated ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED);
    }

    /**
     * Get player_id
     *
     * @return  string
     */
    public function getPlayerId()
    {
        return $this->ci->session->userdata('player_id');
    }

    /**
     * Get employer_id
     *
     * @return  string
     */
    public function getEmployerId()
    {
        return $this->ci->session->userdata('employer_id');
    }

    /**
     * Get username
     *
     * @return  string
     */
    public function getUsername()
    {
        return $this->ci->session->userdata('username');
    }

    /**
     * Get error message.
     * Can be invoked after any failed operation such as login or register.
     *
     * @return  string
     */
    public function get_error_message()
    {
        return $this->error;
    }
}

/* End of file fe_authentication.php */
/* Location: ./application/libraries/fe_authentication.php */