<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MusicRepository")
 * @Vich\Uploadable
 */
class Music
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $uniqid;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @var File|null
     * @Assert\File(
     *      maxSize="8192k",
     *      maxSizeMessage="Le fichier est trop volumineux. Sa taille ne doit pas dépasser 8Mo.",
     *      mimeTypes={"audio/mpeg"},
     *      mimeTypesMessage="Le type du fichier est invalide. Le type autorisé est mp3."
     * )
     * @Vich\UploadableField(mapping="music_mp3_file", fileNameProperty="mp3FileName")
     */
    private $mp3File;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $mp3FileName;
    
    /**
     * @var File|null
     * @Assert\File(
     *      maxSize="8192k",
     *      maxSizeMessage="Le fichier est trop volumineux. Sa taille ne doit pas dépasser 8Mo.",
     *      mimeTypes={"audio/ogg", "video/ogg", "application/ogg"},
     *      mimeTypesMessage="Le type du fichier est invalide. Le type autorisé est ogg."
     * )
     * @Vich\UploadableField(mapping="music_ogg_file", fileNameProperty="oggFileName")
     */
    private $oggFile;
    
    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $oggFileName;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $publicationDate;
    
    /**
     * @ORM\Column(type="datetime")
     *
     * @var \DateTimeInterface
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUniqid(): ?string
    {
        return $this->uniqid;
    }

    public function setUniqid(string $uniqid): self
    {
        $this->uniqid = $uniqid;

        return $this;
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

    public function getMp3File(): ?File
    {
        return $this->mp3File;
    }
    
    public function setMp3File(File $mp3File): self
    {
        $this->mp3File = $mp3File;

        if (null !== $mp3File) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        
        return $this;
    }
    
    public function getMp3FileName(): ?string
    {
        return $this->mp3FileName;
    }

    public function setMp3FileName(?string $mp3FileName): self
    {
        $this->mp3FileName = $mp3FileName;

        return $this;
    }

    public function getOggFile(): ?File
    {
        return $this->oggFile;
    }
    
    public function setOggFile(File $oggFile): self
    {
        $this->oggFile = $oggFile;

        if (null !== $oggFile) {
            $this->updatedAt = new \DateTimeImmutable();
        }
        
        return $this;
    }
    
    public function getOggFileName(): ?string
    {
        return $this->oggFileName;
    }

    public function setOggFileName(?string $oggFileName): self
    {
        $this->oggFileName = $oggFileName;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
