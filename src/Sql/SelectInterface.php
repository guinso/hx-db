<?php 
declare(strict_types=1);

namespace Hx\Db\Sql;

interface SelectInterface {
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
	 * Reset current configuration
	 * @param int $options
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function reset(int $options = null): \Hx\Db\Sql\SelectInterface;
	
	/**
	 * Add select column
	 * @param string $column
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function select(string $column): \Hx\Db\Sql\SelectInterface;
	
	/**
	 * Set data table
	 * @param string $tableName
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function table(string $tableName): \Hx\Db\Sql\SelectInterface;
	
	/**
	 * Set where clause
	 * @param string $clause
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function where(string $clause): \Hx\Db\Sql\SelectInterface;
	
	/**
	 * Set order clause
	 * @param string $column
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function order(string $column): \Hx\Db\Sql\SelectInterface;
	
	/**
	 * Set group clause
	 * @param string $column
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function group(string $column): \Hx\Db\Sql\SelectInterface;
	
	/**
	 * Set join clause
	 * @param string $mode	join mode; innerjoin, outerjoin
	 * @param string $table targeted join table name
	 * @param string $clause join condition
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function join(string $mode, string $table, string $clause): \Hx\Db\Sql\SelectInterface;
	
	/**
	 * Apply pagination
	 * @param int $pageIndex data offet index value; zero based value
	 * @param int $pageSize pagination size
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function paginate(int $pageIndex, int $pageSize): \Hx\Db\Sql\SelectInterface;
	
	/**
	 * Add binding parameter
	 * @param string $paramName
	 * @param mixed $value
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function param(string $paramName, mixed $value): \Hx\Db\Sql\SelectInterface;
}
?>