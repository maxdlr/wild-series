<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(
        CategoryRepository $categoryRepository,
        ProgramRepository $programRepository
    ): Response
    {
        $programs = $programRepository->findAll();
        $categories = $categoryRepository->findAll();

        return $this->render('program/index.html.twig', [
            'website' => 'Wild Series',
            'categories' => $categories,
            'programs' => $programs,
        ]);
    }

    #[Route(
        '/{id}/', 
        requirements: ['id'=>'\d+'], 
        methods: ['GET'],
        name: 'show', 
        )]

    public function show(
        int $id = 1,
        CategoryRepository $categoryRepository,
        ProgramRepository $programRepository
        ) :Response
    {
        $categories = $categoryRepository->findAll();
        $program = $programRepository->findOneById($id);

        if (!$program)
        {
            throw $this->createNotFoundException(
                "Aucun programme trouvé avec l'id: " . $id . " dans la base de donnée."
            );
        }
        
        return $this->render('program/show.html.twig', [
            'id' => $id,
            'categories' => $categories,
            'program' => $program,
        ]);
    }
}