<?php
namespace Model\Repository;

use Model\Entity\Actor;

class ActorRepository
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
        $sth = $this->pdo->query('SELECT * FROM  actor;');

        $collection = [];

        while ($res = $sth->fetch(\PDO::FETCH_ASSOC)){
            $actor = new Actor(
                $res['id'],
                $res['name']
            );
            $collection[]= $actor;
        }

        return $collection;
    }

    public function findByName($full_name)
    {
        $sql = 'SELECT * FROM actor WHERE name = :full_name;';

        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'full_name' => $full_name
        ]);

        $res = $sth->fetch(\PDO::FETCH_ASSOC);

        if (!$res){
            return false;
        }

        return new Actor(
            $res['id'],$res['name']
        );

    }


    public function add($name)
    {
        $sql = 'INSERT INTO actor (id, `name`) VALUES (NULL, :a_name);';

        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'a_name' => $name,
        ]);

        return  $this->pdo->lastInsertId();

    }
}