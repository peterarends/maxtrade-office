<template>
    <div class="mainDiv" v-bind:class="theme">
        <top v-bind:theme="theme"></top>
        <bodycontent
            v-bind:theme="theme"
            v-bind:properties="properties"
        ></bodycontent>
        <bottom v-bind:theme="theme"></bottom>
    </div>
</template>

<script>
import Top from "./Top";
import Bodycontent from "./Bodycontent";
import Bottom from "./Bottom";
import Vue from "vue";

// This variable will hold the reference to
// document's click handler
let handleOutsideClick;

Vue.directive("closable", {
    bind(el, binding, vnode) {
        // Here's the click/touchstart handler
        // (it is registered below)
        handleOutsideClick = e => {
            e.stopPropagation();
            // Get the handler method name and the exclude array
            // from the object used in v-closable
            const { handler, exclude } = binding.value;

            // This variable indicates if the clicked element is excluded
            let clickedOnExcludedEl = false;
            exclude.forEach(refName => {
                // We only run this code if we haven't detected
                // any excluded element yet
                if (!clickedOnExcludedEl) {
                    // Get the element using the reference name
                    const excludedEl = vnode.context.$refs[refName];
                    // See if this excluded element
                    // is the same element the user just clicked on
                    clickedOnExcludedEl = excludedEl.contains(e.target);
                }
            });

            // We check to see if the clicked element is not
            // the dialog element and not excluded
            if (!el.contains(e.target) && !clickedOnExcludedEl) {
                // If the clicked element is outside the dialog
                // and not the button, then call the outside-click handler
                // from the same component this directive is used in
                vnode.context[handler]();
            }
        };
        // Register click/touchstart event listeners on the whole page
        document.addEventListener("click", handleOutsideClick);
        document.addEventListener("touchstart", handleOutsideClick);
    },

    unbind() {
        // If the element that has v-closable is removed, then
        // unbind click/touchstart listeners from the whole page
        document.removeEventListener("click", handleOutsideClick);
        document.removeEventListener("touchstart", handleOutsideClick);
    }
});

export default {
    name: "App",
    components: {
        Top,
        Bodycontent,
        Bottom
    },

    data() {
        return {
            theme: "dark",
            properties: []
        };
    },

    created() {
        this.fetchProperties();
    },

    methods: {
        // Get Properties and set Theme
        fetchProperties() {
            fetch("api/properties")
                .then(res => res.json())
                .then(res => {
                    this.properties = res.data;
                    this.theme = res.data.find(
                        prop => prop.name === "theme"
                    ).value;
                });
        }
    }
};
</script>

<style>
/* Projects and Tasks List View */
h1 {
    font-size: 28px;
}
h2 {
    font-size: 24px;
}
h3 {
    font-size: 20px;
}
h4 {
    font-size: 18px;
}
h5 {
    font-size: 16px;
}
.mainDiv {
    display: flex;
    flex-direction: column;
    height: 100%;
}
.mainDiv.light {
    background-color: #fff;
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
    color: #edf2f7;
}
#tasksListView div.taskItem.dark {
    background: #cbd5e0;
    color: #2d3748;
}
#projectsListView div.projectItem.light:hover {
    background: #2d3748;
}
#projectsListView div.projectItem.dark:hover {
    background: #edf2f7;
}
#tasksListView div.taskItem.light:hover {
    background: #2d3748;
}
#tasksListView div.taskItem.dark:hover {
    background: #edf2f7;
}
#projectsListView div.projectItem.light.active {
    background: #2d3748;
}
#projectsListView div.projectItem.dark.active {
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
    border-left: 1px solid #e2e8f0;
    border-right: 1px solid #f7fafc;
}
.separator-vertical.dark {
    border-left: 1px solid #4a5568;
    border-right: 1px solid #1a202c;
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
    background: #1a202c;
}
::-webkit-scrollbar-thumb {
    background: #2d3748;
}
::-webkit-scrollbar-thumb:hover {
    background: #4a5568;
}
</style>
