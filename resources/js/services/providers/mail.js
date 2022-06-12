import BaseHandler from '../../handler';

class MailProvider extends BaseHandler{
    createMail(payload){
        return this.post('/api/employee',payload);
    }

    getAllMail(params=''){
        return this.query('/api/employee?search='+params);
    }

    getMail(params){
        return this.get('/api/employee/'+params);
    }

    resendMail(params){
        // alert(params);
        return this.put('/api/employee/'+params);
    }

    getRecipient(params){
        return this.delete('/api/employee/'+params);
    }
}
export default MailProvider;
