/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im=baseUrl+'coke/images/',
        aud=baseUrl+'cokemedia/',
        vid=baseUrl+'cokemedia/',
        js=baseUrl+'cokejs/',
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
                            id: 'boton_abre',
                            type: 'rect',
                            rect: ['973px', '16px', '24px', '27px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(242,10,10,1.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"]
                        },
                        {
                            id: '_160x600_1',
                            type: 'image',
                            rect: ['270px', '0px', '160px', '600px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"160x600.jpg",'0px','0px']
                        },
                        {
                            id: '_160x600_2',
                            type: 'image',
                            rect: ['900px', '0px', '160px', '600px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"160x600.jpg",'0px','0px']
                        },
                        {
                            id: 'desplegado_1',
                            type: 'image',
                            rect: ['261px', '0px', '800px', '600px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"desplegado.jpg",'0px','0px']
                        },
                        {
                            id: 'desplegado_2',
                            type: 'image',
                            rect: ['261px', '0px', '800px', '600px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"desplegado.jpg",'0px','0px']
                        },
                        {
                            id: 'cerrar2',
                            symbolName: 'cerrar',
                            type: 'rect',
                            rect: ['1074px', '10px', '32', '32', 'auto', 'auto'],
                            cursor: 'pointer',
                            opacity: '0'
                        },
                        {
                            id: 'contenedor',
                            symbolName: 'video',
                            type: 'rect',
                            rect: ['566px', '259px', '480', '300', 'auto', 'auto'],
                            opacity: '0',
                            transform: [[],[],[],['0.9375','0.85']]
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
                    duration: 2333,
                    autoPlay: true,
                    labels: {
                        "inicio": 0,
                        "play": 1933
                    },
                    data: [
                        [
                            "eid195",
                            "scaleX",
                            1500,
                            0,
                            "linear",
                            "${contenedor}",
                            '0.9375',
                            '0.9375'
                        ],
                        [
                            "eid199",
                            "scaleY",
                            1500,
                            0,
                            "linear",
                            "${contenedor}",
                            '0.85',
                            '0.85'
                        ],
                        [
                            "eid152",
                            "top",
                            2250,
                            83,
                            "easeOutQuad",
                            "${cerrar2}",
                            '10px',
                            '-40px'
                        ],
                        [
                            "eid178",
                            "opacity",
                            1933,
                            250,
                            "linear",
                            "${_160x600_1}",
                            '1',
                            '0'
                        ],
                        [
                            "eid153",
                            "left",
                            978,
                            0,
                            "easeOutQuad",
                            "${cerrar2}",
                            '1074px',
                            '1074px'
                        ],
                        [
                            "eid61",
                            "opacity",
                            798,
                            180,
                            "easeOutQuad",
                            "${cerrar2}",
                            '0',
                            '1'
                        ],
                        [
                            "eid151",
                            "opacity",
                            2250,
                            83,
                            "easeOutQuad",
                            "${cerrar2}",
                            '1',
                            '0'
                        ],
                        [
                            "eid175",
                            "opacity",
                            1933,
                            250,
                            "linear",
                            "${_160x600_2}",
                            '1',
                            '0'
                        ],
                        [
                            "eid200",
                            "top",
                            1500,
                            0,
                            "linear",
                            "${contenedor}",
                            '259px',
                            '259px'
                        ],
                        [
                            "eid155",
                            "left",
                            0,
                            500,
                            "linear",
                            "${_160x600_1}",
                            '0px',
                            '270px'
                        ],
                        [
                            "eid202",
                            "opacity",
                            664,
                            134,
                            "linear",
                            "${contenedor}",
                            '0',
                            '1'
                        ],
                        [
                            "eid204",
                            "opacity",
                            1750,
                            0,
                            "linear",
                            "${contenedor}",
                            '1',
                            '0'
                        ],
                        [
                            "eid203",
                            "opacity",
                            2183,
                            0,
                            "linear",
                            "${contenedor}",
                            '0',
                            '0'
                        ],
                        [
                            "eid156",
                            "left",
                            0,
                            500,
                            "linear",
                            "${_160x600_2}",
                            '1170px',
                            '900px'
                        ],
                        [
                            "eid161",
                            "opacity",
                            328,
                            336,
                            "linear",
                            "${desplegado_2}",
                            '0',
                            '1'
                        ],
                        [
                            "eid177",
                            "opacity",
                            1933,
                            250,
                            "linear",
                            "${desplegado_2}",
                            '1',
                            '0'
                        ],
                        [
                            "eid196",
                            "left",
                            1500,
                            0,
                            "linear",
                            "${contenedor}",
                            '566px',
                            '566px'
                        ],
                        [
                            "eid160",
                            "opacity",
                            328,
                            336,
                            "linear",
                            "${desplegado_1}",
                            '0',
                            '1'
                        ],
                        [
                            "eid176",
                            "opacity",
                            1933,
                            250,
                            "linear",
                            "${desplegado_1}",
                            '1',
                            '0'
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
            },
            "video": {
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
                            id: 'Rectangle',
                            stroke: [0, 'rgb(0, 0, 0)', 'none'],
                            rect: ['0px', '0px', '480px', '300px', 'auto', 'auto'],
                            fill: ['rgba(192,192,192,1)']
                        }
                    ],
                    style: {
                        '${symbolSelector}': {
                            rect: [null, null, '480px', '300px']
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
