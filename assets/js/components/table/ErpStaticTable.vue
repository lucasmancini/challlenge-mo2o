<template>
    <bootstrap-table :columns="columns" :data="items" :options="options"/>
</template>

<script>
    export default {
        name: "ErpStaticTable",
        props: {
            columns: Array,
            items: Array,
            options: Object
        }
    }
</script>

<style scoped>

</style>