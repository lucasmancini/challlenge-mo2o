<template>
    <div class="col-lg-3">
        <div class="row mb-3">
            <label class="col-4 col-form-label" :for="id" v-text="label"></label>
            <div class="col-8">
                <input :title="title" :type="type" class="form-control"  :placeholder="placeholder" :name="name" :id="id">
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ErpInputFilter",
        props: {
            label: String,
            id: String,
            name: String,
            type: String,
            placeholder: String,
            title: String
        }
    }
</script>

<style scoped>

</style>