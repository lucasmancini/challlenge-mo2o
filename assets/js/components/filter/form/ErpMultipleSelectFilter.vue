<template>
    <div :class="fillIn ? 'col-lg-12' : 'col-lg-3'">
        <div class="row mb-3">
            <label class="col-4 col-form-label" :for="id" v-text="label"></label>
            <div :class="fillIn ? 'col-12' : 'col-8'">
                <select :type="type" class="form-control kt-selectpicker" :name="name" :id="id" multiple data-size="5" data-live-search="true">
                    <slot></slot>
                </select>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ErpMultipleSelectFilter",
        props: {
            id: String,
            type: String,
            name: String,
            label: String,
            value: Array,
            dataForAjax: Array,
            fillIn: {
                type: Boolean,
                default: false
            }
        },
        data() {
            return {
                el: null
            }
        },
        mounted() {
            this.el = $(`#${this.id}`);
            this.el.selectpicker({
                noneSelectedText : this.label,
                actionsBox: true
            });
        },
        watch: {
            value() {
                this.el.val(this.value);
                this.el.selectpicker("refresh");
            },
            dataForAjax() {
                this.dataForAjax.forEach((item, key) => {
                    let obj = {};
                    if(typeof item === 'object') {
                        obj = {
                            value: item.id,
                            text: item.name
                        };
                    } else {
                        obj = {
                            value: key,
                            text: item
                        }
                    }
                    this.el.append($("<option>", obj));
                    this.el.selectpicker("refresh");
                });
            }
        }
    }
</script>
<style scoped>

</style>