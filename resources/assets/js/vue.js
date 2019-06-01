const Vue = require('vue');

window.Vue = Vue;

$(function(){
    const $vueApp = $("v-app");

    if($vueApp.length){
        const app = new Vue({
            el: '.v-app'
        });
    }
});