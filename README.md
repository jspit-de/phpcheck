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
