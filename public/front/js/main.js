$(function () {
    $('a[href^="#"]').click(function(e) {
        e.preventDefault()
        let target = $(this).attr('href');
        $('html').animate({scrollTop: $(target).offset().top - 130 }, 900);
    })
})

Storage.prototype.setObj = function(key, obj) {
    return this.setItem(key, JSON.stringify(obj))
}

Storage.prototype.getObj = function(key) {
    return JSON.parse(this.getItem(key))
}

/**
 * @param arr
 * @param toRemove
 * @returns {*}
 */
function remove(arr, toRemove){
    return arr.filter(function(el) {
        return el !== toRemove
    });
}

/**
 * @param value
 * @param index
 * @param self
 * @returns {boolean}
 */
function onlyUnique(value, index, self) {
    return self.indexOf(value) === index;
}

/**
 * @param name
 * @param value
 * @param days
 */
function setCookie(name, value, days) {
    let expires = "";

    if (days) {
        let date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }

    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
