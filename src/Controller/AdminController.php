<?php

namespace App\Controller;

use App\Repository\PresentationRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('admin/index.html.twig', [
            'projects' => $projects,
        ]);
    }


    #[Route('/admin/presentation/{projectId}', name: 'app_admin_presentation')]
    public function presentation(int $projectId, PresentationRepository $presRepository): Response
    {
        $presentations = $presRepository->findBy(['project' => $projectId]);

        return $this->render('admin/presentation.html.twig', [
            'presentations' => $presentations,
            'projectId' => $projectId,
        ]);
    }
}
