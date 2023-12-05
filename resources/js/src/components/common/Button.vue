<template>
    <button
        type="{{buttonType}}"
        @click="$emit('click-button', $event)"
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
    setup(props, { emit }) {},
};
</script>

<style></style>
