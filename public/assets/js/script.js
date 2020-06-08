(function($) {
    "use strict";

    $(document).ready(function($) {
        
        
        $('.menu-toggle').on("click", function() {
            $('.site-nav').addClass('animate');
            $('.site-nav').toggleClass('mobile-menu-hide')
        });
    })

    
}
)(jQuery);
