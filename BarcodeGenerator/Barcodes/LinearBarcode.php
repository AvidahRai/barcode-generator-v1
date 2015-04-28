<?php namespace BarcodeGenerator\Barcodes;
	
	/**
	* LinearBarcode extends @see \BarcodeGenerator\Barcodes\Barcode
	* @author Avinash Rai
	*/	
	abstract class LinearBarcode extends Barcode { 
		
		/**
		 * Create a new LinearBarcode instance.
		 * @param string $input_data
		 */
		protected function __construct($input_data) {				
			parent::__construct($input_data);				
		}		
		
		/**
		 * Calculate the checksum of the barcode data. 
		 */
		protected abstract function _calculateChecksum();  
				
		/**
		 * Perform binary encoding of the barcode data.
		 */
		protected abstract function _binaryEncoding(); 
		
	}
	
	
