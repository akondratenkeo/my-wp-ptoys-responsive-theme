<?php
/**
 * The template for displaying the footer
 */

$front_page_id = get_option( 'page_on_front' );
$fields = get_fields($front_page_id);

?>

    <div class="how-we-working" id="how-we-working">
        <div class="container">
            <h2><?php echo $fields['how_title']; ?></h2>
            <div class="row">
                <?php
                    $i = 1;
                    foreach(explode(';', $fields['how_info_list']) as $info_item) :
                ?>
                <div class="col-xs-12 col-sm-4 col-md-2">
                    <div class="icon i-<?php echo $i; ?>"></div>
                    <p><?php echo $info_item; ?></p>
                </div>
                <?php
                    $i++;
                    endforeach;
                ?>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p><?php echo $fields['footer_text']; ?></p>
        </div>
    </footer>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title">Корзина</h2>
                </div>
                <div class="modal-body">
                    <img class="ajax-loader" src="http://pamperok.com.ua/wp-content/themes/ptoys/images/ajax-loader.gif" alt="Loader"/>
                </div>
            </div>
        </div>
    </div>

    <?php wp_footer(); ?>
</body>
</html>
