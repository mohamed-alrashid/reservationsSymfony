<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/artist')]
final class ArtistController extends AbstractController
{
    #[Route('/', name: 'app_artist_index', methods: ['GET'])]
    public function index(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findAll();

        return $this->render('artist/index.html.twig', [
            'artists' => $artists,
            'title' => 'Liste des artistes',
        ]);
    }

    #[Route('/{id}', name:'app_artist_show', methods: ['GET'])]
    public function show(Artist $artist, ArtistRepository $respository) : Response
    {
        $artist = $respository->find($artist);

        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
            'title' => "Fiche d'un artiste",
        ]);
    }

    #[Route('/{id}/edit', name: 'artist_edit', methods: ['GET','POST','PUT'])]
    public function edit(Request $request, Artist $artist, ArtistRepository $artistRepository, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde les changements en base de données
            $artistRepository->getEntityManager()->flush();
            
            // Redirige vers la liste pour voir le changement
            return $this->redirectToRoute('app_artist_index',[],Response::HTTP_SEE_OTHER);
        }

        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    } 
}
