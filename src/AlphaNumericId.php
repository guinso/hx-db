<?php 
declare(strict_types=1);

namespace Hx\Db;

class AlphaNumericId {
	
	private $selectSql, $alpha, $length;
	
	public function __construct(
			\Hx\Db\Sql\SelectInterface $selectSql, 
			string $alpha, 
			int $numericLength)
	{
		$this->selectSql = $selectSql;
		
		$this->alpha = $alpha;
		
		$this->length = $numericLength;
	}
	
	/**
	 * Get next increment alphanumeric ID for that data column
	 * @param string $tableName
	 * @param string $columnName
	 * @return string
	 */
	public function getNextId(string $tableName, string $columnName): string
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