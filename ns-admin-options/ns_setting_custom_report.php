<div class="genRowNssdc">
    <h2 class="ns-rac-main-title ns-rac-report-main-title">NS Recover Abandoned Chart </h2>	
	<h2>Report</h2>	

	<hr>
	<?php
		//Getting the option with total RESTORED/ABANDONED cart prices
		$total_amount_restored = get_option( 'rac_recovered_amount' );
		$total_amount_abandoned = get_option( 'rac_abandoned_amount' );

		//Getting the option with total RESTORED/ABANDONED cart
		$total_cart_restored = get_option( 'rac_recovered_number' );
		$total_cart_abandoned = get_option( 'rac_abandoned_number' );
if(class_exists( 'WooCommerce' )){
	?>

	<div class="rac-stats-dashboard">
		<div class="rac-stat-panel">
			<div class="rac-stat-square rac-square-blue">

			</div>
			<div class="rac-stat-panel-inner-info">
				<p>Total restored amount</p>
				<h1><?php echo $total_amount_restored.' '.get_woocommerce_currency_symbol(); ?></h1>
			</div>
		</div>

		<div class="rac-stat-panel">
			<div class="rac-stat-square rac-square-red">
				
			</div>
			<div class="rac-stat-panel-inner-info">
				<p>Total abandoned amount</p>
				<h1><?php echo $total_amount_abandoned.' '.get_woocommerce_currency_symbol(); ?></h1>
			</div>
		</div>

		<div class="rac-stat-panel">
			<div class="rac-stat-square rac-square-green">

			</div>
			<div class="rac-stat-panel-inner-info">
				<p>Total restored cart</p>
				<h1><?php echo $total_cart_restored; ?></h1>
			</div>
		</div>

		<div class="rac-stat-panel">
			<div class="rac-stat-square rac-square-yellow">

			</div>
			<div class="rac-stat-panel-inner-info">
				<p>Total abandoned cart</p>
				<h1><?php echo $total_cart_abandoned; ?></h1>
			</div>
		</div>
	</div>

	<!-- Table list section -->
	
	<?php 
		global $wpdb;
		$table_name = $wpdb->prefix . "ns_rac_db_table"; 

		//$results = $wpdb->get_results( "SELECT * FROM $table_name" );

		//Ad Hoc Pagination
		$table_page = 1;
		if(isset($_GET['table-page'])){
			$table_page = sanitize_text_field($_GET['table-page']);
		}

		$items_per_page = 10;
		$offset = ( $table_page * $items_per_page ) - $items_per_page;

		$query = 'SELECT * FROM '.$table_name;
		$total_query = "SELECT COUNT(1) FROM (${query}) AS combined_table";
		$total = $wpdb->get_var( $total_query );

		$results = $wpdb->get_results(  $query.' ORDER BY id DESC LIMIT '. $offset.', '. $items_per_page, OBJECT );

		//------------------
		
	?>
	<div class="rac-list-container-class">
		<?php
		if($results != null){
		?>
		<table class="rac-table-class">
			<tr>
				<th>ID</th>
				<th>Creation Time</th>
				<th>Order ID</th>
				<th>Products ( Quantity )</th>
				<th>Total price</th>
				<th>Status</th>
				<th>User Email</th>
				<th>IP Address</th>
			</tr>
			<?php
				foreach($results as $res){
					$id = $res->id;
					$time = $res->time;
					$rac_order = ($res->order_id == null) ? '-' : '<a href="'.get_edit_post_link( $res->order_id ).'" target="_blank">'.$res->order_id.'</a>';
					$user_id = $res->ns_rac_user_id;
					$rac_user = get_user_by( 'ID', $user_id );
					$user_mail = ($user_id == '0') ? 'Guest' : $rac_user->user_email;
					$rac_td_bkg_color_status = '';
					$ip_address = $res->ip_address;

					
					$status = $res->status;
					if($status == 'RESTORED'){
						$status_class = 'rac-status-color-restored';
						$rac_td_bkg_color_status = 'rac-td-bkg-status-payment-restored';
					}
					else if($status == 'ABANDONED'){
						$status_class = 'rac-status-color-abandoned';
						$rac_td_bkg_color_status = 'rac-td-bkg-status-payment-abandoned';
					}
					else if($status == 'PENDING'){
						$status_class = 'rac-status-color-pending';
					}
					else if($status == 'MAIL-SENT'){
						$status_class = 'rac-status-color-mail-sent';
					}
					else if($status == 'EMPTY'){
						$status_class = 'rac-status-color-empty';
					}
					else if($status == 'PROCESSING'){
						$status_class = 'rac-status-color-processing';
					}
					else if($status == 'COMPLETED'){
						$status_class = 'rac-status-color-completed';
						$rac_td_bkg_color_status = 'rac-td-bkg-status-payment-completed';
					}

					//Get the cart values
					$cart = $wpdb->get_results("SELECT cart FROM $table_name WHERE id = $res->id");
					$product_links = '';
					//print_r(unserialize($cart[0]->cart));
					$total_price = 0;
					
					$item_counter = 1;
					$item_num = count(unserialize($cart[0]->cart));

					foreach(unserialize($cart[0]->cart) as $prod_id=>$inner_arr){

						$comma = ( ($item_num > 1) && ($item_num != $item_counter) )  ? $comma = ', ' : $comma = ' ';
						$product_links .= '<a href="'.get_permalink($prod_id).'" target="_blank"> '.get_the_title($prod_id).'('.$inner_arr['quantity'].') </a>'.$comma;
						$total_price = $total_price + rac_calc_total_price($inner_arr);
						$item_counter ++;
					}

					echo '<tr>';
						echo '<td>'.$id.'</td>';
						echo '<td>'.$time.'</td>';
						echo '<td class="ns-rac-link">'.$rac_order.'</td>';
						echo '<td class="ns-rac-link">'.$product_links.'</td>';
						echo '<td class="'.$rac_td_bkg_color_status.'">'.$total_price.' '.get_woocommerce_currency_symbol().'</td>';
						echo '<td class="'.$status_class.'"><b>'.$status.'</b></td>';
						echo '<td><b>'.$user_mail.'</b></td>';
						echo '<td><b>'.$ip_address.'</b></td>';
					echo '</tr>';

				}
			?>
		</table>
		<?php
		}
		else{
			echo '<h2><b>No entries to show.</b></h2>';
		}
		?>
	</div>
	<div class="ns-rac-pagination">
		<?php
			echo paginate_links( array(
				'base' => add_query_arg( 'table-page', '%#%' ),
				'format' => '',
				'prev_text' => __('«'),
				'next_text' => __('»'),
				'total' => ceil($total / $items_per_page),
				'current' => $table_page
			));
		?>
	</div>
<?php
}
else{
?>
<div class="ns-rac-option-container" style='width: calc(100% - 50px);'>
	<h3>Woocommerce is not installed!</h3>
	<p>NS Recover Abandoned Cart plugin needs <b class="ns-rac-wc-warning">Woocommerce 3.0</b> or later versions to work!</p>

</div>
<?php
}
?>
	<!-- End table list section -->

</div>