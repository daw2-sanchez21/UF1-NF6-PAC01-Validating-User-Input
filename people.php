<?php
$db = mysqli_connect('localhost', 'root', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db,'moviesite') or die(mysqli_error($db));
if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            people_fullname, people_isactor, people_isdirector
        FROM
            people
        WHERE
            people_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $people_fullname = '';
    $people_isactor = 0;
    $people_isdirector = 0;
}?>

<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> People</title>
  <style type="text/css">
    <!--
        #error { background-color: #600; border: 1px solid #FF0; color: #FFF;
        text-align: center; margin: 10px; padding: 10px; }
    -->
  </style>
 </head>
 <body>
<?php
    if (isset($_GET['error']) && $_GET['error'] != '') {
        echo '<div id="error">' . $_GET['error'] . '</div>';
}
?>
  <form action="N6P105commit.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <tr>
     <td>People Fullname</td>
     <td><input type="text" name="people_fullname"
      value="<?php echo $people_fullname; ?>"/></td>
    </tr>
    <tr>
     <td>Lead Actor</td>
     <td><select name="people_isactor">
<?php
// select director records
if ($_GET['action'] == 'edit') {
$query = 'SELECT
        people_id, people_fullname, people_isactor
    FROM
        people
    WHERE
        people_id = '.$_GET['id'];

$result = mysqli_query($db, $query) or die(mysqli_error($db));

// populate the select options with the results
while ($row = mysqli_fetch_assoc($result)) {
            if ($row['people_isactor'] == 1) {
            echo '<option value="1" selected="selected">1</option>';
            echo '<option value="0">0</option>';
        } else {
            echo '<option value="0" selected="selected">0</option>';
            echo '<option value="1">1</option>';
        }
}
}else{if ($people_isactor == 1) {
            echo '<option value="1" selected="selected">1</option>';
            echo '<option value="0">0</option>';
        } else {
            echo '<option value="0" selected="selected">0</option>';
            echo '<option value="1">1</option>';
        }}
?>
      </select></td>
    </tr><tr>
     <td>Director</td>
     <td><select name="people_isdirector">
<?php
if ($_GET['action'] == 'edit') {
// select director records
$query = 'SELECT
        people_id, people_fullname, people_isdirector
    FROM
        people
    WHERE
        people_id = '.$_GET['id'];

$result = mysqli_query($db, $query) or die(mysqli_error($db));


// populate the select options with the results
while ($row = mysqli_fetch_assoc($result)) {
            if ($row['people_isdirector'] == 1) {
            echo '<option value="1" selected="selected">1</option>';
            echo '<option value="0">0</option>';
        } else {
            echo '<option value="0" selected="selected">0</option>';
            echo '<option value="1">1</option>';
        }
}
} else{if ($people_isdirector == 1) {
            echo '<option value="1" selected="selected">1</option>';
            echo '<option value="0">0</option>';
        } else {
            echo '<option value="0" selected="selected">0</option>';
            echo '<option value="1">1</option>';
        }}

?>
      </select></td>
    </tr><tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="people_id" />';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>
