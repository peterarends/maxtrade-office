<template>
    <div>
        <h2 class="text-3xl">Projects</h2>
        <div v-for="project in projects" v-bind:key="project.id" 
        class="max-w-sm rounded overflow-hidden shadow-lg">
            <div class="px-6 py-4">
                <div class="font-bold text-xl mb-2">{{project.title}}</div>
                <p class="text-gray-700 text-base">{{project.body}}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
  data() {
    return {
      projects: [],
      project: {
        id: "",
        title: "",
        body: ""
      },
      article_id: "",
      pagination: {},
      edit: false
    };
  },

  created() {
    this.fetchProjects();
  },

  methods: {
    fetchProjects() {
      fetch("api/projects")
        .then(res => res.json())
        .then(res => {
          this.projects = res.data;
        });
    }
  }
};
</script>

<style scoped>
</style>
