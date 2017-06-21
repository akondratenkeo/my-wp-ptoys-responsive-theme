<?php
/**
 * The template for displaying the header
 */

$front_page_id = get_option( 'page_on_front' );
$fields = get_fields($front_page_id);

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
    <link href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" rel="shortcut icon" type="image/x-icon"; />
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-53166532-5', 'auto');
        ga('send', 'pageview');
    </script>
</head>

<body <?php body_class(); ?>>
    <div class="vspl"></div>
    <div id="vspl"><br><div id="exit">Закрыть</div></div>
    <header class="mainheader" id="top">
        <div class="container">
            <div class="row">
                <div class="col-xs-9 col-sm-9 col-md-6">
                    <div class="logo">
                        <a href="/"><img src="http://pamperok.com.ua/wp-content/uploads/2016/02/logo.png" alt="Logo"/></a>
                    </div>
                    <div class="hidden-xs left">
                        <p class="slogan"><?php echo str_replace('#', '<br>', $fields['shop_title']); ?></p>
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-6">
                    <nav>
                        <ul id="j-menu">
                            <li><a href="http://pamperok.com.ua/#advertising">О НАС</a></li>
                            <li><a href="http://pamperok.com.ua/#catalog">КАТАЛОГ ИГРУШЕК</a></li>
                            <li><a href="http://pamperok.com.ua/#proposition">АКЦИЯ</a></li>
                            <li><a href="http://pamperok.com.ua/#how-we-working">КАК МЫ РАБОТАЕМ</a></li>
                        </ul>
                        <a class="jump-menu" title="Show navigation">Show navigation</a>
                    </nav>
                </div>
            </div>
            <ul class="sm-menu" id="j-menu">
                <li><a href="http://pamperok.com.ua/#advertising">О НАС</a></li>
                <li><a href="http://pamperok.com.ua/#catalog">КАТАЛОГ ИГРУШЕК</a></li>
                <li><a href="http://pamperok.com.ua/#proposition">АКЦИЯ</a></li>
                <li><a href="http://pamperok.com.ua/#how-we-working">КАК МЫ РАБОТАЕМ</a></li>
            </ul>
        </div>
    </header>