<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\TranslationUnitRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ApiResource(
  operations: [
    new Get(),
    new GetCollection(),
    new Post(),
    new Put(),
    new Delete(),
  ],
  normalizationContext: [
    'groups' => ['translation_unit:read'],
  ],
  denormalizationContext: [
    'groups' => ['translation_unit:write'],
  ],
)]
#[ORM\Entity(repositoryClass: TranslationUnitRepository::class)]
#[ORM\HasLifecycleCallbacks]
class TranslationUnit
{
    #[Groups(['translation_unit:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['translation_unit:read', 'translation_unit:write'])]
    #[ORM\Column(type: Types::TEXT)]
    private ?string $text = null;

    #[Groups(['translation_unit:read', 'translation_unit:write'])]
    #[ORM\Column(length: 255)]
    private ?string $languageCode = null;

    #[Groups(['translation_unit:read', 'translation_unit:write'])]
    #[ORM\Column(length: 255)]
    private ?string $destLanguageCode = null;

    #[Groups(['translation_unit:read', 'translation_unit:write'])]
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $translatedText = null;

    #[Groups(['translation_unit:read'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[Groups(['translation_unit:read'])]
    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\OneToMany(mappedBy: 'translationUnit', targetEntity: TranslationUnitVersion::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $translationUnitVersions;

    public function __construct()
    {
        $this->translationUnitVersions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * @return Collection<int, TranslationUnitVersion>
     */
    public function getTranslationUnitVersions(): Collection
    {
        return $this->translationUnitVersions;
    }

    public function addTranslationUnitVersion(TranslationUnitVersion $translationUnitVersion): static
    {
        if (!$this->translationUnitVersions->contains($translationUnitVersion)) {
            $this->translationUnitVersions->add($translationUnitVersion);
            $translationUnitVersion->setVersion($this->translationUnitVersions->count() + 1);
            $translationUnitVersion->setTranslationUnit($this);
        }

        return $this;
    }

    public function removeTranslationUnitVersion(TranslationUnitVersion $translationUnitVersion): static
    {
        if ($this->translationUnitVersions->removeElement($translationUnitVersion)) {
            // set the owning side to null (unless already changed)
            if ($translationUnitVersion->getTranslationUnit() === $this) {
                $translationUnitVersion->setTranslationUnit(null);
            }
        }

        return $this;
    }

    #[ORM\PrePersist]
    public function prePersist(): void
    {
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    #[ORM\PreUpdate]
    public function preUpdate(): void
    {
        $this->updatedAt = new \DateTimeImmutable();
    }
}
