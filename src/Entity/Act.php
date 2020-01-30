<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActRepository")
 * @ORM\HasLifecycleCallbacks
 * @Vich\Uploadable
 */
class Act
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
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $actImgName;
    /**
     * @Vich\UploadableField(mapping="act_file", fileNameProperty="actImgName")
     */
    private $actFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    /**
     * @ORM\PrePersist
     */
    public function handleCreationDate()
    {
        if ($this->getCreatedAt() === null) {
            $this->setCreatedAt(new \DateTimeImmutable());
        }
    }

    public function getActImgName(): ?string
    {
        return $this->actImgName;
    }

    public function setActImgName(string $actImgName): self
    {
        $this->actImgName = $actImgName;

        return $this;
    }

    /**
     * @param File|null $image
     * @return Act
     */
    public function setActFile(File $image = null): Act
    {
        $this->actFile = $image;
        if ($this->actFile instanceof UploadedFile) {
            $this->updatedAt = new DateTime();
        }
        return $this;
    }

    /**
     * @return null|File
     */
    public function getActFile(): ?File
    {
        return $this->actFile;
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
    /**
     * @ORM\PreUpdate
     */
    public function handleUpdateDate()
    {
        $this->setUpdatedAt(new \DateTimeImmutable());
    }
}
