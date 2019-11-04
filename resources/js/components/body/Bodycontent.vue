<template>
    <div class="body">
        <leftmenu></leftmenu>
        <projects></projects>
        <tasks></tasks>
        <bodypanel></bodypanel>
    </div>
</template>

<script>
import Leftmenu from './Leftmenu';
import Projects from './projects/Projects';
import Tasks from './Tasks';
import Bodypanel from './Bodypanel';

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
