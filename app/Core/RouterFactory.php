<?php

declare(strict_types=1);

namespace App\Core;

use Nette;
use Nette\Application\Routers\RouteList;


final class RouterFactory
{
	use Nette\StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList();

		$router->addRoute('pet/list/findByStatus', 'Pet:list');
		$router->addRoute('pet/add', 'Pet:add');
		$router->addRoute('pet/edit/<id>', 'Pet:edit');
		$router->addRoute('pet/delete/<id>', 'Pet:delete');

		$router->addRoute('<presenter>/<action>[/<id>]', 'Pet:list');

		return $router;
	}
}
