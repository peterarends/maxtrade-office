import axios from "axios";
import moment from "moment";

const state = {
    version: "1.0.1",
    theme: "dark",
    properties: [],
    property_categories: [],
    panel: "",
    current_project_id: 0,
    tasks: [],
    task: [],
    new_task: false,
    current_task_id: 0,
    projects: [],
    project: [],
    new_project: false,
    project_filter: {
        filter09: false,
        filteraz: false,
        filterstatus: "all"
    },
    task_filter: {
        filter09: false,
        filteraz: false,
        filterstatus: "all"
    },
    documents: []
};

const getters = {
    getTheme: state => state.theme,
    getProperties: state => state.properties,
    getPropertyCategories: state => state.property_categories,
    getCurrentProjectId: state => state.current_project_id,
    getTasks: state => state.tasks,
    getTask: state => state.task,
    getNewTask: state => state.new_task,
    getCurrentTaskId: state => state.current_task_id,
    getPanel: state => state.panel,
    getProjects: state => state.projects,
    getProject: state => state.project,
    getNewProject: state => state.new_project,
    getProjectFilter: state => state.project_filter,
    getTaskFilter: state => state.task_filter,
    getDocuments: state => state.documents,
    countAllTasks: state => state.tasks.length,
    countActiveTasks: state => {
        return state.tasks.filter(
            p => p.status === 1
        ).length;
    },
    countEndedTasks: state => {
        return state.tasks.filter(
            p => p.status === 0
        ).length;
    },
    getVersion: state => state.version
};

const actions = {
    // Fetch all properties and set theme and properties
    async fetchProperties({ commit }) {
        const response = await axios.get("api/properties");
        const theme = response.data.data.find(
            prop => prop.name === "theme"
        ).value;
        const properties = response.data.data;
        commit("setTheme", theme);
        commit("setProperties", properties);
    },
    // Fetch properties categories
    async fetchPropertyCategories({ commit }) {
        const response = await axios.get("api/properties_categories");
        const property_categories = response.data.data;
        commit("setPropertyCategories", property_categories);
    },
    // Change theme
    async changeTheme({ commit, state }, event) {
        commit("setTheme", event.target.value);
        await axios.put(
            "api/property",
            {
                property_id: state.properties.find(
                    prop => prop.name === "theme"
                ).id,
                value: state.theme
            },
            { "Content-Type": "application/json; charset=utf-8" });
    },
    // Exit program
    exitProgram() {
        window.location = "/logout.html";
    },
    // Show panel properties
    showProperties({ commit }) {
        commit("setPanel", "properties");
    },
    // Close current panel
    closePanel({ commit }) {
        commit("setPanel", "");
    },
    // Show About panel
    showAbout({ commit }) {
        commit("setPanel", "about");
    },
    // Fetch all projects
    async fetchProjects({ commit }, status) {
        const response = await axios.get("api/projects/" + status);
        commit("setProjects", response.data.data);
    },
    // Show clcicked project and populate tasks panel
    async showProject({ commit }, project) {
        commit("setProject", project);
        commit("setCurrentProjectId", project.id);
        commit("setNewProject", false);
        commit("setPanel", "projects");
        commit("setCurrentTaskId", 0);
        const response = await axios.get("api/tasks/all/" + project.id);
        commit("setTasks", response.data.data);
    },
    // Search in projects panel
    async projectSearch({ commit }, event) {
        const response = await axios.post(
            "api/projects/search",
            {
                search: event.target.value
            },
            { "Content-Type": "application/json; charset=utf-8" });
        commit("setProjects", response.data.data);
    },
    // Toggle project status filter
    toggleProjectStatusFilter({ commit, state, dispatch }) {
        if (state.project_filter.filterstatus == "all") {
            commit("setProjectFilterStatus", "act");
            dispatch("fetchProjects", "act");
        } else {
            if (state.project_filter.filterstatus == "act") {
                commit("setProjectFilterStatus", "end");
                dispatch("fetchProjects", "end");
            } else {
                if (state.project_filter.filterstatus == "end") {
                    commit("setProjectFilterStatus", "all");
                    dispatch("fetchProjects", "all");
                }
            }
        }
    },
    // Toggle project name filter
    toggleProjectNameFilter({ commit, state }) {
        commit("setProjectFilterName", !state.project_filter.filteraz);
        if (state.project_filter.filteraz) {
            state.projects.sort(function (a, b) {
                if (a.title > b.title) return 1;
                if (a.title < b.title) return -1;
            });
        } else {
            state.projects.sort(function (a, b) {
                if (a.title > b.title) return -1;
                if (a.title < b.title) return 1;
            });
        }
    },
    // Toggle project ID filter
    toggleProjectIdFilter({ commit, state }) {
        commit("setProjectFilterId", !state.project_filter.filter09);
        if (state.project_filter.filter09) {
            state.projects.sort(function (a, b) {
                if (a.id > b.id) return 1;
                if (a.id < b.id) return -1;
            });
        } else {
            state.projects.sort(function (a, b) {
                if (a.id > b.id) return -1;
                if (a.id < b.id) return 1;
            });
        }
    },
    // Add project
    addProject({ commit, state, dispatch }) {
        const newProject = {
            id:
                Math.max.apply(
                    Math,
                    state.projects.map(function (o) {
                        return o.id;
                    })
                ) + 1,
            title: "Name of new Project",
            body: "Description of new Project",
            created_at: moment().format(),
            updated_at: "",
            status: 1
        };
        state.projects.unshift(newProject);
        state.project = newProject;
        commit("setCurrentProjectId", newProject.id);
        commit("setNewProject", true);
        commit("setPanel", "projects");
        dispatch("saveProject", false);
    },
    // Delete current project
    async deleteProject({ commit, state }) {
        if (state.current_project_id != 0) {
            if (confirm("Are You sure?")) {
                const response = await axios.delete(
                    "api/project/" + state.project.id,
                    {
                        project_id: state.project.id
                    },
                    { "Content-Type": "application/json; charset=utf-8" });
                commit("setProjects", state.projects.filter(
                    p => p.id !== response.data.data.id
                ));
                commit("setCurrentProjectId", 0);
                commit("setCurrentTaskId", 0);
                commit("setTasks", []);
                commit("setPanel", "");
            }
        }
    },
    // Complete a project and all tasks bind to this project
    completeProject({ commit, state, dispatch }) {
        if (state.current_project_id != 0) {
            commit("setProjectStatus", 0);
            dispatch("saveProject", false);
        }
    },
    // Save current project
    async saveProject({ commit, state }, isMessage) {
        let response = null;
        if (state.new_project) {
            response = await axios.post(
                "api/project",
                {
                    project_id: 0,
                    title: state.project.title,
                    body: state.project.body,
                    status: state.project.status
                },
                { "Content-Type": "application/json; charset=utf-8" });
        } else {
            response = await axios.put(
                "api/project",
                {
                    project_id: state.project.id,
                    title: state.project.title,
                    body: state.project.body,
                    status: state.project.status
                },
                { "Content-Type": "application/json; charset=utf-8" });
        }
        state.project.id = response.data.data.id;
        state.project.title = response.data.data.title;
        state.project.body = response.data.data.body;
        state.project.created_at = response.data.data.created_at;
        state.project.updated_at = response.data.data.updated_at;
        state.project.status = response.data.data.status;
        commit("setNewProject", false);
        if (isMessage) {
            alert(
                "You have successfully saved the changes to the Project: " +
                response.data.data.title
            );
        }
        // change all task status by project
        if (state.project.status == 0) {
            await axios.get("api/task/complete/" + state.project.id);
            state.tasks.forEach(function (part, index) {
                part.status = 0;
            });
        }
    },
    // Add new Task
    addTask({ state, dispatch }) {
        if (state.current_project_id != 0) {
            const newTask = {
                id:
                    Math.max.apply(
                        Math,
                        state.tasks.map(function (o) {
                            return o.id;
                        })
                    ) + 1,
                project_id: state.current_project_id,
                title: "Name of new Task",
                body: "Description of new Task",
                created_at: moment().format(),
                updated_at: "",
                status: 1
            };
            state.tasks.unshift(newTask);
            state.task = newTask;
            state.current_task_id = newTask.id;
            state.new_task = true;
            state.panel = "tasks";
            dispatch("saveTask", false);
        }
    },
    // Save current task
    async saveTask({ commit, state }, isMessage) {
        let response = null;
        if (state.new_task) {
            response = await axios.post(
                "api/task",
                {
                    task_id: 0,
                    project_id: state.current_project_id,
                    title: state.task.title,
                    body: state.task.body,
                    status: state.task.status
                },
                { "Content-Type": "application/json; charset=utf-8" });
        } else {
            response = await axios.put(
                "api/task",
                {
                    task_id: state.task.id,
                    project_id: state.current_project_id,
                    title: state.task.title,
                    body: state.task.body,
                    status: state.task.status
                },
                { "Content-Type": "application/json; charset=utf-8" });
        }
        state.task.id = response.data.data.id;
        state.task.project_id = response.data.data.project_id;
        state.task.title = response.data.data.title;
        state.task.body = response.data.data.body;
        state.task.created_at = response.data.data.created_at;
        state.task.updated_at = response.data.data.updated_at;
        state.task.status = response.data.data.status;
        commit("setNewTask", false);
        if (isMessage) {
            alert(
                "You have successfully saved the changes to the Task: " +
                response.data.data.title
            );
        }
    },
    // Search task by text
    async fetchTasksSearch({ commit, state }, event) {
        const response = await axios.post(
            "api/tasks/search/" + state.current_project_id,
            {
                search: event.target.value
            },
            { "Content-Type": "application/json; charset=utf-8" });
        commit("setTasks", response.data.data);
    },
    // Fetch all tasks
    async fetchTasks({ commit, state }, status) {
        const response = await axios.get("api/tasks/" + status + "/" + state.current_project_id);
        commit("setTasks", response.data.data);
    },
    // Toggle task status filter
    toggleTaskStatusFilter({ commit, state, dispatch }) {
        if (state.task_filter.filterstatus == "all") {
            commit("setTaskFilterStatus", "act");
            dispatch("fetchTasks", "act");
        } else {
            if (state.task_filter.filterstatus == "act") {
                commit("setTaskFilterStatus", "end");
                dispatch("fetchTasks", "end");
            } else {
                if (state.task_filter.filterstatus == "end") {
                    commit("setTaskFilterStatus", "all");
                    dispatch("fetchTasks", "all");
                }
            }
        }
    },
    // Toggle task name filter
    toggleTaskNameFilter({ commit, state }) {
        commit("setTaskFilterName", !state.task_filter.filteraz);
        if (state.task_filter.filteraz) {
            state.tasks.sort(function (a, b) {
                if (a.title > b.title) return 1;
                if (a.title < b.title) return -1;
            });
        } else {
            state.tasks.sort(function (a, b) {
                if (a.title > b.title) return -1;
                if (a.title < b.title) return 1;
            });
        }
    },
    // Toggle tasks ID filter
    toggleTaskIdFilter({ commit, state }) {
        commit("setTaskFilterId", !state.task_filter.filter09);
        if (state.task_filter.filter09) {
            state.tasks.sort(function (a, b) {
                if (a.id > b.id) return 1;
                if (a.id < b.id) return -1;
            });
        } else {
            state.tasks.sort(function (a, b) {
                if (a.id > b.id) return -1;
                if (a.id < b.id) return 1;
            });
        }
    },
    async showTask({ commit }, task) {
        commit("setTask", task);
        commit("setCurrentTaskId", task.id);
        commit("setNewTask", false);
        const response = await axios.get("api/task/documents/" + task.id);
        commit("setDocuments", response.data);
        commit("setPanel", "tasks");
    },
    async deleteTask({ commit, state }) {
        if (state.current_task_id != 0) {
            if (confirm("Are You sure?")) {
                const response = await axios.delete(
                    "api/task/" + state.task.id,
                    {
                        task_id: state.task.id
                    },
                    { "Content-Type": "application/json; charset=utf-8" });
                state.tasks = state.tasks.filter(
                    t => t.id !== response.data.data.id
                );
                commit("setCurrentTaskId", 0);
                commit("setPanel", "");
            }
        }
    },
    // Change task status to complete
    completeTask({ state, dispatch }) {
        if (state.current_task_id != 0) {
            state.task.status = 0;
            dispatch("saveTask", false);
        }
    },
    // Delete selected document from task
    async deleteDocument({ state, dispatch }, current_document) {
        const response = await axios.delete("api/task/document/delete/" + state.task.id + "/" + current_document);
        if (response.data.result === "success") {
            dispatch("changeDocuments");
        } else {
            alert("Document cannot be deleted!");
        }
    },
    // Change documents after commit
    async changeDocuments({ commit, state }) {
        const response = await axios.get("api/task/documents/" + state.task.id);
        commit("setDocuments", response.data);
    },
    // Filter show all projects
    showAllProjects({ state, dispatch }) {
        state.project_filter.filterstatus = "all";
        dispatch("fetchProjects", "all");
    },
    // Filter show completed projects
    showCompletedProjects({ state, dispatch }) {
        state.project_filter.filterstatus = "end";
        dispatch("fetchProjects", "end");
    },
    // Filter show actived projects
    showActivedProjects({ state, dispatch }) {
        state.project_filter.filterstatus = "act";
        dispatch("fetchProjects", "act");
    },
    // Sort projects by ID ACC
    sortProjectsIdAcc({ state }) {
        state.project_filter.filter09 = true;
        state.projects.sort(function (a, b) {
            if (a.id > b.id) return 1;
            if (a.id < b.id) return -1;
        });
    },
    // Sort projects by ID DEC
    sortProjectsIdDec({ state }) {
        state.project_filter.filter09 = false;
        state.projects.sort(function (a, b) {
            if (a.id > b.id) return -1;
            if (a.id < b.id) return 1;
        });
    },
    // Sort projects by Name ACC
    sortProjectsNameAcc({ state }) {
        state.project_filter.filteraz = true;
        state.projects.sort(function (a, b) {
            if (a.title > b.title) return 1;
            if (a.title < b.title) return -1;
        });
    },
    // Sort projects by Name DEC
    sortProjectsNameDec({ state }) {
        state.project_filter.filteraz = false;
        state.projects.sort(function (a, b) {
            if (a.title > b.title) return -1;
            if (a.title < b.title) return 1;
        });
    },
    // Filter show all tasks
    showAllTasks({ state, dispatch }) {
        state.task_filter.filterstatus = "all";
        dispatch("fetchTasks", "all", state.current_project_id);
    },
    // Filter show completed tasks
    showCompletedTasks({ state, dispatch }) {
        state.task_filter.filterstatus = "end";
        dispatch("fetchTasks", "end", state.current_project_id);
    },
    // Filter show actived tasks
    showActivedTasks({ state, dispatch }) {
        state.task_filter.filterstatus = "act";
        dispatch("fetchTasks", "act", state.current_project_id);
    },
    // Sort tasks by ID ACC
    sortTasksIdAcc({ state }) {
        state.task_filter.filter09 = true;
        state.tasks.sort(function (a, b) {
            if (a.id > b.id) return 1;
            if (a.id < b.id) return -1;
        });
    },
    // Sort tasks by ID DEC
    sortTasksIdDec({ state }) {
        state.task_filter.filter09 = false;
        state.tasks.sort(function (a, b) {
            if (a.id > b.id) return -1;
            if (a.id < b.id) return 1;
        });
    },
    // Sort tasks by Name ACC
    sortTasksNameAcc({ state }) {
        state.task_filter.filteraz = true;
        state.tasks.sort(function (a, b) {
            if (a.title > b.title) return 1;
            if (a.title < b.title) return -1;
        });
    },
    // Sort tasks by Name DEC
    sortTasksNameDec() {
        state.task_filter.filteraz = false;
        state.tasks.sort(function (a, b) {
            if (a.title > b.title) return -1;
            if (a.title < b.title) return 1;
        });
    }
};

const mutations = {
    setTheme: (state, theme) => (state.theme = theme),
    setProperties: (state, properties) => (state.properties = properties),
    setPropertyCategories: (state, property_categories) => (state.property_categories = property_categories),
    setPanel: (state, panel) => (state.panel = panel),
    setProjects: (state, projects) => (state.projects = projects),
    setProject: (state, project) => (state.project = project),
    setCurrentProjectId: (state, current_project_id) => (state.current_project_id = current_project_id),
    setNewProject: (state, new_project) => (state.new_project = new_project),
    setTasks: (state, tasks) => (state.tasks = tasks),
    setTask: (state, task) => (state.task = task),
    setCurrentTaskId: (state, current_task_id) => (state.current_task_id = current_task_id),
    setNewTask: (state, new_task) => (state.new_task = new_task),
    setProjectFilterStatus: (state, status) => (state.project_filter.filterstatus = status),
    setProjectFilterName: (state, filteraz) => (state.project_filter.filteraz = filteraz),
    setProjectFilterId: (state, filter09) => (state.project_filter.filter09 = filter09),
    setProjectStatus: (state, status) => (state.project.status = status),
    setTaskFilterStatus: (state, status) => (state.task_filter.filterstatus = status),
    setTaskFilterName: (state, filteraz) => (state.task_filter.filteraz = filteraz),
    setTaskFilterId: (state, filter09) => (state.task_filter.filter09 = filter09),
    setDocuments: (state, documents) => (state.documents = documents)
};

export default {
    state,
    getters,
    actions,
    mutations
};
