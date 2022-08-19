<template>
    <div class="row mt-3">
        <ErpStaticTable :columns="columns" :items="items" :options="options"/>
    </div>
</template>

<script>
    import ErpStaticTable from "../../../../components/table/ErpStaticTable";
    export default {
        name: "CanonContent",
        components: {ErpStaticTable},
        props: {
            monthlySummary: Object
        },
        data () {
            return {
                columns: [
                    { field: 'dateFrom', title: 'Fecha desde', sortable: true, formatter: this.formatter },
                    { field: 'dateTo', title: 'Fecha hasta', sortable: true, formatter: this.formatter },
                    { field: 'value', title: 'Valor', sortable: true, formatter: this.formatter},
                ],
                items: this.monthlySummary.concepts.canon,
                options: {
                    pagination: true,
                    locale: 'es-ES',
                    scrollX: true
                },
            }
        },
        methods: {
            formatter(value) {
                if(value === null){return "-"}
                return value;
            },
        }
    }
</script>

<style scoped>

</style>