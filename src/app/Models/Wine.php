<?php

class Wine
{
	public $id;
	public $name;
	public $price;
	public $brand;
	public $status;
	public $createdAt;
	public $updatedAt;

	public function __construct(...$args)
	{
		$this->id = $args[0]['id'];
		$this->name = $args[0]['name'];
		$this->price = $args[0]['price'];
		$this->brand = $args[0]['brand'];
		$this->status = $args[0]['status'];
		$this->createdAt = $args[0]['created_at'];
		$this->updatedAt = $args[0]['updated_at'];
	}

	public function __get($property) {
		if (property_exists($this, $property)) {
		  return $this->$property;
		}
	}

	public function __set($property, $value) {
		if (property_exists($this, $property)) {
		  $this->$property = $value;
		}

		return $this;
	}
}
