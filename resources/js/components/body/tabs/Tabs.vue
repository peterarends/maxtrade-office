<template>
    <div>
        <div>
            <ul class="tabs">
                <li class="tab" v-for="tab in tabs" v-bind:key="tab.href" v-bind:class="{ 'active': tab.isActive }">
                    <i class="mdi mdiIcon tab-icon" 
                    v-bind:class="[ 
                        tab.href == '#project' ? 'mdi-finance' : '',
                        tab.href == '#task' ? 'mdi-calendar-check' : '', 
                        tab.href == '#properties' ? 'mdi-settings-outline' : '',                        
                         ]">
                    </i>
                    <a v-bind:href="tab.href" @click="selectTab(tab)">{{tab.name}}</a>
                    <button class="btnClose"><i class="mdi mdi-close-outline mdiIcon"></i></button>
                </li>
            </ul>
        </div>
        <div class="tabs-details">
            <slot></slot>
        </div>
    </div>
</template>

<script>
import Tab from "./Tab";

export default {
    name: "Tabs",

    components: {
        Tab
    },

    data() {
        return { tabs: [] };
    },

    created() {
        this.tabs = this.$children;
    },

    methods: {
        selectTab(selectedTab) {
            this.tabs.forEach(tab => {
                tab.isActive = tab.href == selectedTab.href;
            });
        }
    }
};
</script>

<style scoped>
    .tabs {
        display: flex;
        flex-direction: row;
    }
    .tab {
        display: flex;
        flex-direction: row;
        background: #E2E8F0;
        padding: 5px 20px 7px 10px;
        border-right: 1px solid #F7FAFC;
    }
    .tab.active {
        background: #F7FAFC;
    }
    .tab-icon {
        font-size: 20px;
        padding-right: 3px;
    }
    .btnClose {
        padding-left: 15px;
    }
</style>
