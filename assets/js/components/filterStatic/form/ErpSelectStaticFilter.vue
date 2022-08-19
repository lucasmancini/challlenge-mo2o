<template>
    <div  :class="classNumber ? `col-md-${classNumber}` : 'col-md-3'">
        <label class="control-label" :for="id" v-text="label"></label>
        <select @change="changeValue" class="form-control" :name="name" :id="id">
            <slot></slot>
        </select>
    </div>
</template>

<script>
    export default {
        name: "ErpSelectStaticFilter",
        props: {
            classNumber: String,
            id: String,
            name: String,
            label: String
        },
        methods:{
            changeValue(e){
                this.$emit('changeValue', e);
            }
        }
    }
</script>

<style scoped>

</style>