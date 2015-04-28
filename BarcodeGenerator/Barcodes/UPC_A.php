<?php namespace BarcodeGenerator\Barcodes;

	/**
	* UPC_A extends @see \BarcodeGenerator\Barcodes\LinearBarcode
	* @author Avinash Rai
	*/		
	class UPC_A extends LinearBarcode {
		
		/**
		 * 
		 * @param string $input_data
		 */
		function __construct($input_data) {				
			parent::__construct($input_data);				
		}
		
		/**
		 * (non-PHPdoc)
		 * @see \BarcodeGenerator\Barcodes\Barcode::isValid()
		 */
		public final function isValid() {				
			$data = $this->_data;
			if (strlen($data) == 12) {
				return $this->_calculateChecksum();
			}
			return false;				
		}
				
		/**
		 * (non-PHPdoc)
		 * @see \BarcodeGenerator\Barcodes\Barcode::getGraphic()
		 */
		public final function getGraphic() {				
			if ($this->isValid()) {
				$binary_pattern = $this->_binaryEncoding();
				return $this->_drawGraphic($binary_pattern);
			}				
		}
				
		/**
		 * (non-PHPdoc)
		 * @see \BarcodeGenerator\Barcodes\LinearBarcode::_calculateChecksum()
		 */
		protected final function _calculateChecksum() {	
			$data = $this->_data;
			$odd = 0;
			$even = 0;
			$check_digit_original = substr($data, -1);
			for ($x=0; $x < 11; $x++) {
				if ($x % 2) {
					$even += $data[$x];
				} else {
					$odd += $data[$x];
				}
			}
			$check_digit_calculated = 10 - ((($odd * 3) + $even) % 10);
			if ($check_digit_original == $check_digit_calculated) {
				return true;
			}
			return false;			
		}
				
		/**
		 * (non-PHPdoc)
		 * @see \BarcodeGenerator\Barcodes\LinearBarcode::_binaryEncoding()
		 */
		protected final function _binaryEncoding() {				
			$data = $this->_data;				
			# UPC-A Binary Encoding Values and Patterns
			$start_gaurd = '101';
			$center_guard = '01010';
			$right_guard = '101';
			$l_pattern = array('0001101','0011001','0010011','0111101','0100011','0110001','0101111','0111011','0110111','0001011');
			$r_pattern = array('1110010','1100110','1101100','1000010','1011100', '1001110','1010000','1000100','1001000','1110100');				
			# UPC-A  Encoding
			$modules_pattern = $start_gaurd;
			for ($x = 0; $x < 6; $x++) {
				$modules_pattern .= $l_pattern[ $data[$x] ];
			}
			$modules_pattern .= $center_guard;
			for ($x = 6; $x < 12; $x++) {
				$modules_pattern .= $r_pattern[ $data[$x] ];
			}
			$modules_pattern .= $right_guard;
			return $modules_pattern;							
		}
			
		/**
		 * (non-PHPdoc)
		 * @see \BarcodeGenerator\Barcodes\Barcode::_drawGraphic()
		 */
		protected final function _drawGraphic($pattern) {				
			# UPC-A Dimensions Specifications (Magnification 160%)
			$x_width = 2;
			$width = $x_width * 95;
			$left_quiet_width = $x_width * 9;
			$right_quiet_width = $x_width * 9;
			$full_width = $width + $left_quiet_width + $right_quiet_width;
			$bar_height = 138;
			$full_height = 156.80503937;		
			# EAN-13 Image Creation
			$image = ImageCreate($full_width, $full_height);
			$white = ImageColorAllocate($image, 255, 255, 255);
			$black = ImageColorAllocate($image, 0, 0, 0);	
			for ($x=0; $x < strlen($pattern); $x++) { 
				if (($x<10) || ($x>=45 && $x<50) || ($x >=85)) {  
					$extension = 10;
				} else {
					$extension = 0;
				}			
				if ( $pattern[$x] == '1' ) { 
					$color = $black; 
				} else { 
					$color = $white; 
				}
				ImageFilledRectangle($image, ($x * $x_width) + $left_quiet_width, 0 ,($x+.5) * $x_width + $left_quiet_width, $bar_height + $extension, $color);
			}		
			$font = BASE_URI.'/BarcodeGenerator/Fonts/Ocrb.ttf';
			$font_size_1 = '12.771779528';
			$font_size_2 = '15.9647244096';
			$data = $this->_data;
			imagettftext($image, $font_size_1, 0, 0, $full_height, $black, $font, $data[0]);					
			for ($x=0; $x<5; $x++) {
				imagettftext($image, $font_size_2, 0, ($x*13.5) + $left_quiet_width + 23, $full_height, $black, $font, $data[$x+1]);		
				imagettftext($image, $font_size_2, 0, ($x*13.5) + $left_quiet_width + 101, $full_height, $black, $font, $data[$x+6]);		
			}
			imagettftext($image, $font_size_1, 0, $full_width - 10, $full_height, $black, $font, $data[11]);	
			return $image;
			ImageDestroy($image);	
		}
	
	}
