<?php if (!defined('BASEPATH')) {
	exit('No direct script access allowed');
}

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
 */
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
 */

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

define('BASEURL', 'http://' . $_SERVER['HTTP_HOST'] . '/jk3.0/');
define('IMAGEPATH', 'http://' . $_SERVER['HTTP_HOST'] . '/jk3.0/resources/images/');
define('CSSPATH', 'http://' . $_SERVER['HTTP_HOST'] . '/jk3.0/resources/css/');
define('JSPATH', 'http://' . $_SERVER['HTTP_HOST'] . '/jk3.0/resources/js/');
define('AGREPORTPATH', 'http://' . $_SERVER['HTTP_HOST'] . '/jk3.0/resources/agreport/');

//images path
define('PROMOIMAGEPATH', BASEURL . 'resources/images/promothumbnails/');
//define('PROMOCMSBANNERPATH', 'http://admin.'.$_SERVER['HTTP_HOST'].'/resources/images/cmsbanner/');
define('PROMOCMSBANNERPATH', BASEURL . 'resources/images/cmsbanner/');
//define('LOGOPATH', 'http://admin.hll999.com/resources/images/cmslogo/');
define('LOGOPATH', BASEURL . 'resources/images/ajkk/');
define('AJKKIMGPATH', 'http://' . $_SERVER['HTTP_HOST'] . '/jk3.0/resources/images/ajkk/');

/* End of file constants.php */
/* Location: ./application/config/constants.php */