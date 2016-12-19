/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='http://www.futbolecuador.com/unionlayer/samsung/images/',
        aud='http://www.futbolecuador.com/unionlayer/samsung/media/',
        vid='http://www.futbolecuador.com/unionlayer/samsung/media/',
        js='http://www.futbolecuador.com/unionlayer/samsung/js/',
        fonts = {
        },
        opts = {
            'gAudioPreloadPreference': 'auto',
            'gVideoPreloadPreference': 'auto'
        },
        resources = [
        ],
        scripts = [
        ],
        symbols = {
            "stage": {
                version: "6.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "6.0.0.400",
                scaleToFit: "none",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            id: 'cerrar',
                            symbolName: 'cerrar',
                            type: 'rect',
                            rect: ['1074px', '10px', '32', '32', 'auto', 'auto'],
                            cursor: 'pointer',
                            opacity: '0'
                        },
                        {
                            id: 'start',
                            type: 'rect',
                            rect: ['277px', '488px', '88px', '90px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"]
                        },
                        {
                            id: 'fondo',
                            type: 'image',
                            rect: ['0', '0', '160px', '600px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"fondo.jpg",'0px','0px']
                        },
                        {
                            id: 'fondo2',
                            type: 'image',
                            rect: ['652px', '0', '413px', '600px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"fondo.jpg",'0px','0px']
                        },
                        {
                            id: 'fondo_union',
                            type: 'image',
                            rect: ['185px', '0', '960px', '600px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"fondo_union.jpg",'0px','0px']
                        },
                        {
                            id: 'logo',
                            type: 'image',
                            rect: ['0', '34px', '160px', '54px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"logo.png",'0px','0px']
                        },
                        {
                            id: 'txt',
                            type: 'image',
                            rect: ['0', '117px', '160px', '45px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"txt.png",'0px','0px']
                        },
                        {
                            id: 'onda',
                            type: 'image',
                            rect: ['53px', '163px', '53px', '52px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"onda.png",'0px','0px']
                        },
                        {
                            id: 'equipo',
                            type: 'image',
                            rect: ['0', '241px', '160px', '294px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"equipo.png",'0px','0px']
                        },
                        {
                            id: 'cta',
                            type: 'image',
                            rect: ['0', '544px', '160px', '34px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"cta.png",'0px','0px']
                        },
                        {
                            id: 'logoCopy',
                            type: 'image',
                            rect: ['1170px', '34px', '160px', '54px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"logo.png",'0px','0px']
                        },
                        {
                            id: 'txtCopy',
                            type: 'image',
                            rect: ['1170px', '117px', '160px', '45px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"txt.png",'0px','0px']
                        },
                        {
                            id: 'ondaCopy',
                            type: 'image',
                            rect: ['1223px', '163px', '53px', '52px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"onda.png",'0px','0px']
                        },
                        {
                            id: 'equipoCopy',
                            type: 'image',
                            rect: ['1170px', '241px', '160px', '294px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"equipo.png",'0px','0px']
                        },
                        {
                            id: 'ctaCopy',
                            type: 'image',
                            rect: ['1170px', '544px', '160px', '34px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"cta.png",'0px','0px']
                        },
                        {
                            id: 'texto_desplegado',
                            type: 'image',
                            rect: ['294px', '23px', '358px', '103px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"texto_desplegado.png",'0px','0px']
                        },
                        {
                            id: 'eq_negro_desp',
                            type: 'image',
                            rect: ['310px', '174px', '181px', '340px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"eq_negro_desp.png",'0px','0px']
                        },
                        {
                            id: 'eq_blanco_desp',
                            type: 'image',
                            rect: ['420px', '197px', '181px', '340px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"eq_blanco_desp.png",'0px','0px']
                        },
                        {
                            id: 'cta_desplegado',
                            type: 'image',
                            rect: ['771px', '483px', '259px', '42px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"cta_desplegado.png",'0px','0px']
                        },
                        {
                            id: 'abja',
                            type: 'image',
                            rect: ['228px', '544px', '850px', '62px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"abja.png",'0px','0px']
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: ['null', 'null', '1330px', '600px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(255,255,255,1)"]
                        }
                    }
                },
                timeline: {
                    duration: 1309.7075406095,
                    autoPlay: true,
                    labels: {
                        "inicio": 32
                    },
                    data: [
                        [
                            "eid97",
                            "left",
                            250,
                            268,
                            "easeOutQuad",
                            "${fondo}",
                            '0px',
                            '265px'
                        ],
                        [
                            "eid105",
                            "opacity",
                            32,
                            141,
                            "easeOutQuad",
                            "${logoCopy}",
                            '1',
                            '0'
                        ],
                        [
                            "eid102",
                            "opacity",
                            345,
                            253,
                            "easeOutQuad",
                            "${fondo_union}",
                            '0',
                            '1'
                        ],
                        [
                            "eid118",
                            "opacity",
                            750,
                            273,
                            "easeOutQuad",
                            "${eq_negro_desp}",
                            '0',
                            '1'
                        ],
                        [
                            "eid112",
                            "opacity",
                            173,
                            141,
                            "easeOutQuad",
                            "${ctaCopy}",
                            '1',
                            '0'
                        ],
                        [
                            "eid126",
                            "top",
                            669,
                            273,
                            "easeOutQuad",
                            "${eq_blanco_desp}",
                            '177px',
                            '197px'
                        ],
                        [
                            "eid98",
                            "width",
                            250,
                            268,
                            "easeOutQuad",
                            "${fondo}",
                            '160px',
                            '400px'
                        ],
                        [
                            "eid103",
                            "opacity",
                            173,
                            141,
                            "easeOutQuad",
                            "${cta}",
                            '1',
                            '0'
                        ],
                        [
                            "eid94",
                            "left",
                            212,
                            0,
                            "easeOutQuad",
                            "${cerrar}",
                            '1074px',
                            '1074px'
                        ],
                        [
                            "eid104",
                            "opacity",
                            146,
                            141,
                            "easeOutQuad",
                            "${equipoCopy}",
                            '1',
                            '0'
                        ],
                        [
                            "eid120",
                            "opacity",
                            669,
                            273,
                            "easeOutQuad",
                            "${eq_blanco_desp}",
                            '0',
                            '1'
                        ],
                        [
                            "eid122",
                            "opacity",
                            598,
                            273,
                            "easeOutQuad",
                            "${texto_desplegado}",
                            '0',
                            '1'
                        ],
                        [
                            "eid109",
                            "opacity",
                            109,
                            141,
                            "easeOutQuad",
                            "${onda}",
                            '1',
                            '0'
                        ],
                        [
                            "eid99",
                            "left",
                            250,
                            268,
                            "easeOutQuad",
                            "${fondo2}",
                            '1170px',
                            '652px'
                        ],
                        [
                            "eid136",
                            "top",
                            942,
                            256,
                            "easeOutQuad",
                            "${cta_desplegado}",
                            '483px',
                            '493px'
                        ],
                        [
                            "eid107",
                            "opacity",
                            71,
                            141,
                            "easeOutQuad",
                            "${txtCopy}",
                            '1',
                            '0'
                        ],
                        [
                            "eid114",
                            "width",
                            345,
                            253,
                            "easeOutQuad",
                            "${fondo_union}",
                            '960px',
                            '800px'
                        ],
                        [
                            "eid111",
                            "opacity",
                            71,
                            141,
                            "easeOutQuad",
                            "${txt}",
                            '1',
                            '0'
                        ],
                        [
                            "eid92",
                            "opacity",
                            32,
                            180,
                            "easeOutQuad",
                            "${cerrar}",
                            '0',
                            '1'
                        ],
                        [
                            "eid116",
                            "left",
                            345,
                            253,
                            "easeOutQuad",
                            "${fondo_union}",
                            '185px',
                            '265px'
                        ],
                        [
                            "eid110",
                            "opacity",
                            146,
                            141,
                            "easeOutQuad",
                            "${equipo}",
                            '1',
                            '0'
                        ],
                        [
                            "eid100",
                            "width",
                            250,
                            268,
                            "easeOutQuad",
                            "${fondo2}",
                            '160px',
                            '413px'
                        ],
                        [
                            "eid132",
                            "opacity",
                            942,
                            256,
                            "easeOutQuad",
                            "${abja}",
                            '0',
                            '1'
                        ],
                        [
                            "eid108",
                            "opacity",
                            109,
                            141,
                            "easeOutQuad",
                            "${ondaCopy}",
                            '1',
                            '0'
                        ],
                        [
                            "eid106",
                            "opacity",
                            32,
                            141,
                            "easeOutQuad",
                            "${logo}",
                            '1',
                            '0'
                        ],
                        [
                            "eid129",
                            "top",
                            750,
                            273,
                            "easeOutQuad",
                            "${eq_negro_desp}",
                            '174px',
                            '164px'
                        ],
                        [
                            "eid134",
                            "opacity",
                            942,
                            256,
                            "easeOutQuad",
                            "${cta_desplegado}",
                            '0',
                            '1'
                        ]
                    ]
                }
            },
            "cerrar": {
                version: "6.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "6.0.0.400",
                scaleToFit: "none",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            rect: ['0px', '0px', '32px', '32px', 'auto', 'auto'],
                            borderRadius: ['50%', '50%', '50%', '50%'],
                            opacity: '1',
                            id: 'cerrar',
                            stroke: [0, 'rgb(0, 0, 0)', 'none'],
                            type: 'ellipse',
                            fill: ['rgba(192,192,192,1)']
                        },
                        {
                            transform: [[], ['45'], [0, 0, 0], [1, 1, 1]],
                            rect: ['15px', '7px', '3px', '18px', 'auto', 'auto'],
                            id: 'Rectangle2',
                            stroke: [0, 'rgb(0, 0, 0)', 'none'],
                            type: 'rect',
                            fill: ['rgba(255,255,255,1.00)']
                        },
                        {
                            transform: [[], ['-45'], [0, 0, 0], [1, 1, 1]],
                            rect: ['15px', '7px', '3px', '18px', 'auto', 'auto'],
                            id: 'Rectangle2Copy',
                            stroke: [0, 'rgb(0, 0, 0)', 'none'],
                            type: 'rect',
                            fill: ['rgba(255,255,255,1.00)']
                        }
                    ],
                    style: {
                        '${symbolSelector}': {
                            rect: [null, null, '32px', '32px']
                        }
                    }
                },
                timeline: {
                    duration: 0,
                    autoPlay: true,
                    data: [

                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("http://www.futbolecuador.com/unionlayer/samsung/centro_edgeActions.js");
})("EDGE-11811650");
