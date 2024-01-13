<template>
    <div class="alert alert-custom alert-light-danger fade show mb-0 py-3 px-5" role="alert">
        <div class="alert-text text-danger">
            Error: The given data was invalid!
            <ul class="mb-0">
                <li v-for="(error, e) in errors" :key="e">{{ error[0] }}</li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: ['errors'],
}
</script>   