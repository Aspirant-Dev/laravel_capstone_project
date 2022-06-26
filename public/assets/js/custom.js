$(document).ready(function() {

    loadcart();
    loadwishlist();

    // increment value
    $('.increment-btn').click(function(e) {
        e.preventDefault();

        var inc_value = $(this).parents('.product_data').find('.qty-input').val();
        var value = parseInt(inc_value, 10);
        if (value < 100) {
            value++;
            $(this).parents('.product_data').find('.qty-input').val(value);
        }
    });


    // decrement value
    $('.decrement-btn').click(function(e) {
        e.preventDefault();

        var dec_value = $(this).parents('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;

        if (value > 1) {
            value--;
            $(this).parents('.product_data').find('.qty-input').val(value);
        }
    });

    $('.oops').click(function(e) {
        e.preventDefault();

        var product_name = $(this).closest('.product_data').find('.name').val();
        swal(" ", {
            title: 'Oops',
            icon: 'info',
            text: product_name + ' is out of stock.',
            closeOnClickOutside: false,
        });

    });
    // add to cart
    $('.btnCart').click(function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var cate_id = $(this).closest('.product_data').find('.cate_id').val();
        var product_name = $(this).closest('.product_data').find('.prod_name').val();
        var quantity = $(this).closest('.product_data').find('.qty-input').val();
        var prod_stock = $(this).closest('.product_data').find('.prod_stock').val();

        $.ajax({
            url: "/add-to-cart",
            method: "POST",
            data: {
                'cate_id': cate_id,
                'product_id': product_id,
                'name': product_name,
                'quantity': quantity,
                'prod_stock': prod_stock,

            },
            success: function(response) {
                swal(" ", {
                    title: response.status,
                    icon: response.icon,
                    text: response.status1,
                    closeOnClickOutside: false,
                }).then(function() {
                    location.reload();
                    loadcart();
                });
            },
        });
    });
    // add to cart
    $('.btnWishlist').click(function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var cate_id = $(this).closest('.product_data').find('.cate_id').val();
        var product_name = $(this).closest('.product_data').find('.prod_name').val();
        var quantity = $(this).closest('.product_data').find('.qty-input').val();
        var prod_stock = $(this).closest('.product_data').find('.prod_stock').val();

        $.ajax({
            url: "/add-to-wishlist",
            method: "POST",
            data: {
                'cate_id': cate_id,
                'product_id': product_id,
                'name': product_name,
                'quantity': quantity,
                'prod_stock': prod_stock,

            },
            success: function(response) {
                swal(" ", {
                    title: response.status,
                    icon: response.icon,
                    text: response.status1,
                    closeOnClickOutside: false,
                });
                loadwishlist();
            },
        });
    });

    // auto hide alert
    // window.setTimeout(function() {
    //     $(".alert").fadeTo(500, 0).slideUp(500, function(){
    //         $(this).remove();
    //     });
    //     }, 4000);

    // load cart real time
    function loadcart() {
        $.ajax({
            method: "GET",
            url: "/load-cart-data",
            success: function(response) {
                $('.cart-count').html('');
                $('.cart-count').html(response.count);
            }
        });
    }

    function loadwishlist() {
        $.ajax({
            method: "GET",
            url: "/load-wishlist-data",
            success: function(response) {
                $('.wishlist-count').html('');
                $('.wishlist-count').html(response.wishcount);
            }
        });
    }

    // Deleting an item in the cart
    $('.delete-cart-item').click(function(e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.product_id').val();
        var product_name = $(this).closest('.product_data').find('.product_name').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        swal({
                title: "Are you sure?",
                text: "Once deleted, You can always add this again to your cart!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: "delete-cart-item",
                        method: "POST",
                        data: {
                            'prod_id': prod_id,
                            'name': product_name,
                        },
                        success: function(response) {
                            swal(" ", {
                                    title: response.status,
                                    icon: "success",
                                })
                                .then((willDelete) => {
                                    location.reload();
                                });
                        },
                    });
                }
            });
    });
    // Deleting an item in the cart
    $('.delete-wish-item').click(function(e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.product_id').val();
        var product_name = $(this).closest('.product_data').find('.product_name').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        swal({
                title: "Are you sure?",
                text: "Once deleted, You can always add this again to your wishlist!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: "delete-wish-item",
                        method: "POST",
                        data: {
                            'prod_id': prod_id,
                            'name': product_name,
                        },
                        success: function(response) {
                            swal(" ", {
                                    title: response.status,
                                    icon: "success",
                                })
                                .then((willDelete) => {
                                    location.reload();
                                });
                        },
                    });
                }
            });
    });
    // change item quantity
    $('.changeQuantity').click(function(e) {
        e.preventDefault();

        $thisClick = $(this);
        var prod_id = $(this).closest('.product_data').find('.product_id').val();
        var qty = $(this).closest('.product_data').find('.qty-input').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: "update-cart",
            method: "POST",
            data: {
                'prod_id': prod_id,
                'prod_qty': qty,
            },
            success: function(response) {
                window.location.reload();
                // $thisClick.closest('.product_data').find('.amount').text(' '+response.totalPrice);
                // $('.totalAmountLoad').load(location.href +'.TotalAmount');
                // alertify.set('notifier','position','top-right');
                // alertify.success(response.status);
            },
        });
    });

    // delete all items in the cart
    $('.delete-all').click(function(e) {
        e.preventDefault();

        var prod_id = $(this).closest('.product_data').find('.product_id').val();
        var product_name = $(this).closest('.product_data').find('.product_name').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        swal({
                title: "Are you sure?",
                text: "Once deleted, You can always add this again to your cart!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: "delete-all",
                        method: "POST",
                        data: {
                            'prod_id': prod_id,
                            'name': product_name,
                        },
                        success: function(response) {
                            swal(" ", {
                                    title: response.status,
                                    icon: "success",
                                })
                                .then((willDelete) => {
                                    location.reload();
                                });
                        },
                    });
                }
            });
    });

    // Deleting an item in the cart
    $('.delete-address').click(function(e) {
        e.preventDefault();

        var address_id = $(this).closest('.address_data').find('.address_id').val();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        swal({
                title: "Are you sure?",
                text: "Once deleted, you will not able to recover this address. But you can add again if you want.",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        url: "delete-address",
                        method: "POST",
                        data: {
                            'address_id': address_id,
                        },
                        success: function(response) {
                            swal(" ", {
                                    title: response.status,
                                    icon: "success",
                                })
                                .then((willDelete) => {
                                    location.reload();
                                });
                        },
                    });
                }
            });
    });

    // ===== Scroll to Top ====
    $(window).scroll(function() {
        if ($(this).scrollTop() >= 760) { // If page is scrolled more than 50px
            $('#return-to-top').fadeIn(500); // Fade in the arrow
        } else {
            $('#return-to-top').fadeOut(500); // Else fade out the arrow
        }
    });
    $('#return-to-top').click(function() { // When arrow is clicked
        $('body,html').animate({
            scrollTop: 0 // Scroll to top of body
        }, 500);
    });
});