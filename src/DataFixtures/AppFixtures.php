<?php

namespace App\DataFixtures;

use App\Entity\Catalog;
use App\Entity\Liturgy;
use App\Entity\Period;
use App\Entity\Song;
use App\Entity\SongBook;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private const SONG_BOOK_LIST = [
        'Hosana I' => '2c3056',
        'Hosana II' => '266133'
    ];
    private const LITURGY_LIST = [
        'MV' => 'Vstup,',
        'ME' => 'Evangelium',
        'MD' => 'Dary',
        'MP' => 'Přijímání',
        'MZ' => 'Závěr'
    ];
    private const PERIOD_LIST = [
        'AD' => 'Advent',
        'VA' => 'Vánoce',
        'PU' => 'Postní doba',
        'VE' => 'Velikonoce'
    ];
    private const TAG_LIST = [
        'Žalm',
        'Opakovací'
    ];
    private const SONG_LIST = [
        'Ejhle Hospodin přijde' => [
            'book' => [ 0 => '96' ],
            'tag' => [],
            'liturgy' => [ 0 ],
            'period' => 0
        ],
        'Hospodin je můj pastýř' => [
            'book' => [ 1 => '92' ],
            'tag' => [ 0, 1 ],
            'liturgy' => [ 1 ]
        ],
        'Chvalte služebníci' => [
            'book' => [ 1 => '120' ],
            'tag' => [],
            'liturgy' => [ 0, 4 ]
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        $songBookList = $this->createSongBookList($manager);
        $liturgyList = $this->createLiturgyList($manager);
        $periodList = $this->createPeriodList($manager);
        $tagList = $this->createTagList($manager);

        $this->createSongList($manager, $songBookList, $liturgyList, $periodList, $tagList);

        $manager->flush();
    }

    /**
     * @param ObjectManager $manager
     * @return SongBook[]
     */
    private function createSongBookList(ObjectManager $manager): array
    {
        $songBookList = [];
        foreach (self::SONG_BOOK_LIST as $name => $color) {
            $songBook = new SongBook();
            $songBook
                ->setName($name)
                ->setColor($color);
            $manager->persist($songBook);
            $songBookList[] = $songBook;
        }
        return $songBookList;
    }

    /**
     * @param ObjectManager $manager
     * @return Liturgy[]
     */
    private function createLiturgyList(ObjectManager $manager): array
    {
        $liturgyList = [];
        foreach (self::LITURGY_LIST as $code => $name) {
            $liturgy = new Liturgy();
            $liturgy
                ->setName($name)
                ->setCode($code);
            $manager->persist($liturgy);
            $liturgyList[] = $liturgy;
        }
        return $liturgyList;
    }

    /**
     * @param ObjectManager $manager
     * @return Period[]
     */
    private function createPeriodList(ObjectManager $manager): array
    {
        $periodList = [];
        foreach (self::PERIOD_LIST as $code => $name) {
            $period = new Period();
            $period
                ->setName($name)
                ->setCode($code);
            $manager->persist($period);
            $periodList[] = $period;
        }
        return $periodList;
    }

    /**
     * @param ObjectManager $manager
     * @return Tag[]
     */
    private function createTagList(ObjectManager $manager): array
    {
        $tagList = [];
        foreach (self::TAG_LIST as $name) {
            $tag = new Tag();
            $tag
                ->setName($name);
            $manager->persist($tag);
            $tagList[] = $tag;
        }
        return $tagList;
    }

    /**
     * @param ObjectManager $manager
     * @param SongBook[] $songBookList
     * @param Liturgy[] $liturgyList
     * @param Period[] $periodList
     * @param Tag[] $tagList
     * @return void
     */
    private function createSongList(
        ObjectManager $manager,
        array $songBookList,
        array $liturgyList,
        array $periodList,
        array $tagList
    ): void {
        foreach (self::SONG_LIST as $name => $data) {
            $song = new Song();
            $song->setName($name);

            foreach ($data['tag'] as $tag) {
                $song->addTag($tagList[$tag]);
            }
            foreach ($data['liturgy'] as $liturgy) {
                $song->addLiturgy($liturgyList[$liturgy]);
            }
            if (isset($data['period'])) {
                $song->setPeriod($periodList[$data['period']]);
            }

            $manager->persist($song);

            foreach ($data['book'] as $book => $number) {
                $catalog = new Catalog();
                $catalog
                    ->setSong($song)
                    ->setSongBook($songBookList[$book])
                    ->setNumber($number);
                $manager->persist($catalog);
            }
        }
    }
}
