<?php 
namespace Hx\Db;

class AlphaNumericId {
	
	private $selectSql, $alpha, $length;
	
	public function __construct(
			\Hx\Db\Sql\SelectInterface $selectSql, 
			$alpha, 
			$numericLength)
	{
		$this->selectSql = $selectSql;
		
		$this->alpha = $alpha;
		
		$this->length = $numericLength;
	}
	
	public function getNextId($tableName, $columnName)
	{
		$this->selectSql
			->reset()
			->table("$tableName")
			->select("$columnName")
			->order("$columnName DESC")
			->where("$columnName REGEXP '^" .
				$this->alpha . '[0-9]{' . $this->length . '}$\'');
		
		$raw = $this->selectSql->execute();
		
		if ($raw->rowCount() == 0)
		{
			$number = str_pad(1, $this->length, '0', STR_PAD_LEFT);
		}
		else
		{
			$row = $raw->fetch();
			
			$n = intval(substr($row[$columnName], 1)) + 1;
			
			$number = str_pad($n, $this->length, '0', STR_PAD_LEFT);
		}
		
		return $this->alpha . $number;
	}
}
?>