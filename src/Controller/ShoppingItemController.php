<?php

namespace App\Controller;

use App\Entity\ShoppingItem;
use App\Form\ShoppingItemType;
use App\Repository\ShoppingItemRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shopping/item')]
class ShoppingItemController extends AbstractController
{
    #[Route('/', name: 'app_shopping_item_index', methods: ['GET'])]
    public function index(ShoppingItemRepository $shoppingItemRepository): Response
    {
        return $this->render('shopping_item/index.html.twig', [
            'shopping_items' => $shoppingItemRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_shopping_item_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $shoppingItem = new ShoppingItem();
        $form = $this->createForm(ShoppingItemType::class, $shoppingItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($shoppingItem);
            $entityManager->flush();

            return $this->redirectToRoute('app_shopping_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shopping_item/new.html.twig', [
            'shopping_item' => $shoppingItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shopping_item_show', methods: ['GET'])]
    public function show(ShoppingItem $shoppingItem): Response
    {
        return $this->render('shopping_item/show.html.twig', [
            'shopping_item' => $shoppingItem,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_shopping_item_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ShoppingItem $shoppingItem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ShoppingItemType::class, $shoppingItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_shopping_item_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('shopping_item/edit.html.twig', [
            'shopping_item' => $shoppingItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shopping_item_delete', methods: ['POST'])]
    public function delete(Request $request, ShoppingItem $shoppingItem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shoppingItem->getId(), $request->request->get('_token'))) {
            $entityManager->remove($shoppingItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_shopping_item_index', [], Response::HTTP_SEE_OTHER);
    }
}
