<template>
    <div class="body">
        <leftmenu></leftmenu>
        <projects></projects>
        <tasks></tasks>
        <bodypanel></bodypanel>
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
    }
}
</script>

<style scoped>
/* Body panel */
.body{
    display: flex;
    flex: 1;
    color: #868686;
    border-top: 1px solid #212121;
}
</style>
