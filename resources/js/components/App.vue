<template>
    <div class="mainDiv" v-bind:class="theme">
        <!-- Start Top panel -->
        <div>
            <div class="generalStyleDiv" v-bind:class="theme">
                <!--Header, icon, menu, title ...-->
                <div class="iconDiv">
                    <!--Header icon-->
                    <img src="/images/maxtradeoffice.png" class="iconImg" />
                </div>
                <div class="contentDiv" v-bind:class="theme">
                    <!--Main menu-->
                    <div id="cssmenu" v-bind:class="theme">
                        <ul>
                            <li class="has-sub">
                                <a><span>File</span></a>
                                <ul>
                                    <li>
                                        <a>
                                            <div
                                                class="mnu-flex"
                                                v-on:click="exit"
                                            >
                                                <i
                                                    class="mdi mdi-location-exit mdiExitIcon"
                                                    v-bind:class="theme"
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
                                        <a>
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteProjectIcon"
                                                    v-bind:class="theme"
                                                ></i
                                                >&nbsp;<span>Add Project</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-delete mdiAddEditDeleteProjectIcon"
                                                    v-bind:class="theme"
                                                ></i
                                                >&nbsp;<span
                                                    >Delete Project</span
                                                >
                                            </div>
                                        </a>
                                    </li>
                                    <li>
                                        <a>
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                                                    v-bind:class="theme"
                                                ></i
                                                >&nbsp;<span>Add Task</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="has-sub">
                                <a><span>Tasks</span></a>
                                <ul>
                                    <li id="mnuAddTask">
                                        <a>
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                                                    v-bind:class="theme"
                                                ></i
                                                >&nbsp;<span>Add Task</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li id="mnuDeleteTask">
                                        <a>
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-delete mdiAddEditDeleteTaskIcon"
                                                    v-bind:class="theme"
                                                ></i
                                                >&nbsp;<span>Delete Task</span>
                                            </div>
                                        </a>
                                    </li>
                                    <li id="mnuTaskStatus">
                                        <a><span>Task Status</span></a>
                                    </li>
                                    <li class="has-sub">
                                        <a><span>Tasks Filter</span></a>
                                        <ul>
                                            <li>
                                                <a><span>All Tasks</span></a>
                                            </li>
                                            <li>
                                                <a
                                                    ><span
                                                        >Completed Tasks</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a
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
                                                <a><span>Sort By</span></a>
                                            </li>
                                            <li>
                                                <a
                                                    ><span
                                                        >Date Ascending</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    ><span
                                                        >Date Descending</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    ><span
                                                        >Status Completed</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a
                                                    ><span
                                                        >Status Active</span
                                                    ></a
                                                >
                                            </li>
                                            <li>
                                                <a><span>Name A-Z</span></a>
                                            </li>
                                            <li>
                                                <a><span>Name Z-A</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a><span>Refresh Filters</span></a>
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
                                                    v-bind:class="theme"
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
                                    <li id="mnuAbout">
                                        <a>
                                            <div class="mnu-flex">
                                                <i
                                                    class="mdi mdi-information-variant standardSizeIcon"
                                                    v-bind:class="theme"
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
                <div class="topTitleDiv" v-bind:class="theme">
                    <!--Window title-->
                    <span>MaxtradeOffice</span>
                </div>
                <div class="topRightIcons">
                    <!--Window title icons-->
                    <div class="minMaxIcons" v-bind:class="theme">
                        <img src="/images/minimize.png" />
                    </div>
                    <div class="minMaxIcons" v-bind:class="theme">
                        <img src="/images/maximize.png" />
                    </div>
                    <div
                        class="rightExitIcon"
                        v-bind:class="theme"
                        v-on:click="exit"
                    >
                        <img src="/images/close.png" />
                    </div>
                </div>
            </div>
            <div class="button-bar" v-bind:class="theme">
                <a href="/logout.html" title="Exit this program"
                    ><i
                        class="mdi mdi-location-exit mdiExitIcon"
                        v-bind:class="theme"
                    ></i
                ></a>
                <a id="btnAddProject"
                    ><i
                        class="mdi mdi-plus-circle-outline mdiAddEditDeleteProjectIcon"
                        v-bind:class="theme"
                    ></i
                    >&nbsp;Add Project</a
                >
                <a id="btnDeleteProject"
                    ><i
                        class="mdi mdi-delete mdiAddEditDeleteProjectIcon"
                        v-bind:class="theme"
                    ></i
                    >&nbsp;Delete Project</a
                >
                <a id="btnAddTask"
                    ><i
                        class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                        v-bind:class="theme"
                    ></i
                    >&nbsp;Add Task</a
                >
                <a id="btnDeleteTask"
                    ><i
                        class="mdi mdi-delete mdiAddEditDeleteTaskIcon"
                        v-bind:class="theme"
                    ></i
                    >&nbsp;Delete Task</a
                >
            </div>
        </div>
        <!-- End Top panel -->
        <!-- Start Body panel -->
        <div class="body" v-bind:class="theme">
            <leftmenu v-bind:theme="theme"></leftmenu>
            <projects-panel
                v-bind:projects="projects"
                v-bind:theme="theme"
                v-bind:current_id="current_project_id"
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
                    @saveproject="saveProject"
                ></projects>
            </div>
        </div>
        <!-- End body panel -->
        <!-- Start Footer panel -->
        <div class="footerMainDiv" v-bind:class="theme">
            <div class="footer-icon">
                <!--Header icon-->
                <div><i class="mdi mdi-server-network serverIcon"></i></div>
                <div class="separator-vertical"></div>
                <div>MaxtradeOffice ver: <span id="app-version"></span></div>
                <div class="separator-vertical"></div>
                <div class="projects-panel-title-dot">
                    <i class="fas fa-circle"></i>
                </div>
                <div>
                    Projects: <span id="projects_number"></span>&nbsp;<span
                        id="projects_name"
                    ></span>
                </div>
                <div class="separator-vertical"></div>
                <div class="tasks-panel-title-dot">
                    <i class="fas fa-circle"></i>
                </div>
                <div>
                    Tasks: <span id="tasks_number"></span>&nbsp;<span
                        id="tasks_name"
                    ></span>
                </div>
                <div class="separator-vertical"></div>
            </div>
        </div>
        <!-- End Footer panel -->
    </div>
</template>

<script>
import Vue from "vue";
import Leftmenu from "./body/Leftmenu";
import ProjectsPanel from "./body/ProjectsPanel";
import TasksPanel from "./body/TasksPanel";
import Properties from "./body/Properties";
import Projects from "./body/Projects";

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
        Projects
    },

    data() {
        return {
            theme: "dark",
            properties: [],
            panel: "",
            projects: [],
            project: [],
            current_project_id: 0
        };
    },

    created() {
        this.fetchProperties();
        this.fetchProjects();
    },

    methods: {
        // Get Properties and set Theme
        fetchProperties() {
            fetch("api/properties")
                .then(res => res.json())
                .then(res => {
                    this.properties = res.data;
                    this.theme = res.data.find(
                        prop => prop.name === "theme"
                    ).value;
                })
                .catch(err => console.log(err));
        },
        fetchProjects() {
            fetch("api/projects")
                .then(res => res.json())
                .then(res => {
                    this.projects = res.data;
                })
                .catch(err => console.log(err));
        },
        changeTheme(changed_theme) {
            this.theme = changed_theme;
            fetch("api/property", {
                method: "PUT",
                body: JSON.stringify({
                    property_id: this.properties.find(
                        prop => prop.name === "theme"
                    ).id,
                    value: this.theme
                }),
                headers: { "Content-Type": "application/json; charset=utf-8" }
            })
                .then(res => res.json())
                .catch(err => console.log(err));
        },
        closePanel() {
            this.current_project_id = 0;
            this.panel = "";
        },
        changeProject(project) {
            this.project = project;
            this.current_project_id = project.id;
            this.panel = "projects";
        },
        saveProject() {
            fetch("api/project", {
                method: "PUT",
                body: JSON.stringify({
                    project_id: this.project.id,
                    title: this.project.title,
                    body: this.project.body,
                    status: this.project.status
                }),
                headers: { "Content-Type": "application/json; charset=utf-8" }
            })
                .then(res => res.json())
                .then(res => {
                    alert(
                        "You have successfully saved the changes to the Project: " +
                            res.data.title
                    );
                })
                .catch(err => console.log(err));
        },
        exit: function(event) {
            window.location = "/logout.html";
        },
        showProperties() {
            this.panel = "properties";
        }
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

#tasksListView {
    width: 100%;
    box-sizing: border-box;
    user-select: none;
    overflow-x: hidden;
    overflow-y: auto;
    flex: 1;
}
#tasksListView div.taskItem {
    display: flex;
    flex-direction: column;
    padding: 10px 20px;
    margin: 5px 5px;
    transition: 0.5s;
    cursor: pointer;
}
#tasksListView div.taskItem.light {
    background: #718096;
    color: #edf2f7;
}
#tasksListView div.taskItem.dark {
    background: #cbd5e0;
    color: #2d3748;
}
#projectsListView div.projectItem.light:hover {
    background: #2d3748;
}
#projectsListView div.projectItem.dark:hover {
    background: #edf2f7;
}
#tasksListView div.taskItem.light:hover {
    background: #2d3748;
}
#tasksListView div.taskItem.dark:hover {
    background: #edf2f7;
}
#projectsListView div.projectItem.light.active {
    background: #2d3748;
}
#projectsListView div.projectItem.dark.active {
    background: #edf2f7;
}
#tasksListView div.taskItem.light.active {
    background: #2d3748;
}
#tasksListView div.taskItem.dark.active {
    background: #edf2f7;
}
#tasksListView div.taskItem.light.ended {
    color: #cbd5e0;
    text-decoration: line-through;
}
#tasksListView div.taskItem.dark.ended {
    color: #718096;
    text-decoration: line-through;
}
#projectsListView div.projectItem div {
    display: flex;
    align-items: center;
}
#tasksListView div.taskItem div {
    display: flex;
    align-items: center;
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
.button-bar a {
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 12px;
    padding-right: 12px;
    transition: all 0.3s ease;
    height: 30px;
    cursor: pointer;
}
.button-bar.light a {
    color: #2d3748;
    border-right: 1px solid #f7fafc;
    background: #edf2f7;
}
.button-bar.dark a {
    color: #edf2f7;
    border-right: 1px solid #1a202c;
    background: #2d3748;
}
.button-bar.dark a:hover {
    background-color: #2b6cb0;
    color: #f7fafc;
}
.button-bar.light a:hover {
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
/* End Footer panel */
</style>
