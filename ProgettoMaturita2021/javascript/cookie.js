/**drop cookies */
function dropLoginCookie() {
    document.cookie = "keepLogEmail=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "KeepLogRole=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}