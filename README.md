# phpcheck

Simple Test class for output in web browser

### Features

- Supports module and interaction tests
- Result presentation as a table in the browser
- Execution time of each test, accumulated time and average
- only pure PHP (>= V7.0) required, no development environments, extensions, frameworks or installations necessary
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

**phpcheck.demo2.php Total: 3 Tests, 1 Errors ->first, ↻all**  
PHPCheck V1.66, OS: WIN build 19045 (Windows 10), Machine: AMD64, PHP-Version: 8.2.0 (64 Bit), Time: 0.010ms (AVG: 0.003ms), Memory: 2.0M (512M)

**Comment** | **Line** | **Code** | **Result** | **Test**
----------- | -------------|----------|-----------------|-----------
fact() test 1|22|$result = fact(3);<br/>$expected = 6;<br/>$t->checkEqual($result,$expected);|[0.005 ms]<br/>6|Ok
fact() test 2|27|$result = fact(5);<br/>$expected = 120;<br/>$t->checkEqual($result,$expected);|[0.003 ms]<br/>120|Ok
fact() test 3|32|$result = fact(-1);<br/>$expected = false;<br/>$t->checkEqual($result,$expected);|[0.002 ms]<br/>1|**Error**


### Documentation

http://jspit.de/tools/classdoc.php?class=phpcheck

### Demos

http://jspit.de/check/phpcheck.demo.php

http://jspit.de/check/phpcheck.democheckmethods.php

#### Unit Test class dt

http://jspit.de/check/phpcheck.class.dt.php

#### Test class.debug.php

http://jspit.de/check/phpcheck.class.debug.php

#### Test for a HTML table builder

http://jspit.de/check/phpcheck.table.php

#### Interactiv tests for methods to create an HTML inputs

http://jspit.de/check/phpcheck.input.class.html.php

http://jspit.de/check/phpcheck.select.class.html.php

#### Test a Template Class

http://jspit.de/check/phpcheck.jspittemplate.php

#### Test class.sqliteobject.store

http://jspit.de/check/phpcheck.class.sqliteobjectstore.php

#### Test a GD-Image Class

http://jspit.de/check/phpcheck.jspitgdimage.php

#### Autoloadertest

http://jspit.de/check/phpcheck.autoload.php

