<template>
    <div class="mainDivBodypanel" v-bind:class="theme">
        <tabs>
            <tab name="Project" v-bind:selected="true">
                <h1>Component project</h1>
            </tab>
            <tab name="Task">
                <h1>Component task</h1>
            </tab>
            <tab name="Properties">
                <properties></properties>
            </tab>
        </tabs>
    </div>
</template>

<script>
import Tabs from "./tabs/Tabs";
import Tab from "./tabs/Tab";
import Properties from "./properties/Properties";

export default {
    name: "Bodypanel",

    components: {
        Tabs,
        Tab,
        Properties
    },

    data() {
        return {
            activeItem: "home"
        };
    },

    methods: {
        isActive(tabItem) {
            return this.activeItem === tabItem;
        },
        setActive(tabItem) {
            this.activeItem = tabItem;
        }
    },

    props: ["theme"]
};
</script>

<style scoped>
/** Main div style */
.mainDivBodypanel {
    /* flex-1 bg-gray-900 */
    flex: 1 1 0%;
}
.mainDivBodypanel.light {
    background-color: #f7fafc;
}
.mainDivBodypanel.dark {
    background-color: #1a202c;
}
</style>
