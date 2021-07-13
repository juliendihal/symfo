<?php


namespace App\Controller\Front;


use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class FrontTagController extends AbstractController
{
    /**
     * @Route("/taglist" , name="taglist")
     */
    public function Taglist(TagRepository $tagRepository){
        $tags = $tagRepository->findAll();

        return $this->render('Front/taglist.html.twig' , [
            'tags'=> $tags
        ]);
    }

    /**
     * @Route("/tag/{id}", name="tag")
     */
    public function TagShow($id , TagRepository $tagRepository){
        $tag = $tagRepository->find($id);

        if(is_Null($tag)){
            throw new NotFoundHttpException();
        }
        return $this->render('Front/tag.html.twig',[
            'tag'=> $tag
        ]);

    }
}