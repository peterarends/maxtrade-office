<template>
    <div class="aearchtasks-body">
        <div class="button-bar" :class="getTheme">
            <div class="topTitleDiv">
                <!--Window title-->
                <span>{{ t("Search Projects and Tasks") }}</span>
            </div>
            <div class="topRightIcons">
                <!--Window title icons-->
                <div
                    class="rightExitIcon"
                    :class="getTheme"
                    @click="closePanel"
                >
                    <img src="/images/close.png" />
                </div>
            </div>
        </div>
        <div class="body">
            <div class="searchpanel">
                <input
                    type="text"
                    class="searchInput"
                    :class="getTheme"
                    ref="search_input"
                    :placeholder="t('search for a match ...')"
                    @input="allSearch($event)"
                />
            </div>
            <div class="vp20"></div>
            <div class="resultpanel">
                <h4>{{ t("Matches in Projects") }}:</h4>
                <table style="width:100%">
                    <tr>
                        <th>{{ t("#") }}</th>
                        <th>{{ t("Project") }}</th>
                        <th>{{ t("Created at") }}</th>
                    </tr>
                    <tr v-for="project in getProjectsSearch" :key="project.id">
                        <td>{{ project.id }}</td>
                        <td>
                            <a
                                class="title"
                                @click.prevent="gotoProject(project)"
                                >{{ project.title }}</a
                            >
                        </td>
                        <td>{{ project.created_at }}</td>
                    </tr>
                </table>

                <div class="vp20"></div>
                <h4>{{ t("Matches in Tasks") }}:</h4>
                <table style="width:100%">
                    <tr>
                        <th>{{ t("#") }}</th>
                        <th>{{ t("Task") }}</th>
                        <th>{{ t("Created at") }}</th>
                    </tr>
                    <tr v-for="task in getTasksSearch" :key="task.id">
                        <td>{{ task.id }}</td>
                        <td>
                            <a class="title" @click.prevent="gotoTask(task)">{{
                                task.title
                            }}</a>
                        </td>
                        <td>{{ task.created_at }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="bottom" :class="getTheme">
            <a @click.prevent="closePanel"
                ><i
                    class="mdi mdi-close-outline mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Close") }}</a
            >
            <div class="status_panel"></div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "Searchtasks",

    computed: mapGetters([
        "getTheme",
        "getLanguage",
        "getProjectsSearch",
        "getTasksSearch",
        "getProjects"
    ]),

    mounted() {
        setInterval(this.setFocus, 500);
    },

    methods: {
        ...mapActions([
            "closePanel",
            "allSearch",
            "showProject",
            "clearSearch",
            "showAllProjects",
            "showTask"
        ]),
        gotoProject(project) {
            this.$refs.search_input.value = "";
            this.clearSearch();
            this.showAllProjects();
            this.showProject(project);
        },
        gotoTask(task) {
            this.$refs.search_input.value = "";
            this.clearSearch();
            this.showAllProjects();
            const project = this.getProjects.find(p => p.id == task.project_id);
            this.showProject(project);
            this.showTask(task);
        },
        setFocus() {
            this.$refs.search_input.focus();
        }
    }
};
</script>

<style scoped>
.aearchtasks-body {
    width: 100%;
    display: flex;
    flex-direction: column;
}
.button-bar {
    display: flex;
    align-items: center;
    height: 30px;
}
.button-bar.light {
    background: #edf2f7;
    border-top: 1px solid #f7fafc;
    box-shadow: 0 2px 0 white;
    border-bottom: 1px solid #e2e8f0;
}
.button-bar.dark {
    background: #2d3748;
    border-top: 1px solid #1a202c;
    box-shadow: 0 2px 0 black;
    border-bottom: 1px solid #4a5568;
}
.topTitleDiv {
    /* text-center flex-grow text-xl pl-2 pr-2 text-gray-300 */
    text-align: center;
    flex-grow: 1;
    font-size: 1.25rem;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    color: #3182ce;
}
.topRightIcons {
    /* flex items-center justify-content-center */
    display: flex;
    align-items: center;
    justify-content: center;
}
.rightExitIcon {
    /* flex items-center justify-content-center w-7 h-7 px-1 py-1 hover:bg-red-600 */
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1.5rem;
    height: 1.5rem;
    padding-right: 0.25rem;
    padding-left: 0.25rem;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}
.rightExitIcon:hover.light {
    background-color: #fc8181;
}
.rightExitIcon:hover.dark {
    background-color: #e53e3e;
}
.body {
    flex: 1;
    padding: 10px;
    display: flex;
    flex-direction: column;
}
.searchpanel {
    display: flex;
}
.resultpanel {
    display: flex;
    flex-direction: column;
    max-height: calc(100vh - 250px);
    overflow-y: auto;
}
.searchInput {
    border-radius: 0.25rem;
    flex: 1;
    padding-left: 0.25rem;
    padding-bottom: 0.25rem;
    margin-right: 0.25rem;
}
.searchInput.light {
    background-color: #f7fafc;
    border: 1px solid #edf2f7;
    color: #4a5568;
}
.searchInput.dark {
    background-color: #1a202c;
    border: 1px solid #2d3748;
    color: #e2e8f0;
}
.searchInput.light::placeholder {
    color: #e2e8f0;
}
.searchInput.dark::placeholder {
    color: #4a5568;
}
.title {
    cursor: pointer;
}
.title:hover {
    background: #4a5568;
}
.bottom {
    display: flex;
    padding: 2px;
    height: 30px;
}
.bottom.light {
    background: #edf2f7;
    border-bottom: 1px solid #f7fafc;
    border-top: 1px solid #e2e8f0;
}
.bottom.dark {
    background: #2d3748;
    border-bottom: 1px solid #1a202c;
    border-top: 1px solid #4a5568;
}
.bottom a {
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 12px;
    padding-right: 12px;
    transition: all 0.3s ease;
    height: 24px;
    cursor: pointer;
}
.bottom.light a {
    color: #2d3748;
    border-right: 1px solid #f7fafc;
    background: #edf2f7;
}
.bottom.dark a {
    color: #edf2f7;
    border-right: 1px solid #1a202c;
    background: #2d3748;
}
.bottom.dark a:hover {
    background-color: #2b6cb0;
    color: #f7fafc;
}
.bottom.light a:hover {
    background-color: #90cdf4;
    color: #1a202c;
}
.status_panel {
    flex: 1;
    text-align: right;
}
.mdiProjectIcon {
    font-size: 1.3rem;
}
.mdiProjectIcon.light {
    color: #63b3ed;
}
.mdiProjectIcon.dark {
    color: #3182ce;
}
</style>
