      <section class="subscribe_section">
          <div class="container-fuild">
              <div class="box">
                  <div class="row">
                      <div class="col-md-6 offset-md-3">
                          <div class="subscribe_form ">
                              <div class="heading_container heading_center">
                                  <h3>Subscribe To Get Discounted Offers</h3>
                              </div>
                              <p>Join our email list and hear all the latest(arrival, deals, more). Plus, get up to 25%
                                  off reg. price when you purchase online.</p>
                              <form id="subscribe" action="https://app.getresponse.com/add_subscriber.html"
                                  accept-charset="utf-8" method="post">
                                  <!-- List token -->
                                  <!-- Get the token at: https://app.getresponse.com/campaign_list.html -->
                                  <input type="hidden" name="campaign_token" value="rG1Dv" />
                                  <!-- Thank you page (optional) -->
                                  <input type="hidden" name="thankyou_url" value="{{ url('/?q=success') }}" />
                                  <!-- Add subscriber to the follow-up sequence with a specified day (optional) -->
                                  <input type="hidden" name="start_day" value="0" />
                                  <!-- Subscriber button -->

                                  <input type="email" name="email" placeholder="Enter your email">
                                  <button>
                                      subscribe
                                  </button>
                              </form>


                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
