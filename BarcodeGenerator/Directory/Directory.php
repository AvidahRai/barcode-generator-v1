<?php namespace BarcodeGenerator\Directory;
	
	use \FilesystemIterator; # SPL FilesystemIterator Class
	
	/**
	*
	* @author Avinash Rai
	*/
	class Directory { 
		
		private $_path;
		
		private $_files; 
		
		const FETCH_URI = 0;
		
		const FETCH_URL = 1;
		
		/**
		 * Create a new Directory instance.
		 */
		function __construct() { 
			$this->_path = CACHE_URI . $_SERVER['REMOTE_ADDR'];
			if ( !file_exists($this->_path)) {
				mkdir($this->_path, 0777, true);
			}
			$this->_files = [];
			$iterator = new FilesystemIterator($this->_path, FilesystemIterator::SKIP_DOTS);
			if ($iterator->valid()) { 
				foreach ($iterator as $file) {
					if ($file->isFile() && ($file->getExtension() == 'jpg')) {
						$this->_files[$file->getBasename('.jpg')] = array( 'path' => $file->getFilename(), 'modified_time' => $file->getMTime() );
					}
				}
			}
		}

		/**
		 * Returns the full path name of the directory.
		 * @return string
		 */
		public function getPath() { 
			return $this->_path; 		
		}

		/**
		 * Returns either URI or URL location of all the choosen file from the Cache directory.
		 * @param string $file_name
		 * @param const $fetch_mode
		 * @return string
		 */
		public function getFile($file_name, $fetch_mode) {
			switch ($fetch_mode) {
				case 0:
					return $this->getPath().DS.$this->_files[$file_name]['path'];
					break;
				case 1:
					return CACHE_URL.$_SERVER['REMOTE_ADDR'].DS.$this->_files[$file_name]['path'];
					break;
				default:
					return CACHE_URL.$_SERVER['REMOTE_ADDR'].DS.$this->_files[$file_name]['path'];
					break;
			}
		}

		/**
		 * Returns either URI or URL location of all the files in the Cache directory.
		 * @param const $fetch_mode
		 * @return multitype:string
		 */
		public function getFiles($fetch_mode) {
			$this->_sortFiles();
			switch ($fetch_mode) {
				case 0:
					$fileURIpath = [];
					foreach ($this->_files as $file) {
						$fileURIpath[] = $this->getPath().DS.$file['path'];
					}
					return $fileURIpath;
					break;
				case 1:
					$fileURLpath = [];
					foreach ($this->_files as $file) {
						$fileURLpath[] = CACHE_URL.$_SERVER['REMOTE_ADDR'].DS.$file['path'];
					}
					return $fileURLpath;
					break;
				default:
					$fileURLpath = [];
					foreach ($this->_files as $file) {
						$fileURLpath[] = CACHE_URL.$_SERVER['REMOTE_ADDR'].DS.$file['path'];
					}
					return $fileURLpath;
					break;
			}
		}		
		
		/**
		 * Checks if the given file exists in the directory.
		 * @param string $file_name
		 * @return boolean
		 */
		public function hasFile($file_name) {
			if (array_key_exists($file_name, $this->_files)) {
				return true;
			}
			return false;
		}

		/**
		 * Check if the directory has files
		 * @return boolean
		 */
		public function hasFiles() {
			return (count($this->_files) > 0) ? true : false;
		}
				
		/**
		 * Sort the files in the directory by modified time.
		 * @return boolean
		 */
		private function _sortFiles() {
			uasort($this->_files, function ($x, $y) { return ($x['modified_time'] > $y['modified_time']); });
		}
	
	}
	
