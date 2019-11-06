<template>
    <div class="body-projects-panel">
        <div class="projects-panel-title">
            <div class="projects-panel-title-dot"><i class="fas fa-circle"></i></div>
            <div class="projects-panel-title-name" id="project_panel_title_name">All Projects</div>
        </div>
        <div id="projectsListView">
            <div class="project_item" v-for="project in projects" v-bind:key="project.id">
                <div class="flex justify-end text-xs text-gray-500" v-bind:class="[
                    project.status == 0 ? 'text-gray-500' : '', 'text-gray-300',
                    project.status == 0 ? 'line-through' : '', ''
                    ]">{{project.created_at | formatDate}}</div>
                <div class="flex">
                    <div class="rounded-full h-6 w-6 text-xs flex items-center
                    justify-center" v-bind:class="[
                    project.status == 0 ? '' : 'bg-gray-600', '',
                    project.status == 0 ? 'text-gray-600' : 'text-gray-900', ''
                    ]">
                        {{project.id}}
                    </div>
                    <div class="pl-2 pt-1" v-bind:class="[
                    project.status == 0 ? 'text-gray-500' : '', 'text-gray-300',
                    project.status == 0 ? 'line-through' : '', ''
                    ]">
                        {{project.title}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from 'moment';

export default {
    name: "Projects",

    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format('DD.MM.YYYY hh:mm')
            }
        }
    },

    data() {
        return {
            projects: [],
            project: {
                id: "",
                title: "",
                body: "",
                status
            },
            article_id: "",
            pagination: {},
            edit: false
        };
    },

    created() {
        this.fetchProjects();
    },

    methods: {
        fetchProjects() {
            fetch("api/projects")
                .then(res => res.json())
                .then(res => {
                    this.projects = res.data;
            });
        }
    },
};
</script>

<style scoped>
.body-projects-panel{
    display: flex;
    width: 300px;
    height: calc(100vh - 94px);
    flex-direction: column;
    border-right: 1px solid black;
    background: #1A202C;
    overflow-x: hidden;
    overflow-y: hidden;
}
.projects-panel-title{
    display: flex;
    align-items: center;
    width: 295px;
    height: 60px;
    margin: 0px 0px 0px 5px;
    box-sizing: border-box;
    background: #1A202C;
}
.projects-panel-title-name{
    font-weight: 500;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    flex: 1;
}
#projectsListView{
    width: 100%;
    box-sizing: border-box;
    user-select: none;
    overflow-x: hidden;
    overflow-y: auto;
}
.project_item{
    display: flex;
    flex-direction: column;
    background: #4A5568;
    padding: 5px 20px 5px 5px;
    color: #CBD5E0;
    margin: 5px 5px;
    transition: 0.3s;
    cursor: pointer;
}
.project_item:first-child{
    padding: 5px 20px 5px 5px;
    margin: 0px 5px 5px 5px;
}
.project_item:hover{
    background: #2D3748;
    color: #CBD5E0;
}
</style>
