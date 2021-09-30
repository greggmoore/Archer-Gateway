<?php
namespace Fogg\Db\Sync;

/**
 * DB Sync is a simple class for synchronizing tables across multiple database
 * connections. By using PDO, you can easily synchronize records across varying
 * types of databases, such as MySql and SqlLite. Once the object is
 * instantiated, simply call the syncTable method and the class will do the rest.
 *
 *
 * @author jacobfogg
 *
 */
 
class Sync{
	private $fromDb;
	private $toDb;


	public function __construct(\PDO $fromDb = null, \PDO $toDb = null){
		//TODO: Validate each db is a db instance
		if($fromDb !== null){
			$this->setFromDb($fromDb);
		}
		if($toDb !== null){
			$this->setToDb($toDb);
		}
	}

	/**
	 * Synchronizes a table between two databases. Expects minimally a table name
	 * but can optionally take a comma separated field list and a valid where
	 * statement condition list. Also you can choose to truncate the receiving
	 * table (true by default) or delete rows in your table by passing in a
	 * table field key to base the row delete on (false by default).
	 *
	 * @param string $table The name of the table to copy records from
	 * @param string $fieldList A comma separated list of fields to select form
	 * @param string $conditionList A valid where statement used to limit the
	 * rows that are selected from
	 * @param bool $truncateBeforeInsert Determines if the table should be
	 * truncated prior to inserts (default: true)
	 * @param bool|string $deleteBeforeInsertFieldKeyDetermines if rows should
	 * be deleted prior to insert, and what field key to use
	 * @throws \Exception if both the from and to databases are not populated
	 */
	public function syncTable($table, $fieldList = '*', $conditionList = '', $truncateBeforeInsert = true, $deleteBeforeInsertFieldKey = false){
		if(!$this->fromDb || !$this->toDb){
			throw new \Exception('You must set the databases to be synced.');
		}

		$res = $this->selectContent($table, $fieldList, $conditionList);
		$this->insertContent($table, $res, $truncateBeforeInsert, $deleteBeforeInsertFieldKey);
	}

	/**
	 * Selects the records from the sending database to be synced to the
	 * receiving database.
	 *
	 * @param string $table The name of the table to select records from
	 * @param string $fieldList A comma separated list of fields to select from
	 * @param string $conditionList A valid where statement used to limit the
	 * rows that are selected from
	 * @throws \Exception if the select query fails
	 * @return PDOStatement
	 */
	private function selectContent($table, $fieldList, $conditionList){
		$sql = sprintf("SELECT %s FROM %s", $fieldList, $table);
		if($conditionList != ''){
			$sql .= sprintf(" WHERE %s", $conditionList);
		}

		if(($res = $this->fromDb->query($sql)) === false){
			throw new \Exception("The select query failed: $sql");
		}

		return $res;
	}

	/**
	 * Inserts records into the receiving database. Can optionally truncate the
	 * table or delete rows prior to insert attempts.
	 *
	 * @param string $table The name of the table to insert records to
	 * @param \PDOStatement $res A valid Result
	 * @param bool $truncateBeforeInsert Determines if the table should be
	 * truncated prior to inserts
	 * @param bool|string $deleteBeforeInsertFieldKey Determines if rows should
	 * be deleted prior to insert, and what field key to use
	 * @throws \Exception if a any of the queries fail.
	 */
	private function insertContent($table, $res, $truncateBeforeInsert, $deleteBeforeInsertFieldKey){
		if($truncateBeforeInsert){
			if($this->toDb->exec(sprintf("TRUNCATE %s", $table))===false){
				throw new \Exception('Could not truncate the table prior to inserting.');
			}
		}
		$res->setFetchMode(\PDO::FETCH_ASSOC);
		$sql = '';
		while(($row = $res->fetch()) !== false){
			if($sql == ''){
				$keys = implode(', ', array_keys($row));
				$values = ':' . implode(', :', array_keys($row));
				$sql = sprintf("INSERT INTO %s ({$keys}) VALUES ({$values});",$table);
				$qry = $this->toDb->prepare($sql);

				if($deleteBeforeInsertFieldKey !== false){
					$deleteSql = sprintf("DELETE FROM %s WHERE %s = :%s", $table, $deleteBeforeInsertFieldKey, $deleteBeforeInsertFieldKey);
					$deleteQry = $this->toDb->prepare($deleteSql);
				}
			}

			if($deleteBeforeInsertFieldKey!==false){
				if($deleteQry->execute([$deleteBeforeInsertFieldKey=>$row[$deleteBeforeInsertFieldKey]])===false){
					throw new \Exception('There was a problem deleting a row prior to insert.');
				}
			}

			if($qry->execute($row)===false){
				throw new \Exception('There was a problem inserting one of the records.');
			}
		}
	}

	/**
	 * Set the database that you want to sync records from
	 *
	 * @param \PDO $fromDb A valid PDO Database
	 */
	public function setFromDb(\PDO $fromDb){
		$this->fromDb = $fromDb;
	}
	/**
	 * Set the database that you want to sync records to
	 *
	 * @param \PDO $toDb A valid PDO Database
	 */
	public function setToDb(\PDO $toDb){
		$this->toDb = $toDb;
	}
}

/* End of file DB_Sync.php */
/* Location: ./application/libraries/DB_Sync.php */