<?php 
declare(strict_types=1);

namespace Hx\Db;

Interface DbInterface {
	
	/**
	 * Run sql script
	 * @param string $sql
	 * @param array $param
	 * @return \PDOStatement
	 */
	public function runSql(string $sql, array $param = null): \PDOStatement;
	
	/**
	 * Run SQL script from file
	 * @param string $sqlFilePath	<p>file path of the SQL script</p>
	 */
	public function runSqlFile(string $sqlFilePath): int;
	
	/**
	 * Begin PDO transaction
	 * @return bool
	 */
	public function BeginTransaction(): bool;
	
	/**
	 * Roll back PDO transaction
	 * @return bool
	 */
	public function RollBackTransaction(): bool;
	
	/**
	 * Commit PDO transaction
	 * @return bool
	 */
	public function CommitTransaction(): bool;
}
?>