<?php
error_reporting(E_ALL); ini_set('display_errors', 1);
set_include_path ( "./classes" );
spl_autoload_register ();
  if (isset($_GET['source'])) {
    highlight_file($_SERVER['SCRIPT_FILENAME']);
    exit;
  }
?>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<table>
  <tr>
    <th>Student Name</th>
    <th>Faculty Adviser</th>
    <th>Faculty Phone</th>
  </tr>

<?php
$session = new dbAdapter('secure/config.ini');
$session->connect();
$students = $session->select('SELECT s_id, s_first, s_mi, s_last, f_id FROM student');
//$s_id = $session->select('SELECT s_id FROM student');
$it = 0;
foreach($students as $student){
        $fac = $session->select("SELECT f_phone, f_first, f_mi, f_last FROM faculty WHERE f_id = $student[f_id]");
        echo <<<EOT
        <tr>
          <td>$student[s_first] $student[s_mi] $student[s_last]</td>
          <td>$fac[0][f_first] $fac[0][f_mi] $fac[0][f_last]</td>
          <td>$fac[0][f_phone]</td>
        </tr>

	EOT;
	$it += 1;
}
?>

</table>

</body>

