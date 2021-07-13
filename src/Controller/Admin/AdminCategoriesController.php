<?php


namespace App\Controller\Admin;

use App\Entity\category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoriesController extends AbstractController
{
    /**
     * @Route("/categorys/insert" , name="categoryinsert")
     *
     */
    public function  insertCategory(EntityManagerInterface $entityManager, CategoryRepository $categoryRepository){
        //creer un nouvelle category
        $category = new category();

        // j'utilise les setters de l'entité category pour renseigner les valeurs des colonnes
        $category->setTitle('aurelien est un connard ');
        $category->setDescription('il a un window');

        //sauvegarde les entity crée ici
        $entityManager->persist($category);
        // je récupère toutes les entités pré-sauvegardées et je les insère en BDD
        $entityManager->flush();

        return $this->redirectToRoute('categorielist');

    }

    /**
     * @Route("/categorys/update/{id}" , name="categoryupdate")
     */
    public function updateCategory($id,CategoryRepository $categoryRepository , EntityManagerInterface $entityManager ){

        $category = $categoryRepository->find($id);

        $category->setTitle("aurelien");

        $entityManager->persist($category);
        $entityManager->flush();

        return $this->redirectToRoute('categorielist');
    }

    /**
     * @Route("/categorys/delete/{id}" , name="categorydelete")
     */
    public  function deleteCategory($id, CategoryRepository $categoryRepository , EntityManagerInterface $entityManager){

        $category = $categoryRepository->find($id);

        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('categorielist');

    }


}