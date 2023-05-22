<?php

namespace PavelPlot\App\Router;

use PavelPlot\App\Config;
use PavelPlot\App\Request\Request;
use PavelPlot\App\View\ViewFactory;

class Router

{
    private array $routeList = [];
    private Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Метод для объявления GET роутов в приложении
     * @param string $route
     * @param string $controller
     * @param string $method_name
     *
     * @return void
     */
    public function get(string $route, $controller, string $method_name): void
    {
        $this->routeList['GET'][] = [
            'url' => $route,
            'controller_class' => $controller,
            'method_name' => $method_name,
        ];
    }

    /**
     * Метод для объявления POST роутов в приложении
     * @param string $route
     * @param string $controller
     * @param string $method_name
     *
     * @return void
     */
    public function post(string $route, $controller, string $method_name): void
    {
        $this->routeList['POST'][] = [
            'url' => $route,
            'controller_class' => $controller,
            'method_name' => $method_name,
        ];
    }

    /**
     * Основной метод работы роутера, ищет нужный роут и вызывает соответствующий метод контроллера
     *
     * @return void
     */
    public function run()
    {
        $url = $this->request->getUrl();

        $route = $this->trackRoute($url);

        if (!$route) {
            return;
        }

        $controller = new $route['controller_class'](ViewFactory::createView(Config::get('templates_path')));
        $controller->{$route['method_name']}($this->request);
    }

    /**
     * Ищет url из реквеста в списке заданных url
     *
     * @return array|bool
     */
    private function trackRoute(): array|bool
    {
        foreach ($this->routeList[$this->request->getMethod()] as $route) {
            if ($this->request->getUrl() === $route['url']) {
                return $route;
            }
        }
        return false;
    }

}