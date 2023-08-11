<?php

namespace App\Controller\Admin;

use App\Entity\Episode;
use App\Entity\Product;
use App\Form\Admin\ShowType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ShowController extends AbstractController
{
    private ProductRepository $productRepository;

    private EntityManagerInterface $entityManager;

    public function __construct(ProductRepository $productRepository, EntityManagerInterface $entityManager)
    {
        $this->productRepository = $productRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/shows', name: 'app_admin_shows')]
    public function index(): Response
    {
        $shows = $this->productRepository->findBy(['type' => 'show']);
        return $this->render('admin/show/index.html.twig', [
            'shows' => $shows,
        ]);
    }

    #[Route('/admin/shows/edit/{id}', name: 'app_admin_show_edit', defaults: ['id' => null])]
    public function edit(Request $request, $id): Response
    {
        if($id) {
            $show = $this->productRepository->findOneBy(['id' => $id, 'type' => 'show']);
            if(!$show) {
                $this->addFlash('error', 'Show not found');
                return $this->redirectToRoute('app_admin_shows');
            }
        } else {
            $show = new Product();
        }

        $form = $this->createForm(ShowType::class, $show);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $show = $form->getData();
            $show->setType('show');
            $this->entityManager->persist($show);
            $this->entityManager->flush();
            $this->addFlash('success', 'Show saved');
            return $this->redirectToRoute('app_admin_shows');
        }

        return $this->render('admin/show/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin/shows/delete/{id}', name: 'app_admin_show_delete')]
    public function delete($id): RedirectResponse
    {
        $show = $this->productRepository->findOneBy(['id' => $id, 'type' => 'show']);
        if(!$show) {
            $this->addFlash('error', 'Show not found');
            return $this->redirectToRoute('app_admin_shows');
        }

        $this->entityManager->remove($show);
        $this->entityManager->flush();
        $this->addFlash('success', 'Show deleted');
        return $this->redirectToRoute('app_admin_shows');
    }
}
