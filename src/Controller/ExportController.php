<?php

class ExportController
{
    public function products_csvAction()
    {
        $result = Adapter53::mysql_query('SELECT * FROM products');
        while($row = Adapter53::mysql_fetch_array($result)) {
            $rows[] = $row;
        }

        $this->products_csvView($rows);
    }

    private function products_csvView($rows)
    {
        if (count($rows) == 0) {
            ?><p>No results found</p><?php
            return;
        }

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=products.csv");
        while (list($k, $v) = Adapter53::each($rows)) {
            echo implode(',', array('name'=>$v['name'], 'price'=>$v['price'])) . "\n";
        }
    }

    public function products_pdfAction()
    {
        $result = Adapter53::mysql_query('SELECT * FROM products');
        $html = $this->products_pdfView($result);
        export_pdf($html);
    }

    private function products_pdfView($result)
    {
        $html = '';
        $html .= '<h1>Product List</h1>';
        $html .= '<table border="1" cellspacing="0" cellpadding="5">';
        $html .= '<tr><td>Name</td><td>Price</td></tr>';
        while($row = Adapter53::mysql_fetch_array($result)) {
            $html .= '<tr><td>'.$row['name'].'</td><td>'.format_price($row['price']).'</td></tr>';
        }
        $html .= '</table>';
        $html .= '<p>Product count: ' . Adapter53::mysql_numrows($result).'</p>';
        return $html;
    }
}
