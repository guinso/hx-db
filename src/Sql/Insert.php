<?php 
declare(strict_types=1);

namespace Hx\Db\Sql;

class Insert implements InsertInterface {
	
	private $db, $column, $param, $table;
	
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
		$sql = "INSERT  INTO {$this->table} ";
		
		$col = '';
		
		$values = '';
		
		$cnt = 0;
		
		foreach($this->column as $key => $value)
		{
			if ($cnt > 0)
			{
				$col .= ",$key";
				
				$values .= ",$value";
			}
			else 
			{
				$col = $key;
				
				$values = $value;
			}
			
			$cnt++;
		}
		
		return $sql . "($col) values ($values);";
	}
	
	public function table($tableName): \Hx\Db\Sql\InsertInterface
	{
		$this->table = $tableName;
		
		return $this;
	}
	
	public function column(string $name, $value): \Hx\Db\Sql\InsertInterface
	{
		$this->column[$name] = $value;
		
		return $this;
	}
	
	public function reset(int $options = null): \Hx\Db\Sql\InsertInterface
	{
		if (is_null($options))
			$options = self::RESET_PARAM | self::RESET_SQL;
		
		if (($options & self::RESET_SQL) > 0)
		{
			$this->column = array();
			
			$this->table = '';
		}
		
		if(($options & self::RESET_PARAM) > 0)
		{
			$this->param = array();
		}
		
		return $this;
	}
	
	public function param(string $paramName, $value): \Hx\Db\Sql\InsertInterface
	{
		$this->param[$paramName] = $value;
	
		return $this;
	}
}
?>