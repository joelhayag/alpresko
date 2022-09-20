<!DOCTYPE html>
<html>

<head>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

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



{{ $cart_count }}

        <div class="center" style="overflow-x:auto;">

            <table style=" margin-left: auto;
  margin-right: auto;">

                <tr>

                    <th class="th_deg">Product title</th>
                    <th class="th_deg">product quantity</th>
                    <th class="th_deg">price</th>
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
                                    href="{{ url('/remove_cart', $key) }}">Remove Product</a>


                            </td>


                        </tr>
                        <?php $totalproduct++; ?>

                        <?php $totalprice = $totalprice + $cart['price']; ?>
                 @endforeach


            </table>

            <div>

                <h1 class="total_deg">Total Price : ₱{{ $totalprice }}</h1>


            </div>


            <div>

                <h1 style="font-size: 25px; padding-bottom: 15px;">Proceed to Checkout</h1>
                <div style="padding: 10px; width: 75%; margin: auto">
                    <form action="{{url('cash_order',$totalproduct)}}" method="POST">
                        @csrf
                        <div style="text-align: left">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $user->name }}" required/>
                        </div>
                        <div style="text-align: left">
                            <label>Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" required/>
                        </div>
                        <div style="text-align: left">
                            <label>Phone Number</label>
                            <input type="number" name="phone" value="{{ $user->phone }}" required/>
                        </div>
                        <div style="text-align: left">
                            <label>Address</label>
                            <input type="text" name="address" value="{{ $user->address }}" required/>
                        </div>
                        <div style="text-align: left; display: none" id="password">

                        </div>
                        @if($user->name == '')
                        <div style="text-align: left display: flex">
                            <input type="checkbox" name="createAnAccount" id="create" onchange="Check(this)" style="width: 20px"/>
                            <label for="create">Create an Account?</label>
                        </div>
                        @endif
                        <input type="submit" value='Cash On Delivery' />
                    </form>
                </div>

            </div>







        </div>



        <!-- footer start -->

        <!-- footer end -->

        <div style="padding-top: 215px;">
            <div class="cpy_">
                <p class="mx-auto">Copyright ©
                    <script>
                        document.write(new Date().getFullYear());
                    </script> All Rights Reserved<br>

                    For KodeGo Capstone Project (B13-Group2)

                </p>
            </div>

        </div>



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
