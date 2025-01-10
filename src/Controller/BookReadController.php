<?php


namespace App\Controller;

use App\Entity\BookRead;
use App\Form\BookReadFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class BookReadController extends AbstractController
{
    #[Route('/add-book', name: 'book_add', methods: ['POST'])]
    public function addBook(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $bookRead = new BookRead();
        $form = $this->createForm(BookReadFormType::class, $bookRead);
        $form->handleRequest($request);

        // Simuler un utilisateur (remplacez ceci par getUser() si disponible)
        $simulatedUserId = 1;

        if (!$simulatedUserId) { // Vérifie si l'utilisateur est "connecté"
            return new JsonResponse(['status' => 'error', 'message' => 'User not logged in.'], 403);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $bookRead->setUserId($simulatedUserId);
            $bookRead->setCreatedAt(new \DateTime());
            $bookRead->setUpdatedAt(new \DateTime());

            $entityManager->persist($bookRead);
            $entityManager->flush();

            return new JsonResponse([
                'status' => 'success',
                'id' => $bookRead->getId(),
                'description' => $bookRead->getDescription(),
                'rating' => $bookRead->getRating(),
                'book_id' => $bookRead->getBookId(),
            ], 200);
        }

        return new JsonResponse(['status' => 'error', 'errors' => (string)$form->getErrors(true)], 400);
    }
}
