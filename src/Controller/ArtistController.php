<?php


namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Track;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtistController extends AbstractController
{
    /**
     * @Route("/artist", name="create_artist")
     */
    public function createArtist(): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $artist = new Artist();
        $artist->setName('Mike Miller');
        $entityManager->persist($artist);

        $artist1 = new Artist();
        $artist1->setName('J-cole');
        $entityManager->persist($artist1);

        $artist2 = new Artist();
        $artist2->setName('Aaron May');
        $entityManager->persist($artist2);
        $entityManager->flush();

        return $this->render('playlist/index.html.twig');
    }
    /**
     * @Route("/track", name="create_track")
     */
    public function createTrack(EntityManagerInterface $entityManager): Response
    {
        $artist = $this->getDoctrine()
            ->getRepository(Artist::class)
            ->findOneBy(['name' => 'Aaron May']);

        $track = new Track();
        $track->setName('I love the song');
        $track->setArtist($artist);

        $entityManager->persist($track);
        $entityManager->flush();

        dd($track);
    }
}