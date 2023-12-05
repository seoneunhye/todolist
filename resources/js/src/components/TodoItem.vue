<template>
    <li class="p-3 list-none border-2 rounded-xl">
        <strong class="block mb-2">{{ todo.title }}</strong>
        <p class="block mb-2">{{ todo.description }}</p>
        <Button buttonTxt="삭제" @button-click="handleDelete(todo.id)" />
        <Button buttonTxt="수정" @button-click="handleOpenEditModal" />
    </li>
    <EditModal v-if="isShow" :todo="todo" @show-modal="handleCancelEditModal" />
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
    },
    emits: ["delete-todo", "update-todo"],
    setup: (props, { emit }) => {
        const isShow = ref(false);

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
            handleDelete,
            handleOpenEditModal,
            handleCancelEditModal,
            isShow,
        };
    },
};
</script>
