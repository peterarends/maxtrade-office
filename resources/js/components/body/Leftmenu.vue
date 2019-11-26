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
        <a title="Show Tools Menu" class="settingsMenuLink">
            <i class="mdi mdi-tools mdiIcon"></i>
        </a>
    </div>
</template>

<script>
export default {
    name: "Leftmenu",

    props: ["theme"]
}
</script>

<style scoped>

/** General icon size */
.mdiIcon{
    font-size: 1.875rem;
}
/** Setting menu a */
.settingsMenuLink{
    padding-bottom: 1rem;
}

.body-left-menu{
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
    width: 48px;
}
.body-left-menu.light{
    background: #EDF2F7;
    border-bottom: 1px solid #F7FAFC;
}
.body-left-menu.dark{
    background: #2D3748;
    border-bottom: 1px solid #1A202C;
}
.body-left-menu a{
    padding-top: 16px;
    transition: all 0.3s ease;
    font-size: 26px;
    cursor: pointer;
}
.body-left-menu.light a{
    color: #A0AEC0;
}
.body-left-menu.dark a{
    color: #A0AEC0;
}
.body-left-menu.light a:hover{
    color: #1A202C;
}
.body-left-menu.dark a:hover{
    color: #F7FAFC;
}
.left-menu-title{
    flex: 1;
    writing-mode: vertical-rl;
    text-align: center;
    font-size: 32px;
}
.left-menu-title.light{
    opacity: 0.5;
    color: #4299E1;
}
.left-menu-title.dark{
    opacity: 0.3;
    color: #4299E1;
}
.body-left-menu #btnToolsMenu{
    flex: 0;
}
.body-left-menu.light a.active{
    color: #1A202C;
}
.body-left-menu.dark a.active{
    color: #F7FAFC;
}
</style>
