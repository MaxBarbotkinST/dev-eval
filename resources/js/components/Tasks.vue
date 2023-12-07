<template>
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 sm:flex block justify-between gap-6">
    <div class="w-full">
      <div class="m-2 text-center">
        <a class="underline" href="/create">Add new task</a>
      </div>
      <div v-if="tasks.length" class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full">
        <div class="p-3 text-gray-900 flex gap-6 items-center record-list-item border-b-2 border-b-sky-200">
          <div class="w-1/4 text-center">
            Title
          </div>
          <div class="w-1/4 text-center">
            Description
          </div>
          <div class="w-1/4 text-center">
            Status
          </div>
          <div class="w-1/4 text-center">
            Actions
          </div>
        </div>
        <div v-for="(task, i) of tasks" :key="i">
          <div class="p-3 text-gray-900 flex gap-6 items-center record-list-item border-b-2">
            <div class="w-1/4 text-center">
              {{ task.title }}
            </div>
            <div class="w-1/4 text-center">
              {{ task.description }}
            </div>
            <div class="w-1/4 text-center">
              <div v-if="task.status==='new'" class="p-0.5 rounded bg-green-200">
                {{ task.status }}
              </div>
              <div v-else-if="task.status==='pending'" class="p-0.5 rounded bg-yellow-200">
                {{ task.status }}
              </div>
              <div v-else class="p-0.5 rounded bg-red-200">
                {{ task.status }}
              </div>
            </div>
            <div class="w-1/4 text-center flex gap-6 items-center justify-center">
              <div>
                <i @click="deleteTask(task.id)" class="fa-solid fa-trash cursor-pointer"></i>
              </div>
              <div>
                <a :href="'/'+task.id">
                  <i class="fa-solid fa-pen-to-square cursor-pointer"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-else class="bg-white overflow-hidden shadow-sm sm:rounded-lg w-full p-6">
        There are no tasks
      </div>
    </div>
  </div>
</template>

<script>
import {onMounted, ref} from "vue";

export default {
  name: "Tasks",

  setup() {
    const tasks = ref([]);

    function fetchTasks() {
      return fetch(import.meta.env.VITE_API_ENDPOINT + '/tasks', {
        method: 'get',
      }).then(res => {
        return res.json();
      }).then(json => {
        tasks.value = json.data;
      });
    }

    async function deleteTask(id) {
      await fetch(import.meta.env.VITE_API_ENDPOINT + '/tasks/' + id, {
        method: 'delete',
      }).then(res => {
        return res.json();
      });

      await fetchTasks();
    }

    onMounted(() => {
      fetchTasks();
    });

    return {
      tasks,
      deleteTask,
    }
  }
}
</script>

<style scoped>
</style>
