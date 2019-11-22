<template>
    <div class="body-projects-panel">
        <div class="topProjectsDiv">
            <input
                type="text"
                class="searchInput"
                placeholder="projects search ..."
            />
            <div
                class="searchElementsDiv"
            >
                <i
                    class="mdi mdi-filter searchIcons"
                ></i>
                <div>
                    <i
                        class="mdi mdi-airplane searchIcons"
                    ></i>
                    <i
                        class="mdi mdi-sort-alphabetical searchIcons"
                    ></i>
                    <i
                        class="mdi mdi-sort-numeric searchIcons"
                    ></i>
                </div>
            </div>
        </div>
        <div id="projectsListView">
            <div class="project_item" v-for="project in projects" v-bind:key="project.id">
                <div
                    class="dateText"
                    v-bind:class="[
                        project.status == 0 ? 'dateWithLine' : '',
                        'dateWithoutLine'
                    ]"
                >
                    {{ project.created_at | formatDate }}
                </div>
                <div class="singleProjectDiv">
                    <div
                        class="singleProjectId"
                        v-bind:class="[
                            project.status == 0 ? '' : 'idBackground',
                            '',
                            project.status == 0
                                ? 'idTextUnfinished'
                                : 'idTextFinished',
                            ''
                        ]"
                    >
                        {{ project.id }}
                    </div>
                    <div
                        class="pl-2 pt-1"
                        v-bind:class="[
                            project.status == 0 ? 'titleTextFinished' : '',
                            'titleTextUninished',
                            project.status == 0 ? 'titleTextLine' : '',
                            ''
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
            options: [],
            theme: "light"
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
    }
};
</script>

<style scoped>

/** Top part of projects */
.topProjectsDiv{
    /* flex items-center p-1 bg-gray-900 */
    display: flex;
    align-items: center;
    padding: 0.25rem;
    background-color: #1a202c;
}

/** Search style */
.searchInput{
    /* bg-gray-900 border-gray-800 border rounded w-1/2 pl-1 pb-1 text-gray-300
            placeholder-gray-700 mr-1 */
    background-color: #1a202c;
    border: 1px solid  #2d3748;
    border-radius: .25rem;
    width: 50%;
    padding-left: 0.25rem;
    padding-bottom: 0.25rem;
    color: #e2e8f0;
    margin-right: 0.25rem;
}
.searchInput::placeholder{
    color: #4a5568;
}
/** Search by element */
.searchElementsDiv{
    /* flex items-center justify-center border-l border-gray-700 border-dotted pl-1 */
    display: flex;
    justify-content: center;
    border-left: 1px dotted #4a5568;
    padding-left: 0.25rem;
}

/** Search by element icons */
.searchIcons{
    /* text-2xl text-gray-500 hover:text-gray-100 */
    font-size: 1.5rem;
    color: #a0aec0;
}
.searchIcons:hover{
    color: #f7fafc;
}

/** Date style */
.dateText{
    /* flex justify-end text-xs */
    display: flex;
    justify-content: flex-end;
    font-size: .75rem;
}
.dateWithLine{
    /* text-gray-500 line-through */
    color: #a0aec0;
    text-decoration: line-through;
}
.dateWithoutLine{
    /* text-gray-400 */
    color: #cbd5e0;
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
.idBackground{
    /* bg-gray-600 */
    background-color: #718096;
}
.idTextUnfinished{
    /* text-gray-600 */
    color: #718096;
}
.idTextFinished{
    color: #1a202c;
}
.titleTextUnfinished{
    color: #e2e8f0;
}
.titleTextFinished{
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
    border-right: 1px solid black;
    background: #1a202c;
    overflow-x: hidden;
    overflow-y: hidden;
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
    background: #4a5568;
    color: #cbd5e0;
    margin: 5px 5px;
    transition: 0.3s;
    cursor: pointer;
}
.project_item:first-child {
    padding: 5px 20px 5px 5px;
    margin: 0px 5px 5px 5px;
}
.project_item:hover {
    background: #2d3748;
    color: #cbd5e0;
}
</style>
