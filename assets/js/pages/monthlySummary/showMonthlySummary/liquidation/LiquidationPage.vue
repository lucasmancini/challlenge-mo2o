<template>
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div id="kt_portlet" class="kt-portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{ ("Liquidaciones") }}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <liquidation-canon-header :monthly-summary="monthlySummary"/>
                    <liquidation-content :monthly-summary="monthlySummary"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LiquidationCanonHeader from "../LiquidationCanonHeader";
    import LiquidationContent from "./LiquidationContent";

    export default {
        name: "LiquidationPage",
        components: {LiquidationContent, LiquidationCanonHeader},
        props: {
            monthlySummary: Object
        }
    }
</script>

<style scoped>

</style>