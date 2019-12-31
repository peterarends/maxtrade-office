import axios from "axios";

const state = {
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
    getDocuments: state => state.documents
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
    completeProject() {

    },
    showAllProjects() {

    },
    showCompletedProjects() {

    },
    showActivedProjects() {

    },
    sortProjectsIdAcc() {

    },
    sortProjectsIdDec() {

    },
    sortProjectsNameAcc() {

    },
    sortProjectsNameDec() {

    },
    completeTask() {

    },
    showAllTasks() {

    },
    showCompletedTasks() {

    },
    showActivedTasks() {

    },
    sortTasksIdAcc() {

    },
    sortTasksIdDec() {

    },
    sortTasksNameAcc() {

    },
    sortTasksNameDec() {

    },
    addProject() {

    },
    deleteProject() {

    },
    addTask() {

    },
    deleteTask() {

    },
    changeProject() {

    },
    fetchProjectsSearch() {

    },
    changeTask() {

    },
    toggleTaskIdFilter() {

    },
    toggleTaskNameFilter() {

    },
    toggleTaskStatusFilter() {

    },
    fetchTasksSearch() {

    },
    changeDocuments() {

    },
    deleteDocument() {

    },
    getTasks() {

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
    setCurrentTaskId: (state, current_task_id) => (state.current_task_id = current_task_id),
    setTasks: (state, tasks) => (state.tasks = tasks),
    setProjectFilterStatus: (state, status) => (state.project_filter.filterstatus = status),
    setProjectFilterName: (state, filteraz) => (state.project_filter.filteraz = filteraz),
    setProjectFilterId: (state, filter09) => (state.project_filter.filter09 = filter09)
};

export default {
    state,
    getters,
    actions,
    mutations
};
