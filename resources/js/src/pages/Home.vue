<template>
    <h1 class="pt-8 font-mono text-4xl font-extrabold text-center">ToDoList</h1>
    <div class="flex justify-end pr-4">
        <Button
            @button-click="handleMoveToRegistration"
            buttonTxt="할 일 입력하기"
            class="p-1 mt-4 font-bold text-blue-600 border-2 rounded-xl"
        ></Button>
    </div>
    <div class="m-4 border-2">
        <h2 class="p-2 text-xl font-semibold text-center">오늘의 할 일</h2>
    </div>
    <ul class="grid grid-cols-2 gap-2 m-4">
        <TodoItem
            v-for="todo in todos"
            :key="todo.id"
            :todo="todo"
            @delete-todo="handleApplyDeletedState"
        />
    </ul>
</template>

<script>
import TodoItem from "../components/TodoItem.vue";
import todoAPI from "../api/todoApi";
import EditModal from "../components/common/EditModal.vue";
import Button from "../components/common/Button.vue";
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";

export default {
    name: "Home",
    components: {
        TodoItem,
        EditModal,
        Button,
    },
    setup(props, { emit }) {
        const isShow = ref(false);
        const router = useRouter();
        const todos = ref([]);

        const fetchTodos = async () => {
            try {
                const response = await todoAPI.getTotalTodos();
                todos.value = response;
            } catch (error) {
                console.error("API 에러", error);
            }
        };

        onMounted(fetchTodos);

        // 삭제 API 통신 적용 후 todos reactive 에 삭제된 상태 적용하기
        const handleApplyDeletedState = (todoId) => {
            const index = todos.value.findIndex((todo) => todo.id === todoId);
            if (index !== -1) {
                todos.value.splice(index, 1);
            }
        };

        const handleMoveToRegistration = () => {
            router.push("/registration");
        };

        return {
            todos,
            handleApplyDeletedState,
            handleMoveToRegistration,
            isShow,
        };
    },
};
</script>
