@extends('layouts.inc.front')

@section('title')
    Checkout
@endsection

@section('content')
    <div class="py-3 mb-4 shadow-sm bg-warning border-top">
        <div class="container">
            <h6 class="mb-0 "><a class="text-black text-decoration-underline" href="{{ url('/') }}">Home</a>
                /<a class="text-black text-decoration-underline" href="{{ url('cart') }}"> Cart</a> / Checkout</h6>
        </div>
    </div>
    <div class="container mt-3">
        <form action="{{ url('place-order') }}" method="POST">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-md-7">
                    <div class="card">
                        <div class="card-body">
                            <h6>Basic Details</h6>
                            <hr>
                            <div class="row checkout-form">
                                <div class="col-md-6 mt-3">
                                    <label for="firstName">First Name</label>
                                    <input type="text" name="fname" required value= "@php Auth::check() ? Auth::user()->fname : '' @endphp"
                                        class="form-control firstname " required placeholder="Enter First name">
                                    <span class="text-danger" id="firstname_error"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="">Last Name</label>
                                    <input type="text" name="lname" required value="@php Auth::check() ? Auth::user()->lname : '' @endphp"
                                        class="form-control lastname" placeholder="Enter Last name">
                                    <span class="text-danger" id="lastname_error"></span>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label for="">Email</label>
                                    <input type="text" name="email" required value="@php Auth::check() ? Auth::user()->email : '' @endphp"
                                        class="form-control email" placeholder="Enter First name">
                                    <span class="text-danger" id="email_error"></span>
                                </div>
                                <div class="col-md-3 mt-3">
                                    <label for="f">Phone Number</label>
                                    <input type="text" name="phone" required value="@php Auth::check() ? Auth::user()->phone : '' @endphp"
                                        class="form-control phone" placeholder="Enter First name">
                                    <span class="text-danger" id="phone_error"></span>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <label for="firstName">Address</label>
                                    <input type="text" name="address" value="@php Auth::check() ? Auth::user()->address : '' @endphp"
                                        class="form-control address" placeholder="Enter First name">
                                    <span class="text-danger" id="address_error"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-body">
                            <h6>Order Details</h6>
                            <hr>
                            @if(Auth::check())
                            @if ($cartItems->count() > 0) 
                                <table class="table table-striped table-bodered">
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>

                                        @php $total = 0; @endphp
                                        @php $rand = rand(10,100) @endphp
                                        @foreach ($cartItems as $item)
                                            <tr>
                                                <td> {{ $item->product->name }}</td>
                                                <td> {{ $item->prod_qty }}</td>
                                                <td> {{ $item->prod_qty * $item->product->selling_price }}.{{ $rand }}k
                                                </td>
                                            </tr>
                                            @php $total +=  $item->prod_qty * $item->product->selling_price  @endphp
                                        @endforeach
                                    </tbody>
                                </table>


                                <h6 class="px-2">Total Price :
                                    <span class="float-end px-4"> ₦{{ $total }}.{{ $rand }}K
                                    </span>
                                </h6>
                                <hr>
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" class="btn btn-success w-100 ">Place order | COD</button>
                                <button type="button" class="btn btn-primary w-100 mt-2  razorpay_btn">Pay with
                                    Razorpay</button>
                                <div class="mt-2 " id="paypal-button-container"></div>
                            @else
                                <h4 class="text-center"> No products in cart</h4>
                            @endif

                            @elseif(session('cart'))
                            
                            @if (count(session('cart')) > 0) 
                                <table class="table table-striped table-bodered">
                                    <tbody>
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                            </tr>
                                        </thead>

                                        @php $total = 0; @endphp
                                        @php $rand = rand(10,100) @endphp
                                        @foreach (session('cart') as $item)
                                            <tr>
                                                <td> {{ $item['name'] }}</td>
                                                <td> {{ $item['prod_qty'] }}</td>
                                                <td> {{ $item['prod_qty'] * $item['selling_price'] }}.{{ $rand }}k
                                                </td>
                                            </tr>
                                            @php $total +=  $item['prod_qty']*$item['selling_price'] @endphp
                                        @endforeach
                                    </tbody>
                                </table>


                                <h6 class="px-2">Total Price :
                                    <span class="float-end px-4"> ₦{{ $total }}.{{ $rand }}K
                                    </span>
                                </h6>
                                <hr>
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" class="btn btn-success w-100 ">Place order | COD</button>
                                <button type="button" class="btn btn-primary w-100 mt-2  razorpay_btn">Pay with
                                    Razorpay</button>
                                <div class="mt-2 " id="paypal-button-container"></div>
                            @else
                                <h4 class="text-center"> No products in cart</h4>
                            @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </form>
    </div>
@endsection

@section('scripts')
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script
        src="https://www.paypal.com/sdk/js?client-id=ATHW-fUn1Uv1JOWPI9jk0iXWpc3-CiV7zBYQwaHKI8Ph2d98EHa358aY3atpklw8duZLozFDLdOmI8Kc">
    </script>

    <script>
        paypal.Buttons({
            // Sets up the transaction when a payment button is clicked
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total }}' // Can also reference a variable or function
                        }
                    }]
                });
            },
            // Finalize the transaction after payer approval
            onApprove: (data, actions) => {
                return actions.order.capture().then(function(orderData) {
                    // Successful capture! For dev/demo purposes:
                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    const transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
                    // When ready to go live, remove the alert and show a success message within this page. For example:
                    // const element = document.getElementById('paypal-button-container');
                    // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                    // Or go to another URL:  actions.redirect('thank_you.html');

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


                    $.ajax({
                        method: "POST",
                        url: "/place-order",
                        data: {
                            'fname': firstname,
                            'lname': lastname,
                            'email': email,
                            'phone': phone,
                            'address': address,
                            'payment_mode': "Paid by Paypal",
                            'payment_id': orderData.id

                        },

                        success: function(response) {

                            swal(response.status).then((value) => {
                                window.location.href = "/my-orders"
                            });


                        }
                    })
                });
            }
        }).render('#paypal-button-container');
    </script>
@endsection
