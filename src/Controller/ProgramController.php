<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Form\ProgramType;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
        ProgramRepository $programRepository
        ) :Response
    {
        $program = $programRepository->findOneById($id);

        if (!$program)
        {
            throw $this->createNotFoundException(
                "Aucun programme trouvé avec l'id: " . $id . " dans la base de donnée."
            );
        }
        
        return $this->render('program/show.html.twig', [
            'id' => $id,
            'program' => $program,
        ]);
    }

    #[Route('/create/', name: 'create')]
    public function create(Request $request, ProgramRepository $programRepository):Response
    {
        $program = new Program;
        $form = $this->createForm(ProgramType::class, $program);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $programRepository->save($program, true);
            return $this->redirectToRoute('program_index');
        }

        return $this->render('program/new.html.twig', [
            'form' => $form,
        ]);

    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Program $program):Response
    {
        return new Response('A supprimé');
    }
}