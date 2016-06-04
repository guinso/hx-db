<?php 
declare(strict_types=1);

namespace Hx\Db;

class SimpleDb implements \Hx\Db\DbInterface {
	
	private $pdo;
	
	public function __construct(\PDO $pdo)
	{
		$this->pdo = $pdo;
	}
	
	public function runSql($sql, array $parameter = null): \PDOStatement
	{
		$stmt = $this->pdo->prepare($sql);
		
		$result = false;
		
		if (empty($parameter))
			$result = $stmt->execute();
		else 
			$result = $stmt->execute($parameter);
		
		if ($result === false)
			throw new DbException(
				"Fail to run sql: " . $stmt->errorInfo());
		
		return $stmt;
	}
	
	public function runSqlFile(string $sqlFilePath): int
	{
		if (!file_exists($sqlFilePath))
			Throw new DbException("File $sqlFilePath not found.");
		
		if (!is_readable($sqlFilePath))
			Throw new DbException("File $sqlFilePath is not accessible.");
				
		return $this->pdo->exec(file_get_contents($sqlFilePath));
	}
	
	public function BeginTransaction(): bool
	{
		$this->pdo->beginTransaction();
	}
	
	public function RollBackTransaction(): bool
	{
		$this->pdo->rollBack();
	}
	
	public function CommitTransaction(): bool
	{
		$this->pdo->commit();
	}
}
?>