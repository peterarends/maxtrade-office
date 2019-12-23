<template>
    <div class="projects-body">
        <div class="button-bar" v-bind:class="theme">
            <div class="topTitleDiv">
                <!--Window title-->
                <span
                    >Project:
                    {{ project.id | formatProjectId(new_project) }}</span
                >
            </div>
            <div class="topRightIcons">
                <!--Window title icons-->
                <div
                    class="rightExitIcon"
                    v-bind:class="theme"
                    v-on:click="closeProject"
                >
                    <img src="/images/close.png" />
                </div>
            </div>
        </div>
        <div class="body" v-bind:class="[project.status == 0 ? 'ended' : '']">
            <div class="date">
                <h3>Date start: {{ project.created_at | formatDate }}</h3>
                <h3>
                    Date end:
                    <span v-show="project.status == 1" class="continues"
                        >Continues
                    </span>
                    <span v-show="project.status == 0"
                        >{{ project.updated_at | formatDate }}
                    </span>
                </h3>
            </div>
            <input class="title" type="text" v-model="project.title" />
            <textarea
                class="text_body"
                rows="10"
                v-model="project.body"
            ></textarea>
            <div>
                <input type="checkbox" id="project_status" v-model="project.status" />
                <label for="project_status"
                    ><span></span>Status of the project:
                    {{ project.status | statusFilter }}</label
                >
            </div>
        </div>
        <div class="bottom" v-bind:class="theme">
            <a v-on:click.prevent="saveProject"
                ><i
                    class="mdi mdi-content-save-outline mdiProjectIcon"
                    v-bind:class="theme"
                ></i
                >&nbsp;Save Project</a
            >
            <a v-on:click.prevent="deleteProject"
                ><i
                    class="mdi mdi-delete-outline mdiProjectIcon"
                    v-bind:class="theme"
                ></i
                >&nbsp;Delete Project</a
            >
            <a v-on:click.prevent="closeProject"
                ><i
                    class="mdi mdi-close-outline mdiProjectIcon"
                    v-bind:class="theme"
                ></i
                >&nbsp;Close Project</a
            >
            <div class="status_panel">
                Last change: {{ project.updated_at | formatDate }}
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "Projects",

    props: ["theme", "project", "new_project"],

    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format("DD.MM.YYYY hh:mm");
            }
        },
        statusFilter: function(value) {
            if (value == 1) {
                return "Active";
            } else {
                return "Completed";
            }
        },
        formatProjectId: function(value, _new_project) {
            if (_new_project) {
                return "New Project";
            } else {
                return value;
            }
        }
    },

    methods: {
        closeProject: function(event) {
            this.$emit("closepanel");
        },
        saveProject: function(event) {
            this.$emit("saveproject");
        },
        deleteProject: function(event) {
            this.$emit("deleteproject");
        }
    }
};
</script>

<style scoped>
.projects-body {
    width: 100%;
    display: flex;
    flex-direction: column;
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
.topTitleDiv {
    /* text-center flex-grow text-xl pl-2 pr-2 text-gray-300 */
    text-align: center;
    flex-grow: 1;
    font-size: 1.25rem;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    color: #3182ce;
}
.topRightIcons {
    /* flex items-center justify-content-center */
    display: flex;
    align-items: center;
    justify-content: center;
}
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
.body {
    flex: 1;
    padding: 10px;
    display: flex;
    flex-direction: column;
}
.ended {
    text-decoration: line-through;
}
.date {
    display: flex;
    justify-content: space-between;
    padding-bottom: 20px;
}
.title {
    background: transparent;
    text-align: center;
    padding: 4px;
    font-size: 32px;
}
.text_body {
    background: transparent;
    padding: 4px;
    font-size: 18px;
}
.continues {
    color: green;
}
.bottom {
    display: flex;
    padding: 2px;
    height: 30px;
}
.bottom.light {
    background: #edf2f7;
    border-bottom: 1px solid #f7fafc;
    border-top: 1px solid #e2e8f0;
}
.bottom.dark {
    background: #2d3748;
    border-bottom: 1px solid #1a202c;
    border-top: 1px solid #4a5568;
}
.bottom a {
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 12px;
    padding-right: 12px;
    transition: all 0.3s ease;
    height: 24px;
    cursor: pointer;
}
.bottom.light a {
    color: #2d3748;
    border-right: 1px solid #f7fafc;
    background: #edf2f7;
}
.bottom.dark a {
    color: #edf2f7;
    border-right: 1px solid #1a202c;
    background: #2d3748;
}
.bottom.dark a:hover {
    background-color: #2b6cb0;
    color: #f7fafc;
}
.bottom.light a:hover {
    background-color: #90cdf4;
    color: #1a202c;
}
.status_panel {
    flex: 1;
    text-align: right;
}
.mdiProjectIcon {
    font-size: 1.3rem;
}
.mdiProjectIcon.light {
    color: #63b3ed;
}
.mdiProjectIcon.dark {
    color: #3182ce;
}
label {
    display: inline-block;
    cursor: pointer;
    position: relative;
}
label span {
    display: inline-block;
    position: relative;
    background-color: transparent;
    width: 25px;
    height: 25px;
    transform-origin: center;
    border: 2px solid #718096;
    border-radius: 50%;
    vertical-align: -6px;
    margin-right: 10px;
    transition: background-color 150ms 200ms,
        transform 350ms cubic-bezier(0.78, -1.22, 0.17, 1.89);
}
label span:before {
    content: "";
    width: 0px;
    height: 2px;
    border-radius: 2px;
    background: #cbd5e0;
    position: absolute;
    transform: rotate(45deg);
    top: 10px;
    left: 8px;
    transition: width 50ms ease 50ms;
    transform-origin: 0% 0%;
}
label span:after {
    content: "";
    width: 0;
    height: 2px;
    border-radius: 2px;
    background: #cbd5e0;
    position: absolute;
    transform: rotate(305deg);
    top: 13px;
    left: 9px;
    transition: width 50ms ease;
    transform-origin: 0% 0%;
}
label:hover span:before {
    width: 5px;
    transition: width 100ms ease;
}
label:hover span:after {
    width: 10px;
    transition: width 150ms ease 100ms;
}
input[type="checkbox"] {
    display: none;
}
input[type="checkbox"]:checked + label span {
    background-color: #cbd5e0;
    transform: scale(1.25);
}
input[type="checkbox"]:checked + label span:after {
    width: 10px;
    background: #1790b5;
    transition: width 150ms ease 100ms;
}
input[type="checkbox"]:checked + label span:before {
    width: 5px;
    background: #1790b5;
    transition: width 150ms ease 100ms;
}
input[type="checkbox"]:checked + label:hover span {
    background-color: #cbd5e0;
    transform: scale(1.25);
}
input[type="checkbox"]:checked + label:hover span:after {
    width: 10px;
    background: #1790b5;
    transition: width 150ms ease 100ms;
}
input[type="checkbox"]:checked + label:hover span:before {
    width: 5px;
    background: #1790b5;
    transition: width 150ms ease 100ms;
}
</style>
