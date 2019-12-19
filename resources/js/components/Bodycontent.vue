<template>
    <div class="body" v-bind:class="theme">
        <leftmenu v-bind:theme="theme"></leftmenu>
        <projects-panel 
            v-bind:theme="theme"
            @changeproject="changeProject"
        ></projects-panel>
        <tasks-panel v-bind:theme="theme"></tasks-panel>
        <bodypanel
            v-bind:theme="theme"
            v-bind:properties="properties"
            v-bind:panel="panel"
            v-bind:project="project"
            @changetheme="changeTheme"
            @closepanel="closePanel"
        ></bodypanel>
    </div>
</template>

<script>
import Leftmenu from "./body/Leftmenu";
import ProjectsPanel from "./body/ProjectsPanel";
import TasksPanel from "./body/TasksPanel";
import Bodypanel from "./body/Bodypanel";

export default {
    name: "Bodycontent",

    components: {
        Leftmenu,
        ProjectsPanel,
        TasksPanel,
        Bodypanel
    },

    data(){
        return {
            project: {
                id: "",
                title: "",
                body: "",
                status
            }
        };
    },

    methods: {
        changeTheme(changed_theme) {
            this.$emit("changetheme", changed_theme);
        },
        closePanel() {
            this.$emit("closepanel");
        },
        changeProject(project){
            this.project = project;
        }
    },

    props: ["theme", "properties", "panel"]
};
</script>

<style scoped>
/* Body panel */
.body {
    display: flex;
    flex: 1;
}
.body.light {
    color: #718096;
    border-top: 1px solid #f7fafc;
}
.body.dark {
    color: #cbd5e0;
    border-top: 1px solid #1a202c;
}
</style>
