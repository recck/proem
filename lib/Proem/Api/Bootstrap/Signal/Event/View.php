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
 * @namespace Proem\Api\Bootstrap\Signal\Event\Bootstrap
 */
namespace Proem\Api\Bootstrap\Signal\Event;

use Proem\Signal\Event\Standard as StandardEvent;

/**
 * A custom event used to setup views within the bootstrap.
 */
class View extends StandardEvent
{
    /**
     * Store a reference to a provider.
     *
     * @var Proem\View\Template|string $provider
     */
    protected $provider = false;

    /**
     * Store the path to the template files.
     *
     * @var string
     */
    protected $path     = false;

    /**
     * Set the provider
     *
     * @param Proem\View\Template|string $provider
     * @return Proem\Api\Bootstrap\Signal\Event\View
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
        return $this;
    }

    /**
     * Get the provider
     *
     * @return Proem\View\Template|string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * Set the template path.
     *
     * @return Proem\Api\Bootstrap\Signal\Event\View
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Get the template path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

}
