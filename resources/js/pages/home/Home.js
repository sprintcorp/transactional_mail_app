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
            this.attachments = event.target.files
            // console.log(this.attachments);
            const formData = new FormData();
            for (const i of Object.keys(this.attachments)) {
                formData.append('attachments', this.attachments[i])
            }
            console.log(formData);
        },
        sendMail(){
            const formData = new FormData();
            for (const i of Object.keys(this.attachments)) {
                formData.append('attachments', this.attachments[i])
            }
            formData.append('sender',this.sender);
            formData.append('recipient',this.recipient);
            formData.append('html_content',this.html_content);
            formData.append('text_content',this.message);
            formData.append('subject',this.subject);
            this.$store.dispatch(CREATE_MAIL, formData).then(
                () => {
                    alert(" Mail Created");
                    this.getMails();
                },
                () => {
                    alert(" Mail Created");
                }
            );
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
