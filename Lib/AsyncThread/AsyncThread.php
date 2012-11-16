<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 16.11.2012
 * Time: 11:52:11
 *
 */
class AsyncThread {

    private $_Engine = null;

    public function __construct(AsyncThreadEngineInterface $Engine) {
        $this->_Engine = $Engine;
    }

    public function execute(callable $callback, array $arguments = null) {
        $this->_Engine->execute($callback, $arguments);
    }

}