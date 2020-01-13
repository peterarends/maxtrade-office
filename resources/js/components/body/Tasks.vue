<template>
    <div class="tasks-body">
        <div class="button-bar" :class="getTheme">
            <div class="topTitleDiv">
                <!--Window title-->
                <span
                    >{{ t("Task") }}:
                    {{ getTask.id | formatTaskId(getNewTask) }}</span
                >
            </div>
            <div class="topRightIcons">
                <!--Window title icons-->
                <div
                    class="rightExitIcon"
                    :class="getTheme"
                    @click="closePanel"
                >
                    <img src="/images/close.png" />
                </div>
            </div>
        </div>
        <div class="body" :class="[getTask.status == 0 ? 'ended' : '']">
            <div class="date">
                <h3>
                    {{ t("Date start") }}: {{ getTask.created_at | formatDate }}
                </h3>
                <h3>
                    {{ t("Date end") }}:
                    <span v-show="getTask.status == 1" class="continues">{{
                        t("Continues")
                    }}</span>
                    <span v-show="getTask.status == 0">{{
                        getTask.updated_at | formatDate
                    }}</span>
                </h3>
            </div>
            <input class="title" type="text" v-model="getTask.title" />
            <textarea class="text_body" v-model="getTask.body"></textarea>
            <div class="taskStatus">
                <input
                    type="checkbox"
                    id="task_status"
                    v-model="getTask.status"
                />
                <label for="task_status">
                    <span></span>{{ t("Status of the task") }}:
                    <strong>{{
                        getTask.status
                            | statusFilter(t("Active"), t("Completed"))
                    }}</strong> </label
                >&nbsp;&nbsp;
                <input
                    class="decision"
                    type="text"
                    :placeholder="t('Short description of the decision ...')"
                    v-model="getTask.decision"
                />
            </div>
            <h4>{{ t("Documents attached to this task") }}:</h4>
            <div class="documents">
                <div
                    class="document"
                    v-for="document in getDocuments"
                    :key="document"
                >
                    <a
                        target="_blank"
                        v-bind:href="
                            'images/tasks/' + getTask.id + '/' + document
                        "
                    >
                        <img
                            :src="
                                ('images/tasks/' + getTask.id + '/' + document)
                                    | formatIcons
                            "
                            :alt="document"
                            @contextmenu.prevent="
                                $refs.menu.open($event, document)
                            "
                        />
                    </a>
                    <span class="documenName">{{ document }}</span>
                </div>
            </div>
            <div class="documentsButtons">
                <input
                    type="file"
                    id="file"
                    ref="file"
                    @change="onFileSelected"
                />
                &nbsp;&nbsp;&nbsp;<span ref="uploadPurcent"></span
                >&nbsp;&nbsp;&nbsp;
                <button
                    class="button"
                    :title="t('Add selected file.')"
                    @click="onUpload"
                >
                    <i class="mdi mdi-plus-circle-outline"></i>{{ t("Add") }}
                </button>
            </div>
        </div>
        <div class="bottom" :class="getTheme">
            <a @click.prevent="saveTask(true)">
                <i
                    class="mdi mdi-content-save-outline mdiTaskIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Save") }}
            </a>
            <a @click.prevent="deleteTask">
                <i
                    class="mdi mdi-delete-outline mdiTaskIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Delete") }}
            </a>
            <a @click.prevent="closePanel">
                <i
                    class="mdi mdi-close-outline mdiTaskIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Close") }}
            </a>
            <div class="status_panel">
                {{ t("Last change") }}: {{ getTask.updated_at | formatDate
                }}<span class="status_panel_user">
                    [#{{ getTask.last_id }} / {{ getTask.last_name }}]</span
                >
            </div>
        </div>
        <vue-context ref="menu" @open="onOpenContextMenu">
            <li>
                <a @click.prevent="onClickContextMenu('delete')">{{
                    t("Delete File")
                }}</a>
            </li>
        </vue-context>
    </div>
</template>

<script>
import Vue from "vue";
import moment from "moment";
import path from "path";
import axios from "axios";
import { VueContext } from "vue-context";
import { mapGetters, mapActions } from "vuex";
// import VueTranslate from "vue-translate-plugin";

// Vue.use(VueTranslate);

export default {
    name: "Tasks",

    data() {
        return {
            file: null,
            current_file: null
        };
    },

    components: {
        VueContext
    },

    computed: mapGetters([
        "getTheme",
        "getTask",
        "getNewTask",
        "getDocuments",
        "getLanguage"
    ]),

    // mounted() {
    //     this.$translate.setLang(this.getLanguage);
    // },

    // locales: {
    //     en_US: {},
    //     bg_BG: {
    //         Task: "Задача",
    //         "Date start": "Начало",
    //         "Date end": "Край",
    //         Continues: "Не е завършен",
    //         "Status of the task": "Състояние на задачата",
    //         Active: "Активна",
    //         Completed: "Приключена",
    //         "Short description of the decision ...":
    //             "Описание на решението ...",
    //         "Documents attached to this task":
    //             "Документи прикачени към тази задача",
    //         "Add selected file.": "Добави избрания файл.",
    //         Add: "Добави",
    //         Save: "Запиши",
    //         Delete: "Изтрий",
    //         Close: "Затвори",
    //         "Last change": "Последна промяна",
    //         "Delete File": "Изтрий файла"
    //     }
    // },

    filters: {
        formatDate: function(value) {
            if (value) {
                return moment(String(value)).format("DD.MM.YYYY hh:mm");
            }
        },
        statusFilter: function(value, label1, label2) {
            if (value == 1) {
                return label1;
            } else {
                return label2;
            }
        },
        formatTaskId: function(value, _new_task) {
            if (_new_task) {
                return "New Task";
            } else {
                return value;
            }
        },
        formatIcons(value) {
            const extension = path.extname(value);
            switch (extension) {
                case ".pdf":
                    return "images/document_icons/pdf.png";
                    break;
                case ".doc":
                case ".docx":
                    return "images/document_icons/doc.png";
                    break;
                case ".xls":
                case ".xlsx":
                    return "images/document_icons/xls.png";
                    break;
                case ".ppt":
                    return "images/document_icons/ppt.png";
                    break;
                case ".txt":
                    return "images/document_icons/txt.png";
                    break;
                case ".jpg":
                case ".jpeg":
                case ".png":
                    return "images/document_icons/pic.png";
                    break;
                default:
                    return "images/document_icons/default.png";
            }
        }
    },

    methods: {
        ...mapActions([
            "closePanel",
            "saveTask",
            "deleteTask",
            "deleteDocument",
            "changeDocuments",
            "changeProgress"
        ]),
        onFileSelected(event) {
            this.file = event.target.files[0];
        },
        onUpload() {
            const formData = new FormData();
            formData.append("file", this.file, this.file.name);
            axios
                .post("api/task/file/" + this.getTask.id, formData, {
                    onUploadProgress: uploudEvent => {
                        this.$refs.uploadPurcent.innerHTML =
                            Math.round(
                                (uploudEvent.loaded / uploudEvent.total) * 100
                            ) + "%";
                        this.changeProgress(
                            Math.round(
                                (uploudEvent.loaded / uploudEvent.total) * 100
                            )
                        );
                    }
                })
                .then(res => {
                    if (res.data.result == "success") {
                        this.$refs.file.value = "";
                        this.$refs.uploadPurcent.innerHTML = "";
                        this.changeProgress(0);
                        this.file = null;
                        this.changeDocuments();
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
        },
        onOpenContextMenu(event, data) {
            this.current_file = data;
        },
        onClickContextMenu(action) {
            if (action === "delete" && this.current_file !== null) {
                this.deleteDocument(this.current_file);
            }
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
.decision {
    flex: 1;
    border-bottom: 1px dotted #4a5568;
    background: transparent;
    text-align: left;
    padding: 0px 4px;
    font-size: 18px;
}
.text_body {
    background: transparent;
    height: 260px;
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
    display: flex;
    padding-top: 10px;
    padding-bottom: 20px;
    font-size: 18px;
}
.documents {
    background: #2d3748;
    height: 140px;
    border: 1px solid #4a5568;
    display: flex;
    padding: 10px;
    overflow: auto;
}
.document {
    display: flex;
    flex-direction: column;
    width: 140px;
    padding: 2px;
    align-items: center;
}
.documentsButtons {
    padding-top: 10px;
}
.line {
    border-top: 1px dotted #4a5568;
    padding: 10px 0px;
}
.v-context,
.v-context ul {
    background-color: #1a202c;
    background-clip: padding-box;
    border-radius: 0.25rem;
    border: 1px solid rgba(0, 0, 0, 0.15);
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.14),
        0 3px 1px -2px rgba(0, 0, 0, 0.2), 0 1px 5px 0 rgba(0, 0, 0, 0.12);
    display: block;
    margin: 0;
    padding: 0px;
    min-width: 10rem;
    z-index: 1500;
    position: fixed;
    list-style: none;
    box-sizing: border-box;
    max-height: calc(100% - 50px);
    overflow-y: auto;
}
.v-context > li,
.v-context ul > li {
    margin: 0;
    position: relative;
    cursor: pointer;
}
.v-context > li > a,
.v-context ul > li > a {
    display: block;
    padding: 0.5rem 1.5rem;
    font-weight: 400;
    color: #cbd5e0;
    text-decoration: none;
    white-space: nowrap;
    background-color: transparent;
    border: 0;
}
.v-context > li > a:focus,
.v-context > li > a:hover,
.v-context ul > li > a:focus,
.v-context ul > li > a:hover {
    text-decoration: none;
    color: #212529;
    background-color: #a0aec0;
}
.v-context:focus,
.v-context > li > a:focus,
.v-context ul:focus,
.v-context ul > li > a:focus {
    outline: 0;
}
.v-context__sub > a:after {
    content: "\2BC8";
    float: right;
    padding-left: 1rem;
}
.v-context__sub > ul {
    display: none;
}
@media screen and (max-width: 1440px), screen and (max-height: 900px) {
    .status_panel_user {
        display: none;
    }
    .text_body {
        background: transparent;
        height: 120px;
        padding: 4px;
        font-size: 18px;
    }
}
</style>
