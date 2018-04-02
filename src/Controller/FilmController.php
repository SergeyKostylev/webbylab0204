<?php

namespace Controller;

use Framework\BaseController;
use Framework\Request;
use Framework\Session;
use Model\Form\FeedbackForm;
use Model\Entity\Feedback;
use Model\Form\FilmForm;
use Model\Service\ImportFile;
use Model\Service\PreparationFile;


class FilmController extends BaseController
{
    public function indexAction(Request $request)
    {
        $search = $request->get('search');
        $field = $request->get('field');
        $message = 'Все фильмы';
        if($search && ($field == 'film')){

            $films = $this
                ->getRepository('Film')
                ->findAll('%' . $search . '%');
            $message = 'Поиск по названию:' .  $search;

        }elseif ($search && ($field == 'actor')){

            $films = $this
                ->getRepository('Film')
                ->findAll('%' . $search . '%', 'actors');

            $message = 'Поиск по актеру:' .  $search;
        }
        else{
        $films = $this
            ->getRepository('Film')
            ->findAll();
        }
        return $this->render('index.html.twig', [
            'films' => $films,
            'message' => $message
        ]);

    }

    public  function importAction(Request $request)
    {

        if(isset($_FILES['import'])){
            $file = $_FILES['import'];

            $import_File = new ImportFile(
                $file['name'],
                $file['type'],
                $file['tmp_name'],
                $file['size']
            );
            if($import_File->isValid()){
            $mime_type = mime_content_type( $import_File->getTmpName());

            if ($mime_type == 'text/plain'){

                $all_formats = $this->getRepository('Format')->findAll();
                $all_actors = $this->getRepository('Actor')->findAll();

                $str = file_get_contents($import_File->getTmpName());

                $films_mas = explode("\n\n",$str);

                $amount = 0;
                if (count($films_mas)){
                    foreach ($films_mas as $film_in_mas){
                        $film_mas = explode("\n",$film_in_mas);
                        if (count($film_mas) == 4){

                            $film_pre = new PreparationFile($film_mas, $all_formats, $all_actors);
                            if ($film_pre->readyToLoad()){
                                $film_id = $this->getRepository('Film')->add($film_pre->getName(), $film_pre->getYear(), $film_pre->getFormat());
                                $actors_array = $film_pre->getActors();
                                $amount++;
                                if (count($actors_array)){
                                    foreach($actors_array as $full_name){

                                        $actor = $this->getRepository('Actor')->findByName($full_name);
                                        if ($actor){
                                            $this->getRepository('Film')->addActorToFilm($film_id, $actor->getId());
                                        }
                                        if(!$actor){
                                            $actor_id = $this->getRepository('Actor')->add($full_name);
                                            $this->getRepository('Film')->addActorToFilm($film_id, $actor_id);
                                        }
                                    }
                                }
                            }

                        }

                    }

                }
                Session::setFlash('Импортировано '. $amount . ' фильмов');

                return $this->getRouter()->redirect('films-import');
            }
            Session::setFlash('Файл должени иметь mime_type =text/plain');
            }
        }
        return $this->render('import.html.twig');
    }

    public function addAction(Request $request)
    {
        $formats = $this->getRepository('Format')->findAll();

        $form = new FilmForm(
            $request->post('name'),
            $request->post('year'),
            $request->post('format'),
            $request->post('actors')
        );
        $format = $this->getRepository('Format')->find($form->getFormat());

        if($request->isPost()){
            Session::setFlash('Некорректно заполнена форма');
            if($form->isValid() && $format){

                $film_id = $this->getRepository('Film')->add(
                    $form->getName(),
                    $form->getYear(),
                    $format->getId()
                );

                $actors_array = explode(", ",$form->getActors());

                foreach($actors_array as $full_name){

                    $actor = $this->getRepository('Actor')->findByName($full_name);
                    if ($actor){
                        $this->getRepository('Film')->addActorToFilm($film_id, $actor->getId());
                    }
                    if(!$actor){
                        $actor_id = $this->getRepository('Actor')->add($full_name);
                        $this->getRepository('Film')->addActorToFilm($film_id, $actor_id);
                    }
                }
                Session::setFlash('Фильм добавлен, можно добавить еще');

                return $this->getRouter()->redirect('films-add');
            }

        }

        return $this->render('add.html.twig', [
            'formats' => $formats,
            'form' => $form

        ]);

    }

    public function infoAction(Request $request)
    {
        $film_id = $request->get('id');

        $film = $this
            ->getRepository('Film')
            ->find($film_id);

        return $this->render('info.html.twig', ['film' => $film]);

    }

    public function deleteAction(Request $request)
    {
        $film_id = $request->get('id');

        $film = $this
            ->getRepository('Film')
            ->delete($film_id);

        http_response_code($film['code']);
        header('Content-type: application/json');
        return json_encode([
            'answer' => $film['answer']
        ]);
    }

}