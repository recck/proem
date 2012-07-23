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
 * @namespace Proem\Api\View
 */
namespace Proem\Api\View;

use Proem\View\Template;

/**
 * Abstract base that View can implement.
 */
abstract class Generic implements Template
{
    /**
     * Store the provider
     */
    protected $provider;
    protected static $instance;

    protected $template;
    protected $params = [];

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static;
        }

        return self::$instance;
    }

    /**
     * Set the internal template engine provider.
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * Retrive the internal template engine provider.
     */
    public function getProvider()
    {
        return $this->provider;
    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }

    public function setParams($params)
    {
        $this->params = $params;
        return $this;
    }

    /**
     * Returns the output of the template.
     */
    abstract public function render();

    /**
     * Send the output of the template to the client
     */
    abstract public function stream();

    /**
     * Get the contents of the View
     */
    abstract public function getContent();

}
