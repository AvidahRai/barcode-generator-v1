<?php namespace BarcodeGenerator\Barcodes;	

	/**
	* UPC_E extends @see \BarcodeGenerator\Barcodes\LinearBarcode
	* @author Avinash Rai
	*/		
	class UPC_E extends LinearBarcode {
		
		/**
		 * Create a new LinearBarcode instance.
		 * @param string $input_data
		 * @return void;
		 */
		function __construct($input_data) {	
			parent::__construct($input_data);
		}
		
		/**
		 * @see \BarcodeGenerator\Barcodes\Barcode::isValid()
		 */
		public final function isValid() {
		
			return false;
		}
		
		/**
		 * @see \BarcodeGenerator\Barcodes\Barcode::getGraphic()
		 */
		public final function getGraphic() { 
			
			
		}
		
		/**
		 * @see \BarcodeGenerator\Barcodes\LinearBarcode::_calculateChecksum()
		 */
		protected final function _calculateChecksum() { 
			
			
		}	
			
		/**
		 * @see \BarcodeGenerator\Barcodes\LinearBarcode::_binaryEncoding()
		 */
		protected final function _binaryEncoding() { 
			
			
		}
		
		/**
		 * @see \BarcodeGenerator\Barcodes\Barcode::_drawGraphic()
		 */
		protected final function _drawGraphic($pattern) {
			$font = BASE_URI.'/BarcodeGenerator/Fonts/Ocrb.ttf';	
		}		
	
	}
