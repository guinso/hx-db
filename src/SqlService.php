<?php 
declare(strict_types=1);

namespace Hx\Db;

class SqlService implements SqlServiceInterface {
	
	private $db;
	
	public function __construct(DbInterface $db)
	{
		$this->db = $db;
	}
	
	public function createSelectSql(): \Hx\Db\Sql\SelectInterface
	{
		return new Sql\Select($this->db);
	}
	
	public function createInsertSql(): \Hx\Db\Sql\InsertInterface
	{
		return new Sql\Insert($this->db);
	}
	
	public function createUpdateSql(): \Hx\Db\Sql\UpdateInterface
	{
		return new Sql\Update($this->db);
	}
	
	public function getDb(): \Hx\Db\DbInterface
	{
		return $this->db;
	}
}
?>