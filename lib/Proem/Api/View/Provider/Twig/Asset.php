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
 * @namespace Proem\Api\View\Provider\Twig
 */
namespace Proem\Api\View\Provider\Twig;

use Proem\Service\Asset\Standard,
    Proem\View\Provider\Twig\View as TwigView;

/**
 * The Twig Provider Asset
 */
class Asset extends Standard
{
    public function __construct()
    {
        $this->set('Proem\View\Template', function() {

            require_once realpath(__DIR__) . '/../../../../../../vendor/twig/twig/lib/Twig/Autoloader.php';
            \Twig_Autoloader::register();
            $twig = new \Twig_Environment(new \Twig_Loader_Filesystem($this->params['path']));

            return TwigView::getInstance()->setProvider($twig);
        });
    }
}
