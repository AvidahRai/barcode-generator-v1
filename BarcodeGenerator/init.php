<?php
	/*
	 |--------------------------------------------------------------------------
	 | Name : init.php
	 | Creator : Avinash Rai
	 | Purpose: Application Initialization File
	 |--------------------------------------------------------------------------
	 */
	 
	/*
	 |--------------------------------------------------------------------------
	 | Run Environment-specific configuration settings
	 |--------------------------------------------------------------------------
	 */
		$host = substr($_SERVER['HTTP_HOST'], 0, 5);
		if (in_array($host, array('local', '127.0', '192.1'))) {
			$local = true;
		} else {
			$local = false;
		}
		if ($local) {
			require 'Config/local.php';
		} else {
			require 'Config/live.php';
		}	
			
	/*
	 |--------------------------------------------------------------------------
	 | Define PRS-4 Standard Autoloader
	 |--------------------------------------------------------------------------
	 */
		spl_autoload_register(function ($class) {
			$file = BASE_URI .str_replace('\\', '/', $class) .'.php';
			if (file_exists($file)) {
				require $file;
			}
		});

	/*
	 |--------------------------------------------------------------------------
	 | Clean unused Cache Directory
	 |--------------------------------------------------------------------------
	 */		
		$clean = new BarcodeGenerator\Directory\DirectoryCleaner(); 
		
	/*
	 |--------------------------------------------------------------------------
	 | Run Application
	 |--------------------------------------------------------------------------
	 */
		$app = new BarcodeGenerator\Core\AsyncRequestHandler();