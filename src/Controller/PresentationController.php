<?php

namespace App\Controller;

use App\Entity\Presentation;
use App\Form\PresentationType;
use App\Repository\PresentationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Project;
use App\Repository\ProjectRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

#[Route('/presentation')]
class PresentationController extends AbstractController
{
    #[Route('/project/{projectId}', name: 'app_presentation_index', methods: ['GET'])]
    public function index(
        int $projectId,
        PresentationRepository $presRepository,
        ProjectRepository $projRepository
    ): Response {
        $presentations = $presRepository->findBy(['project' => $projectId]);

        $project = $projRepository->find($projectId);
        $website = $project ? $project->getWebsite() : null;

        return $this->render('presentation/index.html.twig', [
            'presentations' => $presentations,
            'projectId' => $projectId,
            'website' => $website
        ]);
    }



    #[Route('/new/{projectId}', name: 'app_presentation_new', methods: ['GET', 'POST'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function new(Request $request, EntityManagerInterface $entityManager, int $projectId): Response
    {
        $project = $entityManager->getRepository(Project::class)->find($projectId);

        if (!$project) {
            throw $this->createNotFoundException('The project does not exist');
        }

        $presentation = new Presentation();
        $presentation->setProject($project);
        $presentation = new Presentation();
        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($presentation);
            $entityManager->flush();

            return $this->redirectToRoute(
                'app_admin_presentation',
                ['projectId' => $projectId],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('presentation/new.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
            'projectId' => $projectId
        ]);
    }

    #[Route('/{id}', name: 'app_presentation_show', methods: ['GET'])]
    public function show(Presentation $presentation): Response
    {
        return $this->render('presentation/show.html.twig', [
            'presentation' => $presentation,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_presentation_edit', methods: ['GET', 'POST'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function edit(Request $request, Presentation $presentation, EntityManagerInterface $entityManager): Response
    {

        $projectId = $presentation->getProject()->getId();
        $form = $this->createForm(PresentationType::class, $presentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute(
                'app_admin_presentation',
                ['projectId' => $projectId],
                Response::HTTP_SEE_OTHER
            );
        }

        return $this->render('presentation/edit.html.twig', [
            'presentation' => $presentation,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_presentation_delete', methods: ['POST'])]
    #[Security('is_granted("ROLE_ADMIN")')]
    public function delete(
        Request $request,
        Presentation $presentation,
        EntityManagerInterface $entityManager
    ): Response {
        $projectId = $presentation->getProject()->getId();

        if ($this->isCsrfTokenValid('delete' . $presentation->getId(), $request->request->get('_token'))) {
            $entityManager->remove($presentation);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_presentation_index', ['projectId' => $projectId], Response::HTTP_SEE_OTHER);
    }
}
