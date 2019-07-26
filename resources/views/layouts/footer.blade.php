<div class="copyrights">
    <p>© 2018 All Rights Reserved | <a href="//www.alaskan.ro/" target="_blank">Alaskan Global Network SRL</a></p>
</div>
<!--COPY rights end here-->
</div>
</div>
</div>
<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
<script>window.modernizr || document.write('<script src="/js/modernizr.min.js"><\/script>')</script>
<script src="{{ asset('js/jquery.nicescroll.js') }}"></script>
<script src="{{ asset('js/scripts.js') }}"></script>
@yield('scripts')
<script type="text/javascript">
    var menu_setting = sessionStorage.getItem('collapsed');
    if (menu_setting) {
        $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
    }
    var navoffeset = $(".header-main").offset().top;
    $(window).scroll(function () {
        var scrollpos = $(window).scrollTop();
        if (scrollpos >= navoffeset) {
            $(".header-main").addClass("fixed");
        } else {
            $(".header-main").removeClass("fixed");
        }
    });

    var toggle = true;

    $(".sidebar-icon").click(function () {
        if (toggle && !menu_setting) {
            $(".page-container").addClass("sidebar-collapsed").removeClass("sidebar-collapsed-back");
            $("#menu span").css({"position": "absolute"});
            sessionStorage.setItem('collapsed', 'yes');

        } else {
            $(".page-container").removeClass("sidebar-collapsed").addClass("sidebar-collapsed-back");
            sessionStorage.setItem('collapsed', '');
            setTimeout(function () {
                $("#menu span").css({"position": "relative"});
            }, 200);
        }
        toggle = !toggle;
    });
</script>
@yield('js_scripts')