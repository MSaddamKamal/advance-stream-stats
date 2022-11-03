import {createStore} from "vuex";

const store = createStore({
    state:{
        isLoggedIn:localStorage.getItem('user')?true:false,
        loader:false,
    },
    getters:{

    },
    mutations:{
        mutateLoggedIn(state,payload){
            this.state.isLoggedIn = payload
        },
        mutateLoader(state,payload){
            this.state.loader = payload
        }
    },
    actions:{
        setLoggedIn(context,paylaod){
            context.commit('mutateLoggedIn',paylaod)
        },
        setLoader(context,paylaod){
            context.commit('mutateLoader',paylaod)
        },
    }
})

export default store