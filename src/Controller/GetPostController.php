<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\PostRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetPostController extends AbstractController
{
    #[Route('/posts', name: 'api_posts', methods: ['GET'])]
    public function getPosts(PostRepository $postRepository): JsonResponse
    {
        $posts = $postRepository->findAll();
        $responseData = [];

        foreach ($posts as $post) {
            $responseData[] = [
                'id' => $post->getId(),
                'title' => $post->getTitle(),
                'body' => $post->getBody(),
            ];
        }

        return new JsonResponse($responseData);
    }
}
