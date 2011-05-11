<?php


function gc_donate( $options=array() ){
    
    static $instances = 0;
    ob_start();
    extract( $options );
    if( @$id && !@$business_id ) $business_id = $id;
    if( !@$business_id || !@$name )    return;
    if( !@$currency )       $currency = 'USD';
    if( !@$min )            $min = '0.01';
    if( !@$max )            $max = '25000.00';
    if( !@$description )    $description = '';
    if( !@$align )          $align = 'center';
    $table_style = $align=='center' ? "margin: 0 auto;" : ("margin-".($align=='left'?'right':'left').": auto;");
    ?>
<form action="https://checkout.google.com/cws/v2/Donations/<?= $business_id ?>/checkoutForm" id="BB_BuyButtonForm" method="post" name="BB_BuyButtonForm" onsubmit="return validateAmount(this.item_price_1)" target="_top">
    <input name="item_name_1" type="hidden" value="<?= esc_attr( $name ) ?>">
    <input name="item_description_1" type="hidden" value="<?= esc_attr( $description ) ?>">
    <input name="item_quantity_1" type="hidden" value="1">
    <input name="item_currency_1" type="hidden" value="<?= esc_attr( $currency ) ?>">
    <input name="item_is_modifiable_1" type="hidden" value="true">
    <input name="item_min_price_1" type="hidden" value="<?= esc_attr( $min ) ?>">
    <input name="item_max_price_1" type="hidden" value="<?= esc_attr( $max ) ?>">
    <input name="_charset_" type="hidden" value="utf-8">
    <table cellpadding="5" cellspacing="0" style="<?= $table_style ?>">
        <tbody>
            <tr valign="middle">
                <td>
                    $ <input name="item_price_1" onfocus="this.style.color='black'; this.value='';" size="11" style="color: #999; " type="text" value="Enter Amount" class="" />
                </td>
            </tr>
            <tr>
                <td>
                    <input alt="Donate" src="https://checkout.google.com/buttons/donateNow.gif?merchant_id=<?= $business_id ?>&amp;w=115&amp;h=50&amp;style=white&amp;variant=text&amp;loc=en_US" type="image">
                </td>
            </tr>
        </tbody>
    </table>
</form>
    <?php
    if( $instances++ === 0 ){
        ?>
<script type="text/javascript">
function validateAmount(amount){
       if(amount.value.match( /^[0-9]+(\.([0-9]+))?$/)){
               return true;
       }else{
               alert('You must enter a valid donation.');
               amount.focus();
               return false;
       }
}
</script>
        <?php
    }
    if( @$echo ){
        echo ob_get_clean();
        return true;
    }
    return ob_get_clean();
}