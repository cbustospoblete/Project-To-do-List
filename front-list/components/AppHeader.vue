<template>
  <header>
    <a-layout-header class="bg-[#001529] flex items-center justify-between">
      <a-menu
        theme="dark"
        mode="horizontal"
        :defaultSelectedKeys="['1']"
        class="flex-1"
      >
        <a-menu-item key="1">
          <nuxt-link to="/">Inicio</nuxt-link>
        </a-menu-item>
        <a-menu-item key="2">
          <nuxt-link to="/create-task">Tasks</nuxt-link>
        </a-menu-item>
      </a-menu>
    </a-layout-header>
  </header>
</template>
