<?php

namespace TRBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use TRBundle\Entity\Eigenfunction;

/**
 * Generated by Webonaute\DoctrineFixtureGenerator.
 *
 */
class LoadTRBundleEntityEigenfunction extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * Set loading order.
     *
     * @return int
     */
    public function getOrder()
    {
        return 2;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $manager->getClassMetadata(Eigenfunction::class)->setIdGeneratorType(ClassMetadata::GENERATOR_TYPE_NONE);

        $item1              = new Eigenfunction();
        $item1->trigger     = "Dogs plurality";
        $item1->scoring     = "Dogs";
        $item1->wave        = $this->getReference('_reference_TRBundleEntityWave1');
        $item1->description = "US Enters the Great War";
        $item1->id          = 1;
        $this->addReference('_reference_TRBundleEntityEigenfunction1', $item1);
        $manager->persist($item1);

        $item2              = new Eigenfunction();
        $item2->trigger     = "More sheep than dogs";
        $item2->scoring     = "Sheep";
        $item2->wave        = $this->getReference('_reference_TRBundleEntityWave1');
        $item2->description = "US Avoids the Great War";
        $item2->id          = 2;
        $this->addReference('_reference_TRBundleEntityEigenfunction2', $item2);
        $manager->persist($item2);

        $item3          = new Eigenfunction();
        $item3->trigger = "Dogs plurality";
        $item3->scoring = "Sheep";
        $item3->wave    = $this->getReference('_reference_TRBundleEntityWave2');

        $item3->description = "Germany Loses the Great War";
        $item3->id          = 3;
        $this->addReference('_reference_TRBundleEntityEigenfunction3', $item3);
        $manager->persist($item3);

        $item4          = new Eigenfunction();
        $item4->trigger = "Fewer pigs than sheep";
        $item4->scoring = "Pigs";
        $item4->wave    = $this->getReference('_reference_TRBundleEntityWave2');

        $item4->description = "Germany Stalemates the Great War";
        $item4->id          = 4;
        $this->addReference('_reference_TRBundleEntityEigenfunction4', $item4);
        $manager->persist($item4);

        $item5          = new Eigenfunction();
        $item5->trigger = "Dogs minority";
        $item5->scoring = "Dog";
        $item5->wave    = $this->getReference('_reference_TRBundleEntityWave2');

        $item5->description = "Germany Wins the Great War";
        $item5->id          = 5;
        $this->addReference('_reference_TRBundleEntityEigenfunction5', $item5);
        $manager->persist($item5);

        $item6          = new Eigenfunction();
        $item6->trigger = "Sheep plurality";
        $item6->scoring = "Pigs";
        $item6->wave    = $this->getReference('_reference_TRBundleEntityWave3');

        $item6->description = "Weimar Hyperinflation";
        $item6->id          = 6;
        $this->addReference('_reference_TRBundleEntityEigenfunction6', $item6);
        $manager->persist($item6);

        $item7          = new Eigenfunction();
        $item7->trigger = "More pigs than sheep";
        $item7->scoring = "Sheep";
        $item7->wave    = $this->getReference('_reference_TRBundleEntityWave3');

        $item7->description = "Weimar Depression";
        $item7->id          = 7;
        $this->addReference('_reference_TRBundleEntityEigenfunction7', $item7);
        $manager->persist($item7);

        $item8          = new Eigenfunction();
        $item8->trigger = "More pigs than dogs";
        $item8->scoring = "Dogs";
        $item8->wave    = $this->getReference('_reference_TRBundleEntityWave3');

        $item8->description = "Weimar Recession";
        $item8->id          = 8;
        $this->addReference('_reference_TRBundleEntityEigenfunction8', $item8);
        $manager->persist($item8);

        $item9          = new Eigenfunction();
        $item9->trigger = "Pigs plurality";
        $item9->scoring = "Pigs";
        $item9->wave    = $this->getReference('_reference_TRBundleEntityWave3');

        $item9->description = "Weimar Boom";
        $item9->id          = 9;
        $this->addReference('_reference_TRBundleEntityEigenfunction9', $item9);
        $manager->persist($item9);

        $item10          = new Eigenfunction();
        $item10->trigger = "Pigs majority";
        $item10->scoring = "Pigs";
        $item10->wave    = $this->getReference('_reference_TRBundleEntityWave4');

        $item10->description = "German Autocracy";
        $item10->id          = 10;
        $this->addReference('_reference_TRBundleEntityEigenfunction10', $item10);
        $manager->persist($item10);

        $item11          = new Eigenfunction();
        $item11->trigger = "Dogs plurality";
        $item11->scoring = "Dogs";
        $item11->wave    = $this->getReference('_reference_TRBundleEntityWave4');

        $item11->description = "German Fascism";
        $item11->id          = 11;
        $this->addReference('_reference_TRBundleEntityEigenfunction11', $item11);
        $manager->persist($item11);

        $item12          = new Eigenfunction();
        $item12->trigger = "Pigs plurality";
        $item12->scoring = "Pigs";
        $item12->wave    = $this->getReference('_reference_TRBundleEntityWave4');

        $item12->description = "German Nationalism";
        $item12->id          = 12;
        $this->addReference('_reference_TRBundleEntityEigenfunction12', $item12);
        $manager->persist($item12);

        $item13          = new Eigenfunction();
        $item13->trigger = "Sheep minority";
        $item13->scoring = "Dogs";
        $item13->wave    = $this->getReference('_reference_TRBundleEntityWave4');

        $item13->description = "German Populism";
        $item13->id          = 13;
        $this->addReference('_reference_TRBundleEntityEigenfunction13', $item13);
        $manager->persist($item13);

        $item14          = new Eigenfunction();
        $item14->trigger = "Sheep plurality";
        $item14->scoring = "Sheep";
        $item14->wave    = $this->getReference('_reference_TRBundleEntityWave4');

        $item14->description = "German Socialism";
        $item14->id          = 14;
        $this->addReference('_reference_TRBundleEntityEigenfunction14', $item14);
        $manager->persist($item14);

        $item15          = new Eigenfunction();
        $item15->trigger = "Sheep plurality";
        $item15->scoring = "Sheep";
        $item15->wave    = $this->getReference('_reference_TRBundleEntityWave5');

        $item15->description = "Germany does not attack Russia";
        $item15->id          = 15;
        $this->addReference('_reference_TRBundleEntityEigenfunction15', $item15);
        $manager->persist($item15);

        $item16          = new Eigenfunction();
        $item16->trigger = "Dogs plurality";
        $item16->scoring = "Dogs";
        $item16->wave    = $this->getReference('_reference_TRBundleEntityWave5');

        $item16->description = "Germany attacks Russia";
        $item16->id          = 16;
        $this->addReference('_reference_TRBundleEntityEigenfunction16', $item16);
        $manager->persist($item16);

        $item17          = new Eigenfunction();
        $item17->trigger = "Dogs majority";
        $item17->scoring = "Dogs";
        $item17->wave    = $this->getReference('_reference_TRBundleEntityWave5');

        $item17->description = "Russia declares war on Britain";
        $item17->id          = 17;
        $this->addReference('_reference_TRBundleEntityEigenfunction17', $item17);
        $manager->persist($item17);

        $item18          = new Eigenfunction();
        $item18->trigger = "Pigs majority";
        $item18->scoring = "Pigs";
        $item18->wave    = $this->getReference('_reference_TRBundleEntityWave6');

        $item18->description = "Germany does not honor alliance with Japan";
        $item18->id          = 18;
        $this->addReference('_reference_TRBundleEntityEigenfunction18', $item18);
        $manager->persist($item18);

        $item19          = new Eigenfunction();
        $item19->trigger = "Dogs plurality";
        $item19->scoring = "Dogs";
        $item19->wave    = $this->getReference('_reference_TRBundleEntityWave6');

        $item19->description = "Germany declares war on US";
        $item19->id          = 19;
        $this->addReference('_reference_TRBundleEntityEigenfunction19', $item19);
        $manager->persist($item19);

        $item20          = new Eigenfunction();
        $item20->trigger = "Pigs plurality";
        $item20->scoring = "Sheep";
        $item20->wave    = $this->getReference('_reference_TRBundleEntityWave7');

        $item20->description = "Decisive German Victory in WW II";
        $item20->id          = 20;
        $this->addReference('_reference_TRBundleEntityEigenfunction20', $item20);
        $manager->persist($item20);

        $item21          = new Eigenfunction();
        $item21->trigger = "Dogs minority";
        $item21->scoring = "Pigs";
        $item21->wave    = $this->getReference('_reference_TRBundleEntityWave7');

        $item21->description = "Marginal German Victory in WW II";
        $item21->id          = 21;
        $this->addReference('_reference_TRBundleEntityEigenfunction21', $item21);
        $manager->persist($item21);

        $item22          = new Eigenfunction();
        $item22->trigger = "Sheep majority";
        $item22->scoring = "Dogs";
        $item22->wave    = $this->getReference('_reference_TRBundleEntityWave7');

        $item22->description = "Marginal German Defeat in WW II";
        $item22->id          = 22;
        $this->addReference('_reference_TRBundleEntityEigenfunction22', $item22);
        $manager->persist($item22);

        $item23          = new Eigenfunction();
        $item23->trigger = "Sheep plurality";
        $item23->scoring = "Pigs";
        $item23->wave    = $this->getReference('_reference_TRBundleEntityWave7');

        $item23->description = "Decisive German Defeat in WW II";
        $item23->id          = 23;
        $this->addReference('_reference_TRBundleEntityEigenfunction23', $item23);
        $manager->persist($item23);

        $item24          = new Eigenfunction();
        $item24->trigger = "Pigs majority";
        $item24->scoring = "Pigs";
        $item24->wave    = $this->getReference('_reference_TRBundleEntityWave8');

        $item24->description = "Germany builds the Bomb";
        $item24->id          = 24;
        $this->addReference('_reference_TRBundleEntityEigenfunction24', $item24);
        $manager->persist($item24);

        $item25          = new Eigenfunction();
        $item25->trigger = "Sheep plurality";
        $item25->scoring = "Sheep";
        $item25->wave    = $this->getReference('_reference_TRBundleEntityWave8');

        $item25->description = "Germany abandons the Bomb";
        $item25->id          = 25;
        $this->addReference('_reference_TRBundleEntityEigenfunction25', $item25);
        $manager->persist($item25);

        $item26          = new Eigenfunction();
        $item26->trigger = "Sheep minority";
        $item26->scoring = "Dogs";
        $item26->wave    = $this->getReference('_reference_TRBundleEntityWave9');

        $item26->description = "US Obliterates Europe";
        $item26->id          = 26;
        $this->addReference('_reference_TRBundleEntityEigenfunction26', $item26);
        $manager->persist($item26);

        $item27          = new Eigenfunction();
        $item27->trigger = "Pigs plurality";
        $item27->scoring = "Sheep";
        $item27->wave    = $this->getReference('_reference_TRBundleEntityWave9');

        $item27->description = "US Establishes Strategic Deterrent";
        $item27->id          = 27;
        $this->addReference('_reference_TRBundleEntityEigenfunction27', $item27);
        $manager->persist($item27);

        $item28          = new Eigenfunction();
        $item28->trigger = "Pigs plurality";
        $item28->scoring = "Pigs";
        $item28->wave    = $this->getReference('_reference_TRBundleEntityWave10');

        $item28->description = "Germany Wins Cold War";
        $item28->id          = 28;
        $this->addReference('_reference_TRBundleEntityEigenfunction28', $item28);
        $manager->persist($item28);

        $item29          = new Eigenfunction();
        $item29->trigger = "More pigs than dogs";
        $item29->scoring = "Sheep";
        $item29->wave    = $this->getReference('_reference_TRBundleEntityWave10');

        $item29->description = "Germany Stalemates Cold War";
        $item29->id          = 29;
        $this->addReference('_reference_TRBundleEntityEigenfunction29', $item29);
        $manager->persist($item29);

        $item30          = new Eigenfunction();
        $item30->trigger = "More dogs than pigs";
        $item30->scoring = "Sheep";
        $item30->wave    = $this->getReference('_reference_TRBundleEntityWave10');

        $item30->description = "Germany Loses Cold War";
        $item30->id          = 30;
        $this->addReference('_reference_TRBundleEntityEigenfunction30', $item30);
        $manager->persist($item30);

        $item31          = new Eigenfunction();
        $item31->trigger = "Sheep minority";
        $item31->scoring = "Dogs";
        $item31->wave    = $this->getReference('_reference_TRBundleEntityWave10');

        $item31->description = "Limited Exchange";
        $item31->id          = 31;
        $this->addReference('_reference_TRBundleEntityEigenfunction31', $item31);
        $manager->persist($item31);

        $item32          = new Eigenfunction();
        $item32->trigger = "Pigs plurality";
        $item32->scoring = "Pigs";
        $item32->wave    = $this->getReference('_reference_TRBundleEntityWave11');

        $item32->description = "Fuhrer is succeeded";
        $item32->id          = 32;
        $this->addReference('_reference_TRBundleEntityEigenfunction32', $item32);
        $manager->persist($item32);

        $item33          = new Eigenfunction();
        $item33->trigger = "Dogs majority";
        $item33->scoring = "Dogs";
        $item33->wave    = $this->getReference('_reference_TRBundleEntityWave11');

        $item33->description = "Fuhrer is assassinated";
        $item33->id          = 33;
        $this->addReference('_reference_TRBundleEntityEigenfunction33', $item33);
        $manager->persist($item33);
        $manager->flush();

        $item3->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction1'),
        ];
        $item4->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction2'),
        ];
        $item5->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction1'),
            $this->getReference('_reference_TRBundleEntityEigenfunction2'),
        ];
        $item6->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction3'),
        ];
        $item7->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction3'),
            $this->getReference('_reference_TRBundleEntityEigenfunction5'),
        ];
        $item8->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction4'),
            $this->getReference('_reference_TRBundleEntityEigenfunction5'),
        ];
        $item9->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction4'),
        ];
        $item10->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction6'),
        ];
        $item11->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction6'),
            $this->getReference('_reference_TRBundleEntityEigenfunction7'),
        ];
        $item12->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction7'),
            $this->getReference('_reference_TRBundleEntityEigenfunction8'),
        ];
        $item13->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction8'),
            $this->getReference('_reference_TRBundleEntityEigenfunction9'),
        ];
        $item14->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction9'),
        ];
        $item15->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction10'),
            $this->getReference('_reference_TRBundleEntityEigenfunction13'),
        ];
        $item16->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction11'),
            $this->getReference('_reference_TRBundleEntityEigenfunction12'),
        ];
        $item17->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction11'),
            $this->getReference('_reference_TRBundleEntityEigenfunction14'),
        ];
        $item18->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction13'),
            $this->getReference('_reference_TRBundleEntityEigenfunction14'),
        ];
        $item19->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction10'),
            $this->getReference('_reference_TRBundleEntityEigenfunction11'),
            $this->getReference('_reference_TRBundleEntityEigenfunction12'),
        ];
        $item20->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction17'),
        ];
        $item21->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction15'),
            $this->getReference('_reference_TRBundleEntityEigenfunction17'),
            $this->getReference('_reference_TRBundleEntityEigenfunction18'),
        ];
        $item22->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction15'),
            $this->getReference('_reference_TRBundleEntityEigenfunction16'),
            $this->getReference('_reference_TRBundleEntityEigenfunction18'),
            $this->getReference('_reference_TRBundleEntityEigenfunction19'),
        ];
        $item23->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction16'),
            $this->getReference('_reference_TRBundleEntityEigenfunction18'),
            $this->getReference('_reference_TRBundleEntityEigenfunction19'),
        ];
        $item24->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction20'),
            $this->getReference('_reference_TRBundleEntityEigenfunction21'),
            $this->getReference('_reference_TRBundleEntityEigenfunction22'),
        ];
        $item25->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction20'),
            $this->getReference('_reference_TRBundleEntityEigenfunction21'),
            $this->getReference('_reference_TRBundleEntityEigenfunction22'),
        ];
        $item26->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction25'),
        ];
        $item27->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction25'),
        ];
        $item28->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction24'),
        ];
        $item29->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction24'),
        ];
        $item30->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction24'),
        ];
        $item31->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction24'),
        ];
        $item32->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction28'),
            $this->getReference('_reference_TRBundleEntityEigenfunction29'),
            $this->getReference('_reference_TRBundleEntityEigenfunction30'),
        ];
        $item33->prev = [
            $this->getReference('_reference_TRBundleEntityEigenfunction23'),
            $this->getReference('_reference_TRBundleEntityEigenfunction26'),
            $this->getReference('_reference_TRBundleEntityEigenfunction27'),
            $this->getReference('_reference_TRBundleEntityEigenfunction28'),
            $this->getReference('_reference_TRBundleEntityEigenfunction29'),
            $this->getReference('_reference_TRBundleEntityEigenfunction30'),
            $this->getReference('_reference_TRBundleEntityEigenfunction31'),
        ];

        $manager->flush();
    }
}
