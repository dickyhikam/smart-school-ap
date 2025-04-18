class App {
    initComponents() {
        $(window).on("load", function () {
            $("#status").fadeOut(), $("#preloader").delay(350).fadeOut("slow");
        }),
            [...document.querySelectorAll('[data-bs-toggle="popover"]')].map(
                (e) => new bootstrap.Popover(e)
            ),
            [...document.querySelectorAll('[data-bs-toggle="tooltip"]')].map(
                (e) => new bootstrap.Tooltip(e)
            ),
            [...document.querySelectorAll(".offcanvas")].map(
                (e) => new bootstrap.Offcanvas(e)
            );
        var e = document.getElementById("toastPlacement");
        e &&
            document
                .getElementById("selectToastPlacement")
                .addEventListener("change", function () {
                    e.dataset.originalClass ||
                        (e.dataset.originalClass = e.className),
                        (e.className =
                            e.dataset.originalClass + " " + this.value);
                }),
            [].slice
                .call(document.querySelectorAll(".toast"))
                .map(function (e) {
                    return new bootstrap.Toast(e);
                });
        let t = document.getElementById("liveAlertPlaceholder"),
            a = document.getElementById("liveAlertBtn");
        a &&
            a.addEventListener("click", () => {
                var e;
                ((e = document.createElement("div")).innerHTML = [
                    '<div class="alert alert-success alert-dismissible" role="alert">',
                    "   <div>Nice, you triggered this alert message!</div>",
                    '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
                    "</div>",
                ].join("")),
                    t.append(e);
            }),
            document.getElementById("app-style").href.includes("rtl.min.css") &&
                (document.getElementsByTagName("html")[0].dir = "rtl");
    }
    initPortletCard() {
        var a = ".card";
        $(document).on(
            "click",
            '.card a[data-bs-toggle="remove"]',
            function (e) {
                e.preventDefault();
                var t = (e = $(this).closest(a)).parent();
                e.remove(), 0 == t.children().length && t.remove();
            }
        ),
            $(document).on(
                "click",
                '.card a[data-bs-toggle="reload"]',
                function (e) {
                    e.preventDefault(),
                        (e = $(this).closest(a)).append(
                            '<div class="card-disabled"><div class="card-portlets-loader"></div></div>'
                        );
                    var t = e.find(".card-disabled");
                    setTimeout(function () {
                        t.fadeOut("fast", function () {
                            t.remove();
                        });
                    }, 500 + 5 * Math.random() * 300);
                }
            );
    }
    initMultiDropdown() {
        $(".dropdown-menu a.dropdown-toggle").on("click", function () {
            var e = $(this).next(".dropdown-menu");
            return (
                (e = $(this)
                    .parent()
                    .parent()
                    .find(".dropdown-menu")
                    .not(e)).removeClass("show"),
                e.parent().find(".dropdown-toggle").removeClass("show"),
                !1
            );
        });
    }
    initCounterUp() {
        var a = $(this).attr("data-delay") ? $(this).attr("data-delay") : 100,
            n = $(this).attr("data-time") ? $(this).attr("data-time") : 1200;
        $('[data-plugin="counterup"]').each(function (e, t) {
            $(this).counterUp({ delay: a, time: n });
        });
    }
    initLeftSidebar() {
        var e;
        $(".side-nav").length &&
            ((e = $(".side-nav li .collapse")),
            $(".side-nav li [data-bs-toggle='collapse']").on(
                "click",
                function (e) {
                    return !1;
                }
            ),
            e.on({
                "show.bs.collapse": function (e) {
                    var t = $(e.target).parents(".collapse.show");
                    $(".side-nav .collapse.show")
                        .not(e.target)
                        .not(t)
                        .collapse("hide");
                },
            }),
            $(".side-nav a").each(function () {
                var currentUrl = window.location.href.split(/[?#]/)[0]; //currentUrl
                var linkUrl = this.href.split(/[?#]/)[0];

                if (currentUrl.includes("perpustakaan")) {
                    // Memecah URL untuk hanya mengambil bagian yang lebih umum (misalnya, menghapus /tambah)
                    var e = currentUrl.split("/").slice(0, 5).join("/"); // Mengambil hanya 'http://smart-school.test/perpustakaan'
                } else {
                    // Memecah URL untuk hanya mengambil bagian yang lebih umum (misalnya, menghapus /tambah)
                    var e = currentUrl.split("/").slice(0, 4).join("/"); // Mengambil hanya 'http://smart-school.test/perpustakaan'
                }

                // Hanya cocokkan URL yang sesuai dengan bagian yang lebih spesifik
                if (e.startsWith(linkUrl)) {
                    this.href == e &&
                        ($(this).addClass("active"),
                        $(this).parent().addClass("active"),
                        $(this).parent().parent().parent().addClass("show"),
                        $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .addClass("active"),
                        "sidebar-menu" !==
                            (e = $(this)
                                .parent()
                                .parent()
                                .parent()
                                .parent()
                                .parent()
                                .parent()).attr("id") && e.addClass("show"),
                        $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .addClass("active"),
                        "wrapper" !==
                            (e = $(this)
                                .parent()
                                .parent()
                                .parent()
                                .parent()
                                .parent()
                                .parent()
                                .parent()
                                .parent()
                                .parent()).attr("id") && e.addClass("show"),
                        (e = $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()).is("body") || e.addClass("active"));
                }
            }),
            setTimeout(function () {
                var e,
                    a,
                    n,
                    i,
                    o,
                    t = document.querySelector("li.active .active");
                null != t &&
                    ((e = document.querySelector(
                        ".sidenav-menu .simplebar-content-wrapper"
                    )),
                    (t = t.offsetTop - 300),
                    e) &&
                    100 < t &&
                    ((n = (a = e).scrollTop),
                    (i = t - n),
                    (o = 0),
                    (function e() {
                        var t = (o += 20),
                            t =
                                (t /= 300) < 1
                                    ? (i / 2) * t * t + n
                                    : (-i / 2) * (--t * (t - 2) - 1) + n;
                        (a.scrollTop = t), o < 600 && setTimeout(e, 20);
                    })());
            }, 200));
    }
    initTopbarMenu() {
        $(".navbar-nav").length &&
            ($(".navbar-nav li a").each(function () {
                var e = window.location.href.split(/[?#]/)[0];
                this.href == e &&
                    ($(this).addClass("active"),
                    $(this).parent().parent().addClass("active"),
                    $(this)
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .addClass("active"),
                    $(this)
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .addClass("active"));
            }),
            $(".navbar-toggle").on("click", function () {
                $(this).toggleClass("open"), $("#navigation").slideToggle(400);
            }));
    }
    initfullScreenListener() {
        var e = document.querySelector('[data-toggle="fullscreen"]');
        e &&
            e.addEventListener("click", function (e) {
                e.preventDefault(),
                    document.body.classList.toggle("fullscreen-enable"),
                    document.fullscreenElement ||
                    document.mozFullScreenElement ||
                    document.webkitFullscreenElement
                        ? document.cancelFullScreen
                            ? document.cancelFullScreen()
                            : document.mozCancelFullScreen
                            ? document.mozCancelFullScreen()
                            : document.webkitCancelFullScreen &&
                              document.webkitCancelFullScreen()
                        : document.documentElement.requestFullscreen
                        ? document.documentElement.requestFullscreen()
                        : document.documentElement.mozRequestFullScreen
                        ? document.documentElement.mozRequestFullScreen()
                        : document.documentElement.webkitRequestFullscreen &&
                          document.documentElement.webkitRequestFullscreen(
                              Element.ALLOW_KEYBOARD_INPUT
                          );
            });
    }
    initFormValidation() {
        document.querySelectorAll(".needs-validation").forEach((t) => {
            t.addEventListener(
                "submit",
                (e) => {
                    t.checkValidity() ||
                        (e.preventDefault(), e.stopPropagation()),
                        t.classList.add("was-validated");
                },
                !1
            );
        });
    }
    initFormAdvance() {
        document.querySelectorAll('[data-toggle="input-mask"]').forEach((e) => {
            var t = e
                .getAttribute("data-mask-format")
                .toString()
                .replaceAll("0", "9");
            e.setAttribute("data-mask-format", t), new Inputmask(t).mask(e);
        }),
            document.querySelectorAll("[data-choices]").forEach(function (e) {
                var t = {},
                    a = e.attributes;
                a["data-choices-groups"] &&
                    (t.placeholderValue =
                        "This is a placeholder set in the config"),
                    a["data-choices-search-false"] && (t.searchEnabled = !1),
                    a["data-choices-search-true"] && (t.searchEnabled = !0),
                    a["data-choices-removeItem"] && (t.removeItemButton = !0),
                    a["data-choices-sorting-false"] && (t.shouldSort = !1),
                    a["data-choices-sorting-true"] && (t.shouldSort = !0),
                    a["data-choices-multiple-remove"] &&
                        (t.removeItemButton = !0),
                    a["data-choices-limit"] &&
                        (t.maxItemCount =
                            a["data-choices-limit"].value.toString()),
                    a["data-choices-limit"] &&
                        (t.maxItemCount =
                            a["data-choices-limit"].value.toString()),
                    a["data-choices-editItem-true"] && (t.maxItemCount = !0),
                    a["data-choices-editItem-false"] && (t.maxItemCount = !1),
                    a["data-choices-text-unique-true"] &&
                        (t.duplicateItemsAllowed = !1),
                    a["data-choices-text-disabled-true"] && (t.addItems = !1),
                    a["data-choices-text-disabled-true"]
                        ? new Choices(e, t).disable()
                        : new Choices(e, t);
            }),
            jQuery().select2 && $('[data-toggle="select2"]').select2(),
            jQuery().mask &&
                $('[data-toggle="input-mask"]').each(function (e, t) {
                    var a = $(t).data("maskFormat"),
                        n = $(t).data("reverse");
                    null != n ? $(t).mask(a, { reverse: n }) : $(t).mask(a);
                });
        var e = document.querySelectorAll("[data-provider]");
        Array.from(e).forEach(function (e) {
            var t, a, n;
            "flatpickr" == e.getAttribute("data-provider")
                ? ((n = e.attributes),
                  ((t = {}).disableMobile = "true"),
                  n["data-date-format"] &&
                      (t.dateFormat = n["data-date-format"].value.toString()),
                  n["data-enable-time"] &&
                      ((t.enableTime = !0),
                      (t.dateFormat =
                          n["data-date-format"].value.toString() + " H:i")),
                  n["data-altFormat"] &&
                      ((t.altInput = !0),
                      (t.altFormat = n["data-altFormat"].value.toString())),
                  n["data-minDate"] &&
                      ((t.minDate = n["data-minDate"].value.toString()),
                      (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-maxDate"] &&
                      ((t.maxDate = n["data-maxDate"].value.toString()),
                      (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-deafult-date"] &&
                      ((t.defaultDate =
                          n["data-deafult-date"].value.toString()),
                      (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-multiple-date"] &&
                      ((t.mode = "multiple"),
                      (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-range-date"] &&
                      ((t.mode = "range"),
                      (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-inline-date"] &&
                      ((t.inline = !0),
                      (t.defaultDate = n["data-deafult-date"].value.toString()),
                      (t.dateFormat = n["data-date-format"].value.toString())),
                  n["data-disable-date"] &&
                      ((a = []).push(n["data-disable-date"].value),
                      (t.disable = a.toString().split(","))),
                  n["data-week-number"] &&
                      ((a = []).push(n["data-week-number"].value),
                      (t.weekNumbers = !0)),
                  flatpickr(e, t))
                : "timepickr" == e.getAttribute("data-provider") &&
                  ((a = {}),
                  (n = e.attributes)["data-time-basic"] &&
                      ((a.enableTime = !0),
                      (a.noCalendar = !0),
                      (a.dateFormat = "H:i")),
                  n["data-time-hrs"] &&
                      ((a.enableTime = !0),
                      (a.noCalendar = !0),
                      (a.dateFormat = "H:i"),
                      (a.time_24hr = !0)),
                  n["data-min-time"] &&
                      ((a.enableTime = !0),
                      (a.noCalendar = !0),
                      (a.dateFormat = "H:i"),
                      (a.minTime = n["data-min-time"].value.toString())),
                  n["data-max-time"] &&
                      ((a.enableTime = !0),
                      (a.noCalendar = !0),
                      (a.dateFormat = "H:i"),
                      (a.minTime = n["data-max-time"].value.toString())),
                  n["data-default-time"] &&
                      ((a.enableTime = !0),
                      (a.noCalendar = !0),
                      (a.dateFormat = "H:i"),
                      (a.defaultDate =
                          n["data-default-time"].value.toString())),
                  n["data-time-inline"] &&
                      ((a.enableTime = !0),
                      (a.noCalendar = !0),
                      (a.defaultDate = n["data-time-inline"].value.toString()),
                      (a.inline = !0)),
                  flatpickr(e, a));
        });
    }
    initTopbarScroll() {
        window.scrollY;
        var e = document.getElementById("header");
        window.addEventListener("scroll", function () {
            25 <= window.scrollY
                ? e.classList.add("topbar-active")
                : e.classList.remove("topbar-active");
        });
    }
    init() {
        this.initComponents(),
            this.initPortletCard(),
            this.initMultiDropdown(),
            this.initCounterUp(),
            this.initLeftSidebar(),
            this.initTopbarMenu(),
            this.initfullScreenListener(),
            this.initFormValidation(),
            this.initFormAdvance(),
            this.initTopbarScroll();
    }
}
class ThemeCustomizer {
    constructor() {
        (this.html = document.getElementsByTagName("html")[0]),
            (this.config = {}),
            (this.defaultConfig = window.config);
    }
    initConfig() {
        (this.defaultConfig = JSON.parse(JSON.stringify(window.defaultConfig))),
            (this.config = JSON.parse(JSON.stringify(window.config))),
            this.setSwitchFromConfig();
    }
    initTwoColumn() {
        var a, n, t, i, o;
        $("#two-col-sidenav-main").length &&
            ((a = $("#two-col-sidenav-main .side-nav-link")),
            (n = $(".sidenav-menu-item")),
            (t = $(".sidenav-menu-item .sub-menu")),
            (i = $("#two-col-menu menu-item .collapse")).on({
                "show.bs.collapse": function () {
                    var e = $(this).closest(t).closest(t).find(i);
                    (e.length ? e : i).not($(this)).collapse("hide");
                },
            }),
            a.on("click", function (e) {
                var t = $($(this).attr("href"));
                return (
                    t.length &&
                        (e.preventDefault(),
                        a.removeClass("active"),
                        $(this).addClass("active"),
                        n.removeClass("d-block"),
                        t.addClass("d-block"),
                        1040 <= window.innerWidth) &&
                        self.changeLeftbarSize("default"),
                    !0
                );
            }),
            (o = window.location.href),
            a.each(function () {
                this.href === o && $(this).addClass("active");
            }),
            $("#two-col-menu a").each(function () {
                var e, t, a;
                this.href == o &&
                    ($(this).addClass("active"),
                    $(this).parent().addClass("active"),
                    $(this).parent().parent().parent().addClass("show"),
                    $(this)
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .addClass("active"),
                    "sidebar-menu" !==
                        (e = $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()).attr("id") && e.addClass("show"),
                    $(this)
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .addClass("active"),
                    "wrapper" !==
                        (e = $(this)
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()
                            .parent()).attr("id") && e.addClass("show"),
                    (e = $(this)
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()
                        .parent()).is("body") || e.addClass("active"),
                    (t = null),
                    (a =
                        "#" + $(this).parents(".sidenav-menu-item").attr("id")),
                    $("#two-col-sidenav-main .side-nav-link").each(function () {
                        $(this).attr("href") === a && (t = $(this));
                    }),
                    t) &&
                    t.trigger("click");
            }));
    }
    changeMenuColor(e) {
        (this.config.menu.color = e),
            this.html.setAttribute("data-menu-color", e),
            this.setSwitchFromConfig();
    }
    changeLeftbarSize(e, t = !0) {
        this.html.setAttribute("data-sidenav-size", e),
            t && ((this.config.sidenav.size = e), this.setSwitchFromConfig());
    }
    changeLayoutMode(e, t = !0) {
        this.html.setAttribute("data-layout-mode", e),
            t && ((this.config.layout.mode = e), this.setSwitchFromConfig());
    }
    changeLayoutColor(e) {
        (this.config.theme = e),
            this.html.setAttribute("data-bs-theme", e),
            this.setSwitchFromConfig();
    }
    changeTopbarColor(e) {
        (this.config.topbar.color = e),
            this.html.setAttribute("data-topbar-color", e),
            this.setSwitchFromConfig();
    }
    resetTheme() {
        (this.config = JSON.parse(JSON.stringify(window.defaultConfig))),
            this.changeMenuColor(this.config.menu.color),
            this.changeLeftbarSize(this.config.sidenav.size),
            this.changeLayoutColor(this.config.theme),
            this.changeLayoutMode(this.config.layout.mode),
            this.changeTopbarColor(this.config.topbar.color),
            this._adjustLayout();
    }
    initSwitchListener() {
        var a = this,
            e =
                (document
                    .querySelectorAll("input[name=data-menu-color]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            a.changeMenuColor(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-sidenav-size]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            a.changeLeftbarSize(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-bs-theme]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            a.changeLayoutColor(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-layout-mode]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            a.changeLayoutMode(t.value);
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-layout]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            window.location =
                                "horizontal" === t.value
                                    ? "layouts-horizontal.html"
                                    : "index.html";
                        });
                    }),
                document
                    .querySelectorAll("input[name=data-topbar-color]")
                    .forEach(function (t) {
                        t.addEventListener("change", function (e) {
                            a.changeTopbarColor(t.value);
                        });
                    }),
                document.getElementById("light-dark-mode"));
        e &&
            e.addEventListener("click", function (e) {
                "light" === a.config.theme
                    ? a.changeLayoutColor("dark")
                    : a.changeLayoutColor("light");
            }),
            (e = document.querySelector("#reset-layout")) &&
                e.addEventListener("click", function (e) {
                    a.resetTheme();
                }),
            document
                .querySelectorAll(".sidenav-toggle-button")
                .forEach(function (e) {
                    e.addEventListener("click", function () {
                        var e = a.config.sidenav.size,
                            t = a.html.getAttribute("data-sidenav-size", e);
                        "full" === t
                            ? a.showBackdrop()
                            : "fullscreen" == e
                            ? "fullscreen" === t
                                ? a.changeLeftbarSize(
                                      "fullscreen" == e ? "default" : e,
                                      !1
                                  )
                                : a.changeLeftbarSize("fullscreen", !1)
                            : "condensed" === t
                            ? a.changeLeftbarSize(
                                  "condensed" == e ? "default" : e,
                                  !1
                              )
                            : a.changeLeftbarSize("condensed", !1),
                            a.html.classList.toggle("sidebar-enable");
                    });
                }),
            (e = document.querySelector(".button-close-fullsidebar")) &&
                e.addEventListener("click", function () {
                    a.html.classList.remove("sidebar-enable"), a.hideBackdrop();
                }),
            document.querySelectorAll(".button-sm-hover").forEach(function (e) {
                e.addEventListener("click", function () {
                    var e = a.config.sidenav.size;
                    "sm-hover-active" ===
                    a.html.getAttribute("data-sidenav-size", e)
                        ? a.changeLeftbarSize("sm-hover", !1)
                        : a.changeLeftbarSize("sm-hover-active", !1);
                });
            });
    }
    showBackdrop() {
        var e = document.createElement("div");
        (e.id = "custom-backdrop"),
            (e.classList = "offcanvas-backdrop fade show"),
            document.body.appendChild(e),
            (document.body.style.overflow = "hidden"),
            767 < window.innerWidth &&
                (document.body.style.paddingRight = "15px");
        let t = this;
        e.addEventListener("click", function (e) {
            t.html.classList.remove("sidebar-enable"), t.hideBackdrop();
        });
    }
    hideBackdrop() {
        var e = document.getElementById("custom-backdrop");
        e &&
            (document.body.removeChild(e),
            (document.body.style.overflow = null),
            (document.body.style.paddingRight = null));
    }
    initWindowSize() {
        var t = this;
        window.addEventListener("resize", function (e) {
            t._adjustLayout();
        });
    }
    _adjustLayout() {
        var e = this;
        window.innerWidth <= 1140
            ? (e.changeLeftbarSize("full", !1),
              e.changeLayoutMode("default", !1))
            : (e.changeLeftbarSize(e.config.sidenav.size),
              e.changeLayoutMode(e.config.layout.mode));
    }
    setSwitchFromConfig() {
        sessionStorage.setItem(
            "__ADMINTO_CONFIG__",
            JSON.stringify(this.config)
        ),
            document
                .querySelectorAll(
                    "#theme-settings-offcanvas input[type=checkbox]"
                )
                .forEach(function (e) {
                    e.checked = !1;
                });
        var e,
            t,
            a,
            n,
            i,
            o = this.config;
        o &&
            ((e = document.querySelector(
                "input[type=radio][name=data-layout][value=" + o.nav + "]"
            )),
            (t = document.querySelector(
                "input[type=radio][name=data-bs-theme][value=" + o.theme + "]"
            )),
            (a = document.querySelector(
                "input[type=radio][name=data-layout-mode][value=" +
                    o.layout.mode +
                    "]"
            )),
            (n = document.querySelector(
                "input[type=radio][name=data-topbar-color][value=" +
                    o.topbar.color +
                    "]"
            )),
            (i = document.querySelector(
                "input[type=radio][name=data-menu-color][value=" +
                    o.menu.color +
                    "]"
            )),
            (o = document.querySelector(
                "input[type=radio][name=data-sidenav-size][value=" +
                    o.sidenav.size +
                    "]"
            )),
            e && (e.checked = !0),
            t && (t.checked = !0),
            a && (a.checked = !0),
            n && (n.checked = !0),
            i && (i.checked = !0),
            o) &&
            (o.checked = !0);
    }
    init() {
        this.initConfig(),
            this.initTwoColumn(),
            this.initSwitchListener(),
            this.initWindowSize(),
            this._adjustLayout(),
            this.setSwitchFromConfig();
    }
}
document.addEventListener("DOMContentLoaded", function (e) {
    new App().init(), new ThemeCustomizer().init();
});
let customJS = () => {
    var e;
    document.addEventListener("mousemove", function (t) {
        clearTimeout(e),
            (e = setTimeout(function () {
                var e = new CustomEvent("mousestop", {
                    detail: { clientX: t.clientX, clientY: t.clientY },
                    bubbles: !0,
                    cancelable: !0,
                });
                t.target.dispatchEvent(e);
            }, 100));
    }),
        document.querySelectorAll("[data-dismissible]").forEach((a) => {
            a.addEventListener("click", (e) => {
                var t = a.getAttribute("data-dismissible");
                (t = document.querySelector(t)) && t.remove();
            });
        });
    {
        let e = document.querySelectorAll("[data-toggler]"),
            n = (e) => {
                e.classList.remove("d-none");
            },
            i = (e) => {
                e.classList.add("d-none");
            },
            o = (e, t, a) => {
                console.info(e, t, a),
                    e && t && (a ? (n(e), i(t)) : (n(t), i(e)));
            };
        e.forEach((e) => {
            let t = e.querySelector("[data-toggler-on]"),
                a = e.querySelector("[data-toggler-off]"),
                n = "on" === e.getAttribute("data-toggler");
            t &&
                t.addEventListener("click", () => {
                    (n = !1), o(t, a, n);
                }),
                a &&
                    a.addEventListener("click", () => {
                        (n = !0), o(t, a, n);
                    }),
                o(t, a, n);
        });
    }
    document.querySelectorAll("[data-touchspin]").forEach((e) => {
        let t = e.querySelector(".minus"),
            i = e.querySelector(".plus"),
            o = e.querySelector("input");
        if (o) {
            let a = 0 !== o.min.length ? Number(o.min) : null,
                n = 0 !== o.max.length ? Number(o.max) : null;
            t &&
                t.addEventListener("click", (e) => {
                    var t = Number.parseInt(o.value) - 1;
                    null === a && (o.value = t.toString()),
                        null != a && t > a - 1 && (o.value = t.toString());
                }),
                i &&
                    i.addEventListener("click", (e) => {
                        var t = Number.parseInt(o.value) + 1;
                        null === n && (o.value = t.toString()),
                            null != n && t < n + 1 && (o.value = t.toString());
                    });
        }
    });
};
customJS();
