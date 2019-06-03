<?php

namespace App\Controller\Movie;

use App\Entity\Movie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ListController extends AbstractController
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        $movieRepository = $this->getDoctrine()->getRepository(Movie::class);

        return $this->render(
            'movie-list.html.twig',
            [
                'movies' => $movieRepository->findAll()
            ]
        );
    }
}

