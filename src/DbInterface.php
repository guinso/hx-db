<?php 
namespace Hx\Db;

Interface DbInterface {
	
	/**
	 * Run SQL script from string
	 * @param string $sql
	 */
	public function runSql($sql, array $param = null);
	
	/**
	 * Run SQL script from file
	 * @param string $sqlFilePath	<p>file path of the SQL script</p>
	 */
	public function runSqlFile($sqlFilePath);
}
?>