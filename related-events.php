<?php
$related_events = get_field('event_woocommerce_product');

if( $related_events ): ?>


<div class="loop">

	<?php foreach( $related_events as $post ): 
	
// Setup this post for WP functions (variable must be named $post).
setup_postdata($post);
		?>

	<div class="loop-item margin-bottom--m border-bottom--shade-ultra-light margin-bottom--l">

		<?php
	global $product;
	$event_tijd = get_post_meta( $product->get_id(), 'event_tijd', true );
	$event_datum = get_post_meta( $product->get_id(), 'event_datum', true );
	$date_now = date('Ymd'); // this format is string comparable
?>

		<?php if(strtotime($event_datum) >= strtotime($date_now))
{
 ?>

		<h4 class="margin-bottom--xs"> <?php 	echo $product->get_title(); ?> </h4>
		<div class="text--s margin-bottom--xs"><svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 20 20">
				<path id="Path_391" data-name="Path 391" d="M9.063,4.688a.938.938,0,0,1,1.875,0V9.5l3.332,2.219a.9.9,0,0,1,.227,1.3.86.86,0,0,1-1.266.227l-3.75-2.5a.857.857,0,0,1-.418-.781ZM10,0A10,10,0,1,1,0,10,10,10,0,0,1,10,0ZM1.875,10A8.125,8.125,0,1,0,10,1.875,8.124,8.124,0,0,0,1.875,10Z" />
			</svg>
			<?php echo $event_tijd;?> </div>

		<!-- Prijs en button -->
		<?php
	echo '<div class="margin-bottom--xs">' . $product->get_price_html() . '</div>';
?>
		<?php
echo '<div class="btn--secondary justify-content--center inline-block margin-bottom--xs">';
		
echo apply_filters( 'woocommerce_loop_add_to_cart_link',
    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( $product->get_id() ),
        esc_attr( $product->get_sku() ),
        $product->is_purchasable() ? 'add_to_cart_button' : '',
        esc_attr( $product->get_type() ),
        esc_html( $product->add_to_cart_text() )
    ),
$product );
		echo '</div>';	
?>
		<!-- /Prijs en button -->

	</div><!-- .loop-item -->
	<?php }
else {
    echo "";
}?>
	<?php endforeach; ?>

</div> <!-- .loop -->

<?php else: 
echo 'Nog geen events gepland. Schrijf je in voor onze nieuwsbrief en blijf op de hoogte van nieuwe events!';
?>
<?php 
// Reset the global post object so that the rest of the page works correctly.
wp_reset_postdata(); ?>
<?php endif; ?>
