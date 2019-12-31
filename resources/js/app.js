import Vue from "vue";
import App from "./components/App";
import store from "./store";

require("./bootstrap");

const app = new Vue({
    store,
    el: "app",
    components: {
        App
    }
});
