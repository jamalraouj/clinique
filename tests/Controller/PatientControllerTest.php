<?php

namespace App\Test\Controller;

use App\Entity\Patient;
use App\Repository\PatientRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PatientControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private PatientRepository $repository;
    private string $path = '/patient/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Patient::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Patient index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'patient[family_history]' => 'Testing',
            'patient[profession]' => 'Testing',
            'patient[status_patient]' => 'Testing',
            'patient[cree_en]' => 'Testing',
            'patient[mise_a_jour_a]' => 'Testing',
        ]);

        self::assertResponseRedirects('/patient/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Patient();
        $fixture->setFamily_history('My Title');
        $fixture->setProfession('My Title');
        $fixture->setStatus_patient('My Title');
        $fixture->setCree_en('My Title');
        $fixture->setMise_a_jour_a('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Patient');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Patient();
        $fixture->setFamily_history('My Title');
        $fixture->setProfession('My Title');
        $fixture->setStatus_patient('My Title');
        $fixture->setCree_en('My Title');
        $fixture->setMise_a_jour_a('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'patient[family_history]' => 'Something New',
            'patient[profession]' => 'Something New',
            'patient[status_patient]' => 'Something New',
            'patient[cree_en]' => 'Something New',
            'patient[mise_a_jour_a]' => 'Something New',
        ]);

        self::assertResponseRedirects('/patient/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getFamily_history());
        self::assertSame('Something New', $fixture[0]->getProfession());
        self::assertSame('Something New', $fixture[0]->getStatus_patient());
        self::assertSame('Something New', $fixture[0]->getCree_en());
        self::assertSame('Something New', $fixture[0]->getMise_a_jour_a());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Patient();
        $fixture->setFamily_history('My Title');
        $fixture->setProfession('My Title');
        $fixture->setStatus_patient('My Title');
        $fixture->setCree_en('My Title');
        $fixture->setMise_a_jour_a('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/patient/');
    }
}
