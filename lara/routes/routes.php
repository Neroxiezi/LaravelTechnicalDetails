<?php
$app['router']->get('/',function(){
	return 123;
});

$app['router']->get('/','App\Http\Controllers\IndexController@index');
