<?php

use Products\ProductRepository;
use Twig\Environment;

class IndexController
{
    public function __construct(
        private readonly Environment $templating,
        private readonly ProductRepository $productRepository
    )
    {
    }

    public function defaultAction()
    {
        echo $this->templating->render('index/default.html.twig', [
            'results' => $this->productRepository->fetchAll()
        ]);
    }
}
