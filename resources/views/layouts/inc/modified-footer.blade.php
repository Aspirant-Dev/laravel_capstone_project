
<footer class="site-footer border-top border-danger" style="border-width:4px !important; color: 4px solid #ee4d2d" >
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-md-3">
                <h6>About</h6>
                <p class="text-justify">realvalueenterprise.online is an online store where you can find your desire products in company. </p>
            </div>
            <div class="col-xs-6 col-md-3">
                <h6>Categories</h6>
                <ul class="footer-links">
                    @foreach ($categories as $item)
                        <li><a href="{{ url('view-category/'.$item->slug) }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-xs-6 col-md-3">
                <h6>Quick Links</h6>
                <ul class="footer-links">
                    <li><a href="#">About Us</a></li>
                    <li><a href="{{ url('contact-us') }}">Contact Us</a></li>
                    <li><a href="{{ url('/privacy-policy') }}" target="_blank">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-xs-6 col-md-3">
                <h6>Payment Methods</h6>
                <ul class="footer-links">
                    <li><span><i class="fab fa-paypal"></i></span></li>
                </ul>
            </div>
        </div>
    <hr>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-6 col-xs-12">
                <p class="copyright-text">Copyright &copy; 2021 All Rights Reserved by
                    <a href="#" style="text-decoration: none">Real Value Enterprise</a>.
                </p>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="social-icons">
                    <li><a  href="https://www.facebook.com/REAL-VALUE-Enterprises-100441979037579" target="_blank"><i class="fab fa-facebook mt-2" style="margin-top: 12px!important;"></i></a></li>
                    <li><a href="https://www.linkedin.com/in/renz-joseph-castelo-4522021b9" target="_blank"><i class="fab fa-linkedin mt-2" style="margin-top: 12px!important;"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
