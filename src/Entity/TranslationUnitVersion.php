<?php

namespace App\Entity;

use App\Repository\TranslationUnitVersionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity(repositoryClass: TranslationUnitVersionRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[UniqueEntity(fields: ['translationUnit', 'version'])]
class TranslationUnitVersion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'translationUnitVersions')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TranslationUnit $translationUnit = null;

    #[ORM\Column]
    private ?int $version = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[ORM\Column(length: 255)]
    private ?string $languageCode = null;

    #[ORM\Column(length: 255)]
    private ?string $destLanguageCode = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $translatedText = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTranslationUnit(): ?TranslationUnit
    {
        return $this->translationUnit;
    }

    public function setTranslationUnit(?TranslationUnit $translationUnit): static
    {
        $this->translationUnit = $translationUnit;

        return $this;
    }

    public function getVersion(): ?int
    {
        return $this->version;
    }

    public function setVersion(int $version): static
    {
        $this->version = $version;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getLanguageCode(): ?string
    {
        return $this->languageCode;
    }

    public function setLanguageCode(string $languageCode): static
    {
        $this->languageCode = $languageCode;

        return $this;
    }

    public function getDestLanguageCode(): ?string
    {
        return $this->destLanguageCode;
    }

    public function setDestLanguageCode(string $destLanguageCode): static
    {
        $this->destLanguageCode = $destLanguageCode;

        return $this;
    }

    public function getTranslatedText(): ?string
    {
        return $this->translatedText;
    }

    public function setTranslatedText(?string $translatedText): static
    {
        $this->translatedText = $translatedText;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->createdAt = new \DateTimeImmutable();
    }
}
