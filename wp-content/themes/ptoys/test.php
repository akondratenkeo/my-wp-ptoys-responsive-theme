
<?php

	$posts = get_posts(array(
		'numberposts'     => 5,
		'category'        => 7,
		'post_status'     => 'publish'
	));

	foreach ($posts as $post) {
		//$fields = get_fields($post->ID);
		$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
		var_dump($image);
	}

