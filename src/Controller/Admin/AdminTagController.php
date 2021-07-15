<?php


namespace App\Controller\Admin;


use App\Entity\Tag;
use App\Form\TagType;
use App\Repository\TagRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminTagController extends AbstractController
{

    /**
     * @Route("/admintaglist" , name="admintaglist")
     */
    public function AdminTaglist(TagRepository $tagRepository){
        $tags = $tagRepository->findAll();

        return $this->render('Admin/Tag.html.twig' , [
            'tags'=> $tags
        ]);
    }


    /**
     * @Route("/tags/insert" , name="taginsert")
     */
    public function  insertTag(EntityManagerInterface $entityManager , Request $request){
        //creer un nouvelle Tag
        $tag = new Tag();

        $tagForm = $this->createForm(TagType::class, $tag);

        $tagForm->handleRequest($request);

        //si le formulaire a ete poster et il est valide alors on enregistre l'article
        if($tagForm->isSubmitted() && $tagForm->isValid()){
            $entityManager->persist($tag);
            $entityManager->flush();
            return $this->redirectToRoute('admintaglist');
        }

        return $this->render('Admin/formtag.html.twig',[
            'tagForm'=>$tagForm->createView()

        ]);

    }

    /**
     * @Route("/tags/update/{id}" , name="tagupdate")
     */
    public function updateTag($id,TagRepository $TagRepository , EntityManagerInterface $entityManager , Request $request){

        $tag = $TagRepository->find($id);

        $tagForm = $this->createForm(TagType::class, $tag);

        $tagForm->handleRequest($request);

        //si le formulaire a ete poster et il est valide alors on enregistre l'article
        if($tagForm->isSubmitted() && $tagForm->isValid()){
            $entityManager->persist($tag);
            $entityManager->flush();
            return $this->redirectToRoute('admintaglist');
        }

        return $this->render('Admin/formtag.html.twig',[
            'tagForm'=>$tagForm->createView()

        ]);
    }

    /**
     * @Route("/tags/delete/{id}" , name="tagdelete")
     */
    public  function deleteTag($id, TagRepository $TagRepository , EntityManagerInterface $entityManager){

        $Tag = $TagRepository->find($id);

        $entityManager->remove($Tag);
        $entityManager->flush();

        return $this->redirectToRoute('admintaglist');

    }

}