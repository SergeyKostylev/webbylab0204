<?php
namespace Model\Repository;

use Model\Entity\Format;

class FormatRepository
{
    /**
     *  @var \PDO
     */
    protected $pdo;

    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        $sth = $this->pdo->query('SELECT * FROM format;');

        $collection = [];

        while ($res = $sth->fetch(\PDO::FETCH_ASSOC)){
            $format = new Format(
                $res['id'],
                $res['name']
            );
            $collection[]= $format;
        }

        return $collection;
    }

    public function find($id)
    {
        $sql = 'SELECT * FROM format WHERE id =:id;';

        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'id' => $id
        ]);

        $res = $sth->fetch(\PDO::FETCH_ASSOC);

        if (!$res){
            return false;
        }

        return new Format(
            $res['id'],$res['name']
        );

    }

    public function findId($name)
    {
        $sql = 'SELECT id FROM format WHERE name = :name;';

        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'name' => $name
        ]);

        $res = $sth->fetch(\PDO::FETCH_ASSOC);

        if (!$res){
            return false;
        }

        return $res['id'];

    }
}