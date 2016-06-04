<?php 
declare(strict_types=1);

namespace Hx\Db\Sql;

class Select implements SelectInterface {

	private $param, $db;
	
	private $select, $where, $group, $join, $order, $table, $pgIndex, $pgSize;
	
	private $hasPagination;
	
	public function __construct(\Hx\Db\DbInterface $db)
	{
		$this->db = $db;
		
		$this->reset(self::RESET_PARAM | self::RESET_SQL);
	}
	
	public function execute(array $param = null): \PDOStatement
	{
		return $this->db->runSql(
			$this->generateSql(), 
			empty($param)? 
				$this->param : $param);
	}
	
	public function generateSql(): string
	{
		$sql = '';
	
		//select
		if (count($this->select) > 0) {
			$tmp = '';
			for ($i=0; $i< count($this->select); $i++) {
				$select = $this->select[$i];
	
				$tmp .= ($i==0? ' ': ' ,') . $this->select[$i];
			}
				
			$sql .= ' SELECT ' . $tmp;
		} else {
			$sql .= ' SELECT *';
		}
	
		//from
		$sql .= ' FROM ' . $this->table . ' ';
	
		//join
		foreach ($this->join as $join) {
			$sql .= ' ' .
				$join['mode'] . ' ' . $join['table'] . 
				' ON ' . $join['condition'];
		}
	
		//where
		if (count($this->where) > 0) {
			$tmp = '';
			for ($i=0; $i<count($this->where); $i++) {
				$whr = $this->where[$i];
				$tmp .= ($i==0? ' ': ' AND ') . $whr;
			}
				
			$sql .= ' WHERE ' . $tmp;
		}
	
		//group
		if (count($this->group) > 0) {
			$tmp = '';
			for ($i=0; $i<count($this->group); $i++) {
				$grp = $this->group[$i];
				$tmp .= ($i==0? ' ' : ' ,') . $grp;
			}
	
			$sql .= ' GROUP BY ' . $tmp;
		}
	
		//order
		if (count($this->order) > 0) {
			$tmp = '';
			for ($i=0; $i<count($this->order); $i++) {
				$tmp .= ($i==0? ' ' : ' ,') . $this->order[$i];
			}
				
			$sql .= ' ORDER BY ' . $tmp;
		}
	
		//pagination
		if ($this->hasPagination === true) {
			$pgSize = $this->pgSize;
			$offset = $this->pgIndex * $this->pgSize;
			$sql .= " LIMIT $pgSize OFFSET $offset";
		}
	
		return $sql;
	}
	
	public function reset(int $options = null): \Hx\Db\Sql\SelectInterface
	{
		if (is_null($options))
			$options = self::RESET_PARAM | self::RESET_SQL;
		
		if (($options & self::RESET_PARAM) > 0)
			$this->param = array();
		
		if (($options & self::RESET_SQL) > 0)
		{
			$this->table = '';
			
			$this->select = array();
			
			$this->where = array();
			
			$this->group = array();
			
			$this->join = array();
			
			$this->order = array();
			
			$this->pgIndex = 0;
			
			$this->pgSize = 0;
			
			$this->hasPagination = false;
		}
		
		return $this;
	}
	
	public function select(string $column): \Hx\Db\Sql\SelectInterface
	{
		$this->select[] = $column;
		
		return $this;
	}
	
	public function table(string $tableName): \Hx\Db\Sql\SelectInterface
	{
		$this->table = $tableName;
		
		return $this;
	}
	
	public function where(string $clause): \Hx\Db\Sql\SelectInterface
	{
		$this->where[] = $clause;
		
		return $this;
	}
	
	public function order(string $column): \Hx\Db\Sql\SelectInterface
	{
		$this->order[] = $column;
		
		return $this;
	}
	
	public function group(string $column): \Hx\Db\Sql\SelectInterface
	{
		$this->group[] = $column;
		
		return $this;
	}
	
	public function join(string $mode, string $table, string $clause): \Hx\Db\Sql\SelectInterface
	{
		$this->join[] = array(
			'mode' => $mode,
			'table' => $table,
			'condition' => $clause
		);
		
		return $this;
	}
	
	public function paginate(int $pageIndex, int $pageSize): \Hx\Db\Sql\SelectInterface
	{
		$this->hasPagination = true;
		
		$this->pgIndex = $pageIndex;
		
		$this->pgSize = $pageSize;
		
		return $this;
	}
	
	public function param(string $paramName, mixed $value): \Hx\Db\Sql\SelectInterface
	{
		$this->param[$paramName] = $value;
		
		return $this;
	}
}
?>