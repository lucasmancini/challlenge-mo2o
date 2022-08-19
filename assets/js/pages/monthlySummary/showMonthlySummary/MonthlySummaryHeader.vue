<template>
    <div class="row">

        <div class="col-md-12">
            <!--begin::Portlet-->
            <div id="kt_portlet" class="kt-portlet">
                <div class="kt-portlet__head kt-portlet__head--lg">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{ ("Sumario mensual") }}
                        </h3>
                    </div>
                </div>

                <div class="kt-portlet__body">
                    <div class="row mt-3">
                        <div class="form-group col-lg-3">
                            <label>{{ ("Persona que validó") }}:</label>
                            <p class="form-control-static" v-text="validateUser"></p>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>{{ ("Fecha de validación") }}:</label>
                            <p class="form-control-static" v-text="validateDate"></p>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>{{ ("Persona que envió") }}:</label>
                            <p class="form-control-static" v-text="sendedUser"></p>
                        </div>
                        <div class="form-group col-lg-3">
                            <label>{{ ("Fecha de envío") }}:</label>
                            <p class="form-control-static" v-text="sendedDate"></p>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-lg-3">
                            <button v-show="validate" id="btnValidar" v-if="monthlySummary.validateUser == '-'" type="button" class="btn btn-outline-secondary" v-on:click="validar()">Validar</button>
                            <button v-show="sended" id="btnEnvio" v-if="monthlySummary.sendedUser == '-'" type="button" class="btn btn-outline-secondary" v-on:click="enviar()">Marcar como enviado</button>
                            <button id="btnExportarXml" type="button" class="btn btn-outline-secondary" v-on:click="exportXml()">Exportar a XML</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <notifications position=""></notifications>
                            <img v-show="loading" src="img/loading.gif" alt="Cargando..." />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Axios from "axios";
    export default {
        name: "MonthlySummaryHeader",
        props: {
            monthlySummary: Object,
        },
        data(){
            return {
                validateUser: this.monthlySummary.validateUser,
                validateDate: this.monthlySummary.validateDate,
                sendedUser: this.monthlySummary.sendedUser,
                sendedDate: this.monthlySummary.sendedDate,
                validate:true,
                sended: true,
                loading: false,
                exportToXml: true,
                id: 0,
                animation: {
                    enter: {
                        opacity: [1, 0],
                        translateX: [0, -300],
                        scale: [1, 0.2]
                    },
                    leave: {
                        opacity: 0,
                        height: 0
                    }
                }
            }
        },
        mounted(){
          if(this.monthlySummary.validateUser == '-'){
                this.sended = false;
            }
        },
        methods: {
            validar() {
                let urlValidate = this.routing.generate('monthlySummary.validate.send', { action:'validate', delegation: this.monthlySummary.delegation.id, year: this.monthlySummary.year, month: this.monthlySummary.month.id })
                this.validate = false;
                this.loading = true;
                Axios.get(urlValidate).then(resp => {
                    if(resp.data.result.code == "200"){
                        this.loading = false;
                        this.validateUser = resp.data.user;
                        this.validateDate = resp.data.date;
                        this.sended = true;
                        this.exportToXml = true;
                        this.show('success','Validación hecha correctamente');
                    }else{
                        this.loading = false;
                        this.validate = true;
                        this.show('error','Ha habido un error al validar: '+resp.data.result.message);
                    }


                });
            },
            enviar() {
                let urlValidate = this.routing.generate('monthlySummary.validate.send', { action:'send', delegation: this.monthlySummary.delegation.id, year: this.monthlySummary.year, month: this.monthlySummary.month.id })
                this.sended = false;
                this.loading = true;
                Axios.get(urlValidate).then(resp => {
                    if(resp.data.result.code == "200"){
                        this.loading = false;
                        this.sendedUser = resp.data.user;
                        this.sendedDate = resp.data.date;
                        this.show('success','Marcado como enviado correctamente');
                    }else{
                        this.loading = false;
                        this.sended = true;
                        this.show('error','Ha habido un error al marcar como enviado: '+resp.data.result.message);
                    }


                });
            },
            exportXml(){
                let params = {
                    monthlySummary:this.monthlySummary
                };
                let urlExportXml = this.routing.generate('monthlySummary.exportToXml');
                Axios.post(urlExportXml, params).then(resp => {

                    let blob = new Blob([resp.data], { type: 'text/xml' });
                    let link = document.createElement('a');
                    link.href = window.URL.createObjectURL(blob);
                    link.download = 'resumen_mensual'+this.monthlySummary.month.name+this.monthlySummary.year+'.xml';
                    link.click();

                });
            },
            show (type = '', text = '') {
                this.$notify({
                    text,
                    type
                });
            }
        }
    }
</script>

<style scoped>

</style>