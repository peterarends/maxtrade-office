<template>
    <div class="mainDivBodypanel" v-bind:class="theme">
        <tabs v-bind:theme="theme" v-bind:properties="properties">
            <tab name="Project" v-bind:selected="true">
                <h1>Component project</h1>
            </tab>
            <tab name="Task">
                <h1>Component task</h1>
            </tab>
            <tab name="Properties">
                <properties
                    v-bind:theme="theme"
                    v-bind:properties="properties"
                    @changetheme="changeTheme"
                ></properties>
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
        },
        changeTheme(changed_theme) {
            this.$emit("changetheme", changed_theme);
        }
    },

    props: ["theme", "properties"]
};
</script>

<style scoped>
/** Main div style */
.mainDivBodypanel {
    display: flex;
    flex: 1;
}
.mainDivBodypanel.light {
    background-color: #f7fafc;
}
.mainDivBodypanel.dark {
    background-color: #1a202c;
}
</style>
