<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class CategorieController extends AbstractController {


    /**
     * @Route("/categorie/{id}", name="categorie")
     */
    public function Categorie($id, CategoryRepository $categorieRepository){
        $categorie = $categorieRepository->find($id);
        return $this->render('categorie.html.twig' , [
            'categorie'=> $categorie
        ]);

    }

    /**
     * @Route("/categorielist" , name="categorielist")
     */
    public function Categorielist(CategoryRepository $categorieRepository){
      $categories = $categorieRepository->findAll();
      return $this->render('categorielist.html.twig' , [
          'categories'=> $categories
          ]);

    }
}