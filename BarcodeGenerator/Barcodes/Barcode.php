<?php namespace BarcodeGenerator\Barcodes; 
	
	/**
	* @author Avinash Rai
	*/
	abstract Class Barcode { 
		
		protected $_data;
		
		/**
		 * Create a new Barcode instance. 
		 * @param string $input_data
		 * @return void
		 */
		protected function __construct($input_data) { 
			$this->_data = $input_data;
		}
		
		/**
		 * Get the value of the data; 
		 * @return string
		 */
		public function getData() { 
			return $this->_data;			
		}
		
		/**
		 * Check the validity of barcode data.
		 */
		public abstract function isValid(); 
		
		/**
		 * Get the raster graphic of the Barcode. 
		 */
		public abstract function getGraphic();
		
		/**
		 * Create the raster graphic of the Barcode.
		 * @param string $pattern
		 */
		protected abstract function _drawGraphic($pattern); 
		
	}
	
