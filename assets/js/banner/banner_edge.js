/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='http://new.futbolecuador.com/futec/images/';

var fonts = {};
var opts = {
    'gAudioPreloadPreference': 'auto',

    'gVideoPreloadPreference': 'auto'
};
var resources = [
];
var symbols = {
"stage": {
    version: "4.0.0",
    minimumCompatibleVersion: "4.0.0",
    build: "4.0.0.359",
    baseState: "Base State",
    scaleToFit: "none",
    centerStage: "none",
    initialState: "Base State",
    gpuAccelerate: false,
    resizeInstances: false,
    content: {
            dom: [
            {
                id: 'Rectangle',
                type: 'rect',
                rect: ['1px', '0px','100%','450px','auto', 'auto'],
                fill: ["rgba(192,192,192,1)"],
                stroke: [0,"rgba(0,0,0,1)","none"]
            },
            {
                id: 'replegado',
                type: 'rect',
                rect: ['0', '0','auto','auto','auto', 'auto']
            },
            {
                id: '_8',
                type: 'image',
                rect: ['10px', '12px','320px','426px','auto', 'auto'],
                fill: ["rgba(0,0,0,0)",im+"8.jpg",'0px','0px']
            },
            {
                id: 'RectangleCopy',
                type: 'rect',
                rect: ['1px', '0px','340px','450px','auto', 'auto'],
                fill: ["rgba(192,192,192,1)"],
                stroke: [0,"rgba(0,0,0,1)","none"]
            },
            {
                id: 'Rectangle2',
                type: 'rect',
                rect: ['1px', '1px','355px','50px','auto', 'auto'],
                fill: ["rgba(192,192,192,1)"],
                stroke: [0,"rgb(0, 0, 0)","none"]
            }],
            symbolInstances: [
            {
                id: 'replegado',
                symbolName: 'replegado',
                autoPlay: {

                }
            }
            ]
        },
    states: {
        "Base State": {
            "${_Rectangle2}": [
                ["style", "top", '1px'],
                ["style", "opacity", '0']
            ],
            "${_RectangleCopy}": [
                ["style", "height", '450px'],
                ["style", "opacity", '0'],
                ["style", "left", '-348px'],
                ["style", "width", '340px']
            ],
            "${__8}": [
                ["style", "top", '12px'],
                ["style", "opacity", '0'],
                ["style", "left", '10px']
            ],
            "${_Stage}": [
                ["color", "background-color", 'rgba(255,255,255,1)'],
                ["style", "width", '100%'],
                ["style", "height", '450px'],
                ["style", "overflow", 'hidden']
            ],
            "${_Rectangle}": [
                ["color", "background-color", 'rgba(11,30,96,1.00)'],
                ["style", "height", '50px'],
                ["style", "left", '0px'],
                ["style", "width", '100%']
            ],
            "${_replegado}": [
                ["style", "opacity", '1']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 9034,
            autoPlay: true,
            labels: {
                "inicio": 0,
                "play": 1072,
                "atras": 2188
            },
            timeline: [
                { id: "eid4", tween: [ "style", "${_RectangleCopy}", "height", '450px', { fromValue: '450px'}], position: 1313, duration: 0 },
                { id: "eid50", tween: [ "style", "${_replegado}", "opacity", '0', { fromValue: '1'}], position: 1072, duration: 428 },
                { id: "eid13", tween: [ "color", "${_Rectangle}", "background-color", 'rgba(11,30,96,1.00)', { animationColorSpace: 'RGB', valueTemplate: undefined, fromValue: 'rgba(11,30,96,1.00)'}], position: 0, duration: 0 },
                { id: "eid12", tween: [ "style", "${_Rectangle2}", "top", '-70px', { fromValue: '1px'}], position: 2000, duration: 63 },
                { id: "eid9", tween: [ "style", "${_RectangleCopy}", "left", '1px', { fromValue: '-348px'}], position: 1223, duration: 0 },
                { id: "eid8", tween: [ "style", "${_RectangleCopy}", "left", '1px', { fromValue: '1px'}], position: 1313, duration: 0 },
                { id: "eid52", tween: [ "style", "${__8}", "opacity", '1', { fromValue: '0'}], position: 1624, duration: 376 },
                { id: "eid53", tween: [ "style", "${__8}", "opacity", '0', { fromValue: '1'}], position: 2188, duration: 377 },
                { id: "eid2", tween: [ "style", "${_Rectangle}", "height", '450px', { fromValue: '50px'}], position: 1072, duration: 589 },
                { id: "eid1", tween: [ "style", "${_Rectangle}", "height", '50px', { fromValue: '450px'}], position: 2500, duration: 562 },
                { id: "eid5", tween: [ "style", "${_RectangleCopy}", "opacity", '0', { fromValue: '0'}], position: 1313, duration: 0 },
                { id: "eid14", tween: [ "style", "${_Rectangle}", "left", '0px', { fromValue: '0px'}], position: 0, duration: 0 }            ]
        }
    }
},
"replegado": {
    version: "4.0.0",
    minimumCompatibleVersion: "4.0.0",
    build: "4.0.0.359",
    baseState: "Base State",
    scaleToFit: "none",
    centerStage: "none",
    initialState: "Base State",
    gpuAccelerate: false,
    resizeInstances: false,
    content: {
            dom: [
                {
                    id: '_7',
                    type: 'image',
                    rect: ['0px', '0px', '320px', '50px', 'auto', 'auto'],
                    fill: ['rgba(0,0,0,0)', 'http://new.futbolecuador.com/futec/images/7.png', '0px', '0px']
                },
                {
                    id: '_6',
                    type: 'image',
                    rect: ['0px', '0px', '320px', '50px', 'auto', 'auto'],
                    fill: ['rgba(0,0,0,0)', 'http://new.futbolecuador.com/futec/images/6.png', '0px', '0px']
                },
                {
                    id: '_5',
                    type: 'image',
                    rect: ['246px', '0px', '55px', '50px', 'auto', 'auto'],
                    fill: ['rgba(0,0,0,0)', 'http://new.futbolecuador.com/futec/images/5.png', '0px', '0px']
                },
                {
                    id: '_4',
                    type: 'image',
                    rect: ['27px', '0px', '136px', '50px', 'auto', 'auto'],
                    fill: ['rgba(0,0,0,0)', 'http://new.futbolecuador.com/futec/images/4.png', '0px', '0px']
                },
                {
                    id: '_3',
                    type: 'image',
                    rect: ['281px', '0px', '39px', '50px', 'auto', 'auto'],
                    fill: ['rgba(0,0,0,0)', 'http://new.futbolecuador.com/futec/images/3.png', '0px', '0px']
                },
                {
                    id: '_2',
                    type: 'image',
                    rect: ['114px', '0px', '141px', '50px', 'auto', 'auto'],
                    fill: ['rgba(0,0,0,0)', 'http://new.futbolecuador.com/futec/images/2.png', '0px', '0px']
                },
                {
                    id: '_1',
                    type: 'image',
                    rect: ['0px', '0px', '95px', '50px', 'auto', 'auto'],
                    fill: ['rgba(0,0,0,0)', 'http://new.futbolecuador.com/futec/images/1.png', '0px', '0px']
                }
            ],
            symbolInstances: [
            ]
        },
    states: {
        "Base State": {
            "${__7}": [
                ["style", "top", '0px'],
                ["style", "opacity", '0'],
                ["style", "left", '0px']
            ],
            "${__1}": [
                ["style", "top", '0px'],
                ["style", "opacity", '0'],
                ["style", "left", '0px']
            ],
            "${__2}": [
                ["style", "top", '0px'],
                ["style", "opacity", '0'],
                ["style", "left", '114px']
            ],
            "${__4}": [
                ["style", "top", '0px'],
                ["style", "opacity", '0'],
                ["style", "left", '27px']
            ],
            "${__3}": [
                ["style", "top", '0px'],
                ["style", "opacity", '0'],
                ["style", "left", '281px']
            ],
            "${symbolSelector}": [
                ["style", "height", '50px'],
                ["style", "width", '320px']
            ],
            "${__6}": [
                ["style", "top", '0px'],
                ["style", "opacity", '0'],
                ["style", "left", '0px']
            ],
            "${__5}": [
                ["style", "top", '0px'],
                ["style", "opacity", '0'],
                ["style", "left", '246px']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 9034,
            autoPlay: true,
            timeline: [
                { id: "eid39", tween: [ "style", "${__5}", "opacity", '1', { fromValue: '0'}], position: 2325, duration: 297 },
                { id: "eid42", tween: [ "style", "${__5}", "opacity", '0', { fromValue: '1'}], position: 4325, duration: 388 },
                { id: "eid41", tween: [ "style", "${__4}", "opacity", '1', { fromValue: '0'}], position: 2453, duration: 297 },
                { id: "eid43", tween: [ "style", "${__4}", "opacity", '0', { fromValue: '1'}], position: 4112, duration: 388 },
                { id: "eid48", tween: [ "style", "${__7}", "opacity", '1', { fromValue: '0'}], position: 6750, duration: 381 },
                { id: "eid49", tween: [ "style", "${__7}", "opacity", '0', { fromValue: '1'}], position: 8697, duration: 337 },
                { id: "eid32", tween: [ "style", "${__1}", "opacity", '1', { fromValue: '0'}], position: 0, duration: 391 },
                { id: "eid37", tween: [ "style", "${__1}", "opacity", '0', { fromValue: '1'}], position: 2250, duration: 325 },
                { id: "eid30", tween: [ "style", "${__3}", "opacity", '1', { fromValue: '0'}], position: 250, duration: 391 },
                { id: "eid35", tween: [ "style", "${__3}", "opacity", '0', { fromValue: '1'}], position: 2000, duration: 325 },
                { id: "eid45", tween: [ "style", "${__6}", "opacity", '1', { fromValue: '0'}], position: 4553, duration: 381 },
                { id: "eid46", tween: [ "style", "${__6}", "opacity", '0', { fromValue: '0.999190'}], position: 6500, duration: 337 },
                { id: "eid34", tween: [ "style", "${__2}", "opacity", '1', { fromValue: '0'}], position: 109, duration: 391 },
                { id: "eid36", tween: [ "style", "${__2}", "opacity", '0', { fromValue: '1'}], position: 2128, duration: 325 }            ]
        }
    }
}
};


Edge.registerCompositionDefn(compId, symbols, fonts, resources, opts);

/**
 * Adobe Edge DOM Ready Event Handler
 */
$(window).ready(function() {
     Edge.launchComposition(compId);
});
})(jQuery, AdobeEdge, "EDGE-3751729");
