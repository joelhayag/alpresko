<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="full">
                    <div class="logo_footer">
                        <a href="{{ url('/') }}"><img width="210" src="{{ asset('images/logo.png') }}"
                                alt="#" /></a>
                    </div>
                    <div class="information_f">
                        <p><strong>ADDRESS:</strong> 28 White tower, Makati City</p>
                        <p><strong>TELEPHONE:</strong> +63 912 345 6789</p>
                        <p><strong>EMAIL:</strong> contact@alpresko.com</p>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-7">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="widget_menu">
                                    <h3>Menu</h3>
                                    <ul>
                                        <li><a href="#">Home</a></li>
                                        <li><a href="#">About</a></li>
                                        <li><a href="#">Services</a></li>
                                        <li><a href="#">Testimonial</a></li>
                                        <li><a href="#">Blog</a></li>
                                        <li><a href="#">Contact</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="widget_menu">
                                    <h3>Account</h3>
                                    <ul>
                                        <li><a href="#">Account</a></li>
                                        <li><a href="#">Checkout</a></li>
                                        <li><a href="#">Login</a></li>
                                        <li><a href="#">Register</a></li>
                                        <li><a href="#">Shopping</a></li>
                                        <li><a href="#">Widget</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="widget_menu">
                            <h3>Newsletter</h3>
                            <div class="information_f">
                                <p>Subscribe to our newsletter and be notified for our latest update.</p>
                            </div>
                            <div class="form_sub">
                                <form action="https://app.getresponse.com/add_subscriber.html" accept-charset="utf-8"
                                    method="post">
                                    <fieldset>
                                        <div class="field">
                                            <!-- Get the token at: https://app.getresponse.com/campaign_list.html -->
                                            <input type="hidden" name="campaign_token" value="rG1Dv" />
                                            <!-- Add subscriber to the follow-up sequence with a specified day (optional) -->
                                            <input type="hidden" name="start_day" value="0" />
                                            <!-- Subscriber button -->
                                            <input type="email" placeholder="Enter Your Mail" name="email" />
                                            <input type="submit" value="Subscribe" />
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>



<div class="cpy_">
    <p class="mx-auto">Copyright ©
        <script>
            document.write(new Date().getFullYear());
        </script> All Rights Reserved<br>

        For KodeGo Capstone Project (B13-Group2)

    </p>
</div>
