Dropzone.autoDiscover = false;

(function( $ ) {
 
    $.fn.progress = function( action ) {
 
        if ( action === "open") {
           $(this).loading('start');
        }
 
        if ( action === "close" ) {
            $(this).loading('stop');
        }
 
    };

    $(".page-sidebar-menu li a").click(function(e){
        e.preventDefault();
        if($(this).closest("li").find("ul.sub-menu").length > 0){
            if($(this).closest("li").hasClass("active") || $(this).closest("li").hasClass("open")){
                $(this).closest("li").removeClass("active").removeClass("open");
                $(this).closest("li").find(".arrow").removeClass("open");
                $(this).closest("li").find("ul.sub-menu").removeClass("show").addClass("hide");
                
            }
            else{
                $(this).closest("li").addClass("active").addClass("open");
                $(this).closest("li").find(".arrow").addClass("open");
                $(this).closest("li").find("ul.sub-menu").removeClass("hide").addClass("show");
            }
        }
        else{
            location.href = $(this).attr("href") 
        }
    })

    $('.input-daterange input').datepicker({
        autoclose: true
     });

}( jQuery ));



