<template>
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-end">
            <li class="page-item" @click="goToPage(link.current_page-1)" :class="disabled ? link.current_page === 1 : ''">
                <a class="page-link">Previous</a>
            </li>
            <li class="page-item" @click="goToPage(index+1)" v-for="(number,index) in link.last_page" key="index"><a class="page-link" href="#">{{index+1}}</a></li>
            <li class="page-item" @click="goToPage(link.current_page+1)">
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
