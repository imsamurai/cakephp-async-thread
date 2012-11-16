<?

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 16.11.2012
 * Time: 11:58:44
 * Format: http://book.cakephp.org/2.0/en/models/behaviors.html
 */

App::uses('AsyncThread', 'AsyncThread.AsyncThread');

class AsyncThreadBehavior extends ModelBehavior {

    public $mapMethods = array('/async(\w+)/' => 'execute');


    public function setup(Model $Model, $config = array()) {
        if (empty($config['engine'])) {
            $config['engine'] = 'AsyncThread.PCNTLAsyncThreadEngine';
        }

        list($engine_plugin, $engine_name) = pluginSplit($config['engine']);

        App::uses($engine_name, $engine_plugin.'.Lib/AsyncThread/Engine/');

        $Engine = new $engine_name();
        $AsyncThread = new AsyncThread($Engine);


        $this->settings[$Model->alias] = array(
            'Model' => $Model,
            'AsyncThread' => $AsyncThread,
            'config' => $config
        );
    }

    public function execute(Model $Model, $method) {
        $original_method = lcfirst(substr($method, 5));
        $arguments = array_slice(func_get_args(), 2);

        $this->settings[$Model->alias]['AsyncThread']->execute(array($this->settings[$Model->alias]['Model'], $original_method), $arguments);
    }

}