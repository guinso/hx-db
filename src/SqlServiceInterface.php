<?php 
declare(strict_types=1);

namespace Hx\Db;

interface SqlServiceInterface {
	
	/**
	 * Create Select SQL instance
	 * @return \Hx\Db\Sql\SelectInterface
	 */
	public function createSelectSql(): \Hx\Db\Sql\SelectInterface;
	
	/**
	 * Create Insert SQL instance
	 * @return \Hx\Db\Sql\InsertInterface
	 */
	public function createInsertSql(): \Hx\Db\Sql\InsertInterface;
	
	/**
	 * Create Update SQL instance
	 * @return \Hx\Db\Sql\UpdateInterface
	 */
	public function createUpdateSql(): \Hx\Db\Sql\UpdateInterface;
	
	/**
	 * Get database handler
	 * @return \Hx\Db\DbInterface
	 */
	public function getDb(): \Hx\Db\DbInterface;
}
?>