<template>
    <div class="row">
        <div class="col-md-12">
            <!--begin::Portlet-->
            <div id="kt_portlet" class="kt-portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{ ("Canones") }}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body">
                    <liquidation-canon-header :monthly-summary="monthlySummary"/>
                    <canon-content :monthly-summary="monthlySummary"/>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import LiquidationCanonHeader from "../LiquidationCanonHeader";
    import CanonContent from "./CanonContent";
    export default {
        name: "CanonPage",
        components: {CanonContent, LiquidationCanonHeader},
        props: {
            monthlySummary: Object
        }
    }
</script>

<style scoped>

</style>