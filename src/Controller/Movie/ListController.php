<?php

namespace App\Controller\Movie;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ListController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $currentUser = $this->getUser();

        $movies = $currentUser->getMovies();

        return $this->render(
            'movie-list.html.twig',
            [
                'movies' => $movies
            ]
        );
    }
}

