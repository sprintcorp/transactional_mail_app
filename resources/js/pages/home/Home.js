import SearchButtonComponent from "../../components/SearchButtonComponent";
import LoaderComponent from "../../components/LoaderComponent";
import PaginationComponent from "../../components/PaginationComponent";
import {CREATE_MAIL, GET_ALL_MAIL} from "../../store/actions";
import {mapGetters} from "vuex";

export default {
    components:{
        SearchButtonComponent,LoaderComponent,PaginationComponent
    },
    data(){
        return{
            search:'',
            loading:false,
            page:1,
            data:[],
            sender:'',
            recipient:'',
            subject:'',
            message:'',
            html_content:'',
            attachments:[],
            error:false,
            errors:[],
        }
    },
    watch:{

    },
    computed: {
        ...mapGetters(["mails"]),
    },
    methods:{
        getMails(){
            this.loading = true;
            const payload = {
                'search_text':this.search,
                'page':this.page
            }
            this.$store
                .dispatch(GET_ALL_MAIL,payload)
                .then(()=>{

                })
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
        viewRecipient(mail) {
            this.$router.push({
                name: "RecipientEmailPage",
                params: {mail: mail}
            })
        },
        onChange(event){
            this.attachments = event.target.files;
        },
        sendMail(){
            this.errors = [];
            this.error = false;
            const formData = new FormData();
            for (const i of Object.keys(this.attachments)) {
                formData.append('attachments[]', this.attachments[i])
            }
            formData.append('sender',this.sender);
            formData.append('recipient',this.recipient);
            formData.append('html_content',this.html_content);
            formData.append('text_content',this.message);
            formData.append('subject',this.subject);
            this.$store.dispatch(CREATE_MAIL, formData).then(
                (res) => {
                    this.$swal(res.message);
                    this.getMails();
                }
            ).catch((e)=>{
                this.error = true;
                if (e.response && e.response.status === 422) {
                    const errors = Object.values(e.response.data.error);
                    this.errors = errors.flatMap(val=>val);
                }
            });
        },
        paginationChange(no){
            this.page = no;
            this.getMails();
        }
    },
    mounted() {
        this.getMails();
    }
}
