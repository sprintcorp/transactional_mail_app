<template>
    <div>
        <Header/>
            <div class="container">
            <router-view>

            </router-view>
            </div>
<!--        <Footer/>-->
    </div>
</template>

<script>
import Footer from './Footer';
import Header from './Header';

export default {
    name: 'layout',
    components: {
        Footer,
        Header,
    },
};
</script>

<style scoped>
    .container{
        height: auto !important;
    }
</style>

