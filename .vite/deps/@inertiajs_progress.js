import {
  require_nprogress
} from "./chunk-AXSH7MDO.js";
import {
  __commonJS
} from "./chunk-UXIASGQL.js";

// node_modules/@inertiajs/progress/dist/index.js
var require_dist = __commonJS({
  "node_modules/@inertiajs/progress/dist/index.js"(exports) {
    var n;
    var e = (n = require_nprogress()) && "object" == typeof n && "default" in n ? n.default : n;
    var t = null;
    function r(n2) {
      document.addEventListener("inertia:start", o.bind(null, n2)), document.addEventListener("inertia:progress", i), document.addEventListener("inertia:finish", s);
    }
    function o(n2) {
      t = setTimeout(function() {
        return e.start();
      }, n2);
    }
    function i(n2) {
      e.isStarted() && n2.detail.progress.percentage && e.set(Math.max(e.status, n2.detail.progress.percentage / 100 * 0.9));
    }
    function s(n2) {
      clearTimeout(t), e.isStarted() && (n2.detail.visit.completed ? e.done() : n2.detail.visit.interrupted ? e.set(0) : n2.detail.visit.cancelled && (e.done(), e.remove()));
    }
    exports.InertiaProgress = { init: function(n2) {
      var t2 = void 0 === n2 ? {} : n2, o2 = t2.delay, i2 = t2.color, s2 = void 0 === i2 ? "#29d" : i2, a = t2.includeCSS, p = void 0 === a || a, d = t2.showSpinner, l = void 0 !== d && d;
      r(void 0 === o2 ? 250 : o2), e.configure({ showSpinner: l }), p && function(n3) {
        var e2 = document.createElement("style");
        e2.type = "text/css", e2.textContent = "\n    #nprogress {\n      pointer-events: none;\n    }\n\n    #nprogress .bar {\n      background: " + n3 + ";\n\n      position: fixed;\n      z-index: 1031;\n      top: 0;\n      left: 0;\n\n      width: 100%;\n      height: 2px;\n    }\n\n    #nprogress .peg {\n      display: block;\n      position: absolute;\n      right: 0px;\n      width: 100px;\n      height: 100%;\n      box-shadow: 0 0 10px " + n3 + ", 0 0 5px " + n3 + ";\n      opacity: 1.0;\n\n      -webkit-transform: rotate(3deg) translate(0px, -4px);\n          -ms-transform: rotate(3deg) translate(0px, -4px);\n              transform: rotate(3deg) translate(0px, -4px);\n    }\n\n    #nprogress .spinner {\n      display: block;\n      position: fixed;\n      z-index: 1031;\n      top: 15px;\n      right: 15px;\n    }\n\n    #nprogress .spinner-icon {\n      width: 18px;\n      height: 18px;\n      box-sizing: border-box;\n\n      border: solid 2px transparent;\n      border-top-color: " + n3 + ";\n      border-left-color: " + n3 + ";\n      border-radius: 50%;\n\n      -webkit-animation: nprogress-spinner 400ms linear infinite;\n              animation: nprogress-spinner 400ms linear infinite;\n    }\n\n    .nprogress-custom-parent {\n      overflow: hidden;\n      position: relative;\n    }\n\n    .nprogress-custom-parent #nprogress .spinner,\n    .nprogress-custom-parent #nprogress .bar {\n      position: absolute;\n    }\n\n    @-webkit-keyframes nprogress-spinner {\n      0%   { -webkit-transform: rotate(0deg); }\n      100% { -webkit-transform: rotate(360deg); }\n    }\n    @keyframes nprogress-spinner {\n      0%   { transform: rotate(0deg); }\n      100% { transform: rotate(360deg); }\n    }\n  ", document.head.appendChild(e2);
      }(s2);
    } };
  }
});
export default require_dist();
//# sourceMappingURL=@inertiajs_progress.js.map
