<?php
namespace php_badgeTest;
use php_badge;
use php_badge\Badge;
use PHPUnit\Framework\TestCase;
class php_badgeTest extends TestCase{
  public function testBadge(){
    $path = dirname(__FILE__);
    $FontFile = $path.'/DejaVu-Sans.ttf'; //font file path
    $DBsvg = $path.'/DB.svg';
    $CIsvg = $path.'/CI.svg';
    $Badge = new Badge();
    $Badge->imageFontFile = $FontFile;
    //----------- DB --------------//
    $DB = array(
      array('state', '44CC11'),
      array('staging', 'f0Ce1a'),
      array('testing', 'a0abfc')
    );
    ob_start();
      $Badge->svg($DB);
    $ob_DB = ob_get_contents();
    ob_end_clean();
    $this->assertXmlStringEqualsXmlFile($DBsvg, $ob_DB);
    //----------- CI --------------//
     $CI = array(
        array('build', '555'), //#555555
        array('passing', '4c1'), //#44CC11
    );
    $Badge->$SimplexmlNo = true; //Simplexml Svg
    ob_start();
      $Badge->svg($CI);
    $ob_CI = ob_get_contents();
    ob_end_clean();
    $this->assertXmlStringEqualsXmlFile($CIsvg, $ob_CI);
  }
}