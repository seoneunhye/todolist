import axios from "axios";

const API_BASE_URL = "/api";

const todoAPI = {
    async getTotalTodos() {
        const todos = await axios.get(`${API_BASE_URL}/todos`);
        return todos.data;
    },
    async getTodo(todoId) {
        const todo = await axios.get(`${API_BASE_URL}/todos/${todoId}`);
        return todo.data;
    },
    async deleteTodo(todoId) {
        const todo = await axios.delete(`${API_BASE_URL}/todos/${todoId}`);
        return todo.data;
    },
    async addTodo(todoData) {
        const todo = await axios.post(`${API_BASE_URL}/todos`, todoData);
        return todo.data;
    },
};

export default todoAPI;
