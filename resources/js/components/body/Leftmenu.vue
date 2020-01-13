<template>
    <div class="body-left-menu" :class="getTheme">
        <a
            :class="[
                getPanel === '' ||
                getPanel === 'properties' ||
                getPanel === 'about' ||
                getPanel === 'projects' ||
                getPanel === 'tasks'
                    ? 'active'
                    : ''
            ]"
            :title="t('Return to ready state')"
            @click.prevent="readyState"
        >
            <i class="mdi mdi-finance mdiIcon"></i>
        </a>
        <a
            :title="t('Show Search Panel')"
            @click.prevent="showSearchtasks"
            :class="[getPanel === 'searchtasks' ? 'active' : '']"
        >
            <i class="mdi mdi-file-document-box-search mdiIcon"></i>
        </a>
        <a
            :title="t('Show Mails Panel')"
            @click.prevent="showEmails"
            :class="[getPanel === 'emails' ? 'active' : '']"
        >
            <i class="mdi mdi-email-check mdiIcon"></i>
        </a>
        <a
            :title="t('Show Contacts Panel')"
            @click.prevent="showContacts"
            :class="[getPanel === 'contacts' ? 'active' : '']"
        >
            <i class="mdi mdi-contacts mdiIcon"></i>
        </a>
        <div class="left-menu-title" :class="getTheme">
            Maxtrade Office
        </div>
        <a
            title="Show Tools Menu"
            class="settingsMenuLink"
            v-on:contextmenu.prevent="$refs.menu.open($event)"
        >
            <i class="mdi mdi-tools mdiIcon"></i>
        </a>
        <vue-context ref="menu">
            <li>
                <a @click.prevent="onClickContextMenu('properties')"
                    >Show Properties</a
                >
            </li>
            <li>
                <a @click.prevent="onClickContextMenu('dark')"
                    >Dark Theme
                    <strong v-show="getTheme === 'dark'">&check;</strong></a
                >
            </li>
            <li>
                <a @click.prevent="onClickContextMenu('light')"
                    >Light Theme
                    <strong v-show="getTheme === 'light'">&check;</strong></a
                >
            </li>
        </vue-context>
    </div>
</template>

<script>
import Vue from "vue";
import { mapGetters, mapActions } from "vuex";
import { VueContext } from "vue-context";
// import VueTranslate from "vue-translate-plugin";

// Vue.use(VueTranslate);

export default {
    name: "Leftmenu",

    components: {
        VueContext
    },

    computed: mapGetters(["getTheme", "getPanel", "getLanguage"]),

    // mounted() {
    //     this.$translate.setLang(this.getLanguage);
    // },

    // locales: {
    //     en_US: {},
    //     bg_BG: {
    //         "Return to ready state": "Върни в началото",
    //         "Show Search Panel": "Покажи панела за търсене",
    //         "Show Mails Panel": "Покажи панела съобщения",
    //         "Show Contacts Panel": "Покажи панела контакти"
    //     }
    // },

    methods: {
        ...mapActions([
            "showProperties",
            "changeTheme",
            "readyState",
            "showContacts",
            "showEmails",
            "showSearchtasks"
        ]),
        onClickContextMenu(action) {
            if (action == "properties") {
                this.showProperties();
            } else {
                if (action == "dark") {
                    this.changeTheme("dark");
                } else {
                    if (action == "light") {
                        this.changeTheme("light");
                    }
                }
            }
        }
    }
};
</script>

<style scoped>
/** General icon size */
.mdiIcon {
    font-size: 1.875rem;
}
/** Setting menu a */
.settingsMenuLink {
    padding-bottom: 1rem;
}

.body-left-menu {
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
    width: 48px;
}
.body-left-menu.light {
    background: #edf2f7;
    border-bottom: 1px solid #f7fafc;
}
.body-left-menu.dark {
    background: #2d3748;
    border-bottom: 1px solid #1a202c;
}
.body-left-menu a {
    padding-top: 16px;
    transition: all 0.3s ease;
    font-size: 26px;
    cursor: pointer;
}
.body-left-menu.light a {
    color: #a0aec0;
}
.body-left-menu.dark a {
    color: #a0aec0;
}
.body-left-menu.light a:hover {
    color: #1a202c;
}
.body-left-menu.dark a:hover {
    color: #f7fafc;
}
.left-menu-title {
    flex: 1;
    writing-mode: vertical-rl;
    text-align: center;
    font-size: 32px;
}
.left-menu-title.light {
    opacity: 0.5;
    color: #4299e1;
}
.left-menu-title.dark {
    opacity: 0.3;
    color: #4299e1;
}
.body-left-menu #btnToolsMenu {
    flex: 0;
}
.body-left-menu.light a.active {
    color: #1a202c;
}
.body-left-menu.dark a.active {
    color: #f7fafc;
}
.contextMenu {
    width: 300px;
    box-shadow: 0 4px 5px 3px rgba(0, 0, 0, 0.2);
    background-color: #1a202c;
    position: absolute;
    bottom: 87px;
    left: 25px;
}
.contextMenu-options {
    list-style: none;
    padding: 10px 0;
}
.contextMenu-option {
    font-weight: 500;
    font-size: 14px;
    padding: 10px 40px 10px 20px;
    cursor: pointer;
    color: #a0aec0;
}
.contextMenu-option:hover {
    background: rgba(0, 0, 0, 0.2);
}
.right-text {
    float: right;
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
    font-size: 14px;
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
