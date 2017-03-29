<?php

$host = "localhost"; 
$username = "wwwcays_rentalin";
$password = "qq~KUTQW!+KC"; 
$dbname = "wwwcays_rentalsver2";  

backup_tables($host, $username, $password, $dbname);


function backup_tables($host,$user,$pass,$name,$tables = '*')
{
$con = mysql_connect($host,$user,$pass);
mysql_select_db($name,$con);
if($tables == '*')
{
$tables = array();
$result = mysql_query('SHOW TABLES');
while($row = mysql_fetch_row($result))
{
$tables[] = $row[0];
}
}
else
{
$tables = is_array($tables) ? $tables : explode(',',$tables);
}
$return = "";
foreach($tables as $table)
{
$result = mysql_query('SELECT * FROM '.$table);
$num_fields = mysql_num_fields($result);
$return.= 'DROP TABLE '.$table.';';
$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
$return.= "nn".$row2[1].";nn";

while($row = mysql_fetch_row($result))
{
$return.= 'INSERT INTO '.$table.' VALUES(';
for($j=0; $j<$num_fields; $j++)
{
$row[$j] = addslashes($row[$j]);
$row[$j] = preg_replace("#n#","n",$row[$j]);
if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
if ($j<($num_fields-1)) { $return.= ','; }
}
$return.= ");n";
}
$return.="nnn";
}


$handle = fopen('backup/backupdb'.'.sql','w+');
fwrite($handle,$return);
fclose($handle);
}
if (glob("*.sql") != false)
{
$filecount = count(glob("*.sql"));
$arr_file = glob("*.sql");

}


$path = dirname($_SERVER['PHP_SELF']);
$position = strrpos($path,'/') + 1;
$folder_name = substr($path,$position);


$iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator("../$folder_name/"));

echo "<script> window.location='admin/dashboard/admin_dashboard';alert('Successfully Backup Database');</script>";

?>