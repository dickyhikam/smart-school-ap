((o) => {
    function e() {
        this.$body = o("body");
    }
    (e.prototype.init = function () {
        (Dropzone.autoDiscover = !1),
            o('[data-plugin="dropzone"]').each(function () {
                var e = o(this).attr("action"),
                    i = o(this).data("previewsContainer"),
                    e = { url: e };
                i && (e.previewsContainer = i),
                    (i = o(this).data("uploadPreviewTemplate")) &&
                        (e.previewTemplate = o(i).html()),
                    o(this).dropzone(e);
            });
    }),
        (o.FileUpload = new e()),
        (o.FileUpload.Constructor = e);
})(window.jQuery),
    window.jQuery.FileUpload.init();
