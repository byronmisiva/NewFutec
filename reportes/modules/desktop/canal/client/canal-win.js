QoDesk.CanalWindow = Ext.extend(Ext.app.Module, {
    id: 'canal',
    type: 'desktop/canal',

    init: function () {
        this.launcher = {
            text: 'Canal',
            iconCls: 'canal-icon',
            handler: this.createWindow,
            scope: this
        }
    },

    createWindow: function () {
        var desktop = this.app.getDesktop();
        var win = desktop.getWindow('grid-win-canal');

        var urlCanal = "modules/desktop/canal/server/";
        var pathimagenes = "../../../../../../imagenes/canalslisto/promociones-14-01/";
        var urlver = "imagenes/canalslisto/promociones-14-01/";

        //inicio combo Canal
        this.storeCanal = new Ext.data.JsonStore({
            id: 'storeCanal',
            root: 'data',
            fields: ['id', 'nombre'],
            url: urlCanal + "crudCanal.php?operation=itemsCanal&path=" + pathimagenes + "&urlver=" + urlver
        });
        this.storeCanal.load();
        storeCanal = this.storeCanal;


        var comboCanal = new Ext.form.ComboBox({
            id: 'comboCanal',
            store: this.storeCanal,
            valueField: 'id',
            displayField: 'nombre',
            triggerAction: 'all',
            mode: 'local'
        });

        function canalImagenes(id) {
            var index = this.storeCanal.find('id', id);
            if (index > -1) {
                var record = this.storeCanal.getAt(index);
                return record.get('nombre');
            }
        }
        //fin combo Canal

        var proxyCanal = new Ext.data.HttpProxy({
            api: {
                create: urlCanal + "crudCanal.php?operation=insert",
                read: urlCanal + "crudCanal.php?operation=select",
                update: urlCanal + "crudCanal.php?operation=update",
                destroy: urlCanal + "crudCanal.php?operation=delete"
            }
        });

        var readerCanal = new Ext.data.JsonReader({
            totalProperty: 'total',
            successProperty: 'success',
            messageProperty: 'message',
            idProperty: 'id',
            root: 'data',
            fields: [
                {name: 'nombre', allowBlank: false},
                {name: 'descripcion', allowBlank: false},
                {name: 'icono', allowBlank: false}
            ]
        });
        var writerCanal = new Ext.data.JsonWriter({
            encode: true,
            writeAllFields: true
        });
        this.storeCanal = new Ext.data.Store({
            id: "id",
            proxy: proxyCanal,
            reader: readerCanal,
            writer: writerCanal,
            autoSave: true
        });
        this.storeCanal.load();
        storeCanal = this.storeCanal;

        var textField = new Ext.form.TextField({allowBlank: false});

        function formatDate(value) {
            return value ? value.dateFormat('Y-m-d') : '';
        }

        var formatoFechaMax = new Ext.form.DateField({
            format: 'Y-m-d'
        });

        this.gridCanal = new Ext.grid.EditorGridPanel({
            height: 300,
            store: this.storeCanal, columns: [
                {
                    header: 'Nombre',
                    dataIndex: 'nombre',
                    sortable: true,
                    width: 100,
                    editor: new Ext.form.TextField({allowBlank: false})
                },
                {
                    header: 'Descripción',
                    dataIndex: 'descripcion',
                    sortable: true,
                    width: 300,
                    editor: new Ext.form.TextField({allowBlank: false})
                },
                {
                    header: 'Icono',
                    dataIndex: 'icono',
                    sortable: true,
                    width: 200,
                    editor: new Ext.form.TextField({allowBlank: false})
                }
            ],
            viewConfig: {forceFit: true},
            sm: new Ext.grid.RowSelectionModel({singleSelect: false}),
            border: false,
            stripeRows: true
        });
        var desktop = this.app.getDesktop();
        var win = desktop.getWindow('layout-win');

        if (!win) {
            var winWidth = desktop.getWinWidth() / 1.1;
            var winHeight = desktop.getWinHeight() / 1.1;

            this.formCanalDetalle = new Ext.FormPanel({
                id: 'formCanalDetalle',

                items: [
                    {
                        collapsible: true,
                        id: 'formcabeceracanal',
                        collapsedTitle: true,
                        titleCollapse: true,
                        split: true,
                        flex: 1,
                        autoScroll: true,
                        title: 'Listado Canales',
                        layout: 'column', items: this.gridCanal
                    },
                    {
                        collapsible: true,
                        collapsedTitle: true,
                        titleCollapse: true,
                        split: true,
                        flex: 2,
                        height: 'auto',
                        autoScroll: true,
                        labelAlign: 'left',
                        title: 'Detalle Canal',
                        bodyStyle: 'padding:0; background: #DFE8F6',
                        layout: 'column',
                        tbar: [
                            {
                                text: 'Grabar',
                                scope: this,
                                handler: this.grabarcanal,
                                iconCls: 'save-icon',
                                disabled: true,
                                id: 'tb_grabarcanal'
                            }
                        ],
                        items: [
                            {
                                frame: true,
                                columnWidth: 1,
                                layout: 'form',
                                id: 'formCanal',
                                items: [
                                    {
                                        xtype: 'textfield',
                                        fieldLabel: 'Nombre',
                                        name: 'nombre',
                                        anchor: '95%',
                                        readOnly: false
                                    },
                                    {
                                        xtype: 'textfield',
                                        fieldLabel: 'Descripción',
                                        name: 'descripcion',
                                        anchor: '95%',
                                        readOnly: false
                                    },
                                    {
                                        xtype: 'textfield',
                                        fieldLabel: 'Icono',
                                        name: 'icono',
                                        anchor: '95%',
                                        readOnly: false
                                    },
                                    {xtype: 'textfield', fieldLabel: 'Id', name: 'id', anchor: '95%', readOnly: true}
                                ]
                            }
                        ]

                    }
                ]
            });

            win = desktop.createWindow({
                id: 'grid-win-canal',
                title: 'Canal',
                width: winWidth,
                height: winHeight,
                iconCls: 'canal-icon',
                shim: false,
                animCollapse: false,
                constrainHeader: true,
                layout: 'fit',
                tbar: [
                    {text: 'Nuevo', scope: this, handler: this.addcanal, iconCls: 'save-icon'},
                    '-',
                    {text: "Eliminar", scope: this, handler: this.deletecanal, iconCls: 'delete-icon'},
                    '-',
                    {
                        iconCls: 'demo-grid-add',
                        handler: this.requestGridData,
                        scope: this,
                        text: 'Recargar Datos',
                        tooltip: 'Recargar datos en la grilla'
                    }

                ],
                items: this.formCanalDetalle
            });
        }
        win.show();

        function cargaDetalle(canal, forma) {
            forma.getForm().load({
                url: 'modules/desktop/canal/server/crudCanal.php?operation=selectForm',
                params: {
                    id: canal
                }
            });
        };
        this.gridCanal.on('rowclick', function (grid, rowIndex) {
            this.record = this.gridCanal.getStore().getAt(rowIndex);
            this.idCanalRecuperada = this.record.id;

            /*cargar el formulario*/
            cargaDetalle(this.idCanalRecuperada, this.formCanalDetalle);
            Ext.getCmp('tb_grabarcanal').setDisabled(false);
        }, this);
    }, deletecanal: function () {
        Ext.Msg.show({
            title: 'Confirmación',
            msg: 'Está seguro de querer borrar?',
            scope: this,
            buttons: Ext.Msg.YESNO,
            fn: function (btn) {
                if (btn == 'yes') {
                    var rows = this.gridCanal.getSelectionModel().getSelections();
                    if (rows.length === 0) {
                        return false;
                    }
                    this.storeCanal.remove(rows);
                }
            }
        });
    }, addcanal: function () {
        var canal = new this.storeCanal.recordType({
            nombre: '',
            descripcion: '',
            icono: ''
        });
        this.gridCanal.stopEditing();
        this.storeCanal.insert(0, canal);
        this.gridCanal.startEditing(0, 1);
    }, requestGridData: function () {
        this.storeCanal.load();
    }, grabarcanal: function () {
        Ext.Msg.show({
            title: 'Advertencia',
            msg: 'Desea Guardar los cambios.<br>¿Desea continuar?',
            scope: this,
            icon: Ext.Msg.WARNING,
            buttons: Ext.Msg.YESNO,
            fn: function (btn) {
                if (btn == 'yes') {
                    var myForm = Ext.getCmp('formCanalDetalle').getForm();
                    myForm.submit({
                        url: 'modules/desktop/canal/server/crudCanal.php?operation=updateForm',
                        method: 'POST',
                        fileUpload: true,
                        submitEmptyText: false,
                        // waitMsg : 'Saving data',
                        success: function (form, action) {
                            storeCanal.load();
                        }
                    });
                }
            }
        });
    }

});
