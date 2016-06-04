<?php 
declare(strict_types=1);

namespace Hx\Db\Sql;

interface UpdateInterface {
	
	const RESET_SQL = 1;
	const RESET_PARAM = 2;
	
	/**
	 * Execute SQL based on current configuration
	 * @param array $param
	 * @return \PDOStatement
	 */
	public function execute(array $param = null): \PDOStatement;
	
	/**
	 * Generate SQL script based on current configuration
	 * @return string
	 */
	public function generateSql(): string;
	
	/**
	 * Set data table
	 * @param string $tableName
	 * @return \Hx\Db\Sql\UpdateInterface
	 */
	public function table(string $tableName): \Hx\Db\Sql\UpdateInterface;
	
	/**
	 * Add column for update
	 * @param string $name
	 * @param mixed $value
	 * @return \Hx\Db\Sql\UpdateInterface
	 */
	public function column(string $name, mixed $value): \Hx\Db\Sql\UpdateInterface;
	
	/**
	 * Add where clause
	 * @param string $clause
	 * @return \Hx\Db\Sql\UpdateInterface
	 */
	public function where(string $clause): \Hx\Db\Sql\UpdateInterface;
	
	/**
	 * Add binding
	 * @param string $paramName
	 * @param mixed $value
	 * @return \Hx\Db\Sql\UpdateInterface
	 */
	public function param(string $paramName, mixed $value): \Hx\Db\Sql\UpdateInterface;
	
	/**
	 * Reset current configuration
	 * @param int $options
	 * @return \Hx\Db\Sql\UpdateInterface
	 */
	public function reset(int $options = null): \Hx\Db\Sql\UpdateInterface;
}
?>