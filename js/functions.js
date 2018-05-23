function decodeAndParse(str) {
    return JSON.parse(decodeURIComponent((str).replace(/\+/g, '%20')));
}