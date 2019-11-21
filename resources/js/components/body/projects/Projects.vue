<template>
    <div class="body-projects-panel">
        <div class="flex items-center p-1 bg-gray-900">
            <input
                type="text"
                class="bg-gray-900 border-gray-800 border rounded w-1/2 pl-1 pb-1 text-gray-300
            placeholder-gray-700 mr-1"
                placeholder="projects search ..."
            />
            <div
                class="flex items-center justify-center border-l border-gray-700 border-dotted pl-1"
            >
                <i
                    class="mdi mdi-filter text-2xl text-gray-500 hover:text-gray-100"
                ></i>
                <div>
                    <i
                        class="mdi mdi-airplane text-2xl text-gray-500 hover:text-gray-100"
                    ></i>
                    <i
                        class="mdi mdi-sort-alphabetical text-2xl text-gray-500 hover:text-gray-100"
                    ></i>
                    <i
                        class="mdi mdi-sort-numeric text-2xl text-gray-500 hover:text-gray-100"
                    ></i>
                </div>
            </div>
        </div>
        <div id="projectsListView">
            <div class="project_item" v-for="project in projects" v-bind:key="project.id">
                <div
                    class="flex justify-end text-xs"
                    v-bind:class="[
                        project.status == 0 ? 'text-gray-500 line-through' : '',
                        'text-gray-400'
                    ]"
                >
                    {{ project.created_at | formatDate }}
                </div>
                <div class="flex">
                    <div
                        class="rounded-full h-6 w-6 text-xs flex items-center
                    justify-center"
                        v-bind:class="[
                            project.status == 0 ? '' : 'bg-gray-600',
                            '',
                            project.status == 0
                                ? 'text-gray-600'
                                : 'text-gray-900',
                            ''
                        ]"
                    >
                        {{ project.id }}
                    </div>
                    <div
                        class="pl-2 pt-1"
                        v-bind:class="[
                            project.status == 0 ? 'text-gray-500' : '',
                            'text-gray-300',
                            project.status == 0 ? 'line-through' : '',
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
