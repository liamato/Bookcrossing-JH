export default function translate(index, def, lang) {
    if (!db || ! db.translations) {
        return def;
    }
    if (!lang) {
        if (window.localStorage && localStorage.lang) {
            lang = localStorage.lang
        } else {
            lang = Object.keys(db.translations)[0]
        }
    }
    return db.translations[lang][index]? db.translations[lang][index]:def
}
