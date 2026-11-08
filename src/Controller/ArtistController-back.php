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

    #[Route('/new', name: 'artist_new', methods:['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($artist);
            $em->flush();

            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'artist_delete', methods:['POST','DELETE'])]
    public function delete(Request $request, Artist $artist, EntityManagerInterface $em): Response
    {
        if($this->isCsrfTokenValid('delete'.$artist->getId(), $request->request->get('_token'))){
            $em->remove($artist);
            $em->flush();
        }

        return $this->redirectToRoute('app_artist_index',[], Response::HTTP_SEE_OTHER);
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
    public function edit(Request $request, Artist $artist, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            
            return $this->redirectToRoute('app_artist_index',[],Response::HTTP_SEE_OTHER);
        }

        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    } 


}
