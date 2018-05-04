jQuery(function ($) {
    $('.js-add-to-cart').click(function (event) {
        event.preventDefault();//Блокирует переход по сылке

        var $me = $(this);

        $me.attr('disabled','disabled');
        $('#header-cart').load(this.href, function () {
            $me.removeAttr('disabled')
        });
    });

    /** $('#delete_item').on('click', function (event) {

        event.preventDefault();

        var $success = confirm('Подвердите удаление')

        if($success){
           submitComment();
            }


    })**/
});