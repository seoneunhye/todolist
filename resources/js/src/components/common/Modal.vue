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
                id="title"
                placeholder="15자 이내로 작성"
                class="w-5/6 mb-4 border-2 rounded-md"
            /><br />
            <label for="description">할 일 상세 기록</label><br />
            <textarea
                id="description"
                cols="10"
                rows="5"
                placeholder="100자 이내로 작성"
                class="w-5/6 mb-4 border-2 rounded-md"
            ></textarea>
            <br />
            <Button buttonTxt="수정" />
            <Button buttonTxt="취소" @button-click="handleCancel" />
        </form>
    </div>
</template>

<script>
import Button from "./Button.vue";

export default {
    name: "Modal",
    components: { Button },
    setup(props, { emit }) {
        const handleCancel = () => {
            emit("show-modal", false);
        };

        return { handleCancel };
    },
};
</script>
