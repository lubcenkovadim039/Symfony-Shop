jQuery(function ($) {
    $('.js-add-to-cart').click(function (event) {
        event.preventDefault();//Блокирует переход по сылке

        let $me = $(this);

        $me.attr('disabled','disabled');
        $('#header-cart').load(this.href, function () {
            $me.removeAttr('disabled')
        });
    });

    let removeToCartHref;
    let $cartTable = $('#cartTable');

    $cartTable.on('click','.js-remove-from-card', function(event) {
       event.preventDefault();

       removeToCartHref = this.href ;

   });

   $('#confirmedRemoveFromCartButton').click(function () {
       $catrTable.load(removeToCartHref);
       reloadHeaderCart();
   });
   //'change' ловит изменения в   input
   $cartTable.on('change', '.js-cart-item-quantity', function (event) {
       let $me = $(this);
       let url = $me.data('item-update-url').replace('--quantity--', $me.val());
       $cartTable.load(url);
       reloadHeaderCart();
   });

   function reloadHeaderCart()
   {
       let $cart = $('#header-cart');
       let url = $cart.data('href')

       $cart.load(url);

   }


});