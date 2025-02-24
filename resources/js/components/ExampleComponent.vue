<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body">
                        <p>This is an example Vue component.</p>
                        <button class="btn btn-primary" @click="incrementCount">
                            Count: {{ count }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ExampleComponent',
    data() {
        return {
            count: 0
        }
    },
    methods: {
        incrementCount() {
            this.count++
        }
    },
    mounted() {
        console.log('Example Component mounted.')
    }
}
</script>

<style scoped>
.card {
    margin-top: 20px;
}

.btn-primary {
    margin-top: 10px;
}
</style> 