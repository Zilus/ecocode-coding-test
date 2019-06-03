<?php
/**
 * IGNORE FIXTURE FILES
 */
namespace App\DataFixtures;

use App\Entity\Movie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MovieFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $movies = [
            [
                'title'  => 'Dark Phoenix',
                'genres' => [
                    $this->getReference('GENRE_ACTION'),
                    $this->getReference('GENRE_ADVENTURE'),
                    $this->getReference('GENRE_SCI_FI'),
                ]
            ],
            [
                'title'  => 'Aladdin (2019)',
                'genres' => [
                    $this->getReference('GENRE_ADVENTURE'),
                    $this->getReference('GENRE_COMEDY'),
                    $this->getReference('GENRE_FAMILY'),
                    $this->getReference('GENRE_FANTASY'),
                    $this->getReference('GENRE_MUSICAL'),
                    $this->getReference('GENRE_ROMANCE'),
                ]
            ]
        ];

        foreach ($movies as $movieData) {
            {

                $movie = new Movie();

                $movie->setTitle($movieData['title']);

                foreach ($movieData['genres'] as $genreReference) {
                    $movie->addGenre($genreReference);
                }

                $manager->persist($movie);
            }
        }


        $manager->flush();
    }
}
