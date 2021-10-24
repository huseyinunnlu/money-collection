<template>
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link :to="{ name: 'Index' }" class="brand-link">
      <span class="brand-text font-weight-light">Logo </span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <SidebarUser v-if="_User"/>
      <nav class="mt-2">
        <ul
          class="nav nav-pills nav-sidebar flex-column"
          data-widget="treeview"
          role="menu"
          data-accordion="false"
        >

          <div class="admin-pages" v-if="$store.getters._User.role == '1'">
            <li class="nav-header">Admin Pages</li>
            
            <li class="nav-item">
              <router-link :to="{ name: 'AdminpanelUsers' }" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Users
                </p>
              </router-link>
            </li>

            <li class="nav-item menu-open">
            <router-link :to="{name:'AdminMoneyOperations'}" class="nav-link">
              <i class="nav-icon fas fa-lira-sign"></i>
              <p>
                Money Operations
              </p>
            </router-link>
          </li>
          </div>

          <div class="admin-pages">
            <li class="nav-header">Public Pages</li>
            <li class="nav-item">
              <a href="../widgets.html" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                  Moneys
                </p>
              </a>
            </li>
          </div>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>
<script>
import SidebarUser from "@/components/Sidebar/SidebarUser.vue";
import {mapGetters} from "vuex"
export default {
  components: {
    SidebarUser,
  },
  computed:{
    ...mapGetters(['_User'])
  }
};
</script>
