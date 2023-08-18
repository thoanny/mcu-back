<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\Admin\MovieType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class MovieController extends AbstractController
{
    private ProductRepository $productRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(ProductRepository $productRepository, EntityManagerInterface $entityManager)
    {
        $this->productRepository = $productRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/movies', name: 'app_admin_movies')]
    public function index(): Response
    {
        $movies = $this->productRepository->findBy(['type' => 'movie']);
        return $this->render('admin/movie/index.html.twig', [
            'movies' => $movies,
        ]);
    }

    #[Route('/admin/movies/edit/{id}', name: 'app_admin_movie_edit', defaults: ['id' => null])]
    public function edit(Request $request, $id): Response
    {
        if($id) {
            $movie = $this->productRepository->findOneBy(['id' => $id, 'type' => 'movie']);
            if(!$movie) {
                $this->addFlash('error', 'Movie not found');
                return $this->redirectToRoute('app_admin_movies');
            }
        } else {
            $movie = new Product();
        }

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $movie = $form->getData();
            $movie->setType('movie');
            $this->entityManager->persist($movie);
            $this->entityManager->flush();
            $this->addFlash('success', 'Movie saved');
            return $this->redirectToRoute('app_admin_movies');
        }

        return $this->render('admin/movie/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin/movies/delete/{id}', name: 'app_admin_movie_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete($id): RedirectResponse
    {
        $movie = $this->productRepository->findOneBy(['id' => $id, 'type' => 'movie']);
        if(!$movie) {
            $this->addFlash('error', 'Movie not found');
            return $this->redirectToRoute('app_admin_movies');
        }

        $this->entityManager->remove($movie);
        $this->entityManager->flush();
        $this->addFlash('success', 'Movie deleted');
        return $this->redirectToRoute('app_admin_movies');
    }
}
