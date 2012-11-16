<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 16.11.2012
 * Time: 11:48:18
 *
 */
interface AsyncThreadEngineInterface {
    public function execute(callable $callback, array $arguments = null);
}