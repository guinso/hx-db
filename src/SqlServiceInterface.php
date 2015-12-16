<?php 
namespace Hx\Db;

interface SqlServiceInterface {
	
	public function createSelectSql();
	
	public function createInsertSql();
	
	public function createUpdateSql();
}
?>