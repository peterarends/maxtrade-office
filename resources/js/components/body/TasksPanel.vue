<template>
    <div class="body-tasks-panel" :class="getTheme">
        <div class="topTaskDiv" :class="getTheme">
            <input
                type="text"
                class="searchInput"
                :class="getTheme"
                :placeholder="t('tasks search ...')"
                @input="fetchTasksSearch($event)"
            />
            <div class="searchElementsDiv" :class="getTheme">
                <span
                    class="searchIconsText"
                    :class="getTheme"
                    @click="toggleTaskStatusFilter"
                    >{{ getTaskFilter.filterstatus.toUpperCase() }}</span
                >
                <i
                    class="mdi mdi-sort-alphabetical searchIcons"
                    :class="getTheme"
                    @click="toggleTaskNameFilter"
                ></i>
                <i
                    class="mdi mdi-sort-numeric searchIcons"
                    :class="getTheme"
                    @click="toggleTaskIdFilter"
                ></i>
            </div>
        </div>
        <div id="tasksListView">
            <div
                class="task_item"
                v-for="task in getTasks"
                :key="task.id"
                :class="[task.id == getCurrentTaskId ? 'active' : '', getTheme]"
                @click="showTask(task)"
                @contextmenu.prevent="$refs.menu.open($event, task)"
            >
                <div
                    class="dateText"
                    :class="[
                        task.status == 0 ? 'dateWithLine' : 'dateWithoutLine',
                        getTheme
                    ]"
                >
                    {{ task.created_at | formatDate
                    }}<span v-if="task.isfiles"
                        >&nbsp;|&nbsp;<i
                            class="mdi mdi-file-multiple mdiIcon"
                            title="Тhere are files available in this task"
                        ></i
                    ></span>
                </div>
                <div class="singleTaskDiv">
                    <div
                        class="singleTaskId"
                        :class="[
                            task.status == 0 ? '' : 'idBackground',
                            task.status == 0
                                ? 'idTextFinished'
                                : 'idTextUnfinished ',
                            getTheme
                        ]"
                    >
                        {{ task.id }}
                    </div>
                    <div
                        class="singleTaskText"
                        :class="[
                            task.status == 0
                                ? 'titleTextFinished'
                                : 'titleTextUnfinished',
                            task.status == 0 ? 'titleTextLine' : '',
                            getTheme
                        ]"
                    >
                        {{ task.title }}
                    </div>
                </div>
            </div>
        </div>
        <vue-context ref="menu" @open="onOpenContextMenu">
            <li>
                <a @click.prevent="onClickContextMenu('delete')">{{
                    t("Delete Task")
                }}</a>
            </li>
            <li>
                <a @click.prevent="onClickContextMenu('complete')">{{
                    t("Complete Task")
                }}</a>
            </li>
        </vue-context>
    </div>
</template>

<script>
import Vue from "vue";
import moment from "moment";
import { VueContext } from "vue-context";
import { mapGetters, mapActions } from "vuex";
import VueTranslate from "vue-translate-plugin";

Vue.use(VueTranslate);

export default {
    name: "TasksPanel",

    components: {
        VueContext
    },

    computed: mapGetters([
        "getTheme",
        "getTasks",
        "getTaskFilter",
        "getCurrentTaskId"
    ]),

    mounted() {
        this.$translate.setLang("bg_BG");
    },

    locales: {
        en_US: {},
        bg_BG: {
            "tasks search ...": "търси в задачи ...",
            "Delete Task": "Изтрий задачата",
            "Complete Task": "Приключи задачата"
        }
    },

    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format("DD.MM.YYYY hh:mm");
            }
        }
    },

    methods: {
        ...mapActions([
            "fetchTasksSearch",
            "toggleTaskStatusFilter",
            "toggleTaskNameFilter",
            "toggleTaskIdFilter",
            "showTask",
            "deleteTask",
            "completeTask"
        ]),
        onClickContextMenu(action) {
            if (action == "delete") {
                this.deleteTask();
            }
            if (action == "complete") {
                this.completeTask();
            }
        },
        onOpenContextMenu(event, data) {
            this.showTask(data);
        }
    }
};
</script>

<style scoped>
.v-context,
.v-context ul {
    background-color: #1a202c;
    background-clip: padding-box;
    border-radius: 0.25rem;
    border: 1px solid rgba(0, 0, 0, 0.15);
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14),
        0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
    display: block;
    margin: 0;
    padding: 0px;
    min-width: 10rem;
    z-index: 1500;
    position: fixed;
    list-style: none;
    box-sizing: border-box;
    max-height: calc(100% - 50px);
    overflow-y: auto;
}
.v-context > li,
.v-context ul > li {
    margin: 0;
    position: relative;
    cursor: pointer;
}
.v-context > li > a,
.v-context ul > li > a {
    display: block;
    padding: 0.5rem 1.5rem;
    font-weight: 400;
    color: #cbd5e0;
    text-decoration: none;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}
.v-context > li > a:focus,
.v-context > li > a:hover,
.v-context ul > li > a:focus,
.v-context ul > li > a:hover {
    text-decoration: none;
    color: #212529;
    background-color: #a0aec0;
}
.v-context:focus,
.v-context > li > a:focus,
.v-context ul:focus,
.v-context ul > li > a:focus {
    outline: 0;
}
.v-context__sub > a:after {
    content: "\2BC8";
    float: right;
    padding-left: 1rem;
}
.v-context__sub > ul {
    display: none;
}
/** Top part of projects */
.topProjectsDiv {
    /* flex items-center p-1 bg-gray-900 */
    display: flex;
    align-items: center;
    padding: 0.25rem;
}
.topProjectsDiv.light {
    background-color: #f7fafc;
}
.topProjectsDiv.dark {
    background-color: #1a202c;
}

/** Top part of tasks */
.topTaskDiv {
    display: flex;
    align-items: center;
    padding: 0.25rem;
}
.topTaskDiv.light {
    background-color: #f7fafc;
}
.topTaskDiv.dark {
    background-color: #1a202c;
}

/** Search style */
.searchInput {
    border-radius: 0.25rem;
    width: 70%;
    padding-left: 0.25rem;
    padding-bottom: 0.25rem;
    margin-right: 0.25rem;
}
.searchInput.light {
    background-color: #f7fafc;
    border: 1px solid #edf2f7;
    color: #4a5568;
}
.searchInput.dark {
    background-color: #1a202c;
    border: 1px solid #2d3748;
    color: #e2e8f0;
}
.searchInput.light::placeholder {
    color: #e2e8f0;
}
.searchInput.dark::placeholder {
    color: #4a5568;
}
/** Search by element */
.searchElementsDiv {
    display: flex;
    justify-content: center;
    padding-left: 0.25rem;
}
.searchElementsDiv.light {
    border-left: 1px dotted #e2e8f0;
}
.searchElementsDiv.dark {
    border-left: 1px dotted #4a5568;
}
/** Search by element icons */
.searchIconsText {
    /* text-2xl text-gray-500 hover:text-gray-100 */
    font-size: 1rem;
    padding: 0px 2px;
    font-weight: bold;
    cursor: pointer;
}
.searchIconsText.light {
    color: #a0aec0;
}
.searchIconsText.dark {
    color: #a0aec0;
}
.searchIconsText.light:hover {
    color: #1a202c;
}
.searchIconsText.dark:hover {
    color: #f7fafc;
}
.searchIcons {
    font-size: 1.5rem;
    padding: 0px 2px;
    font-weight: bold;
    cursor: pointer;
}
.searchIcons.light {
    color: #a0aec0;
}
.searchIcons.dark {
    color: #a0aec0;
}
.searchIcons.light:hover {
    color: #1a202c;
}
.searchIcons.dark:hover {
    color: #f7fafc;
}
/** Date style */
.dateText {
    display: flex;
    justify-content: flex-end;
    font-size: 0.75rem;
}
.dateText.dateWithLine {
    text-decoration: line-through;
}
.dateText.dateWithLine.light {
    color: #718096;
}
.dateText.dateWithLine.dark {
    color: #a0aec0;
}
.dateText.dateWithoutLine.light {
    color: #a0aec0;
}
.dateText.dateWithoutLine.dark {
    color: #a0aec0;
}
/** Style for each project block */
.singleTaskDiv {
    display: flex;
}
.singleTaskId {
    border-radius: 9999px;
    height: 1.5rem;
    width: 1.5rem;
    font-size: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
.singleTaskId.idBackground.light {
    /* bg-gray-600 */
    background-color: #cbd5e0;
}
.singleTaskId.idBackground.dark {
    /* bg-gray-600 */
    background-color: #718096;
}
.singleTaskId.idTextUnfinished.light {
    /* text-gray-600 */
    color: #718096;
}
.singleTaskId.idTextUnfinished.dark {
    /* text-gray-600 */
    color: #cbd5e0;
}
.singleTaskId.idTextFinished.light {
    color: #f7fafc;
}
.singleTaskId.idTextFinished.dark {
    color: #1a202c;
}
.singleTaskText {
    flex: 1;
    padding-left: 0.5rem;
    padding-top: 0.25rem;
}
.singleTaskText.titleTextUnfinished.light {
    color: #4a5568;
}
.singleTaskText.titleTextUnfinished.dark {
    color: #e2e8f0;
}
.singleTaskText.titleTextFinished.light {
    color: #a0aec0;
}
.singleTaskText.titleTextFinished.dark {
    color: #a0aec0;
}
.titleTextLine {
    text-decoration: line-through;
}
.body-tasks-panel {
    display: flex;
    width: 300px;
    height: calc(100vh - 94px);
    flex-direction: column;
    overflow-x: hidden;
    overflow-y: hidden;
}
.body-tasks-panel.light {
    border-right: 1px solid white;
    background: #f7fafc;
}
.body-tasks-panel.dark {
    border-right: 1px solid black;
    background: #1a202c;
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
#tasksListView div.taskItem.light:hover {
    background: #2d3748;
}
#tasksListView div.taskItem.dark:hover {
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
#tasksListView div.taskItem div {
    display: flex;
    align-items: center;
}
.task_item {
    display: flex;
    flex-direction: column;
    padding: 5px 20px 5px 5px;
    margin: 5px 5px;
    transition: 0.3s;
    cursor: pointer;
}
.task_item.light {
    background: #e2e8f0;
    color: #718096;
}
.task_item.dark {
    background: #4a5568;
    color: #cbd5e0;
}
.task_item:first-child {
    padding: 5px 20px 5px 5px;
    margin: 0px 5px 5px 5px;
}
.task_item.light:hover {
    background: #edf2f7;
    color: #718096;
}
.task_item.dark:hover {
    background: #2d3748;
    color: #cbd5e0;
}
.task_item.light.active {
    background: #edf2f7;
    color: #718096;
}
.task_item.dark.active {
    background: #2d3748;
    color: #cbd5e0;
}
</style>
