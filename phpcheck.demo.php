<?php
//error_reporting(-1);  //dev
error_reporting(E_ALL ^ (E_WARNING | E_USER_WARNING));
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=UTF-8');

require __DIR__.'/phpcheck.php';

$t = new PHPcheck;
//Reset Filter to enable html output
//$t->setResultFilter("html");

//Outputvariante Form
$t->setOutputVariant("Form");

$t->start('check phpcheck Instance');
$t->check($t instanceof phpcheck, true);

//check without ->start
$result = 5 + 4;
$expect = 9;
$t->check($result, $result === $expect);

$t->start('check: ok, simple addition');
$result = 5 + 4;
$expect = 9;
$t->check($result, $result === $expect);

$t->start('check: error');
$result = 3 + 4;
$expect = 9;
$t->check($result, $result === $expect);

$t->start('checkEqual:ok, simple addition');
$result = 5 + 4;
$expect = 9;
$t->checkEqual($result, $expect);

$t->start('checkEqual:error');
$result = 5 + 4;
$expect = "9";
//error: $result is a integer, string expect 
$t->checkEqual($result, $expect);

$t->start('checkEqual:error');
$result = 1/3;
$expect = 0.33333333;
$t->checkEqual($result, $expect);

$t->start('checkEqual: ok, compare with delta');
$result = 1/3;
$expect = 0.33333333;
$delta =  0.00000001;
$t->checkEqual($result, $expect,"", $delta);

$t->start('checkEqualHex: ok');
$result = "abc\n";
$expect = "abc\x0a";
$t->checkEqualHex($result, $expect);

$t->start('checkHTML: ok');
$t->setResultFilter("html");
$result = "<b>Fett</b>";
$t->checkHTML($result);

$t->start('checkHTML: false, invalid HTML');
$t->setResultFilter();  //default
$result = "<b>Fett";
$t->checkHTML($result);

$t->start('checkMultiple: ');
$userFct = function($par1,$par2){
  return $par1 * $par2;
};
$tests = array(
  array(4,5,20),  //par1,par2, expect
  array(-2,5,-10),  //par1,par2, expect
);
$t->checkMultiple($userFct,$tests);

$t->startOutput('start Output: 1');
echo "A Message";
$t->checkOutput("A Message");

$t->startOutput('start Output: 2');
echo "<p>A Message</p>";
$t->checkHTML(null, "A Message");

$t->startOutput('Output a input text field1');
$t->setResultFilter("html");
echo '<input name="field1" >';  
$t->checkHTML(null);

$t->start('check $_POST');
$result = $_POST;
$testOk = (
  empty($_POST) //first Call
  OR isset($_POST["field1"])  //after Send Form
);
$t->check($result, $testOk);

/*
 * End Tests 
 */

//output as table
echo $t->gethtml();

