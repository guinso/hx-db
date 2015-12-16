<?php 
namespace Hx\Db;

class SimpleDb implements \Hx\Db\DbInterface {
	
	private $pdo;
	
	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	
	public function runSql($sql, array $parameter = null)
	{
		$stmt = $this->pdo->prepare($sql);
		
		$result = false;
		
		if (empty($parameter))
			$result = $stmt->execute();
		else 
			$result = $stmt->execute($parameter);
		
		if ($result === false)
			throw new \Hx\Database\DbException(
				"Fail to run sql: " . $stmt->errorInfo());
		
		return $stmt;
	}
	
	public function runSqlFile($sqlFilePath)
	{
		if (!file_exists($sqlFilePath))
			Throw new DbException("File $sqlFilePath not found.");
		
		if (!is_readable($sqlFilePath))
			Throw new DbException("File $sqlFilePath is not accessible.");
				
		return $this->pdo->exec(file_get_contents($sqlFilePath));
	}
}
?>