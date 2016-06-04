<?php 
declare(strict_types=1);

namespace Hx\Db\Sql;

class Update implements UpdateInterface {
	
	private $db, $table, $column, $where, $param;
	
	public function __construct(\Hx\Db\DbInterface $db)
	{
		$this->db = $db;
		
		$this->reset(self::RESET_PARAM | self::RESET_SQL);
	}
	
	public function execute(array $param = null): \PDOStatement
	{
		return $this->db->runSql(
			$this->generateSql(), 
			empty($param)? $this->param : $param
		);
	}
	
	public function generateSql(): string 
	{
		$sql = "UPDATE {$this->table} SET ";
		
		$cnt = 0;
		
		foreach($this->column as $key => $value)
		{
			if ($cnt > 0)
				$sql .= ' ,';
			else 
				$sql .= ' ';
			
			$sql .= "$key = $value";

			$cnt++;
		}
		
		if (count($this->where) > 0)
		{
			$sql .= " WHERE ";
			
			$cnt = 0;
			
			foreach ($this->where as $whr)
			{
				if ($cnt > 0)
				{
					$sql .= " AND ($whr)";
				}
				else 
				{
					$sql .= "($whr)";
				}
				
				$cnt++;
			}
		}
		
		return $sql . ";";
	}
	
	public function table(string $tableName): \Hx\Db\Sql\UpdateInterface
	{
		$this->table = $tableName;
		
		return $this;
	}
	
	public function column(string $name, mixed $value): \Hx\Db\Sql\UpdateInterface
	{
		$this->column[$name] = $value;
		
		return $this;
	}
	
	public function where(string $clause): \Hx\Db\Sql\UpdateInterface
	{
		$this->where[] = $clause;
		
		return $this;
	}
	
	public function param(string $paramName, mixed $value): \Hx\Db\Sql\UpdateInterface
	{
		$this->param[$paramName] = $value;
		
		return $this;
	}
	
	public function reset(int $options = null): \Hx\Db\Sql\UpdateInterface
	{
		if (is_null($options))
			$options = self::RESET_PARAM | self::RESET_SQL;
		
		if (($options & self::RESET_SQL))
		{
			$this->table = '';
			
			$this->column = array();
			
			$this->where = array();
		}
		
		if (($options & self::RESET_PARAM))
		{
			$this->param = array();
		}
		
		return $this;
	}
}
?>