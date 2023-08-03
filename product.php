<?php
include 'include/common.inc';

$result = Adapter53::mysql_query('SELECT * FROM products WHERE id = ' . $_GET['id']);
$product = Adapter53::mysql_fetch_object($result);

$title = $product->name;

switch ($_GET['action']) {
    case 'view':
        include 'page_header.inc';
    ?>
    <h1><?=$product->name?></h1>
    <?php if (is_admin()): ?>
        <a href="<?=$hostname?>/product.php?action=edit&id=<?=$_GET['id']?>">Admin Edit</a>
    <?php endif ?>
    <p>Price: <?=format_price($product->price)?></p>
    <?php
        break;
    case 'edit':
        include 'page_header.inc';
        include 'functions_admin.inc';
        $form_values = get_form_values($product);
        $validation = array(
            'name' => array('notempty' => true, 'length' => array('max' => MAX_PRODUCT_NAME_LENGTH))
        );
        $is_valid = validate($form_values, $validation);
        if (is_form_submitted() && $is_valid) {
            //The Elder Scrolls V: Skyrim
            Adapter53::mysql_query("UPDATE products SET name = '$form_values->name', price = '$form_values->price' WHERE id = {$_GET['id']}");
            header('Location: '.$hostname.'/product.php?action=view&id='.$_GET['id']);
            exit;
        }
        ?>
        <h1>Edit Product <?=$product->id?></h1>
        <?php
        if (is_form_submitted() && count($errors) > 0) {
            show_form_errors();
        }
        ?>
        <form action="<?=$hostname?>/product.php?action=edit&id=<?=$_GET['id']?>" method="POST">
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" value="<?=$form_values->name?>" name="name"></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" value="<?=$form_values->price?>" name="price"></td>
                </tr>
            </table>
            <input type="submit" value="Submit">
        </form>
        <?php
        break;
}

include 'page_footer.inc';
?>
