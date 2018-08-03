<?php

$env = require_once(__BASE_DIR__ . 'database/DBConnector.php');
$env = require_once(__BASE_DIR__ . 'app/Models/Wine.php');

class WineRepo
{
	protected $table = 'wine';
	protected $connector;

	public function __construct()
	{
		$this->connector = new DBConnector();
	}

	public function all()
	{
		$conn = $this->connector->getConnection();
		$sql = "SELECT * FROM `wine`";
		$queryResult = $conn->query($sql);

		if ($queryResult->num_rows > 0) {
			$result = [];
		    // output data of each row
		    while($row = $queryResult->fetch_assoc()) {
		    	$wine = new Wine($row);
		    	array_push($result, $wine);
		    }
		} else {
		    echo "0 results";
		}

		return $result;
	}

	public function store($params)
	{
		try {
			$conn = $this->connector->getConnection();
			$sql = "INSERT INTO wine(name, price, brand, created_at, updated_at) VALUES ('"
				. $params['name'] . "', '". $params['price'] . "', '". $params['brand'] . "', '"
				. date("Y/m/d") . "', '". date("Y/m/d") . "');";
			$conn->query($sql);
			$lastId = $conn->insert_id;
			return $this->findById($lastId);
		} catch (\Exception $ex) {
			throw $ex;
		}
	}

	public function delete($id)
	{
		try {
			$conn = $this->connector->getConnection();
			$sql = "DELETE FROM wine where id=" . $id . ";";
			$conn->query($sql);
		} catch (\Exception $ex) {
			throw $ex;
		}
	}

	public function findById($id)
	{
		$conn = $this->connector->getConnection();
		$sql = "SELECT * FROM `wine` WHERE id=" . $id;
		$queryResult = $conn->query($sql);

		if ($queryResult->num_rows > 0) {
			$result = [];
		    // output data of each row
		    while($row = $queryResult->fetch_assoc()) {
		    	$wine = new Wine($row);
		    	array_push($result, $wine);
		    }
		} else {
		    echo "0 results";
		}

		return $result;
	}
}
