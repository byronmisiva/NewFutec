/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='unionlayer/panini/images/',
        aud='unionlayer/panini/media/',
        vid='unionlayer/panini/media/',
        js='js/',
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
                            id: 'estadio',
                            display: 'block',
                            type: 'image',
                            rect: ['265px', '-156px', '800px', '756px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"estadio.jpg",'0px','0px']
                        },
                        {
                            id: 'barcelona',
                            display: 'none',
                            type: 'image',
                            rect: ['260px', '38px', '357px', '82px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"barcelona.png",'0px','0px'],
                            transform: [[],[],[],['0','0']]
                        },
                        {
                            id: 'cromos',
                            display: 'none',
                            type: 'image',
                            rect: ['270px', '607px', '321px', '356px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"cromos.png",'0px','0px']
                        },
                        {
                            id: 'mi-vecino',
                            display: 'none',
                            type: 'image',
                            rect: ['1062px', '479px', '296px', '92px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"mi-vecino.png",'0px','0px']
                        },
                        {
                            id: 'text1',
                            type: 'image',
                            rect: ['779px', '38px', '304px', '82px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"text1.png",'0px','0px']
                        },
                        {
                            id: 'text2',
                            display: 'none',
                            type: 'image',
                            rect: ['241px', '33px', '314px', '106px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"text2.png",'0px','0px']
                        },
                        {
                            id: 'text3',
                            type: 'image',
                            rect: ['775px', '33px', '310px', '90px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"text3.png",'0px','0px']
                        },
                        {
                            id: 'Rectangle',
                            display: 'block',
                            type: 'rect',
                            rect: ['265px', '0px', '800px', '600px', 'auto', 'auto'],
                            opacity: '0.6991869807243347',
                            fill: ["rgba(0,0,0,1.00)"],
                            stroke: [0,"rgba(0,0,0,1)","none"]
                        },
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
                    duration: 18273,
                    autoPlay: true,
                    labels: {
                        "inicio": 32
                    },
                    data: [
                        [
                            "eid40",
                            "display",
                            0,
                            0,
                            "easeOutQuart",
                            "${Rectangle}",
                            'block',
                            'block'
                        ],
                        [
                            "eid16",
                            "display",
                            2500,
                            0,
                            "easeOutQuart",
                            "${mi-vecino}",
                            'none',
                            'block'
                        ],
                        [
                            "eid65",
                            "left",
                            2500,
                            0,
                            "easeOutQuart",
                            "${cromos}",
                            '270px',
                            '270px'
                        ],
                        [
                            "eid46",
                            "display",
                            18250,
                            0,
                            "easeOutQuart",
                            "${text3}",
                            'block',
                            'none'
                        ],
                        [
                            "eid4",
                            "display",
                            1750,
                            0,
                            "easeOutQuart",
                            "${barcelona}",
                            'none',
                            'block'
                        ],
                        [
                            "eid27",
                            "left",
                            9250,
                            500,
                            "easeOutQuart",
                            "${text2}",
                            '254px',
                            '523px'
                        ],
                        [
                            "eid38",
                            "left",
                            13572,
                            490,
                            "easeOutQuart",
                            "${text2}",
                            '523px',
                            '241px'
                        ],
                        [
                            "eid8",
                            "scaleX",
                            1750,
                            750,
                            "easeOutBack",
                            "${barcelona}",
                            '0',
                            '1'
                        ],
                        [
                            "eid1",
                            "display",
                            250,
                            0,
                            "linear",
                            "${estadio}",
                            'block',
                            'block'
                        ],
                        [
                            "eid80",
                            "opacity",
                            5051,
                            449,
                            "easeOutQuart",
                            "${barcelona}",
                            '1',
                            '0'
                        ],
                        [
                            "eid56",
                            "width",
                            1000,
                            0,
                            "linear",
                            "${Rectangle}",
                            '800px',
                            '800px'
                        ],
                        [
                            "eid25",
                            "display",
                            9250,
                            0,
                            "easeOutQuart",
                            "${text2}",
                            'none',
                            'block'
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
                            "eid78",
                            "opacity",
                            13806,
                            444,
                            "easeOutQuart",
                            "${text3}",
                            '0',
                            '1'
                        ],
                        [
                            "eid74",
                            "opacity",
                            17000,
                            1208,
                            "easeOutQuart",
                            "${text3}",
                            '1',
                            '0'
                        ],
                        [
                            "eid64",
                            "left",
                            1000,
                            0,
                            "linear",
                            "${Rectangle}",
                            '265px',
                            '265px'
                        ],
                        [
                            "eid90",
                            "opacity",
                            17000,
                            750,
                            "linear",
                            "${mi-vecino}",
                            '1',
                            '0'
                        ],
                        [
                            "eid42",
                            "opacity",
                            1000,
                            1250,
                            "linear",
                            "${Rectangle}",
                            '0.6991869807243347',
                            '0'
                        ],
                        [
                            "eid48",
                            "opacity",
                            17000,
                            750,
                            "linear",
                            "${Rectangle}",
                            '0',
                            '0.6991869807243347'
                        ],
                        [
                            "eid14",
                            "top",
                            2500,
                            750,
                            "easeOutQuart",
                            "${cromos}",
                            '612px',
                            '244px'
                        ],
                        [
                            "eid52",
                            "top",
                            17000,
                            1250,
                            "easeOutQuart",
                            "${cromos}",
                            '244px',
                            '607px'
                        ],
                        [
                            "eid55",
                            "width",
                            250,
                            0,
                            "easeOutQuart",
                            "${estadio}",
                            '800px',
                            '800px'
                        ],
                        [
                            "eid91",
                            "top",
                            17857,
                            83,
                            "easeOutQuad",
                            "${cerrar}",
                            '10px',
                            '-40px'
                        ],
                        [
                            "eid62",
                            "left",
                            250,
                            0,
                            "easeOutQuart",
                            "${estadio}",
                            '265px',
                            '265px'
                        ],
                        [
                            "eid82",
                            "opacity",
                            5187,
                            563,
                            "easeOutQuart",
                            "${text1}",
                            '0',
                            '1'
                        ],
                        [
                            "eid84",
                            "opacity",
                            9000,
                            571,
                            "easeOutQuart",
                            "${text1}",
                            '1',
                            '0'
                        ],
                        [
                            "eid3",
                            "top",
                            250,
                            2000,
                            "easeOutQuart",
                            "${estadio}",
                            '-156px',
                            '0px'
                        ],
                        [
                            "eid54",
                            "top",
                            17000,
                            1250,
                            "easeOutQuart",
                            "${estadio}",
                            '0px',
                            '-156px'
                        ],
                        [
                            "eid21",
                            "left",
                            5187,
                            563,
                            "easeOutQuart",
                            "${text1}",
                            '765px',
                            '522px'
                        ],
                        [
                            "eid29",
                            "left",
                            9000,
                            571,
                            "easeOutQuart",
                            "${text1}",
                            '522px',
                            '779px'
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
                            "eid93",
                            "opacity",
                            17857,
                            83,
                            "easeOutQuad",
                            "${cerrar}",
                            '1',
                            '0'
                        ],
                        [
                            "eid32",
                            "left",
                            13806,
                            444,
                            "easeOutQuart",
                            "${text3}",
                            '775px',
                            '535px'
                        ],
                        [
                            "eid45",
                            "left",
                            17000,
                            1208,
                            "easeOutQuart",
                            "${text3}",
                            '535px',
                            '264px'
                        ],
                        [
                            "eid70",
                            "left",
                            1750,
                            0,
                            "easeOutQuart",
                            "${barcelona}",
                            '506px',
                            '506px'
                        ],
                        [
                            "eid71",
                            "left",
                            2500,
                            0,
                            "easeOutQuart",
                            "${barcelona}",
                            '506px',
                            '506px'
                        ],
                        [
                            "eid23",
                            "left",
                            5051,
                            449,
                            "easeOutQuart",
                            "${barcelona}",
                            '506px',
                            '260px'
                        ],
                        [
                            "eid18",
                            "left",
                            2500,
                            750,
                            "easeOutQuart",
                            "${mi-vecino}",
                            '1062px',
                            '754px'
                        ],
                        [
                            "eid51",
                            "left",
                            17000,
                            750,
                            "linear",
                            "${mi-vecino}",
                            '754px',
                            '800px'
                        ],
                        [
                            "eid10",
                            "display",
                            2500,
                            0,
                            "easeOutBack",
                            "${cromos}",
                            'none',
                            'block'
                        ],
                        [
                            "eid86",
                            "opacity",
                            9250,
                            500,
                            "easeOutQuart",
                            "${text2}",
                            '0',
                            '1'
                        ],
                        [
                            "eid88",
                            "opacity",
                            13572,
                            490,
                            "easeOutQuart",
                            "${text2}",
                            '1',
                            '0'
                        ],
                        [
                            "eid9",
                            "scaleY",
                            1750,
                            750,
                            "easeOutBack",
                            "${barcelona}",
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
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("unionlayer/panini/600x600_edgeActions.js");
})("EDGE-11811655");
