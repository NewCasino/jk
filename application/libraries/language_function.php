<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Language function
 *
 * Language function library for FHI OG System
 *
 * @package		Language function
 * @author		ASRII
 * @version		1.0.0
 */

class Language_function
{
	private $error = array();

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->database();
		$this->ci->load->library(array('session'));
		$this->ci->load->model(array('player'));
	}
	
	/**
	 * get language code
	 *
	 * @return	rendered Template
	 */
    function getLanguageCode($lang) {
    	switch ($lang) {
    		case 1:
    			return 'en';
    			break;
    		case 2:
    			return 'ch';
    			break;
    		default:
    			# code...
    			break;
    	}
    }

	/**
	 * get language 
	 *
	 * @return	rendered Template
	 */
    function getLanguage($lang) {
    	switch ($lang) {
    		case 1:
    			return 'english';
    			break;
    		case 2:
    			return 'chinese';
    			break;
    		default:
    			# code...
    			break;
    	}
    }

    /**
	 * get current language
	 *
	 * @param	int
	 * @return 	array
	 */
	function getCurrentLanguage() {
		$language =	$this->ci->session->userdata('lang');

		if(empty($language)) {
			$this->ci->session->set_userdata('lang', '1');
			$language = '1';
		}

		return $language;
	}

	/**
	 * get current language
	 *
	 * @param	data
	 * @return 	array
	 */
	function setCurrentLanguage($language) {
		$this->ci->session->set_userdata('lang', $language);//$this->ci->player->setCurrentLanguage($data);
	}
}

/* End of file language_function.php */
/* Location: ./application/libraries/language_function.php */
