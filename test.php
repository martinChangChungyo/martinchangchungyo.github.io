<?php
$DBNAME = "test_1";
$DBUSER = "root";
$DBPASSWD = "";
$DBHOST = "localhost";

$conn = mysqli_connect( $DBHOST, $DBUSER, $DBPASSWD);
if (empty($conn)){
  print mysqli_error($conn);
  die ("無法連結資料庫_1");
  exit;
}

if( !mysqli_select_db($conn, $DBNAME)) {
  print mysqli_error($conn);
  die ("無法選擇資料庫_2");
}
// 設定連線編碼
mysqli_query( $conn, "SET NAMES 'utf8'");

$sql ="SELECT * FROM `test_table`";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<?php
// error_reporting(0)
?>

<?php
    echo 'My first PHP script!';
?>

<?php
    $x = 5 + 15 + 5 * 2;
    echo $x;
?>

<?php
    echo 'Hello World!<br>';
    echo 'Hello World!<br>';
    echo 'Hello World!<br>';
?>

<?php
    $text = 'red';
    echo'My car is '.$text.'<br>';
?>

<br>

<?php
    $txt = "Hello world!";
    $x = 5;
    $y = 10.5;

    echo $text;
    echo $txt;
    echo "<br>";
    echo $x;
    echo "<br>";
    echo $y;
?>

<br>

<?php
    $txt = "W3Schools.com";
    echo "I love $txt!";
?>

<br>

<?php
$x = 5;
$y = 4;
$txt = "W3Schools.com";
echo $x + $y . $txt;
$y = null;
?>

<br>

<?php
$x = 5; // global scope

function myTest() {
    $y = 9; // global scope
    // using x inside this function will generate an error
    global $globalText;
    $globalText = "Hii";
    $GLOBALS['globalText_2'] = "YOO!";
    echo "<p>Variable x inside function is: " . ($x + $y) . "</p>";
}
myTest();

echo "<p>Variable x outside function is: " . ($x + $y) . $globalText . $globalText_2 . "</p>";
$x = null;
?>

<?php
function myTestFFF() {
    static $x = 0;
    echo $x . "<br>";
    $x++;
}

myTestFFF();
myTestFFF();
myTestFFF();
?>

<?php
$txt1 = "Learn PHP";
$txt2 = "W3Schools.com";
$x = 5;
$y = 4;

echo "<h2>" . $txt1 . "</h2>";
echo "Study PHP at ", $txt2, "<br>";
echo $x + $y;
?>

<?php
$txt1 = "Learn PHP";
$txt2 = "W3Schools.com";
$x = 5;
$y = 4;

print "<h2>" . $txt1 . "</h2>";
print "Study PHP at " . $txt2 . "<br>";
print $x + $y;
?>

<br>

<?php
// ($some_var) ? echo 'true' : echo 'false';
($some_var) ? print "true": print "false";
echo $some_var ? "true": "false";
print $some_var ? "true": "false";
?>

<br>

<?php
$x = '5985';
var_dump($x);
print '<br>';
var_dump($not_exist);
print '<br>';
$boolean_test = false;
var_dump($boolean_test);
print '<br>';
$array_test = array("Volvo","BMW","Toyota");
var_dump($array_test);
print '<br>';
var_dump($array_test[0]);
print '<br>';
$array_test_2 = ["Volvo", "BMW", "Toyota"];
var_dump($array_test_2);
print '<br>';
var_dump($array_test_2[0]);
print '<br>';
$object_test =
[
  'no'=> 1,
  'data'=> 'Jack'
];
var_dump($object_test);
print '<br>';
var_dump($object_test['data']);

print '<br>';
print '<br>';
$object_test_2 = array(
[
  'no'=> 1,
  'data'=> 'Jack'
],
[
  'no'=> 2,
  'data'=> 'Marry'
],
[
  'no'=> 3,
  'data'=> 'Jhon'
]);

var_dump($object_test_2);
print '<br>';
var_dump($object_test_2[1]);
print '<br>';
var_dump($object_test_2[1][data]);
print '<br>';
?>

<br>

<?php
echo strlen("Hello world!"); // 回傳字串長度
print '<br>';
echo str_word_count("Hello world!"); // 回傳單字數
print '<br>';
echo strrev("Hello world!"); // 回傳反轉字串
print '<br>';
echo strpos("Hello world!", "world"); // 搜尋字串，有救回傳位置，否則回傳 false
print '<br>';
echo strpos("Hello world!", "world") ? "true": "false";
print '<br>';
(strpos("Hello world!", "worldDDD")) ? print "true": print "false";
print '<br>';
echo str_replace("world", "Dolly", "Hello world!"); // 取代字串
?>

<br>

<?php
define("GREETING", "Welcome to W3Schools.com!<br>");
echo GREETING;
define("test_text", "Welcome to W3Schools.com!????<br>");
echo test_text;
define("GREETING_2", "Welcome to W3Schools.com!!!!<br>", true);
echo greeting_2;

define("GREETING_OUT", "Welcome to W3Schools.com!?!?!?");

function myTest_define() {
    echo GREETING_OUT;
}

myTest_define();
?>

<br>

<?php
$x = 10;
echo ++$x, '<br>'; // 先+1

$y = 10;
echo $y++, '<br>'; // 後+1
?>

<br>

<?php
$txt1 = "Hello";
$txt2 = " world!<br>";
echo $txt1 . $txt2;

$txt3 = "Hello";
$txt4 = " world!<br>";
$txt3 .= $txt4;
echo $txt3;
?>

<br>

<?php
$t = date("H");
$t2 = date("Y-m-d H:i:s");

if ($t < "10") {
    echo "Have a good morning!($t2)";
} elseif ($t < "20") {
    echo "Have a good day!($t2)";
} else {
    echo "Have a good night!($t2)";
}
?>

<br>

<?php
$favcolor = rand(0, 3);

echo "Number is $favcolor!<br>";
switch ($favcolor) {
    case 1:
        echo "Your favorite number is 1!";
        break;
    case 2:
        echo "Your favorite number is 2!";
        break;
    case 3:
        echo "Your favorite number is 3!";
        break;
    default:
        echo "Your favorite number is neither 1, 2, nor 3!";
}
?>

<br>
<br>

<?php
$x = 1;

while($x <= 5) {  // 先檢查判斷式再執行
    echo "The number is: $x <br>";
    $x++;
}
?>

<br>
<br>

<?php
$x = 6;

do {
    echo "The number is: $x <br>";
    $x++;
} while ($x <= 5); // 至少執行一次再檢查判斷式
?>

<br>
<br>

<?php
for ($x = 0; $x <= 5; $x++) {
    echo "The number is: $x <br>";
}
?>

<br>
<br>

<?php
$colors = array("red", "green", "blue", "yellow");

foreach ($colors as $val) {
    echo "$val <br>";
}
writeMsg(); // call the function
?>

<br>

<?php
function writeMsg() {
    echo "Hello world!<br>";
}

writeMsg(); // call the function
wrITemsG(); // call the function
?>

<br>

<?php
function familyName($fname) {
    echo "$fname Red.<br>";
}

familyName("A");
familyName("B");
familyName("C");
familyName("D");
familyName("E");
?>

<br>

<?php
function setHeight($minheight = 50) {
    echo "The height is : $minheight <br>";
}

setHeight(350);
setHeight(); // will use the default value of 50
setHeight(80);
?>

<br>

<?php
function sum($x, $y) {
    $z = $x + $y;
    return $z;
}

echo "5 + 10 = " . sum(5, 10) . "<br>";
echo "7 + 13 = " . sum(7, 13) . "<br>";
echo "2 + 4 = " . sum(2, 4);
?>

<br>

<?php
$skills = array("Fire", "Water", "Wind");
$arrlength = count($skills);
for ($i = 0; $i < $arrlength; $i++) {
  echo $skills[$i], "<br>";
}
?>

<br>

<?php
$testArray = array(1, 3, 44, 0, -5);
echo $testArray[0], $testArray[1], $testArray[2], $testArray[3], $testArray[4], "<br>";

$testArray_2 = $testArray;
sort($testArray_2);
echo $testArray_2[0], $testArray_2[1], $testArray_2[2], $testArray_2[3], $testArray_2[4], "<br>";

$testArray_2 = $testArray;
rsort($testArray_2);
echo $testArray_2[0], $testArray_2[1], $testArray_2[2], $testArray_2[3], $testArray_2[4], "<br>";
?>

<br>

<?php
$age = array('Jack' => 38, 'Marry' => 67, 'Jhon' => 5, 'Bee' => 18, 'Lin' => 24);
asort($age); // 以值排序

foreach($age as $x => $x_value) {
    echo $x . ": " . $x_value;
    echo "<br>";
}
print '<br>';

ksort($age); // 以Key排序

foreach($age as $x => $x_value) {
    echo $x . ": " . $x_value;
    echo "<br>";
}

print '<br>';

arsort($age); // 以Key排序

foreach($age as $x => $x_value) {
    echo $x . ": " . $x_value;
    echo "<br>";
}

print '<br>';

krsort($age); // 以Key排序

foreach($age as $x => $x_value) {
    echo $x . ": " . $x_value;
    echo "<br>";
}
?>

<br>

<?php
echo $_SERVER['PHP_SELF'];
echo "<br>";
echo $_SERVER['SERVER_NAME'];
echo "<br>";
echo $_SERVER['HTTP_HOST'];
echo "<br>";
echo $_SERVER['HTTP_REFERER'];
echo "<br>";
echo $_SERVER['HTTP_USER_AGENT'];
echo "<br>";
echo $_SERVER['SCRIPT_NAME'];
?>

<br>

<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = htmlspecialchars($_REQUEST['fname']);
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }
}
?>

<?php
while($obj = mysqli_fetch_object($result)){
   print $obj -> id . $obj -> timestamp . $obj -> name . $obj -> picture . $obj -> text . $obj -> like_count . "<br>";
}
?>

</body>
</html>
