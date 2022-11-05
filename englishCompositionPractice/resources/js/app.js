import HeaderComponent from "./components/HeaderComponent";
import TaskListComponent from "./components/TaskListComponent";

require('./bootstrap');

window.Vue = require('vue').default;

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('header-component', HeaderComponent);
Vue.component('tasklist-component', TaskListComponent);

const app = new Vue({
    el: '#app',
});
