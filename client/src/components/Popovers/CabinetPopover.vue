<template>
  <el-popover placement="top-start" :width="340" trigger="hover">
    <h3>Мій акаунт</h3>
    <div>
      <el-button index="3" type="info" link @click="account">
        <el-icon color="#909399" :size="25">
          <Box />
        </el-icon>
        Мої замовлення</el-button>
    </div>
    <div>
      <el-button index="3" type="info" link @click="account">
        <el-icon color="#909399" :size="25">
          <Document />
        </el-icon>
        Мої дані</el-button>
    </div>
    <el-divider />
    <div>
      <el-button index="3" type="info" link @click="logoutUser">
        <el-icon color="#909399" :size="25">
          <SwitchButton />
        </el-icon>
        Вийти</el-button>
    </div>

    <template #reference>
      <el-button index="3" type="info" link @click="account">
        <el-icon color="#909399" :size="20">
          <User />
        </el-icon>
        {{ this.getUser.name }}
      </el-button>
    </template>
  </el-popover>
</template>

<script>
import { mapGetters, mapActions } from 'vuex';

export default {
  name: 'CabinetPopover',

  computed: {
    ...mapGetters(['getUser'])
  },

  methods: {
    ...mapActions(['logout']), 

    account() {
      // this.$router.push({
      //   name: 'account'
      // })
    },

    logoutUser() {
      this.logout(this.getUser);
      this.$router.push({
        name: 'home',
      });
    }
  },
}
</script>

<style scoped>
.el-icon {
  margin-right: 5px;
}

.el-button {
  margin: 16px 10px 0 0;
  font-size: 16px;
  letter-spacing: .5px;
}

h3 {
  font-size: 18px;
  letter-spacing: .5px;
}

div {
  padding: 10px 0 0 0;
}
</style>