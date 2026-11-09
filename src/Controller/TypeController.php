<?php

namespace App\Controller;

use App\Entity\Type;
use App\Repository\TypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TypeController extends AbstractController
{
    /**
     * @Route("/type", name="app_type")
     */
    #[Route('/type', name: 'app_type')]
    public function index(TypeRepository $typeRepository): Response
    {
        $types = $typeRepository->findAll();

        return $this->render('type/index.html.twig', [
            'types' => $types,
        ]);
    }
    /**
     * @Route("/type/{id}", name="app_type_show")
     */

    #[Route('/type/{id}', name: 'app_type_show', methods: ['GET'])]
    public function show(Type $type): Response
    {
        return $this->render('type/show.html.twig', [
            't' => $type,
        ]);
    }
}
