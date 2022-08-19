<template>
    <div :class="classNumber ? `col-md-${classNumber}` : 'col-md-1'">
        <div class="kt-checkbox-inline">
            <label class="kt-checkbox control-label" :for="id">
                <input class="form-control" type="checkbox" :name="name" :id="id"> {{ label }}
                <span></span>
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ErpCheckboxFilter",
        props: {
            classNumber: String,
            id: String,
            name: String,
            label: String
        }
    }
</script>

<style scoped>

</style>