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

        echo $this->templating->render('index/deault.html.twig', [
            'results' => mysqli_fetch_all($result, MYSQLI_ASSOC)
        ]);
    }

    private function defaultView($title, $result)
    {
        include 'page_header.inc';
        include 'page_footer.inc';
    }
}
