<?php namespace BarcodeGenerator\Core;
 	
	/**
	* 
	* @author Avinash Rai
	*/
	class AsyncRequestHandler { 
			 
		private $_method;
		
		private $_parameters;
		
		/**
		 * Create a new AsyncRequestHandler instance
		 */
		function __construct() { 	
			if (!$this->_isAsynchronous()) { 
				$this->_redirectToIndex();
			}
			$this->_method = 'loadForm'; 
			$this->_parameters = null; 
			$url = $this->_parseURLRequest();
			if (!isset($url)) { 
				HTMLRenderer::render('main');
				return;
			}
			if (method_exists(__CLASS__, $url[0])) { 
				$this->_method = $url[0]; 
				unset($url[0]);
			}
			$this->_parameters = $url ? array_values($url) : [];
			unset($url); 
			call_user_func_array( [__CLASS__, $this->_method], $this->_parameters );
		}

		/**
		 * Render the form for the selected barcode symbology.
		 * @param string $symbology 
		 * @return void;
		 */ 
		public function loadForm($symbology=null) {
			switch (strtolower($symbology)) { 
				case 'upc-a':
					HTMLRenderer::render('forms/upc-a');
				break;
				case 'upc-e':
					HTMLRenderer::render('forms/upc-e');
				break;
				case 'ean-13':
					HTMLRenderer::render('forms/ean-13');
				break;
				case 'ean-8':
					HTMLRenderer::render('forms/ean-8');
				break;
				case 'isbn':
					HTMLRenderer::render('forms/isbn');
				break;
				default :
					HTMLRenderer::render('forms/upc-a');
				break;
			}
		}
		
		/**
		 * Process the input data to generate a barcode
		 * @return null
		 */
		public function processBarcode() {	
			if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
				$facade = new MainFacade(); 
				$data = []; 
				$data = array_merge($_POST, $data);
				extract($_POST);
				$data['result'] = $facade->getBarcode($selected_symbology, $input_data);
				HTMLRenderer::render('output/barcode', $data);
			} 
			return null;
		}
		
		/**
		 * Get the previously generated barcodes
		 * @return null
		 */
		public function getGeneratedBarcodes() {
			$facade = new MainFacade();
			$data = $facade->getBarcodes();
			HTMLRenderer::render('output/generatedBarcodes', $data);
		}

		/**
		 * Check if the request from the Browser is Asynchronous.
		 * @return boolean;
		 */
		private function _isAsynchronous() {
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
				return true;
			}
			return false;
		}
		
		/**
		 * Parse the URL request into an array.
		 * @return Array;
		 */
		private function _parseURLRequest() {
			if (isset($_GET['url'])) {
				return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
			}
			return null;
		}
		
		/**
		 * Redirect to Index and restrict any other URL request to protect from unwanted navigation.
		 * @return void;
		 */
		private function _redirectToIndex() {
			if (!$_SERVER['QUERY_STRING'] != 'url=') {
				header('Location:'.PUBLIC_URL);
				exit();
			}
		}		
		
	}
