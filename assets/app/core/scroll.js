$(document).ready(() => {

    // 1. Simple mode, it styles document scrollbar:
    $(() => $("body").niceScroll());

    // 2. Instance with object returned:
    var nice = false;
    $(() => nice = $("body").niceScroll());

    // 3. Style a DIV and change cursor color:
    $(function() {
        $("#thisdiv").niceScroll({cursorcolor:"#00F"});
    });

    // 4. DIV with "wrapper", formed by two divs, the first is the vieport, the latter is the content:
    $(function() {
        $("#viewportdiv").niceScroll("#wrapperdiv",{cursorcolor:"#00F"});
    });

    // 5. Get nicescroll object:
    var nice = $("#mydiv").getNiceScroll();

    // 6. Hide scrollbars:
    $("#mydiv").getNiceScroll().hide();

    // 7. Check for scrollbars resize (when content or position have changed):
    $("#mydiv").getNiceScroll().resize();
});
