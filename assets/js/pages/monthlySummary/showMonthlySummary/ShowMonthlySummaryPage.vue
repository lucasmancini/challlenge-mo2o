<template>
    <fragment>
        <monthly-summary-header :monthly-summary="monthlySummary"/>
        <monthly-summary-content :monthly-summary="monthlySummary"/>
    </fragment>
</template>

<script>
    import MonthlySummaryHeader from "./MonthlySummaryHeader";
    import MonthlySummaryContent from "./MonthlySummaryContent";
    export default {
        name: "ShowMonthlySummaryPage",
        components: {MonthlySummaryContent, MonthlySummaryHeader},
        props: {
            monthlySummary: Object
        },
        mounted(){
            //console.log(this.monthlySummary.year)
        }
    }
</script>

<style scoped>

</style>