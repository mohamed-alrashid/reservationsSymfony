<?php

namespace App\Controller;

use App\Entity\Role;
use App\Repository\RoleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RoleController extends AbstractController
{
    #[Route('/role', name: 'app_role')]
    public function index(RoleRepository $roleRepository): Response
    {
        $roles = $roleRepository->findAll();

        return $this->render('role/index.html.twig', [
            'roles' => $roles,
        ]);
    }

    #[Route('/role/{id}', name: 'app_role_show', methods: ['GET'])]
    public function show(Role $role): Response
    {
        return $this->render('role/show.html.twig', [
            'r' => $role,
        ]);
    }
}
