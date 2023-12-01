<?php

namespace App\Tests\Integration\EventListener;

use App\Entity\TranslationUnit;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class TranslationUnitListenerTest extends KernelTestCase
{
    public function testVersions(): void
    {
        $kernel = self::bootKernel();
        $container = $kernel->getContainer();
        $entityManager = $container->get('doctrine')->getManager();
        $translationUnit = (new TranslationUnit())
            ->setText('Hello world!')
            ->setLanguageCode('en')
            ->setDestLanguageCode('fr')
            ->setTranslatedText('Bonjour le monde!')
        ;
        $entityManager->persist($translationUnit);
        $entityManager->flush();
        self::assertCount(1, $translationUnit->getTranslationUnitVersions());
        $translationUnitVersion = $translationUnit->getTranslationUnitVersions()->first();
        self::assertSame('Hello world!', $translationUnitVersion->getText());
        self::assertSame('en', $translationUnitVersion->getLanguageCode());
        self::assertSame('fr', $translationUnitVersion->getDestLanguageCode());
        self::assertSame('Bonjour le monde!', $translationUnitVersion->getTranslatedText());

        $translationUnit->setTranslatedText('Bonjour tout le monde!');
        $entityManager->flush();

        self::assertCount(2, $translationUnit->getTranslationUnitVersions());
        $translationUnitVersion = $translationUnit->getTranslationUnitVersions()->last();
        self::assertSame('Bonjour tout le monde!', $translationUnitVersion->getTranslatedText());
    }
}
