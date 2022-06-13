
$(document).ready(function () {

    $(".razorpay_btn").on("click", function (e) {
        e.preventDefault();

        var firstname = $('.firstname').val();
        var lastname = $('.lastname').val();
        var email = $('.email').val();
        var phone = $('.phone').val();
        var address = $('.address').val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (!firstname) {
            firstname_error = "First name is required";
            $('#firstname_error').html('');
            $('#firstname_error').html(firstname_error);
        } else {
            firstname_error = "";
            $('#firstname_error').html('')
        }


        if (!lastname) {
            lastname_error = "Last name is required";
            $('#lastname_error').html('');
            $('#lastname_error').html(lastname_error);
        } else {
            lastname_error = "";
            $('#lastname_error').html('')
        }


        if (!email) {
            email_error = "Email is required";
            $('#email_error').html('');
            $('#email_error').html(email_error);
        } else {
            email_error = "";
            $('#email_error').html('')
        }


        if (!phone) {
            phone_error = "Phone number is required";
            $('#phone_error').html('');
            $('#phone_error').html(phone_error);
        } else {
            phone_error = "";
            $('#phone_error').html('')
        }


        if (!address) {
            address_error = "Address is required";
            $('#address_error').html('');
            $('#address_error').html(address_error);
        } else {
            address_error = "";
            $('#address_error').html('')
        }


        if (firstname_error != "" || lastname_error != "" || email_error != "" || phone_error != "" || address_error != "") {

            return false
        } else {

            data = {
                'firstname': firstname,
                'lastname': lastname,
                'email': email,
                'phone': phone,
                'address': address
            }

            $.ajax({
                method: "POST",
                url: "/proceed-to-pay",
                data: data,
                success: function (response) {

                    var options = {
                        "key": "rzp_test_QVj4loe8VuXcwr", // Enter the Key ID generated from the Dashboard
                        "amount": response.total_price * 100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                        "currency": "INR",
                        "name": response.firstname + ' ' + response.lastname,
                        "description": "Thank you for your purchase",
                        "image": "https://example.com/your_logo",
                        // "order_id": "order_9A33XWu170gUtm", //This is a sample Order ID. Pass the `id` obtained in the response of Step 1
                        "handler": function (responserazor) {
                            //alert(responserazor.razorpay_payment_id);

                            $.ajax({
                                method: "POST",
                                url: "/place-order",
                                data: {
                                    'fname': response.firstname,
                                    'lname': response.lastname,
                                    'email': response.email,
                                    'phone': response.phone,
                                    'address': response.address,
                                    'payment_mode': "Paid by Razorpay",
                                    'payment_id': responserazor.razorpay_payment_id

                                },

                                success: function (responserazorb) {

                                    swal(responserazorb.status).then((value) => {
                                        window.location.href = "/my-orders";
                                    });


                                }
                            })
                        },
                        "prefill": {
                            "name": response.firstname + ' ' + response.lastname,
                            "email": response.email,
                            "contact": response.phone
                        },

                        "theme": {
                            "color": "#3399cc"
                        }
                    };
                    var rzp1 = new Razorpay(options);

                    rzp1.open();


                }

            })
        }

    });
});      