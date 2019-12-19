<template>
    <div>
        {{project.title}}
    </div>
</template>

<script>
export default {
    name: "Projects",

    props: ["project"]
}
</script>

<style scoped>
.projects-body {
    width: 100%;
    display: flex;
    flex-direction: column;
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
.body {
    flex: 1;
    padding: 10px;
}
</style>