<template>
    <div>
        <h1>
            <span class="label label-primary">{{ hours }}</span> heures
            <span class="label label-primary">{{ minutes }}</span> minutes
            <span class="label label-primary">{{ secondes }}</span> secondes
        </h1>
        <button id ="start" @click="startTimer();startHidden = true;" v-if="!startHidden">Start</button>
        <button id ="action" @click="actionTimer">{{ actionButton }}</button>
        <button id ="action" @click="stopTimer">Stop</button>
    </div>
</template>

<script type="text/javascript">

    //VueJS stopwatch
export default {
    props: ['taskId', 'runningTimerSeconds', 'timerId'],
    data() {
          return {
                hours: 0,
                minutes: 0,
                secondes: 0,
                interval: null,
                startHidden: false,
                actionButton: "Pause"
            };
        },
    mounted() {
        console.log(this.runningTimerSeconds)
        console.log(this.timerId)
        // (runningTimerSeconds !== 0) ?
        // let res = this.calculateTimerValue(this.runningTimerSeconds);
        // console.log(res)
        // console.log(calculateTimerValue(this.runningTimerSeconds));
        let _this = this;
        let runningTimer = this.calculateTimerValue(this.runningTimerSeconds);
        this.hours = runningTimer.h;
        this.minutes = runningTimer.m;
        this.secondes = runningTimer.s;
        if(this.runningTimerSeconds !== 0) {
            this.interval = setInterval(function() {
                _this.tickTimer();
            }, 1000);
            //If current timer running hide start
            this.startHidden = true;
        }
    },
    methods: {
        startTimer() {
            let _this = this;
            this.interval = setInterval(function() {
                _this.tickTimer();
            }, 1000);
            //Send start request only if no timer is running
            axios.post('/timers', {
                    task_id: this.taskId
                }).then(function(response) {
                    console.log(response.data)
                    //Setting created timer id for the stop action
                    _this.timerId = response.data.timer.id;
                    //Reload page ?
                    // document.getElementById('timer_id').val = response.data.timer.id; //THIS IS WRONG !!!
                });
                // ).then(response => {
                //     this.posts = response.data;
                // });
        },
        actionTimer() {
            let _this = this;
            if(this.interval != null) {
                this.actionButton = "Start";
                clearInterval(this.interval);
                this.interval = null; //On clearInterval call nothing is returned, we need a way of tracking the pause
            } else {
                this.actionButton = "Pause";
                //it's been paused start it again
                this.interval = setInterval(function() {
                    _this.tickTimer();
                }, 1000);
            }
        },
        stopTimer() {
            axios.patch('/timers/'+this.timerId, {});
        },
        tickTimer() {
            this.secondes++;
            if(this.secondes > 59) {
                this.minutes++;
                this.secondes = 0;
                if(this.minutes > 59) {
                    this.hours++;
                    this.minutes = 0;
                }
            }
        },
        calculateTimerValue(totalSeconds) {
            // m = Math.floor(totalSeconds / 60);
            // s = totalSeconds - m * 60;
            // h = Math.floor(totalSeconds / 3600);
            let h = totalSeconds / 3600;
            let m = (totalSeconds % 3600) / 60;
            let s = totalSeconds % 60;
            return {s: Math.trunc(s), m: Math.trunc(m), h: Math.trunc(h)};
        }
    }
}

//Ajax post request example
//  export default {
//     props: ['user'],
//     data: function () {
//         return {
//             posts: []
//         };
//     },
//     mounted: function () {
//         this.getPosts();
//     },
//     methods: {
//         getPosts: function () {
//             axios.get('/posts')
//                 .then(response => {
//                     this.posts = response.data;
//                 });
//         }
//     }
// }
</script>
