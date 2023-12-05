<template>
    <div
        class="fixed inset-0 w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50"
    >
        <form
            class="relative p-5 mx-auto bg-white border rounded-md shadow-lg top-48 w-96"
        >
            <label for="title" class="mb-1">오늘의 할 일</label><br />
            <input
                type="text"
                v-model="todo.title"
                id="title"
                placeholder="15자 이내로 작성"
                class="w-5/6 mb-4 border-2 rounded-md"
                required
            /><br />
            <label for="description">할 일 상세 기록</label><br />
            <textarea
                id="description"
                v-model="todo.description"
                cols="10"
                rows="5"
                placeholder="100자 이내로 작성"
                class="w-5/6 mb-4 border-2 rounded-md"
                required
            ></textarea>
            <br />
            <label for="is_completed" class="mr-2">완료 여부</label>
            <input
                type="checkbox"
                id="is_completed"
                v-model="todo.is_completed"
            /><br />
            <Button buttonTxt="수정완료" @button-click="handleUpdateForm" />
            <Button buttonTxt="취소" @button-click="handleCancel" />
        </form>
    </div>
</template>

<script>
import Button from "./Button.vue";
import todoAPI from "../../api/todoApi";

export default {
    name: "Modal",
    components: { Button },
    props: {
        todo: Object,
    },
    emits: ["show-modal", "update-todo"],
    setup(props, { emit }) {
        //props를 통해 수정하기 이전값 불러오고, 수정한 값 api통신하기
        const handleUpdateForm = async (event) => {
            event.preventDefault();

            await todoAPI.updateTodo(props.todo, props.todo.id);
            emit("show-modal", false);
        };

        const handleCancel = (event) => {
            event.preventDefault();
            emit("show-modal", false);
        };

        return {
            handleCancel,
            handleUpdateForm,
        };
    },
};
</script>
