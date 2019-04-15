
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app'
});

//Dirty stopwatch JS
// var h1 = document.getElementsByTagName('h2')[0],
//     start = document.getElementById('start'),
//     stop = document.getElementById('stop'),
//     clear = document.getElementById('clear'),
//     seconds = 0, minutes = 0, hours = 0,
//     t;

// function add() {
//     seconds++;
//     if (seconds >= 60) {
//         seconds = 0;
//         minutes++;
//         if (minutes >= 60) {
//             minutes = 0;
//             hours++;
//         }
//     }

//     h1.textContent = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);

//     timer();
// }
// function timer() {
//     t = setTimeout(add, 1000);
// }
// timer();


// /* Start button */
// start.onclick = timer;

// /* Stop button */
// stop.onclick = function() {
//     clearTimeout(t);
// }

// /* Clear button */
// clear.onclick = function() {
//     h1.textContent = "00:00:00";
//     seconds = 0; minutes = 0; hours = 0;
// }



let timerDiv = document.getElementById('timer');
let start = document.getElementById('start');
let pause = document.getElementById('pause');
let stop = document.getElementById('stop');
let interval;

let seconds = 0;
let minutes = 0;
let hours = 0;

function tickTimer() {
    seconds++;
    if(seconds > 59) {
        seconds = 0;
        minutes++;
        if(minutes > 59) {
            minutes = 0;
            hours++;
        }
    }
    // console.log(hours + ":" + minutes + ":" + seconds);
    // minutes = formatTime(minutes);
    // seconds = formatTime(seconds);
    timeTemplate = hours + ":" + minutes + ":" + seconds;
    timeTemplate = (hours ? (hours > 9 ? hours : "0" + hours) : "00") + ":" + (minutes ? (minutes > 9 ? minutes : "0" + minutes) : "00") + ":" + (seconds > 9 ? seconds : "0" + seconds);
    timerDiv.textContent = timeTemplate;
}

function formatTime (n) {
  return (parseInt(n, 10) >= 10 ? '' : '0') + n
}

function launchTimer() {
    interval = setInterval(tickTimer, 1000); //tick every 1 second
}

function pauseTimer() {
    clearInterval(interval);
}

//bind events
start.onclick = launchTimer;

pause.onclick = function() {
    pauseTimer(interval);
}

stop.onclick = function() { //This must save the time instance to DB before cleaning things
    timerDiv.textContent = "00:00:00";
    seconds = 0; minutes = 0; hours = 0;
}

// launchTimer();
