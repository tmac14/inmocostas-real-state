<?php

namespace App\DataFixtures;

use App\Entity\Property;
use App\Entity\PropertyClass;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $propertyClass1 = new PropertyClass();
        $propertyClass1->setName('housing');
        $propertyClass2 = new PropertyClass();
        $propertyClass2->setName('duplex');
        $propertyClass2->setParent($propertyClass1);

        $manager->persist($propertyClass1);
        $manager->persist($propertyClass2);

        $propertyClasses = [
            'housing' => $propertyClass1,
            'duplex' => $propertyClass2
        ];

        foreach (self::getPropertiesData() as $propertyData) {
            $property = new Property();
            $property->setTitle($propertyData['title']);
            $property->setDescription($propertyData['description']);
            $property->setInternalRef($propertyData['internalRef']);
            $property->setExternalRef($propertyData['externalRef']);
            $property->setPropertyClass($propertyClasses[$propertyData['propertyClass']]);
            $property->setSurfaceSimpleNote($propertyData['surfaceSimpleNote']);
            $property->setSurfaceBuilt($propertyData['surfaceBuilt']);
            $property->setSurfaceUtil($propertyData['surfaceUtil']);
            $property->setYearBuilt($propertyData['yearBuilt']);
            $property->setRooms($propertyData['rooms']);
            $property->setBathrooms($propertyData['bathrooms']);
            $property->setConservationStatus(Property::PROPERTY_CONSERVATION_STATUSES[$propertyData['conservationStatus']]);
            $property->setTransactionType(Property::PROPERTY_TRANSACTION_TYPES[$propertyData['transactionType']]);
            $property->setPrice($propertyData['price']);

            $manager->persist($property);
        }

        $manager->flush();
    }

    private static function getPropertiesData()
    {
        yield [
            'title' => '59 Aguamarina Street, Cartagena',
            'description' => '
                <div>
                    This large house looks veryLive the dream in Cartagena! This beautiful duplex is perfect for a family or two couples. With 3 bedrooms and 3 bathrooms, the main floor offers a guest bath with a laundry room and a living room with a fireplace.
                    <br>
                    The lower level has a private garage that can accommodate 2 cars, garden patio, and a guest bedroom. The backyard is fully fenced and has a garden area, fruit trees, and plenty of room for kids to play.
                    <br><br>
                    Contact us to book your viewing today! modern and is in excellent condition.
                    <br><br>
                    The interior is done in rich colors. The yard is tiny and is neatly-trimmed.
                </div>',
            'internalRef' => 'REDU-1',
            'externalRef' => 'ALRE-11579',
            'propertyClass' => 'duplex',
            'surfaceSimpleNote' => 105.68,
            'surfaceBuilt' => 105.68,
            'surfaceUtil' => 95,
            'yearBuilt' => 1995,
            'rooms' => 5,
            'bedrooms' => 3,
            'bathrooms' => 3,
            'conservationStatus' => 'good condition',
            'transactionType' => 'for sale',
            'price' => 200000
        ];
    }
}
