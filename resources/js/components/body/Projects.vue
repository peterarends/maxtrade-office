<template>
    <div class="projects-body">
        <div class="button-bar" v-bind:class="theme">
            <div class="topTitleDiv">
                <!--Window title-->
                <span>Project: {{ project.id }}</span>
            </div>
            <div class="topRightIcons">
                <!--Window title icons-->
                <div
                    class="rightExitIcon"
                    v-bind:class="theme"
                    v-on:click="close"
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
            <input class="title" type="text" v-model="project.title">
            <textarea class="text_body" rows="10" v-model="project.body"></textarea>
            <div style="flex:1;">
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "Projects",

    props: ["theme", "project"],

    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format("DD.MM.YYYY hh:mm");
            }
        }
    },

    methods: {
        close: function(event) {
            this.$emit("closepanel");
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
.title{
    background: transparent;
    text-align: center;
    padding: 4px;
    font-size: 32px;
}
.text_body{
    background: transparent;
    padding: 4px;
    font-size: 18px;
}
.continues {
    color: green;
}
</style>
