<?php


namespace App\Controller\Admin;

use App\Entity\category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoriesController extends AbstractController
{


    /**
     * @Route("/admincategorielist" , name="admincategorielist")
     */
    public function Categorielist(CategoryRepository $categorieRepository){
        $categories = $categorieRepository->findAll();
        return $this->render('Admin/Category.html.twig' , [
            'categories'=> $categories
        ]);

    }

    /**
     * @Route("/categorys/insert" , name="categoryinsert")
     *
     */
    public function  insertCategory(EntityManagerInterface $entityManager, Request $request){
        //creer un nouvelle category
        $category = new category();

        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);

        //si le formulaire a ete poster et il est valide alors on enregistre l'article
        if($categoryForm->isSubmitted() && $categoryForm->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('admincategorielist');
        }

        return $this->render('Admin/formcategory.html.twig',[
            'categoryForm'=>$categoryForm->createView()
        ]);


    }

    /**
     * @Route("/categorys/update/{id}" , name="categoryupdate")
     */
    public function updateCategory($id,Request $request, EntityManagerInterface $entityManager, CategoryRepository $categoryRepository){

        $category = $categoryRepository->find($id);

        $categoryForm = $this->createForm(CategoryType::class, $category);

        $categoryForm->handleRequest($request);

        //si le formulaire a ete poster et il est valide alors on enregistre l'article
        if($categoryForm->isSubmitted() && $categoryForm->isValid()){
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('admincategorielist');
        }

        return $this->render('Admin/formcategory.html.twig',[
            'categoryForm'=>$categoryForm->createView()
        ]);

    }

    /**
     * @Route("/categorys/delete/{id}" , name="categorydelete")
     */
    public  function deleteCategory($id, CategoryRepository $categoryRepository , EntityManagerInterface $entityManager){

        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('admincategorielist');

    }


}