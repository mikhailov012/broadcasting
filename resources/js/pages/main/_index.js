import Vue from 'vue'
import store from './../../store/index'

import Main from './../../components/MainComponent'

if (document.querySelector('#main')) {
    const eca = new Vue({
        el: '#main',
        store,
        components: { Main },
        template: '<Main/>'
    })
}
