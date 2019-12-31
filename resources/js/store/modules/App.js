import axios from "axios";

const state = {
    theme: "dark",
    properties: [],
    property_categories: [],
    panel: "",
    current_project_id: 0,
    tasks: [],
    current_task_id: 0
};

const getters = {
    getTheme: state => state.theme,
    getProperties: state => state.properties,
    getPropertyCategories: state => state.property_categories,
    getCurrentProjectId: state => state.current_project_id,
    getTasks: state => state.tasks,
    getCurrentTaskId: state => state.current_task_id,
    getPanel: state => state.panel
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
    toggleProjectIdFilter() {

    },
    toggleProjectNameFilter() {

    },
    toggleProjectStatusFilter() {

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
    setPanel: (state, panel) => (state.panel = panel)
};

export default {
    state,
    getters,
    actions,
    mutations
};
