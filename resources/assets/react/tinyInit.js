export default function tinyInit(lang) {
    if (!tinymce) return
    if (!lang) lang = 'ca'
    tinymce.init({
        selector: '.tinymce',
        content_css: db.content_css,
        menubar: false,
        statusbar: false,
        toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image ',
        plugins: 'image imagetools link autolink autoresize',
        link_assume_external_targets: true,
        browser_spellcheck: true,
        language: lang,
        language_url: db.language_url,
        width: '100%',
    });
}
