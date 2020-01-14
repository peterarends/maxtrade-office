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
                <select class="controll">
                    <option
                        v-for="user in returnAllUsers(getUsers, getUserId)"
                        :key="user.id"
                        :value="user.id"
                        >{{ user.id }}{{ getUserId }}{{ user.name }} ({{
                            user.email
                        }})</option
                    > </select
                >&nbsp;&nbsp;&nbsp;
                <button
                    class="button"
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
                        <span class="documenName">{{ t("Root User") }}</span>
                    </div>
                    <!-- <div
                        class="document"
                        v-for="document in getDocuments"
                        :key="document"
                    >
                        <a
                            target="_blank"
                            v-bind:href="
                                'images/tasks/' + getTask.id + '/' + document
                            "
                        >
                            <img
                                :src="
                                    ('images/tasks/' +
                                        getTask.id +
                                        '/' +
                                        document)
                                        | formatIcons
                                "
                                :alt="document"
                                @contextmenu.prevent="
                                    $refs.menu.open($event, document)
                                "
                            />
                        </a>
                        <span class="documenName">{{ document }}</span>
                    </div> -->
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
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "Users",

    computed: {
        ...mapGetters([
            "getTheme",
            "getProject",
            "getNewTask",
            "getUserId",
            "getUsers"
        ])
    },

    async created() {
        await this.fetchUsers();
        console.log(this.returnAllUsers(this.getUsers, this.getUserId));
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
        ...mapActions(["closePanel", "fetchUsers"]),
        returnAllUsers(users, curruser) {
            return users.filter(u => u.id !== curruser);
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
</style>
