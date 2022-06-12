import BaseHandler from '../../handler';

class MailProvider extends BaseHandler{
    createMail(payload){
        return this.post('/api/mail',payload);
    }

    getAllMail(params=''){
        return this.query('/api/mail?search='+params);
    }

    getMail(params){
        return this.get('/api/mail/'+params);
    }

    resendMail(params){
        // alert(params);
        return this.put('/api/resend-mail/'+params);
    }

    getRecipient(params){
        return this.delete('/api/recipient-mail/'+params);
    }
}
export default MailProvider;
