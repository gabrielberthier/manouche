<?php

namespace Manouche\Models;
use App\Core\Database\QueryBuilder;

abstract class AbstractModel
{
    /**
     * @Inject
     * @var QueryBuilder
     */
    protected $database;
    
    /**
     * This variable defines the table we want to query
     *
     * @var string
     */
    protected $tableName;


    public function getAll()
    {
        if(!empty(trim($this->tableName))){
            return $this->database->selectAll($this->tableName);
        }
        throw new \Exception("Table name cannot be empty");
    }

    public function save(array $fields)
    {
        $table = trim($this->tableName);
        if(empty($table)){
            throw new \Exception("Table name cannot be empty");
        }
        elseif(empty($fields)){
            throw new \Exception("No arguments passed to be saved in database");
        }
        else{
            $this->database->insert($table, $fields);
        }
    }

}
