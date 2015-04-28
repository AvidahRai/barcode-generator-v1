<?php
	
	/*
	 |--------------------------------------------------------------------------
	 | Error Reporting
	 |--------------------------------------------------------------------------
	*/
	ini_set('display_errors', 0);
	error_reporting(E_ALL);
	
	/*
	 |--------------------------------------------------------------------------
	 | Constant Definition
	 |--------------------------------------------------------------------------
	 */	
		define ('DS','/');
		define ('BASE_URI', '');
		define ('CACHE_URI', ''); 
		define ('PUBLIC_URL', '');
		define ('CACHE_URL', ''); 	
		
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