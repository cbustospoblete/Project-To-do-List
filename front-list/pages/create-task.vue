<script setup lang="ts">
import { ref } from "vue";
import { message } from "ant-design-vue";

const newTask = ref({ name: "", description: "" });

const createTask = async () => {
  try {
    const response = await fetch("http://localhost:8000/graphql", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        query: `
          mutation {
            createTask(input: {
              name: "${newTask.value.name}",
              description: "${newTask.value.description}"
            }) {
              id
              name
              description
            }
          }
        `,
      }),
    });

    const result = await response.json();

    if (result.data?.createTask) {
      message.success("Task created successfully!");
      newTask.value = { name: "", description: "" };
    } else {
      throw new Error(result.errors[0]?.message || "Error creating task");
    }
  } catch (error) {
    message.error(`Failed to create task: ${error.message}`);
  }
};
</script>

<template>
  <div class="p-6">
    <!-- Formulario de creación de tareas -->
    <a-form @submit.prevent="createTask" class="mb-6">
      <a-form-item label="Task Name" required>
        <a-input
          v-model:value="newTask.name"
          placeholder="Enter task name"
          class="w-full"
        />
      </a-form-item>
      <a-form-item label="Description" required>
        <a-textarea
          v-model:value="newTask.description"
          placeholder="Enter task description"
          class="w-full"
        />
      </a-form-item>
      <a-form-item>
        <a-button type="primary" html-type="submit"> Create Task </a-button>
      </a-form-item>
    </a-form>
  </div>
</template>
