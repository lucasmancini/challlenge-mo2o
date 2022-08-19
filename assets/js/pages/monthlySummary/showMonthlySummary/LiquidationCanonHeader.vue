<template>
                <div class="row mt-3">
                    <div class="form-group col-lg-2">
                        <label>{{ ("Fecha") }}:</label>
                        <p class="form-control-static">{{ monthlySummary.month.name }} {{ monthlySummary.year }}</p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>{{ ("Id Aeropuerto") }}:</label>
                        <p class="form-control-static">{{ monthlySummary.delegation.iataCode }}</p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>{{ ("Id contrato") }}:</label>
                        <p class="form-control-static">{{ monthlySummary.delegation.aenaRentalAgreementId }}</p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>{{ ("Concepto Canon") }}:</label>
                        <p class="form-control-static">{{ monthlySummary.concepts.canonConcept }}</p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>{{ ("Subconcepto Canon") }}:</label>
                        <p class="form-control-static">{{ monthlySummary.concepts.subCanonConcept }}</p>
                    </div>
                    <div class="form-group col-lg-2">
                        <label>{{ ("id local") }}:</label>
                        <p class="form-control-static">{{ monthlySummary.delegation.aenaLocalId }}</p>
                    </div>
                </div>
</template>

<script>
    export default {
        name: "LiquidationCanonHeader",
        props: {
            monthlySummary: Object
        }
    }
</script>

<style scoped>

</style>