<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\SongBookRepository;
use App\Schema\SchemaFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class SongBookController extends AbstractController
{
    private SongBookRepository $songBookRepository;
    private SchemaFactory $schemaFactory;

    public function __construct(SongBookRepository $songBookRepository, SchemaFactory $schemaFactory)
    {
        $this->songBookRepository = $songBookRepository;
        $this->schemaFactory = $schemaFactory;
    }

    #[Route('/song-book', name: 'songbook_list')]
    public function list(): Response
    {
        $list = $this->songBookRepository->findAll();
        $songBookList = $this->schemaFactory->createSongBookList($list);
        return $this->json($songBookList);
    }

    #[Route('/song-book/{id<\d+>}', name: 'songbook_item')]
    public function item(int $id): Response
    {
        $item = $this->songBookRepository->find($id);
        if ($item) {
            $songBook = $this->schemaFactory->createSongBook($item);
        } else {
            throw new NotFoundHttpException("SongBook #$id not found", null, 40401);
        }
        return $this->json($songBook);
    }
}
