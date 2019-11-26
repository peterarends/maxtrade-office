<template>
    <div class="mainDiv" v-bind:class="theme">
        <top v-bind:theme="theme"></top>
        <bodycontent v-bind:theme="theme"></bodycontent>
        <bottom v-bind:theme="theme"></bottom>
    </div>
</template>

<script>
import Top from "./Top";
import Bodycontent from "./Bodycontent";
import Bottom from "./Bottom";

export default {
    name: "App",
    components: {
        Top,
        Bodycontent,
        Bottom
    },

    data() {
        return {
            theme: "light"
        };
    },

    // created() {
    //     this.changeTheme();
    // },

    // methods: {
    //     changeTheme() {
    //         var menu = document.querySelector('.menu') // Using a class instead, see note below.
    //         menu.classList.toggle('hidden-phone');
    //     }
    // },
};
</script>

<style>
/* Projects and Tasks List View */

.mainDiv {
    display: flex;
    flex-direction: column;
    height: 100%;
}
.mainDiv.light {
    background-color: #FFF;
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
    color: #EDF2F7;
}
#tasksListView div.taskItem.dark {
    background: #CBD5E0;
    color: #2D3748;
}
#projectsListView div.projectItem.light:hover {
    background: #2D3748;
}
#projectsListView div.projectItem.dark:hover {
    background: #EDF2F7;
}
#tasksListView div.taskItem.light:hover {
    background: #2D3748;
}
#tasksListView div.taskItem.dark:hover {
    background: #EDF2F7;
}
#projectsListView div.projectItem.light.active {
    background: #2D3748;
}
#projectsListView div.projectItem.dark.active {
    background: #EDF2F7;
}
#tasksListView div.taskItem.light.active {
    background: #2D3748;
}
#tasksListView div.taskItem.dark.active {
    background: #EDF2F7;
}
#tasksListView div.taskItem.light.ended {
    color: #CBD5E0;
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
    border-left: 1px solid #E2E8F0;
    border-right: 1px solid #F7FAFC;
}
.separator-vertical.dark {
    border-left: 1px solid #4A5568;
    border-right: 1px solid #1A202C;
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
    background: red;
}
::-webkit-scrollbar-track {
    background: blue;
}
::-webkit-scrollbar-thumb {
    background: #333333;
}
::-webkit-scrollbar-thumb:hover {
    background: #6b6b6b;
}
</style>
