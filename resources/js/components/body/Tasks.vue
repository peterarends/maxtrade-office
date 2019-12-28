<template>
    <div class="tasks-body">
        <div class="button-bar" v-bind:class="theme">
            <div class="topTitleDiv">
                <!--Window title-->
                <span>Task: {{ task.id | formatTaskId(new_task) }}</span>
            </div>
            <div class="topRightIcons">
                <!--Window title icons-->
                <div
                    class="rightExitIcon"
                    v-bind:class="theme"
                    v-on:click="closeTask"
                >
                    <img src="/images/close.png" />
                </div>
            </div>
        </div>
        <div class="body" v-bind:class="[task.status == 0 ? 'ended' : '']">
            <div class="date">
                <h3>Date start: {{ task.created_at | formatDate }}</h3>
                <h3>
                    Date end:
                    <span v-show="task.status == 1" class="continues"
                        >Continues</span
                    >
                    <span v-show="task.status == 0">{{
                        task.updated_at | formatDate
                    }}</span>
                </h3>
            </div>
            <input class="title" type="text" v-model="task.title" />
            <textarea
                class="text_body"
                rows="10"
                v-model="task.body"
            ></textarea>
            <div class="taskStatus">
                <input type="checkbox" id="task_status" v-model="task.status" />
                <label for="task_status">
                    <span></span>Status of the task:
                    <strong>{{ task.status | statusFilter }}</strong>
                </label>
            </div>
            <hr class="line" />
            <h4>Documents attached to this task:</h4>
            <div class="documents">&nbsp;</div>
            <div class="documentsButtons">
                <input
                    type="file"
                    id="file"
                    accept="image/jpeg, application/pdf"
                    ref="file"
                    v-on:change="handleFileUpload"
                />
                <button
                    class="button"
                    title="Add selected file."
                    v-on:click="submitFile"
                >
                    <i class="mdi mdi-plus-circle-outline"></i>Add
                </button>
            </div>
        </div>
        <div class="bottom" v-bind:class="theme">
            <a v-on:click.prevent="saveTask">
                <i
                    class="mdi mdi-content-save-outline mdiTaskIcon"
                    v-bind:class="theme"
                ></i
                >&nbsp;Save Task
            </a>
            <a v-on:click.prevent="deleteTask">
                <i
                    class="mdi mdi-delete-outline mdiTaskIcon"
                    v-bind:class="theme"
                ></i
                >&nbsp;Delete Task
            </a>
            <a v-on:click.prevent="closeTask">
                <i
                    class="mdi mdi-close-outline mdiTaskIcon"
                    v-bind:class="theme"
                ></i
                >&nbsp;Close Task
            </a>
            <div class="status_panel">
                Last change: {{ task.updated_at | formatDate }}
            </div>
        </div>
    </div>
</template>

<script>
import moment from "moment";

export default {
    name: "Tasks",

    props: ["theme", "task", "new_task"],

    data() {
        return {
            file: ""
        };
    },

    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format("DD.MM.YYYY hh:mm");
            }
        },
        statusFilter: function(value) {
            if (value == 1) {
                return "Active";
            } else {
                return "Completed";
            }
        },
        formatTaskId: function(value, _new_task) {
            if (_new_task) {
                return "New Task";
            } else {
                return value;
            }
        }
    },

    methods: {
        closeTask: function(event) {
            this.$emit("closepanel");
        },
        saveTask: function(event) {
            this.$emit("savetask");
        },
        deleteTask: function(event) {
            this.$emit("deletetask");
        },
        handleFileUpload() {
            this.file = this.$refs.file.files[0];
        },
        submitFile() {
            let formData = new FormData();
            formData.append("file", this.file);
            axios
                .post("api/task/file/" + this.task.id, formData, {
                    headers: {
                        "Content-Type": "multipart/form-data"
                    }
                })
                .then(res => {
                    if (res.data.result == "success") {
                        this.$refs.file.value = "";
                        this.file = "";
                    } else {
                        if (res.data.result === "no file") {
                            alert("You have not specified a file to upload!");
                        }
                        if (res.data.result === "exceed file size") {
                            alert(
                                "The file you are trying to upload exceeds the maximum allowed size!"
                            );
                        }
                        if (res.data.result === "wrong file type") {
                            alert(
                                "This type of file is not allowed for upload!"
                            );
                        }
                    }
                })
                .catch(function(e) {
                    console.log(e.mesage);
                });
        }
    }
};
</script>

<style scoped>
.tasks-body {
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
.topTitleDiv {
    /* text-center flex-grow text-xl pl-2 pr-2 text-gray-300 */
    text-align: center;
    flex-grow: 1;
    font-size: 1.25rem;
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    color: #dd6b20;
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
    display: flex;
    flex-direction: column;
}
.ended {
    text-decoration: line-through;
}
.date {
    display: flex;
    justify-content: space-between;
    padding-bottom: 20px;
}
.title {
    background: transparent;
    text-align: center;
    padding: 4px;
    font-size: 32px;
}
.text_body {
    background: transparent;
    padding: 4px;
    font-size: 18px;
}
.continues {
    color: green;
}
.bottom {
    display: flex;
    padding: 2px;
    height: 30px;
}
.bottom.light {
    background: #edf2f7;
    border-bottom: 1px solid #f7fafc;
    border-top: 1px solid #e2e8f0;
}
.bottom.dark {
    background: #2d3748;
    border-bottom: 1px solid #1a202c;
    border-top: 1px solid #4a5568;
}
.bottom a {
    display: flex;
    align-items: center;
    align-content: center;
    padding-left: 12px;
    padding-right: 12px;
    transition: all 0.3s ease;
    height: 24px;
    cursor: pointer;
}
.bottom.light a {
    color: #2d3748;
    border-right: 1px solid #f7fafc;
    background: #edf2f7;
}
.bottom.dark a {
    color: #edf2f7;
    border-right: 1px solid #1a202c;
    background: #2d3748;
}
.bottom.dark a:hover {
    background-color: #2b6cb0;
    color: #f7fafc;
}
.bottom.light a:hover {
    background-color: #90cdf4;
    color: #1a202c;
}
.status_panel {
    flex: 1;
    text-align: right;
}
.mdiTaskIcon {
    font-size: 1.3rem;
}
.mdiTaskIcon.light {
    color: #63b3ed;
}
.mdiTaskIcon.dark {
    color: #3182ce;
}
label {
    display: inline-block;
    cursor: pointer;
    position: relative;
}
label span {
    display: inline-block;
    position: relative;
    background-color: transparent;
    width: 25px;
    height: 25px;
    transform-origin: center;
    border: 2px solid #718096;
    border-radius: 50%;
    vertical-align: -6px;
    margin-right: 10px;
    transition: background-color 150ms 200ms,
        transform 350ms cubic-bezier(0.78, -1.22, 0.17, 1.89);
}
label span:before {
    content: "";
    width: 0px;
    height: 2px;
    border-radius: 2px;
    background: #cbd5e0;
    position: absolute;
    transform: rotate(45deg);
    top: 10px;
    left: 8px;
    transition: width 50ms ease 50ms;
    transform-origin: 0% 0%;
}
label span:after {
    content: "";
    width: 0;
    height: 2px;
    border-radius: 2px;
    background: #cbd5e0;
    position: absolute;
    transform: rotate(305deg);
    top: 13px;
    left: 9px;
    transition: width 50ms ease;
    transform-origin: 0% 0%;
}
label:hover span:before {
    width: 5px;
    transition: width 100ms ease;
}
label:hover span:after {
    width: 10px;
    transition: width 150ms ease 100ms;
}
input[type="checkbox"] {
    display: none;
}
input[type="checkbox"]:checked + label span {
    background-color: #cbd5e0;
    transform: scale(1.25);
}
input[type="checkbox"]:checked + label span:after {
    width: 10px;
    background: #1790b5;
    transition: width 150ms ease 100ms;
}
input[type="checkbox"]:checked + label span:before {
    width: 5px;
    background: #1790b5;
    transition: width 150ms ease 100ms;
}
input[type="checkbox"]:checked + label:hover span {
    background-color: #cbd5e0;
    transform: scale(1.25);
}
input[type="checkbox"]:checked + label:hover span:after {
    width: 10px;
    background: #1790b5;
    transition: width 150ms ease 100ms;
}
input[type="checkbox"]:checked + label:hover span:before {
    width: 5px;
    background: #1790b5;
    transition: width 150ms ease 100ms;
}
.taskStatus {
    padding-top: 10px;
    padding-bottom: 10px;
    font-size: 18px;
}
.documents {
    background: #2d3748;
    height: 100px;
    border: 1px solid #4a5568;
    display: flex;
}
.documentsButtons {
    padding-top: 10px;
}
.line {
    border-top: 1px dotted #4a5568;
    padding: 10px 0px;
}
</style>
