!(function () {
    var tRaw = sessionStorage.getItem("__ADMINTO_CONFIG__"),
        e = document.getElementsByTagName("html")[0],
        o = {
            theme: "light",
            layout: { mode: "fluid" },
            topbar: { color: "light" },
            menu: { color: "light" },
            sidenav: { size: e.getAttribute("data-sidenav-size") ?? "default" },
        };

    // Parse t jadi objek
    var t = tRaw ? JSON.parse(tRaw) : null;

    // Cek perbedaan antara o dan t
    function isDifferent(a, b) {
        return JSON.stringify(a) !== JSON.stringify(b);
    }

    // Kalau berbeda, update sessionStorage
    if (!t || isDifferent(o, t)) {
        sessionStorage.setItem("__ADMINTO_CONFIG__", JSON.stringify(o));
        // console.log("Config updated to sessionStorage:", o);
    } else {
        console.log("No changes detected in config.");
    }

    var t = sessionStorage.getItem("__ADMINTO_CONFIG__"),
        e = document.getElementsByTagName("html")[0],
        o = {
            theme: "light",
            layout: { mode: "fluid" },
            topbar: { color: "light" },
            menu: { color: "light" },
            sidenav: { size: e.getAttribute("data-sidenav-size") ?? "default" },
        },
        i =
            ((this.html = document.getElementsByTagName("html")[0]),
            (config = Object.assign(JSON.parse(JSON.stringify(o)), {})),
            this.html.getAttribute("data-bs-theme")),
        i =
            ((config.theme = null !== i ? i : o.theme),
            this.html.getAttribute("data-layout-mode")),
        i =
            ((config.layout.mode = null !== i ? i : o.layout.mode),
            this.html.getAttribute("data-topbar-color")),
        i =
            ((config.topbar.color = null != i ? i : o.topbar.color),
            this.html.getAttribute("data-menu-color")),
        i =
            ((config.sidenav.size = null !== i ? i : o.sidenav.size),
            this.html.getAttribute("data-sidenav-size"));

    // console.log(t);
    // console.log(o);
    // console.log(config);

    (config.menu.color = null !== i ? i : o.menu.color),
        (window.defaultConfig = JSON.parse(JSON.stringify(config))),
        null !== t && (config = JSON.parse(t)),
        (window.config = config) &&
            (window.innerWidth <= 1140
                ? (e.setAttribute("data-sidenav-size", "full"),
                  e.setAttribute("data-layout-mode", "default"))
                : (e.setAttribute("data-layout-mode", config.layout.mode),
                  e.setAttribute("data-sidenav-size", config.sidenav.size)),
            e.setAttribute("data-bs-theme", config.theme),
            e.setAttribute("data-menu-color", config.menu.color),
            e.setAttribute("data-topbar-color", config.topbar.color));
})();
