<?php

class TestClass2 {

	private $id;

	private $name;

	public function __construct($id, $name) {
		$this->id = $id;
		$this->name = $name;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 *
	 * @return mixed
	 */
	public function getName() {
		return $this->name;
	}

	/**
	 *
	 * @param mixed $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 *
	 * @param mixed $name
	 */
	public function setName($name) {
		$this->name = $name;
	}

	public function toArray() {
		return [
			'id' => $this->id,
			'name' => $this->name
		];
	}
}

