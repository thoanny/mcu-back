<?php

namespace App\Controller\Admin;

use App\Entity\Character;
use App\Form\Admin\CharacterType;
use App\Repository\CharacterRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class CharacterController extends AbstractController
{
    private CharacterRepository $characterRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(CharacterRepository $characterRepository, EntityManagerInterface $entityManager)
    {
        $this->characterRepository = $characterRepository;
        $this->entityManager = $entityManager;
    }

    #[Route('/admin/characters', name: 'app_admin_characters')]
    public function index(): Response
    {
        $characters = $this->characterRepository->findAll();
        return $this->render('admin/character/index.html.twig', [
            'characters' => $characters,
        ]);
    }

    #[Route('/admin/characters/edit/{id}', name: 'app_admin_character_edit', defaults: ['id' => null])]
    public function edit(Request $request, $id): Response
    {
        if($id) {
            $character = $this->characterRepository->findOneBy(['id' => $id]);
            if(!$character) {
                $this->addFlash('error', 'Character not found');
                return $this->redirectToRoute('app_admin_characters');
            }
        } else {
            $character = new Character();
        }

        $form = $this->createForm(CharacterType::class, $character);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $character = $form->getData();
            $this->entityManager->persist($character);
            $this->entityManager->flush();
            $this->addFlash('success', 'Character saved');
            return $this->redirectToRoute('app_admin_characters');
        }

        return $this->render('admin/character/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/admin/characters/delete/{id}', name: 'app_admin_character_delete')]
    #[IsGranted('ROLE_ADMIN')]
    public function delete($id): RedirectResponse
    {
        $character = $this->characterRepository->findOneBy(['id' => $id]);
        if(!$character) {
            $this->addFlash('error', 'Character not found');
            return $this->redirectToRoute('app_admin_characters');
        }

        $this->entityManager->remove($character);
        $this->entityManager->flush();
        $this->addFlash('success', 'Character deleted');
        return $this->redirectToRoute('app_admin_characters');
    }
}
