<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li @click="goToPage(link.current_page-1)" :class="link.current_page === 1 ?'page-item disabled' : 'page-item'">
                <a class="page-link">Previous</a>
            </li>
            <li :class="link.current_page === number ?'page-item active' : 'page-item'" @click="goToPage(number)" v-for="(number,index) in link.last_page" :key="index"><a class="page-link" href="#">{{number}}</a></li>
            <li :class="link.current_page === link.last_page ?'page-item disabled' : 'page-item'" @click="goToPage(link.current_page+1)">
                <a class="page-link" href="#">Next</a>
            </li>
        </ul>
    </nav>
</template>

<script>
    export default {
        name:'pagination',
        props:['link'],
        methods:{
            paginationCalc(){

            },
            goToPage(no){
                this.$emit('paginationChange', no);
            }
        }

    }
</script>
