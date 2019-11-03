<template>
    <div>
        <div class="header">
            <!--Header, icon, menu, title ...-->
            <div class="header-icon">
                <!--Header icon-->
                <img src="/images/maxtradeoffice.png" width="20" height="20">
            </div>
            <div class="header-menu">
                <!--Main menu-->
                <div id='cssmenu'>
                    <ul>
                        <li class="has-sub"><a><span>File</span></a>
                            <ul>
                                <li>
                                    <a>
                                        <div class="mnu-flex" v-on:click="exit">
                                            <img src="/images/close-app.png" width="20" height="20">&nbsp;<span>Exit</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub"><a><span>Projects</span></a>
                            <ul>
                                <li>
                                    <a>
                                        <div class="mnu-flex">
                                            <img src="/images/add.png" width="20" height="20">&nbsp;<span>Add
                                                Project</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div class="mnu-flex">
                                            <img src="/images/edit.png" width="20" height="20">&nbsp;<span>Edit
                                                Project</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div class="mnu-flex">
                                            <img src="/images/delete.png" width="20" height="20">&nbsp;<span>Delete
                                                Project</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div class="mnu-flex">
                                            <img src="/images/addtask.png" width="20" height="20">&nbsp;<span>Add
                                                Task</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub"><a><span>Tasks</span></a>
                            <ul>
                                <li id="mnuAddTask">
                                    <a>
                                        <div class="mnu-flex">
                                            <img src="/images/addtask.png" width="20" height="20">&nbsp;<span>Add
                                                Task</span>
                                        </div>
                                    </a>
                                </li>
                                <li id="mnuEditTask">
                                    <a>
                                        <div class="mnu-flex">
                                            <img src="/images/edittask.png" width="20" height="20">&nbsp;<span>Edit
                                                Task</span>
                                        </div>
                                    </a>
                                </li>
                                <li id="mnuDeleteTask">
                                    <a>
                                        <div class="mnu-flex">
                                            <img src="/images/deletetask.png" width="20" height="20">&nbsp;<span>Delete
                                                Task</span>
                                        </div>
                                    </a>
                                </li>
                                <li id="mnuTaskStatus"><a><span>Task Status</span></a></li>
                                <li class="has-sub"><a><span>Tasks Filter</span></a>
                                    <ul>
                                        <li><a><span>All Tasks</span></a></li>
                                        <li><a><span>Completed Tasks</span></a></li>
                                        <li><a><span>Actived Tasks</span></a></li>
                                    </ul>
                                </li>
                                <li class="has-sub"><a><span>Tasks Sort</span></a>
                                    <ul>
                                        <li><a><span>Sort By</span></a></li>
                                        <li><a><span>Date Ascending</span></a></li>
                                        <li><a><span>Date Descending</span></a></li>
                                        <li><a><span>Status Completed</span></a></li>
                                        <li><a><span>Status Active</span></a></li>
                                        <li><a><span>Name A-Z</span></a></li>
                                        <li><a><span>Name Z-A</span></a></li>
                                    </ul>
                                </li>
                                <li><a><span>Refresh Filters</span></a></li>
                            </ul>
                        </li>
                        <li class="has-sub"><a><span>Tools</span></a>
                            <ul>
                                <li id="mnuOptions">
                                    <a>
                                        <div class="mnu-flex">
                                            <img src="/images/options.png" width="20" height="20">&nbsp;<span>Options</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub"><a><span>Help</span></a>
                            <ul>
                                <li id="mnuAbout">
                                    <a>
                                        <div class="mnu-flex">
                                            <img src="/images/about.png" width="20" height="20">&nbsp;<span>About</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="header-title">
                <!--Window title-->
                <span>MaxtradeOffice</span>
            </div>
            <div class="header-actions">
                <!--Window title icons-->
                <div class="action-minimize-maximize" id="btnTitleMinimize">
                    <img src="/images/minimize.png">
                </div>
                <div class="action-minimize-maximize" id="btnTitleMaximize">
                    <img src="/images/maximize.png">
                </div>
                <div class="action-cloze" v-on:click="exit">
                    <img src="/images/close.png">
                </div>
            </div>
        </div>
        <div class="button-bar">
            <a href="/logout.html"><img src="/images/close-app.png" width="20px" height="20px"></a>
            <a id="btnAddProject"><img src="/images/add.png" width="20px" height="20px">&nbsp;Add Project</a>
            <a id="btnEditProject"><img src="/images/edit.png" width="20px" height="20px">&nbsp;Edit Project</a>
            <a id="btnDeleteProject"><img src="/images/delete.png" width="20px" height="20px">&nbsp;Delete Project</a>
            <a id="btnAddTask"><img src="/images/addtask.png" width="20px" height="20px">&nbsp;Add Task</a>
            <a id="btnEditTask"><img src="/images/edittask.png" width="20px" height="20px">&nbsp;Edit Task</a>
            <a id="btnDeleteTask"><img src="/images/deletetask.png" width="20px" height="20px">&nbsp;Delete Task</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "Top",

    methods: {
        exit: function (event) {
            window.location = '/logout.html';
        }
    }
}
</script>

<style scoped>
/* Header */
.header{
    display: flex;
    align-items: center;
    height: 30px;
    background: #333333;
    color: #868686;
    border-bottom: 1px solid #4c4c4c;
}
.header-icon{
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 6px;
    padding-right: 2px;
    -webkit-app-region: no-drag;
}
.header-menu{
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 10px;
    padding-right: 2px;
    color: #868686;
    -webkit-app-region: no-drag;
}
.header-title{
    text-align: center;
    flex-grow: 1;
    padding-left: 2px;
    padding-right: 2px;
    color: #868686;
    font-size: 13px;
    -webkit-user-select: none;
    -webkit-app-region: drag;
}
.header-actions{
    display: flex;
    align-items: center;
    justify-content: center;
    -webkit-app-region: no-drag;
}
.action-minimize-maximize{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
}
.action-minimize-maximize:hover{
    background: #4f4f4f;
}
.action-cloze{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
}
.action-cloze:hover{
    background: #d71525;
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
#cssmenu {
    background: #333333;
}
#cssmenu > ul {
    *display: inline-block;
}
#cssmenu:after,
#cssmenu ul:after {
    content: '';
    display: block;
    clear: both;
}
#cssmenu ul ul {
    text-transform: none;
    min-width: 190px;
}
#cssmenu ul ul a {
    background: #252526;
    color: #868686;
    border: 1px solid #37373d;
    border-top: 0px none #37373d;
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
    background: #094771;
}
#cssmenu ul ul li:first-child > a {
    border: 1px solid #37373d;
}
#cssmenu ul ul li:last-child > a {
    box-shadow: 0 3px 0 #101011;
}
#cssmenu ul ul li.has-sub > a:after {
    content: '+';
    position: absolute;
    top: 50%;
    right: 15px;
    margin-top: -8px;
}
#cssmenu ul li:hover > a,
#cssmenu ul li.active > a {
    background: #4f4f4f;
    color: #CBCBCB;
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
    background: #333333;
    color: #868686;
    padding: 0 10px;
}
#cssmenu > ul > li > a {
    line-height: 30px;
}
.mnu-flex{
    display: flex;
    align-items: center;
}
/* Button bar */
.button-bar{
    display: flex;
    align-items: center;
    height: 30px;
    background: #333333;
    border-top: 1px solid #212121;
    box-shadow: 0 2px 0 #161616;
    border-bottom: 1px solid #4c4c4c;
}
.button-bar a {
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 12px;
    padding-right: 12px;
    color: #868686;
    transition: all 0.3s ease;
    border-right: 1px solid #1e1e1e;
    background: #2d2d2d;
    height: 30px;
    cursor: pointer;
}
.button-bar a:hover {
    background-color: #1e1e1e;
    color: #CBCBCB;
}
</style>
