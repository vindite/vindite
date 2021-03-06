<?php
/**
 * @copyright   2019 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2019-02-16
 */

namespace Selene\Routes\Http;

use Selene\Routes\RouteConstant;
use Selene\Routes\RouteException;
use Selene\Routes\RouteAwareResolveCallbackTrait;

/**
 * Reponsável por adicionar rotas a fila do roteador
 */
abstract class HttpAbstract
{
    use RouteAwareResolveCallbackTrait;

    /**
     * Adiciona uma rota a fila de rotas
     *
     * @param array $queue
     * @param string $resource
     * @param mixed $callback
     *
     * @return array
     */
    public function resolve($routeType, array $queue, string $resource, $callback = null) : array
    {
        if (empty($routeType)) {
            throw new RouteException("Método HTTP desconhecido", 404);
        }

        if (empty($resource)) {
            throw new RouteException("Recurso não encontrado", 404);
        }

        $this->resolveCallback($callback);

        if ($this->isCallable()) {
            $queue[] = [
                $routeType => [
                    RouteConstant::ROUTE_RESOURCE => $resource,
                    RouteConstant::ROUTE_CALLBACK => $callback
                ]
            ];

            return $queue;
        }

        if (empty($this->getController())) {
            throw new RouteException("Controller não encontrada", 404);
        }

        if (empty($this->getMethod())) {
            throw new RouteException("Ação da controller não encontrada", 404);
        }

        $queue[] = [
            $routeType => [
                RouteConstant::ROUTE_RESOURCE => $resource,
                RouteConstant::ROUTE_CLASS    => $this->getController(),
                RouteConstant::ROUTE_ACTION   => $this->getMethod()
            ]
        ];

        return $queue;
    }
}
