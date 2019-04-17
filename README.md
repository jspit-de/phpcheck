# phpcheck

Simple Test class for output in web browser

### Features

- Supports module and interaction tests
- Result presentation as a table in the browser
- only pure PHP5 (> V5.3) required, no development environments, extensions, frameworks or installations necessary
- runs on all target platforms (all web hosts up to embedded controllers)

### Example

```php
<?php
//error_reporting(-1);  //dev
error_reporting(E_ALL ^ (E_WARNING | E_USER_WARNING));
ini_set('display_errors', 1);
header('Content-Type: text/html; charset=UTF-8');

require __DIR__.'/../class/phpcheck.php';

$t = new PHPcheck;

//our testobject
function fact($n){
  $fak = 1;
  while($n > 0){
    $fak *= $n--;
  }
  return $fak;
}

//test
$t->start('fact() test 1');  //Comment
$result = fact(3);
$expected = 6; 
$t->checkEqual($result,$expected);

$t->start('fact() test 2');  //Comment
$result = fact(5);
$expected = 120; 
$t->checkEqual($result,$expected);

$t->start('fact() illegal parameter');  //Comment
$result = fact(-1);
$expected = false; 
$t->checkEqual($result,$expected);

/*
 * End Tests 
 */

//output as html
echo $t->gethtml();
```

### View in browser

**phpcheck.demo2.php Total: 3 Tests, 1 Errors**  
PHPCheck V1.3.13, OS: Linux, PHP-Version: 7.1.7 (64 Bit), Time: 0.00 s, Memory: 2.0M (128M)

**Comment** | **Line** | **Code** | **Result** | **Test**
----------- | -------------|----------|-----------------|-----------
fact() test 1|22|$result = fact(3);<br/>$expected = 6;<br/>$t->checkEqual($result,$expected);|[0.0 ms]<br/>6|Ok
fact() test 2|27|$result = fact(5);<br/>$expected = 120;<br/>$t->checkEqual($result,$expected);|[0.0 ms]<br/>120|Ok
fact() test 3|32|$result = fact(-1);<br/>$expected = false;<br/>$t->checkEqual($result,$expected);|[0.0 ms]<br/>1|**Error**

### Class-Info

| Info | Value |
| :--- | :---- |
| Declaration | class PHPcheck |
| File | phpcheck.php |
| Date/Time modify File | 2019-01-24 10:35:34 |
| File-Size | 30 KByte |
| MD5 File | 3330f1d07eba8f52929976c3372577f1 |
| Version | 1.42 (const VERSION = 1.42) |
| Date | 2018-10-30 |


### Public Methods

| Methods and Parameter | Description/Comments |
| :-------------------- | :------------------- |
| public function __construct() | create a instance of phpcheck |
| public function start($comment=&#039;&#039;) | the method marks the start of new test<br>param $comment set a title/comment of following test  |
| public function startOutput($comment=&#039;&#039;) | the method marks the start of new test with Output<br>param $comment set a title/comment of following test <br>works how start() and expectOutput()  |
| public function check($actual,$testResult,$comment=&#039;&#039;) | use this method&#039;s to finish a test<br>param $actual the result of test <br>param $testResult true/false for test was ok or not<br>param $comment set a title/comment, if method start use this comment will be overwerite<br>return array results |
| public function checkEqual($actual,$expected,$comment=&#039;&#039;, $delta = 0) | finish a test<br>param $actual the actual result<br>param $expected the expected result<br>param $comment new comment<br>param $delta if not 0, then check abs($expected-$actual) &lt;= $delta<br>return array results |
| public function checkEqualHex($actual,$expected,$comment=&#039;&#039;) | finish a test<br>param $actual the actual result, if is string it will be show as hex-string<br>param $expected the expected result<br>param $comment new comment<br>return array results |
| public function checkHTML($actual = null, $containStrings = &quot;&quot;, $ignoreLibXmlErrors = false) | finish a test<br>param $actual the actual result html-Code<br>param $containStrings: if not &quot;&quot; the result must contain Strings<br>param $ignoreLibXmlErrors: ignor Errors how unknown Tags<br>return array results |
| public function checkContains($actual, $containStrings = &quot;&quot;) | finish a test<br>param $actual the actual result <br>param $containStrings: if not &quot;&quot; the result must contain Strings<br>return array results |
| public function checkOutput($containStrings = &quot;&quot;, $outputFilter = null) | finish a test after startOutput<br>param $containStrings : check if output contains the list of strings, default &quot;&quot;<br>param $outputFilter : if not null setResultFilter temp to $outputFilter, p.E. &#039;html&#039; <br>return array results |
| public function checkMultiple($userFct,array $data) | make a multiple test<br>par $user: function-name, closure, static method &quot;class::method&quot; or array($class,&#039;method&#039;)<br>par $data: multiple array with comment as key and array(par,par2,..,expectedValue)<br>return array results |
| public function checkException($closure,$exceptionTyp = &quot;&quot;,$comment=&#039;&#039;) | use this method&#039;s to finish a test<br>param $closure a function with testobject <br>param $exceptionTyp the exception or &quot;&quot; for all<br>param $comment set a title/comment, if method start use this comment will be overwerite<br>return array results |
| public function expectOutput() | prepare the output buffer for expect a output<br>to check a output you must use expectOutput or startOutput |
| public function getOutput() | stop the output buffering and get the output  |
| public function time() | return float: seconds from last test start |
| public function getResults() | return a array of resultarrays from all collected checks<br>array ( 0 =&gt; array (<br>&#039;line&#039; =&gt; 3, //Line number source <br>&#039;comm&#039; =&gt; &quot;1.test&quot;, //Comment<br>&#039;taskCode&#039; =&gt; &#039;$result = 3 * 4;&#039;, //source code ckeck<br>&#039;result&#039; =&gt; 12, //result that will be checked<br>&#039;filterResult&#039; =&gt; &quot;12&quot;, //result after filter<br>&#039;test&#039; =&gt; true, //result of check<br>&#039;warning&#039; =&gt; //Errors and warnings that occur during the test <br>array (<br>),<br>&#039;mctime&#039; =&gt; 6.9E-6, //Time required by the test<br>)) |
| public function getLastResult($key = null) | return last result or result with the specified key<br>param key string &#039;line&#039;, &#039;comm&#039;, &#039;mctime&#039;<br>return false if error |
| public function getLastPHPcode() | return the PHP Code (taskCode) as highlightPhpString from the last check  |
| public function getErrorCount() | returns the number of failed tests |
| public function getCheckCount() | return count of check-calls |
| public function clearChecks() | Delete collected results from all checks  |
| public function setErrorLevel($level) | set new error level and push old level<br>return old level<br>use this to show warnings and errors only in results<br>and not in top of site |
| public function restoreErrorLevel() | restore error level <br>return: current level |
| public function setTabSpacePHPview($tabSpace = 4) | set Tabspace for view PHP-Code |
| public function setStartWithCheck($enable = true) | true (default): check is automatically start for new test<br>false : start must be called |
| public function setResultFilter($filterName = &#039;default&#039;) | set a new result filter for getTable<br>results are filtered with &quot;var_export&quot; (default) <br>If you want present text or html without filter, <br>call setResultFilter with parameter empty string<br>$filtername = &#039;html&#039; : present strings without filter, other with &quot;var_export&quot;<br>return $oldFilter (&gt;V1.42) |
| public function setHeadline($text) | set text for additional Headline |
| public function setOutputVariant($variant) | set variant for output<br>Valid variant: &quot;&quot; , &quot;form&quot; <br>&quot;form&quot; creates a button, that allow form-elements send with POST |
| public function setOutputOnlyErrors($trueOrFalse) | set variant for output print Only Errors |
| public function getPostCount() | get count (cycle number) for POST-cykles<br>return 0 after first Start |
| public function getTable($tableAttribut = &quot;&quot;, $clearResults = true) | create a full table with results<br>return: html-string<br>param: tableAttribut e.g. &#039;style=&quot;&quot;&#039;<br>param: set $clearResults = false if you may not delete collected results |
| public function getHtmlHeader($title = &#039;Test&#039;) | return default html header for a site as string |
| public function addCSS($css = &quot;&quot;) | add CSS to header |
| public function getHtmlFooter() | return default html footer as string |
| public function getTotalInfo() | get total Info (Number of checks, errors..) as HTML |
| public function getHtml($withFooter = true) | provides a complete tabular analysis as a web page<br>typical use<br>$t = new phpcheck();<br>$t-&gt;start(&quot;first test&quot;);<br>$result = 5 + 4; //our first test<br>$t-&gt;checkEqual($result,9); //end first test<br>echo $t-&gt;getHTML(); //show analysis |
| public function getRandomString($length = 10) | return a random ASCII-String<br>param $length (default 10 chars) |
| public function highlightPhpString($phpCode) | Syntax highlighting of a string with php-Code |
| public static function getValidateHtmlError($html, $ignoreLibXmlErrors = false) | validate a html-string and get the error notice<br>return &quot;&quot; if ok and not error found<br>return error-message if errror<br>param: HTML as string<br>param: flag $ignoreLibXmlErrors true/false default false |
| public function getClassVersion($class=NULL) | @return string version of class<br>return false if error, &quot;&quot; Versioninfo not found<br>@param class: object, string (optional) |
| public function roundPrecision($floatValue, $overallPrecision = self::DEFAULT_FLOAT_PRECISION) | @return Float-Value with reduced precision<br>@param $floatValue: input (float)<br>@param $overallPrecision: 1..20 (default 14) |
| public function checkErrorHandler($errcode, $errmsg, $fileName, $line) | the internal error handler, do not use |
| public function echoImg($gdResource) | echo gd-rsource |

### Public Propertys

| Property and Defaults | Description/Comments |
| :-------------------- | :------------------- |
|  public $cmpFloatPrecision = self::DEFAULT_FLOAT_PRECISION; |  |

### Constants

| Declaration/Name | Value | Description/Comments |
| :--------------- | :---- | :------------------- |
|  const version = &#039;1.42&#039;; | &#039;1.42&#039; |   |
|  const DISPLAY_PRECISION = 16; | 16 |   |
|  const DEFAULT_FLOAT_PRECISION = 14; | 14 |   |

### Demos

#### Unit Test class dt

http://jspit.de/check/phpcheck.class.dt.php

#### Test class.debug.php

http://jspit.de/check/phpcheck.class.debug.php

#### Test for a method to create an HTML Table 

http://jspit.de/check/phpcheck.table.class.html.php

#### Interactiv tests for methods to create an HTML inputs

http://jspit.de/check/phpcheck.input.class.html.php

http://jspit.de/check/phpcheck.select.class.html.php

#### Test class.sqliteobject.store

http://jspit.de/check/phpcheck.class.sqliteobjectstore.php

#### Test a GD-Image Class

http://jspit.de/check/phpcheck.class.gdimage.php

#### Autoloadertest

http://jspit.de/check/phpcheck.autoload.php


