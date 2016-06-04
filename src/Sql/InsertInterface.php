<?php 
declare(strict_types=1);

namespace Hx\Db\Sql;

interface InsertInterface {
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
	 * Set datatable
	 * @param string $tableName
	 * @return \Hx\Db\Sql\InsertInterface
	 */
	public function table(string $tableName): \Hx\Db\Sql\InsertInterface;
	
	/**
	 * Set column to insert
	 * @param string $name
	 * @param unknown $value
	 * @return \Hx\Db\Sql\InsertInterface
	 */
	public function column(string $name, $value): \Hx\Db\Sql\InsertInterface;
	
	/**
	 * Reset configuration
	 * @param int $options
	 * @return \Hx\Db\Sql\InsertInterface
	 */
	public function reset(int $options = null): \Hx\Db\Sql\InsertInterface;
	
	/**
	 * Set binding param
	 * @param string $paramName
	 * @param unknown $value
	 * @return \Hx\Db\Sql\InsertInterface
	 */
	public function param(string $paramName, $value): \Hx\Db\Sql\InsertInterface;
}
?>