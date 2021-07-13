<?php
 namespace App\Controller\Admin;
 use App\Entity\Article;
 use App\Form\ArticleType;
 use App\Repository\ArticleRepository;
 use App\Repository\CategoryRepository;
 use Doctrine\ORM\EntityManagerInterface;
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Routing\Annotation\Route;

 class AdminArticleController extends AbstractController{


     /**
      * @Route("/articles/insert", name="articleinsert")
      */
     public function  insertArticle(Request $request , EntityManagerInterface $entityManager){
         $article = new Article();

         $articleForm = $this->createForm(ArticleType::class, $article);

         $articleForm->handleRequest($request);

         //si le formulaire a ete poster et il est valide alors on enregistre l'article
         if($articleForm->isSubmitted() && $articleForm->isValid()){
              $entityManager->persist($article);
              $entityManager->flush();
              return $this->redirectToRoute('adminarticlelist');
         }
         return $this->render('Admin/form.html.twig',[
           'articleForm'=>$articleForm->createView()
         ]);
     }

     /**
      * @Route("/articles/update/{id}" , name="articleupdate")
      */
     public function updateArticle($id,ArticleRepository $articleRepository , EntityManagerInterface $entityManager ){

         $article = $articleRepository->find($id);

         $article->setTitle("update titre 2");

         $entityManager->persist($article);
         $entityManager->flush();

         return $this->redirectToRoute('adminarticlelist');
     }

     /**
      * @Route("/articles/delete/{id}" , name="articledelete")
      */
     public  function deleteArticle($id, ArticleRepository $articleRepository , EntityManagerInterface $entityManager){

         $article = $articleRepository->find($id);

         $entityManager->remove($article);
         $entityManager->flush();

         return $this->redirectToRoute('adminarticlelist');

     }


     /**
      * @Route("/adminarticlelist" , name="adminarticlelist")
      */
     public function Articlelist(ArticleRepository $articleRepository ){
         //auto wire je place la classe en argument suivi de la variable que je veux instancier la class

         $articles = $articleRepository->findAll();

         return $this->render('Admin/Article.html.twig', [
             'articles'=> $articles
         ]);
     }
}