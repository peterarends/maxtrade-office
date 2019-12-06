<template>
    <div class="body-left-menu" v-bind:class="theme">
        <a class="active" title="Show Projects Panel">
            <i class="mdi mdi-finance mdiIcon"></i>
        </a>
        <a title="Show Mails Panel">
            <i class="mdi mdi-email-check mdiIcon"></i>
        </a>
        <a title="Show Contacts Panel">
            <i class="mdi mdi-contacts mdiIcon"></i>
        </a>
        <div class="left-menu-title" v-bind:class="theme">Maxtrade Office</div>
        <div
            class="contextMenu"
            v-show="isVisible"
            v-closable="{
                exclude: ['settingsButton'],
                handler: 'closeSettings'
            }"
        >
            <ul class="contextMenu-options">
                <li class="contextMenu-option">
                    Тема
                    <ul class="submenu">
                        <li>Светла</li>
                        <li>Тъмна</li>
                    </ul>
                </li>
                <li class="contextMenu-option">Reload</li>
                <li class="contextMenu-option">Save</li>
                <li class="contextMenu-option">Save As</li>
                <li class="contextMenu-option">Inspect</li>
            </ul>
        </div>
        <a
            title="Show Tools Menu"
            class="settingsMenuLink"
            v-on:click.prevent="isVisible = !isVisible"
            ref="settingsButton"
        >
            <i class="mdi mdi-tools mdiIcon"></i>
        </a>
    </div>
</template>

<script>
export default {
    name: "Leftmenu",

    props: ["theme"],

    data() {
        return {
            isVisible: false
        };
    },

    methods: {
        closeSettings() {
            this.isVisible = false;
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
    width: 150px;
    box-shadow: 0 4px 5px 3px rgba(0, 0, 0, 0.2);
    background-color: #a0aec0;
    position: absolute;
    bottom: 100px;
    left: 80px;
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
    color: #1a202c;
}
.contextMenu-option:hover {
    background: rgba(0, 0, 0, 0.2);
}
.contextMenu ul.submenu {
    width: 150px;
    box-shadow: 0 4px 5px 3px rgba(0, 0, 0, 0.2);
    background-color: #a0aec0;
    position: absolute;
    left: 152px;
    z-index: 99;
    display: none;
}

.contextMenu ul.submenu li {
    font-weight: 500;
    font-size: 14px;
    padding: 10px 40px 10px 20px;
    cursor: pointer;
    color: #1a202c;
}

.contextMenu li:hover ul.submenu {
    display: block;
}
</style>
