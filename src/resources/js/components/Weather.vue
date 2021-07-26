<template>
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Weather</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ weather.temp }}</h6>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                'weather': [],
            }
        },
        mounted() {
            this.load();
        },
        methods: {
            load() {
                axios.get('/api/weather')
                    .then(response => {
                        this.weather = response.data.fact;
                    }).catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>
