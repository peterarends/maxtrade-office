<template>
    <div class="projects-body">
        <div class="button-bar" :class="getTheme">
            <div class="topTitleDiv">
                <!--Window title-->
                <span
                    >{{ t("Project") }}:
                    {{ getProject.id | formatProjectId(getNewTask) }}</span
                >
            </div>
            <div class="topRightIcons">
                <!--Window title icons-->
                <div
                    class="rightExitIcon"
                    :class="getTheme"
                    @click="closePanel"
                >
                    <img src="/images/close.png" />
                </div>
            </div>
        </div>
        <div class="body" :class="[getProject.status == 0 ? 'ended' : '']">
            <div class="date">
                <h3>
                    {{ t("Date start") }}:
                    {{ getProject.created_at | formatDate }}
                </h3>
                <h3>
                    {{ t("Date end") }}:
                    <span v-show="getProject.status == 1" class="continues"
                        >{{ t("Continues") }}
                    </span>
                    <span v-show="getProject.status == 0"
                        >{{ getProject.updated_at | formatDate }}
                    </span>
                </h3>
            </div>
            <input class="title" type="text" v-model="getProject.title" />
            <textarea
                class="text_body"
                rows="10"
                v-model="getProject.body"
            ></textarea>
            <div class="projectStatus">
                <input
                    type="checkbox"
                    id="project_status"
                    v-model="getProject.status"
                />
                <label for="project_status"
                    ><span></span>{{ t("Status of the project") }}:
                    <strong>{{
                        getProject.status
                            | statusFilter(t("Active"), t("Completed"))
                    }}</strong></label
                >
            </div>
            <div class="taskStauses">
                <div class="taskAll">
                    {{ t("All tasks") }}: <strong>{{ countAllTasks }}</strong>
                </div>
                <div class="taskActive">
                    {{ t("Actived Tasks") }}:
                    <strong>{{ countActiveTasks }}</strong>
                </div>
                <div class="taskEnded">
                    {{ t("Ended tasks") }}:
                    <strong>{{ countEndedTasks }}</strong>
                </div>
            </div>
            <div class="vp20"></div>
            <div class="chart">
                <pie-chart
                    :chart-data="chartData"
                    :options="chartOptions"
                ></pie-chart>
            </div>
        </div>
        <div class="bottom" :class="getTheme">
            <a @click.prevent="saveProject(true)"
                ><i
                    class="mdi mdi-content-save-outline mdiProjectIcon"
                    v-bind:class="getTheme"
                ></i
                >&nbsp;{{ t("Save") }}</a
            >
            <a @click.prevent="deleteProject"
                ><i
                    class="mdi mdi-delete-outline mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Delete") }}</a
            >
            <a
                :href="'/project/' + getProject.id + '/export.html'"
                target="_blank"
                ><i class="mdi mdi-printer mdiProjectIcon" :class="getTheme"></i
                >&nbsp;{{ t("Export") }}</a
            >
            <a @click.prevent="closePanel"
                ><i
                    class="mdi mdi-close-outline mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Close") }}</a
            >
            <div class="status_panel">
                {{ t("Last change") }}: {{ getProject.updated_at | formatDate
                }}<span class="status_panel_user">
                    [#{{ getProject.last_id }} /
                    {{ getProject.last_name }}]</span
                >
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";
import { mapGetters, mapActions } from "vuex";
import PieChart from "./PieChart";

export default {
    name: "Projects",

    components: {
        PieChart
    },

    data() {
        return {
            chartOptions: {
                hoverBorderWidth: 20
            },
            chartData: {
                hoverBackgroundColor: "red",
                hoverBorderWidth: 10,
                labels: ["Active", "Ended"],
                datasets: [
                    {
                        label: "Data One",
                        backgroundColor: ["#E46651", "#41B883"],
                        data: [1, 1]
                    }
                ]
            }
        };
    },

    computed: {
        ...mapGetters([
            "getTheme",
            "getProject",
            "getNewTask",
            "countAllTasks",
            "countActiveTasks",
            "countEndedTasks"
        ])
    },

    mounted() {
        setInterval(this.generateData, 2000);
    },

    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format("DD.MM.YYYY hh:mm");
            }
        },
        statusFilter: function(value, label1, label2) {
            if (value == 1) {
                return label1;
            } else {
                return label2;
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
        ...mapActions(["closePanel", "saveProject", "deleteProject"]),
        generateData() {
            this.chartData = {
                hoverBackgroundColor: "red",
                hoverBorderWidth: 10,
                labels: ["Active", "Ended"],
                datasets: [
                    {
                        label: "Data One",
                        backgroundColor: ["#E46651", "#41B883"],
                        data: [this.countActiveTasks, this.countEndedTasks]
                    }
                ]
            };
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
    padding-bottom: 10px;
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
.projectStatus {
    padding-top: 10px;
    font-size: 18px;
}
.taskStauses {
    margin-left: auto;
    margin-right: auto;
    padding-top: 10px;
    display: flex;
    font-size: 18px;
}
.taskAll {
    flex: 1/3;
    padding: 3px 6px;
    border-right: 1px solid #718096;
}
.taskActive {
    flex: 1/3;
    padding: 3px 6px;
    border-right: 1px solid #718096;
}
.taskEnded {
    flex: 1/3;
    padding-top: 3px;
    padding-bottom: 3px;
}
.chart {
    max-width: 320px;
    max-height: 320px;
}
@media screen and (max-width: 1440px), screen and (max-height: 900px) {
    .chart {
        display: none;
    }
    .status_panel_user {
        display: none;
    }
}
</style>
