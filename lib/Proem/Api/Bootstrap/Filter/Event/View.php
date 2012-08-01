<?php

/**
 * The MIT License
 *
 * Copyright (c) 2010 - 2012 Tony R Quilkey <trq@proemframework.org>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */


/**
 * @namespace Proem\Api\Bootstrap\Filter\Event
 */
namespace Proem\Api\Bootstrap\Filter\Event;

use Proem\Service\Manager\Template as Manager,
    Proem\Bootstrap\Signal\Event\View as Event,
    Proem\Service\Asset\Standard as Asset,
    Proem\View\Provider\Twig\View as TwigView,
    Proem\Api\Filter\Event\Generic as FilterEvent;

/**
 * The default "View" filter event.
 */
class View extends FilterEvent
{
    /**
     * WIP:
     *
     * Currently this method triggers a proem.pre.in.view event then checks to see
     * if the response is a Proem\View\Template implementation.
     *
     * If so, it will load that implementation as the View.
     *
     * If not, a default Twig View will eventually be loaded via the inBound event.
     *
     * Eventually I would like to see the default Twig View replaced by a simple PHP
     * rendering template engine.
     *
     * I would also like to move all of this Twig stuff into a third party repo and make
     * it a plugin. For the moment though, it's staying here.
     *
     * ->attachEventListener([
     *     'name' => 'proem.pre.in.view',
     *     'callback' => function($event) {
     *         return $event->setProvider('SomeTemplateEngine')
     *             ->setPath('../templates');
     *     }
     * ]);
     */
    public function preIn(Manager $assets)
    {
        if ($assets->provides('events', 'Proem\Signal\Manager\Template')) {
            $assets->get('events')->trigger([
                'name'      => 'proem.pre.in.view',
                'params'    => [],
                'target'    => $this,
                'method'    => __FUNCTION__,
                'event'     => new Event,
                'callback'  => function($response) use ($assets) {
                    if ($response instanceof Event) {
                        if ($response->getProvider() instanceof Asset && $response->getProvider()->provides('Proem\View\Template')) {
                            $assets->set('view', $response->getProvider());
                        }
                    }
                },
            ]);
        }
    }

    /**
     * Method to be called on the way into the filter.
     *
     * If no other Proem\View\Template has been configured at this stage, this
     * method sets up a default Twig View. Eventually I would like this replaced
     * by a PHP rendering View provider.
     *
     * This default still requires some interaction from the user, namely
     * they must tell Twig where there templates are stored.
     *
     *
     * ->attachEventListener([
     *     'name' => 'proem.in.view',
     *     'callback' => function($event) {
     *         return $event->setPath('../templates');
     *     }
     * ]);
     *
     * @param Proem\Api\Service\Manager\Template $assets
     */
    public function inBound(Manager $assets)
    {
        if (!$assets->provides('Proem\View\Template')) {

            /**
             * Load Twig as a default View provider.
             */
            $event = (new Event)->setProvider('Twig');

            $assets->get('events')->trigger([
                'name'      => 'proem.in.view',
                'params'    => [],
                'target'    => $this,
                'method'    => __FUNCTION__,
                'event'     => $event,
                'callback'  => function($response) use ($assets) {
                    if ($response->getPath()) {
                        if (ucfirst(strtolower($response->getProvider())) == 'Twig') {

                            $asset = new Asset;
                            $asset->set('Proem\View\Template', $asset->single(function() use ($response) {

                                require_once realpath(__DIR__) . '/../../../../../../vendor/twig/twig/lib/Twig/Autoloader.php';
                                \Twig_Autoloader::register();
                                return (new TwigView)->setProvider(
                                    new \Twig_Environment(new \Twig_Loader_Filesystem($response->getPath()))
                                );

                            }));

                            $assets->set('view', $asset);
                        }
                    }
                }
            ]);
        }
    }

    /**
     * Called after outBound.
     *
     * @param Proem\Api\Service\Manager\Template $assets
     * @triggers Proem\Api\Bootstrap\Signal\Event\Bootstrap proem.post.in.view
     */
    public function postIn(Manager $assets)
    {
        if ($assets->provides('events', 'Proem\Signal\Manager\Template')) {
            $assets->get('events')->trigger([
                'name'      => 'proem.post.in.view',
                'params'    => [],
                'target'    => $this,
                'method'    => __FUNCTION__,
                'event'     => new Event,
                'callback'  => function($response) {},
            ]);
        }
    }

    /**
     * Called prior to outBound.
     *
     * @param Proem\Api\Service\Manager\Template $assets
     * @triggers Proem\Api\Bootstrap\Signal\Event\Bootstrap proem.pre.out.view
     */
    public function preOut(Manager $assets)
    {
        if ($assets->provides('events', 'Proem\Signal\Manager\Template')) {
            $assets->get('events')->trigger([
                'name'      => 'proem.pre.out.view',
                'params'    => [],
                'target'    => $this,
                'method'    => __FUNCTION__,
                'event'     => new Event,
                'callback'  => function($response) {},
            ]);
        }
    }

    /**
     * Method to be called on the way out of the filter.
     *
     * @param Proem\Api\Service\Manager\Template $assets
     */
    public function outBound(Manager $assets)
    {

    }

    /**
     * Called after outBound.
     *
     * @param Proem\Api\Service\Manager\Template $assets
     * @triggers Proem\Api\Bootstrap\Signal\Event\Bootstrap proem.post.out.view
     */
    public function postOut(Manager $assets)
    {
        if ($assets->provides('events', 'Proem\Signal\Manager\Template')) {
            $assets->get('events')->trigger([
                'name'      => 'proem.post.out.view',
                'params'    => [],
                'target'    => $this,
                'method'    => __FUNCTION__,
                'event'     => new Event,
                'callback'  => function($response) {},
            ]);
        }
    }
}
