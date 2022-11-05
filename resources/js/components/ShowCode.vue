<template>
    <div class="p-4">
        <code v-for="code in props.data">
            <div class="p-2" :class="active(code)">
                <span class="inline-block min-w-[40px]">{{ code.line_number }}</span>
                <span v-html="code.line" />
            </div>
        </code>
    </div>
</template>

<script setup>

const props = defineProps({
    data: {
        type: Array,
        default: ''
    },

    line: {
        type: Number,
        default: null
    }
})

const active = (code) => {
    return code.line_number === props.line ? 'bg-red-200' : 'bg-slate-200';
}

</script>

<style scoped>

</style>
