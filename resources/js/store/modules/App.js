import axios from "axios";
import moment from "moment";

const state = {
    version: "1.0.1",
    theme: "dark",
    lng: "en_US",
    properties: [],
    property_categories: [],
    panel: "",
    current_project_id: 0,
    tasks: [],
    tasks_temp: [],
    tasks_search: [],
    task: [],
    new_task: false,
    current_task_id: 0,
    projects: [],
    projects_temp: [],
    projects_search: [],
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
    documents: [],
    user_name: document.getElementsByTagName("App")[0].getAttribute("userName"),
    user_id: document.getElementsByTagName("App")[0].getAttribute("userId"),
    progress: 0,
    users: [],
    users_projects: [],
    contacts: [],
    current_contact: [],
    imaps: [],
    current_imap_id: 0
};

const getters = {
    getTheme: state => state.theme,
    getLanguage: state => state.lng,
    getProperties: state => state.properties,
    getPropertyCategories: state => state.property_categories,
    getCurrentProjectId: state => state.current_project_id,
    getTasks: state => state.tasks,
    getTasksTemp: state => state.tasks_temp,
    getTask: state => state.task,
    getNewTask: state => state.new_task,
    getCurrentTaskId: state => state.current_task_id,
    getPanel: state => state.panel,
    getProjects: state => state.projects,
    getProjectsTemp: state => state.projects_temp,
    getProjectsSearch: state => state.projects_search,
    getTasksSearch: state => state.tasks_search,
    getProject: state => state.project,
    getNewProject: state => state.new_project,
    getProjectFilter: state => state.project_filter,
    getTaskFilter: state => state.task_filter,
    getDocuments: state => state.documents,
    countAllTasks: state => state.tasks.length,
    countActiveTasks: state => {
        return state.tasks.filter(p => p.status === 1).length;
    },
    countEndedTasks: state => {
        return state.tasks.filter(p => p.status === 0).length;
    },
    getVersion: state => state.version,
    getUserName: state => state.user_name,
    getUserId: state => state.user_id,
    getProgress: state => state.progress,
    getUsers: state => state.users,
    getUsersProjects: state => state.users_projects,
    getCurrentUser: state => state.current_user,
    getContacts: state => state.contacts,
    getCurrentContact: state => state.current_contact,
    getImaps: state => state.imaps,
    getCurrentImapId: state => state.current_imap_id
};

const actions = {
    // Fetch all properties and set theme and properties
    async fetchProperties({ commit, dispatch }) {
        const response = await axios.get("api/properties");
        const theme = response.data.data.find(prop => prop.name === "theme")
            .value;
        const lng = response.data.data.find(prop => prop.name === "language")
            .value;
        const projectfilter = response.data.data.find(
            prop => prop.name === "projectfilter"
        ).value;
        const taskfilter = response.data.data.find(
            prop => prop.name === "taskfilter"
        ).value;
        const properties = response.data.data;
        commit("setTheme", theme);
        commit("setLanguage", lng);
        commit("setProjectFilterStatus", projectfilter);
        commit("setTaskFilterStatus", taskfilter);
        commit("setProperties", properties);
        dispatch("fetchProjects", projectfilter);
    },
    // Fetch properties categories
    async fetchPropertyCategories({ commit }) {
        const response = await axios.get("api/properties_categories");
        const property_categories = response.data.data;
        commit("setPropertyCategories", property_categories);
    },
    // Change theme
    async changeTheme({ commit, state }, theme) {
        commit("setTheme", theme);
        await axios.put(
            "api/property",
            {
                property_id: state.properties.find(
                    prop => prop.name === "theme"
                ).id,
                value: theme
            },
            { "Content-Type": "application/json; charset=utf-8" }
        );
    },
    // Change language
    async changeLanguage({ commit, state }, lng) {
        commit("setLanguage", lng);
        await axios.put(
            "api/property",
            {
                property_id: state.properties.find(
                    prop => prop.name === "language"
                ).id,
                value: lng
            },
            { "Content-Type": "application/json; charset=utf-8" }
        );
    },
    // Change project filter
    async changeProjectFilter({ commit, state, dispatch }, filter) {
        commit("setProjectFilterStatus", filter);
        await axios.put(
            "api/property",
            {
                property_id: state.properties.find(
                    prop => prop.name === "projectfilter"
                ).id,
                value: filter
            },
            { "Content-Type": "application/json; charset=utf-8" }
        );
        dispatch("fetchProjects", filter);
    },
    // Change task filter
    async changeTaskFilter({ commit, state, dispatch }, filter) {
        commit("setTaskFilterStatus", filter);
        await axios.put(
            "api/property",
            {
                property_id: state.properties.find(
                    prop => prop.name === "taskfilter"
                ).id,
                value: filter
            },
            { "Content-Type": "application/json; charset=utf-8" }
        );
        dispatch("fetchTasks", filter);
    },
    // Exit program
    exitProgram() {
        window.location = "/logout.html";
    },
    // Show panel properties
    showProperties({ commit }) {
        commit("setPanel", "properties");
    },
    // Show panel contacts
    showContacts({ commit, dispatch }) {
        dispatch("fetchContacts");
        commit("setPanel", "contacts");
    },
    // Show panel emails
    showEmails({ commit, dispatch }) {
        dispatch("fetchImaps");
        commit("setPanel", "emails");
    },
    // Show panel all tasks
    showSearchtasks({ commit }) {
        commit("setPanel", "searchtasks");
    },
    // Close current panel
    closePanel({ dispatch }) {
        dispatch("readyState");
    },
    // Show About panel
    showAbout({ commit }) {
        commit("setPanel", "about");
    },
    // Show Users panel
    showUsers({ commit }) {
        commit("setPanel", "users");
    },
    // Fetch all users
    async fetchUsers({ commit }) {
        const response = await axios.get("api/users");
        commit("setUsers", response.data.data);
    },
    // Fetch users to project
    async fetchUsersByProjects({ commit }, id) {
        const response = await axios.get("api/users/project/" + id);
        commit("setUsersProjects", response.data.data);
    },
    // Add user to project
    async addUsersProject({ state }, user_id) {
        const response = await axios.post(
            "api/add/user",
            {
                userid: user_id,
                projectid: state.current_project_id
            },
            { "Content-Type": "application/json; charset=utf-8" }
        );
        const newUsersProject = {
            id: response.data.data.id,
            name: response.data.data.name,
            email: response.data.data.email,
            created_at: response.data.data.created_at,
            updated_at: response.data.data.updated_at
        };
        state.users_projects.unshift(newUsersProject);
    },
    // Delete user from project
    deleteUsersProject({ state }, user_id) {
        state.users_projects = state.users_projects.filter(
            u => u.id != user_id
        );
        axios.delete(
            "api/delete/user/" +
            user_id +
            "/project/" +
            state.current_project_id
        );
    },
    // Fetch all projects
    async fetchProjects({ commit }) {
        const response = await axios.get("api/projects/" + state.user_id);
        commit("setProjectsTemp", response.data.data);
        if (state.project_filter.filterstatus == "all") {
            commit("setProjects", state.projects_temp);
        } else {
            if (state.project_filter.filterstatus == "act") {
                commit(
                    "setProjects",
                    state.projects_temp.filter(p => p.status == 1)
                );
            } else {
                if (state.project_filter.filterstatus == "end") {
                    commit(
                        "setProjects",
                        state.projects_temp.filter(p => p.status == 0)
                    );
                }
            }
        }
    },
    // Show clcicked project and populate tasks panel
    async showProject({ state, commit, dispatch }, project) {
        commit("setProject", project);
        commit("setCurrentProjectId", project.id);
        commit("setNewProject", false);
        commit("setPanel", "projects");
        commit("setCurrentTaskId", 0);
        const response = await axios.get(
            "api/tasks/" + state.task_filter.filterstatus + "/" + project.id
        );
        commit("setTasks", response.data.data);
        commit("setTasksTemp", response.data.data);
        dispatch("fetchUsersByProjects", project.id);
    },
    // Search in projects panel
    async projectSearch({ state, commit }, event) {
        commit(
            "setProjects",
            state.projects_temp.filter(p =>
                p.title.toUpperCase().includes(event.target.value.toUpperCase())
            )
        );
    },
    // Search in projects and task
    async allSearch({ state, commit }, event) {
        const response = await axios.post(
            "api/search",
            {
                search: event.target.value,
                user_id: state.user_id
            },
            { "Content-Type": "application/json; charset=utf-8" }
        );
        commit("setProjectsSearch", response.data.projects);
        commit("setTasksSearch", response.data.tasks);
    },
    clearSearch({ commit }) {
        commit("setProjectsSearch", []);
        commit("setTasksSearch", []);
    },
    // Toggle project status filter
    toggleProjectStatusFilter({ commit, state }) {
        if (state.project_filter.filterstatus == "all") {
            commit("setProjectFilterStatus", "act");
            commit(
                "setProjects",
                state.projects_temp.filter(p => p.status == 1)
            );
        } else {
            if (state.project_filter.filterstatus == "act") {
                commit("setProjectFilterStatus", "end");
                commit(
                    "setProjects",
                    state.projects_temp.filter(p => p.status == 0)
                );
            } else {
                if (state.project_filter.filterstatus == "end") {
                    commit("setProjectFilterStatus", "all");
                    commit("setProjects", state.projects_temp);
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
            status: 1,
            user_id: state.user_id,
            last_name: state.user_name,
            last_id: state.user_id
        };
        state.projects.unshift(newProject);
        commit("setProject", newProject);
        commit("setCurrentProjectId", newProject.id);
        commit("setNewProject", true);
        commit("setTasks", []);
        commit("setTask", []);
        commit("setCurrentTaskId", 0);
        commit("setDocuments", []);
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
                    { "Content-Type": "application/json; charset=utf-8" }
                );
                commit(
                    "setProjects",
                    state.projects.filter(p => p.id !== response.data.data.id)
                );
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
                    status: state.project.status,
                    user_id: state.user_id,
                    last_name: state.user_name,
                    last_id: state.user_id
                },
                { "Content-Type": "application/json; charset=utf-8" }
            );
        } else {
            response = await axios.put(
                "api/project",
                {
                    project_id: state.project.id,
                    title: state.project.title,
                    body: state.project.body,
                    status: state.project.status,
                    user_id: state.project.user_id,
                    last_name: state.user_name,
                    last_id: state.user_id
                },
                { "Content-Type": "application/json; charset=utf-8" }
            );
        }
        state.project.id = response.data.data.id;
        state.project.title = response.data.data.title;
        state.project.body = response.data.data.body;
        state.project.created_at = response.data.data.created_at;
        state.project.updated_at = response.data.data.updated_at;
        state.project.status = response.data.data.status;
        state.project.user_id = response.data.data.user_id;
        state.project.last_name = response.data.data.last_name;
        state.project.last_id = response.data.data.last_id;
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
    addTask({ state, commit, dispatch }) {
        if (state.current_project_id != 0) {
            commit("setDocuments", []);
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
                status: 1,
                decision: "",
                last_name: state.user_name,
                last_id: state.user_id
            };
            state.tasks.unshift(newTask);
            commit("setTask", newTask);
            commit("setCurrentTaskId", newTask.id);
            commit("setNewTask", true);
            commit("setPanel", "tasks");
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
                    status: state.task.status,
                    decision: state.task.decision,
                    last_name: state.user_name,
                    last_id: state.user_id,
                    isfiles: 0
                },
                { "Content-Type": "application/json; charset=utf-8" }
            );
        } else {
            response = await axios.put(
                "api/task",
                {
                    task_id: state.task.id,
                    project_id: state.current_project_id,
                    title: state.task.title,
                    body: state.task.body,
                    status: state.task.status,
                    decision: state.task.decision,
                    last_name: state.user_name,
                    last_id: state.user_id,
                    isfiles: state.documents.length > 0 ? 1 : 0
                },
                { "Content-Type": "application/json; charset=utf-8" }
            );
        }
        state.task.id = response.data.data.id;
        state.task.project_id = response.data.data.project_id;
        state.task.title = response.data.data.title;
        state.task.body = response.data.data.body;
        state.task.created_at = response.data.data.created_at;
        state.task.updated_at = response.data.data.updated_at;
        state.task.status = response.data.data.status;
        state.task.decision = response.data.data.decision;
        state.task.last_name = response.data.data.last_name;
        state.task.last_id = response.data.data.last_id;
        state.task.isfiles = response.data.data.isfiles;
        commit("setNewTask", false);
        commit("setCurrentTaskId", response.data.data.id);
        if (isMessage) {
            alert(
                "You have successfully saved the changes to the Task: " +
                response.data.data.title
            );
        }
    },
    // Search task by text
    async fetchTasksSearch({ commit, state }, event) {
        commit(
            "setTasks",
            state.tasks_temp.filter(p =>
                p.title.toUpperCase().includes(event.target.value.toUpperCase())
            )
        );
    },
    // Fetch all tasks
    async fetchTasks({ commit, state }, status) {
        const response = await axios.get(
            "api/tasks/" + status + "/" + state.current_project_id
        );
        commit("setTasksTemp", response.data.data);
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
                    { "Content-Type": "application/json; charset=utf-8" }
                );
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
        const response = await axios.delete(
            "api/task/document/delete/" + state.task.id + "/" + current_document
        );
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
    },
    // Fetch all contacts
    async fetchContacts({ commit, state }) {
        const response = await axios.get("api/contacts/" + state.user_id);
        commit("setContacts", response.data.data);
    },
    changeCurrentContact({ commit }, current_contact) {
        commit("setCurrentContact", current_contact);
    },
    // Delete contact
    deleteContact({ state }) {
        state.contacts = state.contacts.filter(
            c => c.id != state.current_contact.id
        );
        axios.delete("api/contact/" + state.current_contact.id);
    },
    // Save changed contacts
    async saveContacts() {
        const response = await axios.post(
            "api/contacts",
            {
                contacts: state.contacts
            },
            { "Content-Type": "application/json; charset=utf-8" }
        );
    },
    // Save new contact
    async addContact({ commit, state }) {
        const response = await axios.post(
            "api/contact",
            {
                name: "Name of new Contact",
                phone: "",
                email: "",
                description: "",
                user_id: state.user_id
            },
            { "Content-Type": "application/json; charset=utf-8" }
        );
        const newContact = {
            id: response.data.data.id,
            name: response.data.data.name,
            phone: response.data.data.phone,
            email: response.data.data.email,
            description: response.data.data.description,
            user_id: response.data.data.user_id,
            created_at: response.data.data.created_at,
            updated_at: response.data.data.updated_at
        };
        state.contacts.unshift(newContact);
        commit("setCurrentContact", newContact);
    },
    // Search in contacts
    async allSearchContacts({ state, commit }, event) {
        const response = await axios.post(
            "api/contacts/search",
            {
                search: event.target.value,
                user_id: state.user_id
            },
            { "Content-Type": "application/json; charset=utf-8" }
        );
        commit("setContacts", response.data.data);
    },
    // Fetch all imaps
    fetchImaps({ commit, state, dispatch }) {
        const counter = setInterval(() => {
            const current_progress = state.progress;
            if (current_progress == 10) {
                commit("setProgress", 0);
            } else {
                commit("setProgress", current_progress + 1);
            }
        }, 500);
        axios.get("api/imaps/" + state.user_id)
            .then(response => {
                commit("setImaps", response.data);
                clearInterval(counter);
                commit("setProgress", 0);
            });
    },
    // Refresh to ready state
    readyState({ commit }) {
        commit("setCurrentProjectId", 0);
        commit("setCurrentTaskId", 0);
        commit("setProject", []);
        commit("setTask", []);
        commit("setTasks", []);
        commit("setDocuments", []);
        commit("setPanel", "");
    },
    changeProgress({ commit }, progress) {
        commit("setProgress", progress);
    }
};

const mutations = {
    setTheme: (state, theme) => (state.theme = theme),
    setLanguage: (state, lng) => (state.lng = lng),
    setProperties: (state, properties) => (state.properties = properties),
    setPropertyCategories: (state, property_categories) =>
        (state.property_categories = property_categories),
    setPanel: (state, panel) => (state.panel = panel),
    setProjects: (state, projects) => (state.projects = projects),
    setProjectsTemp: (state, projects_temp) =>
        (state.projects_temp = projects_temp),
    setProjectsSearch: (state, projects_search) =>
        (state.projects_search = projects_search),
    setTasksSearch: (state, tasks_search) =>
        (state.tasks_search = tasks_search),
    setProject: (state, project) => (state.project = project),
    setCurrentProjectId: (state, current_project_id) =>
        (state.current_project_id = current_project_id),
    setNewProject: (state, new_project) => (state.new_project = new_project),
    setTasks: (state, tasks) => (state.tasks = tasks),
    setTasksTemp: (state, tasks_temp) => (state.tasks_temp = tasks_temp),
    setTask: (state, task) => (state.task = task),
    setCurrentTaskId: (state, current_task_id) =>
        (state.current_task_id = current_task_id),
    setNewTask: (state, new_task) => (state.new_task = new_task),
    setProjectFilterStatus: (state, status) =>
        (state.project_filter.filterstatus = status),
    setProjectFilterName: (state, filteraz) =>
        (state.project_filter.filteraz = filteraz),
    setProjectFilterId: (state, filter09) =>
        (state.project_filter.filter09 = filter09),
    setProjectStatus: (state, status) => (state.project.status = status),
    setTaskFilterStatus: (state, status) =>
        (state.task_filter.filterstatus = status),
    setTaskFilterName: (state, filteraz) =>
        (state.task_filter.filteraz = filteraz),
    setTaskFilterId: (state, filter09) =>
        (state.task_filter.filter09 = filter09),
    setDocuments: (state, documents) => (state.documents = documents),
    setProgress: (state, progress) => (state.progress = progress),
    setUsers: (state, users) => (state.users = users),
    setUsersProjects: (state, users_projects) =>
        (state.users_projects = users_projects),
    setContacts: (state, contacts) => (state.contacts = contacts),
    setCurrentContact: (state, current_contact) =>
        (state.current_contact = current_contact),
    setImaps: (state, imaps) => (state.imaps = imaps),
    setCurrentImapId: (state, current_imap_id) =>
        (state.current_imap_id = current_imap_id)
};

export default {
    state,
    getters,
    actions,
    mutations
};
