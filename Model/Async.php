<?
/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 16.11.2012
 * Time: 12:08:56
 * Format: http://book.cakephp.org/2.0/en/models.html
 */

App::uses('AsyncThreadAppModel', 'AsyncThread.Model');
App::uses('AsyncThreadBehavior', 'AsyncThread.Model/Behavior');

class Async extends AsyncThreadAppModel {
    public $name = 'Async';
    public $useTable = false;
    public $actsAs = array('AsyncThread.AsyncThread');

    private $_dataPath = '';

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
        $this->_dataPath = APP . 'Plugin' . DS . 'AsyncThread' . DS . 'Test' . DS . 'Data' . DS . 'async_result.php';
    }

    public function doSomething($data) {
        $this->saveData($data);
        return $data;
    }

    public function saveData($data) {
        $File = new File($this->_dataPath);
        $File->lock = true;
        $File->delete();
        $File->create();
        $File->write($data);
        $File->close();
    }

    public function readData() {
        $File = new File($this->_dataPath);
        $File->lock = true;
        $data = $File->read();
        $File->close();
        return $data;
    }


}