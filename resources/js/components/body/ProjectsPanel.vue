<template>
  <div class="body-projects-panel" :class="getTheme">
    <div class="topProjectsDiv" :class="getTheme">
      <input
        type="text"
        class="searchInput"
        :class="getTheme"
        :placeholder="t('projects search ...')"
        @input="projectSearch($event)"
      />
      <div class="searchElementsDiv" :class="getTheme">
        <span
          class="searchIconsText"
          :class="getTheme"
          @click="toggleProjectStatusFilter"
        >{{ getProjectFilter.filterstatus.toUpperCase() }}</span>
        <i
          class="mdi mdi-sort-alphabetical searchIcons"
          :class="getTheme"
          @click="toggleProjectNameFilter"
        ></i>
        <i
          class="mdi mdi-sort-numeric searchIcons"
          :class="getTheme"
          @click="toggleProjectIdFilter"
        ></i>
      </div>
    </div>
    <div id="projectsListView">
      <div
        class="project_item"
        v-for="project in getProjects"
        :key="project.id"
        :class="[
                    project.id == getCurrentProjectId ? 'active' : '',
                    getTheme
                ]"
        @click="showProject(project)"
        @contextmenu.prevent="$refs.menu.open($event, project)"
      >
        <div
          class="dateText"
          :class="[
                        project.status == 0
                            ? 'dateWithLine'
                            : 'dateWithoutLine',
                        getTheme
                    ]"
        >
          {{ project.created_at | formatDate }}&nbsp;|&nbsp;
          <span
            v-if="project.id == getCurrentProjectId"
          >
            {{ countAllTasks }}/{{ countActiveTasks }}/{{
            countEndedTasks
            }}
          </span>
        </div>
        <div class="singleProjectDiv">
          <div
            class="singleProjectId"
            :class="[
                            project.status == 0 ? '' : 'idBackground',
                            project.status == 0
                                ? 'idTextFinished'
                                : 'idTextUnfinished ',
                            getTheme
                        ]"
          >{{ project.id }}</div>
          <div
            class="singleProjectText"
            :class="[
                            project.status == 0
                                ? 'titleTextFinished'
                                : 'titleTextUnfinished',
                            project.status == 0 ? 'titleTextLine' : '',
                            getTheme
                        ]"
          >{{ project.title }}</div>
        </div>
      </div>
    </div>
    <vue-context ref="menu" @open="onOpenContextMenu">
      <li>
        <a @click.prevent="onClickContextMenu('users')">
          {{
          t("Users")
          }}
        </a>
      </li>
      <li>
        <a @click.prevent="onClickContextMenu('delete')">
          {{
          t("Delete Project")
          }}
        </a>
      </li>
      <li>
        <a @click.prevent="onClickContextMenu('complete')">
          {{
          t("Complete Project")
          }}
        </a>
      </li>
      <li>
        <a @click.prevent="onClickContextMenu('addtask')">
          {{
          t("New Task")
          }}
        </a>
      </li>
    </vue-context>
  </div>
</template>

<script>
import moment from "moment";
import { VueContext } from "vue-context";
import { mapGetters, mapActions } from "vuex";

export default {
  name: "ProjectsPanel",

  components: {
    VueContext
  },

  computed: mapGetters([
    "getTheme",
    "getProjects",
    "getProjectFilter",
    "getCurrentProjectId",
    "countAllTasks",
    "countActiveTasks",
    "countEndedTasks"
  ]),

  filters: {
    formatDate: function(value) {
      if (value) {
        return moment(String(value)).format("DD.MM.YYYY hh:mm");
      }
    }
  },

  methods: {
    ...mapActions([
      "showProject",
      "projectSearch",
      "toggleProjectStatusFilter",
      "toggleProjectNameFilter",
      "toggleProjectIdFilter",
      "deleteProject",
      "completeProject",
      "addTask",
      "showUsers"
    ]),

    onClickContextMenu(action) {
      if (action == "delete") {
        this.deleteProject();
      } else {
        if (action == "complete") {
          this.completeProject();
        } else {
          if (action == "addtask") {
            this.addTask();
          } else {
            if (action == "users") {
              this.showUsers();
            }
          }
        }
      }
    },
    onOpenContextMenu(event, data) {
      this.showProject(data);
    }
  }
};
</script>

<style scoped>
.v-context,
.v-context ul {
  background-color: #1a202c;
  background-clip: padding-box;
  border-radius: 0.25rem;
  border: 1px solid rgba(0, 0, 0, 0.15);
  box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14), 0 3px 1px -2px rgba(0, 0, 0, 0.2),
    0 1px 5px 0 rgba(0, 0, 0, 0.12);
  display: block;
  margin: 0;
  padding: 0px;
  min-width: 10rem;
  z-index: 1500;
  position: fixed;
  list-style: none;
  box-sizing: border-box;
  max-height: calc(100% - 50px);
  overflow-y: auto;
}
.v-context > li,
.v-context ul > li {
  margin: 0;
  position: relative;
  cursor: pointer;
}
.v-context > li > a,
.v-context ul > li > a {
  display: block;
  padding: 0.5rem 1.5rem;
  font-weight: 400;
  color: #cbd5e0;
  text-decoration: none;
  white-space: nowrap;
  background-color: transparent;
  border: 0;
}
.v-context > li > a:focus,
.v-context > li > a:hover,
.v-context ul > li > a:focus,
.v-context ul > li > a:hover {
  text-decoration: none;
  color: #212529;
  background-color: #a0aec0;
}
.v-context:focus,
.v-context > li > a:focus,
.v-context ul:focus,
.v-context ul > li > a:focus {
  outline: 0;
}
.v-context__sub > a:after {
  content: "\2BC8";
  float: right;
  padding-left: 1rem;
}
.v-context__sub > ul {
  display: none;
}
/** Top part of projects */
.topProjectsDiv {
  /* flex items-center p-1 bg-gray-900 */
  display: flex;
  align-items: center;
  padding: 0.25rem;
}
.topProjectsDiv.light {
  background-color: #f7fafc;
}
.topProjectsDiv.dark {
  background-color: #1a202c;
}

/** Search style */
.searchInput {
  /* bg-gray-900 border-gray-800 border rounded w-1/2 pl-1 pb-1 text-gray-300
            placeholder-gray-700 mr-1 */
  border-radius: 0.25rem;
  width: 70%;
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
/** Search by element */
.searchElementsDiv {
  /* flex items-center justify-center border-l border-gray-700 border-dotted pl-1 */
  display: flex;
  justify-content: center;
  padding-left: 0.25rem;
}
.searchElementsDiv.light {
  border-left: 1px dotted #e2e8f0;
}
.searchElementsDiv.dark {
  border-left: 1px dotted #4a5568;
}

/** Search by element icons */
.searchIconsText {
  /* text-2xl text-gray-500 hover:text-gray-100 */
  font-size: 1rem;
  padding: 0px 2px;
  font-weight: bold;
  cursor: pointer;
}
.searchIconsText.light {
  color: #a0aec0;
}
.searchIconsText.dark {
  color: #a0aec0;
}
.searchIconsText.light:hover {
  color: #1a202c;
}
.searchIconsText.dark:hover {
  color: #f7fafc;
}
.searchIcons {
  /* text-2xl text-gray-500 hover:text-gray-100 */
  font-size: 1.5rem;
  padding: 0px 2px;
  font-weight: bold;
  cursor: pointer;
}
.searchIcons.light {
  color: #a0aec0;
}
.searchIcons.dark {
  color: #a0aec0;
}
.searchIcons.light:hover {
  color: #1a202c;
}
.searchIcons.dark:hover {
  color: #f7fafc;
}
/** Date style */
.dateText {
  /* flex justify-end text-xs */
  display: flex;
  justify-content: flex-end;
  font-size: 0.75rem;
}
.dateText.dateWithLine {
  text-decoration: line-through;
}
.dateText.dateWithLine.light {
  /* text-gray-500 line-through */
  color: #718096;
}
.dateText.dateWithLine.dark {
  /* text-gray-500 line-through */
  color: #cbd5e0;
}
.dateText.dateWithoutLine.light {
  /* text-gray-400 */
  color: #a0aec0;
}
.dateText.dateWithoutLine.dark {
  color: #a0aec0;
}

/** Style for each project block */
.singleProjectDiv {
  display: flex;
}
.singleProjectId {
  border-radius: 1.3rem;
  height: 1.3rem;
  width: 2.5rem;
  font-size: 0.75rem;
  display: flex;
  align-items: center;
  justify-content: center;
}
.singleProjectId.idBackground.light {
  /* bg-gray-600 */
  background-color: #cbd5e0;
}
.singleProjectId.idBackground.dark {
  /* bg-gray-600 */
  background-color: #718096;
}
.singleProjectId.idTextUnfinished.light {
  /* text-gray-600 */
  color: #718096;
}
.singleProjectId.idTextUnfinished.dark {
  /* text-gray-600 */
  color: #cbd5e0;
}
.singleProjectId.idTextFinished.light {
  color: #f7fafc;
}
.singleProjectId.idTextFinished.dark {
  color: #1a202c;
}
.singleProjectText {
  flex: 1;
  padding-left: 0.5rem;
  padding-top: 0.25rem;
}
.singleProjectText.titleTextUnfinished.light {
  color: #4a5568;
}
.singleProjectText.titleTextUnfinished.dark {
  color: #e2e8f0;
}
.singleProjectText.titleTextFinished.light {
  color: #a0aec0;
}
.singleProjectText.titleTextFinished.dark {
  color: #a0aec0;
}
.titleTextLine {
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
  background: #f7fafc;
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
  background: #e2e8f0;
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
  background: #edf2f7;
  color: #718096;
}
.project_item.dark:hover {
  background: #2d3748;
  color: #cbd5e0;
}
.project_item.light.active {
  background: #edf2f7;
  color: #718096;
}
.project_item.dark.active {
  background: #2d3748;
  color: #cbd5e0;
}
</style>
