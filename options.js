// Again ignore this for now too
// Changes made on the options.html page will be reflected here

function save() {
    var data = {};
    data[this.id] = this.value;
    chrome.storage.local.set(data);
}

function restore_options() {
    chrome.storage.local.get({
        callback: 'http://localhost/dashboard/',
        key: 'chrome'
    }, function(options) {
        document.getElementById('callback').value = options.callback;
        document.getElementById('key').value = options.key;
    });
}

// If any of the callback or url values are changed, save them as defaults immediately
document.getElementById('callback').addEventListener('change', save);
document.getElementById('key').addEventListener('change', save);
document.addEventListener('DOMContentLoaded', restore_options);
