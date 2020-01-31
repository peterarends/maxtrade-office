<template>
    <div class="emails-body">
        <div class="button-bar" :class="getTheme">
            <div class="topTitleDiv">
                <!--Window title-->
                <span>{{ t("E-Mails") }}</span>
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
            <h2 v-if="getMailacounts.length == 0">
                {{
                    t(
                        "You don't have an email account yet. Please enter at least one update. You can do it from here:"
                    )
                }}
                <br /><br />
                <a class="link" @click.prevent="showProfile">{{
                    t("Profile")
                }}</a>
            </h2>
            <div class="menu">
                <div
                    class="mail_item"
                    v-for="imap in getImaps"
                    :key="imap.id"
                    :class="[
                        imap.id == getCurrentImapId ? 'active' : '',
                        getTheme
                    ]"
                    @click="showImap(imap)"
                    @contextmenu.prevent="$refs.menu.open($event, imap)"
                >
                    <div class="dateText">
                        {{ imap.date | formatDate }}&nbsp;|&nbsp;
                        {{ imap.id }}
                    </div>
                    <p>
                        <span class="gray">{{ t("from:") }}</span
                        >&nbsp;{{ imap.fromAddress }}
                    </p>
                    <p>
                        <span class="gray">{{ t("to:") }}</span
                        >&nbsp;{{ imap.toString }}
                    </p>
                    <p>{{ imap.subject }}</p>
                </div>
            </div>
            <div class="html">
                {{ getImap.html }}
            </div>
        </div>
        <div class="bottom" :class="getTheme">
            <a @click.prevent="newProjectImap" v-if="getCurrentImapId != 0">
                <i
                    class="mdi mdi-chevron-double-left mdiProjectIcon"
                    :class="getTheme"
                ></i
                ><i
                    class="mdi mdi-alpha-p-box mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("New Project") }}
            </a>
            <a
                @click.prevent="newTaskImap"
                v-if="getCurrentImapId != 0 && getCurrentProjectId != 0"
            >
                <i
                    class="mdi mdi-chevron-double-left mdiProjectIcon"
                    :class="getTheme"
                ></i
                ><i
                    class="mdi mdi-alpha-t-box mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("New Task") }}
            </a>
            <a
                @click.prevent="currentTaskImap"
                v-if="getCurrentImapId != 0 && getCurrentTaskId != 0"
            >
                <i
                    class="mdi mdi-chevron-double-left mdiProjectIcon"
                    :class="getTheme"
                ></i
                ><i
                    class="mdi mdi-alpha-c-box mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("To Current Task") }}
            </a>
            <a @click.prevent="deleteImap">
                <i
                    class="mdi mdi-delete-outline mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Delete") }}
            </a>
            <a @click.prevent="closePanel">
                <i
                    class="mdi mdi-close-outline mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;Close
            </a>
            <div class="status_panel"></div>
        </div>
        <vue-context ref="menu" @open="onOpenContextMenu">
            <li v-if="getCurrentImapId != 0">
                <a @click.prevent="onClickContextMenu('newproject')">{{
                    t("New Project")
                }}</a>
            </li>
            <li v-if="getCurrentImapId != 0 && getCurrentProjectId != 0">
                <a @click.prevent="onClickContextMenu('newtask')">{{
                    t("New Task")
                }}</a>
            </li>
            <li v-if="getCurrentImapId != 0 && getCurrentTaskId != 0">
                <a @click.prevent="onClickContextMenu('tocurrenttask')">{{
                    t("To Current Task")
                }}</a>
            </li>
            <li>
                <a @click.prevent="onClickContextMenu('delete')">{{
                    t("Delete")
                }}</a>
            </li>
        </vue-context>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
import moment from "moment";
import { VueContext } from "vue-context";

export default {
    name: "Emails",

    components: {
        VueContext
    },

    computed: mapGetters([
        "getTheme",
        "getImaps",
        "getCurrentImapId",
        "getImap",
        "getCurrentProjectId",
        "getCurrentTaskId",
        "getMailacounts"
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
            "closePanel",
            "showImap",
            "deleteImap",
            "newProjectImap",
            "newTaskImap",
            "currentTaskImap",
            "showProfile"
        ]),
        onClickContextMenu(action) {
            if (action == "newproject") {
                this.newProjectImap();
            }
            if (action == "newtask") {
                this.newTaskImap();
            }
            if (action == "tocurrenttask") {
                this.currentTaskImap();
            }
            if (action == "delete") {
                this.deleteImap();
            }
        },
        onOpenContextMenu(event, data) {
            this.showImap(data);
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
.emails-body {
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
}
.menu {
    display: flex;
    flex-direction: column;
    flex: 1;
    border-right: 1px solid #1a202c;
    width: 100%;
    box-sizing: border-box;
    user-select: none;
    overflow-x: hidden;
    overflow-y: auto;
}
.mail_item {
    display: flex;
    flex-direction: column;
    padding: 5px 20px 5px 5px;
    margin: 5px 5px;
    transition: 0.3s;
    cursor: pointer;
}
.mail_item.light {
    background: #e2e8f0;
    color: #718096;
}
.mail_item.dark {
    background: #4a5568;
    color: #cbd5e0;
}
.mail_item:first-child {
    padding: 5px 20px 5px 5px;
    margin: 0px 5px 5px 5px;
}
.mail_item.light:hover {
    background: #edf2f7;
    color: #718096;
}
.mail_item.dark:hover {
    background: #2d3748;
    color: #cbd5e0;
}
.mail_item.light.active {
    background: #edf2f7;
    color: #718096;
}
.mail_item.dark.active {
    background: #2d3748;
    color: #cbd5e0;
}
.dateText {
    display: flex;
    justify-content: flex-end;
    font-size: 0.75rem;
}
.html {
    flex: 3;
    background: #2d3748;
    border: 1px solid #4a5568;
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
