import {GET_MAIL, RESEND_MAIL} from "../../store/actions";
import {mapGetters} from "vuex";

export default {
    data(){
        return{
            loading:false,
        }
    },
    computed: {
        ...mapGetters(["mail"]),
    },
    methods:{
        getMail(mail_id){
            this.loading = true;

            this.$store
                .dispatch(GET_MAIL,mail_id)
                .then()
                .catch((e)=>{
                    console.log(e);
                });
            this.loading = false;
        },
        resendMail(id){
            this.loading = true;
            this.$store.dispatch(RESEND_MAIL,id)
                .then((res)=>{
                    this.$swal(res.message);
                    this.getMail(id);
            }).catch((e)=>{

            });
            this.loading = false;
        }
    },
    mounted() {
        this.getMail(this.$route.params.id);
    }
}
