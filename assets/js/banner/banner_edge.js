/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='images/';

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
                opacity: 0,
                fill: ["rgba(192,192,192,1)"],
                stroke: [0,"rgb(0, 0, 0)","none"]
            }],
            symbolInstances: [

            ]
        },
    states: {
        "Base State": {
            "${_Stage}": [
                ["color", "background-color", 'rgba(255,255,255,1)'],
                ["style", "width", '100%'],
                ["style", "height", '450px'],
                ["style", "overflow", 'hidden']
            ],
            "${_Rectangle}": [
                ["style", "height", '50px'],
                ["style", "width", '100%']
            ],
            "${_RectangleCopy}": [
                ["style", "height", '450px'],
                ["style", "opacity", '0'],
                ["style", "left", '-348px'],
                ["style", "width", '340px']
            ],
            "${_Rectangle2}": [
                ["style", "top", '1px'],
                ["style", "opacity", '0']
            ]
        }
    },
    timelines: {
        "Default Timeline": {
            fromState: "Base State",
            toState: "",
            duration: 2000,
            autoPlay: true,
            labels: {
                "play": 322,
                "atras": 1438
            },
            timeline: [
                { id: "eid4", tween: [ "style", "${_RectangleCopy}", "height", '450px', { fromValue: '450px'}], position: 1313, duration: 0 },
                { id: "eid12", tween: [ "style", "${_Rectangle2}", "top", '-70px', { fromValue: '1px'}], position: 1250, duration: 63 },
                { id: "eid9", tween: [ "style", "${_RectangleCopy}", "left", '1px', { fromValue: '-348px'}], position: 1223, duration: 0 },
                { id: "eid8", tween: [ "style", "${_RectangleCopy}", "left", '1px', { fromValue: '1px'}], position: 1313, duration: 0 },
                { id: "eid5", tween: [ "style", "${_RectangleCopy}", "opacity", '0', { fromValue: '0'}], position: 1313, duration: 0 },
                { id: "eid2", tween: [ "style", "${_Rectangle}", "height", '450px', { fromValue: '50px'}], position: 322, duration: 589 },
                { id: "eid1", tween: [ "style", "${_Rectangle}", "height", '50px', { fromValue: '450px'}], position: 1438, duration: 562 }            ]
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
