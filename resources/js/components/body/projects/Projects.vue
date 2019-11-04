<template>
    <div class="body-projects-panel">
        <div class="projects-panel-title">
            <div class="projects-panel-title-dot"><i class="fas fa-circle"></i></div>
            <div class="projects-panel-title-name" id="project_panel_title_name">All Projects</div>
        </div>
        <div id="projectsListView">
            <div class="project_item" v-for="project in projects" v-bind:key="project.id">
                <div class="flex justify-end text-xs">{{project.created_at}}</div>
                <div>{{project.id}}{{project.title}}</div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Projects",

    data() {
        return {
            projects: [],
            project: {
                id: "",
                title: "",
                body: ""
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
    }
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
    padding: 10px 20px;
    color: #CBD5E0;
    margin: 5px 5px;
    transition: 0.3s;
    cursor: pointer;
}
.project_item:first-child{
    padding: 10px 20px;
    margin: 0px 5px 5px 5px;
}
.project_item:hover{
    background: #2D3748;
    color: #CBD5E0;
}
</style>
