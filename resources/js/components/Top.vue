<template>
    <div>
        <div class="generalStyleDiv">
            <!--Header, icon, menu, title ...-->
            <div class="iconDiv">
                <!--Header icon-->
                <img src="/images/maxtradeoffice.png" class="iconImg" />
            </div>
            <div
                class="contentDiv"
            >
                <!--Main menu-->
                <div id="cssmenu">
                    <ul>
                        <li class="has-sub">
                            <a><span>File</span></a>
                            <ul>
                                <li>
                                    <a>
                                        <div class="mnu-flex" v-on:click="exit">
                                            <i
                                                class="mdi mdi-location-exit mdiExitIcon"
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
            <div class="topTitleDiv">
                <!--Window title-->
                <span>MaxtradeOffice</span>
            </div>
            <div class="topRightIcons">
                <!--Window title icons-->
                <div
                    class="minMaxIcons"
                >
                    <img src="/images/minimize.png" />
                </div>
                <div
                    class="minMaxIcons"
                >
                    <img src="/images/maximize.png" />
                </div>
                <div
                    class="rightExitIcon"
                    v-on:click="exit"
                >
                    <img src="/images/close.png" />
                </div>
            </div>
        </div>
        <div class="button-bar">
            <a href="/logout.html" title="Exit this program"
                ><i class="mdi mdi-location-exit mdiExitIcon"></i
            ></a>
            <a id="btnAddProject"
                ><i
                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteProjectIcon"
                ></i
                >&nbsp;Add Project</a
            >
            <a id="btnEditProject"
                ><i class="mdi mdi-pencil mdiAddEditDeleteProjectIcon"></i>&nbsp;Edit
                Project</a
            >
            <a id="btnDeleteProject"
                ><i class="mdi mdi-delete mdiAddEditDeleteProjectIcon"></i
                >&nbsp;Delete Project</a
            >
            <a id="btnAddTask"
                ><i
                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                ></i
                >&nbsp;Add Task</a
            >
            <a id="btnEditTask"
                ><i class="mdi mdi-pencil mdiAddEditDeleteTaskIcon"></i
                >&nbsp;Edit Task</a
            >
            <a id="btnDeleteTask"
                ><i class="mdi mdi-delete mdiAddEditDeleteTaskIcon"></i
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
    }
};
</script>

<style scoped>
/** General style of the top bar */
.generalStyleDiv {
    display: flex;
    align-items: center;
    height: 2rem;
    background-color: #4a5568;
    border-bottom-width: 1px;
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
.contentDiv{
    /* flex items-center justify-content-center pr-2 text-gray-300 */
    display: flex;
    align-items: center;
    justify-content: center;
    padding-right: 0.5rem;
    color: #e2e8f0;
}
/** Top bar content div */

/** Exit mdi icon */
.mdiExitIcon{
    /* text-2xl text-red-600 */
    font-size: 1.5rem;
    color: #e53e3e;
}
/** Exit mdi icon */

/** Add Project, Edit, Delete icons */
.mdiAddEditDeleteProjectIcon{
    /* text-2xl text-blue-600 */
    font-size: 1.5rem;
    color: #3182ce;
}
/** Add Project, Edit, Delete icons */

/** Add, Edit, Delete task icons */
.mdiAddEditDeleteTaskIcon{
    /* text-2xl text-orange-600 */
    font-size: 1.5rem;
    color: #dd6b20;
}
/** Add, Edit, Delete task icons */

/** Standard mdi icon size */
.standardSizeIcon{
    font-size: 1.5rem;
}
/** Standard mdi icon size */

/** Style of the top title div */
.topTitleDiv{
    /* text-center flex-grow text-xl pl-2 pr-2 text-gray-300 */
    text-align: center;
    flex-grow: 1;
    font-size: 1.25rem;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    color: #e2e8f0;
}
/** Style of the top title div */

/** Minimize, Maximize, Exit General*/
.topRightIcons{
    /* flex items-center justify-content-center */
    display:flex;
    align-items: center;
    justify-content: center;
}
/** Minimize, Maximize, Exit General*/

/** Minimize, Maximize icons*/
.minMaxIcons{
    /* flex items-center justify-content-center w-7 h-7 px-1 py-1 hover:bg-gray-600 */
    display:flex;
    align-items: center;
    justify-content: center;
    width: 1.5rem;
    height: 1.5rem;
    padding-right: 0.25rem;
    padding-left: 0.25rem;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;  
}
.minMaxIcons:hover{
    background-color: #718096;
}
/** Minimize, Maximize icons*/

/** Top right exit icon */
.rightExitIcon{
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
.rightExitIcon:hover{
    background-color: #e53e3e;
}
/** Top right exit icon */

/* Button bar */
.button-bar {
    display: flex;
    align-items: center;
    height: 30px;
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
    color: #edf2f7;
    transition: all 0.3s ease;
    border-right: 1px solid #1a202c;
    background: #2d3748;
    height: 30px;
    cursor: pointer;
}
.button-bar a:hover {
    background-color: #2b6cb0;
    color: #f7fafc;
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
#cssmenu ul ul a {
    background: #4a5568;
    color: #edf2f7;
    border: 1px solid #2d3748;
    border-top: 0px none #2d3748;
    line-height: 110%;
    padding: 6px 10px;
}
#cssmenu ul ul ul {
    border-top: 0 none;
}
#cssmenu ul ul li {
    position: relative;
}
#cssmenu ul ul li:hover > a {
    background: #2b6cb0;
}
#cssmenu ul ul li:first-child > a {
    border: 1px solid #2d3748;
}
#cssmenu ul ul li:last-child > a {
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
#cssmenu ul li.active > a {
    background: #2b6cb0;
    color: #f7fafc;
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
    background: #4a5568;
    color: #edf2f7;
    padding: 3px 10px;
}
#cssmenu > ul > li > a {
    line-height: 30px;
}
.mnu-flex {
    display: flex;
    align-items: center;
}
</style>
