import Vue from "vue";
import Vuex from 'vuex';
import { filter } from './modules/filter';


Vue.use(Vuex);

export const store = new Vuex.Store({
    modules: {
        filter
    }
});


