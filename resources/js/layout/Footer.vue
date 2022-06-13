<template>
    <footer class="footer">
        <div class="ml-auto">
            <span class="">
            copyright@{{ currentYear }}
            </span>
        </div>
    </footer>
</template>

<script>
export default {
    name:'footerComponent',
    data() {
        return {
            currentYear: new Date().getFullYear(),
        };
    },
};
</script>

<style>
    .footer{
        clear: both;
        /*position: absolute;*/
        bottom: 0;
    }
</style>
