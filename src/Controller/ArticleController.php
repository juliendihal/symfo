<?php
namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;

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

    /**
     * @Route("/search" , name="search")
     */
    public function Search(ArticleRepository $articleRepository, Request $request)
    {

        $word = $request->query->get('q');

      $articles = $articleRepository->searchByTerm($word);

      return $this->render('articlesearch.html.twig', [
       'articles'=> $articles,
          'word'=> $word
      ]);
    }

    /**
     * @Route("/articles/insert" , name="isert")
     *
     */
    public function  insertArticle(EntityManagerInterface $entityManager){
        //creer un nouvelle article
      $article = new Article();

        // j'utilise les setters de l'entité Article pour renseigner les valeurs des colonnes
      $article->setTitle('titre article depuis le controleur');
      $article->setContent('content depuis le controleur');
      $article->setIspublished(true);
      $article->setCreateatt(new \DateTime('NOW'));

        //sauvegarde les entity crée ici
      $entityManager->persist($article);
        // je récupère toutes les entités pré-sauvegardées et je les insère en BDD
      $entityManager->flush();

        return $this->redirectToRoute('articlelist');

    }


}