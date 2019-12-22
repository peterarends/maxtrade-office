<template>
    <div class="properties-body">
        <div class="button-bar" v-bind:class="theme">
            <div class="topTitleDiv" v-bind:class="theme">
                <!--Window title-->
                <span>Properties</span>
            </div>
            <div class="topRightIcons">
                <!--Window title icons-->
                <div
                    class="rightExitIcon"
                    v-bind:class="theme"
                    v-on:click="close"
                >
                    <img src="/images/close.png" />
                </div>
            </div>
        </div>
        <div class="top">
            <input
                type="text"
                class="search_input"
                placeholder="Search settings ..."
            />
        </div>
        <div class="body">
            <h2 class="property_title">Properties:</h2>
            <ul>
                <li
                    v-for="category in property_categories"
                    v-bind:key="category.category"
                >
                    <h4 class="property_section">
                        {{ category.category }} properties
                    </h4>
                    <ul>
                        <li
                            class="property_row"
                            v-for="property in properties.filter(
                                prop => prop.category === category.category
                            )"
                            v-bind:key="property.id"
                        >
                            <div>
                                {{ property.id }}.&nbsp;{{
                                    category.category
                                }}:&nbsp;<strong>{{
                                    property.description
                                }}</strong>
                            </div>
                            <div>
                                {{ property.help }}
                            </div>
                            <div>
                                <select
                                    class="controll"
                                    v-model="property.value"
                                    @change="changeTheme($event)"
                                >
                                    <option value="dark">Dark theme</option>
                                    <option value="light">Light theme</option>
                                </select>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    name: "Properties",

    data() {
        return {
            property: {
                id: "",
                name: "",
                value: "",
                description: "",
                help: "",
                category: ""
            },
            property_id: "",
            property_categories: [],
            edit: false
        };
    },

    created() {
        this.fetchProperyCategories();
    },

    methods: {
        // Get Property categories
        fetchProperyCategories() {
            fetch("api/properties_categories")
                .then(res => res.json())
                .then(res => {
                    this.property_categories = res.data;
                });
        },
        changeTheme(event) {
            this.$emit("changetheme", event.target.value);
        },
        close: function(event) {
            this.$emit("closepanel");
        }
    },

    props: ["theme", "properties"]
};
</script>

<style scoped>
.properties-body {
    width: 100%;
    display: flex;
    flex-direction: column;
}
.top {
    padding: 10px;
}
.search_input {
    border-radius: 0.25rem;
    background-color: #1a202c;
    border: 1px solid #2d3748;
    color: #e2e8f0;
    padding: 2px 5px;
    width: 100%;
}
.search_input::placeholder {
    color: #4a5568;
}
.body {
    flex: 1;
    padding: 10px;
}
.property_title {
    padding: 0px 0px 20px 10px;
}
.property_section {
    padding: 0px 0px 10px 20px;
    text-decoration: underline;
}
.property_row {
    display: flex;
    flex-direction: column;
    margin: 0px 0px 10px 30px;
    padding-left: 5px;
    border-left: 1px dotted #4a5568;
}
.controll {
    background: #4a5568;
    padding: 1px 3px;
    border: 1px dotted #718096;
}
.button-bar {
    display: flex;
    align-items: center;
    height: 30px;
}
.button-bar.light {
    background: #edf2f7;
    border-top: 1px solid #f7fafc;
    box-shadow: 0 2px 0 white;
    border-bottom: 1px solid #e2e8f0;
}
.button-bar.dark {
    background: #2d3748;
    border-top: 1px solid #1a202c;
    box-shadow: 0 2px 0 black;
    border-bottom: 1px solid #4a5568;
}
.button-bar a {
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 12px;
    padding-right: 12px;
    transition: all 0.3s ease;
    height: 30px;
    cursor: pointer;
}
.button-bar.light a {
    color: #2d3748;
    border-right: 1px solid #f7fafc;
    background: #edf2f7;
}
.button-bar.dark a {
    color: #edf2f7;
    border-right: 1px solid #1a202c;
    background: #2d3748;
}
.button-bar.dark a:hover {
    background-color: #2b6cb0;
    color: #f7fafc;
}
.button-bar.light a:hover {
    background-color: #90cdf4;
    color: #1a202c;
}
.topTitleDiv {
    /* text-center flex-grow text-xl pl-2 pr-2 text-gray-300 */
    text-align: center;
    flex-grow: 1;
    font-size: 1.25rem;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    color: #e2e8f0;
}
.topTitleDiv.light {
    color: #4a5568;
}
.topTitleDiv.dark {
    color: #e2e8f0;
}
.topRightIcons {
    /* flex items-center justify-content-center */
    display: flex;
    align-items: center;
    justify-content: center;
}
.rightExitIcon {
    /* flex items-center justify-content-center w-7 h-7 px-1 py-1 hover:bg-red-600 */
    display: flex;
    align-items: center;
    justify-content: center;
    width: 1.5rem;
    height: 1.5rem;
    padding-right: 0.25rem;
    padding-left: 0.25rem;
    padding-top: 0.25rem;
    padding-bottom: 0.25rem;
}
.rightExitIcon:hover.light {
    background-color: #fc8181;
}
.rightExitIcon:hover.dark {
    background-color: #e53e3e;
}
</style>