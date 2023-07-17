<?php
class fileUpload {
	var $aFile;
	function __construct($aFile) {
		$this->aFile = $aFile;
	}
	function getFileType() {
		return $_FILES[$this->aFile]['type'];
	}
	function getFileLocation() {
		return $_FILES[$this->aFile]['tmp_name'];
	}
	function getFileName() {
		return $_FILES[$this->aFile]['name'];
	}
	function getFileSize() {
		return $_FILES[$this->aFile]['size'];
	}
	function getPixel() {
		return GetImageSize($this->getFileLocation());
	}
	function checkImageType() {
		$type = $this->getFileType();
		if (($type != 'image/gif') && 
			($type != 'image/jpeg') &&
			($type != 'image/jpg') &&
			($type != 'image/pjpeg') &&
			($type != 'image/png'))  {
			return false;
		}
		else {
			return true;
		}
	}
	function bToKB() {
		$kb = $this->getFileSize() / 1024;
		return round($kb).' KB';
	}
	function bToMB() {
		$mb = $this->bToKB() / 1024;
		return round($mb, 1).' MB';
	}
	function convertFileSize() {
		if ($this->getFileSize() <= 1048576) 
			$result = $this->bToKB();
		else
			$result = $this->bToMB();
		return $result;
	}
}
?>