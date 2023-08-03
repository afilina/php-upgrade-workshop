<?
include 'include/common.inc';
$title = 'My Awesome Shop';
include 'page_header.inc';

// Queries
$result = mysql_query('SELECT * FROM products');

// HTML
?>
<a href="<?=$hostname?>/export.php?action=products_csv">Export CSV</a> | <a href="<?=$hostname?>/export.php?action=products_pdf">Export PDF</a>
<table border="1">
    <tr>
        <td>Product</td>
        <td>Price</td>
    </tr>
<?
while($row = mysql_fetch_array($result)) {
    ?>
    <tr>
        <td><a href="<?=$hostname?>/product.php?action=view&id=<?=$row['id']?>"><?=$row['name']?></a></td>
        <td><?=format_price($row['price'])?></td>
    </tr>
    <?
}
?>
</table>
<?
include 'page_footer.inc';
?>
