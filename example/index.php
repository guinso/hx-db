<?php 
//NOTE: run 'composer update' command to get composer configuration
include_once dirname(__DIR__) . "/Vendor/autoload.php";

$database = "study";
$username = "your-db-username";
$password = "123456789";

$pdo = new PDO("mysql:host=localhost;dbname=$database", $username, $password);
$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

$databaseHandler = new \Hx\Db\SimpleDb($pdo);

function SampleDirectRunSql(\Hx\Db\DbInterface $db)
{
	$result = $db->runSql("SELECT * FROM test");
	
	echo "#Simple SQL script<br/>";
	
	foreach ($result as $row)
		echo $row['name'] . "<br/>";
}

function SampleDirectRunSqlWithParam(\Hx\Db\DbInterface $db)
{
	$result = $db->runSql(
		"SELECT * FROM test WHERE name = :his", 
		array(':his' => 'john'));

	echo "#Run with parameter 'john'<br/>";
	
	foreach ($result as $row)
		echo $row['name'] . "<br/>";
}

function SampleRunSqlScriptFile(\Hx\Db\DbInterface $db)
{
	$result = $db->runSqlFile(__DIR__ . "/selectName.sql");
}

SampleDirectRunSql($databaseHandler);
echo "<br/>";
SampleDirectRunSqlWithParam($databaseHandler);
echo "<br/>";
SampleRunSqlScriptFile($databaseHandler);
?>