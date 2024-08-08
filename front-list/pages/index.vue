<script setup lang="ts">
import { ref, watch, onMounted } from "vue";
import { useFetch } from "#app";

const isClient = ref(false);

onMounted(() => {
  isClient.value = true;
});

const { data, pending, error } = useFetch("http://localhost:8000/graphql", {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
  },
  body: JSON.stringify({
    query: `
      {
        tasks {
          id
          name
          description
        }
      }
    `,
  }),
});

const tasks = ref(data?.value?.data?.tasks || []);
// Log de las tareas iniciales
console.log("Tasks on setup:", tasks.value);

// Observa cambios en tasks y log de las tareas
watch(tasks, (newTasks) => {
  console.log("Tasks updated:", newTasks);
});

// Configuración SEO
useSeoMeta({
  title: "Home page",
  description: "to-do list",
});
</script>

<template>
  <div class="flex flex-col items-center justify-center min-h-screen p-2">
    <a-page-header
      style="
        border: 1px solid rgb(235, 237, 240);
        width: 100%;
        max-width: 800px;
      "
      title="Tasks"
    />
    <div v-if="isClient" class="w-full max-w-6xl">
      <a-table
        :data-source="tasks"
        class="w-full"
        bordered
        :scroll="{ x: 500, y: 500 }"
      >
        <a-table-column-group>
          <a-table-column key="name" title="Name" data-index="name" />
          <a-table-column
            key="description"
            title="Description"
            data-index="description"
          />
        </a-table-column-group>
        <a-table-column key="action" title="Action">
          <template #default="{ record }">
            <span>
              <a-button type="primary" danger>Delete</a-button>
            </span>
          </template>
        </a-table-column>
      </a-table>
    </div>
  </div>
</template>
