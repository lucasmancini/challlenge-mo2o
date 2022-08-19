<template>
    <fragment>
        <liquidation-page :monthly-summary="monthlySummary" />
        <canon-page :monthly-summary="monthlySummary" />
    </fragment>
</template>

<script>
    import LiquidationPage from "./liquidation/LiquidationPage";
    import CanonPage from "./canon/CanonPage";
    export default {
        name: "MonthlySummaryContent",
        components: {CanonPage, LiquidationPage},
        props: {
            monthlySummary: Object
        },
    }
</script>

<style scoped>

</style>