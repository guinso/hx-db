<?php 
namespace Hx\Db\Sql;

class Update implements UpdateInterface {
	
	private $db, $table, $column, $where, $param;
	
	public function __construct(\Hx\Db\DbInterface $db)
	{
		$this->db = $db;
		
		$this->reset(self::RESET_PARAM | self::RESET_SQL);
	}
	
	public function execute(array $param = null)
	{
		return $this->db->runSql(
			$this->generateSql(), 
			empty($param)? $this->param : $param
		);
	}
	
	public function generateSql()
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
	
	public function table($tableName)
	{
		$this->table = $tableName;
		
		return $this;
	}
	
	public function column($name, $value)
	{
		$this->column[$name] = $value;
		
		return $this;
	}
	
	public function where($clause)
	{
		$this->where[] = $clause;
		
		return $this;
	}
	
	public function param($paramName, $value)
	{
		$this->param[$paramName] = $value;
		
		return $this;
	}
	
	public function reset($options = null)
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