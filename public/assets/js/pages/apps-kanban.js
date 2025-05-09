class Dragula {
    initDragula() {
        document
            .querySelectorAll('[data-plugin="dragula"]')
            .forEach(function (t) {
                var a = t.getAttribute("data-containers"),
                    n = [],
                    e =
                        (a
                            ? (a = JSON.parse(a)).forEach(function (t) {
                                  n.push(document.getElementById(t));
                              })
                            : (n = [t]),
                        t.getAttribute("data-handleclass"));
                e
                    ? dragula(n, {
                          moves: function (t, a, n) {
                              return n.classList.contains(e);
                          },
                      })
                    : dragula(n);
            });
    }
    init() {
        this.initDragula();
    }
}
document.addEventListener("DOMContentLoaded", function (t) {
    new Dragula().init();
});
