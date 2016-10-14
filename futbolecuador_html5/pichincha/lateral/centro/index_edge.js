/*jslint */
/*global AdobeEdge: false, window: false, document: false, console:false, alert: false */
(function (compId) {

    "use strict";
    var im='images/',
        aud='media/',
        vid='media/',
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
                            id: 'fondo',
                            type: 'image',
                            rect: ['20px', '0px', '120px', '600px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"fondo.jpg",'0px','0px']
                        },
                        {
                            id: 'jugador1_15',
                            type: 'image',
                            rect: ['20px', '194px', '120px', '406px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"jugador1_15.jpg",'0px','0px']
                        },
                        {
                            id: 'frase1_07',
                            type: 'image',
                            rect: ['-142px', '106px', '96px', '18px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"frase1_07.png",'0px','0px']
                        },
                        {
                            id: 'frase1_09',
                            type: 'image',
                            rect: ['-142px', '131px', '65px', '19px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"frase1_09.png",'0px','0px']
                        },
                        {
                            id: 'frase1_12',
                            type: 'image',
                            rect: ['-145px', '155px', '79px', '18px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"frase1_12.png",'0px','0px']
                        },
                        {
                            id: 'frase1_04',
                            type: 'image',
                            rect: ['-142px', '73px', '96px', '19px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"frase1_04.png",'0px','0px']
                        },
                        {
                            id: 'logo_01',
                            type: 'image',
                            rect: ['20px', '0px', '120px', '47px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"logo_01.jpg",'0px','0px']
                        },
                        {
                            id: 'juagador2_02',
                            type: 'image',
                            rect: ['20px', '180px', '120px', '307px', 'auto', 'auto'],
                            opacity: '0',
                            fill: ["rgba(0,0,0,0)",im+"juagador2_02.jpg",'0px','0px']
                        },
                        {
                            id: 'Rectangle',
                            type: 'rect',
                            rect: ['20px', '487px', '120px', '113px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,1.00)"],
                            stroke: [0,"rgba(0,0,0,1)","none"]
                        },
                        {
                            id: 'final_frase_03',
                            type: 'image',
                            rect: ['35px', '98px', '94px', '22px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"final_frase_03.png",'0px','0px']
                        },
                        {
                            id: 'final_frase_05',
                            type: 'image',
                            rect: ['34px', '125px', '94px', '24px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"final_frase_05.png",'0px','0px']
                        },
                        {
                            id: 'final_frase_07',
                            type: 'image',
                            rect: ['37px', '493px', '94px', '18px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"final_frase_07.png",'0px','0px']
                        },
                        {
                            id: 'final_frase_08',
                            type: 'image',
                            rect: ['37px', '510px', '94px', '19px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"final_frase_08.png",'0px','0px']
                        },
                        {
                            id: 'final_frase_09',
                            type: 'image',
                            rect: ['37px', '528px', '94px', '18px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"final_frase_09.png",'0px','0px']
                        },
                        {
                            id: 'final_frase_12',
                            type: 'image',
                            rect: ['38px', '548px', '87px', '41px', 'auto', 'auto'],
                            fill: ["rgba(0,0,0,0)",im+"final_frase_12.png",'0px','0px']
                        },
                        {
                            id: 'Rectangle2',
                            type: 'rect',
                            rect: ['21px', '0px', '120px', '600px', 'auto', 'auto'],
                            cursor: 'pointer',
                            fill: ["rgba(0,0,0,0.00)"],
                            stroke: [0,"rgb(0, 0, 0)","none"]
                        },
                        {
                            id: 'tapa',
                            type: 'rect',
                            rect: ['-20px', '0px', '40px', '600px', 'auto', 'auto'],
                            fill: ["rgba(255,255,255,1.00)"],
                            stroke: [0,"rgba(0,0,0,1)","none"]
                        },
                        {
                            id: 'tapa2',
                            type: 'rect',
                            rect: ['140px', '0px', '40px', '600px', 'auto', 'auto'],
                            fill: ["rgba(255,255,255,1.00)"],
                            stroke: [0,"rgba(0,0,0,1)","none"]
                        }
                    ],
                    style: {
                        '${Stage}': {
                            isStage: true,
                            rect: ['null', 'null', '160px', '600px', 'auto', 'auto'],
                            overflow: 'hidden',
                            fill: ["rgba(255,255,255,1)"]
                        }
                    }
                },
                timeline: {
                    duration: 5000,
                    autoPlay: true,
                    data: [
                        [
                            "eid31",
                            "left",
                            1208,
                            250,
                            "easeOutBack",
                            "${frase1_07}",
                            '-142px',
                            '33px'
                        ],
                        [
                            "eid43",
                            "left",
                            3687,
                            250,
                            "easeInBack",
                            "${frase1_07}",
                            '33px',
                            '205px'
                        ],
                        [
                            "eid33",
                            "left",
                            1250,
                            250,
                            "easeOutBack",
                            "${frase1_09}",
                            '-142px',
                            '33px'
                        ],
                        [
                            "eid44",
                            "left",
                            3607,
                            250,
                            "easeInBack",
                            "${frase1_09}",
                            '33px',
                            '205px'
                        ],
                        [
                            "eid67",
                            "left",
                            4750,
                            250,
                            "easeOutBack",
                            "${final_frase_12}",
                            '-163px',
                            '38px'
                        ],
                        [
                            "eid74",
                            "left",
                            0,
                            0,
                            "linear",
                            "${fondo}",
                            '20px',
                            '20px'
                        ],
                        [
                            "eid4",
                            "opacity",
                            750,
                            500,
                            "easeOutQuint",
                            "${jugador1_15}",
                            '0',
                            '1'
                        ],
                        [
                            "eid46",
                            "opacity",
                            1250,
                            0,
                            "easeInBack",
                            "${jugador1_15}",
                            '1',
                            '1'
                        ],
                        [
                            "eid47",
                            "opacity",
                            3750,
                            338,
                            "easeInBack",
                            "${jugador1_15}",
                            '1',
                            '0'
                        ],
                        [
                            "eid2",
                            "opacity",
                            0,
                            750,
                            "linear",
                            "${fondo}",
                            '0',
                            '1'
                        ],
                        [
                            "eid76",
                            "left",
                            4088,
                            0,
                            "linear",
                            "${juagador2_02}",
                            '20px',
                            '20px'
                        ],
                        [
                            "eid68",
                            "left",
                            4582,
                            250,
                            "easeOutBack",
                            "${final_frase_07}",
                            '-164px',
                            '37px'
                        ],
                        [
                            "eid66",
                            "left",
                            4714,
                            250,
                            "easeOutBack",
                            "${final_frase_09}",
                            '-164px',
                            '37px'
                        ],
                        [
                            "eid65",
                            "left",
                            4633,
                            250,
                            "easeOutBack",
                            "${final_frase_08}",
                            '-164px',
                            '37px'
                        ],
                        [
                            "eid64",
                            "left",
                            4537,
                            250,
                            "easeOutBack",
                            "${final_frase_05}",
                            '-167px',
                            '34px'
                        ],
                        [
                            "eid56",
                            "top",
                            4049,
                            0,
                            "linear",
                            "${Rectangle}",
                            '487px',
                            '487px'
                        ],
                        [
                            "eid63",
                            "left",
                            4500,
                            250,
                            "easeOutBack",
                            "${final_frase_03}",
                            '-166px',
                            '35px'
                        ],
                        [
                            "eid69",
                            "top",
                            4088,
                            0,
                            "linear",
                            "${juagador2_02}",
                            '180px',
                            '180px'
                        ],
                        [
                            "eid36",
                            "left",
                            1458,
                            250,
                            "easeOutBack",
                            "${logo_01}",
                            '-178px',
                            '20px'
                        ],
                        [
                            "eid34",
                            "left",
                            1391,
                            250,
                            "easeOutBack",
                            "${frase1_04}",
                            '-142px',
                            '33px'
                        ],
                        [
                            "eid41",
                            "left",
                            3500,
                            250,
                            "easeInBack",
                            "${frase1_04}",
                            '33px',
                            '205px'
                        ],
                        [
                            "eid75",
                            "left",
                            750,
                            0,
                            "linear",
                            "${jugador1_15}",
                            '20px',
                            '20px'
                        ],
                        [
                            "eid54",
                            "left",
                            4049,
                            318,
                            "easeOutQuint",
                            "${Rectangle}",
                            '-149px',
                            '20px'
                        ],
                        [
                            "eid32",
                            "left",
                            1321,
                            250,
                            "easeOutBack",
                            "${frase1_12}",
                            '-145px',
                            '30px'
                        ],
                        [
                            "eid42",
                            "left",
                            3540,
                            250,
                            "easeInBack",
                            "${frase1_12}",
                            '30px',
                            '202px'
                        ],
                        [
                            "eid52",
                            "opacity",
                            4088,
                            449,
                            "linear",
                            "${juagador2_02}",
                            '0',
                            '1'
                        ]
                    ]
                }
            }
        };

    AdobeEdge.registerCompositionDefn(compId, symbols, fonts, scripts, resources, opts);

    if (!window.edge_authoring_mode) AdobeEdge.getComposition(compId).load("index_edgeActions.js");
})("EDGE-7014516");
