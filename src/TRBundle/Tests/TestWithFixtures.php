<?php

namespace TRBundle\Tests;

use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\SchemaTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\DependencyInjection\Container;

class TestWithFixtures extends KernelTestCase
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected static $em;

    /**
     * @var Symfony\Bundle\FrameworkBundle\Client
     */
    protected $client;

    /**
     * @var Symfony\Component\DependencyInjection\Container
     */
    protected $container;

    public function testIsThisThingOn()
    {
        $this->assertTrue(true);
    }

    public static function setUpBeforeClass()
    {
        self::$kernel = self::bootKernel();
        // Store the container and the entity manager in test case properties
        self::$em = self::$kernel->getContainer()->get('doctrine')->getManager();
        // Build the schema for sqlite
        self::generateSchema();
        //Loadup the fixtures
        self::loadFixtures();
    }

    public function setUp()
    {
        $this->client = self::$kernel->getContainer()->get('test.client');
    }

    public function tearDown() {}
    public static function tearDownAfterClass()
    {
        self::$kernel->shutdown();
    }

    public static function loadFixtures()
    {
        //Create a new loader
        $loader = new Loader();

        //Load from the directory
        $loader->loadFromDirectory(dirname(__DIR__) . '/DataFixtures/ORM');

        //Put in the temp db
        $purger   = new ORMPurger();
        $executor = new ORMExecutor(self::$em, $purger);
        $executor->execute($loader->getFixtures(), true);
    }

    public static function generateSchema()
    {
        // Get the metadata of the application to create the schema.
        $metadata = self::getMetadata();
        if (!empty($metadata)) {
            // Create SchemaTool
            $tool = new SchemaTool(self::$em);
            $tool->dropSchema($metadata);
            $tool->createSchema($metadata);
        } else {
            throw new Doctrine\DBAL\Schema\SchemaException('No Metadata Classes to process.');
        }
    }

/**
 * Overwrite this method to get specific metadata.
 *
 * @return array
 */
    public static function getMetadata()
    {
        return self::$em->getMetadataFactory()->getAllMetadata();
    }
}
