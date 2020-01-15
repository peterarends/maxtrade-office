<template>
    <div class="users-body">
        <div class="button-bar" :class="getTheme">
            <div class="topTitleDiv">
                <!--Window title-->
                <span
                    >{{ t("Managing users to a Project") }}:
                    {{ getProject.id | formatProjectId(getNewTask) }}</span
                >
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
        <div class="body" :class="[getProject.status == 0 ? 'ended' : '']">
            <input class="title" type="text" v-model="getProject.title" />
            <div class="vp20"></div>
            <div class="select">
                <select
                    class="controll"
                    v-model="current_user"
                    ref="selected_user"
                >
                    <option value="0">{{ t("Choose User to add...") }}</option>
                    <option
                        v-for="user in getUsers.filter(
                            u => u.id !== getProject.user_id
                        )"
                        :key="user.id"
                        :value="user.id"
                        >{{ user.name }} ({{ user.email }})</option
                    > </select
                >&nbsp;&nbsp;&nbsp;
                <button
                    v-if="current_user != 0"
                    class="button"
                    @click="addUsersProject(current_user)"
                    :title="
                        t(
                            'Add the selected user to those who are allowed to work with the project'
                        )
                    "
                >
                    <i class="mdi mdi-plus-circle-outline"></i>{{ t("Add") }}
                </button>
            </div>
            <div class="vp20"></div>
            <div>
                <h4>{{ t("Users attached to this project") }}:</h4>
                <div class="documents">
                    <div class="document">
                        <img :src="'images/document_icons/user.png'" />
                        <span class="documenName">{{
                            typeof getUsers.find(
                                u => u.id === getProject.user_id
                            ) != "undefined"
                                ? getUsers.find(
                                      u => u.id === getProject.user_id
                                  ).name
                                : ""
                        }}</span>
                    </div>
                    <div
                        class="document"
                        v-for="user in getUsersProjects"
                        :key="user.id"
                    >
                        <img
                            :src="'images/document_icons/users.png'"
                            @contextmenu.prevent="
                                $refs.menu.open($event, user.id)
                            "
                        />
                        <span class="documenName">{{ user.name }}</span>
                    </div>
                </div>
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
        </div>
        <vue-context ref="menu" @open="onOpenContextMenu">
            <li>
                <a @click.prevent="onClickContextMenu('delete')">{{
                    t("Remove User")
                }}</a>
            </li>
        </vue-context>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import { VueContext } from "vue-context";

export default {
    name: "Users",

    components: {
        VueContext
    },

    data() {
        return {
            curr_user: 0,
            curr_user_delete: null
        };
    },

    computed: {
        ...mapGetters([
            "getTheme",
            "getProject",
            "getNewTask",
            "getUserId",
            "getUsers",
            "getUsersProjects"
        ]),
        current_user: {
            set: function(val) {
                this.curr_user = val;
            },
            get: function() {
                return this.curr_user;
            }
        }
    },

    created() {
        this.fetchUsers();
    },

    filters: {
        formatProjectId: function(value, _new_project) {
            if (_new_project) {
                return "New Project";
            } else {
                return value;
            }
        }
    },

    methods: {
        ...mapActions([
            "closePanel",
            "fetchUsers",
            "fetchUsersByProjects",
            "addUsersProject",
            "deleteUsersProject"
        ]),
        onOpenContextMenu(event, id) {
            this.curr_user_delete = id;
        },
        onClickContextMenu(action) {
            if (action === "delete" && this.curr_user_delete !== null) {
                this.deleteUsersProject(this.curr_user_delete);
                this.curr_user_delete = null;
            }
        }
    }
};
</script>

<style scoped>
.users-body {
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
.ended {
    text-decoration: line-through;
}
.title {
    background: transparent;
    text-align: center;
    padding: 4px;
    font-size: 32px;
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
.mdiProjectIcon {
    font-size: 1.3rem;
}
.mdiProjectIcon.light {
    color: #63b3ed;
}
.mdiProjectIcon.dark {
    color: #3182ce;
}
.select {
    display: flex;
}
.controll {
    background: #4a5568;
    padding: 1px 3px;
    border: 1px dotted #718096;
}
.documents {
    background: #2d3748;
    height: 140px;
    border: 1px solid #4a5568;
    display: flex;
    padding: 10px;
    overflow: auto;
}
.document {
    display: flex;
    flex-direction: column;
    width: 140px;
    padding: 2px;
    align-items: center;
}
.v-context,
.v-context ul {
    background-color: #1a202c;
    background-clip: padding-box;
    border-radius: 0.25rem;
    border: 1px solid rgba(0, 0, 0, 0.15);
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14),
        0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
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
</style>
