<template>
    <div>
        <div class="generalStyleDiv" :class="getTheme">
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
                            <a
                                ><span>{{ t("File") }}</span></a
                            >
                            <ul>
                                <li>
                                    <a>
                                        <div
                                            class="mnu-flex"
                                            @click="exitProgram"
                                        >
                                            <i
                                                class="mdi mdi-location-exit mdiExitIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{ t("Exit") }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a
                                ><span>{{ t("Projects") }}</span></a
                            >
                            <ul>
                                <li>
                                    <a @click.prevent="addProject">
                                        <div class="mnu-flex">
                                            <i
                                                class="mdi mdi-plus-circle-outline mdiAddEditDeleteProjectIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("Add Project")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a @click.prevent="deleteProject">
                                        <div class="mnu-flex">
                                            <i
                                                class="mdi mdi-delete mdiAddEditDeleteProjectIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("Delete Project")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a @click.prevent="addTask">
                                        <div class="mnu-flex">
                                            <i
                                                class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("Add Task")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a @click="completeProject"
                                        ><span>{{
                                            t("Complete Project")
                                        }}</span></a
                                    >
                                </li>
                                <li class="has-sub">
                                    <a
                                        ><span>{{
                                            t("Projects Filter")
                                        }}</span></a
                                    >
                                    <ul>
                                        <li>
                                            <a @click="showAllProjects"
                                                ><span>{{
                                                    t("All Projects")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="showCompletedProjects"
                                                ><span>{{
                                                    t("Completed Projects")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="showActivedProjects"
                                                ><span>{{
                                                    t("Actived Projects")
                                                }}</span></a
                                            >
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a
                                        ><span>{{
                                            t("Projects Sort")
                                        }}</span></a
                                    >
                                    <ul>
                                        <li>
                                            <a @click="sortProjectsIdAcc"
                                                ><span>{{
                                                    t("Id Ascending")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="sortProjectsIdDec"
                                                ><span>{{
                                                    t("Id Descending")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="sortProjectsNameAcc"
                                                ><span>{{
                                                    t("Name A-Z")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="sortProjectsNameDec"
                                                ><span>{{
                                                    t("Name Z-A")
                                                }}</span></a
                                            >
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a
                                ><span>{{ t("Tasks") }}</span></a
                            >
                            <ul>
                                <li>
                                    <a @click.prevent="addTask">
                                        <div class="mnu-flex">
                                            <i
                                                class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("Add Task")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a @click.prevent="deleteTask">
                                        <div class="mnu-flex">
                                            <i
                                                class="mdi mdi-delete mdiAddEditDeleteTaskIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("Delete Task")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a @click="completeTask"
                                        ><span>{{
                                            t("Complete Task")
                                        }}</span></a
                                    >
                                </li>
                                <li class="has-sub">
                                    <a
                                        ><span>{{ t("Tasks Filter") }}</span></a
                                    >
                                    <ul>
                                        <li>
                                            <a @click="showAllTasks"
                                                ><span>{{
                                                    t("All Tasks")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="showCompletedTasks"
                                                ><span>{{
                                                    t("Completed Tasks")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="showActivedTasks"
                                                ><span>{{
                                                    t("Actived Tasks")
                                                }}</span></a
                                            >
                                        </li>
                                    </ul>
                                </li>
                                <li class="has-sub">
                                    <a
                                        ><span>{{ t("Tasks Sort") }}</span></a
                                    >
                                    <ul>
                                        <li>
                                            <a @click="sortTasksIdAcc"
                                                ><span>{{
                                                    t("Id Ascending")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="sortTasksIdDec"
                                                ><span>{{
                                                    t("Id Descending")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="sortTasksNameAcc"
                                                ><span>{{
                                                    t("Name A-Z")
                                                }}</span></a
                                            >
                                        </li>
                                        <li>
                                            <a @click="sortTasksNameDec"
                                                ><span>{{
                                                    t("Name Z-A")
                                                }}</span></a
                                            >
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a
                                ><span>{{ t("Panels") }}</span></a
                            >
                            <ul>
                                <li>
                                    <a>
                                        <div
                                            class="mnu-flex"
                                            @click="showSearchtasks"
                                        >
                                            <i
                                                class="mdi mdi-file-document-box-search standardSizeIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("Search Panel")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div
                                            class="mnu-flex"
                                            @click="showEmails"
                                        >
                                            <i
                                                class="mdi mdi-email-check standardSizeIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("E-Mails")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div
                                            class="mnu-flex"
                                            @click="showContacts"
                                        >
                                            <i
                                                class="mdi mdi-contacts standardSizeIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("Contacts")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a
                                ><span>{{ t("Tools") }}</span></a
                            >
                            <ul>
                                <li>
                                    <a>
                                        <div
                                            class="mnu-flex"
                                            @click="showProperties"
                                        >
                                            <i
                                                class="mdi mdi-tools standardSizeIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("Options")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a>
                                        <div
                                            class="mnu-flex"
                                            @click="showProfile"
                                        >
                                            <i
                                                class="mdi mdi-account standardSizeIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{
                                                t("Profile")
                                            }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="has-sub">
                            <a
                                ><span>{{ t("Help") }}</span></a
                            >
                            <ul>
                                <li>
                                    <a>
                                        <div
                                            class="mnu-flex"
                                            @click="showAbout()"
                                        >
                                            <i
                                                class="mdi mdi-information-variant standardSizeIcon"
                                                :class="getTheme"
                                            ></i
                                            >&nbsp;<span>{{ t("About") }}</span>
                                        </div>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="topTitleDiv" :class="getTheme">
                <!--Window title-->
                <span>MaxtradeOffice [{{ getUserName }}]</span>
            </div>
            <div class="topRightIcons">
                <!--Window title icons-->
                <div class="minMaxIcons" :class="getTheme">
                    <img src="/images/minimize.png" />
                </div>
                <div class="minMaxIcons" :class="getTheme">
                    <img src="/images/maximize.png" />
                </div>
                <div
                    class="rightExitIcon"
                    :class="getTheme"
                    @click="exitProgram"
                >
                    <img src="/images/close.png" />
                </div>
            </div>
        </div>
        <div class="button-bar" :class="getTheme">
            <button @click="exitProgram" title="Exit this program">
                <i
                    class="mdi mdi-location-exit mdiExitIcon"
                    :class="getTheme"
                ></i>
            </button>
            <button @click="addProject">
                <i
                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Add Project") }}
            </button>
            <button :disabled="getCurrentProjectId == 0" @click="deleteProject">
                <i
                    class="mdi mdi-delete mdiAddEditDeleteProjectIcon"
                    v-bind:class="getTheme"
                ></i
                >&nbsp;{{ t("Delete Project") }}
            </button>
            <button @click="addTask" :disabled="getCurrentProjectId == 0">
                <i
                    class="mdi mdi-plus-circle-outline mdiAddEditDeleteTaskIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Add Task") }}
            </button>
            <button :disabled="getCurrentTaskId == 0" @click="deleteTask">
                <i
                    class="mdi mdi-delete mdiAddEditDeleteTaskIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Delete Task") }}
            </button>
            <button @click="showSearchtasks">
                <i
                    class="mdi mdi-file-document-box-search mdiOtherIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Search Panel") }}
            </button>
            <button @click="showEmails">
                <i
                    class="mdi mdi-email-check mdiOtherIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("E-Mails") }}
            </button>
            <button @click="showContacts">
                <i class="mdi mdi-contacts mdiOtherIcon" :class="getTheme"></i
                >&nbsp;{{ t("Contacts") }}
            </button>
        </div>
    </div>
</template>
<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "TopBar",

    computed: mapGetters(["getTheme", "getUserName"]),

    methods: {
        ...mapActions([
            "exitProgram",
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
            "getCurrentProjectId",
            "deleteProject",
            "addTask",
            "getCurrentTaskId",
            "deleteTask",
            "showProperties",
            "showContacts",
            "showProfile",
            "showEmails",
            "showAbout",
            "showSearchtasks"
        ])
    }
};
</script>
<style scoped>
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
.mdiOtherIcon {
    font-size: 1.5rem;
    color: #a0aec0;
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
</style>
