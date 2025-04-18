var sliderColorScheme = document.querySelectorAll("#rangeslider_basic"),
    rangesliderVertical =
        (sliderColorScheme &&
            sliderColorScheme.forEach(function (e) {
                noUiSlider.create(e, {
                    start: 127,
                    connect: "lower",
                    range: { min: 0, max: 255 },
                });
            }),
        document.querySelectorAll("#rangeslider_vertical")),
    multielementslider =
        (rangesliderVertical &&
            rangesliderVertical.forEach(function (e) {
                noUiSlider.create(e, {
                    start: [60, 160],
                    connect: !0,
                    orientation: "vertical",
                    range: { min: 0, max: 200 },
                });
            }),
        document.querySelectorAll("#rangeslider_multielement")),
    resultElement =
        (multielementslider &&
            multielementslider.forEach(function (e) {
                noUiSlider.create(e, {
                    start: [20, 80],
                    connect: !0,
                    range: { min: 0, max: 100 },
                });
            }),
        document.getElementById("result")),
    sliders = document.getElementsByClassName("sliders"),
    colors = [0, 0, 0],
    nonLinearSlider =
        (sliders &&
            [].slice.call(sliders).forEach(function (t, i) {
                noUiSlider.create(t, {
                    start: 127,
                    connect: [!0, !1],
                    orientation: "vertical",
                    range: { min: 0, max: 255 },
                    format: wNumb({ decimals: 0 }),
                }),
                    t.noUiSlider.on("update", function () {
                        colors[i] = t.noUiSlider.get();
                        var e = "rgb(" + colors.join(",") + ")";
                        (resultElement.style.background = e),
                            (resultElement.style.color = e);
                    });
            }),
        document.getElementById("nonlinear")),
    nodes =
        (nonLinearSlider &&
            noUiSlider.create(nonLinearSlider, {
                connect: !0,
                behaviour: "tap",
                start: [500, 4e3],
                range: {
                    min: [0],
                    "10%": [500, 500],
                    "50%": [4e3, 1e3],
                    max: [1e4],
                },
            }),
        [
            document.getElementById("lower-value"),
            document.getElementById("upper-value"),
        ]),
    lockedState =
        (nonLinearSlider.noUiSlider.on("update", function (e, t, i, r, n) {
            nodes[t].innerHTML = e[t] + ", " + n[t].toFixed(2) + "%";
        }),
        !1),
    lockedSlider = !1,
    lockedValues = [60, 80],
    slider1 = document.getElementById("slider1"),
    slider2 = document.getElementById("slider2"),
    lockButton = document.getElementById("lockbutton"),
    slider1Value = document.getElementById("slider1-span"),
    slider2Value = document.getElementById("slider2-span");
function crossUpdate(e, t) {
    var i;
    lockedState &&
        ((e -=
            lockedValues[(i = slider1 === t ? 0 : 1) ? 0 : 1] -
            lockedValues[i]),
        t.noUiSlider.set(e));
}
function setLockedValues() {
    lockedValues = [
        Number(slider1.noUiSlider.get()),
        Number(slider2.noUiSlider.get()),
    ];
}
lockButton &&
    lockButton.addEventListener("click", function () {
        (lockedState = !lockedState),
            (this.textContent = lockedState ? "Unlock" : "Lock");
    }),
    noUiSlider.create(slider1, {
        start: 60,
        animate: !1,
        range: { min: 50, max: 100 },
    }),
    noUiSlider.create(slider2, {
        start: 80,
        animate: !1,
        range: { min: 50, max: 100 },
    }),
    slider1 &&
        slider2 &&
        (slider1.noUiSlider.on("update", function (e, t) {
            slider1Value.innerHTML = e[t];
        }),
        slider2.noUiSlider.on("update", function (e, t) {
            slider2Value.innerHTML = e[t];
        }),
        slider1.noUiSlider.on("change", setLockedValues),
        slider2.noUiSlider.on("change", setLockedValues),
        slider1.noUiSlider.on("slide", function (e, t) {
            crossUpdate(e[t], slider2);
        }),
        slider2.noUiSlider.on("slide", function (e, t) {
            crossUpdate(e[t], slider1);
        }));
var mergingTooltipSlider = document.getElementById("slider-merging-tooltips");
function mergeTooltips(e, s, m) {
    var u = "rtl" === getComputedStyle(e).direction,
        g = "rtl" === e.noUiSlider.options.direction,
        S = "vertical" === e.noUiSlider.options.orientation,
        p = e.noUiSlider.getTooltips(),
        i = e.noUiSlider.getOrigins();
    p.forEach(function (e, t) {
        e && i[t].appendChild(e);
    }),
        e &&
            e.noUiSlider.on("update", function (e, t, i, r, n) {
                var l = [[]],
                    a = [[]],
                    c = [[]],
                    o = 0;
                p[0] && ((l[0][0] = 0), (a[0][0] = n[0]), (c[0][0] = e[0]));
                for (var d = 1; d < n.length; d++)
                    (!p[d] || n[d] - n[d - 1] > s) &&
                        ((l[++o] = []), (c[o] = []), (a[o] = [])),
                        p[d] &&
                            (l[o].push(d), c[o].push(e[d]), a[o].push(n[d]));
                l.forEach(function (e, t) {
                    for (var i = e.length, r = 0; r < i; r++) {
                        var n,
                            l,
                            o,
                            d = e[r];
                        r === i - 1
                            ? ((o = 0),
                              a[t].forEach(function (e) {
                                  o += 1e3 - e;
                              }),
                              (n = S ? "bottom" : "right"),
                              (l = 1e3 - a[t][g ? 0 : i - 1]),
                              (o = (u && !S ? 100 : 0) + o / i - l),
                              (p[d].innerHTML = c[t].join(m)),
                              (p[d].style.display = "block"),
                              (p[d].style[n] = o + "%"))
                            : (p[d].style.display = "none");
                    }
                });
            });
}
mergingTooltipSlider &&
    (noUiSlider.create(mergingTooltipSlider, {
        start: [20, 75],
        connect: !0,
        tooltips: [!0, !0],
        range: { min: 0, max: 100 },
    }),
    mergeTooltips(mergingTooltipSlider, 5, " - "));
var softSlider = document.getElementById("soft");
softSlider &&
    (noUiSlider.create(softSlider, {
        start: 50,
        range: { min: 0, max: 100 },
        pips: { mode: "values", values: [20, 80], density: 4 },
    }),
    softSlider.noUiSlider.on("change", function (e, t) {
        e[t] < 20
            ? softSlider.noUiSlider.set(20)
            : 80 < e[t] && softSlider.noUiSlider.set(80);
    }));
let sliderPrimary = document.getElementById("slider-primary"),
    sliderSecondary = document.getElementById("slider-secondary"),
    sliderSuccess = document.getElementById("slider-success"),
    sliderDanger = document.getElementById("slider-danger"),
    sliderInfo = document.getElementById("slider-info"),
    sliderWarning = document.getElementById("slider-warning"),
    colorOptions = {
        start: 127,
        connect: "lower",
        range: { min: 0, max: 255 },
    },
    defaultVertical =
        (sliderPrimary && noUiSlider.create(sliderPrimary, colorOptions),
        sliderSecondary && noUiSlider.create(sliderSecondary, colorOptions),
        sliderSuccess && noUiSlider.create(sliderSuccess, colorOptions),
        sliderDanger && noUiSlider.create(sliderDanger, colorOptions),
        sliderInfo && noUiSlider.create(sliderInfo, colorOptions),
        sliderWarning && noUiSlider.create(sliderWarning, colorOptions),
        document.getElementById("slider-vertical")),
    connectVertical = document.getElementById("slider-connect-upper"),
    tooltipVertical = document.getElementById("slider-vertical-tooltip"),
    limitVertical = document.getElementById("slider-vertical-limit");
defaultVertical &&
    ((defaultVertical.style.height = "200px"),
    noUiSlider.create(defaultVertical, {
        start: [40, 60],
        orientation: "vertical",
        behaviour: "drag",
        connect: !0,
        range: { min: 0, max: 100 },
    })),
    connectVertical &&
        ((connectVertical.style.height = "200px"),
        noUiSlider.create(connectVertical, {
            start: 40,
            orientation: "vertical",
            behaviour: "drag",
            connect: "upper",
            range: { min: 0, max: 100 },
        })),
    tooltipVertical &&
        ((tooltipVertical.style.height = "200px"),
        noUiSlider.create(tooltipVertical, {
            start: 10,
            orientation: "vertical",
            behaviour: "drag",
            tooltips: !0,
            range: { min: 0, max: 100 },
        })),
    limitVertical &&
        ((limitVertical.style.height = "200px"),
        noUiSlider.create(limitVertical, {
            start: [0, 40],
            orientation: "vertical",
            behaviour: "drag",
            limit: 60,
            tooltips: !0,
            connect: !0,
            range: { min: 0, max: 100 },
        }));
