<?php
// require_once( 'config.php');
// require_once( CLASSES . 'Hosts.class.php');
 require_once( dirname(dirname(__FILE__)) . '/Classes/Hosts.class.php');

class HostsTest extends PHPUnit_Framework_TestCase {
    public function testExists() {
        $H = new Hosts(array('filePath'=>'/etc/hosts') );
        $exists = $H->exists();
        $this->assertTrue($exists);
    }

    public function testDefault() {
        $H = new Hosts(array('filePath'=>'/etc/hosts') );
        $this->assertEquals('/etc/hosts', $H->getFilePath());

    }

    public function testOSX() {
        $H = new Hosts();
        $this->assertEquals('OSX', $H->getOS());
    }
}
