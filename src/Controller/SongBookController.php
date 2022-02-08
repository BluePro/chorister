<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\SongBookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SongBookController extends AbstractController
{
    private SongBookRepository $songBookRepository;

    public function __construct(SongBookRepository $songBookRepository)
    {
        $this->songBookRepository = $songBookRepository;
    }

    #[Route('/song-book', name: 'songbook_list')]
    public function list(): Response
    {
        $list = $this->songBookRepository->findAll();
        return $this->json($list);
    }

    #[Route('/song-book/{id<\d+>}', name: 'songbook_item')]
    public function item(int $id): Response
    {
        $item = $this->songBookRepository->find($id);
        return $this->json($item);
    }
}
