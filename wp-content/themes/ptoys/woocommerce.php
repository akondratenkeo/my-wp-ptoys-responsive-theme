<?php
/**
 * The template for displaying pages
 */

$front_page_id = get_option( 'page_on_front' );

$blocks_groups = array(
    0 => array('shop_title', 'button_text', 'footer_text'),
    1 => array('title_1', 'title_2', 'title_3'),
    2 => array('text_block_1', 'mini-logo', 'slider_item_1', 'slider_item_2', 'slider_item_3', 'slider_item_4', 'slider_item_5'),
    3 => array('s3_title', 's3_image', 's3_text'),
    4 => array('cat_title_1', 'cat_text', 'cat_title_2'),
    5 => array('s5_text', 's5_image'),
    6 => array('act_header', 'act_line_1', 'act_image_l1', 'act_line_2', 'act_image_l2', 'act_item_1_img', 'act_item_2_img', 'act_item_3_img', 'act_price_old', 'act_price_new'),
    7 => array('how_title', 'how_info_list')
);

$fields = get_fields($front_page_id);
$fields_groups = array();

if( $fields ) {

    foreach( $fields as $field_name => $value ) {

        foreach ($blocks_groups as $key => $val) {
            if (in_array($field_name, $val)) {
                if (!array_key_exists($key, $fields_groups)) {
                    $fields_groups[$key] = array($field_name => $value);
                } else {
                    $fields_groups[$key] = array_merge($fields_groups[$key], array($field_name => $value));
                }
            }
        }
    }
}
foreach ($fields_groups[2] as $fg_key => $fg_val) {
    if (strstr($fg_key, 'slider_item')) {
        if (!array_key_exists('slider', $fields_groups[2])) {
            $fields_groups[2]['slider'] = array();
            $fields_groups[2]['slider'][] = $fg_val;
        } else {
            $fields_groups[2]['slider'][] = $fg_val;
        }
        unset($fields_groups[2][$fg_key]);
    }
}

get_header(); ?>

<main class="maincontent" id="maincontent">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-no-rel">
                <h1><?php echo $fields_groups[1]['title_1']; ?></h1>
                <p class="line-2"><?php echo $fields_groups[1]['title_2']; ?></p>
                <p class="line-3"><?php echo $fields_groups[1]['title_3']; ?></p>
            </div>
        </div>
    </div>
</main>
<div class="quality" id="quality">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-5 col-left">
                <div class="col-text">
                    <h3><?php echo $fields_groups[2]['text_block_1']; ?></h3>
                    <img src="<?php echo $fields_groups[2]['mini-logo']; ?>" alt="">
                </div>
            </div>
            <div class="col-xs-12 col-sm-1 col-md-4 col-sm-push-5 col-md-push-3">
                <div class="slider">
                    <div id="slides">
                        <div class="slides_container">
                            <?php foreach ($fields_groups[2]['slider'] as $slide_item) : ?>
                                <?php if (!empty($slide_item)) :?>
                                    <div><img src="<?php echo $slide_item; ?>" alt="" class="img-responsive"></div>
                                <?php endif;?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-5 col-md-3 col-sm-pull-1 col-md-pull-4">
                <a href="#catalog" class="button-1"><?php echo $fields_groups[0]['button_text']; ?></a>
            </div>
        </div>
    </div>
</div>
<div class="advertising" id="advertising">
    <div class="container">
        <h2><?php echo $fields_groups[3]['s3_title']; ?></h2>
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-left">
                <img src="<?php echo $fields_groups[3]['s3_image']; ?>" class="img-responsive center-block">
            </div>
            <div class="col-xs-12 col-sm-6 col-right">
                <?php echo $fields_groups[3]['s3_text']; ?>
                <a href="#catalog" class="button-1 center-block"><?php echo $fields_groups[0]['button_text']; ?></a>
            </div>
        </div>
    </div>
</div>
<div class="catalog" id="catalog">
<div class="container">
    <h2><?php echo $fields_groups[4]['cat_title_1']; ?></h2>
    <p class="row2"><?php echo $fields_groups[4]['cat_text']; ?></p>
    <?php woocommerce_content(); ?>
</div>
</div>
<div class="quote" id="quote">
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-7 col-left">
                <blockquote><?php echo $fields_groups[5]['s5_text']; ?></blockquote><br>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-right">
                <img src="<?php echo $fields_groups[5]['s5_image']; ?>" alt="" class="img-responsive">
            </div>
        </div>
    </div>
</div>
<div class="proposition" id="proposition">
    <div class="container">
        <h2><?php echo $fields_groups[6]['act_header']; ?></h2>
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-8 col-left">
                <p><?php echo $fields_groups[6]['act_line_1']; ?></p>
                <img src="<?php echo $fields_groups[6]['act_image_l1']; ?>" class="img-responsive center-block">
            </div>
            <div class="col-md-4 hidden-xs hidden-sm col-right">
                <form action="" method="POST" class="request-callback-1" id="ajaxform">
                    <div class="heading">Оставьте заявку<p>на игрушку или участие в акции</p></div>
                    <div class="inputs">
                        <div class="input-1"><input type="text" name="name" data-notice="Ваше имя" placeholder="Ваше имя"></div>
                        <div class="input-1"><input type="text" id="phone1" name="phone" data-notice="Ваш телефон" placeholder="Ваше телефон"></div>
                        <input type="submit" value="Отправить заявку">
                    </div>
                    <div class="input-caption">Ваши контактные данные в безопасности<br>и не будут переданы третьим лицам</div>
                </form>
            </div>
            <div class="col-xs-12 col-head">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-8">
                        <p class="text"><?php echo $fields_groups[6]['act_line_2']; ?></p>
                    </div>
                    <div class="col-md-4 hidden-xs hidden-sm">
                        <p class="price"><span><?php echo $fields_groups[6]['act_price_old']; ?></span><br><?php echo $fields_groups[6]['act_price_new']; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-items">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-1"></div>
                    <div class="col-xs-12 col-sm-12 col-md-9">
                        <div class="row">
                            <div class="col-xs-4 col-sm-4 p-item">
                                <div class="icircle"><img src="<?php echo $fields_groups[6]['act_item_1_img']['url']; ?>" class="img-responsive"></div>
                                <p><?php echo $fields_groups[6]['act_item_1_img']['description']; ?></p>
                            </div>
                            <div class="col-xs-4 col-sm-4 p-item">
                                <div class="icircle"><img src="<?php echo $fields_groups[6]['act_item_2_img']['url']; ?>" class="img-responsive"></div>
                                <p><?php echo $fields_groups[6]['act_item_2_img']['description']; ?></p>
                            </div>
                            <div class="col-xs-4 col-sm-4 p-item">
                                <div class="icircle"><img src="<?php echo $fields_groups[6]['act_item_3_img']['url']; ?>" class="img-responsive"></div>
                                <p><?php echo $fields_groups[6]['act_item_3_img']['description']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 hidden-md hidden-lg">
                        <p class="price"><span><?php echo $fields_groups[6]['act_price_old']; ?></span><br><?php echo $fields_groups[6]['act_price_new']; ?></p>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-xs-12 hidden-md hidden-lg">
                <form action="" method="POST" class="request-callback-1" id="ajaxform">
                    <div class="heading">Оставьте заявку<p>на игрушку или участие в акции</p></div>
                    <div class="inputs">
                        <div class="input-1"><input type="text" name="name" data-notice="Ваше имя" placeholder="Ваше имя"></div>
                        <div class="input-1"><input type="text" id="phone2" name="phone" data-notice="Ваш телефон" placeholder="Ваше телефон"></div>
                        <input type="submit" value="Отправить заявку">
                    </div>
                    <div class="input-caption">Ваши контактные данные в безопасности<br>и не будут переданы третьим лицам</div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="fast-acc-label-fixed">
    <a class="cart-label" href="#" data-toggle="modal" data-target="#myModal"></a>
    <a class="order-label" href="/order/"></a>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
