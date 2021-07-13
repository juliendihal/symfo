<?php


namespace App\Controller\Admin;


use App\Entity\Tag;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminTagController extends AbstractController
{

    /**
     * @Route("/tags/insert" , name="taginsert")
     */
    public function  insertTag(EntityManagerInterface $entityManager , TagRepository $TagRepository){
        //creer un nouvelle Tag
        $Tag = new Tag();

        // j'utilise les setters de l'entité Tag pour renseigner les valeurs des colonnes
        $Tag->setTitle('aurelien est un connard ');
        $Tag->setColor('black');


        //sauvegarde les entity crée ici
        $entityManager->persist($Tag);
        // je récupère toutes les entités pré-sauvegardées et je les insère en BDD
        $entityManager->flush();

        return $this->redirectToRoute('taglist');

    }

    /**
     * @Route("/tags/update/{id}" , name="tagupdate")
     */
    public function updateTag($id,TagRepository $TagRepository , EntityManagerInterface $entityManager ){

        $Tag = $TagRepository->find($id);

        $Tag->setTitle("update titre 2");

        $entityManager->persist($Tag);
        $entityManager->flush();

        return $this->redirectToRoute('taglist');
    }

    /**
     * @Route("/tags/delete/{id}" , name="tagdelete")
     */
    public  function deleteTag($id, TagRepository $TagRepository , EntityManagerInterface $entityManager){

        $Tag = $TagRepository->find($id);

        $entityManager->remove($Tag);
        $entityManager->flush();

        return $this->redirectToRoute('taglist');

    }

}