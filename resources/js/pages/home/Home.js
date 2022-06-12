import SearchButtonComponent from "../../components/SearchButtonComponent";
import {GET_ALL_MAIL} from "../../store/actions";
import {mapGetters} from "vuex";

export default {
    components:{
        SearchButtonComponent
    },
    data(){
        return{
            search:'',
            loading:false,
        }
    },
    watch:{

    },
    computed: {
        ...mapGetters(["mails"]),
    },
    methods:{
        filterMail(){

        },
        getMails(){
            this.loading = true;
            this.$store
                .dispatch(GET_ALL_MAIL)
                .then(()=>{
                    this.loading = false;
                })
                .catch((e)=>{
                    this.loading = false;
                    console.log(e);
                });
        }
    },
    mounted() {
        this.getMails();
    }
}
