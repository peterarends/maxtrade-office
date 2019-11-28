<template>
    <div class="properties-body">
        <hr />
        <div class="top">
            <input type="text" class="search_input" placeholder="Search settings ...">
        </div>
        <div class="body">
            <div class="left">
                <h3>Categories:</h3>
                <ul>
                    <li v-for="category in categories" v-bind:key="category.category" class="category">
                        {{category.category}}
                    </li>
                </ul>
            </div>
            <div class="right">
                body panel
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Properties",

    data() {
        return {
            properties: [],
            property: {
                id: "",
                name: "",
                value: "",
                category: ""
            },
            property_id: "",
            edit: false,
            categories: [],
            category: {
                category: ""
            }
        };
    },

    created() {
        this.fetchCategories();
        this.fetchProperties();
    },

    methods: {
        fetchProperties() {
            fetch("api/properties")
                .then(res => res.json())
                .then(res => {
                    this.properties = res.data;
                });
        },

        fetchCategories() {
            fetch("api/properties_categories")
                .then(res => res.json())
                .then(res => {
                    this.categories = res.data;
                });
        }
    }
};
</script>

<style scoped>
.properties-body {
    width: 100%;
    display: flex;
    flex-direction: column;
}
.top {
    padding: 10px 10px 10px 0px;
}
.search_input{
    padding: 2px 5px;
    background: #EDF2F7;
    width: 100%;
}
.search_input:focus{
    outline: 1px solid #CBD5E0;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
.body {
    display: flex;
    flex: 1;
}
.left{
    flex: 1;
    padding: 5px;
}
.category{
    padding: 2px 2px 2px 10px;
    font-size: 16px;
}
.right{
    flex: 4;
}
</style>
