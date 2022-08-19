<template>
    <div class="row mt-3">
        <ErpStaticTable :columns="columns" :items="items" :options="options"/>
    </div>
</template>

<script>
    import ErpStaticTable from "../../../../components/table/ErpStaticTable";
    export default {
        name: "LiquidationContent",
        components: {ErpStaticTable},
        props: {
            monthlySummary: Object
        },
        data () {
            return {
                columns: [
                    { field: 'day', title: 'Día', sortable: true, formatter: this.formatter },
                    { field: 'nArticles', title: 'Nº Artículos', sortable: true, formatter: this.formatter },
                    { field: 'nSales', title: 'Nº Ventas', sortable: true, formatter: this.formatter},
                    { field: 'grossAmount', title: 'Valor Bruto', sortable: true, formatter: this.formatter },
                    { field: 'taxAmount', title: 'Valor Neto', sortable: true, formatter: this.formatter },
                    { field: 'netAmount', title: 'Valor Impuesto', sortable: true, formatter: this.formatter },
                ],
                items: this.monthlySummary.concepts.liquidation,
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