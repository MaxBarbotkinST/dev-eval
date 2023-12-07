import './bootstrap';

import Alpine from 'alpinejs';
import {createApp} from 'vue'
import Tasks from "./components/Tasks.vue";
import TasksForm from "./components/TasksForm.vue";

createApp(Tasks).mount("#tasks")
createApp(TasksForm).mount("#form")

window.Alpine = Alpine;

Alpine.start();
