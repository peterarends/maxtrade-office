<template>
    <div class="body-tasks-panel">
        <div class="task-panel-title">
            <div class="task-panel-title-dot"><i class="fas fa-circle"></i></div>
            <div class="task-panel-title-name" id="task_panel_title_name"></div>
            <div class="task-panel-title-search" id="task_panel_title_search">
                <select id="tasks_select" class="tasks-select">
                    <option value="all">All Tasks</option>
                    <option value="end">Completed Tasks</option>
                    <option value="active">Actived Tasks</option>
                </select>
                <select id="tasks_sord" class="tasks-select">
                    <option value="none">Sort By</option>
                    <option value="datea">Date +</option>
                    <option value="dated">Date -</option>
                    <option value="end">Completed</option>
                    <option value="active">Active</option>
                    <option value="nameaz">Name A-Z</option>
                    <option value="nameza">Name Z-A</option>
                </select>
            </div>
            <div class="task-panel-title-action" data-tooltip="Filter to show Tasks" data-tooltip-position="right"><i class="fas fa-search"></i></div>
        </div>
        <div id="tasksListView"></div>
    </div>
</template>

<script>
export default {
    name: "Tasks"
}
</script>

<style scoped>
.body-tasks-panel{
    display: flex;
    width: 300px;
    flex-direction: column;
    background: #252526;
    height: calc(100vh - 94px);
    border-right: 1px solid #1e1e1e;
}
.task-panel-title{
    display: flex;
    align-items: center;
    width: 295px;
    height: 30px;
    margin: 0px 0px 0px 5px;
    box-sizing: border-box;
    background: #252526;
}
.task-panel-title-dot{
    color: #ff8c00;
    font-size: 12px;
    padding-right: 5px;
}
.task-panel-title-name{
    font-weight: 500;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    flex: 1;
}
.task-panel-title-search{
    flex: 1;
    display: none;
}
.tasks-select{
    background: #333333;
    color: #ADADAD;
}
.task-panel-title-action{
    width: 30px;
    cursor: pointer;
}
.task-panel-title-action:hover{
    color: #ff8c00;
}
</style>
