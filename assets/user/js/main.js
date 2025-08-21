/*============================================================
 # Template Name: Interix - Interior & Architecture HTML Template
 # Template URI: https://webextheme.com/html/interior-html/
 # Description: Interior & Architecture HTML Template
 # Author: WebexTheme
 # Author URI: https://themeforest.net/user/webextheme
 # Version: 1.0
/*============================================================

/*========================================
---------- [JS_INDEXING_START] -----------
==========================================
## [_Prealoder_Default]
## [_Header_Height]
## [_Sticky_Header]
## [_Side_Panel_Start]
## [_Mobile_Menu_Start]
## [_Progress_Bar]
## [_Toggle_Search_Box]
## [_Back_To_Top]
## [_Accordion]
## [_js_tilt]
## [_Owl_Carousel]
	## [_home_banner_01]
	## [_home_banner_02]
	## [Owl_Items_1col]
	## [Owl_Items_2col]
	## [Owl_Items_3col]
	## [Owl_Items_4col]
	## [Owl_Items_5col]
	## [_Testimonial_Carousel]
	## [_testimonial_items_1col]
	## [_Testimonial_Items_3col]
	## [_Team_Items_3col]
	## [_Team_Items_4col]
	## [_Team_Items_5col]
	## [_Client_Items]
## [_Language_Button]
## [_Inline_Data_Attribute]
## [_MagnificPopUp]
## [_Portfolio_Filter]
## [_CounterUp]
## [_Wow]
## [_kursor]
==========================================
--------- [JS_INDEXING_END] --------------
==========================================
*/

(function($) {
	"use strict";

	var wind = $(window);
	var jQwind = jQuery(window);
	var jQdoc = jQuery(document);

	$(window).on('load', function() {
		/*=============================================*/
		/*---------- [_Prealoder_Default] -------------*/
		/*=============================================*/
		// $('#ctn-preloader').delay(500).fadeOut(800);

		$('#ctn-preloader').addClass('loaded');
		if ($('#ctn-preloader').hasClass('loaded')) {
      // Es para que una vez que se haya ido el preloader se elimine toda la seccion preloader
      $('#ctn-preloader').delay(200).fadeOut(500).queue(function() {
      	$(this).remove();
      });
    }

  });

	/*=============================================*/
	/*-------------- [_Sticky_Header] -------------*/
	/*=============================================*/
	wind.on('scroll', function() {
		var sticky_header_style_one = $('.header-style-one .header-navigation-area');
		var sticky_header_style_two = $('.header-style-two .header-navigation-area');
		var sticky_three_layers = $('.header-navigation-area.three-layers-header');
		var scroll = wind.scrollTop();
		if (scroll < 60) {
			sticky_header_style_one.removeClass('fixed');
		} else {
			sticky_header_style_one.addClass('fixed');
		}
		if (scroll < 5) {
			sticky_header_style_two.removeClass('fixed');
		} else {
			sticky_header_style_two.addClass('fixed');
		}
	});

	/*=============================================*/
	/*------------- [_Header_Height] --------------*/
	/*=============================================*/
	// var headerHeight = $('.header-style-one').height();
	// $('.header-style-one').css('height', headerHeight);
	// var headerHeight = $('.header-style-two').height();
	// $('.header-style-two').css('height', headerHeight);


	jQuery(document).on('ready', function() {
		/*=============================================*/
		/*----------- [_Side_Panel_Start] -------------*/
		/*=============================================*/
		$('.side-panel-trigger').on('click', function() {
			$('.side-panel-content').addClass('side-panel-open');
		})

		$('.close-icon').on('click', function() {
			$('.side-panel-content').removeClass('side-panel-open');
		})
		/*=============================================*/
		/*---------- [_Mobile_Menu_Start] -------------*/
		/*=============================================*/
		var $mobile_menu = $('#mobile-menu');
		var $mobile_menu_right = $('#mobile-menu-right');
		$mobile_menu.meanmenu({
			meanMenuContainer: '.mobile-menu',
			meanScreenWidth: "991",
			meanRevealPosition: "left",
		});
		$mobile_menu_right.meanmenu({
			meanMenuContainer: '.mobile-menu-right',
			meanScreenWidth: "991",
			meanRevealPosition: "right",
		});

		/*=============================================*/
		/*------------- [_Progress_Bar] ---------------*/
		/*=============================================*/
		if ($('.progress-line').length) {
			$('.progress-line').appear(function() {
				var el = $(this);
				var percent = el.data('width');
				$(el).css('width', percent + '%');
			}, {
				accY: 0
			});
		}
		if ($('.count-box').length) {
			$('.count-box').appear(function() {
				var $t = $(this),
				n = $t.find(".count-text").attr("data-stop"),
				r = parseInt($t.find(".count-text").attr("data-speed"), 10);
				if (!$t.hasClass("counted")) {
					$t.addClass("counted");
					$({
						countNum: $t.find(".count-text").text()
					}).animate({
						countNum: n
					}, {
						duration: r,
						easing: "linear",
						step: function() {
							$t.find(".count-text").text(Math.floor(this.countNum));
						},
						complete: function() {
							$t.find(".count-text").text(this.countNum);
						}
					});
				}
			}, {
				accY: 0
			});
		}
		/*=============================================*/
		/*----------- [_Toggle_Search_Box] ------------*/
		/*=============================================*/
		var $showsearchbox = $(".show-searchbox");
		var $togglesearchbox = $(".toggle-searchbox");
		$(document).on('click', function(e) {
			var clickID = e.target.id;
			if ((clickID !== 's')) {
				$togglesearchbox.removeClass('show');
			}
		});
		$showsearchbox.on('click', function(e) {
			event.stopPropagation();
		});
		$('.search-form').on('click', function(e) {
			event.stopPropagation();
		});
		$showsearchbox.on('click', function(e) {
			if (!$togglesearchbox.hasClass("show")) {
				$togglesearchbox.addClass('show');
				event.preventDefault();
			} else
			$togglesearchbox.removeClass('show');
			event.preventDefault();

			if (!$showsearchbox.hasClass("active"))
				$showsearchbox.addClass('active');
			else
				$showsearchbox.removeClass('active');
		});

		/*=============================================*/
		/*--------------- [_Accordion] ----------------*/
		/*=============================================*/
		$('.accordion-header').on('click', function(e) {
			var element = $(this).parent('.accordion-item');
			if (element.hasClass('active')) {
				element.removeClass('active');
				element.find('.accordion-body').removeClass('active');
				element.find('.accordion-body').slideUp(300, "swing");
			} else {
				element.addClass('active');
				element.children('.accordion-body').slideDown(300, "swing");
				element.siblings('.accordion-item').children('.accordion-body').slideUp(300, "swing");
				element.siblings('.accordion-item').removeClass('active');
				element.siblings('.accordion-item').find('.accordion-header').removeClass('active');
				element.siblings('.accordion-item').find('.accordion-body').slideUp(300, "swing");
			}
		});

		/*=============================================*/
		/*---------------- [_js_tilt] -----------------*/
		/*=============================================*/
		function onHoverthreeDmovement() {
			var tiltBlock = $('.js-tilt');
			if(tiltBlock.length) {
				$('.js-tilt').tilt({
					maxTilt: 12,
					perspective:800,
					glare: true,
					maxGlare: 0
				})
			}
		}
		onHoverthreeDmovement();

		/*=============================================*/
		/*------------- [_Owl_Carousel] ---------------*/
		/*=============================================*/

		/*------------- [_home_banner_01] --------------*/
		function home_banner_01() {
			var owl = $(".home_banner_01 .home-carousel");
			owl.owlCarousel({
				loop:true,
				margin:0,
				nav:true,
				dots: false,
				animateOut: 'fadeOut',
				animateIn: 'fadeIn',
				active: true,
				autoplay: false,
				smartSpeed: 1000,
				autoplayTimeout: 6000,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 1
					},
					1024: {
						items: 1
					},
					1440: {
						items: 1
					}
				}
			});
		}
		home_banner_01();

		/*------------- [_home_banner_02] --------------*/
		function home_banner_02() {
			var owl = $(".home_banner_02 .home-carousel");
			owl.owlCarousel({
				loop:true,
				margin:0,
				nav:true,
				dots: false,
				animateOut: 'fadeOut',
				animateIn: 'fadeIn',
				active: true,
				autoplay: true,
				smartSpeed: 1000,
				autoplayTimeout: 8000,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 1
					},
					1024: {
						items: 1
					},
					1440: {
						items: 1
					}
				}
			});
		}
		home_banner_02();

		/*------------- [Owl_Items_1col] ------*/
		function owl_items_1col() {
			var owl = $(".owl-items-1col");
			owl.owlCarousel({
				loop: true,
				margin: 30,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 1
					},
					1024: {
						items: 1
					},
					1440: {
						items: 1
					}
				}
			});
		}
		owl_items_1col();

		/*------------- [Owl_Items_2col] ------*/
		function owl_items_2col() {
			var owl = $(".owl-items-2col");
			owl.owlCarousel({
				loop: true,
				margin: 30,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 1
					},
					1024: {
						items: 2
					},
					1440: {
						items: 2
					}
				}
			});
		}
		owl_items_2col();

		/*------------- [Owl_Items_3col] ------*/
		function owl_items_3col() {
			var owl = $(".owl-items-3col");
			owl.owlCarousel({
				loop: true,
				margin: 10,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 2
					},
					1024: {
						items: 3
					},
					1440: {
						items: 3
					}
				}
			});
		}
		owl_items_3col();

		/*------------- [Owl_Items_4col] ------*/
		function owl_items_4col() {
			var owl = $(".owl-items-4col");
			owl.owlCarousel({
				loop: true,
				margin: 30,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 2
					},
					1024: {
						items: 3
					},
					1440: {
						items: 4
					}
				}
			});
		}
		owl_items_4col();

		/*------------- [Owl_Items_5col] ------*/
		function owl_items_5col() {
			var owl = $(".owl-items-5col");
			owl.owlCarousel({
				loop: true,
				margin: 5,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 2
					},
					1024: {
						items: 3
					},
					1440: {
						items: 5
					}
				}
			});
		}
		owl_items_5col();

		/*------------- [_Testimonial_Carousel] ------*/
		function testimonial_carousel() {
			var owl = $(".testimonial-items");
			owl.owlCarousel({
				loop: true,
				margin: 30,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					767: {
						items: 1
					},
					1000: {
						items: 2
					}
				}
			});
		}
		testimonial_carousel();

		/*------------- [_testimonial_items_1col] ------*/
		function testimonial_items_1col() {
			var owl = $(".testimonial-items-1col");
			owl.owlCarousel({
				loop: true,
				margin: 0,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: true,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 1
					},
					1024: {
						items: 2
					},
					1440: {
						items: 1
					}
				}
			});
		}
		testimonial_items_1col();

		/*------------- [_Testimonial_Items_3col] ------*/
		function testimonial_items_3col() {
			var owl = $(".testimonial-items-3col");
			owl.owlCarousel({
				loop: true,
				margin: 30,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					767: {
						items: 2
					},
					1000: {
						items: 3
					}
				}
			});
		}
		testimonial_items_3col();

		/*------------- [_Team_Items_3col] ------*/
		function team_items_3col() {
			var owl = $(".team-items-3col");
			owl.owlCarousel({
				loop: true,
				margin: 30,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 2
					},
					1024: {
						items: 3
					},
					1440: {
						items: 3
					}
				}
			});
		}
		team_items_3col();

		/*------------- [_Team_Items_4col] ------*/
		function team_items_4col() {
			var owl = $(".team-items-4col");
			owl.owlCarousel({
				loop: true,
				margin: 30,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 1
					},
					768: {
						items: 3
					},
					1024: {
						items: 4
					},
					1440: {
						items: 4
					}
				}
			});
		}
		team_items_4col();

		/*------------- [_Team_Items_5col] ------*/
		function team_items_5col() {
			var owl = $(".team-items-5col");
			owl.owlCarousel({
				loop: true,
				margin: 30,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: true,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 2
					},
					768: {
						items: 3
					},
					1024: {
						items: 4
					},
					1440: {
						items: 5
					}
				}
			});
		}
		team_items_5col();

		/*------------- [_Client_Items] ------*/
		function client_items() {
			var owl = $(".client-items");
			owl.owlCarousel({
				loop: true,
				margin: 30,
				autoplay: true,
				autoplayTimeout: 8000,
				nav: false,
				dots: false,
				navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
				responsive: {
					0: {
						items: 1
					},
					425: {
						items: 2
					},
					768: {
						items: 3
					},
					1024: {
						items: 4
					},
					1440: {
						items: 5
					}
				}
			});
		}
		client_items();

		// ===Pricing Switcher===
		$('#checboxv').click(function() {
			var checkBox = document.getElementById("checboxv");
			var monthlyPrice = document.getElementsByClassName("monthlyPrice");
			var yearlyPrice = document.getElementsByClassName("yearlyPrice");

			for (var i = 0; i < monthlyPrice.length; i++) {
				if (checkBox.checked == true) {
					monthlyPrice[i].style.display = "block";
					yearlyPrice[i].style.display = "none";
				} else if (checkBox.checked == false) {
					monthlyPrice[i].style.display = "none";
					yearlyPrice[i].style.display = "block";
				}
			}
		});

		/*=============================================*/
		/*------------ [_Language_Button] -------------*/
		/*=============================================*/
		$('.language-btn').on('click', function(event) {
			event.preventDefault();
			$(this).next('.language-dropdown').toggleClass('open');
		});

		/*=============================================*/
		/*---------- [_Inline_Data_Attribute] ---------*/
		/*=============================================*/
		var sectionBgImg = $(".bg-img, .footer, section, div");
		sectionBgImg.each(function(indx) {
			if ($(this).attr("data-background")) {
				$(this).css("background-image", "url(" + $(this).data("background") + ")");
			}
		});

		/*=============================================*/
		/*--------------- [_MagnificPopUp] ------------*/
		/*=============================================*/
		$('.popup-load').magnificPopup({
			type: 'iframe',
			gallery: {
				enabled: true
			}
		});
		$('.img-popup').magnificPopup({
			type: 'image',
			gallery: {
				enabled: true
			}
		});
		$('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
			type: 'iframe',
			mainClass: 'mfp-fade',
			removalDelay: 160,
			preloader: false,
			fixedContentPos: false
		});

		/*=============================================*/
		/*------------ [_Portfolio_Filter] ------------*/
		/*=============================================*/
		$("#container").imagesLoaded(function() {
			$(".project-filter").on("click", "li", function() {
				$('li').removeClass("active");
				$(this).addClass("active");
				var filterValue = $(this).attr("data-filter");
				$grid.isotope({
					filter: filterValue
				});
			});
			var $grid = $(".grid").isotope({
				itemSelector: ".grid-item",
				percentPosition: true,
				transitionDuration: ".6s"
			})
		});

		/*=============================================*/
		/*--------------- [_CounterUp] ----------------*/
		/*=============================================*/
		$('.counter').counterUp({
			delay: 10,
			time: 1000
		});

		/*=============================================*/
		/*------------------ [_Wow] -------------------*/
		/*=============================================*/
		if ($('.wow').length) {
			var wow = new WOW({
				boxClass: 'wow',
				animateClass: 'animated',
				offset: 0,
				mobile: false,
				live: true
			});
			wow.init();
		}

		var TxtType = function(el, toRotate, period) {
			this.toRotate = toRotate;
			this.el = el;
			this.loopNum = 0;
			this.period = parseInt(period, 10) || 2000;
			this.txt = '';
			this.tick();
			this.isDeleting = !1
		};
		TxtType.prototype.tick = function() {
			var i = this.loopNum % this.toRotate.length;
			var fullTxt = this.toRotate[i];
			if (this.isDeleting) {
				this.txt = fullTxt.substring(0, this.txt.length - 1)
			} else {
				this.txt = fullTxt.substring(0, this.txt.length + 1)
			}
			this.el.innerHTML = '<span class="wrap">' + this.txt + '</span>';
			var that = this;
			var delta = 200 - Math.random() * 100;
			if (this.isDeleting) {
				delta /= 2
			}
			if (!this.isDeleting && this.txt === fullTxt) {
				delta = this.period;
				this.isDeleting = !0
			} else if (this.isDeleting && this.txt === '') {
				this.isDeleting = !1;
				this.loopNum++;
				delta = 500
			}
			setTimeout(function() {
				that.tick()
			}, delta)
		};
		window.onload = function() {
			var elements = document.getElementsByClassName('typewrite');
			for (var i = 0; i < elements.length; i++) {
				var toRotate = elements[i].getAttribute('data-type');
				var period = elements[i].getAttribute('data-period');
				if (toRotate) {
					new TxtType(elements[i], JSON.parse(toRotate), period)
				}
			}
			var css = document.createElement("style");
			css.type = "text/css";
			css.innerHTML = ".typewrite > .wrap { border-right: 0.08em solid #fff}";
			document.body.appendChild(css)
		}

	});

/*=============================================*/
/*--------------- [_kursor] -------------------*/
/*=============================================*/
new kursor({
	type: 1,
	color: 'rgba(200,145,54)'
})

}(jQuery));