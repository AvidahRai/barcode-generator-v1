<?php namespace BarcodeGenerator\Barcodes; 
	
	/**
	* 
	* @author Avinash Rai
	*/
	class BarcodeFactory { 
		
		/**
		* Get a specific Barcode instance.
		* @param string $selected_symbology
		* @param string $input_data
		* @return Barcode
		*/
		public function createBarcode($selected_symbology, $input_data) { 
			$selected_symbology = strtoupper($selected_symbology);
			switch ($selected_symbology) { 
				case 'UPC-A':
					$barcode = new UPC_A($input_data); 
				break; 
				case 'UPC-E':
					$barcode = new UPC_E($input_data); 
				break;
				case 'EAN-13':
					$barcode = new EAN_13($input_data); 
				break; 
				case 'EAN-8': 
					$barcode = new EAN_8($input_data);
				break; 
				case 'ISBN':
					$barcode = new ISBN($input_data);
				break;
				default:
					$barcode = null; 
				break;
			}
			return $barcode;
		}
		
	}