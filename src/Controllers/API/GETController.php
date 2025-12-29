<?php

namespace App\Controllers\API;

use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Models\Services\APIService;

class GETController extends Controller {
	#[RouteAttribute(
		path: "/api",
		name: "app_api_index_get",
		method: "GET",
		description: "API index page",
	)]

	public function render(): void {
		$data = [
			"name" => APP_NAME,
			"version" => TEMPORA_VERSION,
		];

		(new APIService)
			->setStatusCode(statusCode: 200)
			->setData(data: $data)
			->render()
		;
	}
}
