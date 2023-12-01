<?php

namespace App\EventListener;

use App\Entity\TranslationUnit;
use App\Entity\TranslationUnitVersion;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

#[AsEntityListener(event: 'prePersist', method: 'prePersist', entity: TranslationUnit::class)]
#[AsEntityListener(event: 'preUpdate', method: 'preUpdate', entity: TranslationUnit::class)]
class TranslationUnitListener
{
    public function prePersist(TranslationUnit $translationUnit, PrePersistEventArgs $eventArgs): void
    {
        $this->addTranslationUnitVersion($translationUnit);
    }

    public function preUpdate(TranslationUnit $translationUnit, PreUpdateEventArgs $eventArgs): void
    {
        $this->addTranslationUnitVersion($translationUnit);
    }

    private function addTranslationUnitVersion(TranslationUnit $translationUnit): void
    {
        $translationUnitVersion = (new TranslationUnitVersion())
            ->setText($translationUnit->getText())
            ->setLanguageCode($translationUnit->getLanguageCode())
            ->setDestLanguageCode($translationUnit->getDestLanguageCode())
            ->setTranslatedText($translationUnit->getTranslatedText())
        ;
        $translationUnit->addTranslationUnitVersion($translationUnitVersion);
    }
}
