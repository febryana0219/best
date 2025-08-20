<footer class="footer bg-cover" data-background="https://via.placeholder.com/1920x1280" data-overlay-dark="98">
    <div class="footer-main-area">
        <div class="footer-section-obj1">
            <img src="{{ URL::asset('assets/user/images/objects/footer-obj1.png') }}" alt="" />
        </div>
        <div class="footer-section-obj2">
            <img src="{{ URL::asset('assets/user/images/objects/footer-obj2.png') }}" alt="" />
        </div>
        <div class="container">
            <div class="row pdb-30">
                <div class="col-xl-4 col-lg-6">
                    <div class="widget footer-widget mrr-60 mrr-md-0">
                        <h5 class="widget-title text-white mrb-30">Newsletter</h5>
                        <p class="mrb-30">Subscribe to newsletter to get updates!</p>
                        <div class="newsletter-from">
                            <div class="email">
                                <input type="email" name="email" id="newsletter-email" placeholder="Enter your email" required />
                            </div>
                            <div class="submit">
                                <button type="submit" id="newsletter-submit">
                                    <i class="base-icon-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        <p id="newsletter-message" style="color: #fff; margin-top: 10px;"></p>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-12">
                    <div class="widget footer-widget mrr-30 mrr-md-0">
                        <h5 class="widget-title text-white mrb-30">Contact</h5>
                        <address class="mrb-0">
                            <b>{{ $spContactAddress->name }}</b><br>
                            <?php
                                $addressContent = $spContactAddress->address;
                                $addressContent = str_replace('Phone-Icon', '<i class="fas fa-phone-alt mrr-10"></i>', $addressContent);
                                $addressContent = str_replace('Fax-Icon', '<i class="fas fa-envelope mrr-10"></i>', $addressContent);
                                $addressContent = str_replace('Email-Icon', '<i class="fas fa-fax mrr-10"></i>', $addressContent);
                            ?>

                            {!! $addressContent !!}
                        </address>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6">
                    <div class="widget footer-widget mrr-60 mrr-md-0">
                        <div class="footer-logo">
                            <img src="{{ URL::asset('assets/user/images/pt_best_logo.png') }}" alt="" class="mrb-25" />
                        </div>
                        <p class="mrb-25">{!! $spHomeMeta->value !!}</p>
                        <ul class="social-list">
                            @foreach ($spSocialLink as $sl)
                                <li>
                                    <a href="{{ $sl->link }}" target="_blank"><i class="{{ $sl->icon }}"></i></a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row pdt-30 pdb-30 footer-copyright-area">
                <div class="col-xl-12">
                    <div class="text-center">
                        <span>{!! $spCopyright->value !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
