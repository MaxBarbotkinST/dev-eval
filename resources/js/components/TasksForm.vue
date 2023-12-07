<template>
  <div class="max-w-md mx-auto mt-8 p-6 bg-white border rounded shadow-md">
    <h2 class="text-2xl font-bold mb-4">{{ formTitle }}</h2>
    <div v-if="task">
      <form @submit.prevent="save">
        <div class="mb-4">
          <label for="title" class="block text-sm font-medium text-gray-600">Title:</label>
          <input
              type="text"
              id="title"
              v-model="task.title"
              required
              class="mt-1 p-2 w-full border rounded-md"
          />
        </div>

        <div class="mb-4">
          <label for="description" class="block text-sm font-medium text-gray-600">Description:</label>
          <textarea
              id="description"
              v-model="task.description"
              required
              class="mt-1 p-2 w-full border rounded-md"
          ></textarea>
        </div>

        <div class="mb-4">
          <label for="status" class="block text-sm font-medium text-gray-600">Status:</label>
          <select
              id="status"
              v-model="task.status"
              required
              class="mt-1 p-2 w-full border rounded-md"
          >
            <option value="new">New</option>
            <option value="pending">Pending</option>
            <option value="completed">Completed</option>
          </select>
        </div>

        <button
            type="submit"
            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600"
        >
          Save
        </button>
      </form>
    </div>
    <div v-else>
      <h3>Task Not Found</h3>
      <a class="underline" href="/">Go back to list</a>
    </div>
  </div>
</template>

<script>
import {onMounted, ref} from 'vue';

export default {
  name: "TasksForm",

  setup() {
    const defaultTaskObj = {
      title: '',
      description: '',
      status: 'new',
    };
    const task = ref({});
    const formTitle = ref('Add New Task');

    async function getTaskObject() {
      if (window.location.pathname === '/create') {
        task.value = defaultTaskObj
      } else {
        const resp = await fetch(import.meta.env.VITE_API_ENDPOINT + '/tasks' + window.location.pathname, {
          method: 'get',
        }).then(res => {
          return res.json();
        });
        task.value = resp.data ?? null
        formTitle.value = 'Edit task';
      }
    }

    async function save() {
      let url = '';
      let method = '';
      if (window.location.pathname === '/create') {
        url = import.meta.env.VITE_API_ENDPOINT + '/tasks';
        method = 'post';
      } else {
        url = import.meta.env.VITE_API_ENDPOINT + '/tasks' + window.location.pathname;
        method = 'put';
      }
      const resp = await fetch(url, {
        method: method,
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify(task.value)
      }).then(res => {
        return res.json();
      });
      if (resp) {
        window.location.href = '/';
      }
    }

    onMounted(() => {
      getTaskObject();
    });

    return {
      task,
      formTitle,
      save
    };
  },
};
</script>
