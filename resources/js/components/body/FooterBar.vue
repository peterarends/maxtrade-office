<template>
    <div class="footerMainDiv" :class="getTheme">
        <div class="footer-icon">
            <!--Header icon-->
            <div><i class="mdi mdi-server-network serverIcon"></i></div>
            <div class="separator-vertical" :class="getTheme"></div>
            <div>
                MaxtradeOffice ver:
                <span>{{ getVersion }} [{{ getUser.name }}]</span>
            </div>
            <div class="separator-vertical" :class="getTheme"></div>
            <div class="projects-panel-title-dot">
                <i class="fas fa-circle"></i>
            </div>
            <div>
                Projects: <span>{{ getProjects.length }}</span>
            </div>
            <div class="separator-vertical" :class="getTheme"></div>
            <div class="tasks-panel-title-dot">
                <i class="fas fa-circle"></i>
            </div>
            <div>
                Tasks: <span>{{ getTasks.length }}</span>
            </div>
            <div class="separator-vertical" :class="getTheme"></div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "FooterBar",

    computed: mapGetters([
        "getTheme",
        "getVersion",
        "getTasks",
        "getProjects",
        "getUser"
    ])
};
</script>

<style scoped>
/** Start Footer panel */
.footerMainDiv {
    display: flex;
    align-items: center;
    height: 2rem;
}
.footerMainDiv.dark {
    color: #e2e8f0;
    background-color: #2d3748;
}
.footerMainDiv.light {
    color: #4a5568;
    background-color: #edf2f7;
}
.serverIcon {
    font-size: 1.25rem;
}
.footer-icon {
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 10px;
    padding-right: 2px;
}
.footer-icon div:first-child {
    width: 32px;
    text-align: center;
}
.button {
    padding: 3px 8px;
    background: #2d3748;
    border: 1px solid #4a5568;
    border-radius: 5px;
}
/* End Footer panel */
</style>
