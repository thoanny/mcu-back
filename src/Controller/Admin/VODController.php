<?php

namespace App\Controller\Admin;

use App\Repository\VODRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class VODController extends AbstractController
{
    private VODRepository $VODRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(VODRepository $VODRepository, EntityManagerInterface $entityManager)
    {
        $this->VODRepository = $VODRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/vods', name: 'app_admin_vods')]
    public function index(): Response
    {
        $vods = $this->VODRepository->findAll();
        return $this->render('admin/vod/index.html.twig', [
            'vods' => $vods,
        ]);
    }

    #[Route('/admin/vods/delete/{id}', name: 'app_admin_vod_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete($id): RedirectResponse
    {
        $vod = $this->VODRepository->findOneBy(['id' => $id]);
        if(!$vod) {
            $this->addFlash('error', 'VOD not found');
            return $this->redirectToRoute('app_admin_vods');
        }

        $this->entityManager->remove($vod);
        $this->entityManager->flush();
        $this->addFlash('success', 'VOD deleted');
        return $this->redirectToRoute('app_admin_vods');
    }
}
