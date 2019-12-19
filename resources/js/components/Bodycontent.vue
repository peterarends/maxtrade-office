<template>
    <div class="body" v-bind:class="theme">
        <leftmenu v-bind:theme="theme"></leftmenu>
        <projects-panel
            v-bind:theme="theme"
            @changeproject="changeProject"
        ></projects-panel>
        <tasks-panel v-bind:theme="theme"></tasks-panel>
        <div class="mainDivBodypanel" v-bind:class="theme">
            <properties
                v-show="panel == 'properties'"
                v-bind:theme="theme"
                v-bind:properties="properties"
                @changetheme="changeTheme"
                @closepanel="closePanel"
            ></properties>
            <projects 
                v-show="panel == 'projects'"
                v-bind:project="project"
                v-bind:theme="theme"
                @closepanel="closePanel"
            ></projects>
        </div>
    </div>
</template>

<script>
import Leftmenu from "./body/Leftmenu";
import ProjectsPanel from "./body/ProjectsPanel";
import TasksPanel from "./body/TasksPanel";
import Properties from "./body/Properties";
import Projects from './body/Projects';

export default {
    name: "Bodycontent",

    components: {
        Leftmenu,
        ProjectsPanel,
        TasksPanel,
        Properties,
        Projects
    },

    data() {
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
        changeProject(project) {
            this.project = project;
            this.$emit("showprojects");
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
