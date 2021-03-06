<template>
    <div class="address-body">
        <div class="button-bar" :class="getTheme">
            <div class="topTitleDiv">
                <!--Window title-->
                <span>{{ t("Contacts") }}</span>
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
        <div class="body">
            <div class="searchpanel">
                <input
                    type="text"
                    class="searchInput"
                    :class="getTheme"
                    ref="search_contacts"
                    :placeholder="t('search for a match ...')"
                    @input="allSearchContacts($event)"
                />
            </div>
            <div class="vp20"></div>
            <div class="resultpanel" ref="top">
                <div
                    class="contactItem"
                    v-for="contact in getContacts"
                    :key="contact.id"
                    :class="[
                        contact.id == getCurrentContact.id ? 'active' : '',
                        getTheme
                    ]"
                >
                    <input
                        type="text"
                        class="title"
                        v-model="contact.name"
                        @click="changeCurrentContact(contact)"
                        :placeholder="t('contact name ...')"
                    />
                    <div>
                        <input
                            type="text"
                            class="title_phone"
                            v-model="contact.phone"
                            @click="changeCurrentContact(contact)"
                            :placeholder="t('phone ...')"
                        />
                        |
                        <input
                            type="text"
                            class="title_phone"
                            v-model="contact.email"
                            @click="changeCurrentContact(contact)"
                            :placeholder="t('email ...')"
                        />
                    </div>
                    <textarea
                        maxlength="100"
                        class="title_description"
                        v-model="contact.description"
                        @click="changeCurrentContact(contact)"
                        :placeholder="t('description ...')"
                    ></textarea>
                </div>
            </div>
        </div>
        <div class="bottom" :class="getTheme">
            <a @click.passive="saveContactsLocal">
                <i
                    class="mdi mdi-content-save-outline mdiProjectIcon"
                    v-bind:class="getTheme"
                ></i
                >&nbsp;{{ t("Save") }}
            </a>
            <a @click.passive="addContactLocal">
                <i
                    class="mdi mdi-plus-circle-outline mdiProjectIcon"
                    v-bind:class="getTheme"
                ></i
                >&nbsp;{{ t("Add") }}
            </a>
            <a @click.prevent="defelteContactLocal">
                <i
                    class="mdi mdi-delete-outline mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Delete") }}
            </a>
            <a @click.prevent="closePanel">
                <i
                    class="mdi mdi-close-outline mdiProjectIcon"
                    :class="getTheme"
                ></i
                >&nbsp;{{ t("Close") }}
            </a>
            <div class="status_panel"></div>
        </div>
    </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
    name: "Contacts",

    computed: mapGetters(["getTheme", "getContacts", "getCurrentContact"]),

    methods: {
        ...mapActions([
            "closePanel",
            "changeCurrentContact",
            "deleteContact",
            "saveContacts",
            "addContact",
            "allSearchContacts"
        ]),
        defelteContactLocal() {
            if (this.getCurrentContact.id != null) {
                if (
                    confirm(
                        this.$translate.text(
                            "Do you want to delete the contact?"
                        )
                    )
                ) {
                    this.deleteContact();
                }
            }
        },
        addContactLocal() {
            this.$refs.top.scrollTop = 0;
            this.addContact();
        },
        saveContactsLocal() {
            this.saveContacts();
            alert(
                this.$translate.text("You have successfully saved the changes!")
            );
        }
    }
};
</script>

<style scoped>
.address-body {
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
    color: #3182ce;
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
.searchpanel {
    display: flex;
}
.searchInput {
    border-radius: 0.25rem;
    flex: 1;
    padding-left: 0.25rem;
    padding-bottom: 0.25rem;
    margin-right: 0.25rem;
}
.searchInput.light {
    background-color: #f7fafc;
    border: 1px solid #edf2f7;
    color: #4a5568;
}
.searchInput.dark {
    background-color: #1a202c;
    border: 1px solid #2d3748;
    color: #e2e8f0;
}
.searchInput.light::placeholder {
    color: #e2e8f0;
}
.searchInput.dark::placeholder {
    color: #4a5568;
}
.resultpanel {
    display: flex;
    flex-wrap: wrap;
    max-height: calc(100vh - 250px);
    overflow-y: auto;
    justify-content: space-between;
}
.contactItem {
    display: flex;
    flex-direction: column;
    height: 100px;
    width: 32%;
    padding: 2px;
    margin: 2px;
}
.title {
    background: transparent;
    padding: 0px;
    width: 100%;
}
.title_description {
    background: transparent;
    padding: 0px;
    width: 100%;
    height: 60px;
}
.title_phone {
    background: transparent;
    padding: 0px;
}
.contactItemTitle {
    height: 100%;
    width: 30px;
    background: #2d3748;
    transition: 0.3s;
    cursor: pointer;
}
.contactItem.light {
    background: #e2e8f0;
    color: #718096;
}
.contactItem.dark {
    background: #4a5568;
    color: #cbd5e0;
}
.contactItem:hover.light {
    background: #edf2f7;
    color: #718096;
}
.contactItem:hover.dark {
    background: #2d3748;
    color: #cbd5e0;
}
.contactItem.light.active {
    background: #edf2f7;
    color: #718096;
}
.contactItem.dark.active {
    background: #2d3748;
    color: #cbd5e0;
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
.mdiProjectIcon {
    font-size: 1.3rem;
}
.mdiProjectIcon.light {
    color: #63b3ed;
}
.mdiProjectIcon.dark {
    color: #3182ce;
}
@media screen and (max-width: 1440px), screen and (max-height: 900px) {
    .contactItem {
        display: flex;
        flex-direction: column;
        height: 100px;
        width: 49%;
        padding: 2px;
        margin: 2px;
    }
}
</style>
