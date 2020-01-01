<template>
    <div class="mainDiv" v-bind:class="getTheme">
        <!-- Start Top panel -->
        <top-bar></top-bar>
        <!-- End Top panel -->
        <!-- Start Body panel -->
        <div class="body" v-bind:class="getTheme">
            <leftmenu></leftmenu>
            <projects-panel></projects-panel>
            <tasks-panel></tasks-panel>
            <div class="mainDivBodypanel" v-bind:class="getTheme">
                <properties v-show="getPanel == 'properties'"></properties>
                <about v-show="getPanel == 'about'"></about>
                <projects v-show="getPanel == 'projects'"></projects>
                <tasks v-show="getPanel == 'tasks'"></tasks>
            </div>
        </div>
        <!-- End body panel -->
        <!-- Start Footer panel -->
        <div class="footerMainDiv" v-bind:class="getTheme">
            <div class="footer-icon">
                <!--Header icon-->
                <div><i class="mdi mdi-server-network serverIcon"></i></div>
                <div class="separator-vertical" v-bind:class="getTheme"></div>
                <div>
                    MaxtradeOffice ver: <span>{{ version }}</span>
                </div>
                <div class="separator-vertical" v-bind:class="getTheme"></div>
                <div class="projects-panel-title-dot">
                    <i class="fas fa-circle"></i>
                </div>
                <div>
                    <!-- Projects: <span>{{ projects.length }}</span> -->
                </div>
                <div class="separator-vertical" v-bind:class="getTheme"></div>
                <div class="tasks-panel-title-dot">
                    <i class="fas fa-circle"></i>
                </div>
                <div>
                    Tasks: <span>{{ getTasks.length }}</span>
                </div>
                <div class="separator-vertical" v-bind:class="getTheme"></div>
            </div>
        </div>
        <!-- End Footer panel -->
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
        About
    },

    data() {
        return {
            version: "1.0.1"
        };
    },

    created() {
        this.fetchProperties();
    },

    computed: mapGetters([
        "getTheme",
        "getCurrentProjectId",
        "getCurrentTaskId",
        "getPanel"
    ]),

    methods: {
        ...mapActions([
            "fetchProperties",
            "exitProgram",
            "showProperties",
            "showAbout",
            "addProject",

            "completeProject",
            "showAllProjects",
            "showCompletedProjects",
            "showActivedProjects",
            "sortProjectsIdAcc",
            "sortProjectsIdDec",
            "sortProjectsNameAcc",
            "sortProjectsNameDec",
            "completeTask",
            "showAllTasks",
            "showCompletedTasks",
            "showActivedTasks",
            "sortTasksIdAcc",
            "sortTasksIdDec",
            "sortTasksNameAcc",
            "sortTasksNameDec",
            "deleteProject",
            "addTask",
            "deleteTask",
            "changeProject",
            "toggleProjectIdFilter",
            "toggleProjectNameFilter",
            "toggleProjectStatusFilter",
            "fetchProjectsSearch",
            "changeTask",
            "toggleTaskIdFilter",
            "toggleTaskNameFilter",
            "toggleTaskStatusFilter",
            "fetchTasksSearch",
            "changeDocuments",
            "deleteDocument",
            "getTasks"
        ])

        // // Projects actions
        // // Add new project
        // addProject() {
        //     const newProject = {
        //         id:
        //             Math.max.apply(
        //                 Math,
        //                 this.projects.map(function(o) {
        //                     return o.id;
        //                 })
        //             ) + 1,
        //         title: "Name of new Project",
        //         body: "Description of new Project",
        //         created_at: moment().format(),
        //         updated_at: "",
        //         status: 1
        //     };
        //     this.projects.unshift(newProject);
        //     this.project = newProject;
        //     //this.current_project_id = newProject.id;
        //     this.new_project = true;
        //     this.panel = "projects";
        //     this.saveProject(false);
        // },

        // // Show About panel
        // showAbout() {
        //     this.panel = "about";
        // },

        // // Other system staff
        // // Close all panels and unset current projects
        // closePanel() {
        //     //this.current_task_id = 0;
        //     this.tasks = [];
        //     //this.current_project_id = 0;
        //     this.panel = "";
        // },
        // // Exit the program
        // exit: function(event) {
        //     window.location = "/logout.html";
        // }
    }
};
</script>

<style>
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

/** Start Footer panel */
.footerMainDiv {
    display: flex;
    align-items: center;
    height: 2rem;
}
.footerMainDiv.dark {
    color: #e2e8f0;
    background-color: #2d3748;
}
.footerMainDiv.light {
    color: #4a5568;
    background-color: #edf2f7;
}
.serverIcon {
    font-size: 1.25rem;
}
.footer-icon {
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 10px;
    padding-right: 2px;
}
.footer-icon div:first-child {
    width: 32px;
    text-align: center;
}
.button {
    padding: 3px 8px;
    background: #2d3748;
    border: 1px solid #4a5568;
    border-radius: 5px;
}
/* End Footer panel */
</style>
