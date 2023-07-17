<?php
class combo {
	var $monthName;
	function __construct() {
		$this->monthName = array(1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'Nopember', 'Desember');
	}
	private function preCombo($var) {
		echo "<select name=".$var.">";
	}
	private function preComboAuto($var) {
		echo "<select name=".$var." onChange='this.form.submit()'>";
	}
	private function inCombo($value, $option) {
		echo "<option value=".$value.">".$option."</option>";
	}
	private function inComboSelected($value, $option) {
		echo "<option value=".$value." selected>".$option."</option>";
	}
	private function finalCombo() {
		echo "</select>";
	}	
	function comboRange($first, $last, $var, $default) {
		$this->preCombo($var);
		$state = false;
		for ($i=$first; $i<=$last; $i++) {
			if ($i==$default) {
				$state = true;
				break;
			}
		}
		if ($state) {
			for ($i=$first; $i<=$last; $i++) {
				if ($i==$default)
					$this->inComboSelected($i, $i);
				else 
					$this->inCombo($i, $i);
			}
		}
		else {
			$this->inComboSelected($default, $default);
			for ($i=$first; $i<=$last; $i++) 
				$this->inCombo($i, $i);
		}
		$this->finalCombo();
	}
	function comboArray($array, $var, $default, $auto='') {
		$state = false;
		if ($auto == '')
			$this->preCombo($var);
		else
			$this->preComboAuto($var);
		foreach($array as $key=>$value) {
			if ($value == $default) {
				$state = true;
				break;
			}
		}
		if ($state) {
			foreach ($array as $key=>$value) {
				if ($value == $default) {
					$this->inComboSelected($default, $default);
				}
				else {
					$this->inCombo($value, $value);
				}
			}
		}
		else {
			$this->inComboSelected($default, $default);
			foreach ($array as $key=>$value) {
				$this->inCombo($value, $value);
			}
		}
		$this->finalCombo();
	}
	function comboDb($sql, $var, $value, $option, $default, $auto='') {
		$query1 = mysql_query($sql);
		$state = false;		
		if ($auto == '')
			$this->preCombo($var);
		else
			$this->preComboAuto($var);
		while ($result = mysql_fetch_array($query1)) {
			if ($result[$option] == $default) {
				$state = true;
				break;
			}
		}
		$query2 = mysql_query($sql);
		if ($state) {
			while ($result = mysql_fetch_array($query2)) {
				if ($result[$option] == $default) 
					$this->inComboSelected($result[$value], $result[$option]);
				else 
					$this->inCombo($result[$value], $result[$option]);			
			}
		}
		else {
			$this->inComboSelected($default, $default);
			while ($result = mysql_fetch_array($query2)) {
				$this->inCombo($result[$value], $result[$option]);
			}
		}
		$this->finalCombo();
	}
	function comboMonth($first, $last, $var, $default) {
		$this->preCombo($var);
		for ($i=$first; $i<=$last; $i++) {
			if ($i==$default)
				$this->inComboSelected($i, $this->monthName[$i]);
			else
				$this->inCombo($i, $this->monthName[$i]);
		}
		$this->finalCombo();
	}
}
?>