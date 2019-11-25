<template>
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
                                        <div class="mnu-flex" v-on:click="exit">
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
                                                class="mdi mdi-pencil mdiAddEditDeleteProjectIcon"
                                                v-bind:class="theme"
                                            ></i
                                            >&nbsp;<span>Edit Project</span>
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
                                            >&nbsp;<span>Delete Project</span>
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
                                <li id="mnuEditTask">
                                    <a>
                                        <div class="mnu-flex">
                                            <i
                                                class="mdi mdi-pencil mdiAddEditDeleteTaskIcon"
                                                v-bind:class="theme"
                                            ></i
                                            >&nbsp;<span>Edit Task</span>
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
                                            <a><span>Completed Tasks</span></a>
                                        </li>
                                        <li>
                                            <a><span>Actived Tasks</span></a>
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
                                            <a><span>Date Ascending</span></a>
                                        </li>
                                        <li>
                                            <a><span>Date Descending</span></a>
                                        </li>
                                        <li>
                                            <a><span>Status Completed</span></a>
                                        </li>
                                        <li>
                                            <a><span>Status Active</span></a>
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
                                        <div class="mnu-flex">
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
            <a id="btnEditProject"
                ><i
                    class="mdi mdi-pencil mdiAddEditDeleteProjectIcon"
                    v-bind:class="theme"
                ></i
                >&nbsp;Edit Project</a
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
            <a id="btnEditTask"
                ><i
                    class="mdi mdi-pencil mdiAddEditDeleteTaskIcon"
                    v-bind:class="theme"
                ></i
                >&nbsp;Edit Task</a
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
</template>

<script>
export default {
    name: "Top",

    methods: {
        exit: function(event) {
            window.location = "/logout.html";
        }
    },

    props: ["theme"]
};
</script>

<style scoped>
/** General style of the top bar */
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
/** General style of the top bar */

/** Top bar icon div */
.iconDiv {
    /* flex items-center justify-content-center px-3 */
    display: flex;
    align-items: center;
    justify-content: center;
    padding-right: 0.75rem;
    padding-left: 0.75rem;
}
/** Top bar icon div */

/** Top bar icon image */
.iconImg {
    width: 1.5rem;
    height: 1.5rem;
    margin-right: auto;
    margin-left: auto;
}
/** Top bar icon image */

/** Top bar content div */
.contentDiv {
    /* flex items-center justify-content-center pr-2 text-gray-300 */
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
/** Top bar content div */

/** Exit mdi icon */
.mdiExitIcon {
    /* text-2xl text-red-600 */
    font-size: 1.5rem;
}
.mdiExitIcon.light {
    color: #fc8181;
}
.mdiExitIcon.dark {
    color: #e53e3e;
}
/** Exit mdi icon */

/** Add Project, Edit, Delete icons */
.mdiAddEditDeleteProjectIcon {
    /* text-2xl text-blue-600 */
    font-size: 1.5rem;
}
.mdiAddEditDeleteProjectIcon.light {
    color: #63b3ed;
}
.mdiAddEditDeleteProjectIcon.dark {
    color: #3182ce;
}
/** Add Project, Edit, Delete icons */

/** Add, Edit, Delete task icons */
.mdiAddEditDeleteTaskIcon {
    /* text-2xl text-orange-600 */
    font-size: 1.5rem;
}
.mdiAddEditDeleteTaskIcon.light {
    color: #f6ad55;
}
.mdiAddEditDeleteTaskIcon.dark {
    color: #dd6b20;
}
/** Add, Edit, Delete task icons */

/** Standard mdi icon size */
.standardSizeIcon {
    font-size: 1.5rem;
}
/** Standard mdi icon size */

/** Style of the top title div */
.topTitleDiv {
    /* text-center flex-grow text-xl pl-2 pr-2 text-gray-300 */
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
/** Style of the top title div */

/** Minimize, Maximize, Exit General*/
.topRightIcons {
    /* flex items-center justify-content-center */
    display: flex;
    align-items: center;
    justify-content: center;
}
/** Minimize, Maximize, Exit General*/

/** Minimize, Maximize icons*/
.minMaxIcons {
    /* flex items-center justify-content-center w-7 h-7 px-1 py-1 hover:bg-gray-600 */
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
/** Minimize, Maximize icons*/

/** Top right exit icon */
.rightExitIcon {
    /* flex items-center justify-content-center w-7 h-7 px-1 py-1 hover:bg-red-600 */
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
/** Top right exit icon */

/* Button bar */
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
/* Main menu */
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
</style>
