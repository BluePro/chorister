<?php

namespace App\DataFixtures;

use App\Entity\SongBook;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SongBookFixtures extends Fixture
{
    private const SONG_BOOK_LIST = [
        'Hosana I' => '2c3056',
        'Hosana II' => '266133'
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SONG_BOOK_LIST as $name => $color) {
            $songBook  = new SongBook();
            $songBook
                ->setName($name)
                ->setColor($color);
            $manager->persist($songBook);
        }

        $manager->flush();
    }
}
