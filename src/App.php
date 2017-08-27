<?php
/**
 * User: Script
 * Date: 24.08.2017
 * Time: 21:36
 */

namespace Geega\Simplex;


use Geega\NativeTemplate\Template;
use Geega\Request\Request;
use Geega\Response\Response;

class App
{
    public static function init()
    {
        MSO::set('Request', new Request());
        MSO::set('Router', new Router(new Request()));
        MSO::set('Response', new Response());
        MSO::set('Tpl', new Template(TPL_DIR));
    }

    public function run()
    {
        $router = MSO::get('Router');
        /** @var Router $currentRouter */
        $currentRouter = $router->getCurrent();
        $controllerName = $currentRouter->getCurrentController();
        $controllerMethodName = $currentRouter->getCurrentMethod();

        $controller = new $controllerName;
        /** @var Response $response */
        $response = $controller->{$controllerMethodName}();
        $response->render();
    }
}