<!DOCTYPE html>
<html>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <script>
        function checkPasswordMatch() {
            var password = $("#txtNewPassword").val();
            var confirmPassword = $("#txtConfirmPassword").val();
            if (password != confirmPassword)
                $("#CheckPasswordMatch").html("Passwords does not match!");
            else
                $("#CheckPasswordMatch").html("Passwords match.");
        }
        $(document).ready(function() {
            $("#txtConfirmPassword").keyup(checkPasswordMatch);
        });
    </script>


    @include('home.css')


    <style type="text/css">
        .center {
            margin-left: auto;
            margin-right: auto;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            border: 1px solid #ddd;
            text-align: center;
            padding: 30px;

        }

        th {
            background: #7FAD39 !important;
        }

        table,
        th,
        td {
            border: 1px solid grey;
        }

        .th_deg {
            font-size: 15px;
            padding: 5px;
            background: skyblue;
        }

        .img_deg {
            height: 200px;
            width: 200px;
        }

        .total_deg {
            font-size: 20px;
            padding: 40px;
        }
    </style>


</head>

<body>
    @include('sweetalert::alert')

    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <!-- end header section -->
        <!-- slider section -->

        <!-- end slider section -->

        <!-- why section -->



        {{-- {{ $cart_count }} --}}

        <div class="center" style="overflow-x:auto;">

            <table style="width:70%; margin-left: auto; margin-right: auto;">

                <tr>

                    <th class="th_deg">Product Name</th>
                    <th class="th_deg">Quantity</th>
                    <th class="th_deg">Price</th>
                    <th class="th_deg">Image</th>
                    <th class="th_deg">Action</th>

                </tr>

                <?php $totalprice = 0; ?>

                <?php $totalproduct = 0; ?>

                @foreach ((array) $cart as $key => $cart)
                    <tr>

                        <td>{{ $cart['product_title'] }}</td>
                        <td>{{ $cart['quantity'] }}</td>
                        <td>₱{{ $cart['price'] }}</td>
                        <td><img class="img_deg" src="{{ asset('/product/' . $cart['image']) }}"></td>
                        <td>

                            <a class="btn btn-danger" onclick="confirmation(event)"
                                href="{{ url('/remove_cart', $key) }}">Remove</a>


                        </td>


                    </tr>
                    <?php $totalproduct++; ?>

                    <?php $totalprice = $totalprice + $cart['price'] * $cart['quantity']; ?>
                @endforeach


            </table>

            <div>

                <h1 class="total_deg"><strong><u>Total Price : ₱{{ $totalprice }}</u></strong></h1>


            </div>


            <div>

                <div>
                    <h1 style="color: #7FAD39">
                        <strong>Please fill out the form below to process your order!</strong>
                    </h1>
                </div>
                <div style="padding: 10px; width: 75%; margin: auto">
                    <form action="{{ url('cash_order', $totalproduct) }}" method="POST">
                        @csrf
                        @if ($user->name == '')
                            <div style="text-align: left">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ $user->name }}" required />
                            </div>
                            <div style="text-align: left">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" required />
                            </div>
                            <div style="text-align: left">
                                <label>Phone Number</label>
                                <input type="number" name="phone" value="{{ $user->phone }}" required />
                            </div>
                            <div style="text-align: left">
                                <label>Address</label>
                                <input type="text" name="address" value="{{ $user->address }}" required />
                            </div>
                        @else
                            <div style="text-align: left">
                                <input type="hidden" name="name" value="{{ $user->name }}" required />
                            </div>
                            <div style="text-align: left">
                                <input type="hidden" name="email" value="{{ $user->email }}" required />
                            </div>
                            <div style="text-align: left">
                                <input type="hidden" name="phone" value="{{ $user->phone }}" required />
                            </div>
                            <div style="text-align: left">
                                <input type="hidden" name="address" value="{{ $user->address }}" required />
                            </div>
                        @endif

                        <div style="text-align: left; display: none" id="password">

                        </div>
                        <br />

                        @if ($user->name == '')
                            <div style="text-align: left display: flex">
                                <input type="checkbox" name="createAnAccount" id="create" onchange="Check(this)"
                                    style="width: 20px" />
                                <label for="create">Create an Account? Creating an account will let you view
                                    your order history</label>

                            </div>
                        @endif
                        <br />
                        <input type="submit" value='SUBMIT ORDER' />
                        <br /><br />
                    </form>
                </div>

            </div>


        </div>
        <br />
        <br />

        <br />

        <!-- footer start -->
        @include('home.footer')
        <!-- footer end -->

        <script>
            function confirmation(ev) {
                ev.preventDefault();
                var urlToRedirect = ev.currentTarget.getAttribute('href');
                console.log(urlToRedirect);
                swal({
                        title: "Are you sure to cancel this product",
                        text: "You will not be able to revert this!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willCancel) => {
                        if (willCancel) {



                            window.location.href = urlToRedirect;

                        }


                    });


            }
        </script>



        <!-- jQery -->
        <!-- jQery -->
        <script src="{{ asset('home/js/jquery-3.4.1.min.js') }}"></script>
        <!-- popper js -->
        <script src="{{ asset('home/js/popper.min.js') }}"></script>
        <!-- bootstrap js -->
        <script src="{{ asset('home/js/bootstrap.js') }}"></script>
        <!-- custom js -->
        <script src="{{ asset('home/js/custom.js') }}"></script>

        <script src="{{ asset('js/myfunction.js') }}"></script>

</body>

</html>
