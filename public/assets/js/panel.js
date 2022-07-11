panel = {
    _axios : {},
    vueInfoPopup:null,
    _modalInfoPopup: null,
    _createInfoPopup: function(){
        this.vueInfoPopup = createApp({
            data() {
                return {
                    title: '',
                    message: ''
                }
            },
            mounted: function() {
                options = {};
                panel._modalInfoPopup = new bootstrap.Modal(document.getElementById('info-popup'), options);
            },
            methods : {
                call: function(pt, pm){
                    panel.vueInfoPopup.title = pt;
                    panel.vueInfoPopup.message = pm;
                    panel._modalInfoPopup.show();
                },
            }
        }).mount('#info-popup')
    },
    toast: null,
    _createTosats: function(){
        var toastElList = [].slice.call(document.querySelectorAll('.toast'))
        toastList = {};
        for (var i = 0; i < toastElList.length; i++) {
            toastList[toastElList[i].id] =  new bootstrap.Toast(toastElList[i], {});
        }
        this.toast= {
            items : toastList,
            call: function(type, title, description){
                var el = document.getElementById( type)
                el.querySelectorAll('.toast-title')[0].innerHTML = title;
                el.querySelectorAll('.toast-body')[0].innerHTML = description;
                panel.toast.items[type].show();
            }
        };
    },
    vueTable: {},
    _htmlTable: null,
    _createDataTable: function(selector, fields){
        var tables = [].slice.call(document.querySelectorAll(selector))
        for (var i = 0; i < tables.length; i++) {
            var id = tables[i].getAttribute('id');
            if(id){
                var source = tables[i].getAttribute('source');
                var vueTable = createApp({
                    data() {
                        return {
                            tableId: id,
                            source: source,
                            page: 0,
                            rows: {},
                            pages: {},
                        }
                    },
                    methods:{
                        loadPage : function(p){
                            this.page = p;
                            panel._axios[this.tableId] = axios.create({
                                baseURL: panel.vueTable[this.tableId].source,
                                timeout: 3000,
                                params: {page: p,targetTable : this.tableId},
                                tableId:this.tableId
                            })
                            panel._axios[this.tableId]
                                .get()
                                .then(function (response) {
                                    if(response.data.status=='success'){
                                        panel.vueTable[response.config.params.targetTable].rows = response.data.data.rows;
                                        panel.vueTable[response.config.params.targetTable].pages = response.data.data.pages;
                                        panel.vueTable[response.config.params.targetTable].page = response.data.data.page;
                                        if(response.data.title!=''){
                                            panel.vueInfoPopup.call(response.data.title,response.data.message)
                                        }
                                    } else {
                                        panel.vueInfoPopup.call(response.data.title,response.data.message)
                                    }
                                })
                                .catch(function (error) {
                                    panel.vueInfoPopup.call('sonuc',error.message)
                                });
                        },
                        page_number: function(i){
                            if(i==null){
                                return '...';
                            }
                            return (i * 1)+1;
                        }
                    },
                    mounted: function() {
                        console.log( id+ " Mounted")
                        document.getElementById(id).style.opacity = "1";
                    },
                }).mount('#'+id)
                this.vueTable[id] = vueTable;
            } else {
                console.error('Required element id for datatable')
            }
        }
    },
    _createForm: function(selector, get, post, fields){
        var panelForm = createApp({
            data(){
                return fields
            },
            methods : {
                onSubmit: function() {
                    panel.vueInfoPopup.call('İşlem Yapılıyor', 'Lütfen Bekleyiniz')
                    axios.post( post, this.$data)
                        .then(function (response) {
                            panel.vueInfoPopup.call(response.data.title, response.data.message)
                            console.log(response.data.fields)
                            for (var key in response.data.fields){
                                if(panelForm['fields'].hasOwnProperty(key) ){
                                    panelForm['fields'][key] = response.data.fields[key]
                                }
                            }
                        })
                        .catch(function (error) {
                            panel.vueInfoPopup.call('sonuc',error.message)
                        });
                }
            }
        }).mount(selector);
    },
    editForm: function(selector, get, post){
        axios.get( get )
            .then(function(response){
                if(response.data.status=='success'){
                    panel._createForm(selector, get, post, response.data)
                } else{
                    panel.vueInfoPopup.call(response.data.title,response.data.message)
                    panel._createForm(selector, get, post, {})
                }
            })
            .catch(function (error) {
                panel.vueInfoPopup.call('sonuc',error.message)
            });
    }
}



