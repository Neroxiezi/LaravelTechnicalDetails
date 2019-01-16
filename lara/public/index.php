<?php
// 调用自动加载文件, 添加自动加载函数

require __DIR__.'/../vendor/autoload.php';
//实例化服务容器,注册事件,路由服务提供者

$app = new Illuminate\Container\Container;
// 通过服务容器中的 setInstance() 静态方法 将服务容器实例添加为静态属性, 这样就可以在任何位置获取服务容器实例
Illuminate\Container\Container::setInstance($app);
with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();


//启动 Eloquent ORM 模块并进行相关配置
$manager = new Illuminate\Database\Capsule\Manager();
//加入数据库配置文件
$manager->addConnection(require '../config/database.php');
$manager->bootEloquent();

//通过服务容器实例的instancce()方法 将服务名称为 config 和 Fluent的实例进行绑定,主要用于存储视图慕课的配置信息。
$app->instance('config',new Illuminate\Support\Fluent());
//配置模板编译目录路径
$app['config']['view.compiled'] = "D:\\phpStudy\\WWW\\test\\lara\\storage\\framework\\views";
$app['config']['view.paths'] = ["D:\\phpStudy\\WWW\\test\\lara\\resources\\views"];
with(new Illuminate\View\ViewServiceProvider($app))->register();
with(new Illuminate\Filesystem\FilesystemServiceProvider($app))->register();


//加载路由
require __DIR__ .'/../routes/routes.php';

//实例化请求并分发处理请求
$request = Illuminate\Http\Request::createFromGlobals();
$response = $app['router']->dispatch($request);

//返回请求想要
$response->send();
