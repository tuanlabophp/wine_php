<?php

class DBConnector
{
	protected $env;
	protected $connection;
	protected $host;
	protected $port;
	protected $databaseName;
	protected $username;
	protected $password;
	protected $conn;

	public function __construct()
	{
		$this->env = require_once(__BASE_DIR__ . 'env.php');
		$this->connection = $this->env['db']['connection'];
		$this->host = $this->env['db']['host'];
		$this->port = $this->env['db']['port'];
		$this->databaseName = $this->env['db']['database_name'];
		$this->username = $this->env['db']['username'];
		$this->password = $this->env['db']['password'];

		$this->initConnection();
	}

	protected function initConnection()
	{
		$this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->databaseName);
		if (!$this->conn) {
		    die("Connection failed: " . mysqli_connect_error());
		}
	}

	public function getConnection()
	{
		return $this->conn;
	}
}
