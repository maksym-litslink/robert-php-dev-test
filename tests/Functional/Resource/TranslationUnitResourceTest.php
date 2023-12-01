<?php

namespace App\Tests\Functional\Resource;

use App\Entity\TranslationUnit;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class TranslationUnitResourceTest extends WebTestCase
{
    public function testGetCollection()
    {
        $client = self::createClient();
        $em = $this->getEntityManager();

        $translationUnit1 = (new TranslationUnit())
          ->setText('Text 1')
          ->setLanguageCode('en')
          ->setDestLanguageCode('ua')
        ;
        $em->persist($translationUnit1);
        $em->flush();

        $url = '/api/translation_units';
        $client->request('GET', $url);
        $json = json_decode($client->getResponse()->getContent(), true);
        self::assertArrayHasKey('hydra:totalItems', $json);
        self::assertEquals(1, $json['hydra:totalItems']);
        self::assertArrayHasKey('hydra:member', $json);
        self::assertCount(1, $json['hydra:member']);
        self::assertEquals($translationUnit1->getId(), $json['hydra:member'][0]['id']);
        self::assertEquals($translationUnit1->getText(), $json['hydra:member'][0]['text']);
        self::assertEquals($translationUnit1->getLanguageCode(), $json['hydra:member'][0]['languageCode']);
        self::assertEquals($translationUnit1->getDestLanguageCode(), $json['hydra:member'][0]['destLanguageCode']);
        self::assertArrayHasKey('createdAt', $json['hydra:member'][0]);
        self::assertArrayHasKey('updatedAt', $json['hydra:member'][0]);
    }

    public function testGetItem()
    {
        $client = self::createClient();
        $em = $this->getEntityManager();

        $translationUnit1 = (new TranslationUnit())
          ->setText('Text 1')
          ->setLanguageCode('en')
          ->setDestLanguageCode('ua')
        ;
        $em->persist($translationUnit1);
        $em->flush();

        $url = '/api/translation_units/' . $translationUnit1->getId();
        $client->request('GET', $url);
        $json = json_decode($client->getResponse()->getContent(), true);
        self::assertEquals($translationUnit1->getId(), $json['id']);
        self::assertEquals($translationUnit1->getText(), $json['text']);
        self::assertEquals($translationUnit1->getLanguageCode(), $json['languageCode']);
        self::assertEquals($translationUnit1->getDestLanguageCode(), $json['destLanguageCode']);
        self::assertArrayHasKey('createdAt', $json);
        self::assertArrayHasKey('updatedAt', $json);
    }

    public function testPost()
    {
        $client = self::createClient();

        $url = '/api/translation_units';
        $client->request(
          'POST',
          $url,
          [],
          [],
          [
            'CONTENT_TYPE' => 'application/ld+json',
          ],
          json_encode([
            'text' => 'Text 1',
            'languageCode' => 'en',
            'destLanguageCode' => 'ua',
          ], JSON_THROW_ON_ERROR)
        );
        $json = json_decode($client->getResponse()->getContent(), true);
        self::assertArrayHasKey('id', $json);
        self::assertArrayHasKey('createdAt', $json);
        self::assertArrayHasKey('updatedAt', $json);
        self::assertEquals('Text 1', $json['text']);
        self::assertEquals('en', $json['languageCode']);
        self::assertEquals('ua', $json['destLanguageCode']);
    }

    public function testPut()
    {
        $client = self::createClient();
        $em = $this->getEntityManager();

        $translationUnit1 = (new TranslationUnit())
          ->setText('Text 1')
          ->setLanguageCode('en')
          ->setDestLanguageCode('ua')
        ;
        $em->persist($translationUnit1);
        $em->flush();

        $url = '/api/translation_units/' . $translationUnit1->getId();
        $client->request(
          'PUT',
          $url,
          [],
          [],
          [
            'CONTENT_TYPE' => 'application/ld+json',
          ],
          json_encode([
            'text' => 'Text 2',
            'languageCode' => 'en',
            'destLanguageCode' => 'ua',
          ], JSON_THROW_ON_ERROR)
        );
        $json = json_decode($client->getResponse()->getContent(), true);
        self::assertEquals($translationUnit1->getId(), $json['id']);
        self::assertEquals('Text 2', $json['text']);
        self::assertEquals('en', $json['languageCode']);
        self::assertEquals('ua', $json['destLanguageCode']);
        self::assertArrayHasKey('createdAt', $json);
        self::assertArrayHasKey('updatedAt', $json);
    }

    public function testDelete()
    {
        $client = self::createClient();
        $em = $this->getEntityManager();

        $translationUnit1 = (new TranslationUnit())
          ->setText('Text 1')
          ->setLanguageCode('en')
          ->setDestLanguageCode('ua')
        ;
        $em->persist($translationUnit1);
        $em->flush();

        $url = '/api/translation_units/' . $translationUnit1->getId();
        $client->request('DELETE', $url);
        self::assertEquals(204, $client->getResponse()->getStatusCode());
        self::assertEmpty($client->getResponse()->getContent());
    }

    protected function getEntityManager(): EntityManagerInterface
    {
        return self::getContainer()->get(EntityManagerInterface::class);
    }
}
