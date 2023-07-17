<?php
class database
{
	var $host		= 'localhost';
	var $user		= 'root';
	var $password	= '';
	var $database	= 'db_nenomember';
	var $lastQuery;
	var $lastErr;
	var $rowCount;
	function __construct()
	{
		$result = mysql_connect($this->host, $this->user, $this->password);
		if (!$result) {
			$this->lastErr = 'Gagal koneksi ke server MySQL. Pesan error: ' . mysql_error();
		}
		$result = mysql_select_db($this->database);
		if (!$result) {
			$this->lastErr = 'Gagal koneksi ke database MySQL. Pesan error: ' . mysql_error();
		}
	}
	function select($sql)
	{
		$this->lastQuery = $sql;
		$result = mysql_query($sql);
		if (!$result) {
			$this->lastErr = 'Perintah select() gagal dilaksanakan. Pesan error: ' . mysql_error();
			return false;
		}
		$this->rowCount = mysql_num_rows($result);
		return $result;
	}
	function selectOne($sql)
	{
		$this->lastQuery = $sql;
		$result = mysql_query($sql);
		if (!$result) {
			$this->lastErr = 'Perintah selectOne() gagal dilaksanakan. Pesan error: ' . mysql_error();
			return false;
		}
		$this->rowCount = mysql_num_rows($result);
		if ($this->rowCount > 1) {
			$this->last_error = 'Perintah query pada fungsi selectOne() menghasilkan lebih dari satu record';
			return false;
		}
		if ($this->rowCount < 1) {
			$this->last_error = 'Perintah query pada fungsi selectOne() tidak menghasilkan record';
			return false;
		}
		$return = mysql_result($result, 0);
		mysql_free_result($result);
		return $return;
	}
	function getRow($result)
	{
		if (!$result) {
			$this->lastErr = 'Resource pada fungsi getRow() tidak valid. Pesan error : ' . mysql_error();
			return false;
		}
		$row = mysql_fetch_array($result);
		if (!$row) {
			return false;
		}
		return $row;
	}
	function insert($sql)
	{
		$this->lastQuery = $sql;
		$result = mysql_query($sql);
		if (!$result) {
			$this->lastErr = 'Perintah pada fungsi insertSql() gagal dilaksanakan. Pesan error : ' . mysql_error();
			return false;
		}
		$id = mysql_insert_id();
		if ($id == 0) {
			return true;
		} else {
			return $id;
		}
	}
	function update($sql)
	{
		$this->lastQuery = $sql;
		$result = mysql_query($sql);
		if (!$result) {
			$this->lastErr = 'Perintah pada fungsi updateSql() gagal dilaksanakan. Pesan error : ' . mysql_error();
			return false;
		}
		$rows = mysql_affected_rows();
		if ($rows == 0) {
			return false;
		} else {
			return $rows;
		}
	}
}
