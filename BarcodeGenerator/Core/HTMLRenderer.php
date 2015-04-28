<?php namespace BarcodeGenerator\Core;
	
	/**
	* Static Class HTMLRenderer
	* @author Avinash Rai
	*/
	class HTMLRenderer { 
		
		/**
		 * Render the view from the specified file.
		 * @param string $file_name
		 * @param string $data
		 * @return void
		 */
		public static function render($file_name, $data = null) {
			$path = BASE_URI.'BarcodeGenerator'.DS.'Views'.DS.$file_name.'.html'; 
			if ( file_exists($path) ) { 
				include $path; 
			}
		}
		
	}
