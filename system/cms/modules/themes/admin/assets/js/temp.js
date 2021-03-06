$(document).ready(function() {
    $(function() {
            $(".preloader").fadeOut()
        }), $(function() {
            $(window).bind("load resize", function() {
                topOffset = 60, height = (this.window.innerHeight > 0 ? this.window.innerHeight : this.screen.height) - 1, height -= topOffset, height < 1 && (height = 1), height > topOffset && $("#page-wrapper").css("min-height", height + "px")
            })
        }),
        function(e, i, n) {
            var t = '[data-perform="panel-collapse"]';
            e(t).each(function() {
                var i = e(this),
                    n = i.closest(".panel"),
                    t = n.find(".panel-wrapper"),
                    s = {
                        toggle: !1
                    };
                t.length || (t = n.children(".panel-heading").nextAll().wrapAll("<div/>").parent().addClass("panel-wrapper"), s = {}), t.collapse(s).on("hide.bs.collapse", function() {
                    i.children("i").removeClass("ti-minus").addClass("ti-plus")
                }).on("show.bs.collapse", function() {
                    i.children("i").removeClass("ti-plus").addClass("ti-minus")
                })
            }), e(n).on("click", t, function(i) {
                i.preventDefault();
                var n = e(this).closest(".panel"),
                    t = n.find(".panel-wrapper");
                t.collapse("toggle")
            })
        }(jQuery, window, document),
        function(e, i, n) {
            var t = '[data-perform="panel-dismiss"]';
            e(n).on("click", t, function(i) {
                function n() {
                    var i = t.parent();
                    t.remove(), i.filter(function() {
                        var i = e(this);
                        return i.is('[class*="col-"]') && 0 === i.children("*").length
                    }).remove()
                }
                i.preventDefault();
                var t = e(this).closest(".panel");
                n()
            })
        }(jQuery, window, document), $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        }), $(function() {
            $('[data-toggle="popover"]').popover()
        }), $(".list-task li label").click(function() {
            $(this).toggleClass("task-done")
        }), $(".settings_box a").click(function() {
            $("ul.theme_color").toggleClass("theme_block")
        })
}), $(".collapseble").click(function() {
    $(".collapseblebox").fadeToggle(350)
}), $(".slimscrollright").slimScroll({
    height: "100%",
    position: "right",
    size: "5px",
    color: "#dcdcdc"
}), $(".mini-nav, .sidebar-menu").slimScroll({
    height: "100%",
    position: "right",
    size: "0px",
    color: "#dcdcdc"
}), $(".scrollable-right").slimScroll({
    height: "100%",
    position: "right",
    size: "0px",
    color: "#dcdcdc"
}), $(".chat-list").slimScroll({
    height: "100%",
    position: "right",
    size: "0px",
    color: "#dcdcdc"
}), $("body").trigger("resize"), $(".visited li a").click(function(e) {
    $(".visited li").removeClass("active");
    var i = $(this).parent();
    i.hasClass("active") || i.addClass("active"), e.preventDefault()
}), $("#to-recover").click(function() {
    $("#loginform").slideUp(), $("#recoverform").fadeIn()
}), $(function() {
    $(window).load(function() {
        $(".chat-left-inner").css({
            height: $(window).height() - 240 + "px"
        })
    }), $(window).resize(function() {
        $(".chat-left-inner").css({
            height: $(window).height() - 240 + "px"
        })
    })
}), $(".open-panel").click(function() {
    $(".chat-left-aside").toggleClass("open-pnl"), $(".open-panel i").toggleClass("ti-angle-left")
}), $(function() {
    $(window).bind("load resize", function() {
        width = this.window.innerWidth > 0 ? this.window.innerWidth : this.screen.width, width < 1270 ? ($("body").addClass("content-wrapper"), $(".mini-nav > li.selected").addClass("cnt-none"), $("#togglebtn").hide()) : ($("body").removeClass("content-wrapper"), $("#togglebtn").show(), $(".mini-nav > li.selected").removeClass("cnt-none"))
    })
}), $(".mini-nav > li, #togglebtn").on("click", function() {
    $("body").hasClass("rmv-sidebarmenu") ? ($("body").trigger("resize"), $("#togglebtn").hide()) : ($("body").trigger("resize"), $("#togglebtn").show())
}), $(".mini-nav > li, #togglebtn").on("click", function() {
    $("body").hasClass("content-wrapper") && ($(".mini-nav > li.selected").removeClass("cnt-none"), $("#togglebtn").show())
}), $(".mini-nav").css("overflow", "hidden").parent().css("overflow", "visible"), $("#togglebtn").click(function() {
    $("#togglebtn").hide(), $(".mini-nav > li.selected").addClass("cnt-none")
}), $(".mini-nav > li").click(function() {
    $("#togglebtn").show(), $(".mini-nav > li.selected").removeClass("cnt-none"), $("body").removeClass("rmv-sidebarmenu")
}), $(".mini-nav > li").on("click", function() {
    $(".mini-nav > li.selected").removeClass("selected"), $(this).addClass("selected")
}), $("#togglebtn").on("click", function() {
    $("body").removeClass("content-wrapper"), $("body").addClass("content-wrapper")
}), $(function() {
    var e = window.location,
        i = $("ul.sidebar-menu a").filter(function() {
            return this.href == e || 0 == e.href.indexOf(this.href)
        }).addClass("active").parent().parent().addClass("in").parent();
    i.is("li") && i.addClass("active")
}), $.sidemenu = function(e) {
    var i = 300;
    $(e).on("click", "li a", function(e) {
        if ($(this).next().is(".sub-menu") && $(this).next().is(":visible")) $(this).next().slideUp(i, function() {
            $(this).next().removeClass("menu-open")
        }), $(this).next().parent("li").removeClass("active");
        else if ($(this).next().is(".sub-menu") && !$(this).next().is(":visible")) {
            var n = $(this).parents("ul").first();
            n.find("ul:visible").slideUp(i).removeClass("menu-open"), $(this).next().slideDown(i, function() {
                $(this).next().addClass("menu-open"), n.find("li.active").removeClass("active"), $(this).parent("li").addClass("active")
            })
        }
    })
}, $.sidemenu($(".sidebar-menu")), $(function() {
    $(window).bind("load resize", function() {
        width = this.window.innerWidth > 0 ? this.window.innerWidth : this.screen.width, width < 1549 ? ($("body").addClass("rmv-right-panel"), $(".right-side-toggle i").addClass("ti-arrow-left")) : ($("body").removeClass("rmv-right-panel"), $(".right-side-toggle i").removeClass("ti-arrow-left"))
    })
}), $(".right-side-toggle").on("click", function() {
    $("body").toggleClass("rmv-right-panel"), $(".right-side-toggle i").toggleClass("ti-arrow-left")
});