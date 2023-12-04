<template>
    <li class="p-3 list-none border-2 rounded-xl">
        <p>{{ todo.title }}</p>
        <Btn buttonTxt="삭제" @button-click="handleDelete(todo.id)" />
        <Btn buttonTxt="수정" @button-click="handleEdit" />
    </li>
</template>
<script>
import todoAPI from "../../api/todoApi";
import Btn from "./common/Btn.vue";

export default {
    components: {
        Btn,
    },
    props: {
        todo: Object,
    },
    setup: (props, { emit }) => {
        // todos를 반응형 참조로 만든다.

        const handleDelete = async (todoId) => {
            try {
                if (confirm("상품을 삭제하시겠습니까?")) {
                    await todoAPI.deleteTodo(todoId);
                    emit("delete-todo", todoId);
                }
            } catch (error) {
                console.error(error);
            }
        };
        const handleEdit = () => {
            console.log("수정 버튼이 클릭되었습니다.");
        };

        return {
            handleDelete,
            handleEdit,
        };
    },
};
</script>
