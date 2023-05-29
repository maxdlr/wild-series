<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController {

    #[Route('/get-categories', name:'get-categories')]
    public function getAllCategories(
        CategoryRepository $categoryRepository
    ):JsonResponse
    {
        $categories = $categoryRepository->findAll();

        $jsonCategoriesResponse = [];

        foreach($categories as $category) {
            $jsonCategoriesResponse[] =
                $category->getName();
        }

        return new JsonResponse($jsonCategoriesResponse);
    }

}