<?php

namespace App\Controller;

use App\Entity\Locality;
use App\Repository\LocalityRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LocalityController extends AbstractController
{
    #[Route('/locality', name: 'app_locality')]
    public function index(LocalityRepository $localityRepository): Response
    {
        $localities = $localityRepository->findAll();


        return $this->render('locality/index.html.twig', [
            'localities' => $localities,
        ]);
    }

    #[Route('/locality/{id}', name: 'app_locality_show', methods: ['GET'])]
    public function show(Locality $locality): Response
    {
        return $this->render('locality/show.html.twig', [
            'locality' => $locality,
        ]);
    }
}
