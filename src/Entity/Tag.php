<?php

namespace App\Entity;

use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=TagRepository::class)
 */
class Tag
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="remplir le champs titre")
     * @Assert\Length(min=5, minMessage="vous devez avoir au minimum 5 caractere")
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\NotBlank(message="remplir le champs couleur")
     * @Assert\Length (min=5 , minMessage="vous devez avoir au minimum 5 caractere")
     */
    private $color;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article" , mappedBy="tag")
     */
    private $articles;

    public function __construct(){
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    public function addArticle(Article $article):self{
        if(!$this->articles->contains($article)){
            $this->articles [] = $article;
            $article->setCategory($this);
        }
        return $this;
    }

    public function removeArticle(Article  $article){
        if($this->articles->contains($article)){
            $this->articles->removeElement($article);

            if($article->getCategory() == $this){
                $article->setCategory(null);
            }
        }
        return $this;
    }


}
