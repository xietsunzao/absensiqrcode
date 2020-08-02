<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * PHP QR Code porting for Codeigniter
 *
 * @package        	CodeIgniter
 * @subpackage    	Libraries
 * @category    	Libraries
 * @porting author	dwi.setiyadi@gmail.com
 * @original author	http://phpqrcode.sourceforge.net/
 * @link 			https://github.com/dwisetiyadi/CodeIgniter-PHP-QR-Code
 * @version		1.0	
 * @license 
 */

 
$config['cacheable'] 	= TRUE; //boolean, the default is true
$config['cachedir'] 	= 'tmp/cache/'; //string, the default is tmp/cache/
$config['imagedir'] 	= 'tmp/qr_codes/'; //string, the default is tmp/qr_codes/
$config['errorlog'] 	= 'tmp/logs/'; //string, the default is tmp/logs/
$config['ciqrcodelib'] 	= 'application/third_party/qr_code/'; //string, the default is application/third_party/qr_code/
$config['quality'] 		= TRUE; //boolean, the default is true 
$config['size'] 		= 1024; 	//interger, the default is 1024
$config['black']        = array(224,255,255); // array, default is array(255,255,255)
$config['white']        = array(70,130,180); // array, default is array(0,0,0)
  
/* End of file qr_code.php */
/* Location: ./application/config/qr_code.php */