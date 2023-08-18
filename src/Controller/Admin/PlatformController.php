<?php

namespace App\Controller\Admin;

use App\Entity\Platform;
use App\Form\Admin\PlatformType;
use App\Repository\PlatformRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class PlatformController extends AbstractController
{
    private PlatformRepository $platformRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(PlatformRepository $platformRepository, EntityManagerInterface $entityManager)
    {
        $this->platformRepository = $platformRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/platforms', name: 'app_admin_platforms')]
    public function index(): Response
    {
        $platforms = $this->platformRepository->findAll();
        return $this->render('admin/platform/index.html.twig', [
            'platforms' => $platforms,
        ]);
    }

    #[Route('/admin/platforms/edit/{id}', name: 'app_admin_platform_edit', defaults: ['id' => null])]
    public function edit(Request $request, $id): Response
    {
        if($id) {
            $platform = $this->platformRepository->findOneBy(['id' => $id]);
            if(!$platform) {
                $this->addFlash('error', 'Platform not found');
                return $this->redirectToRoute('app_admin_platforms');
            }
        } else {
            $platform = new Platform();
        }

        $form = $this->createForm(PlatformType::class, $platform);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $platform = $form->getData();
            $this->entityManager->persist($platform);
            $this->entityManager->flush();
            $this->addFlash('success', 'Platform saved');
            return $this->redirectToRoute('app_admin_platforms');
        }

        return $this->render('admin/platform/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin/platforms/delete/{id}', name: 'app_admin_platform_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete($id): Response
    {
        $platform = $this->platformRepository->findOneBy(['id' => $id]);
        if(!$platform) {
            $this->addFlash('error', 'Platform not found');
            return $this->redirectToRoute('app_admin_platforms');
        }

        $this->entityManager->remove($platform);
        $this->entityManager->flush();
        $this->addFlash('success', 'Platform deleted');
        return $this->redirectToRoute('app_admin_platforms');
    }
}
