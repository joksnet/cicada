<?php
/*
 *  Copyright 2013 Christian Grobmeier
 *
 *  Licensed under the Apache License, Version 2.0 (the "License");
 *  you may not use this file except in compliance with the License.
 *  You may obtain a copy of the License at
 *
 *  http://www.apache.org/licenses/LICENSE-2.0
 *
 *  Unless required by applicable law or agreed to in writing,
 *  software distributed under the License is distributed
 *  on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND,
 *  either express or implied. See the License for the specific
 *  language governing permissions and limitations under the License.
 */
namespace Cicada\Routing;

use Cicada\Application;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Router
{
    private $routeMap = [];

    public function addRoute(Route $route)
    {
        $method = $route->getMethod();

        if (!isset($this->routeMap[$method])) {
            $this->routeMap[$method] = [];
        }

        $this->routeMap[$method][] = $route;
    }

    /**
     * Routes the request, and returns a Response.
     *
     * @param  Request  $request
     * @return Response
     */
    public function route(Application $app, Request $request)
    {
        $url = $request->getPathInfo();
        $method = $request->getMethod();

        if (isset($this->routeMap[$method])) {
            /** @var $route Route */
            foreach ($this->routeMap[$method] as $route) {
                $matches = $route->matches($url);
                if ($matches !== false) {
                    return $route->run($app, $request, $matches);
                }
            }
        }

        // Return HTTP 404
        return new Response("Route not found", Response::HTTP_NOT_FOUND);
    }
}