<?php

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 16.11.2012
 * Time: 11:49:15
 *
 */
App::uses('AsyncThreadEngineInterface', 'AsyncThread.Lib/AsyncThread/Engine');

class PCNTLAsyncThreadEngine implements AsyncThreadEngineInterface {

    private $_pid = -1;

    public function execute(callable $callback, array $arguments = null) {
        $this->_fork();
        if ($this->_isChild()) {
            call_user_func_array($callback, (array) $arguments);
        }
        else {
            pcntl_wait($status);
        }
    }

    private function _fork() {
        $this->_pid = pcntl_fork();
        if ($this->_pid == -1) {
            die('could not create');
        }
    }

    private function _isParent() {
        return (bool) $this->_pid;
    }

    private function _isChild() {
        return !$this->_isParent();
    }

    public function __destruct() {
        posix_kill($this->_pid, SIGKILL);
    }

}