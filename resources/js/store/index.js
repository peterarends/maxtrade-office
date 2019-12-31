import Vuex from "vuex";
import Vue from "vue";

import About from "./modules/App";

// Load Vuex
Vue.use(Vuex);

// Create store
export default new Vuex.Store({
    modules: {
        About
    }
});
