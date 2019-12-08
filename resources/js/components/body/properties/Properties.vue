<template>
    <div class="properties-body">
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
                            v-for="property in properties.filter(
                                prop => prop.category === category.category
                            )"
                            v-bind:key="property.id"
                            class="category"
                        >
                            {{ property.name }}
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
    padding: 0px 0px 10px 10px;
}
.property_section {
    padding-bottom: 7px;
    text-decoration: underline;
}
</style>
