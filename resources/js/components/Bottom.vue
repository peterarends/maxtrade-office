<template>
    <div class="footerMainDiv">
        <div class="footer-icon">
            <!--Header icon-->
            <div><i class="mdi mdi-server-network serverIcon"></i></div>
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

/** Footer main div */
.footerMainDiv{
    /* flex items-center text-gray-300 h-8 bg-gray-800 */
    display: flex;
    align-items: center;
    color: #e2e8f0;
    height: 2rem;
    background-color: #2d3748;
}
/** Footer main div */
.serverIcon{
    /* text-xl */
    font-size: 1.25rem;
}
/** Footer server icon */

/** Footer server icon */

/* Foother panel */
.footer-icon{
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 10px;
    padding-right: 2px;
}
.footer-icon div:first-child{
    width: 32px;
    text-align: center;
}
</style>
