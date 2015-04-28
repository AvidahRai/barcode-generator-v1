<?php namespace BarcodeGenerator\Directory; 
	
	use \FilesystemIterator; # SPL FilesystemIterator Class

	/**
	 * This class removes every files from the directory and deletes itself.
	 * @author Avinash
	 */
	class DirectoryCleaner { 
		
		/**
		* Create a new DirectoryCleaner instance
		*/
		public function __construct() { 
			# Create the FilesystemIterator Object from Cache
			$cachePath = CACHE_URI;
			$iterator = new FilesystemIterator($cachePath, FilesystemIterator::SKIP_DOTS);
			# List all folders within the Cache
			$folders = [];
			foreach ($iterator as $folder) {
				if ($folder->isDir()){
					$folders[] = $folder->getFilename();
				}
			}
			# List all unused folders
			$unused_folders = array_diff ($folders, $_SESSION['users']);
			# Remove all unused folders and its files.
			foreach ($unused_folders as $unused_folder) { 
				$folderPath = $cachePath.DS.$unused_folder;
				$files = new FilesystemIterator($folderPath, FilesystemIterator::SKIP_DOTS);
				foreach ($files as $file) {
					if ($file->isDir()){
						rmdir($file->getRealPath());
					} else {
						unlink($file->getRealPath());
					}
				}
				rmdir($folderPath);
			}
		}
				
	}
