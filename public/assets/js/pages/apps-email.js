let quill = new Quill("#mail-compose", {
    modules: {
        toolbar: [
            [{ header: [1, 2, !1] }],
            ["bold", "italic", "underline"],
            ["image", "code-block"],
        ],
    },
    placeholder: "Compose an epic...",
    theme: "snow",
});
