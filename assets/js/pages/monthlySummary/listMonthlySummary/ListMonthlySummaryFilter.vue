<template>
    <erp-filter>
        <erp-multiple-select-filter label="Delegación"  name="delegation" id="delegationId" :data-for-ajax="delegations" />
        <erp-select-filter id="year" name="year" label="Año">
            <option v-for="item in years"  :value="item" v-text="item"></option>
        </erp-select-filter>
        <erp-select-filter id="month" name="month" label="Mes">
            <option v-for="item in months"  :value="item.id" v-text="item.name"></option>
        </erp-select-filter>
        <div class="col-md-3"></div>
        <erp-checkbox-filter label="validado" name="validate" id="validate" />
        <erp-input-filter label="Persona que validó"  name="pvalidate" id="pvalidate" aria-valuetext=""/>
        <erp-checkbox-filter label="enviado" name="sended" id="sended" />
        <erp-input-filter label="Persona que envió"  name="psended" id="psended" aria-valuetext=""/>
    </erp-filter>
</template>

<script>
    import ErpFilter from "../../../components/filter/ErpFilter";
    import Axios from "axios";
    import ErpMultipleSelectFilter from "../../../components/filter/form/ErpMultipleSelectFilter";
    import ErpInputFilter from "../../../components/filter/form/ErpInputFilter";
    import ErpInputStaticFilter from "../../../components/filterStatic/form/ErpInputStaticFilter";
    import ErpCheckboxFilter from "../../../components/filter/form/ErpCheckboxFilter";
    import ErpSelectFilter from "../../../components/filter/form/ErpSelectFilter";
    export default {
        name: "ListMonthSummaryFilter",
        components: {
            ErpSelectFilter,
            ErpCheckboxFilter,
            ErpInputStaticFilter, ErpInputFilter, ErpMultipleSelectFilter,ErpFilter},
        data() {
            return {
                delegations: [],
                years: [],
                months: [],
            }
        },
        async mounted() {
            try {
                let resp = await Axios.get(this.routing.generate('listMonthlySummarySelector'));
                this.delegations = resp.data.delegations;
                this.years = resp.data.years;
                this.months = resp.data.months;
            } catch (e) {
                console.log(e);
            }
        }
    }
</script>

<style scoped>

</style>