<template>
    <li class="p-3 list-none border-2 rounded-xl">
        <p class="py-3">{{ todo.title }}</p>
        <Button buttonTxt="삭제" @button-click="handleDelete(todo.id)" />
        <Button buttonTxt="수정" @button-click="handleEdit(todo.id)" />
    </li>
</template>
<script>
import todoAPI from "../../api/todoApi";
import Button from "./common/Button.vue";

export default {
    components: {
        Button,
    },
    props: {
        todo: Object,
    },
    setup: (props, { emit }) => {
        // todos를 반응형 참조로 만든다.

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
        const handleEdit = (todoId) => {
            emit("update-todo", todoId);
        };

        return {
            handleDelete,
            handleEdit,
        };
    },
};
</script>
