<?php
    $barcode_height     = !empty(wpcargo_print_barcode_sizes()['waybill']['height'])? wpcargo_print_barcode_sizes()['waybill']['height'] : 80;
    $barcode_width      = !empty(wpcargo_print_barcode_sizes()['waybill']['height'])? wpcargo_print_barcode_sizes()['waybill']['width'] : 250;
    $copies = [
        'account-copy' => esc_html__('Accounts Copy', 'wpcargo' ),
        'consignee-copy' => esc_html__('Consignee Copy', 'wpcargo' ),
        'shippers-copy' => esc_html__('Shippers Copy', 'wpcargo' ),
    ];
    $copies = apply_filters( 'wpcargo_print_label_template_copies', $copies );
    if( empty( $copies ) ){
        return false;
    }
?>
<?php do_action('wpc_label_before_header_information', $shipmentDetails['shipmentID'] ); ?>
<?php foreach( $copies as $key => $label ): ?>
    <div id="<?php echo $key; ?>" class="copy-section">
        <table class="shipment-header-table" cellpadding="0" cellspacing="0" style="border: 1px solid #000;width: 100%;margin:0;padding:0;">
            <tr>
                <td rowspan="3" class="align-center">
                    <?php echo wp_kses( $shipmentDetails['logo'], 'post' ); ?>
                </td>
                <td rowspan="3" class="align-center">
                    <img id="admin-waybill-barcode" class="waybill-barcode" style="float: none !important; margin: 0 !important; width: <?php echo absint( $barcode_width ).'px'; ?>!important; height: <?php echo absint( $barcode_height ).'px'; ?>!important; " src="<?php echo esc_html( $shipmentDetails['barcode'] ); ?>" alt="<?php echo esc_html( get_the_title( $shipmentDetails['shipmentID'] ) ); ?>" />
                    <p style="margin:0;padding:0;font-weight: bold;"><?php echo esc_html( get_the_title( $shipmentDetails['shipmentID'] ) ); ?></p>
                    <?php do_action('wpc_label_header_barcode_information', $shipmentDetails['shipmentID'] ); ?>
                    <span class="copy-label"><?php echo esc_html( $label ); ?></span>
                </td>
                <td>
                    <span class="wpcargo-label"><?php esc_html_e('Pickup Date', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_pickup_date_picker', 'date' ) ); ?></span>
                </td>
                <td>
                    <span class="wpcargo-label"><?php esc_html_e('Pickup Time', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html(wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_pickup_time_picker' )); ?></span>
                </td>
                <td>
                    <span class="wpcargo-label"><?php esc_html_e('Delivery Date', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html(wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_expected_delivery_date_picker', 'date' )); ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="wpcargo-label"><?php esc_html_e('Origin', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html(wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_origin_field' )); ?></span>
                </td>
                <td>
                    <span class="wpcargo-label"><?php esc_html_e('Destination', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html(wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_destination' )); ?></span>
                </td>
                <td>
                    <span class="wpcargo-label"><?php esc_html_e('Courier', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html(wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_courier' )); ?></span>
                </td>
            </tr>
            <tr>
                <td>
                    <span class="wpcargo-label"><?php esc_html_e('Carrier', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html(wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_carrier_field' ) ); ?></span>
                </td>
                <td>
                    <span class="wpcargo-label"><?php esc_html_e('Carrier Reference No.', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_carrier_ref_number' ) ); ?></span>
                </td>
                <td>
                    <span class="wpcargo-label"><?php esc_html_e('Departure Time', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_departure_time_picker' ) ); ?></span>
                </td>
            </tr>
            <tr>
            </tr>
        </table>
        <table class="shipment-info-table" cellpadding="0" cellspacing="0" style="border: 1px solid #000;width: 100%;margin:0;padding:0;">
            <tr>
                <td><?php esc_html_e('Shipper', 'wpcargo'); ?></td>
                <td><span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_shipper_name' ) ); ?></span></td>
                <td><?php esc_html_e('Consignee', 'wpcargo'); ?></td>
                <td><span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_receiver_name' ) ); ?></span></td>
                <td colspan="2"><span class="wpcargo-label"><?php esc_html_e('Status', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_status' ) ); ?></span></td>
            </tr>
            <tr>
                <td colspan="2">
                    <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_shipper_address' ) ); ?></span></br>
                    <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_shipper_phone' ) ); ?></span></br>
                    <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_shipper_email' ) ); ?></span></br>
                </td>
                <td colspan="2">
                    <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_receiver_address' ) ); ?></span></br>
                    <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_receiver_phone' ) ); ?></span></br>
                    <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_receiver_email' ) ); ?></span></br>
                </td>
                <td colspan="2" rowspan="3" style="vertical-align: baseline;"><span class="wpcargo-label"><?php esc_html_e('Comment', 'wpcargo'); ?></span>:<br/><span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_comments' ) ); ?></span></td>
            </tr>
            <tr>
                <td><span class="wpcargo-label"><?php esc_html_e('Type of Shipment', 'wpcargo'); ?></span>:<br/><span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_type_of_shipment' ) ); ?></span></td>
                <td><span class="wpcargo-label"><?php esc_html_e('Packages', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_packages' ) ); ?></span></td>
                <td><span class="wpcargo-label"><?php esc_html_e('Product', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_product' ) ); ?></span></td>
                <td><span class="wpcargo-label"><?php esc_html_e('Weight', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_weight' ) ); ?></span></td>
            </tr>
            <tr>
                <td><span class="wpcargo-label"><?php esc_html_e('Total Freight', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_total_freight' ) ); ?></td>
                <td><span class="wpcargo-label"><?php esc_html_e('Quantity', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_qty' ) ); ?></span></td>
                <td><span class="wpcargo-label"><?php esc_html_e('Payment Mode', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'payment_wpcargo_mode_field' ) ); ?></span></td>
                <td><span class="wpcargo-label"><?php esc_html_e('Mode', 'wpcargo'); ?></span>: <span class="data"><?php echo esc_html( wpcargo_get_postmeta( $shipmentDetails['shipmentID'], 'wpcargo_mode_field' ) ); ?></span></td>
            </tr>
        </table>
    </div>
<?php endforeach; ?>
<?php do_action('wpc_label_footer_information', $shipmentDetails['shipmentID'] ); ?>
</div>