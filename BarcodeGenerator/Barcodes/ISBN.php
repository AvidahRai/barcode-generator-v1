<?php namespace BarcodeGenerator\Barcodes;
	
	/**
	* ISBN extends @see \BarcodeGenerator\Barcodes\LinearBarcode
	* @author Avinash Rai
	*/	
	class ISBN extends LinearBarcode {
		
		/**
		 * Create a new LinearBarcode instance.
		 * @param string $input_data
		 * @return void;
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
			$valid_prefix = array('978', '979');				
			if ( strlen($data)==10 || strlen($data) == 13 ) { # Must be 10 or 13 Digit Long
				if ( strlen($data) == 13) {
					$prefix = substr($data, 0, 3);
					if ( !in_array($prefix, $valid_prefix) ) { # For 13 digits the prefix must be either '978' or '979'
						return false;
					}
				}
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
			$data = $this->_data;//$data = $this->getData();
			switch ( strlen($data) ) {
				case 10: # ISBN-10 Check Digit Verification
					$check_digit_original = substr($data, -1);
					$sum = 0;
					$weight = 10;
					for ($x = 0; $x < 9; $x++) {
						$sum += $data[$x] * $weight;
						$weight--;
					}
					$check_digit_calculated = (11 - ($sum % 11)) % 11;
					if ($check_digit_original == $check_digit_calculated) {
						return true;
					}
					return false;
					break;
				case 13: # ISBN-13 Check Digit Verification
					$twelve_digits = substr($data , 0 , 12);
					$check_digit_original = substr($data, -1);
					$odd = 0;
					$even = 0;
					for ($x=0; $x < 12; $x++) {
						if ($x % 2) {
							$even += $twelve_digits[$x] * 3;
						} else {
							$odd += $twelve_digits[$x];
						}
					}
					$check_digit_calculated = 10 - (($odd + $even) % 10);
					if ($check_digit_original == $check_digit_calculated) {
						return true;
					}
					return false;
					break;
				default:
					return false;
					break;
			}				
		}
				
		/**
		 * (non-PHPdoc)
		 * @see \BarcodeGenerator\Barcodes\LinearBarcode::_binaryEncoding()
		 */
		protected final function _binaryEncoding() {			
			$data = $this->_data;//$data = $this->getData();
			if (strlen($data) == 10) {
				$data = '978'.$data;
			}				
			# EAN-13 Binary Encoding Values and Patterns
			$start_gaurd = '101';
			$center_guard = '01010';
			$right_guard = '101';
			$left_structure = array('LLLLLL', 'LLGLGG', 'LLGGLG','LLGGGL','LGLLGG','LGGLLG', 'LGGGLL','LGLGLG', 'LGLGGL', 'LGGLGL');
			$right_structure = array('RRRRRR', 'RRRRRR', 'RRRRRR','RRRRRR','RRRRRR','RRRRRR', 'RRRRRR','RRRRRR', 'RRRRRR', 'RRRRRR');
			$l_pattern = array('0001101', '0011001', '0010011','0111101','0100011','0110001', '0101111','0111011', '0110111', '0001011');
			$g_pattern = array('0100111', '0110011','0011011','0100001', '0011101','0111001', '0000101','0010001','0001001', '0010111');
			$r_pattern = array('1110010','1100110', '1101100', '1000010','1011100','1001110','1010000','1000100','1001000', '1110100');		
			# EAN-13 Encoding
			$pattern = $left_structure[$data[0]] . $right_structure[$data[0]];
			$modules_pattern = $start_gaurd;
			for ($x = 0; $x < 6; $x++) {
			if ($pattern[$x] == 'L') {
				$modules_pattern .= $l_pattern[$data[$x+1]];
				} else {
				$modules_pattern .= $g_pattern[$data[$x+1]];
				}
			}
			$modules_pattern .= $center_guard;
			for ($x = 6; $x < 12; $x++) {
				$modules_pattern .= $r_pattern[$data[$x+1]];
			}
			$modules_pattern .= $right_guard;
			return $modules_pattern;			
		}
		
		/**
		 * (non-PHPdoc)
		 * @see \BarcodeGenerator\Barcodes\Barcode::_drawGraphic()
		 */
		protected final function _drawGraphic($pattern) {				
			# EAN-13 Dimensions Specifications (Magnification 160%)
			$x_width = 2;
			$width = $x_width * 95;
			$left_quiet_width = $x_width * 11;
			$right_quiet_width = $x_width * 7;
			$full_width = $width + $left_quiet_width + $right_quiet_width;
			$bar_height = 138;
			$full_height = 156.80503937;			
			# EAN-13 Image Creation
			$image = ImageCreate($full_width, $full_height);
			$white = ImageColorAllocate($image, 255, 255, 255);
			$black = ImageColorAllocate($image, 0, 0, 0);	
			for ($x=0; $x < strlen($pattern); $x++) { 
				if (($x<3) || ($x>=45 && $x<50) || ($x >91)) { 
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
			$font_size = 16.62992126;
			$data = $this->_data;
			imagettftext($image, $font_size, 0, 0, $full_height, $black, $font, $data[0]);					
			for ($x=0; $x<6; $x++) {
				imagettftext($image, $font_size, 0, ($x*14) + $left_quiet_width + 7, $full_height, $black, $font, $data[$x+1]);		
				imagettftext($image, $font_size, 0, ($x*14) + $left_quiet_width + 99, $full_height, $black, $font, $data[$x+7]);		
			}
			imagettftext($image, $font_size, 0, $full_width-14, $full_height, $black, $font, '>');	
			return $image;
		}			
	
	}