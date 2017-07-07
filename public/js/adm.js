//custom Admin JS

var msg;
if (window.jQuery) {
    msg = 'You are running jQuery version: ' + jQuery.fn.jquery;
} else {
    msg = 'jQuery is not installed';
}
console.log(msg);
