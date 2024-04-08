<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\HttpClient\HttpClient;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Post;
use App\Entity\User;

#[AsCommand(
    name: 'app:fetch-posts',
    description: 'Add a short description for your command',
)]

class FetchPostsCommand extends Command
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {

    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $client = HttpClient::create();

        $responseUsers = $client->request('GET', 'https://jsonplaceholder.typicode.com/users');
        $users = $responseUsers->toArray();

        foreach ($users as $userData) {
                $user = new User();
                $user->setName($userData['name']);
                $user->setUsername($userData['username']);
                $this->entityManager->persist($user);
        }

        $this->entityManager->flush();
        $io->success('Users [Successfully]');

        $responsePosts = $client->request('GET', 'https://jsonplaceholder.typicode.com/posts');
        $posts = $responsePosts->toArray();

        foreach ($posts as $postData) {
            $post = new Post();
            $post->setTitle($postData['title']);
            $post->setBody($postData['body']);

            $user = $this->entityManager->getRepository(User::class)->find($postData['userId']);
            if ($user) {
                $post->setAuthor($user);
            }

            $this->entityManager->persist($post);
        }

        $this->entityManager->flush();
        $io->success('Posts [Successfully]');

        return Command::SUCCESS;
    }

}
