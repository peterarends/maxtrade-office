<template>
    <div class="mainDiv" :class="getTheme">
        <top-bar></top-bar>
        <!-- Start Body panel -->
        <div class="body" :class="getTheme">
            <leftmenu></leftmenu>
            <projects-panel></projects-panel>
            <tasks-panel></tasks-panel>
            <div class="mainDivBodypanel" :class="getTheme">
                <properties v-show="getPanel == 'properties'"></properties>
                <projects v-show="getPanel == 'projects'"></projects>
                <tasks v-show="getPanel == 'tasks'"></tasks>
                <about v-show="getPanel == 'about'"></about>
            </div>
        </div>
        <!-- End body panel -->
        <footer-bar></footer-bar>
    </div>
</template>

<script>
import Vue from "vue";
import TopBar from "./body/TopBar";
import Leftmenu from "./body/Leftmenu";
import ProjectsPanel from "./body/ProjectsPanel";
import TasksPanel from "./body/TasksPanel";
import Properties from "./body/Properties";
import Projects from "./body/Projects";
import Tasks from "./body/Tasks";
import About from "./body/About";
import FooterBar from "./body/FooterBar";
import { mapGetters, mapActions } from "vuex";

export default {
    name: "App",

    components: {
        TopBar,
        Leftmenu,
        ProjectsPanel,
        TasksPanel,
        Properties,
        Projects,
        Tasks,
        About,
        FooterBar
    },

    created() {
        this.fetchProperties();
    },

    computed: mapGetters(["getTheme", "getPanel"]),

    methods: {
        ...mapActions(["fetchProperties"])
    }
};
</script>

<style>
.mainDiv {
    display: flex;
    flex-direction: column;
    height: 100%;
}
.mainDiv.light {
    background-color: #fff;
}
.mainDiv.dark {
    background-color: #000;
}
/* Start Body panel */
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
/* End Body panel */
/* Projects and Tasks List View */
h1 {
    font-size: 28px;
}
h2 {
    font-size: 24px;
}
h3 {
    font-size: 20px;
}
h4 {
    font-size: 18px;
}
h5 {
    font-size: 16px;
}
.list-dot {
    color: #4682b4;
    font-size: 12px;
    padding-right: 5px;
}
.list-dot-task {
    color: #ff8c00;
    font-size: 12px;
    padding-right: 5px;
}
.list-dot-task.ended {
    color: #868686;
}
.list-name {
    display: table-cell;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    height: 20px;
    font-weight: 600;
}
.list-description {
    display: block;
    overflow: hidden;
    height: 40px;
    font-size: 12px;
}
.list-date {
    font-size: 11px;
}
.list-project-name {
    font-size: 11px;
    padding-left: 5px;
    font-weight: 600;
    color: #4682b4;
}
.list-data {
    font-size: 11px;
    padding-left: 5px;
}
.list-paragraph {
    padding: 3px 0px;
}
/* tools */
.separator-vertical {
    margin: 0px 5px 0px 5px;
    height: 26px;
}
.separator-vertical.light {
    border-left: 1px solid #e2e8f0;
    border-right: 1px solid #f7fafc;
}
.separator-vertical.dark {
    border-left: 1px solid #4a5568;
    border-right: 1px solid #1a202c;
}
.projects-panel-title-dot {
    color: #4682b4;
    font-size: 12px;
    padding-right: 5px;
}
.tasks-panel-title-dot {
    color: #ff8c00;
    font-size: 12px;
    padding-right: 5px;
}
/* scroll bar */
::-webkit-scrollbar {
    width: 10px;
}
::-webkit-scrollbar-track {
    background: #1a202c;
}
::-webkit-scrollbar-thumb {
    background: #2d3748;
}
::-webkit-scrollbar-thumb:hover {
    background: #4a5568;
}
.vp20 {
    padding: 20px 0px;
}
</style>
