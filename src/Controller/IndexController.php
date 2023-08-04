<?php

use Twig\Environment;

class IndexController
{
    public function __construct(
        private readonly Environment $templating,
    )
    {
    }

    public function defaultAction()
    {
        $result = Adapter53::mysql_query('SELECT * FROM products');

        echo $this->templating->render('index/default.html.twig', [
            'results' => mysqli_fetch_all($result, MYSQLI_ASSOC)
        ]);
    }
}
