<template>
    <div class="flex-1 bg-gray-900">
        <tabs>
            <tab name="Project" :selected="true">
                <h1>Component project</h1>
            </tab>
            <tab name="Task">
                <h1>Component task</h1>
            </tab>
            <tab name="Properties">
                <h1>Component properties</h1>
            </tab>
        </tabs>
    </div>
</template>

<script>
import Tabs from "./tabs/Tabs";
import Tab from "./tabs/Tab";

export default {
    name: "Bodypanel",

    components: {
        Tabs,
        Tab
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
    }
};
</script>

<style scoped></style>
