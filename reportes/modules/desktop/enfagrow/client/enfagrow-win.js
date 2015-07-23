QoDesk.EnfagrowWindow = Ext.extend(Ext.app.Module, {
    id: 'enfagrow',
    type: 'desktop/enfagrow',

    init: function () {
        this.launcher = {
            text: 'Enfagrow',
            iconCls: 'enfagrow-icon',
            handler: this.createWindow,
            scope: this
        }
    },

    createWindow: function () {
        var desktop = this.app.getDesktop();
        var win = desktop.getWindow('grid-win-enfagrow');
        var urlEnfagrow = "modules/desktop/enfagrow/server/";
        var winWidth = desktop.getWinWidth() / 1.2;
        var winHeight = desktop.getWinHeight() / 1.2;

        var textField = new Ext.form.TextField({allowBlank: false});

        function formatDate(value) {
            return value ? value.dateFormat('Y-m-d') : '';
        }

        var formatoFechaMax = new Ext.form.DateField({
            format: 'Y-m-d',
            background: '#0000ff'
        });
/*
        //inicio combo sexo
        this.storeOFSE = new Ext.data.JsonStore({
            root: 'users',
            fields: [ 'id', 'nombre' ],
            autoLoad: true,
            data: { users: [
                { "id": 'I', "nombre":"Indistinto"},
                { "id": 'M', "nombre":"Mujer"},
                { "id": 'H', "nombre":"Hombre"}

            ]}
        });

        var comboOFSE = new Ext.form.ComboBox({
            id: 'comboOFSE',
            store: this.storeOFSE,
            valueField: 'id',
            displayField: 'nombre',
            triggerAction: 'all',
            mode: 'local'
        });

        function enfagrowSexo(id) {
            var index = this.storeOFSE.find('id', id);
            if (index > -1) {
                var record = this.storeOFSE.getAt(index);
                return record.get('nombre');
            }
        }

        //fin combo sexo
        //inicio combo activo

        this.storeOFAC = new Ext.data.JsonStore({
            root: 'users',
            fields: [ 'id', 'nombre' ],
            autoLoad: true,
            data: { users: [
                { "id": 1, "nombre":"Si"},
                { "id": 0, "nombre":"No"}

            ]}
        });

        var comboOFAC = new Ext.form.ComboBox({
            id: 'comboOFAC',
            store: this.storeOFAC,
            valueField: 'id',
            displayField: 'nombre',
            triggerAction: 'all',
            mode: 'local'
        });

        function enfagrowActivo(id) {
            var index = this.storeOFAC.find('id', id);
            if (index > -1) {
                var record = this.storeOFAC.getAt(index);
                return record.get('nombre');
            }
        }

        //fin combo activo

        //inicio combo cargo
        this.storeFA = new Ext.data.JsonStore({
            id: 'storeFA',
            root: 'data',
            fields: ['id', 'nombre'],
            url: 'modules/common/combos/combos.php?tipo=cargo'
        });
        this.storeFA.load();

        var comboEJFA = new Ext.form.ComboBox({
            id: 'comboEJFA',
            store: this.storeFA,
            valueField: 'id',
            displayField: 'nombre',
            triggerAction: 'all',
            mode: 'local'
        });

        function enfagrowCargo(id) {
            var index = this.storeFA.find('id', id);
            if (index > -1) {
                var record = this.storeFA.getAt(index);
                return record.get('nombre');
            }
        }

        //fin combo cargo

        //inicio combo campo
        this.storePrFa = new Ext.data.JsonStore({
            root: 'data',
            fields: ['id', 'nombre'],
            url: 'modules/common/combos/combos.php?tipo=campo'
        });
        this.storePrFa.load();

        var comboPrFa = new Ext.form.ComboBox({
            store: this.storePrFa,
            valueField: 'id',
            displayField: 'nombre',
            triggerAction: 'all',
            mode: 'local'
        });

        function enfagrowCampo(id) {
            var index = this.storePrFa.find('id', id);
            if (index > -1) {
                var record = this.storePrFa.getAt(index);
                return record.get('nombre');
            }
        }

        //fin combo campo
*/

        //Enfagrow tab
        var  proxyEnfagrowGana = new Ext.data.HttpProxy({
            api: {
                create: urlEnfagrow + "crudEnfagrow.php?operation=insert",
                read: urlEnfagrow + "crudEnfagrow.php?operation=selectganadores",
                update: urlEnfagrow + "crudEnfagrow.php?operation=update",
                destroy: urlEnfagrow + "crudEnfagrow.php?operation=delete"
            }
        });

        var readerEnfagrowGana = new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            messageProperty: 'message',
            idProperty: 'id',
            root: 'data',
            fields: [

                {name: 'id', allowBlank: false},
                {name: 'nombre', allowBlank: false},
                {name: 'telefono', allowBlank: false},
                {name: 'direccion', allowBlank: false},
                {name: 'nombrepremio', allowBlank: false},
                {name: 'creado', type: 'date', dateFormat: 'c', allowBlank: true},
                {name: 'mail', allowBlank: false},
                {name: 'ciudad', allowBlank: false},
                {name: 'consumidor', allowBlank: false},
                {name: 'consumidor-donde',  allowBlank: true},
                {name: 'donde', allowBlank: false}
            ]
        });
        var writerEnfagrowGana = new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: true
        });
        this.storeEnfagrowGana = new Ext.data.Store({
            id: "id",
            proxy:  proxyEnfagrowGana,
            reader: readerEnfagrowGana,
            writer: writerEnfagrowGana,
            autoSave: true
        });
        this.storeEnfagrowGana.load();
        this.gridEnfagrowGana = new Ext.grid.EditorGridPanel({
            height: winHeight - 94,
            store: this.storeEnfagrowGana, columns: [
                new Ext.grid.RowNumberer()
                , { header:'id', dataIndex:'id', sortable:true, width:50  }
                , { header:'Nombre', dataIndex:'nombre', sortable:true, width:150}
                , { header: 'Teléfono', dataIndex: 'telefono', sortable: true, width: 50  }
                , { header: 'Dirección', dataIndex: 'direccion', sortable: true, width: 150 }
                , { header: 'Premio', dataIndex: 'nombrepremio', sortable: true, width: 70 }
                , { header: 'Creado', dataIndex: 'creado', sortable: true, width: 50, renderer: formatDate }
                , { header:'Email', dataIndex:'mail', sortable:true, width:25, scope:this}
                , { header: 'Ciudad', dataIndex: 'ciudad', sortable: true, width: 30  }
                , { header: 'Consumidor', dataIndex: 'consumidor', sortable: true, width: 80  }
                , { header: 'Consumidor-donde', dataIndex: 'consumidor-donde', sortable: true, width: 80 }
                , { header:'Donde', dataIndex:'donde', sortable:true, width:30, scope:this}

            ],
            viewConfig: {forceFit: true},
            sm: new Ext.grid.RowSelectionModel({singleSelect: false}),
            border: false,
            stripeRows: true
        });
//fin Enfagrow tab

//Enfagrow tab
        var  proxyEnfagrowSorteo = new Ext.data.HttpProxy({
            api: {
                create: urlEnfagrow + "crudEnfagrow.php?operation=insert",
                read: urlEnfagrow + "crudEnfagrow.php?operation=selectSorteo",
                update: urlEnfagrow + "crudEnfagrow.php?operation=update",
                destroy: urlEnfagrow + "crudEnfagrow.php?operation=delete"
            }
        });

        var readerEnfagrowSorteo = new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            messageProperty: 'message',
            idProperty: 'id',
            root: 'data',
            fields: [

                {name: 'id', allowBlank: false},
                {name: 'nombre', allowBlank: false},
                {name: 'telefono', allowBlank: false},
                {name: 'direccion', allowBlank: false},
               // {name: 'nombrepremio', allowBlank: false},
                {name: 'creado', type: 'date', dateFormat: 'c', allowBlank: true},
                {name: 'mail', allowBlank: false},
                {name: 'ciudad', allowBlank: false},
                {name: 'consumidor', allowBlank: false},
                {name: 'consumidor-donde',  allowBlank: true},
                {name: 'donde', allowBlank: false}
            ]
        });
        var writerEnfagrowSorteo = new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: true
        });
        this.storeEnfagrowSorteo = new Ext.data.Store({
            id: "id",
            proxy:  proxyEnfagrowSorteo,
            reader: readerEnfagrowSorteo,
            writer: writerEnfagrowSorteo,
            autoSave: true
        });
        this.storeEnfagrowSorteo.load();
        this.gridEnfagrowSorteo = new Ext.grid.EditorGridPanel({
            height: winHeight - 94,
            store: this.storeEnfagrowSorteo, columns: [
                new Ext.grid.RowNumberer()
                , { header:'id', dataIndex:'id', sortable:true, width:50  }
                , { header:'Nombre', dataIndex:'nombre', sortable:true, width:150}
                , { header: 'Teléfono', dataIndex: 'telefono', sortable: true, width: 50  }
                , { header: 'Dirección', dataIndex: 'direccion', sortable: true, width: 150 }
                //, EnfagrowSorteo{ header: 'Premio', dataIndex: 'nombrepremio', sortable: true, width: 70 }
                , { header: 'Creado', dataIndex: 'creado', sortable: true, width: 50, renderer: formatDate }
                , { header:'Email', dataIndex:'mail', sortable:true, width:25, scope:this}
                , { header: 'Ciudad', dataIndex: 'ciudad', sortable: true, width: 30  }
                , { header: 'Consumidor', dataIndex: 'consumidor', sortable: true, width: 80  }
                , { header: 'Consumidor-donde', dataIndex: 'consumidor-donde', sortable: true, width: 80 }
                , { header:'Donde', dataIndex:'donde', sortable:true, width:30, scope:this}

            ],
            viewConfig: {forceFit: true},
            sm: new Ext.grid.RowSelectionModel({singleSelect: false}),
            border: false,
            stripeRows: true
        });
//fin Enfagrow tab


        //Enfagrow tab
        var  proxyEnfagrowComentarios = new Ext.data.HttpProxy({
            api: {
                create: urlEnfagrow + "crudEnfagrow.php?operation=insert",
                read: urlEnfagrow + "crudEnfagrow.php?operation=selectComentarios",
                update: urlEnfagrow + "crudEnfagrow.php?operation=update",
                destroy: urlEnfagrow + "crudEnfagrow.php?operation=delete"
            }
        });

        var readerEnfagrowComentarios = new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            messageProperty: 'message',
            idProperty: 'id',
            root: 'data',
            fields: [

                {name: 'id', allowBlank: false},
                {name: 'nombre', allowBlank: false},
                {name: 'telefono', allowBlank: false},
                {name: 'creado', type: 'date', dateFormat: 'c', allowBlank: true},
                {name: 'correo', allowBlank: false},
                {name: 'mensaje', allowBlank: false}
            ]
        });
        var writerEnfagrowComentarios = new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: true
        });
        this.storeEnfagrowComentarios = new Ext.data.Store({
            id: "id",
            proxy:  proxyEnfagrowComentarios,
            reader: readerEnfagrowComentarios,
            writer: writerEnfagrowComentarios,
            autoSave: true
        });
        this.storeEnfagrowComentarios.load();
        this.gridEnfagrowComentarios = new Ext.grid.EditorGridPanel({
            height: winHeight - 94,
            store: this.storeEnfagrowComentarios, columns: [
                new Ext.grid.RowNumberer()
                , { header:'id', dataIndex:'id', sortable:true, width:50  }
                , { header:'Nombre', dataIndex:'nombre', sortable:true, width:150}
                , { header: 'Teléfono', dataIndex: 'telefono', sortable: true, width: 50  }
                , { header: 'Creado', dataIndex: 'creado', sortable: true, width: 50, renderer: formatDate }
                , { header:'Email', dataIndex:'correo', sortable:true, width:70, scope:this}
                , { header: 'Mensaje', dataIndex: 'mensaje', sortable: true, width: 300  }
            ],
            viewConfig: {forceFit: true},
            sm: new Ext.grid.RowSelectionModel({singleSelect: false}),
            border: false,
            stripeRows: true
        });
//fin Enfagrow tab


        var desktop = this.app.getDesktop();
        var win = desktop.getWindow('layout-win');

        if (!win) {
            win = desktop.createWindow({
                id: 'grid-win-enfagrow',
                title: 'Trabajos disponibles',
                width: winWidth,
                height: winHeight,
                iconCls: 'enfagrow-icon',
                shim: false,
                animCollapse: false,
                constrainHeader: true,
                layout: 'fit',
                items: new Ext.TabPanel({
                    activeTab: 0,
                    border: false,

                    items: [
                        {
                            autoScroll: true,
                            title: 'Ganadores Doky',
                            iconCls: 'enfagrow-icon',
                            closable: true,
                            tbar: [

                                {
                                    iconCls: 'demo-grid-add',
                                    handler: this.requestGridData,
                                    scope: this,
                                    text: 'Recargar Datos',
                                    tooltip: 'Recargar datos en la grilla'
                                },
                                '-',
                                {
                                    iconCls: 'demo-grid-add',
                                    handler: this.requestGridDataExport,
                                    scope: this,
                                    text: 'Exportar Datos',
                                    tooltip: 'Exportar datos en la grilla'
                                }
                            ],
                            items: this.gridEnfagrowGana
                        },
                        {
                            autoScroll: true,
                            title: 'Registro sorteo 1 año',
                            iconCls: 'enfagrow-icon',
                            closable: true,
                            tbar: [

                                {
                                    iconCls: 'demo-grid-add',
                                    handler: this.requestEnfagrowSorteo,
                                    scope: this,
                                    text: 'Recargar Datos',
                                    tooltip: 'Recargar datos en la grilla'
                                },
                                '-',
                                {
                                    iconCls: 'demo-grid-add',
                                    handler: this.requestEnfagrowSorteoExport,
                                    scope: this,
                                    text: 'Exportar Datos',
                                    tooltip: 'Exportar datos en la grilla'
                                }
                            ],
                            items: this.gridEnfagrowSorteo
                        },
                        {
                            autoScroll: true,
                            title: 'Comentarios',
                            iconCls: 'enfagrow-icon',
                            closable: true,
                            items: this.gridEnfagrowComentarios,
                            tbar: [

                                {
                                    iconCls: 'demo-grid-add',
                                    handler: this.requestGridEnfagrowComentarios,
                                    scope: this,
                                    text: 'Recargar Datos',
                                    tooltip: 'Recargar datos en la grilla'
                                },
                                '-',
                                {
                                    iconCls: 'demo-grid-add',
                                    handler: this.requestGridEnfagrowComentariosExport,
                                    scope: this,
                                    text: 'Exportar Datos',
                                    tooltip: 'Exportar datos en la grilla'
                                }
                            ]
                        }
                    ]
                })

            });
        }
        win.show();
    },

  /*  deleteenfagrow: function () {
        Ext.Msg.show({
            title: 'Confirmación',
            msg: 'Está seguro de querer borrar?',
            scope: this,
            buttons: Ext.Msg.YESNO,
            fn: function (btn) {
                if (btn == 'yes') {
                    var rows = this.gridEnfagrow.getSelectionModel().getSelections();
                    if (rows.length === 0) {
                        return false;
                    }
                    this.storeEnfagrow.remove(rows);
                }
            }
        });
    }, addenfagrow: function () {
        var enfagrow = new this.storeEnfagrow.recordType({
            cargo: '',
            area: '',
            tipo_puesto: '',
            vacantes: '',
            ciudad: '',
            salario: '',
            descripcion: '',
            sexo: '',
            activo: '1',
            creado: ''

        });
        this.gridEnfagrow.stopEditing();
        this.storeEnfagrow.insert(0, enfagrow);
        this.gridEnfagrow.startEditing(0, 1);
    }, deleteenfagrowCampo: function () {
        Ext.Msg.show({
            title: 'Confirmación',
            msg: 'Está seguro de querer borrar?',
            scope: this,
            buttons: Ext.Msg.YESNO,
            fn: function (btn) {
                if (btn == 'yes') {
                    var rows = this.gridEnfagrowCampoAT.getSelectionModel().getSelections();
                    if (rows.length === 0) {
                        return false;
                    }
                    this.storeEnfagrowCampoAT.remove(rows);
                }
            }
        });
    }, addenfagrowCampo: function () {
        var enfagrowcampo = new this.storeEnfagrowCampoAT.recordType({
            nombre: ''
        });
        this.gridEnfagrowCampoAT.stopEditing();
        this.storeEnfagrowCampoAT.insert(0, enfagrowcampo);
        this.gridEnfagrowCampoAT.startEditing(0, 1);
    },

    deleteenfagrowCargo: function () {
        Ext.Msg.show({
            title: 'Confirmación',
            msg: 'Está seguro de querer borrar?',
            scope: this,
            buttons: Ext.Msg.YESNO,
            fn: function (btn) {
                if (btn == 'yes') {
                    var rows = this.gridEnfagrowCargo.getSelectionModel().getSelections();
                    if (rows.length === 0) {
                        return false;
                    }
                    this.storeEnfagrowCargo.remove(rows);
                }
            }
        });
    }, addenfagrowCargo: function () {
        var enfagrowcargo = new this.storeEnfagrowCargo.recordType({
            nombre: ''
        });
        this.gridEnfagrowCargo.stopEditing();
        this.storeEnfagrowCargo.insert(0, enfagrowcargo);
        this.gridEnfagrowCargo.startEditing(0, 1);
    }

    ,
    */
    requestGridData: function () {
        this.storeEnfagrowGana.load();
    },
    requestGridDataExport: function () {
        Ext.Msg.show({
            title:'Advertencia',
            msg:'Descargue el archivo xls  .<br>¿Desea continuar?',
            scope:this,
            icon:Ext.Msg.WARNING,
            buttons:Ext.Msg.YESNO,
            fn:function (btn) {
                if (btn == 'yes') {
                    window.location.href = 'modules/desktop/enfagrow/server/EnfagrowGanadores.php' ;
                }
            }
        });
    },
    requestEnfagrowSorteo: function () {
        this.storeEnfagrowSorteo.load();
    },
    requestEnfagrowSorteoExport: function () {
        Ext.Msg.show({
            title:'Advertencia',
            msg:'Descargue el archivo xls .<br>¿Desea continuar?',
            scope:this,
            icon:Ext.Msg.WARNING,
            buttons:Ext.Msg.YESNO,
            fn:function (btn) {
                if (btn == 'yes') {
                    window.location.href = 'modules/desktop/enfagrow/server/Enfagrow1anio.php' ;
                }
            }
        });
    },
    requestGridEnfagrowComentarios: function () {
        this.storeEnfagrowComentarios.load();
    },
    requestGridEnfagrowComentariosExport: function () {
        Ext.Msg.show({
            title:'Advertencia',
            msg:'Descargue el archivo xls para imprimirlo.<br>¿Desea continuar?',
            scope:this,
            icon:Ext.Msg.WARNING,
            buttons:Ext.Msg.YESNO,
            fn:function (btn) {
                if (btn == 'yes') {
                    window.location.href = 'modules/desktop/enfagrow/server/EnfagrowComentario.php' ;
                }
            }
        });
    }
});

