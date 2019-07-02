<?php

namespace Manouche\Models;

use Doctrine\ORM\EntityManager;

abstract class AbstractModel
{
    /**
     * @Inject
     * @var EntityManager
     */
    protected $database;

    /**
     * This variable defines the table we want to query
     *
     * @var string
     */
    protected $tableName;

    /**
     * This variable defines which fields can be filled
     *
     * @var array
     */
    protected $fillable = [];

    public function getAll()
    {
        return $this->database->getRepository(static::class)->findAll();
    }

    public function save()
    {
        try{
            $this->database->persist($this);
            $this->database->flush();
        }
        catch(\Exception $ex){
            echo $ex->getMessage(); die;
            $this->database->rollback();
            die("Erro");
        }
    }

    public function fillInstance(array $fields)
    {
        foreach ($this->fillable as $key => $value) {
            echo "$key and $value <br>";
            if (key_exists($value, $fields)) {
                $this->{$value} = $fields[$value];
            } else {
                echo "cool";
            }
        }
        dd($this);
    }
}
