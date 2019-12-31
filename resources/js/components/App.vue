<template>
    <div class="mainDiv" v-bind:class="getTheme">
        <!-- Start Top panel -->
        <div>
            <div class="generalStyleDiv" v-bind:class="getTheme">
                <!--Header, icon, menu, title ...-->
                <div class="iconDiv">
                    <!--Header icon-->
                    <img src="/images/maxtradeoffice.png" class="iconImg" />
                </div>
                <div class="contentDiv" v-bind:class="getTheme">
                    <!--Main menu-->
                    <div id="cssmenu" v-bind:class="getTheme">
                        <ul>
                            <li class="has-sub">
                                <a><span>File</span></a>
                                <ul>
                                    <li>
                                        <a>
                                            <div
                                                class="mnu-flex"
                                                v-on:click="exitProgram"
                                            >
                                                <i
                                                    class="mdi mdi-location-exit mdiExitIcon"
                                                    v-bind:class="getTheme"
                                                ></i
                                                >&nbsp;<span>Exit</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a><span>Projects</span></a>
                                <ul>
                                    <li>
                                        <a v-on:click.prevent="addProject">
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteProjectIcon"
                                                    v-bind:class="getTheme"
                                                ></i
                                                >&nbsp;<span>Add Project</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a v-on:click.prevent="deleteProject">
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-delete mdiAddEditDeleteProjectIcon"
                                                    v-bind:class="getTheme"
                                                ></i
                                                >&nbsp;<span
                                                    >Delete Project</span
                                                >
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a v-on:click.prevent="addTask">
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                                                    v-bind:class="getTheme"
                                                ></i
                                                >&nbsp;<span>Add Task</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a v-on:click="completeProject"
                                            ><span>Complete Project</span></a
                                        >
                                    </li>
                                    <li class="has-sub">
                                        <a><span>Projects Filter</span></a>
                                        <ul>
                                            <li>
                                                <a v-on:click="showAllProjects"
                                                    ><span
                                                        >All Projects</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    v-on:click="
                                                        showCompletedProjects
                                                    "
                                                    ><span
                                                        >Completed
                                                        Projects</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    v-on:click="
                                                        showActivedProjects
                                                    "
                                                    ><span
                                                        >Actived Projects</span
                                                    ></a
                                                >
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-sub">
                                        <a><span>Projects Sort</span></a>
                                        <ul>
                                            <li>
                                                <a
                                                    v-on:click="
                                                        sortProjectsIdAcc
                                                    "
                                                    ><span
                                                        >Id Ascending</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    v-on:click="
                                                        sortProjectsIdDec
                                                    "
                                                    ><span
                                                        >Id Descending</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    v-on:click="
                                                        sortProjectsNameAcc
                                                    "
                                                    ><span>Name A-Z</span></a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    v-on:click="
                                                        sortProjectsNameDec
                                                    "
                                                    ><span>Name Z-A</span></a
                                                >
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a><span>Tasks</span></a>
                                <ul>
                                    <li>
                                        <a v-on:click.prevent="addTask">
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                                                    v-bind:class="getTheme"
                                                ></i
                                                >&nbsp;<span>Add Task</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a v-on:click.prevent="deleteTask">
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-delete mdiAddEditDeleteTaskIcon"
                                                    v-bind:class="getTheme"
                                                ></i
                                                >&nbsp;<span>Delete Task</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a v-on:click="completeTask"
                                            ><span>Complete Task</span></a
                                        >
                                    </li>
                                    <li class="has-sub">
                                        <a><span>Tasks Filter</span></a>
                                        <ul>
                                            <li>
                                                <a v-on:click="showAllTasks"
                                                    ><span>All Tasks</span></a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    v-on:click="
                                                        showCompletedTasks
                                                    "
                                                    ><span
                                                        >Completed Tasks</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a v-on:click="showActivedTasks"
                                                    ><span
                                                        >Actived Tasks</span
                                                    ></a
                                                >
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="has-sub">
                                        <a><span>Tasks Sort</span></a>
                                        <ul>
                                            <li>
                                                <a v-on:click="sortTasksIdAcc"
                                                    ><span
                                                        >Id Ascending</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a v-on:click="sortTasksIdDec"
                                                    ><span
                                                        >Id Descending</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a v-on:click="sortTasksNameAcc"
                                                    ><span>Name A-Z</span></a
                                                >
                                            </li>
                                            <li>
                                                <a v-on:click="sortTasksNameDec"
                                                    ><span>Name Z-A</span></a
                                                >
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a><span>Tools</span></a>
                                <ul>
                                    <li id="mnuOptions">
                                        <a>
                                            <div
                                                class="mnu-flex"
                                                @click="showProperties($event)"
                                            >
                                                <i
                                                    class="mdi mdi-tools standardSizeIcon"
                                                    v-bind:class="getTheme"
                                                ></i
                                                >&nbsp;<span>Options</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a><span>Help</span></a>
                                <ul>
                                    <li>
                                        <a>
                                            <div
                                                class="mnu-flex"
                                                @click="showAbout()"
                                            >
                                                <i
                                                    class="mdi mdi-information-variant standardSizeIcon"
                                                    v-bind:class="getTheme"
                                                ></i
                                                >&nbsp;<span>About</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="topTitleDiv" v-bind:class="getTheme">
                    <!--Window title-->
                    <span>MaxtradeOffice</span>
                </div>
                <div class="topRightIcons">
                    <!--Window title icons-->
                    <div class="minMaxIcons" v-bind:class="getTheme">
                        <img src="/images/minimize.png" />
                    </div>
                    <div class="minMaxIcons" v-bind:class="getTheme">
                        <img src="/images/maximize.png" />
                    </div>
                    <div
                        class="rightExitIcon"
                        v-bind:class="getTheme"
                        v-on:click="exitProgram"
                    >
                        <img src="/images/close.png" />
                    </div>
                </div>
            </div>
            <div class="button-bar" v-bind:class="getTheme">
                <button v-on:click="exitProgram" title="Exit this program">
                    <i
                        class="mdi mdi-location-exit mdiExitIcon"
                        v-bind:class="getTheme"
                    ></i>
                </button>
                <button v-on:click="addProject">
                    <i
                        class="mdi mdi-plus-circle-outline mdiAddEditDeleteProjectIcon"
                        v-bind:class="getTheme"
                    ></i
                    >&nbsp;Add Project
                </button>
                <button
                    :disabled="getCurrentProjectId == 0"
                    v-on:click="deleteProject"
                >
                    <i
                        class="mdi mdi-delete mdiAddEditDeleteProjectIcon"
                        v-bind:class="getTheme"
                    ></i
                    >&nbsp;Delete Project
                </button>
                <button
                    v-on:click="addTask"
                    :disabled="getCurrentProjectId == 0"
                >
                    <i
                        class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                        v-bind:class="getTheme"
                    ></i
                    >&nbsp;Add Task
                </button>
                <button
                    :disabled="getCurrentTaskId == 0"
                    v-on:click="deleteTask"
                >
                    <i
                        class="mdi mdi-delete mdiAddEditDeleteTaskIcon"
                        v-bind:class="getTheme"
                    ></i
                    >&nbsp;Delete Task
                </button>
            </div>
        </div>
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
import moment from "moment";
import Leftmenu from "./body/Leftmenu";
import ProjectsPanel from "./body/ProjectsPanel";
import TasksPanel from "./body/TasksPanel";
import Properties from "./body/Properties";
import Projects from "./body/Projects";
import Tasks from "./body/Tasks";
import About from "./body/About";
import { mapGetters, mapActions } from "vuex";

// This variable will hold the reference to
// document's click handler
let handleOutsideClick;

Vue.directive("closable", {
    bind(el, binding, vnode) {
        // Here's the click/touchstart handler
        // (it is registered below)
        handleOutsideClick = e => {
            e.stopPropagation();
            // Get the handler method name and the exclude array
            // from the object used in v-closable
            const { handler, exclude } = binding.value;

            // This variable indicates if the clicked element is excluded
            let clickedOnExcludedEl = false;
            exclude.forEach(refName => {
                // We only run this code if we haven't detected
                // any excluded element yet
                if (!clickedOnExcludedEl) {
                    // Get the element using the reference name
                    const excludedEl = vnode.context.$refs[refName];
                    // See if this excluded element
                    // is the same element the user just clicked on
                    clickedOnExcludedEl = excludedEl.contains(e.target);
                }
            });

            // We check to see if the clicked element is not
            // the dialog element and not excluded
            if (!el.contains(e.target) && !clickedOnExcludedEl) {
                // If the clicked element is outside the dialog
                // and not the button, then call the outside-click handler
                // from the same component this directive is used in
                vnode.context[handler]();
            }
        };
        // Register click/touchstart event listeners on the whole page
        document.addEventListener("click", handleOutsideClick);
        document.addEventListener("touchstart", handleOutsideClick);
    },

    unbind() {
        // If the element that has v-closable is removed, then
        // unbind click/touchstart listeners from the whole page
        document.removeEventListener("click", handleOutsideClick);
        document.removeEventListener("touchstart", handleOutsideClick);
    }
});

export default {
    name: "App",

    components: {
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
            "addProject",
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
        // // Save project changes back to DB
        // saveProject(isMessage) {
        //     fetch("api/project", {
        //         method: this.new_project ? "POST" : "PUT",
        //         body: JSON.stringify({
        //             project_id: this.new_project ? 0 : this.project.id,
        //             title: this.project.title,
        //             body: this.project.body,
        //             status: this.project.status
        //         }),
        //         headers: { "Content-Type": "application/json; charset=utf-8" }
        //     })
        //         .then(res => res.json())
        //         .then(res => {
        //             this.project.id = res.data.id;
        //             this.project.title = res.data.title;
        //             this.project.body = res.data.body;
        //             this.project.created_at = res.data.created_at;
        //             this.project.updated_at = res.data.updated_at;
        //             this.project.status = res.data.status;
        //             this.new_project = false;
        //             //this.current_project_id = res.data.id;
        //             if (isMessage) {
        //                 alert(
        //                     "You have successfully saved the changes to the Project: " +
        //                         res.data.title
        //                 );
        //             }
        //             // change all task status by project
        //             if (this.project.status == 0) {
        //                 fetch("api/task/complete/" + this.project.id, {
        //                     method: "GET"
        //                 }).catch(err => console.log(err));
        //                 this.getTasks().forEach(function(part, index) {
        //                     part.status = 0;
        //                 });
        //             }
        //         })
        //         .catch(err => console.log(err));
        // },
        // // Delete current project
        // deleteProject() {
        //     if (this.getCurrentProjectId() != 0) {
        //         if (confirm("Are You sure?")) {
        //             fetch("api/project/" + this.project.id, {
        //                 method: "DELETE",
        //                 body: JSON.stringify({
        //                     project_id: this.project.id
        //                 }),
        //                 headers: {
        //                     "Content-Type": "application/json; charset=utf-8"
        //                 }
        //             })
        //                 .then(res => res.json())
        //                 .then(res => {
        //                     this.projects = this.projects.filter(
        //                         p => p.id !== res.data.id
        //                     );
        //                     //this.current_project_id = 0;
        //                     //this.current_task_id = 0;
        //                     //this.tasks = [];
        //                     //this.panel = "";
        //                 })
        //                 .catch(err => console.log(err));
        //         }
        //     }
        // },
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
        // completeProject() {
        //     if (this.getCurrentProjectId() != 0) {
        //         this.project.status = 0;
        //         this.saveProject(false);
        //     }
        // },
        // sortProjectsIdAcc() {
        //     this.project_filter.filter09 = true;
        //     this.projects.sort(function(a, b) {
        //         if (a.id > b.id) return 1;
        //         if (a.id < b.id) return -1;
        //     });
        // },
        // sortProjectsIdDec() {
        //     this.project_filter.filter09 = false;
        //     this.projects.sort(function(a, b) {
        //         if (a.id > b.id) return -1;
        //         if (a.id < b.id) return 1;
        //     });
        // },
        // sortProjectsNameAcc() {
        //     this.project_filter.filteraz = true;
        //     this.projects.sort(function(a, b) {
        //         if (a.title > b.title) return 1;
        //         if (a.title < b.title) return -1;
        //     });
        // },
        // sortProjectsNameDec() {
        //     this.project_filter.filteraz = false;
        //     this.projects.sort(function(a, b) {
        //         if (a.title > b.title) return -1;
        //         if (a.title < b.title) return 1;
        //     });
        // },
        // showAllProjects() {
        //     this.project_filter.filterstatus = "all";
        //     this.fetchProjects("all");
        // },
        // showCompletedProjects() {
        //     this.project_filter.filterstatus = "end";
        //     this.fetchProjects("end");
        // },
        // showActivedProjects() {
        //     this.project_filter.filterstatus = "act";
        //     this.fetchProjects("act");
        // },

        // // Tasks actions
        // // Fetch all tasks from DB and set to TasksPanel
        // fetchTasks(_status, _project_id) {
        //     fetch("api/tasks/" + _status + "/" + _project_id)
        //         .then(res => res.json())
        //         .then(res => {
        //             //this.tasks = res.data;
        //         })
        //         .catch(err => console.log(err));
        // },
        // // Open task in Task panel
        // changeTask(task) {
        //     this.task = task;
        //     //this.current_task_id = task.id;
        //     this.new_task = false;
        //     // Get documents
        //     fetch("api/task/documents/" + task.id)
        //         .then(res => res.json())
        //         .then(res => {
        //             this.documents = res;
        //         })
        //         .catch(err => console.log(err));
        //     //this.panel = "tasks";
        // },
        // // Save task changes back to DB
        // saveTask(isMessage) {
        //     fetch("api/task", {
        //         method: this.new_task ? "POST" : "PUT",
        //         body: JSON.stringify({
        //             task_id: this.new_task ? 0 : this.task.id,
        //             project_id: this.getCurrentProjectId(),
        //             title: this.task.title,
        //             body: this.task.body,
        //             status: this.task.status
        //         }),
        //         headers: { "Content-Type": "application/json; charset=utf-8" }
        //     })
        //         .then(res => res.json())
        //         .then(res => {
        //             this.task.id = res.data.id;
        //             this.task.title = res.data.title;
        //             this.task.body = res.data.body;
        //             this.task.created_at = res.data.created_at;
        //             this.task.updated_at = res.data.updated_at;
        //             this.task.status = res.data.status;
        //             this.new_task = false;
        //             //this.current_task_id = res.data.id;
        //             if (isMessage) {
        //                 alert(
        //                     "You have successfully saved the changes to the Task: " +
        //                         res.data.title
        //                 );
        //             }
        //         })
        //         .catch(err => console.log(err));
        // },
        // // Delete current task
        // deleteTask() {
        //     if (this.getCurrentTaskId() != 0) {
        //         if (confirm("Are You sure?")) {
        //             fetch("api/task/" + this.task.id, {
        //                 method: "DELETE",
        //                 body: JSON.stringify({
        //                     task_id: this.task.id
        //                 }),
        //                 headers: {
        //                     "Content-Type": "application/json; charset=utf-8"
        //                 }
        //             })
        //                 .then(res => res.json())
        //                 .then(res => {
        //                     alert(
        //                         "You have successfully delete the Task: " +
        //                             res.data.title
        //                     );
        //                     // this.tasks = this.tasks.filter(
        //                     //     t => t.id !== res.data.id
        //                     // );
        //                     //this.current_task_id = 0;
        //                     this.panel = "";
        //                 })
        //                 .catch(err => console.log(err));
        //         }
        //     }
        // },
        // // Add new task
        // addTask() {
        //     if (this.getCurrentProjectId() != 0) {
        //         const newTask = {
        //             id:
        //                 Math.max.apply(
        //                     Math,
        //                     this.tasks.map(function(o) {
        //                         return o.id;
        //                     })
        //                 ) + 1,
        //             project_id: this.getCurrentProjectId(),
        //             title: "Name of new Task",
        //             body: "Description of new Task",
        //             created_at: moment().format(),
        //             updated_at: "",
        //             status: 1
        //         };
        //         this.tasks.unshift(newTask);
        //         this.task = newTask;
        //         //this.current_task_id = newTask.id;
        //         this.new_task = true;
        //         this.panel = "tasks";
        //         this.saveTask(false);
        //     }
        // },
        // completeTask() {
        //     if (this.getCurrentTaskId() != 0) {
        //         this.task.status = 0;
        //         this.saveTask(false);
        //     }
        // },
        // toggleTaskIdFilter() {
        //     this.task_filter.filter09 = !this.task_filter.filter09;
        //     if (this.task_filter.filter09) {
        //         this.tasks.sort(function(a, b) {
        //             if (a.id > b.id) return 1;
        //             if (a.id < b.id) return -1;
        //         });
        //     } else {
        //         this.tasks.sort(function(a, b) {
        //             if (a.id > b.id) return -1;
        //             if (a.id < b.id) return 1;
        //         });
        //     }
        // },
        // sortTasksIdAcc() {
        //     this.task_filter.filter09 = true;
        //     this.tasks.sort(function(a, b) {
        //         if (a.id > b.id) return -1;
        //         if (a.id < b.id) return 1;
        //     });
        // },
        // sortTasksIdDec() {
        //     this.task_filter.filter09 = false;
        //     this.tasks.sort(function(a, b) {
        //         if (a.id > b.id) return 1;
        //         if (a.id < b.id) return -1;
        //     });
        // },
        // toggleTaskNameFilter() {
        //     this.task_filter.filteraz = !this.task_filter.filteraz;
        //     if (this.task_filter.filteraz) {
        //         this.tasks.sort(function(a, b) {
        //             if (a.title > b.title) return 1;
        //             if (a.title < b.title) return -1;
        //         });
        //     } else {
        //         this.tasks.sort(function(a, b) {
        //             if (a.title > b.title) return -1;
        //             if (a.title < b.title) return 1;
        //         });
        //     }
        // },
        // sortTasksNameAcc() {
        //     this.task_filter.filteraz = true;
        //     this.tasks.sort(function(a, b) {
        //         if (a.title > b.title) return 1;
        //         if (a.title < b.title) return -1;
        //     });
        // },
        // sortTasksNameDec() {
        //     this.task_filter.filteraz = false;
        //     this.tasks.sort(function(a, b) {
        //         if (a.title > b.title) return -1;
        //         if (a.title < b.title) return 1;
        //     });
        // },
        // toggleTaskStatusFilter() {
        //     if (this.task_filter.filterstatus == "all") {
        //         this.task_filter.filterstatus = "act";
        //         this.fetchTasks("act", this.getCurrentProjectId());
        //     } else {
        //         if (this.task_filter.filterstatus == "act") {
        //             this.task_filter.filterstatus = "end";
        //             this.fetchTasks("end", this.getCurrentProjectId());
        //         } else {
        //             if (this.task_filter.filterstatus == "end") {
        //                 this.task_filter.filterstatus = "all";
        //                 this.fetchTasks("all", this.getCurrentProjectId());
        //             }
        //         }
        //     }
        // },
        // showAllTasks() {
        //     this.task_filter.filterstatus = "all";
        //     this.fetchTasks("all", this.getCurrentProjectId());
        // },
        // showActivedTasks() {
        //     this.task_filter.filterstatus = "act";
        //     this.fetchTasks("act", this.getCurrentProjectId());
        // },
        // showCompletedTasks() {
        //     this.task_filter.filterstatus = "end";
        //     this.fetchTasks("end", this.getCurrentProjectId());
        // },
        // // Fetch all tasks from DB width search
        // fetchTasksSearch(_text) {
        //     fetch("api/tasks/search/" + this.getCurrentProjectId(), {
        //         method: "POST",
        //         body: JSON.stringify({
        //             search: _text
        //         }),
        //         headers: { "Content-Type": "application/json; charset=utf-8" }
        //     })
        //         .then(res => res.json())
        //         .then(res => {
        //             this.tasks = res.data;
        //         })
        //         .catch(err => console.log(err));
        // },
        // changeDocuments() {
        //     fetch("api/task/documents/" + this.task.id)
        //         .then(res => res.json())
        //         .then(res => {
        //             this.documents = res;
        //         })
        //         .catch(err => console.log(err));
        // },
        // deleteDocument(current_document) {
        //     fetch(
        //         "api/task/document/delete/" +
        //             this.task.id +
        //             "/" +
        //             current_document,
        //         {
        //             method: "DELETE"
        //         }
        //     )
        //         .then(res => res.json())
        //         .then(res => {
        //             if (res.result === "success") {
        //                 this.changeDocuments();
        //             } else {
        //                 alert("Document cannot be deleted!");
        //             }
        //         })
        //         .catch(err => console.log(err));
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
/* Start Top panel */
.generalStyleDiv {
    display: flex;
    align-items: center;
    height: 2rem;
    border-bottom-width: 1px;
}
.generalStyleDiv.light {
    background-color: #e2e8f0;
    border-color: #cbd5e0;
}
.generalStyleDiv.dark {
    background-color: #4a5568;
    border-color: #718096;
}
.iconDiv {
    display: flex;
    align-items: center;
    justify-content: center;
    padding-right: 0.75rem;
    padding-left: 0.75rem;
}
.iconImg {
    width: 1.5rem;
    height: 1.5rem;
    margin-right: auto;
    margin-left: auto;
}
.contentDiv {
    display: flex;
    align-items: center;
    justify-content: center;
    padding-right: 0.5rem;
}
.contentDiv.light {
    color: #4a5568;
}
.contentDiv.dark {
    color: #e2e8f0;
}
.mdiExitIcon {
    font-size: 1.5rem;
}
.mdiExitIcon.light {
    color: #fc8181;
}
.mdiExitIcon.dark {
    color: #e53e3e;
}
.mdiAddEditDeleteProjectIcon {
    font-size: 1.5rem;
}
.mdiAddEditDeleteProjectIcon.light {
    color: #63b3ed;
}
.mdiAddEditDeleteProjectIcon.dark {
    color: #3182ce;
}
.mdiAddEditDeleteTaskIcon {
    font-size: 1.5rem;
}
.mdiAddEditDeleteTaskIcon.light {
    color: #f6ad55;
}
.mdiAddEditDeleteTaskIcon.dark {
    color: #dd6b20;
}
.standardSizeIcon {
    font-size: 1.5rem;
}
.topTitleDiv {
    text-align: center;
    flex-grow: 1;
    font-size: 1.25rem;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    color: #e2e8f0;
}
.topTitleDiv.light {
    color: #4a5568;
}
.topTitleDiv.dark {
    color: #e2e8f0;
}
.topRightIcons {
    display: flex;
    align-items: center;
    justify-content: center;
}
.minMaxIcons {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1.5rem;
    height: 1.5rem;
    padding-right: 0.25rem;
    padding-left: 0.25rem;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}
.minMaxIcons.light:hover {
    background-color: #cbd5e0;
}
.minMaxIcons.dark:hover {
    background-color: #718096;
}
.rightExitIcon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1.5rem;
    height: 1.5rem;
    padding-right: 0.25rem;
    padding-left: 0.25rem;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}
.rightExitIcon:hover.light {
    background-color: #fc8181;
}
.rightExitIcon:hover.dark {
    background-color: #e53e3e;
}
.button-bar {
    display: flex;
    align-items: center;
    height: 30px;
}
.button-bar.light {
    background: #edf2f7;
    border-top: 1px solid #f7fafc;
    box-shadow: 0 2px 0 white;
    border-bottom: 1px solid #e2e8f0;
}
.button-bar.dark {
    background: #2d3748;
    border-top: 1px solid #1a202c;
    box-shadow: 0 2px 0 black;
    border-bottom: 1px solid #4a5568;
}
.button-bar button {
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 12px;
    padding-right: 12px;
    transition: all 0.3s ease;
    height: 30px;
    cursor: pointer;
}
.button-bar.light button {
    color: #2d3748;
    border-right: 1px solid #f7fafc;
    background: #edf2f7;
}
.button-bar.dark button {
    color: #edf2f7;
    border-right: 1px solid #1a202c;
    background: #2d3748;
}
.button-bar.dark button:hover {
    background-color: #2b6cb0;
    color: #f7fafc;
}
.button-bar.light button:hover {
    background-color: #90cdf4;
    color: #1a202c;
}
#cssmenu {
    padding: 0;
    margin: 0;
    border: 0;
    width: auto;
}
#cssmenu ul,
#cssmenu li {
    list-style: none;
    margin: 0;
    padding: 0;
}
#cssmenu ul {
    position: relative;
    z-index: 597;
}
#cssmenu ul li {
    float: left;
    min-height: 1px;
    vertical-align: middle;
}
#cssmenu ul li.hover,
#cssmenu ul li:hover {
    position: relative;
    z-index: 599;
    cursor: default;
}
#cssmenu ul ul {
    visibility: hidden;
    position: absolute;
    top: 100%;
    left: 0;
    z-index: 598;
    width: 100%;
}
#cssmenu ul ul li {
    float: none;
}
#cssmenu ul ul ul {
    top: 0;
    left: 190px;
    width: 190px;
}
#cssmenu ul li:hover > ul {
    visibility: visible;
}
#cssmenu ul ul {
    bottom: 0;
    left: 0;
}
#cssmenu ul ul {
    margin-top: 0;
}
#cssmenu ul ul li {
    font-weight: normal;
}
#cssmenu a {
    display: block;
    line-height: 1em;
    text-decoration: none;
}
#cssmenu > ul {
    *display: inline-block;
}
#cssmenu:after,
#cssmenu ul:after {
    content: "";
    display: block;
    clear: both;
}
#cssmenu ul ul {
    text-transform: none;
    min-width: 190px;
}
#cssmenu.dark ul ul a {
    background: #4a5568;
    color: #edf2f7;
    border: 1px solid #2d3748;
    border-top: 0px none #2d3748;
    line-height: 110%;
    padding: 6px 10px;
}
#cssmenu.light ul ul a {
    background: #e2e8f0;
    color: #2d3748;
    border: 1px solid #edf2f7;
    border-top: 0px none #edf2f7;
    line-height: 110%;
    padding: 6px 10px;
}
#cssmenu ul ul ul {
    border-top: 0 none;
}
#cssmenu ul ul li {
    position: relative;
}
#cssmenu.dark ul ul li:hover > a {
    background: #2b6cb0;
}
#cssmenu.light ul ul li:hover > a {
    background: #90cdf4;
}
#cssmenu.dark ul ul li:first-child > a {
    border: 1px solid #2d3748;
}
#cssmenu.light ul ul li:first-child > a {
    border: 1px solid #edf2f7;
}
#cssmenu.dark ul ul li:last-child > a {
    box-shadow: 0 3px 0 #f7fafc;
}
#cssmenu.light ul ul li:last-child > a {
    box-shadow: 0 3px 0 #1a202c;
}
#cssmenu ul ul li.has-sub > a:after {
    content: "+";
    position: absolute;
    top: 50%;
    right: 15px;
    margin-top: -8px;
}
#cssmenu ul li:hover > a,
#cssmenu.dark ul li.active > a {
    background: #2b6cb0;
    color: #f7fafc;
}
#cssmenu ul li:hover > a,
#cssmenu.light ul li.active > a {
    background: #90cdf4;
    color: #1a202c;
}
#cssmenu ul li.last ul {
    left: auto;
    right: 0;
}
#cssmenu ul li.last ul ul {
    left: auto;
    right: 99.5%;
}
#cssmenu a {
    padding: 3px 10px;
}
#cssmenu.dark a {
    background: #4a5568;
    color: #edf2f7;
}
#cssmenu.light a {
    background: #e2e8f0;
    color: #2d3748;
}
#cssmenu > ul > li > a {
    line-height: 30px;
}
.mnu-flex {
    display: flex;
    align-items: center;
}
/* End Top panel */

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
