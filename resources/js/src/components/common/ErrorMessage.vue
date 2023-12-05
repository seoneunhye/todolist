<template>
    <small class="block mb-2 text-red-600">{{ errorMessage }}</small>
</template>

<script>
export default {
    props: {
        errorMessage: String,
    },
};
</script>
