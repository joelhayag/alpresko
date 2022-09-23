<section class="product_section layout_padding">
    <div class="container">
        <div id="featured" class="heading_container heading_center">
            <h2>
                Featured <span>Products</span>
            </h2>

            <br><br>

            <div>


                <form action="{{ url('product_search') }}" method="GET">

                    @csrf

                    <input class="search_box" type="text" name="search" placeholder="Search . . .">

                    <input type="submit" value="search">

                </form>

            </div>

        </div>

        <div class="row">
            <span style="padding-top: 20px;">

                {!! $product->withQueryString()->links('pagination::bootstrap-4') !!}

            </span>
        </div>


        <div class="row">

            @foreach ($product as $products)
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="box">
                        <div class="option_container">
                            <div class="options">
                                <a href="{{ url('product_details', $products->id) }}" class="option1">
                                    Product Details
                                </a>

                                <form action="{{ url('add_cart', $products->id) }}" method="Post">

                                    @csrf

                                    <div class="row">

                                        <div style="margin: auto; padding-left: 14px; padding-top: 20px;"
                                            class="quantity">

                                            <input type="number" name="quantity" value="1" min="1"
                                                max="{{ $products->quantity }}" step="1" autofocus="autofocus"
                                                style="width: 100px">



                                        </div>



                                        <div style="padding-left: 14px!important; margin: auto;">

                                            <input type="submit" value="Add To Cart">

                                        </div>



                                    </div>

                                </form>


                            </div>
                        </div>
                        <div class="img-box">
                            <img src="product/{{ $products->image }}" alt="">
                        </div>
                        <div class="detail-box">
                            <h5>
                                {{ $products->title }}
                            </h5>

                            @if ($products->discount_price != null)
                                <h6 style="color: red">
                                    Discounted
                                    <br>
                                    ₱{{ $products->discount_price }}
                                </h6>


                                <h6 style="text-decoration: line-through; color: #007BFF">
                                    Price
                                    <br>
                                    ₱{{ $products->price }}
                                </h6>
                            @else
                                <h6 style="color: #007BFF">
                                    Price
                                    <br>
                                    ₱{{ $products->price }}
                                </h6>
                            @endif



                        </div>
                        <h6>Available Quantity : {{ $products->quantity }}</h6>
                    </div>
                </div>
            @endforeach


        </div>

        <div class="row">
            <span style="padding-top: 50px;">

                {!! $product->withQueryString()->links('pagination::bootstrap-4') !!}

            </span>
        </div>
</section>
