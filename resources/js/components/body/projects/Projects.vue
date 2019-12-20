<template>
    <div class="body-projects-panel" v-bind:class="theme">
        <div class="topProjectsDiv" v-bind:class="theme">
            <input
                type="text"
                class="searchInput" v-bind:class="theme"
                placeholder="projects search ..."
            />
            <div
                class="searchElementsDiv" v-bind:class="theme"
            >
                <i
                    class="mdi mdi-filter searchIcons" v-bind:class="theme"
                ></i>
                <div>
                    <i
                        class="mdi mdi-airplane searchIcons" v-bind:class="theme" 
                    ></i>
                    <i
                        class="mdi mdi-sort-alphabetical searchIcons" v-bind:class="theme"
                    ></i>
                    <i
                        class="mdi mdi-sort-numeric searchIcons" v-bind:class="theme"
                    ></i>
                </div>
            </div>
        </div>
        <div id="projectsListView">
            <div class="project_item" v-for="project in projects" v-bind:key="project.id" v-bind:class="theme">
                <div
                    class="dateText"
                    v-bind:class="[ project.status == 0 ? 'dateWithLine' : 'dateWithoutLine', theme ]"
                >
                    {{ project.created_at | formatDate }}
                </div>
                <div class="singleProjectDiv">
                    <div
                        class="singleProjectId"
                        v-bind:class="[
                            project.status == 0 ? '' : 'idBackground',
                            project.status == 0 ? 'idTextFinished' : 'idTextUnfinished ',
                            theme
                        ]"
                    >
                        {{ project.id }}
                    </div>
                    <div
                        class="singleProjectText"
                        v-bind:class="[
                            project.status == 0 ? 'titleTextFinished' : 'titleTextUnfinished',
                            project.status == 0 ? 'titleTextLine' : '',
                            theme
                            
                        ]"
                    >
                        {{ project.title }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "Projects",

    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format("DD.MM.YYYY hh:mm");
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
            project_id: "",
            pagination: {},
            edit: false,
            options: []
        };
    },

    created() {
        this.fetchProjects();
    },

    mounted() {
        if (localStorage.options) {
            this.options = localStorage.options;
        }
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

    props: ["theme"]
};
</script>

<style scoped>

/** Top part of projects */
.topProjectsDiv{
    /* flex items-center p-1 bg-gray-900 */
    display: flex;
    align-items: center;
    padding: 0.25rem;
}
.topProjectsDiv.light{
    background-color: #F7FAFC;
}
.topProjectsDiv.dark{
    background-color: #1a202c;
}

/** Search style */
.searchInput{
    /* bg-gray-900 border-gray-800 border rounded w-1/2 pl-1 pb-1 text-gray-300
            placeholder-gray-700 mr-1 */
    border-radius: .25rem;
    width: 50%;
    padding-left: 0.25rem;
    padding-bottom: 0.25rem;
    margin-right: 0.25rem;
}
.searchInput.light{
    background-color: #F7FAFC;
    border: 1px solid  #EDF2F7;
    color: #4A5568;
}
.searchInput.dark{
    background-color: #1a202c;
    border: 1px solid  #2d3748;
    color: #e2e8f0;
}
.searchInput.light::placeholder{
    color: #E2E8F0;
}
.searchInput.dark::placeholder{
    color: #4a5568;
}
/** Search by element */
.searchElementsDiv{
    /* flex items-center justify-center border-l border-gray-700 border-dotted pl-1 */
    display: flex;
    justify-content: center;
    padding-left: 0.25rem;
}
.searchElementsDiv.light{
    border-left: 1px dotted #E2E8F0;
}
.searchElementsDiv.dark{
    border-left: 1px dotted #4a5568;
}

/** Search by element icons */
.searchIcons{
    /* text-2xl text-gray-500 hover:text-gray-100 */
    font-size: 1.5rem;
}
.searchIcons.light{
    color: #a0aec0;
}
.searchIcons.dark{
    color: #a0aec0;
}
.searchIcons.light:hover{
    color: #1A202C;
}
.searchIcons.dark:hover{
    color: #f7fafc;
}
/** Date style */
.dateText{
    /* flex justify-end text-xs */
    display: flex;
    justify-content: flex-end;
    font-size: .75rem;
}
.dateText.dateWithLine{
    text-decoration: line-through;
}
.dateText.dateWithLine.light{
    /* text-gray-500 line-through */
    color: #718096;
}
.dateText.dateWithLine.dark{
    /* text-gray-500 line-through */
    color: #cbd5e0;
}
.dateText.dateWithoutLine.light{
    /* text-gray-400 */
    color: #a0aec0;
}
.dateText.dateWithoutLine.dark{
    color: #a0aec0;
}

/** Style for each project block */
.singleProjectDiv{
    display:flex;
}
.singleProjectId{
    /* rounded-full h-6 w-6 text-xs flex items-center justify-center */
    border-radius: 9999px;
    height: 1.5rem;
    width: 1.5rem;
    font-size: .75rem;
    display: flex;
    align-items: center;
    justify-content: center;
}
.singleProjectId.idBackground.light{
    /* bg-gray-600 */
    background-color: #CBD5E0;
}
.singleProjectId.idBackground.dark{
    /* bg-gray-600 */
    background-color: #718096;
}
.singleProjectId.idTextUnfinished.light{
    /* text-gray-600 */
    color: #718096;
}
.singleProjectId.idTextUnfinished.dark{
    /* text-gray-600 */
    color: #CBD5E0;
}
.singleProjectId.idTextFinished.light{
    color: #F7FAFC;
}
.singleProjectId.idTextFinished.dark{
    color: #1a202c;
}
.singleProjectText{
    /* pl-2 pt-1 */
    padding-left: 0.5rem;
    padding-top: 0.25rem;
}
.singleProjectText.titleTextUnfinished.light{
    color: #4A5568;
}
.singleProjectText.titleTextUnfinished.dark{
    color: #e2e8f0;
}
.singleProjectText.titleTextFinished.light{
    color: #a0aec0;
}
.singleProjectText.titleTextFinished.dark{
    color: #a0aec0;
}
.titleTextLine{
    text-decoration: line-through;
}

.body-projects-panel {
    display: flex;
    width: 300px;
    height: calc(100vh - 94px);
    flex-direction: column;
    overflow-x: hidden;
    overflow-y: hidden;
}
.body-projects-panel.light {
    border-right: 1px solid white;
    background: #F7FAFC;
}
.body-projects-panel.dark {
    border-right: 1px solid black;
    background: #1a202c;
}
#projectsListView {
    width: 100%;
    box-sizing: border-box;
    user-select: none;
    overflow-x: hidden;
    overflow-y: auto;
}
.project_item {
    display: flex;
    flex-direction: column;
    padding: 5px 20px 5px 5px;
    margin: 5px 5px;
    transition: 0.3s;
    cursor: pointer;
}
.project_item.light {
    background: #E2E8F0;
    color: #718096;
}
.project_item.dark {
    background: #4a5568;
    color: #cbd5e0;
}
.project_item:first-child {
    padding: 5px 20px 5px 5px;
    margin: 0px 5px 5px 5px;
}
.project_item.light:hover {
    background: #EDF2F7;
    color: #718096;
}
.project_item.dark:hover {
    background: #2d3748;
    color: #cbd5e0;
}
</style>
