<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Repository\ProgramRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Faker;

class DefaultController extends AbstractController {

    #[Route('/', name: 'app_index')]
    public function index(
        CategoryRepository $categoryRepository,
        ProgramRepository $programRepository
    ) :Response

    {
        $faker = Faker\Factory::create();
        $categories = $categoryRepository->findAll();
        $headerImgUrl = $faker->imageUrl(1024, 500, true);

        $programs = $programRepository->findAll();
        $programImgUrl = $faker->imageUrl(300, 200, 'program', true, 'image', true);

        return $this->render('index.html.twig', [
            'categories' => $categories,
            'headerImgUrl' => $headerImgUrl,
            'programs' => $programs,
            'programImgUrl' => $programImgUrl,
        ]);
    }
}