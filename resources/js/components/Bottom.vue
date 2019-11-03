<template>
    <div class="footer">
        <div class="footer-icon">
            <!--Header icon-->
            <div><img src="assets/images/connected.png" width="20" height="20"></div>
            <div class="separator-vertical"></div>
            <div>MaxtradeOffice ver: <span id="app-version"></span></div>
            <div class="separator-vertical"></div>
            <div class="projects-panel-title-dot"><i class="fas fa-circle"></i></div><div>Projects: <span id="projects_number"></span>&nbsp;<span id="projects_name"></span></div>
            <div class="separator-vertical"></div>
            <div class="tasks-panel-title-dot"><i class="fas fa-circle"></i></div><div>Tasks: <span id="tasks_number"></span>&nbsp;<span id="tasks_name"></span></div>
            <div class="separator-vertical"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Bottom"
}
</script>

<style scoped>
/* Foother panel */
.footer{
    display: flex;
    align-items: center;
    color: gray;
    font-weight: normal;
    height: 30px;
    background: #333333;
    color: '#868686';
}
.footer-icon{
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 6px;
    padding-right: 2px;
}
.footer-icon div:first-child{
    width: 32px;
    text-align: center;
}
</style>
