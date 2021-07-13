<?php
 namespace App\Controller\Admin;
 use App\Entity\Article;
 use App\Repository\ArticleRepository;
 use App\Repository\CategoryRepository;
 use Doctrine\ORM\EntityManagerInterface;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\Routing\Annotation\Route;

 class AdminArticleController extends AbstractController{

     /**
      * @Route("/articles/insert", name="articleinsert")
      *
      */
     public function  insertArticle(EntityManagerInterface $entityManager , categoryRepository $categoryRepository){
         //creer un nouvelle article
         $article = new Article();

         // j'utilise les setters de l'entité Article pour renseigner les valeurs des colonnes
         $article->setTitle('aurelien est un connard ');
         $article->setContent('il a un window');
         $article->setIspublished(true);
         $article->setCreateatt(new \DateTime('NOW'));

         //je recupere la categorie dont lid est 1 en bdd
         $category = $categoryRepository->find(1);
         // j'associe l'instance de l'entité category recuperéé a l'instance article
         $article->setCategory($category);




         //sauvegarde les entity crée ici
         $entityManager->persist($article);
         // je récupère toutes les entités pré-sauvegardées et je les insère en BDD
         $entityManager->flush();

         return $this->redirectToRoute('articlelist');

     }

     /**
      * @Route("/articles/update/{id}" , name="articleupdate")
      */
     public function updateArticle($id,ArticleRepository $articleRepository , EntityManagerInterface $entityManager ){

         $article = $articleRepository->find($id);

         $article->setTitle("update titre 2");

         $entityManager->persist($article);
         $entityManager->flush();

         return $this->redirectToRoute('articlelist');
     }

     /**
      * @Route("/articles/delete/{id}" , name="articledelete")
      */
     public  function deleteArticle($id, ArticleRepository $articleRepository , EntityManagerInterface $entityManager){

         $article = $articleRepository->find($id);

         $entityManager->remove($article);
         $entityManager->flush();

         return $this->redirectToRoute('articlelist');

     }
}