<?php
    // error_reporting(0);
    global $DBNAME, $DBUSER, $DBPASSWD, $DBHOST, $con;
    $DBNAME = 'test_1';
    $DBUSER = 'root';
    $DBPASSWD = '';
    $DBHOST = 'localhost';

    $con = mysqli_connect($DBHOST, $DBUSER, $DBPASSWD);
    if (empty($con)) {
        echo mysqli_error($con);
        die('無法連結資料庫_1');
        exit;
    }

    if (!mysqli_select_db($con, $DBNAME)) {
        echo mysqli_error($con);
        die('無法選擇資料庫_2');
    }
    mysqli_query($con, "SET NAMES 'utf8'");

    $sql = 'SELECT * FROM `test_table_2`';
    $result = mysqli_query($con, $sql);
    doTableData($result);

    $sql = 'SELECT name,age FROM `test_table_2`';
    $result = mysqli_query($con, $sql);
    doTableData($result);

    mysqli_close($con);
?>

<?php
function doTableData($array)
{
    doTableDataHeader($array);
    doTableDataBody($array);
}
function doTableDataHeader($array)
{
    echo '<table class="table table-bordered table-hover">';
    echo '<thead>';
    echo '<tr>';
    while ($fieldinfo = mysqli_fetch_field($array)) {
        echo '<th>' .$fieldinfo->name. '</th>';
    }
    echo '</tr>';
    echo '</thead>';
}

function doTableDataBody($array)
{
    echo '<tbody>';
    while ($row = mysqli_fetch_row($array)) {
        echo '<tr>';
        foreach ($row as $_column) {
            echo '<td>' .$_column. '</td>';
        }
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}
?>
