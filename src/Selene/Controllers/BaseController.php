<?php
/**
 * @copyright   2017 - Selene
 * @author      Vinicius Oliveira <vinicius_o.a@live.com>
 * @category    Micro Framework
 * @since       2017-10-18
 */

namespace Selene\Controllers;

use Psr\Container\ContainerInterface;
use Selene\Gateway\GatewayAbstract;
use Selene\Render\View;

/**
 * Classe base para as controllers.
 */
class BaseController extends GatewayAbstract
{
    /**
     * Define a constante de injeção da view na base controller.
     */
    public const INJECT_VIEW = 'injectViewOnBaseController';

    /**
     * Define a constante de injeção do service container na base controller.
     */
    public const INJECT_SERVICE_CONTAINER = 'injectContainerOnBaseController';

    /**
     * Guarda o objeto da view.
     *
     * @var View
     */
    protected $view;

    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * Instância o objeto da view.
     */
    final public function injectViewOnBaseController(View $view): void
    {
        $this->view = $view;
    }

    /**
     * Instância o objeto de Service Container.
     */
    final public function injectContainerOnBaseController(ContainerInterface $container): void
    {
        $this->container = $container;
    }

    /**
     * Retorna objeto de render view.
     */
    protected function view(): View
    {
        return $this->view;
    }

    /**
     * Retorna objeto de Service Container.
     */
    protected function container(): ContainerInterface
    {
        return $this->container;
    }
}
