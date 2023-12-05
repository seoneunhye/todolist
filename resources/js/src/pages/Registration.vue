<template>
    <h1 class="pt-8 mt-8 font-mono text-4xl font-extrabold text-center">
        ToDoList 등록
    </h1>
    <form @submit.prevent="handleRegister" class="m-5">
        <label for="title" class="mb-1">오늘의 할 일</label><br />
        <input
            type="text"
            id="title"
            placeholder="15자 이내로 작성"
            class="w-5/6 mb-4 border-2 rounded-md"
            v-model="todoForm.title"
            required
        /><br />
        <label for="description">할 일 상세 기록</label><br />
        <textarea
            id="description"
            cols="10"
            rows="5"
            placeholder="100자 이내로 작성"
            class="w-5/6 mb-4 border-2 rounded-md"
            v-model="todoForm.description"
            required
        ></textarea>
        <br />
        <Button buttonTxt="등록하기" />
    </form>
</template>

<script>
import todoAPI from "../api/todoApi";
import Button from "../components/common/Button.vue";
import { reactive } from "vue";
import { useRouter } from "vue-router";

export default {
    name: "Registration",
    components: {
        Button,
    },
    setup() {
        const router = useRouter();
        const todoForm = reactive({ title: "", description: "" });

        const handleRegister = async (event) => {
            event.preventDefault();
            try {
                await todoAPI.addTodo(todoForm);
                await router.push({ name: "home" });
            } catch (error) {
                console.log(error);
            }
        };
        return { handleRegister, todoForm };
    },
};
</script>
