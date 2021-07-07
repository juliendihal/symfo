<?php
namespace App\Controller;
use App\Repository\ArticleRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class ArticleController extends AbstractController{




      /**
       * @Route("/" , name="home")
       */
    public function Home(){
     var_dump('hello');die;
    }

    /**
     * @Route("/articlelist" , name="articlelist")
     */
    public function Articlelist(ArticleRepository $articleRepository ){
  //auto wire je place la classe en argument suivi de la variable que je veux instancier la class

        $articles = $articleRepository->findAll();

        return $this->render('articlelist.html.twig', [
            'articles'=> $articles
        ]);
    }

    /**
     * @Route("/article/{id}" , name="article")
     */
    public  function articleShow ($id , ArticleRepository $articleRepository){
       $article = $articleRepository->find($id);

       return $this->render('article.html.twig',[
           'article'=> $article
       ]);
    }


}