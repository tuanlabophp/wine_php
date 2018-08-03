<?php

require_once(__BASE_DIR__ . 'app/Repositories/WineRepo.php');

class HomeController
{
	static protected $wineRepo;

	// public static function __construct()
	// {
	// 	static::wineRepo = new WineRepo();
	// }

	public static function index()
	{
		$wineRepo = new WineRepo();
		$wines = $wineRepo->all();
		include(__BASE_DIR__ . 'resources/views/wine/index.php');
	}

	public static function store()
	{
		if (!self::checkEmpty($_POST)) {
			echo json_encode([
				'success' => false,
				'errors' => [
					'Some field is empty!'
				]
			], 400);
		} else {
			$wineRepo = new WineRepo();
			try {
				$wine = $wineRepo->store($_POST);
				echo json_encode([
					'success' => true,
					'data' => [
						'record' => $wine[0]
					]
				], 200);
			} catch (\Exception $ex) {
				echo json_encode([
					'success' => false,
					'errors' => [
						'Unexpected Error!'
					]
				], 400);
			}
		}

	}

	public static function delete()
	{
		$id = $_POST['id'];
		try {
			$wineRepo = new WineRepo();
			$wineRepo->delete($id);
			echo json_encode([
				'success' => true
			], 200);
		} catch (\Exception $ex) {
			echo json_encode([
				'success' => false,
				'errors' => [
					'Unexpected Error!'
				]
			], 400);
		}
	}

	protected static function checkEmpty($data)
	{
		foreach ($data as $key => $value) {
			if (empty($value)) {
				return false;
			}
		}

		return true;
	}
}
