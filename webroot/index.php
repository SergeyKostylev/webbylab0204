<?php

define('DS',DIRECTORY_SEPARATOR);
define('ROOT', __DIR__ . DS . '..' . DS . 'src' . DS);
define('VIEW_DIR', ROOT . 'View' . DS);
define('VENDOR_DIR', ROOT . '..' . DS . 'vendor' . DS);
define('CONF_DIR', ROOT . '..' . DS . 'config' . DS);

require VENDOR_DIR . 'autoload.php';

try{

    $config = Symfony\Component\Yaml\Yaml::parse(file_get_contents(CONF_DIR . 'config.yml'));
    $parameters = $config['parameters'];
    $routing = $config['routing'];

    $dsn = "mysql: host={$parameters['database_host']}; dbname={$parameters['database_name']}";

    \Framework\Session::start();

    $loader = new \Twig_Loader_Filesystem(VIEW_DIR);
    $twig = new \Twig_Environment($loader);

    $dbconnection = new \PDO(
            $dsn,
            $parameters['database_user'],
            $parameters['database_password']
           );

    $dbconnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    $router = new Framework\Router($routing);
    $conteiner = new Framework\Conteiner();

    $router->generateUrl($routing);

    $repositoryFactory = new Framework\RepositoryFactory();
    $repositoryFactory->setPdo($dbconnection);
    $twig->addExtension(new \Framework\Twig\AppExtension($router));


    $conteiner
        ->set('pdo',$dbconnection)
        ->set('router',$router)
        ->set('repositoryFactory',$repositoryFactory)
        ->set('twig', $twig)
    ;

    $request = new \Framework\Request($_GET, $_POST, $_SERVER, $_FILES);

    $router->match($request);

    $controller = '\\Controller\\' . $router->getCurrentController();
    $action = $router->getCurrentAction();

    $controller = new $controller($dbconnection);
    $controller->setConteiner($conteiner);

    $content =  $controller->$action($request);

}
catch (\Framework\Exception\NotFoundException $e){
    $controller = new \Controller\ErrorController($e);
    $controller->setConteiner($conteiner);
    $content = $controller->error404Action();
}catch (\Exception $e){
//    dump($e);
    $controller = new \Controller\ErrorController($e);
    $controller->setConteiner($conteiner);
    $content = $controller->errorAction();
}

echo $content;

