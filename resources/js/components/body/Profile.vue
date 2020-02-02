<template>
  <div class="profile-body">
    <div class="button-bar" :class="getTheme">
      <div class="topTitleDiv">
        <!--Window title-->
        <span>{{ t("Profile") }} [{{ getUserName }}]</span>
      </div>
      <div class="topRightIcons">
        <!--Window title icons-->
        <div class="rightExitIcon" :class="getTheme" @click="closePanel">
          <img src="/images/close.png" />
        </div>
      </div>
    </div>
    <div class="body">
      <input class="title" type="text" v-model="getUser.name" />
      <input class="title" type="text" v-model="getUser.email" />
      <div class="vp20"></div>
      <div class="resultpanel">
        <h4>{{ t("Imap accounts") }}:</h4>
        <table style="width:100%">
          <tr>
            <th>{{ t("host") }}</th>
            <th>{{ t("port") }}</th>
            <th>{{ t("encryption") }}</th>
            <th>{{ t("username") }}</th>
            <th>{{ t("password") }}</th>
            <th>{{ t("protocol") }}</th>
            <th>{{ t("action") }}</th>
          </tr>
          <tr v-for="mailacount in getMailacounts" :key="mailacount.id">
            <td>
              <input type="text" class="controll" :class="getTheme" v-model="mailacount.host" />
            </td>
            <td>
              <input type="text" class="controll" :class="getTheme" v-model="mailacount.port" />
            </td>
            <td>
              <select class="controll" :class="getTheme" v-model="mailacount.encryption">
                <option value="SSL">SSL</option>
              </select>
            </td>
            <td>
              <input class="controll" :class="getTheme" type="text" v-model="mailacount.username" />
            </td>
            <td>
              <input class="controll" :class="getTheme" type="text" v-model="mailacount.password" />
            </td>
            <td>
              <select class="controll" :class="getTheme" v-model="mailacount.protocol">
                <option value="imap">imap</option>
              </select>
            </td>
            <td>
              <a
                class="delete"
                @click.prevent="
                                    deleteAccountLocal(mailacount.id)
                                "
              >{{ t("Delete") }}</a>
            </td>
          </tr>
        </table>
      </div>
      <div class="vp20"></div>
      <div>
        <button
          class="button_red"
          @click.prevent="deleteProfileLocal"
          :title="
                        t(
                            'Attention! Do you want to delete your account? Any documents and events associated with your account will also be deleted. The operation is irreversible!'
                        )
                    "
        >
          <i class="mdi mdi-account"></i>
          {{ t("Delete profile!") }}
        </button>
      </div>
    </div>
    <div class="bottom" :class="getTheme">
      <a @click.prevent="saveUser(true)">
        <i class="mdi mdi-content-save-outline mdiProjectIcon" v-bind:class="getTheme"></i>
        &nbsp;{{ t("Save") }}
      </a>
      <a @click.prevent="addAccount">
        <i class="mdi mdi-email-plus-outline mdiProjectIcon" v-bind:class="getTheme"></i>
        &nbsp;{{ t("Add mail account") }}
      </a>
      <a @click.prevent="closePanel">
        <i class="mdi mdi-close-outline mdiProjectIcon" :class="getTheme"></i>
        &nbsp;{{ t("Close") }}
      </a>
      <div class="status_panel"></div>
    </div>
  </div>
</template>

<script>
import { mapGetters, mapActions } from "vuex";

export default {
  name: "Contacts",

  computed: mapGetters([
    "getTheme",
    "getUserName",
    "getUser",
    "getMailacounts"
  ]),

  methods: {
    ...mapActions([
      "closePanel",
      "saveUser",
      "addAccount",
      "deleteAccount",
      "deleteProfile"
    ]),
    deleteAccountLocal(id) {
      if (confirm(this.$translate.text("Do you want to delete the account?"))) {
        this.deleteAccount(id);
      }
    },
    deleteProfileLocal() {
      if (
        confirm(
          this.$translate.text(
            "Attention! Do you want to delete your account? Any documents and events associated with your account will also be deleted. The operation is irreversible!"
          )
        )
      ) {
        this.deleteProfile();
      }
    }
  }
};
</script>

<style scoped>
.profile-body {
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
.title {
  background: transparent;
  padding: 4px;
  font-size: 32px;
}
.resultpanel {
  display: flex;
  flex-direction: column;
  max-height: calc(100vh - 250px);
  overflow-y: auto;
}
.controll {
  width: 100%;
  padding: 1px 3px;
}
.controll.light {
  background: #edf2f7;
  border: 1px dotted #a0aec0;
}
.controll.dark {
  background: #2d3748;
  border: 1px dotted #4a5568;
}
.delete {
  color: #c53030;
  cursor: pointer;
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
.mdiExitIcon {
  font-size: 1.3rem;
}
.mdiExitIcon.light {
  color: #c53030;
}
.mdiExitIcon.dark {
  color: #c53030;
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
