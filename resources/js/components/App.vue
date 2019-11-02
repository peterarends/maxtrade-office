<template>
    <div class="flex w-full">
        <div class="w-1/4">
            <projects></projects>
        </div>
        <div>
            <h1>Tasks Panel</h1>
        </div>
    </div>
</template>

<script>
import Projects from './Projects';

export default {
    name: "App",
    components: {
        Projects
    }
}
</script>

<style>

</style>
