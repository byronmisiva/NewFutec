/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im=baseUrl+'coke/images/',
        aud=baseUrl+'coke/media/',
        vid=baseUrl+'coke/media/',
        js=baseUrl+'coke/js/',
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
                            id: 'tapa_izq',
                            type: 'rect',
                            rect: ['1px', '0px', '160px', '600px', 'auto', 'auto'],
                            fill: ["rgba(255,255,255,1.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"]
                        },
                        {
                            id: 'tapa_der',
                            type: 'rect',
                            rect: ['1170px', '0px', '160px', '600px', 'auto', 'auto'],
                            fill: ["rgba(255,255,255,1.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"]
                        },
                        {
                            id: 'mask_izquierda',
                            type: 'rect',
                            rect: ['0px', '0px', '160px', '600px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(192,192,192,1)"],
                            stroke: [0,"rgba(0,0,0,1)","none"],
                            c: [
                            {
                                id: 'fondo_izquierda',
                                type: 'image',
                                rect: ['-223px', '-5px', '943px', '609px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"fondo.jpg",'0px','0px']
                            }]
                        },
                        {
                            id: 'mask_derecha',
                            type: 'rect',
                            rect: ['1170px', '0px', '160px', '600px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(192,192,192,1)"],
                            stroke: [0,"rgba(0,0,0,1)","none"],
                            c: [
                            {
                                id: 'fondo_derecha',
                                type: 'image',
                                rect: ['-212px', '-5px', '943px', '609px', 'auto', 'auto'],
                                overflow: 'visible',
                                fill: ["rgba(0,0,0,0)",im+"fondo.jpg",'0px','0px'],
                                filter: [0, 0, 1, 1, 0, 0, 0, 0, "rgba(0,0,0,0)", 0, 0, 0]
                            }]
                        },
                        {
                            id: 'cerrar2',
                            symbolName: 'cerrar',
                            type: 'rect',
                            rect: ['1064px', '10px', '32', '32', 'auto', 'auto'],
                            cursor: 'pointer',
                            opacity: '0'
                        },
                        {
                            id: 'logo_grande',
                            type: 'image',
                            rect: ['839px', '10px', '200px', '200px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"logo_grande.png",'0px','0px']
                        },
                        {
                            id: 'l1',
                            type: 'image',
                            rect: ['803px', '532px', '51px', '44px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"l1.png",'0px','0px']
                        },
                        {
                            id: 'l2',
                            type: 'image',
                            rect: ['863px', '532px', '93px', '44px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"l2.png",'0px','0px']
                        },
                        {
                            id: 'l3',
                            type: 'image',
                            rect: ['973px', '532px', '47px', '44px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"l3.png",'0px','0px']
                        },
                        {
                            id: 'logo_peq',
                            type: 'image',
                            rect: ['25px', '25px', '108px', '115px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"logo_peq.png",'0px','0px']
                        },
                        {
                            id: 'logo_peq2',
                            type: 'image',
                            rect: ['1195px', '25px', '108px', '115px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"logo_peq.png",'0px','0px']
                        },
                        {
                            id: 'video',
                            volume: '1',
                            type: 'video',
                            tag: 'video',
                            rect: ['568px', '201px', '480px', '334px', 'auto', 'auto'],
                            opacity: '0',
                            source: [vid+"video.mp4"],
                            preload: 'auto'
                        },
                        {
                            id: 'boton_abre',
                            type: 'rect',
                            rect: ['973px', '16px', '24px', '27px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(242,10,10,1.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"]
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: ['null', 'null', '1330px', '600px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(0,0,0,0.00)"]
                        }
                    }
                },
                timeline: {
                    duration: 5000,
                    autoPlay: true,
                    labels: {
                        "inicio": 0,
                        "play": 3343
                    },
                    data: [
                        [
                            "eid12",
                            "left",
                            250,
                            1157,
                            "easeOutQuad",
                            "${fondo_izquierda}",
                            '-223px',
                            '-252px'
                        ],
                        [
                            "eid30",
                            "left",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${fondo_izquierda}",
                            '-252px',
                            '-223px'
                        ],
                        [
                            "eid44",
                            "opacity",
                            1665,
                            703,
                            "easeOutQuad",
                            "${l1}",
                            '0',
                            '1'
                        ],
                        [
                            "eid47",
                            "opacity",
                            3500,
                            250,
                            "easeOutQuad",
                            "${l1}",
                            '1',
                            '0'
                        ],
                        [
                            "eid49",
                            "opacity",
                            1000,
                            656,
                            "easeOutQuad",
                            "${logo_grande}",
                            '0',
                            '1'
                        ],
                        [
                            "eid48",
                            "opacity",
                            3439,
                            217,
                            "easeOutQuad",
                            "${logo_grande}",
                            '1',
                            '0'
                        ],
                        [
                            "eid23",
                            "width",
                            250,
                            1157,
                            "easeOutQuad",
                            "${fondo_derecha}",
                            '943px',
                            '1330px'
                        ],
                        [
                            "eid29",
                            "width",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${fondo_derecha}",
                            '1330px',
                            '943px'
                        ],
                        [
                            "eid61",
                            "opacity",
                            1656,
                            180,
                            "easeOutQuad",
                            "${cerrar2}",
                            '0',
                            '1'
                        ],
                        [
                            "eid62",
                            "opacity",
                            3439,
                            217,
                            "easeOutQuad",
                            "${cerrar2}",
                            '1',
                            '0'
                        ],
                        [
                            "eid22",
                            "left",
                            250,
                            1157,
                            "easeOutQuad",
                            "${fondo_derecha}",
                            '-214px',
                            '-252px'
                        ],
                        [
                            "eid24",
                            "left",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${fondo_derecha}",
                            '-252px',
                            '-212px'
                        ],
                        [
                            "eid5",
                            "left",
                            250,
                            1144,
                            "easeOutQuad",
                            "${mask_derecha}",
                            '1170px',
                            '265px'
                        ],
                        [
                            "eid7",
                            "left",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${mask_derecha}",
                            '265px',
                            '1170px'
                        ],
                        [
                            "eid79",
                            "opacity",
                            1394,
                            606,
                            "linear",
                            "${video}",
                            '0',
                            '1'
                        ],
                        [
                            "eid80",
                            "opacity",
                            3343,
                            407,
                            "linear",
                            "${video}",
                            '1',
                            '0'
                        ],
                        [
                            "eid3",
                            "width",
                            250,
                            1144,
                            "easeOutQuad",
                            "${mask_izquierda}",
                            '160px',
                            '800px'
                        ],
                        [
                            "eid8",
                            "width",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${mask_izquierda}",
                            '800px',
                            '160px'
                        ],
                        [
                            "eid14",
                            "height",
                            250,
                            1157,
                            "easeOutQuad",
                            "${fondo_izquierda}",
                            '609px',
                            '859px'
                        ],
                        [
                            "eid32",
                            "height",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${fondo_izquierda}",
                            '859px',
                            '609px'
                        ],
                        [
                            "eid42",
                            "opacity",
                            2000,
                            703,
                            "easeOutQuad",
                            "${l2}",
                            '0',
                            '1'
                        ],
                        [
                            "eid46",
                            "opacity",
                            3626,
                            217,
                            "easeOutQuad",
                            "${l2}",
                            '1',
                            '0'
                        ],
                        [
                            "eid54",
                            "opacity",
                            0,
                            250,
                            "linear",
                            "${logo_peq2}",
                            '1',
                            '0'
                        ],
                        [
                            "eid1",
                            "width",
                            250,
                            1144,
                            "easeOutQuad",
                            "${mask_derecha}",
                            '160px',
                            '800px'
                        ],
                        [
                            "eid6",
                            "width",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${mask_derecha}",
                            '800px',
                            '160px'
                        ],
                        [
                            "eid16",
                            "top",
                            250,
                            1157,
                            "easeOutQuad",
                            "${fondo_izquierda}",
                            '-5px',
                            '-175px'
                        ],
                        [
                            "eid31",
                            "top",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${fondo_izquierda}",
                            '-175px',
                            '-5px'
                        ],
                        [
                            "eid55",
                            "opacity",
                            0,
                            250,
                            "linear",
                            "${logo_peq}",
                            '1',
                            '0'
                        ],
                        [
                            "eid82",
                            "left",
                            0,
                            3656,
                            "easeOutQuad",
                            "${cerrar2}",
                            '1064px',
                            '1073px'
                        ],
                        [
                            "eid63",
                            "left",
                            3656,
                            94,
                            "easeOutQuad",
                            "${cerrar2}",
                            '1073px',
                            '1076px'
                        ],
                        [
                            "eid81",
                            "volume",
                            3343,
                            407,
                            "linear",
                            "${video}",
                            '1',
                            '0'
                        ],
                        [
                            "eid40",
                            "opacity",
                            2368,
                            703,
                            "easeOutQuad",
                            "${l3}",
                            '0',
                            '1'
                        ],
                        [
                            "eid45",
                            "opacity",
                            3750,
                            217,
                            "easeOutQuad",
                            "${l3}",
                            '1',
                            '0'
                        ],
                        [
                            "eid83",
                            "top",
                            0,
                            3656,
                            "easeOutQuad",
                            "${cerrar2}",
                            '10px',
                            '5px'
                        ],
                        [
                            "eid64",
                            "top",
                            3656,
                            94,
                            "easeOutQuad",
                            "${cerrar2}",
                            '5px',
                            '-46px'
                        ],
                        [
                            "eid18",
                            "width",
                            250,
                            1157,
                            "easeOutQuad",
                            "${fondo_izquierda}",
                            '943px',
                            '1330px'
                        ],
                        [
                            "eid33",
                            "width",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${fondo_izquierda}",
                            '1330px',
                            '943px'
                        ],
                        [
                            "eid20",
                            "top",
                            250,
                            1157,
                            "easeOutQuad",
                            "${fondo_derecha}",
                            '-5px',
                            '-175px'
                        ],
                        [
                            "eid25",
                            "top",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${fondo_derecha}",
                            '-175px',
                            '-5px'
                        ],
                        [
                            "eid4",
                            "left",
                            250,
                            1144,
                            "easeOutQuad",
                            "${mask_izquierda}",
                            '0px',
                            '265px'
                        ],
                        [
                            "eid10",
                            "left",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${mask_izquierda}",
                            '265px',
                            '0px'
                        ],
                        [
                            "eid21",
                            "height",
                            250,
                            1157,
                            "easeOutQuad",
                            "${fondo_derecha}",
                            '609px',
                            '859px'
                        ],
                        [
                            "eid28",
                            "height",
                            3843,
                            1157,
                            "easeOutQuad",
                            "${fondo_derecha}",
                            '859px',
                            '609px'
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
                            stroke: [0, 'rgb(0, 0, 0)', 'none'],
                            id: 'cerrar',
                            opacity: '1',
                            type: 'ellipse',
                            fill: ['rgba(192,192,192,1)']
                        },
                        {
                            rect: ['15px', '7px', '3px', '18px', 'auto', 'auto'],
                            transform: [[], ['45'], [0, 0, 0], [1, 1, 1]],
                            id: 'Rectangle2',
                            stroke: [0, 'rgb(0, 0, 0)', 'none'],
                            type: 'rect',
                            fill: ['rgba(255,255,255,1.00)']
                        },
                        {
                            rect: ['15px', '7px', '3px', '18px', 'auto', 'auto'],
                            transform: [[], ['-45'], [0, 0, 0], [1, 1, 1]],
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
            },
            "contenedor_video": {
                version: "6.0.0",
                minimumCompatibleVersion: "5.0.0",
                build: "6.0.0.400",
                scaleToFit: "none",
                centerStage: "none",
                resizeInstances: false,
                content: {
                    dom: [
                        {
                            type: 'rect',
                            id: 'video',
                            stroke: [0, 'rgb(0, 0, 0)', 'none'],
                            rect: ['0px', '0px', '560px', '315px', 'auto', 'auto'],
                            fill: ['rgba(192,192,192,1)']
                        }
                    ],
                    style: {
                        '${symbolSelector}': {
                            rect: [null, null, '560px', '315px']
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

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load(baseUrl+"coke/union_layer_edgeActions.js");
})("EDGE-28231535");
