import { GET_RECIPIENT_MAIL} from "../../store/actions";
import {mapGetters} from "vuex";
import LoaderComponent from "../../components/LoaderComponent";

export default {
    data(){
        return{
            loading:false
        }
    },
    components:{
        LoaderComponent
    },
    computed: {
        ...mapGetters(["mail"]),
    },
    methods:{
        getRecipientMail(mail){
            this.loading = true;

            this.$store
                .dispatch(GET_RECIPIENT_MAIL,mail)
                .then()
                .catch((e)=>{
                    console.log(e);
                });
            this.loading = false;
        },
        viewEmail(id) {
            this.$router.push({
                name: "ViewEmailPage",
                params: {id: id}
            })
        },
    },
    mounted() {
        this.getRecipientMail(this.$route.params.mail)
    }
}
