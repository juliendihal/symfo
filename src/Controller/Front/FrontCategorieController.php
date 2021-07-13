<?php


namespace App\Controller\Front;


use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontCategorieController  extends AbstractController
{
    /**
     * @Route("/categorie/{id}", name="categorie")
     */
    public function Categorie($id, CategoryRepository $categorieRepository){
        $categorie = $categorieRepository->find($id);
        return $this->render('Front/categorie.html.twig' , [
            'categorie'=> $categorie
        ]);

    }

    /**
     * @Route("/categorielist" , name="categorielist")
     */
    public function Categorielist(CategoryRepository $categorieRepository){
        $categories = $categorieRepository->findAll();
        return $this->render('Front/categorielist.html.twig' , [
            'categories'=> $categories
        ]);

    }
}