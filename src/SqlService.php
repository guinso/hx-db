<?php 
namespace Hx\Db;

class SqlService implements SqlServiceInterface {
	
	private $db;
	
	public function __construct(DbInterface $db)
	{
		$this->db = $db;
	}
	
	public function createSelectSql()
	{
		return new Sql\Select($this->db);
	}
	
	public function createInsertSql()
	{
		return new Sql\Insert($this->db);
	}
	
	public function createUpdateSql()
	{
		return new Sql\Update($this->db);
	}
	
	public function getDb()
	{
		return $this->db;
	}
}
?>