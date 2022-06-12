import {MailService} from "../../services";
import {CREATE_MAIL, RESEND_MAIL, GET_MAIL, GET_RECIPIENT_MAIL, GET_ALL_MAIL} from "../actions";
import {SET_MAIL, SET_ALL_MAIL} from "../mutations";

const initialState = {
    mails:[],
    mail:[],
}

export const state = {...initialState};

const actions = {
    async[CREATE_MAIL](context,payload){
        const {data} = await MailService.createMail(payload);
        return data;
    },

    async[RESEND_MAIL](context,params){
        const {data} = await MailService.resendMail(params);
        await context.dispatch(GET_RECIPIENT_MAIL, params);
        return data;
    },

    async[GET_RECIPIENT_MAIL](context,payload){
        const {data} = await MailService.getRecipient(payload);
        context.commit(SET_MAIL,data);
        return data;
    },

    async[GET_MAIL](context,payload){
        const {data} = await MailService.getMail(payload);
        context.commit(SET_MAIL,data);
        return data;
    },

    async[GET_ALL_MAIL](context,params=''){
        const {data} = await MailService.getAllMail(params);
        context.commit(SET_ALL_MAIL,data);
        return data;
    },

}

const mutations = {
    [SET_ALL_MAIL](state,mails){
        state.mails = mails;
    },
    [SET_MAIL](state,mail){
        state.mail = mail;
    },
}

const getters ={
    mails(state){
        return state.mails;
    },
    mail(state){
        return state.mail;
    }
}

export default {
    state,
    actions,
    mutations,
    getters
};
