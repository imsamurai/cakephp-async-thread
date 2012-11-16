<?

/**
 * Author: imsamurai <im.samuray@gmail.com>
 * Date: 16.11.2012
 * Time: 12:02:22
 * Format: http://book.cakephp.org/2.0/en/development/testing.html
 */
App::uses('Async', 'AsyncThread.Model');

class AsyncTest extends CakeTestCase {

    public function setUp() {
        parent::setUp();
        $this->Model = new Async();
        $this->Model->saveData('');
    }

    public function testMethod() {
        $this->Model->doSomething('123');
        $this->assertSame('123', $this->Model->readData());
    }

    public function testAsyncMethod() {
        $this->Model->asyncDoSomething('321');
        $this->assertSame('321', $this->Model->readData());
    }

    public function testAsyncMethod2() {
        $this->Model->asyncDoSomething('4444');
        $this->assertSame('4444', $this->Model->readData());
    }

}