<template>
    <div>
        <h1>
            <span class="label label-primary">{{ hours }}</span> heures
            <span class="label label-primary">{{ minutes }}</span> minutes
            <span class="label label-primary">{{ secondes }}</span> secondes
        </h1>
        <button id ="start" @click="startTimer">Start</button>
        <button id ="pause" @click="pauseTimer">Pause</button>
    </div>
</template>

<script type="text/javascript">

    //VueJS stopwatch
export default {
    data: function() {
          return {
                hours: 0,
                minutes: 59,
                secondes: 40,
                interval: null
            };
        },
    mounted: function() {
        console.log(this.seconds);
    },
    methods: {
        startTimer() {
            console.log('click');
            let _this = this;
            // let hours = 0;
            // let minutes = 0;
            // let seconds = 0;
            this.interval = setInterval(function() {
                _this.tickTimer();
                // console.log(this.seconds)
            }, 1000);
        },
        pauseTimer() {
            clearInterval(this.interval);
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
