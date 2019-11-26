<template>
    <div class="body" v-bind:class="theme">
        <leftmenu v-bind:theme="theme"></leftmenu>
        <projects v-bind:theme="theme"></projects>
        <tasks v-bind:theme="theme"></tasks>
        <bodypanel v-bind:theme="theme"></bodypanel>
    </div>
</template>

<script>
import Leftmenu from './body/Leftmenu';
import Projects from './body/projects/Projects';
import Tasks from './body/Tasks';
import Bodypanel from './body/Bodypanel';

export default {
    name: "Bodycontent",

    components: {
        Leftmenu,
        Projects,
        Tasks,
        Bodypanel
    }, 

    props: ["theme"]
}
</script>

<style scoped>
/* Body panel */
.body{
    display: flex;
    flex: 1;
}
.body.light{
    color: #718096;
    border-top: 1px solid #F7FAFC ;
}
.body.dark{
    color: #CBD5E0;
    border-top: 1px solid #1A202C;
}
</style>
