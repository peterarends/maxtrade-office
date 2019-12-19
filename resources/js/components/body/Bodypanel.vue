<template>
    <div class="mainDivBodypanel" v-bind:class="theme">
        <properties
            v-show="panel == 'properties'"
            v-bind:theme="theme"
            v-bind:properties="properties"
            @changetheme="changeTheme"
            @closepanel="closePanel"
        ></properties>
        <projects v-bind:project="project"></projects>
    </div>
</template>

<script>
import Properties from "./Properties";
import Projects from './Projects';

export default {
    name: "Bodypanel",

    components: {
        Properties,
        Projects
    },

    data() {
        return {
            activeItem: "properties"
        };
    },

    methods: {
        changeTheme(changed_theme) {
            this.$emit("changetheme", changed_theme);
        },
        closePanel() {
            this.$emit("closepanel");
        }
    },

    props: ["theme", "properties", "panel", "project"]
};
</script>

<style scoped>
/** Main div style */
.mainDivBodypanel {
    display: flex;
    flex: 1;
}
.mainDivBodypanel.light {
    background-color: #f7fafc;
}
.mainDivBodypanel.dark {
    background-color: #1a202c;
}
</style>
