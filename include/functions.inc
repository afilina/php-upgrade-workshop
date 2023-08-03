<?php
if (!function_exists('format_price'))
{
    function format_price($price)
    {
        return '$' . number_format($price, 2, '.', ',');
    }
}

if (!function_exists('is_admin'))
{
    function is_admin()
    {
        global $user;
        return $user->is_admin;
    }
}

function export_pdf($html)
{
    include 'html2ps-2.0.43/config.inc.php';
    include HTML2PS_DIR.'pipeline.factory.class.php';
    include HTML2PS_DIR.'fetcher.memory.class.php';
    parse_config_file(HTML2PS_DIR.'html2ps.config');

    $pipeline = PipelineFactory::create_default_pipeline("","");
    $pipeline->fetchers = array(new FetcherMemory($html, 'data_id_products_list'));
    $pipeline->destination = new DestinationBrowser('products.pdf');
    $media = Media::predefined('A4');
    $media->set_landscape(false);
    $media->set_margins(array(
        'left' => 15,
        'right' => 15,
        'top' => 10,
        'bottom' => 10));
    $media->set_pixels(1024);
    $pipeline->process('data_id_products_list', $media);
}
?>
