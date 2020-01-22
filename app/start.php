<?php

use DI\ContainerBuilder;
use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;

//DI
$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
  Engine::class => function() {
    return new Engine('../app/views');
  },
  QueryFactory::class => function(){
    return new QueryFactory('mysql');
  },
  PDO::class => function(){
    require '../dbPass.php';
    return new PDO("mysql:host=$host; dbname=$db_name", $db_user, $db_pass);
  }
]);
$container = $containerBuilder->build();

//РОУТИНГ
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
  $r->addRoute('GET', '/', ["App\Controllers\HomeController", "tasks"]);
  $r->addRoute('GET', '/tasks', ["App\Controllers\HomeController", "tasks"]);
  $r->addRoute('GET', '/tasks/{id}', ["App\Controllers\HomeController", "show"]);
  $r->addRoute('GET', '/create', ["App\Controllers\HomeController", "create"]);
  $r->addRoute('POST', '/createTask_h', ["App\Controllers\HomeController", "createTask_h"]);
  $r->addRoute('GET', '/edit/{id}', ["App\Controllers\HomeController", "edit"]);
  $r->addRoute('POST', '/editTask_h', ["App\Controllers\HomeController", "editTask_h"]);
  $r->addRoute('GET', '/delete/{id}', ["App\Controllers\HomeController", "deleteTask_h"]);
  // {id} must be a number (:\d+)
  // $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
  // The /{title} suffix is optional
  // $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
  $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);


//call_user_func ДИСПЕТЧЕР
$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
  case FastRoute\Dispatcher::NOT_FOUND:
    // ... 404 Not Found
    echo "404 | ERROR";
    break;
  case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
    $allowedMethods = $routeInfo[1];
    // ... 405 Method Not Allowed
    echo "405 Method Not Allowed";
    break;
  case FastRoute\Dispatcher::FOUND:
    $handler = $routeInfo[1];
    $vars = $routeInfo[2];
    // ... call $handler with $vars
    
    //ЗАВИСИМОСТИ
    $container->call($handler, $vars);
    break;
}
?>