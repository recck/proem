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

/**
 * Base interface that all views must implement.
 */
interface Template
{
    /**
     * Set the internal template engine provider.
     *
     * No type hinting is used here because these providers do not have a common
     * interface at this stage. This is exactly what the Proem\Api\View does,
     * provides a common interface.
     *
     * @param object $provider
     */
    public function setProvider($provider);

    /**
     * Retrieve the internal template engine provider.
     */
    public function getProvider();

    /**
     * Set the name of the template to use.
     *
     * @param string $template
     */
    public function setTemplate($template);

    /**
     * Pass any arguments into the template.
     *
     * @param array $params
     */
    public function setParams($params);

    /**
     * Returns the output of the template.
     */
    public function render();

    /**
     * Send the output of the template to the client
     */
    public function stream();

}
