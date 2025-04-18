function onload(e) {
    raterJs({
        starSize: 32,
        element: document.querySelector("#rater"),
        rateCallback: function (e, t) {
            this.setRating(e), t();
        },
    }),
        raterJs({
            starSize: 32,
            step: 0.5,
            element: document.querySelector("#rater-step"),
            rateCallback: function (e, t) {
                this.setRating(e), t();
            },
        });
    var r = raterJs({
            isBusyText: "Rating in progress. Please wait...",
            element: document.querySelector("#rater4"),
            rateCallback: function (e, t) {
                r.setRating(e),
                    setTimeout(function () {
                        var e = 5 * Math.random();
                        r.setRating(e), t();
                    }, 1e3);
            },
        }),
        a = raterJs({
            max: 5,
            rating: 4,
            element: document.querySelector("#rater2"),
            disableText: "Custom disable text!",
            ratingText: "My custom rating text {rating}",
            showToolTip: !0,
            rateCallback: function (e, t) {
                a.setRating(e), a.disable(), t();
            },
        }),
        t =
            (raterJs({
                max: 16,
                readOnly: !0,
                rating: 4.4,
                element: document.querySelector("#rater3"),
            }),
            raterJs({
                element: document.querySelector("#rater5"),
                rateCallback: function (e, t) {
                    this.setRating(e), t();
                },
                onHover: function (e, t) {
                    document.querySelector(".live-rating").textContent = e;
                },
                onLeave: function (e, t) {
                    document.querySelector(".live-rating").textContent = t;
                },
            }),
            raterJs({
                starSize: 32,
                element: document.querySelector("#rater6"),
                rateCallback: function (e, t) {
                    this.setRating(e), t();
                },
            }));
    document.querySelector("#rater6-button").addEventListener(
        "click",
        function () {
            t.clear(), console.log(t.getRating());
        },
        !1
    ),
        raterJs({
            max: 6,
            reverse: !0,
            element: document.querySelector("#rater7"),
            rateCallback: function (e, t) {
                this.setRating(e), t();
            },
        });
}
window.addEventListener("load", onload, !1);
