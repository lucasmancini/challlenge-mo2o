<template>
    <fragment>
    <list-month-summary-filter/>
    <div class="kt-portlet kt-portlet--bordered">
        <div class="kt-portlet__body">
            <div class="kt-datatable kt-datatable--default kt-datatable--brand kt-datatable--loaded">
                <erp-ajax-table :url="routing.generate('monthlySummary.filter')" :columns="columns" :options="options"  />
            </div>
        </div>
    </div>
    </fragment>
</template>

<script>
    import ListMonthSummaryFilter from "./ListMonthlySummaryFilter";
    import ErpAjaxTable from "../../../components/table/ErpAjaxTable";
    export default {
        name: "ListMonthlySummaryPage",
        components: {ListMonthSummaryFilter, ErpAjaxTable},
        data () {
            return {
                columns: [
                    { field: 'delegation', title: 'delegation', sortable: true, formatter: this.getNameFormatter },
                    { field: 'year', title: 'Año', sortable: true, formatter: this.formatter },
                    { field: 'month', title: 'Mes', sortable: true, formatter: this.getNameFormatter},
                    { field: 'validateDate', title: 'Fecha de validación', sortable: true, formatter: this.dateFormatter },
                    { field: 'validateUser', title: 'Persona validación', sortable: true, formatter: this.formatter },
                    { field: 'sendedDate', title: 'Fecha de envío', sortable: true, formatter: this.dateFormatter },
                    { field: 'sendedUser', title: 'Persona envío', sortable: true, formatter: this.formatter },
                    {
                        title: 'Ver resumen',
                        formatter: this.actionsFormatter,
                        events: {
                            'click .eye': (e, value, row) =>  this.clickEyeRow(row),
                        },
                        width: 160
                    }
                ],
                options: {
                    pagination: true,
                    locale: 'es-ES',
                    scrollX: true
                },
                row: {},
                monthlySummary: []
            }
        },
        methods: {
            dateFormatter(value) {
                if(value === null){return "-"}
                return moment(value, "DD/MM/YYYY").format("DD/MM/YYYY");
            },
            getNameFormatter(value){
                return value.name;
            },
            formatter(value) {
                if(value === null){return "-"}
                return value;
            },
            actionsFormatter(value, row) {
                const actions = [
                    '<a href="javascript:void(0)" class="btn btn-sm btn-clean btn-icon btn-icon-md eye" title="Ver resumen"><i class="flaticon-eye"></i></a>',
                ]
                return actions.join('');
            },
            clickEyeRow(row) {
                location.href = this.routing.generate('monthlySummary.show', { delegation: row.delegation.id, year: row.year, month: row.month.id });
            },

        }
    }
</script>

<style scoped>

</style>