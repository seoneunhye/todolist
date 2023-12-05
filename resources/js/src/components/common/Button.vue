<template>
    <button
        type="{{buttonType}}"
        @click="handleClick"
        class="p-1 mt-2 mr-2 border-2 rounded-lg"
    >
        {{ buttonTxt }}
    </button>
</template>

<script>
export default {
    name: "Button",
    props: {
        buttonTxt: String,
        buttonType: {
            type: String,
            default: "button",
        },
    },
    setup(props, { emit }) {
        const handleClick = () => {
            emit("button-click");
        };
        return { handleClick };
    },
};
</script>

<style></style>
