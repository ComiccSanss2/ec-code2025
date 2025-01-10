<?php

namespace App\Controller;

use App\Entity\BookRead;
use App\Form\BookReadFormType;
use App\Repository\BookReadRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private BookReadRepository $bookReadRepository;

    public function __construct(BookReadRepository $bookReadRepository)
    {
        $this->bookReadRepository = $bookReadRepository;
    }

    #[Route('/', name: 'app.home')]
    public function index(): Response
    {
        $userId = 1; // ID de l'utilisateur actuellement connecté
        $booksRead = $this->bookReadRepository->findByUserId($userId, false);

        // Créez une instance du formulaire
        $bookRead = new BookRead();
        $form = $this->createForm(BookReadFormType::class, $bookRead);

        // Transmettez le formulaire et les livres lus à la vue
        return $this->render('pages/home.html.twig', [
            'booksRead' => $booksRead,
            'form' => $form->createView(),
            'name' => 'Accueil',
        ]);
    }

    #[Route('/login', name: 'auth.login')]
    public function login(): Response
    {
        return $this->render('auth/login.html.twig', [
            'name' => 'Thibaud',
        ]);
    }

    #[Route('/register', name: 'auth.register')]
    public function register(): Response
    {
        return $this->render('auth/register.html.twig', [
            'name' => 'Thibaud',
        ]);
    }
}
