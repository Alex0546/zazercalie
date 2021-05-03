<?php

class DBLayer {
	var $prefix;
	var $base;
	var $name;
	var $host;
    var $db_name;
    var $db;

	function DBLayer($base, $prefix = '') {
		$this->prefix = $prefix;
		$this->name = $base;
		$this->base = $this->open();
	}

	function connect($db_host, $db_user, $db_pass, $db_name, $db_port) { 
		$this->host = $db_host;
		$this->db_name = $db_name;

		$timeout = 5;
		$db = mysqli_init();
		$db->options(MYSQLI_OPT_CONNECT_TIMEOUT, $timeout);
		$db->real_connect($db_host, $db_user, $db_pass, $db_name, $db_port);

        return $db;
	}

	function open() {
		$base = $this->name;

		//$db[$base] = $this->connect($config_db[$base][0], $config_db[$base][1], $config_db[$base][2], $config_db[$base][3], $config_db[$base][4]);
		//if (isset($config_db[$base][5])) $db[$base]->set_charset($config_db[$base][5]);
		//$$base = $this;
		//return $db[$base];
	}

	function reconnect() {
		global $config_db;
		$base = $this->name;

		if ($this->host != $config_db[$base][0]) {
			trigger_error('db reconnect: '.$this->host.' != '.$config_db[$base][0], E_USER_WARNING);
			$this->host = $config_db[$base][0];
			$this->close();
			$this->open();
		} elseif ($this->$db_name != $config_db[$base][3]) {
			$this->select_db($config_db[$base][3]);
		}
	}

	function query($query, $ignore_error = false) {
		$time0 = microtime(true);
		$result = $this->base->query($query);
		$duration = microtime(true) - $time0;
		if ($duration > 1) file_put_contents("/tmp/slow.sql", gmdate("Y-m-d H:i", time() + 3600 * 3) . " [" . $duration . "] (" . $this->db_name . ") " . $query . "\n", FILE_APPEND);

		if ($result === true && stripos($query, "DELETE") === 0) return $this->affected_rows();
		if (!$ignore_error && ($result === false || (is_int($result) && $result <= 0))) $this->error($query);
		return $result;
	}

	function query_one($query) { // one row
		$r = $this->query($query.' LIMIT 1');
		return $r ? $r->fetch_assoc() : false;
	}

	function query_field($query) { // one field
		$r = $this->query($query.' LIMIT 1');
		if ($r) list($d) = $r->fetch_array(MYSQLI_NUM);
		return $d;
	}

	function query_array($query) {
		$r = $this->query($query);
		$arr = [];
		if ($r) while ($d = $r->fetch_assoc()) $arr[] = $d;
		return $arr;
	}

	function query_assoc($query, $field = false) {
		$r = $this->query($query);
		$arr = [];
		if ($field) while ($d = $r->fetch_assoc()) $arr[$d[$field]] = $d;
		else while (list($key, $val) = $r->fetch_array(MYSQLI_NUM)) $arr[$key] = $val;
		return $arr;
	}

	function result($res = 0, $row = 0) {
		$res->data_seek($row);
		$datarow = $res->fetch_array();
		return $datarow[0];
	}

	function fetch_assoc($query_id = 0) {
		return ($query_id) ? $query_id->fetch_assoc() : false;
	}

	function fetch_row($query_id = 0) {
		return ($query_id) ? $query_id->fetch_row() : false;
	}

	function num_rows($query_id = 0) {
		return ($query_id) ? $query_id->num_rows : false;
	}

	function affected_rows() {
		return ($this->base) ? $this->base->affected_rows : false;
	}

	function insert_id() {
		return ($this->base) ? $this->base->insert_id : false;
	}

	public function escape($str) {
		return $this->base->real_escape_string($str);
	}

	public function free_result($res) {
		$res->free();
	}

	function select_db($name = 0) {
		global $config_db;
		return $this->base->select_db($name ? $name : $config_db['db_default'][3]);
	}

	function begin() {$this->query("BEGIN"); return array();}

	function end($list = 0) {
		if ($list) foreach ($list as $r) if ($r <= 0) $failed = 1;
		if (!isset($failed)) {
			$this->base->commit();
			return true;
		} else {
			$this->base->rollback();
			return false;
		}
	}

	function close() {
		$this->base->close();
	}
}