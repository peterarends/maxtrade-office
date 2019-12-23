<template>
    <div class="body-tasks-panel" v-bind:class="theme">
        <div class="topTaskDiv" v-bind:class="theme">
            <input
                type="text"
                class="searchInput"
                v-bind:class="theme"
                placeholder="tasks search ..."
            />
            <div class="searchElementsDiv" v-bind:class="theme">
                <i class="mdi mdi-filter searchIcons" v-bind:class="theme"></i>
                <div>
                    <i
                        class="mdi mdi-airplane searchIcons"
                        v-bind:class="theme"
                    ></i>
                    <i
                        class="mdi mdi-sort-alphabetical searchIcons"
                        v-bind:class="theme"
                    ></i>
                    <i
                        class="mdi mdi-sort-numeric searchIcons"
                        v-bind:class="theme"
                    ></i>
                </div>
            </div>
        </div>
        <div id="tasksListView">
            <div
                class="task_item"
                v-for="task in tasks"
                v-bind:key="task.id"
                v-bind:class="[task.id == current_id ? 'active' : '', theme]"
                v-on:click="showTask(task)"
            >
                <div
                    class="dateText"
                    v-bind:class="[
                        task.status == 0 ? 'dateWithLine' : 'dateWithoutLine',
                        theme
                    ]"
                >
                    {{ task.created_at | formatDate }}
                </div>
                <div class="singleTaskDiv">
                    <div
                        class="singleTaskId"
                        v-bind:class="[
                            task.status == 0 ? '' : 'idBackground',
                            task.status == 0
                                ? 'idTextFinished'
                                : 'idTextUnfinished ',
                            theme
                        ]"
                    >
                        {{ task.id }}
                    </div>
                    <div
                        class="singleTaskText"
                        v-bind:class="[
                            task.status == 0
                                ? 'titleTextFinished'
                                : 'titleTextUnfinished',
                            task.status == 0 ? 'titleTextLine' : '',
                            theme
                        ]"
                    >
                        {{ task.title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "TasksPanel",

    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format("DD.MM.YYYY hh:mm");
            }
        }
    },

    methods: {
        showTask(task) {
            this.$emit("changetask", task);
        }
    },

    props: ["tasks", "theme", "current_id"]
};
</script>

<style scoped>
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
    width: 50%;
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
.searchIcons {
    font-size: 1.5rem;
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
    color: #cbd5e0;
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
