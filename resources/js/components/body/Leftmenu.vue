<template>
    <div class="body-left-menu">
        <a class="active" title="Show Projects Panel">
            <i class="mdi mdi-finance text-3xl"></i>
        </a>
        <a title="Show Mails Panel">
            <i class="mdi mdi-email-check text-3xl"></i>
        </a>
        <a title="Show Contacts Panel">
            <i class="mdi mdi-contacts text-3xl"></i>
        </a>
        <div class="left-menu-title">Maxtrade Office</div>
        <a title="Show Tools Menu">
            <i class="mdi mdi-tools text-3xl"></i>
        </a>
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
    width: 48px;
    background: #2D3748;
}
.body-left-menu a{
    padding-top: 16px;
    transition: all 0.3s ease;
    color: #A0AEC0;
    font-size: 26px;
    cursor: pointer;
}
.body-left-menu a:hover{
    color: #F7FAFC;
}
.left-menu-title{
    flex: 1;
    writing-mode: vertical-rl;
    text-align: center;
    font-size: 32px;
    opacity: 0.3;
    color: #4299E1;
}
.body-left-menu #btnToolsMenu{
    flex: 0;
}
.body-left-menu a.active{
    color: #F7FAFC;
}
</style>
