CakePHP AsyncThread
===================

With AsyncThread Behavior you can run methods of your models asynchronously
by using custom engines or built-in pcntl engine (for each model you can use different engines).
Custom engines must implements AsyncThreadEngineInterface.

## Installation

	cd my_cake_app/app
	git clone git://github.com/imsamurai/cakephp-async-thread.git Plugin/AsyncThread

or if you use git add as submodule:

	cd my_cake_app
	git submodule add "git://github.com/imsamurai/cakephp-async-thread.git" "app/Plugin/AsyncThread"

then add plugin loading in Config/bootstrap.php

	CakePlugin::load('AsyncThread');

## Configuration

For use AsyncThread Behaviour just add it

    public $actsAs = array('AsyncThread.AsyncThread');

or

    public $actsAs = array(
      'AsyncThread.AsyncThread' => array('engine' => 'path_to_custom_engine')
    );

Then in your model you can use methods like `asyncMethodName(arg1, arg2, ...)`
and it asynchronously call `methodName(arg1, arg2, ...)`.

##WARNING

This is first alpha version full of bugs!

Remember that at this time there is no way to get async method result.
And be careful with shared resources used in methods running at same time.