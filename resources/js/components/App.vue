<template>
    <div class="mainDiv" :class="getTheme">
        <top-bar></top-bar>
        <!-- Start Body panel -->
        <div class="body" :class="getTheme">
            <leftmenu></leftmenu>
            <projects-panel></projects-panel>
            <tasks-panel></tasks-panel>
            <div class="mainDivBodypanel" :class="getTheme">
                <properties v-show="getPanel == 'properties'"></properties>
                <projects v-show="getPanel == 'projects'"></projects>
                <tasks v-show="getPanel == 'tasks'"></tasks>
                <about v-show="getPanel == 'about'"></about>
                <contacts v-show="getPanel == 'contacts'"></contacts>
                <emails v-show="getPanel == 'emails'"></emails>
                <searchtasks v-show="getPanel == 'searchtasks'"></searchtasks>
                <users v-show="getPanel == 'users'"></users>
                <profile v-show="getPanel == 'profile'"></profile>
            </div>
        </div>
        <!-- End body panel -->
        <footer-bar></footer-bar>
    </div>
</template>

<script>
import Vue from "vue";
import TopBar from "./body/TopBar";
import Leftmenu from "./body/Leftmenu";
import ProjectsPanel from "./body/ProjectsPanel";
import TasksPanel from "./body/TasksPanel";
import Properties from "./body/Properties";
import Projects from "./body/Projects";
import Users from "./body/Users";
import Tasks from "./body/Tasks";
import About from "./body/About";
import Contacts from "./body/Contacts";
import Profile from "./body/Profile";
import Emails from "./body/Emails";
import Searchtasks from "./body/Searchtasks";
import FooterBar from "./body/FooterBar";
import { mapGetters, mapActions } from "vuex";
import VueTranslate from "vue-translate-plugin";

Vue.use(VueTranslate);

export default {
    name: "App",

    components: {
        TopBar,
        Leftmenu,
        ProjectsPanel,
        TasksPanel,
        Properties,
        Projects,
        Users,
        Tasks,
        About,
        Contacts,
        Profile,
        Emails,
        Searchtasks,
        FooterBar
    },

    async created() {
        await this.fetchProperties();
        this.$translate.setLang(this.getLanguage);
    },

    locales: {
        en_US: {},
        bg_BG: {
            File: "Програма",
            Exit: "Изход",
            Projects: "Проекти",
            "Add Project": "Добави Проект",
            "Delete Project": "Изтрий Проект",
            "Add Task": "Добави Задача",
            "Complete Project": "Приключи Проект",
            "Projects Filter": "Филтър Проекти",
            "All Projects": "Всички Проекти",
            "Completed Projects": "Приключени Проекти",
            "Actived Projects": "Активни Проекти",
            "Projects Sort": "Подреждане на Проекти",
            "Id Ascending": "По ИД Възходящо",
            "Id Descending": "По ИД Низходящо",
            "Name A-Z": "По Име А-Я",
            "Name Z-A": "По Име Я-А",
            Tasks: "Задачи",
            "Delete Task": "Изтрий Задача",
            "Complete Task": "Приключи задача",
            "Tasks Filter": "Филтър Задачи",
            "All Tasks": "Всички Задачи",
            "Completed Tasks": "Приключени Задачи",
            "Actived Tasks": "Активни задачи",
            "Tasks Sort": "Подреждане на Задачи",
            Panels: "Модули",
            "Search Panel": "Модул Търсене",
            "E-Mails": "Модул E-Mails",
            Contacts: "Модул Контакти",
            Tools: "Инструменти",
            Options: "Настройки",
            Help: "Помощ",
            About: "За Програмата",
            "Return to ready state": "Върни в началото",
            "Show Search Panel": "Покажи панела за търсене",
            "Show Mails Panel": "Покажи панела съобщения",
            "Show Contacts Panel": "Покажи панела контакти",
            Project: "Проект",
            "Date start": "Начало",
            "Date end": "Край",
            Continues: "Не е завършен",
            "Status of the project": "Състояние на проекта",
            "Ended tasks": "Приключени задачи",
            Save: "Запиши",
            Delete: "Изтрий",
            Export: "Експортирай",
            Close: "Затвори",
            "Last change": "Последна промяна",
            Active: "Активен",
            Completed: "Приключен",
            "projects search ...": "търси в проекти ...",
            Properties: "Настройки",
            "search settings ...": "търси в настройки ...",
            properties: "настройки",
            "Dark theme": "Тъмна тема",
            "Light theme": "Светла тема",
            "Show All projects": "Покажи всички проекти",
            "Show Active projects": "Покажи активните проекти",
            "Show Ended projects": "Покажи приключените проекти",
            "Show All tasks": "Покажи всички задачи",
            "Show Active tasks": "Покажи активните задачи",
            "Show Ended tasks": "Покажи приключените задачи",
            Bulgarian: "Български",
            English: "Английски",
            "Search Projects and Tasks": "Търси в Проекти и задачи",
            Task: "Задача",
            "Status of the task": "Състояние на задачата",
            "Short description of the decision ...":
                "Описание на решението ...",
            "Documents attached to this task":
                "Документи прикачени към тази задача",
            "Add selected file.": "Добави избрания файл.",
            Add: "Добави",
            "Delete File": "Изтрий файла",
            "tasks search ...": "търси в задачи ...",
            "New Task": "Нова Задача",
            Users: "Потребители",
            "Managing users to a Project":
                "Управление на потребители към Проекта",
            "Add the selected user to those who are allowed to work with the project":
                "Добави избрания потребител към тези на които е позволено да работят с проекта",
            "Users attached to this project":
                "Потребители прикачени към този проект",
            "Choose User to add...":
                "Изберете потребител за добавяне към проекта",
            "Remove User": "Премахни потребителя",
            owner: "собственик",
            "search for a match ...": "търси за съвпадение ...",
            "Search in Projects and Tasks ...": "Търси в Проекти и Задачи ...",
            Search: "Търси",
            "Matches in Projects": "Съвпадения в Проекти",
            "#": "№",
            "Created at": "Създаден на",
            "Matches in Tasks": "Съвпадения в Задачи",
            "contact name ...": "име на контакта ...",
            "phone ...": "телефон ...",
            "email ...": "email ...",
            "description ...": "описание ...",
            "Do you want to delete the contact?":
                "Желаете ли да изтриете контакта?",
            "You have successfully saved the changes!":
                "Успешно записахте промените!",
            "New Project": "Нов Проект",
            "To Current Task": "Към Задачата",
            Profile: "Потребителски профил"
        }
    },

    computed: mapGetters([
        "getTheme",
        "getPanel",
        "getProjectFilter",
        "getLanguage"
    ]),

    watch: {
        getPanel: function(newPanel, oldPanel) {
            if (oldPanel == "contacts") {
                this.saveContacts();
            }
        }
    },

    methods: {
        ...mapActions(["fetchProperties", "fetchProjects", "saveContacts"])
    }
};
</script>

<style>
.mainDiv {
    display: flex;
    flex-direction: column;
    height: 100%;
}
.mainDiv.light {
    background-color: #fff;
}
.mainDiv.dark {
    background-color: #000;
}
/* Start Body panel */
.body {
    display: flex;
    flex: 1;
}
.body.light {
    color: #718096;
    border-top: 1px solid #f7fafc;
}
.body.dark {
    color: #cbd5e0;
    border-top: 1px solid #1a202c;
}
.mainDivBodypanel {
    display: flex;
    flex: 1;
}
.mainDivBodypanel.light {
    background-color: #f7fafc;
}
.mainDivBodypanel.dark {
    background-color: #1a202c;
}
/* End Body panel */
/* Projects and Tasks List View */
h1 {
    font-size: 28px;
}
h2 {
    font-size: 24px;
}
h3 {
    font-size: 20px;
}
h4 {
    font-size: 18px;
}
h5 {
    font-size: 16px;
}
.list-dot {
    color: #4682b4;
    font-size: 12px;
    padding-right: 5px;
}
.list-dot-task {
    color: #ff8c00;
    font-size: 12px;
    padding-right: 5px;
}
.list-dot-task.ended {
    color: #868686;
}
.list-name {
    display: table-cell;
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    height: 20px;
    font-weight: 600;
}
.list-description {
    display: block;
    overflow: hidden;
    height: 40px;
    font-size: 12px;
}
.list-date {
    font-size: 11px;
}
.list-project-name {
    font-size: 11px;
    padding-left: 5px;
    font-weight: 600;
    color: #4682b4;
}
.list-data {
    font-size: 11px;
    padding-left: 5px;
}
.list-paragraph {
    padding: 3px 0px;
}
/* tools */
.separator-vertical {
    margin: 0px 5px 0px 5px;
    height: 26px;
}
.separator-vertical.light {
    border-left: 1px solid #e2e8f0;
    border-right: 1px solid #f7fafc;
}
.separator-vertical.dark {
    border-left: 1px solid #4a5568;
    border-right: 1px solid #1a202c;
}
.projects-panel-title-dot {
    color: #4682b4;
    font-size: 12px;
    padding-right: 5px;
}
.tasks-panel-title-dot {
    color: #ff8c00;
    font-size: 12px;
    padding-right: 5px;
}
/* scroll bar */
::-webkit-scrollbar {
    width: 10px;
}
::-webkit-scrollbar-track {
    background: #1a202c;
}
::-webkit-scrollbar-thumb {
    background: #2d3748;
}
::-webkit-scrollbar-thumb:hover {
    background: #4a5568;
}
.vp20 {
    padding: 20px 0px;
}
.button {
    border: 1px solid #4a5568;
    padding: 2px 8px;
    border-radius: 5px;
    background: #2a4365;
}
.button:hover {
    background: #2b6cb0;
}
table,
th,
td {
    border: 1px dotted #4a5568;
    text-align: left;
}
th {
    background: #4a5568;
    font-size: 18px;
    font-weight: normal;
}
</style>
