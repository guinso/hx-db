# hx-db
RDBMS utility tool

# Install Package
## Composer
```json
//PHP 7
{
  "require": {
    "guinso/hx-db": "2.0.*"
  }
}

//PHP 5
{
  "require": {
    "guinso/hx-db": "1.0.*"
  }
}
```

## Manual
```php
require_once("hx-db-directory/src/autoload.php");
```

# Example
## Basic PDO operation
```php
$pdo = new \PDO(...); //put standard parameter for PDO
$db = new \Hx\Db\SimpleDb($pdo);

//execute SQL
$sql = "SELECT * FROM account WHERE name = :name";
$pdoStatement = $db->runSql(
  $sql,
  array(":name" => "john")
);
foreach($row in $pdoStatement)
  //process each row data...

//execute SQl from file
$result = $db->runSqlFile("sql-script-file-path"); //only return number of affect row (Int)

//transaction
$db->BeginTransaction();
$db->CommitTransaction();
$db->RollBackTransaction(); //rollback
```

## SQL script Generator
Currently only support simple SELECT, INSERT, and UPDATE SQL
```php
$pdo = new \PDO(...);
$sqlService = new \Hx\Db\SqlService(new \Hx\Db\SimpleDb($pdo));

//Select SQL
$sqlSelect = $sqlService->createSelectSql();
$sqlSelect->table("datatable-name a")
  ->column("a.name")
  ->column("a.address AS addr")
  ->where("a.age > :age")
  ->order("a.name DESC")
  ->group("a.nationality")
  ->join("INNER JOIN", "invoice b", "a.name = b.name")
  ->paginate(0, 10);
  
//to get sql script
$sqlScript = $sqlSelect->generateSql();

//to direct execute
$sqlStatement = $sqlSelect->execute(array(":age" => 18));
```
