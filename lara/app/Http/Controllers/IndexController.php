<?php

namespace App\Http\Controllers;
use App\Models\Menu;
class IndexController  
{
	public function index() {
		$menu = Menu::first();
		$data = $menu->getAttributes();
		$app = \Illuminate\Container\Container::getInstance();
		$factory = $app->make('view');
		return $factory->make('index')->with('data',$data);
	}
}