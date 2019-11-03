<template>
    <div class="body-left-menu">
        <a id="btnProjectsMenu" class="active" data-tooltip="Show Projects Panel" data-tooltip-position="right"><i class="far fa-copy"></i></a>
        <a id="btnMailsMenu" data-tooltip="Show Mails Panel" data-tooltip-position="right"><i class="far fa-envelope-open"></i></a>
        <a id="btnContactsMenu" data-tooltip="Show Contacts Panel" data-tooltip-position="right"><i class="far fa-address-book"></i></a>
        <div class="left-menu-title">Maxtrade Office</div>
        <a id="btnToolsMenu" data-tooltip="Show Tools Menu" data-tooltip-position="right"><i class="fas fa-tools"></i></a>
    </div>
</template>

<script>
export default {
    name: "Leftmenu"
}
</script>

<style scoped>
.body-left-menu{
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
    width: 44px;
    background: #333333;
}
.body-left-menu a{
    padding-top: 16px;
    transition: all 0.3s ease;
    color: #868686;
    font-size: 26px;
    cursor: pointer;
}
.body-left-menu a:hover{
    color: #CBCBCB;
}
.left-menu-title{
    flex: 1;
    writing-mode: vertical-rl;
    text-align: center;
    font-size: 32px;
    opacity: 0.3;
    color: #4682b4;
}
.body-left-menu #btnToolsMenu{
    flex: 0;
}
.body-left-menu a.active{
    color: #CBCBCB;
}
</style>
