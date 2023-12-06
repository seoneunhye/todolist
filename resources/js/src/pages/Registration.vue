<template>
    <h1 class="pt-8 mt-8 font-mono text-4xl font-extrabold text-center">
        ToDoList 등록
    </h1>
    <form @submit.prevent="handleRegister" class="m-5">
        <label for="title" class="mb-1 font-bold">오늘의 할 일</label><br />
        <input
            type="text"
            id="title"
            placeholder="15자 이내로 작성"
            class="w-5/6 mb-2 border-2 rounded-md"
            v-model="todoForm.title"
            required
        /><br />
        <ErrorMessage :errorMessage="errorMessage.title" />
        <label for="description" class="font-bold">할 일 상세 기록</label><br />
        <textarea
            id="description"
            cols="10"
            rows="5"
            placeholder="100자 이내로 작성"
            class="w-5/6 mb-2 border-2 rounded-md"
            v-model="todoForm.description"
            required
        ></textarea>
        <ErrorMessage :errorMessage="errorMessage.description" />
        <Button buttonType="submit" buttonTxt="등록하기" />
    </form>
</template>

<script>
import todoAPI from "../api/todoApi";
import Button from "../components/common/Button.vue";
import ErrorMessage from "../components/common/ErrorMessage.vue";
import { reactive } from "vue";
import { useRouter } from "vue-router";

export default {
    name: "Registration",
    components: {
        Button,
        ErrorMessage,
    },
    setup() {
        const errorMessage = reactive({ title: "", description: "" });
        const router = useRouter();
        const todoForm = reactive({ title: "", description: "" });

        const handleRegister = async (event) => {
            event.preventDefault();
            try {
                await todoAPI.addTodo(todoForm);
                await router.push({ name: "home" });
            } catch (error) {
                const errorData = error.response.data.error;
                errorMessage.title = errorData.title[0];
                errorMessage.description = errorData.description[0];
            }
        };
        return { handleRegister, todoForm, errorMessage };
    },
};
</script>
