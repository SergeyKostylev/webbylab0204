<?php
/**
 * Created by PhpStorm.
 * User: Sergey
 * Date: 15.12.2017
 * Time: 16:28
 */

namespace Model\Repository;


use Model\Entity\Film;

class FilmRepository
{
    /**
     *  @var \PDO
     */
    protected $pdo;

    public function setPdo(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll($search = '%%', $field = 'fi.name')
    {

        $sql =('SELECT fi.id, fi.name, fi.year, fo.name as format, GROUP_CONCAT(a.name SEPARATOR \', \') as actors  FROM film fi 

                                                                    JOIN format fo
                                                                    ON fo.id = fi.format_id
                                                        
                                                                    LEFT JOIN film_actor fa
                                                                    ON fi.id = fa.film_id
                                                                    
                                                                    LEFT JOIN actor a
                                                                    ON a.id = fa.actor_id
                                                                    
                                                                    GROUP BY fi.id
                                                                    
                                                                    HAVING '.$field.' Like :search 
                                                                    
                                                                    ORDER BY  fi.name ;');

        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'search' => $search,
        ]);
        $collection = [];

        while ($res = $sth->fetch(\PDO::FETCH_ASSOC)){
            $film = new Film(
                $res['id'],$res['name'],$res['year'], $res['format'], $res['actors']
            );
            $collection[]= $film;
        }

        return $collection;
    }

    public function find($id)
    {
        $sql = 'SELECT fi.id, fi.name, fi.year, fo.name as format, GROUP_CONCAT(a.name SEPARATOR \', \') as actors  FROM film fi 

                                                                    JOIN format fo
                                                                    ON fo.id = fi.format_id
                                                        
                                                                    LEFT JOIN film_actor fa
                                                                    ON fi.id = fa.film_id
                                                                    
                                                                    LEFT JOIN actor a
                                                                    ON a.id = fa.actor_id
                                                                    
                                                                    GROUP BY fi.id
                                                                    HAVING fi.id = :id
                                                                    ;';

        $sth = $this->pdo->prepare($sql);
        $sth->execute([
                'id' => $id
        ]);

        $res = $sth->fetch(\PDO::FETCH_ASSOC);

        if (!$res){
            return false;
        }

        return new Film(
                $res['id'],$res['name'],$res['year'], $res['format'], $res['actors']
            );

    }

    public function add($name, $year, $format)
    {
        $sql = 'INSERT INTO film (id, `name`, `year`, `format_id`) VALUES (NULL, :f_name, :f_year, :f_format);';

        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'f_name' => $name,
            'f_year' => $year,
            'f_format' => $format,
        ]);

        return  $this->pdo->lastInsertId();

    }

    public function addActorToFilm($film_id, $actor_id)
    {
        $sql = 'INSERT INTO film_actor (film_id, actor_id) VALUES (:film_id, :actor_id);';

        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'film_id' => $film_id,
            'actor_id' => $actor_id,

        ]);

        return  $this->pdo->lastInsertId();

    }

    public function delete($id)
    {
        $film = $this->find($id);
        if (!$film){
            return ([
                'code' => 404,
                'answer' => "Фильм не найден"
            ]);
        }

        $sql = 'DELETE FROM film WHERE film.id = :id';
        $sth = $this->pdo->prepare($sql);
        $sth->execute([
            'id' => $id
        ]);

        return ([
            'code' => 200,
            'answer' => "Фильм удален"
        ]);

    }
}