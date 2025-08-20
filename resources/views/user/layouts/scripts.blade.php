<!-- Back to Top Start -->
<div class="anim-scroll-to-top">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
    </svg>
</div>
<!-- Back to Top end -->
<!-- Integrated important scripts here -->
<script src="{{ URL::asset('assets/user/js/jquery-3.6.0.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/user/js/jquery.nice-select.min.js') }}"></script> --}}
<script src="{{ URL::asset('assets/user/js/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/user/js/jquery.appear.min.js') }}"></script>
<script src="{{ URL::asset('assets/user/js/wow.min.js') }}"></script>
<script src="{{ URL::asset('assets/user/js/owl.carousel.min.js') }}"></script>
<script src="{{ URL::asset('assets/user/js/jquery.event.move.js') }}"></script>
<script src="{{ URL::asset('assets/user/js/jquery.twentytwenty.js') }}"></script>
<script src="{{ URL::asset('assets/user/js/tilt.jquery.min.js') }}"></script>
<script src="{{ URL::asset('assets/user/js/magnific-popup.min.js') }}"></script>
<script src="{{ URL::asset('assets/user/js/backtotop.js') }}"></script>
<script src="{{ URL::asset('assets/user/js/trigger.js') }}"></script>

@yield('script')
    <script>
        window.setTimeout(function() {
            $(".alert.alert-info").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 3000);

       $(document).ready(function() {
            const homeCarousel = $('.home-carousel').owlCarousel({
                items: 1,
                loop: true,
                autoplay: false,
                nav: true,
                dots: true
            });

            let autoClickInterval;
            let isManualClick = false;

            function startAutoClick() {
                autoClickInterval = setInterval(function() {
                    if (!isManualClick) {
                        $('.home-carousel .owl-next').trigger('click');
                    }
                }, 7000);
            }

            startAutoClick();

            $('.home-carousel').on('click', '.owl-next, .owl-prev', function() {
                isManualClick = true;
                clearInterval(autoClickInterval);

                setTimeout(function() {
                    isManualClick = false;
                    startAutoClick();
                }, 10000);
            });

            $('#newsletter-submit').click(function(e) {
                e.preventDefault();
                var email = $('#newsletter-email').val();

                $.ajax({
                    url: "{{ route('newsletter.subscribe') }}",
                    type: 'POST',
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $('#newsletter-message').text(response.success);
                        $('#newsletter-email').val('');
                    },
                    error: function(response) {
                        $('#newsletter-message').text(response.responseJSON.error);
                    }
                });
            });
        });
    </script>
@yield('script-bottom')

