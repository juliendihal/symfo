<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController{

        private $categories = [
        1 => [
        "title" => "Politique",
        "content" => "Tous les articles liés à Jean Lassalle",
        "id" => 1,
        "published" => true,
        ],
        2 => [
        "title" => "Economie",
        "content" => "Les meilleurs tuyaux pour avoir DU FRIC",
        "id" => 2,
        "published" => true
        ],
        3 => [
        "title" => "Securité",
        "content" => "Attention les étrangers sont très méchants",
        "id" => 3,
        "published" => false
        ],
        4 => [
        "title" => "Ecologie",
        "content" => "Hummer <3",
        "id" => 4,
        "published" => true
        ]
        ];


      /**
       * @Route("/" , name="home")
       */
    public function Home(){
     var_dump('hello');die;
    }

    /**
     * @Route("/articlelist" , name="articlelist")
     */
    public function Articlelist(){

        return $this->render('articlelist.html.twig',[
            'articles'=> $this->categories
        ]);
    }

    /**
     * @Route("/article/{id}", name="article")
     */
    public  function article($id){
        return $this->render('article.html.twig',[
            'article'=> $this->categories[$id]
        ]);
    }
}