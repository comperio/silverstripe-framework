<?php
/**
 * @package sapphire
 * @subpackage tests
 */
class DBLocaleTest extends SapphireTest
{
    public function testNice()
    {
        $l = DBField::create('DBLocale', 'de_DE');
        $this->assertEquals($l->Nice(), 'German');
    }
    
    public function testNiceNative()
    {
        $l = DBField::create('DBLocale', 'de_DE');
        $this->assertEquals($l->Nice(true), 'Deutsch');
    }
    
    public function testNativeName()
    {
        $l = DBField::create('DBLocale', 'de_DE');
        $this->assertEquals($l->getNativeName(), 'Deutsch');
    }
}
