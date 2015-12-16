<?php 
namespace Hx\Db\Sql;

interface InsertInterface {
	const RESET_SQL = 1;
	const RESET_PARAM = 2;
	
	public function execute(array $param = null);
	
	public function generateSql();
	
	public function table($tableName);
	
	public function column($name, $value);
	
	public function reset($options = null);
	
	public function param($paramName, $value);
}
?>