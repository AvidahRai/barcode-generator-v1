<?php

	/*
	 |--------------------------------------------------------------------------
	 | Name : development.php
	 | Creator : Avinash Rai
	 | Purpose: simple configure file for Local Environment.
	 |--------------------------------------------------------------------------
	 */
	
	/*
	 |--------------------------------------------------------------------------
	 |Error Reporting
	 |--------------------------------------------------------------------------
	*/
	ini_set('display_errors', 1);
	error_reporting(E_ALL);
	
	/*
	 |--------------------------------------------------------------------------
	 | Constant Definition (*REQUIRES CHANGE*)
	 |--------------------------------------------------------------------------
	 */	
		define ('DS','/');
		define ('BASE_URI', ''); # E.g. C:\Program Files (x86)\XAMPP\htdocs\barcode-generator\\
		define ('CACHE_URI', ''); # E.g. C:\Program Files (x86)\XAMPP\htdocs\barcode-generator\public_html\cache\\
		define ('PUBLIC_URL', ''); # E.g. http://localhost/barcode-generator/public_html/
		define ('CACHE_URL', '');  # E.g. http://localhost/barcode-generator/public_html/cache/
		
	/*
	 |--------------------------------------------------------------------------
	 | Cache Management
	 |--------------------------------------------------------------------------
	 */
		session_start();
		$key = $_SERVER['REMOTE_ADDR'];
		if (isset($_SESSION['users'])) { 
			if (!in_array($key, $_SESSION['users'])) { 
				$_SESSION['users'][] = $key; 
			}
		} else { 
			$_SESSION['users'] = [];
		}
