<?
include 'include/common.inc';

switch ($HTTP_GET_VARS{'action'}) {
    case 'products_csv':
        $result = mysql_query('SELECT * FROM products');
        while($row = mysql_fetch_array($result)) {
            $rows[] = $row;
        }

        if (count($rows) == 0) {
            ?><p>No results found</p><?
            exit;
        }

        header("Content-Type: text/csv");
        header("Content-Disposition: attachment; filename=products.csv");
        while (list($k, $v) = each($rows)) {
            echo implode(array('name'=>$v{'name'}, 'price'=>$v{'price'}), ',') . "\n";
        }
        exit;
    case 'products_pdf':
        $html .= '<h1>Product List</h1>';
        $html .= '<table border="1" cellspacing="0" cellpadding="5">';
        $html .= '<tr><td>Name</td><td>Price</td></tr>';
        $result = mysql_query('SELECT * FROM products');
        while($row = mysql_fetch_array($result)) {
            $html .= '<tr><td>'.$row['name'].'</td><td>'.format_price($row['price']).'</td></tr>';
        }
        $html .= '</table>';
        $html .= '<p>Product count: '.mysql_numrows($result).'</p>';
        export_pdf($html);
}
?>
