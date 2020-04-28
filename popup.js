document.addEventListener('DOMContentLoaded', function() {

    // this part is executed when we press the START button.

    var start = document.getElementById('start');
    // onClick's logic below:
    start.addEventListener('click', function() {
        myfuncs();
    });
});


// this function sends the source url and the source title in the register form
function myfuncs()
{
   chrome.tabs.query({active : true, 'lastFocusedWindow': true}, function (tabs) {
    document.getElementById("s").value = tabs[0].url;
document.getElementById("stitle").value = tabs[0].title;

    // the status field of the form is filled with value 0
   document.getElementById("st").value = 0;

});
  
}

document.addEventListener('DOMContentLoaded', function() {

    // this part is executed when we press the STOP button.

    var stop = document.getElementById('stop');
    // onClick's logic below:
    stop.addEventListener('click', function() {
        myfuncd();
    });
});

// this function sends the destination url and the destination title in the register form
function myfuncd()
{
   chrome.tabs.query({active : true, 'lastFocusedWindow': true}, function (tabs) {
    document.getElementById("d").value = tabs[0].url;
document.getElementById("dtitle").value = tabs[0].title;

    // the status field of the form is filled with value 1
    document.getElementById("st").value = 1;

});
   
}

document.addEventListener('DOMContentLoaded', function() {

    // this part is executed when we press the QUIT button.

    var quit = document.getElementById('quit');
    // onClick's logic below:
    quit.addEventListener('click', function() {
        myfuncq();
    });
});

// this function sends the last url and the last title in the register form
function myfuncq()
{
   chrome.tabs.query({active : true, 'lastFocusedWindow': true}, function (tabs) {
    document.getElementById("q").value = tabs[0].url;
    document.getElementById("qtitle").value = tabs[0].title;

    // the status field of the form is filled with value 2
    document.getElementById("st").value = 2;

});
   
}
