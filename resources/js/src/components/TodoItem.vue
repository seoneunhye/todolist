<template>
    <li class="p-3 list-none border-2 rounded-xl">
        <div>
            <strong
                :class="{ 'line-through': todo.is_completed }"
                class="block mb-2"
                >🔸{{ todo.title }}</strong
            >
            <p
                :class="{ 'line-through': todo.is_completed }"
                class="block h-32 p-2 mb-2 overflow-auto break-words bg-yellow-400 rounded-md"
            >
                {{ todo.description }}
            </p>
        </div>
        <Button buttonTxt="삭제" @click-button="handleDelete(todo.id)" />
        <Button buttonTxt="수정" @click-button="handleOpenEditModal" />
    </li>
    <EditModal
        v-if="isShow"
        :todo="todo"
        @show-modal="handleCancelEditModal"
        @update-todo="handleUpdateTodo"
    />
</template>
<script>
import { ref } from "vue";
import todoAPI from "../api/todoApi";
import Button from "./common/Button.vue";
import EditModal from "./common/EditModal.vue";

export default {
    components: {
        Button,
        EditModal,
    },
    props: {
        todo: Object,
        todos: Array,
    },
    emits: ["delete-todo", "update-todo"],
    setup: (props, { emit }) => {
        const isShow = ref(false);

        const handleUpdateTodo = (updatedTodo) => {
            const index = props.todos.findIndex(
                (todo) => todo.id === updatedTodo.id
            );
            if (index !== -1) {
                props.todos[index] = updatedTodo;
            }
        };

        const handleDelete = async (todoId) => {
            try {
                if (confirm("해당 항목을 삭제하시겠습니까?")) {
                    await todoAPI.deleteTodo(todoId);
                    emit("delete-todo", todoId);
                }
            } catch (error) {
                console.error(error);
            }
        };
        const handleOpenEditModal = () => {
            isShow.value = true;
        };

        const handleCancelEditModal = (modalState) => {
            isShow.value = modalState;
        };

        return {
            handleUpdateTodo,
            handleDelete,
            handleOpenEditModal,
            handleCancelEditModal,
            isShow,
        };
    },
};
</script>
