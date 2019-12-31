import axios from "axios";

const state = {
    theme: "dark"
};

const getters = {
    getTheme: state => state.theme
};

const actions = {
    async fetchTheme({ commit }) {
        const response = await axios.get("api/properties");
        console.log(response);
    }
};

const mutations = {};

export default {
    state,
    getters,
    actions,
    mutations
};
