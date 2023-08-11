<?php

namespace App\Controller\Admin;

use App\Repository\EpisodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EpisodeController extends AbstractController
{
    private EpisodeRepository $episodeRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(EpisodeRepository $episodeRepository, EntityManagerInterface $entityManager)
    {
        $this->episodeRepository = $episodeRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/episodes', name: 'app_admin_episodes')]
    public function index(): Response
    {
        $episodes = $this->episodeRepository->findAll();
        return $this->render('admin/episode/index.html.twig', [
            'episodes' => $episodes,
        ]);
    }

    #[Route('/admin/episodes/delete/{id}', name: 'app_admin_episode_delete')]
    public function delete($id): RedirectResponse
    {
        $episode = $this->episodeRepository->findOneBy(['id' => $id]);
        if(!$episode) {
            $this->addFlash('error', 'Episode not found');
            return $this->redirectToRoute('app_admin_episodes');
        }

        $this->entityManager->remove($episode);
        $this->entityManager->flush();
        $this->addFlash('success', 'episode deleted');
        return $this->redirectToRoute('app_admin_episodes');
    }
}
