<?php


namespace App\Controller\Front;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontArticleController extends AbstractController
{

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

        return $this->render('Front/articlelist.html.twig', [
            'articles'=> $articles
        ]);
    }

    /**
     * @Route("/article/{id}" , name="article")
     */
    public  function articleShow ($id , ArticleRepository $articleRepository){
        $article = $articleRepository->find($id);

        return $this->render('Front/article.html.twig',[
            'article'=> $article
        ]);
    }

    /**
     * @Route("/search" , name="search")
     */
    public function Search(ArticleRepository $articleRepository, Request $request)
    {

        $word = $request->query->get('q');

        $articles = $articleRepository->searchByTerm($word);

        return $this->render('Front/articlesearch.html.twig', [
            'articles'=> $articles,
            'word'=> $word
        ]);
    }


}