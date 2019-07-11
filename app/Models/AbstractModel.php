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
     * @Inject
     * @param EntityManager $database
     */
    public function __construct(EntityManager $database) {
        $this->database = $database;
    }

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

    public function find(int $id)
    {
        return $this->database->getRepository(static::class)->find($id);
    }

    public function save()
    {
        try {
            $this->database->persist($this);
            $this->database->flush();
        } catch (\Exception $ex) {
            echo $ex->getMessage();
            die;
            $this->database->rollback();
            die("Erro");
        }
    }

    public function findOneBy(string $key, string $value)
    {
        return $this->database
            ->getRepository(static::class)
            ->findOneBy(array($key => $value));
    }

    public function add(array $request)
    {
        $conn = $this->database->getConnection();
        $queryBuilder = $conn->createQueryBuilder();
        $queryBuilder = $queryBuilder->insert($this->tableName);
        $i = 0;
        foreach ($request as $key => $value) {
            $queryBuilder->setValue($key, "?")->setParameter($i++, $value);
        }
        $queryBuilder->execute();
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
