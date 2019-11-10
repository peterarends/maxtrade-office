<template>
    <div class="flex flex-col h-full bg-black">
        <top></top>
        <bodycontent></bodycontent>
        <bottom></bottom>
    </div>
</template>

<script>
import Top from './Top';
import Bodycontent from './Bodycontent';
import Bottom from './Bottom';

export default {
    name: "App",
    components: {
        Top,
        Bodycontent,
        Bottom
    }
}
</script>

<style>
/* Projects and Tasks List View */
#tasksListView{
    width: 100%;
    box-sizing: border-box;
    user-select: none;
    overflow-x: hidden;
    overflow-y: auto;
    flex: 1;
}
#tasksListView div.taskItem{
    display: flex;
    flex-direction: column;
    background: #cbcbcb;
    padding: 10px 20px;
    color: #333333;
    margin: 5px 5px;
    transition: 0.5s;
    cursor: pointer;
}
#projectsListView div.projectItem:hover{
    background: #e4e4e4;
}
#tasksListView div.taskItem:hover{
    background: #e4e4e4;
}
#projectsListView div.projectItem.active{
    background: #f5f5f5;
}
#tasksListView div.taskItem.active{
    background: #f5f5f5;
}
#tasksListView div.taskItem.ended{
    color: #585858;
    text-decoration: line-through;
}
#projectsListView div.projectItem div{
    display: flex;
    align-items: center;
}
#tasksListView div.taskItem div{
    display: flex;
    align-items: center;
}
.list-dot{
    color: #4682b4;
    font-size: 12px;
    padding-right: 5px;
}
.list-dot-task{
    color: #ff8c00;
    font-size: 12px;
    padding-right: 5px;
}
.list-dot-task.ended{
    color: #868686;
}
.list-name{
    display: table-cell;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    height: 20px;
    font-weight: 600;
}
.list-description{
    display: block;
    overflow: hidden;
    height: 40px;
    font-size: 12px;
}
.list-date{
    font-size: 11px;
}
.list-project-name{
    font-size: 11px;
    padding-left: 5px;
    font-weight: 600;
    color: #4682b4;
}
.list-data{
    font-size: 11px;
    padding-left: 5px;
}
.list-paragraph{
    padding: 3px 0px;
}
/* tools */
.separator-vertical{
    border-left: 1px solid #4c4c4c;
    border-right: 1px solid #212121;
    margin: 0px 5px 0px 5px;
    height: 26px;
}
.projects-panel-title-dot{
    color: #4682b4;
    font-size: 12px;
    padding-right: 5px;
}
.tasks-panel-title-dot{
    color: #ff8c00;
    font-size: 12px;
    padding-right: 5px;
}
/* scroll bar */
::-webkit-scrollbar {
    width: 10px;
}
::-webkit-scrollbar-track {
    background: #1e1e1e;
}
::-webkit-scrollbar-thumb {
    background: #333333;
}
::-webkit-scrollbar-thumb:hover {
    background: #6b6b6b;
}
</style>
