<?php

namespace App\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TagRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use function PHPUnit\Framework\isNull;

class TagController  extends AbstractController{

    /**
     * @Route("/taglist" , name="taglist")
     */
    public function Taglist(TagRepository $tagRepository){
      $tags = $tagRepository->findAll();

      return $this->render('taglist.html.twig' , [
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
        return $this->render('tag.html.twig',[
            'tag'=> $tag
        ]);

    }
}