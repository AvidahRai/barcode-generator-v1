<?php namespace BarcodeGenerator\Core; 

	use \BarcodeGenerator\Directory\Directory; 
	use \BarcodeGenerator\Barcodes\BarcodeFactory;
	
	/**
	* The MainFacade Class
	* @author Avinash Rai
	*/
	class MainFacade { 
		
		private $_directory; 
		
		private $_barcodeFactory; 
		
		/**
		 * Create a new MainFacade Instance
		 */
		function __construct() { 
			$this->_directory = new Directory(); 
		}
		
		/**
		 * Returns the results in a specific array format. 
		 * - The key 'success' => boolean :- Represents the outcome of the process.
		 * - The key 'value' => string :- Represents the returned value.
		 * @param string $selected_symbology
		 * @param string $input_data
		 * @return array
		 */
		public function getBarcode($selected_symbology, $input_data) { 
			if ( $this->_directory->hasFile($input_data) ) {
				return array(
					'success' => true, 
					'value' => $this->_directory->getFile($input_data, DIRECTORY::FETCH_URL)	
				);
			} else { 
				$this->_barcodeFactory = new BarcodeFactory(); 
				$barcode = $this->_barcodeFactory->createBarcode($selected_symbology, $input_data);
				if ($barcode->isValid()) { 
					$barcode_graphic = $barcode->getGraphic();
					$this->_storeBarcode($barcode_graphic, $input_data);
					return array(
						'success' => true,
						'value' => $this->_directory->getFile($input_data, DIRECTORY::FETCH_URL)
					);					
				} else { 
					return array(
						'success' => false,
						'value' => "The provided input: '$input_data' is not valid for $selected_symbology."
					);
				}	
			}
		}
		
		/**
		 * Returns all filenames 
		 * @return mixed
		 */
		public function getBarcodes() {
			if ($this->_directory->hasFiles()) {  
				return $this->_directory->getFiles(DIRECTORY::FETCH_URL);
			} else {
				return null;
			}
		}
		
		/**
		 * Convert the raster graphic data to a JPEG file
		 * @param raster graphic $raster_graphic
		 * @param string $path
		 * @return void
		 */
		private function _storeBarcode($raster_graphic, $input_data) { 
			$file_name = $this->_directory->getPath().DS.$input_data.'.jpg'; 
			ImageJpeg($raster_graphic, $file_name, 100); 
			ImageDestroy($raster_graphic);
			$this->_directory = new Directory();
		}
	
	}
