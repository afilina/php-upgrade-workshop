<?php

use Config\ViewGlobals;
use Products\Money;
use Products\Product;
use Products\ProductRepository;

class ProductController
{
    public function __construct(
        private readonly ViewGlobals $viewGlobals,
        private readonly ProductRepository $productRepository,
    )
    {
    }

    public function viewAction()
    {
        $product = $this->fetchProduct();

        $title = $product->name;

        $this->viewView($title, $product);
    }

    private function viewView($title, $product)
    {
        include 'page_header.inc';

        ?>
        <h1><?=$product->name?></h1>
        <?php if (is_admin()): ?>
        <a href="<?=$this->viewGlobals->hostname?>/product.php?action=edit&id=<?=$_GET['id']?>">Admin Edit</a>
    <?php endif ?>
        <p>Price: <?=format_price($product->price)?></p>
        <?php

        include 'page_footer.inc';
    }

    public function editAction()
    {
        $product = $this->fetchProduct();
        include 'functions_admin.inc';

        $form_values = get_form_values($product);
        $validation = array(
            'name' => array('notempty' => true, 'length' => array('max' => MAX_PRODUCT_NAME_LENGTH))
        );
        $is_valid = validate($form_values, $validation);
        if (is_form_submitted() && $is_valid) {
            //The Elder Scrolls V: Skyrim
            $this->productRepository->update(new Product($_GET['id'], $form_values->name, Money::fromString($form_values->price)));
            header('Location: ' . $this->viewGlobals->hostname . '/product.php?action=view&id=' . $_GET['id']);
            return;
        }

        $this->editView($product, $form_values);
    }

    private function editView($product, $form_values)
    {
        global $errors;
        include 'page_header.inc';
        ?>

        <h1>Edit Product <?= $product->id ?></h1>
        <?php
        if (is_form_submitted() && count($errors) > 0) {
            show_form_errors();
        }
        ?>
        <form action="<?= $this->viewGlobals->hostname ?>/product.php?action=edit&id=<?= $_GET['id'] ?>" method="POST">
            <table>
                <tr>
                    <td>Name:</td>
                    <td><input type="text" value="<?= $form_values->name ?>" name="name"></td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td><input type="text" value="<?= $form_values->price ?>" name="price"></td>
                </tr>
            </table>
            <input type="submit" value="Submit">
        </form>
        <?php
        include 'page_footer.inc';
    }

    private function fetchProduct()
    {
        $result = Adapter53::mysql_query('SELECT * FROM products WHERE id = ' . $_GET['id']);
        return Adapter53::mysql_fetch_object($result);
    }
}
