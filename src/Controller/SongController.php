<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\SongRepository;
use App\Schema\SchemaFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class SongController extends AbstractController
{
    private SongRepository $songRepository;
    private SchemaFactory $schemaFactory;

    public function __construct(SongRepository $songRepository, SchemaFactory $schemaFactory)
    {
        $this->songRepository = $songRepository;
        $this->schemaFactory = $schemaFactory;
    }

    #[Route('/song', name: 'song_list')]
    public function list(): Response
    {
        $list = $this->songRepository->findAll();
        $songList = $this->schemaFactory->createSongList($list);
        return $this->json($songList);
    }

    #[Route('/song/{id<\d+>}', name: 'song_item')]
    public function item(int $id): Response
    {
        $item = $this->songRepository->find($id);
        if ($item) {
            $song = $this->schemaFactory->createSong($item);
        } else {
            throw new NotFoundHttpException("Song #$id not found", null, 40102);
        }
        return $this->json($song);
    }
}
