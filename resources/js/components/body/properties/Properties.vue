<template>
    <div class="properties-body">
        <div class="top">
            <input
                type="text"
                class="search_input"
                placeholder="Search settings ..."
                v-bind:class="theme"
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
                            v-bind:class="theme"
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
                                    v-bind:class="theme"
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
    padding: 2px 5px;
    width: 100%;
}
.search_input.dark {
    background-color: #1a202c;
    border: 1px solid #2d3748;
    color: #e2e8f0;
}
.search_input.light {
    background-color: #F7FAFC;
    border: 1px solid #EDF2F7;
    color: #4A5568;
}
.search_input.dark::placeholder {
    color: #4a5568;
}
.search_input.light::placeholder {
    color: #CBD5E0;
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
}
.property_row.dark {
    border-left: 1px dotted #4a5568;
}
.property_row.light {
    border-left: 1px dotted #E2E8F0;
}
.controll {
    padding: 1px 3px;
}
.controll.dark {
    background: #4a5568;
    border: 1px dotted #718096;
}
.controll.light {
    background: #E2E8F0;
    border: 1px dotted #CBD5E0;
}
</style>
