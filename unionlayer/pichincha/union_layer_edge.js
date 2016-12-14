/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='unionlayer/pichincha//images/',
        aud='unionlayer/pichincha//media/',
        vid='unionlayer/pichincha//media/',
        js='unionlayer/pichincha//js/',
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
                            id: '_160x600_22',
                            type: 'image',
                            rect: ['1170px', '0px', '160px', '600px', 'auto', 'auto'],
                            opacity: '1',
                            fill: ["rgba(0,0,0,0)",im+"160x600_2.jpg",'0px','0px']
                        },
                        {
                            id: 'desplegado_1',
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
                            id: 'logo_03',
                            type: 'image',
                            rect: ['526px', '174px', '529px', '170px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"logo_03.jpg",'0px','0px']
                        },
                        {
                            id: 'jugadores_ok',
                            type: 'image',
                            rect: ['620px', '147px', '489px', '453px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"jugadores_ok.jpg",'0px','0px']
                        },
                        {
                            id: 'Rectangle',
                            type: 'rect',
                            rect: ['-122px', '478px', '797px', '122px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,1.00)"],
                            stroke: [0,"rgba(0,0,0,1)","none"],
                            transform: [[],[],[],['0.04015']]
                        },
                        {
                            id: 'mascara',
                            type: 'rect',
                            rect: ['260px', '1px', '234px', '600px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(0,0,0,0.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"],
                            c: [
                            {
                                id: 'jugador_final_01',
                                type: 'image',
                                rect: ['-241px', '-1px', '234px', '600px', 'auto', 'auto'],
                                fill: ["rgba(0,0,0,0)",im+"jugador_final_01.jpg",'0px','0px']
                            }]
                        },
                        {
                            id: 'frase1_05',
                            type: 'image',
                            rect: ['668px', '81px', '394px', '38px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"frase1_05.png",'0px','0px']
                        },
                        {
                            id: 'frase1_03',
                            type: 'image',
                            rect: ['668px', '41px', '394px', '37px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"frase1_03.png",'0px','0px']
                        },
                        {
                            id: 'frase_final_17',
                            type: 'image',
                            rect: ['875px', '496px', '180px', '79px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"frase_final_17.png",'0px','0px']
                        },
                        {
                            id: 'postula_05',
                            type: 'image',
                            rect: ['861px', '382px', '208px', '40px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"postula_05.png",'0px','0px']
                        },
                        {
                            id: 'postula_03',
                            type: 'image',
                            rect: ['861px', '336px', '208px', '39px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"postula_03.png",'0px','0px']
                        },
                        {
                            id: 'frase_final_07',
                            type: 'image',
                            rect: ['670px', '228px', '262px', '65px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"frase_final_07.png",'0px','0px']
                        },
                        {
                            id: 'frase_final_04',
                            type: 'image',
                            rect: ['843px', '170px', '243px', '57px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"frase_final_04.png",'0px','0px']
                        },
                        {
                            id: 'logo2_022',
                            type: 'image',
                            rect: ['696px', '-1px', '408px', '128px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"logo2_02.png",'0px','0px']
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
                    duration: 9738,
                    autoPlay: true,
                    labels: {
                        "inicio": 0,
                        "play": 9338
                    },
                    data: [
                        [
                            "eid251",
                            "opacity",
                            6566,
                            650,
                            "easeOutQuad",
                            "${frase_final_17}",
                            '0',
                            '1'
                        ],
                        [
                            "eid260",
                            "scaleX",
                            5410,
                            690,
                            "easeOutQuad",
                            "${Rectangle}",
                            '0.04015',
                            '1'
                        ],
                        [
                            "eid216",
                            "opacity",
                            9000,
                            250,
                            "linear",
                            "${_160x600_22}",
                            '1',
                            '0'
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
                            9338,
                            250,
                            "linear",
                            "${desplegado_1}",
                            '1',
                            '0'
                        ],
                        [
                            "eid240",
                            "left",
                            6566,
                            650,
                            "easeOutQuad",
                            "${frase_final_17}",
                            '875px',
                            '715px'
                        ],
                        [
                            "eid178",
                            "opacity",
                            9000,
                            250,
                            "linear",
                            "${_160x600_1}",
                            '1',
                            '0'
                        ],
                        [
                            "eid228",
                            "left",
                            3110,
                            396,
                            "easeOutQuad",
                            "${frase1_03}",
                            '629px',
                            '459px'
                        ],
                        [
                            "eid233",
                            "left",
                            5000,
                            500,
                            "easeOutQuad",
                            "${frase1_03}",
                            '459px',
                            '659px'
                        ],
                        [
                            "eid237",
                            "left",
                            5500,
                            250,
                            "easeOutQuad",
                            "${frase1_03}",
                            '659px',
                            '668px'
                        ],
                        [
                            "eid229",
                            "opacity",
                            3242,
                            396,
                            "easeOutQuad",
                            "${frase1_05}",
                            '0',
                            '1'
                        ],
                        [
                            "eid234",
                            "opacity",
                            5078,
                            500,
                            "easeOutQuad",
                            "${frase1_05}",
                            '1',
                            '0'
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
                            "eid214",
                            "top",
                            0,
                            0,
                            "linear",
                            "${_160x600_22}",
                            '0px',
                            '0px'
                        ],
                        [
                            "eid215",
                            "top",
                            500,
                            0,
                            "linear",
                            "${_160x600_22}",
                            '0px',
                            '0px'
                        ],
                        [
                            "eid272",
                            "top",
                            6100,
                            0,
                            "easeOutQuad",
                            "${frase_final_07}",
                            '228px',
                            '228px'
                        ],
                        [
                            "eid212",
                            "left",
                            0,
                            500,
                            "linear",
                            "${_160x600_22}",
                            '1170px',
                            '900px'
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
                            "eid220",
                            "opacity",
                            978,
                            522,
                            "easeOutQuad",
                            "${logo_03}",
                            '0',
                            '1'
                        ],
                        [
                            "eid222",
                            "opacity",
                            2500,
                            500,
                            "easeOutQuad",
                            "${logo_03}",
                            '1',
                            '0'
                        ],
                        [
                            "eid232",
                            "left",
                            5250,
                            500,
                            "easeOutQuad",
                            "${jugadores_ok}",
                            '420px',
                            '620px'
                        ],
                        [
                            "eid271",
                            "opacity",
                            5750,
                            650,
                            "easeOutQuad",
                            "${logo2_022}",
                            '0',
                            '1'
                        ],
                        [
                            "eid224",
                            "opacity",
                            2903,
                            491,
                            "linear",
                            "${jugadores_ok}",
                            '0',
                            '1'
                        ],
                        [
                            "eid235",
                            "opacity",
                            5250,
                            500,
                            "easeOutQuad",
                            "${jugadores_ok}",
                            '1',
                            '0'
                        ],
                        [
                            "eid244",
                            "left",
                            6400,
                            650,
                            "easeOutQuad",
                            "${postula_05}",
                            '861px',
                            '701px'
                        ],
                        [
                            "eid253",
                            "opacity",
                            6400,
                            650,
                            "easeOutQuad",
                            "${postula_05}",
                            '0',
                            '1'
                        ],
                        [
                            "eid268",
                            "left",
                            5500,
                            675,
                            "easeOutQuad",
                            "${jugador_final_01}",
                            '-241px',
                            '-1px'
                        ],
                        [
                            "eid226",
                            "left",
                            3242,
                            396,
                            "easeOutQuad",
                            "${frase1_05}",
                            '629px',
                            '459px'
                        ],
                        [
                            "eid231",
                            "left",
                            5078,
                            500,
                            "easeOutQuad",
                            "${frase1_05}",
                            '459px',
                            '659px'
                        ],
                        [
                            "eid238",
                            "left",
                            5578,
                            172,
                            "easeOutQuad",
                            "${frase1_05}",
                            '659px',
                            '668px'
                        ],
                        [
                            "eid266",
                            "opacity",
                            5367,
                            43,
                            "easeOutQuad",
                            "${Rectangle}",
                            '0',
                            '1'
                        ],
                        [
                            "eid152",
                            "top",
                            9655,
                            83,
                            "easeOutQuad",
                            "${cerrar2}",
                            '10px',
                            '-40px'
                        ],
                        [
                            "eid248",
                            "left",
                            5916,
                            650,
                            "easeOutQuad",
                            "${frase_final_04}",
                            '843px',
                            '683px'
                        ],
                        [
                            "eid242",
                            "left",
                            6100,
                            650,
                            "easeOutQuad",
                            "${frase_final_07}",
                            '809px',
                            '670px'
                        ],
                        [
                            "eid262",
                            "left",
                            5410,
                            690,
                            "easeOutQuad",
                            "${Rectangle}",
                            '-122px',
                            '264px'
                        ],
                        [
                            "eid256",
                            "opacity",
                            6250,
                            650,
                            "easeOutQuad",
                            "${postula_03}",
                            '0',
                            '1'
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
                            9655,
                            83,
                            "easeOutQuad",
                            "${cerrar2}",
                            '1',
                            '0'
                        ],
                        [
                            "eid230",
                            "opacity",
                            3110,
                            396,
                            "easeOutQuad",
                            "${frase1_03}",
                            '0',
                            '1'
                        ],
                        [
                            "eid236",
                            "opacity",
                            5000,
                            500,
                            "easeOutQuad",
                            "${frase1_03}",
                            '1',
                            '0'
                        ],
                        [
                            "eid250",
                            "left",
                            6250,
                            650,
                            "easeOutQuad",
                            "${postula_03}",
                            '861px',
                            '701px'
                        ],
                        [
                            "eid264",
                            "top",
                            5410,
                            690,
                            "easeOutQuad",
                            "${Rectangle}",
                            '478px',
                            '479px'
                        ],
                        [
                            "eid269",
                            "left",
                            5750,
                            650,
                            "easeOutQuad",
                            "${logo2_022}",
                            '696px',
                            '596px'
                        ],
                        [
                            "eid218",
                            "left",
                            978,
                            522,
                            "easeOutQuad",
                            "${logo_03}",
                            '526px',
                            '396px'
                        ],
                        [
                            "eid221",
                            "left",
                            2500,
                            500,
                            "easeOutQuad",
                            "${logo_03}",
                            '396px',
                            '526px'
                        ],
                        [
                            "eid252",
                            "opacity",
                            6100,
                            650,
                            "easeOutQuad",
                            "${frase_final_07}",
                            '0',
                            '1'
                        ],
                        [
                            "eid255",
                            "opacity",
                            5916,
                            650,
                            "easeOutQuad",
                            "${frase_final_04}",
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
                            rect: ['0px', '0px', '480px', '300px', 'auto', 'auto'],
                            id: 'Rectangle',
                            stroke: [0, 'rgb(0, 0, 0)', 'none'],
                            type: 'rect',
                            fill: ['rgba(192,192,192,0.00)']
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

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("unionlayer/pichincha/union_layer_edgeActions.js");
})("EDGE-28231535");
