

$(document).ready(function () {

    loadcart()
    loadwishlist()

    /**plus button***/

    $(document).on("click", ".plus-btn", function (e) {
        e.preventDefault();
        // var inc_value = $(".qty-input").val();
        var inc_value = $(this).closest('.product_data').find(".qty-input").val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? '0' : value;

        if (value < 10) {
            value++;
            $(this).closest('.product_data').find(".qty-input").val(value);
        }

    });

    /**minus button***/
    $(document).on("click", ".minus-btn", function (e) {
        e.preventDefault();
        //var inc_value = $(".qty-input").val();
        var inc_value = $(this).closest('.product_data').find(".qty-input").val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? '0' : value;

        if (value > 1) {
            value--;
            $(this).closest('.product_data').find(".qty-input").val(value);
        }

    });

    $(".addToCartBtn").on("click", function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find(".prod_id").val();
        var product_qty = $(this).closest('.product_data').find(".qty-input").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                swal(response.status)
                loadcart()
            }

        })

    })


    $(".addToWishlistBtn").on("click", function (e) {
        e.preventDefault();

        var product_id = $(this).closest('.product_data').find(".prod_id").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/add-to-wishlist",
            data: {
                'product_id': product_id,

            },
            success: function (response) {
                swal(response.status)
                loadwishlist()
            }

        })

    });


    $(document).on("click", '.delete-cart-item', function (e) {

        var prod_id = $(this).closest('.product_data').find(".prod_id").val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "delete-cart-item",
            data: {
                'prod_id': prod_id,

            },
            success: function (response) {

                $('.cartitems').load(location.href + " .cartitems");
                loadcart()
                swal("", response.status, "success")
            }

        })

    });

    $(document).on("click", ".delete-wishlist-item", function (e) {

        var prod_id = $(this).closest('.product_data').find(".prod_id").val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "delete-wishlist-item",
            data: {
                'prod_id': prod_id,

            },
            success: function (response) {
                loadwishlist()
                $('.wishlistitems').load(location.href + " .wishlistitems");
                swal("", response.status, "success")
            }

        })

    });


    $(document).on("click", ".changeQuantity", function (e) {


        var prod_id = $(this).closest('.product_data').find(".prod_id").val();
        var qty = $(this).closest('.product_data').find(".qty-input").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "update-cart",
            data: {
                'prod_id': prod_id,
                'prod_qty': qty,

            },
            success: function (response) {
                $('.cartitems').load(location.href + " .cartitems");

            }

        })

    })

    function loadcart() {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",

            success: function (response) {


                $('.cart-count').html(response.count)

            }

        })
    }


    function loadwishlist() {
        $.ajax({
            method: "GET",
            url: "/load-wishlist-data",

            success: function (response) {


                $('.wishlist-count').html(response.count)

            }

        })
    }

    $(document).on("click", ".addIndex", function (e) {

        var product_id = $(this).attr("id");
        var product_qty = 1
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/add-to-cart",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                swal(response.status)
                loadcart()
            }

        })

    })

    $(document).on("click", ".add_session", function (e) {


        var product_id = $(this).closest('.product_data').find(".prod_id").val();
        var product_qty = 1
       
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "/add-to-session",
            data: {
                'product_id': product_id,
                'product_qty': product_qty,
            },
            success: function (response) {
                
                swal(response.status)
                $('.cart_count').html(response.cart_count)
            }

        })

    })

    $(document).on("click", '.delete-session-item', function (e) {

        var product_id = $(this).closest('.product_data').find(".prod_id").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: "delete-session-item",
            data: {
                'product_id': product_id,

            },
            success: function (response) {
                loadcart()
                $('.cart_count').text(response.cart_count);
                $('.delete'+ product_id ).remove();
               
                swal("", response.status, "success")
            }

        })

     });

});