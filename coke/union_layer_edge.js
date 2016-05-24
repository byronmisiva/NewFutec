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
                            id: 'cerrar2',
                            symbolName: 'cerrar',
                            type: 'rect',
                            rect: ['1074px', '10px', '32', '32', 'auto', 'auto'],
                            cursor: 'pointer',
                            opacity: '0'
                        },
                        {
                            id: 'boton_abre',
                            type: 'rect',
                            rect: ['973px', '16px', '24px', '27px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(242,10,10,1.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"]
                        },
                        {
                            id: '_160x600',
                            type: 'image',
                            rect: ['265px', '0', '160px', '600px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"160x600.jpg",'0px','0px']
                        },
                        {
                            id: '_160x600Copy',
                            type: 'image',
                            rect: ['905px', '0', '160px', '600px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"160x600.jpg",'0px','0px']
                        },
                        {
                            id: 'RectangleCopy',
                            type: 'rect',
                            rect: ['265px', '0px', '162px', '600px', 'auto', 'auto'],
                            overflow: 'hidden',
                            opacity: '0',
                            fill: ["rgba(192,192,192,1)"],
                            stroke: [0,"rgb(0, 0, 0)","none"],
                            c: [
                            {
                                id: 'desplegado',
                                type: 'image',
                                rect: ['0px', '0', '800px', '600px', 'auto', 'auto'],
                                opacity: '0',
                                fill: ["rgba(0,0,0,0)",im+"desplegado.jpg",'0px','0px']
                            }]
                        },
                        {
                            id: 'Rectangle',
                            type: 'rect',
                            rect: ['651px', '0px', '167px', '600px', 'auto', 'auto'],
                            overflow: 'hidden',
                            opacity: '0',
                            fill: ["rgba(192,192,192,1)"],
                            stroke: [0,"rgb(0, 0, 0)","none"],
                            c: [
                            {
                                id: 'desplegadoCopy3',
                                type: 'image',
                                rect: ['-384px', '0', '800px', '600px', 'auto', 'auto'],
                                overflow: 'visible',
                                opacity: '1',
                                fill: ["rgba(0,0,0,0)",im+"desplegado.jpg",'0px','0px']
                            }]
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
                            "eid127",
                            "width",
                            507,
                            750,
                            "easeOutQuad",
                            "${RectangleCopy}",
                            '162px',
                            '402px'
                        ],
                        [
                            "eid61",
                            "opacity",
                            1391,
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
                            "eid120",
                            "width",
                            507,
                            750,
                            "easeOutQuad",
                            "${Rectangle}",
                            '167px',
                            '416px'
                        ],
                        [
                            "eid137",
                            "left",
                            399,
                            108,
                            "easeOutQuad",
                            "${desplegadoCopy3}",
                            '-601px',
                            '-633px'
                        ],
                        [
                            "eid138",
                            "left",
                            507,
                            750,
                            "easeOutQuad",
                            "${desplegadoCopy3}",
                            '-633px',
                            '-384px'
                        ],
                        [
                            "eid79",
                            "opacity",
                            1257,
                            250,
                            "linear",
                            "${video}",
                            '0',
                            '1'
                        ],
                        [
                            "eid80",
                            "opacity",
                            1750,
                            250,
                            "linear",
                            "${video}",
                            '1',
                            '0'
                        ],
                        [
                            "eid142",
                            "left",
                            507,
                            750,
                            "easeOutQuad",
                            "${RectangleCopy}",
                            '263px',
                            '265px'
                        ],
                        [
                            "eid143",
                            "opacity",
                            399,
                            37,
                            "linear",
                            "${_160x600Copy}",
                            '1',
                            '0'
                        ],
                        [
                            "eid133",
                            "opacity",
                            399,
                            108,
                            "easeOutQuad",
                            "${Rectangle}",
                            '0',
                            '1'
                        ],
                        [
                            "eid148",
                            "opacity",
                            2250,
                            83,
                            "easeOutQuad",
                            "${Rectangle}",
                            '1',
                            '0'
                        ],
                        [
                            "eid146",
                            "left",
                            1500,
                            0,
                            "easeOutQuad",
                            "${desplegado}",
                            '0px',
                            '0px'
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
                            "eid115",
                            "left",
                            0,
                            399,
                            "linear",
                            "${_160x600Copy}",
                            '1170px',
                            '905px'
                        ],
                        [
                            "eid135",
                            "opacity",
                            399,
                            108,
                            "easeOutQuad",
                            "${RectangleCopy}",
                            '0',
                            '1'
                        ],
                        [
                            "eid147",
                            "opacity",
                            2250,
                            83,
                            "easeOutQuad",
                            "${RectangleCopy}",
                            '1',
                            '0'
                        ],
                        [
                            "eid153",
                            "left",
                            1571,
                            0,
                            "easeOutQuad",
                            "${cerrar2}",
                            '1074px',
                            '1074px'
                        ],
                        [
                            "eid81",
                            "volume",
                            1750,
                            250,
                            "linear",
                            "${video}",
                            '1',
                            '0'
                        ],
                        [
                            "eid144",
                            "opacity",
                            399,
                            37,
                            "linear",
                            "${_160x600}",
                            '1',
                            '0'
                        ],
                        [
                            "eid150",
                            "opacity",
                            2250,
                            83,
                            "easeOutQuad",
                            "${desplegadoCopy3}",
                            '1',
                            '0'
                        ],
                        [
                            "eid116",
                            "left",
                            0,
                            399,
                            "linear",
                            "${_160x600}",
                            '0px',
                            '265px'
                        ],
                        [
                            "eid119",
                            "left",
                            507,
                            750,
                            "easeOutQuad",
                            "${Rectangle}",
                            '905px',
                            '651px'
                        ],
                        [
                            "eid131",
                            "opacity",
                            399,
                            108,
                            "easeOutQuad",
                            "${desplegado}",
                            '0',
                            '1'
                        ],
                        [
                            "eid149",
                            "opacity",
                            2250,
                            83,
                            "easeOutQuad",
                            "${desplegado}",
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
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load(baseUrl+"coke/union_layer_edgeActions.js");
})("EDGE-28231535");
