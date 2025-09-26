/*
 almond 0.3.3 Copyright jQuery Foundation and other contributors.
 Released under MIT license, http://github.com/requirejs/almond/LICENSE
*/
(function (a, l) {
    function e(a) { var b = a.length, g = n.type(a); return n.isWindow(a) ? !1 : 1 === a.nodeType && b ? !0 : "array" === g || "function" !== g && (0 === b || "number" === typeof b && 0 < b && b - 1 in a) } function h(a) { var b = gb[a] = {}; n.each(a.match(oa) || [], function (a, g) { b[g] = !0 }); return b } function c(a, b, g, c) {
        if (n.acceptData(a)) {
            var f = n.expando, d = "string" === typeof b, m = a.nodeType, k = m ? n.cache : a, q = m ? a[f] : a[f] && f; if (q && k[q] && (c || k[q].data) || !d || g !== l) {
                q || (m ? a[f] = q = P.pop() || n.guid++ : q = f); k[q] || (k[q] = {}, m || (k[q].toJSON = n.noop)); if ("object" ===
                    typeof b || "function" === typeof b) c ? k[q] = n.extend(k[q], b) : k[q].data = n.extend(k[q].data, b); a = k[q]; c || (a.data || (a.data = {}), a = a.data); g !== l && (a[n.camelCase(b)] = g); d ? (g = a[b], null == g && (g = a[n.camelCase(b)])) : g = a; return g
            }
        }
    } function d(a, b, g) {
        if (n.acceptData(a)) {
            var c, d, m, k = a.nodeType, q = k ? n.cache : a, h = k ? a[n.expando] : n.expando; if (q[h]) {
                if (b && (m = g ? q[h] : q[h].data)) {
                    n.isArray(b) ? b = b.concat(n.map(b, n.camelCase)) : b in m ? b = [b] : (b = n.camelCase(b), b = b in m ? [b] : b.split(" ")); c = 0; for (d = b.length; c < d; c++)delete m[b[c]]; if (!(g ?
                        f : n.isEmptyObject)(m)) return
                } if (!g && (delete q[h].data, !f(q[h]))) return; k ? n.cleanData([a], !0) : n.support.deleteExpando || q != q.window ? delete q[h] : q[h] = null
            }
        }
    } function b(a, b, g) { if (g === l && 1 === a.nodeType) if (g = "data-" + b.replace(vb, "-$1").toLowerCase(), g = a.getAttribute(g), "string" === typeof g) { try { g = "true" === g ? !0 : "false" === g ? !1 : "null" === g ? null : +g + "" === g ? +g : qb.test(g) ? n.parseJSON(g) : g } catch (c) { } n.data(a, b, g) } else g = l; return g } function f(a) {
        for (var b in a) if (("data" !== b || !n.isEmptyObject(a[b])) && "toJSON" !== b) return !1;
        return !0
    } function m() { return !0 } function k() { return !1 } function r(a, b) { do a = a[b]; while (a && 1 !== a.nodeType); return a } function z(a, b, g) { b = b || 0; if (n.isFunction(b)) return n.grep(a, function (a, c) { return !!b.call(a, c, a) === g }); if (b.nodeType) return n.grep(a, function (a) { return a === b === g }); if ("string" === typeof b) { var c = n.grep(a, function (a) { return 1 === a.nodeType }); if (Vb.test(b)) return n.filter(b, c, !g); b = n.filter(b, c) } return n.grep(a, function (a) { return 0 <= n.inArray(a, b) === g }) } function t(a) {
        var b = Ib.split("|"); a = a.createDocumentFragment();
        if (a.createElement) for (; b.length;)a.createElement(b.pop()); return a
    } function s(a) { var b = a.getAttributeNode("type"); a.type = (b && b.specified) + "/" + a.type; return a } function v(a) { var b = Ua.exec(a.type); b ? a.type = b[1] : a.removeAttribute("type"); return a } function y(a, b) { for (var g, c = 0; null != (g = a[c]); c++)n._data(g, "globalEval", !b || n._data(b[c], "globalEval")) } function g(a, b) {
        if (1 === b.nodeType && n.hasData(a)) {
            var g, c, f; c = n._data(a); var d = n._data(b, c), m = c.events; if (m) for (g in delete d.handle, d.events = {}, m) for (c = 0,
                f = m[g].length; c < f; c++)n.event.add(b, g, m[g][c]); d.data && (d.data = n.extend({}, d.data))
        }
    } function u(a, b) { var g, c, f = 0, d = typeof a.getElementsByTagName !== G ? a.getElementsByTagName(b || "*") : typeof a.querySelectorAll !== G ? a.querySelectorAll(b || "*") : l; if (!d) for (d = [], g = a.childNodes || a; null != (c = g[f]); f++)!b || n.nodeName(c, b) ? d.push(c) : n.merge(d, u(c, b)); return b === l || b && n.nodeName(a, b) ? n.merge([a], d) : d } function q(a) { wb.test(a.type) && (a.defaultChecked = a.checked) } function w(a, b) {
        if (b in a) return b; for (var g = b.charAt(0).toUpperCase() +
            b.slice(1), c = b, f = na.length; f--;)if (b = na[f] + g, b in a) return b; return c
    } function x(a, b) { a = b || a; return "none" === n.css(a, "display") || !n.contains(a.ownerDocument, a) } function D(a, b) {
        for (var g, c, f, d = [], m = 0, k = a.length; m < k; m++)c = a[m], c.style && (d[m] = n._data(c, "olddisplay"), g = c.style.display, b ? (d[m] || "none" !== g || (c.style.display = ""), "" === c.style.display && x(c) && (d[m] = n._data(c, "olddisplay", O(c.nodeName)))) : d[m] || (f = x(c), (g && "none" !== g || !f) && n._data(c, "olddisplay", f ? g : n.css(c, "display")))); for (m = 0; m < k; m++)c = a[m],
            !c.style || b && "none" !== c.style.display && "" !== c.style.display || (c.style.display = b ? d[m] || "" : "none"); return a
    } function A(a, b, g) { return (a = Ka.exec(b)) ? Math.max(0, a[1] - (g || 0)) + (a[2] || "px") : b } function I(a, b, g, c, f) {
        b = g === (c ? "border" : "content") ? 4 : "width" === b ? 1 : 0; for (var d = 0; 4 > b; b += 2)"margin" === g && (d += n.css(a, g + xa[b], !0, f)), c ? ("content" === g && (d -= n.css(a, "padding" + xa[b], !0, f)), "margin" !== g && (d -= n.css(a, "border" + xa[b] + "Width", !0, f))) : (d += n.css(a, "padding" + xa[b], !0, f), "padding" !== g && (d += n.css(a, "border" + xa[b] +
            "Width", !0, f))); return d
    } function E(a, b, g) { var c = !0, f = "width" === b ? a.offsetWidth : a.offsetHeight, d = ka(a), m = n.support.boxSizing && "border-box" === n.css(a, "boxSizing", !1, d); if (0 >= f || null == f) { f = la(a, b, d); if (0 > f || null == f) f = a.style[b]; if (rb.test(f)) return f; c = m && (n.support.boxSizingReliable || f === a.style[b]); f = parseFloat(f) || 0 } return f + I(a, b, g || (m ? "border" : "content"), c, d) + "px" } function O(a) {
        var b = M, g = Jb[a]; g || (g = C(a, b), "none" !== g && g || (qa = (qa || n("\x3ciframe frameborder\x3d'0' width\x3d'0' height\x3d'0'/\x3e").css("cssText",
            "display:block !important")).appendTo(b.documentElement), b = (qa[0].contentWindow || qa[0].contentDocument).document, b.write("\x3c!doctype html\x3e\x3chtml\x3e\x3cbody\x3e"), b.close(), g = C(a, b), qa.detach()), Jb[a] = g); return g
    } function C(a, b) { var g = n(b.createElement(a)).appendTo(b.body), c = n.css(g[0], "display"); g.remove(); return c } function S(a, b, g, c) {
        var f; if (n.isArray(b)) n.each(b, function (b, f) { g || La.test(a) ? c(a, f) : S(a + "[" + ("object" === typeof f ? b : "") + "]", f, g, c) }); else if (g || "object" !== n.type(b)) c(a, b); else for (f in b) S(a +
            "[" + f + "]", b[f], g, c)
    } function B(a) { return function (b, g) { "string" !== typeof b && (g = b, b = "*"); var c, f = 0, d = b.toLowerCase().match(oa) || []; if (n.isFunction(g)) for (; c = d[f++];)"+" === c[0] ? (c = c.slice(1) || "*", (a[c] = a[c] || []).unshift(g)) : (a[c] = a[c] || []).push(g) } } function K(a, b, g, c) { function f(k) { var q; d[k] = !0; n.each(a[k] || [], function (a, k) { var fb = k(b, g, c); if ("string" === typeof fb && !m && !d[fb]) return b.dataTypes.unshift(fb), f(fb), !1; if (m) return !(q = fb) }); return q } var d = {}, m = a === Va; return f(b.dataTypes[0]) || !d["*"] && f("*") }
    function Y(a, b) { var g, c, f = n.ajaxSettings.flatOptions || {}; for (c in b) b[c] !== l && ((f[c] ? a : g || (g = {}))[c] = b[c]); g && n.extend(!0, a, g); return a } function F() { try { return new a.XMLHttpRequest } catch (b) { } } function T() { setTimeout(function () { Wa = l }); return Wa = n.now() } function U(a, b) { n.each(b, function (b, g) { for (var c = (hb[b] || []).concat(hb["*"]), f = 0, d = c.length; f < d && !c[f].call(a, b, g); f++); }) } function H(a, b, g) {
        var c, f = 0, d = sb.length, m = n.Deferred().always(function () { delete k.elem }), k = function () {
            if (c) return !1; for (var b =
                Wa || T(), b = Math.max(0, q.startTime + q.duration - b), g = 1 - (b / q.duration || 0), f = 0, d = q.tweens.length; f < d; f++)q.tweens[f].run(g); m.notifyWith(a, [q, g, b]); if (1 > g && d) return b; m.resolveWith(a, [q]); return !1
        }, q = m.promise({
            elem: a, props: n.extend({}, b), opts: n.extend(!0, { specialEasing: {} }, g), originalProperties: b, originalOptions: g, startTime: Wa || T(), duration: g.duration, tweens: [], createTween: function (b, g) { var c = n.Tween(a, q.opts, b, g, q.opts.specialEasing[b] || q.opts.easing); q.tweens.push(c); return c }, stop: function (b) {
                var g =
                    0, f = b ? q.tweens.length : 0; if (c) return this; for (c = !0; g < f; g++)q.tweens[g].run(1); b ? m.resolveWith(a, [q, b]) : m.rejectWith(a, [q, b]); return this
            }
        }); g = q.props; for (R(g, q.opts.specialEasing); f < d; f++)if (b = sb[f].call(q, a, g, q.opts)) return b; U(q, g); n.isFunction(q.opts.start) && q.opts.start.call(a, q); n.fx.timer(n.extend(k, { elem: a, anim: q, queue: q.opts.queue })); return q.progress(q.opts.progress).done(q.opts.done, q.opts.complete).fail(q.opts.fail).always(q.opts.always)
    } function R(a, b) {
        var g, c, f, d, m; for (f in a) if (c = n.camelCase(f),
            d = b[c], g = a[f], n.isArray(g) && (d = g[1], g = a[f] = g[0]), f !== c && (a[c] = g, delete a[f]), (m = n.cssHooks[c]) && "expand" in m) for (f in g = m.expand(g), delete a[c], g) f in a || (a[f] = g[f], b[f] = d); else b[c] = d
    } function N(a, b, g, c, f) { return new N.prototype.init(a, b, g, c, f) } function L(a, b) { var g, c = { height: a }, f = 0; for (b = b ? 1 : 0; 4 > f; f += 2 - b)g = xa[f], c["margin" + g] = c["padding" + g] = a; b && (c.opacity = c.width = a); return c } function ha(a) { return n.isWindow(a) ? a : 9 === a.nodeType ? a.defaultView || a.parentWindow : !1 } var ba, ca, G = typeof l, M = a.document,
        Q = a.location, V = a.jQuery, da = a.$, J = {}, P = [], X = P.concat, Z = P.push, W = P.slice, ia = P.indexOf, aa = J.toString, ua = J.hasOwnProperty, Ma = "1.9.1".trim, n = function (a, b) { return new n.fn.init(a, b, ca) }, va = /[+-]?(?:\d*\.|)\d+(?:[eE][+-]?\d+|)/.source, oa = /\S+/g, ja = /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, ea = /^(?:(<[\w\W]+>)[^>]*|#([\w-]*))$/, ya = /^<(\w+)\s*\/?>(?:<\/\1>|)$/, Oa = /^[\],:{}\s]*$/, za = /(?:^|:|,)(?:\s*\[)+/g, Sa = /\\(?:["\\\/bfnrt]|u[\da-fA-F]{4})/g, Da = /"[^"\\\r\n]*"|true|false|null|-?(?:\d+\.|)\d+(?:[eE][+-]?\d+|)/g,
        ra = /^-ms-/, Pa = /-([\da-z])/gi, fa = function (a, b) { return b.toUpperCase() }, ma = function (a) { if (M.addEventListener || "load" === a.type || "complete" === M.readyState) Qa(), n.ready() }, Qa = function () { M.addEventListener ? (M.removeEventListener("DOMContentLoaded", ma, !1), a.removeEventListener("load", ma, !1)) : (M.detachEvent("onreadystatechange", ma), a.detachEvent("onload", ma)) }; n.fn = n.prototype = {
            jquery: "1.9.1", constructor: n, init: function (a, b, g) {
                var c; if (!a) return this; if ("string" === typeof a) {
                    c = "\x3c" === a.charAt(0) && "\x3e" ===
                        a.charAt(a.length - 1) && 3 <= a.length ? [null, a, null] : ea.exec(a); if (!c || !c[1] && b) return !b || b.jquery ? (b || g).find(a) : this.constructor(b).find(a); if (c[1]) { if (b = b instanceof n ? b[0] : b, n.merge(this, n.parseHTML(c[1], b && b.nodeType ? b.ownerDocument || b : M, !0)), ya.test(c[1]) && n.isPlainObject(b)) for (c in b) if (n.isFunction(this[c])) this[c](b[c]); else this.attr(c, b[c]) } else { if ((b = M.getElementById(c[2])) && b.parentNode) { if (b.id !== c[2]) return g.find(a); this.length = 1; this[0] = b } this.context = M; this.selector = a } return this
                } if (a.nodeType) return this.context =
                    this[0] = a, this.length = 1, this; if (n.isFunction(a)) return g.ready(a); a.selector !== l && (this.selector = a.selector, this.context = a.context); return n.makeArray(a, this)
            }, selector: "", length: 0, size: function () { return this.length }, toArray: function () { return W.call(this) }, get: function (a) { return null == a ? this.toArray() : 0 > a ? this[this.length + a] : this[a] }, pushStack: function (a) { a = n.merge(this.constructor(), a); a.prevObject = this; a.context = this.context; return a }, each: function (a, b) { return n.each(this, a, b) }, ready: function (a) {
                n.ready.promise().done(a);
                return this
            }, slice: function () { return this.pushStack(W.apply(this, arguments)) }, first: function () { return this.eq(0) }, last: function () { return this.eq(-1) }, eq: function (a) { var b = this.length; a = +a + (0 > a ? b : 0); return this.pushStack(0 <= a && a < b ? [this[a]] : []) }, map: function (a) { return this.pushStack(n.map(this, function (b, g) { return a.call(b, g, b) })) }, end: function () { return this.prevObject || this.constructor(null) }, push: Z, sort: [].sort, splice: [].splice
        }; n.fn.init.prototype = n.fn; n.extend = n.fn.extend = function () {
            var a, b, g,
            c, f, d = arguments[0] || {}, m = 1, k = arguments.length, q = !1; "boolean" === typeof d && (q = d, d = arguments[1] || {}, m = 2); "object" === typeof d || n.isFunction(d) || (d = {}); k === m && (d = this, --m); for (; m < k; m++)if (null != (f = arguments[m])) for (c in f) a = d[c], g = f[c], d !== g && (q && g && (n.isPlainObject(g) || (b = n.isArray(g))) ? (b ? (b = !1, a = a && n.isArray(a) ? a : []) : a = a && n.isPlainObject(a) ? a : {}, d[c] = n.extend(q, a, g)) : g !== l && (d[c] = g)); return d
        }; n.extend({
            noConflict: function (b) { a.$ === n && (a.$ = da); b && a.jQuery === n && (a.jQuery = V); return n }, isReady: !1, readyWait: 1,
            holdReady: function (a) { a ? n.readyWait++ : n.ready(!0) }, ready: function (a) { if (!0 === a ? !--n.readyWait : !n.isReady) { if (!M.body) return setTimeout(n.ready); n.isReady = !0; !0 !== a && 0 < --n.readyWait || (ba.resolveWith(M, [n]), n.fn.trigger && n(M).trigger("ready").off("ready")) } }, isFunction: function (a) { return "function" === n.type(a) }, isArray: Array.isArray || function (a) { return "array" === n.type(a) }, isWindow: function (a) { return null != a && a == a.window }, isNumeric: function (a) { return !isNaN(parseFloat(a)) && isFinite(a) }, type: function (a) {
                return null ==
                    a ? String(a) : "object" === typeof a || "function" === typeof a ? J[aa.call(a)] || "object" : typeof a
            }, isPlainObject: function (a) { if (!a || "object" !== n.type(a) || a.nodeType || n.isWindow(a)) return !1; try { if (a.constructor && !ua.call(a, "constructor") && !ua.call(a.constructor.prototype, "isPrototypeOf")) return !1 } catch (b) { return !1 } for (var g in a); return g === l || ua.call(a, g) }, isEmptyObject: function (a) { for (var b in a) return !1; return !0 }, error: function (a) { throw Error(a); }, parseHTML: function (a, b, g) {
                if (!a || "string" !== typeof a) return null;
                "boolean" === typeof b && (g = b, b = !1); b = b || M; var c = ya.exec(a); g = !g && []; if (c) return [b.createElement(c[1])]; c = n.buildFragment([a], b, g); g && n(g).remove(); return n.merge([], c.childNodes)
            }, parseJSON: function (b) { if (a.JSON && a.JSON.parse) return a.JSON.parse(b); if (null === b) return b; if ("string" === typeof b && (b = n.trim(b)) && Oa.test(b.replace(Sa, "@").replace(Da, "]").replace(za, ""))) return (new Function("return " + b))(); n.error("Invalid JSON: " + b) }, parseXML: function (b) {
                var g, c; if (!b || "string" !== typeof b) return null; try {
                    a.DOMParser ?
                    (c = new DOMParser, g = c.parseFromString(b, "text/xml")) : (g = new ActiveXObject("Microsoft.XMLDOM"), g.async = "false", g.loadXML(b))
                } catch (f) { g = l } g && g.documentElement && !g.getElementsByTagName("parsererror").length || n.error("Invalid XML: " + b); return g
            }, noop: function () { }, globalEval: function (b) { b && n.trim(b) && (a.execScript || function (b) { a.eval.call(a, b) })(b) }, camelCase: function (a) { return a.replace(ra, "ms-").replace(Pa, fa) }, nodeName: function (a, b) { return a.nodeName && a.nodeName.toLowerCase() === b.toLowerCase() }, each: function (a,
                b, g) { var c, f = 0, d = a.length; c = e(a); if (g) if (c) for (; f < d && (c = b.apply(a[f], g), !1 !== c); f++); else for (f in a) { if (c = b.apply(a[f], g), !1 === c) break } else if (c) for (; f < d && (c = b.call(a[f], f, a[f]), !1 !== c); f++); else for (f in a) if (c = b.call(a[f], f, a[f]), !1 === c) break; return a }, trim: Ma && !Ma.call("\ufeff ") ? function (a) { return null == a ? "" : Ma.call(a) } : function (a) { return null == a ? "" : (a + "").replace(ja, "") }, makeArray: function (a, b) { var g = b || []; null != a && (e(Object(a)) ? n.merge(g, "string" === typeof a ? [a] : a) : Z.call(g, a)); return g }, inArray: function (a,
                    b, g) { var c; if (b) { if (ia) return ia.call(b, a, g); c = b.length; for (g = g ? 0 > g ? Math.max(0, c + g) : g : 0; g < c; g++)if (g in b && b[g] === a) return g } return -1 }, merge: function (a, b) { var g = b.length, c = a.length, f = 0; if ("number" === typeof g) for (; f < g; f++)a[c++] = b[f]; else for (; b[f] !== l;)a[c++] = b[f++]; a.length = c; return a }, grep: function (a, b, g) { var c, f = [], d = 0, m = a.length; for (g = !!g; d < m; d++)c = !!b(a[d], d), g !== c && f.push(a[d]); return f }, map: function (a, b, g) {
                        var c, f = 0, d = a.length, m = []; if (e(a)) for (; f < d; f++)c = b(a[f], f, g), null != c && (m[m.length] = c);
                        else for (f in a) c = b(a[f], f, g), null != c && (m[m.length] = c); return X.apply([], m)
                    }, guid: 1, proxy: function (a, b) { var g, c; "string" === typeof b && (c = a[b], b = a, a = c); if (!n.isFunction(a)) return l; g = W.call(arguments, 2); c = function () { return a.apply(b || this, g.concat(W.call(arguments))) }; c.guid = a.guid = a.guid || n.guid++; return c }, access: function (a, b, g, c, f, d, m) {
                        var k = 0, q = a.length, h = null == g; if ("object" === n.type(g)) for (k in f = !0, g) n.access(a, b, k, g[k], !0, d, m); else if (c !== l && (f = !0, n.isFunction(c) || (m = !0), h && (m ? (b.call(a, c), b =
                            null) : (h = b, b = function (a, b, g) { return h.call(n(a), g) })), b)) for (; k < q; k++)b(a[k], g, m ? c : c.call(a[k], k, b(a[k], g))); return f ? a : h ? b.call(a) : q ? b(a[0], g) : d
                    }, now: function () { return (new Date).getTime() }
        }); n.ready.promise = function (b) {
            if (!ba) if (ba = n.Deferred(), "complete" === M.readyState) setTimeout(n.ready); else if (M.addEventListener) M.addEventListener("DOMContentLoaded", ma, !1), a.addEventListener("load", ma, !1); else {
                M.attachEvent("onreadystatechange", ma); a.attachEvent("onload", ma); var g = !1; try {
                    g = null == a.frameElement &&
                    M.documentElement
                } catch (c) { } g && g.doScroll && function Ub() { if (!n.isReady) { try { g.doScroll("left") } catch (a) { return setTimeout(Ub, 50) } Qa(); n.ready() } }()
            } return ba.promise(b)
        }; n.each("Boolean Number String Function Array Date RegExp Object Error".split(" "), function (a, b) { J["[object " + b + "]"] = b.toLowerCase() }); ca = n(M); var gb = {}; n.Callbacks = function (a) {
            a = "string" === typeof a ? gb[a] || h(a) : n.extend({}, a); var b, g, c, f, d, m, k = [], q = !a.once && [], e = function (h) {
                g = a.memory && h; c = !0; d = m || 0; m = 0; f = k.length; for (b = !0; k && d < f; d++)if (!1 ===
                    k[d].apply(h[0], h[1]) && a.stopOnFalse) { g = !1; break } b = !1; k && (q ? q.length && e(q.shift()) : g ? k = [] : r.disable())
            }, r = {
                add: function () { if (k) { var c = k.length; (function Wb(b) { n.each(b, function (b, g) { var c = n.type(g); "function" === c ? a.unique && r.has(g) || k.push(g) : g && g.length && "string" !== c && Wb(g) }) })(arguments); b ? f = k.length : g && (m = c, e(g)) } return this }, remove: function () { k && n.each(arguments, function (a, g) { for (var c; -1 < (c = n.inArray(g, k, c));)k.splice(c, 1), b && (c <= f && f--, c <= d && d--) }); return this }, has: function (a) {
                    return a ? -1 < n.inArray(a,
                        k) : !(!k || !k.length)
                }, empty: function () { k = []; return this }, disable: function () { k = q = g = l; return this }, disabled: function () { return !k }, lock: function () { q = l; g || r.disable(); return this }, locked: function () { return !q }, fireWith: function (a, g) { g = g || []; g = [a, g.slice ? g.slice() : g]; !k || c && !q || (b ? q.push(g) : e(g)); return this }, fire: function () { r.fireWith(this, arguments); return this }, fired: function () { return !!c }
            }; return r
        }; n.extend({
            Deferred: function (a) {
                var b = [["resolve", "done", n.Callbacks("once memory"), "resolved"], ["reject",
                    "fail", n.Callbacks("once memory"), "rejected"], ["notify", "progress", n.Callbacks("memory")]], g = "pending", c = {
                        state: function () { return g }, always: function () { f.done(arguments).fail(arguments); return this }, then: function () {
                            var a = arguments; return n.Deferred(function (g) {
                                n.each(b, function (b, d) {
                                    var m = d[0], k = n.isFunction(a[b]) && a[b]; f[d[1]](function () {
                                        var a = k && k.apply(this, arguments); if (a && n.isFunction(a.promise)) a.promise().done(g.resolve).fail(g.reject).progress(g.notify); else g[m + "With"](this === c ? g.promise() :
                                            this, k ? [a] : arguments)
                                    })
                                }); a = null
                            }).promise()
                        }, promise: function (a) { return null != a ? n.extend(a, c) : c }
                    }, f = {}; c.pipe = c.then; n.each(b, function (a, d) { var m = d[2], k = d[3]; c[d[1]] = m.add; k && m.add(function () { g = k }, b[a ^ 1][2].disable, b[2][2].lock); f[d[0]] = function () { f[d[0] + "With"](this === f ? c : this, arguments); return this }; f[d[0] + "With"] = m.fireWith }); c.promise(f); a && a.call(f, f); return f
            }, when: function (a) {
                var b = 0, g = W.call(arguments), c = g.length, f = 1 !== c || a && n.isFunction(a.promise) ? c : 0, d = 1 === f ? a : n.Deferred(), m = function (a,
                    b, g) { return function (c) { b[a] = this; g[a] = 1 < arguments.length ? W.call(arguments) : c; g === k ? d.notifyWith(b, g) : --f || d.resolveWith(b, g) } }, k, q, h; if (1 < c) for (k = Array(c), q = Array(c), h = Array(c); b < c; b++)g[b] && n.isFunction(g[b].promise) ? g[b].promise().done(m(b, h, g)).fail(d.reject).progress(m(b, q, k)) : --f; f || d.resolveWith(h, g); return d.promise()
            }
        }); n.support = function () {
            var b, g, c, f, d, m, k, q = M.createElement("div"); q.setAttribute("className", "t"); q.innerHTML = "  \x3clink/\x3e\x3ctable\x3e\x3c/table\x3e\x3ca href\x3d'/a'\x3ea\x3c/a\x3e\x3cinput type\x3d'checkbox'/\x3e";
            g = q.getElementsByTagName("*"); c = q.getElementsByTagName("a")[0]; if (!g || !c || !g.length) return {}; f = M.createElement("select"); d = f.appendChild(M.createElement("option")); g = q.getElementsByTagName("input")[0]; c.style.cssText = "top:1px;float:left;opacity:.5"; b = {
                getSetAttribute: "t" !== q.className, leadingWhitespace: 3 === q.firstChild.nodeType, tbody: !q.getElementsByTagName("tbody").length, htmlSerialize: !!q.getElementsByTagName("link").length, style: /top/.test(c.getAttribute("style")), hrefNormalized: "/a" === c.getAttribute("href"),
                opacity: /^0.5/.test(c.style.opacity), cssFloat: !!c.style.cssFloat, checkOn: !!g.value, optSelected: d.selected, enctype: !!M.createElement("form").enctype, html5Clone: "\x3c:nav\x3e\x3c/:nav\x3e" !== M.createElement("nav").cloneNode(!0).outerHTML, boxModel: "CSS1Compat" === M.compatMode, deleteExpando: !0, noCloneEvent: !0, inlineBlockNeedsLayout: !1, shrinkWrapBlocks: !1, reliableMarginRight: !0, boxSizingReliable: !0, pixelPosition: !1
            }; g.checked = !0; b.noCloneChecked = g.cloneNode(!0).checked; f.disabled = !0; b.optDisabled = !d.disabled;
            try { delete q.test } catch (h) { b.deleteExpando = !1 } g = M.createElement("input"); g.setAttribute("value", ""); b.input = "" === g.getAttribute("value"); g.value = "t"; g.setAttribute("type", "radio"); b.radioValue = "t" === g.value; g.setAttribute("checked", "t"); g.setAttribute("name", "t"); c = M.createDocumentFragment(); c.appendChild(g); b.appendChecked = g.checked; b.checkClone = c.cloneNode(!0).cloneNode(!0).lastChild.checked; q.attachEvent && (q.attachEvent("onclick", function () { b.noCloneEvent = !1 }), q.cloneNode(!0).click()); for (k in {
                submit: !0,
                change: !0, focusin: !0
            }) q.setAttribute(c = "on" + k, "t"), b[k + "Bubbles"] = c in a || !1 === q.attributes[c].expando; q.style.backgroundClip = "content-box"; q.cloneNode(!0).style.backgroundClip = ""; b.clearCloneStyle = "content-box" === q.style.backgroundClip; n(function () {
                var g, c, f = M.getElementsByTagName("body")[0]; f && (g = M.createElement("div"), g.style.cssText = "border:0;width:0;height:0;position:absolute;top:0;left:-9999px;margin-top:1px", f.appendChild(g).appendChild(q), q.innerHTML = "\x3ctable\x3e\x3ctr\x3e\x3ctd\x3e\x3c/td\x3e\x3ctd\x3et\x3c/td\x3e\x3c/tr\x3e\x3c/table\x3e",
                    c = q.getElementsByTagName("td"), c[0].style.cssText = "padding:0;margin:0;border:0;display:none", m = 0 === c[0].offsetHeight, c[0].style.display = "", c[1].style.display = "none", b.reliableHiddenOffsets = m && 0 === c[0].offsetHeight, q.innerHTML = "", q.style.cssText = "box-sizing:border-box;-moz-box-sizing:border-box;-webkit-box-sizing:border-box;padding:1px;border:1px;display:block;width:4px;margin-top:1%;position:absolute;top:1%;", b.boxSizing = 4 === q.offsetWidth, b.doesNotIncludeMarginInBodyOffset = 1 !== f.offsetTop, a.getComputedStyle &&
                    (b.pixelPosition = "1%" !== (a.getComputedStyle(q, null) || {}).top, b.boxSizingReliable = "4px" === (a.getComputedStyle(q, null) || { width: "4px" }).width, c = q.appendChild(M.createElement("div")), c.style.cssText = q.style.cssText = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;", c.style.marginRight = c.style.width = "0", q.style.width = "1px", b.reliableMarginRight = !parseFloat((a.getComputedStyle(c, null) || {}).marginRight)), typeof q.style.zoom !== G &&
                    (q.innerHTML = "", q.style.cssText = "padding:0;margin:0;border:0;display:block;box-sizing:content-box;-moz-box-sizing:content-box;-webkit-box-sizing:content-box;width:1px;padding:1px;display:inline;zoom:1", b.inlineBlockNeedsLayout = 3 === q.offsetWidth, q.style.display = "block", q.innerHTML = "\x3cdiv\x3e\x3c/div\x3e", q.firstChild.style.width = "5px", b.shrinkWrapBlocks = 3 !== q.offsetWidth, b.inlineBlockNeedsLayout && (f.style.zoom = 1)), f.removeChild(g), q = null)
            }); g = f = c = d = c = g = null; return b
        }(); var qb = /(?:\{[\s\S]*\}|\[[\s\S]*\])$/,
            vb = /([A-Z])/g; n.extend({
                cache: {}, expando: "jQuery" + ("1.9.1" + Math.random()).replace(/\D/g, ""), noData: { embed: !0, object: "clsid:D27CDB6E-AE6D-11cf-96B8-444553540000", applet: !0 }, hasData: function (a) { a = a.nodeType ? n.cache[a[n.expando]] : a[n.expando]; return !!a && !f(a) }, data: function (a, b, g) { return c(a, b, g) }, removeData: function (a, b) { return d(a, b) }, _data: function (a, b, g) { return c(a, b, g, !0) }, _removeData: function (a, b) { return d(a, b, !0) }, acceptData: function (a) {
                    if (a.nodeType && 1 !== a.nodeType && 9 !== a.nodeType) return !1; var b =
                        a.nodeName && n.noData[a.nodeName.toLowerCase()]; return !b || !0 !== b && a.getAttribute("classid") === b
                }
            }); n.fn.extend({
                data: function (a, g) {
                    var c, f, d = this[0], m = 0, k = null; if (a === l) { if (this.length && (k = n.data(d), 1 === d.nodeType && !n._data(d, "parsedAttrs"))) { for (c = d.attributes; m < c.length; m++)f = c[m].name, f.indexOf("data-") || (f = n.camelCase(f.slice(5)), b(d, f, k[f])); n._data(d, "parsedAttrs", !0) } return k } return "object" === typeof a ? this.each(function () { n.data(this, a) }) : n.access(this, function (g) {
                        if (g === l) return d ? b(d, a, n.data(d,
                            a)) : null; this.each(function () { n.data(this, a, g) })
                    }, null, g, 1 < arguments.length, null, !0)
                }, removeData: function (a) { return this.each(function () { n.removeData(this, a) }) }
            }); n.extend({
                queue: function (a, b, g) { var c; if (a) return b = (b || "fx") + "queue", c = n._data(a, b), g && (!c || n.isArray(g) ? c = n._data(a, b, n.makeArray(g)) : c.push(g)), c || [] }, dequeue: function (a, b) {
                    b = b || "fx"; var g = n.queue(a, b), c = g.length, f = g.shift(), d = n._queueHooks(a, b), m = function () { n.dequeue(a, b) }; "inprogress" === f && (f = g.shift(), c--); if (d.cur = f) "fx" === b && g.unshift("inprogress"),
                        delete d.stop, f.call(a, m, d); !c && d && d.empty.fire()
                }, _queueHooks: function (a, b) { var g = b + "queueHooks"; return n._data(a, g) || n._data(a, g, { empty: n.Callbacks("once memory").add(function () { n._removeData(a, b + "queue"); n._removeData(a, g) }) }) }
            }); n.fn.extend({
                queue: function (a, b) { var g = 2; "string" !== typeof a && (b = a, a = "fx", g--); return arguments.length < g ? n.queue(this[0], a) : b === l ? this : this.each(function () { var g = n.queue(this, a, b); n._queueHooks(this, a); "fx" === a && "inprogress" !== g[0] && n.dequeue(this, a) }) }, dequeue: function (a) {
                    return this.each(function () {
                        n.dequeue(this,
                            a)
                    })
                }, delay: function (a, b) { a = n.fx ? n.fx.speeds[a] || a : a; return this.queue(b || "fx", function (b, g) { var c = setTimeout(b, a); g.stop = function () { clearTimeout(c) } }) }, clearQueue: function (a) { return this.queue(a || "fx", []) }, promise: function (a, b) { var g, c = 1, f = n.Deferred(), d = this, m = this.length, k = function () { --c || f.resolveWith(d, [d]) }; "string" !== typeof a && (b = a, a = l); for (a = a || "fx"; m--;)(g = n._data(d[m], a + "queueHooks")) && g.empty && (c++, g.empty.add(k)); k(); return f.promise(b) }
            }); var Ea, ib, Fa = /[\t\r\n]/g, Xa = /\r/g, xb = /^(?:input|select|textarea|button|object)$/i,
                yb = /^(?:a|area)$/i, Kb = /^(?:checked|selected|autofocus|autoplay|async|controls|defer|disabled|hidden|loop|multiple|open|readonly|required|scoped)$/i, zb = /^(?:checked|selected)$/i, Ta = n.support.getSetAttribute, Ab = n.support.input; n.fn.extend({
                    attr: function (a, b) { return n.access(this, n.attr, a, b, 1 < arguments.length) }, removeAttr: function (a) { return this.each(function () { n.removeAttr(this, a) }) }, prop: function (a, b) { return n.access(this, n.prop, a, b, 1 < arguments.length) }, removeProp: function (a) {
                        a = n.propFix[a] || a; return this.each(function () {
                            try {
                                this[a] =
                                l, delete this[a]
                            } catch (b) { }
                        })
                    }, addClass: function (a) { var b, g, c, f, d, m = 0, k = this.length; b = "string" === typeof a && a; if (n.isFunction(a)) return this.each(function (b) { n(this).addClass(a.call(this, b, this.className)) }); if (b) for (b = (a || "").match(oa) || []; m < k; m++)if (g = this[m], c = 1 === g.nodeType && (g.className ? (" " + g.className + " ").replace(Fa, " ") : " ")) { for (d = 0; f = b[d++];)0 > c.indexOf(" " + f + " ") && (c += f + " "); g.className = n.trim(c) } return this }, removeClass: function (a) {
                        var b, g, c, f, d, m = 0, k = this.length; b = 0 === arguments.length ||
                            "string" === typeof a && a; if (n.isFunction(a)) return this.each(function (b) { n(this).removeClass(a.call(this, b, this.className)) }); if (b) for (b = (a || "").match(oa) || []; m < k; m++)if (g = this[m], c = 1 === g.nodeType && (g.className ? (" " + g.className + " ").replace(Fa, " ") : "")) { for (d = 0; f = b[d++];)for (; 0 <= c.indexOf(" " + f + " ");)c = c.replace(" " + f + " ", " "); g.className = a ? n.trim(c) : "" } return this
                    }, toggleClass: function (a, b) {
                        var g = typeof a, c = "boolean" === typeof b; return n.isFunction(a) ? this.each(function (g) {
                            n(this).toggleClass(a.call(this,
                                g, this.className, b), b)
                        }) : this.each(function () { if ("string" === g) for (var f, d = 0, m = n(this), k = b, q = a.match(oa) || []; f = q[d++];)k = c ? k : !m.hasClass(f), m[k ? "addClass" : "removeClass"](f); else if (g === G || "boolean" === g) this.className && n._data(this, "__className__", this.className), this.className = this.className || !1 === a ? "" : n._data(this, "__className__") || "" })
                    }, hasClass: function (a) { a = " " + a + " "; for (var b = 0, g = this.length; b < g; b++)if (1 === this[b].nodeType && 0 <= (" " + this[b].className + " ").replace(Fa, " ").indexOf(a)) return !0; return !1 },
                    val: function (a) {
                        var b, g, c, f = this[0]; if (arguments.length) return c = n.isFunction(a), this.each(function (b) { var f = n(this); 1 === this.nodeType && (b = c ? a.call(this, b, f.val()) : a, null == b ? b = "" : "number" === typeof b ? b += "" : n.isArray(b) && (b = n.map(b, function (a) { return null == a ? "" : a + "" })), g = n.valHooks[this.type] || n.valHooks[this.nodeName.toLowerCase()], g && "set" in g && g.set(this, b, "value") !== l || (this.value = b)) }); if (f) {
                            if ((g = n.valHooks[f.type] || n.valHooks[f.nodeName.toLowerCase()]) && "get" in g && (b = g.get(f, "value")) !== l) return b;
                            b = f.value; return "string" === typeof b ? b.replace(Xa, "") : null == b ? "" : b
                        }
                    }
                }); n.extend({
                    valHooks: {
                        option: { get: function (a) { var b = a.attributes.value; return !b || b.specified ? a.value : a.text } }, select: {
                            get: function (a) {
                                for (var b, g = a.options, c = a.selectedIndex, f = (a = "select-one" === a.type || 0 > c) ? null : [], d = a ? c + 1 : g.length, m = 0 > c ? d : a ? c : 0; m < d; m++)if (b = g[m], !(!b.selected && m !== c || (n.support.optDisabled ? b.disabled : null !== b.getAttribute("disabled")) || b.parentNode.disabled && n.nodeName(b.parentNode, "optgroup"))) {
                                    b = n(b).val(); if (a) return b;
                                    f.push(b)
                                } return f
                            }, set: function (a, b) { var g = n.makeArray(b); n(a).find("option").each(function () { this.selected = 0 <= n.inArray(n(this).val(), g) }); g.length || (a.selectedIndex = -1); return g }
                        }
                    }, attr: function (a, b, g) {
                        var c, f, d; f = a.nodeType; if (a && 3 !== f && 8 !== f && 2 !== f) {
                            if (typeof a.getAttribute === G) return n.prop(a, b, g); if (f = 1 !== f || !n.isXMLDoc(a)) b = b.toLowerCase(), c = n.attrHooks[b] || (Kb.test(b) ? ib : Ea); if (g !== l) if (null === g) n.removeAttr(a, b); else {
                                if (c && f && "set" in c && (d = c.set(a, g, b)) !== l) return d; a.setAttribute(b, g + "");
                                return g
                            } else { if (c && f && "get" in c && null !== (d = c.get(a, b))) return d; typeof a.getAttribute !== G && (d = a.getAttribute(b)); return null == d ? l : d }
                        }
                    }, removeAttr: function (a, b) { var g, c, f = 0, d = b && b.match(oa); if (d && 1 === a.nodeType) for (; g = d[f++];)c = n.propFix[g] || g, Kb.test(g) ? !Ta && zb.test(g) ? a[n.camelCase("default-" + g)] = a[c] = !1 : a[c] = !1 : n.attr(a, g, ""), a.removeAttribute(Ta ? g : c) }, attrHooks: {
                        type: {
                            set: function (a, b) {
                                if (!n.support.radioValue && "radio" === b && n.nodeName(a, "input")) {
                                    var g = a.value; a.setAttribute("type", b); g && (a.value =
                                        g); return b
                                }
                            }
                        }
                    }, propFix: { tabindex: "tabIndex", readonly: "readOnly", "for": "htmlFor", "class": "className", maxlength: "maxLength", cellspacing: "cellSpacing", cellpadding: "cellPadding", rowspan: "rowSpan", colspan: "colSpan", usemap: "useMap", frameborder: "frameBorder", contenteditable: "contentEditable" }, prop: function (a, b, g) {
                        var c, f, d; d = a.nodeType; if (a && 3 !== d && 8 !== d && 2 !== d) {
                            if (d = 1 !== d || !n.isXMLDoc(a)) b = n.propFix[b] || b, f = n.propHooks[b]; return g !== l ? f && "set" in f && (c = f.set(a, g, b)) !== l ? c : a[b] = g : f && "get" in f && null !== (c =
                                f.get(a, b)) ? c : a[b]
                        }
                    }, propHooks: { tabIndex: { get: function (a) { var b = a.getAttributeNode("tabindex"); return b && b.specified ? parseInt(b.value, 10) : xb.test(a.nodeName) || yb.test(a.nodeName) && a.href ? 0 : l } } }
                }); ib = {
                    get: function (a, b) { var g = n.prop(a, b), c = "boolean" === typeof g && a.getAttribute(b); return (g = "boolean" === typeof g ? Ab && Ta ? null != c : zb.test(b) ? a[n.camelCase("default-" + b)] : !!c : a.getAttributeNode(b)) && !1 !== g.value ? b.toLowerCase() : l }, set: function (a, b, g) {
                        !1 === b ? n.removeAttr(a, g) : Ab && Ta || !zb.test(g) ? a.setAttribute(!Ta &&
                            n.propFix[g] || g, g) : a[n.camelCase("default-" + g)] = a[g] = !0; return g
                    }
                }; Ab && Ta || (n.attrHooks.value = { get: function (a, b) { var g = a.getAttributeNode(b); return n.nodeName(a, "input") ? a.defaultValue : g && g.specified ? g.value : l }, set: function (a, b, g) { if (n.nodeName(a, "input")) a.defaultValue = b; else return Ea && Ea.set(a, b, g) } }); Ta || (Ea = n.valHooks.button = {
                    get: function (a, b) { var g = a.getAttributeNode(b); return g && ("id" === b || "name" === b || "coords" === b ? "" !== g.value : g.specified) ? g.value : l }, set: function (a, b, g) {
                        var c = a.getAttributeNode(g);
                        c || a.setAttributeNode(c = a.ownerDocument.createAttribute(g)); c.value = b += ""; return "value" === g || b === a.getAttribute(g) ? b : l
                    }
                }, n.attrHooks.contenteditable = { get: Ea.get, set: function (a, b, g) { Ea.set(a, "" === b ? !1 : b, g) } }, n.each(["width", "height"], function (a, b) { n.attrHooks[b] = n.extend(n.attrHooks[b], { set: function (a, g) { if ("" === g) return a.setAttribute(b, "auto"), g } }) })); n.support.hrefNormalized || (n.each(["href", "src", "width", "height"], function (a, b) {
                    n.attrHooks[b] = n.extend(n.attrHooks[b], {
                        get: function (a) {
                            a = a.getAttribute(b,
                                2); return null == a ? l : a
                        }
                    })
                }), n.each(["href", "src"], function (a, b) { n.propHooks[b] = { get: function (a) { return a.getAttribute(b, 4) } } })); n.support.style || (n.attrHooks.style = { get: function (a) { return a.style.cssText || l }, set: function (a, b) { return a.style.cssText = b + "" } }); n.support.optSelected || (n.propHooks.selected = n.extend(n.propHooks.selected, { get: function (a) { if (a = a.parentNode) a.selectedIndex, a.parentNode && a.parentNode.selectedIndex; return null } })); n.support.enctype || (n.propFix.enctype = "encoding"); n.support.checkOn ||
                    n.each(["radio", "checkbox"], function () { n.valHooks[this] = { get: function (a) { return null === a.getAttribute("value") ? "on" : a.value } } }); n.each(["radio", "checkbox"], function () { n.valHooks[this] = n.extend(n.valHooks[this], { set: function (a, b) { if (n.isArray(b)) return a.checked = 0 <= n.inArray(n(a).val(), b) } }) }); var Bb = /^(?:input|select|textarea)$/i, Xb = /^key/, Ga = /^(?:mouse|contextmenu)|click/, jb = /^(?:focusinfocus|focusoutblur)$/, Aa = /^([^.]*)(?:\.(.+)|)$/; n.event = {
                        global: {}, add: function (a, b, g, c, f) {
                            var d, m, k, q, h, e, r, u,
                            x; if (k = n._data(a)) {
                                g.handler && (q = g, g = q.handler, f = q.selector); g.guid || (g.guid = n.guid++); (m = k.events) || (m = k.events = {}); (h = k.handle) || (h = k.handle = function (a) { return typeof n === G || a && n.event.triggered === a.type ? l : n.event.dispatch.apply(h.elem, arguments) }, h.elem = a); b = (b || "").match(oa) || [""]; for (k = b.length; k--;)d = Aa.exec(b[k]) || [], u = e = d[1], x = (d[2] || "").split(".").sort(), d = n.event.special[u] || {}, u = (f ? d.delegateType : d.bindType) || u, d = n.event.special[u] || {}, e = n.extend({
                                    type: u, origType: e, data: c, handler: g, guid: g.guid,
                                    selector: f, needsContext: f && n.expr.match.needsContext.test(f), namespace: x.join(".")
                                }, q), (r = m[u]) || (r = m[u] = [], r.delegateCount = 0, d.setup && !1 !== d.setup.call(a, c, x, h) || (a.addEventListener ? a.addEventListener(u, h, !1) : a.attachEvent && a.attachEvent("on" + u, h))), d.add && (d.add.call(a, e), e.handler.guid || (e.handler.guid = g.guid)), f ? r.splice(r.delegateCount++, 0, e) : r.push(e), n.event.global[u] = !0; a = null
                            }
                        }, remove: function (a, b, g, c, f) {
                            var d, m, k, q, h, e, r, u, x, w, l, A = n.hasData(a) && n._data(a); if (A && (e = A.events)) {
                                b = (b || "").match(oa) ||
                                [""]; for (h = b.length; h--;)if (k = Aa.exec(b[h]) || [], x = l = k[1], w = (k[2] || "").split(".").sort(), x) {
                                    r = n.event.special[x] || {}; x = (c ? r.delegateType : r.bindType) || x; u = e[x] || []; k = k[2] && RegExp("(^|\\.)" + w.join("\\.(?:.*\\.|)") + "(\\.|$)"); for (q = d = u.length; d--;)m = u[d], !f && l !== m.origType || g && g.guid !== m.guid || k && !k.test(m.namespace) || c && !(c === m.selector || "**" === c && m.selector) || (u.splice(d, 1), m.selector && u.delegateCount--, r.remove && r.remove.call(a, m)); q && !u.length && (r.teardown && !1 !== r.teardown.call(a, w, A.handle) || n.removeEvent(a,
                                        x, A.handle), delete e[x])
                                } else for (x in e) n.event.remove(a, x + b[h], g, c, !0); n.isEmptyObject(e) && (delete A.handle, n._removeData(a, "events"))
                            }
                        }, trigger: function (b, g, c, f) {
                            var d, m, k, q, h, e, r = [c || M], u = ua.call(b, "type") ? b.type : b; h = ua.call(b, "namespace") ? b.namespace.split(".") : []; k = d = c = c || M; if (3 !== c.nodeType && 8 !== c.nodeType && !jb.test(u + n.event.triggered) && (0 <= u.indexOf(".") && (h = u.split("."), u = h.shift(), h.sort()), m = 0 > u.indexOf(":") && "on" + u, b = b[n.expando] ? b : new n.Event(u, "object" === typeof b && b), b.isTrigger = !0,
                                b.namespace = h.join("."), b.namespace_re = b.namespace ? RegExp("(^|\\.)" + h.join("\\.(?:.*\\.|)") + "(\\.|$)") : null, b.result = l, b.target || (b.target = c), g = null == g ? [b] : n.makeArray(g, [b]), h = n.event.special[u] || {}, f || !h.trigger || !1 !== h.trigger.apply(c, g))) {
                                    if (!f && !h.noBubble && !n.isWindow(c)) { q = h.delegateType || u; jb.test(q + u) || (k = k.parentNode); for (; k; k = k.parentNode)r.push(k), d = k; d === (c.ownerDocument || M) && r.push(d.defaultView || d.parentWindow || a) } for (e = 0; (k = r[e++]) && !b.isPropagationStopped();)b.type = 1 < e ? q : h.bindType ||
                                        u, (d = (n._data(k, "events") || {})[b.type] && n._data(k, "handle")) && d.apply(k, g), (d = m && k[m]) && n.acceptData(k) && d.apply && !1 === d.apply(k, g) && b.preventDefault(); b.type = u; if (!(f || b.isDefaultPrevented() || h._default && !1 !== h._default.apply(c.ownerDocument, g) || "click" === u && n.nodeName(c, "a")) && n.acceptData(c) && m && c[u] && !n.isWindow(c)) { (d = c[m]) && (c[m] = null); n.event.triggered = u; try { c[u]() } catch (x) { } n.event.triggered = l; d && (c[m] = d) } return b.result
                            }
                        }, dispatch: function (a) {
                            a = n.event.fix(a); var b, g, c, f, d = [], m = W.call(arguments);
                            b = (n._data(this, "events") || {})[a.type] || []; var k = n.event.special[a.type] || {}; m[0] = a; a.delegateTarget = this; if (!k.preDispatch || !1 !== k.preDispatch.call(this, a)) {
                                d = n.event.handlers.call(this, a, b); for (b = 0; (c = d[b++]) && !a.isPropagationStopped();)for (a.currentTarget = c.elem, f = 0; (g = c.handlers[f++]) && !a.isImmediatePropagationStopped();)if (!a.namespace_re || a.namespace_re.test(g.namespace)) a.handleObj = g, a.data = g.data, g = ((n.event.special[g.origType] || {}).handle || g.handler).apply(c.elem, m), g !== l && !1 === (a.result =
                                    g) && (a.preventDefault(), a.stopPropagation()); k.postDispatch && k.postDispatch.call(this, a); return a.result
                            }
                        }, handlers: function (a, b) {
                            var g, c, f, d, m = [], k = b.delegateCount, q = a.target; if (k && q.nodeType && (!a.button || "click" !== a.type)) for (; q != this; q = q.parentNode || this)if (1 === q.nodeType && (!0 !== q.disabled || "click" !== a.type)) { f = []; for (d = 0; d < k; d++)c = b[d], g = c.selector + " ", f[g] === l && (f[g] = c.needsContext ? 0 <= n(g, this).index(q) : n.find(g, this, null, [q]).length), f[g] && f.push(c); f.length && m.push({ elem: q, handlers: f }) } k < b.length &&
                                m.push({ elem: this, handlers: b.slice(k) }); return m
                        }, fix: function (a) { if (a[n.expando]) return a; var b, g, c; b = a.type; var f = a, d = this.fixHooks[b]; d || (this.fixHooks[b] = d = Ga.test(b) ? this.mouseHooks : Xb.test(b) ? this.keyHooks : {}); c = d.props ? this.props.concat(d.props) : this.props; a = new n.Event(f); for (b = c.length; b--;)g = c[b], a[g] = f[g]; a.target || (a.target = f.srcElement || M); 3 === a.target.nodeType && (a.target = a.target.parentNode); a.metaKey = !!a.metaKey; return d.filter ? d.filter(a, f) : a }, props: "altKey bubbles cancelable ctrlKey currentTarget eventPhase metaKey relatedTarget shiftKey target timeStamp view which".split(" "),
                        fixHooks: {}, keyHooks: { props: ["char", "charCode", "key", "keyCode"], filter: function (a, b) { null == a.which && (a.which = null != b.charCode ? b.charCode : b.keyCode); return a } }, mouseHooks: {
                            props: "button buttons clientX clientY fromElement offsetX offsetY pageX pageY screenX screenY toElement".split(" "), filter: function (a, b) {
                                var g, c, f = b.button, d = b.fromElement; null == a.pageX && null != b.clientX && (g = a.target.ownerDocument || M, c = g.documentElement, g = g.body, a.pageX = b.clientX + (c && c.scrollLeft || g && g.scrollLeft || 0) - (c && c.clientLeft ||
                                    g && g.clientLeft || 0), a.pageY = b.clientY + (c && c.scrollTop || g && g.scrollTop || 0) - (c && c.clientTop || g && g.clientTop || 0)); !a.relatedTarget && d && (a.relatedTarget = d === a.target ? b.toElement : d); a.which || f === l || (a.which = f & 1 ? 1 : f & 2 ? 3 : f & 4 ? 2 : 0); return a
                            }
                        }, special: {
                            load: { noBubble: !0 }, click: { trigger: function () { if (n.nodeName(this, "input") && "checkbox" === this.type && this.click) return this.click(), !1 } }, focus: { trigger: function () { if (this !== M.activeElement && this.focus) try { return this.focus(), !1 } catch (a) { } }, delegateType: "focusin" },
                            blur: { trigger: function () { if (this === M.activeElement && this.blur) return this.blur(), !1 }, delegateType: "focusout" }, beforeunload: { postDispatch: function (a) { a.result !== l && (a.originalEvent.returnValue = a.result) } }
                        }, simulate: function (a, b, g, c) { a = n.extend(new n.Event, g, { type: a, isSimulated: !0, originalEvent: {} }); c ? n.event.trigger(a, null, b) : n.event.dispatch.call(b, a); a.isDefaultPrevented() && g.preventDefault() }
                    }; n.removeEvent = M.removeEventListener ? function (a, b, g) { a.removeEventListener && a.removeEventListener(b, g, !1) } :
                        function (a, b, g) { b = "on" + b; a.detachEvent && (typeof a[b] === G && (a[b] = null), a.detachEvent(b, g)) }; n.Event = function (a, b) { if (!(this instanceof n.Event)) return new n.Event(a, b); a && a.type ? (this.originalEvent = a, this.type = a.type, this.isDefaultPrevented = a.defaultPrevented || !1 === a.returnValue || a.getPreventDefault && a.getPreventDefault() ? m : k) : this.type = a; b && n.extend(this, b); this.timeStamp = a && a.timeStamp || n.now(); this[n.expando] = !0 }; n.Event.prototype = {
                            isDefaultPrevented: k, isPropagationStopped: k, isImmediatePropagationStopped: k,
                            preventDefault: function () { var a = this.originalEvent; this.isDefaultPrevented = m; a && (a.preventDefault ? a.preventDefault() : a.returnValue = !1) }, stopPropagation: function () { var a = this.originalEvent; this.isPropagationStopped = m; a && (a.stopPropagation && a.stopPropagation(), a.cancelBubble = !0) }, stopImmediatePropagation: function () { this.isImmediatePropagationStopped = m; this.stopPropagation() }
                        }; n.each({ mouseenter: "mouseover", mouseleave: "mouseout" }, function (a, b) {
                            n.event.special[a] = {
                                delegateType: b, bindType: b, handle: function (a) {
                                    var g,
                                    c = a.relatedTarget, f = a.handleObj; if (!c || c !== this && !n.contains(this, c)) a.type = f.origType, g = f.handler.apply(this, arguments), a.type = b; return g
                                }
                            }
                        }); n.support.submitBubbles || (n.event.special.submit = {
                            setup: function () { if (n.nodeName(this, "form")) return !1; n.event.add(this, "click._submit keypress._submit", function (a) { a = a.target; (a = n.nodeName(a, "input") || n.nodeName(a, "button") ? a.form : l) && !n._data(a, "submitBubbles") && (n.event.add(a, "submit._submit", function (a) { a._submit_bubble = !0 }), n._data(a, "submitBubbles", !0)) }) },
                            postDispatch: function (a) { a._submit_bubble && (delete a._submit_bubble, this.parentNode && !a.isTrigger && n.event.simulate("submit", this.parentNode, a, !0)) }, teardown: function () { if (n.nodeName(this, "form")) return !1; n.event.remove(this, "._submit") }
                        }); n.support.changeBubbles || (n.event.special.change = {
                            setup: function () {
                                if (Bb.test(this.nodeName)) {
                                    if ("checkbox" === this.type || "radio" === this.type) n.event.add(this, "propertychange._change", function (a) { "checked" === a.originalEvent.propertyName && (this._just_changed = !0) }),
                                        n.event.add(this, "click._change", function (a) { this._just_changed && !a.isTrigger && (this._just_changed = !1); n.event.simulate("change", this, a, !0) }); return !1
                                } n.event.add(this, "beforeactivate._change", function (a) { a = a.target; Bb.test(a.nodeName) && !n._data(a, "changeBubbles") && (n.event.add(a, "change._change", function (a) { !this.parentNode || a.isSimulated || a.isTrigger || n.event.simulate("change", this.parentNode, a, !0) }), n._data(a, "changeBubbles", !0)) })
                            }, handle: function (a) {
                                var b = a.target; if (this !== b || a.isSimulated ||
                                    a.isTrigger || "radio" !== b.type && "checkbox" !== b.type) return a.handleObj.handler.apply(this, arguments)
                            }, teardown: function () { n.event.remove(this, "._change"); return !Bb.test(this.nodeName) }
                        }); n.support.focusinBubbles || n.each({ focus: "focusin", blur: "focusout" }, function (a, b) { var g = 0, c = function (a) { n.event.simulate(b, a.target, n.event.fix(a), !0) }; n.event.special[b] = { setup: function () { 0 === g++ && M.addEventListener(a, c, !0) }, teardown: function () { 0 === --g && M.removeEventListener(a, c, !0) } } }); n.fn.extend({
                            on: function (a,
                                b, g, c, f) { var d, m; if ("object" === typeof a) { "string" !== typeof b && (g = g || b, b = l); for (d in a) this.on(d, b, g, a[d], f); return this } null == g && null == c ? (c = b, g = b = l) : null == c && ("string" === typeof b ? (c = g, g = l) : (c = g, g = b, b = l)); if (!1 === c) c = k; else if (!c) return this; 1 === f && (m = c, c = function (a) { n().off(a); return m.apply(this, arguments) }, c.guid = m.guid || (m.guid = n.guid++)); return this.each(function () { n.event.add(this, a, c, g, b) }) }, one: function (a, b, g, c) { return this.on(a, b, g, c, 1) }, off: function (a, b, g) {
                                    var c; if (a && a.preventDefault && a.handleObj) return c =
                                        a.handleObj, n(a.delegateTarget).off(c.namespace ? c.origType + "." + c.namespace : c.origType, c.selector, c.handler), this; if ("object" === typeof a) { for (c in a) this.off(c, b, a[c]); return this } if (!1 === b || "function" === typeof b) g = b, b = l; !1 === g && (g = k); return this.each(function () { n.event.remove(this, a, g, b) })
                                }, bind: function (a, b, g) { return this.on(a, null, b, g) }, unbind: function (a, b) { return this.off(a, null, b) }, delegate: function (a, b, g, c) { return this.on(b, a, g, c) }, undelegate: function (a, b, g) {
                                    return 1 === arguments.length ? this.off(a,
                                        "**") : this.off(b, a || "**", g)
                                }, trigger: function (a, b) { return this.each(function () { n.event.trigger(a, b, this) }) }, triggerHandler: function (a, b) { var g = this[0]; if (g) return n.event.trigger(a, b, g, !0) }
                        }); (function (a, b) {
                            function g(a) { return Eb.test(a + "") } function c() { var a, b = []; return a = function (g, c) { b.push(g += " ") > C.cacheLength && delete a[b.shift()]; return a[g] = c } } function f(a) { a[N] = !0; return a } function d(a) { var b = fa.createElement("div"); try { return a(b) } catch (g) { return !1 } finally { } } function m(a, b, g, c) {
                                var f, d,
                                k, q, h; (b ? b.ownerDocument || b : T) !== fa && y(b); b = b || fa; g = g || []; if (!a || "string" !== typeof a) return g; if (1 !== (q = b.nodeType) && 9 !== q) return []; if (!F && !c) {
                                    if (f = ba.exec(a)) if (k = f[1]) if (9 === q) if ((d = b.getElementById(k)) && d.parentNode) { if (d.id === k) return g.push(d), g } else return g; else { if (b.ownerDocument && (d = b.ownerDocument.getElementById(k)) && Qa(b, d) && d.id === k) return g.push(d), g } else {
                                        if (f[2]) return Fa.apply(g, aa.call(b.getElementsByTagName(a), 0)), g; if ((k = f[3]) && Q.getByClassName && b.getElementsByClassName) return Fa.apply(g,
                                            aa.call(b.getElementsByClassName(k), 0)), g
                                    } if (Q.qsa && !Y.test(a)) { f = !0; d = N; k = b; h = 9 === q && a; if (1 === q && "object" !== b.nodeName.toLowerCase()) { q = r(a); (f = b.getAttribute("id")) ? d = f.replace($a, "\\$\x26") : b.setAttribute("id", d); d = "[id\x3d'" + d + "'] "; for (k = q.length; k--;)q[k] = d + u(q[k]); k = ha.test(a) && b.parentNode || b; h = q.join(",") } if (h) try { return Fa.apply(g, aa.call(k.querySelectorAll(h), 0)), g } catch (e) { } finally { f || b.removeAttribute("id") } }
                                } var x; a: {
                                    a = a.replace(P, "$1"); d = r(a); if (!c && 1 === d.length) {
                                        f = d[0] = d[0].slice(0);
                                        if (2 < f.length && "ID" === (x = f[0]).type && 9 === b.nodeType && !F && C.relative[f[1].type]) { b = C.find.ID(x.matches[0].replace(Ga, Aa), b)[0]; if (!b) { x = g; break a } a = a.slice(f.shift().value.length) } for (q = Xa.needsContext.test(a) ? 0 : f.length; q--;) { x = f[q]; if (C.relative[k = x.type]) break; if (k = C.find[k]) if (c = k(x.matches[0].replace(Ga, Aa), ha.test(f[0].type) && b.parentNode || b)) { f.splice(q, 1); a = c.length && u(f); if (!a) { Fa.apply(g, aa.call(c, 0)); x = g; break a } break } }
                                    } s(a, d)(c, b, F, g, ha.test(a)); x = g
                                } return x
                            } function k(a, b) {
                                var g = b && a,
                                c = g && (~b.sourceIndex || gb) - (~a.sourceIndex || gb); if (c) return c; if (g) for (; g = g.nextSibling;)if (g === b) return -1; return a ? 1 : -1
                            } function q(a) { return function (b) { return "input" === b.nodeName.toLowerCase() && b.type === a } } function h(a) { return function (b) { var g = b.nodeName.toLowerCase(); return ("input" === g || "button" === g) && b.type === a } } function e(a) { return f(function (b) { b = +b; return f(function (g, c) { for (var f, d = a([], g.length, b), m = d.length; m--;)g[f = d[m]] && (g[f] = !(c[f] = g[f])) }) }) } function r(a, b) {
                                var g, c, f, d, k, q, h; if (k = jb[a +
                                    " "]) return b ? 0 : k.slice(0); k = a; q = []; for (h = C.preFilter; k;) { if (!g || (c = vb.exec(k))) c && (k = k.slice(c[0].length) || k), q.push(f = []); g = !1; if (c = yb.exec(k)) g = c.shift(), f.push({ value: g, type: c[0].replace(P, " ") }), k = k.slice(g.length); for (d in C.filter) !(c = Xa[d].exec(k)) || h[d] && !(c = h[d](c)) || (g = c.shift(), f.push({ value: g, type: d, matches: c }), k = k.slice(g.length)); if (!g) break } return b ? k.length : k ? m.error(a) : jb(a, q).slice(0)
                            } function u(a) { for (var b = 0, g = a.length, c = ""; b < g; b++)c += a[b].value; return c } function x(a, b, g) {
                                var c =
                                    b.dir, f = g && "parentNode" === c, d = G++; return b.first ? function (b, g, d) { for (; b = b[c];)if (1 === b.nodeType || f) return a(b, g, d) } : function (b, g, m) { var k, q, h, e = U + " " + d; if (m) for (; b = b[c];) { if ((1 === b.nodeType || f) && a(b, g, m)) return !0 } else for (; b = b[c];)if (1 === b.nodeType || f) if (h = b[N] || (b[N] = {}), (q = h[c]) && q[0] === e) { if (!0 === (k = q[1]) || k === K) return !0 === k } else if (q = h[c] = [e], q[1] = a(b, g, m) || K, !0 === q[1]) return !0 }
                            } function w(a) { return 1 < a.length ? function (b, g, c) { for (var f = a.length; f--;)if (!a[f](b, g, c)) return !1; return !0 } : a[0] } function l(a,
                                b, g, c, f) { for (var d, m = [], k = 0, q = a.length, h = null != b; k < q; k++)if (d = a[k]) if (!g || g(d, c, f)) m.push(d), h && b.push(k); return m } function A(a, b, g, c, d, k) {
                                    c && !c[N] && (c = A(c)); d && !d[N] && (d = A(d, k)); return f(function (f, k, q, h) {
                                        var e, r, u = [], x = [], w = k.length, n; if (!(n = f)) { n = b || "*"; for (var A = q.nodeType ? [q] : q, z = [], B = 0, D = A.length; B < D; B++)m(n, A[B], z); n = z } n = !a || !f && b ? n : l(n, u, a, q, h); A = g ? d || (f ? a : w || c) ? [] : k : n; g && g(n, A, q, h); if (c) for (e = l(A, x), c(e, [], q, h), q = e.length; q--;)if (r = e[q]) A[x[q]] = !(n[x[q]] = r); if (f) {
                                            if (d || a) {
                                                if (d) {
                                                    e = []; for (q =
                                                        A.length; q--;)(r = A[q]) && e.push(n[q] = r); d(null, A = [], e, h)
                                                } for (q = A.length; q--;)(r = A[q]) && -1 < (e = d ? Ea.call(f, r) : u[q]) && (f[e] = !(k[e] = r))
                                            }
                                        } else A = l(A === k ? A.splice(w, A.length) : A), d ? d(null, k, A, h) : Fa.apply(k, A)
                                    })
                                } function z(a) {
                                    var b, g, c, f = a.length, d = C.relative[a[0].type]; g = d || C.relative[" "]; for (var m = d ? 1 : 0, k = x(function (a) { return a === b }, g, !0), q = x(function (a) { return -1 < Ea.call(b, a) }, g, !0), h = [function (a, g, c) { return !d && (c || g !== E) || ((b = g).nodeType ? k(a, g, c) : q(a, g, c)) }]; m < f; m++)if (g = C.relative[a[m].type]) h = [x(w(h),
                                        g)]; else { g = C.filter[a[m].type].apply(null, a[m].matches); if (g[N]) { for (c = ++m; c < f && !C.relative[a[c].type]; c++); return A(1 < m && w(h), 1 < m && u(a.slice(0, m - 1)).replace(P, "$1"), g, m < c && z(a.slice(m, c)), c < f && z(a = a.slice(c)), c < f && u(a)) } h.push(g) } return w(h)
                                } function B(a, b) {
                                    var g = 0, c = 0 < b.length, d = 0 < a.length, k = function (f, k, q, h, e) {
                                        var r, u, x = [], w = 0, n = "0", A = f && [], z = null != e, B = E, D = f || d && C.find.TAG("*", e && k.parentNode || k), t = U += null == B ? 1 : Math.random() || 0.1; z && (E = k !== fa && k, K = g); for (; null != (e = D[n]); n++) {
                                            if (d && e) {
                                                for (r = 0; u =
                                                    a[r++];)if (u(e, k, q)) { h.push(e); break } z && (U = t, K = ++g)
                                            } c && ((e = !u && e) && w--, f && A.push(e))
                                        } w += n; if (c && n !== w) { for (r = 0; u = b[r++];)u(A, x, k, q); if (f) { if (0 < w) for (; n--;)A[n] || x[n] || (x[n] = J.call(h)); x = l(x) } Fa.apply(h, x); z && !f && 0 < x.length && 1 < w + b.length && m.uniqueSort(h) } z && (U = t, E = B); return A
                                    }; return c ? f(k) : k
                                } function D() { } var t, K, C, v, I, s, O, E, y, fa, S, F, Y, ma, H, Qa, R, N = "sizzle" + -new Date, T = a.document, Q = {}, U = 0, G = 0, W = c(), jb = c(), qb = c(), V = typeof b, gb = -2147483648, L = [], J = L.pop, Fa = L.push, aa = L.slice, Ea = L.indexOf || function (a) {
                                    for (var b =
                                        0, g = this.length; b < g; b++)if (this[b] === a) return b; return -1
                                }, L = "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+".replace("w", "w#"), ib = "\\[[\\x20\\t\\r\\n\\f]*((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)[\\x20\\t\\r\\n\\f]*(?:([*^$|!~]?\x3d)[\\x20\\t\\r\\n\\f]*(?:(['\"])((?:\\\\.|[^\\\\])*?)\\3|(" + L + ")|)|)[\\x20\\t\\r\\n\\f]*\\]", kb = ":((?:\\\\.|[\\w-]|[^\\x00-\\xa0])+)(?:\\(((['\"])((?:\\\\.|[^\\\\])*?)\\3|((?:\\\\.|[^\\\\()[\\]]|" + ib.replace(3, 8) + ")*)|.*)\\)|)", P = /^[\x20\t\r\n\f]+|((?:^|[^\\])(?:\\.)*)[\x20\t\r\n\f]+$/g, vb =
                                        /^[\x20\t\r\n\f]*,[\x20\t\r\n\f]*/, yb = /^[\x20\t\r\n\f]*([\x20\t\r\n\f>+~])[\x20\t\r\n\f]*/, Cb = RegExp(kb), pa = RegExp("^" + L + "$"), Xa = {
                                            ID: /^#((?:\\.|[\w-]|[^\x00-\xa0])+)/, CLASS: /^\.((?:\\.|[\w-]|[^\x00-\xa0])+)/, NAME: /^\[name=['"]?((?:\\.|[\w-]|[^\x00-\xa0])+)['"]?\]/, TAG: RegExp("^(" + "(?:\\\\.|[\\w-]|[^\\x00-\\xa0])+".replace("w", "w*") + ")"), ATTR: RegExp("^" + ib), PSEUDO: RegExp("^" + kb), CHILD: RegExp("^:(only|first|last|nth|nth-last)-(child|of-type)(?:\\([\\x20\\t\\r\\n\\f]*(even|odd|(([+-]|)(\\d*)n|)[\\x20\\t\\r\\n\\f]*(?:([+-]|)[\\x20\\t\\r\\n\\f]*(\\d+)|))[\\x20\\t\\r\\n\\f]*\\)|)",
                                                "i"), needsContext: RegExp("^[\\x20\\t\\r\\n\\f]*[\x3e+~]|:(even|odd|eq|gt|lt|nth|first|last)(?:\\([\\x20\\t\\r\\n\\f]*((?:-\\d)?\\d*)[\\x20\\t\\r\\n\\f]*\\)|)(?\x3d[^-]|$)", "i")
                                        }, ha = /[\x20\t\r\n\f]*[+~]/, Eb = /^[^{]+\{\s*\[native code/, ba = /^(?:#([\w-]+)|(\w+)|\.([\w-]+))$/, xb = /^(?:input|select|textarea|button)$/i, M = /^h\d$/i, $a = /'|\\/g, tb = /\=[\x20\t\r\n\f]*([^'"\]]*)[\x20\t\r\n\f]*\]/g, Ga = /\\([\da-fA-F]{1,6}[\x20\t\r\n\f]?|.)/g, Aa = function (a, b) {
                                            var g = "0x" + b - 65536; return g !== g ? b : 0 > g ? String.fromCharCode(g +
                                                65536) : String.fromCharCode(g >> 10 | 55296, g & 1023 | 56320)
                                        }; try { aa.call(T.documentElement.childNodes, 0)[0].nodeType } catch (qa) { aa = function (a) { for (var b, g = []; b = this[a++];)g.push(b); return g } } I = m.isXML = function (a) { return (a = a && (a.ownerDocument || a).documentElement) ? "HTML" !== a.nodeName : !1 }; y = m.setDocument = function (a) {
                                            var c = a ? a.ownerDocument || a : T; if (c === fa || 9 !== c.nodeType || !c.documentElement) return fa; fa = c; S = c.documentElement; F = I(c); Q.tagNameNoComments = d(function (a) { a.appendChild(c.createComment("")); return !a.getElementsByTagName("*").length });
                                            Q.attributes = d(function (a) { a.innerHTML = "\x3cselect\x3e\x3c/select\x3e"; a = typeof a.lastChild.getAttribute("multiple"); return "boolean" !== a && "string" !== a }); Q.getByClassName = d(function (a) { a.innerHTML = "\x3cdiv class\x3d'hidden e'\x3e\x3c/div\x3e\x3cdiv class\x3d'hidden'\x3e\x3c/div\x3e"; if (!a.getElementsByClassName || !a.getElementsByClassName("e").length) return !1; a.lastChild.className = "e"; return 2 === a.getElementsByClassName("e").length }); Q.getByName = d(function (a) {
                                                a.id = N + 0; a.innerHTML = "\x3ca name\x3d'" +
                                                    N + "'\x3e\x3c/a\x3e\x3cdiv name\x3d'" + N + "'\x3e\x3c/div\x3e"; S.insertBefore(a, S.firstChild); var b = c.getElementsByName && c.getElementsByName(N).length === 2 + c.getElementsByName(N + 0).length; Q.getIdNotName = !c.getElementById(N); S.removeChild(a); return b
                                            }); C.attrHandle = d(function (a) { a.innerHTML = "\x3ca href\x3d'#'\x3e\x3c/a\x3e"; return a.firstChild && typeof a.firstChild.getAttribute !== V && "#" === a.firstChild.getAttribute("href") }) ? {} : { href: function (a) { return a.getAttribute("href", 2) }, type: function (a) { return a.getAttribute("type") } };
                                            Q.getIdNotName ? (C.find.ID = function (a, b) { if (typeof b.getElementById !== V && !F) { var g = b.getElementById(a); return g && g.parentNode ? [g] : [] } }, C.filter.ID = function (a) { var b = a.replace(Ga, Aa); return function (a) { return a.getAttribute("id") === b } }) : (C.find.ID = function (a, g) { if (typeof g.getElementById !== V && !F) { var c = g.getElementById(a); return c ? c.id === a || typeof c.getAttributeNode !== V && c.getAttributeNode("id").value === a ? [c] : b : [] } }, C.filter.ID = function (a) {
                                                var b = a.replace(Ga, Aa); return function (a) {
                                                    return (a = typeof a.getAttributeNode !==
                                                        V && a.getAttributeNode("id")) && a.value === b
                                                }
                                            }); C.find.TAG = Q.tagNameNoComments ? function (a, b) { if (typeof b.getElementsByTagName !== V) return b.getElementsByTagName(a) } : function (a, b) { var g, c = [], f = 0, d = b.getElementsByTagName(a); if ("*" === a) { for (; g = d[f++];)1 === g.nodeType && c.push(g); return c } return d }; C.find.NAME = Q.getByName && function (a, b) { if (typeof b.getElementsByName !== V) return b.getElementsByName(name) }; C.find.CLASS = Q.getByClassName && function (a, b) { if (typeof b.getElementsByClassName !== V && !F) return b.getElementsByClassName(a) };
                                            ma = []; Y = [":focus"]; if (Q.qsa = g(c.querySelectorAll)) d(function (a) { a.innerHTML = "\x3cselect\x3e\x3coption selected\x3d''\x3e\x3c/option\x3e\x3c/select\x3e"; a.querySelectorAll("[selected]").length || Y.push("\\[[\\x20\\t\\r\\n\\f]*(?:checked|disabled|ismap|multiple|readonly|selected|value)"); a.querySelectorAll(":checked").length || Y.push(":checked") }), d(function (a) {
                                                a.innerHTML = "\x3cinput type\x3d'hidden' i\x3d''/\x3e"; a.querySelectorAll("[i^\x3d'']").length && Y.push("[*^$]\x3d[\\x20\\t\\r\\n\\f]*(?:\"\"|'')");
                                                a.querySelectorAll(":enabled").length || Y.push(":enabled", ":disabled"); a.querySelectorAll("*,:x"); Y.push(",.*:")
                                            }); (Q.matchesSelector = g(H = S.matchesSelector || S.mozMatchesSelector || S.webkitMatchesSelector || S.oMatchesSelector || S.msMatchesSelector)) && d(function (a) { Q.disconnectedMatch = H.call(a, "div"); H.call(a, "[s!\x3d'']:x"); ma.push("!\x3d", kb) }); Y = RegExp(Y.join("|")); ma = RegExp(ma.join("|")); Qa = g(S.contains) || S.compareDocumentPosition ? function (a, b) {
                                                var g = 9 === a.nodeType ? a.documentElement : a, c = b && b.parentNode;
                                                return a === c || !!(c && 1 === c.nodeType && (g.contains ? g.contains(c) : a.compareDocumentPosition && a.compareDocumentPosition(c) & 16))
                                            } : function (a, b) { if (b) for (; b = b.parentNode;)if (b === a) return !0; return !1 }; R = S.compareDocumentPosition ? function (a, b) { var g; return a === b ? (O = !0, 0) : (g = b.compareDocumentPosition && a.compareDocumentPosition && a.compareDocumentPosition(b)) ? g & 1 || a.parentNode && 11 === a.parentNode.nodeType ? a === c || Qa(T, a) ? -1 : b === c || Qa(T, b) ? 1 : 0 : g & 4 ? -1 : 1 : a.compareDocumentPosition ? -1 : 1 } : function (a, b) {
                                                var g, f = 0; g = a.parentNode;
                                                var d = b.parentNode, m = [a], q = [b]; if (a === b) return O = !0, 0; if (!g || !d) return a === c ? -1 : b === c ? 1 : g ? -1 : d ? 1 : 0; if (g === d) return k(a, b); for (g = a; g = g.parentNode;)m.unshift(g); for (g = b; g = g.parentNode;)q.unshift(g); for (; m[f] === q[f];)f++; return f ? k(m[f], q[f]) : m[f] === T ? -1 : q[f] === T ? 1 : 0
                                            }; O = !1;[0, 0].sort(R); Q.detectDuplicates = O; return fa
                                        }; m.matches = function (a, b) { return m(a, null, null, b) }; m.matchesSelector = function (a, b) {
                                            (a.ownerDocument || a) !== fa && y(a); b = b.replace(tb, "\x3d'$1']"); if (Q.matchesSelector && !(F || ma && ma.test(b) ||
                                                Y.test(b))) try { var g = H.call(a, b); if (g || Q.disconnectedMatch || a.document && 11 !== a.document.nodeType) return g } catch (c) { } return 0 < m(b, fa, null, [a]).length
                                        }; m.contains = function (a, b) { (a.ownerDocument || a) !== fa && y(a); return Qa(a, b) }; m.attr = function (a, b) { var g; (a.ownerDocument || a) !== fa && y(a); F || (b = b.toLowerCase()); return (g = C.attrHandle[b]) ? g(a) : F || Q.attributes ? a.getAttribute(b) : ((g = a.getAttributeNode(b)) || a.getAttribute(b)) && !0 === a[b] ? b : g && g.specified ? g.value : null }; m.error = function (a) {
                                            throw Error("Syntax error, unrecognized expression: " +
                                                a);
                                        }; m.uniqueSort = function (a) { var b, g = [], c = 1, f = 0; O = !Q.detectDuplicates; a.sort(R); if (O) { for (; b = a[c]; c++)b === a[c - 1] && (f = g.push(c)); for (; f--;)a.splice(g[f], 1) } return a }; v = m.getText = function (a) { var b, g = "", c = 0; b = a.nodeType; if (!b) for (; b = a[c]; c++)g += v(b); else if (1 === b || 9 === b || 11 === b) { if ("string" === typeof a.textContent) return a.textContent; for (a = a.firstChild; a; a = a.nextSibling)g += v(a) } else if (3 === b || 4 === b) return a.nodeValue; return g }; C = m.selectors = {
                                            cacheLength: 50, createPseudo: f, match: Xa, find: {}, relative: {
                                                "\x3e": {
                                                    dir: "parentNode",
                                                    first: !0
                                                }, " ": { dir: "parentNode" }, "+": { dir: "previousSibling", first: !0 }, "~": { dir: "previousSibling" }
                                            }, preFilter: {
                                                ATTR: function (a) { a[1] = a[1].replace(Ga, Aa); a[3] = (a[4] || a[5] || "").replace(Ga, Aa); "~\x3d" === a[2] && (a[3] = " " + a[3] + " "); return a.slice(0, 4) }, CHILD: function (a) { a[1] = a[1].toLowerCase(); "nth" === a[1].slice(0, 3) ? (a[3] || m.error(a[0]), a[4] = +(a[4] ? a[5] + (a[6] || 1) : 2 * ("even" === a[3] || "odd" === a[3])), a[5] = +(a[7] + a[8] || "odd" === a[3])) : a[3] && m.error(a[0]); return a }, PSEUDO: function (a) {
                                                    var b, g = !a[5] && a[2]; if (Xa.CHILD.test(a[0])) return null;
                                                    a[4] ? a[2] = a[4] : g && Cb.test(g) && (b = r(g, !0)) && (b = g.indexOf(")", g.length - b) - g.length) && (a[0] = a[0].slice(0, b), a[2] = g.slice(0, b)); return a.slice(0, 3)
                                                }
                                            }, filter: {
                                                TAG: function (a) { if ("*" === a) return function () { return !0 }; a = a.replace(Ga, Aa).toLowerCase(); return function (b) { return b.nodeName && b.nodeName.toLowerCase() === a } }, CLASS: function (a) {
                                                    var b = W[a + " "]; return b || (b = RegExp("(^|[\\x20\\t\\r\\n\\f])" + a + "([\\x20\\t\\r\\n\\f]|$)")) && W(a, function (a) {
                                                        return b.test(a.className || typeof a.getAttribute !== V && a.getAttribute("class") ||
                                                            "")
                                                    })
                                                }, ATTR: function (a, b, g) { return function (c) { c = m.attr(c, a); if (null == c) return "!\x3d" === b; if (!b) return !0; c += ""; return "\x3d" === b ? c === g : "!\x3d" === b ? c !== g : "^\x3d" === b ? g && 0 === c.indexOf(g) : "*\x3d" === b ? g && -1 < c.indexOf(g) : "$\x3d" === b ? g && c.slice(-g.length) === g : "~\x3d" === b ? -1 < (" " + c + " ").indexOf(g) : "|\x3d" === b ? c === g || c.slice(0, g.length + 1) === g + "-" : !1 } }, CHILD: function (a, b, g, c, f) {
                                                    var d = "nth" !== a.slice(0, 3), m = "last" !== a.slice(-4), k = "of-type" === b; return 1 === c && 0 === f ? function (a) { return !!a.parentNode } : function (b,
                                                        g, q) {
                                                            var h, e, r, u, x; g = d !== m ? "nextSibling" : "previousSibling"; var w = b.parentNode, n = k && b.nodeName.toLowerCase(); q = !q && !k; if (w) {
                                                                if (d) { for (; g;) { for (e = b; e = e[g];)if (k ? e.nodeName.toLowerCase() === n : 1 === e.nodeType) return !1; x = g = "only" === a && !x && "nextSibling" } return !0 } x = [m ? w.firstChild : w.lastChild]; if (m && q) for (q = w[N] || (w[N] = {}), h = q[a] || [], u = h[0] === U && h[1], r = h[0] === U && h[2], e = u && w.childNodes[u]; e = ++u && e && e[g] || (r = u = 0) || x.pop();) { if (1 === e.nodeType && ++r && e === b) { q[a] = [U, u, r]; break } } else if (q && (h = (b[N] || (b[N] = {}))[a]) &&
                                                                    h[0] === U) r = h[1]; else for (; (e = ++u && e && e[g] || (r = u = 0) || x.pop()) && ((k ? e.nodeName.toLowerCase() !== n : 1 !== e.nodeType) || !++r || (q && ((e[N] || (e[N] = {}))[a] = [U, r]), e !== b));); r -= f; return r === c || 0 === r % c && 0 <= r / c
                                                            }
                                                    }
                                                }, PSEUDO: function (a, b) {
                                                    var g, c = C.pseudos[a] || C.setFilters[a.toLowerCase()] || m.error("unsupported pseudo: " + a); return c[N] ? c(b) : 1 < c.length ? (g = [a, a, "", b], C.setFilters.hasOwnProperty(a.toLowerCase()) ? f(function (a, g) { for (var f, d = c(a, b), m = d.length; m--;)f = Ea.call(a, d[m]), a[f] = !(g[f] = d[m]) }) : function (a) {
                                                        return c(a,
                                                            0, g)
                                                    }) : c
                                                }
                                            }, pseudos: {
                                                not: f(function (a) { var b = [], g = [], c = s(a.replace(P, "$1")); return c[N] ? f(function (a, b, g, f) { f = c(a, null, f, []); for (var d = a.length; d--;)if (g = f[d]) a[d] = !(b[d] = g) }) : function (a, f, d) { b[0] = a; c(b, null, d, g); return !g.pop() } }), has: f(function (a) { return function (b) { return 0 < m(a, b).length } }), contains: f(function (a) { return function (b) { return -1 < (b.textContent || b.innerText || v(b)).indexOf(a) } }), lang: f(function (a) {
                                                    pa.test(a || "") || m.error("unsupported lang: " + a); a = a.replace(Ga, Aa).toLowerCase(); return function (b) {
                                                        var g;
                                                        do if (g = F ? b.getAttribute("xml:lang") || b.getAttribute("lang") : b.lang) return g = g.toLowerCase(), g === a || 0 === g.indexOf(a + "-"); while ((b = b.parentNode) && 1 === b.nodeType); return !1
                                                    }
                                                }), target: function (b) { var g = a.location && a.location.hash; return g && g.slice(1) === b.id }, root: function (a) { return a === S }, focus: function (a) { return a === fa.activeElement && (!fa.hasFocus || fa.hasFocus()) && !!(a.type || a.href || ~a.tabIndex) }, enabled: function (a) { return !1 === a.disabled }, disabled: function (a) { return !0 === a.disabled }, checked: function (a) {
                                                    var b =
                                                        a.nodeName.toLowerCase(); return "input" === b && !!a.checked || "option" === b && !!a.selected
                                                }, selected: function (a) { a.parentNode && a.parentNode.selectedIndex; return !0 === a.selected }, empty: function (a) { for (a = a.firstChild; a; a = a.nextSibling)if ("@" < a.nodeName || 3 === a.nodeType || 4 === a.nodeType) return !1; return !0 }, parent: function (a) { return !C.pseudos.empty(a) }, header: function (a) { return M.test(a.nodeName) }, input: function (a) { return xb.test(a.nodeName) }, button: function (a) {
                                                    var b = a.nodeName.toLowerCase(); return "input" === b &&
                                                        "button" === a.type || "button" === b
                                                }, text: function (a) { var b; return "input" === a.nodeName.toLowerCase() && "text" === a.type && (null == (b = a.getAttribute("type")) || b.toLowerCase() === a.type) }, first: e(function () { return [0] }), last: e(function (a, b) { return [b - 1] }), eq: e(function (a, b, g) { return [0 > g ? g + b : g] }), even: e(function (a, b) { for (var g = 0; g < b; g += 2)a.push(g); return a }), odd: e(function (a, b) { for (var g = 1; g < b; g += 2)a.push(g); return a }), lt: e(function (a, b, g) { for (b = 0 > g ? g + b : g; 0 <= --b;)a.push(b); return a }), gt: e(function (a, b, g) {
                                                    for (g =
                                                        0 > g ? g + b : g; ++g < b;)a.push(g); return a
                                                })
                                            }
                                        }; for (t in { radio: !0, checkbox: !0, file: !0, password: !0, image: !0 }) C.pseudos[t] = q(t); for (t in { submit: !0, reset: !0 }) C.pseudos[t] = h(t); s = m.compile = function (a, b) { var g, c = [], f = [], d = qb[a + " "]; if (!d) { b || (b = r(a)); for (g = b.length; g--;)d = z(b[g]), d[N] ? c.push(d) : f.push(d); d = qb(a, B(f, c)) } return d }; C.pseudos.nth = C.pseudos.eq; C.filters = D.prototype = C.pseudos; C.setFilters = new D; y(); m.attr = n.attr; n.find = m; n.expr = m.selectors; n.expr[":"] = n.expr.pseudos; n.unique = m.uniqueSort; n.text = m.getText;
                            n.isXMLDoc = m.isXML; n.contains = m.contains
                        })(a); var Cb = /Until$/, kb = /^(?:parents|prev(?:Until|All))/, Vb = /^.[^:#\[\.,]*$/, Lb = n.expr.match.needsContext, Yb = { children: !0, contents: !0, next: !0, prev: !0 }; n.fn.extend({
                            find: function (a) {
                                var b, g, c, f = this.length; if ("string" !== typeof a) return c = this, this.pushStack(n(a).filter(function () { for (b = 0; b < f; b++)if (n.contains(c[b], this)) return !0 })); g = []; for (b = 0; b < f; b++)n.find(a, this[b], g); g = this.pushStack(1 < f ? n.unique(g) : g); g.selector = (this.selector ? this.selector + " " : "") + a;
                                return g
                            }, has: function (a) { var b, g = n(a, this), c = g.length; return this.filter(function () { for (b = 0; b < c; b++)if (n.contains(this, g[b])) return !0 }) }, not: function (a) { return this.pushStack(z(this, a, !1)) }, filter: function (a) { return this.pushStack(z(this, a, !0)) }, is: function (a) { return !!a && ("string" === typeof a ? Lb.test(a) ? 0 <= n(a, this.context).index(this[0]) : 0 < n.filter(a, this).length : 0 < this.filter(a).length) }, closest: function (a, b) {
                                for (var g, c = 0, f = this.length, d = [], m = Lb.test(a) || "string" !== typeof a ? n(a, b || this.context) :
                                    0; c < f; c++)for (g = this[c]; g && g.ownerDocument && g !== b && 11 !== g.nodeType;) { if (m ? -1 < m.index(g) : n.find.matchesSelector(g, a)) { d.push(g); break } g = g.parentNode } return this.pushStack(1 < d.length ? n.unique(d) : d)
                            }, index: function (a) { return a ? "string" === typeof a ? n.inArray(this[0], n(a)) : n.inArray(a.jquery ? a[0] : a, this) : this[0] && this[0].parentNode ? this.first().prevAll().length : -1 }, add: function (a, b) { var g = "string" === typeof a ? n(a, b) : n.makeArray(a && a.nodeType ? [a] : a), g = n.merge(this.get(), g); return this.pushStack(n.unique(g)) },
                            addBack: function (a) { return this.add(null == a ? this.prevObject : this.prevObject.filter(a)) }
                        }); n.fn.andSelf = n.fn.addBack; n.each({
                            parent: function (a) { return (a = a.parentNode) && 11 !== a.nodeType ? a : null }, parents: function (a) { return n.dir(a, "parentNode") }, parentsUntil: function (a, b, g) { return n.dir(a, "parentNode", g) }, next: function (a) { return r(a, "nextSibling") }, prev: function (a) { return r(a, "previousSibling") }, nextAll: function (a) { return n.dir(a, "nextSibling") }, prevAll: function (a) { return n.dir(a, "previousSibling") }, nextUntil: function (a,
                                b, g) { return n.dir(a, "nextSibling", g) }, prevUntil: function (a, b, g) { return n.dir(a, "previousSibling", g) }, siblings: function (a) { return n.sibling((a.parentNode || {}).firstChild, a) }, children: function (a) { return n.sibling(a.firstChild) }, contents: function (a) { return n.nodeName(a, "iframe") ? a.contentDocument || a.contentWindow.document : n.merge([], a.childNodes) }
                        }, function (a, b) {
                            n.fn[a] = function (g, c) {
                                var f = n.map(this, b, g); Cb.test(a) || (c = g); c && "string" === typeof c && (f = n.filter(c, f)); f = 1 < this.length && !Yb[a] ? n.unique(f) :
                                    f; 1 < this.length && kb.test(a) && (f = f.reverse()); return this.pushStack(f)
                            }
                        }); n.extend({ filter: function (a, b, g) { g && (a = ":not(" + a + ")"); return 1 === b.length ? n.find.matchesSelector(b[0], a) ? [b[0]] : [] : n.find.matches(a, b) }, dir: function (a, b, g) { var c = []; for (a = a[b]; a && 9 !== a.nodeType && (g === l || 1 !== a.nodeType || !n(a).is(g));)1 === a.nodeType && c.push(a), a = a[b]; return c }, sibling: function (a, b) { for (var g = []; a; a = a.nextSibling)1 === a.nodeType && a !== b && g.push(a); return g } }); var Ib = "abbr|article|aside|audio|bdi|canvas|data|datalist|details|figcaption|figure|footer|header|hgroup|mark|meter|nav|output|progress|section|summary|time|video",
                            Zb = / jQuery\d+="(?:null|\d+)"/g, Mb = RegExp("\x3c(?:" + Ib + ")[\\s/\x3e]", "i"), Db = /^\s+/, Nb = /<(?!area|br|col|embed|hr|img|input|link|meta|param)(([\w:]+)[^>]*)\/>/gi, Ob = /<([\w:]+)/, Pb = /<tbody/i, Eb = /<|&#?\w+;/, $b = /<(?:script|style|link)/i, wb = /^(?:checkbox|radio)$/i, Ha = /checked\s*(?:[^=]|=\s*.checked.)/i, Ya = /^$|\/(?:java|ecma)script/i, Ua = /^true\/(.*)/, Za = /^\s*<!(?:\[CDATA\[|--)|(?:\]\]|--)>\s*$/g, ga = {
                                option: [1, "\x3cselect multiple\x3d'multiple'\x3e", "\x3c/select\x3e"], legend: [1, "\x3cfieldset\x3e", "\x3c/fieldset\x3e"],
                                area: [1, "\x3cmap\x3e", "\x3c/map\x3e"], param: [1, "\x3cobject\x3e", "\x3c/object\x3e"], thead: [1, "\x3ctable\x3e", "\x3c/table\x3e"], tr: [2, "\x3ctable\x3e\x3ctbody\x3e", "\x3c/tbody\x3e\x3c/table\x3e"], col: [2, "\x3ctable\x3e\x3ctbody\x3e\x3c/tbody\x3e\x3ccolgroup\x3e", "\x3c/colgroup\x3e\x3c/table\x3e"], td: [3, "\x3ctable\x3e\x3ctbody\x3e\x3ctr\x3e", "\x3c/tr\x3e\x3c/tbody\x3e\x3c/table\x3e"], _default: n.support.htmlSerialize ? [0, "", ""] : [1, "X\x3cdiv\x3e", "\x3c/div\x3e"]
                            }, sa = t(M).appendChild(M.createElement("div"));
    ga.optgroup = ga.option; ga.tbody = ga.tfoot = ga.colgroup = ga.caption = ga.thead; ga.th = ga.td; n.fn.extend({
        text: function (a) { return n.access(this, function (a) { return a === l ? n.text(this) : this.empty().append((this[0] && this[0].ownerDocument || M).createTextNode(a)) }, null, a, arguments.length) }, wrapAll: function (a) {
            if (n.isFunction(a)) return this.each(function (b) { n(this).wrapAll(a.call(this, b)) }); if (this[0]) {
                var b = n(a, this[0].ownerDocument).eq(0).clone(!0); this[0].parentNode && b.insertBefore(this[0]); b.map(function () {
                    for (var a =
                        this; a.firstChild && 1 === a.firstChild.nodeType;)a = a.firstChild; return a
                }).append(this)
            } return this
        }, wrapInner: function (a) { return n.isFunction(a) ? this.each(function (b) { n(this).wrapInner(a.call(this, b)) }) : this.each(function () { var b = n(this), g = b.contents(); g.length ? g.wrapAll(a) : b.append(a) }) }, wrap: function (a) { var b = n.isFunction(a); return this.each(function (g) { n(this).wrapAll(b ? a.call(this, g) : a) }) }, unwrap: function () { return this.parent().each(function () { n.nodeName(this, "body") || n(this).replaceWith(this.childNodes) }).end() },
        append: function () { return this.domManip(arguments, !0, function (a) { 1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || this.appendChild(a) }) }, prepend: function () { return this.domManip(arguments, !0, function (a) { 1 !== this.nodeType && 11 !== this.nodeType && 9 !== this.nodeType || this.insertBefore(a, this.firstChild) }) }, before: function () { return this.domManip(arguments, !1, function (a) { this.parentNode && this.parentNode.insertBefore(a, this) }) }, after: function () {
            return this.domManip(arguments, !1, function (a) {
                this.parentNode &&
                this.parentNode.insertBefore(a, this.nextSibling)
            })
        }, remove: function (a, b) { for (var g, c = 0; null != (g = this[c]); c++)if (!a || 0 < n.filter(a, [g]).length) b || 1 !== g.nodeType || n.cleanData(u(g)), g.parentNode && (b && n.contains(g.ownerDocument, g) && y(u(g, "script")), g.parentNode.removeChild(g)); return this }, empty: function () { for (var a, b = 0; null != (a = this[b]); b++) { for (1 === a.nodeType && n.cleanData(u(a, !1)); a.firstChild;)a.removeChild(a.firstChild); a.options && n.nodeName(a, "select") && (a.options.length = 0) } return this }, clone: function (a,
            b) { a = null == a ? !1 : a; b = null == b ? a : b; return this.map(function () { return n.clone(this, a, b) }) }, html: function (a) {
                return n.access(this, function (a) {
                    var b = this[0] || {}, g = 0, c = this.length; if (a === l) return 1 === b.nodeType ? b.innerHTML.replace(Zb, "") : l; if ("string" === typeof a && !($b.test(a) || !n.support.htmlSerialize && Mb.test(a) || !n.support.leadingWhitespace && Db.test(a) || ga[(Ob.exec(a) || ["", ""])[1].toLowerCase()])) {
                        a = a.replace(Nb, "\x3c$1\x3e\x3c/$2\x3e"); try {
                            for (; g < c; g++)b = this[g] || {}, 1 === b.nodeType && (n.cleanData(u(b, !1)),
                                b.innerHTML = a); b = 0
                        } catch (f) { }
                    } b && this.empty().append(a)
                }, null, a, arguments.length)
            }, replaceWith: function (a) { n.isFunction(a) || "string" === typeof a || (a = n(a).not(this).detach()); return this.domManip([a], !0, function (a) { var b = this.nextSibling, g = this.parentNode; g && (n(this).remove(), g.insertBefore(a, b)) }) }, detach: function (a) { return this.remove(a, !0) }, domManip: function (a, b, g) {
                a = X.apply([], a); var c, f, d, m, k = 0, q = this.length, h = this, e = q - 1, r = a[0], x = n.isFunction(r); if (x || !(1 >= q || "string" !== typeof r || n.support.checkClone) &&
                    Ha.test(r)) return this.each(function (c) { var f = h.eq(c); x && (a[0] = r.call(this, c, b ? f.html() : l)); f.domManip(a, b, g) }); if (q && (m = n.buildFragment(a, this[0].ownerDocument, !1, this), c = m.firstChild, 1 === m.childNodes.length && (m = c), c)) {
                        b = b && n.nodeName(c, "tr"); d = n.map(u(m, "script"), s); for (f = d.length; k < q; k++)c = m, k !== e && (c = n.clone(c, !0, !0), f && n.merge(d, u(c, "script"))), g.call(b && n.nodeName(this[k], "table") ? this[k].getElementsByTagName("tbody")[0] || this[k].appendChild(this[k].ownerDocument.createElement("tbody")) : this[k],
                            c, k); if (f) for (m = d[d.length - 1].ownerDocument, n.map(d, v), k = 0; k < f; k++)c = d[k], Ya.test(c.type || "") && !n._data(c, "globalEval") && n.contains(m, c) && (c.src ? n.ajax({ url: c.src, type: "GET", dataType: "script", async: !1, global: !1, "throws": !0 }) : n.globalEval((c.text || c.textContent || c.innerHTML || "").replace(Za, ""))); m = c = null
                    } return this
            }
    }); n.each({ appendTo: "append", prependTo: "prepend", insertBefore: "before", insertAfter: "after", replaceAll: "replaceWith" }, function (a, b) {
        n.fn[a] = function (a) {
            for (var g = 0, c = [], f = n(a), d = f.length -
                1; g <= d; g++)a = g === d ? this : this.clone(!0), n(f[g])[b](a), Z.apply(c, a.get()); return this.pushStack(c)
        }
    }); n.extend({
        clone: function (a, b, c) {
            var f, d, m, k, q, h = n.contains(a.ownerDocument, a); n.support.html5Clone || n.isXMLDoc(a) || !Mb.test("\x3c" + a.nodeName + "\x3e") ? m = a.cloneNode(!0) : (sa.innerHTML = a.outerHTML, sa.removeChild(m = sa.firstChild)); if (!(n.support.noCloneEvent && n.support.noCloneChecked || 1 !== a.nodeType && 11 !== a.nodeType || n.isXMLDoc(a))) for (f = u(m), q = u(a), k = 0; null != (d = q[k]); ++k)if (f[k]) {
                var e = f[k], r = void 0, x =
                    void 0, w = void 0; if (1 === e.nodeType) {
                        r = e.nodeName.toLowerCase(); if (!n.support.noCloneEvent && e[n.expando]) { w = n._data(e); for (x in w.events) n.removeEvent(e, x, w.handle); e.removeAttribute(n.expando) } if ("script" === r && e.text !== d.text) s(e).text = d.text, v(e); else if ("object" === r) e.parentNode && (e.outerHTML = d.outerHTML), n.support.html5Clone && d.innerHTML && !n.trim(e.innerHTML) && (e.innerHTML = d.innerHTML); else if ("input" === r && wb.test(d.type)) e.defaultChecked = e.checked = d.checked, e.value !== d.value && (e.value = d.value);
                        else if ("option" === r) e.defaultSelected = e.selected = d.defaultSelected; else if ("input" === r || "textarea" === r) e.defaultValue = d.defaultValue
                    }
            } if (b) if (c) for (q = q || u(a), f = f || u(m), k = 0; null != (d = q[k]); k++)g(d, f[k]); else g(a, m); f = u(m, "script"); 0 < f.length && y(f, !h && u(a, "script")); return m
        }, buildFragment: function (a, b, g, c) {
            for (var f, d, m, k, h, e, r = a.length, x = t(b), w = [], A = 0; A < r; A++)if ((d = a[A]) || 0 === d) if ("object" === n.type(d)) n.merge(w, d.nodeType ? [d] : d); else if (Eb.test(d)) {
                m = m || x.appendChild(b.createElement("div")); k = (Ob.exec(d) ||
                    ["", ""])[1].toLowerCase(); e = ga[k] || ga._default; m.innerHTML = e[1] + d.replace(Nb, "\x3c$1\x3e\x3c/$2\x3e") + e[2]; for (f = e[0]; f--;)m = m.lastChild; !n.support.leadingWhitespace && Db.test(d) && w.push(b.createTextNode(Db.exec(d)[0])); if (!n.support.tbody) for (f = (d = "table" !== k || Pb.test(d) ? "\x3ctable\x3e" !== e[1] || Pb.test(d) ? 0 : m : m.firstChild) && d.childNodes.length; f--;)n.nodeName(h = d.childNodes[f], "tbody") && !h.childNodes.length && d.removeChild(h); n.merge(w, m.childNodes); for (m.textContent = ""; m.firstChild;)m.removeChild(m.firstChild);
                m = x.lastChild
            } else w.push(b.createTextNode(d)); m && x.removeChild(m); n.support.appendChecked || n.grep(u(w, "input"), q); for (A = 0; d = w[A++];)if (!c || -1 === n.inArray(d, c)) if (a = n.contains(d.ownerDocument, d), m = u(x.appendChild(d), "script"), a && y(m), g) for (f = 0; d = m[f++];)Ya.test(d.type || "") && g.push(d); return x
        }, cleanData: function (a, b) {
            for (var g, c, f, d, m = 0, k = n.expando, q = n.cache, h = n.support.deleteExpando, e = n.event.special; null != (g = a[m]); m++)if (b || n.acceptData(g)) if (d = (f = g[k]) && q[f]) {
                if (d.events) for (c in d.events) e[c] ?
                    n.event.remove(g, c) : n.removeEvent(g, c, d.handle); q[f] && (delete q[f], h ? delete g[k] : typeof g.removeAttribute !== G ? g.removeAttribute(k) : g[k] = null, P.push(f))
            }
        }
    }); var qa, ka, la, wa = /alpha\([^)]*\)/i, Ba = /opacity\s*=\s*([^)]*)/, pa = /^(top|right|bottom|left)$/, $a = /^(none|table(?!-c[ea]).+)/, Qb = /^margin/, Ka = RegExp("^(" + va + ")(.*)$", "i"), rb = RegExp("^(" + va + ")(?!px)[a-z%]+$", "i"), lb = RegExp("^([+-])\x3d(" + va + ")", "i"), Jb = { BODY: "block" }, Ra = { position: "absolute", visibility: "hidden", display: "block" }, Rb = {
        letterSpacing: 0,
        fontWeight: 400
    }, xa = ["Top", "Right", "Bottom", "Left"], na = ["Webkit", "O", "Moz", "ms"]; n.fn.extend({ css: function (a, b) { return n.access(this, function (a, b, g) { var c, f = {}, d = 0; if (n.isArray(b)) { c = ka(a); for (g = b.length; d < g; d++)f[b[d]] = n.css(a, b[d], !1, c); return f } return g !== l ? n.style(a, b, g) : n.css(a, b) }, a, b, 1 < arguments.length) }, show: function () { return D(this, !0) }, hide: function () { return D(this) }, toggle: function (a) { var b = "boolean" === typeof a; return this.each(function () { (b ? a : x(this)) ? n(this).show() : n(this).hide() }) } });
    n.extend({
        cssHooks: { opacity: { get: function (a, b) { if (b) { var g = la(a, "opacity"); return "" === g ? "1" : g } } } }, cssNumber: { columnCount: !0, fillOpacity: !0, fontWeight: !0, lineHeight: !0, opacity: !0, orphans: !0, widows: !0, zIndex: !0, zoom: !0 }, cssProps: { "float": n.support.cssFloat ? "cssFloat" : "styleFloat" }, style: function (a, b, g, c) {
            if (a && 3 !== a.nodeType && 8 !== a.nodeType && a.style) {
                var f, d, m, k = n.camelCase(b), q = a.style; b = n.cssProps[k] || (n.cssProps[k] = w(q, k)); m = n.cssHooks[b] || n.cssHooks[k]; if (g !== l) {
                    if (d = typeof g, "string" === d && (f = lb.exec(g)) &&
                        (g = (f[1] + 1) * f[2] + parseFloat(n.css(a, b)), d = "number"), !(null == g || "number" === d && isNaN(g) || ("number" !== d || n.cssNumber[k] || (g += "px"), n.support.clearCloneStyle || "" !== g || 0 !== b.indexOf("background") || (q[b] = "inherit"), m && "set" in m && (g = m.set(a, g, c)) === l))) try { q[b] = g } catch (h) { }
                } else return m && "get" in m && (f = m.get(a, !1, c)) !== l ? f : q[b]
            }
        }, css: function (a, b, g, c) {
            var f, d; d = n.camelCase(b); b = n.cssProps[d] || (n.cssProps[d] = w(a.style, d)); (d = n.cssHooks[b] || n.cssHooks[d]) && "get" in d && (f = d.get(a, !0, g)); f === l && (f = la(a, b, c));
            "normal" === f && b in Rb && (f = Rb[b]); return "" === g || g ? (a = parseFloat(f), !0 === g || n.isNumeric(a) ? a || 0 : f) : f
        }, swap: function (a, b, g, c) { var f, d = {}; for (f in b) d[f] = a.style[f], a.style[f] = b[f]; g = g.apply(a, c || []); for (f in b) a.style[f] = d[f]; return g }
    }); a.getComputedStyle ? (ka = function (b) { return a.getComputedStyle(b, null) }, la = function (a, b, g) {
        var c, f = (g = g || ka(a)) ? g.getPropertyValue(b) || g[b] : l, d = a.style; g && ("" !== f || n.contains(a.ownerDocument, a) || (f = n.style(a, b)), rb.test(f) && Qb.test(b) && (a = d.width, b = d.minWidth, c = d.maxWidth,
            d.minWidth = d.maxWidth = d.width = f, f = g.width, d.width = a, d.minWidth = b, d.maxWidth = c)); return f
    }) : M.documentElement.currentStyle && (ka = function (a) { return a.currentStyle }, la = function (a, b, g) { var c, f, d = (g = g || ka(a)) ? g[b] : l, m = a.style; null == d && m && m[b] && (d = m[b]); if (rb.test(d) && !pa.test(b)) { g = m.left; if (f = (c = a.runtimeStyle) && c.left) c.left = a.currentStyle.left; m.left = "fontSize" === b ? "1em" : d; d = m.pixelLeft + "px"; m.left = g; f && (c.left = f) } return "" === d ? "auto" : d }); n.each(["height", "width"], function (a, b) {
        n.cssHooks[b] = {
            get: function (a,
                g, c) { if (g) return 0 === a.offsetWidth && $a.test(n.css(a, "display")) ? n.swap(a, Ra, function () { return E(a, b, c) }) : E(a, b, c) }, set: function (a, g, c) { var f = c && ka(a); return A(a, g, c ? I(a, b, c, n.support.boxSizing && "border-box" === n.css(a, "boxSizing", !1, f), f) : 0) }
        }
    }); n.support.opacity || (n.cssHooks.opacity = {
        get: function (a, b) { return Ba.test((b && a.currentStyle ? a.currentStyle.filter : a.style.filter) || "") ? 0.01 * parseFloat(RegExp.$1) + "" : b ? "1" : "" }, set: function (a, b) {
            var g = a.style, c = a.currentStyle, f = n.isNumeric(b) ? "alpha(opacity\x3d" +
                100 * b + ")" : "", d = c && c.filter || g.filter || ""; g.zoom = 1; if ((1 <= b || "" === b) && "" === n.trim(d.replace(wa, "")) && g.removeAttribute && (g.removeAttribute("filter"), "" === b || c && !c.filter)) return; g.filter = wa.test(d) ? d.replace(wa, f) : d + " " + f
        }
    }); n(function () {
        n.support.reliableMarginRight || (n.cssHooks.marginRight = { get: function (a, b) { if (b) return n.swap(a, { display: "inline-block" }, la, [a, "marginRight"]) } }); !n.support.pixelPosition && n.fn.position && n.each(["top", "left"], function (a, b) {
            n.cssHooks[b] = {
                get: function (a, g) {
                    if (g) return g =
                        la(a, b), rb.test(g) ? n(a).position()[b] + "px" : g
                }
            }
        })
    }); n.expr && n.expr.filters && (n.expr.filters.hidden = function (a) { return 0 >= a.offsetWidth && 0 >= a.offsetHeight || !n.support.reliableHiddenOffsets && "none" === (a.style && a.style.display || n.css(a, "display")) }, n.expr.filters.visible = function (a) { return !n.expr.filters.hidden(a) }); n.each({ margin: "", padding: "", border: "Width" }, function (a, b) {
        n.cssHooks[a + b] = {
            expand: function (g) {
                var c = 0, f = {}; for (g = "string" === typeof g ? g.split(" ") : [g]; 4 > c; c++)f[a + xa[c] + b] = g[c] || g[c - 2] || g[0];
                return f
            }
        }; Qb.test(a) || (n.cssHooks[a + b].set = A)
    }); var mb = /%20/g, La = /\[\]$/, Sb = /\r?\n/g, ac = /^(?:submit|button|image|reset|file)$/i, bc = /^(?:input|select|textarea|keygen)/i; n.fn.extend({
        serialize: function () { return n.param(this.serializeArray()) }, serializeArray: function () {
            return this.map(function () { var a = n.prop(this, "elements"); return a ? n.makeArray(a) : this }).filter(function () { var a = this.type; return this.name && !n(this).is(":disabled") && bc.test(this.nodeName) && !ac.test(a) && (this.checked || !wb.test(a)) }).map(function (a,
                b) { var g = n(this).val(); return null == g ? null : n.isArray(g) ? n.map(g, function (a) { return { name: b.name, value: a.replace(Sb, "\r\n") } }) : { name: b.name, value: g.replace(Sb, "\r\n") } }).get()
        }
    }); n.param = function (a, b) {
        var g, c = [], f = function (a, b) { b = n.isFunction(b) ? b() : null == b ? "" : b; c[c.length] = encodeURIComponent(a) + "\x3d" + encodeURIComponent(b) }; b === l && (b = n.ajaxSettings && n.ajaxSettings.traditional); if (n.isArray(a) || a.jquery && !n.isPlainObject(a)) n.each(a, function () { f(this.name, this.value) }); else for (g in a) S(g, a[g], b, f);
        return c.join("\x26").replace(mb, "+")
    }; n.each("blur focus focusin focusout load resize scroll unload click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup error contextmenu".split(" "), function (a, b) { n.fn[b] = function (a, g) { return 0 < arguments.length ? this.on(b, null, a, g) : this.trigger(b) } }); n.fn.hover = function (a, b) { return this.mouseenter(a).mouseleave(b || a) }; var Ia, ta, Fb = n.now(), ab = /\?/, nb = /#.*$/, Ca = /([?&])_=[^&]*/, Ja = /^(.*?):[ \t]*([^\r\n]*)\r?$/mg,
        Na = /^(?:GET|HEAD)$/, bb = /^\/\//, ob = /^([\w.+-]+:)(?:\/\/([^\/?#:]*)(?::(\d+)|)|)/, cb = n.fn.load, db = {}, Va = {}, tb = "*/".concat("*"); try { ta = Q.href } catch (gc) { ta = M.createElement("a"), ta.href = "", ta = ta.href } Ia = ob.exec(ta.toLowerCase()) || []; n.fn.load = function (a, b, g) {
            if ("string" !== typeof a && cb) return cb.apply(this, arguments); var c, f, d, m = this, k = a.indexOf(" "); 0 <= k && (c = a.slice(k, a.length), a = a.slice(0, k)); n.isFunction(b) ? (g = b, b = l) : b && "object" === typeof b && (d = "POST"); 0 < m.length && n.ajax({
                url: a, type: d, dataType: "html",
                data: b
            }).done(function (a) { f = arguments; m.html(c ? n("\x3cdiv\x3e").append(n.parseHTML(a)).find(c) : a) }).complete(g && function (a, b) { m.each(g, f || [a.responseText, b, a]) }); return this
        }; n.each("ajaxStart ajaxStop ajaxComplete ajaxError ajaxSuccess ajaxSend".split(" "), function (a, b) { n.fn[b] = function (a) { return this.on(b, a) } }); n.each(["get", "post"], function (a, b) { n[b] = function (a, g, c, f) { n.isFunction(g) && (f = f || c, c = g, g = l); return n.ajax({ url: a, type: b, dataType: f, data: g, success: c }) } }); n.extend({
            active: 0, lastModified: {},
            etag: {}, ajaxSettings: {
                url: ta, type: "GET", isLocal: /^(?:about|app|app-storage|.+-extension|file|res|widget):$/.test(Ia[1]), global: !0, processData: !0, async: !0, contentType: "application/x-www-form-urlencoded; charset\x3dUTF-8", accepts: { "*": tb, text: "text/plain", html: "text/html", xml: "application/xml, text/xml", json: "application/json, text/javascript" }, contents: { xml: /xml/, html: /html/, json: /json/ }, responseFields: { xml: "responseXML", text: "responseText" }, converters: {
                    "* text": a.String, "text html": !0, "text json": n.parseJSON,
                    "text xml": n.parseXML
                }, flatOptions: { url: !0, context: !0 }
            }, ajaxSetup: function (a, b) { return b ? Y(Y(a, n.ajaxSettings), b) : Y(n.ajaxSettings, a) }, ajaxPrefilter: B(db), ajaxTransport: B(Va), ajax: function (a, b) {
                function g(a, b, c, f) {
                    var e, B, D, K, C = b; if (2 !== t) {
                        t = 2; k && clearTimeout(k); h = l; m = f || ""; v.readyState = 0 < a ? 4 : 0; if (c) {
                            K = r; f = v; var I, s, O, E, y = K.contents, fa = K.dataTypes, S = K.responseFields; for (E in S) E in c && (f[S[E]] = c[E]); for (; "*" === fa[0];)fa.shift(), s === l && (s = K.mimeType || f.getResponseHeader("Content-Type")); if (s) for (E in y) if (y[E] &&
                                y[E].test(s)) { fa.unshift(E); break } if (fa[0] in c) O = fa[0]; else { for (E in c) { if (!fa[0] || K.converters[E + " " + fa[0]]) { O = E; break } I || (I = E) } O = O || I } O ? (O !== fa[0] && fa.unshift(O), K = c[O]) : K = void 0
                        } if (200 <= a && 300 > a || 304 === a) if (r.ifModified && ((c = v.getResponseHeader("Last-Modified")) && (n.lastModified[d] = c), (c = v.getResponseHeader("etag")) && (n.etag[d] = c)), 204 === a) e = !0, C = "nocontent"; else if (304 === a) e = !0, C = "notmodified"; else {
                            a: {
                                B = r; D = K; var F, Y, C = {}; I = 0; s = B.dataTypes.slice(); O = s[0]; B.dataFilter && (D = B.dataFilter(D, B.dataType));
                                if (s[1]) for (Y in B.converters) C[Y.toLowerCase()] = B.converters[Y]; for (; c = s[++I];)if ("*" !== c) { if ("*" !== O && O !== c) { Y = C[O + " " + c] || C["* " + c]; if (!Y) for (F in C) if (e = F.split(" "), e[1] === c && (Y = C[O + " " + e[0]] || C["* " + e[0]])) { !0 === Y ? Y = C[F] : !0 !== C[F] && (c = e[0], s.splice(I--, 0, c)); break } if (!0 !== Y) if (Y && B["throws"]) D = Y(D); else try { D = Y(D) } catch (ma) { e = { state: "parsererror", error: Y ? ma : "No conversion from " + O + " to " + c }; break a } } O = c } e = { state: "success", data: D }
                            } C = e.state; B = e.data; D = e.error; e = !D
                        } else if (D = C, a || !C) C = "error",
                            0 > a && (a = 0); v.status = a; v.statusText = (b || C) + ""; e ? w.resolveWith(u, [B, C, v]) : w.rejectWith(u, [v, C, D]); v.statusCode(z); z = l; q && x.trigger(e ? "ajaxSuccess" : "ajaxError", [v, r, e ? B : D]); A.fireWith(u, [v, C]); q && (x.trigger("ajaxComplete", [v, r]), --n.active || n.event.trigger("ajaxStop"))
                    }
                } "object" === typeof a && (b = a, a = l); b = b || {}; var c, f, d, m, k, q, h, e, r = n.ajaxSetup({}, b), u = r.context || r, x = r.context && (u.nodeType || u.jquery) ? n(u) : n.event, w = n.Deferred(), A = n.Callbacks("once memory"), z = r.statusCode || {}, B = {}, D = {}, t = 0, C = "canceled",
                    v = {
                        readyState: 0, getResponseHeader: function (a) { var b; if (2 === t) { if (!e) for (e = {}; b = Ja.exec(m);)e[b[1].toLowerCase()] = b[2]; b = e[a.toLowerCase()] } return null == b ? null : b }, getAllResponseHeaders: function () { return 2 === t ? m : null }, setRequestHeader: function (a, b) { var g = a.toLowerCase(); t || (a = D[g] = D[g] || a, B[a] = b); return this }, overrideMimeType: function (a) { t || (r.mimeType = a); return this }, statusCode: function (a) { var b; if (a) if (2 > t) for (b in a) z[b] = [z[b], a[b]]; else v.always(a[v.status]); return this }, abort: function (a) {
                            a = a ||
                            C; h && h.abort(a); g(0, a); return this
                        }
                    }; w.promise(v).complete = A.add; v.success = v.done; v.error = v.fail; r.url = ((a || r.url || ta) + "").replace(nb, "").replace(bb, Ia[1] + "//"); r.type = b.method || b.type || r.method || r.type; r.dataTypes = n.trim(r.dataType || "*").toLowerCase().match(oa) || [""]; null == r.crossDomain && (c = ob.exec(r.url.toLowerCase()), r.crossDomain = !(!c || c[1] === Ia[1] && c[2] === Ia[2] && (c[3] || ("http:" === c[1] ? 80 : 443)) == (Ia[3] || ("http:" === Ia[1] ? 80 : 443)))); r.data && r.processData && "string" !== typeof r.data && (r.data = n.param(r.data,
                        r.traditional)); K(db, r, b, v); if (2 === t) return v; (q = r.global) && 0 === n.active++ && n.event.trigger("ajaxStart"); r.type = r.type.toUpperCase(); r.hasContent = !Na.test(r.type); d = r.url; r.hasContent || (r.data && (d = r.url += (ab.test(d) ? "\x26" : "?") + r.data, delete r.data), !1 === r.cache && (r.url = Ca.test(d) ? d.replace(Ca, "$1_\x3d" + Fb++) : d + (ab.test(d) ? "\x26" : "?") + "_\x3d" + Fb++)); r.ifModified && (n.lastModified[d] && v.setRequestHeader("If-Modified-Since", n.lastModified[d]), n.etag[d] && v.setRequestHeader("If-None-Match", n.etag[d]));
                (r.data && r.hasContent && !1 !== r.contentType || b.contentType) && v.setRequestHeader("Content-Type", r.contentType); v.setRequestHeader("Accept", r.dataTypes[0] && r.accepts[r.dataTypes[0]] ? r.accepts[r.dataTypes[0]] + ("*" !== r.dataTypes[0] ? ", " + tb + "; q\x3d0.01" : "") : r.accepts["*"]); for (f in r.headers) v.setRequestHeader(f, r.headers[f]); if (r.beforeSend && (!1 === r.beforeSend.call(u, v, r) || 2 === t)) return v.abort(); C = "abort"; for (f in { success: 1, error: 1, complete: 1 }) v[f](r[f]); if (h = K(Va, r, b, v)) {
                    v.readyState = 1; q && x.trigger("ajaxSend",
                        [v, r]); r.async && 0 < r.timeout && (k = setTimeout(function () { v.abort("timeout") }, r.timeout)); try { t = 1, h.send(B, g) } catch (I) { if (2 > t) g(-1, I); else throw I; }
                } else g(-1, "No Transport"); return v
            }, getScript: function (a, b) { return n.get(a, l, b, "script") }, getJSON: function (a, b, g) { return n.get(a, b, g, "json") }
        }); n.ajaxSetup({
            accepts: { script: "text/javascript, application/javascript, application/ecmascript, application/x-ecmascript" }, contents: { script: /(?:java|ecma)script/ }, converters: {
                "text script": function (a) {
                    n.globalEval(a);
                    return a
                }
            }
        }); n.ajaxPrefilter("script", function (a) { a.cache === l && (a.cache = !1); a.crossDomain && (a.type = "GET", a.global = !1) }); n.ajaxTransport("script", function (a) {
            if (a.crossDomain) {
                var b, g = M.head || n("head")[0] || M.documentElement; return {
                    send: function (c, f) {
                        b = M.createElement("script"); b.async = !0; a.scriptCharset && (b.charset = a.scriptCharset); b.src = a.url; b.onload = b.onreadystatechange = function (a, g) {
                            if (g || !b.readyState || /loaded|complete/.test(b.readyState)) b.onload = b.onreadystatechange = null, b.parentNode && b.parentNode.removeChild(b),
                                b = null, g || f(200, "success")
                        }; g.insertBefore(b, g.firstChild)
                    }, abort: function () { if (b) b.onload(l, !0) }
                }
            }
        }); var Tb = [], Gb = /(=)\?(?=&|$)|\?\?/; n.ajaxSetup({ jsonp: "callback", jsonpCallback: function () { var a = Tb.pop() || n.expando + "_" + Fb++; this[a] = !0; return a } }); n.ajaxPrefilter("json jsonp", function (b, g, c) {
            var f, d, m, k = !1 !== b.jsonp && (Gb.test(b.url) ? "url" : "string" === typeof b.data && !(b.contentType || "").indexOf("application/x-www-form-urlencoded") && Gb.test(b.data) && "data"); if (k || "jsonp" === b.dataTypes[0]) return f = b.jsonpCallback =
                n.isFunction(b.jsonpCallback) ? b.jsonpCallback() : b.jsonpCallback, k ? b[k] = b[k].replace(Gb, "$1" + f) : !1 !== b.jsonp && (b.url += (ab.test(b.url) ? "\x26" : "?") + b.jsonp + "\x3d" + f), b.converters["script json"] = function () { m || n.error(f + " was not called"); return m[0] }, b.dataTypes[0] = "json", d = a[f], a[f] = function () { m = arguments }, c.always(function () { a[f] = d; b[f] && (b.jsonpCallback = g.jsonpCallback, Tb.push(f)); m && n.isFunction(d) && d(m[0]); m = d = l }), "script"
        }); var eb, pb, cc = 0, Hb = a.ActiveXObject && function () { for (var a in eb) eb[a](l, !0) };
    n.ajaxSettings.xhr = a.ActiveXObject ? function () { var b; if (!(b = !this.isLocal && F())) a: { try { b = new a.ActiveXObject("Microsoft.XMLHTTP"); break a } catch (g) { } b = void 0 } return b } : F; pb = n.ajaxSettings.xhr(); n.support.cors = !!pb && "withCredentials" in pb; (pb = n.support.ajax = !!pb) && n.ajaxTransport(function (b) {
        if (!b.crossDomain || n.support.cors) {
            var g; return {
                send: function (c, f) {
                    var d, m, k = b.xhr(); b.username ? k.open(b.type, b.url, b.async, b.username, b.password) : k.open(b.type, b.url, b.async); if (b.xhrFields) for (m in b.xhrFields) k[m] =
                        b.xhrFields[m]; b.mimeType && k.overrideMimeType && k.overrideMimeType(b.mimeType); b.crossDomain || c["X-Requested-With"] || (c["X-Requested-With"] = "XMLHttpRequest"); try { for (m in c) k.setRequestHeader(m, c[m]) } catch (q) { } k.send(b.hasContent && b.data || null); g = function (a, c) {
                            var m, q, h, e; try {
                                if (g && (c || 4 === k.readyState)) if (g = l, d && (k.onreadystatechange = n.noop, Hb && delete eb[d]), c) 4 !== k.readyState && k.abort(); else {
                                    e = {}; m = k.status; q = k.getAllResponseHeaders(); "string" === typeof k.responseText && (e.text = k.responseText); try {
                                        h =
                                        k.statusText
                                    } catch (r) { h = "" } m || !b.isLocal || b.crossDomain ? 1223 === m && (m = 204) : m = e.text ? 200 : 404
                                }
                            } catch (u) { c || f(-1, u) } e && f(m, h, e, q)
                        }; b.async ? 4 === k.readyState ? setTimeout(g) : (d = ++cc, Hb && (eb || (eb = {}, n(a).unload(Hb)), eb[d] = g), k.onreadystatechange = g) : g()
                }, abort: function () { g && g(l, !0) }
            }
        }
    }); var Wa, ub, dc = /^(?:toggle|show|hide)$/, ec = RegExp("^(?:([+-])\x3d|)(" + va + ")([a-z%]*)$", "i"), fc = /queueHooks$/, sb = [function (a, b, g) {
        var c, f, d, m, k, q, h = this, e = a.style, r = {}, u = [], w = a.nodeType && x(a); g.queue || (k = n._queueHooks(a, "fx"),
            null == k.unqueued && (k.unqueued = 0, q = k.empty.fire, k.empty.fire = function () { k.unqueued || q() }), k.unqueued++, h.always(function () { h.always(function () { k.unqueued--; n.queue(a, "fx").length || k.empty.fire() }) })); 1 === a.nodeType && ("height" in b || "width" in b) && (g.overflow = [e.overflow, e.overflowX, e.overflowY], "inline" === n.css(a, "display") && "none" === n.css(a, "float") && (n.support.inlineBlockNeedsLayout && "inline" !== O(a.nodeName) ? e.zoom = 1 : e.display = "inline-block")); g.overflow && (e.overflow = "hidden", n.support.shrinkWrapBlocks ||
                h.always(function () { e.overflow = g.overflow[0]; e.overflowX = g.overflow[1]; e.overflowY = g.overflow[2] })); for (f in b) d = b[f], dc.exec(d) && (delete b[f], c = c || "toggle" === d, d !== (w ? "hide" : "show") && u.push(f)); if (b = u.length) for (d = n._data(a, "fxshow") || n._data(a, "fxshow", {}), ("hidden" in d) && (w = d.hidden), c && (d.hidden = !w), w ? n(a).show() : h.done(function () { n(a).hide() }), h.done(function () { var b; n._removeData(a, "fxshow"); for (b in r) n.style(a, b, r[b]) }), f = 0; f < b; f++)c = u[f], m = h.createTween(c, w ? d[c] : 0), r[c] = d[c] || n.style(a, c),
                    c in d || (d[c] = m.start, w && (m.end = m.start, m.start = "width" === c || "height" === c ? 1 : 0))
    }], hb = { "*": [function (a, b) { var g, c, f = this.createTween(a, b), d = ec.exec(b), m = f.cur(), k = +m || 0, q = 1, h = 20; if (d) { g = +d[2]; c = d[3] || (n.cssNumber[a] ? "" : "px"); if ("px" !== c && k) { k = n.css(f.elem, a, !0) || g || 1; do q = q || ".5", k /= q, n.style(f.elem, a, k + c); while (q !== (q = f.cur() / m) && 1 !== q && --h) } f.unit = c; f.start = k; f.end = d[1] ? k + (d[1] + 1) * g : g } return f }] }; n.Animation = n.extend(H, {
        tweener: function (a, b) {
            n.isFunction(a) ? (b = a, a = ["*"]) : a = a.split(" "); for (var g,
                c = 0, f = a.length; c < f; c++)g = a[c], hb[g] = hb[g] || [], hb[g].unshift(b)
        }, prefilter: function (a, b) { b ? sb.unshift(a) : sb.push(a) }
    }); n.Tween = N; N.prototype = {
        constructor: N, init: function (a, b, g, c, f, d) { this.elem = a; this.prop = g; this.easing = f || "swing"; this.options = b; this.start = this.now = this.cur(); this.end = c; this.unit = d || (n.cssNumber[g] ? "" : "px") }, cur: function () { var a = N.propHooks[this.prop]; return a && a.get ? a.get(this) : N.propHooks._default.get(this) }, run: function (a) {
            var b, g = N.propHooks[this.prop]; this.pos = this.options.duration ?
                b = n.easing[this.easing](a, this.options.duration * a, 0, 1, this.options.duration) : b = a; this.now = (this.end - this.start) * b + this.start; this.options.step && this.options.step.call(this.elem, this.now, this); g && g.set ? g.set(this) : N.propHooks._default.set(this); return this
        }
    }; N.prototype.init.prototype = N.prototype; N.propHooks = {
        _default: {
            get: function (a) { return null == a.elem[a.prop] || a.elem.style && null != a.elem.style[a.prop] ? (a = n.css(a.elem, a.prop, "")) && "auto" !== a ? a : 0 : a.elem[a.prop] }, set: function (a) {
                if (n.fx.step[a.prop]) n.fx.step[a.prop](a);
                else a.elem.style && (null != a.elem.style[n.cssProps[a.prop]] || n.cssHooks[a.prop]) ? n.style(a.elem, a.prop, a.now + a.unit) : a.elem[a.prop] = a.now
            }
        }
    }; N.propHooks.scrollTop = N.propHooks.scrollLeft = { set: function (a) { a.elem.nodeType && a.elem.parentNode && (a.elem[a.prop] = a.now) } }; n.each(["toggle", "show", "hide"], function (a, b) { var g = n.fn[b]; n.fn[b] = function (a, c, f) { return null == a || "boolean" === typeof a ? g.apply(this, arguments) : this.animate(L(b, !0), a, c, f) } }); n.fn.extend({
        fadeTo: function (a, b, g, c) {
            return this.filter(x).css("opacity",
                0).show().end().animate({ opacity: b }, a, g, c)
        }, animate: function (a, b, g, c) { var f = n.isEmptyObject(a), d = n.speed(b, g, c), m = function () { var b = H(this, n.extend({}, a), d); m.finish = function () { b.stop(!0) }; (f || n._data(this, "finish")) && b.stop(!0) }; m.finish = m; return f || !1 === d.queue ? this.each(m) : this.queue(d.queue, m) }, stop: function (a, b, g) {
            var c = function (a) { var b = a.stop; delete a.stop; b(g) }; "string" !== typeof a && (g = b, b = a, a = l); b && !1 !== a && this.queue(a || "fx", []); return this.each(function () {
                var b = !0, f = null != a && a + "queueHooks",
                d = n.timers, m = n._data(this); if (f) m[f] && m[f].stop && c(m[f]); else for (f in m) m[f] && m[f].stop && fc.test(f) && c(m[f]); for (f = d.length; f--;)d[f].elem !== this || null != a && d[f].queue !== a || (d[f].anim.stop(g), b = !1, d.splice(f, 1)); !b && g || n.dequeue(this, a)
            })
        }, finish: function (a) {
            !1 !== a && (a = a || "fx"); return this.each(function () {
                var b, g = n._data(this), c = g[a + "queue"]; b = g[a + "queueHooks"]; var f = n.timers, d = c ? c.length : 0; g.finish = !0; n.queue(this, a, []); b && b.cur && b.cur.finish && b.cur.finish.call(this); for (b = f.length; b--;)f[b].elem ===
                    this && f[b].queue === a && (f[b].anim.stop(!0), f.splice(b, 1)); for (b = 0; b < d; b++)c[b] && c[b].finish && c[b].finish.call(this); delete g.finish
            })
        }
    }); n.each({ slideDown: L("show"), slideUp: L("hide"), slideToggle: L("toggle"), fadeIn: { opacity: "show" }, fadeOut: { opacity: "hide" }, fadeToggle: { opacity: "toggle" } }, function (a, b) { n.fn[a] = function (a, g, c) { return this.animate(b, a, g, c) } }); n.speed = function (a, b, g) {
        var c = a && "object" === typeof a ? n.extend({}, a) : {
            complete: g || !g && b || n.isFunction(a) && a, duration: a, easing: g && b || b && !n.isFunction(b) &&
                b
        }; c.duration = n.fx.off ? 0 : "number" === typeof c.duration ? c.duration : c.duration in n.fx.speeds ? n.fx.speeds[c.duration] : n.fx.speeds._default; if (null == c.queue || !0 === c.queue) c.queue = "fx"; c.old = c.complete; c.complete = function () { n.isFunction(c.old) && c.old.call(this); c.queue && n.dequeue(this, c.queue) }; return c
    }; n.easing = { linear: function (a) { return a }, swing: function (a) { return 0.5 - Math.cos(a * Math.PI) / 2 } }; n.timers = []; n.fx = N.prototype.init; n.fx.tick = function () {
        var a, b = n.timers, g = 0; for (Wa = n.now(); g < b.length; g++)a =
            b[g], a() || b[g] !== a || b.splice(g--, 1); b.length || n.fx.stop(); Wa = l
    }; n.fx.timer = function (a) { a() && n.timers.push(a) && n.fx.start() }; n.fx.interval = 13; n.fx.start = function () { ub || (ub = setInterval(n.fx.tick, n.fx.interval)) }; n.fx.stop = function () { clearInterval(ub); ub = null }; n.fx.speeds = { slow: 600, fast: 200, _default: 400 }; n.fx.step = {}; n.expr && n.expr.filters && (n.expr.filters.animated = function (a) { return n.grep(n.timers, function (b) { return a === b.elem }).length }); n.fn.offset = function (a) {
        if (arguments.length) return a === l ? this :
            this.each(function (b) { n.offset.setOffset(this, a, b) }); var b, g, c = { top: 0, left: 0 }, f = (g = this[0]) && g.ownerDocument; if (f) { b = f.documentElement; if (!n.contains(b, g)) return c; typeof g.getBoundingClientRect !== G && (c = g.getBoundingClientRect()); g = ha(f); return { top: c.top + (g.pageYOffset || b.scrollTop) - (b.clientTop || 0), left: c.left + (g.pageXOffset || b.scrollLeft) - (b.clientLeft || 0) } }
    }; n.offset = {
        setOffset: function (a, b, g) {
            var c = n.css(a, "position"); "static" === c && (a.style.position = "relative"); var f = n(a), d = f.offset(), m = n.css(a,
                "top"), k = n.css(a, "left"), q = {}, h = {}; ("absolute" === c || "fixed" === c) && -1 < n.inArray("auto", [m, k]) ? (h = f.position(), c = h.top, k = h.left) : (c = parseFloat(m) || 0, k = parseFloat(k) || 0); n.isFunction(b) && (b = b.call(a, g, d)); null != b.top && (q.top = b.top - d.top + c); null != b.left && (q.left = b.left - d.left + k); "using" in b ? b.using.call(a, q) : f.css(q)
        }
    }; n.fn.extend({
        position: function () {
            if (this[0]) {
                var a, b, g = { top: 0, left: 0 }, c = this[0]; "fixed" === n.css(c, "position") ? b = c.getBoundingClientRect() : (a = this.offsetParent(), b = this.offset(), n.nodeName(a[0],
                    "html") || (g = a.offset()), g.top += n.css(a[0], "borderTopWidth", !0), g.left += n.css(a[0], "borderLeftWidth", !0)); return { top: b.top - g.top - n.css(c, "marginTop", !0), left: b.left - g.left - n.css(c, "marginLeft", !0) }
            }
        }, offsetParent: function () { return this.map(function () { for (var a = this.offsetParent || M.documentElement; a && !n.nodeName(a, "html") && "static" === n.css(a, "position");)a = a.offsetParent; return a || M.documentElement }) }
    }); n.each({ scrollLeft: "pageXOffset", scrollTop: "pageYOffset" }, function (a, b) {
        var g = /Y/.test(b); n.fn[a] =
            function (c) { return n.access(this, function (a, c, f) { var d = ha(a); if (f === l) return d ? b in d ? d[b] : d.document.documentElement[c] : a[c]; d ? d.scrollTo(g ? n(d).scrollLeft() : f, g ? f : n(d).scrollTop()) : a[c] = f }, a, c, arguments.length, null) }
    }); n.each({ Height: "height", Width: "width" }, function (a, b) {
        n.each({ padding: "inner" + a, content: b, "": "outer" + a }, function (g, c) {
            n.fn[c] = function (c, f) {
                var d = arguments.length && (g || "boolean" !== typeof c), m = g || (!0 === c || !0 === f ? "margin" : "border"); return n.access(this, function (b, g, c) {
                    return n.isWindow(b) ?
                        b.document.documentElement["client" + a] : 9 === b.nodeType ? (g = b.documentElement, Math.max(b.body["scroll" + a], g["scroll" + a], b.body["offset" + a], g["offset" + a], g["client" + a])) : c === l ? n.css(b, g, m) : n.style(b, g, c, m)
                }, b, d ? c : l, d, null)
            }
        })
    }); a.jQuery = a.$ = n; "function" === typeof define && define.amd && define.amd.jQuery && define("jquery", [], function () { return n })
})(window);
(function (a, l) {
    function e(b, c) { var d, k; d = b.nodeName.toLowerCase(); if ("area" === d) { d = b.parentNode; k = d.name; if (!b.href || !k || "map" !== d.nodeName.toLowerCase()) return !1; d = a("img[usemap\x3d#" + k + "]")[0]; return !!d && h(d) } return (/input|select|textarea|button|object/.test(d) ? !b.disabled : "a" === d ? b.href || c : c) && h(b) } function h(b) { return a.expr.filters.visible(b) && !a(b).parents().addBack().filter(function () { return "hidden" === a.css(this, "visibility") }).length } var c = 0, d = /^ui-id-\d+$/; a.ui = a.ui || {}; a.extend(a.ui, {
        version: "1.10.3",
        keyCode: { BACKSPACE: 8, COMMA: 188, DELETE: 46, DOWN: 40, END: 35, ENTER: 13, ESCAPE: 27, HOME: 36, LEFT: 37, NUMPAD_ADD: 107, NUMPAD_DECIMAL: 110, NUMPAD_DIVIDE: 111, NUMPAD_ENTER: 108, NUMPAD_MULTIPLY: 106, NUMPAD_SUBTRACT: 109, PAGE_DOWN: 34, PAGE_UP: 33, PERIOD: 190, RIGHT: 39, SPACE: 32, TAB: 9, UP: 38 }
    }); a.fn.extend({
        focus: function (b) { return function (c, d) { return "number" === typeof c ? this.each(function () { var b = this; setTimeout(function () { a(b).focus(); d && d.call(b) }, c) }) : b.apply(this, arguments) } }(a.fn.focus), scrollParent: function () {
            var b; b =
                a.ui.ie && /(static|relative)/.test(this.css("position")) || /absolute/.test(this.css("position")) ? this.parents().filter(function () { return /(relative|absolute|fixed)/.test(a.css(this, "position")) && /(auto|scroll)/.test(a.css(this, "overflow") + a.css(this, "overflow-y") + a.css(this, "overflow-x")) }).eq(0) : this.parents().filter(function () { return /(auto|scroll)/.test(a.css(this, "overflow") + a.css(this, "overflow-y") + a.css(this, "overflow-x")) }).eq(0); return /fixed/.test(this.css("position")) || !b.length ? a(document) :
                    b
        }, zIndex: function (b) { if (b !== l) return this.css("zIndex", b); if (this.length) { b = a(this[0]); for (var c; b.length && b[0] !== document;) { c = b.css("position"); if ("absolute" === c || "relative" === c || "fixed" === c) if (c = parseInt(b.css("zIndex"), 10), !isNaN(c) && 0 !== c) return c; b = b.parent() } } return 0 }, uniqueId: function () { return this.each(function () { this.id || (this.id = "ui-id-" + ++c) }) }, removeUniqueId: function () { return this.each(function () { d.test(this.id) && a(this).removeAttr("id") }) }
    }); a.extend(a.expr[":"], {
        data: a.expr.createPseudo ?
            a.expr.createPseudo(function (b) { return function (c) { return !!a.data(c, b) } }) : function (b, c, d) { return !!a.data(b, d[3]) }, focusable: function (b) { return e(b, !isNaN(a.attr(b, "tabindex"))) }, tabbable: function (b) { var c = a.attr(b, "tabindex"), d = isNaN(c); return (d || 0 <= c) && e(b, !d) }
    }); a("\x3ca\x3e").outerWidth(1).jquery || a.each(["Width", "Height"], function (b, c) {
        function d(b, c, f, m) {
            a.each(k, function () {
                c -= parseFloat(a.css(b, "padding" + this)) || 0; f && (c -= parseFloat(a.css(b, "border" + this + "Width")) || 0); m && (c -= parseFloat(a.css(b,
                    "margin" + this)) || 0)
            }); return c
        } var k = "Width" === c ? ["Left", "Right"] : ["Top", "Bottom"], h = c.toLowerCase(), e = { innerWidth: a.fn.innerWidth, innerHeight: a.fn.innerHeight, outerWidth: a.fn.outerWidth, outerHeight: a.fn.outerHeight }; a.fn["inner" + c] = function (b) { return b === l ? e["inner" + c].call(this) : this.each(function () { a(this).css(h, d(this, b) + "px") }) }; a.fn["outer" + c] = function (b, k) { return "number" !== typeof b ? e["outer" + c].call(this, b) : this.each(function () { a(this).css(h, d(this, b, !0, k) + "px") }) }
    }); a.fn.addBack || (a.fn.addBack =
        function (a) { return this.add(null == a ? this.prevObject : this.prevObject.filter(a)) }); a("\x3ca\x3e").data("a-b", "a").removeData("a-b").data("a-b") && (a.fn.removeData = function (b) { return function (c) { return arguments.length ? b.call(this, a.camelCase(c)) : b.call(this) } }(a.fn.removeData)); a.ui.ie = !!/msie [\w.]+/.exec(navigator.userAgent.toLowerCase()); a.support.selectstart = "onselectstart" in document.createElement("div"); a.fn.extend({
            disableSelection: function () {
                return this.bind((a.support.selectstart ? "selectstart" :
                    "mousedown") + ".ui-disableSelection", function (a) { a.preventDefault() })
            }, enableSelection: function () { return this.unbind(".ui-disableSelection") }
        }); a.extend(a.ui, {
            plugin: { add: function (b, c, d) { var k; b = a.ui[b].prototype; for (k in d) b.plugins[k] = b.plugins[k] || [], b.plugins[k].push([c, d[k]]) }, call: function (a, c, d) { var k = a.plugins[c]; if (k && a.element[0].parentNode && 11 !== a.element[0].parentNode.nodeType) for (c = 0; c < k.length; c++)a.options[k[c][0]] && k[c][1].apply(a.element, d) } }, hasScroll: function (b, c) {
                if ("hidden" ===
                    a(b).css("overflow")) return !1; var d = c && "left" === c ? "scrollLeft" : "scrollTop", k = !1; if (0 < b[d]) return !0; b[d] = 1; k = 0 < b[d]; b[d] = 0; return k
            }
        })
})(jQuery);
(function (a, l) {
    var e = 0, h = Array.prototype.slice, c = a.cleanData; a.cleanData = function (d) { for (var b = 0, f; null != (f = d[b]); b++)try { a(f).triggerHandler("remove") } catch (m) { } c(d) }; a.widget = function (c, b, f) {
        var m, k, h, e, l = {}, s = c.split(".")[0]; c = c.split(".")[1]; m = s + "-" + c; f || (f = b, b = a.Widget); a.expr[":"][m.toLowerCase()] = function (b) { return !!a.data(b, m) }; a[s] = a[s] || {}; k = a[s][c]; h = a[s][c] = function (a, b) { if (!this._createWidget) return new h(a, b); arguments.length && this._createWidget(a, b) }; a.extend(h, k, {
            version: f.version,
            _proto: a.extend({}, f), _childConstructors: []
        }); e = new b; e.options = a.widget.extend({}, e.options); a.each(f, function (c, f) { a.isFunction(f) ? l[c] = function () { var a = function () { return b.prototype[c].apply(this, arguments) }, d = function (a) { return b.prototype[c].apply(this, a) }; return function () { var b = this._super, c = this._superApply, m; this._super = a; this._superApply = d; m = f.apply(this, arguments); this._super = b; this._superApply = c; return m } }() : l[c] = f }); h.prototype = a.widget.extend(e, {
            widgetEventPrefix: k ? e.widgetEventPrefix :
                c
        }, l, { constructor: h, namespace: s, widgetName: c, widgetFullName: m }); k ? (a.each(k._childConstructors, function (b, c) { var g = c.prototype; a.widget(g.namespace + "." + g.widgetName, h, c._proto) }), delete k._childConstructors) : b._childConstructors.push(h); a.widget.bridge(c, h)
    }; a.widget.extend = function (c) {
        for (var b = h.call(arguments, 1), f = 0, m = b.length, k, e; f < m; f++)for (k in b[f]) e = b[f][k], b[f].hasOwnProperty(k) && e !== l && (a.isPlainObject(e) ? c[k] = a.isPlainObject(c[k]) ? a.widget.extend({}, c[k], e) : a.widget.extend({}, e) : c[k] = e);
        return c
    }; a.widget.bridge = function (c, b) {
        var f = b.prototype.widgetFullName || c; a.fn[c] = function (m) {
            var k = "string" === typeof m, e = h.call(arguments, 1), z = this; m = !k && e.length ? a.widget.extend.apply(null, [m].concat(e)) : m; k ? this.each(function () {
                var b, k = a.data(this, f); if (!k) return a.error("cannot call methods on " + c + " prior to initialization; attempted to call method '" + m + "'"); if (!a.isFunction(k[m]) || "_" === m.charAt(0)) return a.error("no such method '" + m + "' for " + c + " widget instance"); b = k[m].apply(k, e); if (b !==
                    k && b !== l) return z = b && b.jquery ? z.pushStack(b.get()) : b, !1
            }) : this.each(function () { var c = a.data(this, f); c ? c.option(m || {})._init() : a.data(this, f, new b(m, this)) }); return z
        }
    }; a.Widget = function () { }; a.Widget._childConstructors = []; a.Widget.prototype = {
        widgetName: "widget", widgetEventPrefix: "", defaultElement: "\x3cdiv\x3e", options: { disabled: !1, create: null }, _createWidget: function (c, b) {
            b = a(b || this.defaultElement || this)[0]; this.element = a(b); this.uuid = e++; this.eventNamespace = "." + this.widgetName + this.uuid; this.options =
                a.widget.extend({}, this.options, this._getCreateOptions(), c); this.bindings = a(); this.hoverable = a(); this.focusable = a(); b !== this && (a.data(b, this.widgetFullName, this), this._on(!0, this.element, { remove: function (a) { a.target === b && this.destroy() } }), this.document = a(b.style ? b.ownerDocument : b.document || b), this.window = a(this.document[0].defaultView || this.document[0].parentWindow)); this._create(); this._trigger("create", null, this._getCreateEventData()); this._init()
        }, _getCreateOptions: a.noop, _getCreateEventData: a.noop,
        _create: a.noop, _init: a.noop, destroy: function () { this._destroy(); this.element.unbind(this.eventNamespace).removeData(this.widgetName).removeData(this.widgetFullName).removeData(a.camelCase(this.widgetFullName)); this.widget().unbind(this.eventNamespace).removeAttr("aria-disabled").removeClass(this.widgetFullName + "-disabled ui-state-disabled"); this.bindings.unbind(this.eventNamespace); this.hoverable.removeClass("ui-state-hover"); this.focusable.removeClass("ui-state-focus") }, _destroy: a.noop, widget: function () { return this.element },
        option: function (c, b) { var f = c, m, k, e; if (0 === arguments.length) return a.widget.extend({}, this.options); if ("string" === typeof c) if (f = {}, m = c.split("."), c = m.shift(), m.length) { k = f[c] = a.widget.extend({}, this.options[c]); for (e = 0; e < m.length - 1; e++)k[m[e]] = k[m[e]] || {}, k = k[m[e]]; c = m.pop(); if (b === l) return k[c] === l ? null : k[c]; k[c] = b } else { if (b === l) return this.options[c] === l ? null : this.options[c]; f[c] = b } this._setOptions(f); return this }, _setOptions: function (a) { for (var b in a) this._setOption(b, a[b]); return this }, _setOption: function (a,
            b) { this.options[a] = b; "disabled" === a && (this.widget().toggleClass(this.widgetFullName + "-disabled ui-state-disabled", !!b).attr("aria-disabled", b), this.hoverable.removeClass("ui-state-hover"), this.focusable.removeClass("ui-state-focus")); return this }, enable: function () { return this._setOption("disabled", !1) }, disable: function () { return this._setOption("disabled", !0) }, _on: function (c, b, f) {
                var m, k = this; "boolean" !== typeof c && (f = b, b = c, c = !1); f ? (b = m = a(b), this.bindings = this.bindings.add(b)) : (f = b, b = this.element, m =
                    this.widget()); a.each(f, function (f, e) { function h() { if (c || !0 !== k.options.disabled && !a(this).hasClass("ui-state-disabled")) return ("string" === typeof e ? k[e] : e).apply(k, arguments) } "string" !== typeof e && (h.guid = e.guid = e.guid || h.guid || a.guid++); var l = f.match(/^(\w+)\s*(.*)$/), v = l[1] + k.eventNamespace; (l = l[2]) ? m.delegate(l, v, h) : b.bind(v, h) })
            }, _off: function (a, b) { b = (b || "").split(" ").join(this.eventNamespace + " ") + this.eventNamespace; a.unbind(b).undelegate(b) }, _delay: function (a, b) {
                var c = this; return setTimeout(function () {
                    return ("string" ===
                        typeof a ? c[a] : a).apply(c, arguments)
                }, b || 0)
            }, _hoverable: function (c) { this.hoverable = this.hoverable.add(c); this._on(c, { mouseenter: function (b) { a(b.currentTarget).addClass("ui-state-hover") }, mouseleave: function (b) { a(b.currentTarget).removeClass("ui-state-hover") } }) }, _focusable: function (c) { this.focusable = this.focusable.add(c); this._on(c, { focusin: function (b) { a(b.currentTarget).addClass("ui-state-focus") }, focusout: function (b) { a(b.currentTarget).removeClass("ui-state-focus") } }) }, _trigger: function (c, b, f) {
                var m,
                k = this.options[c]; f = f || {}; b = a.Event(b); b.type = (c === this.widgetEventPrefix ? c : this.widgetEventPrefix + c).toLowerCase(); b.target = this.element[0]; if (c = b.originalEvent) for (m in c) m in b || (b[m] = c[m]); this.element.trigger(b, f); return !(a.isFunction(k) && !1 === k.apply(this.element[0], [b].concat(f)) || b.isDefaultPrevented())
            }
    }; a.each({ show: "fadeIn", hide: "fadeOut" }, function (c, b) {
        a.Widget.prototype["_" + c] = function (f, m, k) {
            "string" === typeof m && (m = { effect: m }); var e, h = m ? !0 === m || "number" === typeof m ? b : m.effect || b : c; m =
                m || {}; "number" === typeof m && (m = { duration: m }); e = !a.isEmptyObject(m); m.complete = k; m.delay && f.delay(m.delay); if (e && a.effects && a.effects.effect[h]) f[c](m); else if (h !== c && f[h]) f[h](m.duration, m.easing, k); else f.queue(function (b) { a(this)[c](); k && k.call(f[0]); b() })
        }
    })
})(jQuery);
(function (a, l) {
    var e = !1; a(document).mouseup(function () { e = !1 }); a.widget("ui.mouse", {
        version: "1.10.3", options: { cancel: "input,textarea,button,select,option", distance: 1, delay: 0 }, _mouseInit: function () {
            var e = this; this.element.bind("mousedown." + this.widgetName, function (a) { return e._mouseDown(a) }).bind("click." + this.widgetName, function (c) { if (!0 === a.data(c.target, e.widgetName + ".preventClickEvent")) return a.removeData(c.target, e.widgetName + ".preventClickEvent"), c.stopImmediatePropagation(), !1 }); this.started =
                !1
        }, _mouseDestroy: function () { this.element.unbind("." + this.widgetName); this._mouseMoveDelegate && a(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate) }, _mouseDown: function (h) {
            if (!e) {
                this._mouseStarted && this._mouseUp(h); this._mouseDownEvent = h; var c = this, d = 1 === h.which, b = "string" === typeof this.options.cancel && h.target.nodeName ? a(h.target).closest(this.options.cancel).length : !1; if (!d || b || !this._mouseCapture(h)) return !0; this.mouseDelayMet =
                    !this.options.delay; this.mouseDelayMet || (this._mouseDelayTimer = setTimeout(function () { c.mouseDelayMet = !0 }, this.options.delay)); if (this._mouseDistanceMet(h) && this._mouseDelayMet(h) && (this._mouseStarted = !1 !== this._mouseStart(h), !this._mouseStarted)) return h.preventDefault(), !0; !0 === a.data(h.target, this.widgetName + ".preventClickEvent") && a.removeData(h.target, this.widgetName + ".preventClickEvent"); this._mouseMoveDelegate = function (a) { return c._mouseMove(a) }; this._mouseUpDelegate = function (a) { return c._mouseUp(a) };
                a(document).bind("mousemove." + this.widgetName, this._mouseMoveDelegate).bind("mouseup." + this.widgetName, this._mouseUpDelegate); h.preventDefault(); return e = !0
            }
        }, _mouseMove: function (e) {
            if (a.ui.ie && (!document.documentMode || 9 > document.documentMode) && !e.button) return this._mouseUp(e); if (this._mouseStarted) return this._mouseDrag(e), e.preventDefault(); this._mouseDistanceMet(e) && this._mouseDelayMet(e) && ((this._mouseStarted = !1 !== this._mouseStart(this._mouseDownEvent, e)) ? this._mouseDrag(e) : this._mouseUp(e));
            return !this._mouseStarted
        }, _mouseUp: function (e) { a(document).unbind("mousemove." + this.widgetName, this._mouseMoveDelegate).unbind("mouseup." + this.widgetName, this._mouseUpDelegate); this._mouseStarted && (this._mouseStarted = !1, e.target === this._mouseDownEvent.target && a.data(e.target, this.widgetName + ".preventClickEvent", !0), this._mouseStop(e)); return !1 }, _mouseDistanceMet: function (a) { return Math.max(Math.abs(this._mouseDownEvent.pageX - a.pageX), Math.abs(this._mouseDownEvent.pageY - a.pageY)) >= this.options.distance },
        _mouseDelayMet: function () { return this.mouseDelayMet }, _mouseStart: function () { }, _mouseDrag: function () { }, _mouseStop: function () { }, _mouseCapture: function () { return !0 }
    })
})(jQuery);
(function (a, l) {
    function e(a, b, g) { return [parseFloat(a[0]) * (t.test(a[0]) ? b / 100 : 1), parseFloat(a[1]) * (t.test(a[1]) ? g / 100 : 1)] } function h(b) { var c = b[0]; return 9 === c.nodeType ? { width: b.width(), height: b.height(), offset: { top: 0, left: 0 } } : a.isWindow(c) ? { width: b.width(), height: b.height(), offset: { top: b.scrollTop(), left: b.scrollLeft() } } : c.preventDefault ? { width: 0, height: 0, offset: { top: c.pageY, left: c.pageX } } : { width: b.outerWidth(), height: b.outerHeight(), offset: b.offset() } } a.ui = a.ui || {}; var c, d = Math.max, b = Math.abs, f =
        Math.round, m = /left|center|right/, k = /top|center|bottom/, r = /[\+\-]\d+(\.[\d]+)?%?/, z = /^\w+/, t = /%$/, s = a.fn.position; a.position = {
            scrollbarWidth: function () { if (c !== l) return c; var b, f, g = a("\x3cdiv style\x3d'display:block;width:50px;height:50px;overflow:hidden;'\x3e\x3cdiv style\x3d'height:100px;width:auto;'\x3e\x3c/div\x3e\x3c/div\x3e"); f = g.children()[0]; a("body").append(g); b = f.offsetWidth; g.css("overflow", "scroll"); f = f.offsetWidth; b === f && (f = g[0].clientWidth); g.remove(); return c = b - f }, getScrollInfo: function (b) {
                var c =
                    b.isWindow ? "" : b.element.css("overflow-x"), g = b.isWindow ? "" : b.element.css("overflow-y"), c = "scroll" === c || "auto" === c && b.width < b.element[0].scrollWidth; return { width: "scroll" === g || "auto" === g && b.height < b.element[0].scrollHeight ? a.position.scrollbarWidth() : 0, height: c ? a.position.scrollbarWidth() : 0 }
            }, getWithinInfo: function (b) {
                b = a(b || window); var c = a.isWindow(b[0]); return {
                    element: b, isWindow: c, offset: b.offset() || { left: 0, top: 0 }, scrollLeft: b.scrollLeft(), scrollTop: b.scrollTop(), width: c ? b.width() : b.outerWidth(),
                    height: c ? b.height() : b.outerHeight()
                }
            }
        }; a.fn.position = function (c) {
            if (!c || !c.of) return s.apply(this, arguments); c = a.extend({}, c); var l, g, u, q, w, x, D = a(c.of), A = a.position.getWithinInfo(c.within), t = a.position.getScrollInfo(A), E = (c.collision || "flip").split(" "), O = {}; x = h(D); D[0].preventDefault && (c.at = "left top"); g = x.width; u = x.height; q = x.offset; w = a.extend({}, q); a.each(["my", "at"], function () {
                var a = (c[this] || "").split(" "), b, g; 1 === a.length && (a = m.test(a[0]) ? a.concat(["center"]) : k.test(a[0]) ? ["center"].concat(a) :
                    ["center", "center"]); a[0] = m.test(a[0]) ? a[0] : "center"; a[1] = k.test(a[1]) ? a[1] : "center"; b = r.exec(a[0]); g = r.exec(a[1]); O[this] = [b ? b[0] : 0, g ? g[0] : 0]; c[this] = [z.exec(a[0])[0], z.exec(a[1])[0]]
            }); 1 === E.length && (E[1] = E[0]); "right" === c.at[0] ? w.left += g : "center" === c.at[0] && (w.left += g / 2); "bottom" === c.at[1] ? w.top += u : "center" === c.at[1] && (w.top += u / 2); l = e(O.at, g, u); w.left += l[0]; w.top += l[1]; return this.each(function () {
                var m, k, h = a(this), r = h.outerWidth(), x = h.outerHeight(), z = parseInt(a.css(this, "marginLeft"), 10) || 0, s =
                    parseInt(a.css(this, "marginTop"), 10) || 0, U = r + z + (parseInt(a.css(this, "marginRight"), 10) || 0) + t.width, H = x + s + (parseInt(a.css(this, "marginBottom"), 10) || 0) + t.height, R = a.extend({}, w), N = e(O.my, h.outerWidth(), h.outerHeight()); "right" === c.my[0] ? R.left -= r : "center" === c.my[0] && (R.left -= r / 2); "bottom" === c.my[1] ? R.top -= x : "center" === c.my[1] && (R.top -= x / 2); R.left += N[0]; R.top += N[1]; a.support.offsetFractions || (R.left = f(R.left), R.top = f(R.top)); m = { marginLeft: z, marginTop: s }; a.each(["left", "top"], function (b, f) {
                        if (a.ui.position[E[b]]) a.ui.position[E[b]][f](R,
                            { targetWidth: g, targetHeight: u, elemWidth: r, elemHeight: x, collisionPosition: m, collisionWidth: U, collisionHeight: H, offset: [l[0] + N[0], l[1] + N[1]], my: c.my, at: c.at, within: A, elem: h })
                    }); c.using && (k = function (a) {
                        var f = q.left - R.left, m = f + g - r, k = q.top - R.top, e = k + u - x, w = { target: { element: D, left: q.left, top: q.top, width: g, height: u }, element: { element: h, left: R.left, top: R.top, width: r, height: x }, horizontal: 0 > m ? "left" : 0 < f ? "right" : "center", vertical: 0 > e ? "top" : 0 < k ? "bottom" : "middle" }; g < r && b(f + m) < g && (w.horizontal = "center"); u < x && b(k +
                            e) < u && (w.vertical = "middle"); d(b(f), b(m)) > d(b(k), b(e)) ? w.important = "horizontal" : w.important = "vertical"; c.using.call(this, a, w)
                    }); h.offset(a.extend(R, { using: k }))
            })
        }; a.ui.position = {
            fit: {
                left: function (a, b) {
                    var g = b.within, c = g.isWindow ? g.scrollLeft : g.offset.left, f = g.width, m = a.left - b.collisionPosition.marginLeft, g = c - m, k = m + b.collisionWidth - f - c; b.collisionWidth > f ? 0 < g && 0 >= k ? (c = a.left + g + b.collisionWidth - f - c, a.left += g - c) : a.left = 0 < k && 0 >= g ? c : g > k ? c + f - b.collisionWidth : c : a.left = 0 < g ? a.left + g : 0 < k ? a.left - k : d(a.left - m,
                        a.left)
                }, top: function (a, b) { var g = b.within, c = g.isWindow ? g.scrollTop : g.offset.top, f = b.within.height, m = a.top - b.collisionPosition.marginTop, g = c - m, k = m + b.collisionHeight - f - c; b.collisionHeight > f ? 0 < g && 0 >= k ? (c = a.top + g + b.collisionHeight - f - c, a.top += g - c) : a.top = 0 < k && 0 >= g ? c : g > k ? c + f - b.collisionHeight : c : a.top = 0 < g ? a.top + g : 0 < k ? a.top - k : d(a.top - m, a.top) }
            }, flip: {
                left: function (a, c) {
                    var g = c.within, f = g.offset.left + g.scrollLeft, d = g.width, m = g.isWindow ? g.scrollLeft : g.offset.left, k = a.left - c.collisionPosition.marginLeft, g = k -
                        m, e = k + c.collisionWidth - d - m, k = "left" === c.my[0] ? -c.elemWidth : "right" === c.my[0] ? c.elemWidth : 0, h = "left" === c.at[0] ? c.targetWidth : "right" === c.at[0] ? -c.targetWidth : 0, r = -2 * c.offset[0]; if (0 > g) { if (f = a.left + k + h + r + c.collisionWidth - d - f, 0 > f || f < b(g)) a.left += k + h + r } else 0 < e && (f = a.left - c.collisionPosition.marginLeft + k + h + r - m, 0 < f || b(f) < e) && (a.left += k + h + r)
                }, top: function (a, c) {
                    var g = c.within, f = g.offset.top + g.scrollTop, d = g.height, m = g.isWindow ? g.scrollTop : g.offset.top, k = a.top - c.collisionPosition.marginTop, g = k - m, e = k + c.collisionHeight -
                        d - m, k = "top" === c.my[1] ? -c.elemHeight : "bottom" === c.my[1] ? c.elemHeight : 0, h = "top" === c.at[1] ? c.targetHeight : "bottom" === c.at[1] ? -c.targetHeight : 0, r = -2 * c.offset[1]; 0 > g ? (f = a.top + k + h + r + c.collisionHeight - d - f, a.top + k + h + r > g && (0 > f || f < b(g)) && (a.top += k + h + r)) : 0 < e && (f = a.top - c.collisionPosition.marginTop + k + h + r - m, a.top + k + h + r > e && (0 < f || b(f) < e) && (a.top += k + h + r))
                }
            }, flipfit: {
                left: function () { a.ui.position.flip.left.apply(this, arguments); a.ui.position.fit.left.apply(this, arguments) }, top: function () {
                    a.ui.position.flip.top.apply(this,
                        arguments); a.ui.position.fit.top.apply(this, arguments)
                }
            }
        }; (function () {
            var b, c, g, f, d = document.getElementsByTagName("body")[0]; g = document.createElement("div"); b = document.createElement(d ? "div" : "body"); c = { visibility: "hidden", width: 0, height: 0, border: 0, margin: 0, background: "none" }; d && a.extend(c, { position: "absolute", left: "-1000px", top: "-1000px" }); for (f in c) b.style[f] = c[f]; b.appendChild(g); c = d || document.documentElement; c.insertBefore(b, c.firstChild); g.style.cssText = "position: absolute; left: 10.7432222px;";
            g = a(g).offset().left; a.support.offsetFractions = 10 < g && 11 > g; b.innerHTML = ""; c.removeChild(b)
        })()
})(jQuery);
(function (a, l) {
    a.widget("ui.draggable", a.ui.mouse, {
        version: "1.10.3", widgetEventPrefix: "drag", options: { addClasses: !0, appendTo: "parent", axis: !1, connectToSortable: !1, containment: !1, cursor: "auto", cursorAt: !1, grid: !1, handle: !1, helper: "original", iframeFix: !1, opacity: !1, refreshPositions: !1, revert: !1, revertDuration: 500, scope: "default", scroll: !0, scrollSensitivity: 20, scrollSpeed: 20, snap: !1, snapMode: "both", snapTolerance: 20, stack: !1, zIndex: !1, drag: null, start: null, stop: null }, _create: function () {
            "original" !== this.options.helper ||
            /^(?:r|a|f)/.test(this.element.css("position")) || (this.element[0].style.position = "relative"); this.options.addClasses && this.element.addClass("ui-draggable"); this.options.disabled && this.element.addClass("ui-draggable-disabled"); this._mouseInit()
        }, _destroy: function () { this.element.removeClass("ui-draggable ui-draggable-dragging ui-draggable-disabled"); this._mouseDestroy() }, _mouseCapture: function (e) {
            var h = this.options; if (this.helper || h.disabled || 0 < a(e.target).closest(".ui-resizable-handle").length) return !1;
            this.handle = this._getHandle(e); if (!this.handle) return !1; a(!0 === h.iframeFix ? "iframe" : h.iframeFix).each(function () { a("\x3cdiv class\x3d'ui-draggable-iframeFix' style\x3d'background: #fff;'\x3e\x3c/div\x3e").css({ width: this.offsetWidth + "px", height: this.offsetHeight + "px", position: "absolute", opacity: "0.001", zIndex: 1E3 }).css(a(this).offset()).appendTo("body") }); return !0
        }, _mouseStart: function (e) {
            var h = this.options; this.helper = this._createHelper(e); this.helper.addClass("ui-draggable-dragging"); this._cacheHelperProportions();
            a.ui.ddmanager && (a.ui.ddmanager.current = this); this._cacheMargins(); this.cssPosition = this.helper.css("position"); this.scrollParent = this.helper.scrollParent(); this.offsetParent = this.helper.offsetParent(); this.offsetParentCssPosition = this.offsetParent.css("position"); this.offset = this.positionAbs = this.element.offset(); this.offset = { top: this.offset.top - this.margins.top, left: this.offset.left - this.margins.left }; this.offset.scroll = !1; a.extend(this.offset, {
                click: { left: e.pageX - this.offset.left, top: e.pageY - this.offset.top },
                parent: this._getParentOffset(), relative: this._getRelativeOffset()
            }); this.originalPosition = this.position = this._generatePosition(e); this.originalPageX = e.pageX; this.originalPageY = e.pageY; h.cursorAt && this._adjustOffsetFromHelper(h.cursorAt); this._setContainment(); if (!1 === this._trigger("start", e)) return this._clear(), !1; this._cacheHelperProportions(); a.ui.ddmanager && !h.dropBehaviour && a.ui.ddmanager.prepareOffsets(this, e); this._mouseDrag(e, !0); a.ui.ddmanager && a.ui.ddmanager.dragStart(this, e); return !0
        },
        _mouseDrag: function (e, h) {
            "fixed" === this.offsetParentCssPosition && (this.offset.parent = this._getParentOffset()); this.position = this._generatePosition(e); this.positionAbs = this._convertPositionTo("absolute"); if (!h) { var c = this._uiHash(); if (!1 === this._trigger("drag", e, c)) return this._mouseUp({}), !1; this.position = c.position } this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"); this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top +
                "px"); a.ui.ddmanager && a.ui.ddmanager.drag(this, e); return !1
        }, _mouseStop: function (e) {
            var h = this, c = !1; a.ui.ddmanager && !this.options.dropBehaviour && (c = a.ui.ddmanager.drop(this, e)); this.dropped && (c = this.dropped, this.dropped = !1); if ("original" === this.options.helper && !a.contains(this.element[0].ownerDocument, this.element[0])) return !1; "invalid" === this.options.revert && !c || "valid" === this.options.revert && c || !0 === this.options.revert || a.isFunction(this.options.revert) && this.options.revert.call(this.element, c) ?
                a(this.helper).animate(this.originalPosition, parseInt(this.options.revertDuration, 10), function () { !1 !== h._trigger("stop", e) && h._clear() }) : !1 !== this._trigger("stop", e) && this._clear(); return !1
        }, _mouseUp: function (e) { a("div.ui-draggable-iframeFix").each(function () { this.parentNode.removeChild(this) }); a.ui.ddmanager && a.ui.ddmanager.dragStop(this, e); return a.ui.mouse.prototype._mouseUp.call(this, e) }, cancel: function () { this.helper.is(".ui-draggable-dragging") ? this._mouseUp({}) : this._clear(); return this }, _getHandle: function (e) {
            return this.options.handle ?
                !!a(e.target).closest(this.element.find(this.options.handle)).length : !0
        }, _createHelper: function (e) { var h = this.options; e = a.isFunction(h.helper) ? a(h.helper.apply(this.element[0], [e])) : "clone" === h.helper ? this.element.clone().removeAttr("id") : this.element; e.parents("body").length || e.appendTo("parent" === h.appendTo ? this.element[0].parentNode : h.appendTo); e[0] === this.element[0] || /(fixed|absolute)/.test(e.css("position")) || e.css("position", "absolute"); return e }, _adjustOffsetFromHelper: function (e) {
            "string" ===
            typeof e && (e = e.split(" ")); a.isArray(e) && (e = { left: +e[0], top: +e[1] || 0 }); "left" in e && (this.offset.click.left = e.left + this.margins.left); "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left); "top" in e && (this.offset.click.top = e.top + this.margins.top); "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
        }, _getParentOffset: function () {
            var e = this.offsetParent.offset(); "absolute" === this.cssPosition && this.scrollParent[0] !== document &&
                a.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()); if (this.offsetParent[0] === document.body || this.offsetParent[0].tagName && "html" === this.offsetParent[0].tagName.toLowerCase() && a.ui.ie) e = { top: 0, left: 0 }; return { top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0), left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0) }
        }, _getRelativeOffset: function () {
            if ("relative" === this.cssPosition) {
                var a = this.element.position();
                return { top: a.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(), left: a.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft() }
            } return { top: 0, left: 0 }
        }, _cacheMargins: function () { this.margins = { left: parseInt(this.element.css("marginLeft"), 10) || 0, top: parseInt(this.element.css("marginTop"), 10) || 0, right: parseInt(this.element.css("marginRight"), 10) || 0, bottom: parseInt(this.element.css("marginBottom"), 10) || 0 } }, _cacheHelperProportions: function () {
            this.helperProportions =
            { width: this.helper.outerWidth(), height: this.helper.outerHeight() }
        }, _setContainment: function () {
            var e, h, c; e = this.options; if (e.containment) if ("window" === e.containment) this.containment = [a(window).scrollLeft() - this.offset.relative.left - this.offset.parent.left, a(window).scrollTop() - this.offset.relative.top - this.offset.parent.top, a(window).scrollLeft() + a(window).width() - this.helperProportions.width - this.margins.left, a(window).scrollTop() + (a(window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height -
                this.margins.top]; else if ("document" === e.containment) this.containment = [0, 0, a(document).width() - this.helperProportions.width - this.margins.left, (a(document).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]; else if (e.containment.constructor === Array) this.containment = e.containment; else {
                    if ("parent" === e.containment && (e.containment = this.helper[0].parentNode), h = a(e.containment), c = h[0]) e = "hidden" !== h.css("overflow"), this.containment = [(parseInt(h.css("borderLeftWidth"),
                        10) || 0) + (parseInt(h.css("paddingLeft"), 10) || 0), (parseInt(h.css("borderTopWidth"), 10) || 0) + (parseInt(h.css("paddingTop"), 10) || 0), (e ? Math.max(c.scrollWidth, c.offsetWidth) : c.offsetWidth) - (parseInt(h.css("borderRightWidth"), 10) || 0) - (parseInt(h.css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left - this.margins.right, (e ? Math.max(c.scrollHeight, c.offsetHeight) : c.offsetHeight) - (parseInt(h.css("borderBottomWidth"), 10) || 0) - (parseInt(h.css("paddingBottom"), 10) || 0) - this.helperProportions.height -
                        this.margins.top - this.margins.bottom], this.relative_container = h
                } else this.containment = null
        }, _convertPositionTo: function (e, h) {
            h || (h = this.position); var c = "absolute" === e ? 1 : -1, d = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && a.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent; this.offset.scroll || (this.offset.scroll = { top: d.scrollTop(), left: d.scrollLeft() }); return {
                top: h.top + this.offset.relative.top * c + this.offset.parent.top * c - ("fixed" === this.cssPosition ?
                    -this.scrollParent.scrollTop() : this.offset.scroll.top) * c, left: h.left + this.offset.relative.left * c + this.offset.parent.left * c - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left) * c
            }
        }, _generatePosition: function (e) {
            var h, c, d, b = this.options, f = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && a.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent; d = e.pageX; c = e.pageY; this.offset.scroll || (this.offset.scroll = {
                top: f.scrollTop(),
                left: f.scrollLeft()
            }); this.originalPosition && (this.containment && (this.relative_container ? (h = this.relative_container.offset(), h = [this.containment[0] + h.left, this.containment[1] + h.top, this.containment[2] + h.left, this.containment[3] + h.top]) : h = this.containment, e.pageX - this.offset.click.left < h[0] && (d = h[0] + this.offset.click.left), e.pageY - this.offset.click.top < h[1] && (c = h[1] + this.offset.click.top), e.pageX - this.offset.click.left > h[2] && (d = h[2] + this.offset.click.left), e.pageY - this.offset.click.top > h[3] && (c = h[3] +
                this.offset.click.top)), b.grid && (c = b.grid[1] ? this.originalPageY + Math.round((c - this.originalPageY) / b.grid[1]) * b.grid[1] : this.originalPageY, c = h ? c - this.offset.click.top >= h[1] || c - this.offset.click.top > h[3] ? c : c - this.offset.click.top >= h[1] ? c - b.grid[1] : c + b.grid[1] : c, d = b.grid[0] ? this.originalPageX + Math.round((d - this.originalPageX) / b.grid[0]) * b.grid[0] : this.originalPageX, d = h ? d - this.offset.click.left >= h[0] || d - this.offset.click.left > h[2] ? d : d - this.offset.click.left >= h[0] ? d - b.grid[0] : d + b.grid[0] : d)); return {
                    top: c -
                        this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : this.offset.scroll.top), left: d - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : this.offset.scroll.left)
                }
        }, _clear: function () {
            this.helper.removeClass("ui-draggable-dragging"); this.helper[0] === this.element[0] || this.cancelHelperRemoval || this.helper.remove(); this.helper = null; this.cancelHelperRemoval =
                !1
        }, _trigger: function (e, h, c) { c = c || this._uiHash(); a.ui.plugin.call(this, e, [h, c]); "drag" === e && (this.positionAbs = this._convertPositionTo("absolute")); return a.Widget.prototype._trigger.call(this, e, h, c) }, plugins: {}, _uiHash: function () { return { helper: this.helper, position: this.position, originalPosition: this.originalPosition, offset: this.positionAbs } }
    }); a.ui.plugin.add("draggable", "connectToSortable", {
        start: function (e, h) {
            var c = a(this).data("ui-draggable"), d = c.options, b = a.extend({}, h, { item: c.element }); c.sortables =
                []; a(d.connectToSortable).each(function () { var f = a.data(this, "ui-sortable"); f && !f.options.disabled && (c.sortables.push({ instance: f, shouldRevert: f.options.revert }), f.refreshPositions(), f._trigger("activate", e, b)) })
        }, stop: function (e, h) {
            var c = a(this).data("ui-draggable"), d = a.extend({}, h, { item: c.element }); a.each(c.sortables, function () {
                this.instance.isOver ? (this.instance.isOver = 0, c.cancelHelperRemoval = !0, this.instance.cancelHelperRemoval = !1, this.shouldRevert && (this.instance.options.revert = this.shouldRevert),
                    this.instance._mouseStop(e), this.instance.options.helper = this.instance.options._helper, "original" === c.options.helper && this.instance.currentItem.css({ top: "auto", left: "auto" })) : (this.instance.cancelHelperRemoval = !1, this.instance._trigger("deactivate", e, d))
            })
        }, drag: function (e, h) {
            var c = a(this).data("ui-draggable"), d = this; a.each(c.sortables, function () {
                var b = !1, f = this; this.instance.positionAbs = c.positionAbs; this.instance.helperProportions = c.helperProportions; this.instance.offset.click = c.offset.click; this.instance._intersectsWith(this.instance.containerCache) &&
                    (b = !0, a.each(c.sortables, function () { this.instance.positionAbs = c.positionAbs; this.instance.helperProportions = c.helperProportions; this.instance.offset.click = c.offset.click; this !== f && this.instance._intersectsWith(this.instance.containerCache) && a.contains(f.instance.element[0], this.instance.element[0]) && (b = !1); return b })); b ? (this.instance.isOver || (this.instance.isOver = 1, this.instance.currentItem = a(d).clone().removeAttr("id").appendTo(this.instance.element).data("ui-sortable-item", !0), this.instance.options._helper =
                        this.instance.options.helper, this.instance.options.helper = function () { return h.helper[0] }, e.target = this.instance.currentItem[0], this.instance._mouseCapture(e, !0), this.instance._mouseStart(e, !0, !0), this.instance.offset.click.top = c.offset.click.top, this.instance.offset.click.left = c.offset.click.left, this.instance.offset.parent.left -= c.offset.parent.left - this.instance.offset.parent.left, this.instance.offset.parent.top -= c.offset.parent.top - this.instance.offset.parent.top, c._trigger("toSortable", e), c.dropped =
                        this.instance.element, c.currentItem = c.element, this.instance.fromOutside = c), this.instance.currentItem && this.instance._mouseDrag(e)) : this.instance.isOver && (this.instance.isOver = 0, this.instance.cancelHelperRemoval = !0, this.instance.options.revert = !1, this.instance._trigger("out", e, this.instance._uiHash(this.instance)), this.instance._mouseStop(e, !0), this.instance.options.helper = this.instance.options._helper, this.instance.currentItem.remove(), this.instance.placeholder && this.instance.placeholder.remove(),
                            c._trigger("fromSortable", e), c.dropped = !1)
            })
        }
    }); a.ui.plugin.add("draggable", "cursor", { start: function () { var e = a("body"), h = a(this).data("ui-draggable").options; e.css("cursor") && (h._cursor = e.css("cursor")); e.css("cursor", h.cursor) }, stop: function () { var e = a(this).data("ui-draggable").options; e._cursor && a("body").css("cursor", e._cursor) } }); a.ui.plugin.add("draggable", "opacity", {
        start: function (e, h) {
            var c = a(h.helper), d = a(this).data("ui-draggable").options; c.css("opacity") && (d._opacity = c.css("opacity")); c.css("opacity",
                d.opacity)
        }, stop: function (e, h) { var c = a(this).data("ui-draggable").options; c._opacity && a(h.helper).css("opacity", c._opacity) }
    }); a.ui.plugin.add("draggable", "scroll", {
        start: function () { var e = a(this).data("ui-draggable"); e.scrollParent[0] !== document && "HTML" !== e.scrollParent[0].tagName && (e.overflowOffset = e.scrollParent.offset()) }, drag: function (e) {
            var h = a(this).data("ui-draggable"), c = h.options, d = !1; h.scrollParent[0] !== document && "HTML" !== h.scrollParent[0].tagName ? (c.axis && "x" === c.axis || (h.overflowOffset.top +
                h.scrollParent[0].offsetHeight - e.pageY < c.scrollSensitivity ? h.scrollParent[0].scrollTop = d = h.scrollParent[0].scrollTop + c.scrollSpeed : e.pageY - h.overflowOffset.top < c.scrollSensitivity && (h.scrollParent[0].scrollTop = d = h.scrollParent[0].scrollTop - c.scrollSpeed)), c.axis && "y" === c.axis || (h.overflowOffset.left + h.scrollParent[0].offsetWidth - e.pageX < c.scrollSensitivity ? h.scrollParent[0].scrollLeft = d = h.scrollParent[0].scrollLeft + c.scrollSpeed : e.pageX - h.overflowOffset.left < c.scrollSensitivity && (h.scrollParent[0].scrollLeft =
                    d = h.scrollParent[0].scrollLeft - c.scrollSpeed))) : (c.axis && "x" === c.axis || (e.pageY - a(document).scrollTop() < c.scrollSensitivity ? d = a(document).scrollTop(a(document).scrollTop() - c.scrollSpeed) : a(window).height() - (e.pageY - a(document).scrollTop()) < c.scrollSensitivity && (d = a(document).scrollTop(a(document).scrollTop() + c.scrollSpeed))), c.axis && "y" === c.axis || (e.pageX - a(document).scrollLeft() < c.scrollSensitivity ? d = a(document).scrollLeft(a(document).scrollLeft() - c.scrollSpeed) : a(window).width() - (e.pageX - a(document).scrollLeft()) <
                        c.scrollSensitivity && (d = a(document).scrollLeft(a(document).scrollLeft() + c.scrollSpeed)))); !1 !== d && a.ui.ddmanager && !c.dropBehaviour && a.ui.ddmanager.prepareOffsets(h, e)
        }
    }); a.ui.plugin.add("draggable", "snap", {
        start: function () {
            var e = a(this).data("ui-draggable"), h = e.options; e.snapElements = []; a(h.snap.constructor !== String ? h.snap.items || ":data(ui-draggable)" : h.snap).each(function () {
                var c = a(this), d = c.offset(); this !== e.element[0] && e.snapElements.push({
                    item: this, width: c.outerWidth(), height: c.outerHeight(),
                    top: d.top, left: d.left
                })
            })
        }, drag: function (e, h) {
            var c, d, b, f, m, k, r, l, t, s, v = a(this).data("ui-draggable"), y = v.options, g = y.snapTolerance, u = h.offset.left, q = u + v.helperProportions.width, w = h.offset.top, x = w + v.helperProportions.height; for (t = v.snapElements.length - 1; 0 <= t; t--)m = v.snapElements[t].left, k = m + v.snapElements[t].width, r = v.snapElements[t].top, l = r + v.snapElements[t].height, q < m - g || u > k + g || x < r - g || w > l + g || !a.contains(v.snapElements[t].item.ownerDocument, v.snapElements[t].item) ? (v.snapElements[t].snapping && v.options.snap.release &&
                v.options.snap.release.call(v.element, e, a.extend(v._uiHash(), { snapItem: v.snapElements[t].item })), v.snapElements[t].snapping = !1) : ("inner" !== y.snapMode && (c = Math.abs(r - x) <= g, d = Math.abs(l - w) <= g, b = Math.abs(m - q) <= g, f = Math.abs(k - u) <= g, c && (h.position.top = v._convertPositionTo("relative", { top: r - v.helperProportions.height, left: 0 }).top - v.margins.top), d && (h.position.top = v._convertPositionTo("relative", { top: l, left: 0 }).top - v.margins.top), b && (h.position.left = v._convertPositionTo("relative", { top: 0, left: m - v.helperProportions.width }).left -
                    v.margins.left), f && (h.position.left = v._convertPositionTo("relative", { top: 0, left: k }).left - v.margins.left)), s = c || d || b || f, "outer" !== y.snapMode && (c = Math.abs(r - w) <= g, d = Math.abs(l - x) <= g, b = Math.abs(m - u) <= g, f = Math.abs(k - q) <= g, c && (h.position.top = v._convertPositionTo("relative", { top: r, left: 0 }).top - v.margins.top), d && (h.position.top = v._convertPositionTo("relative", { top: l - v.helperProportions.height, left: 0 }).top - v.margins.top), b && (h.position.left = v._convertPositionTo("relative", { top: 0, left: m }).left - v.margins.left),
                        f && (h.position.left = v._convertPositionTo("relative", { top: 0, left: k - v.helperProportions.width }).left - v.margins.left)), !v.snapElements[t].snapping && (c || d || b || f || s) && v.options.snap.snap && v.options.snap.snap.call(v.element, e, a.extend(v._uiHash(), { snapItem: v.snapElements[t].item })), v.snapElements[t].snapping = c || d || b || f || s)
        }
    }); a.ui.plugin.add("draggable", "stack", {
        start: function () {
            var e, h = this.data("ui-draggable").options, h = a.makeArray(a(h.stack)).sort(function (c, d) {
                return (parseInt(a(c).css("zIndex"), 10) ||
                    0) - (parseInt(a(d).css("zIndex"), 10) || 0)
            }); h.length && (e = parseInt(a(h[0]).css("zIndex"), 10) || 0, a(h).each(function (c) { a(this).css("zIndex", e + c) }), this.css("zIndex", e + h.length))
        }
    }); a.ui.plugin.add("draggable", "zIndex", { start: function (e, h) { var c = a(h.helper), d = a(this).data("ui-draggable").options; c.css("zIndex") && (d._zIndex = c.css("zIndex")); c.css("zIndex", d.zIndex) }, stop: function (e, h) { var c = a(this).data("ui-draggable").options; c._zIndex && a(h.helper).css("zIndex", c._zIndex) } })
})(jQuery);
(function (a, l) {
    a.widget("ui.droppable", {
        version: "1.10.3", widgetEventPrefix: "drop", options: { accept: "*", activeClass: !1, addClasses: !0, greedy: !1, hoverClass: !1, scope: "default", tolerance: "intersect", activate: null, deactivate: null, drop: null, out: null, over: null }, _create: function () {
            var e = this.options, h = e.accept; this.isover = !1; this.isout = !0; this.accept = a.isFunction(h) ? h : function (a) { return a.is(h) }; this.proportions = { width: this.element[0].offsetWidth, height: this.element[0].offsetHeight }; a.ui.ddmanager.droppables[e.scope] =
                a.ui.ddmanager.droppables[e.scope] || []; a.ui.ddmanager.droppables[e.scope].push(this); e.addClasses && this.element.addClass("ui-droppable")
        }, _destroy: function () { for (var e = 0, h = a.ui.ddmanager.droppables[this.options.scope]; e < h.length; e++)h[e] === this && h.splice(e, 1); this.element.removeClass("ui-droppable ui-droppable-disabled") }, _setOption: function (e, h) { "accept" === e && (this.accept = a.isFunction(h) ? h : function (a) { return a.is(h) }); a.Widget.prototype._setOption.apply(this, arguments) }, _activate: function (e) {
            var h =
                a.ui.ddmanager.current; this.options.activeClass && this.element.addClass(this.options.activeClass); h && this._trigger("activate", e, this.ui(h))
        }, _deactivate: function (e) { var h = a.ui.ddmanager.current; this.options.activeClass && this.element.removeClass(this.options.activeClass); h && this._trigger("deactivate", e, this.ui(h)) }, _over: function (e) {
            var h = a.ui.ddmanager.current; h && (h.currentItem || h.element)[0] !== this.element[0] && this.accept.call(this.element[0], h.currentItem || h.element) && (this.options.hoverClass && this.element.addClass(this.options.hoverClass),
                this._trigger("over", e, this.ui(h)))
        }, _out: function (e) { var h = a.ui.ddmanager.current; h && (h.currentItem || h.element)[0] !== this.element[0] && this.accept.call(this.element[0], h.currentItem || h.element) && (this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("out", e, this.ui(h))) }, _drop: function (e, h) {
            var c = h || a.ui.ddmanager.current, d = !1; if (!c || (c.currentItem || c.element)[0] === this.element[0]) return !1; this.element.find(":data(ui-droppable)").not(".ui-draggable-dragging").each(function () {
                var b =
                    a.data(this, "ui-droppable"); if (b.options.greedy && !b.options.disabled && b.options.scope === c.options.scope && b.accept.call(b.element[0], c.currentItem || c.element) && a.ui.intersect(c, a.extend(b, { offset: b.element.offset() }), b.options.tolerance)) return d = !0, !1
            }); return d ? !1 : this.accept.call(this.element[0], c.currentItem || c.element) ? (this.options.activeClass && this.element.removeClass(this.options.activeClass), this.options.hoverClass && this.element.removeClass(this.options.hoverClass), this._trigger("drop", e,
                this.ui(c)), this.element) : !1
        }, ui: function (a) { return { draggable: a.currentItem || a.element, helper: a.helper, position: a.position, offset: a.positionAbs } }
    }); a.ui.intersect = function (a, h, c) {
        if (!h.offset) return !1; var d = (a.positionAbs || a.position.absolute).left, b = d + a.helperProportions.width, f = (a.positionAbs || a.position.absolute).top, m = f + a.helperProportions.height, k = h.offset.left, r = k + h.proportions.width, l = h.offset.top, t = l + h.proportions.height; switch (c) {
            case "fit": return k <= d && b <= r && l <= f && m <= t; case "intersect": return k <
                d + a.helperProportions.width / 2 && b - a.helperProportions.width / 2 < r && l < f + a.helperProportions.height / 2 && m - a.helperProportions.height / 2 < t; case "pointer": return c = (a.positionAbs || a.position.absolute).left + (a.clickOffset || a.offset.click).left, a = (a.positionAbs || a.position.absolute).top + (a.clickOffset || a.offset.click).top, a > l && a < l + h.proportions.height && c > k && c < k + h.proportions.width; case "touch": return (f >= l && f <= t || m >= l && m <= t || f < l && m > t) && (d >= k && d <= r || b >= k && b <= r || d < k && b > r); default: return !1
        }
    }; a.ui.ddmanager = {
        current: null,
        droppables: { "default": [] }, prepareOffsets: function (e, h) {
            var c, d, b = a.ui.ddmanager.droppables[e.options.scope] || [], f = h ? h.type : null, m = (e.currentItem || e.element).find(":data(ui-droppable)").addBack(); c = 0; a: for (; c < b.length; c++)if (!(b[c].options.disabled || e && !b[c].accept.call(b[c].element[0], e.currentItem || e.element))) {
                for (d = 0; d < m.length; d++)if (m[d] === b[c].element[0]) { b[c].proportions.height = 0; continue a } b[c].visible = "none" !== b[c].element.css("display"); b[c].visible && ("mousedown" === f && b[c]._activate.call(b[c],
                    h), b[c].offset = b[c].element.offset(), b[c].proportions = { width: b[c].element[0].offsetWidth, height: b[c].element[0].offsetHeight })
            }
        }, drop: function (e, h) {
            var c = !1; a.each((a.ui.ddmanager.droppables[e.options.scope] || []).slice(), function () {
                this.options && (!this.options.disabled && this.visible && a.ui.intersect(e, this, this.options.tolerance) && (c = this._drop.call(this, h) || c), !this.options.disabled && this.visible && this.accept.call(this.element[0], e.currentItem || e.element) && (this.isout = !0, this.isover = !1, this._deactivate.call(this,
                    h)))
            }); return c
        }, dragStart: function (e, h) { e.element.parentsUntil("body").bind("scroll.droppable", function () { e.options.refreshPositions || a.ui.ddmanager.prepareOffsets(e, h) }) }, drag: function (e, h) {
            e.options.refreshPositions && a.ui.ddmanager.prepareOffsets(e, h); a.each(a.ui.ddmanager.droppables[e.options.scope] || [], function () {
                if (!this.options.disabled && !this.greedyChild && this.visible) {
                    var c, d, b; b = a.ui.intersect(e, this, this.options.tolerance); var f = !b && this.isover ? "isout" : b && !this.isover ? "isover" : null; f &&
                        (this.options.greedy && (d = this.options.scope, b = this.element.parents(":data(ui-droppable)").filter(function () { return a.data(this, "ui-droppable").options.scope === d }), b.length && (c = a.data(b[0], "ui-droppable"), c.greedyChild = "isover" === f)), c && "isover" === f && (c.isover = !1, c.isout = !0, c._out.call(c, h)), this[f] = !0, this["isout" === f ? "isover" : "isout"] = !1, this["isover" === f ? "_over" : "_out"].call(this, h), c && "isout" === f && (c.isout = !1, c.isover = !0, c._over.call(c, h)))
                }
            })
        }, dragStop: function (e, h) {
            e.element.parentsUntil("body").unbind("scroll.droppable");
            e.options.refreshPositions || a.ui.ddmanager.prepareOffsets(e, h)
        }
    }
})(jQuery);
(function (a, l) {
    function e(a) { return parseInt(a, 10) || 0 } function h(a) { return !isNaN(parseInt(a, 10)) } a.widget("ui.resizable", a.ui.mouse, {
        version: "1.10.3", widgetEventPrefix: "resize", options: { alsoResize: !1, animate: !1, animateDuration: "slow", animateEasing: "swing", aspectRatio: !1, autoHide: !1, containment: !1, ghost: !1, grid: !1, handles: "e,s,se", helper: !1, maxHeight: null, maxWidth: null, minHeight: 10, minWidth: 10, zIndex: 90, resize: null, start: null, stop: null }, _create: function () {
            var c, d, b, f, m, k = this, e = this.options; this.element.addClass("ui-resizable");
            a.extend(this, { _aspectRatio: !!e.aspectRatio, aspectRatio: e.aspectRatio, originalElement: this.element, _proportionallyResizeElements: [], _helper: e.helper || e.ghost || e.animate ? e.helper || "ui-resizable-helper" : null }); this.element[0].nodeName.match(/canvas|textarea|input|select|button|img/i) && (this.element.wrap(a("\x3cdiv class\x3d'ui-wrapper' style\x3d'overflow: hidden;'\x3e\x3c/div\x3e").css({
                position: this.element.css("position"), width: this.element.outerWidth(), height: this.element.outerHeight(), top: this.element.css("top"),
                left: this.element.css("left")
            })), this.element = this.element.parent().data("ui-resizable", this.element.data("ui-resizable")), this.elementIsWrapper = !0, this.element.css({ marginLeft: this.originalElement.css("marginLeft"), marginTop: this.originalElement.css("marginTop"), marginRight: this.originalElement.css("marginRight"), marginBottom: this.originalElement.css("marginBottom") }), this.originalElement.css({ marginLeft: 0, marginTop: 0, marginRight: 0, marginBottom: 0 }), this.originalResizeStyle = this.originalElement.css("resize"),
                this.originalElement.css("resize", "none"), this._proportionallyResizeElements.push(this.originalElement.css({ position: "static", zoom: 1, display: "block" })), this.originalElement.css({ margin: this.originalElement.css("margin") }), this._proportionallyResize()); this.handles = e.handles || (a(".ui-resizable-handle", this.element).length ? { n: ".ui-resizable-n", e: ".ui-resizable-e", s: ".ui-resizable-s", w: ".ui-resizable-w", se: ".ui-resizable-se", sw: ".ui-resizable-sw", ne: ".ui-resizable-ne", nw: ".ui-resizable-nw" } : "e,s,se");
            if (this.handles.constructor === String) for ("all" === this.handles && (this.handles = "n,e,s,w,se,sw,ne,nw"), c = this.handles.split(","), this.handles = {}, d = 0; d < c.length; d++)b = a.trim(c[d]), m = "ui-resizable-" + b, f = a("\x3cdiv class\x3d'ui-resizable-handle " + m + "'\x3e\x3c/div\x3e"), f.css({ zIndex: e.zIndex }), "se" === b && f.addClass("ui-icon ui-icon-gripsmall-diagonal-se"), this.handles[b] = ".ui-resizable-" + b, this.element.append(f); this._renderAxis = function (b) {
                var c, f, d; b = b || this.element; for (c in this.handles) this.handles[c].constructor ===
                    String && (this.handles[c] = a(this.handles[c], this.element).show()), this.elementIsWrapper && this.originalElement[0].nodeName.match(/textarea|input|select|button/i) && (f = a(this.handles[c], this.element), d = /sw|ne|nw|se|n|s/.test(c) ? f.outerHeight() : f.outerWidth(), f = ["padding", /ne|nw|n/.test(c) ? "Top" : /se|sw|s/.test(c) ? "Bottom" : /^e$/.test(c) ? "Right" : "Left"].join(""), b.css(f, d), this._proportionallyResize()), a(this.handles[c])
            }; this._renderAxis(this.element); this._handles = a(".ui-resizable-handle", this.element).disableSelection();
            this._handles.mouseover(function () { k.resizing || (this.className && (f = this.className.match(/ui-resizable-(se|sw|ne|nw|n|e|s|w)/i)), k.axis = f && f[1] ? f[1] : "se") }); e.autoHide && (this._handles.hide(), a(this.element).addClass("ui-resizable-autohide").mouseenter(function () { e.disabled || (a(this).removeClass("ui-resizable-autohide"), k._handles.show()) }).mouseleave(function () { e.disabled || k.resizing || (a(this).addClass("ui-resizable-autohide"), k._handles.hide()) })); this._mouseInit()
        }, _destroy: function () {
            this._mouseDestroy();
            var c, d = function (b) { a(b).removeClass("ui-resizable ui-resizable-disabled ui-resizable-resizing").removeData("resizable").removeData("ui-resizable").unbind(".resizable").find(".ui-resizable-handle").remove() }; this.elementIsWrapper && (d(this.element), c = this.element, this.originalElement.css({ position: c.css("position"), width: c.outerWidth(), height: c.outerHeight(), top: c.css("top"), left: c.css("left") }).insertAfter(c), c.remove()); this.originalElement.css("resize", this.originalResizeStyle); d(this.originalElement);
            return this
        }, _mouseCapture: function (c) { var d, b, f = !1; for (d in this.handles) if (b = a(this.handles[d])[0], b === c.target || a.contains(b, c.target)) f = !0; return !this.options.disabled && f }, _mouseStart: function (c) {
            var d, b, f; f = this.options; d = this.element.position(); var m = this.element; this.resizing = !0; /absolute/.test(m.css("position")) ? m.css({ position: "absolute", top: m.css("top"), left: m.css("left") }) : m.is(".ui-draggable") && m.css({ position: "absolute", top: d.top, left: d.left }); this._renderProxy(); d = e(this.helper.css("left"));
            b = e(this.helper.css("top")); f.containment && (d += a(f.containment).scrollLeft() || 0, b += a(f.containment).scrollTop() || 0); this.offset = this.helper.offset(); this.position = { left: d, top: b }; this.size = this._helper ? { width: m.outerWidth(), height: m.outerHeight() } : { width: m.width(), height: m.height() }; this.originalSize = this._helper ? { width: m.outerWidth(), height: m.outerHeight() } : { width: m.width(), height: m.height() }; this.originalPosition = { left: d, top: b }; this.sizeDiff = {
                width: m.outerWidth() - m.width(), height: m.outerHeight() -
                    m.height()
            }; this.originalMousePosition = { left: c.pageX, top: c.pageY }; this.aspectRatio = "number" === typeof f.aspectRatio ? f.aspectRatio : this.originalSize.width / this.originalSize.height || 1; f = a(".ui-resizable-" + this.axis).css("cursor"); a("body").css("cursor", "auto" === f ? this.axis + "-resize" : f); m.addClass("ui-resizable-resizing"); this._propagate("start", c); return !0
        }, _mouseDrag: function (c) {
            var d, b = this.helper, f = {}; d = this.originalMousePosition; var m = this.position.top, k = this.position.left, e = this.size.width, h = this.size.height,
                l = this._change[this.axis]; if (!l) return !1; d = l.apply(this, [c, c.pageX - d.left || 0, c.pageY - d.top || 0]); this._updateVirtualBoundaries(c.shiftKey); if (this._aspectRatio || c.shiftKey) d = this._updateRatio(d, c); d = this._respectSize(d, c); this._updateCache(d); this._propagate("resize", c); this.position.top !== m && (f.top = this.position.top + "px"); this.position.left !== k && (f.left = this.position.left + "px"); this.size.width !== e && (f.width = this.size.width + "px"); this.size.height !== h && (f.height = this.size.height + "px"); b.css(f); !this._helper &&
                    this._proportionallyResizeElements.length && this._proportionallyResize(); a.isEmptyObject(f) || this._trigger("resize", c, this.ui()); return !1
        }, _mouseStop: function (c) {
            this.resizing = !1; var d, b, f, m = this.options; this._helper && (d = this._proportionallyResizeElements, d = (b = d.length && /textarea/i.test(d[0].nodeName)) && a.ui.hasScroll(d[0], "left") ? 0 : this.sizeDiff.height, b = b ? 0 : this.sizeDiff.width, b = { width: this.helper.width() - b, height: this.helper.height() - d }, d = parseInt(this.element.css("left"), 10) + (this.position.left -
                this.originalPosition.left) || null, f = parseInt(this.element.css("top"), 10) + (this.position.top - this.originalPosition.top) || null, m.animate || this.element.css(a.extend(b, { top: f, left: d })), this.helper.height(this.size.height), this.helper.width(this.size.width), this._helper && !m.animate && this._proportionallyResize()); a("body").css("cursor", "auto"); this.element.removeClass("ui-resizable-resizing"); this._propagate("stop", c); this._helper && this.helper.remove(); return !1
        }, _updateVirtualBoundaries: function (a) {
            var d,
            b, f, m; m = this.options; m = { minWidth: h(m.minWidth) ? m.minWidth : 0, maxWidth: h(m.maxWidth) ? m.maxWidth : Infinity, minHeight: h(m.minHeight) ? m.minHeight : 0, maxHeight: h(m.maxHeight) ? m.maxHeight : Infinity }; if (this._aspectRatio || a) a = m.minHeight * this.aspectRatio, b = m.minWidth / this.aspectRatio, d = m.maxHeight * this.aspectRatio, f = m.maxWidth / this.aspectRatio, a > m.minWidth && (m.minWidth = a), b > m.minHeight && (m.minHeight = b), d < m.maxWidth && (m.maxWidth = d), f < m.maxHeight && (m.maxHeight = f); this._vBoundaries = m
        }, _updateCache: function (a) {
            this.offset =
            this.helper.offset(); h(a.left) && (this.position.left = a.left); h(a.top) && (this.position.top = a.top); h(a.height) && (this.size.height = a.height); h(a.width) && (this.size.width = a.width)
        }, _updateRatio: function (a) { var d = this.position, b = this.size, f = this.axis; h(a.height) ? a.width = a.height * this.aspectRatio : h(a.width) && (a.height = a.width / this.aspectRatio); "sw" === f && (a.left = d.left + (b.width - a.width), a.top = null); "nw" === f && (a.top = d.top + (b.height - a.height), a.left = d.left + (b.width - a.width)); return a }, _respectSize: function (a) {
            var d =
                this._vBoundaries, b = this.axis, f = h(a.width) && d.maxWidth && d.maxWidth < a.width, m = h(a.height) && d.maxHeight && d.maxHeight < a.height, k = h(a.width) && d.minWidth && d.minWidth > a.width, e = h(a.height) && d.minHeight && d.minHeight > a.height, l = this.originalPosition.left + this.originalSize.width, t = this.position.top + this.size.height, s = /sw|nw|w/.test(b), b = /nw|ne|n/.test(b); k && (a.width = d.minWidth); e && (a.height = d.minHeight); f && (a.width = d.maxWidth); m && (a.height = d.maxHeight); k && s && (a.left = l - d.minWidth); f && s && (a.left = l - d.maxWidth);
            e && b && (a.top = t - d.minHeight); m && b && (a.top = t - d.maxHeight); a.width || a.height || a.left || !a.top ? a.width || a.height || a.top || !a.left || (a.left = null) : a.top = null; return a
        }, _proportionallyResize: function () {
            if (this._proportionallyResizeElements.length) {
                var a, d, b, f, m, k = this.helper || this.element; for (a = 0; a < this._proportionallyResizeElements.length; a++) {
                    m = this._proportionallyResizeElements[a]; if (!this.borderDif) for (this.borderDif = [], b = [m.css("borderTopWidth"), m.css("borderRightWidth"), m.css("borderBottomWidth"), m.css("borderLeftWidth")],
                        f = [m.css("paddingTop"), m.css("paddingRight"), m.css("paddingBottom"), m.css("paddingLeft")], d = 0; d < b.length; d++)this.borderDif[d] = (parseInt(b[d], 10) || 0) + (parseInt(f[d], 10) || 0); m.css({ height: k.height() - this.borderDif[0] - this.borderDif[2] || 0, width: k.width() - this.borderDif[1] - this.borderDif[3] || 0 })
                }
            }
        }, _renderProxy: function () {
            var c = this.options; this.elementOffset = this.element.offset(); this._helper ? (this.helper = this.helper || a("\x3cdiv style\x3d'overflow:hidden;'\x3e\x3c/div\x3e"), this.helper.addClass(this._helper).css({
                width: this.element.outerWidth() -
                    1, height: this.element.outerHeight() - 1, position: "absolute", left: this.elementOffset.left + "px", top: this.elementOffset.top + "px", zIndex: ++c.zIndex
            }), this.helper.appendTo("body").disableSelection()) : this.helper = this.element
        }, _change: {
            e: function (a, d) { return { width: this.originalSize.width + d } }, w: function (a, d) { return { left: this.originalPosition.left + d, width: this.originalSize.width - d } }, n: function (a, d, b) { return { top: this.originalPosition.top + b, height: this.originalSize.height - b } }, s: function (a, d, b) {
                return {
                    height: this.originalSize.height +
                        b
                }
            }, se: function (c, d, b) { return a.extend(this._change.s.apply(this, arguments), this._change.e.apply(this, [c, d, b])) }, sw: function (c, d, b) { return a.extend(this._change.s.apply(this, arguments), this._change.w.apply(this, [c, d, b])) }, ne: function (c, d, b) { return a.extend(this._change.n.apply(this, arguments), this._change.e.apply(this, [c, d, b])) }, nw: function (c, d, b) { return a.extend(this._change.n.apply(this, arguments), this._change.w.apply(this, [c, d, b])) }
        }, _propagate: function (c, d) {
            a.ui.plugin.call(this, c, [d, this.ui()]);
            "resize" !== c && this._trigger(c, d, this.ui())
        }, plugins: {}, ui: function () { return { originalElement: this.originalElement, element: this.element, helper: this.helper, position: this.position, size: this.size, originalSize: this.originalSize, originalPosition: this.originalPosition } }
    }); a.ui.plugin.add("resizable", "animate", {
        stop: function (c) {
            var d = a(this).data("ui-resizable"), b = d.options, f = d._proportionallyResizeElements, m = f.length && /textarea/i.test(f[0].nodeName), k = m && a.ui.hasScroll(f[0], "left") ? 0 : d.sizeDiff.height, m =
                { width: d.size.width - (m ? 0 : d.sizeDiff.width), height: d.size.height - k }, k = parseInt(d.element.css("left"), 10) + (d.position.left - d.originalPosition.left) || null, e = parseInt(d.element.css("top"), 10) + (d.position.top - d.originalPosition.top) || null; d.element.animate(a.extend(m, e && k ? { top: e, left: k } : {}), {
                    duration: b.animateDuration, easing: b.animateEasing, step: function () {
                        var b = {
                            width: parseInt(d.element.css("width"), 10), height: parseInt(d.element.css("height"), 10), top: parseInt(d.element.css("top"), 10), left: parseInt(d.element.css("left"),
                                10)
                        }; f && f.length && a(f[0]).css({ width: b.width, height: b.height }); d._updateCache(b); d._propagate("resize", c)
                    }
                })
        }
    }); a.ui.plugin.add("resizable", "containment", {
        start: function () {
            var c, d, b, f, m, k = a(this).data("ui-resizable"), h = k.element; b = k.options.containment; if (h = b instanceof a ? b.get(0) : /parent/.test(b) ? h.parent().get(0) : b) k.containerElement = a(h), /document/.test(b) || b === document ? (k.containerOffset = { left: 0, top: 0 }, k.containerPosition = { left: 0, top: 0 }, k.parentData = {
                element: a(document), left: 0, top: 0, width: a(document).width(),
                height: a(document).height() || document.body.parentNode.scrollHeight
            }) : (c = a(h), d = [], a(["Top", "Right", "Left", "Bottom"]).each(function (a, b) { d[a] = e(c.css("padding" + b)) }), k.containerOffset = c.offset(), k.containerPosition = c.position(), k.containerSize = { height: c.innerHeight() - d[3], width: c.innerWidth() - d[1] }, b = k.containerOffset, f = k.containerSize.height, m = k.containerSize.width, m = a.ui.hasScroll(h, "left") ? h.scrollWidth : m, f = a.ui.hasScroll(h) ? h.scrollHeight : f, k.parentData = {
                element: h, left: b.left, top: b.top, width: m,
                height: f
            })
        }, resize: function (c) {
            var d, b, f, m, k = a(this).data("ui-resizable"); d = k.options; b = k.containerOffset; f = k.position; c = k._aspectRatio || c.shiftKey; m = { top: 0, left: 0 }; var e = k.containerElement; e[0] !== document && /static/.test(e.css("position")) && (m = b); f.left < (k._helper ? b.left : 0) && (k.size.width += k._helper ? k.position.left - b.left : k.position.left - m.left, c && (k.size.height = k.size.width / k.aspectRatio), k.position.left = d.helper ? b.left : 0); f.top < (k._helper ? b.top : 0) && (k.size.height += k._helper ? k.position.top - b.top :
                k.position.top, c && (k.size.width = k.size.height * k.aspectRatio), k.position.top = k._helper ? b.top : 0); k.offset.left = k.parentData.left + k.position.left; k.offset.top = k.parentData.top + k.position.top; d = Math.abs(k.offset.left - m.left + k.sizeDiff.width); b = Math.abs((k._helper ? k.offset.top - m.top : k.offset.top - b.top) + k.sizeDiff.height); f = k.containerElement.get(0) === k.element.parent().get(0); m = /relative|absolute/.test(k.containerElement.css("position")); f && m && (d -= k.parentData.left); d + k.size.width >= k.parentData.width &&
                    (k.size.width = k.parentData.width - d, c && (k.size.height = k.size.width / k.aspectRatio)); b + k.size.height >= k.parentData.height && (k.size.height = k.parentData.height - b, c && (k.size.width = k.size.height * k.aspectRatio))
        }, stop: function () {
            var c = a(this).data("ui-resizable"), d = c.options, b = c.containerOffset, f = c.containerPosition, m = c.containerElement, k = a(c.helper), e = k.offset(), h = k.outerWidth() - c.sizeDiff.width, k = k.outerHeight() - c.sizeDiff.height; c._helper && !d.animate && /relative/.test(m.css("position")) && a(this).css({
                left: e.left -
                    f.left - b.left, width: h, height: k
            }); c._helper && !d.animate && /static/.test(m.css("position")) && a(this).css({ left: e.left - f.left - b.left, width: h, height: k })
        }
    }); a.ui.plugin.add("resizable", "alsoResize", {
        start: function () {
            var c = a(this).data("ui-resizable").options, d = function (b) { a(b).each(function () { var b = a(this); b.data("ui-resizable-alsoresize", { width: parseInt(b.width(), 10), height: parseInt(b.height(), 10), left: parseInt(b.css("left"), 10), top: parseInt(b.css("top"), 10) }) }) }; "object" !== typeof c.alsoResize || c.alsoResize.parentNode ?
                d(c.alsoResize) : c.alsoResize.length ? (c.alsoResize = c.alsoResize[0], d(c.alsoResize)) : a.each(c.alsoResize, function (a) { d(a) })
        }, resize: function (c, d) {
            var b = a(this).data("ui-resizable"), f = b.options, m = b.originalSize, k = b.originalPosition, e = { height: b.size.height - m.height || 0, width: b.size.width - m.width || 0, top: b.position.top - k.top || 0, left: b.position.left - k.left || 0 }, h = function (b, c) {
                a(b).each(function () {
                    var b = a(this), f = a(this).data("ui-resizable-alsoresize"), g = {}, m = c && c.length ? c : b.parents(d.originalElement[0]).length ?
                        ["width", "height"] : ["width", "height", "top", "left"]; a.each(m, function (a, b) { var c = (f[b] || 0) + (e[b] || 0); c && 0 <= c && (g[b] = c || null) }); b.css(g)
                })
            }; "object" !== typeof f.alsoResize || f.alsoResize.nodeType ? h(f.alsoResize) : a.each(f.alsoResize, function (a, b) { h(a, b) })
        }, stop: function () { a(this).removeData("resizable-alsoresize") }
    }); a.ui.plugin.add("resizable", "ghost", {
        start: function () {
            var c = a(this).data("ui-resizable"), d = c.options, b = c.size; c.ghost = c.originalElement.clone(); c.ghost.css({
                opacity: 0.25, display: "block", position: "relative",
                height: b.height, width: b.width, margin: 0, left: 0, top: 0
            }).addClass("ui-resizable-ghost").addClass("string" === typeof d.ghost ? d.ghost : ""); c.ghost.appendTo(c.helper)
        }, resize: function () { var c = a(this).data("ui-resizable"); c.ghost && c.ghost.css({ position: "relative", height: c.size.height, width: c.size.width }) }, stop: function () { var c = a(this).data("ui-resizable"); c.ghost && c.helper && c.helper.get(0).removeChild(c.ghost.get(0)) }
    }); a.ui.plugin.add("resizable", "grid", {
        resize: function () {
            var c = a(this).data("ui-resizable"),
            d = c.options, b = c.size, f = c.originalSize, m = c.originalPosition, k = c.axis, e = "number" === typeof d.grid ? [d.grid, d.grid] : d.grid, h = e[0] || 1, l = e[1] || 1, s = Math.round((b.width - f.width) / h) * h, b = Math.round((b.height - f.height) / l) * l, v = f.width + s, f = f.height + b, y = d.maxWidth && d.maxWidth < v, g = d.maxHeight && d.maxHeight < f, u = d.minWidth && d.minWidth > v, q = d.minHeight && d.minHeight > f; d.grid = e; u && (v += h); q && (f += l); y && (v -= h); g && (f -= l); /^(se|s|e)$/.test(k) ? (c.size.width = v, c.size.height = f) : /^(ne)$/.test(k) ? (c.size.width = v, c.size.height = f,
                c.position.top = m.top - b) : (/^(sw)$/.test(k) ? (c.size.width = v, c.size.height = f) : (c.size.width = v, c.size.height = f, c.position.top = m.top - b), c.position.left = m.left - s)
        }
    })
})(jQuery);
(function (a, l) {
    a.widget("ui.selectable", a.ui.mouse, {
        version: "1.10.3", options: { appendTo: "body", autoRefresh: !0, distance: 0, filter: "*", tolerance: "touch", selected: null, selecting: null, start: null, stop: null, unselected: null, unselecting: null }, _create: function () {
            var e, h = this; this.element.addClass("ui-selectable"); this.dragged = !1; this.refresh = function () {
                e = a(h.options.filter, h.element[0]); e.addClass("ui-selectee"); e.each(function () {
                    var c = a(this), d = c.offset(); a.data(this, "selectable-item", {
                        element: this, $element: c,
                        left: d.left, top: d.top, right: d.left + c.outerWidth(), bottom: d.top + c.outerHeight(), startselected: !1, selected: c.hasClass("ui-selected"), selecting: c.hasClass("ui-selecting"), unselecting: c.hasClass("ui-unselecting")
                    })
                })
            }; this.refresh(); this.selectees = e.addClass("ui-selectee"); this._mouseInit(); this.helper = a("\x3cdiv class\x3d'ui-selectable-helper'\x3e\x3c/div\x3e")
        }, _destroy: function () {
            this.selectees.removeClass("ui-selectee").removeData("selectable-item"); this.element.removeClass("ui-selectable ui-selectable-disabled");
            this._mouseDestroy()
        }, _mouseStart: function (e) {
            var h = this, c = this.options; this.opos = [e.pageX, e.pageY]; this.options.disabled || (this.selectees = a(c.filter, this.element[0]), this._trigger("start", e), a(c.appendTo).append(this.helper), this.helper.css({ left: e.pageX, top: e.pageY, width: 0, height: 0 }), c.autoRefresh && this.refresh(), this.selectees.filter(".ui-selected").each(function () {
                var c = a.data(this, "selectable-item"); c.startselected = !0; e.metaKey || e.ctrlKey || (c.$element.removeClass("ui-selected"), c.selected = !1,
                    c.$element.addClass("ui-unselecting"), c.unselecting = !0, h._trigger("unselecting", e, { unselecting: c.element }))
            }), a(e.target).parents().addBack().each(function () {
                var c, b = a.data(this, "selectable-item"); if (b) return c = !e.metaKey && !e.ctrlKey || !b.$element.hasClass("ui-selected"), b.$element.removeClass(c ? "ui-unselecting" : "ui-selected").addClass(c ? "ui-selecting" : "ui-unselecting"), b.unselecting = !c, b.selecting = c, (b.selected = c) ? h._trigger("selecting", e, { selecting: b.element }) : h._trigger("unselecting", e, { unselecting: b.element }),
                    !1
            }))
        }, _mouseDrag: function (e) {
            this.dragged = !0; if (!this.options.disabled) {
                var h, c = this, d = this.options, b = this.opos[0], f = this.opos[1], m = e.pageX, k = e.pageY; b > m && (h = m, m = b, b = h); f > k && (h = k, k = f, f = h); this.helper.css({ left: b, top: f, width: m - b, height: k - f }); this.selectees.each(function () {
                    var h = a.data(this, "selectable-item"), l = !1; h && h.element !== c.element[0] && ("touch" === d.tolerance ? l = !(h.left > m || h.right < b || h.top > k || h.bottom < f) : "fit" === d.tolerance && (l = h.left > b && h.right < m && h.top > f && h.bottom < k), l ? (h.selected && (h.$element.removeClass("ui-selected"),
                        h.selected = !1), h.unselecting && (h.$element.removeClass("ui-unselecting"), h.unselecting = !1), h.selecting || (h.$element.addClass("ui-selecting"), h.selecting = !0, c._trigger("selecting", e, { selecting: h.element }))) : (h.selecting && ((e.metaKey || e.ctrlKey) && h.startselected ? (h.$element.removeClass("ui-selecting"), h.selecting = !1, h.$element.addClass("ui-selected"), h.selected = !0) : (h.$element.removeClass("ui-selecting"), h.selecting = !1, h.startselected && (h.$element.addClass("ui-unselecting"), h.unselecting = !0), c._trigger("unselecting",
                            e, { unselecting: h.element }))), !h.selected || e.metaKey || e.ctrlKey || h.startselected || (h.$element.removeClass("ui-selected"), h.selected = !1, h.$element.addClass("ui-unselecting"), h.unselecting = !0, c._trigger("unselecting", e, { unselecting: h.element }))))
                }); return !1
            }
        }, _mouseStop: function (e) {
            var h = this; this.dragged = !1; a(".ui-unselecting", this.element[0]).each(function () { var c = a.data(this, "selectable-item"); c.$element.removeClass("ui-unselecting"); c.unselecting = !1; c.startselected = !1; h._trigger("unselected", e, { unselected: c.element }) });
            a(".ui-selecting", this.element[0]).each(function () { var c = a.data(this, "selectable-item"); c.$element.removeClass("ui-selecting").addClass("ui-selected"); c.selecting = !1; c.selected = !0; c.startselected = !0; h._trigger("selected", e, { selected: c.element }) }); this._trigger("stop", e); this.helper.remove(); return !1
        }
    })
})(jQuery);
(function (a, l) {
    function e(a) { return /left|right/.test(a.css("float")) || /inline|table-cell/.test(a.css("display")) } a.widget("ui.sortable", a.ui.mouse, {
        version: "1.10.3", widgetEventPrefix: "sort", ready: !1, options: {
            appendTo: "parent", axis: !1, connectWith: !1, containment: !1, cursor: "auto", cursorAt: !1, dropOnEmpty: !0, forcePlaceholderSize: !1, forceHelperSize: !1, grid: !1, handle: !1, helper: "original", items: "\x3e *", opacity: !1, placeholder: !1, revert: !1, scroll: !0, scrollSensitivity: 20, scrollSpeed: 20, scope: "default", tolerance: "intersect",
            zIndex: 1E3, activate: null, beforeStop: null, change: null, deactivate: null, out: null, over: null, receive: null, remove: null, sort: null, start: null, stop: null, update: null
        }, _create: function () { var a = this.options; this.containerCache = {}; this.element.addClass("ui-sortable"); this.refresh(); this.floating = this.items.length ? "x" === a.axis || e(this.items[0].item) : !1; this.offset = this.element.offset(); this._mouseInit(); this.ready = !0 }, _destroy: function () {
            this.element.removeClass("ui-sortable ui-sortable-disabled"); this._mouseDestroy();
            for (var a = this.items.length - 1; 0 <= a; a--)this.items[a].item.removeData(this.widgetName + "-item"); return this
        }, _setOption: function (h, c) { "disabled" === h ? (this.options[h] = c, this.widget().toggleClass("ui-sortable-disabled", !!c)) : a.Widget.prototype._setOption.apply(this, arguments) }, _mouseCapture: function (h, c) {
            var d = null, b = !1, f = this; if (this.reverting || this.options.disabled || "static" === this.options.type) return !1; this._refreshItems(h); a(h.target).parents().each(function () {
                if (a.data(this, f.widgetName + "-item") ===
                    f) return d = a(this), !1
            }); a.data(h.target, f.widgetName + "-item") === f && (d = a(h.target)); if (!d || this.options.handle && !c && (a(this.options.handle, d).find("*").addBack().each(function () { this === h.target && (b = !0) }), !b)) return !1; this.currentItem = d; this._removeCurrentsFromItems(); return !0
        }, _mouseStart: function (h, c, d) {
            var b; c = this.options; this.currentContainer = this; this.refreshPositions(); this.helper = this._createHelper(h); this._cacheHelperProportions(); this._cacheMargins(); this.scrollParent = this.helper.scrollParent();
            this.offset = this.currentItem.offset(); this.offset = { top: this.offset.top - this.margins.top, left: this.offset.left - this.margins.left }; a.extend(this.offset, { click: { left: h.pageX - this.offset.left, top: h.pageY - this.offset.top }, parent: this._getParentOffset(), relative: this._getRelativeOffset() }); this.helper.css("position", "absolute"); this.cssPosition = this.helper.css("position"); this.originalPosition = this._generatePosition(h); this.originalPageX = h.pageX; this.originalPageY = h.pageY; c.cursorAt && this._adjustOffsetFromHelper(c.cursorAt);
            this.domPosition = { prev: this.currentItem.prev()[0], parent: this.currentItem.parent()[0] }; this.helper[0] !== this.currentItem[0] && this.currentItem.hide(); this._createPlaceholder(); c.containment && this._setContainment(); c.cursor && "auto" !== c.cursor && (b = this.document.find("body"), this.storedCursor = b.css("cursor"), b.css("cursor", c.cursor), this.storedStylesheet = a("\x3cstyle\x3e*{ cursor: " + c.cursor + " !important; }\x3c/style\x3e").appendTo(b)); c.opacity && (this.helper.css("opacity") && (this._storedOpacity = this.helper.css("opacity")),
                this.helper.css("opacity", c.opacity)); c.zIndex && (this.helper.css("zIndex") && (this._storedZIndex = this.helper.css("zIndex")), this.helper.css("zIndex", c.zIndex)); this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName && (this.overflowOffset = this.scrollParent.offset()); this._trigger("start", h, this._uiHash()); this._preserveHelperProportions || this._cacheHelperProportions(); if (!d) for (d = this.containers.length - 1; 0 <= d; d--)this.containers[d]._trigger("activate", h, this._uiHash(this)); a.ui.ddmanager &&
                    (a.ui.ddmanager.current = this); a.ui.ddmanager && !c.dropBehaviour && a.ui.ddmanager.prepareOffsets(this, h); this.dragging = !0; this.helper.addClass("ui-sortable-helper"); this._mouseDrag(h); return !0
        }, _mouseDrag: function (h) {
            var c, d, b, f; c = this.options; d = !1; this.position = this._generatePosition(h); this.positionAbs = this._convertPositionTo("absolute"); this.lastPositionAbs || (this.lastPositionAbs = this.positionAbs); this.options.scroll && (this.scrollParent[0] !== document && "HTML" !== this.scrollParent[0].tagName ? (this.overflowOffset.top +
                this.scrollParent[0].offsetHeight - h.pageY < c.scrollSensitivity ? this.scrollParent[0].scrollTop = d = this.scrollParent[0].scrollTop + c.scrollSpeed : h.pageY - this.overflowOffset.top < c.scrollSensitivity && (this.scrollParent[0].scrollTop = d = this.scrollParent[0].scrollTop - c.scrollSpeed), this.overflowOffset.left + this.scrollParent[0].offsetWidth - h.pageX < c.scrollSensitivity ? this.scrollParent[0].scrollLeft = d = this.scrollParent[0].scrollLeft + c.scrollSpeed : h.pageX - this.overflowOffset.left < c.scrollSensitivity && (this.scrollParent[0].scrollLeft =
                    d = this.scrollParent[0].scrollLeft - c.scrollSpeed)) : (h.pageY - a(document).scrollTop() < c.scrollSensitivity ? d = a(document).scrollTop(a(document).scrollTop() - c.scrollSpeed) : a(window).height() - (h.pageY - a(document).scrollTop()) < c.scrollSensitivity && (d = a(document).scrollTop(a(document).scrollTop() + c.scrollSpeed)), h.pageX - a(document).scrollLeft() < c.scrollSensitivity ? d = a(document).scrollLeft(a(document).scrollLeft() - c.scrollSpeed) : a(window).width() - (h.pageX - a(document).scrollLeft()) < c.scrollSensitivity && (d = a(document).scrollLeft(a(document).scrollLeft() +
                        c.scrollSpeed))), !1 !== d && a.ui.ddmanager && !c.dropBehaviour && a.ui.ddmanager.prepareOffsets(this, h)); this.positionAbs = this._convertPositionTo("absolute"); this.options.axis && "y" === this.options.axis || (this.helper[0].style.left = this.position.left + "px"); this.options.axis && "x" === this.options.axis || (this.helper[0].style.top = this.position.top + "px"); for (c = this.items.length - 1; 0 <= c; c--)if (d = this.items[c], b = d.item[0], (f = this._intersectsWithPointer(d)) && d.instance === this.currentContainer && b !== this.currentItem[0] &&
                            this.placeholder[1 === f ? "next" : "prev"]()[0] !== b && !a.contains(this.placeholder[0], b) && ("semi-dynamic" === this.options.type ? !a.contains(this.element[0], b) : 1)) { this.direction = 1 === f ? "down" : "up"; if ("pointer" === this.options.tolerance || this._intersectsWithSides(d)) this._rearrange(h, d); else break; this._trigger("change", h, this._uiHash()); break } this._contactContainers(h); a.ui.ddmanager && a.ui.ddmanager.drag(this, h); this._trigger("sort", h, this._uiHash()); this.lastPositionAbs = this.positionAbs; return !1
        }, _mouseStop: function (h,
            c) {
                if (h) {
                    a.ui.ddmanager && !this.options.dropBehaviour && a.ui.ddmanager.drop(this, h); if (this.options.revert) {
                        var d = this, b = this.placeholder.offset(), f = this.options.axis, m = {}; f && "x" !== f || (m.left = b.left - this.offset.parent.left - this.margins.left + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollLeft)); f && "y" !== f || (m.top = b.top - this.offset.parent.top - this.margins.top + (this.offsetParent[0] === document.body ? 0 : this.offsetParent[0].scrollTop)); this.reverting = !0; a(this.helper).animate(m, parseInt(this.options.revert,
                            10) || 500, function () { d._clear(h) })
                    } else this._clear(h, c); return !1
                }
        }, cancel: function () {
            if (this.dragging) {
                this._mouseUp({ target: null }); "original" === this.options.helper ? this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") : this.currentItem.show(); for (var h = this.containers.length - 1; 0 <= h; h--)this.containers[h]._trigger("deactivate", null, this._uiHash(this)), this.containers[h].containerCache.over && (this.containers[h]._trigger("out", null, this._uiHash(this)), this.containers[h].containerCache.over =
                    0)
            } this.placeholder && (this.placeholder[0].parentNode && this.placeholder[0].parentNode.removeChild(this.placeholder[0]), "original" !== this.options.helper && this.helper && this.helper[0].parentNode && this.helper.remove(), a.extend(this, { helper: null, dragging: !1, reverting: !1, _noFinalSort: null }), this.domPosition.prev ? a(this.domPosition.prev).after(this.currentItem) : a(this.domPosition.parent).prepend(this.currentItem)); return this
        }, serialize: function (h) {
            var c = this._getItemsAsjQuery(h && h.connected), d = []; h = h || {};
            a(c).each(function () { var b = (a(h.item || this).attr(h.attribute || "id") || "").match(h.expression || /(.+)[\-=_](.+)/); b && d.push((h.key || b[1] + "[]") + "\x3d" + (h.key && h.expression ? b[1] : b[2])) }); !d.length && h.key && d.push(h.key + "\x3d"); return d.join("\x26")
        }, toArray: function (h) { var c = this._getItemsAsjQuery(h && h.connected), d = []; h = h || {}; c.each(function () { d.push(a(h.item || this).attr(h.attribute || "id") || "") }); return d }, _intersectsWith: function (a) {
            var c = this.positionAbs.left, d = c + this.helperProportions.width, b = this.positionAbs.top,
            f = b + this.helperProportions.height, m = a.left, k = m + a.width, e = a.top, l = e + a.height, t = this.offset.click.top, s = this.offset.click.left, s = "y" === this.options.axis || c + s > m && c + s < k, t = ("x" === this.options.axis || b + t > e && b + t < l) && s; return "pointer" === this.options.tolerance || this.options.forcePointerForContainers || "pointer" !== this.options.tolerance && this.helperProportions[this.floating ? "width" : "height"] > a[this.floating ? "width" : "height"] ? t : m < c + this.helperProportions.width / 2 && d - this.helperProportions.width / 2 < k && e < b + this.helperProportions.height /
                2 && f - this.helperProportions.height / 2 < l
        }, _intersectsWithPointer: function (a) {
            var c = "y" === this.options.axis || this.positionAbs.left + this.offset.click.left > a.left && this.positionAbs.left + this.offset.click.left < a.left + a.width; a = ("x" === this.options.axis || this.positionAbs.top + this.offset.click.top > a.top && this.positionAbs.top + this.offset.click.top < a.top + a.height) && c; var c = this._getDragVerticalDirection(), d = this._getDragHorizontalDirection(); return a ? this.floating ? d && "right" === d || "down" === c ? 2 : 1 : c && ("down" ===
                c ? 2 : 1) : !1
        }, _intersectsWithSides: function (a) { var c = this.positionAbs.top + this.offset.click.top > a.top + a.height / 2 && this.positionAbs.top + this.offset.click.top < a.top + a.height / 2 + a.height; a = this.positionAbs.left + this.offset.click.left > a.left + a.width / 2 && this.positionAbs.left + this.offset.click.left < a.left + a.width / 2 + a.width; var d = this._getDragVerticalDirection(), b = this._getDragHorizontalDirection(); return this.floating && b ? "right" === b && a || "left" === b && !a : d && ("down" === d && c || "up" === d && !c) }, _getDragVerticalDirection: function () {
            var a =
                this.positionAbs.top - this.lastPositionAbs.top; return 0 !== a && (0 < a ? "down" : "up")
        }, _getDragHorizontalDirection: function () { var a = this.positionAbs.left - this.lastPositionAbs.left; return 0 !== a && (0 < a ? "right" : "left") }, refresh: function (a) { this._refreshItems(a); this.refreshPositions(); return this }, _connectWith: function () { var a = this.options; return a.connectWith.constructor === String ? [a.connectWith] : a.connectWith }, _getItemsAsjQuery: function (e) {
            var c, d, b, f = [], m = [], k = this._connectWith(); if (k && e) for (e = k.length - 1; 0 <=
                e; e--)for (d = a(k[e]), c = d.length - 1; 0 <= c; c--)(b = a.data(d[c], this.widgetFullName)) && b !== this && !b.options.disabled && m.push([a.isFunction(b.options.items) ? b.options.items.call(b.element) : a(b.options.items, b.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), b]); m.push([a.isFunction(this.options.items) ? this.options.items.call(this.element, null, { options: this.options, item: this.currentItem }) : a(this.options.items, this.element).not(".ui-sortable-helper").not(".ui-sortable-placeholder"), this]);
            for (e = m.length - 1; 0 <= e; e--)m[e][0].each(function () { f.push(this) }); return a(f)
        }, _removeCurrentsFromItems: function () { var e = this.currentItem.find(":data(" + this.widgetName + "-item)"); this.items = a.grep(this.items, function (a) { for (var d = 0; d < e.length; d++)if (e[d] === a.item[0]) return !1; return !0 }) }, _refreshItems: function (e) {
            this.items = []; this.containers = [this]; var c, d, b, f, m, k = this.items, r = [[a.isFunction(this.options.items) ? this.options.items.call(this.element[0], e, { item: this.currentItem }) : a(this.options.items,
                this.element), this]]; if ((m = this._connectWith()) && this.ready) for (c = m.length - 1; 0 <= c; c--)for (b = a(m[c]), d = b.length - 1; 0 <= d; d--)(f = a.data(b[d], this.widgetFullName)) && f !== this && !f.options.disabled && (r.push([a.isFunction(f.options.items) ? f.options.items.call(f.element[0], e, { item: this.currentItem }) : a(f.options.items, f.element), f]), this.containers.push(f)); for (c = r.length - 1; 0 <= c; c--)for (e = r[c][1], b = r[c][0], d = 0, m = b.length; d < m; d++)f = a(b[d]), f.data(this.widgetName + "-item", e), k.push({
                    item: f, instance: e, width: 0, height: 0,
                    left: 0, top: 0
                })
        }, refreshPositions: function (e) {
            this.offsetParent && this.helper && (this.offset.parent = this._getParentOffset()); var c, d, b; for (c = this.items.length - 1; 0 <= c; c--)d = this.items[c], d.instance !== this.currentContainer && this.currentContainer && d.item[0] !== this.currentItem[0] || (b = this.options.toleranceElement ? a(this.options.toleranceElement, d.item) : d.item, e || (d.width = b.outerWidth(), d.height = b.outerHeight()), b = b.offset(), d.left = b.left, d.top = b.top); if (this.options.custom && this.options.custom.refreshContainers) this.options.custom.refreshContainers.call(this);
            else for (c = this.containers.length - 1; 0 <= c; c--)b = this.containers[c].element.offset(), this.containers[c].containerCache.left = b.left, this.containers[c].containerCache.top = b.top, this.containers[c].containerCache.width = this.containers[c].element.outerWidth(), this.containers[c].containerCache.height = this.containers[c].element.outerHeight(); return this
        }, _createPlaceholder: function (e) {
            e = e || this; var c, d = e.options; d.placeholder && d.placeholder.constructor !== String || (c = d.placeholder, d.placeholder = {
                element: function () {
                    var b =
                        e.currentItem[0].nodeName.toLowerCase(), f = a("\x3c" + b + "\x3e", e.document[0]).addClass(c || e.currentItem[0].className + " ui-sortable-placeholder").removeClass("ui-sortable-helper"); "tr" === b ? e.currentItem.children().each(function () { a("\x3ctd\x3e\x26#160;\x3c/td\x3e", e.document[0]).attr("colspan", a(this).attr("colspan") || 1).appendTo(f) }) : "img" === b && f.attr("src", e.currentItem.attr("src")); c || f.css("visibility", "hidden"); return f
                }, update: function (a, f) {
                    if (!c || d.forcePlaceholderSize) f.height() || f.height(e.currentItem.innerHeight() -
                        parseInt(e.currentItem.css("paddingTop") || 0, 10) - parseInt(e.currentItem.css("paddingBottom") || 0, 10)), f.width() || f.width(e.currentItem.innerWidth() - parseInt(e.currentItem.css("paddingLeft") || 0, 10) - parseInt(e.currentItem.css("paddingRight") || 0, 10))
                }
            }); e.placeholder = a(d.placeholder.element.call(e.element, e.currentItem)); e.currentItem.after(e.placeholder); d.placeholder.update(e, e.placeholder)
        }, _contactContainers: function (h) {
            var c, d, b, f, m, k, r, l, t, s = d = null; for (c = this.containers.length - 1; 0 <= c; c--)a.contains(this.currentItem[0],
                this.containers[c].element[0]) || (this._intersectsWith(this.containers[c].containerCache) ? d && a.contains(this.containers[c].element[0], d.element[0]) || (d = this.containers[c], s = c) : this.containers[c].containerCache.over && (this.containers[c]._trigger("out", h, this._uiHash(this)), this.containers[c].containerCache.over = 0)); if (d) if (1 === this.containers.length) this.containers[s].containerCache.over || (this.containers[s]._trigger("over", h, this._uiHash(this)), this.containers[s].containerCache.over = 1); else {
                    c = 1E4;
                    b = null; f = (t = d.floating || e(this.currentItem)) ? "left" : "top"; m = t ? "width" : "height"; k = this.positionAbs[f] + this.offset.click[f]; for (d = this.items.length - 1; 0 <= d; d--)a.contains(this.containers[s].element[0], this.items[d].item[0]) && this.items[d].item[0] !== this.currentItem[0] && (!t || this.positionAbs.top + this.offset.click.top > this.items[d].top && this.positionAbs.top + this.offset.click.top < this.items[d].top + this.items[d].height) && (r = this.items[d].item.offset()[f], l = !1, Math.abs(r - k) > Math.abs(r + this.items[d][m] - k) &&
                        (l = !0, r += this.items[d][m]), Math.abs(r - k) < c && (c = Math.abs(r - k), b = this.items[d], this.direction = l ? "up" : "down")); (b || this.options.dropOnEmpty) && this.currentContainer !== this.containers[s] && (b ? this._rearrange(h, b, null, !0) : this._rearrange(h, null, this.containers[s].element, !0), this._trigger("change", h, this._uiHash()), this.containers[s]._trigger("change", h, this._uiHash(this)), this.currentContainer = this.containers[s], this.options.placeholder.update(this.currentContainer, this.placeholder), this.containers[s]._trigger("over",
                            h, this._uiHash(this)), this.containers[s].containerCache.over = 1)
                }
        }, _createHelper: function (e) {
            var c = this.options; e = a.isFunction(c.helper) ? a(c.helper.apply(this.element[0], [e, this.currentItem])) : "clone" === c.helper ? this.currentItem.clone() : this.currentItem; e.parents("body").length || a("parent" !== c.appendTo ? c.appendTo : this.currentItem[0].parentNode)[0].appendChild(e[0]); e[0] === this.currentItem[0] && (this._storedCSS = {
                width: this.currentItem[0].style.width, height: this.currentItem[0].style.height, position: this.currentItem.css("position"),
                top: this.currentItem.css("top"), left: this.currentItem.css("left")
            }); e[0].style.width && !c.forceHelperSize || e.width(this.currentItem.width()); e[0].style.height && !c.forceHelperSize || e.height(this.currentItem.height()); return e
        }, _adjustOffsetFromHelper: function (e) {
            "string" === typeof e && (e = e.split(" ")); a.isArray(e) && (e = { left: +e[0], top: +e[1] || 0 }); "left" in e && (this.offset.click.left = e.left + this.margins.left); "right" in e && (this.offset.click.left = this.helperProportions.width - e.right + this.margins.left); "top" in
                e && (this.offset.click.top = e.top + this.margins.top); "bottom" in e && (this.offset.click.top = this.helperProportions.height - e.bottom + this.margins.top)
        }, _getParentOffset: function () {
            this.offsetParent = this.helper.offsetParent(); var e = this.offsetParent.offset(); "absolute" === this.cssPosition && this.scrollParent[0] !== document && a.contains(this.scrollParent[0], this.offsetParent[0]) && (e.left += this.scrollParent.scrollLeft(), e.top += this.scrollParent.scrollTop()); if (this.offsetParent[0] === document.body || this.offsetParent[0].tagName &&
                "html" === this.offsetParent[0].tagName.toLowerCase() && a.ui.ie) e = { top: 0, left: 0 }; return { top: e.top + (parseInt(this.offsetParent.css("borderTopWidth"), 10) || 0), left: e.left + (parseInt(this.offsetParent.css("borderLeftWidth"), 10) || 0) }
        }, _getRelativeOffset: function () {
            if ("relative" === this.cssPosition) { var a = this.currentItem.position(); return { top: a.top - (parseInt(this.helper.css("top"), 10) || 0) + this.scrollParent.scrollTop(), left: a.left - (parseInt(this.helper.css("left"), 10) || 0) + this.scrollParent.scrollLeft() } } return {
                top: 0,
                left: 0
            }
        }, _cacheMargins: function () { this.margins = { left: parseInt(this.currentItem.css("marginLeft"), 10) || 0, top: parseInt(this.currentItem.css("marginTop"), 10) || 0 } }, _cacheHelperProportions: function () { this.helperProportions = { width: this.helper.outerWidth(), height: this.helper.outerHeight() } }, _setContainment: function () {
            var e, c, d; c = this.options; "parent" === c.containment && (c.containment = this.helper[0].parentNode); if ("document" === c.containment || "window" === c.containment) this.containment = [0 - this.offset.relative.left -
                this.offset.parent.left, 0 - this.offset.relative.top - this.offset.parent.top, a("document" === c.containment ? document : window).width() - this.helperProportions.width - this.margins.left, (a("document" === c.containment ? document : window).height() || document.body.parentNode.scrollHeight) - this.helperProportions.height - this.margins.top]; /^(document|window|parent)$/.test(c.containment) || (e = a(c.containment)[0], c = a(c.containment).offset(), d = "hidden" !== a(e).css("overflow"), this.containment = [c.left + (parseInt(a(e).css("borderLeftWidth"),
                    10) || 0) + (parseInt(a(e).css("paddingLeft"), 10) || 0) - this.margins.left, c.top + (parseInt(a(e).css("borderTopWidth"), 10) || 0) + (parseInt(a(e).css("paddingTop"), 10) || 0) - this.margins.top, c.left + (d ? Math.max(e.scrollWidth, e.offsetWidth) : e.offsetWidth) - (parseInt(a(e).css("borderLeftWidth"), 10) || 0) - (parseInt(a(e).css("paddingRight"), 10) || 0) - this.helperProportions.width - this.margins.left, c.top + (d ? Math.max(e.scrollHeight, e.offsetHeight) : e.offsetHeight) - (parseInt(a(e).css("borderTopWidth"), 10) || 0) - (parseInt(a(e).css("paddingBottom"),
                        10) || 0) - this.helperProportions.height - this.margins.top])
        }, _convertPositionTo: function (e, c) {
            c || (c = this.position); var d = "absolute" === e ? 1 : -1, b = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && a.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent, f = /(html|body)/i.test(b[0].tagName); return {
                top: c.top + this.offset.relative.top * d + this.offset.parent.top * d - ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : f ? 0 : b.scrollTop()) * d, left: c.left + this.offset.relative.left *
                    d + this.offset.parent.left * d - ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : f ? 0 : b.scrollLeft()) * d
            }
        }, _generatePosition: function (e) {
            var c, d, b = this.options; d = e.pageX; c = e.pageY; var f = "absolute" !== this.cssPosition || this.scrollParent[0] !== document && a.contains(this.scrollParent[0], this.offsetParent[0]) ? this.scrollParent : this.offsetParent, m = /(html|body)/i.test(f[0].tagName); "relative" !== this.cssPosition || this.scrollParent[0] !== document && this.scrollParent[0] !== this.offsetParent[0] || (this.offset.relative =
                this._getRelativeOffset()); this.originalPosition && (this.containment && (e.pageX - this.offset.click.left < this.containment[0] && (d = this.containment[0] + this.offset.click.left), e.pageY - this.offset.click.top < this.containment[1] && (c = this.containment[1] + this.offset.click.top), e.pageX - this.offset.click.left > this.containment[2] && (d = this.containment[2] + this.offset.click.left), e.pageY - this.offset.click.top > this.containment[3] && (c = this.containment[3] + this.offset.click.top)), b.grid && (c = this.originalPageY + Math.round((c -
                    this.originalPageY) / b.grid[1]) * b.grid[1], c = this.containment ? c - this.offset.click.top >= this.containment[1] && c - this.offset.click.top <= this.containment[3] ? c : c - this.offset.click.top >= this.containment[1] ? c - b.grid[1] : c + b.grid[1] : c, d = this.originalPageX + Math.round((d - this.originalPageX) / b.grid[0]) * b.grid[0], d = this.containment ? d - this.offset.click.left >= this.containment[0] && d - this.offset.click.left <= this.containment[2] ? d : d - this.offset.click.left >= this.containment[0] ? d - b.grid[0] : d + b.grid[0] : d)); return {
                        top: c -
                            this.offset.click.top - this.offset.relative.top - this.offset.parent.top + ("fixed" === this.cssPosition ? -this.scrollParent.scrollTop() : m ? 0 : f.scrollTop()), left: d - this.offset.click.left - this.offset.relative.left - this.offset.parent.left + ("fixed" === this.cssPosition ? -this.scrollParent.scrollLeft() : m ? 0 : f.scrollLeft())
                    }
        }, _rearrange: function (a, c, d, b) {
            d ? d[0].appendChild(this.placeholder[0]) : c.item[0].parentNode.insertBefore(this.placeholder[0], "down" === this.direction ? c.item[0] : c.item[0].nextSibling); var f = this.counter =
                this.counter ? ++this.counter : 1; this._delay(function () { f === this.counter && this.refreshPositions(!b) })
        }, _clear: function (a, c) {
            this.reverting = !1; var d, b = []; !this._noFinalSort && this.currentItem.parent().length && this.placeholder.before(this.currentItem); this._noFinalSort = null; if (this.helper[0] === this.currentItem[0]) { for (d in this._storedCSS) if ("auto" === this._storedCSS[d] || "static" === this._storedCSS[d]) this._storedCSS[d] = ""; this.currentItem.css(this._storedCSS).removeClass("ui-sortable-helper") } else this.currentItem.show();
            this.fromOutside && !c && b.push(function (a) { this._trigger("receive", a, this._uiHash(this.fromOutside)) }); !this.fromOutside && this.domPosition.prev === this.currentItem.prev().not(".ui-sortable-helper")[0] && this.domPosition.parent === this.currentItem.parent()[0] || c || b.push(function (a) { this._trigger("update", a, this._uiHash()) }); this === this.currentContainer || c || (b.push(function (a) { this._trigger("remove", a, this._uiHash()) }), b.push(function (a) { return function (b) { a._trigger("receive", b, this._uiHash(this)) } }.call(this,
                this.currentContainer)), b.push(function (a) { return function (b) { a._trigger("update", b, this._uiHash(this)) } }.call(this, this.currentContainer))); for (d = this.containers.length - 1; 0 <= d; d--)c || b.push(function (a) { return function (b) { a._trigger("deactivate", b, this._uiHash(this)) } }.call(this, this.containers[d])), this.containers[d].containerCache.over && (b.push(function (a) { return function (b) { a._trigger("out", b, this._uiHash(this)) } }.call(this, this.containers[d])), this.containers[d].containerCache.over = 0); this.storedCursor &&
                    (this.document.find("body").css("cursor", this.storedCursor), this.storedStylesheet.remove()); this._storedOpacity && this.helper.css("opacity", this._storedOpacity); this._storedZIndex && this.helper.css("zIndex", "auto" === this._storedZIndex ? "" : this._storedZIndex); this.dragging = !1; if (this.cancelHelperRemoval) { if (!c) { this._trigger("beforeStop", a, this._uiHash()); for (d = 0; d < b.length; d++)b[d].call(this, a); this._trigger("stop", a, this._uiHash()) } return this.fromOutside = !1 } c || this._trigger("beforeStop", a, this._uiHash());
            this.placeholder[0].parentNode.removeChild(this.placeholder[0]); this.helper[0] !== this.currentItem[0] && this.helper.remove(); this.helper = null; if (!c) { for (d = 0; d < b.length; d++)b[d].call(this, a); this._trigger("stop", a, this._uiHash()) } this.fromOutside = !1; return !0
        }, _trigger: function () { !1 === a.Widget.prototype._trigger.apply(this, arguments) && this.cancel() }, _uiHash: function (e) {
            var c = e || this; return {
                helper: c.helper, placeholder: c.placeholder || a([]), position: c.position, originalPosition: c.originalPosition, offset: c.positionAbs,
                item: c.currentItem, sender: e ? e.element : null
            }
        }
    })
})(jQuery);
(function (a, l) {
    var e = 0, h = {}, c = {}; h.height = h.paddingTop = h.paddingBottom = h.borderTopWidth = h.borderBottomWidth = "hide"; c.height = c.paddingTop = c.paddingBottom = c.borderTopWidth = c.borderBottomWidth = "show"; a.widget("ui.accordion", {
        version: "1.10.3", options: { active: 0, animate: {}, collapsible: !1, event: "click", header: "\x3e li \x3e :first-child,\x3e :not(li):even", heightStyle: "auto", icons: { activeHeader: "ui-icon-triangle-1-s", header: "ui-icon-triangle-1-e" }, activate: null, beforeActivate: null }, _create: function () {
            var c =
                this.options; this.prevShow = this.prevHide = a(); this.element.addClass("ui-accordion ui-widget ui-helper-reset").attr("role", "tablist"); c.collapsible || !1 !== c.active && null != c.active || (c.active = 0); this._processPanels(); 0 > c.active && (c.active += this.headers.length); this._refresh()
        }, _getCreateEventData: function () { return { header: this.active, panel: this.active.length ? this.active.next() : a(), content: this.active.length ? this.active.next() : a() } }, _createIcons: function () {
            var c = this.options.icons; c && (a("\x3cspan\x3e").addClass("ui-accordion-header-icon ui-icon " +
                c.header).prependTo(this.headers), this.active.children(".ui-accordion-header-icon").removeClass(c.header).addClass(c.activeHeader), this.headers.addClass("ui-accordion-icons"))
        }, _destroyIcons: function () { this.headers.removeClass("ui-accordion-icons").children(".ui-accordion-header-icon").remove() }, _destroy: function () {
            var a; this.element.removeClass("ui-accordion ui-widget ui-helper-reset").removeAttr("role"); this.headers.removeClass("ui-accordion-header ui-accordion-header-active ui-helper-reset ui-state-default ui-corner-all ui-state-active ui-state-disabled ui-corner-top").removeAttr("role").removeAttr("aria-selected").removeAttr("aria-controls").removeAttr("tabIndex").each(function () {
                /^ui-accordion/.test(this.id) &&
                this.removeAttribute("id")
            }); this._destroyIcons(); a = this.headers.next().css("display", "").removeAttr("role").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-labelledby").removeClass("ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content ui-accordion-content-active ui-state-disabled").each(function () { /^ui-accordion/.test(this.id) && this.removeAttribute("id") }); "content" !== this.options.heightStyle && a.css("height", "")
        }, _setOption: function (a, b) {
            "active" === a ? this._activate(b) :
            ("event" === a && (this.options.event && this._off(this.headers, this.options.event), this._setupEvents(b)), this._super(a, b), "collapsible" !== a || b || !1 !== this.options.active || this._activate(0), "icons" === a && (this._destroyIcons(), b && this._createIcons()), "disabled" === a && this.headers.add(this.headers.next()).toggleClass("ui-state-disabled", !!b))
        }, _keydown: function (c) {
            if (!c.altKey && !c.ctrlKey) {
                var b = a.ui.keyCode, f = this.headers.length, m = this.headers.index(c.target), k = !1; switch (c.keyCode) {
                    case b.RIGHT: case b.DOWN: k =
                        this.headers[(m + 1) % f]; break; case b.LEFT: case b.UP: k = this.headers[(m - 1 + f) % f]; break; case b.SPACE: case b.ENTER: this._eventHandler(c); break; case b.HOME: k = this.headers[0]; break; case b.END: k = this.headers[f - 1]
                }k && (a(c.target).attr("tabIndex", -1), a(k).attr("tabIndex", 0), k.focus(), c.preventDefault())
            }
        }, _panelKeyDown: function (c) { c.keyCode === a.ui.keyCode.UP && c.ctrlKey && a(c.currentTarget).prev().focus() }, refresh: function () {
            var c = this.options; this._processPanels(); !1 === c.active && !0 === c.collapsible || !this.headers.length ?
                (c.active = !1, this.active = a()) : !1 === c.active ? this._activate(0) : this.active.length && !a.contains(this.element[0], this.active[0]) ? this.headers.length === this.headers.find(".ui-state-disabled").length ? (c.active = !1, this.active = a()) : this._activate(Math.max(0, c.active - 1)) : c.active = this.headers.index(this.active); this._destroyIcons(); this._refresh()
        }, _processPanels: function () { this.headers = this.element.find(this.options.header).addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-all"); this.headers.next().addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").filter(":not(.ui-accordion-content-active)").hide() },
        _refresh: function () {
            var c, b = this.options, f = b.heightStyle, m = this.element.parent(), k = this.accordionId = "ui-accordion-" + (this.element.attr("id") || ++e); this.active = this._findActive(b.active).addClass("ui-accordion-header-active ui-state-active ui-corner-top").removeClass("ui-corner-all"); this.active.next().addClass("ui-accordion-content-active").show(); this.headers.attr("role", "tab").each(function (b) {
                var c = a(this), f = c.attr("id"), d = c.next(), m = d.attr("id"); f || (f = k + "-header-" + b, c.attr("id", f)); m || (m = k + "-panel-" +
                    b, d.attr("id", m)); c.attr("aria-controls", m); d.attr("aria-labelledby", f)
            }).next().attr("role", "tabpanel"); this.headers.not(this.active).attr({ "aria-selected": "false", tabIndex: -1 }).next().attr({ "aria-expanded": "false", "aria-hidden": "true" }).hide(); this.active.length ? this.active.attr({ "aria-selected": "true", tabIndex: 0 }).next().attr({ "aria-expanded": "true", "aria-hidden": "false" }) : this.headers.eq(0).attr("tabIndex", 0); this._createIcons(); this._setupEvents(b.event); "fill" === f ? (c = m.height(), this.element.siblings(":visible").each(function () {
                var b =
                    a(this), f = b.css("position"); "absolute" !== f && "fixed" !== f && (c -= b.outerHeight(!0))
            }), this.headers.each(function () { c -= a(this).outerHeight(!0) }), this.headers.next().each(function () { a(this).height(Math.max(0, c - a(this).innerHeight() + a(this).height())) }).css("overflow", "auto")) : "auto" === f && (c = 0, this.headers.next().each(function () { c = Math.max(c, a(this).css("height", "").height()) }).height(c))
        }, _activate: function (c) {
            c = this._findActive(c)[0]; c !== this.active[0] && (c = c || this.active[0], this._eventHandler({
                target: c,
                currentTarget: c, preventDefault: a.noop
            }))
        }, _findActive: function (c) { return "number" === typeof c ? this.headers.eq(c) : a() }, _setupEvents: function (c) { var b = { keydown: "_keydown" }; c && a.each(c.split(" "), function (a, c) { b[c] = "_eventHandler" }); this._off(this.headers.add(this.headers.next())); this._on(this.headers, b); this._on(this.headers.next(), { keydown: "_panelKeyDown" }); this._hoverable(this.headers); this._focusable(this.headers) }, _eventHandler: function (c) {
            var b = this.options, f = this.active, m = a(c.currentTarget), k =
                m[0] === f[0], e = k && b.collapsible, h = e ? a() : m.next(), l = f.next(), h = { oldHeader: f, oldPanel: l, newHeader: e ? a() : m, newPanel: h }; c.preventDefault(); k && !b.collapsible || !1 === this._trigger("beforeActivate", c, h) || (b.active = e ? !1 : this.headers.index(m), this.active = k ? a() : m, this._toggle(h), f.removeClass("ui-accordion-header-active ui-state-active"), b.icons && f.children(".ui-accordion-header-icon").removeClass(b.icons.activeHeader).addClass(b.icons.header), k || (m.removeClass("ui-corner-all").addClass("ui-accordion-header-active ui-state-active ui-corner-top"),
                    b.icons && m.children(".ui-accordion-header-icon").removeClass(b.icons.header).addClass(b.icons.activeHeader), m.next().addClass("ui-accordion-content-active")))
        }, _toggle: function (c) {
            var b = c.newPanel, f = this.prevShow.length ? this.prevShow : c.oldPanel; this.prevShow.add(this.prevHide).stop(!0, !0); this.prevShow = b; this.prevHide = f; this.options.animate ? this._animate(b, f, c) : (f.hide(), b.show(), this._toggleComplete(c)); f.attr({ "aria-expanded": "false", "aria-hidden": "true" }); f.prev().attr("aria-selected", "false");
            b.length && f.length ? f.prev().attr("tabIndex", -1) : b.length && this.headers.filter(function () { return 0 === a(this).attr("tabIndex") }).attr("tabIndex", -1); b.attr({ "aria-expanded": "true", "aria-hidden": "false" }).prev().attr({ "aria-selected": "true", tabIndex: 0 })
        }, _animate: function (a, b, f) {
            var m, k, e, l = this, t = 0, s = a.length && (!b.length || a.index() < b.index()), v = this.options.animate || {}, s = s && v.down || v, y = function () { l._toggleComplete(f) }; "number" === typeof s && (e = s); "string" === typeof s && (k = s); k = k || s.easing || v.easing; e = e ||
                s.duration || v.duration; if (!b.length) return a.animate(c, e, k, y); if (!a.length) return b.animate(h, e, k, y); m = a.show().outerHeight(); b.animate(h, { duration: e, easing: k, step: function (a, b) { b.now = Math.round(a) } }); a.hide().animate(c, { duration: e, easing: k, complete: y, step: function (a, c) { c.now = Math.round(a); "height" !== c.prop ? t += c.now : "content" !== l.options.heightStyle && (c.now = Math.round(m - b.outerHeight() - t), t = 0) } })
        }, _toggleComplete: function (a) {
            var b = a.oldPanel; b.removeClass("ui-accordion-content-active").prev().removeClass("ui-corner-top").addClass("ui-corner-all");
            b.length && (b.parent()[0].className = b.parent()[0].className); this._trigger("activate", null, a)
        }
    })
})(jQuery);
(function (a, l) {
    var e = 0; a.widget("ui.autocomplete", {
        version: "1.10.3", defaultElement: "\x3cinput\x3e", options: { appendTo: null, autoFocus: !1, delay: 300, minLength: 1, position: { my: "left top", at: "left bottom", collision: "none" }, source: null, change: null, close: null, focus: null, open: null, response: null, search: null, select: null }, pending: 0, _create: function () {
            var e, c, d, b = this.element[0].nodeName.toLowerCase(), f = "textarea" === b, b = "input" === b; this.isMultiLine = f ? !0 : b ? !1 : this.element.prop("isContentEditable"); this.valueMethod =
                this.element[f || b ? "val" : "text"]; this.isNewMenu = !0; this.element.addClass("ui-autocomplete-input").attr("autocomplete", "off"); this._on(this.element, {
                    keydown: function (b) {
                        if (this.element.prop("readOnly")) c = d = e = !0; else {
                            c = d = e = !1; var f = a.ui.keyCode; switch (b.keyCode) {
                                case f.PAGE_UP: e = !0; this._move("previousPage", b); break; case f.PAGE_DOWN: e = !0; this._move("nextPage", b); break; case f.UP: e = !0; this._keyEvent("previous", b); break; case f.DOWN: e = !0; this._keyEvent("next", b); break; case f.ENTER: case f.NUMPAD_ENTER: this.menu.active &&
                                    (e = !0, b.preventDefault(), this.menu.select(b)); break; case f.TAB: this.menu.active && this.menu.select(b); break; case f.ESCAPE: this.menu.element.is(":visible") && (this._value(this.term), this.close(b), b.preventDefault()); break; default: c = !0, this._searchTimeout(b)
                            }
                        }
                    }, keypress: function (b) {
                        if (e) e = !1, this.isMultiLine && !this.menu.element.is(":visible") || b.preventDefault(); else if (!c) {
                            var f = a.ui.keyCode; switch (b.keyCode) {
                                case f.PAGE_UP: this._move("previousPage", b); break; case f.PAGE_DOWN: this._move("nextPage", b);
                                    break; case f.UP: this._keyEvent("previous", b); break; case f.DOWN: this._keyEvent("next", b)
                            }
                        }
                    }, input: function (a) { d ? (d = !1, a.preventDefault()) : this._searchTimeout(a) }, focus: function () { this.selectedItem = null; this.previous = this._value() }, blur: function (a) { this.cancelBlur ? delete this.cancelBlur : (clearTimeout(this.searching), this.close(a), this._change(a)) }
                }); this._initSource(); this.menu = a("\x3cul\x3e").addClass("ui-autocomplete ui-front").appendTo(this._appendTo()).menu({ role: null }).hide().data("ui-menu"); this._on(this.menu.element,
                    {
                        mousedown: function (b) { b.preventDefault(); this.cancelBlur = !0; this._delay(function () { delete this.cancelBlur }); var c = this.menu.element[0]; a(b.target).closest(".ui-menu-item").length || this._delay(function () { var b = this; this.document.one("mousedown", function (f) { f.target === b.element[0] || f.target === c || a.contains(c, f.target) || b.close() }) }) }, menufocus: function (b, c) {
                            if (this.isNewMenu && (this.isNewMenu = !1, b.originalEvent && /^mouse/.test(b.originalEvent.type))) {
                                this.menu.blur(); this.document.one("mousemove", function () { a(b.target).trigger(b.originalEvent) });
                                return
                            } var f = c.item.data("ui-autocomplete-item"); !1 !== this._trigger("focus", b, { item: f }) ? b.originalEvent && /^key/.test(b.originalEvent.type) && this._value(f.value) : this.liveRegion.text(f.value)
                        }, menuselect: function (a, b) {
                            var c = b.item.data("ui-autocomplete-item"), f = this.previous; this.element[0] !== this.document[0].activeElement && (this.element.focus(), this.previous = f, this._delay(function () { this.previous = f; this.selectedItem = c })); !1 !== this._trigger("select", a, { item: c }) && this._value(c.value); this.term = this._value();
                            this.close(a); this.selectedItem = c
                        }
                    }); this.liveRegion = a("\x3cspan\x3e", { role: "status", "aria-live": "polite" }).addClass("ui-helper-hidden-accessible").insertBefore(this.element); this._on(this.window, { beforeunload: function () { this.element.removeAttr("autocomplete") } })
        }, _destroy: function () { clearTimeout(this.searching); this.element.removeClass("ui-autocomplete-input").removeAttr("autocomplete"); this.menu.element.remove(); this.liveRegion.remove() }, _setOption: function (a, c) {
            this._super(a, c); "source" === a && this._initSource();
            "appendTo" === a && this.menu.element.appendTo(this._appendTo()); "disabled" === a && c && this.xhr && this.xhr.abort()
        }, _appendTo: function () { var e = this.options.appendTo; e && (e = e.jquery || e.nodeType ? a(e) : this.document.find(e).eq(0)); e || (e = this.element.closest(".ui-front")); e.length || (e = this.document[0].body); return e }, _initSource: function () {
            var e, c, d = this; a.isArray(this.options.source) ? (e = this.options.source, this.source = function (b, c) { c(a.ui.autocomplete.filter(e, b.term)) }) : "string" === typeof this.options.source ?
                (c = this.options.source, this.source = function (b, f) { d.xhr && d.xhr.abort(); d.xhr = a.ajax({ url: c, data: b, dataType: "json", success: function (a) { f(a) }, error: function () { f([]) } }) }) : this.source = this.options.source
        }, _searchTimeout: function (a) { clearTimeout(this.searching); this.searching = this._delay(function () { this.term !== this._value() && (this.selectedItem = null, this.search(null, a)) }, this.options.delay) }, search: function (a, c) {
            a = null != a ? a : this._value(); this.term = this._value(); if (a.length < this.options.minLength) return this.close(c);
            if (!1 !== this._trigger("search", c)) return this._search(a)
        }, _search: function (a) { this.pending++; this.element.addClass("ui-autocomplete-loading"); this.cancelSearch = !1; this.source({ term: a }, this._response()) }, _response: function () { var a = this, c = ++e; return function (d) { c === e && a.__response(d); a.pending--; a.pending || a.element.removeClass("ui-autocomplete-loading") } }, __response: function (a) {
            a && (a = this._normalize(a)); this._trigger("response", null, { content: a }); !this.options.disabled && a && a.length && !this.cancelSearch ?
                (this._suggest(a), this._trigger("open")) : this._close()
        }, close: function (a) { this.cancelSearch = !0; this._close(a) }, _close: function (a) { this.menu.element.is(":visible") && (this.menu.element.hide(), this.menu.blur(), this.isNewMenu = !0, this._trigger("close", a)) }, _change: function (a) { this.previous !== this._value() && this._trigger("change", a, { item: this.selectedItem }) }, _normalize: function (e) {
            return e.length && e[0].label && e[0].value ? e : a.map(e, function (c) {
                return "string" === typeof c ? { label: c, value: c } : a.extend({
                    label: c.label ||
                        c.value, value: c.value || c.label
                }, c)
            })
        }, _suggest: function (e) { var c = this.menu.element.empty(); this._renderMenu(c, e); this.isNewMenu = !0; this.menu.refresh(); c.show(); this._resizeMenu(); c.position(a.extend({ of: this.element }, this.options.position)); this.options.autoFocus && this.menu.next() }, _resizeMenu: function () { var a = this.menu.element; a.outerWidth(Math.max(a.width("").outerWidth() + 1, this.element.outerWidth())) }, _renderMenu: function (e, c) { var d = this; a.each(c, function (a, c) { d._renderItemData(e, c) }) }, _renderItemData: function (a,
            c) { return this._renderItem(a, c).data("ui-autocomplete-item", c) }, _renderItem: function (e, c) { return a("\x3cli\x3e").append(a("\x3ca\x3e").html(c.label)).appendTo(e) }, _move: function (a, c) { if (this.menu.element.is(":visible")) if (this.menu.isFirstItem() && /^previous/.test(a) || this.menu.isLastItem() && /^next/.test(a)) this._value(this.term), this.menu.blur(); else this.menu[a](c); else this.search(null, c) }, widget: function () { return this.menu.element }, _value: function () { return this.valueMethod.apply(this.element, arguments) },
        _keyEvent: function (a, c) { if (!this.isMultiLine || this.menu.element.is(":visible")) this._move(a, c), c.preventDefault() }
    }); a.extend(a.ui.autocomplete, { escapeRegex: function (a) { return a.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g, "\\$\x26") }, filter: function (e, c) { var d = RegExp(a.ui.autocomplete.escapeRegex(c), "i"); return a.grep(e, function (a) { return d.test(a.label || a.value || a) }) } }); a.widget("ui.autocomplete", a.ui.autocomplete, {
        options: {
            messages: {
                noResults: "No search results.", results: function (a) {
                    return a + (1 < a ? " results are" :
                        " result is") + " available, use up and down arrow keys to navigate."
                }
            }
        }, __response: function (a) { var c; this._superApply(arguments); this.options.disabled || this.cancelSearch || (c = a && a.length ? this.options.messages.results(a.length) : this.options.messages.noResults, this.liveRegion.text(c)) }
    })
})(jQuery);
(function (a, l) {
    var e, h, c, d, b = function () { var b = a(this); setTimeout(function () { b.find(":ui-button").button("refresh") }, 1) }, f = function (b) { var c = b.name, f = b.form, d = a([]); c && (c = c.replace(/'/g, "\\'"), d = f ? a(f).find("[name\x3d'" + c + "']") : a("[name\x3d'" + c + "']", b.ownerDocument).filter(function () { return !this.form })); return d }; a.widget("ui.button", {
        version: "1.10.3", defaultElement: "\x3cbutton\x3e", options: { disabled: null, text: !0, label: null, icons: { primary: null, secondary: null } }, _create: function () {
            this.element.closest("form").unbind("reset" +
                this.eventNamespace).bind("reset" + this.eventNamespace, b); "boolean" !== typeof this.options.disabled ? this.options.disabled = !!this.element.prop("disabled") : this.element.prop("disabled", this.options.disabled); this._determineButtonType(); this.hasTitle = !!this.buttonElement.attr("title"); var m = this, k = this.options, r = "checkbox" === this.type || "radio" === this.type, l = r ? "" : "ui-state-active"; null === k.label && (k.label = "input" === this.type ? this.buttonElement.val() : this.buttonElement.html()); this._hoverable(this.buttonElement);
            this.buttonElement.addClass("ui-button ui-widget ui-state-default ui-corner-all").attr("role", "button").bind("mouseenter" + this.eventNamespace, function () { k.disabled || this === e && a(this).addClass("ui-state-active") }).bind("mouseleave" + this.eventNamespace, function () { k.disabled || a(this).removeClass(l) }).bind("click" + this.eventNamespace, function (a) { k.disabled && (a.preventDefault(), a.stopImmediatePropagation()) }); this.element.bind("focus" + this.eventNamespace, function () { m.buttonElement.addClass("ui-state-focus") }).bind("blur" +
                this.eventNamespace, function () { m.buttonElement.removeClass("ui-state-focus") }); r && (this.element.bind("change" + this.eventNamespace, function () { d || m.refresh() }), this.buttonElement.bind("mousedown" + this.eventNamespace, function (a) { k.disabled || (d = !1, h = a.pageX, c = a.pageY) }).bind("mouseup" + this.eventNamespace, function (a) { k.disabled || h === a.pageX && c === a.pageY || (d = !0) })); "checkbox" === this.type ? this.buttonElement.bind("click" + this.eventNamespace, function () { if (k.disabled || d) return !1 }) : "radio" === this.type ? this.buttonElement.bind("click" +
                    this.eventNamespace, function () { if (k.disabled || d) return !1; a(this).addClass("ui-state-active"); m.buttonElement.attr("aria-pressed", "true"); var b = m.element[0]; f(b).not(b).map(function () { return a(this).button("widget")[0] }).removeClass("ui-state-active").attr("aria-pressed", "false") }) : (this.buttonElement.bind("mousedown" + this.eventNamespace, function () { if (k.disabled) return !1; a(this).addClass("ui-state-active"); e = this; m.document.one("mouseup", function () { e = null }) }).bind("mouseup" + this.eventNamespace, function () {
                        if (k.disabled) return !1;
                        a(this).removeClass("ui-state-active")
                    }).bind("keydown" + this.eventNamespace, function (b) { if (k.disabled) return !1; b.keyCode !== a.ui.keyCode.SPACE && b.keyCode !== a.ui.keyCode.ENTER || a(this).addClass("ui-state-active") }).bind("keyup" + this.eventNamespace + " blur" + this.eventNamespace, function () { a(this).removeClass("ui-state-active") }), this.buttonElement.is("a") && this.buttonElement.keyup(function (b) { b.keyCode === a.ui.keyCode.SPACE && a(this).click() })); this._setOption("disabled", k.disabled); this._resetButton()
        },
        _determineButtonType: function () {
            var a, b; this.element.is("[type\x3dcheckbox]") ? this.type = "checkbox" : this.element.is("[type\x3dradio]") ? this.type = "radio" : this.element.is("input") ? this.type = "input" : this.type = "button"; "checkbox" === this.type || "radio" === this.type ? (a = this.element.parents().last(), b = "label[for\x3d'" + this.element.attr("id") + "']", this.buttonElement = a.find(b), this.buttonElement.length || (a = a.length ? a.siblings() : this.element.siblings(), this.buttonElement = a.filter(b), this.buttonElement.length ||
                (this.buttonElement = a.find(b))), this.element.addClass("ui-helper-hidden-accessible"), (a = this.element.is(":checked")) && this.buttonElement.addClass("ui-state-active"), this.buttonElement.prop("aria-pressed", a)) : this.buttonElement = this.element
        }, widget: function () { return this.buttonElement }, _destroy: function () {
            this.element.removeClass("ui-helper-hidden-accessible"); this.buttonElement.removeClass("ui-button ui-widget ui-state-default ui-corner-all ui-state-hover ui-state-active  ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only").removeAttr("role").removeAttr("aria-pressed").html(this.buttonElement.find(".ui-button-text").html());
            this.hasTitle || this.buttonElement.removeAttr("title")
        }, _setOption: function (a, b) { this._super(a, b); "disabled" === a ? b ? this.element.prop("disabled", !0) : this.element.prop("disabled", !1) : this._resetButton() }, refresh: function () {
            var b = this.element.is("input, button") ? this.element.is(":disabled") : this.element.hasClass("ui-button-disabled"); b !== this.options.disabled && this._setOption("disabled", b); "radio" === this.type ? f(this.element[0]).each(function () {
                a(this).is(":checked") ? a(this).button("widget").addClass("ui-state-active").attr("aria-pressed",
                    "true") : a(this).button("widget").removeClass("ui-state-active").attr("aria-pressed", "false")
            }) : "checkbox" === this.type && (this.element.is(":checked") ? this.buttonElement.addClass("ui-state-active").attr("aria-pressed", "true") : this.buttonElement.removeClass("ui-state-active").attr("aria-pressed", "false"))
        }, _resetButton: function () {
            if ("input" === this.type) this.options.label && this.element.val(this.options.label); else {
                var b = this.buttonElement.removeClass("ui-button-icons-only ui-button-icon-only ui-button-text-icons ui-button-text-icon-primary ui-button-text-icon-secondary ui-button-text-only"),
                c = a("\x3cspan\x3e\x3c/span\x3e", this.document[0]).addClass("ui-button-text").html(this.options.label).appendTo(b.empty()).text(), f = this.options.icons, d = f.primary && f.secondary, e = []; f.primary || f.secondary ? (this.options.text && e.push("ui-button-text-icon" + (d ? "s" : f.primary ? "-primary" : "-secondary")), f.primary && b.prepend("\x3cspan class\x3d'ui-button-icon-primary ui-icon " + f.primary + "'\x3e\x3c/span\x3e"), f.secondary && b.append("\x3cspan class\x3d'ui-button-icon-secondary ui-icon " + f.secondary + "'\x3e\x3c/span\x3e"),
                    this.options.text || (e.push(d ? "ui-button-icons-only" : "ui-button-icon-only"), this.hasTitle || b.attr("title", a.trim(c)))) : e.push("ui-button-text-only"); b.addClass(e.join(" "))
            }
        }
    }); a.widget("ui.buttonset", {
        version: "1.10.3", options: { items: "button, input[type\x3dbutton], input[type\x3dsubmit], input[type\x3dreset], input[type\x3dcheckbox], input[type\x3dradio], a, :data(ui-button)" }, _create: function () { this.element.addClass("ui-buttonset") }, _init: function () { this.refresh() }, _setOption: function (a, b) {
            "disabled" ===
            a && this.buttons.button("option", a, b); this._super(a, b)
        }, refresh: function () { var b = "rtl" === this.element.css("direction"); this.buttons = this.element.find(this.options.items).filter(":ui-button").button("refresh").end().not(":ui-button").button().end().map(function () { return a(this).button("widget")[0] }).removeClass("ui-corner-all ui-corner-left ui-corner-right").filter(":first").addClass(b ? "ui-corner-right" : "ui-corner-left").end().filter(":last").addClass(b ? "ui-corner-left" : "ui-corner-right").end().end() },
        _destroy: function () { this.element.removeClass("ui-buttonset"); this.buttons.map(function () { return a(this).button("widget")[0] }).removeClass("ui-corner-left ui-corner-right").end().button("destroy") }
    })
})(jQuery);
(function (a, l) {
    function e() {
        this._curInst = null; this._keyEvent = !1; this._disabledInputs = []; this._inDialog = this._datepickerShowing = !1; this._mainDivId = "ui-datepicker-div"; this._inlineClass = "ui-datepicker-inline"; this._appendClass = "ui-datepicker-append"; this._triggerClass = "ui-datepicker-trigger"; this._dialogClass = "ui-datepicker-dialog"; this._disableClass = "ui-datepicker-disabled"; this._unselectableClass = "ui-datepicker-unselectable"; this._currentClass = "ui-datepicker-current-day"; this._dayOverClass = "ui-datepicker-days-cell-over";
        this.regional = []; this.regional[""] = {
            closeText: "Done", prevText: "Prev", nextText: "Next", currentText: "Today", monthNames: "January February March April May June July August September October November December".split(" "), monthNamesShort: "Jan Feb Mar Apr May Jun Jul Aug Sep Oct Nov Dec".split(" "), dayNames: "Sunday Monday Tuesday Wednesday Thursday Friday Saturday".split(" "), dayNamesShort: "Sun Mon Tue Wed Thu Fri Sat".split(" "), dayNamesMin: "Su Mo Tu We Th Fr Sa".split(" "), weekHeader: "Wk", dateFormat: "mm/dd/yy",
            firstDay: 0, isRTL: !1, showMonthAfterYear: !1, yearSuffix: ""
        }; this._defaults = {
            showOn: "focus", showAnim: "fadeIn", showOptions: {}, defaultDate: null, appendText: "", buttonText: "...", buttonImage: "", buttonImageOnly: !1, hideIfNoPrevNext: !1, navigationAsDateFormat: !1, gotoCurrent: !1, changeMonth: !1, changeYear: !1, yearRange: "c-10:c+10", showOtherMonths: !1, selectOtherMonths: !1, showWeek: !1, calculateWeek: this.iso8601Week, shortYearCutoff: "+10", minDate: null, maxDate: null, duration: "fast", beforeShowDay: null, beforeShow: null, onSelect: null,
            onChangeMonthYear: null, onClose: null, numberOfMonths: 1, showCurrentAtPos: 0, stepMonths: 1, stepBigMonths: 12, altField: "", altFormat: "", constrainInput: !0, showButtonPanel: !1, autoSize: !1, disabled: !1
        }; a.extend(this._defaults, this.regional[""]); this.dpDiv = h(a("\x3cdiv id\x3d'" + this._mainDivId + "' class\x3d'ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'\x3e\x3c/div\x3e"))
    } function h(b) {
        return b.delegate("button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a",
            "mouseout", function () { a(this).removeClass("ui-state-hover"); -1 !== this.className.indexOf("ui-datepicker-prev") && a(this).removeClass("ui-datepicker-prev-hover"); -1 !== this.className.indexOf("ui-datepicker-next") && a(this).removeClass("ui-datepicker-next-hover") }).delegate("button, .ui-datepicker-prev, .ui-datepicker-next, .ui-datepicker-calendar td a", "mouseover", function () {
                a.datepicker._isDisabledDatepicker(d.inline ? b.parent()[0] : d.input[0]) || (a(this).parents(".ui-datepicker-calendar").find("a").removeClass("ui-state-hover"),
                    a(this).addClass("ui-state-hover"), -1 !== this.className.indexOf("ui-datepicker-prev") && a(this).addClass("ui-datepicker-prev-hover"), -1 !== this.className.indexOf("ui-datepicker-next") && a(this).addClass("ui-datepicker-next-hover"))
            })
    } function c(b, c) { a.extend(b, c); for (var d in c) null == c[d] && (b[d] = c[d]); return b } a.extend(a.ui, { datepicker: { version: "1.10.3" } }); var d; a.extend(e.prototype, {
        markerClassName: "hasDatepicker", maxRows: 4, _widgetDatepicker: function () { return this.dpDiv }, setDefaults: function (a) {
            c(this._defaults,
                a || {}); return this
        }, _attachDatepicker: function (b, c) { var d, k, e; d = b.nodeName.toLowerCase(); k = "div" === d || "span" === d; b.id || (this.uuid += 1, b.id = "dp" + this.uuid); e = this._newInst(a(b), k); e.settings = a.extend({}, c || {}); "input" === d ? this._connectDatepicker(b, e) : k && this._inlineDatepicker(b, e) }, _newInst: function (b, c) {
            return {
                id: b[0].id.replace(/([^A-Za-z0-9_\-])/g, "\\\\$1"), input: b, selectedDay: 0, selectedMonth: 0, selectedYear: 0, drawMonth: 0, drawYear: 0, inline: c, dpDiv: c ? h(a("\x3cdiv class\x3d'" + this._inlineClass + " ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all'\x3e\x3c/div\x3e")) :
                    this.dpDiv
            }
        }, _connectDatepicker: function (b, c) { var d = a(b); c.append = a([]); c.trigger = a([]); d.hasClass(this.markerClassName) || (this._attachments(d, c), d.addClass(this.markerClassName).keydown(this._doKeyDown).keypress(this._doKeyPress).keyup(this._doKeyUp), this._autoSize(c), a.data(b, "datepicker", c), c.settings.disabled && this._disableDatepicker(b)) }, _attachments: function (b, c) {
            var d, k; d = this._get(c, "appendText"); var e = this._get(c, "isRTL"); c.append && c.append.remove(); d && (c.append = a("\x3cspan class\x3d'" + this._appendClass +
                "'\x3e" + d + "\x3c/span\x3e"), b[e ? "before" : "after"](c.append)); b.unbind("focus", this._showDatepicker); c.trigger && c.trigger.remove(); d = this._get(c, "showOn"); "focus" !== d && "both" !== d || b.focus(this._showDatepicker); if ("button" === d || "both" === d) d = this._get(c, "buttonText"), k = this._get(c, "buttonImage"), c.trigger = a(this._get(c, "buttonImageOnly") ? a("\x3cimg/\x3e").addClass(this._triggerClass).attr({ src: k, alt: d, title: d }) : a("\x3cbutton type\x3d'button'\x3e\x3c/button\x3e").addClass(this._triggerClass).html(k ? a("\x3cimg/\x3e").attr({
                    src: k,
                    alt: d, title: d
                }) : d)), b[e ? "before" : "after"](c.trigger), c.trigger.click(function () { a.datepicker._datepickerShowing && a.datepicker._lastInput === b[0] ? a.datepicker._hideDatepicker() : (a.datepicker._datepickerShowing && a.datepicker._lastInput !== b[0] && a.datepicker._hideDatepicker(), a.datepicker._showDatepicker(b[0])); return !1 })
        }, _autoSize: function (a) {
            if (this._get(a, "autoSize") && !a.inline) {
                var c, d, k, e, h = new Date(2009, 11, 20), l = this._get(a, "dateFormat"); l.match(/[DM]/) && (c = function (a) {
                    for (e = k = d = 0; e < a.length; e++)a[e].length >
                        d && (d = a[e].length, k = e); return k
                }, h.setMonth(c(this._get(a, l.match(/MM/) ? "monthNames" : "monthNamesShort"))), h.setDate(c(this._get(a, l.match(/DD/) ? "dayNames" : "dayNamesShort")) + 20 - h.getDay())); a.input.attr("size", this._formatDate(a, h).length)
            }
        }, _inlineDatepicker: function (b, c) {
            var d = a(b); d.hasClass(this.markerClassName) || (d.addClass(this.markerClassName).append(c.dpDiv), a.data(b, "datepicker", c), this._setDate(c, this._getDefaultDate(c), !0), this._updateDatepicker(c), this._updateAlternate(c), c.settings.disabled &&
                this._disableDatepicker(b), c.dpDiv.css("display", "block"))
        }, _dialogDatepicker: function (b, f, d, k, e) {
            var h; b = this._dialogInst; b || (this.uuid += 1, b = "dp" + this.uuid, this._dialogInput = a("\x3cinput type\x3d'text' id\x3d'" + b + "' style\x3d'position: absolute; top: -100px; width: 0px;'/\x3e"), this._dialogInput.keydown(this._doKeyDown), a("body").append(this._dialogInput), b = this._dialogInst = this._newInst(this._dialogInput, !1), b.settings = {}, a.data(this._dialogInput[0], "datepicker", b)); c(b.settings, k || {}); f = f && f.constructor ===
                Date ? this._formatDate(b, f) : f; this._dialogInput.val(f); this._pos = e ? e.length ? e : [e.pageX, e.pageY] : null; this._pos || (f = document.documentElement.clientWidth, k = document.documentElement.clientHeight, e = document.documentElement.scrollLeft || document.body.scrollLeft, h = document.documentElement.scrollTop || document.body.scrollTop, this._pos = [f / 2 - 100 + e, k / 2 - 150 + h]); this._dialogInput.css("left", this._pos[0] + 20 + "px").css("top", this._pos[1] + "px"); b.settings.onSelect = d; this._inDialog = !0; this.dpDiv.addClass(this._dialogClass);
            this._showDatepicker(this._dialogInput[0]); a.blockUI && a.blockUI(this.dpDiv); a.data(this._dialogInput[0], "datepicker", b); return this
        }, _destroyDatepicker: function (b) {
            var c, d = a(b), k = a.data(b, "datepicker"); d.hasClass(this.markerClassName) && (c = b.nodeName.toLowerCase(), a.removeData(b, "datepicker"), "input" === c ? (k.append.remove(), k.trigger.remove(), d.removeClass(this.markerClassName).unbind("focus", this._showDatepicker).unbind("keydown", this._doKeyDown).unbind("keypress", this._doKeyPress).unbind("keyup",
                this._doKeyUp)) : "div" !== c && "span" !== c || d.removeClass(this.markerClassName).empty())
        }, _enableDatepicker: function (b) {
            var c, d = a(b), k = a.data(b, "datepicker"); if (d.hasClass(this.markerClassName)) {
                c = b.nodeName.toLowerCase(); if ("input" === c) b.disabled = !1, k.trigger.filter("button").each(function () { this.disabled = !1 }).end().filter("img").css({ opacity: "1.0", cursor: "" }); else if ("div" === c || "span" === c) c = d.children("." + this._inlineClass), c.children().removeClass("ui-state-disabled"), c.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",
                    !1); this._disabledInputs = a.map(this._disabledInputs, function (a) { return a === b ? null : a })
            }
        }, _disableDatepicker: function (b) {
            var c, d = a(b), k = a.data(b, "datepicker"); if (d.hasClass(this.markerClassName)) {
                c = b.nodeName.toLowerCase(); if ("input" === c) b.disabled = !0, k.trigger.filter("button").each(function () { this.disabled = !0 }).end().filter("img").css({ opacity: "0.5", cursor: "default" }); else if ("div" === c || "span" === c) c = d.children("." + this._inlineClass), c.children().addClass("ui-state-disabled"), c.find("select.ui-datepicker-month, select.ui-datepicker-year").prop("disabled",
                    !0); this._disabledInputs = a.map(this._disabledInputs, function (a) { return a === b ? null : a }); this._disabledInputs[this._disabledInputs.length] = b
            }
        }, _isDisabledDatepicker: function (a) { if (!a) return !1; for (var c = 0; c < this._disabledInputs.length; c++)if (this._disabledInputs[c] === a) return !0; return !1 }, _getInst: function (b) { try { return a.data(b, "datepicker") } catch (c) { throw "Missing instance data for this datepicker"; } }, _optionDatepicker: function (b, f, d) {
            var k, e, h, t, s = this._getInst(b); if (2 === arguments.length && "string" ===
                typeof f) return "defaults" === f ? a.extend({}, a.datepicker._defaults) : s ? "all" === f ? a.extend({}, s.settings) : this._get(s, f) : null; k = f || {}; "string" === typeof f && (k = {}, k[f] = d); s && (this._curInst === s && this._hideDatepicker(), e = this._getDateDatepicker(b, !0), h = this._getMinMaxDate(s, "min"), t = this._getMinMaxDate(s, "max"), c(s.settings, k), null !== h && k.dateFormat !== l && k.minDate === l && (s.settings.minDate = this._formatDate(s, h)), null !== t && k.dateFormat !== l && k.maxDate === l && (s.settings.maxDate = this._formatDate(s, t)), "disabled" in
                    k && (k.disabled ? this._disableDatepicker(b) : this._enableDatepicker(b)), this._attachments(a(b), s), this._autoSize(s), this._setDate(s, e), this._updateAlternate(s), this._updateDatepicker(s))
        }, _changeDatepicker: function (a, c, d) { this._optionDatepicker(a, c, d) }, _refreshDatepicker: function (a) { (a = this._getInst(a)) && this._updateDatepicker(a) }, _setDateDatepicker: function (a, c) { var d = this._getInst(a); d && (this._setDate(d, c), this._updateDatepicker(d), this._updateAlternate(d)) }, _getDateDatepicker: function (a, c) {
            var d =
                this._getInst(a); d && !d.inline && this._setDateFromField(d, c); return d ? this._getDate(d) : null
        }, _doKeyDown: function (b) {
            var c, d = a.datepicker._getInst(b.target); c = !0; var k = d.dpDiv.is(".ui-datepicker-rtl"); d._keyEvent = !0; if (a.datepicker._datepickerShowing) switch (b.keyCode) {
                case 9: a.datepicker._hideDatepicker(); c = !1; break; case 13: return c = a("td." + a.datepicker._dayOverClass + ":not(." + a.datepicker._currentClass + ")", d.dpDiv), c[0] && a.datepicker._selectDay(b.target, d.selectedMonth, d.selectedYear, c[0]), (b = a.datepicker._get(d,
                    "onSelect")) ? (c = a.datepicker._formatDate(d), b.apply(d.input ? d.input[0] : null, [c, d])) : a.datepicker._hideDatepicker(), !1; case 27: a.datepicker._hideDatepicker(); break; case 33: a.datepicker._adjustDate(b.target, b.ctrlKey ? -a.datepicker._get(d, "stepBigMonths") : -a.datepicker._get(d, "stepMonths"), "M"); break; case 34: a.datepicker._adjustDate(b.target, b.ctrlKey ? +a.datepicker._get(d, "stepBigMonths") : +a.datepicker._get(d, "stepMonths"), "M"); break; case 35: (b.ctrlKey || b.metaKey) && a.datepicker._clearDate(b.target);
                    c = b.ctrlKey || b.metaKey; break; case 36: (b.ctrlKey || b.metaKey) && a.datepicker._gotoToday(b.target); c = b.ctrlKey || b.metaKey; break; case 37: (b.ctrlKey || b.metaKey) && a.datepicker._adjustDate(b.target, k ? 1 : -1, "D"); c = b.ctrlKey || b.metaKey; b.originalEvent.altKey && a.datepicker._adjustDate(b.target, b.ctrlKey ? -a.datepicker._get(d, "stepBigMonths") : -a.datepicker._get(d, "stepMonths"), "M"); break; case 38: (b.ctrlKey || b.metaKey) && a.datepicker._adjustDate(b.target, -7, "D"); c = b.ctrlKey || b.metaKey; break; case 39: (b.ctrlKey || b.metaKey) &&
                        a.datepicker._adjustDate(b.target, k ? -1 : 1, "D"); c = b.ctrlKey || b.metaKey; b.originalEvent.altKey && a.datepicker._adjustDate(b.target, b.ctrlKey ? +a.datepicker._get(d, "stepBigMonths") : +a.datepicker._get(d, "stepMonths"), "M"); break; case 40: (b.ctrlKey || b.metaKey) && a.datepicker._adjustDate(b.target, 7, "D"); c = b.ctrlKey || b.metaKey; break; default: c = !1
            } else 36 === b.keyCode && b.ctrlKey ? a.datepicker._showDatepicker(this) : c = !1; c && (b.preventDefault(), b.stopPropagation())
        }, _doKeyPress: function (b) {
            var c, d; c = a.datepicker._getInst(b.target);
            if (a.datepicker._get(c, "constrainInput")) return c = a.datepicker._possibleChars(a.datepicker._get(c, "dateFormat")), d = String.fromCharCode(null == b.charCode ? b.keyCode : b.charCode), b.ctrlKey || b.metaKey || " " > d || !c || -1 < c.indexOf(d)
        }, _doKeyUp: function (b) {
            var c; b = a.datepicker._getInst(b.target); if (b.input.val() !== b.lastVal) try {
                if (c = a.datepicker.parseDate(a.datepicker._get(b, "dateFormat"), b.input ? b.input.val() : null, a.datepicker._getFormatConfig(b))) a.datepicker._setDateFromField(b), a.datepicker._updateAlternate(b),
                    a.datepicker._updateDatepicker(b)
            } catch (d) { } return !0
        }, _showDatepicker: function (b) {
            b = b.target || b; "input" !== b.nodeName.toLowerCase() && (b = a("input", b.parentNode)[0]); if (!a.datepicker._isDisabledDatepicker(b) && a.datepicker._lastInput !== b) {
                var f, d, k, e; f = a.datepicker._getInst(b); a.datepicker._curInst && a.datepicker._curInst !== f && (a.datepicker._curInst.dpDiv.stop(!0, !0), f && a.datepicker._datepickerShowing && a.datepicker._hideDatepicker(a.datepicker._curInst.input[0])); d = (d = a.datepicker._get(f, "beforeShow")) ?
                    d.apply(b, [b, f]) : {}; if (!1 !== d && (c(f.settings, d), f.lastVal = null, a.datepicker._lastInput = b, a.datepicker._setDateFromField(f), a.datepicker._inDialog && (b.value = ""), a.datepicker._pos || (a.datepicker._pos = a.datepicker._findPos(b), a.datepicker._pos[1] += b.offsetHeight), k = !1, a(b).parents().each(function () { k |= "fixed" === a(this).css("position"); return !k }), d = { left: a.datepicker._pos[0], top: a.datepicker._pos[1] }, a.datepicker._pos = null, f.dpDiv.empty(), f.dpDiv.css({ position: "absolute", display: "block", top: "-1000px" }),
                        a.datepicker._updateDatepicker(f), d = a.datepicker._checkOffset(f, d, k), f.dpDiv.css({ position: a.datepicker._inDialog && a.blockUI ? "static" : k ? "fixed" : "absolute", display: "none", left: d.left + "px", top: d.top + "px" }), !f.inline)) {
                            d = a.datepicker._get(f, "showAnim"); e = a.datepicker._get(f, "duration"); f.dpDiv.zIndex(a(b).zIndex() + 1); a.datepicker._datepickerShowing = !0; if (a.effects && a.effects.effect[d]) f.dpDiv.show(d, a.datepicker._get(f, "showOptions"), e); else f.dpDiv[d || "show"](d ? e : null); a.datepicker._shouldFocusInput(f) &&
                                f.input.focus(); a.datepicker._curInst = f
                }
            }
        }, _updateDatepicker: function (b) {
            this.maxRows = 4; d = b; b.dpDiv.empty().append(this._generateHTML(b)); this._attachHandlers(b); b.dpDiv.find("." + this._dayOverClass + " a").mouseover(); var c, e = this._getNumberOfMonths(b), k = e[1]; b.dpDiv.removeClass("ui-datepicker-multi-2 ui-datepicker-multi-3 ui-datepicker-multi-4").width(""); 1 < k && b.dpDiv.addClass("ui-datepicker-multi-" + k).css("width", 17 * k + "em"); b.dpDiv[(1 !== e[0] || 1 !== e[1] ? "add" : "remove") + "Class"]("ui-datepicker-multi");
            b.dpDiv[(this._get(b, "isRTL") ? "add" : "remove") + "Class"]("ui-datepicker-rtl"); b === a.datepicker._curInst && a.datepicker._datepickerShowing && a.datepicker._shouldFocusInput(b) && b.input.focus(); b.yearshtml && (c = b.yearshtml, setTimeout(function () { c === b.yearshtml && b.yearshtml && b.dpDiv.find("select.ui-datepicker-year:first").replaceWith(b.yearshtml); c = b.yearshtml = null }, 0))
        }, _shouldFocusInput: function (a) { return a.input && a.input.is(":visible") && !a.input.is(":disabled") && !a.input.is(":focus") }, _checkOffset: function (b,
            c, d) {
                var e = b.dpDiv.outerWidth(), h = b.dpDiv.outerHeight(), l = b.input ? b.input.outerWidth() : 0, t = b.input ? b.input.outerHeight() : 0, s = document.documentElement.clientWidth + (d ? 0 : a(document).scrollLeft()), v = document.documentElement.clientHeight + (d ? 0 : a(document).scrollTop()); c.left -= this._get(b, "isRTL") ? e - l : 0; c.left -= d && c.left === b.input.offset().left ? a(document).scrollLeft() : 0; c.top -= d && c.top === b.input.offset().top + t ? a(document).scrollTop() : 0; c.left -= Math.min(c.left, c.left + e > s && s > e ? Math.abs(c.left + e - s) : 0); c.top -=
                    Math.min(c.top, c.top + h > v && v > h ? Math.abs(h + t) : 0); return c
        }, _findPos: function (b) { for (var c = this._getInst(b), c = this._get(c, "isRTL"); b && ("hidden" === b.type || 1 !== b.nodeType || a.expr.filters.hidden(b));)b = b[c ? "previousSibling" : "nextSibling"]; b = a(b).offset(); return [b.left, b.top] }, _hideDatepicker: function (b) {
            var c, d, e = this._curInst; if (e && (!b || e === a.data(b, "datepicker")) && this._datepickerShowing) {
                b = this._get(e, "showAnim"); c = this._get(e, "duration"); d = function () { a.datepicker._tidyDialog(e) }; if (a.effects && (a.effects.effect[b] ||
                    a.effects[b])) e.dpDiv.hide(b, a.datepicker._get(e, "showOptions"), c, d); else e.dpDiv["slideDown" === b ? "slideUp" : "fadeIn" === b ? "fadeOut" : "hide"](b ? c : null, d); b || d(); this._datepickerShowing = !1; (b = this._get(e, "onClose")) && b.apply(e.input ? e.input[0] : null, [e.input ? e.input.val() : "", e]); this._lastInput = null; this._inDialog && (this._dialogInput.css({ position: "absolute", left: "0", top: "-100px" }), a.blockUI && (a.unblockUI(), a("body").append(this.dpDiv))); this._inDialog = !1
            }
        }, _tidyDialog: function (a) { a.dpDiv.removeClass(this._dialogClass).unbind(".ui-datepicker-calendar") },
        _checkExternalClick: function (b) { if (a.datepicker._curInst) { b = a(b.target); var c = a.datepicker._getInst(b[0]); (b[0].id !== a.datepicker._mainDivId && 0 === b.parents("#" + a.datepicker._mainDivId).length && !(b.hasClass(a.datepicker.markerClassName) || b.closest("." + a.datepicker._triggerClass).length || !a.datepicker._datepickerShowing || a.datepicker._inDialog && a.blockUI) || b.hasClass(a.datepicker.markerClassName) && a.datepicker._curInst !== c) && a.datepicker._hideDatepicker() } }, _adjustDate: function (b, c, d) {
            b = a(b); var e =
                this._getInst(b[0]); this._isDisabledDatepicker(b[0]) || (this._adjustInstDate(e, c + ("M" === d ? this._get(e, "showCurrentAtPos") : 0), d), this._updateDatepicker(e))
        }, _gotoToday: function (b) {
            var c = a(b), d = this._getInst(c[0]); this._get(d, "gotoCurrent") && d.currentDay ? (d.selectedDay = d.currentDay, d.drawMonth = d.selectedMonth = d.currentMonth, d.drawYear = d.selectedYear = d.currentYear) : (b = new Date, d.selectedDay = b.getDate(), d.drawMonth = d.selectedMonth = b.getMonth(), d.drawYear = d.selectedYear = b.getFullYear()); this._notifyChange(d);
            this._adjustDate(c)
        }, _selectMonthYear: function (b, c, d) { b = a(b); var e = this._getInst(b[0]); e["selected" + ("M" === d ? "Month" : "Year")] = e["draw" + ("M" === d ? "Month" : "Year")] = parseInt(c.options[c.selectedIndex].value, 10); this._notifyChange(e); this._adjustDate(b) }, _selectDay: function (b, c, d, e) {
            var h; h = a(b); a(e).hasClass(this._unselectableClass) || this._isDisabledDatepicker(h[0]) || (h = this._getInst(h[0]), h.selectedDay = h.currentDay = a("a", e).html(), h.selectedMonth = h.currentMonth = c, h.selectedYear = h.currentYear = d, this._selectDate(b,
                this._formatDate(h, h.currentDay, h.currentMonth, h.currentYear)))
        }, _clearDate: function (b) { b = a(b); this._selectDate(b, "") }, _selectDate: function (b, c) {
            var d; d = a(b); var e = this._getInst(d[0]); c = null != c ? c : this._formatDate(e); e.input && e.input.val(c); this._updateAlternate(e); (d = this._get(e, "onSelect")) ? d.apply(e.input ? e.input[0] : null, [c, e]) : e.input && e.input.trigger("change"); e.inline ? this._updateDatepicker(e) : (this._hideDatepicker(), this._lastInput = e.input[0], "object" !== typeof e.input[0] && e.input.focus(), this._lastInput =
                null)
        }, _updateAlternate: function (b) { var c, d, e, h = this._get(b, "altField"); h && (c = this._get(b, "altFormat") || this._get(b, "dateFormat"), d = this._getDate(b), e = this.formatDate(c, d, this._getFormatConfig(b)), a(h).each(function () { a(this).val(e) })) }, noWeekends: function (a) { a = a.getDay(); return [0 < a && 6 > a, ""] }, iso8601Week: function (a) { var c = new Date(a.getTime()); c.setDate(c.getDate() + 4 - (c.getDay() || 7)); a = c.getTime(); c.setMonth(0); c.setDate(1); return Math.floor(Math.round((a - c) / 864E5) / 7) + 1 }, parseDate: function (b, c, d) {
            if (null ==
                b || null == c) throw "Invalid arguments"; c = "object" === typeof c ? c.toString() : c + ""; if ("" === c) return null; var e, h, l, t = 0; h = (d ? d.shortYearCutoff : null) || this._defaults.shortYearCutoff; h = "string" !== typeof h ? h : (new Date).getFullYear() % 100 + parseInt(h, 10); l = (d ? d.dayNamesShort : null) || this._defaults.dayNamesShort; var s = (d ? d.dayNames : null) || this._defaults.dayNames, v = (d ? d.monthNamesShort : null) || this._defaults.monthNamesShort, y = (d ? d.monthNames : null) || this._defaults.monthNames, g = d = -1, u = -1, q = -1, w = !1, x, D = function (a) {
                    (a =
                        e + 1 < b.length && b.charAt(e + 1) === a) && e++; return a
                }, A = function (a) { var b = D(a); a = RegExp("^\\d{1," + ("@" === a ? 14 : "!" === a ? 20 : "y" === a && b ? 4 : "o" === a ? 3 : 2) + "}"); a = c.substring(t).match(a); if (!a) throw "Missing number at position " + t; t += a[0].length; return parseInt(a[0], 10) }, I = function (b, g, d) {
                    var e = -1; b = a.map(D(b) ? d : g, function (a, b) { return [[b, a]] }).sort(function (a, b) { return -(a[1].length - b[1].length) }); a.each(b, function (a, b) { var g = b[1]; if (c.substr(t, g.length).toLowerCase() === g.toLowerCase()) return e = b[0], t += g.length, !1 });
                    if (-1 !== e) return e + 1; throw "Unknown name at position " + t;
                }, E = function () { if (c.charAt(t) !== b.charAt(e)) throw "Unexpected literal at position " + t; t++ }; for (e = 0; e < b.length; e++)if (w) "'" !== b.charAt(e) || D("'") ? E() : w = !1; else switch (b.charAt(e)) {
                    case "d": u = A("d"); break; case "D": I("D", l, s); break; case "o": q = A("o"); break; case "m": g = A("m"); break; case "M": g = I("M", v, y); break; case "y": d = A("y"); break; case "@": x = new Date(A("@")); d = x.getFullYear(); g = x.getMonth() + 1; u = x.getDate(); break; case "!": x = new Date((A("!") - this._ticksTo1970) /
                        1E4); d = x.getFullYear(); g = x.getMonth() + 1; u = x.getDate(); break; case "'": D("'") ? E() : w = !0; break; default: E()
                }if (t < c.length && (l = c.substr(t), !/^\s+/.test(l))) throw "Extra/unparsed characters found in date: " + l; -1 === d ? d = (new Date).getFullYear() : 100 > d && (d += (new Date).getFullYear() - (new Date).getFullYear() % 100 + (d <= h ? 0 : -100)); if (-1 < q) { g = 1; u = q; do { h = this._getDaysInMonth(d, g - 1); if (u <= h) break; g++; u -= h } while (1) } x = this._daylightSavingAdjust(new Date(d, g - 1, u)); if (x.getFullYear() !== d || x.getMonth() + 1 !== g || x.getDate() !==
                    u) throw "Invalid date"; return x
        }, ATOM: "yy-mm-dd", COOKIE: "D, dd M yy", ISO_8601: "yy-mm-dd", RFC_822: "D, d M y", RFC_850: "DD, dd-M-y", RFC_1036: "D, d M y", RFC_1123: "D, d M yy", RFC_2822: "D, d M yy", RSS: "D, d M y", TICKS: "!", TIMESTAMP: "@", W3C: "yy-mm-dd", _ticksTo1970: 864E9 * (718685 + Math.floor(492.5) - Math.floor(19.7) + Math.floor(4.925)), formatDate: function (a, c, d) {
            if (!c) return ""; var e, h = (d ? d.dayNamesShort : null) || this._defaults.dayNamesShort, l = (d ? d.dayNames : null) || this._defaults.dayNames, t = (d ? d.monthNamesShort : null) ||
                this._defaults.monthNamesShort; d = (d ? d.monthNames : null) || this._defaults.monthNames; var s = function (c) { (c = e + 1 < a.length && a.charAt(e + 1) === c) && e++; return c }, v = function (a, b, c) { b = "" + b; if (s(a)) for (; b.length < c;)b = "0" + b; return b }, y = function (a, b, c, g) { return s(a) ? g[b] : c[b] }, g = "", u = !1; if (c) for (e = 0; e < a.length; e++)if (u) "'" !== a.charAt(e) || s("'") ? g += a.charAt(e) : u = !1; else switch (a.charAt(e)) {
                    case "d": g += v("d", c.getDate(), 2); break; case "D": g += y("D", c.getDay(), h, l); break; case "o": g += v("o", Math.round(((new Date(c.getFullYear(),
                        c.getMonth(), c.getDate())).getTime() - (new Date(c.getFullYear(), 0, 0)).getTime()) / 864E5), 3); break; case "m": g += v("m", c.getMonth() + 1, 2); break; case "M": g += y("M", c.getMonth(), t, d); break; case "y": g += s("y") ? c.getFullYear() : (10 > c.getYear() % 100 ? "0" : "") + c.getYear() % 100; break; case "@": g += c.getTime(); break; case "!": g += 1E4 * c.getTime() + this._ticksTo1970; break; case "'": s("'") ? g += "'" : u = !0; break; default: g += a.charAt(e)
                }return g
        }, _possibleChars: function (a) {
            var c, d = "", e = !1, h = function (d) {
                (d = c + 1 < a.length && a.charAt(c + 1) ===
                    d) && c++; return d
            }; for (c = 0; c < a.length; c++)if (e) "'" !== a.charAt(c) || h("'") ? d += a.charAt(c) : e = !1; else switch (a.charAt(c)) { case "d": case "m": case "y": case "@": d += "0123456789"; break; case "D": case "M": return null; case "'": h("'") ? d += "'" : e = !0; break; default: d += a.charAt(c) }return d
        }, _get: function (a, c) { return a.settings[c] !== l ? a.settings[c] : this._defaults[c] }, _setDateFromField: function (a, c) {
            if (a.input.val() !== a.lastVal) {
                var d = this._get(a, "dateFormat"), e = a.lastVal = a.input ? a.input.val() : null, h = this._getDefaultDate(a),
                l = h, t = this._getFormatConfig(a); try { l = this.parseDate(d, e, t) || h } catch (s) { e = c ? "" : e } a.selectedDay = l.getDate(); a.drawMonth = a.selectedMonth = l.getMonth(); a.drawYear = a.selectedYear = l.getFullYear(); a.currentDay = e ? l.getDate() : 0; a.currentMonth = e ? l.getMonth() : 0; a.currentYear = e ? l.getFullYear() : 0; this._adjustInstDate(a)
            }
        }, _getDefaultDate: function (a) { return this._restrictMinMax(a, this._determineDate(a, this._get(a, "defaultDate"), new Date)) }, _determineDate: function (b, c, d) {
            var e = function (a) {
                var b = new Date; b.setDate(b.getDate() +
                    a); return b
            }, h = function (c) {
                try { return a.datepicker.parseDate(a.datepicker._get(b, "dateFormat"), c, a.datepicker._getFormatConfig(b)) } catch (d) { } for (var f = (c.toLowerCase().match(/^c/) ? a.datepicker._getDate(b) : null) || new Date, e = f.getFullYear(), k = f.getMonth(), f = f.getDate(), g = /([+\-]?[0-9]+)\s*(d|D|w|W|m|M|y|Y)?/g, m = g.exec(c); m;) {
                    switch (m[2] || "d") {
                        case "d": case "D": f += parseInt(m[1], 10); break; case "w": case "W": f += 7 * parseInt(m[1], 10); break; case "m": case "M": k += parseInt(m[1], 10); f = Math.min(f, a.datepicker._getDaysInMonth(e,
                            k)); break; case "y": case "Y": e += parseInt(m[1], 10), f = Math.min(f, a.datepicker._getDaysInMonth(e, k))
                    }m = g.exec(c)
                } return new Date(e, k, f)
            }; if (c = (c = null == c || "" === c ? d : "string" === typeof c ? h(c) : "number" === typeof c ? isNaN(c) ? d : e(c) : new Date(c.getTime())) && "Invalid Date" === c.toString() ? d : c) c.setHours(0), c.setMinutes(0), c.setSeconds(0), c.setMilliseconds(0); return this._daylightSavingAdjust(c)
        }, _daylightSavingAdjust: function (a) { if (!a) return null; a.setHours(12 < a.getHours() ? a.getHours() + 2 : 0); return a }, _setDate: function (a,
            c, d) { var e = !c, h = a.selectedMonth, l = a.selectedYear; c = this._restrictMinMax(a, this._determineDate(a, c, new Date)); a.selectedDay = a.currentDay = c.getDate(); a.drawMonth = a.selectedMonth = a.currentMonth = c.getMonth(); a.drawYear = a.selectedYear = a.currentYear = c.getFullYear(); h === a.selectedMonth && l === a.selectedYear || d || this._notifyChange(a); this._adjustInstDate(a); a.input && a.input.val(e ? "" : this._formatDate(a)) }, _getDate: function (a) {
                return !a.currentYear || a.input && "" === a.input.val() ? null : this._daylightSavingAdjust(new Date(a.currentYear,
                    a.currentMonth, a.currentDay))
            }, _attachHandlers: function (b) {
                var c = this._get(b, "stepMonths"), d = "#" + b.id.replace(/\\\\/g, "\\"); b.dpDiv.find("[data-handler]").map(function () {
                    a(this).bind(this.getAttribute("data-event"), {
                        prev: function () { a.datepicker._adjustDate(d, -c, "M") }, next: function () { a.datepicker._adjustDate(d, +c, "M") }, hide: function () { a.datepicker._hideDatepicker() }, today: function () { a.datepicker._gotoToday(d) }, selectDay: function () {
                            a.datepicker._selectDay(d, +this.getAttribute("data-month"), +this.getAttribute("data-year"),
                                this); return !1
                        }, selectMonth: function () { a.datepicker._selectMonthYear(d, this, "M"); return !1 }, selectYear: function () { a.datepicker._selectMonthYear(d, this, "Y"); return !1 }
                    }[this.getAttribute("data-handler")])
                })
            }, _generateHTML: function (a) {
                var c, d, e, h, l, t, s, v, y, g, u, q, w, x, D, A, I, E, O, C, S, B, K, Y, F, T, U, H = new Date, H = this._daylightSavingAdjust(new Date(H.getFullYear(), H.getMonth(), H.getDate())), R = this._get(a, "isRTL"); t = this._get(a, "showButtonPanel"); e = this._get(a, "hideIfNoPrevNext"); l = this._get(a, "navigationAsDateFormat");
                var N = this._getNumberOfMonths(a), L = this._get(a, "showCurrentAtPos"); h = this._get(a, "stepMonths"); var ha = 1 !== N[0] || 1 !== N[1], ba = this._daylightSavingAdjust(a.currentDay ? new Date(a.currentYear, a.currentMonth, a.currentDay) : new Date(9999, 9, 9)), ca = this._getMinMaxDate(a, "min"), G = this._getMinMaxDate(a, "max"), L = a.drawMonth - L, M = a.drawYear; 0 > L && (L += 12, M--); if (G) for (c = this._daylightSavingAdjust(new Date(G.getFullYear(), G.getMonth() - N[0] * N[1] + 1, G.getDate())), c = ca && c < ca ? ca : c; this._daylightSavingAdjust(new Date(M,
                    L, 1)) > c;)L--, 0 > L && (L = 11, M--); a.drawMonth = L; a.drawYear = M; c = this._get(a, "prevText"); c = l ? this.formatDate(c, this._daylightSavingAdjust(new Date(M, L - h, 1)), this._getFormatConfig(a)) : c; c = this._canAdjustMonth(a, -1, M, L) ? "\x3ca class\x3d'ui-datepicker-prev ui-corner-all' data-handler\x3d'prev' data-event\x3d'click' title\x3d'" + c + "'\x3e\x3cspan class\x3d'ui-icon ui-icon-circle-triangle-" + (R ? "e" : "w") + "'\x3e" + c + "\x3c/span\x3e\x3c/a\x3e" : e ? "" : "\x3ca class\x3d'ui-datepicker-prev ui-corner-all ui-state-disabled' title\x3d'" +
                        c + "'\x3e\x3cspan class\x3d'ui-icon ui-icon-circle-triangle-" + (R ? "e" : "w") + "'\x3e" + c + "\x3c/span\x3e\x3c/a\x3e"; d = this._get(a, "nextText"); d = l ? this.formatDate(d, this._daylightSavingAdjust(new Date(M, L + h, 1)), this._getFormatConfig(a)) : d; e = this._canAdjustMonth(a, 1, M, L) ? "\x3ca class\x3d'ui-datepicker-next ui-corner-all' data-handler\x3d'next' data-event\x3d'click' title\x3d'" + d + "'\x3e\x3cspan class\x3d'ui-icon ui-icon-circle-triangle-" + (R ? "w" : "e") + "'\x3e" + d + "\x3c/span\x3e\x3c/a\x3e" : e ? "" : "\x3ca class\x3d'ui-datepicker-next ui-corner-all ui-state-disabled' title\x3d'" +
                            d + "'\x3e\x3cspan class\x3d'ui-icon ui-icon-circle-triangle-" + (R ? "w" : "e") + "'\x3e" + d + "\x3c/span\x3e\x3c/a\x3e"; h = this._get(a, "currentText"); d = this._get(a, "gotoCurrent") && a.currentDay ? ba : H; h = l ? this.formatDate(h, d, this._getFormatConfig(a)) : h; l = a.inline ? "" : "\x3cbutton type\x3d'button' class\x3d'ui-datepicker-close ui-state-default ui-priority-primary ui-corner-all' data-handler\x3d'hide' data-event\x3d'click'\x3e" + this._get(a, "closeText") + "\x3c/button\x3e"; t = t ? "\x3cdiv class\x3d'ui-datepicker-buttonpane ui-widget-content'\x3e" +
                                (R ? l : "") + (this._isInRange(a, d) ? "\x3cbutton type\x3d'button' class\x3d'ui-datepicker-current ui-state-default ui-priority-secondary ui-corner-all' data-handler\x3d'today' data-event\x3d'click'\x3e" + h + "\x3c/button\x3e" : "") + (R ? "" : l) + "\x3c/div\x3e" : ""; l = parseInt(this._get(a, "firstDay"), 10); l = isNaN(l) ? 0 : l; h = this._get(a, "showWeek"); d = this._get(a, "dayNames"); s = this._get(a, "dayNamesMin"); v = this._get(a, "monthNames"); y = this._get(a, "monthNamesShort"); g = this._get(a, "beforeShowDay"); u = this._get(a, "showOtherMonths");
                q = this._get(a, "selectOtherMonths"); w = this._getDefaultDate(a); x = ""; D; for (A = 0; A < N[0]; A++) {
                    I = ""; this.maxRows = 4; for (E = 0; E < N[1]; E++) {
                        O = this._daylightSavingAdjust(new Date(M, L, a.selectedDay)); D = " ui-corner-all"; C = ""; if (ha) { C += "\x3cdiv class\x3d'ui-datepicker-group"; if (1 < N[1]) switch (E) { case 0: C += " ui-datepicker-group-first"; D = " ui-corner-" + (R ? "right" : "left"); break; case N[1] - 1: C += " ui-datepicker-group-last"; D = " ui-corner-" + (R ? "left" : "right"); break; default: C += " ui-datepicker-group-middle", D = "" }C += "'\x3e" } C +=
                            "\x3cdiv class\x3d'ui-datepicker-header ui-widget-header ui-helper-clearfix" + D + "'\x3e" + (/all|left/.test(D) && 0 === A ? R ? e : c : "") + (/all|right/.test(D) && 0 === A ? R ? c : e : "") + this._generateMonthYearHeader(a, L, M, ca, G, 0 < A || 0 < E, v, y) + "\x3c/div\x3e\x3ctable class\x3d'ui-datepicker-calendar'\x3e\x3cthead\x3e\x3ctr\x3e"; S = h ? "\x3cth class\x3d'ui-datepicker-week-col'\x3e" + this._get(a, "weekHeader") + "\x3c/th\x3e" : ""; for (D = 0; 7 > D; D++)B = (D + l) % 7, S += "\x3cth" + (5 <= (D + l + 6) % 7 ? " class\x3d'ui-datepicker-week-end'" : "") + "\x3e\x3cspan title\x3d'" +
                                d[B] + "'\x3e" + s[B] + "\x3c/span\x3e\x3c/th\x3e"; C += S + "\x3c/tr\x3e\x3c/thead\x3e\x3ctbody\x3e"; S = this._getDaysInMonth(M, L); M === a.selectedYear && L === a.selectedMonth && (a.selectedDay = Math.min(a.selectedDay, S)); D = (this._getFirstDayOfMonth(M, L) - l + 7) % 7; S = Math.ceil((D + S) / 7); this.maxRows = S = ha ? this.maxRows > S ? this.maxRows : S : S; B = this._daylightSavingAdjust(new Date(M, L, 1 - D)); for (K = 0; K < S; K++) {
                                    C += "\x3ctr\x3e"; Y = h ? "\x3ctd class\x3d'ui-datepicker-week-col'\x3e" + this._get(a, "calculateWeek")(B) + "\x3c/td\x3e" : ""; for (D = 0; 7 >
                                        D; D++)F = g ? g.apply(a.input ? a.input[0] : null, [B]) : [!0, ""], U = (T = B.getMonth() !== L) && !q || !F[0] || ca && B < ca || G && B > G, Y += "\x3ctd class\x3d'" + (5 <= (D + l + 6) % 7 ? " ui-datepicker-week-end" : "") + (T ? " ui-datepicker-other-month" : "") + (B.getTime() === O.getTime() && L === a.selectedMonth && a._keyEvent || w.getTime() === B.getTime() && w.getTime() === O.getTime() ? " " + this._dayOverClass : "") + (U ? " " + this._unselectableClass + " ui-state-disabled" : "") + (T && !u ? "" : " " + F[1] + (B.getTime() === ba.getTime() ? " " + this._currentClass : "") + (B.getTime() === H.getTime() ?
                                            " ui-datepicker-today" : "")) + "'" + (T && !u || !F[2] ? "" : " title\x3d'" + F[2].replace(/'/g, "\x26#39;") + "'") + (U ? "" : " data-handler\x3d'selectDay' data-event\x3d'click' data-month\x3d'" + B.getMonth() + "' data-year\x3d'" + B.getFullYear() + "'") + "\x3e" + (T && !u ? "\x26#xa0;" : U ? "\x3cspan class\x3d'ui-state-default'\x3e" + B.getDate() + "\x3c/span\x3e" : "\x3ca class\x3d'ui-state-default" + (B.getTime() === H.getTime() ? " ui-state-highlight" : "") + (B.getTime() === ba.getTime() ? " ui-state-active" : "") + (T ? " ui-priority-secondary" : "") + "' href\x3d'#'\x3e" +
                                                B.getDate() + "\x3c/a\x3e") + "\x3c/td\x3e", B.setDate(B.getDate() + 1), B = this._daylightSavingAdjust(B); C += Y + "\x3c/tr\x3e"
                                } L++; 11 < L && (L = 0, M++); C += "\x3c/tbody\x3e\x3c/table\x3e" + (ha ? "\x3c/div\x3e" + (0 < N[0] && E === N[1] - 1 ? "\x3cdiv class\x3d'ui-datepicker-row-break'\x3e\x3c/div\x3e" : "") : ""); I += C
                    } x += I
                } a._keyEvent = !1; return x + t
            }, _generateMonthYearHeader: function (a, c, d, e, h, l, t, s) {
                var v, y, g, u = this._get(a, "changeMonth"), q = this._get(a, "changeYear"), w = this._get(a, "showMonthAfterYear"), x = "\x3cdiv class\x3d'ui-datepicker-title'\x3e",
                D = ""; if (l || !u) D += "\x3cspan class\x3d'ui-datepicker-month'\x3e" + t[c] + "\x3c/span\x3e"; else { t = e && e.getFullYear() === d; v = h && h.getFullYear() === d; D += "\x3cselect class\x3d'ui-datepicker-month' data-handler\x3d'selectMonth' data-event\x3d'change'\x3e"; for (y = 0; 12 > y; y++)(!t || y >= e.getMonth()) && (!v || y <= h.getMonth()) && (D += "\x3coption value\x3d'" + y + "'" + (y === c ? " selected\x3d'selected'" : "") + "\x3e" + s[y] + "\x3c/option\x3e"); D += "\x3c/select\x3e" } w || (x += D + (!l && u && q ? "" : "\x26#xa0;")); if (!a.yearshtml) if (a.yearshtml = "", l ||
                    !q) x += "\x3cspan class\x3d'ui-datepicker-year'\x3e" + d + "\x3c/span\x3e"; else {
                        s = this._get(a, "yearRange").split(":"); g = (new Date).getFullYear(); t = function (a) { a = a.match(/c[+\-].*/) ? d + parseInt(a.substring(1), 10) : a.match(/[+\-].*/) ? g + parseInt(a, 10) : parseInt(a, 10); return isNaN(a) ? g : a }; c = t(s[0]); s = Math.max(c, t(s[1] || "")); c = e ? Math.max(c, e.getFullYear()) : c; s = h ? Math.min(s, h.getFullYear()) : s; for (a.yearshtml += "\x3cselect class\x3d'ui-datepicker-year' data-handler\x3d'selectYear' data-event\x3d'change'\x3e"; c <= s; c++)a.yearshtml +=
                            "\x3coption value\x3d'" + c + "'" + (c === d ? " selected\x3d'selected'" : "") + "\x3e" + c + "\x3c/option\x3e"; a.yearshtml += "\x3c/select\x3e"; x += a.yearshtml; a.yearshtml = null
                } x += this._get(a, "yearSuffix"); w && (x += (!l && u && q ? "" : "\x26#xa0;") + D); return x + "\x3c/div\x3e"
            }, _adjustInstDate: function (a, c, d) {
                var e = a.drawYear + ("Y" === d ? c : 0), h = a.drawMonth + ("M" === d ? c : 0); c = Math.min(a.selectedDay, this._getDaysInMonth(e, h)) + ("D" === d ? c : 0); e = this._restrictMinMax(a, this._daylightSavingAdjust(new Date(e, h, c))); a.selectedDay = e.getDate(); a.drawMonth =
                    a.selectedMonth = e.getMonth(); a.drawYear = a.selectedYear = e.getFullYear(); "M" !== d && "Y" !== d || this._notifyChange(a)
            }, _restrictMinMax: function (a, c) { var d = this._getMinMaxDate(a, "min"), e = this._getMinMaxDate(a, "max"), d = d && c < d ? d : c; return e && d > e ? e : d }, _notifyChange: function (a) { var c = this._get(a, "onChangeMonthYear"); c && c.apply(a.input ? a.input[0] : null, [a.selectedYear, a.selectedMonth + 1, a]) }, _getNumberOfMonths: function (a) { a = this._get(a, "numberOfMonths"); return null == a ? [1, 1] : "number" === typeof a ? [1, a] : a }, _getMinMaxDate: function (a,
                c) { return this._determineDate(a, this._get(a, c + "Date"), null) }, _getDaysInMonth: function (a, c) { return 32 - this._daylightSavingAdjust(new Date(a, c, 32)).getDate() }, _getFirstDayOfMonth: function (a, c) { return (new Date(a, c, 1)).getDay() }, _canAdjustMonth: function (a, c, d, e) { var h = this._getNumberOfMonths(a); d = this._daylightSavingAdjust(new Date(d, e + (0 > c ? c : h[0] * h[1]), 1)); 0 > c && d.setDate(this._getDaysInMonth(d.getFullYear(), d.getMonth())); return this._isInRange(a, d) }, _isInRange: function (a, c) {
                    var d, e, h = this._getMinMaxDate(a,
                        "min"), l = this._getMinMaxDate(a, "max"), t = null, s = null; if (d = this._get(a, "yearRange")) d = d.split(":"), e = (new Date).getFullYear(), t = parseInt(d[0], 10), s = parseInt(d[1], 10), d[0].match(/[+\-].*/) && (t += e), d[1].match(/[+\-].*/) && (s += e); return (!h || c.getTime() >= h.getTime()) && (!l || c.getTime() <= l.getTime()) && (!t || c.getFullYear() >= t) && (!s || c.getFullYear() <= s)
                }, _getFormatConfig: function (a) {
                    var c = this._get(a, "shortYearCutoff"), c = "string" !== typeof c ? c : (new Date).getFullYear() % 100 + parseInt(c, 10); return {
                        shortYearCutoff: c,
                        dayNamesShort: this._get(a, "dayNamesShort"), dayNames: this._get(a, "dayNames"), monthNamesShort: this._get(a, "monthNamesShort"), monthNames: this._get(a, "monthNames")
                    }
                }, _formatDate: function (a, c, d, e) { c || (a.currentDay = a.selectedDay, a.currentMonth = a.selectedMonth, a.currentYear = a.selectedYear); c = c ? "object" === typeof c ? c : this._daylightSavingAdjust(new Date(e, d, c)) : this._daylightSavingAdjust(new Date(a.currentYear, a.currentMonth, a.currentDay)); return this.formatDate(this._get(a, "dateFormat"), c, this._getFormatConfig(a)) }
    });
    a.fn.datepicker = function (b) {
        if (!this.length) return this; a.datepicker.initialized || (a(document).mousedown(a.datepicker._checkExternalClick), a.datepicker.initialized = !0); 0 === a("#" + a.datepicker._mainDivId).length && a("body").append(a.datepicker.dpDiv); var c = Array.prototype.slice.call(arguments, 1); return "string" === typeof b && ("isDisabled" === b || "getDate" === b || "widget" === b) || "option" === b && 2 === arguments.length && "string" === typeof arguments[1] ? a.datepicker["_" + b + "Datepicker"].apply(a.datepicker, [this[0]].concat(c)) :
            this.each(function () { "string" === typeof b ? a.datepicker["_" + b + "Datepicker"].apply(a.datepicker, [this].concat(c)) : a.datepicker._attachDatepicker(this, b) })
    }; a.datepicker = new e; a.datepicker.initialized = !1; a.datepicker.uuid = (new Date).getTime(); a.datepicker.version = "1.10.3"
})(jQuery);
(function (a, l) {
    var e = { buttons: !0, height: !0, maxHeight: !0, maxWidth: !0, minHeight: !0, minWidth: !0, width: !0 }, h = { maxHeight: !0, maxWidth: !0, minHeight: !0, minWidth: !0 }; a.widget("ui.dialog", {
        version: "1.10.3", options: {
            appendTo: "body", autoOpen: !0, buttons: [], closeOnEscape: !0, closeText: "close", dialogClass: "", draggable: !0, hide: null, height: "auto", maxHeight: null, maxWidth: null, minHeight: 150, minWidth: 150, modal: !1, position: {
                my: "center", at: "center", of: window, collision: "fit", using: function (c) {
                    var d = a(this).css(c).offset().top;
                    0 > d && a(this).css("top", c.top - d)
                }
            }, resizable: !0, show: null, title: null, width: 300, beforeClose: null, close: null, drag: null, dragStart: null, dragStop: null, focus: null, open: null, resize: null, resizeStart: null, resizeStop: null
        }, _create: function () {
            this.originalCss = { display: this.element[0].style.display, width: this.element[0].style.width, minHeight: this.element[0].style.minHeight, maxHeight: this.element[0].style.maxHeight, height: this.element[0].style.height }; this.originalPosition = { parent: this.element.parent(), index: this.element.parent().children().index(this.element) };
            this.originalTitle = this.element.attr("title"); this.options.title = this.options.title || this.originalTitle; this._createWrapper(); this.element.show().removeAttr("title").addClass("ui-dialog-content ui-widget-content").appendTo(this.uiDialog); this._createTitlebar(); this._createButtonPane(); this.options.draggable && a.fn.draggable && this._makeDraggable(); this.options.resizable && a.fn.resizable && this._makeResizable(); this._isOpen = !1
        }, _init: function () { this.options.autoOpen && this.open() }, _appendTo: function () {
            var c =
                this.options.appendTo; return c && (c.jquery || c.nodeType) ? a(c) : this.document.find(c || "body").eq(0)
        }, _destroy: function () { var a, d = this.originalPosition; this._destroyOverlay(); this.element.removeUniqueId().removeClass("ui-dialog-content ui-widget-content").css(this.originalCss).detach(); this.uiDialog.stop(!0, !0).remove(); this.originalTitle && this.element.attr("title", this.originalTitle); a = d.parent.children().eq(d.index); a.length && a[0] !== this.element[0] ? a.before(this.element) : d.parent.append(this.element) },
        widget: function () { return this.uiDialog }, disable: a.noop, enable: a.noop, close: function (c) { var d = this; this._isOpen && !1 !== this._trigger("beforeClose", c) && (this._isOpen = !1, this._destroyOverlay(), this.opener.filter(":focusable").focus().length || a(this.document[0].activeElement).blur(), this._hide(this.uiDialog, this.options.hide, function () { d._trigger("close", c) })) }, isOpen: function () { return this._isOpen }, moveToTop: function () { this._moveToTop() }, _moveToTop: function (a, d) {
            var b = !!this.uiDialog.nextAll(":visible").insertBefore(this.uiDialog).length;
            b && !d && this._trigger("focus", a); return b
        }, open: function () { var c = this; this._isOpen ? this._moveToTop() && this._focusTabbable() : (this._isOpen = !0, this.opener = a(this.document[0].activeElement), this._size(), this._position(), this._createOverlay(), this._moveToTop(null, !0), this._show(this.uiDialog, this.options.show, function () { c._focusTabbable(); c._trigger("focus") }), this._trigger("open")) }, _focusTabbable: function () {
            var a = this.element.find("[autofocus]"); a.length || (a = this.element.find(":tabbable")); a.length ||
                (a = this.uiDialogButtonPane.find(":tabbable")); a.length || (a = this.uiDialogTitlebarClose.filter(":tabbable")); a.length || (a = this.uiDialog); a.eq(0).focus()
        }, _keepFocus: function (c) { function d() { var b = this.document[0].activeElement; this.uiDialog[0] === b || a.contains(this.uiDialog[0], b) || this._focusTabbable() } c.preventDefault(); d.call(this); this._delay(d) }, _createWrapper: function () {
            this.uiDialog = a("\x3cdiv\x3e").addClass("ui-dialog ui-widget ui-widget-content ui-corner-all ui-front " + this.options.dialogClass).hide().attr({
                tabIndex: -1,
                role: "dialog"
            }).appendTo(this._appendTo()); this._on(this.uiDialog, {
                keydown: function (c) { if (this.options.closeOnEscape && !c.isDefaultPrevented() && c.keyCode && c.keyCode === a.ui.keyCode.ESCAPE) c.preventDefault(), this.close(c); else if (c.keyCode === a.ui.keyCode.TAB) { var d = this.uiDialog.find(":tabbable"), b = d.filter(":first"), d = d.filter(":last"); c.target !== d[0] && c.target !== this.uiDialog[0] || c.shiftKey ? c.target !== b[0] && c.target !== this.uiDialog[0] || !c.shiftKey || (d.focus(1), c.preventDefault()) : (b.focus(1), c.preventDefault()) } },
                mousedown: function (a) { this._moveToTop(a) && this._focusTabbable() }
            }); this.element.find("[aria-describedby]").length || this.uiDialog.attr({ "aria-describedby": this.element.uniqueId().attr("id") })
        }, _createTitlebar: function () {
            var c; this.uiDialogTitlebar = a("\x3cdiv\x3e").addClass("ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix").prependTo(this.uiDialog); this._on(this.uiDialogTitlebar, { mousedown: function (c) { a(c.target).closest(".ui-dialog-titlebar-close") || this.uiDialog.focus() } }); this.uiDialogTitlebarClose =
                a("\x3cbutton\x3e\x3c/button\x3e").button({ label: this.options.closeText, icons: { primary: "ui-icon-closethick-white" }, text: !1 }).addClass("ui-dialog-titlebar-close").appendTo(this.uiDialogTitlebar); this._on(this.uiDialogTitlebarClose, { click: function (a) { a.preventDefault(); this.close(a) } }); c = a("\x3cspan\x3e").uniqueId().addClass("ui-dialog-title").prependTo(this.uiDialogTitlebar); this._title(c); this.uiDialog.attr({ "aria-labelledby": c.attr("id") })
        }, _title: function (a) {
            this.options.title || a.html("\x26#160;");
            a.text(this.options.title)
        }, _createButtonPane: function () { this.uiDialogButtonPane = a("\x3cdiv\x3e").addClass("ui-dialog-buttonpane ui-widget-content ui-helper-clearfix"); this.uiButtonSet = a("\x3cdiv\x3e").addClass("ui-dialog-buttonset").appendTo(this.uiDialogButtonPane); this._createButtons() }, _createButtons: function () {
            var c = this, d = this.options.buttons; this.uiDialogButtonPane.remove(); this.uiButtonSet.empty(); a.isEmptyObject(d) || a.isArray(d) && !d.length ? this.uiDialog.removeClass("ui-dialog-buttons") : (a.each(d,
                function (b, d) { var e, k; d = a.isFunction(d) ? { click: d, text: b } : d; d = a.extend({ type: "button" }, d); e = d.click; d.click = function () { e.apply(c.element[0], arguments) }; k = { icons: d.icons, text: d.showText }; delete d.icons; delete d.showText; a("\x3cbutton\x3e\x3c/button\x3e", d).button(k).appendTo(c.uiButtonSet) }), this.uiDialog.addClass("ui-dialog-buttons"), this.uiDialogButtonPane.appendTo(this.uiDialog))
        }, _makeDraggable: function () {
            function c(a) { return { position: a.position, offset: a.offset } } var d = this, b = this.options; this.uiDialog.draggable({
                cancel: ".ui-dialog-content, .ui-dialog-titlebar-close",
                handle: ".ui-dialog-titlebar", containment: "document", start: function (b, e) { a(this).addClass("ui-dialog-dragging"); d._blockFrames(); d._trigger("dragStart", b, c(e)) }, drag: function (a, b) { d._trigger("drag", a, c(b)) }, stop: function (e, m) { b.position = [m.position.left - d.document.scrollLeft(), m.position.top - d.document.scrollTop()]; a(this).removeClass("ui-dialog-dragging"); d._unblockFrames(); d._trigger("dragStop", e, c(m)) }
            })
        }, _makeResizable: function () {
            function c(a) {
                return {
                    originalPosition: a.originalPosition, originalSize: a.originalSize,
                    position: a.position, size: a.size
                }
            } var d = this, b = this.options, e = b.resizable, m = this.uiDialog.css("position"), e = "string" === typeof e ? e : "n,e,s,w,se,sw,ne,nw"; this.uiDialog.resizable({
                cancel: ".ui-dialog-content", containment: "document", alsoResize: this.element, maxWidth: b.maxWidth, maxHeight: b.maxHeight, minWidth: b.minWidth, minHeight: this._minHeight(), handles: e, start: function (b, e) { a(this).addClass("ui-dialog-resizing"); d._blockFrames(); d._trigger("resizeStart", b, c(e)) }, resize: function (a, b) {
                    d._trigger("resize",
                        a, c(b))
                }, stop: function (e, f) { b.height = a(this).height(); b.width = a(this).width(); a(this).removeClass("ui-dialog-resizing"); d._unblockFrames(); d._trigger("resizeStop", e, c(f)) }
            }).css("position", m)
        }, _minHeight: function () { var a = this.options; return "auto" === a.height ? a.minHeight : Math.min(a.minHeight, a.height) }, _position: function () { var a = this.uiDialog.is(":visible"); a || this.uiDialog.show(); this.uiDialog.position(this.options.position); a || this.uiDialog.hide() }, _setOptions: function (c) {
            var d = this, b = !1, f = {}; a.each(c,
                function (a, c) { d._setOption(a, c); a in e && (b = !0); a in h && (f[a] = c) }); b && (this._size(), this._position()); this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", f)
        }, _setOption: function (a, d) {
            var b, e = this.uiDialog; "dialogClass" === a && e.removeClass(this.options.dialogClass).addClass(d); "disabled" !== a && (this._super(a, d), "appendTo" === a && this.uiDialog.appendTo(this._appendTo()), "buttons" === a && this._createButtons(), "closeText" === a && this.uiDialogTitlebarClose.button({ label: "" + d }), "draggable" ===
                a && ((b = e.is(":data(ui-draggable)")) && !d && e.draggable("destroy"), !b && d && this._makeDraggable()), "position" === a && this._position(), "resizable" === a && ((b = e.is(":data(ui-resizable)")) && !d && e.resizable("destroy"), b && "string" === typeof d && e.resizable("option", "handles", d), b || !1 === d || this._makeResizable()), "title" === a && this._title(this.uiDialogTitlebar.find(".ui-dialog-title")))
        }, _size: function () {
            var a, d, b, e = this.options; this.element.show().css({ width: "auto", minHeight: 0, maxHeight: "none", height: 0 }); e.minWidth >
                e.width && (e.width = e.minWidth); a = this.uiDialog.css({ height: "auto", width: e.width }).outerHeight(); d = Math.max(0, e.minHeight - a); b = "number" === typeof e.maxHeight ? Math.max(0, e.maxHeight - a) : "none"; "auto" === e.height ? this.element.css({ minHeight: d, maxHeight: b, height: "auto" }) : this.element.height(Math.max(0, e.height - a)); this.uiDialog.is(":data(ui-resizable)") && this.uiDialog.resizable("option", "minHeight", this._minHeight())
        }, _blockFrames: function () {
            this.iframeBlocks = this.document.find("iframe").map(function () {
                var c =
                    a(this); return a("\x3cdiv\x3e").css({ position: "absolute", width: c.outerWidth(), height: c.outerHeight() }).appendTo(c.parent()).offset(c.offset())[0]
            })
        }, _unblockFrames: function () { this.iframeBlocks && (this.iframeBlocks.remove(), delete this.iframeBlocks) }, _allowInteraction: function (c) { return a(c.target).closest(".ui-dialog").length ? !0 : !!a(c.target).closest(".ui-datepicker").length }, _createOverlay: function () {
            if (this.options.modal) {
                var c = this, d = this.widgetFullName; a.ui.dialog.overlayInstances || this._delay(function () {
                    a.ui.dialog.overlayInstances &&
                    this.document.bind("focusin.dialog", function (b) { c._allowInteraction(b) || (b.preventDefault(), a(".ui-dialog:visible:last .ui-dialog-content").data(d)._focusTabbable()) })
                }); this.overlay = a("\x3cdiv\x3e").addClass("ui-widget-overlay ui-front").appendTo(this._appendTo()); this._on(this.overlay, { mousedown: "_keepFocus" }); a.ui.dialog.overlayInstances++
            }
        }, _destroyOverlay: function () {
            this.options.modal && this.overlay && (a.ui.dialog.overlayInstances--, a.ui.dialog.overlayInstances || this.document.unbind("focusin.dialog"),
                this.overlay.remove(), this.overlay = null)
        }
    }); a.ui.dialog.overlayInstances = 0; !1 !== a.uiBackCompat && a.widget("ui.dialog", a.ui.dialog, {
        _position: function () {
            var c = this.options.position, d = [], b = [0, 0], e; if (c) {
                if ("string" === typeof c || "object" === typeof c && "0" in c) d = c.split ? c.split(" ") : [c[0], c[1]], 1 === d.length && (d[1] = d[0]), a.each(["left", "top"], function (a, c) { +d[a] === d[a] && (b[a] = d[a], d[a] = c) }), c = { my: d[0] + (0 > b[0] ? b[0] : "+" + b[0]) + " " + d[1] + (0 > b[1] ? b[1] : "+" + b[1]), at: d.join(" ") }; c = a.extend({}, a.ui.dialog.prototype.options.position,
                    c)
            } else c = a.ui.dialog.prototype.options.position; (e = this.uiDialog.is(":visible")) || this.uiDialog.show(); this.uiDialog.position(c); e || this.uiDialog.hide()
        }
    })
})(jQuery);
(function (a, l) {
    a.widget("ui.menu", {
        version: "1.10.3", defaultElement: "\x3cul\x3e", delay: 300, options: { icons: { submenu: "ui-icon-carat-1-e" }, menus: "ul", position: { my: "left top", at: "right top" }, role: "menu", blur: null, focus: null, select: null }, _create: function () {
            this.activeMenu = this.element; this.mouseHandled = !1; this.element.uniqueId().addClass("ui-menu ui-widget ui-widget-content ui-corner-all").toggleClass("ui-menu-icons", !!this.element.find(".ui-icon").length).attr({ role: this.options.role, tabIndex: 0 }).bind("click" +
                this.eventNamespace, a.proxy(function (a) { this.options.disabled && a.preventDefault() }, this)); this.options.disabled && this.element.addClass("ui-state-disabled").attr("aria-disabled", "true"); this._on({
                    "mousedown .ui-menu-item \x3e a": function (a) { a.preventDefault() }, "click .ui-state-disabled \x3e a": function (a) { a.preventDefault() }, "click .ui-menu-item:has(a)": function (e) {
                        var h = a(e.target).closest(".ui-menu-item"); !this.mouseHandled && h.not(".ui-state-disabled").length && (this.mouseHandled = !0, this.select(e),
                            h.has(".ui-menu").length ? this.expand(e) : this.element.is(":focus") || (this.element.trigger("focus", [!0]), this.active && 1 === this.active.parents(".ui-menu").length && clearTimeout(this.timer)))
                    }, "mouseenter .ui-menu-item": function (e) { var h = a(e.currentTarget); h.siblings().children(".ui-state-active").removeClass("ui-state-active"); this.focus(e, h) }, mouseleave: "collapseAll", "mouseleave .ui-menu": "collapseAll", focus: function (a, h) {
                        var c = this.active || this.element.children(".ui-menu-item").eq(0); h || this.focus(a,
                            c)
                    }, blur: function (e) { this._delay(function () { a.contains(this.element[0], this.document[0].activeElement) || this.collapseAll(e) }) }, keydown: "_keydown"
                }); this.refresh(); this._on(this.document, { click: function (e) { a(e.target).closest(".ui-menu").length || this.collapseAll(e); this.mouseHandled = !1 } })
        }, _destroy: function () {
            this.element.removeAttr("aria-activedescendant").find(".ui-menu").addBack().removeClass("ui-menu ui-widget ui-widget-content ui-corner-all ui-menu-icons").removeAttr("role").removeAttr("tabIndex").removeAttr("aria-labelledby").removeAttr("aria-expanded").removeAttr("aria-hidden").removeAttr("aria-disabled").removeUniqueId().show();
            this.element.find(".ui-menu-item").removeClass("ui-menu-item").removeAttr("role").removeAttr("aria-disabled").children("a").removeUniqueId().removeClass("ui-corner-all ui-state-hover").removeAttr("tabIndex").removeAttr("role").removeAttr("aria-haspopup").children().each(function () { var e = a(this); e.data("ui-menu-submenu-carat") && e.remove() }); this.element.find(".ui-menu-divider").removeClass("ui-menu-divider ui-widget-content")
        }, _keydown: function (e) {
            function h(a) {
                return a.replace(/[\-\[\]{}()*+?.,\\\^$|#\s]/g,
                    "\\$\x26")
            } var c, d, b, f, m = !0; switch (e.keyCode) {
                case a.ui.keyCode.PAGE_UP: this.previousPage(e); break; case a.ui.keyCode.PAGE_DOWN: this.nextPage(e); break; case a.ui.keyCode.HOME: this._move("first", "first", e); break; case a.ui.keyCode.END: this._move("last", "last", e); break; case a.ui.keyCode.UP: this.previous(e); break; case a.ui.keyCode.DOWN: this.next(e); break; case a.ui.keyCode.LEFT: this.collapse(e); break; case a.ui.keyCode.RIGHT: this.active && !this.active.is(".ui-state-disabled") && this.expand(e); break; case a.ui.keyCode.ENTER: case a.ui.keyCode.SPACE: this._activate(e);
                    break; case a.ui.keyCode.ESCAPE: this.collapse(e); break; default: m = !1, c = this.previousFilter || "", d = String.fromCharCode(e.keyCode), b = !1, clearTimeout(this.filterTimer), d === c ? b = !0 : d = c + d, f = RegExp("^" + h(d), "i"), c = this.activeMenu.children(".ui-menu-item").filter(function () { return f.test(a(this).children("a").text()) }), c = b && -1 !== c.index(this.active.next()) ? this.active.nextAll(".ui-menu-item") : c, c.length || (d = String.fromCharCode(e.keyCode), f = RegExp("^" + h(d), "i"), c = this.activeMenu.children(".ui-menu-item").filter(function () { return f.test(a(this).children("a").text()) })),
                        c.length ? (this.focus(e, c), 1 < c.length ? (this.previousFilter = d, this.filterTimer = this._delay(function () { delete this.previousFilter }, 1E3)) : delete this.previousFilter) : delete this.previousFilter
            }m && e.preventDefault()
        }, _activate: function (a) { this.active.is(".ui-state-disabled") || (this.active.children("a[aria-haspopup\x3d'true']").length ? this.expand(a) : this.select(a)) }, refresh: function () {
            var e, h = this.options.icons.submenu; e = this.element.find(this.options.menus); e.filter(":not(.ui-menu)").addClass("ui-menu ui-widget ui-widget-content ui-corner-all").hide().attr({
                role: this.options.role,
                "aria-hidden": "true", "aria-expanded": "false"
            }).each(function () { var c = a(this), d = c.prev("a"), b = a("\x3cspan\x3e").addClass("ui-menu-icon ui-icon " + h).data("ui-menu-submenu-carat", !0); d.attr("aria-haspopup", "true").prepend(b); c.attr("aria-labelledby", d.attr("id")) }); e = e.add(this.element); e.children(":not(.ui-menu-item):has(a)").addClass("ui-menu-item").attr("role", "presentation").children("a").uniqueId().addClass("ui-corner-all").attr({ tabIndex: -1, role: this._itemRole() }); e.children(":not(.ui-menu-item)").each(function () {
                var c =
                    a(this); /[^\-\u2014\u2013\s]/.test(c.text()) || c.addClass("ui-widget-content ui-menu-divider")
            }); e.children(".ui-state-disabled").attr("aria-disabled", "true"); this.active && !a.contains(this.element[0], this.active[0]) && this.blur()
        }, _itemRole: function () { return { menu: "menuitem", listbox: "option" }[this.options.role] }, _setOption: function (a, h) { "icons" === a && this.element.find(".ui-menu-icon").removeClass(this.options.icons.submenu).addClass(h.submenu); this._super(a, h) }, focus: function (a, h) {
            var c; this.blur(a, a &&
                "focus" === a.type); this._scrollIntoView(h); this.active = h.first(); c = this.active.children("a").addClass("ui-state-focus"); this.options.role && this.element.attr("aria-activedescendant", c.attr("id")); this.active.parent().closest(".ui-menu-item").children("a:first").addClass("ui-state-active"); a && "keydown" === a.type ? this._close() : this.timer = this._delay(function () { this._close() }, this.delay); c = h.children(".ui-menu"); c.length && /^mouse/.test(a.type) && this._startOpening(c); this.activeMenu = h.parent(); this._trigger("focus",
                    a, { item: h })
        }, _scrollIntoView: function (e) { var h, c, d; this._hasScroll() && (h = parseFloat(a.css(this.activeMenu[0], "borderTopWidth")) || 0, c = parseFloat(a.css(this.activeMenu[0], "paddingTop")) || 0, h = e.offset().top - this.activeMenu.offset().top - h - c, c = this.activeMenu.scrollTop(), d = this.activeMenu.height(), e = e.height(), 0 > h ? this.activeMenu.scrollTop(c + h) : h + e > d && this.activeMenu.scrollTop(c + h - d + e)) }, blur: function (a, h) {
            h || clearTimeout(this.timer); this.active && (this.active.children("a").removeClass("ui-state-focus"),
                this.active = null, this._trigger("blur", a, { item: this.active }))
        }, _startOpening: function (a) { clearTimeout(this.timer); "true" === a.attr("aria-hidden") && (this.timer = this._delay(function () { this._close(); this._open(a) }, this.delay)) }, _open: function (e) { var h = a.extend({ of: this.active }, this.options.position); clearTimeout(this.timer); this.element.find(".ui-menu").not(e.parents(".ui-menu")).hide().attr("aria-hidden", "true"); e.show().removeAttr("aria-hidden").attr("aria-expanded", "true").position(h) }, collapseAll: function (e,
            h) { clearTimeout(this.timer); this.timer = this._delay(function () { var c = h ? this.element : a(e && e.target).closest(this.element.find(".ui-menu")); c.length || (c = this.element); this._close(c); this.blur(e); this.activeMenu = c }, this.delay) }, _close: function (a) { a || (a = this.active ? this.active.parent() : this.element); a.find(".ui-menu").hide().attr("aria-hidden", "true").attr("aria-expanded", "false").end().find("a.ui-state-active").removeClass("ui-state-active") }, collapse: function (a) {
                var h = this.active && this.active.parent().closest(".ui-menu-item",
                    this.element); h && h.length && (this._close(), this.focus(a, h))
            }, expand: function (a) { var h = this.active && this.active.children(".ui-menu ").children(".ui-menu-item").first(); h && h.length && (this._open(h.parent()), this._delay(function () { this.focus(a, h) })) }, next: function (a) { this._move("next", "first", a) }, previous: function (a) { this._move("prev", "last", a) }, isFirstItem: function () { return this.active && !this.active.prevAll(".ui-menu-item").length }, isLastItem: function () { return this.active && !this.active.nextAll(".ui-menu-item").length },
        _move: function (a, h, c) { var d; this.active && (d = "first" === a || "last" === a ? this.active["first" === a ? "prevAll" : "nextAll"](".ui-menu-item").eq(-1) : this.active[a + "All"](".ui-menu-item").eq(0)); d && d.length && this.active || (d = this.activeMenu.children(".ui-menu-item")[h]()); this.focus(c, d) }, nextPage: function (e) {
            var h, c, d; this.active ? this.isLastItem() || (this._hasScroll() ? (c = this.active.offset().top, d = this.element.height(), this.active.nextAll(".ui-menu-item").each(function () { h = a(this); return 0 > h.offset().top - c - d }),
                this.focus(e, h)) : this.focus(e, this.activeMenu.children(".ui-menu-item")[this.active ? "last" : "first"]())) : this.next(e)
        }, previousPage: function (e) { var h, c, d; this.active ? this.isFirstItem() || (this._hasScroll() ? (c = this.active.offset().top, d = this.element.height(), this.active.prevAll(".ui-menu-item").each(function () { h = a(this); return 0 < h.offset().top - c + d }), this.focus(e, h)) : this.focus(e, this.activeMenu.children(".ui-menu-item").first())) : this.next(e) }, _hasScroll: function () {
            return this.element.outerHeight() <
                this.element.prop("scrollHeight")
        }, select: function (e) { this.active = this.active || a(e.target).closest(".ui-menu-item"); var h = { item: this.active }; this.active.has(".ui-menu").length || this.collapseAll(e, !0); this._trigger("select", e, h) }
    })
})(jQuery);
(function (a, l) {
    a.widget("ui.progressbar", {
        version: "1.10.3", options: { max: 100, value: 0, change: null, complete: null }, min: 0, _create: function () { this.oldValue = this.options.value = this._constrainedValue(); this.element.addClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").attr({ role: "progressbar", "aria-valuemin": this.min }); this.valueDiv = a("\x3cdiv class\x3d'ui-progressbar-value ui-widget-header ui-corner-left'\x3e\x3c/div\x3e").appendTo(this.element); this._refreshValue() }, _destroy: function () {
            this.element.removeClass("ui-progressbar ui-widget ui-widget-content ui-corner-all").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow");
            this.valueDiv.remove()
        }, value: function (a) { if (a === l) return this.options.value; this.options.value = this._constrainedValue(a); this._refreshValue() }, _constrainedValue: function (a) { a === l && (a = this.options.value); this.indeterminate = !1 === a; "number" !== typeof a && (a = 0); return this.indeterminate ? !1 : Math.min(this.options.max, Math.max(this.min, a)) }, _setOptions: function (a) { var h = a.value; delete a.value; this._super(a); this.options.value = this._constrainedValue(h); this._refreshValue() }, _setOption: function (a, h) {
            "max" ===
            a && (h = Math.max(this.min, h)); this._super(a, h)
        }, _percentage: function () { return this.indeterminate ? 100 : 100 * (this.options.value - this.min) / (this.options.max - this.min) }, _refreshValue: function () {
            var e = this.options.value, h = this._percentage(); this.valueDiv.toggle(this.indeterminate || e > this.min).toggleClass("ui-corner-right", e === this.options.max).width(h.toFixed(0) + "%"); this.element.toggleClass("ui-progressbar-indeterminate", this.indeterminate); this.indeterminate ? (this.element.removeAttr("aria-valuenow"), this.overlayDiv ||
                (this.overlayDiv = a("\x3cdiv class\x3d'ui-progressbar-overlay'\x3e\x3c/div\x3e").appendTo(this.valueDiv))) : (this.element.attr({ "aria-valuemax": this.options.max, "aria-valuenow": e }), this.overlayDiv && (this.overlayDiv.remove(), this.overlayDiv = null)); this.oldValue !== e && (this.oldValue = e, this._trigger("change")); e === this.options.max && this._trigger("complete")
        }
    })
})(jQuery);
(function (a, l) {
    a.widget("ui.slider", a.ui.mouse, {
        version: "1.10.3", widgetEventPrefix: "slide", options: { animate: !1, distance: 0, max: 100, min: 0, orientation: "horizontal", range: !1, step: 1, value: 0, values: null, change: null, slide: null, start: null, stop: null }, _create: function () {
            this._mouseSliding = this._keySliding = !1; this._animateOff = !0; this._handleIndex = null; this._detectOrientation(); this._mouseInit(); this.element.addClass("ui-slider ui-slider-" + this.orientation + " ui-widget ui-widget-content ui-corner-all"); this._refresh();
            this._setOption("disabled", this.options.disabled); this._animateOff = !1
        }, _refresh: function () { this._createRange(); this._createHandles(); this._setupEvents(); this._refreshValue() }, _createHandles: function () {
            var e, h; e = this.options; var c = this.element.find(".ui-slider-handle").addClass("ui-state-default ui-corner-all"), d = []; h = e.values && e.values.length || 1; c.length > h && (c.slice(h).remove(), c = c.slice(0, h)); for (e = c.length; e < h; e++)d.push("\x3ca class\x3d'ui-slider-handle ui-state-default ui-corner-all' href\x3d'#'\x3e\x3c/a\x3e");
            this.handles = c.add(a(d.join("")).appendTo(this.element)); this.handle = this.handles.eq(0); this.handles.each(function (b) { a(this).data("ui-slider-handle-index", b) })
        }, _createRange: function () {
            var e = this.options, h = ""; e.range ? (!0 === e.range && (e.values ? e.values.length && 2 !== e.values.length ? e.values = [e.values[0], e.values[0]] : a.isArray(e.values) && (e.values = e.values.slice(0)) : e.values = [this._valueMin(), this._valueMin()]), this.range && this.range.length ? this.range.removeClass("ui-slider-range-min ui-slider-range-max").css({
                left: "",
                bottom: ""
            }) : (this.range = a("\x3cdiv\x3e\x3c/div\x3e").appendTo(this.element), h = "ui-slider-range ui-widget-header ui-corner-all"), this.range.addClass(h + ("min" === e.range || "max" === e.range ? " ui-slider-range-" + e.range : ""))) : this.range = a([])
        }, _setupEvents: function () { var a = this.handles.add(this.range).filter("a"); this._off(a); this._on(a, this._handleEvents); this._hoverable(a); this._focusable(a) }, _destroy: function () {
            this.handles.remove(); this.range.remove(); this.element.removeClass("ui-slider ui-slider-horizontal ui-slider-vertical ui-widget ui-widget-content ui-corner-all");
            this._mouseDestroy()
        }, _mouseCapture: function (e) {
            var h, c, d, b, f, m = this, k = this.options; if (k.disabled) return !1; this.elementSize = { width: this.element.outerWidth(), height: this.element.outerHeight() }; this.elementOffset = this.element.offset(); h = this._normValueFromMouse({ x: e.pageX, y: e.pageY }); c = this._valueMax() - this._valueMin() + 1; this.handles.each(function (f) { var e = Math.abs(h - m.values(f)); if (c > e || c === e && (f === m._lastChangedValue || m.values(f) === k.min)) c = e, d = a(this), b = f }); if (!1 === this._start(e, b)) return !1; this._mouseSliding =
                !0; this._handleIndex = b; d.addClass("ui-state-active").focus(); f = d.offset(); this._clickOffset = a(e.target).parents().addBack().is(".ui-slider-handle") ? { left: e.pageX - f.left - d.width() / 2, top: e.pageY - f.top - d.height() / 2 - (parseInt(d.css("borderTopWidth"), 10) || 0) - (parseInt(d.css("borderBottomWidth"), 10) || 0) + (parseInt(d.css("marginTop"), 10) || 0) } : { left: 0, top: 0 }; this.handles.hasClass("ui-state-hover") || this._slide(e, b, h); return this._animateOff = !0
        }, _mouseStart: function () { return !0 }, _mouseDrag: function (a) {
            var h =
                this._normValueFromMouse({ x: a.pageX, y: a.pageY }); this._slide(a, this._handleIndex, h); return !1
        }, _mouseStop: function (a) { this.handles.removeClass("ui-state-active"); this._mouseSliding = !1; this._stop(a, this._handleIndex); this._change(a, this._handleIndex); this._clickOffset = this._handleIndex = null; return this._animateOff = !1 }, _detectOrientation: function () { this.orientation = "vertical" === this.options.orientation ? "vertical" : "horizontal" }, _normValueFromMouse: function (a) {
            var h; "horizontal" === this.orientation ? (h = this.elementSize.width,
                a = a.x - this.elementOffset.left - (this._clickOffset ? this._clickOffset.left : 0)) : (h = this.elementSize.height, a = a.y - this.elementOffset.top - (this._clickOffset ? this._clickOffset.top : 0)); h = a / h; 1 < h && (h = 1); 0 > h && (h = 0); "vertical" === this.orientation && (h = 1 - h); a = this._valueMax() - this._valueMin(); h = this._valueMin() + h * a; return this._trimAlignValue(h)
        }, _start: function (a, h) {
            var c = { handle: this.handles[h], value: this.value() }; this.options.values && this.options.values.length && (c.value = this.values(h), c.values = this.values());
            return this._trigger("start", a, c)
        }, _slide: function (a, h, c) { var d; this.options.values && this.options.values.length ? (d = this.values(h ? 0 : 1), 2 === this.options.values.length && !0 === this.options.range && (0 === h && c > d || 1 === h && c < d) && (c = d), c !== this.values(h) && (d = this.values(), d[h] = c, a = this._trigger("slide", a, { handle: this.handles[h], value: c, values: d }), this.values(h ? 0 : 1), !1 !== a && this.values(h, c, !0))) : c !== this.value() && (a = this._trigger("slide", a, { handle: this.handles[h], value: c }), !1 !== a && this.value(c)) }, _stop: function (a,
            h) { var c = { handle: this.handles[h], value: this.value() }; this.options.values && this.options.values.length && (c.value = this.values(h), c.values = this.values()); this._trigger("stop", a, c) }, _change: function (a, h) { if (!this._keySliding && !this._mouseSliding) { var c = { handle: this.handles[h], value: this.value() }; this.options.values && this.options.values.length && (c.value = this.values(h), c.values = this.values()); this._lastChangedValue = h; this._trigger("change", a, c) } }, value: function (a) {
                if (arguments.length) this.options.value =
                    this._trimAlignValue(a), this._refreshValue(), this._change(null, 0); else return this._value()
            }, values: function (e, h) {
                var c, d, b; if (1 < arguments.length) this.options.values[e] = this._trimAlignValue(h), this._refreshValue(), this._change(null, e); else if (arguments.length) if (a.isArray(arguments[0])) { c = this.options.values; d = arguments[0]; for (b = 0; b < c.length; b += 1)c[b] = this._trimAlignValue(d[b]), this._change(null, b); this._refreshValue() } else return this.options.values && this.options.values.length ? this._values(e) : this.value();
                else return this._values()
            }, _setOption: function (e, h) {
                var c, d = 0; "range" === e && !0 === this.options.range && ("min" === h ? (this.options.value = this._values(0), this.options.values = null) : "max" === h && (this.options.value = this._values(this.options.values.length - 1), this.options.values = null)); a.isArray(this.options.values) && (d = this.options.values.length); a.Widget.prototype._setOption.apply(this, arguments); switch (e) {
                    case "orientation": this._detectOrientation(); this.element.removeClass("ui-slider-horizontal ui-slider-vertical").addClass("ui-slider-" +
                        this.orientation); this._refreshValue(); break; case "value": this._animateOff = !0; this._refreshValue(); this._change(null, 0); this._animateOff = !1; break; case "values": this._animateOff = !0; this._refreshValue(); for (c = 0; c < d; c += 1)this._change(null, c); this._animateOff = !1; break; case "min": case "max": this._animateOff = !0; this._refreshValue(); this._animateOff = !1; break; case "range": this._animateOff = !0, this._refresh(), this._animateOff = !1
                }
            }, _value: function () { var a = this.options.value; return a = this._trimAlignValue(a) },
        _values: function (a) { var h, c; if (arguments.length) return h = this.options.values[a], h = this._trimAlignValue(h); if (this.options.values && this.options.values.length) { h = this.options.values.slice(); for (c = 0; c < h.length; c += 1)h[c] = this._trimAlignValue(h[c]); return h } return [] }, _trimAlignValue: function (a) { if (a <= this._valueMin()) return this._valueMin(); if (a >= this._valueMax()) return this._valueMax(); var h = 0 < this.options.step ? this.options.step : 1, c = (a - this._valueMin()) % h; a -= c; 2 * Math.abs(c) >= h && (a += 0 < c ? h : -h); return parseFloat(a.toFixed(5)) },
        _valueMin: function () { return this.options.min }, _valueMax: function () { return this.options.max }, _refreshValue: function () {
            var e, h, c, d, b, f = this.options.range, m = this.options, k = this, r = this._animateOff ? !1 : m.animate, l = {}; if (this.options.values && this.options.values.length) this.handles.each(function (b) {
                h = 100 * ((k.values(b) - k._valueMin()) / (k._valueMax() - k._valueMin())); l["horizontal" === k.orientation ? "left" : "bottom"] = h + "%"; a(this).stop(1, 1)[r ? "animate" : "css"](l, m.animate); if (!0 === k.options.range) if ("horizontal" ===
                    k.orientation) { if (0 === b) k.range.stop(1, 1)[r ? "animate" : "css"]({ left: h + "%" }, m.animate); if (1 === b) k.range[r ? "animate" : "css"]({ width: h - e + "%" }, { queue: !1, duration: m.animate }) } else { if (0 === b) k.range.stop(1, 1)[r ? "animate" : "css"]({ bottom: h + "%" }, m.animate); if (1 === b) k.range[r ? "animate" : "css"]({ height: h - e + "%" }, { queue: !1, duration: m.animate }) } e = h
            }); else {
                c = this.value(); d = this._valueMin(); b = this._valueMax(); h = b !== d ? 100 * ((c - d) / (b - d)) : 0; l["horizontal" === this.orientation ? "left" : "bottom"] = h + "%"; this.handle.stop(1, 1)[r ?
                    "animate" : "css"](l, m.animate); if ("min" === f && "horizontal" === this.orientation) this.range.stop(1, 1)[r ? "animate" : "css"]({ width: h + "%" }, m.animate); if ("max" === f && "horizontal" === this.orientation) this.range[r ? "animate" : "css"]({ width: 100 - h + "%" }, { queue: !1, duration: m.animate }); if ("min" === f && "vertical" === this.orientation) this.range.stop(1, 1)[r ? "animate" : "css"]({ height: h + "%" }, m.animate); if ("max" === f && "vertical" === this.orientation) this.range[r ? "animate" : "css"]({ height: 100 - h + "%" }, { queue: !1, duration: m.animate })
            }
        },
        _handleEvents: {
            keydown: function (e) {
                var h, c, d, b = a(e.target).data("ui-slider-handle-index"); switch (e.keyCode) { case a.ui.keyCode.HOME: case a.ui.keyCode.END: case a.ui.keyCode.PAGE_UP: case a.ui.keyCode.PAGE_DOWN: case a.ui.keyCode.UP: case a.ui.keyCode.RIGHT: case a.ui.keyCode.DOWN: case a.ui.keyCode.LEFT: if (e.preventDefault(), !this._keySliding && (this._keySliding = !0, a(e.target).addClass("ui-state-active"), h = this._start(e, b), !1 === h)) return }d = this.options.step; h = this.options.values && this.options.values.length ?
                    c = this.values(b) : c = this.value(); switch (e.keyCode) {
                        case a.ui.keyCode.HOME: c = this._valueMin(); break; case a.ui.keyCode.END: c = this._valueMax(); break; case a.ui.keyCode.PAGE_UP: c = this._trimAlignValue(h + (this._valueMax() - this._valueMin()) / 5); break; case a.ui.keyCode.PAGE_DOWN: c = this._trimAlignValue(h - (this._valueMax() - this._valueMin()) / 5); break; case a.ui.keyCode.UP: case a.ui.keyCode.RIGHT: if (h === this._valueMax()) return; c = this._trimAlignValue(h + d); break; case a.ui.keyCode.DOWN: case a.ui.keyCode.LEFT: if (h ===
                            this._valueMin()) return; c = this._trimAlignValue(h - d)
                    }this._slide(e, b, c)
            }, click: function (a) { a.preventDefault() }, keyup: function (e) { var h = a(e.target).data("ui-slider-handle-index"); this._keySliding && (this._keySliding = !1, this._stop(e, h), this._change(e, h), a(e.target).removeClass("ui-state-active")) }
        }
    })
})(jQuery);
(function (a) {
    function l(a) { return function () { var h = this.element.val(); a.apply(this, arguments); this._refresh(); h !== this.element.val() && this._trigger("change") } } a.widget("ui.spinner", {
        version: "1.10.3", defaultElement: "\x3cinput\x3e", widgetEventPrefix: "spin", options: { culture: null, icons: { down: "ui-icon-triangle-1-s", up: "ui-icon-triangle-1-n" }, incremental: !0, max: null, min: null, numberFormat: null, page: 10, step: 1, change: null, spin: null, start: null, stop: null }, _create: function () {
            this._setOption("max", this.options.max);
            this._setOption("min", this.options.min); this._setOption("step", this.options.step); this._value(this.element.val(), !0); this._draw(); this._on(this._events); this._refresh(); this._on(this.window, { beforeunload: function () { this.element.removeAttr("autocomplete") } })
        }, _getCreateOptions: function () { var e = {}, h = this.element; a.each(["min", "max", "step"], function (a, d) { var b = h.attr(d); void 0 !== b && b.length && (e[d] = b) }); return e }, _events: {
            keydown: function (a) { this._start(a) && this._keydown(a) && a.preventDefault() }, keyup: "_stop",
            focus: function () { this.previous = this.element.val() }, blur: function (a) { this.cancelBlur ? delete this.cancelBlur : (this._stop(), this._refresh(), this.previous !== this.element.val() && this._trigger("change", a)) }, mousewheel: function (a, h) { if (h) { if (!this.spinning && !this._start(a)) return !1; this._spin((0 < h ? 1 : -1) * this.options.step, a); clearTimeout(this.mousewheelTimer); this.mousewheelTimer = this._delay(function () { this.spinning && this._stop(a) }, 100); a.preventDefault() } }, "mousedown .ui-spinner-button": function (e) {
                function h() {
                    this.element[0] !==
                    this.document[0].activeElement && (this.element.focus(), this.previous = c, this._delay(function () { this.previous = c }))
                } var c; c = this.element[0] === this.document[0].activeElement ? this.previous : this.element.val(); e.preventDefault(); h.call(this); this.cancelBlur = !0; this._delay(function () { delete this.cancelBlur; h.call(this) }); !1 !== this._start(e) && this._repeat(null, a(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e)
            }, "mouseup .ui-spinner-button": "_stop", "mouseenter .ui-spinner-button": function (e) {
                if (a(e.currentTarget).hasClass("ui-state-active")) {
                    if (!1 ===
                        this._start(e)) return !1; this._repeat(null, a(e.currentTarget).hasClass("ui-spinner-up") ? 1 : -1, e)
                }
            }, "mouseleave .ui-spinner-button": "_stop"
        }, _draw: function () {
            var a = this.uiSpinner = this.element.addClass("ui-spinner-input").attr("autocomplete", "off").wrap(this._uiSpinnerHtml()).parent().append(this._buttonHtml()); this.element.attr("role", "spinbutton"); this.buttons = a.find(".ui-spinner-button").attr("tabIndex", -1).button().removeClass("ui-corner-all"); this.buttons.height() > Math.ceil(0.5 * a.height()) && 0 < a.height() &&
                a.height(a.height()); this.options.disabled && this.disable()
        }, _keydown: function (e) { var h = this.options, c = a.ui.keyCode; switch (e.keyCode) { case c.UP: return this._repeat(null, 1, e), !0; case c.DOWN: return this._repeat(null, -1, e), !0; case c.PAGE_UP: return this._repeat(null, h.page, e), !0; case c.PAGE_DOWN: return this._repeat(null, -h.page, e), !0 }return !1 }, _uiSpinnerHtml: function () { return "\x3cspan class\x3d'ui-spinner ui-widget ui-widget-content ui-corner-all'\x3e\x3c/span\x3e" }, _buttonHtml: function () {
            return "\x3ca class\x3d'ui-spinner-button ui-spinner-up ui-corner-tr'\x3e\x3cspan class\x3d'ui-icon " +
                this.options.icons.up + "'\x3e\x26#9650;\x3c/span\x3e\x3c/a\x3e\x3ca class\x3d'ui-spinner-button ui-spinner-down ui-corner-br'\x3e\x3cspan class\x3d'ui-icon " + this.options.icons.down + "'\x3e\x26#9660;\x3c/span\x3e\x3c/a\x3e"
        }, _start: function (a) { if (!this.spinning && !1 === this._trigger("start", a)) return !1; this.counter || (this.counter = 1); return this.spinning = !0 }, _repeat: function (a, h, c) {
            a = a || 500; clearTimeout(this.timer); this.timer = this._delay(function () { this._repeat(40, h, c) }, a); this._spin(h * this.options.step,
                c)
        }, _spin: function (a, h) { var c = this.value() || 0; this.counter || (this.counter = 1); c = this._adjustValue(c + a * this._increment(this.counter)); this.spinning && !1 === this._trigger("spin", h, { value: c }) || (this._value(c), this.counter++) }, _increment: function (e) { var h = this.options.incremental; return h ? a.isFunction(h) ? h(e) : Math.floor(e * e * e / 5E4 - e * e / 500 + 17 * e / 200 + 1) : 1 }, _precision: function () { var a = this._precisionOf(this.options.step); null !== this.options.min && (a = Math.max(a, this._precisionOf(this.options.min))); return a }, _precisionOf: function (a) {
            a =
            a.toString(); var h = a.indexOf("."); return -1 === h ? 0 : a.length - h - 1
        }, _adjustValue: function (a) { var h, c = this.options; h = null !== c.min ? c.min : 0; a = Math.round((a - h) / c.step) * c.step; a = h + a; a = parseFloat(a.toFixed(this._precision())); return null !== c.max && a > c.max ? c.max : null !== c.min && a < c.min ? c.min : a }, _stop: function (a) { this.spinning && (clearTimeout(this.timer), clearTimeout(this.mousewheelTimer), this.counter = 0, this.spinning = !1, this._trigger("stop", a)) }, _setOption: function (a, h) {
            if ("culture" === a || "numberFormat" === a) {
                var c =
                    this._parse(this.element.val()); this.options[a] = h; this.element.val(this._format(c))
            } else "max" !== a && "min" !== a && "step" !== a || "string" !== typeof h || (h = this._parse(h)), "icons" === a && (this.buttons.first().find(".ui-icon").removeClass(this.options.icons.up).addClass(h.up), this.buttons.last().find(".ui-icon").removeClass(this.options.icons.down).addClass(h.down)), this._super(a, h), "disabled" === a && (h ? (this.element.prop("disabled", !0), this.buttons.button("disable")) : (this.element.prop("disabled", !1), this.buttons.button("enable")))
        },
        _setOptions: l(function (a) { this._super(a); this._value(this.element.val()) }), _parse: function (a) { "string" === typeof a && "" !== a && (a = window.Globalize && this.options.numberFormat ? Globalize.parseFloat(a, 10, this.options.culture) : +a); return "" === a || isNaN(a) ? null : a }, _format: function (a) { return "" === a ? "" : window.Globalize && this.options.numberFormat ? Globalize.format(a, this.options.numberFormat, this.options.culture) : a }, _refresh: function () {
            this.element.attr({
                "aria-valuemin": this.options.min, "aria-valuemax": this.options.max,
                "aria-valuenow": this._parse(this.element.val())
            })
        }, _value: function (a, h) { var c; "" !== a && (c = this._parse(a), null !== c && (h || (c = this._adjustValue(c)), a = this._format(c))); this.element.val(a); this._refresh() }, _destroy: function () { this.element.removeClass("ui-spinner-input").prop("disabled", !1).removeAttr("autocomplete").removeAttr("role").removeAttr("aria-valuemin").removeAttr("aria-valuemax").removeAttr("aria-valuenow"); this.uiSpinner.replaceWith(this.element) }, stepUp: l(function (a) { this._stepUp(a) }), _stepUp: function (a) {
            this._start() &&
            (this._spin((a || 1) * this.options.step), this._stop())
        }, stepDown: l(function (a) { this._stepDown(a) }), _stepDown: function (a) { this._start() && (this._spin((a || 1) * -this.options.step), this._stop()) }, pageUp: l(function (a) { this._stepUp((a || 1) * this.options.page) }), pageDown: l(function (a) { this._stepDown((a || 1) * this.options.page) }), value: function (a) { if (!arguments.length) return this._parse(this.element.val()); l(this._value).call(this, a) }, widget: function () { return this.uiSpinner }
    })
})(jQuery);
(function (a, l) {
    function e(a) { return 1 < a.hash.length && decodeURIComponent(a.href.replace(c, "")) === decodeURIComponent(location.href.replace(c, "")) } var h = 0, c = /#.*$/; a.widget("ui.tabs", {
        version: "1.10.3", delay: 300, options: { active: null, collapsible: !1, event: "click", heightStyle: "content", hide: null, show: null, activate: null, beforeActivate: null, beforeLoad: null, load: null }, _create: function () {
            var c = this, b = this.options; this.running = !1; this.element.addClass("ui-tabs ui-widget ui-widget-content ui-corner-all").toggleClass("ui-tabs-collapsible",
                b.collapsible).delegate(".ui-tabs-nav \x3e li", "mousedown" + this.eventNamespace, function (b) { a(this).is(".ui-state-disabled") && b.preventDefault() }).delegate(".ui-tabs-anchor", "focus" + this.eventNamespace, function () { a(this).closest("li").is(".ui-state-disabled") && this.blur() }); this._processTabs(); b.active = this._initialActive(); a.isArray(b.disabled) && (b.disabled = a.unique(b.disabled.concat(a.map(this.tabs.filter(".ui-state-disabled"), function (a) { return c.tabs.index(a) }))).sort()); this.active = !1 !== this.options.active &&
                    this.anchors.length ? this._findActive(b.active) : a(); this._refresh(); this.active.length && this.load(b.active)
        }, _initialActive: function () {
            var c = this.options.active, b = this.options.collapsible, f = location.hash.substring(1); null === c && (f && this.tabs.each(function (b, e) { if (a(e).attr("aria-controls") === f) return c = b, !1 }), null === c && (c = this.tabs.index(this.tabs.filter(".ui-tabs-active"))), null === c || -1 === c) && (c = this.tabs.length ? 0 : !1); !1 !== c && (c = this.tabs.index(this.tabs.eq(c)), -1 === c && (c = b ? !1 : 0)); !b && !1 === c && this.anchors.length &&
                (c = 0); return c
        }, _getCreateEventData: function () { return { tab: this.active, panel: this.active.length ? this._getPanelForTab(this.active) : a() } }, _tabKeydown: function (c) {
            var b = a(this.document[0].activeElement).closest("li"), f = this.tabs.index(b), e = !0; if (!this._handlePageNav(c)) {
                switch (c.keyCode) {
                    case a.ui.keyCode.RIGHT: case a.ui.keyCode.DOWN: f++; break; case a.ui.keyCode.UP: case a.ui.keyCode.LEFT: e = !1; f--; break; case a.ui.keyCode.END: f = this.anchors.length - 1; break; case a.ui.keyCode.HOME: f = 0; break; case a.ui.keyCode.SPACE: c.preventDefault();
                        clearTimeout(this.activating); this._activate(f); return; case a.ui.keyCode.ENTER: c.preventDefault(); clearTimeout(this.activating); this._activate(f === this.options.active ? !1 : f); return; default: return
                }c.preventDefault(); clearTimeout(this.activating); f = this._focusNextTab(f, e); c.ctrlKey || (b.attr("aria-selected", "false"), this.tabs.eq(f).attr("aria-selected", "true"), this.activating = this._delay(function () { this.option("active", f) }, this.delay))
            }
        }, _panelKeydown: function (c) {
            !this._handlePageNav(c) && c.ctrlKey && c.keyCode ===
                a.ui.keyCode.UP && (c.preventDefault(), this.active.focus())
        }, _handlePageNav: function (c) { if (c.altKey && c.keyCode === a.ui.keyCode.PAGE_UP) return this._activate(this._focusNextTab(this.options.active - 1, !1)), !0; if (c.altKey && c.keyCode === a.ui.keyCode.PAGE_DOWN) return this._activate(this._focusNextTab(this.options.active + 1, !0)), !0 }, _findNextTab: function (c, b) { function f() { c > e && (c = 0); 0 > c && (c = e); return c } for (var e = this.tabs.length - 1; -1 !== a.inArray(f(), this.options.disabled);)c = b ? c + 1 : c - 1; return c }, _focusNextTab: function (a,
            b) { a = this._findNextTab(a, b); this.tabs.eq(a).focus(); return a }, _setOption: function (a, b) { "active" === a ? this._activate(b) : "disabled" === a ? this._setupDisabled(b) : (this._super(a, b), "collapsible" === a && (this.element.toggleClass("ui-tabs-collapsible", b), b || !1 !== this.options.active || this._activate(0)), "event" === a && this._setupEvents(b), "heightStyle" === a && this._setupHeightStyle(b)) }, _tabId: function (a) { return a.attr("aria-controls") || "ui-tabs-" + ++h }, _sanitizeSelector: function (a) {
                return a ? a.replace(/[!"$%&'()*+,.\/:;<=>?@\[\]\^`{|}~]/g,
                    "\\$\x26") : ""
            }, refresh: function () { var c = this.options, b = this.tablist.children(":has(a[href])"); c.disabled = a.map(b.filter(".ui-state-disabled"), function (a) { return b.index(a) }); this._processTabs(); !1 !== c.active && this.anchors.length ? this.active.length && !a.contains(this.tablist[0], this.active[0]) ? this.tabs.length === c.disabled.length ? (c.active = !1, this.active = a()) : this._activate(this._findNextTab(Math.max(0, c.active - 1), !1)) : c.active = this.tabs.index(this.active) : (c.active = !1, this.active = a()); this._refresh() },
        _refresh: function () {
            this._setupDisabled(this.options.disabled); this._setupEvents(this.options.event); this._setupHeightStyle(this.options.heightStyle); this.tabs.not(this.active).attr({ "aria-selected": "false", tabIndex: -1 }); this.panels.not(this._getPanelForTab(this.active)).hide().attr({ "aria-expanded": "false", "aria-hidden": "true" }); this.active.length ? (this.active.addClass("ui-tabs-active ui-state-active").attr({ "aria-selected": "true", tabIndex: 0 }), this._getPanelForTab(this.active).show().attr({
                "aria-expanded": "true",
                "aria-hidden": "false"
            })) : this.tabs.eq(0).attr("tabIndex", 0)
        }, _processTabs: function () {
            var c = this; this.tablist = this._getList().addClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").attr("role", "tablist"); this.tabs = this.tablist.find("\x3e li:has(a[href])").addClass("ui-state-default ui-corner-top").attr({ role: "tab", tabIndex: -1 }); this.anchors = this.tabs.map(function () { return a("a", this)[0] }).addClass("ui-tabs-anchor").attr({ role: "presentation", tabIndex: -1 }); this.panels =
                a(); this.anchors.each(function (b, f) { var m, k, h, l = a(f).uniqueId().attr("id"), t = a(f).closest("li"), s = t.attr("aria-controls"); e(f) ? (m = f.hash, k = c.element.find(c._sanitizeSelector(m))) : (h = c._tabId(t), m = "#" + h, k = c.element.find(m), k.length || (k = c._createPanel(h), k.insertAfter(c.panels[b - 1] || c.tablist)), k.attr("aria-live", "polite")); k.length && (c.panels = c.panels.add(k)); s && t.data("ui-tabs-aria-controls", s); t.attr({ "aria-controls": m.substring(1), "aria-labelledby": l }); k.attr("aria-labelledby", l) }); this.panels.addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").attr("role",
                    "tabpanel")
        }, _getList: function () { return this.element.find("ol,ul").eq(0) }, _createPanel: function (c) { return a("\x3cdiv\x3e").attr("id", c).addClass("ui-tabs-panel ui-widget-content ui-corner-bottom").data("ui-tabs-destroy", !0) }, _setupDisabled: function (c) {
            a.isArray(c) && (c.length ? c.length === this.anchors.length && (c = !0) : c = !1); for (var b = 0, f; f = this.tabs[b]; b++)!0 === c || -1 !== a.inArray(b, c) ? a(f).addClass("ui-state-disabled").attr("aria-disabled", "true") : a(f).removeClass("ui-state-disabled").removeAttr("aria-disabled");
            this.options.disabled = c
        }, _setupEvents: function (c) { var b = { click: function (a) { a.preventDefault() } }; c && a.each(c.split(" "), function (a, c) { b[c] = "_eventHandler" }); this._off(this.anchors.add(this.tabs).add(this.panels)); this._on(this.anchors, b); this._on(this.tabs, { keydown: "_tabKeydown" }); this._on(this.panels, { keydown: "_panelKeydown" }); this._focusable(this.tabs); this._hoverable(this.tabs) }, _setupHeightStyle: function (c) {
            var b, f = this.element.parent(); "fill" === c ? (b = f.height(), b -= this.element.outerHeight() - this.element.height(),
                this.element.siblings(":visible").each(function () { var c = a(this), d = c.css("position"); "absolute" !== d && "fixed" !== d && (b -= c.outerHeight(!0)) }), this.element.children().not(this.panels).each(function () { b -= a(this).outerHeight(!0) }), this.panels.each(function () { a(this).height(Math.max(0, b - a(this).innerHeight() + a(this).height())) }).css("overflow", "auto")) : "auto" === c && (b = 0, this.panels.each(function () { b = Math.max(b, a(this).height("").height()) }).height(b))
        }, _eventHandler: function (c) {
            var b = this.options, f = this.active,
            e = a(c.currentTarget).closest("li"), k = e[0] === f[0], h = k && b.collapsible, l = h ? a() : this._getPanelForTab(e), t = f.length ? this._getPanelForTab(f) : a(), f = { oldTab: f, oldPanel: t, newTab: h ? a() : e, newPanel: l }; c.preventDefault(); e.hasClass("ui-state-disabled") || e.hasClass("ui-tabs-loading") || this.running || k && !b.collapsible || !1 === this._trigger("beforeActivate", c, f) || (b.active = h ? !1 : this.tabs.index(e), this.active = k ? a() : e, this.xhr && this.xhr.abort(), t.length || l.length || a.error("jQuery UI Tabs: Mismatching fragment identifier."),
                l.length && this.load(this.tabs.index(e), c), this._toggle(c, f))
        }, _toggle: function (c, b) {
            function f() { k.running = !1; k._trigger("activate", c, b) } function e() { b.newTab.closest("li").addClass("ui-tabs-active ui-state-active"); h.length && k.options.show ? k._show(h, k.options.show, f) : (h.show(), f()) } var k = this, h = b.newPanel, l = b.oldPanel; this.running = !0; l.length && this.options.hide ? this._hide(l, this.options.hide, function () { b.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"); e() }) : (b.oldTab.closest("li").removeClass("ui-tabs-active ui-state-active"),
                l.hide(), e()); l.attr({ "aria-expanded": "false", "aria-hidden": "true" }); b.oldTab.attr("aria-selected", "false"); h.length && l.length ? b.oldTab.attr("tabIndex", -1) : h.length && this.tabs.filter(function () { return 0 === a(this).attr("tabIndex") }).attr("tabIndex", -1); h.attr({ "aria-expanded": "true", "aria-hidden": "false" }); b.newTab.attr({ "aria-selected": "true", tabIndex: 0 })
        }, _activate: function (c) {
            c = this._findActive(c); c[0] !== this.active[0] && (c.length || (c = this.active), c = c.find(".ui-tabs-anchor")[0], this._eventHandler({
                target: c,
                currentTarget: c, preventDefault: a.noop
            }))
        }, _findActive: function (c) { return !1 === c ? a() : this.tabs.eq(c) }, _getIndex: function (a) { "string" === typeof a && (a = this.anchors.index(this.anchors.filter("[href$\x3d'" + a + "']"))); return a }, _destroy: function () {
            this.xhr && this.xhr.abort(); this.element.removeClass("ui-tabs ui-widget ui-widget-content ui-corner-all ui-tabs-collapsible"); this.tablist.removeClass("ui-tabs-nav ui-helper-reset ui-helper-clearfix ui-widget-header ui-corner-all").removeAttr("role"); this.anchors.removeClass("ui-tabs-anchor").removeAttr("role").removeAttr("tabIndex").removeUniqueId();
            this.tabs.add(this.panels).each(function () { a.data(this, "ui-tabs-destroy") ? a(this).remove() : a(this).removeClass("ui-state-default ui-state-active ui-state-disabled ui-corner-top ui-corner-bottom ui-widget-content ui-tabs-active ui-tabs-panel").removeAttr("tabIndex").removeAttr("aria-live").removeAttr("aria-busy").removeAttr("aria-selected").removeAttr("aria-labelledby").removeAttr("aria-hidden").removeAttr("aria-expanded").removeAttr("role") }); this.tabs.each(function () {
                var c = a(this), b = c.data("ui-tabs-aria-controls");
                b ? c.attr("aria-controls", b).removeData("ui-tabs-aria-controls") : c.removeAttr("aria-controls")
            }); this.panels.show(); "content" !== this.options.heightStyle && this.panels.css("height", "")
        }, enable: function (c) { var b = this.options.disabled; !1 !== b && (c === l ? b = !1 : (c = this._getIndex(c), b = a.isArray(b) ? a.map(b, function (a) { return a !== c ? a : null }) : a.map(this.tabs, function (a, b) { return b !== c ? b : null })), this._setupDisabled(b)) }, disable: function (c) {
            var b = this.options.disabled; if (!0 !== b) {
                if (c === l) b = !0; else {
                    c = this._getIndex(c);
                    if (-1 !== a.inArray(c, b)) return; b = a.isArray(b) ? a.merge([c], b).sort() : [c]
                } this._setupDisabled(b)
            }
        }, load: function (c, b) {
            c = this._getIndex(c); var f = this, m = this.tabs.eq(c), k = m.find(".ui-tabs-anchor"), h = this._getPanelForTab(m), l = { tab: m, panel: h }; e(k[0]) || (this.xhr = a.ajax(this._ajaxSettings(k, b, l))) && "canceled" !== this.xhr.statusText && (m.addClass("ui-tabs-loading"), h.attr("aria-busy", "true"), this.xhr.success(function (a) { setTimeout(function () { h.html(a); f._trigger("load", b, l) }, 1) }).complete(function (a, b) {
                setTimeout(function () {
                    "abort" ===
                    b && f.panels.stop(!1, !0); m.removeClass("ui-tabs-loading"); h.removeAttr("aria-busy"); a === f.xhr && delete f.xhr
                }, 1)
            }))
        }, _ajaxSettings: function (c, b, f) { var e = this; return { url: c.attr("href"), beforeSend: function (c, d) { return e._trigger("beforeLoad", b, a.extend({ jqXHR: c, ajaxSettings: d }, f)) } } }, _getPanelForTab: function (c) { c = a(c).attr("aria-controls"); return this.element.find(this._sanitizeSelector("#" + c)) }
    })
})(jQuery);
(function (a) {
    function l(c, d) { var b = (c.attr("aria-describedby") || "").split(/\s+/); b.push(d); c.data("ui-tooltip-id", d).attr("aria-describedby", a.trim(b.join(" "))) } function e(c) { var d = c.data("ui-tooltip-id"), b = (c.attr("aria-describedby") || "").split(/\s+/), d = a.inArray(d, b); -1 !== d && b.splice(d, 1); c.removeData("ui-tooltip-id"); (b = a.trim(b.join(" "))) ? c.attr("aria-describedby", b) : c.removeAttr("aria-describedby") } var h = 0; a.widget("ui.tooltip", {
        version: "1.10.3", options: {
            content: function () {
                var c = a(this).attr("title") ||
                    ""; return a("\x3ca\x3e").text(c).html()
            }, hide: !0, items: "[title]:not([disabled])", position: { my: "left top+15", at: "left bottom", collision: "flipfit flip" }, show: !0, tooltipClass: null, track: !1, close: null, open: null
        }, _create: function () { this._on({ mouseover: "open", focusin: "open" }); this.tooltips = {}; this.parents = {}; this.options.disabled && this._disable() }, _setOption: function (c, d) {
            var b = this; "disabled" === c ? (this[d ? "_disable" : "_enable"](), this.options[c] = d) : (this._super(c, d), "content" === c && a.each(this.tooltips, function (a,
                c) { b._updateContent(c) }))
        }, _disable: function () { var c = this; a.each(this.tooltips, function (d, b) { var f = a.Event("blur"); f.target = f.currentTarget = b[0]; c.close(f, !0) }); this.element.find(this.options.items).addBack().each(function () { var c = a(this); c.is("[title]") && c.data("ui-tooltip-title", c.attr("title")).attr("title", "") }) }, _enable: function () { this.element.find(this.options.items).addBack().each(function () { var c = a(this); c.data("ui-tooltip-title") && c.attr("title", c.data("ui-tooltip-title")) }) }, open: function (c) {
            var d =
                this, b = a(c ? c.target : this.element).closest(this.options.items); b.length && !b.data("ui-tooltip-id") && (b.attr("title") && b.data("ui-tooltip-title", b.attr("title")), b.data("ui-tooltip-open", !0), c && "mouseover" === c.type && b.parents().each(function () { var b = a(this), c; b.data("ui-tooltip-open") && (c = a.Event("blur"), c.target = c.currentTarget = this, d.close(c, !0)); b.attr("title") && (b.uniqueId(), d.parents[this.id] = { element: this, title: b.attr("title") }, b.attr("title", "")) }), this._updateContent(b, c))
        }, _updateContent: function (a,
            d) { var b; b = this.options.content; var f = this, e = d ? d.type : null; if ("string" === typeof b) return this._open(d, a, b); (b = b.call(a[0], function (b) { a.data("ui-tooltip-open") && f._delay(function () { d && (d.type = e); this._open(d, a, b) }) })) && this._open(d, a, b) }, _open: function (c, d, b) {
                function f(a) { h.of = a; e.is(":hidden") || e.position(h) } var e, k, h = a.extend({}, this.options.position); b && (e = this._find(d), e.length ? e.find(".ui-tooltip-content").html(b) : (d.is("[title]") && (c && "mouseover" === c.type ? d.attr("title", "") : d.removeAttr("title")),
                    e = this._tooltip(d), l(d, e.attr("id")), e.find(".ui-tooltip-content").html(b), this.options.track && c && /^mouse/.test(c.type) ? (this._on(this.document, { mousemove: f }), f(c)) : e.position(a.extend({ of: d }, this.options.position)), e.hide(), this._show(e, this.options.show), this.options.show && this.options.show.delay && (k = this.delayedShow = setInterval(function () { e.is(":visible") && (f(h.of), clearInterval(k)) }, a.fx.interval)), this._trigger("open", c, { tooltip: e }), b = {
                        keyup: function (b) {
                            b.keyCode === a.ui.keyCode.ESCAPE && (b = a.Event(b),
                                b.currentTarget = d[0], this.close(b, !0))
                        }, remove: function () { this._removeTooltip(e) }
                    }, c && "mouseover" !== c.type || (b.mouseleave = "close"), c && "focusin" !== c.type || (b.focusout = "close"), this._on(!0, d, b)))
            }, close: function (c) {
                var d = this, b = a(c ? c.currentTarget : this.element), f = this._find(b); this.closing || (clearInterval(this.delayedShow), b.data("ui-tooltip-title") && b.attr("title", b.data("ui-tooltip-title")), e(b), f.stop(!0), this._hide(f, this.options.hide, function () { d._removeTooltip(a(this)) }), b.removeData("ui-tooltip-open"),
                    this._off(b, "mouseleave focusout keyup"), b[0] !== this.element[0] && this._off(b, "remove"), this._off(this.document, "mousemove"), c && "mouseleave" === c.type && a.each(this.parents, function (b, c) { a(c.element).attr("title", c.title); delete d.parents[b] }), this.closing = !0, this._trigger("close", c, { tooltip: f }), this.closing = !1)
            }, _tooltip: function (c) {
                var d = "ui-tooltip-" + h++, b = a("\x3cdiv\x3e").attr({ id: d, role: "tooltip" }).addClass("ui-tooltip ui-widget ui-corner-all ui-widget-content " + (this.options.tooltipClass || ""));
                a("\x3cdiv\x3e").addClass("ui-tooltip-content").appendTo(b); b.appendTo(this.document[0].body); this.tooltips[d] = c; return b
            }, _find: function (c) { return (c = c.data("ui-tooltip-id")) ? a("#" + c) : a() }, _removeTooltip: function (a) { a.remove(); delete this.tooltips[a.attr("id")] }, _destroy: function () { var c = this; a.each(this.tooltips, function (d, b) { var f = a.Event("blur"); f.target = f.currentTarget = b[0]; c.close(f, !0); a("#" + d).remove(); b.data("ui-tooltip-title") && (b.attr("title", b.data("ui-tooltip-title")), b.removeData("ui-tooltip-title")) }) }
    })
})(jQuery);
(function (a, l) {
    a.effects = { effect: {} }; (function (a, h) {
        function c(a, b, c) { var d = l[b.type] || {}; if (null == a) return c || !b.def ? null : b.def; a = d.floor ? ~~a : parseFloat(a); return isNaN(a) ? b.def : d.mod ? (a + d.mod) % d.mod : 0 > a ? 0 : d.max < a ? d.max : a } function d(b) { var c = k(), d = c._rgba = []; b = b.toLowerCase(); y(m, function (a, f) { var e, k = f.re.exec(b); e = k && f.parse(k); k = f.space || "rgba"; if (e) return e = c[k](e), c[r[k].cache] = e[r[k].cache], d = c._rgba = e._rgba, !1 }); return d.length ? ("0,0,0,0" === d.join() && a.extend(d, v.transparent), c) : v[b] } function b(a,
            b, c) { c = (c + 1) % 1; return 1 > 6 * c ? a + 6 * (b - a) * c : 1 > 2 * c ? b : 2 > 3 * c ? a + 6 * (b - a) * (2 / 3 - c) : a } var f = /^([\-+])=\s*(\d+\.?\d*)/, m = [{ re: /rgba?\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/, parse: function (a) { return [a[1], a[2], a[3], a[4]] } }, { re: /rgba?\(\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/, parse: function (a) { return [2.55 * a[1], 2.55 * a[2], 2.55 * a[3], a[4]] } }, {
                re: /#([a-f0-9]{2})([a-f0-9]{2})([a-f0-9]{2})/, parse: function (a) {
                    return [parseInt(a[1],
                        16), parseInt(a[2], 16), parseInt(a[3], 16)]
                }
            }, { re: /#([a-f0-9])([a-f0-9])([a-f0-9])/, parse: function (a) { return [parseInt(a[1] + a[1], 16), parseInt(a[2] + a[2], 16), parseInt(a[3] + a[3], 16)] } }, { re: /hsla?\(\s*(\d+(?:\.\d+)?)\s*,\s*(\d+(?:\.\d+)?)\%\s*,\s*(\d+(?:\.\d+)?)\%\s*(?:,\s*(\d?(?:\.\d+)?)\s*)?\)/, space: "hsla", parse: function (a) { return [a[1], a[2] / 100, a[3] / 100, a[4]] } }], k = a.Color = function (b, c, d, f) { return new a.Color.fn.parse(b, c, d, f) }, r = {
                rgba: {
                    props: {
                        red: { idx: 0, type: "byte" }, green: { idx: 1, type: "byte" }, blue: {
                            idx: 2,
                            type: "byte"
                        }
                    }
                }, hsla: { props: { hue: { idx: 0, type: "degrees" }, saturation: { idx: 1, type: "percent" }, lightness: { idx: 2, type: "percent" } } }
            }, l = { "byte": { floor: !0, max: 255 }, percent: { max: 1 }, degrees: { mod: 360, floor: !0 } }, t = k.support = {}, s = a("\x3cp\x3e")[0], v, y = a.each; s.style.cssText = "background-color:rgba(1,1,1,.5)"; t.rgba = -1 < s.style.backgroundColor.indexOf("rgba"); y(r, function (a, b) { b.cache = "_" + a; b.props.alpha = { idx: 3, type: "percent", def: 1 } }); k.fn = a.extend(k.prototype, {
                parse: function (b, f, q, m) {
                    if (b === h) return this._rgba = [null,
                        null, null, null], this; if (b.jquery || b.nodeType) b = a(b).css(f), f = h; var x = this, l = a.type(b), A = this._rgba = []; f !== h && (b = [b, f, q, m], l = "array"); if ("string" === l) return this.parse(d(b) || v._default); if ("array" === l) return y(r.rgba.props, function (a, d) { A[d.idx] = c(b[d.idx], d) }), this; if ("object" === l) return b instanceof k ? y(r, function (a, c) { b[c.cache] && (x[c.cache] = b[c.cache].slice()) }) : y(r, function (d, f) {
                            var k = f.cache; y(f.props, function (a, d) {
                                if (!x[k] && f.to) { if ("alpha" === a || null == b[a]) return; x[k] = f.to(x._rgba) } x[k][d.idx] =
                                    c(b[a], d, !0)
                            }); x[k] && 0 > a.inArray(null, x[k].slice(0, 3)) && (x[k][3] = 1, f.from && (x._rgba = f.from(x[k])))
                        }), this
                }, is: function (a) { var b = k(a), c = !0, d = this; y(r, function (a, g) { var f, e = b[g.cache]; e && (f = d[g.cache] || g.to && g.to(d._rgba) || [], y(g.props, function (a, b) { if (null != e[b.idx]) return c = e[b.idx] === f[b.idx] })); return c }); return c }, _space: function () { var a = [], b = this; y(r, function (c, d) { b[d.cache] && a.push(c) }); return a.pop() }, transition: function (a, b) {
                    var d = k(a), f = d._space(), e = r[f], m = 0 === this.alpha() ? k("transparent") :
                        this, h = m[e.cache] || e.to(m._rgba), t = h.slice(), d = d[e.cache]; y(e.props, function (a, g) { var f = g.idx, e = h[f], k = d[f], m = l[g.type] || {}; null !== k && (null === e ? t[f] = k : (m.mod && (k - e > m.mod / 2 ? e += m.mod : e - k > m.mod / 2 && (e -= m.mod)), t[f] = c((k - e) * b + e, g))) }); return this[f](t)
                }, blend: function (b) { if (1 === this._rgba[3]) return this; var c = this._rgba.slice(), d = c.pop(), f = k(b)._rgba; return k(a.map(c, function (a, b) { return (1 - d) * f[b] + d * a })) }, toRgbaString: function () {
                    var b = "rgba(", c = a.map(this._rgba, function (a, b) { return null == a ? 2 < b ? 1 : 0 : a });
                    1 === c[3] && (c.pop(), b = "rgb("); return b + c.join() + ")"
                }, toHslaString: function () { var b = "hsla(", c = a.map(this.hsla(), function (a, b) { null == a && (a = 2 < b ? 1 : 0); b && 3 > b && (a = Math.round(100 * a) + "%"); return a }); 1 === c[3] && (c.pop(), b = "hsl("); return b + c.join() + ")" }, toHexString: function (b) { var c = this._rgba.slice(), d = c.pop(); b && c.push(~~(255 * d)); return "#" + a.map(c, function (a) { a = (a || 0).toString(16); return 1 === a.length ? "0" + a : a }).join("") }, toString: function () { return 0 === this._rgba[3] ? "transparent" : this.toRgbaString() }
            }); k.fn.parse.prototype =
                k.fn; r.hsla.to = function (a) { if (null == a[0] || null == a[1] || null == a[2]) return [null, null, null, a[3]]; var b = a[0] / 255, c = a[1] / 255, d = a[2] / 255; a = a[3]; var f = Math.max(b, c, d), e = Math.min(b, c, d), k = f - e, m = f + e, h = 0.5 * m, m = 0 === k ? 0 : 0.5 >= h ? k / m : k / (2 - m); return [Math.round(e === f ? 0 : b === f ? 60 * (c - d) / k + 360 : c === f ? 60 * (d - b) / k + 120 : 60 * (b - c) / k + 240) % 360, m, h, null == a ? 1 : a] }; r.hsla.from = function (a) {
                    if (null == a[0] || null == a[1] || null == a[2]) return [null, null, null, a[3]]; var c = a[0] / 360, d = a[1], f = a[2]; a = a[3]; d = 0.5 >= f ? f * (1 + d) : f + d - f * d; f = 2 * f - d; return [Math.round(255 *
                        b(f, d, c + 1 / 3)), Math.round(255 * b(f, d, c)), Math.round(255 * b(f, d, c - 1 / 3)), a]
                }; y(r, function (b, d) {
                    var q = d.props, m = d.cache, x = d.to, r = d.from; k.fn[b] = function (b) { x && !this[m] && (this[m] = x(this._rgba)); if (b === h) return this[m].slice(); var g, d = a.type(b), f = "array" === d || "object" === d ? b : arguments, u = this[m].slice(); y(q, function (a, b) { var g = f["object" === d ? a : b.idx]; null == g && (g = u[b.idx]); u[b.idx] = c(g, b) }); return r ? (g = k(r(u)), g[m] = u, g) : k(u) }; y(q, function (c, d) {
                        k.fn[c] || (k.fn[c] = function (k) {
                            var q = a.type(k), m = "alpha" === c ? this._hsla ?
                                "hsla" : "rgba" : b, h = this[m](), u = h[d.idx]; if ("undefined" === q) return u; "function" === q && (k = k.call(this, u), q = a.type(k)); if (null == k && d.empty) return this; "string" === q && (q = f.exec(k)) && (k = u + parseFloat(q[2]) * ("+" === q[1] ? 1 : -1)); h[d.idx] = k; return this[m](h)
                        })
                    })
                }); k.hook = function (b) {
                    b = b.split(" "); y(b, function (b, c) {
                        a.cssHooks[c] = {
                            set: function (b, g) {
                                var f, m = ""; if ("transparent" !== g && ("string" !== a.type(g) || (f = d(g)))) {
                                    g = k(f || g); if (!t.rgba && 1 !== g._rgba[3]) {
                                        for (f = "backgroundColor" === c ? b.parentNode : b; ("" === m || "transparent" ===
                                            m) && f && f.style;)try { m = a.css(f, "backgroundColor"), f = f.parentNode } catch (h) { } g = g.blend(m && "transparent" !== m ? m : "_default")
                                    } g = g.toRgbaString()
                                } try { b.style[c] = g } catch (u) { }
                            }
                        }; a.fx.step[c] = function (b) { b.colorInit || (b.start = k(b.elem, c), b.end = k(b.end), b.colorInit = !0); a.cssHooks[c].set(b.elem, b.start.transition(b.end, b.pos)) }
                    })
                }; k.hook("backgroundColor borderBottomColor borderLeftColor borderRightColor borderTopColor color columnRuleColor outlineColor textDecorationColor textEmphasisColor"); a.cssHooks.borderColor =
                    { expand: function (a) { var b = {}; y(["Top", "Right", "Bottom", "Left"], function (c, d) { b["border" + d + "Color"] = a }); return b } }; v = a.Color.names = { aqua: "#00ffff", black: "#000000", blue: "#0000ff", fuchsia: "#ff00ff", gray: "#808080", green: "#008000", lime: "#00ff00", maroon: "#800000", navy: "#000080", olive: "#808000", purple: "#800080", red: "#ff0000", silver: "#c0c0c0", teal: "#008080", white: "#ffffff", yellow: "#ffff00", transparent: [null, null, null, 0], _default: "#ffffff" }
    })(jQuery); (function () {
        function e(c) {
            var b, f = c.ownerDocument.defaultView ?
                c.ownerDocument.defaultView.getComputedStyle(c, null) : c.currentStyle, e = {}; if (f && f.length && f[0] && f[f[0]]) for (c = f.length; c--;)b = f[c], "string" === typeof f[b] && (e[a.camelCase(b)] = f[b]); else for (b in f) "string" === typeof f[b] && (e[b] = f[b]); return e
        } var h = ["add", "remove", "toggle"], c = { border: 1, borderBottom: 1, borderColor: 1, borderLeft: 1, borderRight: 1, borderTop: 1, borderWidth: 1, margin: 1, padding: 1 }; a.each(["borderLeftStyle", "borderRightStyle", "borderBottomStyle", "borderTopStyle"], function (c, b) {
            a.fx.step[b] = function (a) {
                if ("none" !==
                    a.end && !a.setAttr || 1 === a.pos && !a.setAttr) jQuery.style(a.elem, b, a.end), a.setAttr = !0
            }
        }); a.fn.addBack || (a.fn.addBack = function (a) { return this.add(null == a ? this.prevObject : this.prevObject.filter(a)) }); a.effects.animateClass = function (d, b, f, m) {
            var k = a.speed(b, f, m); return this.queue(function () {
                var b = a(this), f = b.attr("class") || "", m, l = k.children ? b.find("*").addBack() : b, l = l.map(function () { return { el: a(this), start: e(this) } }); m = function () { a.each(h, function (a, c) { if (d[c]) b[c + "Class"](d[c]) }) }; m(); l = l.map(function () {
                    this.end =
                    e(this.el[0]); var b = this.start, d = this.end, g = {}, f, k; for (f in d) k = d[f], b[f] === k || c[f] || !a.fx.step[f] && isNaN(parseFloat(k)) || (g[f] = k); this.diff = g; return this
                }); b.attr("class", f); l = l.map(function () { var b = this, c = a.Deferred(), g = a.extend({}, k, { queue: !1, complete: function () { c.resolve(b) } }); this.el.animate(this.diff, g); return c.promise() }); a.when.apply(a, l.get()).done(function () { m(); a.each(arguments, function () { var b = this.el; a.each(this.diff, function (a) { b.css(a, "") }) }); k.complete.call(b[0]) })
            })
        }; a.fn.extend({
            addClass: function (c) {
                return function (b,
                    f, e, k) { return f ? a.effects.animateClass.call(this, { add: b }, f, e, k) : c.apply(this, arguments) }
            }(a.fn.addClass), removeClass: function (c) { return function (b, f, e, k) { return 1 < arguments.length ? a.effects.animateClass.call(this, { remove: b }, f, e, k) : c.apply(this, arguments) } }(a.fn.removeClass), toggleClass: function (c) { return function (b, f, e, k, h) { return "boolean" === typeof f || f === l ? e ? a.effects.animateClass.call(this, f ? { add: b } : { remove: b }, e, k, h) : c.apply(this, arguments) : a.effects.animateClass.call(this, { toggle: b }, f, e, k) } }(a.fn.toggleClass),
            switchClass: function (c, b, f, e, k) { return a.effects.animateClass.call(this, { add: b, remove: c }, f, e, k) }
        })
    })(); (function () {
        function e(c, d, b, f) { a.isPlainObject(c) && (d = c, c = c.effect); c = { effect: c }; null == d && (d = {}); a.isFunction(d) && (f = d, b = null, d = {}); if ("number" === typeof d || a.fx.speeds[d]) f = b, b = d, d = {}; a.isFunction(b) && (f = b, b = null); d && a.extend(c, d); b = b || d.duration; c.duration = a.fx.off ? 0 : "number" === typeof b ? b : b in a.fx.speeds ? a.fx.speeds[b] : a.fx.speeds._default; c.complete = f || d.complete; return c } function h(c) {
            return !c ||
                "number" === typeof c || a.fx.speeds[c] || "string" === typeof c && !a.effects.effect[c] || a.isFunction(c) || "object" === typeof c && !c.effect ? !0 : !1
        } a.extend(a.effects, {
            version: "1.10.3", save: function (a, d) { for (var b = 0; b < d.length; b++)null !== d[b] && a.data("ui-effects-" + d[b], a[0].style[d[b]]) }, restore: function (a, d) { var b, f; for (f = 0; f < d.length; f++)null !== d[f] && (b = a.data("ui-effects-" + d[f]), b === l && (b = ""), a.css(d[f], b)) }, setMode: function (a, d) { "toggle" === d && (d = a.is(":hidden") ? "show" : "hide"); return d }, getBaseline: function (a,
                d) { var b, f; switch (a[0]) { case "top": b = 0; break; case "middle": b = 0.5; break; case "bottom": b = 1; break; default: b = a[0] / d.height }switch (a[1]) { case "left": f = 0; break; case "center": f = 0.5; break; case "right": f = 1; break; default: f = a[1] / d.width }return { x: f, y: b } }, createWrapper: function (c) {
                    if (c.parent().is(".ui-effects-wrapper")) return c.parent(); var d = { width: c.outerWidth(!0), height: c.outerHeight(!0), "float": c.css("float") }, b = a("\x3cdiv\x3e\x3c/div\x3e").addClass("ui-effects-wrapper").css({
                        fontSize: "100%", background: "transparent",
                        border: "none", margin: 0, padding: 0
                    }), f = { width: c.width(), height: c.height() }, e = document.activeElement; try { e.id } catch (k) { e = document.body } c.wrap(b); (c[0] === e || a.contains(c[0], e)) && a(e).focus(); b = c.parent(); "static" === c.css("position") ? (b.css({ position: "relative" }), c.css({ position: "relative" })) : (a.extend(d, { position: c.css("position"), zIndex: c.css("z-index") }), a.each(["top", "left", "bottom", "right"], function (a, b) { d[b] = c.css(b); isNaN(parseInt(d[b], 10)) && (d[b] = "auto") }), c.css({
                        position: "relative", top: 0, left: 0,
                        right: "auto", bottom: "auto"
                    })); c.css(f); return b.css(d).show()
                }, removeWrapper: function (c) { var d = document.activeElement; c.parent().is(".ui-effects-wrapper") && (c.parent().replaceWith(c), (c[0] === d || a.contains(c[0], d)) && a(d).focus()); return c }, setTransition: function (c, d, b, f) { f = f || {}; a.each(d, function (a, d) { var e = c.cssUnit(d); 0 < e[0] && (f[d] = e[0] * b + e[1]) }); return f }
        }); a.fn.extend({
            effect: function () {
                function c(b) {
                    function c() { a.isFunction(e) && e.call(f[0]); a.isFunction(b) && b() } var f = a(this), e = d.complete, h = d.mode;
                    (f.is(":hidden") ? "hide" === h : "show" === h) ? (f[h](), c()) : m.call(f[0], d, c)
                } var d = e.apply(this, arguments), b = d.mode, f = d.queue, m = a.effects.effect[d.effect]; return a.fx.off || !m ? b ? this[b](d.duration, d.complete) : this.each(function () { d.complete && d.complete.call(this) }) : !1 === f ? this.each(c) : this.queue(f || "fx", c)
            }, show: function (a) { return function (d) { if (h(d)) return a.apply(this, arguments); var b = e.apply(this, arguments); b.mode = "show"; return this.effect.call(this, b) } }(a.fn.show), hide: function (a) {
                return function (d) {
                    if (h(d)) return a.apply(this,
                        arguments); var b = e.apply(this, arguments); b.mode = "hide"; return this.effect.call(this, b)
                }
            }(a.fn.hide), toggle: function (a) { return function (d) { if (h(d) || "boolean" === typeof d) return a.apply(this, arguments); var b = e.apply(this, arguments); b.mode = "toggle"; return this.effect.call(this, b) } }(a.fn.toggle), cssUnit: function (c) { var d = this.css(c), b = []; a.each(["em", "px", "%", "pt"], function (a, c) { 0 < d.indexOf(c) && (b = [parseFloat(d), c]) }); return b }
        })
    })(); (function () {
        var e = {}; a.each(["Quad", "Cubic", "Quart", "Quint", "Expo"],
            function (a, c) { e[c] = function (c) { return Math.pow(c, a + 2) } }); a.extend(e, { Sine: function (a) { return 1 - Math.cos(a * Math.PI / 2) }, Circ: function (a) { return 1 - Math.sqrt(1 - a * a) }, Elastic: function (a) { return 0 === a || 1 === a ? a : -Math.pow(2, 8 * (a - 1)) * Math.sin((80 * (a - 1) - 7.5) * Math.PI / 15) }, Back: function (a) { return a * a * (3 * a - 2) }, Bounce: function (a) { for (var c, d = 4; a < ((c = Math.pow(2, --d)) - 1) / 11;); return 1 / Math.pow(4, 3 - d) - 7.5625 * Math.pow((3 * c - 2) / 22 - a, 2) } }); a.each(e, function (e, c) {
                a.easing["easeIn" + e] = c; a.easing["easeOut" + e] = function (a) {
                    return 1 -
                        c(1 - a)
                }; a.easing["easeInOut" + e] = function (a) { return 0.5 > a ? c(2 * a) / 2 : 1 - c(-2 * a + 2) / 2 }
            })
    })()
})(jQuery);
(function (a, l) {
    var e = /up|down|vertical/, h = /up|left|vertical|horizontal/; a.effects.effect.blind = function (c, d) {
        var b = a(this), f = "position top bottom left right height width".split(" "), m = a.effects.setMode(b, c.mode || "hide"), k = c.direction || "up", r = e.test(k), l = r ? "height" : "width", t = r ? "top" : "left", k = h.test(k), s = {}, v = "show" === m, y, g, u; b.parent().is(".ui-effects-wrapper") ? a.effects.save(b.parent(), f) : a.effects.save(b, f); b.show(); y = a.effects.createWrapper(b).css({ overflow: "hidden" }); g = y[l](); u = parseFloat(y.css(t)) ||
            0; s[l] = v ? g : 0; k || (b.css(r ? "bottom" : "right", 0).css(r ? "top" : "left", "auto").css({ position: "absolute" }), s[t] = v ? u : g + u); v && (y.css(l, 0), k || y.css(t, u + g)); y.animate(s, { duration: c.duration, easing: c.easing, queue: !1, complete: function () { "hide" === m && b.hide(); a.effects.restore(b, f); a.effects.removeWrapper(b); d() } })
    }
})(jQuery);
(function (a, l) {
    a.effects.effect.bounce = function (e, h) {
        var c = a(this), d = "position top bottom left right height width".split(" "), b = a.effects.setMode(c, e.mode || "effect"), f = "hide" === b, m = "show" === b, k = e.direction || "up", b = e.distance, r = e.times || 5, l = 2 * r + (m || f ? 1 : 0), t = e.duration / l, s = e.easing, v = "up" === k || "down" === k ? "top" : "left", k = "up" === k || "left" === k, y, g, u = c.queue(), q = u.length; (m || f) && d.push("opacity"); a.effects.save(c, d); c.show(); a.effects.createWrapper(c); b || (b = c["top" === v ? "outerHeight" : "outerWidth"]() / 3); m &&
            (g = { opacity: 1 }, g[v] = 0, c.css("opacity", 0).css(v, k ? 2 * -b : 2 * b).animate(g, t, s)); f && (b /= Math.pow(2, r - 1)); g = {}; for (m = g[v] = 0; m < r; m++)y = {}, y[v] = (k ? "-\x3d" : "+\x3d") + b, c.animate(y, t, s).animate(g, t, s), b = f ? 2 * b : b / 2; f && (y = { opacity: 0 }, y[v] = (k ? "-\x3d" : "+\x3d") + b, c.animate(y, t, s)); c.queue(function () { f && c.hide(); a.effects.restore(c, d); a.effects.removeWrapper(c); h() }); 1 < q && u.splice.apply(u, [1, 0].concat(u.splice(q, l + 1))); c.dequeue()
    }
})(jQuery);
(function (a, l) {
    a.effects.effect.clip = function (e, h) {
        var c = a(this), d = "position top bottom left right height width".split(" "), b = "show" === a.effects.setMode(c, e.mode || "hide"), f = "vertical" === (e.direction || "vertical"), m = f ? "height" : "width", f = f ? "top" : "left", k = {}, l, z; a.effects.save(c, d); c.show(); l = a.effects.createWrapper(c).css({ overflow: "hidden" }); l = "IMG" === c[0].tagName ? l : c; z = l[m](); b && (l.css(m, 0), l.css(f, z / 2)); k[m] = b ? z : 0; k[f] = b ? 0 : z / 2; l.animate(k, {
            queue: !1, duration: e.duration, easing: e.easing, complete: function () {
                b ||
                c.hide(); a.effects.restore(c, d); a.effects.removeWrapper(c); h()
            }
        })
    }
})(jQuery);
(function (a, l) {
    a.effects.effect.drop = function (e, h) {
        var c = a(this), d = "position top bottom left right opacity height width".split(" "), b = a.effects.setMode(c, e.mode || "hide"), f = "show" === b, m = e.direction || "left", k = "up" === m || "down" === m ? "top" : "left", m = "up" === m || "left" === m ? "pos" : "neg", l = { opacity: f ? 1 : 0 }, z; a.effects.save(c, d); c.show(); a.effects.createWrapper(c); z = e.distance || c["top" === k ? "outerHeight" : "outerWidth"](!0) / 2; f && c.css("opacity", 0).css(k, "pos" === m ? -z : z); l[k] = (f ? "pos" === m ? "+\x3d" : "-\x3d" : "pos" === m ? "-\x3d" :
            "+\x3d") + z; c.animate(l, { queue: !1, duration: e.duration, easing: e.easing, complete: function () { "hide" === b && c.hide(); a.effects.restore(c, d); a.effects.removeWrapper(c); h() } })
    }
})(jQuery);
(function (a, l) {
    a.effects.effect.explode = function (e, h) {
        function c() { t.push(this); t.length === d * b && (f.css({ visibility: "visible" }), a(t).remove(), m || f.hide(), h()) } var d = e.pieces ? Math.round(Math.sqrt(e.pieces)) : 3, b = d, f = a(this), m = "show" === a.effects.setMode(f, e.mode || "hide"), k = f.show().css("visibility", "hidden").offset(), l = Math.ceil(f.outerWidth() / b), z = Math.ceil(f.outerHeight() / d), t = [], s, v, y, g, u, q; for (s = 0; s < d; s++)for (g = k.top + s * z, q = s - (d - 1) / 2, v = 0; v < b; v++)y = k.left + v * l, u = v - (b - 1) / 2, f.clone().appendTo("body").wrap("\x3cdiv\x3e\x3c/div\x3e").css({
            position: "absolute",
            visibility: "visible", left: -v * l, top: -s * z
        }).parent().addClass("ui-effects-explode").css({ position: "absolute", overflow: "hidden", width: l, height: z, left: y + (m ? u * l : 0), top: g + (m ? q * z : 0), opacity: m ? 0 : 1 }).animate({ left: y + (m ? 0 : u * l), top: g + (m ? 0 : q * z), opacity: m ? 1 : 0 }, e.duration || 500, e.easing, c)
    }
})(jQuery); (function (a, l) { a.effects.effect.fade = function (e, h) { var c = a(this), d = a.effects.setMode(c, e.mode || "toggle"); c.animate({ opacity: d }, { queue: !1, duration: e.duration, easing: e.easing, complete: h }) } })(jQuery);
(function (a, l) {
    a.effects.effect.fold = function (e, h) {
        var c = a(this), d = "position top bottom left right height width".split(" "), b = a.effects.setMode(c, e.mode || "hide"), f = "show" === b, m = "hide" === b, b = e.size || 15, k = /([0-9]+)%/.exec(b), l = !!e.horizFirst, z = f !== l, t = z ? ["width", "height"] : ["height", "width"], s = e.duration / 2, v, y = {}, g = {}; a.effects.save(c, d); c.show(); v = a.effects.createWrapper(c).css({ overflow: "hidden" }); z = z ? [v.width(), v.height()] : [v.height(), v.width()]; k && (b = parseInt(k[1], 10) / 100 * z[m ? 0 : 1]); f && v.css(l ? {
            height: 0,
            width: b
        } : { height: b, width: 0 }); y[t[0]] = f ? z[0] : b; g[t[1]] = f ? z[1] : 0; v.animate(y, s, e.easing).animate(g, s, e.easing, function () { m && c.hide(); a.effects.restore(c, d); a.effects.removeWrapper(c); h() })
    }
})(jQuery);
(function (a, l) { a.effects.effect.highlight = function (e, h) { var c = a(this), d = ["backgroundImage", "backgroundColor", "opacity"], b = a.effects.setMode(c, e.mode || "show"), f = { backgroundColor: c.css("backgroundColor") }; "hide" === b && (f.opacity = 0); a.effects.save(c, d); c.show().css({ backgroundImage: "none", backgroundColor: e.color || "#ffff99" }).animate(f, { queue: !1, duration: e.duration, easing: e.easing, complete: function () { "hide" === b && c.hide(); a.effects.restore(c, d); h() } }) } })(jQuery);
(function (a, l) { a.effects.effect.pulsate = function (e, h) { var c = a(this), d = a.effects.setMode(c, e.mode || "show"), b = "show" === d, f = "hide" === d, d = 2 * (e.times || 5) + (b || "hide" === d ? 1 : 0), m = e.duration / d, k = 0, l = c.queue(), z = l.length; if (b || !c.is(":visible")) c.css("opacity", 0).show(), k = 1; for (b = 1; b < d; b++)c.animate({ opacity: k }, m, e.easing), k = 1 - k; c.animate({ opacity: k }, m, e.easing); c.queue(function () { f && c.hide(); h() }); 1 < z && l.splice.apply(l, [1, 0].concat(l.splice(z, d + 1))); c.dequeue() } })(jQuery);
(function (a, l) {
    a.effects.effect.puff = function (e, h) { var c = a(this), d = a.effects.setMode(c, e.mode || "hide"), b = "hide" === d, f = parseInt(e.percent, 10) || 150, m = f / 100, k = { height: c.height(), width: c.width(), outerHeight: c.outerHeight(), outerWidth: c.outerWidth() }; a.extend(e, { effect: "scale", queue: !1, fade: !0, mode: d, complete: h, percent: b ? f : 100, from: b ? k : { height: k.height * m, width: k.width * m, outerHeight: k.outerHeight * m, outerWidth: k.outerWidth * m } }); c.effect(e) }; a.effects.effect.scale = function (e, h) {
        var c = a(this), d = a.extend(!0,
            {}, e), b = a.effects.setMode(c, e.mode || "effect"), f = parseInt(e.percent, 10) || (0 === parseInt(e.percent, 10) ? 0 : "hide" === b ? 0 : 100), m = e.direction || "both", k = e.origin, l = { height: c.height(), width: c.width(), outerHeight: c.outerHeight(), outerWidth: c.outerWidth() }, z = "horizontal" !== m ? f / 100 : 1, f = "vertical" !== m ? f / 100 : 1; d.effect = "size"; d.queue = !1; d.complete = h; "effect" !== b && (d.origin = k || ["middle", "center"], d.restore = !0); d.from = e.from || ("show" === b ? { height: 0, width: 0, outerHeight: 0, outerWidth: 0 } : l); d.to = {
                height: l.height * z, width: l.width *
                    f, outerHeight: l.outerHeight * z, outerWidth: l.outerWidth * f
            }; d.fade && ("show" === b && (d.from.opacity = 0, d.to.opacity = 1), "hide" === b && (d.from.opacity = 1, d.to.opacity = 0)); c.effect(d)
    }; a.effects.effect.size = function (e, h) {
        var c, d, b, f, m, k, l = a(this), z = "position top bottom left right width height overflow opacity".split(" "); m = "position top bottom left right overflow opacity".split(" "); var t = ["width", "height", "overflow"], s = ["fontSize"], v = ["borderTopWidth", "borderBottomWidth", "paddingTop", "paddingBottom"], y = ["borderLeftWidth",
            "borderRightWidth", "paddingLeft", "paddingRight"], g = a.effects.setMode(l, e.mode || "effect"), u = e.restore || "effect" !== g, q = e.scale || "both"; k = e.origin || ["middle", "center"]; var w = l.css("position"), x = u ? z : m, D = { height: 0, width: 0, outerHeight: 0, outerWidth: 0 }; "show" === g && l.show(); m = { height: l.height(), width: l.width(), outerHeight: l.outerHeight(), outerWidth: l.outerWidth() }; "toggle" === e.mode && "show" === g ? (l.from = e.to || D, l.to = e.from || m) : (l.from = e.from || ("show" === g ? D : m), l.to = e.to || ("hide" === g ? D : m)); b = l.from.height / m.height;
        f = l.from.width / m.width; c = l.to.height / m.height; d = l.to.width / m.width; if ("box" === q || "both" === q) b !== c && (x = x.concat(v), l.from = a.effects.setTransition(l, v, b, l.from), l.to = a.effects.setTransition(l, v, c, l.to)), f !== d && (x = x.concat(y), l.from = a.effects.setTransition(l, y, f, l.from), l.to = a.effects.setTransition(l, y, d, l.to)); "content" !== q && "both" !== q || b === c || (x = x.concat(s).concat(t), l.from = a.effects.setTransition(l, s, b, l.from), l.to = a.effects.setTransition(l, s, c, l.to)); a.effects.save(l, x); l.show(); a.effects.createWrapper(l);
        l.css("overflow", "hidden").css(l.from); k && (k = a.effects.getBaseline(k, m), l.from.top = (m.outerHeight - l.outerHeight()) * k.y, l.from.left = (m.outerWidth - l.outerWidth()) * k.x, l.to.top = (m.outerHeight - l.to.outerHeight) * k.y, l.to.left = (m.outerWidth - l.to.outerWidth) * k.x); l.css(l.from); if ("content" === q || "both" === q) v = v.concat(["marginTop", "marginBottom"]).concat(s), y = y.concat(["marginLeft", "marginRight"]), t = z.concat(v).concat(y), l.find("*[width]").each(function () {
            var g = a(this), k = g.height(), q = g.width(), m = g.outerHeight(),
            h = g.outerWidth(); u && a.effects.save(g, t); g.from = { height: k * b, width: q * f, outerHeight: m * b, outerWidth: h * f }; g.to = { height: k * c, width: q * d, outerHeight: k * c, outerWidth: q * d }; b !== c && (g.from = a.effects.setTransition(g, v, b, g.from), g.to = a.effects.setTransition(g, v, c, g.to)); f !== d && (g.from = a.effects.setTransition(g, y, f, g.from), g.to = a.effects.setTransition(g, y, d, g.to)); g.css(g.from); g.animate(g.to, e.duration, e.easing, function () { u && a.effects.restore(g, t) })
        }); l.animate(l.to, {
            queue: !1, duration: e.duration, easing: e.easing,
            complete: function () { 0 === l.to.opacity && l.css("opacity", l.from.opacity); "hide" === g && l.hide(); a.effects.restore(l, x); u || ("static" === w ? l.css({ position: "relative", top: l.to.top, left: l.to.left }) : a.each(["top", "left"], function (a, b) { l.css(b, function (b, c) { var g = parseInt(c, 10), d = a ? l.to.left : l.to.top; return "auto" === c ? d + "px" : g + d + "px" }) })); a.effects.removeWrapper(l); h() }
        })
    }
})(jQuery);
(function (a, l) {
    a.effects.effect.shake = function (e, h) {
        var c = a(this), d = "position top bottom left right height width".split(" "), b = a.effects.setMode(c, e.mode || "effect"), f = e.direction || "left", m = e.distance || 20, k = e.times || 3, l = 2 * k + 1, z = Math.round(e.duration / l), t = "up" === f || "down" === f ? "top" : "left", s = "up" === f || "left" === f, f = {}, v = {}, y = {}, g = c.queue(), u = g.length; a.effects.save(c, d); c.show(); a.effects.createWrapper(c); f[t] = (s ? "-\x3d" : "+\x3d") + m; v[t] = (s ? "+\x3d" : "-\x3d") + 2 * m; y[t] = (s ? "-\x3d" : "+\x3d") + 2 * m; c.animate(f,
            z, e.easing); for (m = 1; m < k; m++)c.animate(v, z, e.easing).animate(y, z, e.easing); c.animate(v, z, e.easing).animate(f, z / 2, e.easing).queue(function () { "hide" === b && c.hide(); a.effects.restore(c, d); a.effects.removeWrapper(c); h() }); 1 < u && g.splice.apply(g, [1, 0].concat(g.splice(u, l + 1))); c.dequeue()
    }
})(jQuery);
(function (a, l) {
    a.effects.effect.slide = function (e, h) {
        var c = a(this), d = "position top bottom left right width height".split(" "), b = a.effects.setMode(c, e.mode || "show"), f = "show" === b, m = e.direction || "left", k = "up" === m || "down" === m ? "top" : "left", m = "up" === m || "left" === m, l, z = {}; a.effects.save(c, d); c.show(); l = e.distance || c["top" === k ? "outerHeight" : "outerWidth"](!0); a.effects.createWrapper(c).css({ overflow: "hidden" }); f && c.css(k, m ? isNaN(l) ? "-" + l : -l : l); z[k] = (f ? m ? "+\x3d" : "-\x3d" : m ? "-\x3d" : "+\x3d") + l; c.animate(z, {
            queue: !1,
            duration: e.duration, easing: e.easing, complete: function () { "hide" === b && c.hide(); a.effects.restore(c, d); a.effects.removeWrapper(c); h() }
        })
    }
})(jQuery);
(function (a, l) {
    a.effects.effect.transfer = function (e, h) {
        var c = a(this), d = a(e.to), b = "fixed" === d.css("position"), f = a("body"), m = b ? f.scrollTop() : 0, f = b ? f.scrollLeft() : 0, k = d.offset(), d = { top: k.top - m, left: k.left - f, height: d.innerHeight(), width: d.innerWidth() }, k = c.offset(), l = a("\x3cdiv class\x3d'ui-effects-transfer'\x3e\x3c/div\x3e").appendTo(document.body).addClass(e.className).css({ top: k.top - m, left: k.left - f, height: c.innerHeight(), width: c.innerWidth(), position: b ? "fixed" : "absolute" }).animate(d, e.duration, e.easing,
            function () { l.remove(); h() })
    }
})(jQuery);
jQuery(function (a) {
    a.datepicker.regional["pt-BR"] = {
        closeText: "Fechar", prevText: "\x26#x3c;Anterior", nextText: "Pr\x26oacute;ximo\x26#x3e;", currentText: "Hoje", monthNames: "Janeiro Fevereiro Mar\x26ccedil;o Abril Maio Junho Julho Agosto Setembro Outubro Novembro Dezembro".split(" "), monthNamesShort: "Jan Fev Mar Abr Mai Jun Jul Ago Set Out Nov Dez".split(" "), dayNames: "Domingo Segunda-feira Ter\x26ccedil;a-feira Quarta-feira Quinta-feira Sexta-feira S\x26aacute;bado".split(" "), dayNamesShort: "Dom Seg Ter Qua Qui Sex S\x26aacute;b".split(" "),
        dayNamesMin: "Dom Seg Ter Qua Qui Sex S\x26aacute;b".split(" "), weekHeader: "Sm", dateFormat: "dd/mm/yy", firstDay: 0, isRTL: !1, showMonthAfterYear: !1, yearSuffix: ""
    }; a.datepicker.setDefaults(a.datepicker.regional["pt-BR"])
}); jQuery.browser = {}; jQuery.browser.mozilla = /mozilla/.test(navigator.userAgent.toLowerCase()) && !/webkit/.test(navigator.userAgent.toLowerCase()); jQuery.browser.webkit = /webkit/.test(navigator.userAgent.toLowerCase()); jQuery.browser.opera = /opera/.test(navigator.userAgent.toLowerCase());
jQuery.browser.msie = /msie/.test(navigator.userAgent.toLowerCase()); $(document).ready(function () { $("select.ui-form-field-required:visible").each(function () { 2 == $("option", this).size() && $(this).val($("option:last", this).val()) }) });
(function (a) { "function" === typeof define && define.amd ? define(["jquery"], a) : "object" === typeof module && module.exports ? module.exports = function (l, e) { void 0 === e && (e = "undefined" !== typeof window ? require("jquery") : require("jquery")(l)); a(e); return e } : a(jQuery) })(function (a) {
    var l = function () {
        if (a && a.fn && a.fn.select2 && a.fn.select2.amd) var e = a.fn.select2.amd; (function () {
            if (!e || !e.requirejs) {
                e ? d = e : e = {}; var a, d, b; (function (f) {
                    function e(a, b) {
                        var c, g, d, f, k, q, m, h, l, u = b && b.split("/"), x = D.map, w = x && x["*"] || {}; if (a) {
                            a =
                            a.split("/"); k = a.length - 1; D.nodeIdCompat && O.test(a[k]) && (a[k] = a[k].replace(O, "")); "." === a[0].charAt(0) && u && (k = u.slice(0, u.length - 1), a = k.concat(a)); for (k = 0; k < a.length; k++)c = a[k], "." === c ? (a.splice(k, 1), k -= 1) : ".." === c && 0 !== k && (1 !== k || ".." !== a[2]) && ".." !== a[k - 1] && 0 < k && (a.splice(k - 1, 2), k -= 2); a = a.join("/")
                        } if ((u || w) && x) {
                            c = a.split("/"); for (k = c.length; 0 < k; k -= 1) { g = c.slice(0, k).join("/"); if (u) for (l = u.length; 0 < l; l -= 1)if (d = x[u.slice(0, l).join("/")]) if (d = d[g]) { f = d; q = k; break } if (f) break; !m && w && w[g] && (m = w[g], h = k) } !f &&
                                m && (f = m, q = h); f && (c.splice(0, q, f), a = c.join("/"))
                        } return a
                    } function k(a, b) { return function () { var c = E.call(arguments, 0); "string" !== typeof c[0] && 1 === c.length && c.push(null); return g.apply(f, c.concat([a, b])) } } function h(a) { return function (b) { return e(b, a) } } function l(a) { return function (b) { w[a] = b } } function t(a) { if (I.call(x, a)) { var b = x[a]; delete x[a]; A[a] = !0; y.apply(f, b) } if (!I.call(w, a) && !I.call(A, a)) throw Error("No " + a); return w[a] } function s(a) {
                        var b, c = a ? a.indexOf("!") : -1; -1 < c && (b = a.substring(0, c), a = a.substring(c +
                            1, a.length)); return [b, a]
                    } function v(a) { return function () { return D && D.config && D.config[a] || {} } } var y, g, u, q, w = {}, x = {}, D = {}, A = {}, I = Object.prototype.hasOwnProperty, E = [].slice, O = /\.js$/; u = function (a, b) { var c, g = s(a), d = g[0], f = b[1]; a = g[1]; d && (d = e(d, f), c = t(d)); d ? a = c && c.normalize ? c.normalize(a, h(f)) : e(a, f) : (a = e(a, f), g = s(a), d = g[0], a = g[1], d && (c = t(d))); return { f: d ? d + "!" + a : a, n: a, pr: d, p: c } }; q = {
                        require: function (a) { return k(a) }, exports: function (a) { var b = w[a]; return "undefined" !== typeof b ? b : w[a] = {} }, module: function (a) {
                            return {
                                id: a,
                                uri: "", exports: w[a], config: v(a)
                            }
                        }
                    }; y = function (a, b, c, g) {
                        var d, e, m, h, r, D = []; e = typeof c; var O; r = (g = g || a) ? s(g) : []; if ("undefined" === e || "function" === e) {
                            b = !b.length && c.length ? ["require", "exports", "module"] : b; for (h = 0; h < b.length; h += 1)if (m = u(b[h], r), e = m.f, "require" === e) D[h] = q.require(a); else if ("exports" === e) D[h] = q.exports(a), O = !0; else if ("module" === e) d = D[h] = q.module(a); else if (I.call(w, e) || I.call(x, e) || I.call(A, e)) D[h] = t(e); else if (m.p) m.p.load(m.n, k(g, !0), l(e), {}), D[h] = w[e]; else throw Error(a + " missing " +
                                e); b = c ? c.apply(w[a], D) : void 0; a && (d && d.exports !== f && d.exports !== w[a] ? w[a] = d.exports : b === f && O || (w[a] = b))
                        } else a && (w[a] = c)
                    }; a = d = g = function (a, b, c, d, e) { if ("string" === typeof a) return q[a] ? q[a](b) : t(u(a, b ? s(b) : []).f); if (!a.splice) { D = a; D.deps && g(D.deps, D.callback); if (!b) return; b.splice ? (a = b, b = c, c = null) : a = f } b = b || function () { }; "function" === typeof c && (c = d, d = e); d ? y(f, a, b, c) : setTimeout(function () { y(f, a, b, c) }, 4); return g }; g.config = function (a) { return g(a) }; a._defined = w; b = function (a, b, c) {
                        if ("string" !== typeof a) throw Error("See almond README: incorrect module build, no module name");
                        b.splice || (c = b, b = []); I.call(w, a) || I.call(x, a) || (x[a] = [a, b, c])
                    }; b.amd = { jQuery: !0 }
                })(); e.requirejs = a; e.require = d; e.define = b
            }
        })(); e.define("almond", function () { }); e.define("jquery", [], function () { var c = a || $; null == c && console && console.error && console.error("Select2: An instance of jQuery or a jQuery-compatible library was not found. Make sure that you are including jQuery before Select2 on your web page."); return c }); e.define("select2/utils", ["jquery"], function (a) {
            function d(a) {
                a = a.prototype; var b = [], c; for (c in a) "function" ===
                    typeof a[c] && "constructor" !== c && b.push(c); return b
            } var b = {
                Extend: function (a, b) { function c() { this.constructor = a } var d = {}.hasOwnProperty, f; for (f in b) d.call(b, f) && (a[f] = b[f]); c.prototype = b.prototype; a.prototype = new c; a.__super__ = b.prototype; return a }, Decorate: function (a, b) {
                    function c() { var g = Array.prototype.unshift, d = a.prototype.constructor; 0 < b.prototype.constructor.length && (g.call(arguments, a.prototype.constructor), d = b.prototype.constructor); d.apply(this, arguments) } var f = d(b), e = d(a); b.displayName =
                        a.displayName; c.prototype = new function () { this.constructor = c }; for (var m = 0; m < e.length; m++) { var h = e[m]; c.prototype[h] = a.prototype[h] } e = function (a) { var d = function () { }; a in c.prototype && (d = c.prototype[a]); var f = b.prototype[a]; return function () { Array.prototype.unshift.call(arguments, d); return f.apply(this, arguments) } }; for (m = 0; m < f.length; m++)h = f[m], c.prototype[h] = e(h); return c
                }
            }, f = function () { this.listeners = {} }; f.prototype.on = function (a, b) {
                this.listeners = this.listeners || {}; a in this.listeners ? this.listeners[a].push(b) :
                    this.listeners[a] = [b]
            }; f.prototype.trigger = function (a) { var b = Array.prototype.slice, c = b.call(arguments, 1); this.listeners = this.listeners || {}; null == c && (c = []); 0 === c.length && c.push({}); c[0]._type = a; a in this.listeners && this.invoke(this.listeners[a], b.call(arguments, 1)); "*" in this.listeners && this.invoke(this.listeners["*"], arguments) }; f.prototype.invoke = function (a, b) { for (var c = 0, d = a.length; c < d; c++)a[c].apply(this, b) }; b.Observable = f; b.generateChars = function (a) {
                for (var b = "", c = 0; c < a; c++)var d = Math.floor(36 *
                    Math.random()), b = b + d.toString(36); return b
            }; b.bind = function (a, b) { return function () { a.apply(b, arguments) } }; b._convertData = function (a) { for (var b in a) { var c = b.split("-"), d = a; if (1 !== c.length) { for (var f = 0; f < c.length; f++) { var e = c[f], e = e.substring(0, 1).toLowerCase() + e.substring(1); e in d || (d[e] = {}); f == c.length - 1 && (d[e] = a[b]); d = d[e] } delete a[b] } } return a }; b.hasScroll = function (b, d) {
                var f = a(d), e = d.style.overflowX, m = d.style.overflowY; return e !== m || "hidden" !== m && "visible" !== m ? "scroll" === e || "scroll" === m ? !0 : f.innerHeight() <
                    d.scrollHeight || f.innerWidth() < d.scrollWidth : !1
            }; b.escapeMarkup = function (a) { var b = { "\\": "\x26#92;", "\x26": "\x26amp;", "\x3c": "\x26lt;", "\x3e": "\x26gt;", '"': "\x26quot;", "'": "\x26#39;", "/": "\x26#47;" }; return "string" !== typeof a ? a : String(a).replace(/[&<>"'\/\\]/g, function (a) { return b[a] }) }; b.appendMany = function (b, d) { if ("1.7" === a.fn.jquery.substr(0, 3)) { var f = a(); a.map(d, function (a) { f = f.add(a) }); d = f } b.append(d) }; b.__cache = {}; var e = 0; b.GetUniqueElementId = function (a) {
                var b = a.getAttribute("data-select2-id");
                null == b && (a.id ? (b = a.id, a.setAttribute("data-select2-id", b)) : (a.setAttribute("data-select2-id", ++e), b = e.toString())); return b
            }; b.StoreData = function (a, c, d) { a = b.GetUniqueElementId(a); b.__cache[a] || (b.__cache[a] = {}); b.__cache[a][c] = d }; b.GetData = function (d, f) { var e = b.GetUniqueElementId(d); return f ? b.__cache[e] && null != b.__cache[e][f] ? b.__cache[e][f] : a(d).data(f) : b.__cache[e] }; b.RemoveData = function (a) { a = b.GetUniqueElementId(a); null != b.__cache[a] && delete b.__cache[a] }; return b
        }); e.define("select2/results",
            ["jquery", "./utils"], function (a, d) {
                function b(a, c, d) { this.$element = a; this.data = d; this.options = c; b.__super__.constructor.call(this) } d.Extend(b, d.Observable); b.prototype.render = function () { var b = a('\x3cul class\x3d"select2-results__options" role\x3d"tree"\x3e\x3c/ul\x3e'); this.options.get("multiple") && b.attr("aria-multiselectable", "true"); return this.$results = b }; b.prototype.clear = function () { this.$results.empty() }; b.prototype.displayMessage = function (b) {
                    var d = this.options.get("escapeMarkup"); this.clear();
                    this.hideLoading(); var e = a('\x3cli role\x3d"treeitem" aria-live\x3d"assertive" class\x3d"select2-results__option"\x3e\x3c/li\x3e'), h = this.options.get("translations").get(b.message); e.append(d(h(b.args))); e[0].className += " select2-results__message"; this.$results.append(e)
                }; b.prototype.hideMessages = function () { this.$results.find(".select2-results__message").remove() }; b.prototype.append = function (a) {
                    this.hideLoading(); var b = []; if (null == a.results || 0 === a.results.length) 0 === this.$results.children().length &&
                        this.trigger("results:message", { message: "noResults" }); else { a.results = this.sort(a.results); for (var c = 0; c < a.results.length; c++) { var d = this.option(a.results[c]); b.push(d) } this.$results.append(b) }
                }; b.prototype.position = function (a, b) { b.find(".select2-results").append(a) }; b.prototype.sort = function (a) { return this.options.get("sorter")(a) }; b.prototype.highlightFirstItem = function () {
                    var a = this.$results.find(".select2-results__option[aria-selected]"), b = a.filter("[aria-selected\x3dtrue]"); 0 < b.length ? b.first().trigger("mouseenter") :
                        a.first().trigger("mouseenter"); this.ensureHighlightVisible()
                }; b.prototype.setClasses = function () { var b = this; this.data.current(function (e) { var k = a.map(e, function (a) { return a.id.toString() }); b.$results.find(".select2-results__option[aria-selected]").each(function () { var b = a(this), f = d.GetData(this, "data"), e = "" + f.id; null != f.element && f.element.selected || null == f.element && -1 < a.inArray(e, k) ? b.attr("aria-selected", "true") : b.attr("aria-selected", "false") }) }) }; b.prototype.showLoading = function (a) {
                    this.hideLoading();
                    a = { disabled: !0, loading: !0, text: this.options.get("translations").get("searching")(a) }; a = this.option(a); a.className += " loading-results"; this.$results.prepend(a)
                }; b.prototype.hideLoading = function () { this.$results.find(".loading-results").remove() }; b.prototype.option = function (b) {
                    var e = document.createElement("li"); e.className = "select2-results__option"; var k = { role: "treeitem", "aria-selected": "false" }; b.disabled && (delete k["aria-selected"], k["aria-disabled"] = "true"); null == b.id && delete k["aria-selected"]; null !=
                        b._resultId && (e.id = b._resultId); b.title && (e.title = b.title); b.children && (k.role = "group", k["aria-label"] = b.text, delete k["aria-selected"]); for (var h in k) e.setAttribute(h, k[h]); if (b.children) {
                            k = a(e); h = document.createElement("strong"); h.className = "select2-results__group"; a(h); this.template(b, h); for (var l = [], t = 0; t < b.children.length; t++) { var s = this.option(b.children[t]); l.push(s) } t = a("\x3cul\x3e\x3c/ul\x3e", { "class": "select2-results__options select2-results__options--nested" }); t.append(l); k.append(h);
                            k.append(t)
                        } else this.template(b, e); d.StoreData(e, "data", b); return e
                }; b.prototype.bind = function (b, e) {
                    var k = this; this.$results.attr("id", b.id + "-results"); b.on("results:all", function (a) { k.clear(); k.append(a.data); b.isOpen() && (k.setClasses(), k.highlightFirstItem()) }); b.on("results:append", function (a) { k.append(a.data); b.isOpen() && k.setClasses() }); b.on("query", function (a) { k.hideMessages(); k.showLoading(a) }); b.on("select", function () { b.isOpen() && (k.setClasses(), k.options.get("scrollAfterSelect") && k.highlightFirstItem()) });
                    b.on("unselect", function () { b.isOpen() && (k.setClasses(), k.options.get("scrollAfterSelect") && k.highlightFirstItem()) }); b.on("open", function () { k.$results.attr("aria-expanded", "true"); k.$results.attr("aria-hidden", "false"); k.setClasses(); k.ensureHighlightVisible() }); b.on("close", function () { k.$results.attr("aria-expanded", "false"); k.$results.attr("aria-hidden", "true"); k.$results.removeAttr("aria-activedescendant") }); b.on("results:toggle", function () { var a = k.getHighlightedResults(); 0 !== a.length && a.trigger("mouseup") });
                    b.on("results:select", function () { var a = k.getHighlightedResults(); if (0 !== a.length) { var b = d.GetData(a[0], "data"); "true" == a.attr("aria-selected") ? k.trigger("close", {}) : k.trigger("select", { data: b }) } }); b.on("results:previous", function () { var a = k.getHighlightedResults(), b = k.$results.find("[aria-selected]"), c = b.index(a); if (!(0 >= c)) { c -= 1; 0 === a.length && (c = 0); b = b.eq(c); b.trigger("mouseenter"); var a = k.$results.offset().top, b = b.offset().top, d = k.$results.scrollTop() + (b - a); 0 === c ? k.$results.scrollTop(0) : 0 > b - a && k.$results.scrollTop(d) } });
                    b.on("results:next", function () { var a = k.getHighlightedResults(), b = k.$results.find("[aria-selected]"), a = b.index(a) + 1; if (!(a >= b.length)) { var c = b.eq(a); c.trigger("mouseenter"); var b = k.$results.offset().top + k.$results.outerHeight(!1), c = c.offset().top + c.outerHeight(!1), d = k.$results.scrollTop() + c - b; 0 === a ? k.$results.scrollTop(0) : c > b && k.$results.scrollTop(d) } }); b.on("results:focus", function (a) { a.element.addClass("select2-results__option--highlighted") }); b.on("results:message", function (a) { k.displayMessage(a) });
                    if (a.fn.mousewheel) this.$results.on("mousewheel", function (a) { var b = k.$results.scrollTop(), c = k.$results.get(0).scrollHeight - b + a.deltaY, b = 0 < a.deltaY && 0 >= b - a.deltaY, c = 0 > a.deltaY && c <= k.$results.height(); b ? (k.$results.scrollTop(0), a.preventDefault(), a.stopPropagation()) : c && (k.$results.scrollTop(k.$results.get(0).scrollHeight - k.$results.height()), a.preventDefault(), a.stopPropagation()) }); this.$results.on("mouseup", ".select2-results__option[aria-selected]", function (b) {
                        var e = a(this), f = d.GetData(this, "data");
                        "true" === e.attr("aria-selected") ? k.options.get("multiple") ? k.trigger("unselect", { originalEvent: b, data: f }) : k.trigger("close", {}) : k.trigger("select", { originalEvent: b, data: f })
                    }); this.$results.on("mouseenter", ".select2-results__option[aria-selected]", function (b) { b = d.GetData(this, "data"); k.getHighlightedResults().removeClass("select2-results__option--highlighted"); k.trigger("results:focus", { data: b, element: a(this) }) })
                }; b.prototype.getHighlightedResults = function () { return this.$results.find(".select2-results__option--highlighted") };
                b.prototype.destroy = function () { this.$results.remove() }; b.prototype.ensureHighlightVisible = function () { var a = this.getHighlightedResults(); if (0 !== a.length) { var b = this.$results.find("[aria-selected]").index(a), c = this.$results.offset().top, d = a.offset().top, e = this.$results.scrollTop() + (d - c), c = d - c, e = e - 2 * a.outerHeight(!1); 2 >= b ? this.$results.scrollTop(0) : (c > this.$results.outerHeight() || 0 > c) && this.$results.scrollTop(e) } }; b.prototype.template = function (b, d) {
                    var e = this.options.get("templateResult"), h = this.options.get("escapeMarkup"),
                    e = e(b, d); null == e ? d.style.display = "none" : "string" === typeof e ? d.innerHTML = h(e) : a(d).append(e)
                }; return b
            }); e.define("select2/keys", [], function () { return { BACKSPACE: 8, TAB: 9, ENTER: 13, SHIFT: 16, CTRL: 17, ALT: 18, ESC: 27, SPACE: 32, PAGE_UP: 33, PAGE_DOWN: 34, END: 35, HOME: 36, LEFT: 37, UP: 38, RIGHT: 39, DOWN: 40, DELETE: 46 } }); e.define("select2/selection/base", ["jquery", "../utils", "../keys"], function (a, d, b) {
                function e(a, b) { this.$element = a; this.options = b; e.__super__.constructor.call(this) } d.Extend(e, d.Observable); e.prototype.render =
                    function () { var b = a('\x3cspan class\x3d"select2-selection" role\x3d"combobox"  aria-haspopup\x3d"true" aria-expanded\x3d"false"\x3e\x3c/span\x3e'); this._tabindex = 0; null != d.GetData(this.$element[0], "old-tabindex") ? this._tabindex = d.GetData(this.$element[0], "old-tabindex") : null != this.$element.attr("tabindex") && (this._tabindex = this.$element.attr("tabindex")); b.attr("title", this.$element.attr("title")); b.attr("tabindex", this._tabindex); return this.$selection = b }; e.prototype.bind = function (a, c) {
                        var d = this,
                        e = a.id + "-results"; this.container = a; this.$selection.on("focus", function (a) { d.trigger("focus", a) }); this.$selection.on("blur", function (a) { d._handleBlur(a) }); this.$selection.on("keydown", function (a) { d.trigger("keypress", a); a.which === b.SPACE && a.preventDefault() }); a.on("results:focus", function (a) { d.$selection.attr("aria-activedescendant", a.data._resultId) }); a.on("selection:update", function (a) { d.update(a.data) }); a.on("open", function () {
                            d.$selection.attr("aria-expanded", "true"); d.$selection.attr("aria-owns",
                                e); d._attachCloseHandler(a)
                        }); a.on("close", function () { d.$selection.attr("aria-expanded", "false"); d.$selection.removeAttr("aria-activedescendant"); d.$selection.removeAttr("aria-owns"); window.setTimeout(function () { d.$selection.focus() }, 0); d._detachCloseHandler(a) }); a.on("enable", function () { d.$selection.attr("tabindex", d._tabindex) }); a.on("disable", function () { d.$selection.attr("tabindex", "-1") })
                    }; e.prototype._handleBlur = function (b) {
                        var d = this; window.setTimeout(function () {
                            document.activeElement == d.$selection[0] ||
                            a.contains(d.$selection[0], document.activeElement) || d.trigger("blur", b)
                        }, 1)
                    }; e.prototype._attachCloseHandler = function (b) { a(document.body).on("mousedown.select2." + b.id, function (b) { var e = a(b.target).closest(".select2"); a(".select2.select2-container--open").each(function () { a(this); this != e[0] && d.GetData(this, "element").select2("close") }) }) }; e.prototype._detachCloseHandler = function (b) { a(document.body).off("mousedown.select2." + b.id) }; e.prototype.position = function (a, b) { b.find(".selection").append(a) }; e.prototype.destroy =
                        function () { this._detachCloseHandler(this.container) }; e.prototype.update = function (a) { throw Error("The `update` method must be defined in child classes."); }; return e
            }); e.define("select2/selection/single", ["jquery", "./base", "../utils", "../keys"], function (a, d, b, e) {
                function m() { m.__super__.constructor.apply(this, arguments) } b.Extend(m, d); m.prototype.render = function () {
                    var a = m.__super__.render.call(this); a.addClass("select2-selection--single"); a.html('\x3cspan class\x3d"select2-selection__rendered"\x3e\x3c/span\x3e\x3cspan class\x3d"select2-selection__arrow" role\x3d"presentation"\x3e\x3cb role\x3d"presentation"\x3e\x3c/b\x3e\x3c/span\x3e');
                    return a
                }; m.prototype.bind = function (a, b) { var c = this; m.__super__.bind.apply(this, arguments); var d = a.id + "-container"; this.$selection.find(".select2-selection__rendered").attr("id", d).attr("role", "textbox").attr("aria-readonly", "true"); this.$selection.attr("aria-labelledby", d); this.$selection.on("mousedown", function (a) { 1 === a.which && c.trigger("toggle", { originalEvent: a }) }); this.$selection.on("focus", function (a) { }); this.$selection.on("blur", function (a) { }); a.on("focus", function (b) { a.isOpen() || c.$selection.focus() }) };
                m.prototype.clear = function () { var a = this.$selection.find(".select2-selection__rendered"); a.empty(); a.removeAttr("title") }; m.prototype.display = function (a, b) { var c = this.options.get("templateSelection"); return this.options.get("escapeMarkup")(c(a, b)) }; m.prototype.selectionContainer = function () { return a("\x3cspan\x3e\x3c/span\x3e") }; m.prototype.update = function (a) {
                    if (0 === a.length) this.clear(); else {
                        a = a[0]; var b = this.$selection.find(".select2-selection__rendered"), c = this.display(a, b); b.empty().append(c); b.attr("title",
                            a.title || a.text)
                    }
                }; return m
            }); e.define("select2/selection/multiple", ["jquery", "./base", "../utils"], function (a, d, b) {
                function e(a, b) { e.__super__.constructor.apply(this, arguments) } b.Extend(e, d); e.prototype.render = function () { var a = e.__super__.render.call(this); a.addClass("select2-selection--multiple"); a.html('\x3cul class\x3d"select2-selection__rendered"\x3e\x3c/ul\x3e'); return a }; e.prototype.bind = function (d, k) {
                    var h = this; e.__super__.bind.apply(this, arguments); this.$selection.on("click", function (a) {
                        h.trigger("toggle",
                            { originalEvent: a })
                    }); this.$selection.on("click", ".select2-selection__choice__remove", function (d) { if (!h.options.get("disabled")) { var e = a(this).parent(), e = b.GetData(e[0], "data"); h.trigger("unselect", { originalEvent: d, data: e }) } })
                }; e.prototype.clear = function () { var a = this.$selection.find(".select2-selection__rendered"); a.empty(); a.removeAttr("title") }; e.prototype.display = function (a, b) { var c = this.options.get("templateSelection"); return this.options.get("escapeMarkup")(c(a, b)) }; e.prototype.selectionContainer =
                    function () { return a('\x3cli class\x3d"select2-selection__choice"\x3e\x3cspan class\x3d"select2-selection__choice__remove" role\x3d"presentation"\x3e\x26times;\x3c/span\x3e\x3c/li\x3e') }; e.prototype.update = function (a) { this.clear(); if (0 !== a.length) { for (var c = [], d = 0; d < a.length; d++) { var e = a[d], f = this.selectionContainer(), h = this.display(e, f); f.append(h); f.attr("title", e.title || e.text); b.StoreData(f[0], "data", e); c.push(f) } a = this.$selection.find(".select2-selection__rendered"); b.appendMany(a, c) } }; return e
            });
        e.define("select2/selection/placeholder", ["../utils"], function (a) {
            function d(a, c, d) { this.placeholder = this.normalizePlaceholder(d.get("placeholder")); a.call(this, c, d) } d.prototype.normalizePlaceholder = function (a, c) { "string" === typeof c && (c = { id: "", text: c }); return c }; d.prototype.createPlaceholder = function (a, c) { var d = this.selectionContainer(); d.html(this.display(c)); d.addClass("select2-selection__placeholder").removeClass("select2-selection__choice"); return d }; d.prototype.update = function (a, c) {
                var d = 1 ==
                    c.length && c[0].id != this.placeholder.id; if (1 < c.length || d) return a.call(this, c); this.clear(); d = this.createPlaceholder(this.placeholder); this.$selection.find(".select2-selection__rendered").append(d)
            }; return d
        }); e.define("select2/selection/allowClear", ["jquery", "../keys", "../utils"], function (a, d, b) {
            function e() { } e.prototype.bind = function (a, b, c) {
                var d = this; a.call(this, b, c); null == this.placeholder && this.options.get("debug") && window.console && console.error && console.error("Select2: The `allowClear` option should be used in combination with the `placeholder` option.");
                this.$selection.on("mousedown", ".select2-selection__clear", function (a) { d._handleClear(a) }); b.on("keypress", function (a) { d._handleKeyboardClear(a, b) })
            }; e.prototype._handleClear = function (a, c) {
                if (!this.options.get("disabled")) {
                    var d = this.$selection.find(".select2-selection__clear"); if (0 !== d.length) {
                        c.stopPropagation(); var d = b.GetData(d[0], "data"), e = this.$element.val(); this.$element.val(this.placeholder.id); var f = { data: d }; this.trigger("clear", f); if (f.prevented) this.$element.val(e); else {
                            for (var h = 0; h < d.length; h++)if (f =
                                { data: d[h] }, this.trigger("unselect", f), f.prevented) { this.$element.val(e); return } this.$element.trigger("change"); this.trigger("toggle", {})
                        }
                    }
                }
            }; e.prototype._handleKeyboardClear = function (a, b, c) { c.isOpen() || b.which != d.DELETE && b.which != d.BACKSPACE || this._handleClear(b) }; e.prototype.update = function (d, e) {
                d.call(this, e); if (!(0 < this.$selection.find(".select2-selection__placeholder").length || 0 === e.length)) {
                    var f = this.options.get("translations").get("removeAllItems"), f = a('\x3cspan class\x3d"select2-selection__clear" title\x3d"' +
                        f() + '"\x3e\x26times;\x3c/span\x3e'); b.StoreData(f[0], "data", e); this.$selection.find(".select2-selection__rendered").prepend(f)
                }
            }; return e
        }); e.define("select2/selection/search", ["jquery", "../utils", "../keys"], function (a, d, b) {
            function e(a, b, c) { a.call(this, b, c) } e.prototype.render = function (b) {
                var d = a('\x3cli class\x3d"select2-search select2-search--inline"\x3e\x3cinput class\x3d"select2-search__field" type\x3d"search" tabindex\x3d"-1" autocomplete\x3d"off" autocorrect\x3d"off" autocapitalize\x3d"none" spellcheck\x3d"false" role\x3d"textbox" aria-autocomplete\x3d"list" /\x3e\x3c/li\x3e');
                this.$searchContainer = d; this.$search = d.find("input"); b = b.call(this); this._transferTabIndex(); return b
            }; e.prototype.bind = function (a, c, e) {
                var f = this; a.call(this, c, e); c.on("open", function () { f.$search.trigger("focus") }); c.on("close", function () { f.$search.val(""); f.$search.removeAttr("aria-activedescendant"); f.$search.trigger("focus") }); c.on("enable", function () { f.$search.prop("disabled", !1); f._transferTabIndex() }); c.on("disable", function () { f.$search.prop("disabled", !0) }); c.on("focus", function (a) { f.$search.trigger("focus") });
                c.on("results:focus", function (a) { f.$search.attr("aria-activedescendant", a.id) }); this.$selection.on("focusin", ".select2-search--inline", function (a) { f.trigger("focus", a) }); this.$selection.on("focusout", ".select2-search--inline", function (a) { f._handleBlur(a) }); this.$selection.on("keydown", ".select2-search--inline", function (a) {
                    a.stopPropagation(); f.trigger("keypress", a); f._keyUpPrevented = a.isDefaultPrevented(); if (a.which === b.BACKSPACE && "" === f.$search.val()) {
                        var c = f.$searchContainer.prev(".select2-selection__choice");
                        0 < c.length && (c = d.GetData(c[0], "data"), f.searchRemoveChoice(c), a.preventDefault())
                    }
                }); var h = (a = document.documentMode) && 11 >= a; this.$selection.on("input.searchcheck", ".select2-search--inline", function (a) { h ? f.$selection.off("input.search input.searchcheck") : f.$selection.off("keyup.search") }); this.$selection.on("keyup.search input.search", ".select2-search--inline", function (a) {
                    if (h && "input" === a.type) f.$selection.off("input.search input.searchcheck"); else {
                        var c = a.which; c != b.SHIFT && c != b.CTRL && c != b.ALT && c !=
                            b.TAB && f.handleSearch(a)
                    }
                })
            }; e.prototype._transferTabIndex = function (a) { this.$search.attr("tabindex", this.$selection.attr("tabindex")); this.$selection.attr("tabindex", "-1") }; e.prototype.createPlaceholder = function (a, b) { this.$search.attr("placeholder", b.text) }; e.prototype.update = function (a, b) {
                var c = this.$search[0] == document.activeElement; this.$search.attr("placeholder", ""); a.call(this, b); this.$selection.find(".select2-selection__rendered").append(this.$searchContainer); this.resizeSearch(); c && (this.$element.find("[data-select2-tag]").length ?
                    this.$element.focus() : this.$search.focus())
            }; e.prototype.handleSearch = function () { this.resizeSearch(); if (!this._keyUpPrevented) { var a = this.$search.val(); this.trigger("query", { term: a }) } this._keyUpPrevented = !1 }; e.prototype.searchRemoveChoice = function (a, b) { this.trigger("unselect", { data: b }); this.$search.val(b.text); this.handleSearch() }; e.prototype.resizeSearch = function () {
                this.$search.css("width", "25px"); var a = "", a = "" !== this.$search.attr("placeholder") ? this.$selection.find(".select2-selection__rendered").innerWidth() :
                    0.75 * (this.$search.val().length + 1) + "em"; this.$search.css("width", a)
            }; return e
        }); e.define("select2/selection/eventRelay", ["jquery"], function (a) {
            function d() { } d.prototype.bind = function (b, d, e) {
                var k = this, h = "open opening close closing select selecting unselect unselecting clear clearing".split(" "), l = ["opening", "closing", "selecting", "unselecting", "clearing"]; b.call(this, d, e); d.on("*", function (b, d) {
                    if (-1 !== a.inArray(b, h)) {
                        d = d || {}; var e = a.Event("select2:" + b, { params: d }); k.$element.trigger(e); -1 !== a.inArray(b,
                            l) && (d.prevented = e.isDefaultPrevented())
                    }
                })
            }; return d
        }); e.define("select2/translation", ["jquery", "require"], function (a, d) { function b(a) { this.dict = a || {} } b.prototype.all = function () { return this.dict }; b.prototype.get = function (a) { return this.dict[a] }; b.prototype.extend = function (b) { this.dict = a.extend({}, b.all(), this.dict) }; b._cache = {}; b.loadPath = function (a) { if (!(a in b._cache)) { var c = d(a); b._cache[a] = c } return new b(b._cache[a]) }; return b }); e.define("select2/diacritics", [], function () {
            return {
                "\u24b6": "A",
                "\uff21": "A", "À": "A", "Á": "A", "Â": "A", "\u1ea6": "A", "\u1ea4": "A", "\u1eaa": "A", "\u1ea8": "A", "Ã": "A", "\u0100": "A", "\u0102": "A", "\u1eb0": "A", "\u1eae": "A", "\u1eb4": "A", "\u1eb2": "A", "\u0226": "A", "\u01e0": "A", "Ä": "A", "\u01de": "A", "\u1ea2": "A", "Å": "A", "\u01fa": "A", "\u01cd": "A", "\u0200": "A", "\u0202": "A", "\u1ea0": "A", "\u1eac": "A", "\u1eb6": "A", "\u1e00": "A", "\u0104": "A", "\u023a": "A", "\u2c6f": "A", "\ua732": "AA", "Æ": "AE", "\u01fc": "AE", "\u01e2": "AE", "\ua734": "AO", "\ua736": "AU", "\ua738": "AV", "\ua73a": "AV", "\ua73c": "AY",
                "\u24b7": "B", "\uff22": "B", "\u1e02": "B", "\u1e04": "B", "\u1e06": "B", "\u0243": "B", "\u0182": "B", "\u0181": "B", "\u24b8": "C", "\uff23": "C", "\u0106": "C", "\u0108": "C", "\u010a": "C", "\u010c": "C", "Ç": "C", "\u1e08": "C", "\u0187": "C", "\u023b": "C", "\ua73e": "C", "\u24b9": "D", "\uff24": "D", "\u1e0a": "D", "\u010e": "D", "\u1e0c": "D", "\u1e10": "D", "\u1e12": "D", "\u1e0e": "D", "\u0110": "D", "\u018b": "D", "\u018a": "D", "\u0189": "D", "\ua779": "D", "\u01f1": "DZ", "\u01c4": "DZ", "\u01f2": "Dz", "\u01c5": "Dz", "\u24ba": "E", "\uff25": "E", "È": "E",
                "É": "E", "Ê": "E", "\u1ec0": "E", "\u1ebe": "E", "\u1ec4": "E", "\u1ec2": "E", "\u1ebc": "E", "\u0112": "E", "\u1e14": "E", "\u1e16": "E", "\u0114": "E", "\u0116": "E", "Ë": "E", "\u1eba": "E", "\u011a": "E", "\u0204": "E", "\u0206": "E", "\u1eb8": "E", "\u1ec6": "E", "\u0228": "E", "\u1e1c": "E", "\u0118": "E", "\u1e18": "E", "\u1e1a": "E", "\u0190": "E", "\u018e": "E", "\u24bb": "F", "\uff26": "F", "\u1e1e": "F", "\u0191": "F", "\ua77b": "F", "\u24bc": "G", "\uff27": "G", "\u01f4": "G", "\u011c": "G", "\u1e20": "G", "\u011e": "G", "\u0120": "G", "\u01e6": "G", "\u0122": "G",
                "\u01e4": "G", "\u0193": "G", "\ua7a0": "G", "\ua77d": "G", "\ua77e": "G", "\u24bd": "H", "\uff28": "H", "\u0124": "H", "\u1e22": "H", "\u1e26": "H", "\u021e": "H", "\u1e24": "H", "\u1e28": "H", "\u1e2a": "H", "\u0126": "H", "\u2c67": "H", "\u2c75": "H", "\ua78d": "H", "\u24be": "I", "\uff29": "I", "Ì": "I", "Í": "I", "Î": "I", "\u0128": "I", "\u012a": "I", "\u012c": "I", "\u0130": "I", "Ï": "I", "\u1e2e": "I", "\u1ec8": "I", "\u01cf": "I", "\u0208": "I", "\u020a": "I", "\u1eca": "I", "\u012e": "I", "\u1e2c": "I", "\u0197": "I", "\u24bf": "J", "\uff2a": "J", "\u0134": "J", "\u0248": "J",
                "\u24c0": "K", "\uff2b": "K", "\u1e30": "K", "\u01e8": "K", "\u1e32": "K", "\u0136": "K", "\u1e34": "K", "\u0198": "K", "\u2c69": "K", "\ua740": "K", "\ua742": "K", "\ua744": "K", "\ua7a2": "K", "\u24c1": "L", "\uff2c": "L", "\u013f": "L", "\u0139": "L", "\u013d": "L", "\u1e36": "L", "\u1e38": "L", "\u013b": "L", "\u1e3c": "L", "\u1e3a": "L", "\u0141": "L", "\u023d": "L", "\u2c62": "L", "\u2c60": "L", "\ua748": "L", "\ua746": "L", "\ua780": "L", "\u01c7": "LJ", "\u01c8": "Lj", "\u24c2": "M", "\uff2d": "M", "\u1e3e": "M", "\u1e40": "M", "\u1e42": "M", "\u2c6e": "M", "\u019c": "M",
                "\u24c3": "N", "\uff2e": "N", "\u01f8": "N", "\u0143": "N", "Ñ": "N", "\u1e44": "N", "\u0147": "N", "\u1e46": "N", "\u0145": "N", "\u1e4a": "N", "\u1e48": "N", "\u0220": "N", "\u019d": "N", "\ua790": "N", "\ua7a4": "N", "\u01ca": "NJ", "\u01cb": "Nj", "\u24c4": "O", "\uff2f": "O", "Ò": "O", "Ó": "O", "Ô": "O", "\u1ed2": "O", "\u1ed0": "O", "\u1ed6": "O", "\u1ed4": "O", "Õ": "O", "\u1e4c": "O", "\u022c": "O", "\u1e4e": "O", "\u014c": "O", "\u1e50": "O", "\u1e52": "O", "\u014e": "O", "\u022e": "O", "\u0230": "O", "Ö": "O", "\u022a": "O", "\u1ece": "O", "\u0150": "O", "\u01d1": "O",
                "\u020c": "O", "\u020e": "O", "\u01a0": "O", "\u1edc": "O", "\u1eda": "O", "\u1ee0": "O", "\u1ede": "O", "\u1ee2": "O", "\u1ecc": "O", "\u1ed8": "O", "\u01ea": "O", "\u01ec": "O", "Ø": "O", "\u01fe": "O", "\u0186": "O", "\u019f": "O", "\ua74a": "O", "\ua74c": "O", "\u0152": "OE", "\u01a2": "OI", "\ua74e": "OO", "\u0222": "OU", "\u24c5": "P", "\uff30": "P", "\u1e54": "P", "\u1e56": "P", "\u01a4": "P", "\u2c63": "P", "\ua750": "P", "\ua752": "P", "\ua754": "P", "\u24c6": "Q", "\uff31": "Q", "\ua756": "Q", "\ua758": "Q", "\u024a": "Q", "\u24c7": "R", "\uff32": "R", "\u0154": "R",
                "\u1e58": "R", "\u0158": "R", "\u0210": "R", "\u0212": "R", "\u1e5a": "R", "\u1e5c": "R", "\u0156": "R", "\u1e5e": "R", "\u024c": "R", "\u2c64": "R", "\ua75a": "R", "\ua7a6": "R", "\ua782": "R", "\u24c8": "S", "\uff33": "S", "\u1e9e": "S", "\u015a": "S", "\u1e64": "S", "\u015c": "S", "\u1e60": "S", "\u0160": "S", "\u1e66": "S", "\u1e62": "S", "\u1e68": "S", "\u0218": "S", "\u015e": "S", "\u2c7e": "S", "\ua7a8": "S", "\ua784": "S", "\u24c9": "T", "\uff34": "T", "\u1e6a": "T", "\u0164": "T", "\u1e6c": "T", "\u021a": "T", "\u0162": "T", "\u1e70": "T", "\u1e6e": "T", "\u0166": "T",
                "\u01ac": "T", "\u01ae": "T", "\u023e": "T", "\ua786": "T", "\ua728": "TZ", "\u24ca": "U", "\uff35": "U", "Ù": "U", "Ú": "U", "Û": "U", "\u0168": "U", "\u1e78": "U", "\u016a": "U", "\u1e7a": "U", "\u016c": "U", "Ü": "U", "\u01db": "U", "\u01d7": "U", "\u01d5": "U", "\u01d9": "U", "\u1ee6": "U", "\u016e": "U", "\u0170": "U", "\u01d3": "U", "\u0214": "U", "\u0216": "U", "\u01af": "U", "\u1eea": "U", "\u1ee8": "U", "\u1eee": "U", "\u1eec": "U", "\u1ef0": "U", "\u1ee4": "U", "\u1e72": "U", "\u0172": "U", "\u1e76": "U", "\u1e74": "U", "\u0244": "U", "\u24cb": "V", "\uff36": "V",
                "\u1e7c": "V", "\u1e7e": "V", "\u01b2": "V", "\ua75e": "V", "\u0245": "V", "\ua760": "VY", "\u24cc": "W", "\uff37": "W", "\u1e80": "W", "\u1e82": "W", "\u0174": "W", "\u1e86": "W", "\u1e84": "W", "\u1e88": "W", "\u2c72": "W", "\u24cd": "X", "\uff38": "X", "\u1e8a": "X", "\u1e8c": "X", "\u24ce": "Y", "\uff39": "Y", "\u1ef2": "Y", "Ý": "Y", "\u0176": "Y", "\u1ef8": "Y", "\u0232": "Y", "\u1e8e": "Y", "\u0178": "Y", "\u1ef6": "Y", "\u1ef4": "Y", "\u01b3": "Y", "\u024e": "Y", "\u1efe": "Y", "\u24cf": "Z", "\uff3a": "Z", "\u0179": "Z", "\u1e90": "Z", "\u017b": "Z", "\u017d": "Z",
                "\u1e92": "Z", "\u1e94": "Z", "\u01b5": "Z", "\u0224": "Z", "\u2c7f": "Z", "\u2c6b": "Z", "\ua762": "Z", "\u24d0": "a", "\uff41": "a", "\u1e9a": "a", "à": "a", "á": "a", "â": "a", "\u1ea7": "a", "\u1ea5": "a", "\u1eab": "a", "\u1ea9": "a", "ã": "a", "\u0101": "a", "\u0103": "a", "\u1eb1": "a", "\u1eaf": "a", "\u1eb5": "a", "\u1eb3": "a", "\u0227": "a", "\u01e1": "a", "ä": "a", "\u01df": "a", "\u1ea3": "a", "å": "a", "\u01fb": "a", "\u01ce": "a", "\u0201": "a", "\u0203": "a", "\u1ea1": "a", "\u1ead": "a", "\u1eb7": "a", "\u1e01": "a", "\u0105": "a", "\u2c65": "a", "\u0250": "a",
                "\ua733": "aa", "æ": "ae", "\u01fd": "ae", "\u01e3": "ae", "\ua735": "ao", "\ua737": "au", "\ua739": "av", "\ua73b": "av", "\ua73d": "ay", "\u24d1": "b", "\uff42": "b", "\u1e03": "b", "\u1e05": "b", "\u1e07": "b", "\u0180": "b", "\u0183": "b", "\u0253": "b", "\u24d2": "c", "\uff43": "c", "\u0107": "c", "\u0109": "c", "\u010b": "c", "\u010d": "c", "ç": "c", "\u1e09": "c", "\u0188": "c", "\u023c": "c", "\ua73f": "c", "\u2184": "c", "\u24d3": "d", "\uff44": "d", "\u1e0b": "d", "\u010f": "d", "\u1e0d": "d", "\u1e11": "d", "\u1e13": "d", "\u1e0f": "d", "\u0111": "d", "\u018c": "d",
                "\u0256": "d", "\u0257": "d", "\ua77a": "d", "\u01f3": "dz", "\u01c6": "dz", "\u24d4": "e", "\uff45": "e", "è": "e", "é": "e", "ê": "e", "\u1ec1": "e", "\u1ebf": "e", "\u1ec5": "e", "\u1ec3": "e", "\u1ebd": "e", "\u0113": "e", "\u1e15": "e", "\u1e17": "e", "\u0115": "e", "\u0117": "e", "ë": "e", "\u1ebb": "e", "\u011b": "e", "\u0205": "e", "\u0207": "e", "\u1eb9": "e", "\u1ec7": "e", "\u0229": "e", "\u1e1d": "e", "\u0119": "e", "\u1e19": "e", "\u1e1b": "e", "\u0247": "e", "\u025b": "e", "\u01dd": "e", "\u24d5": "f", "\uff46": "f", "\u1e1f": "f", "\u0192": "f", "\ua77c": "f",
                "\u24d6": "g", "\uff47": "g", "\u01f5": "g", "\u011d": "g", "\u1e21": "g", "\u011f": "g", "\u0121": "g", "\u01e7": "g", "\u0123": "g", "\u01e5": "g", "\u0260": "g", "\ua7a1": "g", "\u1d79": "g", "\ua77f": "g", "\u24d7": "h", "\uff48": "h", "\u0125": "h", "\u1e23": "h", "\u1e27": "h", "\u021f": "h", "\u1e25": "h", "\u1e29": "h", "\u1e2b": "h", "\u1e96": "h", "\u0127": "h", "\u2c68": "h", "\u2c76": "h", "\u0265": "h", "\u0195": "hv", "\u24d8": "i", "\uff49": "i", "ì": "i", "í": "i", "î": "i", "\u0129": "i", "\u012b": "i", "\u012d": "i", "ï": "i", "\u1e2f": "i", "\u1ec9": "i",
                "\u01d0": "i", "\u0209": "i", "\u020b": "i", "\u1ecb": "i", "\u012f": "i", "\u1e2d": "i", "\u0268": "i", "\u0131": "i", "\u24d9": "j", "\uff4a": "j", "\u0135": "j", "\u01f0": "j", "\u0249": "j", "\u24da": "k", "\uff4b": "k", "\u1e31": "k", "\u01e9": "k", "\u1e33": "k", "\u0137": "k", "\u1e35": "k", "\u0199": "k", "\u2c6a": "k", "\ua741": "k", "\ua743": "k", "\ua745": "k", "\ua7a3": "k", "\u24db": "l", "\uff4c": "l", "\u0140": "l", "\u013a": "l", "\u013e": "l", "\u1e37": "l", "\u1e39": "l", "\u013c": "l", "\u1e3d": "l", "\u1e3b": "l", "\u017f": "l", "\u0142": "l", "\u019a": "l",
                "\u026b": "l", "\u2c61": "l", "\ua749": "l", "\ua781": "l", "\ua747": "l", "\u01c9": "lj", "\u24dc": "m", "\uff4d": "m", "\u1e3f": "m", "\u1e41": "m", "\u1e43": "m", "\u0271": "m", "\u026f": "m", "\u24dd": "n", "\uff4e": "n", "\u01f9": "n", "\u0144": "n", "ñ": "n", "\u1e45": "n", "\u0148": "n", "\u1e47": "n", "\u0146": "n", "\u1e4b": "n", "\u1e49": "n", "\u019e": "n", "\u0272": "n", "\u0149": "n", "\ua791": "n", "\ua7a5": "n", "\u01cc": "nj", "\u24de": "o", "\uff4f": "o", "ò": "o", "ó": "o", "ô": "o", "\u1ed3": "o", "\u1ed1": "o", "\u1ed7": "o", "\u1ed5": "o", "õ": "o", "\u1e4d": "o",
                "\u022d": "o", "\u1e4f": "o", "\u014d": "o", "\u1e51": "o", "\u1e53": "o", "\u014f": "o", "\u022f": "o", "\u0231": "o", "ö": "o", "\u022b": "o", "\u1ecf": "o", "\u0151": "o", "\u01d2": "o", "\u020d": "o", "\u020f": "o", "\u01a1": "o", "\u1edd": "o", "\u1edb": "o", "\u1ee1": "o", "\u1edf": "o", "\u1ee3": "o", "\u1ecd": "o", "\u1ed9": "o", "\u01eb": "o", "\u01ed": "o", "ø": "o", "\u01ff": "o", "\u0254": "o", "\ua74b": "o", "\ua74d": "o", "\u0275": "o", "\u0153": "oe", "\u01a3": "oi", "\u0223": "ou", "\ua74f": "oo", "\u24df": "p", "\uff50": "p", "\u1e55": "p", "\u1e57": "p",
                "\u01a5": "p", "\u1d7d": "p", "\ua751": "p", "\ua753": "p", "\ua755": "p", "\u24e0": "q", "\uff51": "q", "\u024b": "q", "\ua757": "q", "\ua759": "q", "\u24e1": "r", "\uff52": "r", "\u0155": "r", "\u1e59": "r", "\u0159": "r", "\u0211": "r", "\u0213": "r", "\u1e5b": "r", "\u1e5d": "r", "\u0157": "r", "\u1e5f": "r", "\u024d": "r", "\u027d": "r", "\ua75b": "r", "\ua7a7": "r", "\ua783": "r", "\u24e2": "s", "\uff53": "s", "ß": "s", "\u015b": "s", "\u1e65": "s", "\u015d": "s", "\u1e61": "s", "\u0161": "s", "\u1e67": "s", "\u1e63": "s", "\u1e69": "s", "\u0219": "s", "\u015f": "s",
                "\u023f": "s", "\ua7a9": "s", "\ua785": "s", "\u1e9b": "s", "\u24e3": "t", "\uff54": "t", "\u1e6b": "t", "\u1e97": "t", "\u0165": "t", "\u1e6d": "t", "\u021b": "t", "\u0163": "t", "\u1e71": "t", "\u1e6f": "t", "\u0167": "t", "\u01ad": "t", "\u0288": "t", "\u2c66": "t", "\ua787": "t", "\ua729": "tz", "\u24e4": "u", "\uff55": "u", "ù": "u", "ú": "u", "û": "u", "\u0169": "u", "\u1e79": "u", "\u016b": "u", "\u1e7b": "u", "\u016d": "u", "ü": "u", "\u01dc": "u", "\u01d8": "u", "\u01d6": "u", "\u01da": "u", "\u1ee7": "u", "\u016f": "u", "\u0171": "u", "\u01d4": "u", "\u0215": "u",
                "\u0217": "u", "\u01b0": "u", "\u1eeb": "u", "\u1ee9": "u", "\u1eef": "u", "\u1eed": "u", "\u1ef1": "u", "\u1ee5": "u", "\u1e73": "u", "\u0173": "u", "\u1e77": "u", "\u1e75": "u", "\u0289": "u", "\u24e5": "v", "\uff56": "v", "\u1e7d": "v", "\u1e7f": "v", "\u028b": "v", "\ua75f": "v", "\u028c": "v", "\ua761": "vy", "\u24e6": "w", "\uff57": "w", "\u1e81": "w", "\u1e83": "w", "\u0175": "w", "\u1e87": "w", "\u1e85": "w", "\u1e98": "w", "\u1e89": "w", "\u2c73": "w", "\u24e7": "x", "\uff58": "x", "\u1e8b": "x", "\u1e8d": "x", "\u24e8": "y", "\uff59": "y", "\u1ef3": "y", "ý": "y",
                "\u0177": "y", "\u1ef9": "y", "\u0233": "y", "\u1e8f": "y", "ÿ": "y", "\u1ef7": "y", "\u1e99": "y", "\u1ef5": "y", "\u01b4": "y", "\u024f": "y", "\u1eff": "y", "\u24e9": "z", "\uff5a": "z", "\u017a": "z", "\u1e91": "z", "\u017c": "z", "\u017e": "z", "\u1e93": "z", "\u1e95": "z", "\u01b6": "z", "\u0225": "z", "\u0240": "z", "\u2c6c": "z", "\ua763": "z", "\u0386": "\u0391", "\u0388": "\u0395", "\u0389": "\u0397", "\u038a": "\u0399", "\u03aa": "\u0399", "\u038c": "\u039f", "\u038e": "\u03a5", "\u03ab": "\u03a5", "\u038f": "\u03a9", "\u03ac": "\u03b1", "\u03ad": "\u03b5",
                "\u03ae": "\u03b7", "\u03af": "\u03b9", "\u03ca": "\u03b9", "\u0390": "\u03b9", "\u03cc": "\u03bf", "\u03cd": "\u03c5", "\u03cb": "\u03c5", "\u03b0": "\u03c5", "\u03ce": "\u03c9", "\u03c2": "\u03c3", "\u2019": "'"
            }
        }); e.define("select2/data/base", ["../utils"], function (a) {
            function d(a, c) { d.__super__.constructor.call(this) } a.Extend(d, a.Observable); d.prototype.current = function (a) { throw Error("The `current` method must be defined in child classes."); }; d.prototype.query = function (a, c) {
                throw Error("The `query` method must be defined in child classes.");
            }; d.prototype.bind = function (a, c) { }; d.prototype.destroy = function () { }; d.prototype.generateResultId = function (b, d) { var e = b.id + "-result-", e = e + a.generateChars(4); return e = null != d.id ? e + ("-" + d.id.toString()) : e + ("-" + a.generateChars(4)) }; return d
        }); e.define("select2/data/select", ["./base", "../utils", "jquery"], function (a, d, b) {
            function e(a, b) { this.$element = a; this.options = b; e.__super__.constructor.call(this) } d.Extend(e, a); e.prototype.current = function (a) {
                var c = [], d = this; this.$element.find(":selected").each(function () {
                    var a =
                        b(this), a = d.item(a); c.push(a)
                }); a(c)
            }; e.prototype.select = function (a) { var c = this; a.selected = !0; b(a.element).is("option") ? (a.element.selected = !0, this.$element.trigger("change")) : this.$element.prop("multiple") ? this.current(function (d) { var e = []; a = [a]; a.push.apply(a, d); for (d = 0; d < a.length; d++) { var f = a[d].id; -1 === b.inArray(f, e) && e.push(f) } c.$element.val(e); c.$element.trigger("change") }) : (this.$element.val(a.id), this.$element.trigger("change")) }; e.prototype.unselect = function (a) {
                var c = this; this.$element.prop("multiple") &&
                    (a.selected = !1, b(a.element).is("option") ? (a.element.selected = !1, this.$element.trigger("change")) : this.current(function (d) { for (var e = [], f = 0; f < d.length; f++) { var h = d[f].id; h !== a.id && -1 === b.inArray(h, e) && e.push(h) } c.$element.val(e); c.$element.trigger("change") }))
            }; e.prototype.bind = function (a, b) { var c = this; this.container = a; a.on("select", function (a) { c.select(a.data) }); a.on("unselect", function (a) { c.unselect(a.data) }) }; e.prototype.destroy = function () { this.$element.find("*").each(function () { d.RemoveData(this) }) };
            e.prototype.query = function (a, c) { var d = [], e = this; this.$element.children().each(function () { var c = b(this); if (c.is("option") || c.is("optgroup")) c = e.item(c), c = e.matches(a, c), null !== c && d.push(c) }); c({ results: d }) }; e.prototype.addOptions = function (a) { d.appendMany(this.$element, a) }; e.prototype.option = function (a) {
                var c; a.children ? (c = document.createElement("optgroup"), c.label = a.text) : (c = document.createElement("option"), void 0 !== c.textContent ? c.textContent = a.text : c.innerText = a.text); void 0 !== a.id && (c.value = a.id);
                a.disabled && (c.disabled = !0); a.selected && (c.selected = !0); a.title && (c.title = a.title); var e = b(c); a = this._normalizeItem(a); a.element = c; d.StoreData(c, "data", a); return e
            }; e.prototype.item = function (a) {
                var c = {}, c = d.GetData(a[0], "data"); if (null != c) return c; if (a.is("option")) c = { id: a.val(), text: a.text(), disabled: a.prop("disabled"), selected: a.prop("selected"), title: a.prop("title") }; else if (a.is("optgroup")) {
                    for (var c = { text: a.prop("label"), children: [], title: a.prop("title") }, e = a.children("option"), f = [], h = 0; h < e.length; h++) {
                        var l =
                            b(e[h]), l = this.item(l); f.push(l)
                    } c.children = f
                } c = this._normalizeItem(c); c.element = a[0]; d.StoreData(a[0], "data", c); return c
            }; e.prototype._normalizeItem = function (a) { a !== Object(a) && (a = { id: a, text: a }); a = b.extend({}, { text: "" }, a); null != a.id && (a.id = a.id.toString()); null != a.text && (a.text = a.text.toString()); null == a._resultId && a.id && null != this.container && (a._resultId = this.generateResultId(this.container, a)); return b.extend({}, { selected: !1, disabled: !1 }, a) }; e.prototype.matches = function (a, b) {
                return this.options.get("matcher")(a,
                    b)
            }; return e
        }); e.define("select2/data/array", ["./select", "../utils", "jquery"], function (a, d, b) {
            function e(a, b) { var c = b.get("data") || []; e.__super__.constructor.call(this, a, b); this.addOptions(this.convertToOptions(c)) } d.Extend(e, a); e.prototype.select = function (a) { var b = this.$element.find("option").filter(function (b, c) { return c.value == a.id.toString() }); 0 === b.length && (b = this.option(a), this.addOptions(b)); e.__super__.select.call(this, a) }; e.prototype.convertToOptions = function (a) {
                function c(a) {
                    return function () {
                        return b(this).val() ==
                            a.id
                    }
                } for (var e = this, f = this.$element.find("option"), h = f.map(function () { return e.item(b(this)).id }).get(), l = [], v = 0; v < a.length; v++) { var y = this._normalizeItem(a[v]); if (0 <= b.inArray(y.id, h)) { var g = f.filter(c(y)), u = this.item(g), y = b.extend(!0, {}, y, u), y = this.option(y); g.replaceWith(y) } else g = this.option(y), y.children && (y = this.convertToOptions(y.children), d.appendMany(g, y)), l.push(g) } return l
            }; return e
        }); e.define("select2/data/ajax", ["./array", "../utils", "jquery"], function (a, d, b) {
            function e(a, b) {
                this.ajaxOptions =
                this._applyDefaults(b.get("ajax")); null != this.ajaxOptions.processResults && (this.processResults = this.ajaxOptions.processResults); e.__super__.constructor.call(this, a, b)
            } d.Extend(e, a); e.prototype._applyDefaults = function (a) { return b.extend({}, { data: function (a) { return b.extend({}, a, { q: a.term }) }, transport: function (a, c, d) { a = b.ajax(a); a.then(c); a.fail(d); return a } }, a, !0) }; e.prototype.processResults = function (a) { return a }; e.prototype.query = function (a, c) {
                function d() {
                    var h = f.transport(f, function (d) {
                        d = e.processResults(d,
                            a); e.options.get("debug") && window.console && console.error && (d && d.results && b.isArray(d.results) || console.error("Select2: The AJAX results did not return an array in the `results` key of the response.")); c(d)
                    }, function () { "status" in h && (0 === h.status || "0" === h.status) || e.trigger("results:message", { message: "errorLoading" }) }); e._request = h
                } var e = this; null != this._request && (b.isFunction(this._request.abort) && this._request.abort(), this._request = null); var f = b.extend({ type: "GET" }, this.ajaxOptions); "function" ===
                    typeof f.url && (f.url = f.url.call(this.$element, a)); "function" === typeof f.data && (f.data = f.data.call(this.$element, a)); this.ajaxOptions.delay && null != a.term ? (this._queryTimeout && window.clearTimeout(this._queryTimeout), this._queryTimeout = window.setTimeout(d, this.ajaxOptions.delay)) : d()
            }; return e
        }); e.define("select2/data/tags", ["jquery"], function (a) {
            function d(b, d, e) {
                var k = e.get("tags"), h = e.get("createTag"); void 0 !== h && (this.createTag = h); h = e.get("insertTag"); void 0 !== h && (this.insertTag = h); b.call(this, d,
                    e); if (a.isArray(k)) for (b = 0; b < k.length; b++)d = this._normalizeItem(k[b]), d = this.option(d), this.$element.append(d)
            } d.prototype.query = function (a, c, d) {
                function e(a, b) { for (var l = a.results, v = 0; v < l.length; v++) { var y = l[v], g = null != y.children && !e({ results: y.children }, !0), y = (y.text || "").toUpperCase(), u = (c.term || "").toUpperCase(); if (y === u || g) { if (b) return !1; a.data = l; d(a); return } } if (b) return !0; v = h.createTag(c); null != v && (g = h.option(v), g.attr("data-select2-tag", !0), h.addOptions([g]), h.insertTag(l, v)); a.results = l; d(a) }
                var h = this; this._removeOldTags(); null == c.term || null != c.page ? a.call(this, c, d) : a.call(this, c, e)
            }; d.prototype.createTag = function (b, d) { var e = a.trim(d.term); return "" === e ? null : { id: e, text: e } }; d.prototype.insertTag = function (a, c, d) { c.unshift(d) }; d.prototype._removeOldTags = function (b) { this.$element.find("option[data-select2-tag]").each(function () { this.selected || a(this).remove() }) }; return d
        }); e.define("select2/data/tokenizer", ["jquery"], function (a) {
            function d(a, c, d) {
                var e = d.get("tokenizer"); void 0 !== e && (this.tokenizer =
                    e); a.call(this, c, d)
            } d.prototype.bind = function (a, c, d) { a.call(this, c, d); this.$search = c.dropdown.$search || c.selection.$search || d.find(".select2-search__field") }; d.prototype.query = function (b, d, e) {
                var k = this; d.term = d.term || ""; var h = this.tokenizer(d, this.options, function (b) { var d = k._normalizeItem(b); k.$element.find("option").filter(function () { return a(this).val() === d.id }).length || (b = k.option(d), b.attr("data-select2-tag", !0), k._removeOldTags(), k.addOptions([b])); k.trigger("select", { data: d }) }); h.term !== d.term &&
                    (this.$search.length && (this.$search.val(h.term), this.$search.focus()), d.term = h.term); b.call(this, d, e)
            }; d.prototype.tokenizer = function (b, d, e, h) { b = e.get("tokenSeparators") || []; e = d.term; for (var l = 0, z = this.createTag || function (a) { return { id: a.term, text: a.term } }; l < e.length;)if (-1 === a.inArray(e[l], b)) l++; else { var t = e.substr(0, l), t = a.extend({}, d, { term: t }), t = z(t); null == t ? l++ : (h(t), e = e.substr(l + 1) || "", l = 0) } return { term: e } }; return d
        }); e.define("select2/data/minimumInputLength", [], function () {
            function a(c, b, e) {
                this.minimumInputLength =
                e.get("minimumInputLength"); c.call(this, b, e)
            } a.prototype.query = function (a, b, c) { b.term = b.term || ""; b.term.length < this.minimumInputLength ? this.trigger("results:message", { message: "inputTooShort", args: { minimum: this.minimumInputLength, input: b.term, params: b } }) : a.call(this, b, c) }; return a
        }); e.define("select2/data/maximumInputLength", [], function () {
            function a(c, b, e) { this.maximumInputLength = e.get("maximumInputLength"); c.call(this, b, e) } a.prototype.query = function (a, b, c) {
                b.term = b.term || ""; 0 < this.maximumInputLength &&
                    b.term.length > this.maximumInputLength ? this.trigger("results:message", { message: "inputTooLong", args: { maximum: this.maximumInputLength, input: b.term, params: b } }) : a.call(this, b, c)
            }; return a
        }); e.define("select2/data/maximumSelectionLength", [], function () {
            function a(c, b, e) { this.maximumSelectionLength = e.get("maximumSelectionLength"); c.call(this, b, e) } a.prototype.query = function (a, b, c) {
                var e = this; this.current(function (h) {
                    h = null != h ? h.length : 0; 0 < e.maximumSelectionLength && h >= e.maximumSelectionLength ? e.trigger("results:message",
                        { message: "maximumSelected", args: { maximum: e.maximumSelectionLength } }) : a.call(e, b, c)
                })
            }; return a
        }); e.define("select2/dropdown", ["jquery", "./utils"], function (a, d) {
            function b(a, c) { this.$element = a; this.options = c; b.__super__.constructor.call(this) } d.Extend(b, d.Observable); b.prototype.render = function () { var b = a('\x3cspan class\x3d"select2-dropdown"\x3e\x3cspan class\x3d"select2-results"\x3e\x3c/span\x3e\x3c/span\x3e'); b.attr("dir", this.options.get("dir")); return this.$dropdown = b }; b.prototype.bind = function () { };
            b.prototype.position = function (a, b) { }; b.prototype.destroy = function () { this.$dropdown.remove() }; return b
        }); e.define("select2/dropdown/search", ["jquery", "../utils"], function (a, d) {
            function b() { } b.prototype.render = function (b) {
                b = b.call(this); var d = a('\x3cspan class\x3d"select2-search select2-search--dropdown"\x3e\x3cinput class\x3d"select2-search__field" type\x3d"search" tabindex\x3d"-1" autocomplete\x3d"off" autocorrect\x3d"off" autocapitalize\x3d"none" spellcheck\x3d"false" role\x3d"textbox" /\x3e\x3c/span\x3e');
                this.$searchContainer = d; this.$search = d.find("input"); b.prepend(d); return b
            }; b.prototype.bind = function (b, d, e) {
                var h = this; b.call(this, d, e); this.$search.on("keydown", function (a) { h.trigger("keypress", a); h._keyUpPrevented = a.isDefaultPrevented() }); this.$search.on("input", function (b) { a(this).off("keyup") }); this.$search.on("keyup input", function (a) { h.handleSearch(a) }); d.on("open", function () { h.$search.attr("tabindex", 0); h.$search.focus(); window.setTimeout(function () { h.$search.focus() }, 0) }); d.on("close", function () {
                    h.$search.attr("tabindex",
                        -1); h.$search.val(""); h.$search.blur()
                }); d.on("focus", function () { d.isOpen() || h.$search.focus() }); d.on("results:all", function (a) { if (null == a.query.term || "" === a.query.term) h.showSearch(a) ? h.$searchContainer.removeClass("select2-search--hide") : h.$searchContainer.addClass("select2-search--hide") })
            }; b.prototype.handleSearch = function (a) { this._keyUpPrevented || (a = this.$search.val(), this.trigger("query", { term: a })); this._keyUpPrevented = !1 }; b.prototype.showSearch = function (a, b) { return !0 }; return b
        }); e.define("select2/dropdown/hidePlaceholder",
            [], function () { function a(c, b, e, h) { this.placeholder = this.normalizePlaceholder(e.get("placeholder")); c.call(this, b, e, h) } a.prototype.append = function (a, b) { b.results = this.removePlaceholder(b.results); a.call(this, b) }; a.prototype.normalizePlaceholder = function (a, b) { "string" === typeof b && (b = { id: "", text: b }); return b }; a.prototype.removePlaceholder = function (a, b) { for (var c = b.slice(0), e = b.length - 1; 0 <= e; e--)this.placeholder.id === b[e].id && c.splice(e, 1); return c }; return a }); e.define("select2/dropdown/infiniteScroll",
                ["jquery"], function (a) {
                    function d(a, c, d, e) { this.lastParams = {}; a.call(this, c, d, e); this.$loadingMore = this.createLoadingMore(); this.loading = !1 } d.prototype.append = function (a, c) { this.$loadingMore.remove(); this.loading = !1; a.call(this, c); this.showLoadingMore(c) && this.$results.append(this.$loadingMore) }; d.prototype.bind = function (b, d, e) {
                        var h = this; b.call(this, d, e); d.on("query", function (a) { h.lastParams = a; h.loading = !0 }); d.on("query:append", function (a) { h.lastParams = a; h.loading = !0 }); this.$results.on("scroll",
                            function () { var b = a.contains(document.documentElement, h.$loadingMore[0]); if (!h.loading && b) { var b = h.$results.offset().top + h.$results.outerHeight(!1), d = h.$loadingMore.offset().top + h.$loadingMore.outerHeight(!1); b + 50 >= d && h.loadMore() } })
                    }; d.prototype.loadMore = function () { this.loading = !0; var b = a.extend({}, { page: 1 }, this.lastParams); b.page++; this.trigger("query:append", b) }; d.prototype.showLoadingMore = function (a, c) { return c.pagination && c.pagination.more }; d.prototype.createLoadingMore = function () {
                        var b = a('\x3cli class\x3d"select2-results__option select2-results__option--load-more"role\x3d"treeitem" aria-disabled\x3d"true"\x3e\x3c/li\x3e'),
                        d = this.options.get("translations").get("loadingMore"); b.html(d(this.lastParams)); return b
                    }; return d
                }); e.define("select2/dropdown/attachBody", ["jquery", "../utils"], function (a, d) {
                    function b(b, d, e) { this.$dropdownParent = e.get("dropdownParent") || a(document.body); b.call(this, d, e) } b.prototype.bind = function (a, b, c) {
                        var d = this, e = !1; a.call(this, b, c); b.on("open", function () {
                            d._showDropdown(); d._attachPositioningHandler(b); e || (e = !0, b.on("results:all", function () { d._positionDropdown(); d._resizeDropdown() }), b.on("results:append",
                                function () { d._positionDropdown(); d._resizeDropdown() }))
                        }); b.on("close", function () { d._hideDropdown(); d._detachPositioningHandler(b) }); this.$dropdownContainer.on("mousedown", function (a) { a.stopPropagation() })
                    }; b.prototype.destroy = function (a) { a.call(this); this.$dropdownContainer.remove() }; b.prototype.position = function (a, b, c) { b.attr("class", c.attr("class")); b.removeClass("select2"); b.addClass("select2-container--open"); b.css({ position: "absolute", top: -999999 }); this.$container = c }; b.prototype.render = function (b) {
                        var d =
                            a("\x3cspan\x3e\x3c/span\x3e"); b = b.call(this); d.append(b); return this.$dropdownContainer = d
                    }; b.prototype._hideDropdown = function (a) { this.$dropdownContainer.detach() }; b.prototype._attachPositioningHandler = function (b, e) {
                        var h = this, l = "scroll.select2." + e.id, z = "resize.select2." + e.id, t = "orientationchange.select2." + e.id, s = this.$container.parents().filter(d.hasScroll); s.each(function () { d.StoreData(this, "select2-scroll-position", { x: a(this).scrollLeft(), y: a(this).scrollTop() }) }); s.on(l, function (b) {
                            b = d.GetData(this,
                                "select2-scroll-position"); a(this).scrollTop(b.y)
                        }); a(window).on(l + " " + z + " " + t, function (a) { h._positionDropdown(); h._resizeDropdown() })
                    }; b.prototype._detachPositioningHandler = function (b, e) { var h = "scroll.select2." + e.id, l = "resize.select2." + e.id, z = "orientationchange.select2." + e.id; this.$container.parents().filter(d.hasScroll).off(h); a(window).off(h + " " + l + " " + z) }; b.prototype._positionDropdown = function () {
                        var b = a(window), d = this.$dropdown.hasClass("select2-dropdown--above"), e = this.$dropdown.hasClass("select2-dropdown--below"),
                        h = null, l = this.$container.offset(); l.bottom = l.top + this.$container.outerHeight(!1); var t = this.$container.outerHeight(!1), s, v; s = l.top; v = l.top + t; var t = this.$dropdown.outerHeight(!1), y = b.scrollTop(), g = b.scrollTop() + b.height(), b = y < l.top - t, y = g > l.bottom + t, l = { left: l.left, top: v }; v = this.$dropdownParent; "static" === v.css("position") && (v = v.offsetParent()); v = v.offset(); l.top -= v.top; l.left -= v.left; d || e || (h = "below"); y || !b || d ? !b && y && d && (h = "below") : h = "above"; if ("above" == h || d && "below" !== h) l.top = s - v.top - t; null != h && (this.$dropdown.removeClass("select2-dropdown--below select2-dropdown--above").addClass("select2-dropdown--" +
                            h), this.$container.removeClass("select2-container--below select2-container--above").addClass("select2-container--" + h)); this.$dropdownContainer.css(l)
                    }; b.prototype._resizeDropdown = function () { var a = { width: this.$container.outerWidth(!1) + "px" }; this.options.get("dropdownAutoWidth") && (a.minWidth = a.width, a.position = "relative", a.width = "auto"); this.$dropdown.css(a) }; b.prototype._showDropdown = function (a) { this.$dropdownContainer.appendTo(this.$dropdownParent); this._positionDropdown(); this._resizeDropdown() };
                    return b
                }); e.define("select2/dropdown/minimumResultsForSearch", [], function () { function a(b) { for (var d = 0, e = 0; e < b.length; e++) { var h = b[e]; h.children ? d += a(h.children) : d++ } return d } function d(a, c, d, e) { this.minimumResultsForSearch = d.get("minimumResultsForSearch"); 0 > this.minimumResultsForSearch && (this.minimumResultsForSearch = Infinity); a.call(this, c, d, e) } d.prototype.showSearch = function (b, d) { return a(d.data.results) < this.minimumResultsForSearch ? !1 : b.call(this, d) }; return d }); e.define("select2/dropdown/selectOnClose",
                    ["../utils"], function (a) { function d() { } d.prototype.bind = function (a, c, d) { var e = this; a.call(this, c, d); c.on("close", function (a) { e._handleSelectOnClose(a) }) }; d.prototype._handleSelectOnClose = function (b, d) { if (d && null != d.originalSelect2Event) { var e = d.originalSelect2Event; if ("select" === e._type || "unselect" === e._type) return } e = this.getHighlightedResults(); 1 > e.length || (e = a.GetData(e[0], "data"), null != e.element && e.element.selected || null == e.element && e.selected || this.trigger("select", { data: e })) }; return d }); e.define("select2/dropdown/closeOnSelect",
                        [], function () { function a() { } a.prototype.bind = function (a, b, c) { var e = this; a.call(this, b, c); b.on("select", function (a) { e._selectTriggered(a) }); b.on("unselect", function (a) { e._selectTriggered(a) }) }; a.prototype._selectTriggered = function (a, b) { var c = b.originalEvent; c && (c.ctrlKey || c.metaKey) || this.trigger("close", { originalEvent: c, originalSelect2Event: b }) }; return a }); e.define("select2/i18n/en", [], function () {
                            return {
                                errorLoading: function () { return "The results could not be loaded." }, inputTooLong: function (a) {
                                    a = a.input.length -
                                    a.maximum; var d = "Please delete " + a + " character"; 1 != a && (d += "s"); return d
                                }, inputTooShort: function (a) { return "Please enter " + (a.minimum - a.input.length) + " or more characters" }, loadingMore: function () { return "Loading more resultsâ€¦" }, maximumSelected: function (a) { var d = "You can only select " + a.maximum + " item"; 1 != a.maximum && (d += "s"); return d }, noResults: function () { return "No results found" }, searching: function () { return "Searchingâ€¦" }, removeAllItems: function () { return "Remove all items" }
                            }
                        }); e.define("select2/defaults",
                            "jquery require ./results ./selection/single ./selection/multiple ./selection/placeholder ./selection/allowClear ./selection/search ./selection/eventRelay ./utils ./translation ./diacritics ./data/select ./data/array ./data/ajax ./data/tags ./data/tokenizer ./data/minimumInputLength ./data/maximumInputLength ./data/maximumSelectionLength ./dropdown ./dropdown/search ./dropdown/hidePlaceholder ./dropdown/infiniteScroll ./dropdown/attachBody ./dropdown/minimumResultsForSearch ./dropdown/selectOnClose ./dropdown/closeOnSelect ./i18n/en".split(" "),
                            function (a, d, b, e, h, k, l, z, t, s, v, y, g, u, q, w, x, D, A, I, E, O, C, S, B, K, Y, F, T) {
                                function U() { this.reset() } U.prototype.apply = function (H) {
                                    H = a.extend(!0, {}, this.defaults, H); if (null == H.dataAdapter) {
                                        H.dataAdapter = null != H.ajax ? q : null != H.data ? u : g; 0 < H.minimumInputLength && (H.dataAdapter = s.Decorate(H.dataAdapter, D)); 0 < H.maximumInputLength && (H.dataAdapter = s.Decorate(H.dataAdapter, A)); 0 < H.maximumSelectionLength && (H.dataAdapter = s.Decorate(H.dataAdapter, I)); H.tags && (H.dataAdapter = s.Decorate(H.dataAdapter, w)); if (null != H.tokenSeparators ||
                                            null != H.tokenizer) H.dataAdapter = s.Decorate(H.dataAdapter, x); if (null != H.query) { var y = d(H.amdBase + "compat/query"); H.dataAdapter = s.Decorate(H.dataAdapter, y) } null != H.initSelection && (y = d(H.amdBase + "compat/initSelection"), H.dataAdapter = s.Decorate(H.dataAdapter, y))
                                    } null == H.resultsAdapter && (H.resultsAdapter = b, null != H.ajax && (H.resultsAdapter = s.Decorate(H.resultsAdapter, S)), null != H.placeholder && (H.resultsAdapter = s.Decorate(H.resultsAdapter, C)), H.selectOnClose && (H.resultsAdapter = s.Decorate(H.resultsAdapter,
                                        Y))); if (null == H.dropdownAdapter) { H.multiple ? H.dropdownAdapter = E : (y = s.Decorate(E, O), H.dropdownAdapter = y); 0 !== H.minimumResultsForSearch && (H.dropdownAdapter = s.Decorate(H.dropdownAdapter, K)); H.closeOnSelect && (H.dropdownAdapter = s.Decorate(H.dropdownAdapter, F)); if (null != H.dropdownCssClass || null != H.dropdownCss || null != H.adaptDropdownCssClass) y = d(H.amdBase + "compat/dropdownCss"), H.dropdownAdapter = s.Decorate(H.dropdownAdapter, y); H.dropdownAdapter = s.Decorate(H.dropdownAdapter, B) } if (null == H.selectionAdapter) {
                                            H.selectionAdapter =
                                            H.multiple ? h : e; null != H.placeholder && (H.selectionAdapter = s.Decorate(H.selectionAdapter, k)); H.allowClear && (H.selectionAdapter = s.Decorate(H.selectionAdapter, l)); H.multiple && (H.selectionAdapter = s.Decorate(H.selectionAdapter, z)); if (null != H.containerCssClass || null != H.containerCss || null != H.adaptContainerCssClass) y = d(H.amdBase + "compat/containerCss"), H.selectionAdapter = s.Decorate(H.selectionAdapter, y); H.selectionAdapter = s.Decorate(H.selectionAdapter, t)
                                        } "string" === typeof H.language && (0 < H.language.indexOf("-") ?
                                            (y = H.language.split("-")[0], H.language = [H.language, y]) : H.language = [H.language]); if (a.isArray(H.language)) { y = new v; H.language.push("en"); for (var N = H.language, T = 0; T < N.length; T++) { var U = N[T], ba = {}; try { ba = v.loadPath(U) } catch (ca) { try { U = this.defaults.amdLanguageBase + U, ba = v.loadPath(U) } catch (G) { H.debug && window.console && console.warn && console.warn('Select2: The language file for "' + U + '" could not be automatically loaded. A fallback will be used instead.'); continue } } y.extend(ba) } H.translations = y } else y = v.loadPath(this.defaults.amdLanguageBase +
                                                "en"), N = new v(H.language), N.extend(y), H.translations = N; return H
                                }; U.prototype.reset = function () {
                                    function b(a) { return a.replace(/[^\u0000-\u007E]/g, function (a) { return y[a] || a }) } function g(d, e) { if ("" === a.trim(d.term)) return e; if (e.children && 0 < e.children.length) { for (var f = a.extend(!0, {}, e), q = e.children.length - 1; 0 <= q; q--)null == g(d, e.children[q]) && f.children.splice(q, 1); return 0 < f.children.length ? f : g(d, f) } f = b(e.text).toUpperCase(); q = b(d.term).toUpperCase(); return -1 < f.indexOf(q) ? e : null } this.defaults = {
                                        amdBase: "./",
                                        amdLanguageBase: "./i18n/", closeOnSelect: !0, debug: !1, dropdownAutoWidth: !1, escapeMarkup: s.escapeMarkup, language: T, matcher: g, minimumInputLength: 0, maximumInputLength: 0, maximumSelectionLength: 0, minimumResultsForSearch: 0, selectOnClose: !1, scrollAfterSelect: !1, sorter: function (a) { return a }, templateResult: function (a) { return a.text }, templateSelection: function (a) { return a.text }, theme: "default", width: "resolve"
                                    }
                                }; U.prototype.set = function (b, g) {
                                    var d = a.camelCase(b), e = {}; e[d] = g; d = s._convertData(e); a.extend(!0, this.defaults,
                                        d)
                                }; return new U
                            }); e.define("select2/options", ["require", "jquery", "./defaults", "./utils"], function (a, d, b, e) {
                                function h(d, l) { this.options = d; null != l && this.fromElement(l); this.options = b.apply(this.options); if (l && l.is("input")) { var m = a(this.get("amdBase") + "compat/inputData"); this.options.dataAdapter = e.Decorate(this.options.dataAdapter, m) } } h.prototype.fromElement = function (a) {
                                    function b(a, c) { return c.toUpperCase() } var c = ["select2"]; null == this.options.multiple && (this.options.multiple = a.prop("multiple"));
                                    null == this.options.disabled && (this.options.disabled = a.prop("disabled")); null == this.options.language && (a.prop("lang") ? this.options.language = a.prop("lang").toLowerCase() : a.closest("[lang]").prop("lang") && (this.options.language = a.closest("[lang]").prop("lang"))); null == this.options.dir && (a.prop("dir") ? this.options.dir = a.prop("dir") : a.closest("[dir]").prop("dir") ? this.options.dir = a.closest("[dir]").prop("dir") : this.options.dir = "ltr"); a.prop("disabled", this.options.disabled); a.prop("multiple", this.options.multiple);
                                    e.GetData(a[0], "select2Tags") && (this.options.debug && window.console && console.warn && console.warn('Select2: The `data-select2-tags` attribute has been changed to use the `data-data` and `data-tags\x3d"true"` attributes and will be removed in future versions of Select2.'), e.StoreData(a[0], "data", e.GetData(a[0], "select2Tags")), e.StoreData(a[0], "tags", !0)); e.GetData(a[0], "ajaxUrl") && (this.options.debug && window.console && console.warn && console.warn("Select2: The `data-ajax-url` attribute has been changed to `data-ajax--url` and support for the old attribute will be removed in future versions of Select2."),
                                        a.attr("ajax--url", e.GetData(a[0], "ajaxUrl")), e.StoreData(a[0], "ajax-Url", e.GetData(a[0], "ajaxUrl"))); for (var h = {}, l = 0; l < a[0].attributes.length; l++) { var m = a[0].attributes[l].name; if ("data-" == m.substr(0, 5)) { var y = m.substring(5), m = e.GetData(a[0], y), y = y.replace(/-([a-z])/g, b); h[y] = m } } d.fn.jquery && "1." == d.fn.jquery.substr(0, 2) && a[0].dataset && (h = d.extend(!0, {}, a[0].dataset, h)); a = d.extend(!0, {}, e.GetData(a[0]), h); a = e._convertData(a); for (var g in a) -1 < d.inArray(g, c) || (d.isPlainObject(this.options[g]) ? d.extend(this.options[g],
                                            a[g]) : this.options[g] = a[g]); return this
                                }; h.prototype.get = function (a) { return this.options[a] }; h.prototype.set = function (a, b) { this.options[a] = b }; return h
                            }); e.define("select2/core", ["jquery", "./options", "./utils", "./keys"], function (a, d, b, e) {
                                var h = function (a, c) {
                                    null != b.GetData(a[0], "select2") && b.GetData(a[0], "select2").destroy(); this.$element = a; this.id = this._generateId(a); c = c || {}; this.options = new d(c, a); h.__super__.constructor.call(this); var e = a.attr("tabindex") || 0; b.StoreData(a[0], "old-tabindex", e); a.attr("tabindex",
                                        "-1"); this.dataAdapter = new (this.options.get("dataAdapter"))(a, this.options); e = this.render(); this._placeContainer(e); this.selection = new (this.options.get("selectionAdapter"))(a, this.options); this.$selection = this.selection.render(); this.selection.position(this.$selection, e); this.dropdown = new (this.options.get("dropdownAdapter"))(a, this.options); this.$dropdown = this.dropdown.render(); this.dropdown.position(this.$dropdown, e); this.results = new (this.options.get("resultsAdapter"))(a, this.options, this.dataAdapter);
                                    this.$results = this.results.render(); this.results.position(this.$results, this.$dropdown); var f = this; this._bindAdapters(); this._registerDomEvents(); this._registerDataEvents(); this._registerSelectionEvents(); this._registerDropdownEvents(); this._registerResultsEvents(); this._registerEvents(); this.dataAdapter.current(function (a) { f.trigger("selection:update", { data: a }) }); a.addClass("select2-hidden-accessible"); a.attr("aria-hidden", "true"); this._syncAttributes(); b.StoreData(a[0], "select2", this); a.data("select2",
                                        this)
                                }; b.Extend(h, b.Observable); h.prototype._generateId = function (a) { var c = "", c = null != a.attr("id") ? a.attr("id") : null != a.attr("name") ? a.attr("name") + "-" + b.generateChars(2) : b.generateChars(4), c = c.replace(/(:|\.|\[|\]|,)/g, ""); return "select2-" + c }; h.prototype._placeContainer = function (a) { a.insertAfter(this.$element); var b = this._resolveWidth(this.$element, this.options.get("width")); null != b && a.css("width", b) }; h.prototype._resolveWidth = function (a, b) {
                                    var c = /^width:(([-+]?([0-9]*\.)?[0-9]+)(px|em|ex|%|in|cm|mm|pt|pc))/i;
                                    if ("resolve" == b) return c = this._resolveWidth(a, "style"), null != c ? c : this._resolveWidth(a, "element"); if ("element" == b) return c = a.outerWidth(!1), 0 >= c ? "auto" : c + "px"; if ("style" == b) { var d = a.attr("style"); if ("string" !== typeof d) return null; for (var d = d.split(";"), e = 0, f = d.length; e < f; e += 1) { var h = d[e].replace(/\s/g, "").match(c); if (null !== h && 1 <= h.length) return h[1] } return null } return b
                                }; h.prototype._bindAdapters = function () {
                                    this.dataAdapter.bind(this, this.$container); this.selection.bind(this, this.$container); this.dropdown.bind(this,
                                        this.$container); this.results.bind(this, this.$container)
                                }; h.prototype._registerDomEvents = function () {
                                    var d = this; this.$element.on("change.select2", function () { d.dataAdapter.current(function (a) { d.trigger("selection:update", { data: a }) }) }); this.$element.on("focus.select2", function (a) { d.trigger("focus", a) }); this._syncA = b.bind(this._syncAttributes, this); this._syncS = b.bind(this._syncSubtree, this); this.$element[0].attachEvent && this.$element[0].attachEvent("onpropertychange", this._syncA); var e = window.MutationObserver ||
                                        window.WebKitMutationObserver || window.MozMutationObserver; null != e ? (this._observer = new e(function (b) { a.each(b, d._syncA); a.each(b, d._syncS) }), this._observer.observe(this.$element[0], { attributes: !0, childList: !0, subtree: !1 })) : this.$element[0].addEventListener && (this.$element[0].addEventListener("DOMAttrModified", d._syncA, !1), this.$element[0].addEventListener("DOMNodeInserted", d._syncS, !1), this.$element[0].addEventListener("DOMNodeRemoved", d._syncS, !1))
                                }; h.prototype._registerDataEvents = function () {
                                    var a =
                                        this; this.dataAdapter.on("*", function (b, c) { a.trigger(b, c) })
                                }; h.prototype._registerSelectionEvents = function () { var b = this, d = ["toggle", "focus"]; this.selection.on("toggle", function () { b.toggleDropdown() }); this.selection.on("focus", function (a) { b.focus(a) }); this.selection.on("*", function (e, f) { -1 === a.inArray(e, d) && b.trigger(e, f) }) }; h.prototype._registerDropdownEvents = function () { var a = this; this.dropdown.on("*", function (b, c) { a.trigger(b, c) }) }; h.prototype._registerResultsEvents = function () {
                                    var a = this; this.results.on("*",
                                        function (b, c) { a.trigger(b, c) })
                                }; h.prototype._registerEvents = function () {
                                    var a = this; this.on("open", function () { a.$container.addClass("select2-container--open") }); this.on("close", function () { a.$container.removeClass("select2-container--open") }); this.on("enable", function () { a.$container.removeClass("select2-container--disabled") }); this.on("disable", function () { a.$container.addClass("select2-container--disabled") }); this.on("blur", function () { a.$container.removeClass("select2-container--focus") }); this.on("query",
                                        function (b) { a.isOpen() || a.trigger("open", {}); this.dataAdapter.query(b, function (c) { a.trigger("results:all", { data: c, query: b }) }) }); this.on("query:append", function (b) { this.dataAdapter.query(b, function (c) { a.trigger("results:append", { data: c, query: b }) }) }); this.on("keypress", function (b) {
                                            var c = b.which; if (a.isOpen()) c === e.ESC || c === e.TAB || c === e.UP && b.altKey ? (a.close(), b.preventDefault()) : c === e.ENTER ? (a.trigger("results:select", {}), b.preventDefault()) : c === e.SPACE && b.ctrlKey ? (a.trigger("results:toggle", {}), b.preventDefault()) :
                                                c === e.UP ? (a.trigger("results:previous", {}), b.preventDefault()) : c === e.DOWN && (a.trigger("results:next", {}), b.preventDefault()); else if (c === e.ENTER || c === e.SPACE || c === e.DOWN && b.altKey) a.open(), b.preventDefault()
                                        })
                                }; h.prototype._syncAttributes = function () { this.options.set("disabled", this.$element.prop("disabled")); this.options.get("disabled") ? (this.isOpen() && this.close(), this.trigger("disable", {})) : this.trigger("enable", {}) }; h.prototype._syncSubtree = function (a, b) {
                                    var c = !1, d = this; if (!a || !a.target || "OPTION" ===
                                        a.target.nodeName || "OPTGROUP" === a.target.nodeName) { if (b) if (b.addedNodes && 0 < b.addedNodes.length) for (var e = 0; e < b.addedNodes.length; e++)b.addedNodes[e].selected && (c = !0); else b.removedNodes && 0 < b.removedNodes.length && (c = !0); else c = !0; c && this.dataAdapter.current(function (a) { d.trigger("selection:update", { data: a }) }) }
                                }; h.prototype.trigger = function (a, b) {
                                    var c = h.__super__.trigger, d = { open: "opening", close: "closing", select: "selecting", unselect: "unselecting", clear: "clearing" }; void 0 === b && (b = {}); if (a in d) {
                                        var e =
                                            { prevented: !1, name: a, args: b }; c.call(this, d[a], e); if (e.prevented) { b.prevented = !0; return }
                                    } c.call(this, a, b)
                                }; h.prototype.toggleDropdown = function () { this.options.get("disabled") || (this.isOpen() ? this.close() : this.open()) }; h.prototype.open = function () { this.isOpen() || this.trigger("query", {}) }; h.prototype.close = function () { this.isOpen() && this.trigger("close", {}) }; h.prototype.isOpen = function () { return this.$container.hasClass("select2-container--open") }; h.prototype.hasFocus = function () { return this.$container.hasClass("select2-container--focus") };
                                h.prototype.focus = function (a) { this.hasFocus() || (this.$container.addClass("select2-container--focus"), this.trigger("focus", {})) }; h.prototype.enable = function (a) { this.options.get("debug") && window.console && console.warn && console.warn('Select2: The `select2("enable")` method has been deprecated and will be removed in later Select2 versions. Use $element.prop("disabled") instead.'); if (null == a || 0 === a.length) a = [!0]; this.$element.prop("disabled", !a[0]) }; h.prototype.data = function () {
                                    this.options.get("debug") &&
                                    0 < arguments.length && window.console && console.warn && console.warn('Select2: Data can no longer be set using `select2("data")`. You should consider setting the value instead using `$element.val()`.'); var a = []; this.dataAdapter.current(function (b) { a = b }); return a
                                }; h.prototype.val = function (b) {
                                    this.options.get("debug") && window.console && console.warn && console.warn('Select2: The `select2("val")` method has been deprecated and will be removed in later Select2 versions. Use $element.val() instead.'); if (null == b ||
                                        0 === b.length) return this.$element.val(); b = b[0]; a.isArray(b) && (b = a.map(b, function (a) { return a.toString() })); this.$element.val(b).trigger("change")
                                }; h.prototype.destroy = function () {
                                    this.$container.remove(); this.$element[0].detachEvent && this.$element[0].detachEvent("onpropertychange", this._syncA); null != this._observer ? (this._observer.disconnect(), this._observer = null) : this.$element[0].removeEventListener && (this.$element[0].removeEventListener("DOMAttrModified", this._syncA, !1), this.$element[0].removeEventListener("DOMNodeInserted",
                                        this._syncS, !1), this.$element[0].removeEventListener("DOMNodeRemoved", this._syncS, !1)); this._syncS = this._syncA = null; this.$element.off(".select2"); this.$element.attr("tabindex", b.GetData(this.$element[0], "old-tabindex")); this.$element.removeClass("select2-hidden-accessible"); this.$element.attr("aria-hidden", "false"); b.RemoveData(this.$element[0]); this.$element.removeData("select2"); this.dataAdapter.destroy(); this.selection.destroy(); this.dropdown.destroy(); this.results.destroy(); this.results = this.dropdown =
                                            this.selection = this.dataAdapter = null
                                }; h.prototype.render = function () { var d = a('\x3cspan class\x3d"select2 select2-container"\x3e\x3cspan class\x3d"selection"\x3e\x3c/span\x3e\x3cspan class\x3d"dropdown-wrapper" aria-hidden\x3d"true"\x3e\x3c/span\x3e\x3c/span\x3e'); d.attr("dir", this.options.get("dir")); this.$container = d; this.$container.addClass("select2-container--" + this.options.get("theme")); b.StoreData(d[0], "element", this.$element); return d }; return h
                            }); e.define("jquery-mousewheel", ["jquery"], function (a) { return a });
        e.define("jquery.select2", ["jquery", "jquery-mousewheel", "./select2/core", "./select2/defaults", "./select2/utils"], function (a, d, b, e, h) {
            if (null == a.fn.select2) {
                var k = ["open", "close", "destroy"]; a.fn.select2 = function (d) {
                    d = d || {}; if ("object" === typeof d) return this.each(function () { var e = a.extend(!0, {}, d); new b(a(this), e) }), this; if ("string" === typeof d) {
                        var e, f = Array.prototype.slice.call(arguments, 1); this.each(function () {
                            var a = h.GetData(this, "select2"); null == a && window.console && console.error && console.error("The select2('" +
                                d + "') method was called on an element that is not using Select2."); e = a[d].apply(a, f)
                        }); return -1 < a.inArray(d, k) ? this : e
                    } throw Error("Invalid arguments for Select2: " + d);
                }
            } null == a.fn.select2.defaults && (a.fn.select2.defaults = e); return b
        }); return { define: e.define, require: e.require }
    }(), e = l.require("jquery.select2"); a.fn.select2.amd = l; return e
});
(function (a) {
    a.widget("ui.validate", {
        options: { type: "numeric" }, _validateEmail: function (l) {
            if ("" != a(l).val()) {
                var e = a(l).val().split(","); for (i = 0; i < e.length; i++)e[i] = a.trim(e[i]), /^((([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+(\.([a-z]|[0-9]|!|#|$|%|&|'|\*|\+|\-|\/|=|\?|\^|_|`|\{|\||\}|~)+)*)@((((([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.))*([a-z]|[0-9])([a-z]|[0-9]|\-){0,61}([a-z]|[0-9])\.)[\w]{2,4}|(((([0-9]){1,3}\.){3}([0-9]){1,3}))|(\[((([0-9]){1,3}\.){3}([0-9]){1,3})\])))$/.test(e[i]) ||
                    (a(l).val(""), a(l).state("trigger"))
            }
        }, _validateNatural: function (l) { "" == a(l).val() || /^\d+$/g.test(a(l).val()) || (a(l).val(""), a(l).state("trigger")) }, _validateNumeric: function (l) { "" != a(l).val() && isNaN(a(l).val()) && (a(l).val(""), a(l).state("trigger")) }, _validateUrl: function (l) { "" == a(l).val() || /^(ht|f)tp(s?)\:\/\/[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)([a-zA-Z0-9\-\.\?\,\'\/\\\+&amp;%\$#_]*)?$/.test(a(l).val()) || (a(l).val(""), a(l).state("trigger")) }, _validateCpf: function (l) {
            if ("" != a(l).val()) {
                var e =
                    a(l).val().replace(/\./g, "").replace(/-/g, ""), h = !1; if (11 > e.length) h = !0; else if ("00000000000" == e || "11111111111" == e || "22222222222" == e || "33333333333" == e || "44444444444" == e || "55555555555" == e || "66666666666" == e || "77777777777" == e || "88888888888" == e || "99999999999" == e) h = !0; else { var c = ""; for (i = 1; -1 < i; i--) { var d = 0; for (j = i; 10 > j; j++)p = 0 < i ? j - 1 : j, d += parseInt(e.charAt(p), 10) * j; d = eval(d % 11); 10 == d && (d = 0); c += "" + d } c = parseInt(c); e = parseInt(e.substr(e.length - 2, 2), 10); c != e && (h = !0) } h && (a(l).val(""), a(l).state("trigger"))
            }
        },
        _validateCnpj: function (l) { if ("" != a(l).val()) { var e = a(l).val().replace(/\./g, "").replace(/-/g, "").replace(/\//g, ""), h = !1; if (14 > e.length) h = !0; else if ("00000000000000" == e) h = !0; else { var c = ""; for (i = 1; -1 < i; i--) { var d = 0, b = 0, b = 0 < i ? 6 : 5; for (j = i; 13 > j; j++)p = 0 < i ? j - 1 : j, d += parseInt(e.charAt(p), 10) * b, b++, 9 < b && (b = 2); d = eval(d % 11); 10 == d && (d = 0); c += "" + d } c = parseInt(c, 10); e = parseInt(e.substr(e.length - 2, 2), 10); c != e && (h = !0) } h && (a(l).val(""), a(l).state("trigger")) } }, _validateHour: function (l) {
            if ("" != a(l).val()) {
                var e = a(l).val().replace(/\:/g,
                    ""), h = !1; if (4 > e.length) h = !0; else if (isNaN(parseInt(e, 10))) h = !0; else { var c = parseInt(e.substr(0, 2), 10), e = parseInt(e.substr(2, 2), 10); 23 < c ? h = !0 : 59 < e && (h = !0) } h && (a(l).val(""), a(l).state("trigger"))
            }
        }, _validateDate: function (l) {
            if ("" != a(l).val()) {
                var e = a(l).val().replace(/\//g, ""), h = !1; if (8 > e.length) h = !0; else if ("00000000" == e) h = !0; else {
                    var c = parseInt(e.substr(0, 2), 10), d = parseInt(e.substr(2, 2), 10), e = e.substr(4, 4), b = !1; "00" == e.substr(e.length - 2, 2) && 0 == eval(parseInt(e, 10) % 400) ? b = !0 : "00" != e.substr(e.length -
                        2, 2) && 0 == eval(parseInt(e, 10) % 4) && (b = !0); 31 < c || 12 < d ? h = !0 : c > (1 == d || 3 == d || 5 == d || 7 == d || 8 == d || 10 == d || 12 == d ? 31 : 2 == d ? b ? 29 : 28 : 30) && (h = !0)
                } h && (a(l).val(""), a(l).state("trigger"))
            }
        }, _validateTitulo: function (l) { "" == a(l).val() || /^[^!"#\$%&'\(\)\*\+,\.\/:;<=>\?@\[\\\]\^`\{\|\}~]*$/.test(a(l).val()) || (a(l).val(""), a(l).state("trigger")) }, _validateMatriculaSap: function (l) { if ("" != a(l).val()) { var e = a(l).val(), h = !1; 6 > e.length || 7 < e.length ? h = !0 : /^\d+$/g.test(e) || (h = !0) } h && (a(l).val(""), a(l).state("trigger")) }, _validateInqueritoPolicial: function (l) {
            if ("" !=
                a(l).val()) { var e = !1, h = a(l).val().split("/"); if (!/[0-9]{5,7}[\/]{1}([0-9]{4})/gm.test(a(l).val())) e = !0; else if (null == h[1] || "" == h[1] || 1950 > h[1] || h[1] > (new Date).getFullYear()) e = !0; e && (a(l).val(""), a(l).state("trigger")) }
        }, _validateMes: function (l) { "" != a(l).val() && (isNaN(a(l).val()) || 11 < a(l).val()) && (a(l).val(""), a(l).state("trigger")) }, _create: function () {
            var a = this; "numeric" == a.options.type || "number" == a.options.type ? a.element.keydown(function (e) { 13 == e.keyCode && a._validateNumeric(a.element) }).blur(function () { a._validateNumeric(a.element) }).state({
                type: "error",
                content: "Esse campo deve ser preenchido com um valor numï¿½rico"
            }) : "email" == a.options.type ? a.element.keydown(function (e) { 13 == e.keyCode && a._validateEmail(a.element) }).blur(function () { a._validateEmail(a.element) }).state({ type: "error", content: "O campo deve seguir o formato xxxxxx@xxxxxx.xx e deve ser um email vï¿½lido. Nï¿½o utilize acentuaï¿½ï¿½o, letras maiï¿½sculas ou cedilha" }) : "natural" == a.options.type ? a.element.keydown(function (e) { 13 == e.keyCode && a._validateNatural(a.element) }).blur(function () { a._validateNatural(a.element) }).state({
                type: "error",
                content: "O campo deve seguir o formato numï¿½rico sem pontos ou vï¿½rgulas"
            }) : "url" == a.options.type ? a.element.keydown(function (e) { 13 == e.keyCode && a._validateUrl(a.element) }).blur(function () { a._validateUrl(a.element) }).state({ type: "error", content: "Esse campo deve seguir o formato http://xxxxxxxx.xxx.xx e deve ser uma url vï¿½lida" }) : "cpf" == a.options.type ? a.element.keydown(function (e) { 13 == e.keyCode && a._validateCpf(a.element) }).blur(function () { a._validateCpf(a.element) }).state({ type: "error", content: "Esse campo deve seguir o formato 999.999.999-99 e ser um cpf vï¿½lido" }) :
                "cnpj" == a.options.type ? a.element.keydown(function (e) { 13 == e.keyCode && a._validateCnpj(a.element) }).blur(function () { a._validateCnpj(a.element) }).state({ type: "error", content: "Esse campo deve seguir o formato 99.999.999/9999-99 e ser um cnpj vï¿½lido" }) : "hour" == a.options.type ? a.element.keydown(function (e) { 13 == e.keyCode && a._validateHour(a.element) }).blur(function () { a._validateHour(a.element) }).state({ type: "error", content: "Esse campo deve seguir o formato 99:99 e ser uma hora vï¿½lida" }) : "date" == a.options.type ?
                    a.element.keydown(function (e) { 13 == e.keyCode && a._validateDate(a.element) }).blur(function () { a._validateDate(a.element) }).state({ type: "error", content: "Esse campo deve seguir o formato 99/99/9999 e ser uma data vï¿½lida" }) : "titulo" == a.options.type ? a.element.keydown(function (e) { 13 == e.keyCode && a._validateTitulo(a.element) }).blur(function () { a._validateTitulo(a.element) }).state({ type: "error", content: "Esse campo deve seguir o formato sem pontuaï¿½ï¿½es e sï¿½mbolos" }) : "matriculaSap" == a.options.type ? a.element.keydown(function (e) {
                        13 ==
                        e.keyCode && a._validateMatriculaSap(a.element)
                    }).blur(function () { a._validateMatriculaSap(a.element) }).state({ type: "error", content: "Esse campo nï¿½o ï¿½ obrigatï¿½rio, mas se preenchido, deve conter 6 ou 7 nï¿½meros" }) : "inqueritoPolicial" == a.options.type ? a.element.keydown(function (e) { 13 == e.keyCode && a._validateInqueritoPolicial(a.element) }).blur(function () { a._validateInqueritoPolicial(a.element) }).state({ type: "error", content: "Esse campo deve ser preenchido no seguinte formato 99999/9999, deve conter ao menos 5 a 7 nï¿½meros antes da barra e um ano vï¿½lido" }) :
                        "mes" == a.options.type && a.element.keydown(function (e) { 13 == e.keyCode && a._validateMes(a.element) }).blur(function () { a._validateMes(a.element) }).state({ type: "error", content: "Esse campo deve conter valores entre 0 e 11." })
        }
    })
})(jQuery);
(function (a) {
    a.fn.caret = function (a) {
        var e = this[0]; if (0 == arguments.length) { if (e.selectionStart) return a = e.selectionStart, 0 < a ? a : 0; if (e.createTextRange) { e.focus(); var h = document.selection.createRange(); if (null == h) return "0"; var e = e.createTextRange(), c = e.duplicate(); e.moveToBookmark(h.getBookmark()); c.setEndPoint("EndToStart", e); return c.text.length } return 0 } e.setSelectionRange ? e.setSelectionRange(a, a) : e.createTextRange && (h = e.createTextRange(), h.collapse(!0), h.moveEnd("character", a), h.moveStart("character",
            a), h.select())
    }
})(jQuery);
(function (a) {
    a.fn.priceFormat = function (l) {
        l = a.extend({ prefix: "R$ ", centsSeparator: ".", thousandsSeparator: ",", limit: !1, centsLimit: 2, clearPrefix: !1, allowNegative: !1 }, l); return this.each(function () {
            function e(a) {
                for (var c = "", g = 0; g < a.length; g++)char_ = a.charAt(g), 0 == c.length && 0 == char_ && (char_ = !1), char_ && char_.match(b) && (r ? c.length < r && (c += char_) : c += char_); for (var d; c.length < z + 1;)c = "0" + c; d = c; var c = "", g = 0, e = d.substr(d.length - z, z), h = d.substr(0, d.length - z); d = h + m + e; if (k) {
                    for (d = h.length; 0 < d; d--)char_ = h.substr(d -
                        1, 1), g++, 0 == g % 3 && (char_ = k + char_), c = char_ + c; c.substr(0, 1) == k && (c = c.substring(1, c.length)); d = c + m + e
                } !s || -1 == a.indexOf("-") || 0 == h && 0 == e || (d = "-" + d); f && (d = f + d); return d
            } function h() { var a = d.val(), b = e(a); a != b && d.val(b) } function c() { if ("" != a.trim(f) && t) { var b = d.val().split(f); d.val(b[1]) } } var d = a(this), b = /[0-9]/, f = l.prefix, m = l.centsSeparator, k = l.thousandsSeparator, r = l.limit; !r && 0 < a(this).attr("maxlength") && (r = a(this).attr("maxlength")); var z = l.centsLimit, t = l.clearPrefix, s = l.allowNegative; a(this).bind("unMoneyMask",
                function () { d.unbind(".moneyMask") }); a(this).bind("keydown.moneyMask", function (a) { var b = a.keyCode ? a.keyCode : a.which, c = String.fromCharCode(b), f = !1, q = d.val(), c = e(q + c); if (17 == b || 86 == b || 67 == b) f = !0; if (48 <= b && 57 >= b || 96 <= b && 105 >= b) f = !0; 8 == b && (f = !0); 9 == b && (f = !0); 13 == b && (f = !0); 46 == b && (f = !0); 37 == b && (f = !0); 39 == b && (f = !0); 116 == b && (f = !0); !s || 189 != b && 109 != b || (f = !0); f || (a.preventDefault(), a.stopPropagation(), q != c && d.val(c)) }); a(this).bind("keyup.moneyMask", h); t && (a(this).bind("focusout.moneyMask", function () { c() }),
                    a(this).bind("focusin.moneyMask", function () { var a = d.val(); d.val(f + a) })); 0 < a(this).val().length && (h(), c())
        })
    }
})(jQuery); function formatUserMoney(a) { return parseFloat(a.replace(/\./g, "").replace(",", ".")) }
function formatMoney(a) { a = a.toString(); isNaN(a) && (a = "0"); sign = a == (a = Math.abs(a)); a = Math.floor(100 * a + 0.50000000001); cents = a % 100; a = Math.floor(a / 100).toString(); 10 > cents && (cents = "0" + cents); for (var l = 0; l < Math.floor((a.length - (1 + l)) / 3); l++)a = a.substring(0, a.length - (4 * l + 3)) + "." + a.substring(a.length - (4 * l + 3)); return (sign ? "" : "-") + a + "," + cents }
(function (a) {
    var l = (a.browser.msie ? "paste" : "input") + ".mask", e = void 0 != window.orientation; a.mask = { definitions: { 9: "[0-9]", a: "[A-Za-z]", "*": "[A-Za-z0-9]" }, dataName: "rawMaskFn", pattern: "" }; a.fn.extend({
        caret: function (a, c) {
            if (0 != this.length) {
                if ("number" == typeof a) return c = "number" == typeof c ? c : a, this.each(function () { if (this.setSelectionRange) this.setSelectionRange(a, c); else if (this.createTextRange) { var b = this.createTextRange(); b.collapse(!0); b.moveEnd("character", c); b.moveStart("character", a); b.select() } });
                if (this[0].setSelectionRange) a = this[0].selectionStart, c = this[0].selectionEnd; else if (document.selection && document.selection.createRange) { var d = document.selection.createRange(); a = 0 - d.duplicate().moveStart("character", -1E5); c = a + d.text.length } return { begin: a, end: c }
            }
        }, option: function () { return a.mask.pattern }, checkValue: function () { }, unmask: function () { return this.trigger("unmask") }, mask: function (h, c) {
            if (!h && 0 < this.length) return a(this[0]).data(a.mask.dataName)(); a.mask.pattern = h; c = a.extend({
                placeholder: "_",
                completed: null
            }, c); var d = a.mask.definitions, b = [], f = h.length, m = null, k = h.length; a.each(h.split(""), function (a, c) { "?" == c ? (k--, f = a) : d[c] ? (b.push(RegExp(d[c])), null == m && (m = b.length - 1)) : b.push(null) }); return this.trigger("unmask").each(function () {
                function r(a) { for (; ++a <= k && !b[a];); return a } function z(a, g) { if (!(0 > a)) { for (var d = a, e = r(g); d < k; d++)if (b[d]) { if (e < k && b[d].test(q[e])) q[d] = q[e], q[e] = c.placeholder; else break; e = r(e) } y(); u.caret(Math.max(m, a)) } } function t(a) {
                    a = a.which; if (8 == a || 46 == a || e && 127 == a) {
                        var c =
                            u.caret(), d = c.begin, c = c.end; if (0 == c - d) { if (46 != a) for (; 0 <= --d && !b[d];); else d = c = r(d - 1); c = 46 == a ? r(c) : c } v(d, c); z(d, c - 1); return !1
                    } if (27 == a) return u.val(w), u.caret(0, g()), !1
                } function s(a) {
                    var g = a.which, d = u.caret(); if (a.ctrlKey || a.altKey || a.metaKey || 32 > g) return !0; if (g) {
                        0 != d.end - d.begin && (v(d.begin, d.end), z(d.begin, d.end - 1)); a = r(d.begin - 1); if (a < k && (g = String.fromCharCode(g), b[a].test(g))) {
                            for (var d = a, e = c.placeholder; d < k; d++)if (b[d]) { var f = r(d), h = q[d]; q[d] = e; if (f < k && b[f].test(h)) e = h; else break } q[a] = g; y(); a =
                                r(a); u.caret(a); c.completed && a >= k && c.completed.call(u)
                        } return !1
                    }
                } function v(a, g) { for (var d = a; d < g && d < k; d++)b[d] && (q[d] = c.placeholder) } function y() { return u.val(q.join("")).val() } function g(a) { for (var g = u.val(), d = -1, e = 0, h = 0; e < k; e++)if (b[e]) { for (q[e] = c.placeholder; h++ < g.length;) { var l = g.charAt(h - 1); if (b[e].test(l)) { q[e] = l; d = e; break } } if (h > g.length) break } else q[e] == g.charAt(h) && e != f && (h++, d = e); if (!a && d + 1 < f) u.val(""), v(0, k); else if (a || d + 1 >= f) y(), a || u.val(u.val().substring(0, d + 1)); return f ? e : m } var u = a(this),
                    q = a.map(h.split(""), function (a, b) { if ("?" != a) return d[a] ? c.placeholder : a }), w = u.val(); u.data(a.mask.dataName, function () { return a.map(q, function (a, g) { return b[g] && a != c.placeholder ? a : null }).join("") }); u.attr("readonly") || u.one("unmask", function () { u.unbind(".mask").removeData(a.mask.dataName) }).bind("focus.mask", function () { w = u.val(); var b = g(); y(); var c = function () { b == h.length ? u.caret(0, b) : u.caret(b) }; (a.browser.msie ? c : function () { setTimeout(c, 0) })() }).bind("blur.mask", function () { g(); u.val() != w && u.change() }).bind("keydown.mask",
                        t).bind("keypress.mask", s).bind(l, function () { setTimeout(function () { u.caret(g(!0)) }, 0) }); g()
            })
        }
    })
})(jQuery); (function (a) { a.widget("ui.textarea", { options: { resizable: !0 }, _create: function () { this.options.resizable && !a.browser.msie && this.element.resizable({ animate: !0, animateDuration: "fast", helper: "ui-border-all ui-textarea-resizable-helper", handles: "se" }) } }) })(jQuery);
(function (a) {
    a.widget("ui.detail", {
        options: { beforeInsertRow: function () { }, afterInsertRow: function () { }, beforeDeleteRow: function () { }, afterDeleteRow: function () { }, canRemoveRow: !0, canInsertRow: !0, canCleanOnInsert: !0, removeFirstRow: !1 }, insertRow: function () { this._insertRow() }, _insertRow: function () {
            var l = this.element; this.options.beforeInsertRow.call(); if (0 == parseInt(a(".ui-detail-table-row-count", l).val(), 10)) a("tbody tr:eq(0)", l).show(), a(".ui-form-required", l).removeClass("ui-app-hide"); else {
                var e = [], h =
                    [], c = [], d = [], b = [], f = []; a("tbody tr:eq(0) td", l).each(function (k) {
                        1 == a(".ui-auto-complete", this).size() && (e[k] = a(".ui-auto-complete", this).autocomplete("option")); 1 == a(".ui-date-picker", this).size() && (h[k] = a(".ui-date-picker", this).datepicker("option")); 1 == a(".ui-mask", this).size() && (c[k] = a(".ui-mask", this).option()); 1 == a(".ui-money-mask", this).size() && (d[k] = { prefix: "", centsSeparator: ",", thousandsSeparator: "." }); 1 == a(".ui-recursive-combobox", this).size() && (f[k] = a(".ui-recursive-combobox", this).recursiveComboBox("root"),
                            b[k] = a(".ui-recursive-combobox", this).recursiveComboBox("option"))
                    }); a(".ui-auto-complete", l).autocomplete("destroy"); a(".ui-date-picker", l).datepicker("destroy"); a(".ui-recursive-combobox", l).recursiveComboBox("destroy"); a(".ui-mask", l).unmask(); a(".ui-money-mask", l).trigger("unMoneyMask"); var m = a("tbody tr:eq(0)", l).clone(!0); l.append(m); this._reorganizeIds(); a("tbody tr", l).each(function (k) {
                        a("td", this).each(function (k) {
                            1 == a(".ui-auto-complete", this).size() && a(".ui-auto-complete", this).autocomplete(e[k]);
                            1 == a(".ui-date-picker", this).size() && a(".ui-date-picker", this).datepicker(h[k]); 1 == a(".ui-mask", this).size() && a(".ui-mask", this).mask(c[k]); 1 == a(".ui-money-mask", this).size() && a(".ui-money-mask", this).priceFormat(d[k]); 1 == a(".ui-recursive-combobox", this).size() && (a(".ui-recursive-combobox", this).recursiveComboBox(b[k]), a(".ui-recursive-combobox", this).recursiveComboBox("fill", f[k]))
                        })
                    })
            } this.options.canCleanOnInsert && this._cleanValues(); this._refreshRowCount("plus"); this.options.afterInsertRow.call()
        },
        _hoverRows: function () { a(" \x3e tbody \x3e tr", this.element).hover(function () { a(this).addClass("ui-detail-table-state-hover") }, function () { a(this).removeClass("ui-detail-table-state-hover") }) }, _create: function () {
            var l = this, e = this.element; l.options.canInsertRow && a(".ui-detail-table-insert-button", e).click(function () { l._insertRow() }); l.options.canRemoveRow && (a(".ui-detail-table-can-not-remove-row", e).parent().find(".ui-detail-table-remove-button").hide(), a(".ui-detail-table-remove-button", e).click(function () {
                l._refreshRowCount("minus");
                l.options.beforeDeleteRow.call(); 0 == parseInt(a(".ui-detail-table-row-count", e).val(), 10) ? (l._hideFirstRow(), a(".ui-form-required", e).addClass("ui-app-hide")) : a(this).parent().parent().remove(); l.options.afterDeleteRow.call()
            }).hover(function () { a(this).addClass("ui-state-hover"); a(this).parent().parent().find("\x3etd").addClass("ui-detail-table-remove-row-highlight") }, function () { a(this).removeClass("ui-state-hover"); a(this).parent().parent().find("\x3etd").removeClass("ui-detail-table-remove-row-highlight") }));
            this._reorganizeIds(); l.options.removeFirstRow && (l._hideFirstRow(), l._refreshRowCount("minus")); l._hoverRows()
        }, _hideFirstRow: function () { a("tbody tr:eq(0)", this.element).hide() }, _reorganizeIds: function () { var l = 0; a("\x3e tbody \x3e tr", this.element).each(function () { a(":input,div,button", this).each(function () { var e = a(this).attr("id").split("__")[0] + "__" + l; a(this).attr("id", e); a(this).attr("name") && a(this).attr("name", a(this).attr("name").replace(/(\[.*?\])/, "[" + l + "]")) }); l++ }) }, _cleanValues: function () {
            var l =
                this.element; l.find("\x3e tbody \x3e tr:last").find(":input:not(:button,:checkbox,:radio,.notClean)").each(function () { a(this).val(""); a(this).attr("disabled", !1); a(this).attr("readonly", !1); a(this).removeClass("ui-form-field-empty"); a(this).removeClass("ui-form-field-disabled") }); l.find("\x3e tbody \x3e tr:last").find(":checkbox,:radio").each(function () { a(this).attr("checked", !1) })
        }, _refreshRowCount: function (l) {
            var e = this.element, h = parseInt(a(".ui-detail-table-row-count", e).val(), 10); "plus" == l ? h++ :
                h--; a(".ui-detail-table-row-count", e).val(h)
        }, organize: function () { this._reorganizeIds() }, reset: function () { a("tbody tr", this.element).each(function (l) { a("td", this).each(function (e) { a(".ui-detail-table-remove-button", this).trigger("click") }) }) }, hide: function () { a(this.element).hide() }, show: function () { a(this.element).show() }
    })
})(jQuery);
(function (a) {
    a.widget("ui.state", {
        options: { type: "error", content: "No content", delay: 3E3, width: "300px" }, _create: function () {
            this.container = a('\x3cdiv\x3e\x3cdiv class\x3d"' + ("error" == this.options.type ? "ui-state-error" : "info" == this.options.type ? "ui-state-highlight" : "") + ' ui-corner-all"\x3e\x3cp\x3e\x3cspan class\x3d"ui-icon ' + ("error" == this.options.type ? "ui-icon-alert" : "info" == this.options.type ? "ui-icon-info" : "") + '" style\x3d"float: left;margin-right: 0.3em;"\x3e\x3c/span\x3e\x3cstrong\x3e' + ("error" ==
                this.options.type ? "Erro" : "info" == this.options.type ? "Informação" : "") + " :\x3c/strong\x3e " + this.options.content + " \x3c/p\x3e\x3c/div\x3e\x3c/div\x3e").css({ left: 0, top: 0, position: "absolute", fontSize: "12px" }).hide().width(this.options.width); a("body").append(this.container); this.container.position({ of: this.element, my: "left center", at: "right center" })
        }, trigger: function () { var a = this; a.container.fadeIn("slow"); setTimeout(function () { a.container.fadeOut("slow") }, a.options.delay) }
    })
})(jQuery);
(function (a) { a.widget("bs.iframe", { options: { interval: 2E3, offset: 100, minHeight: 550 }, _create: function () { var a = this; a.element.load(function () { a._reset(); a._resize(a.options.offset) }); setInterval(function () { a._resize(0) }, a.options.interval) }, _reset: function () { this.element.css("height", "0px") }, _resize: function (a) { var e = this.element; e && (a = e.contents().outerHeight() + a, a < this.options.minHeight && (a = this.options.minHeight), e.css("height", +a + "px")) } }) })(jQuery);
(function (a, l, e, h) {
    function c(a) { return a.getMonth() + 12 * a.getFullYear() } function d(a) { return Math.floor(a / 12) } function b() { a(this).addClass(v) } function f(a, c) { return a[c ? "on" : "off"]("mousenter mouseout", b).toggleClass(v, c) } function m(a, b, c) { return (!b || a >= b) && (!c || a <= c) } function k(b, g) {
        if (null === g) return g; if (g instanceof h) return c(g); if (a.isNumeric(g)) return c(new h) + parseInt(g, 10); var d = b._parseMonth(g); if (d) return c(d); var e; d = g.trim(); d = d.replace(/y/i, '":"y"'); d = d.replace(/m/i, '":"m"'); try {
            var f =
                JSON.parse('{"' + d.replace(/ /g, ',"') + "}"), d = {}, q; for (q in f) d[f[q]] = q; var k = c(new h), k = k + (parseInt(d.m, 10) || 0); e = k + 12 * (parseInt(d.y, 10) || 0)
        } catch (m) { e = !1 } return e
    } function r(a, b) { return C(b.options[a] || O, b.element[0]) } function z(b) { return a('\x3cspan id\x3d"MonthPicker_Button_' + this.id + '" class\x3d"month-picker-open-button"\x3e' + b.i18n.buttonText + "\x3c/span\x3e").button({ text: !1, icons: { primary: b.ButtonIcon } }) } function t(a, b) { a.button("option", { icons: { primary: "ui-icon-circle-triangle-" + (b ? "w" : "e") } }) }
    if (a && a.ui && a.ui.button && a.ui.datepicker) {
        var s = a.fx.speeds, v = "ui-state-active", y = { my: "left top+1", at: "left bottom" }, g = { my: "right top+1", at: "right bottom" }, u = "MonthPicker Error: ", q = u + "The jQuery UI position plug-in must be loaded.", w = u + "Unsupported % option value, supported values are: ", x = u + '"_" is not a valid %Month value.', D = null, A = !!a.ui.position, I = { Animation: ["slideToggle", "fadeToggle", "none"], ShowAnim: ["fadeIn", "slideDown", "none"], HideAnim: ["fadeOut", "slideUp", "none"] }, E = {
            ValidationErrorMessage: "_createValidationMessage",
            Disabled: "_setDisabledState", ShowIcon: "_updateButton", Button: "_updateButton", ShowOn: "_updateFieldEvents", IsRTL: "_setRTL", AltFormat: "_updateAlt", AltField: "_updateAlt", StartYear: "_setPickerYear", MinMonth: "_setMinMonth", MaxMonth: "_setMaxMonth", SelectedMonth: "_setSelectedMonth"
        }, O = a.noop, C = a.proxy, S = a.datepicker; a.MonthPicker = {
            VERSION: "2.8.2", i18n: {
                year: "Year", prevYear: "Previous Year", nextYear: "Next Year", next5Years: "Jump Forward 5 Years", prev5Years: "Jump Back 5 Years", nextLabel: "Next", prevLabel: "Prev",
                buttonText: "Open Month Chooser", jumpYears: "Jump Years", months: "Jan. Feb. Mar. Apr. May June July Aug. Sep. Oct. Nov. Dec.".split(" ")
            }
        }; a.widget("KidSysco.MonthPicker", {
            options: { i18n: {}, IsRTL: !1, Position: null, StartYear: null, ShowIcon: !0, UseInputMask: !1, ValidationErrorMessage: null, Disabled: !1, MonthFormat: "mm/yy", Animation: "fadeToggle", ShowAnim: null, HideAnim: null, ShowOn: null, MinMonth: null, MaxMonth: null, Duration: "normal", Button: z, ButtonIcon: "ui-icon-calculator" }, _monthPickerButton: a(), _validationMessage: a(),
            _selectedBtn: a(), _destroy: function () { var b = this.element; jQuery.mask && this.options.UseInputMask && (b.unmask(), this.GetSelectedDate() || b.val("")); b.removeClass("month-year-input").off(".MonthPicker"); a(e).off(".MonthPicker" + this.uuid); this._monthPickerMenu.remove(); b = this._monthPickerButton.off("click.MonthPicker"); this._removeOldBtn && b.remove(); this._validationMessage.remove() }, _setOption: function (b, c) {
                switch (b) {
                    case "i18n": c = a.extend({}, c); break; case "Position": if (!A) { alert(q); return } case "MonthFormat": var g =
                        this.GetSelectedDate(); g && this.element.val(this.FormatMonth(g, c))
                }b in I && -1 === I[b].indexOf(c) ? alert(w.replace(/%/, b) + I[b]) : (this._super(b, c), E[b] ? this[E[b]](c) : 0)
            }, _create: function () {
                var b = this.element, c = this.options; if (!b.is("input,div,span") || -1 === ["text", "month", void 0].indexOf(b.attr("type"))) { var g = u + "MonthPicker can only be called on text or month inputs."; alert(g + " \n\nSee (developer tools) for more details."); console.error(g + "\n Caused by:"); console.log(b[0]); return !1 } if (!a.mask && c.UseInputMask) return alert(u +
                    "The UseInputMask option requires the Input Mask Plugin. Get it from digitalbush.com"), !1; if (null !== c.Position && !A) return alert(q), !1; for (g in I) if (null !== c[g] && -1 === I[g].indexOf(c[g])) return alert(w.replace(/%/, g) + I[g]), !1; if (this._isMonthInputType = "month" === b.attr("type")) this.options.MonthFormat = this.MonthInputFormat, b.css("width", "auto"); b.addClass("month-year-input"); var f = this._monthPickerMenu = a('\x3cdiv id\x3d"MonthPicker_' + b[0].id + '" class\x3d"month-picker ui-helper-clearfix"\x3e\x3c/div\x3e'),
                        g = !b.is("input"); a('\x3cdiv class\x3d"ui-widget-header ui-helper-clearfix ui-corner-all"\x3e\x3ctable class\x3d"month-picker-year-table" width\x3d"100%" border\x3d"0" cellspacing\x3d"1" cellpadding\x3d"2"\x3e\x3ctr\x3e\x3ctd class\x3d"previous-year"\x3e\x3cbutton /\x3e\x3c/td\x3e\x3ctd class\x3d"year-container-all"\x3e\x3cdiv id\x3d"year-container"\x3e\x3cspan class\x3d"year-title" /\x3e\x3cspan class\x3d"year" /\x3e\x3c/div\x3e\x3c/td\x3e\x3ctd class\x3d"next-year"\x3e\x3cbutton /\x3e\x3c/td\x3e\x3c/tr\x3e\x3c/table\x3e\x3c/div\x3e\x3cdiv class\x3d"ui-widget ui-widget-content ui-helper-clearfix ui-corner-all"\x3e\x3ctable class\x3d"month-picker-month-table" width\x3d"100%" border\x3d"0" cellspacing\x3d"1" cellpadding\x3d"2" /\x3e\x3c/div\x3e').appendTo(f);
                f.appendTo(g ? b : e.body); a(".year-title", f).text(this._i18n("year")); this._yearContainerAll = a(".year-container-all", f).attr("title", this._i18n("jumpYears")).click(C(this._showYearsClickHandler, this)); this._createValidationMessage(); this._yearContainer = a(".year", f); this._prevButton = a(".previous-year button", f).button({ text: !1 }); this._nextButton = a(".next-year button", f).button({ text: !1 }); this._setRTL(c.IsRTL); a(".ui-button-icon-primary", this._nextButton).text(this._i18n("nextLabel")); a(".ui-button-icon-primary",
                    this._prevButton).text(this._i18n("prevLabel")); for (var m = a(".month-picker-month-table", f), l = 0; 12 > l; l++) { var D = l % 3 ? D : a("\x3ctr /\x3e").appendTo(m); D.append('\x3ctd\x3e\x3cbutton class\x3d"button-' + (l + 1) + '" /\x3e\x3c/td\x3e') } this._buttons = a("button", m).button(); f.on("click.MonthPicker", function (a) { return !1 }); var r = this; a.each(["Min", "Max"], function (a, b) { r["_set" + b + "Month"] = function (a) { !1 === (r["_" + b + "Month"] = k(r, a)) && alert(x.replace(/%/, b).replace(/_/, a)) }; r._setOption(b + "Month", r.options[b + "Month"]) });
                c = c.SelectedMonth; void 0 !== c && (c = k(this, c), b.val(this._formatMonth(new h(d(c), c % 12, 1)))); this._updateAlt(); this._setUseInputMask(); this._setDisabledState(); this._updateFieldEvents(); this.Destroy = this.destroy; g ? this.Open() : b.change(C(this._updateAlt, this))
            }, GetSelectedDate: function () { return this._parseMonth() }, GetSelectedYear: function () { var a = this.GetSelectedDate(); return a ? a.getFullYear() : NaN }, GetSelectedMonth: function () { var a = this.GetSelectedDate(); return a ? a.getMonth() + 1 : NaN }, Validate: function () {
                var a =
                    this.GetSelectedDate(); null === this.options.ValidationErrorMessage || this.options.Disabled || this._validationMessage.toggle(!a); return a
            }, GetSelectedMonthYear: function () { var a = this.Validate(); return a ? a.getMonth() + 1 + "/" + a.getFullYear() : null }, Disable: function () { this._setOption("Disabled", !0) }, Enable: function () { this._setOption("Disabled", !1) }, ClearAllCallbacks: function () { for (var a in this.options) 0 === a.indexOf("On") && (this.options[a] = O) }, Clear: function () { this.element.val(""); this._validationMessage.hide() },
            Toggle: function (a) { return this._visible ? this.Close(a) : this.Open(a) }, Open: function (b) {
                var c = this.element, g = this.options; if (!g.Disabled && !this._visible) {
                    b = b || a.Event(); if (!1 === r("OnBeforeMenuOpen", this)(b) || b.isDefaultPrevented()) return !1; this._visible = !0; this._ajustYear(g); var d = this._monthPickerMenu; this._showMonths(); c.is("input") ? (D && D.Close(b), D = this, a(e).on("click.MonthPicker" + this.uuid, C(this.Close, this)).on("keydown.MonthPicker" + this.uuid, C(this._keyDown, this)), c.off("blur.MonthPicker").focus(),
                        b = g.ShowAnim || g.Animation, c = "none" === b, d[c ? "fadeIn" : b]({ duration: c ? 0 : this._duration(), start: C(this._position, this, d), complete: r("OnAfterMenuOpen", this) })) : (d.css("position", "static").show(), r("OnAfterMenuOpen", this)())
                } return !1
            }, Close: function (b) {
                var c = this.element; if (c.is("input") && this._visible) {
                    var g = this._monthPickerMenu, d = this.options; b = b || a.Event(); if (!1 !== r("OnBeforeMenuClose", this)(b) && !b.isDefaultPrevented()) if (this._visible = !1, D = null, a(e).off("keydown.MonthPicker" + this.uuid).off("click.MonthPicker" +
                        this.uuid), this.Validate(), c.on("blur.MonthPicker", C(this.Validate, this)), b = r("OnAfterMenuClose", this), d = d.HideAnim || d.Animation, "none" === d) g.hide(0, b); else g[d](this._duration(), b)
                }
            }, MonthInputFormat: "yy-mm", ParseMonth: function (a, b) { try { return S.parseDate("dd" + b, "01" + a) } catch (c) { return null } }, FormatMonth: function (a, b) { try { return S.formatDate(b, a) || null } catch (c) { return null } }, _setSelectedMonth: function (a) {
                a = k(this, a); var b = this.element; a ? b.val(this._formatMonth(new h(d(a), a % 12, 1))) : b.val(""); this._ajustYear(this.options);
                this._showMonths()
            }, _i18n: function (b) { return this.options.i18n[b] || a.MonthPicker.i18n[b] }, _parseMonth: function (a, b) { return this.ParseMonth(a || this.element.val(), b || this.options.MonthFormat) }, _formatMonth: function (a, b) { return this.FormatMonth(a || this._parseMonth(), b || this.options.MonthFormat) }, _updateButton: function () { var a = this.options.Disabled; this._createButton(); var b = this._monthPickerButton; try { b.button("option", "disabled", a) } catch (c) { b.filter("button,input").prop("disabled", a) } this._updateFieldEvents() },
            _createButton: function () { var b = this.element, c = this.options; if (b.is("input")) { var g = this._monthPickerButton.off(".MonthPicker"), c = c.ShowIcon ? c.Button : !1; a.isFunction(c) && (c = c.call(b[0], a.extend(!0, { i18n: a.MonthPicker.i18n }, this.options))); var d = !1; this._monthPickerButton = (c instanceof a ? c : a(c)).each(function () { a.contains(e.body, this) || (d = !0, a(this).insertAfter(b)) }).on("click.MonthPicker", C(this.Toggle, this)); this._removeOldBtn && g.remove(); this._removeOldBtn = d } }, _updateFieldEvents: function () {
                this.element.off("click.MonthPicker focus.MonthPicker");
                if ("both" === this.options.ShowOn || !this._monthPickerButton.length) this.element.on("click.MonthPicker focus.MonthPicker", C(this.Open, this))
            }, _createValidationMessage: function () {
                var b = this.options.ValidationErrorMessage, c = this.element; if (-1 === [null, ""].indexOf(b)) {
                    var b = a('\x3cspan id\x3d"MonthPicker_Validation_' + c[0].id + '" class\x3d"month-picker-invalid-message"\x3e' + b + "\x3c/span\x3e"), g = this._monthPickerButton; this._validationMessage = b.insertAfter(g.length ? g : c); c.on("blur.MonthPicker", C(this.Validate,
                        this))
                } else this._validationMessage.remove()
            }, _setRTL: function (a) { t(this._prevButton, !a); t(this._nextButton, a) }, _keyDown: function (a) { switch (a.keyCode) { case 13: this.element.val() || this._chooseMonth((new h).getMonth() + 1); this.Close(a); break; case 27: case 9: this.Close(a) } }, _duration: function () { var b = this.options.Duration; return a.isNumeric(b) ? b : b in s ? s[b] : s._default }, _position: A ? function (b) { var c = a.extend(this.options.IsRTL ? g : y, this.options.Position); return b.position(a.extend({ of: this.element }, c)) } :
                function (a) { var b = this.element, c = { top: b.offset().top + b.height() + 7 + "px" }; c.left = this.options.IsRTL ? b.offset().left - a.width() + b.width() + 7 + "px" : b.offset().left + "px"; return a.css(c) }, _setUseInputMask: function () { if (!this._isMonthInputType) try { this.options.UseInputMask ? this.element.mask(this._formatMonth(new h).replace(/\d/g, 9)) : this.element.unmask() } catch (a) { } }, _setDisabledState: function () {
                    var a = this.options.Disabled, b = this.element; b[0].disabled = a; b.toggleClass("month-picker-disabled", a); a && this._validationMessage.hide();
                    this.Close(); this._updateButton(); r("OnAfterSetDisabled", this)(a)
                }, _getPickerYear: function () { return parseInt(this._yearContainer.text(), 10) }, _setPickerYear: function (a) { this._yearContainer.text(a || (new h).getFullYear()) }, _updateAlt: function (b, c) { var g = a(this.options.AltField); g.length && g.val(this._formatMonth(c, this.options.AltFormat)) }, _chooseMonth: function (b) {
                    var c = new h(this._getPickerYear(), b - 1); this.element.val(this._formatMonth(c)).blur(); this._updateAlt(0, c); f(this._selectedBtn, !1); this._selectedBtn =
                        f(a(this._buttons[b - 1]), !0); r("OnAfterChooseMonth", this)(c)
                }, _chooseYear: function (a) { this._setPickerYear(a); this._buttons.removeClass("ui-state-highlight"); this._showMonths(); r("OnAfterChooseYear", this)() }, _showMonths: function () {
                    var b = this._i18n("months"); this._prevButton.attr("title", this._i18n("prevYear")).off("click.MonthPicker").on("click.MonthPicker", C(this._addToYear, this, -1)); this._nextButton.attr("title", this._i18n("nextYear")).off("click.MonthPicker").on("click.MonthPicker", C(this._addToYear,
                        this, 1)); this._yearContainerAll.css("cursor", "pointer"); this._buttons.off(".MonthPicker"); var c = this, g = C(c._onMonthClick, c); a.each(b, function (b, d) { a(c._buttons[b]).on("click.MonthPicker", { month: b + 1 }, g).button("option", "label", d) }); this._decorateButtons()
                }, _showYearsClickHandler: function () { this._buttons.removeClass("ui-state-highlight"); this._showYears(); r("OnAfterChooseYears", this)() }, _showYears: function () {
                    var b = this._getPickerYear(), c = -4, g = b + c, e = (new h).getFullYear(), q = this._MinMonth, k = this._MaxMonth,
                    q = q ? d(q) : 0, k = k ? d(k) : 0; this._prevButton.attr("title", this._i18n("prev5Years")).off("click.MonthPicker").on("click.MonthPicker", C(this._addToYears, this, -5)).button("option", "disabled", q && g - 1 < q); this._nextButton.attr("title", this._i18n("next5Years")).off("click.MonthPicker").on("click.MonthPicker", C(this._addToYears, this, 5)).button("option", "disabled", k && g + 12 - 1 > k); this._yearContainerAll.css("cursor", "default"); this._buttons.off(".MonthPicker"); f(this._selectedBtn, !1); for (var g = this.GetSelectedYear(),
                        l = C(this._onYearClick, this), u = m(e, q, k), x = m(g, q, k), w = 0; 12 > w; w++) { var A = b + c, D = a(this._buttons[w]).button({ disabled: !m(A, q, k), label: A }).toggleClass("ui-state-highlight", A === e && u).on("click.MonthPicker", { year: A }, l); x && g && g === A && (this._selectedBtn = f(D, !0)); c++ }
                }, _onMonthClick: function (a) { this._chooseMonth(a.data.month); this.Close(a) }, _onYearClick: function (a) { this._chooseYear(a.data.year) }, _addToYear: function (a) {
                    var b = this._yearContainer; b.text(parseInt(b.text()) + a, 10); this.element.focus(); this._decorateButtons();
                    r("OnAfter" + (0 < a ? "Next" : "Previous") + "Year", this)()
                }, _addToYears: function (a) { var b = this._yearContainer; b.text(parseInt(b.text()) + a, 10); this._showYears(); this.element.focus(); r("OnAfter" + (0 < a ? "Next" : "Previous") + "Years", this)() }, _ajustYear: function (a) { a = a.StartYear || this.GetSelectedYear() || (new h).getFullYear(); null !== this._MinMonth && (a = Math.max(d(this._MinMonth), a)); null !== this._MaxMonth && (a = Math.min(d(this._MaxMonth), a)); this._setPickerYear(a) }, _decorateButtons: function () {
                    var b = this._getPickerYear(),
                    g = c(new h), e = this._MinMonth, q = this._MaxMonth; f(this._selectedBtn, !1); var k = this.GetSelectedDate(), l = m(k ? c(k) : null, e, q); k && k.getFullYear() === b && (this._selectedBtn = f(a(this._buttons[k.getMonth()]), l)); this._prevButton.button("option", "disabled", e && b == d(e)); this._nextButton.button("option", "disabled", q && b == d(q)); for (k = 0; 12 > k; k++) { var l = 12 * b + k, u = m(l, e, q); a(this._buttons[k]).button({ disabled: !u }).toggleClass("ui-state-highlight", u && l == g) }
                }
        })
    } else alert(u + "The jQuery UI button and datepicker plug-ins must be loaded.")
})(jQuery,
    window, document, Date);
(function (a) {
    a.widget("ui.form", {
        options: { name: "", url: "", disabled: !1, beforeSubmit: function () { return !0 }, beforeValidate: function () { return !0 }, afterValidate: function () { return !0 }, afterSubmit: function () { return !0 } }, _create: function () {
            var l = this, e = this.element; a(".ui-form-ignore-enter-submit").bind("keydown", function (a) { 13 == a.keyCode && (a.preventDefault(), a.stopImmediatePropagation(), a.stopPropagation()) }); a(":text,:password", e).bind("keydown", function (a) { if (13 == a.keyCode) return l.validate(), !1 }); a(".ui-form-button-submit",
                e).bind("click", function (h) {
                    window.parent.parent.scrollTo(0, 0); window.parent.scrollTo(0, 0); window.scrollTo(0, 0); a(".ui-form-field-empty", e).removeClass("ui-form-field-empty"); a(".ui-form-has-fields-empty", e).hide(); a(".ui-form-has-fields-error", e).hide(); a(".ui-mask", e).each(function () { var b = a(this).val(); -1 < b.indexOf("_") && (-1 < b.indexOf(".") || 1 < b.indexOf("-") || 1 < b.indexOf("/")) && a(this).trigger("blur") }); a(".ui-validate", e).each(function () { a(this).trigger("blur") }); a(".ui-auto-complete", e).each(function () {
                        a(this).hasClass("ui-form-field-required") &&
                        "" == a("#" + a(this).attr("id").replace("_auto_complete", "")).val() && (a(this).val(""), c = !0)
                    }); "_self" == e.attr("target") && (a(".ui-form-button-submit", e).prop("disabled", !0).addClass("ui-state-disabled"), a(".ui-form-button-reset", e).prop("disabled", !0).addClass("ui-state-disabled")); var c = !1; a(".ui-form-field-required:visible:input:not(.ui-recursive-combobox-select)", e).each(function () { if ("" == a(this).val() || null == a(this).val()) a(this).addClass("ui-form-field-empty"), c = !0 }); a(".select2", e).each(function () {
                        var b =
                            a(this); b.prev().hasClass("ui-form-field-empty") && b.addClass("ui-form-field-empty")
                    }); a(".ui-recursive-combobox-select", e).each(function () { a(this).hasClass("ui-form-field-required") && "" == a(this).closest(".ui-recursive-combobox").find(":hidden").val() && (a(this).addClass("ui-form-field-empty"), c = !0) }); a("input:text", e).each(function () { a(this).val(a(this).val().trim()) }); a(".ui-rich-text", e).each(function () {
                        if (a(this).hasClass("ui-form-field-required")) {
                            var b = a(this).attr("id"); "" == CKEDITOR.instances[b].getData() &&
                                (a("#cke_" + b).css("border", "1px solid red"), c = !0)
                        }
                    }); a(".ui-treeview", e).each(function () { if (a(this).hasClass("ui-treeview-required")) { var b = a(this).attr("id"), d = !1; a(":hidden", "#" + b).each(function () { "" == a(this).val() && (d = !0) }); d && (a("#" + b).css("border", "1px solid red"), c = !0) } }); a(".ui-rich-text", e).each(function () { if (a(this).hasClass("ui-form-field-required")) { var b = a(this).attr("id"); "" == CKEDITOR.instances[b].getData() && (a("#cke_" + b).css("border", "1px solid red"), c = !0) } }); a(".ui-textarea", e).each(function () {
                        if (a(this).hasClass("ui-textarea-has-maxlength")) {
                            var b =
                                parseInt(a(this).attr("data-maxlength")), d = a(this).attr("id"); a(this).hasClass("ui-rich-text") && CKEDITOR.instances[d].getData().length > b ? (infoWindow("O(s) texto(s) inserido(s) excederam o tamanho máximo permitido, por favor reescreva."), a("#cke_" + d).css("border", "1px solid red"), c = !0) : a(this).val().length > b && (infoWindow("O(s) texto(s) inserido(s) excederam o tamanho máximo permitido, por favor reescreva."), a(this).addClass("ui-form-field-empty"), c = !0)
                        }
                    }); if (c) a(".ui-form-has-submit-error", e).val("true"),
                        a(".ui-form-has-fields-empty", e).show(), a(".ui-form-button-submit", e).prop("disabled", !1).removeClass("ui-state-disabled"), a(".ui-form-button-reset", e).prop("disabled", !1).removeClass("ui-state-disabled"); else {
                            a(".ui-form-field-disabled", e).attr("disabled", !1); var d = [], b = [], f = 0; a(".ui-detail-table").each(function () { 0 == parseInt(a(this).find(".ui-detail-table-row-count").val(), 10) && (d[f] = a(this), b[f] = a("tbody tr:eq(0)", a(this)).clone(!0), f++, a("tbody tr:eq(0)", a(this)).remove()) }); if ("" == l.options.url) a(".ui-form-has-submit-error",
                                e).val("false"), l.options.beforeSubmit.call() ? (l.element[0].submit(), l.options.afterSubmit.call()) : (a(".ui-form-button-submit", e).prop("disabled", !1).removeClass("ui-state-disabled"), a(".ui-form-button-reset", e).prop("disabled", !1).removeClass("ui-state-disabled")); else {
                                    var m = {
                                        url: l.options.url, type: "post", dataType: "json", data: { _format: "json" }, success: function (c) {
                                            "" != c.errors ? (a(".ui-form-field-disabled", e).attr("disabled", !0), a.each(d, function (a, c) { c.find(" \x3e tbody").append(b[a]) }), a(".ui-form-has-fields-error",
                                                e).show().find(".ui-state-error", e).html(c.errors), a(".ui-form-button-submit", e).prop("disabled", !1).removeClass("ui-state-disabled"), a(".ui-form-button-reset", e).prop("disabled", !1).removeClass("ui-state-disabled"), a(".ui-form-has-submit-error", e).val("true"), l.options.afterValidate.call()) : (a(".ui-form-has-submit-error", e).val("false"), l.options.afterValidate.call(), l.options.beforeSubmit.call() ? (l.element[0].submit(), l.options.afterSubmit.call()) : (a(".ui-form-button-submit", e).prop("disabled",
                                                    !1).removeClass("ui-state-disabled"), a(".ui-form-button-reset", e).prop("disabled", !1).removeClass("ui-state-disabled")))
                                        }, error: function (b, c, d) { a(".ui-form-button-submit", e).state({ type: "error", content: "Houve algum problema ao submeter o formulário para validação." + ("timeout" == c ? " Tentando novamente. Aguarde..." : "") }); a(".ui-form-button-submit", e).prop("disabled", !1).removeClass("ui-state-disabled"); a(".ui-form-button-reset", e).prop("disabled", !1).removeClass("ui-state-disabled"); "timeout" == c && l.element.ajaxSubmit(m) }
                                    };
                                l.options.beforeValidate.call() ? l.element.ajaxSubmit(m) : (a(".ui-form-button-submit", e).prop("disabled", !1).removeClass("ui-state-disabled"), a(".ui-form-button-reset", e).prop("disabled", !1).removeClass("ui-state-disabled"))
                            }
                    }
                }); a(".ui-form-button-reset", e).bind("click", function () { a(".ui-form-has-fields-empty", e).hide(); a(".ui-form-field-empty", e).removeClass("ui-form-field-empty"); l.element[0].reset() }); l.options.disabled && (a(":input:visible:not(.ui-form-dont-block)", e).each(function () {
                    a(this).addClass("ui-form-field-disabled");
                    a(this).attr("disabled", "disabled")
                }), a("button:not(.ui-form-dont-block)", e).each(function () { a(this).prop("disabled", !0).addClass("ui-state-disabled") }))
        }, validate: function () { a(".ui-form-button-submit", this.element).trigger("click") }
    })
})(jQuery);
(function (a) {
    function l() { a.fn.ajaxSubmit.debug && window.console && window.console.log && window.console.log("[jquery.form] " + Array.prototype.join.call(arguments, "")) } a.fn.ajaxSubmit = function (e) {
        if (!this.length) return this; "function" == typeof e && (e = { success: e }); var h = a.trim(this.attr("action")); h && (h = (h.match(/^([^#]+)/) || [])[1]); h = h || window.location.href || ""; e = a.extend({ url: h, type: this.attr("method") || "GET" }, e || {}); h = {}; this.trigger("form-pre-serialize", [this, e, h]); if (h.veto) return l("ajaxSubmit: submit vetoed via form-pre-serialize trigger"),
            this; if (e.beforeSerialize && !1 === e.beforeSerialize(this, e)) return l("ajaxSubmit: submit aborted via beforeSerialize callback"), this; var c = this.formToArray(e.semantic); if (e.data) { e.extraData = e.data; for (var d in e.data) if (e.data[d] instanceof Array) for (var b in e.data[d]) c.push({ name: d, value: e.data[d][b] }); else c.push({ name: d, value: e.data[d] }) } if (e.beforeSubmit && !1 === e.beforeSubmit(c, this, e)) return l("ajaxSubmit: submit aborted via beforeSubmit callback"), this; this.trigger("form-submit-validate", [c, this,
                e, h]); if (h.veto) return l("ajaxSubmit: submit vetoed via form-submit-validate trigger"), this; d = a.param(c); "GET" == e.type.toUpperCase() ? (e.url += (0 <= e.url.indexOf("?") ? "\x26" : "?") + d, e.data = null) : e.data = d; var f = this, m = []; e.resetForm && m.push(function () { f.resetForm() }); e.clearForm && m.push(function () { f.clearForm() }); if (!e.dataType && e.target) { var k = e.success || function () { }; m.push(function (b) { a(e.target).html(b).each(k, arguments) }) } else e.success && m.push(e.success); e.success = function (a, b) {
                    for (var c = 0, d = m.length; c <
                        d; c++)m[c].apply(e, [a, b, f])
                }; a.ajax(e); this.trigger("form-submit-notify", [this, e]); return this
    }; a.fn.ajaxForm = function (e) {
        return this.ajaxFormUnbind().bind("submit.form-plugin", function () { a(this).ajaxSubmit(e); return !1 }).bind("click.form-plugin", function (e) {
            var c = a(e.target); if (c.is(":submit,input:image")) {
                var d = this; d.clk = e.target; "image" == e.target.type && (void 0 != e.offsetX ? (d.clk_x = e.offsetX, d.clk_y = e.offsetY) : "function" == typeof a.fn.offset ? (c = c.offset(), d.clk_x = e.pageX - c.left, d.clk_y = e.pageY - c.top) :
                    (d.clk_x = e.pageX - e.target.offsetLeft, d.clk_y = e.pageY - e.target.offsetTop)); setTimeout(function () { d.clk = d.clk_x = d.clk_y = null }, 10)
            }
        })
    }; a.fn.ajaxFormUnbind = function () { return this.unbind("submit.form-plugin click.form-plugin") }; a.fn.formToArray = function (e) {
        var h = []; if (0 == this.length) return h; var c = this[0], d = e ? c.getElementsByTagName("*") : c.elements; if (!d) return h; for (var b = 0, f = d.length; b < f; b++) {
            var l = d[b], k = l.name; if (k) if (e && c.clk && "image" == l.type) l.disabled || c.clk != l || (h.push({ name: k, value: a(l).val() }),
                h.push({ name: k + ".x", value: c.clk_x }, { name: k + ".y", value: c.clk_y })); else if ((l = a.fieldValue(l, !0)) && l.constructor == Array) for (var r = 0, z = l.length; r < z; r++)h.push({ name: k, value: l[r] }); else null !== l && "undefined" != typeof l && h.push({ name: k, value: l })
        } !e && c.clk && (e = a(c.clk), d = e[0], (k = d.name) && !d.disabled && "image" == d.type && (h.push({ name: k, value: e.val() }), h.push({ name: k + ".x", value: c.clk_x }, { name: k + ".y", value: c.clk_y }))); return h
    }; a.fn.formSerialize = function (e) { return a.param(this.formToArray(e)) }; a.fn.fieldSerialize =
        function (e) { var h = []; this.each(function () { var c = this.name; if (c) { var d = a.fieldValue(this, e); if (d && d.constructor == Array) for (var b = 0, f = d.length; b < f; b++)h.push({ name: c, value: d[b] }); else null !== d && "undefined" != typeof d && h.push({ name: this.name, value: d }) } }); return a.param(h) }; a.fn.fieldValue = function (e) { for (var h = [], c = 0, d = this.length; c < d; c++) { var b = a.fieldValue(this[c], e); null === b || "undefined" == typeof b || b.constructor == Array && !b.length || (b.constructor == Array ? a.merge(h, b) : h.push(b)) } return h }; a.fieldValue =
            function (a, h) {
                var c = a.name, d = a.type, b = a.tagName.toLowerCase(); "undefined" == typeof h && (h = !0); if (h && (!c || a.disabled || "reset" == d || "button" == d || ("checkbox" == d || "radio" == d) && !a.checked || ("submit" == d || "image" == d) && a.form && a.form.clk != a || "select" == b && -1 == a.selectedIndex)) return null; if ("select" == b) {
                    var f = a.selectedIndex; if (0 > f) return null; for (var c = [], b = a.options, l = (d = "select-one" == d) ? f + 1 : b.length, f = d ? f : 0; f < l; f++) {
                        var k = b[f]; if (k.selected) {
                            var r = k.value; r || (r = k.attributes && k.attributes.value && !k.attributes.value.specified ?
                                k.text : k.value); if (d) return r; c.push(r)
                        }
                    } return c
                } return a.value
            }; a.fn.clearForm = function () { return this.each(function () { a("input,select,textarea", this).clearFields() }) }; a.fn.clearFields = a.fn.clearInputs = function () { return this.each(function () { var a = this.type, h = this.tagName.toLowerCase(); "text" == a || "password" == a || "textarea" == h ? this.value = "" : "checkbox" == a || "radio" == a ? this.checked = !1 : "select" == h && (this.selectedIndex = -1) }) }; a.fn.resetForm = function () {
                return this.each(function () {
                    ("function" == typeof this.reset ||
                        "object" == typeof this.reset && !this.reset.nodeType) && this.reset()
                })
            }; a.fn.enable = function (a) { void 0 == a && (a = !0); return this.each(function () { this.disabled = !a }) }; a.fn.selected = function (e) { void 0 == e && (e = !0); return this.each(function () { var h = this.type; "checkbox" == h || "radio" == h ? this.checked = e : "option" == this.tagName.toLowerCase() && (h = a(this).parent("select"), e && h[0] && "select-one" == h[0].type && h.find("option").selected(!1), this.selected = e) }) }
})(jQuery);
(function (a, l) {
    function e(b) { a.extend(!0, va, b) } function h(e, q, h) {
        function k() { setTimeout(function () { !s.start && 0 !== a("body")[0].offsetWidth && n() }, 0) } function u(b) {
            if (!s || b != s.name) {
                J++; E(); var c = s, g; c ? ((c.beforeHide || U)(), T(z, z.height()), c.element.hide()) : T(z, 1); z.css("overflow", "hidden"); (s = y[b]) ? s.element.show() : s = y[b] = new ea[b](g = W = a("\x3cdiv class\x3d'fc-view fc-view-" + b + "' style\x3d'position:absolute'/\x3e").appendTo(z), F); c && Q.deactivateButton(c.name); Q.activateButton(b); n(); z.css("overflow",
                    ""); c && T(z, 1); g || (s.afterShow || U)(); J--
            }
        } function n(a) { if (0 !== H.offsetWidth) { J++; E(); G === l && B(); var b = !1; !s.start || a || aa < s.start || aa >= s.end ? (s.render(aa, a || 0), r(!0), b = !0) : s.sizeDirty ? (s.clearEvents(), r(), b = !0) : s.eventsDirty && (s.clearEvents(), b = !0); s.sizeDirty = !1; s.eventsDirty = !1; a = b; !q.lazyFetching || S(s.visStart, s.visEnd) ? I() : a && C(); R = e.outerWidth(); Q.updateTitle(s.title); a = new Date; a >= s.start && a < s.end ? Q.disableButton("today") : Q.enableButton("today"); J--; s.trigger("viewDisplay", H) } } function w() {
            A();
            0 !== H.offsetWidth && (B(), r(), E(), s.clearEvents(), s.renderEvents(P), s.sizeDirty = !1)
        } function A() { a.each(y, function (a, b) { b.sizeDirty = !0 }) } function B() { G = q.contentHeight ? q.contentHeight : q.height ? q.height - (N ? N.height() : 0) - Y(z) : Math.round(z.width() / Math.max(q.aspectRatio, 0.5)) } function r(a) { J++; s.setHeight(G, a); W && (W.css("position", "relative"), W = null); s.setWidth(z.width(), a); J-- } function K() {
            if (!J) if (s.start) {
                var a = ++V; setTimeout(function () {
                    a != V || J || 0 === H.offsetWidth || R == (R = e.outerWidth()) || (J++, w(), s.trigger("windowResize",
                        H), J--)
                }, 200)
            } else k()
        } function I() { v(s.visStart, s.visEnd) } function C(a) { O(); 0 !== H.offsetWidth && (s.clearEvents(), s.renderEvents(P, a), s.eventsDirty = !1) } function O() { a.each(y, function (a, b) { b.eventsDirty = !0 }) } function E() { s && s.unselect() } var F = this; F.options = q; F.render = function (b) {
            z ? (B(), A(), O(), n(b)) : (e.addClass("fc"), q.isRTL ? e.addClass("fc-rtl") : e.addClass("fc-ltr"), q.theme && e.addClass("ui-widget"), z = a("\x3cdiv class\x3d'fc-content' style\x3d'position:relative'/\x3e").prependTo(e), Q = new c(F, q), (N =
                Q.render()) && e.prepend(N), u(q.defaultView), a(window).resize(K), 0 !== a("body")[0].offsetWidth || k())
        }; F.destroy = function () { a(window).unbind("resize", K); Q.destroy(); z.remove(); e.removeClass("fc fc-rtl ui-widget") }; F.refetchEvents = I; F.reportEvents = function (a) { P = a; C() }; F.reportEventChange = function (a) { C(a) }; F.rerenderEvents = C; F.changeView = u; F.select = function (a, b, c) { s.select(a, b, c === l ? !0 : c) }; F.unselect = E; F.prev = function () { n(-1) }; F.next = function () { n(1) }; F.prevYear = function () { b(aa, -1); n() }; F.nextYear = function () {
            b(aa,
                1); n()
        }; F.today = function () { aa = new Date; n() }; F.gotoDate = function (a, b, c) { a instanceof Date ? aa = t(a) : g(aa, a, b, c); n() }; F.incrementDate = function (a, c, g) { a !== l && b(aa, a); c !== l && f(aa, c); g !== l && m(aa, g); n() }; F.formatDate = function (a, b) { return x(a, b, q) }; F.formatDates = function (a, b, c) { return D(a, b, c, q) }; F.getDate = function () { return t(aa) }; F.getView = function () { return s }; F.option = function (a, b) { if (b === l) return q[a]; if ("height" == a || "contentHeight" == a || "aspectRatio" == a) q[a] = b, w() }; F.trigger = function (a, b) {
            if (q[a]) return q[a].apply(b ||
                H, Array.prototype.slice.call(arguments, 2))
        }; d.call(F, q, h); var S = F.isFetchNeeded, v = F.fetchEvents, H = e[0], Q, N, z, s, y = {}, R, G, W, V = 0, J = 0, aa = new Date, P = [], L; g(aa, q.year, q.month, q.date); q.droppable && a(document).bind("dragstart", function (b, c) { var g = b.target, d = a(g); if (!d.parents(".fc").length) { var e = q.dropAccept; if (a.isFunction(e) ? e.call(g, d) : d.is(e)) L = g, s.dragStart(L, b, c) } }).bind("dragstop", function (a, b) { L && (s.dragStop(L, a, b), L = null) })
    } function c(b, c) {
        function g(d) {
            var f = a("\x3ctd class\x3d'fc-header-" + d + "'/\x3e");
            (d = c.header[d]) && a.each(d.split(" "), function (g) {
                0 < g && f.append("\x3cspan class\x3d'fc-header-space'/\x3e"); var d; a.each(this.split(","), function (g, q) {
                    if ("title" == q) f.append("\x3cspan class\x3d'fc-header-title'\x3e\x3ch2\x3e\x26nbsp;\x3c/h2\x3e\x3c/span\x3e"), d && d.addClass(e + "-corner-right"), d = null; else {
                        var h; b[q] ? h = b[q] : ea[q] && (h = function () { m.removeClass(e + "-state-hover"); b.changeView(q) }); if (h) {
                            var k = c.theme ? N(c.buttonIcons, q) : null, l = N(c.buttonText, q), m = a("\x3cspan class\x3d'fc-button fc-button-" +
                                q + " " + e + "-state-default'\x3e" + (k ? "\x3cspan class\x3d'fc-icon-wrap'\x3e\x3cspan class\x3d'ui-icon ui-icon-" + k + "'/\x3e\x3c/span\x3e" : l) + "\x3c/span\x3e").click(function () { m.hasClass(e + "-state-disabled") || h() }).mousedown(function () { m.not("." + e + "-state-active").not("." + e + "-state-disabled").addClass(e + "-state-down") }).mouseup(function () { m.removeClass(e + "-state-down") }).hover(function () { m.not("." + e + "-state-active").not("." + e + "-state-disabled").addClass(e + "-state-hover") }, function () {
                                    m.removeClass(e + "-state-hover").removeClass(e +
                                        "-state-down")
                                }).appendTo(f); ba(m); d || m.addClass(e + "-corner-left"); d = m
                        }
                    }
                }); d && d.addClass(e + "-corner-right")
            }); return f
        } this.render = function () { e = c.theme ? "ui" : "fc"; if (c.header) return d = a("\x3ctable class\x3d'fc-header' style\x3d'width:100%'/\x3e").append(a("\x3ctr/\x3e").append(g("left")).append(g("center")).append(g("right"))) }; this.destroy = function () { d.remove() }; this.updateTitle = function (a) { d.find("h2").html(a) }; this.activateButton = function (a) { d.find("span.fc-button-" + a).addClass(e + "-state-active") };
        this.deactivateButton = function (a) { d.find("span.fc-button-" + a).removeClass(e + "-state-active") }; this.disableButton = function (a) { d.find("span.fc-button-" + a).addClass(e + "-state-disabled") }; this.enableButton = function (a) { d.find("span.fc-button-" + a).removeClass(e + "-state-disabled") }; var d = a([]), e
    } function d(b, c) {
        function g(c, e) {
            d(c, function (g) {
                if (e == D) {
                    if (g) {
                        b.eventDataTransform && (g = a.map(g, b.eventDataTransform)); c.eventDataTransform && (g = a.map(g, c.eventDataTransform)); for (var d = 0; d < g.length; d++)g[d].source =
                            c, f(g[d]); K = K.concat(g)
                    } B--; B || m(K)
                }
            })
        } function d(c, g) {
            var e, f = ja.sourceFetchers, q; for (e = 0; e < f.length; e++) { q = f[e](c, w, A, g); if (!0 === q) return; if ("object" == typeof q) { d(q, g); return } } if (e = c.events) a.isFunction(e) ? (r++ || h("loading", null, !0), e(t(w), t(A), function (a) { g(a); --r || h("loading", null, !1) })) : a.isArray(e) ? g(e) : g(); else if (c.url) {
                var k = c.success, l = c.error, m = c.complete; e = a.extend({}, c.data || {}); f = V(c.startParam, b.startParam); q = V(c.endParam, b.endParam); f && (e[f] = Math.round(+w / 1E3)); q && (e[q] = Math.round(+A /
                    1E3)); r++ || h("loading", null, !0); a.ajax(a.extend({}, ya, c, { data: e, success: function (b) { b = b || []; var c = Q(k, this, arguments); a.isArray(c) && (b = c); g(b) }, error: function () { Q(l, this, arguments); g() }, complete: function () { Q(m, this, arguments); --r || h("loading", null, !1) } }))
            } else g()
        } function e(b) {
            a.isFunction(b) || a.isArray(b) ? b = { events: b } : "string" == typeof b && (b = { url: b }); if ("object" == typeof b) {
                var c = b; c.className ? "string" == typeof c.className && (c.className = c.className.split(/\s+/)) : c.className = []; for (var g = ja.sourceNormalizers,
                    d = 0; d < g.length; d++)g[d](c); n.push(b); return b
            }
        } function f(a) { var c = a.source || {}, g = V(c.ignoreTimezone, b.ignoreTimezone); a._id = a._id || (a.id === l ? "_fc" + Oa++ : a.id + ""); a.date && (a.start || (a.start = a.date), delete a.date); a._start = t(a.start = u(a.start, g)); a.end = u(a.end, g); a.end && a.end <= a.start && (a.end = null); a._end = a.end ? t(a.end) : null; a.allDay === l && (a.allDay = V(c.allDayDefault, b.allDayDefault)); a.className ? "string" == typeof a.className && (a.className = a.className.split(/\s+/)) : a.className = [] } function q(a) {
            return ("object" ==
                typeof a ? a.events || a.url : "") || a
        } this.isFetchNeeded = function (a, b) { return !w || a < w || b > A }; this.fetchEvents = function (a, b) { w = a; A = b; K = []; var c = ++D, d = n.length; B = d; for (var e = 0; e < d; e++)g(n[e], c) }; this.addEventSource = function (a) { if (a = e(a)) B++, g(a, D) }; this.removeEventSource = function (b) { n = a.grep(n, function (a) { return !(a && b && q(a) == q(b)) }); K = a.grep(K, function (a) { return !(a.source && b && q(a.source) == q(b)) }); m(K) }; this.updateEvent = function (a) {
            var b, c = K.length, g, d = k().defaultEventEnd, e = a.start - a._start, q = a.end ? a.end - (a._end ||
                d(a)) : 0; for (b = 0; b < c; b++)g = K[b], g._id == a._id && g != a && (g.start = new Date(+g.start + e), g.end = a.end ? g.end ? new Date(+g.end + q) : new Date(+d(g) + q) : null, g.title = a.title, g.url = a.url, g.allDay = a.allDay, g.className = a.className, g.editable = a.editable, g.color = a.color, g.backgroudColor = a.backgroudColor, g.borderColor = a.borderColor, g.textColor = a.textColor, f(g)); f(a); m(K)
        }; this.renderEvent = function (a, b) { f(a); a.source || (b && (x.events.push(a), a.source = x), K.push(a)); m(K) }; this.removeEvents = function (b) {
            if (b) {
                if (!a.isFunction(b)) {
                    var c =
                        b + ""; b = function (a) { return a._id == c }
                } K = a.grep(K, b, !0); for (g = 0; g < n.length; g++)a.isArray(n[g].events) && (n[g].events = a.grep(n[g].events, b, !0))
            } else { K = []; for (var g = 0; g < n.length; g++)a.isArray(n[g].events) && (n[g].events = []) } m(K)
        }; this.clientEvents = function (b) { return a.isFunction(b) ? a.grep(K, b) : b ? (b += "", a.grep(K, function (a) { return a._id == b })) : K }; this.normalizeEvent = f; for (var h = this.trigger, k = this.getView, m = this.reportEvents, x = { events: [] }, n = [x], w, A, D = 0, B = 0, r = 0, K = [], I = 0; I < c.length; I++)e(c[I])
    } function b(a,
        b, c) { a.setFullYear(a.getFullYear() + b); c || z(a); return a } function f(a, b, c) { if (+a) { b = a.getMonth() + b; var g = t(a); g.setDate(1); g.setMonth(b); a.setMonth(b); for (c || z(a); a.getMonth() != g.getMonth();)a.setDate(a.getDate() + (a < g ? 1 : -1)) } return a } function m(a, b, c) { if (+a) { b = a.getDate() + b; var g = t(a); g.setHours(9); g.setDate(b); a.setDate(b); c || z(a); k(a, g) } return a } function k(a, b) { if (+a) for (; a.getDate() != b.getDate();)a.setTime(+a + (a < b ? 1 : -1) * Da) } function r(a, b) { a.setMinutes(a.getMinutes() + b); return a } function z(a) {
            a.setHours(0);
            a.setMinutes(0); a.setSeconds(0); a.setMilliseconds(0); return a
        } function t(a, b) { return b ? z(new Date(+a)) : new Date(+a) } function s() { var a = 0, b; do b = new Date(1970, a++, 1); while (b.getHours()); return b } function v(a, b, c) { for (b = b || 1; !a.getDay() || c && 1 == a.getDay() || !c && 6 == a.getDay();)m(a, b); return a } function y(a, b) { return Math.round((t(a, !0) - t(b, !0)) / Sa) } function g(a, b, c, g) { b !== l && b != a.getFullYear() && (a.setDate(1), a.setMonth(0), a.setFullYear(b)); c !== l && c != a.getMonth() && (a.setDate(1), a.setMonth(c)); g !== l && a.setDate(g) }
    function u(a, b) { if ("object" == typeof a) return a; if ("number" == typeof a) return new Date(1E3 * a); if ("string" == typeof a) { if (a.match(/^\d+(\.\d+)?$/)) return new Date(1E3 * parseFloat(a)); b === l && (b = !0); return q(a, b) || (a ? new Date(a) : null) } return null } function q(a, b) {
        var c = a.match(/^([0-9]{4})(-([0-9]{2})(-([0-9]{2})([T ]([0-9]{2}):([0-9]{2})(:([0-9]{2})(\.([0-9]+))?)?(Z|(([-+])([0-9]{2})(:?([0-9]{2}))?))?)?)?)?$/); if (!c) return null; var g = new Date(c[1], 0, 1); if (b || !c[13]) {
            var d = new Date(c[1], 0, 1, 9, 0); c[3] && (g.setMonth(c[3] -
                1), d.setMonth(c[3] - 1)); c[5] && (g.setDate(c[5]), d.setDate(c[5])); k(g, d); c[7] && g.setHours(c[7]); c[8] && g.setMinutes(c[8]); c[10] && g.setSeconds(c[10]); c[12] && g.setMilliseconds(1E3 * Number("0." + c[12])); k(g, d)
        } else g.setUTCFullYear(c[1], c[3] ? c[3] - 1 : 0, c[5] || 1), g.setUTCHours(c[7] || 0, c[8] || 0, c[10] || 0, c[12] ? 1E3 * Number("0." + c[12]) : 0), c[14] && (d = 60 * Number(c[16]) + (c[18] ? Number(c[18]) : 0), d *= "-" == c[15] ? 1 : -1, g = new Date(+g + 6E4 * d)); return g
    } function w(a) {
        if ("number" == typeof a) return 60 * a; if ("object" == typeof a) return 60 *
            a.getHours() + a.getMinutes(); if (a = a.match(/(\d+)(?::(\d+))?\s*(\w+)?/)) { var b = parseInt(a[1], 10); a[3] && (b %= 12, "p" == a[3].toLowerCase().charAt(0) && (b += 12)); return 60 * b + (a[2] ? parseInt(a[2], 10) : 0) }
    } function x(a, b, c) { return D(a, null, b, c) } function D(a, b, c, g) {
        g = g || va; var d = a, e = b, f, q = c.length, h, k, l, m = ""; for (f = 0; f < q; f++)if (h = c.charAt(f), "'" == h) for (k = f + 1; k < q; k++) { if ("'" == c.charAt(k)) { d && (m = k == f + 1 ? m + "'" : m + c.substring(f + 1, k), f = k); break } } else if ("(" == h) for (k = f + 1; k < q; k++) {
            if (")" == c.charAt(k)) {
                f = x(d, c.substring(f +
                    1, k), g); parseInt(f.replace(/\D/, ""), 10) && (m += f); f = k; break
            }
        } else if ("[" == h) for (k = f + 1; k < q; k++) { if ("]" == c.charAt(k)) { h = c.substring(f + 1, k); f = x(d, h, g); f != x(e, h, g) && (m += f); f = k; break } } else if ("{" == h) d = b, e = a; else if ("}" == h) d = a, e = b; else { for (k = q; k > f; k--)if (l = Pa[c.substring(f, k)]) { d && (m += l(d, g)); f = k - 1; break } k == f && d && (m += h) } return m
    } function A(a) { if (a.end) { var b = a.end; a = a.allDay; b = t(b); return a || b.getHours() || b.getMinutes() ? m(b, 1) : z(b) } return m(t(a.start), 1) } function I(a, b) {
        return 100 * (b.msLength - a.msLength) +
            (a.event.start - b.event.start)
    } function E(a, b, c, g) { var d = [], e, f = a.length, q, h, k, l, m; for (e = 0; e < f; e++)q = a[e], h = q.start, k = b[e], k > c && h < g && (h < c ? (h = t(c), l = !1) : l = !0, k > g ? (k = t(g), m = !1) : m = !0, d.push({ event: q, start: h, end: k, isStart: l, isEnd: m, msLength: k - h })); return d.sort(I) } function O(a) { var b = [], c, g = a.length, d, e, f, q; for (c = 0; c < g; c++) { d = a[c]; for (e = 0; ;) { f = !1; if (b[e]) for (q = 0; q < b[e].length; q++)if (b[e][q].end > d.start && b[e][q].start < d.end) { f = !0; break } if (f) e++; else break } b[e] ? b[e].push(d) : b[e] = [d] } return b } function C(b,
        c, g) { b.unbind("mouseover").mouseover(function (b) { for (var d = b.target, e; d != this;)e = d, d = d.parentNode; (d = e._fci) !== l && (e._fci = l, e = c[d], g(e.event, e.element, e), a(b.target).trigger(b)); b.stopPropagation() }) } function S(b, c, g) { for (var d = 0, e; d < b.length; d++)e = a(b[d]), e.width(Math.max(0, c - K(e, g))) } function B(b, c, g) { for (var d = 0, e; d < b.length; d++)e = a(b[d]), e.height(Math.max(0, c - Y(e, g))) } function K(b, c) {
            return (parseFloat(a.css(b[0], "paddingLeft", !0)) || 0) + (parseFloat(a.css(b[0], "paddingRight", !0)) || 0) + ((parseFloat(a.css(b[0],
                "borderLeftWidth", !0)) || 0) + (parseFloat(a.css(b[0], "borderRightWidth", !0)) || 0)) + (c ? (parseFloat(a.css(b[0], "marginLeft", !0)) || 0) + (parseFloat(a.css(b[0], "marginRight", !0)) || 0) : 0)
        } function Y(b, c) { return (parseFloat(a.css(b[0], "paddingTop", !0)) || 0) + (parseFloat(a.css(b[0], "paddingBottom", !0)) || 0) + ((parseFloat(a.css(b[0], "borderTopWidth", !0)) || 0) + (parseFloat(a.css(b[0], "borderBottomWidth", !0)) || 0)) + (c ? F(b) : 0) } function F(b) {
            return (parseFloat(a.css(b[0], "marginTop", !0)) || 0) + (parseFloat(a.css(b[0], "marginBottom",
                !0)) || 0)
        } function T(a, b) { b = "number" == typeof b ? b + "px" : b; a.each(function (a, c) { c.style.cssText += ";min-height:" + b + ";_height:" + b }) } function U() { } function H(a, b) { return a - b } function R(a) { return (10 > a ? "0" : "") + a } function N(a, b) { if (a[b] !== l) return a[b]; for (var c = b.split(/(?=[A-Z])/), g = c.length - 1, d; 0 <= g; g--)if (d = a[c[g].toLowerCase()], d !== l) return d; return a[""] } function L(a) {
            return a.replace(/&/g, "\x26amp;").replace(/</g, "\x26lt;").replace(/>/g, "\x26gt;").replace(/'/g, "\x26#039;").replace(/"/g, "\x26quot;").replace(/\n/g,
                "\x3cbr /\x3e")
        } function ha(a) { return a.id + "/" + a.className + "/" + a.style.cssText.replace(/(^|;)\s*(top|left|width|height)\s*:[^;]*/ig, "") } function ba(a) { a.attr("unselectable", "on").css("MozUserSelect", "none").bind("selectstart.ui", function () { return !1 }) } function ca(a) { a.children().removeClass("fc-first fc-last").filter(":first-child").addClass("fc-first").end().filter(":last-child").addClass("fc-last") } function G(a, b) { a.each(function (a, c) { c.className = c.className.replace(/^fc-\w*/, "fc-" + za[b.getDay()]) }) }
    function M(a, b) { var c = a.source || {}, g = a.color, d = c.color, e = b("eventColor"), f = a.backgroundColor || g || c.backgroundColor || d || b("eventBackgroundColor") || e, g = a.borderColor || g || c.borderColor || d || b("eventBorderColor") || e, c = a.textColor || c.textColor || b("eventTextColor"), d = []; f && d.push("background-color:" + f); g && d.push("border-color:" + g); c && d.push("color:" + c); return d.join(";") } function Q(b, c, g) { a.isFunction(b) && (b = [b]); if (b) { var d, e; for (d = 0; d < b.length; d++)e = b[d].apply(c, g) || e; return e } } function V() {
        for (var a =
            0; a < arguments.length; a++)if (arguments[a] !== l) return arguments[a]
    } function da(b, c, g) {
        function d(c) {
            var g = "", f, q; q = qa + "-widget-header"; var h = qa + "-widget-content", k = w.start.getMonth(), l = z(new Date), m, n, g = g + "\x3ctable class\x3d'fc-border-separate' style\x3d'width:100%' cellspacing\x3d'0'\x3e\x3cthead\x3e\x3ctr\x3e"; la && (g += "\x3cth class\x3d'fc-week-number " + q + "'/\x3e"); for (f = 0; f < L; f++)m = u(0, f), g += "\x3cth class\x3d'fc-day-header fc-" + za[m.getDay()] + " " + q + "'/\x3e"; g += "\x3c/tr\x3e\x3c/thead\x3e\x3ctbody\x3e";
            for (f = 0; f < P; f++) {
                g += "\x3ctr class\x3d'fc-week'\x3e"; la && (g += "\x3ctd class\x3d'fc-week-number " + h + "'\x3e\x3cdiv/\x3e\x3c/td\x3e"); for (q = 0; q < L; q++)m = u(f, q), n = ["fc-day", "fc-" + za[m.getDay()], h], m.getMonth() != k && n.push("fc-other-month"), +m == +l && (n.push("fc-today"), n.push(qa + "-state-highlight")), g += "\x3ctd class\x3d'" + n.join(" ") + "' data-date\x3d'" + C(m, "yyyy-MM-dd") + "'\x3e\x3cdiv\x3e", c && (g += "\x3cdiv class\x3d'fc-day-number'\x3e" + m.getDate() + "\x3c/div\x3e"), g += "\x3cdiv class\x3d'fc-day-content'\x3e\x3cdiv style\x3d'position:relative'\x3e\x26nbsp;\x3c/div\x3e\x3c/div\x3e\x3c/div\x3e\x3c/td\x3e";
                g += "\x3c/tr\x3e"
            } g += "\x3c/tbody\x3e\x3c/table\x3e"; T(b, b.height()); O && O.remove(); O = a(g).appendTo(b); E = O.find("thead"); F = E.find(".fc-day-header"); s = O.find("tbody"); v = s.find("tr"); Q = s.find(".fc-day"); H = v.find("td:first-child"); N = v.eq(0).find(".fc-day-content \x3e div"); ca(E.add(E.find("tr"))); ca(v); v.eq(0).addClass("fc-first"); v.filter(":last").addClass("fc-last"); la && E.find(".fc-week-number").text(wa); F.each(function (b, c) { var g = u(Math.floor(b / L), b % L); a(c).text(C(g, ka)) }); la && s.find(".fc-week-number \x3e div").each(function (b,
                c) { var g = u(b, 0); a(c).text(C(g, Ba)) }); Q.each(function (b, c) { var g = u(Math.floor(b / L), b % L); D("dayRender", w, g, a(c)) }); Q.click(e).mousedown(I)
        } function e(b) { if (!A("selectable")) { var c = q(a(this).data("date")); D("dayClick", this, c, !0, b) } } function f(a, b, c) { c && M.build(); c = t(w.visStart); for (var g = m(t(c), L), d = 0; d < P; d++) { var q = new Date(Math.max(c, a)), k = new Date(Math.min(g, b)); if (q < k) { var l; ha ? (l = y(k, c) * ea + ra + 1, q = y(q, c) * ea + ra + 1) : (l = y(q, c), q = y(k, c)); h(d, l, d, q - 1).click(e).mousedown(I) } m(c, 7); m(g, 7) } } function h(a,
            c, g, d) { a = M.rect(a, c, g, d, b); return K(a, b) } function k(a) { return { row: Math.floor(y(a, w.visStart) / 7), col: x(a.getDay()) } } function l(a) { return u(a.row, a.col) } function u(a, b) { return m(t(w.visStart), 7 * a + b * ea + ra) } function x(a) { return (a - Math.max(ga, ya) + L) % L * ea + ra } var w = this; w.renderBasic = function (c, g, e) {
                P = c; L = g; (ha = A("isRTL")) ? (ea = -1, ra = L - 1) : (ea = 1, ra = 0); ga = A("firstDay"); ya = A("weekends") ? 0 : 1; qa = A("theme") ? "ui" : "fc"; ka = A("columnFormat"); la = A("weekNumbers"); wa = A("weekNumberTitle"); Ba = "iso" != A("weekNumberCalculation") ?
                    "w" : "W"; s ? B() : R = a("\x3cdiv style\x3d'position:absolute;z-index:8;top:0;left:0'/\x3e").appendTo(b); d(e)
            }; w.setHeight = function (c) { W = c; c = W - E.height(); var g, d, e; "variable" == A("weekMode") ? g = d = Math.floor(c / (1 == P ? 2 : 6)) : (g = Math.floor(c / P), d = c - g * (P - 1)); H.each(function (b, c) { b < P && (e = a(c), T(e.find("\x3e div"), (b == P - 1 ? d : g) - Y(e))) }); T(b, 1) }; w.setWidth = function (a) { G = a; X.clear(); U = 0; la && (U = E.find("th.fc-week-number").outerWidth()); V = Math.floor((G - U) / L); S(F.slice(0, -1), V) }; w.renderDayOverlay = f; w.defaultSelectionEnd =
                function (a, b) { return t(a) }; w.renderSelection = function (a, b, c) { f(a, m(t(b), 1), !0) }; w.clearSelection = function () { r() }; w.reportDayClick = function (a, b, c) { var g = k(a); D("dayClick", Q[g.row * L + g.col], a, b, c) }; w.dragStart = function (a, b, c) { da.start(function (a) { r(); a && h(a.row, a.col, a.row, a.col) }, b) }; w.dragStop = function (a, b, c) { var g = da.stop(); r(); g && (g = l(g), D("drop", a, g, !0, b, c)) }; w.defaultEventEnd = function (a) { return t(a.start) }; w.getHoverListener = function () { return da }; w.colContentLeft = function (a) { return X.left(a) };
        w.colContentRight = function (a) { return X.right(a) }; w.dayOfWeekCol = x; w.dateCell = k; w.cellDate = l; w.cellIsAllDay = function () { return !0 }; w.allDayRow = function (a) { return v.eq(a) }; w.allDayBounds = function (a) { a = 0; la && (a += U); return { left: a, right: G } }; w.getRowCnt = function () { return P }; w.getColCnt = function () { return L }; w.getColWidth = function () { return V }; w.getDaySegmentContainer = function () { return R }; Z.call(w, b, c, g); aa.call(w); ia.call(w); J.call(w); var A = w.opt, D = w.trigger, B = w.clearEvents, K = w.renderOverlay, r = w.clearOverlays,
            I = w.daySelectionMousedown, C = c.formatDate, O, E, F, s, v, Q, H, N, R, G, W, V, U, P, L, M, da, X, ha, ea, ra, ga, ya, qa, ka, la, wa, Ba; ba(b.addClass("fc-grid")); M = new ua(function (b, c) { var g, d, e; F.each(function (b, f) { g = a(f); d = g.offset().left; b && (e[1] = d); e = [d]; c[b] = e }); e[1] = d + g.outerWidth(); v.each(function (c, f) { c < P && (g = a(f), d = g.offset().top, c && (e[1] = d), e = [d], b[c] = e) }); e[1] = d + g.outerHeight() }); da = new Ma(M); X = new n(function (a) { return N.eq(a) })
    } function J() {
        function b(c) {
            var d = r(), e = I(), f = t(g.visStart), e = m(t(f), e), q = a.map(c, A), h,
            k, l, u, w, n, x = []; for (h = 0; h < d; h++) { k = O(E(c, q, f, e)); for (l = 0; l < k.length; l++)for (u = k[l], w = 0; w < u.length; w++)n = u[w], n.row = h, n.level = l, x.push(n); m(f, 7); m(e, 7) } return x
        } function c(a, b) {
            var g = D(), f; b.draggable({
                zIndex: 9, delay: 50, opacity: d("dragOpacity"), revertDuration: d("dragRevertDuration"), start: function (c, q) { e("eventDragStart", b, a, c, q); w(a, b); g.start(function (c, g, e, q) { b.draggable("option", "revert", !c || !e && !q); K(); c ? (f = 7 * e + q * (d("isRTL") ? -1 : 1), B(m(t(a.start), f), m(A(a), f))) : f = 0 }, c, "drag") }, stop: function (c, d) {
                    g.stop();
                    K(); e("eventDragStop", b, a, c, d); f ? n(this, a, f, 0, a.allDay, c, d) : (b.css("filter", ""), u(a, b))
                }
            })
        } var g = this; g.renderEvents = function (a, c) { h(a); C(b(a), c); e("eventAfterAllRender") }; g.compileDaySegs = b; g.clearEvents = function () { k(); x().empty() }; g.bindDaySeg = function (a, b, g) { f(a) && c(a, b); g.isEnd && q(a) && F(a, b, g); l(a, b) }; W.call(g); var d = g.opt, e = g.trigger, f = g.isEventDraggable, q = g.isEventResizable, h = g.reportEvents, k = g.reportEventClear, l = g.eventElementHandlers, u = g.showEvents, w = g.hideEvents, n = g.eventDrop, x = g.getDaySegmentContainer,
            D = g.getHoverListener, B = g.renderDayOverlay, K = g.clearOverlays, r = g.getRowCnt, I = g.getColCnt, C = g.renderDaySegs, F = g.resizableDayEvent
    } function P(b, c, g) {
        function d() { function a() { ga.scrollTop(g) } var b = s(), c = t(b); c.setHours(F("firstHour")); var g = D(b, c) + 1; a(); setTimeout(a, 0) } function e(a) {
            if (!F("selectable")) {
                var b = Math.min(na - 1, Math.floor((a.pageX - P.offset().left - Ka) / Oa)), c = u(b), g = this.parentNode.className.match(/fc-slot(\d+)/); g ? (g = parseInt(g[1]) * F("slotMinutes"), c.setHours(Math.floor(g / 60)), c.setMinutes(g %
                    60 + Na), v("dayClick", ea[b], c, !1, a)) : v("dayClick", ea[b], c, !0, a)
            }
        } function f(a, b, c) { c && La.build(); var g = t(E.visStart); nb ? (c = y(b, g) * Ca + Ja + 1, a = y(a, g) * Ca + Ja + 1) : (c = y(a, g), a = y(b, g)); c = Math.max(0, c); a = Math.min(na, a); c < a && q(0, c, 0, a - 1).click(e).mousedown(U) } function q(a, b, c, g) { a = La.rect(a, b, c, g, Ha); return N(a, Ha) } function h(a, b) {
            for (var c = t(E.visStart), g = m(t(c), 1), d = 0; d < na; d++) {
                var f = new Date(Math.max(c, a)), q = new Date(Math.min(g, b)); if (f < q) {
                    var k = d * Ca + Ja, k = La.rect(0, k, 0, k, sa), f = D(c, f), q = D(c, q); k.top = f; k.height =
                        q - f; N(k, sa).click(e).mousedown(C)
                } m(c, 1); m(g, 1)
            }
        } function k(a) { var b = u(a.col); a = a.row; F("allDaySlot") && a--; 0 <= a && r(b, Na + a * Ra); return b } function u(a) { return m(t(E.visStart), a * Ca + Ja) } function x(a) { return F("allDaySlot") && !a.row } function A(a) { return (a - Math.max(Sa, ab) + na) % na * Ca + Ja } function D(a, b) {
            a = t(a, !0); if (b < r(t(a), Na)) return 0; if (b >= r(t(a), bb)) return ka.height(); var c = F("slotMinutes"), g = 60 * b.getHours() + b.getMinutes() - Na, d = Math.floor(g / c), e = Pa[d]; e === l && (e = Pa[d] = ka.find("tr:eq(" + d + ") td div")[0].offsetTop);
            return Math.max(0, Math.round(e - 1 + oa * (g % c / c)))
        } function K(b, c) {
            var g = F("selectHelper"); La.build(); if (g) {
                var d = y(b, E.visStart) * Ca + Ja; if (0 <= d && d < na) {
                    var d = La.rect(0, d, 0, d, sa), f = D(b, b), q = D(b, c); if (q > f) {
                        d.top = f; d.height = q - f; d.left += 2; d.width -= 5; if (a.isFunction(g)) { if (g = g(b, c)) d.position = "absolute", d.zIndex = 8, pa = a(g).css(d).appendTo(sa) } else d.isStart = !0, d.isEnd = !0, pa = a(T({ title: "", start: b, end: c, className: ["fc-select-helper"], editable: !1 }, d)), pa.css("opacity", F("dragOpacity")); pa && (pa.click(e).mousedown(C),
                            sa.append(pa), S(pa, d.width, !0), B(pa, d.height, !0))
                    }
                }
            } else h(b, c)
        } function I() { R(); pa && (pa.remove(), pa = null) } function C(b) { if (1 == b.which && F("selectable")) { V(b); var c; Da.start(function (a, b) { I(); if (a && a.col == b.col && !x(a)) { var g = k(b), d = k(a); c = [g, r(t(g), Ra), d, r(t(d), Ra)].sort(H); K(c[0], c[3]) } else c = null }, b); a(document).one("mouseup", function (a) { Da.stop(); c && (+c[0] == +c[1] && O(c[0], !1, a), W(c[0], c[3], !1, a)) }) } } function O(a, b, c) { v("dayClick", ea[A(a.getDay())], a, b, c) } var E = this; E.renderAgenda = function (c) {
            na =
            c; ta = F("theme") ? "ui" : "fc"; ab = F("weekends") ? 0 : 1; Sa = F("firstDay"); (nb = F("isRTL")) ? (Ca = -1, Ja = na - 1) : (Ca = 1, Ja = 0); Na = w(F("minTime")); bb = w(F("maxTime")); ob = F("columnFormat"); cb = F("weekNumbers"); db = F("weekNumberTitle"); Va = "iso" != F("weekNumberCalculation") ? "w" : "W"; Ra = F("snapMinutes") || F("slotMinutes"); if (P) Q(); else {
                c = ta + "-widget-header"; var g = ta + "-widget-content", d, f, q, h, k, l = 0 == F("slotMinutes") % 15; d = "\x3ctable style\x3d'width:100%' class\x3d'fc-agenda-days fc-border-separate' cellspacing\x3d'0'\x3e\x3cthead\x3e\x3ctr\x3e";
                d = cb ? d + ("\x3cth class\x3d'fc-agenda-axis fc-week-number " + c + "'/\x3e") : d + ("\x3cth class\x3d'fc-agenda-axis " + c + "'\x3e\x26nbsp;\x3c/th\x3e"); for (f = 0; f < na; f++)d += "\x3cth class\x3d'fc- fc-col" + f + " " + c + "'/\x3e"; d += "\x3cth class\x3d'fc-agenda-gutter " + c + "'\x3e\x26nbsp;\x3c/th\x3e\x3c/tr\x3e\x3c/thead\x3e\x3ctbody\x3e\x3ctr\x3e\x3cth class\x3d'fc-agenda-axis " + c + "'\x3e\x26nbsp;\x3c/th\x3e"; for (f = 0; f < na; f++)d += "\x3ctd class\x3d'fc- fc-col" + f + " " + g + "'\x3e\x3cdiv\x3e\x3cdiv class\x3d'fc-day-content'\x3e\x3cdiv style\x3d'position:relative'\x3e\x26nbsp;\x3c/div\x3e\x3c/div\x3e\x3c/div\x3e\x3c/td\x3e";
                P = a(d + ("\x3ctd class\x3d'fc-agenda-gutter " + g + "'\x3e\x26nbsp;\x3c/td\x3e\x3c/tr\x3e\x3c/tbody\x3e\x3c/table\x3e")).appendTo(b); L = P.find("thead"); M = L.find("th").slice(1, -1); da = P.find("tbody"); ea = da.find("td").slice(0, -1); ha = ea.find("div.fc-day-content div"); ra = ea.eq(0); ya = ra.find("\x3e div"); ca(L.add(L.find("tr"))); ca(da.add(da.find("tr"))); wa = L.find("th:first"); Ba = P.find(".fc-agenda-gutter"); Ha = a("\x3cdiv style\x3d'position:absolute;z-index:2;left:0;width:100%'/\x3e").appendTo(b); F("allDaySlot") ?
                    (Ya = a("\x3cdiv style\x3d'position:absolute;z-index:8;top:0;left:0'/\x3e").appendTo(Ha), d = "\x3ctable style\x3d'width:100%' class\x3d'fc-agenda-allday' cellspacing\x3d'0'\x3e\x3ctr\x3e\x3cth class\x3d'" + c + " fc-agenda-axis'\x3e" + F("allDayText") + "\x3c/th\x3e\x3ctd\x3e\x3cdiv class\x3d'fc-day-content'\x3e\x3cdiv style\x3d'position:relative'/\x3e\x3c/div\x3e\x3c/td\x3e\x3cth class\x3d'" + c + " fc-agenda-gutter'\x3e\x26nbsp;\x3c/th\x3e\x3c/tr\x3e\x3c/table\x3e", Ua = a(d).appendTo(Ha), Za = Ua.find("tr"), Za.find("td").click(e).mousedown(U),
                        wa = wa.add(Ua.find("th:first")), Ba = Ba.add(Ua.find("th.fc-agenda-gutter")), Ha.append("\x3cdiv class\x3d'fc-agenda-divider " + c + "'\x3e\x3cdiv class\x3d'fc-agenda-divider-inner'/\x3e\x3c/div\x3e")) : Ya = a([]); ga = a("\x3cdiv style\x3d'position:absolute;width:100%;overflow-x:hidden;overflow-y:auto'/\x3e").appendTo(Ha); sa = a("\x3cdiv style\x3d'position:relative;width:100%;overflow:hidden'/\x3e").appendTo(ga); qa = a("\x3cdiv style\x3d'position:absolute;z-index:8;top:0;left:0'/\x3e").appendTo(sa); d = "\x3ctable class\x3d'fc-agenda-slots' style\x3d'width:100%' cellspacing\x3d'0'\x3e\x3ctbody\x3e";
                q = s(); h = r(t(q), bb); r(q, Na); for (f = mb = 0; q < h; f++)k = q.getMinutes(), d += "\x3ctr class\x3d'fc-slot" + f + " " + (k ? "fc-minor" : "") + "'\x3e\x3cth class\x3d'fc-agenda-axis " + c + "'\x3e" + (l && k ? "\x26nbsp;" : J(q, F("axisFormat"))) + "\x3c/th\x3e\x3ctd class\x3d'" + g + "'\x3e\x3cdiv style\x3d'position:relative'\x3e\x26nbsp;\x3c/div\x3e\x3c/td\x3e\x3c/tr\x3e", r(q, F("slotMinutes")), mb++; d += "\x3c/tbody\x3e\x3c/table\x3e"; ka = a(d).appendTo(sa); la = ka.find("div:first"); ka.find("td").click(e).mousedown(C); wa = wa.add(ka.find("th:first"))
            } c =
                z(new Date); cb && (g = J(u(0), Va), g = nb ? g + db : db + g, L.find(".fc-week-number").text(g)); for (g = 0; g < na; g++)q = u(g), d = M.eq(g), d.html(J(q, ob)), f = ea.eq(g), +q == +c ? f.addClass(ta + "-state-highlight fc-today") : f.removeClass(ta + "-state-highlight fc-today"), G(d.add(f), q)
        }; E.setWidth = function (b) {
            $a = b; za.clear(); Ka = 0; S(wa.width("").each(function (b, c) { Ka = Math.max(Ka, a(c).outerWidth()) }), Ka); b = ga[0].clientWidth; (lb = ga.width() - b) ? (S(Ba, lb), Ba.show().prev().removeClass("fc-last")) : Ba.hide().prev().addClass("fc-last"); Oa = Math.floor((b -
                Ka) / na); S(M.slice(0, -1), Oa)
        }; E.setHeight = function (a, b) { a === l && (a = ja); ja = a; Pa = {}; var c = da.position().top, g = ga.position().top, e = Math.min(a - c, ka.height() + g + 1); ya.height(e - Y(ra)); Ha.css("top", c); ga.height(e - g - 1); oa = la.height() + 1; va = F("slotMinutes") / Ra; xa = oa / va; b && d() }; E.beforeHide = function () { Ia = ga.scrollTop() }; E.afterShow = function () { ga.scrollTop(Ia) }; E.defaultEventEnd = function (a) { var b = t(a.start); return a.allDay ? b : r(b, F("defaultEventMinutes")) }; E.timePosition = D; E.dayOfWeekCol = A; E.dateCell = function (a) {
            return {
                row: Math.floor(y(a,
                    E.visStart) / 7), col: A(a.getDay())
            }
        }; E.cellDate = k; E.cellIsAllDay = x; E.allDayRow = function (a) { return Za }; E.allDayBounds = function () { return { left: Ka, right: $a - lb } }; E.getHoverListener = function () { return Da }; E.colContentLeft = function (a) { return za.left(a) }; E.colContentRight = function (a) { return za.right(a) }; E.getDaySegmentContainer = function () { return Ya }; E.getSlotSegmentContainer = function () { return qa }; E.getMinMinute = function () { return Na }; E.getMaxMinute = function () { return bb }; E.getBodyContent = function () { return sa };
        E.getRowCnt = function () { return 1 }; E.getColCnt = function () { return na }; E.getColWidth = function () { return Oa }; E.getSnapHeight = function () { return xa }; E.getSnapMinutes = function () { return Ra }; E.defaultSelectionEnd = function (a, b) { return b ? t(a) : r(t(a), F("slotMinutes")) }; E.renderDayOverlay = f; E.renderSelection = function (a, b, c) { c ? F("allDaySlot") && f(a, m(t(b), 1), !0) : K(a, b) }; E.clearSelection = I; E.reportDayClick = O; E.dragStart = function (a, b, c) {
            Da.start(function (a) {
                R(); if (a) if (x(a)) q(a.row, a.col, a.row, a.col); else {
                    a = k(a); var b =
                        r(t(a), F("defaultEventMinutes")); h(a, b)
                }
            }, b)
        }; E.dragStop = function (a, b, c) { var g = Da.stop(); R(); g && v("drop", a, k(g), x(g), b, c) }; Z.call(E, b, c, g); aa.call(E); ia.call(E); X.call(E); var F = E.opt, v = E.trigger, Q = E.clearEvents, N = E.renderOverlay, R = E.clearOverlays, W = E.reportSelection, V = E.unselect, U = E.daySelectionMousedown, T = E.slotSegHtml, J = c.formatDate, P, L, M, da, ea, ha, ra, ya, Ha, Ya, Ua, Za, ga, sa, qa, ka, la, wa, Ba, pa, $a, ja, Ka, Oa, lb, oa, Ra, va, xa, na, mb, La, Da, za, Pa = {}, Ia, ta, Sa, ab, nb, Ca, Ja, Na, bb, ob, cb, db, Va; ba(b.addClass("fc-agenda"));
        La = new ua(function (b, c) { var g, d, e; M.each(function (b, f) { g = a(f); d = g.offset().left; b && (e[1] = d); e = [d]; c[b] = e }); e[1] = d + g.outerWidth(); F("allDaySlot") && (g = Za, d = g.offset().top, b[0] = [d, d + g.outerHeight()]); for (var f = sa.offset().top, q = ga.offset().top, h = q + ga.outerHeight(), k = 0; k < mb * va; k++)b.push([Math.max(q, Math.min(h, f + xa * k)), Math.max(q, Math.min(h, f + xa * (k + 1)))]) }); Da = new Ma(La); za = new n(function (a) { return ha.eq(a) })
    } function X() {
        function b(c) {
            c = O(E(c, a.map(c, A), h.visStart, h.visEnd)); var g, d = c.length, e, f, q, k =
                []; for (g = 0; g < d; g++)for (e = c[g], f = 0; f < e.length; f++)q = e[f], q.row = 0, q.level = g, k.push(q); return k
        } function c(a) { return a.end ? t(a.end) : r(t(a.start), k("defaultEventMinutes")) } function g(a, b) {
            var c = "\x3c", d = a.url, e = M(a, k), f = ["fc-event", "fc-event-vert"]; w(a) && f.push("fc-event-draggable"); b.isStart && f.push("fc-event-start"); b.isEnd && f.push("fc-event-end"); f = f.concat(a.className); a.source && (f = f.concat(a.source.className || [])); c = d ? c + ("a href\x3d'" + L(a.url) + "'") : c + "div"; c += " class\x3d'" + f.join(" ") + "' style\x3d'position:absolute;z-index:8;top:" +
                b.top + "px;left:" + b.left + "px;" + e + "'\x3e\x3cdiv class\x3d'fc-event-inner'\x3e\x3cdiv class\x3d'fc-event-time'\x3e" + L(ca(a.start, a.end, k("timeFormat"))) + "\x3c/div\x3e\x3cdiv class\x3d'fc-event-title'\x3e" + L(a.title) + "\x3c/div\x3e\x3c/div\x3e\x3cdiv class\x3d'fc-event-bg'\x3e\x3c/div\x3e"; b.isEnd && n(a) && (c += "\x3cdiv class\x3d'ui-resizable-handle ui-resizable-s'\x3e\x3d\x3c/div\x3e"); return c + ("\x3c/" + (d ? "a" : "div") + "\x3e")
        } function d(a, b, c) {
            var g = b.find("div.fc-event-time"); w(a) && f(a, b, g); c.isEnd && n(a) &&
                q(a, b, g); F(a, b)
        } function e(a, b, c) {
            function g() { q || (b.width(d).height("").draggable("option", "grid", null), q = !0) } var d, f, q = !0, h, l = k("isRTL") ? -1 : 1, w = Q(), n = T(), x = J(), D = P(), K = N(); b.draggable({
                zIndex: 9, opacity: k("dragOpacity", "month"), revertDuration: k("dragRevertDuration"), start: function (e, K) {
                    u("eventDragStart", b, a, e, K); ea(a, b); d = b.width(); w.start(function (d, e, u, w) {
                        ua(); d ? (f = !1, h = w * l, d.row ? c ? q && (b.width(n - 10), B(b, x * Math.round((a.end ? (a.end - a.start) / ra : k("defaultEventMinutes")) / D)), b.draggable("option",
                            "grid", [n, 1]), q = !1) : f = !0 : (Z(m(t(a.start), h), m(A(a), h)), g()), f = f || q && !h) : (g(), f = !0); b.draggable("option", "revert", f)
                    }, e, "drag")
                }, stop: function (c, d) { w.stop(); ua(); u("eventDragStop", b, a, c, d); if (f) g(), b.css("filter", ""), ia(a, b); else { var e = 0; q || (e = Math.round((b.offset().top - aa().offset().top) / x) * D + K - (60 * a.start.getHours() + a.start.getMinutes())); ba(this, a, h, e, q, c, d) } }
            })
        } function f(a, b, c) {
            function g(b) { var d = r(t(a.start), b), e; a.end && (e = r(t(a.end), b)); c.text(ca(d, e, k("timeFormat"))) } function d() {
                q && (c.css("display",
                    ""), b.draggable("option", "grid", [B, K]), q = !1)
            } var e, q = !1, h, l, w, n = k("isRTL") ? -1 : 1, x = Q(), D = U(), B = T(), K = J(), E = P(); b.draggable({
                zIndex: 9, scroll: !1, grid: [B, K], axis: 1 == D ? "y" : !1, opacity: k("dragOpacity"), revertDuration: k("dragRevertDuration"), start: function (g, f) {
                    u("eventDragStart", b, a, g, f); ea(a, b); e = b.position(); l = w = 0; x.start(function (g, e, f, l) { b.draggable("option", "revert", !g); ua(); g && (h = l * n, k("allDaySlot") && !g.row ? (q || (q = !0, c.hide(), b.draggable("option", "grid", null)), Z(m(t(a.start), h), m(A(a), h))) : d()) }, g,
                        "drag")
                }, drag: function (a, b) { l = Math.round((b.position.top - e.top) / K) * E; l != w && (q || g(l), w = l) }, stop: function (c, f) { var k = x.stop(); ua(); u("eventDragStop", b, a, c, f); k && (h || l || q) ? ba(this, a, h, q ? 0 : l, q, c, f) : (d(), b.css("filter", ""), b.css(e), g(0), ia(a, b)) }
            })
        } function q(a, b, c) {
            var g, d, e = J(), f = P(); b.resizable({
                handles: { s: ".ui-resizable-handle" }, grid: e, start: function (c, e) { g = d = 0; ea(a, b); b.css("z-index", 9); u("eventResizeStart", this, a, c, e) }, resize: function (q, h) {
                    g = Math.round((Math.max(e, b.height()) - h.originalSize.height) /
                        e); g != d && (c.text(ca(a.start, g || a.end ? r(x(a), f * g) : null, k("timeFormat"))), d = g)
                }, stop: function (c, d) { u("eventResizeStop", this, a, c, d); g ? X(this, a, 0, f * g, c, d) : (b.css("z-index", 8), ia(a, b)) }
            })
        } var h = this; h.renderEvents = function (e, f) {
            D(e); var q, w = e.length, n = [], x = []; for (q = 0; q < w; q++)e[q].allDay ? n.push(e[q]) : x.push(e[q]); k("allDaySlot") && (G(b(n), f), S()); var w = U(), n = N(), A = H(), B = r(t(h.visStart), n), I = a.map(x, c), F, s, Q, W, V, T; q = []; for (F = 0; F < w; F++) {
                Q = s = O(E(x, I, B, r(t(B), A - n))); var J = T = V = W = void 0, P = void 0, aa = void 0; for (W =
                    Q.length - 1; 0 < W; W--)for (J = Q[W], V = 0; V < J.length; V++)for (P = J[V], T = 0; T < Q[W - 1].length; T++)aa = Q[W - 1][T], P.end > aa.start && P.start < aa.end && (aa.forward = Math.max(aa.forward || 0, (P.forward || 0) + 1)); for (Q = 0; Q < s.length; Q++)for (W = s[Q], V = 0; V < W.length; V++)T = W[V], T.col = F, T.level = Q, q.push(T); m(B, 1, !0)
            } var x = q.length, L, M, ia; s = ""; A = {}; B = {}; F = v(); w = U(); (Q = k("isRTL")) ? (W = -1, J = w - 1) : (W = 1, J = 0); for (w = 0; w < x; w++)n = q[w], I = n.event, V = z(n.start, n.start), T = z(n.start, n.end), L = n.col, P = n.level, aa = n.forward || 0, M = y(L * W + J), ia = R(L * W + J) - M, ia =
                Math.min(ia - 6, 0.95 * ia), L = P ? ia / (P + aa + 1) : aa ? 2 * (ia / (aa + 1) - 6) : ia, P = M + ia / (P + aa + 1) * P * W + (Q ? ia - L : 0), n.top = V, n.left = P, n.outerWidth = L, n.outerHeight = T - V, s += g(I, n); F[0].innerHTML = s; Q = F.children(); for (w = 0; w < x; w++)n = q[w], I = n.event, s = a(Q[w]), W = u("eventRender", I, I, s), !1 === W ? s.remove() : (W && !0 !== W && (s.remove(), s = a(W).css({ position: "absolute", top: n.top, left: n.left }).appendTo(F)), n.element = s, I._id === f ? d(I, s, n) : s[0]._fci = w, da(I, s)); C(F, q, d); for (w = 0; w < x; w++)if (n = q[w], s = n.element) F = A[I = n.key = ha(s[0])], n.vsides = F === l ? A[I] =
                    Y(s, !0) : F, F = B[I], n.hsides = F === l ? B[I] = K(s, !0) : F, I = s.find(".fc-event-title"), I.length && (n.contentTop = I[0].offsetTop); for (w = 0; w < x; w++)if (n = q[w], s = n.element) s[0].style.width = Math.max(0, n.outerWidth - n.hsides) + "px", A = Math.max(0, n.outerHeight - n.vsides), s[0].style.height = A + "px", I = n.event, n.contentTop !== l && 10 > A - n.contentTop && (s.find("div.fc-event-time").text(ya(I.start, k("timeFormat")) + " - " + I.title), s.find("div.fc-event-title").remove()), u("eventAfterRender", I, I, s); u("eventAfterAllRender")
        }; h.compileDaySegs =
            b; h.clearEvents = function () { I(); s().empty(); v().empty() }; h.slotSegHtml = g; h.bindDaySeg = function (a, b, c) { w(a) && e(a, b, c.isStart); c.isEnd && n(a) && V(a, b, c); F(a, b) }; W.call(h); var k = h.opt, u = h.trigger, w = h.isEventDraggable, n = h.isEventResizable, x = h.eventEnd, D = h.reportEvents, I = h.reportEventClear, F = h.eventElementHandlers, S = h.setHeight, s = h.getDaySegmentContainer, v = h.getSlotSegmentContainer, Q = h.getHoverListener, H = h.getMaxMinute, N = h.getMinMinute, z = h.timePosition, y = h.colContentLeft, R = h.colContentRight, G = h.renderDaySegs,
                V = h.resizableDayEvent, U = h.getColCnt, T = h.getColWidth, J = h.getSnapHeight, P = h.getSnapMinutes, aa = h.getBodyContent, da = h.reportEventElement, ia = h.showEvents, ea = h.hideEvents, ba = h.eventDrop, X = h.eventResize, Z = h.renderDayOverlay, ua = h.clearOverlays, Ma = h.calendar, ya = Ma.formatDate, ca = Ma.formatDates
    } function Z(a, b, c) {
        function g(a, b) { var d = K[a]; return "object" == typeof d ? N(d, b || c) : d } function d(a, c) { return b.trigger.apply(b, [a, c || n].concat(Array.prototype.slice.call(arguments, 2), [n])) } function e(a) {
            return V(a.editable,
                (a.source || {}).editable, g("editable"))
        } function f(a) { return a.end ? t(a.end) : u(a) } function q(a, b, c) { a = B[a._id]; var g, d = a.length; for (g = 0; g < d; g++)if (!b || a[g][0] != b[0]) a[g][c]() } function h(a, b, c, g) { c = c || 0; for (var d, e = a.length, f = 0; f < e; f++)d = a[f], g !== l && (d.allDay = g), r(m(d.start, b, !0), c), d.end && (d.end = r(m(d.end, b, !0), c)), w(d, K) } function k(a, b, c) { c = c || 0; for (var g, d = a.length, e = 0; e < d; e++)g = a[e], g.end = r(m(f(g), b, !0), c), w(g, K) } var n = this; n.element = a; n.calendar = b; n.name = c; n.opt = g; n.trigger = d; n.isEventDraggable =
            function (a) { return e(a) && !g("disableDragging") }; n.isEventResizable = function (a) { return e(a) && !g("disableResizing") }; n.reportEvents = function (a) { A = {}; var b, c = a.length, g; for (b = 0; b < c; b++)g = a[b], A[g._id] ? A[g._id].push(g) : A[g._id] = [g] }; n.eventEnd = f; n.reportEventElement = function (a, b) { D.push(b); B[a._id] ? B[a._id].push(b) : B[a._id] = [b] }; n.reportEventClear = function () { D = []; B = {} }; n.eventElementHandlers = function (a, b) {
                b.click(function (c) {
                    if (!b.hasClass("ui-draggable-dragging") && !b.hasClass("ui-resizable-resizing")) return d("eventClick",
                        this, a, c)
                }).hover(function (b) { d("eventMouseover", this, a, b) }, function (b) { d("eventMouseout", this, a, b) })
            }; n.showEvents = function (a, b) { q(a, b, "show") }; n.hideEvents = function (a, b) { q(a, b, "hide") }; n.eventDrop = function (a, b, c, g, e, f, q) { var k = b.allDay, l = b._id; h(A[l], c, g, e); d("eventDrop", a, b, c, g, e, function () { h(A[l], -c, -g, k); x(l) }, f, q); x(l) }; n.eventResize = function (a, b, c, g, e, f) { var q = b._id; k(A[q], c, g); d("eventResize", a, b, c, g, function () { k(A[q], -c, -g); x(q) }, e, f); x(q) }; var u = n.defaultEventEnd, w = b.normalizeEvent, x = b.reportEventChange,
                A = {}, D = [], B = {}, K = b.options
    } function W() {
        function b(a) {
            var c = n("isRTL"), g, d = a.length, e, f, q, h; g = S(); var k = g.left, l = g.right, m, u, A, D, B, K = ""; for (g = 0; g < d; g++)e = a[g], f = e.event, h = ["fc-event", "fc-event-hori"], w(f) && h.push("fc-event-draggable"), e.isStart && h.push("fc-event-start"), e.isEnd && h.push("fc-event-end"), c ? (m = H(e.end.getDay() - 1), u = H(e.start.getDay()), A = e.isEnd ? Q(m) : k, D = e.isStart ? v(u) : l) : (m = H(e.start.getDay()), u = H(e.end.getDay() - 1), A = e.isStart ? Q(m) : k, D = e.isEnd ? v(u) : l), h = h.concat(f.className), f.source &&
                (h = h.concat(f.source.className || [])), q = f.url, B = M(f, n), K = q ? K + ("\x3ca href\x3d'" + L(q) + "'") : K + "\x3cdiv", K += " class\x3d'" + h.join(" ") + "' style\x3d'position:absolute;z-index:8;left:" + A + "px;" + B + "'\x3e\x3cdiv class\x3d'fc-event-inner'\x3e", !f.allDay && e.isStart && (K += "\x3cspan class\x3d'fc-event-time'\x3e" + L(y(f.start, f.end, n("timeFormat"))) + "\x3c/span\x3e"), K += "\x3cspan class\x3d'fc-event-title'\x3e" + L(f.title) + "\x3c/span\x3e\x3c/div\x3e", e.isEnd && x(f) && (K += "\x3cdiv class\x3d'ui-resizable-handle ui-resizable-" +
                    (c ? "w" : "e") + "'\x3e\x26nbsp;\x26nbsp;\x26nbsp;\x3c/div\x3e"), K += "\x3c/" + (q ? "a" : "div") + "\x3e", e.left = A, e.outerWidth = D - A, e.startCol = m, e.endCol = u + 1; return K
        } function c(b, g) { var d, e = b.length, f, q, h; for (d = 0; d < e; d++)f = b[d], q = f.event, h = a(g[d]), q = u("eventRender", q, q, h), !1 === q ? h.remove() : (q && !0 !== q && (q = a(q).css({ position: "absolute", left: f.left }), h.replaceWith(q), h = q), f.element = h) } function g(a) {
            var b, c = a.length, d, e, f, q, h = {}; for (b = 0; b < c; b++)if (d = a[b], e = d.element) f = d.key = ha(e[0]), q = h[f], q === l && (q = h[f] = K(e, !0)),
                d.hsides = q
        } function d(a) { var b, c = a.length, g, e; for (b = 0; b < c; b++)if (g = a[b], e = g.element) e[0].style.width = Math.max(0, g.outerWidth - g.hsides) + "px" } function e(a) { var b, c = a.length, g, d, f, q, h = {}; for (b = 0; b < c; b++)if (g = a[b], d = g.element) f = g.key, q = h[f], q === l && (q = h[f] = F(d)), g.outerHeight = d[0].offsetHeight + q } function f() { var a, b = E(), c = []; for (a = 0; a < b; a++)c[a] = s(a).find("div.fc-day-content \x3e div"); return c } function q(a) { var b, c = a.length, g = []; for (b = 0; b < c; b++)g[b] = a[b][0].offsetTop; return g } function h(a, b) {
            var c, g =
                a.length, d, e; for (c = 0; c < g; c++)if (d = a[c], e = d.element) e[0].style.top = b[d.row] + (d.top || 0) + "px", d = d.event, u("eventAfterRender", d, d, e)
        } var k = this; k.renderDaySegs = function (a, k) {
            var l = z(), m = E(), n = O(), u = 0, w, x, A, B = a.length, K, I; l[0].innerHTML = b(a); c(a, l.children()); x = a.length; for (w = 0; w < x; w++)A = a[w], (I = A.element) && D(A.event, I); x = a.length; var r; for (w = 0; w < x; w++)if (A = a[w], I = A.element) r = A.event, r._id === k ? W(r, I, A) : I[0]._fci = w; C(l, a, W); g(a); d(a); e(a); l = f(); for (w = 0; w < m; w++) {
                x = []; for (A = 0; A < n; A++)x[A] = 0; for (; u < B && (K =
                    a[u]).row == w;) { A = x.slice(K.startCol, K.endCol); A = Math.max.apply(Math, A); K.top = A; A += K.outerHeight; for (I = K.startCol; I < K.endCol; I++)x[I] = A; u++ } l[w].height(Math.max.apply(Math, x))
            } h(a, q(l))
        }; k.resizableDayEvent = function (l, w, x) {
            var D = n("isRTL"), K = D ? "w" : "e", C = w.find(".ui-resizable-" + K), F = !1; ba(w); w.mousedown(function (a) { a.preventDefault() }).click(function (a) { F && (a.preventDefault(), a.stopImmediatePropagation()) }); C.mousedown(function (n) {
                function C(b) {
                    u("eventResizeStop", this, l, b); a("body").css("cursor", "");
                    s.stop(); V(); y && r(this, l, y, 0, b); setTimeout(function () { F = !1 }, 0)
                } if (1 == n.which) {
                    F = !0; var s = k.getHoverListener(), S = E(), Q = O(), v = D ? -1 : 1, H = D ? Q - 1 : 0, W = w.css("top"), y, T, U = a.extend({}, l), J = N(l.start); G(); a("body").css("cursor", K + "-resize").one("mouseup", C); u("eventResizeStart", this, l, n); s.start(function (k, n) {
                        if (k) {
                            var w = Math.max(J.row, k.row), u = k.col; 1 == S && (w = 0); w == J.row && (u = D ? Math.min(J.col, u) : Math.max(J.col, u)); y = 7 * w + u * v + H - (7 * n.row + n.col * v + H); w = m(A(l), y, !0); if (y) {
                                U.end = w; var u = T, r = Y([U]), E = x.row, C = a("\x3cdiv/\x3e"),
                                    F = z(), O = r.length, s; C[0].innerHTML = b(r); C = C.children(); F.append(C); c(r, C); g(r); d(r); e(r); h(r, q(f())); C = []; for (F = 0; F < O; F++)if (s = r[F].element) r[F].row === E && s.css("top", W), C.push(s[0]); T = a(C); T.find("*").css("cursor", K + "-resize"); u && u.remove(); I(l)
                            } else T && (B(l), T.remove(), T = null); V(); R(l.start, m(t(w), 1))
                        }
                    }, n)
                }
            })
        }; var n = k.opt, u = k.trigger, w = k.isEventDraggable, x = k.isEventResizable, A = k.eventEnd, D = k.reportEventElement, B = k.showEvents, I = k.hideEvents, r = k.eventResize, E = k.getRowCnt, O = k.getColCnt, s = k.allDayRow,
            S = k.allDayBounds, Q = k.colContentLeft, v = k.colContentRight, H = k.dayOfWeekCol, N = k.dateCell, Y = k.compileDaySegs, z = k.getDaySegmentContainer, W = k.bindDaySeg, y = k.calendar.formatDates, R = k.renderDayOverlay, V = k.clearOverlays, G = k.clearSelection
    } function ia() {
        function b(a) { k && (k = !1, h(), e("unselect", null, a)) } function c(a, b, g, d) { k = !0; e("select", null, a, b, g, d) } var g = this; g.select = function (a, g, d) { b(); g || (g = f(a, d)); q(a, g, d); c(a, g, d) }; g.unselect = b; g.reportSelection = c; g.daySelectionMousedown = function (e) {
            var f = g.cellDate,
            k = g.cellIsAllDay, l = g.getHoverListener(), m = g.reportDayClick; if (1 == e.which && d("selectable")) { b(e); var n; l.start(function (a, b) { h(); a && k(a) ? (n = [f(b), f(a)].sort(H), q(n[0], n[1], !0)) : n = null }, e); a(document).one("mouseup", function (a) { l.stop(); n && (+n[0] == +n[1] && m(n[0], !0, a), c(n[0], n[1], !0, a)) }) }
        }; var d = g.opt, e = g.trigger, f = g.defaultSelectionEnd, q = g.renderSelection, h = g.clearSelection, k = !1; d("selectable") && d("unselectAuto") && a(document).mousedown(function (c) {
            var g = d("unselectCancel"); g && a(c.target).parents(g).length ||
                b(c)
        })
    } function aa() { this.renderOverlay = function (g, d) { var e = c.shift(); e || (e = a("\x3cdiv class\x3d'fc-cell-overlay' style\x3d'position:absolute;z-index:3'/\x3e")); e[0].parentNode != d[0] && e.appendTo(d); b.push(e.css(g).show()); return e }; this.clearOverlays = function () { for (var a; a = b.shift();)c.push(a.hide().unbind()) }; var b = [], c = [] } function ua(a) {
        var b, c; this.build = function () { b = []; c = []; a(b, c) }; this.cell = function (a, g) {
            var d = b.length, e = c.length, f, q = -1, h = -1; for (f = 0; f < d; f++)if (g >= b[f][0] && g < b[f][1]) { q = f; break } for (f =
                0; f < e; f++)if (a >= c[f][0] && a < c[f][1]) { h = f; break } return 0 <= q && 0 <= h ? { row: q, col: h } : null
        }; this.rect = function (a, g, d, e, f) { f = f.offset(); return { top: b[a][0] - f.top, left: c[g][0] - f.left, width: c[e][1] - c[g][0], height: b[d][1] - b[a][0] } }
    } function Ma(b) {
        function c(a) { a.pageX === l && (a.pageX = a.originalEvent.pageX, a.pageY = a.originalEvent.pageY); a = b.cell(a.pageX, a.pageY); if (!a != !f || a && (a.row != f.row || a.col != f.col)) a ? (e || (e = a), d(a, e, a.row - e.row, a.col - e.col)) : d(a, e), f = a } var g, d, e, f; this.start = function (q, h, k) {
            d = q; e = f = null; b.build();
            c(h); g = k || "mousemove"; a(document).bind(g, c)
        }; this.stop = function () { a(document).unbind(g, c); return f }
    } function n(a) { var b = this, c = {}, g = {}, d = {}; b.left = function (b) { return g[b] = g[b] === l ? (c[b] = c[b] || a(b)).position().left : g[b] }; b.right = function (g) { return d[g] = d[g] === l ? b.left(g) + (c[g] = c[g] || a(g)).width() : d[g] }; b.clear = function () { c = {}; g = {}; d = {} } } var va = {
        defaultView: "month", aspectRatio: 1.35, header: { left: "title", center: "", right: "today prev,next" }, weekends: !0, weekNumbers: !1, weekNumberCalculation: "iso", weekNumberTitle: "W",
        allDayDefault: !0, ignoreTimezone: !0, lazyFetching: !0, startParam: "start", endParam: "end", titleFormat: { month: "MMMM 'de' yyyy", week: "d ['de' MMMM] ['de' yyyy]{ ' a ' d 'de' MMMM 'de' yyyy}", day: "dddd, d ' de ' MMMM ' de ' yyyy" }, columnFormat: { month: "ddd", week: "ddd M/d", day: "dddd M/d" }, timeFormat: { "": "HH:mm" }, isRTL: !1, firstDay: 0, monthNames: "Janeiro Fevereiro Mar\x26ccedil;o Abril Maio Junho Julho Agosto Setembro Outubro Novembro Dezembro".split(" "), monthNamesShort: "Jan. Fev. Mar. Abr. Maio Jun. Jul. Ago. Set. Out. Nov. Dez.".split(" "),
        dayNames: "Domingo Segunda-feira Ter\x26ccedil;a-feira Quarta-feira Quinta-feira Sexta-feira Sábado".split(" "), dayNamesShort: "Dom. Seg. Ter. Qua. Qui. Sex. Sáb.".split(" "), buttonText: { prev: "\x26nbsp;\x26#9668;\x26nbsp;", next: "\x26nbsp;\x26#9658;\x26nbsp;", prevYear: "\x26nbsp;\x26lt;\x26lt;\x26nbsp;", nextYear: "\x26nbsp;\x26gt;\x26gt;\x26nbsp;", today: "hoje", month: "m\x26ecirc;s", week: "semana", day: "dia" }, theme: !1, buttonIcons: { prev: "circle-arrowthick-1-e", next: "circle-arrowthick-1-w" }, unselectAuto: !0,
        dropAccept: "*"
    }, oa = { header: { left: "next,prev today", center: "", right: "title" }, buttonText: { prev: "\x3cspan class\x3d'fc-text-arrow'\x3e\x26rsaquo;\x3c/span\x3e", next: "\x3cspan class\x3d'fc-text-arrow'\x3e\x26lsaquo;\x3c/span\x3e", prevYear: "\x3cspan class\x3d'fc-text-arrow'\x3e\x26raquo;\x3c/span\x3e", nextYear: "\x3cspan class\x3d'fc-text-arrow'\x3e\x26laquo;\x3c/span\x3e" }, buttonIcons: { prev: "circle-triangle-e", next: "circle-triangle-w" } }, ja = a.fullCalendar = { version: "1.6.1" }, ea = ja.views = {}; a.fn.fullCalendar =
        function (b) {
            if ("string" == typeof b) { var c = Array.prototype.slice.call(arguments, 1), g; this.each(function () { var d = a.data(this, "fullCalendar"); d && a.isFunction(d[b]) && (d = d[b].apply(d, c), g === l && (g = d), "destroy" == b && a.removeData(this, "fullCalendar")) }); return g !== l ? g : this } var d = b.eventSources || []; delete b.eventSources; b.events && (d.push(b.events), delete b.events); b = a.extend(!0, {}, va, b.isRTL || b.isRTL === l && va.isRTL ? oa : {}, b); this.each(function (c, g) { var e = a(g), f = new h(e, b, d); e.data("fullCalendar", f); f.render() });
            return this
        }; ja.sourceNormalizers = []; ja.sourceFetchers = []; var ya = { dataType: "json", cache: !1 }, Oa = 1; ja.addDays = m; ja.cloneDate = t; ja.parseDate = u; ja.parseISO8601 = q; ja.parseTime = w; ja.formatDate = x; ja.formatDates = D; var za = "sun mon tue wed thu fri sat".split(" "), Sa = 864E5, Da = 36E5, ra = 6E4, Pa = {
            s: function (a) { return a.getSeconds() }, ss: function (a) { return R(a.getSeconds()) }, m: function (a) { return a.getMinutes() }, mm: function (a) { return R(a.getMinutes()) }, h: function (a) { return a.getHours() % 12 || 12 }, hh: function (a) {
                return R(a.getHours() %
                    12 || 12)
            }, H: function (a) { return a.getHours() }, HH: function (a) { return R(a.getHours()) }, d: function (a) { return a.getDate() }, dd: function (a) { return R(a.getDate()) }, ddd: function (a, b) { return b.dayNamesShort[a.getDay()] }, dddd: function (a, b) { return b.dayNames[a.getDay()] }, M: function (a) { return a.getMonth() + 1 }, MM: function (a) { return R(a.getMonth() + 1) }, MMM: function (a, b) { return b.monthNamesShort[a.getMonth()] }, MMMM: function (a, b) { return b.monthNames[a.getMonth()] }, yy: function (a) { return (a.getFullYear() + "").substring(2) },
            yyyy: function (a) { return a.getFullYear() }, t: function (a) { return 12 > a.getHours() ? "a" : "p" }, tt: function (a) { return 12 > a.getHours() ? "am" : "pm" }, T: function (a) { return 12 > a.getHours() ? "A" : "P" }, TT: function (a) { return 12 > a.getHours() ? "AM" : "PM" }, u: function (a) { return x(a, "yyyy-MM-dd'T'HH:mm:ss'Z'") }, S: function (a) { a = a.getDate(); return 10 < a && 20 > a ? "th" : ["st", "nd", "rd"][a % 10 - 1] || "th" }, w: function (a, b) { return b.weekNumberCalculation(a) }, W: function (a) {
                var b = new Date(a.getTime()); b.setDate(b.getDate() + 4 - (b.getDay() || 7));
                a = b.getTime(); b.setMonth(0); b.setDate(1); return Math.floor(Math.round((a - b) / 864E5) / 7) + 1
            }
        }; ja.dateFormatters = Pa; ja.applyAll = Q; ea.month = function (a, b) {
            var c = this; c.render = function (a, b) {
                b && (f(a, b), a.setDate(1)); var q = t(a, !0); q.setDate(1); var h = f(t(q), 1), k = t(q), l = t(h), n = g("firstDay"), w = g("weekends") ? 0 : 1; w && (v(k), v(l, -1, !0)); m(k, -((k.getDay() - Math.max(n, w) + 7) % 7)); m(l, (7 - l.getDay() + Math.max(n, w)) % 7); n = Math.round((l - k) / (7 * Sa)); "fixed" == g("weekMode") && (m(l, 7 * (6 - n)), n = 6); c.title = e(q, g("titleFormat")); c.start =
                    q; c.end = h; c.visStart = k; c.visEnd = l; d(n, w ? 5 : 7, !0)
            }; da.call(c, a, b, "month"); var g = c.opt, d = c.renderBasic, e = b.formatDate
        }; ea.basicWeek = function (a, b) { var c = this; c.render = function (a, b) { b && m(a, 7 * b); var f = m(t(a), -((a.getDay() - g("firstDay") + 7) % 7)), q = m(t(f), 7), h = t(f), k = t(q), l = g("weekends"); l || (v(h), v(k, -1, !0)); c.title = e(h, m(t(k), -1), g("titleFormat")); c.start = f; c.end = q; c.visStart = h; c.visEnd = k; d(1, l ? 7 : 5, !1) }; da.call(c, a, b, "basicWeek"); var g = c.opt, d = c.renderBasic, e = b.formatDates }; ea.basicDay = function (a, b) {
            var c =
                this; c.render = function (a, b) { b && (m(a, b), g("weekends") || v(a, 0 > b ? -1 : 1)); c.title = e(a, g("titleFormat")); c.start = c.visStart = t(a, !0); c.end = c.visEnd = m(t(c.start), 1); d(1, 1, !1) }; da.call(c, a, b, "basicDay"); var g = c.opt, d = c.renderBasic, e = b.formatDate
        }; e({ weekMode: "fixed" }); ea.agendaWeek = function (a, b) {
            var c = this; c.render = function (a, b) {
                b && m(a, 7 * b); var f = m(t(a), -((a.getDay() - g("firstDay") + 7) % 7)), q = m(t(f), 7), h = t(f), k = t(q), l = g("weekends"); l || (v(h), v(k, -1, !0)); c.title = e(h, m(t(k), -1), g("titleFormat")); c.start = f; c.end =
                    q; c.visStart = h; c.visEnd = k; d(l ? 7 : 5)
            }; P.call(c, a, b, "agendaWeek"); var g = c.opt, d = c.renderAgenda, e = b.formatDates
        }; ea.agendaDay = function (a, b) { var c = this; c.render = function (a, b) { b && (m(a, b), g("weekends") || v(a, 0 > b ? -1 : 1)); var f = t(a, !0), q = m(t(f), 1); c.title = e(a, g("titleFormat")); c.start = c.visStart = f; c.end = c.visEnd = q; d(1) }; P.call(c, a, b, "agendaDay"); var g = c.opt, d = c.renderAgenda, e = b.formatDate }; e({
            allDaySlot: !0, allDayText: "Dia todo", firstHour: 6, slotMinutes: 30, defaultEventMinutes: 120, axisFormat: "HH:mm", timeFormat: { agenda: "h:mm{ - h:mm}" },
            dragOpacity: { agenda: 0.5 }, minTime: 0, maxTime: 24
        })
})(jQuery);
(function (a) {
    a.widget("ui.superMenu", {
        options: { overDelay: 350, outDelay: 100 }, _create: function () {
            var l = this; l.element.addClass("ui-widget ui-widget-header ui-corner-all ui-state-default"); var e = l.element.children("ul"); e.find("ul").addClass("ui-widget ui-widget-content ui-corner-all").end().find("li").hover(function () { a(this).addClass("ui-state-hover ui-corner-all") }, function () { a(this).removeClass("ui-state-hover ui-corner-all") }).end().find("a").click(function () {
                var e = a(this).parent(), c = a(this); -1 ==
                    c.attr("href").indexOf("javascript") ? e.has("ul").length || (e.addClass("ui-state-disabled"), c.addClass("ui-super-menu-loading")) : eval(c.attr("href"))
            }); e.find("ul").parent().each(function (e) {
                e = a(this); var c = a(this).find("ul:eq(0)"); this._dimensions = { width: this.offsetWidth, height: this.offsetHeight, subUlWidth: c.outerWidth(), subUlHeight: c.outerHeight() }; var d = 1 == e.parents("ul").length ? !0 : !1; c.css({ top: d ? this._dimensions.height + "px" : -1 }); e.children("a:eq(0)").css(d ? { paddingRight: 25 } : {}).append('\x3cspan class\x3d"' +
                    (d ? "ui-icon ui-icon-triangle-1-s ui-super-menu-down-arrow" : "ui-icon ui-icon-triangle-1-e ui-super-menu-right-arrow") + '" /\x3e'); e.hover(function (b) { b = a(this).children("ul:eq(0)"); this._offsets = { left: a(this).offset().left, top: a(this).offset().top }; var c = d ? 0 : this._dimensions.width, c = this._offsets.left + c + this._dimensions.subUlWidth > a(window).width() ? d ? -this._dimensions.subUlWidth + this._dimensions.width : -this._dimensions.width : c; b.css({ left: c + 1 + "px" }).fadeIn(l.options.overDelay) }, function (b) { a(this).children("ul:eq(0)").fadeOut(l.options.outDelay) })
            });
            e.find("ul").css({ display: "none", visibility: "visible" })
        }
    })
})(jQuery);
(function (a) { "function" === typeof define && define.amd ? define(["jquery"], a) : a(jQuery) })(function (a) {
    function l() { l.history = l.history || []; l.history.push(arguments); if ("object" === typeof console) { var a = console[console.warn ? "warn" : "log"], b = Array.prototype.slice.call(arguments); "string" === typeof arguments[0] && (b[0] = "qTip2: " + b[0]); a.apply ? a.apply(console, b) : a(b) } } function e(b) {
        var c; if (!b || "object" !== typeof b) return z; if (b.metadata === t || "object" !== typeof b.metadata) b.metadata = { type: b.metadata }; if ("content" in
            b) { if (b.content === t || "object" !== typeof b.content || b.content.jquery) b.content = { text: b.content }; c = b.content.text || z; !a.isFunction(c) && (!c && !c.attr || 1 > c.length || "object" === typeof c && !c.jquery) && (b.content.text = z); if ("title" in b.content) { if (b.content.title === t || "object" !== typeof b.content.title) b.content.title = { text: b.content.title }; c = b.content.title.text || z; !a.isFunction(c) && (!c && !c.attr || 1 > c.length || "object" === typeof c && !c.jquery) && (b.content.title.text = z) } } "position" in b && (b.position === t || "object" !==
                typeof b.position) && (b.position = { my: b.position, at: b.position }); "show" in b && (b.show === t || "object" !== typeof b.show) && (b.show = b.show.jquery ? { target: b.show } : { event: b.show }); "hide" in b && (b.hide === t || "object" !== typeof b.hide) && (b.hide = b.hide.jquery ? { target: b.hide } : { event: b.hide }); "style" in b && (b.style === t || "object" !== typeof b.style) && (b.style = { classes: b.style }); a.each(y, function () { this.sanitize && this.sanitize(b) }); return b
    } function h(b, c, d, f) {
        function h(a) {
            var b = 0, g, d = c; for (a = a.split("."); d = d[a[b++]];)b <
                a.length && (g = d); return [g || c, a.pop()]
        } function k() { var a = c.style.widget; J.toggleClass(w, a).toggleClass(A, c.style.def && !a); X.content.toggleClass(w + "-content", a); X.titlebar && X.titlebar.toggleClass(w + "-header", a); X.button && X.button.toggleClass(q + "-icon", !a) } function l(a) { X.title && (X.titlebar.remove(), X.titlebar = X.title = X.button = t, a !== z && G.reposition()) } function m() {
            var b = c.content.title.button, g = "string" === typeof b ? b : "Close tooltip"; X.button && X.button.remove(); X.button = b.jquery ? b : a("\x3ca /\x3e", {
                "class": "ui-state-default ui-tooltip-close " +
                    (c.style.widget ? "" : q + "-icon"), title: g, "aria-label": g
            }).prepend(a("\x3cspan /\x3e", { "class": "ui-icon ui-icon-close", html: "\x26times;" })); X.button.appendTo(X.titlebar).attr("role", "button").click(function (a) { J.hasClass(x) || G.hide(a); return z }); G.redraw()
        } function N() {
            var b = Q + "-title"; X.titlebar && l(); X.titlebar = a("\x3cdiv /\x3e", { "class": q + "-titlebar " + (c.style.widget ? "ui-widget-header" : "") }).append(X.title = a("\x3cdiv /\x3e", { id: b, "class": q + "-title", "aria-atomic": r })).insertBefore(X.content).delegate(".ui-tooltip-close",
                "mousedown keydown mouseup keyup mouseout", function (b) { a(this).toggleClass("ui-state-active ui-state-focus", "down" === b.type.substr(-4)) }).delegate(".ui-tooltip-close", "mouseover mouseout", function (b) { a(this).toggleClass("ui-state-hover", "mouseover" === b.type) }); c.content.title.button ? m() : G.rendered && G.redraw()
        } function L(c, g) {
            var d = X.title; if (!G.rendered || !c) return z; a.isFunction(c) && (c = c.call(b, Z.event, G)); if (c === z || !c && "" !== c) return l(z); c.jquery && 0 < c.length ? d.empty().append(c.css({ display: "block" })) :
                d.html(c); G.redraw(); g !== z && G.rendered && 0 < J[0].offsetWidth && G.reposition(Z.event)
        } function ha(c, g) {
            function d(b) {
                function c(d) { d && (delete q[d.src], clearTimeout(G.timers.img[d.src]), a(d).unbind(P)); a.isEmptyObject(q) && (G.redraw(), g !== z && G.reposition(Z.event), b()) } var f, q = {}; if (0 === (f = e.find("img[src]:not([height]):not([width])")).length) return c(); f.each(function (b, g) {
                    if (q[g.src] === s) {
                        var d = 0; (function za() { if (g.height || g.width || 3 < d) return c(g); d += 1; G.timers.img[g.src] = setTimeout(za, 700) })(); a(g).bind("error" +
                            P + " load" + P, function () { c(this) }); q[g.src] = g
                    }
                })
            } var e = X.content; if (!G.rendered || !c) return z; a.isFunction(c) && (c = c.call(b, Z.event, G) || ""); c.jquery && 0 < c.length ? e.empty().append(c.css({ display: "block" })) : e.html(c); 0 > G.rendered ? J.queue("fx", d) : (da = 0, d(a.noop)); return G
        } function ba() {
            function e(a) { if (J.hasClass(x)) return z; clearTimeout(G.timers.show); clearTimeout(G.timers.hide); var b = function () { G.toggle(r, a) }; 0 < c.show.delay ? G.timers.show = setTimeout(b, c.show.delay) : b() } function f(b) {
                if (J.hasClass(x) || V ||
                    da) return z; var g = a(b.relatedTarget || b.target), d = g.closest(D)[0] === J[0], g = g[0] === l.show[0]; clearTimeout(G.timers.show); clearTimeout(G.timers.hide); if ("mouse" === k.target && d || c.hide.fixed && /mouse(out|leave|move)/.test(b.type) && (d || g)) try { b.preventDefault(), b.stopImmediatePropagation() } catch (e) { } else 0 < c.hide.delay ? G.timers.hide = setTimeout(function () { G.hide(b) }, c.hide.delay) : G.hide(b)
            } function q(a) {
                if (J.hasClass(x)) return z; clearTimeout(G.timers.inactive); G.timers.inactive = setTimeout(function () { G.hide(a) },
                    c.hide.inactive)
            } function h(a) { G.rendered && 0 < J[0].offsetWidth && G.reposition(a) } var k = c.position, l = { show: c.show.target, hide: c.hide.target, viewport: a(k.viewport), document: a(document), body: a(document.body), window: a(window) }, m = a.trim("" + c.show.event).split(" "), w = a.trim("" + c.hide.event).split(" "), u = a.browser.msie && 6 === parseInt(a.browser.version, 10); J.bind("mouseenter" + P + " mouseleave" + P, function (a) { var b = "mouseenter" === a.type; b && G.focus(a); J.toggleClass(E, b) }); c.hide.fixed && (l.hide = l.hide.add(J), J.bind("mouseover" +
                P, function () { J.hasClass(x) || clearTimeout(G.timers.hide) })); /mouse(out|leave)/i.test(c.hide.event) ? "window" === c.hide.leave && l.window.bind("mouseout" + P + " blur" + P, function (a) { /select|option/.test(a.target) && !a.relatedTarget && G.hide(a) }) : /mouse(over|enter)/i.test(c.show.event) && l.hide.bind("mouseleave" + P, function (a) { clearTimeout(G.timers.show) }); -1 < ("" + c.hide.event).indexOf("unfocus") && k.container.closest("html").bind("mousedown" + P, function (c) {
                    var g = a(c.target); G.rendered && J.hasClass(x); var d = 0 < g.parents(D).filter(J[0]).length;
                    g[0] === b[0] || g[0] === J[0] || d || b.has(g[0]).length || g.attr("disabled") || G.hide(c)
                }); "number" === typeof c.hide.inactive && (l.show.bind("qtip-" + d + "-inactive", q), a.each(v.inactiveEvents, function (a, b) { l.hide.add(X.tooltip).bind(b + P + "-inactive", q) })); a.each(w, function (b, c) { var g = a.inArray(c, m), d = a(l.hide); -1 < g && d.add(l.show).length === d.length || "unfocus" === c ? (l.show.bind(c + P, function (a) { 0 < J[0].offsetWidth ? f(a) : e(a) }), delete m[g]) : l.hide.bind(c + P, f) }); a.each(m, function (a, b) { l.show.bind(b + P, e) }); "number" === typeof c.hide.distance &&
                    l.show.add(J).bind("mousemove" + P, function (a) { var b = Z.origin || {}, g = c.hide.distance, d = Math.abs; (d(a.pageX - b.pageX) >= g || d(a.pageY - b.pageY) >= g) && G.hide(a) }); "mouse" === k.target && (l.show.bind("mousemove" + P, function (a) { g = { pageX: a.pageX, pageY: a.pageY, type: "mousemove" } }), k.adjust.mouse && (c.hide.event && (J.bind("mouseleave" + P, function (a) { (a.relatedTarget || a.target) !== l.show[0] && G.hide(a) }), X.target.bind("mouseenter" + P + " mouseleave" + P, function (a) { Z.onTarget = "mouseenter" === a.type })), l.document.bind("mousemove" +
                        P, function (a) { G.rendered && Z.onTarget && !J.hasClass(x) && 0 < J[0].offsetWidth && G.reposition(a || g) }))); (k.adjust.resize || l.viewport.length) && (a.event.special.resize ? l.viewport : l.window).bind("resize" + P, h); (l.viewport.length || u && "fixed" === J.css("position")) && l.viewport.bind("scroll" + P, h)
        } function ca() {
            var b = [c.show.target[0], c.hide.target[0], G.rendered && X.tooltip[0], c.position.container[0], c.position.viewport[0], window, document]; G.rendered ? a([]).pushStack(a.grep(b, function (a) { return "object" === typeof a })).unbind(P) :
                c.show.target.unbind(P + "-create")
        } var G = this, M = document.body, Q = q + "-" + d, V = 0, da = 0, J = a(), P = ".qtip-" + d, X, Z; G.id = d; G.rendered = z; G.elements = X = { target: b }; G.timers = { img: {} }; G.options = c; G.checks = {}; G.plugins = {}; G.cache = Z = { event: {}, target: a(), disabled: z, attr: f, onTarget: z }; G.checks.builtin = {
            "^id$": function (b, c, g) { b = g === r ? v.nextid : g; c = q + "-" + b; b !== z && 0 < b.length && !a("#" + c).length && (J[0].id = c, X.content[0].id = c + "-content", X.title[0].id = c + "-title") }, "^content.text$": function (a, b, c) { ha(c) }, "^content.title.text$": function (a,
                b, c) { if (!c) return l(); !X.title && c && N(); L(c) }, "^content.title.button$": function (a, b, c) { a = X.button; b = X.title; G.rendered && (c ? (b || N(), m()) : a.remove()) }, "^position.(my|at)$": function (a, b, c) { "string" === typeof c && (a[b] = new y.Corner(c)) }, "^position.container$": function (a, b, c) { G.rendered && J.appendTo(c) }, "^show.ready$": function () { G.rendered ? G.toggle(r) : G.render(1) }, "^style.classes$": function (a, b, c) { J.attr("class", q + " qtip ui-helper-reset " + c) }, "^style.widget|content.title": k, "^events.(render|show|move|hide|focus|blur)$": function (b,
                    c, g) { J[(a.isFunction(g) ? "" : "un") + "bind"]("tooltip" + c, g) }, "^(show|hide|position).(event|target|fixed|inactive|leave|distance|viewport|adjust)": function () { var a = c.position; J.attr("tracking", "mouse" === a.target && a.adjust.mouse); ca(); ba() }
        }; a.extend(G, {
            render: function (g) {
                if (G.rendered) return G; var d = c.content.text, e = c.content.title.text, f = c.position, h = a.Event("tooltiprender"); a.attr(b[0], "aria-describedby", Q); J = X.tooltip = a("\x3cdiv/\x3e", {
                    id: Q, "class": q + " qtip ui-helper-reset " + A + " " + c.style.classes + " " +
                        q + "-pos-" + c.position.my.abbrev(), width: c.style.width || "", height: c.style.height || "", tracking: "mouse" === f.target && f.adjust.mouse, role: "alert", "aria-live": "polite", "aria-atomic": z, "aria-describedby": Q + "-content", "aria-hidden": r
                }).toggleClass(x, Z.disabled).data("qtip", G).appendTo(c.position.container).append(X.content = a("\x3cdiv /\x3e", { "class": q + "-content", id: Q + "-content", "aria-atomic": r })); G.rendered = -1; V = da = 1; e && (N(), a.isFunction(e) || L(e, z)); a.isFunction(d) || ha(d, z); G.rendered = r; k(); a.each(c.events,
                    function (b, c) { a.isFunction(c) && J.bind("toggle" === b ? "tooltipshow tooltiphide" : "tooltip" + b, c) }); a.each(y, function () { "render" === this.initialize && this(G) }); ba(); J.queue("fx", function (a) { h.originalEvent = Z.event; J.trigger(h, [G]); V = da = 0; G.redraw(); (c.show.ready || g) && G.toggle(r, Z.event, z); a() }); return G
            }, get: function (a) {
                switch (a.toLowerCase()) {
                    case "dimensions": a = { height: J.outerHeight(), width: J.outerWidth() }; break; case "offset": a = y.offset(J, c.position.container); break; default: a = h(a.toLowerCase()), a = a[0][a[1]],
                        a = a.precedance ? a.string() : a
                }return a
            }, set: function (b, g) {
                var d = /^position\.(my|at|adjust|target|container)|style|content|show\.ready/i, f = /^content\.(title|attr)|style/i, q = z, k = z, l = G.checks, m; "string" === typeof b ? (m = b, b = {}, b[m] = g) : b = a.extend(r, {}, b); a.each(b, function (c, g) { var e = h(c.toLowerCase()), l; l = e[0][e[1]]; e[0][e[1]] = "object" === typeof g && g.nodeType ? a(g) : g; b[c] = [e[0], e[1], g, l]; q = d.test(c) || q; k = f.test(c) || k }); e(c); V = da = 1; a.each(b, function (a, b) {
                    var c, g, d; for (c in l) for (g in l[c]) if (d = RegExp(g, "i").exec(a)) b.push(d),
                        l[c][g].apply(G, b)
                }); V = da = 0; G.rendered && 0 < J[0].offsetWidth && (q && G.reposition("mouse" === c.position.target ? t : Z.event), k && G.redraw()); return G
            }, toggle: function (b, e, f) {
                function q() { b ? (a.browser.msie && J[0].style.removeAttribute("filter"), J.css("overflow", ""), "string" === typeof k.autofocus && a(k.autofocus, J).focus(), k.target.trigger("qtip-" + d + "-inactive")) : J.css({ display: "", visibility: "", opacity: "", left: "", top: "" }); A = a.Event("tooltip" + (b ? "visible" : "hidden")); A.originalEvent = e ? Z.event : t; J.trigger(A, [G]) } if (!G.rendered) return b ?
                    G.render(1) : G; var h = b ? "show" : "hide", k = c[h], l = c.position, m = c.content, w = 0 < J[0].offsetWidth, u = b || 1 === k.target.length, x = !e || 2 > k.target.length || Z.target[0] === e.target, A; (typeof b).search("boolean|number") && (b = !w); if (!J.is(":animated") && w === b && x) return G; if (e) { if (/over|enter/.test(e.type) && /out|leave/.test(Z.event.type) && c.show.target.add(e.target).length === c.show.target.length && J.has(e.relatedTarget).length) return G; Z.event = a.extend({}, e) } A = a.Event("tooltip" + h); A.originalEvent = e ? Z.event : t; J.trigger(A,
                        [G, 90]); if (A.isDefaultPrevented()) return G; a.attr(J[0], "aria-hidden", !b); b ? (Z.origin = a.extend({}, g), G.focus(e), a.isFunction(m.text) && ha(m.text, z), a.isFunction(m.title.text) && L(m.title.text, z), !S && "mouse" === l.target && l.adjust.mouse && (a(document).bind("mousemove.qtip", function (a) { g = { pageX: a.pageX, pageY: a.pageY, type: "mousemove" } }), S = r), G.reposition(e, f), (A.solo = !!k.solo) && a(D, k.solo).not(J).qtip("hide", A)) : (clearTimeout(G.timers.show), delete Z.origin, S && !a(D + '[tracking\x3d"true"]:visible', k.solo).not(J).length &&
                            (a(document).unbind("mousemove.qtip"), S = z), G.blur(e)); k.effect === z || u === z ? (J[h](), q.call(J)) : a.isFunction(k.effect) ? (J.stop(1, 1), k.effect.call(J, G), J.queue("fx", function (a) { q(); a() })) : J.fadeTo(90, b ? 1 : 0, q); b && k.target.trigger("qtip-" + d + "-inactive"); return G
            }, show: function (a) { return G.toggle(r, a) }, hide: function (a) { return G.toggle(z, a) }, focus: function (b) {
                if (!G.rendered) return G; var c = a(D), g = parseInt(J[0].style.zIndex, 10), d = v.zindex + c.length; b = a.extend({}, b); var e; J.hasClass(I) || (e = a.Event("tooltipfocus"),
                    e.originalEvent = b, J.trigger(e, [G, d]), e.isDefaultPrevented() || (g !== d && (c.each(function () { this.style.zIndex > g && (this.style.zIndex -= 1) }), c.filter("." + I).qtip("blur", b)), J.addClass(I)[0].style.zIndex = d)); return G
            }, blur: function (b) { b = a.extend({}, b); var c; J.removeClass(I); c = a.Event("tooltipblur"); c.originalEvent = b; J.trigger(c, [G]); return G }, reposition: function (b, d) {
                if (!G.rendered || V) return G; V = 1; var e = c.position.target, f = c.position, h = f.my, k = f.at, l = f.adjust, m = l.method.split(" "), w = J.outerWidth(), u = J.outerHeight(),
                    x = 0, A = 0, D = a.Event("tooltipmove"), I = "fixed" === J.css("position"), r = f.viewport, B = { left: 0, top: 0 }, E = f.container, C = z, F = G.plugins.tip, O = 0 < J[0].offsetWidth, s = {
                        horizontal: m[0], vertical: m[1] = m[1] || m[0], enabled: r.jquery && e[0] !== window && e[0] !== M && "none" !== l.method, left: function (a) {
                            var b = "shift" === s.horizontal, c = -E.offset.left + r.offset.left + r.scrollLeft, g = "left" === h.x ? w : "right" === h.x ? -w : -w / 2, d = "left" === k.x ? x : "right" === k.x ? -x : -x / 2, e = F && F.size ? F.size.width || 0 : 0, f = F && F.corner && "x" === F.corner.precedance && !b ? e : 0, q =
                                c - a + f, m = a + w - r.width - c + f, d = g - ("x" === h.precedance || h.x === h.y ? d : 0) - ("center" === k.x ? x / 2 : 0), f = "center" === h.x; b ? (f = F && F.corner && "y" === F.corner.precedance ? e : 0, d = ("left" === h.x ? 1 : -1) * g - f, B.left += 0 < q ? q : 0 < m ? -m : 0, B.left = Math.max(-E.offset.left + r.offset.left + (f && "center" === F.corner.x ? F.offset : 0), a - d, Math.min(Math.max(-E.offset.left + r.offset.left + r.width, a + d), B.left))) : (0 < q && ("left" !== h.x || 0 < m) ? B.left -= d : 0 < m && ("right" !== h.x || 0 < q) && (B.left -= f ? -d : d), B.left !== a && f && (B.left -= l.x), B.left < c && -B.left > m && (B.left = a)); return B.left -
                                    a
                        }, top: function (a) {
                            var b = "shift" === s.vertical, c = -E.offset.top + r.offset.top + r.scrollTop, g = "top" === h.y ? u : "bottom" === h.y ? -u : -u / 2, d = "top" === k.y ? A : "bottom" === k.y ? -A : -A / 2, e = F && F.size ? F.size.height || 0 : 0, f = F && F.corner && "y" === F.corner.precedance && !b ? e : 0, q = c - a + f, c = a + u - r.height - c + f, d = g - ("y" === h.precedance || h.x === h.y ? d : 0) - ("center" === k.y ? A / 2 : 0), f = "center" === h.y; b ? (f = F && F.corner && "x" === F.corner.precedance ? e : 0, d = ("top" === h.y ? 1 : -1) * g - f, B.top += 0 < q ? q : 0 < c ? -c : 0, B.top = Math.max(-E.offset.top + r.offset.top + (f && "center" ===
                                F.corner.x ? F.offset : 0), a - d, Math.min(Math.max(-E.offset.top + r.offset.top + r.height, a + d), B.top))) : (0 < q && ("top" !== h.y || 0 < c) ? B.top -= d : 0 < c && ("bottom" !== h.y || 0 < q) && (B.top -= f ? -d : d), B.top !== a && f && (B.top -= l.y), 0 > B.top && -B.top > c && (B.top = a)); return B.top - a
                        }
                    }; if (a.isArray(e) && 2 === e.length) k = { x: "left", y: "top" }, B = { left: e[0], top: e[1] }; else if ("mouse" === e && (b && b.pageX || Z.event.pageX)) k = { x: "left", y: "top" }, b = (!b || "resize" !== b.type && "scroll" !== b.type ? b && b.pageX && "mousemove" === b.type ? b : !g || !g.pageX || !l.mouse && b && b.pageX ?
                        !l.mouse && Z.origin && Z.origin.pageX && c.show.distance ? Z.origin : b : { pageX: g.pageX, pageY: g.pageY } : Z.event) || b || Z.event || g || {}, B = { top: b.pageY, left: b.pageX }; else {
                            e = "event" === e ? b && b.target && "scroll" !== b.type && "resize" !== b.type ? Z.target = a(b.target) : Z.target : Z.target = a(e.jquery ? e : X.target); e = a(e).eq(0); if (0 === e.length) return G; e[0] === document || e[0] === window ? (x = y.iOS ? window.innerWidth : e.width(), A = y.iOS ? window.innerHeight : e.height(), e[0] === window && (B = { top: (r || e).scrollTop(), left: (r || e).scrollLeft() })) : e.is("area") &&
                                y.imagemap ? B = y.imagemap(e, k, s.enabled ? m : z) : "http://www.w3.org/2000/svg" === e[0].namespaceURI && y.svg ? B = y.svg(e, k) : (x = e.outerWidth(), A = e.outerHeight(), B = y.offset(e, E)); B.offset && (x = B.width, A = B.height, C = B.flipoffset, B = B.offset); if (4.1 > y.iOS && 3.1 < y.iOS || 4.3 == y.iOS || !y.iOS && I) m = a(window), B.left -= m.scrollLeft(), B.top -= m.scrollTop(); B.left += "right" === k.x ? x : "center" === k.x ? x / 2 : 0; B.top += "bottom" === k.y ? A : "center" === k.y ? A / 2 : 0
                    } B.left += l.x + ("right" === h.x ? -w : "center" === h.x ? -w / 2 : 0); B.top += l.y + ("bottom" === h.y ? -u : "center" ===
                        h.y ? -u / 2 : 0); s.enabled ? (r = { elem: r, height: r[(r[0] === window ? "h" : "outerH") + "eight"](), width: r[(r[0] === window ? "w" : "outerW") + "idth"](), scrollLeft: I ? 0 : r.scrollLeft(), scrollTop: I ? 0 : r.scrollTop(), offset: r.offset() || { left: 0, top: 0 } }, E = { elem: E, scrollLeft: E.scrollLeft(), scrollTop: E.scrollTop(), offset: E.offset() || { left: 0, top: 0 } }, B.adjusted = { left: "none" !== s.horizontal ? s.left(B.left) : 0, top: "none" !== s.vertical ? s.top(B.top) : 0 }, B.adjusted.left + B.adjusted.top && J.attr("class", J[0].className.replace(/ui-tooltip-pos-\w+/i,
                            q + "-pos-" + h.abbrev())), C && B.adjusted.left && (B.left += C.left), C && B.adjusted.top && (B.top += C.top)) : B.adjusted = { left: 0, top: 0 }; D.originalEvent = a.extend({}, b); J.trigger(D, [G, B, r.elem || r]); if (D.isDefaultPrevented()) return G; delete B.adjusted; d === z || !O || isNaN(B.left) || isNaN(B.top) || "mouse" === e || !a.isFunction(f.effect) ? J.css(B) : a.isFunction(f.effect) && (f.effect.call(J, G, a.extend({}, B)), J.queue(function (b) { a(this).css({ opacity: "", height: "" }); a.browser.msie && this.style.removeAttribute("filter"); b() })); V = 0; return G
            },
            redraw: function () { if (1 > G.rendered || da) return G; var a = c.position.container, b, g, d; da = 1; c.style.height && J.css("height", c.style.height); c.style.width ? J.css("width", c.style.width) : (J.css("width", "").addClass(O), b = J.width() + 1, g = J.css("max-width") || "", d = J.css("min-width") || "", a = -1 < (g + d).indexOf("%") ? a.width() / 100 : 0, g = (-1 < g.indexOf("%") ? a : 1) * parseInt(g, 10) || b, d = (-1 < d.indexOf("%") ? a : 1) * parseInt(d, 10) || 0, b = g + d ? Math.min(Math.max(b, d), g) : b, J.css("width", Math.round(b)).removeClass(O)); da = 0; return G }, disable: function (b) {
                "boolean" !==
                typeof b && (b = !(J.hasClass(x) || Z.disabled)); G.rendered ? (J.toggleClass(x, b), a.attr(J[0], "aria-disabled", b)) : Z.disabled = !!b; return G
            }, enable: function () { return G.disable(z) }, destroy: function () {
                var g = b[0], e = a.attr(g, C), f = b.data("qtip"); G.rendered && (J.stop(1, 0).remove(), a.each(G.plugins, function () { this.destroy && this.destroy() })); clearTimeout(G.timers.show); clearTimeout(G.timers.hide); ca(); f && G !== f || (a.removeData(g, "qtip"), c.suppress && e && (a.attr(g, "title", e), b.removeAttr(C)), b.removeAttr("aria-describedby"));
                b.unbind(".qtip-" + d); delete u[G.id]; return b
            }
        })
    } function c(b, c) {
        var g, d, f, q, k, m = a(this), w = a(document.body), u = this === document ? w : m; d = m.metadata ? m.metadata(c.metadata) : t; q = "html5" === c.metadata.type && d ? d[c.metadata.name] : t; var x = m.data(c.metadata.name || "qtipopts"); try { x = "string" === typeof x ? (new Function("return " + x))() : x } catch (A) { l("Unable to parse HTML5 attribute data: " + x) } q = a.extend(r, {}, v.defaults, c, "object" === typeof x ? e(x) : t, e(q || d)); d = q.position; q.id = b; if ("boolean" === typeof q.content.text) if (f =
            m.attr(q.content.attr), q.content.attr !== z && f) q.content.text = f; else return l("Unable to locate content for tooltip! Aborting render of tooltip on element: ", m), z; d.container.length || (d.container = w); d.target === z && (d.target = u); q.show.target === z && (q.show.target = u); q.show.solo === r && (q.show.solo = d.container.closest("body")); q.hide.target === z && (q.hide.target = u); q.position.viewport === r && (q.position.viewport = d.container); d.container = d.container.eq(0); d.at = new y.Corner(d.at); d.my = new y.Corner(d.my); if (a.data(this,
                "qtip")) if (q.overwrite) m.qtip("destroy"); else if (q.overwrite === z) return z; q.suppress && (k = a.attr(this, "title")) && a(this).removeAttr("title").attr(C, k); g = new h(m, q, b, !!f); a.data(this, "qtip", g); m.bind("remove.qtip-" + b + " removeqtip.qtip-" + b, function () { g.destroy() }); return g
    } function d(b) {
        var c = this, g = b.elements.tooltip, d = b.options.content.ajax, e = /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, f = r, q = z, h = z, k; b.checks.ajax = {
            "^content.ajax": function (a, b, e) {
                "ajax" === b && (d = e); "once" === b ? c.init() : d && d.url ?
                    c.load() : g.unbind(".qtip-ajax")
            }
        }; a.extend(c, {
            init: function () { if (d && d.url) g.unbind(".qtip-ajax")[d.once ? "one" : "bind"]("tooltipshow.qtip-ajax", c.load); return c }, load: function (g) {
                function l() { q || (f = z, D && (h = r, b.show(g.originalEvent)), a.isFunction(d.complete) && d.complete.apply(this, arguments)) } function m(c) { q || (A && (c = a("\x3cdiv/\x3e").append(c.replace(e, "")).find(A)), b.set("content.text", c)) } function w(a, c, g) { q || 0 === a.status || b.set("content.text", c + ": " + g) } if (h) h = z; else {
                    var u = d.url.indexOf(" "), x = d.url,
                    A, D = !d.loading && f; if (D) try { g.preventDefault() } catch (I) { } else if (g && g.isDefaultPrevented()) return c; k && k.abort && k.abort(); -1 < u && (A = x.substr(u), x = x.substr(0, u)); k = a.ajax(a.extend({ success: m, error: w, context: b }, d, { url: x, complete: l }))
                }
            }, destroy: function () { k && k.abort && k.abort(); q = r }
        }); c.init()
    } function b(a, b, c) {
        var g = Math.ceil(b / 2), d = Math.ceil(c / 2); b = {
            bottomright: [[0, 0], [b, c], [b, 0]], bottomleft: [[0, 0], [b, 0], [0, c]], topright: [[0, c], [b, 0], [b, c]], topleft: [[0, 0], [0, c], [b, c]], topcenter: [[0, c], [g, 0], [b, c]], bottomcenter: [[0,
                0], [b, 0], [g, c]], rightcenter: [[0, 0], [b, d], [0, c]], leftcenter: [[b, 0], [b, c], [0, d]]
        }; b.lefttop = b.bottomright; b.righttop = b.bottomleft; b.leftbottom = b.topright; b.rightbottom = b.topleft; return b[a.string()]
    } function f(c, g) {
        function d(a, b, g, e) {
            if (l.tip) {
                a = h.corner.clone(); b = g.adjusted; var f = c.options.position.adjust.method.split(" "); e = f[0]; var f = f[1] || f[0], q = z, m = z, u = 0, x = 0, A, D = {}, I; h.corner.fixed !== r && ("shift" === e && "x" === a.precedance && b.left && "center" !== a.y ? a.precedance = "x" === a.precedance ? "y" : "x" : "flip" === e &&
                    b.left && (a.x = "center" === a.x ? 0 < b.left ? "left" : "right" : "left" === a.x ? "right" : "left"), "shift" === f && "y" === a.precedance && b.top && "center" !== a.x ? a.precedance = "y" === a.precedance ? "x" : "y" : "flip" === f && b.top && (a.y = "center" === a.y ? 0 < b.top ? "top" : "bottom" : "top" === a.y ? "bottom" : "top"), a.string() === w.corner.string() || w.top === b.top && w.left === b.left || h.update(a, z)); A = h.position(a, b); A.right !== s && (A.left = -A.right); A.bottom !== s && (A.top = -A.bottom); A.user = Math.max(0, k.offset); if (q = "shift" === e && !!b.left) "center" === a.x ? D["margin-left"] =
                        u = A["margin-left"] - b.left : (I = A.right !== s ? [b.left, -A.left] : [-b.left, A.left], (u = Math.max(I[0], I[1])) > I[0] && (g.left -= b.left, q = z), D[A.right !== s ? "right" : "left"] = u); if (m = "shift" === f && !!b.top) "center" === a.y ? D["margin-top"] = x = A["margin-top"] - b.top : (I = A.bottom !== s ? [b.top, -A.top] : [-b.top, A.top], (x = Math.max(I[0], I[1])) > I[0] && (g.top -= b.top, m = z), D[A.bottom !== s ? "bottom" : "top"] = x); l.tip.css(D).toggle(!(u && x || "center" === a.x && x || "center" === a.y && u)); g.left -= A.left.charAt ? A.user : "shift" !== e || m || !q && !m ? A.left : 0; g.top -=
                            A.top.charAt ? A.user : "shift" !== f || q || !q && !m ? A.top : 0; w.left = b.left; w.top = b.top; w.corner = a.clone()
            }
        } function e(a, b, c) { b = b ? b : a[a.precedance]; var g = m.hasClass(O); a = l.titlebar && "top" === a.y ? l.titlebar : l.content; b = "border-" + b + "-width"; m.addClass(O); a = parseInt(a.css(b), 10); a = (c ? a || parseInt(m.css(b), 10) : a) || 0; m.toggleClass(O, g); return a } function f(a) {
            var b = "y" === a.precedance, c = u[b ? "width" : "height"], g = u[b ? "height" : "width"], d = -1 < a.string().indexOf("center"), e = c * (d ? 0.5 : 1), q = Math.pow; a = Math.round; var h = Math.sqrt(q(e,
                2) + q(g, 2)), e = [D / e * h, D / g * h]; e[2] = Math.sqrt(q(e[0], 2) - q(D, 2)); e[3] = Math.sqrt(q(e[1], 2) - q(D, 2)); d = (h + e[2] + e[3] + (d ? 0 : e[0])) / h; c = [a(d * g), a(d * c)]; return { height: c[b ? 0 : 1], width: c[b ? 1 : 0] }
        } var h = this, k = c.options.style.tip, l = c.elements, m = l.tooltip, w = { top: 0, left: 0 }, u = { width: k.width, height: k.height }, x, A, D = k.border || 0, I = !!(a("\x3ccanvas /\x3e")[0] || {}).getContext; h.corner = t; h.mimic = t; h.border = D; h.offset = k.offset; h.size = u; c.checks.tip = {
            "^position.my|style.tip.(corner|mimic|border)$": function () {
                h.init() || h.destroy();
                c.reposition()
            }, "^style.tip.(height|width)$": function () { u = { width: k.width, height: k.height }; h.create(); h.update(); c.reposition() }, "^content.title.text|style.(classes|widget)$": function () { l.tip && h.update() }
        }; a.extend(h, {
            init: function () { var b = h.detectCorner() && (I || a.browser.msie); b && (h.create(), h.update(), m.unbind(".qtip-tip").bind("tooltipmove.qtip-tip", d)); return b }, detectCorner: function () {
                var a = k.corner, b = c.options.position, g = b.at, b = b.my.string ? b.my.string() : b.my; if (a === z || b === z && g === z) return z; a ===
                    r ? h.corner = new y.Corner(b) : a.string || (h.corner = new y.Corner(a), h.corner.fixed = r); w.corner = new y.Corner(h.corner.string()); return "centercenter" !== h.corner.string()
            }, detectColours: function (b) {
                var g, d, e = l.tip.css("cssText", ""); g = b || h.corner; var f = g[g.precedance]; b = "border-" + f + "-color"; d = "border" + f.charAt(0) + f.substr(1) + "Color"; var f = /rgba?\(0, 0, 0(, 0)?\)|transparent|#123456/i, q = a(document.body).css("color"); c.elements.content.css("color"); var w = l.titlebar && ("top" === g.y || "center" === g.y && e.position().top +
                    u.height / 2 + k.offset < l.titlebar.outerHeight(1)) ? l.titlebar : l.content; m.addClass(O); x = g = e.css("background-color"); A = d = e[0].style[d] || e.css(b) || m.css(b); if (!g || f.test(g)) x = w.css("background-color") || "transparent", f.test(x) && (x = m.css("background-color") || g); if (!d || f.test(d) || d === q) A = w.css(b) || "transparent", f.test(A) && (A = d); a("*", e).add(e).css("cssText", "background-color:transparent !important;border:0 !important;"); m.removeClass(O)
            }, create: function () {
                var b = u.width, c = u.height; l.tip && l.tip.remove(); l.tip =
                    a("\x3cdiv /\x3e", { "class": q + "-tip" }).css({ width: b, height: c }).prependTo(m); I ? a("\x3ccanvas /\x3e").appendTo(l.tip)[0].getContext("2d").save() : (l.tip.html('\x3cvml:shape coordorigin\x3d"0,0" style\x3d"display:inline-block; position:absolute; behavior:url(#default#VML);"\x3e\x3c/vml:shape\x3e\x3cvml:shape coordorigin\x3d"0,0" style\x3d"display:inline-block; position:absolute; behavior:url(#default#VML);"\x3e\x3c/vml:shape\x3e'), a("*", l.tip).bind("click mousedown", function (a) { a.stopPropagation() }))
            },
            update: function (c, g) {
                var d = l.tip, q = d.children(), m = u.width, B = u.height, E = k.mimic, C = Math.round, O, K, s; c || (c = w.corner || h.corner); E === z ? E = c : (E = new y.Corner(E), E.precedance = c.precedance, "inherit" === E.x ? E.x = c.x : "inherit" === E.y ? E.y = c.y : E.x === E.y && (E[c.precedance] = c[c.precedance])); O = E.precedance; h.detectColours(c); "transparent" !== A && "#123456" !== A ? (D = e(c, t, r), 0 === k.border && 0 < D && (x = A), h.border = D = k.border !== r ? k.border : D) : h.border = D = 0; K = b(E, m, B); h.size = s = f(c); d.css(s); d = "y" === c.precedance ? [C("left" === E.x ? D : "right" ===
                    E.x ? s.width - m - D : (s.width - m) / 2), C("top" === E.y ? s.height - B : 0)] : [C("left" === E.x ? s.width - m : 0), C("top" === E.y ? D : "bottom" === E.y ? s.height - B - D : (s.height - B) / 2)]; I ? (q.attr(s), q = q[0].getContext("2d"), q.restore(), q.save(), q.clearRect(0, 0, 3E3, 3E3), q.translate(d[0], d[1]), q.beginPath(), q.moveTo(K[0][0], K[0][1]), q.lineTo(K[1][0], K[1][1]), q.lineTo(K[2][0], K[2][1]), q.closePath(), q.fillStyle = x, q.strokeStyle = A, q.lineWidth = 2 * D, q.lineJoin = "miter", q.miterLimit = 100, D && q.stroke(), q.fill()) : (K = "m" + K[0][0] + "," + K[0][1] + " l" + K[1][0] +
                        "," + K[1][1] + " " + K[2][0] + "," + K[2][1] + " xe", d[2] = D && /^(r|b)/i.test(c.string()) ? 8 === parseFloat(a.browser.version, 10) ? 2 : 1 : 0, q.css({ antialias: "" + (-1 < E.string().indexOf("center")), left: d[0] - d[2] * Number("x" === O), top: d[1] - d[2] * Number("y" === O), width: m + D, height: B + D }).each(function (b) { var c = a(this); c[c.prop ? "prop" : "attr"]({ coordsize: m + D + " " + (B + D), path: K, fillcolor: x, filled: !!b, stroked: !b }).css({ display: D || b ? "block" : "none" }); b || "" !== c.html() || c.html('\x3cvml:stroke weight\x3d"' + 2 * D + 'px" color\x3d"' + A + '" miterlimit\x3d"1000" joinstyle\x3d"miter"  style\x3d"behavior:url(#default#VML); display:inline-block;" /\x3e') }));
                g !== z && h.position(c)
            }, position: function (b) {
                var c = l.tip, g = {}, d = Math.max(0, k.offset), q, w, u; if (k.corner === z || !c) return z; b = b || h.corner; q = b.precedance; w = f(b); u = [b.x, b.y]; "x" === q && u.reverse(); a.each(u, function (c, f) {
                    var h, k; if ("center" === f) h = "y" === q ? "left" : "top", g[h] = "50%", g["margin-" + h] = -Math.round(w["y" === q ? "width" : "height"] / 2) + d; else {
                        h = e(b, f, r); k = a.browser.mozilla; var u = b.y + (k ? "" : "-") + b.x; k = (k ? "-moz-" : a.browser.webkit ? "-webkit-" : "") + (k ? "border-radius-" + u : "border-" + u + "-radius"); k = parseInt((l.titlebar &&
                            "top" === b.y ? l.titlebar : l.content).css(k), 10) || parseInt(m.css(k), 10) || 0; g[f] = c ? D ? e(b, f) : 0 : d + (k > h ? k : 0)
                    }
                }); g[b[q]] -= w["x" === q ? "width" : "height"]; c.css({ top: "", bottom: "", left: "", right: "", margin: "" }).css(g); return g
            }, destroy: function () { l.tip && l.tip.remove(); m.unbind(".qtip-tip") }
        }); h.init()
    } function m(b) {
        var c = this, g = b.options.show.modal, d = b.elements, e = d.tooltip, f = ".qtipmodal" + b.id, q = a(document.body), h; b.checks.modal = { "^show.modal.(on|blur)$": function () { c.init(); d.overlay.toggle(e.is(":visible")) } }; a.extend(c,
            {
                init: function () {
                    if (!g.on) return c; h = c.create(); e.attr("is-modal-qtip", r).css("z-index", y.modal.zindex + a(D + "[is-modal-qtip]").length).unbind(".qtipmodal").unbind(f).bind("tooltipshow.qtipmodal tooltiphide.qtipmodal", function (b, g, d) { g = b.originalEvent; if (b.target === e[0]) if (g && "tooltiphide" === b.type && /mouse(leave|enter)/.test(g.type) && a(g.relatedTarget).closest(h[0]).length) try { b.preventDefault() } catch (f) { } else if (!g || g && !g.solo) c[b.type.replace("tooltip", "")](b, d) }).bind("tooltipfocus.qtipmodal", function (b) {
                        if (!b.isDefaultPrevented() &&
                            b.target === e[0]) { var c = a(D).filter("[is-modal-qtip]"), g = y.modal.zindex + c.length, d = parseInt(e[0].style.zIndex, 10); h[0].style.zIndex = g - 1; c.each(function () { this.style.zIndex > d && (this.style.zIndex -= 1) }); c.end().filter("." + I).qtip("blur", b.originalEvent); e.addClass(I)[0].style.zIndex = g; try { b.preventDefault() } catch (f) { } }
                    }).bind("tooltiphide.qtipmodal", function (b) { b.target === e[0] && a("[is-modal-qtip]").filter(":visible").not(e).last().qtip("focus", b) }); g.escape && a(window).unbind(f).bind("keydown" + f, function (a) {
                        27 ===
                        a.keyCode && e.hasClass(I) && b.hide(a)
                    }); g.blur && d.overlay.unbind(f).bind("click" + f, function (a) { e.hasClass(I) && b.hide(a) }); return c
                }, create: function () {
                    function b() { h.css({ height: a(window).height(), width: a(window).width() }) } var c = a("#qtip-overlay"); if (c.length) return d.overlay = c.insertAfter(a(D).last()); h = d.overlay = a("\x3cdiv /\x3e", { id: "qtip-overlay", html: "\x3cdiv\x3e\x3c/div\x3e", mousedown: function () { return z } }).insertAfter(a(D).last()); a(window).unbind(".qtipmodal").bind("resize.qtipmodal", b); b();
                    return h
                }, toggle: function (b, d, k) {
                    if (b && b.isDefaultPrevented()) return c; b = g.effect; var l = d ? "show" : "hide", m = h.is(":visible"), u = a("[is-modal-qtip]").filter(":visible").not(e); h || (h = c.create()); if (h.is(":animated") && m === d || !d && u.length) return c; d ? (h.css({ left: 0, top: 0 }), h.toggleClass("blurs", g.blur), q.bind("focusin" + f, function (b) { var c = a(b.target).closest(".qtip"); (1 > c.length ? z : parseInt(c[0].style.zIndex, 10) > parseInt(e[0].style.zIndex, 10)) || a(b.target).closest(D)[0] === e[0] || e.find("input:visible").filter(":first").focus() })) :
                        q.undelegate("*", "focusin" + f); h.stop(r, z); if (a.isFunction(b)) b.call(h, d); else if (b === z) h[l](); else h.fadeTo(parseInt(k, 10) || 90, d ? 1 : 0, function () { d || a(this).hide() }); d || h.queue(function (a) { h.css({ left: "", top: "" }); a() }); return c
                }, show: function (a, b) { return c.toggle(a, r, b) }, hide: function (a, b) { return c.toggle(a, z, b) }, destroy: function () {
                    var c = h; c && ((c = 1 > a("[is-modal-qtip]").not(e).length) ? (d.overlay.remove(), a(window).unbind(".qtipmodal")) : d.overlay.unbind(".qtipmodal" + b.id), q.undelegate("*", "focusin" + f));
                    return e.removeAttr("is-modal-qtip").unbind(".qtipmodal")
                }
            }); c.init()
    } function k(b) {
        var c = this, g = b.elements, d = g.tooltip, e = ".bgiframe-" + b.id; a.extend(c, {
            init: function () {
                g.bgiframe = a('\x3ciframe class\x3d"ui-tooltip-bgiframe" frameborder\x3d"0" tabindex\x3d"-1" src\x3d"javascript:\'\';"  style\x3d"display:block; position:absolute; z-index:-1; filter:alpha(opacity\x3d0); -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity\x3d0)";"\x3e\x3c/iframe\x3e'); g.bgiframe.appendTo(d); d.bind("tooltipmove" +
                    e, c.adjust)
            }, adjust: function () { var a = b.get("dimensions"), c = b.plugins.tip, e = g.tip, f; f = parseInt(d.css("border-left-width"), 10) || 0; f = { left: -f, top: -f }; c && e && (c = "x" === c.corner.precedance ? ["width", "left"] : ["height", "top"], f[c[1]] -= e[c[0]]()); g.bgiframe.css(f).css(a) }, destroy: function () { g.bgiframe.remove(); d.unbind(e) }
        }); c.init()
    } var r = !0, z = !1, t = null, s, v, y, g, u = {}, q = "ui-qtooltip", w = "ui-widget", x = "ui-state-disabled", D = "div.qtip." + q, A = q + "-default", I = q + "-focus", E = q + "-hover", O = q + "-fluid", C = "oldtitle", S; v = a.fn.qtip =
        function (b, c, g) {
            var d = ("" + b).toLowerCase(), f = t, q = a.makeArray(arguments).slice(1), h = q[q.length - 1], k = this[0] ? a.data(this[0], "qtip") : t; if (!arguments.length && k || "api" === d) return k; if ("string" === typeof b) return this.each(function () { var b = a.data(this, "qtip"); if (!b) return r; h && h.timeStamp && (b.cache.event = h); if ("option" !== d && "options" !== d || !c) b[d] && b[d].apply(b[d], q); else if (a.isPlainObject(c) || g !== s) b.set(c, g); else return f = b.get(c), z }), f !== t ? f : this; if ("object" === typeof b || !arguments.length) return k = e(a.extend(r,
                {}, b)), v.bind.call(this, k, h)
        }; v.bind = function (b, d) {
            return this.each(function (e) {
                function f(b) { function c() { m.render("object" === typeof b || q.show.ready); h.show.add(h.hide).unbind(l) } if (m.cache.disabled) return z; m.cache.event = a.extend({}, b); m.cache.target = b ? a(b.target) : [s]; 0 < q.show.delay ? (clearTimeout(m.timers.show), m.timers.show = setTimeout(c, q.show.delay), k.show !== k.hide && h.hide.bind(k.hide, function () { clearTimeout(m.timers.show) })) : c() } var q, h, k, l, m; e = a.isArray(b.id) ? b.id[e] : b.id; e = !e || e === z || 1 > e.length ||
                    u[e] ? v.nextid++ : u[e] = e; l = ".qtip-" + e + "-create"; m = c.call(this, e, b); if (m === z) return r; q = m.options; a.each(y, function () { "initialize" === this.initialize && this(m) }); h = { show: q.show.target, hide: q.hide.target }; k = { show: a.trim("" + q.show.event).replace(/ /g, l + " ") + l, hide: a.trim("" + q.hide.event).replace(/ /g, l + " ") + l }; /mouse(over|enter)/i.test(k.show) && !/mouse(out|leave)/i.test(k.hide) && (k.hide += " mouseleave" + l); h.show.bind("mousemove" + l, function (a) {
                        g = { pageX: a.pageX, pageY: a.pageY, type: "mousemove" }; m.cache.onTarget =
                            r
                    }); h.show.bind(k.show, f); (q.show.ready || q.prerender) && f(d)
            })
        }; y = v.plugins = {
            Corner: function (a) {
                a = ("" + a).replace(/([A-Z])/, " $1").replace(/middle/gi, "center").toLowerCase(); this.x = (a.match(/left|right/i) || a.match(/center/) || ["inherit"])[0].toLowerCase(); this.y = (a.match(/top|bottom|center/i) || ["inherit"])[0].toLowerCase(); a = a.charAt(0); this.precedance = "t" === a || "b" === a ? "y" : "x"; this.string = function () { return "y" === this.precedance ? this.y + this.x : this.x + this.y }; this.abbrev = function () {
                    var a = this.x.substr(0,
                        1), b = this.y.substr(0, 1); return a === b ? a : "c" === a || "c" !== a && "c" !== b ? b + a : a + b
                }; this.clone = function () { return { x: this.x, y: this.y, precedance: this.precedance, string: this.string, abbrev: this.abbrev, clone: this.clone } }
            }, offset: function (b, c) {
                var g = b.offset(), d = b.closest("body")[0], e = c, f, q, h; if (e) {
                    do "static" !== e.css("position") && (q = e.position(), g.left -= q.left + (parseInt(e.css("borderLeftWidth"), 10) || 0) + (parseInt(e.css("marginLeft"), 10) || 0), g.top -= q.top + (parseInt(e.css("borderTopWidth"), 10) || 0) + (parseInt(e.css("marginTop"),
                        10) || 0), f || "hidden" === (h = e.css("overflow")) || "visible" === h || (f = e)); while ((e = a(e[0].offsetParent)).length); f && f[0] !== d && (d = f, g.left += 1 * d.scrollLeft(), g.top += 1 * d.scrollTop())
                } return g
            }, iOS: parseFloat(("" + (/CPU.*OS ([0-9_]{1,3})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent) || [0, ""])[1]).replace("undefined", "3_2").replace("_", ".")) || z, fn: {
                attr: function (b, c) {
                    if (this.length) {
                        var g = this[0], d = a.data(g, "qtip"); if ("title" === b && d && "object" === typeof d && d.options.suppress) {
                            if (2 > arguments.length) return a.attr(g,
                                C); d && "title" === d.options.content.attr && d.cache.attr && d.set("content.text", c); return this.attr(C, c)
                        }
                    } return a.fn.attr_replacedByqTip.apply(this, arguments)
                }, clone: function (b) { a([]); var c = a.fn.clone_replacedByqTip.apply(this, arguments); b || c.filter("[" + C + "]").attr("title", function () { return a.attr(this, C) }).removeAttr(C); return c }
            }
        }; a.each(y.fn, function (b, c) {
            if (!c || a.fn[b + "_replacedByqTip"]) return r; var g = a.fn[b + "_replacedByqTip"] = a.fn[b]; a.fn[b] = function () {
                return c.apply(this, arguments) || g.apply(this,
                    arguments)
            }
        }); a.ui || (a.cleanData_replacedByqTip = a.cleanData, a.cleanData = function (b) { for (var c = 0, g; (g = b[c]) !== s; c++)try { a(g).triggerHandler("removeqtip") } catch (d) { } a.cleanData_replacedByqTip(b) }); v.version = "nightly"; v.nextid = 0; v.inactiveEvents = "click dblclick mousedown mouseup mousemove mouseleave mouseenter".split(" "); v.zindex = 15E3; v.defaults = {
            prerender: z, id: z, overwrite: r, suppress: r, content: { text: r, attr: "title", title: { text: z, button: z } }, position: {
                my: "top left", at: "bottom right", target: z, container: z,
                viewport: z, adjust: { x: 0, y: 0, mouse: r, resize: r, method: "flip flip" }, effect: function (b, c, g) { a(this).animate(c, { duration: 200, queue: z }) }
            }, show: { target: z, event: "mouseenter", effect: r, delay: 90, solo: z, ready: z, autofocus: z }, hide: { target: z, event: "mouseleave", effect: r, delay: 0, fixed: z, inactive: z, leave: "window", distance: z }, style: { classes: "", widget: z, width: z, height: z, def: r }, events: { render: t, move: t, show: t, hide: t, toggle: t, visible: t, hidden: t, focus: t, blur: t }
        }; y.ajax = function (a) {
            var b = a.plugins.ajax; return "object" === typeof b ?
                b : a.plugins.ajax = new d(a)
        }; y.ajax.initialize = "render"; y.ajax.sanitize = function (a) { var b = a.content; b && "ajax" in b && (b = b.ajax, "object" !== typeof b && (b = a.content.ajax = { url: b }), "boolean" !== typeof b.once && b.once && (b.once = !!b.once)) }; a.extend(r, v.defaults, { content: { ajax: { loading: r, once: r } } }); y.imagemap = function (b, c, g) {
            function d(a, b, c) {
                for (var g = 0, e = 1, f = 1, q = 0, h = 0, k = a.width, l = a.height; 0 < k && 0 < l && 0 < e && 0 < f;)for (k = Math.floor(k / 2), l = Math.floor(l / 2), e = "left" === c.x ? k : "right" === c.x ? a.width - k : e + Math.floor(k / 2), f = "top" ===
                    c.y ? l : "bottom" === c.y ? a.height - l : f + Math.floor(l / 2), g = b.length; g-- && !(2 > b.length);)q = b[g][0] - a.offset.left, h = b[g][1] - a.offset.top, ("left" === c.x && q >= e || "right" === c.x && q <= e || "center" === c.x && (q < e || q > a.width - e) || "top" === c.y && h >= f || "bottom" === c.y && h <= f || "center" === c.y && (h < f || h > a.height - f)) && b.splice(g, 1); return { left: b[0][0], top: b[0][1] }
            } b.jquery || (b = a(b)); var e = (b[0].shape || b.attr("shape")).toLowerCase(), f = (b[0].coords || b.attr("coords")).split(","), q = []; b = a('img[usemap\x3d"#' + b.parent("map").attr("name") +
                '"]'); var h = b.offset(), k = { width: 0, height: 0, offset: { top: 1E10, right: 0, bottom: 0, left: 1E10 } }, l = 0, m = 0; h.left += Math.ceil((b.outerWidth() - b.width()) / 2); h.top += Math.ceil((b.outerHeight() - b.height()) / 2); if ("poly" === e) for (l = f.length; l--;)m = [parseInt(f[--l], 10), parseInt(f[l + 1], 10)], m[0] > k.offset.right && (k.offset.right = m[0]), m[0] < k.offset.left && (k.offset.left = m[0]), m[1] > k.offset.bottom && (k.offset.bottom = m[1]), m[1] < k.offset.top && (k.offset.top = m[1]), q.push(m); else q = a.map(f, function (a) { return parseInt(a, 10) });
            switch (e) {
                case "rect": k = { width: Math.abs(q[2] - q[0]), height: Math.abs(q[3] - q[1]), offset: { left: Math.min(q[0], q[2]), top: Math.min(q[1], q[3]) } }; break; case "circle": k = { width: q[2] + 2, height: q[2] + 2, offset: { left: q[0], top: q[1] } }; break; case "poly": a.extend(k, { width: Math.abs(k.offset.right - k.offset.left), height: Math.abs(k.offset.bottom - k.offset.top) }), "centercenter" === c.string() ? k.offset = { left: k.offset.left + k.width / 2, top: k.offset.top + k.height / 2 } : (k.offset = d(k, q.slice(), c), !g || "flip" !== g[0] && "flip" !== g[1] || (k.flipoffset =
                    d(k, q.slice(), { x: "left" === c.x ? "right" : "right" === c.x ? "left" : "center", y: "top" === c.y ? "bottom" : "bottom" === c.y ? "top" : "center" }), k.flipoffset.left -= k.offset.left, k.flipoffset.top -= k.offset.top)), k.width = k.height = 0
            }k.offset.left += h.left; k.offset.top += h.top; return k
        }; y.tip = function (a) { var b = a.plugins.tip; return "object" === typeof b ? b : a.plugins.tip = new f(a) }; y.tip.initialize = "render"; y.tip.sanitize = function (a) {
            var b = a.style; b && "tip" in b && (b = a.style.tip, "object" !== typeof b && (a.style.tip = { corner: b }), /string|boolean/i.test(typeof b.corner) ||
                (b.corner = r), "number" !== typeof b.width && delete b.width, "number" !== typeof b.height && delete b.height, "number" !== typeof b.border && b.border !== r && delete b.border, "number" !== typeof b.offset && delete b.offset)
        }; a.extend(r, v.defaults, { style: { tip: { corner: r, mimic: z, width: 6, height: 6, border: r, offset: 0 } } }); y.svg = function (b, c) {
            var g = a(document), d = b[0], e = { width: 0, height: 0, offset: { top: 1E10, left: 1E10 } }, f, q, h; if (d.getBBox && d.parentNode) {
                f = d.getBBox(); q = d.getScreenCTM(); d = d.farthestViewportElement || d; if (!d.createSVGPoint) return e;
                d = d.createSVGPoint(); d.x = f.x; d.y = f.y; h = d.matrixTransform(q); e.offset.left = h.x; e.offset.top = h.y; d.x += f.width; d.y += f.height; h = d.matrixTransform(q); e.width = h.x - e.offset.left; e.height = h.y - e.offset.top; e.offset.left += g.scrollLeft(); e.offset.top += g.scrollTop()
            } return e
        }; y.modal = function (a) { var b = a.plugins.modal; return "object" === typeof b ? b : a.plugins.modal = new m(a) }; y.modal.initialize = "render"; y.modal.sanitize = function (a) {
            a.show && ("object" !== typeof a.show.modal ? a.show.modal = { on: !!a.show.modal } : "undefined" ===
                typeof a.show.modal.on && (a.show.modal.on = r))
        }; y.modal.zindex = v.zindex + 1E3; a.extend(r, v.defaults, { show: { modal: { on: z, effect: r, blur: r, escape: r } } }); y.bgiframe = function (b) { var c = a.browser, g = b.plugins.bgiframe; return 1 > a("select, object").length || !c.msie || "6" !== ("" + c.version).charAt(0) ? z : "object" === typeof g ? g : b.plugins.bgiframe = new k(b) }; y.bgiframe.initialize = "render"
});
(function (a) {
    a.widget("ui.grid", {
        options: { exportData: !0, paginate: !0, title: "", noRowText: "Nenhum registro encontrado", queryString: "", url: "", simple: !1, searchType: "client", order: "", orderProperty: "", orderType: "", page: "", resultsPerPage: "", checkOnlyOne: !1, canCheckLines: !0, buttons: [] }, _init: function () { this._buildGridColumnCollapser(); this._populate() }, _create: function () {
            this._buildGridToolbar(); this._buildGridColumnSortable(); "server" == this.options.searchType ? this._buildGridServerSearch() : this._buildGridQuickSearch();
            this.options.exportData && this._buildGridExportation(); this.options.paginate && this._buildGridPagination(); this._buildGridCheckAll()
        }, _hoverRows: function () {
            var l = this; a("table:first \x3e tbody \x3e tr:visible", l.element).hover(function () { a(this).addClass("ui-grid-hover-row") }, function () { a(this).removeClass("ui-grid-hover-row") }).click(function () {
                l.options.canCheckLines && (a(this).hasClass("ui-state-highlight") ? (a(this).removeClass("ui-state-highlight"), a("input:checkbox", this).prop("checked", !1)) : (l.options.checkOnlyOne &&
                    l._cleanAllChecked(), a(this).addClass("ui-state-highlight"), a("input:checkbox", this).prop("checked", !0)))
            })
        }, _stripRows: function () { a("table:first \x3e tbody \x3e tr:visible", this.element).each(function (l) { a(this).removeClass("ui-grid-row-odd ui-grid-row-even"); 0 == l % 2 ? a(this).addClass("ui-grid-row-odd ") : a(this).addClass("ui-grid-row-even") }) }, _cleanAllChecked: function () { a(".ui-grid-id", this.element).prop("checked", !1).parent().parent().removeClass("ui-state-highlight") }, _loading: function (l) {
            l ? a(".ui-grid-pagination-reload",
                this.gridPagination).show() : a(".ui-grid-pagination-reload", this.gridPagination).hide()
        }, _populate: function () {
            this._hoverRows(); if (this.populate) {
                var l = "page\x3d" + a(".ui-grid-pagination-input-count", this.element).val() + "\x26resultsPerPage\x3d" + a(".ui-grid-pagination-select-results", this.element).val() + ("" != this.options.order ? "\x26order\x3d" + this.options.order : "") + ("" != this.options.orderProperty ? "\x26orderProperty\x3d" + this.options.orderProperty : "") + ("" != this.options.orderType ? "\x26orderType\x3d" + this.options.orderType :
                    ""); this.options.paginate || (l = "refresh\x3d1"); window.location = this.options.url + "?" + l + this.options.queryString
            } else this.populate = !0
        }, _buildGridColumnSortable: function () {
            var l = this; a("table:first \x3e thead \x3e tr \x3e th.ui-grid-header-sortable", l.element).each(function () {
                var e = a(this); e.click(function () {
                    var a = "asc"; e.hasClass("ui-grid-header-sortable-asc") ? a = "desc" : e.hasClass("ui-grid-header-sortable-desc") && (a = "asc"); window.location = l.options.url + "?order\x3dtrue\x26orderProperty\x3d" + e.attr("data-name") +
                        "\x26orderType\x3d" + a + l.options.queryString
                })
            })
        }, _buildGridColumnCollapser: function () { a("table:first \x3e tbody \x3e tr \x3e td.ui-grid-colapsable", this.element).each(function () { var l = a(this); l.qtip({ overwrite: !0, content: { text: a("div", l).html() }, position: { my: "top center", at: "bottom center", viewport: a(window) }, show: { event: "click", ready: !1 }, hide: { event: "unfocus" }, style: { widget: !0 } }) }) }, _buildGridToolbar: function () {
            var l = this; a.each(l.options.buttons, function (e, h) {
                if (h.rendered) {
                    var c = a('\x3cbutton class\x3d"ui-app-align-left ui-app-auto-width ui-app-font-size-text ui-app-margin-right-3px" title\x3d"' +
                        h.label + '"\x3e' + h.label + "\x3c/button\x3e").button({ icons: { primary: "ui-icon-" + h.icon } }).click(function () {
                            var d = a("tr.ui-state-highlight", l.element); if (0 == d.size() && ("1" == h.rowsRequiredToExecute || "1..N" == h.rowsRequiredToExecute)) return a(this).state({ type: "error", content: "Escolha pelo menos um registro para executar essa operaÃ§Ã£o" }), !1; if (1 < d.size() && "1" == h.rowsRequiredToExecute) return a(this).state({ type: "error", content: "Escolha apenas 1 registro para executar essa operaÃ§Ã£o" }), !1; var b = ""; 0 < d.size() &&
                                (d.each(function () { b += a("input:checkbox", this).val() + "," }), b = b.substring(0, b.length - 1)); if (!("" != b && "undefined" != b || "1" != h.rowsRequiredToExecute && "1..N" != h.rowsRequiredToExecute)) return a(this).state({ type: "error", content: "Houve algum problema ao coletar sua escolhas para essa operaÃ§Ã£o!!" }), !1; h.confirmBeforeExecute ? a(document.createElement("div")).attr("title", "ConfirmaÃ§Ã£o de operaÃ§Ã£o").html(h.confirmBeforeExecuteText).dialog({
                                    modal: !0, position: "" == h.sameWindowPosition || void 0 == h.sameWindowPosition ?
                                        "top" : h.sameWindowPosition, width: 300, height: 150, open: function (b, c) { var d = a(this)[0], e = d ? d.parentElement : null; e ? e.scrollIntoView(!0) : d && d.scrollIntoView(!0) }, close: function (b, c) { a(this).dialog("destroy") }, buttons: { Ok: function () { a(this).dialog("destroy"); l._executeToolbarOperation(c, h, b) }, Cancelar: function () { a(this).dialog("destroy") } }
                                }) : l._executeToolbarOperation(c, h, b)
                        }); "0" == h.rowsRequiredToExecute ? a(".ui-grid-no-row-required-bar", l.element).append(c) : "1..N" == h.rowsRequiredToExecute && a(".ui-grid-multiple-row-required-bar",
                            l.element).append(c)
                }
            })
        }, _executeToolbarOperation: function (l, e, h) {
            var c = this, d = e.url + ("" != h ? "?ids\x3d" + h : ""); if (-1 != e.url.indexOf("javascript")) d = "", "1" == e.rowsRequiredToExecute ? d = h : "1..N" == e.rowsRequiredToExecute && (d = "[" + h + "]"), window.location = e.url.replace("ids", "" != h ? d : ""); else if (e.sameWindow) if (e.ajax) a.ajax({
                type: "POST", url: d, success: function (a) { e.reloadAfterExecute ? window.location.reload() : (l.state({ type: "info", content: "Operaï¿½ï¿½o executada com sucesso" }), c._cleanAllChecked()) }, error: function () {
                    l.state({
                        type: "error",
                        content: "Houve algum problema a executar essa operaï¿½ï¿½o"
                    })
                }
            }); else {
                var b = a(document.createElement("iframe")).addClass("ui-grid-iframe"); a(document.createElement("div")).attr("title", e.label).append(b).dialog({
                    modal: !0, position: "" == e.sameWindowPosition || void 0 == e.sameWindowPosition ? "top" : e.sameWindowPosition, width: "" != e.sameWindowWidth ? e.sameWindowWidth : screen.width - 50, height: "" != e.sameWindowHeight ? e.sameWindowHeight : screen.width - 250, open: function (a, c) {
                        var d = b[0], e = (d = d ? d.parentElement : null) ? d.parentElement :
                            null; e ? e.scrollIntoView(!0) : d && d.scrollIntoView(!0)
                    }, close: function (b, c) { e.reloadAfterExecute ? (a(".ui-ajax-info-loading").fadeIn(), a(".ui-ajax-info-loading \x3e div:eq(0)").html("Aguarde a pÃ¡gina estÃ¡ sendo recarregada..."), window.location.reload()) : a(this).dialog("close") }
                }); b.attr("src", d)
            } else window.location = d
        }, _buildGridCheckAll: function () {
            var l = this; a(".ui-grid-check-all-checkbox", l.element).click(function () {
                a(this).prop("checked") ? a(".ui-grid-id:visible", l.element).prop("checked", !0).parent().parent().addClass("ui-state-highlight") :
                l._cleanAllChecked()
            })
        }, _buildGridPagination: function () {
            var l = this; if (l.options.paginate) {
                var e = a(".ui-grid-pagination-count", l.element), h = a(".ui-grid-pagination-input-count", l.element).keydown(function (c) { 13 == c.which && (1 > a(this).val() ? a(this).val(1) : parseInt(a(this).val()) > parseInt(e.html()) && a(this).val(parseInt(e.html())), a(".ui-grid-pagination-input-count", l.element).val(a(this).val()), l._populate()) }); a(".ui-grid-pagination-select-results", l.element).change(function () {
                    h.val(1); a(".ui-grid-pagination-select-results",
                        l.element).val(a(this).val()); l._populate()
                }); a(".ui-grid-pagination-first", l.element).click(function () { h.val(1); l._populate() }); a(".ui-grid-pagination-prev", l.element).click(function () { var a = parseInt(h.val(), 10) - 1; 1 > a && (a = 1); h.val(a); l._populate() }); a(".ui-grid-pagination-next", l.element).click(function () { var a = parseInt(h.val(), 10) + 1; a > parseInt(e.html(), 10) && (a = parseInt(e.html(), 10)); h.val(a); l._populate() }); a(".ui-grid-pagination-last", l.element).click(function () { h.val(parseInt(e.html(), 10)); l._populate() })
            } a(".ui-grid-pagination-refresh",
                l.element).click(function () { l._populate() })
        }, _buildGridExportation: function () { var l = this; a(".ui-grid-exportation-pdf-export", l.element).click(function () { l._doExport("pdf") }); a(".ui-grid-exportation-csv-export", l.element).click(function () { l._doExport("csv") }); a(".ui-grid-exportation-xml-export", l.element).click(function () { l._doExport("xml") }); a(".ui-grid-exportation-excel-export", l.element).click(function () { l._doExport("excel") }); a(".ui-grid-print", l.element).click(function () { window.print() }) }, _doExport: function (l) {
            a(".ui-grid-exporter-type",
                this.element).val(l); a(".ui-grid-exporter-html", this.element).val(this._getCleanTableHtml()); a(".ui-grid-exporter-form", this.element).submit()
        }, _getCleanTableHtml: function () {
            var l = "\x3ctable width\x3d'100%' cellspacing\x3d'0' cellpadding\x3d'0'\x3e", l = l + ("\x3ccaption\x3e" + this.options.title + "\x3c/caption\x3e"), l = l + "\x3cthead\x3e", l = l + "\x3ctr\x3e"; a("table:first \x3e thead \x3e tr \x3e th:visible", this.element).each(function () {
                l += "\x3cth align\x3d'" + a(this).attr("align") + "'\x3e\x3ccontent\x3e" + a.trim(a(this).text()) +
                "\x3c/content\x3e\x3c/th\x3e"
            }); l += "\x3c/tr\x3e"; l += "\x3c/thead\x3e"; l += "\x3ctbody\x3e"; a("table:first \x3e tbody \x3e tr:visible", this.element).each(function () { l += "\x3ctr\x3e"; a("td:visible", this).each(function () { l = a(this).hasClass("ui-grid-colapsable") ? l + ("\x3ctd align\x3d'" + a(this).attr("align") + "'\x3e\x3c/td\x3e") : l + ("\x3ctd align\x3d'" + a(this).attr("align") + "'\x3e\x3ccontent\x3e" + a.trim(a(this).text()) + "\x3c/content\x3e\x3c/td\x3e") }); l += "\x3c/tr\x3e" }); l += "\x3c/tbody\x3e"; return l += "\x3c/table\x3e"
        },
        _buildGridServerSearch: function () { var l = this; a(".ui-grid-search-input", l.element).keydown(function (e) { 13 == e.keyCode && (l._loading(!0), l._doServerSearch(a(this).val()), l._loading(!1)) }) }, _doServerSearch: function (a) { window.location = this.options.url + "?search\x3dtrue\x26term\x3d" + a }, _buildGridQuickSearch: function () { var l = this; a(".ui-grid-search-input", l.element).keyup(function (e) { l._loading(!0); l._doQuickSearch(a(this).val()); l._loading(!1) }) }, _doQuickSearch: function (l) {
            var e = this; a("table:first \x3e tbody \x3e tr",
                e.element).each(function (h) { e._testResults(l, a(this).html()) || "" == l ? a(this).show() : a(this).hide() }); e._stripRows(); e._cleanAllChecked()
        }, _removeAccents: function (a) { return a = a.replace(/[ï¿½ï¿½ï¿½ï¿½ï¿½ï¿½]/g, "a").replace(/ï¿½/g, "ae").replace(/ï¿½/g, "c").replace(/[ï¿½ï¿½ï¿½ï¿½]/g, "e").replace(/[ï¿½ï¿½ï¿½ï¿½]/g, "i").replace(/ï¿½/g, "n").replace(/[ï¿½ï¿½ï¿½ï¿½ï¿½]/g, "o").replace(/ï¿½/g, "oe").replace(/[ï¿½ï¿½ï¿½ï¿½]/g, "u").replace(/[ï¿½ï¿½]/g, "y") }, _testResults: function (a, e) {
            return RegExp(this._removeAccents(a.toLowerCase()),
                "i").test(this._removeAccents(e.toLowerCase())) ? !0 : !1
        }
    })
})(jQuery);
function iWindow(a, l, e, h, c, d, b, f) {
    d || (d = "Fechar janela"); var m = $(document.createElement("iframe")).addClass("ui-grid-iframe"); $(document.createElement("div")).attr("title", l).append(m).dialog({
        modal: !0, position: "" == b || void 0 == b ? "top" : b, width: "" == h || void 0 == h ? screen.width - 50 : h, height: "" == c || void 0 == c ? screen.height - 250 : c, open: function (a, b) { var c = m[0], d = (c = c ? c.parentElement : null) ? c.parentElement : null; d ? d.scrollIntoView(!0) : c && c.scrollIntoView(!0); "function" == typeof f && f.call() }, close: function (a, b) {
            "function" ==
            typeof e && e.call()
        }, buttons: [{ text: d, click: function () { $(this).dialog("close") } }]
    }); m.attr("src", a)
}
function errorWindow(a, l, e, h, c, d, b) {
    null == l ? $(".ui-message").attr("title", '\x3cspan class\x3d"form-required"\x3eErro\x3c/font\x3e') : $(".ui-message").attr("title", '\x3cspan class\x3d"form-required"\x3e' + l + "\x3c/font\x3e"); $(".ui-message").html(a); $(".ui-message").dialog("option", "position", e); $(".ui-message").dialog({
        position: "" == c || void 0 == c ? "top" : c, buttons: { Ok: function () { $(this).dialog("close") } }, open: function (a, c) {
            if (d) {
                var e = iframe[0], h = (e = e ? e.parentElement : null) ? e.parentElement : null; h ? h.scrollIntoView(!0) :
                    e && e.scrollIntoView(!0)
            } "function" == typeof b && b.call()
        }, close: function (a, b) { "function" == typeof h && h.call() }, modal: !0
    })
}
function infoWindow(a, l, e, h, c) { $(".ui-message").attr("title", "Informação"); $(".ui-message").html(a); $(".ui-message").dialog({ position: "" == e || void 0 == e ? "top" : e, buttons: { Ok: function () { $(this).dialog("close") } }, open: function (a, b) { if (h) { var e = iframe[0], l = (e = e ? e.parentElement : null) ? e.parentElement : null; l ? l.scrollIntoView(!0) : e && e.scrollIntoView(!0) } "function" == typeof c && c.call() }, close: function (a, b) { "function" == typeof l && l.call() }, modal: !0 }) }
function confirmWindow(a, l, e, h, c, d, b, f, m) {
    $(".ui-message").attr("title", a); $(".ui-message").html(l); $(".ui-message").dialog({
        position: "" == b || void 0 == b ? "top" : b, open: function (a, b) { if (f) { var c = iframe[0], d = (c = c ? c.parentElement : null) ? c.parentElement : null; d ? d.scrollIntoView(!0) : c && c.scrollIntoView(!0) } "function" == typeof m && m.call() }, buttons: [{ text: c ? c : "Tenho certeza", click: function () { $(this).dialog("close"); self.location = e; return !0 } }, {
            text: d ? d : "Cancelar", click: function () {
                "function" == typeof h && h.call();
                $(this).dialog("close"); return !1
            }
        }], modal: !0
    })
} (function (a) { var l = { completeLeftSideWithZero: function (a, h) { h += ""; if (h.length == a) return h; for (; h.length < a;)h = "0" + h; return h }, formatDate: function (e, h, c) { return a.datepicker.formatDate(h, a.datepicker.parseDate(e, c)) } }; a.fn.util = function (e) { if (l[e]) return l[e].apply(this, Array.prototype.slice.call(arguments, 1)); if ("object" !== typeof e && e) a.error("Method " + e + " does not exist on jQuery.util"); else return l.init.apply(this, arguments) } })(jQuery);
(function (a) { a.widget("ui.postIt", { options: {}, _create: function () { var l = this.element; a(".ui-post-it-button", l).click(function () { var e = a(".ui-post-it-content", l); e.is(":visible") ? e.fadeOut() : e.fadeIn() }) } }) })(jQuery);
(function (a) {
    a.widget("ui.recursiveComboBox", {
        options: { url: "", afterForward: function () { } }, _create: function () {
            var l = this; l.levels = []; l.levelsIterator = 0; l.breadCrumb = []; l.breadCrumbIterator = 0; l.hidden = a(".ui-recursive-combobox-hidden", l.element); l.select = a(".ui-recursive-combobox-select", l.element); l.back = a(".ui-recursive-combobox-back", l.element); l.next = a(".ui-recursive-combobox-next", l.element); l.clear = a(".ui-recursive-combobox-clear", l.element); l.text = a(".ui-recursive-combobox-text", l.element); l.clear.button({
                icons: { primary: "ui-icon-trash" },
                text: !1
            }).bind("click.recursiveComboBox", function () { l.select.val(""); l.hidden.val(""); l.text.html(""); l.breadCrumb = []; l.breadCrumbIterator = 0; l.levelsIterator = 0; l.select.html(""); var e = l.levels[l.levelsIterator]; for (i = 0; i < e.length; i++) { var c = a(document.createElement("option")).attr("value", e[i].value).text(e[i].text); l.select.append(c) } }); l.select.bind("change.recursiveComboBox", function () {
                l.back.button("enable"); l.next.button("enable"); var e = a("option:selected", this).text(); "" == a(this).val() && (e =
                    ""); l.breadCrumb[l.breadCrumbIterator] = e; l._refreshBreadCrumb(); l.hidden.val(a(this).val())
            }); var e = []; a(".ui-recursive-combobox-select \x3e option", l.element).each(function () { var h = a(this).val(), c = a(this).text(); e.push({ value: h, text: c }) }); l.levels[l.levelsIterator] = e; l.back.button({ icons: { primary: "ui-icon-arrowthick-1-w" }, text: !1 }).bind("click.recursiveComboBox", function () {
                l.next.button("enable"); 0 < l.levelsIterator ? (l.levelsIterator--, l.breadCrumbIterator--, l.breadCrumb.pop(), l._refreshBreadCrumb()) :
                    l.back.button("disable"); l.select.html(""); var e = l.levels[l.levelsIterator]; for (i = 0; i < e.length; i++) { var c = a(document.createElement("option")).attr("value", e[i].value).text(e[i].text); l.select.append(c) }
            }); l.next.button({ icons: { primary: "ui-icon-arrowthick-1-e" }, text: !1 }).bind("click.recursiveComboBox", function () {
                l.back.button("enable"); var e = l.select.val(); "" != e && a.ajax({
                    url: l.options.url, dataType: "json", type: "post", data: { root: e }, success: function (c) {
                        if (0 < c.length) {
                            l.next.button("enable"); l._refreshBreadCrumb();
                            l.breadCrumbIterator++; l.levelsIterator++; l.select.html(""); var d = []; d.push({ value: "", text: "- - -" }); l.select.append(a(document.createElement("option")).attr("value", "").text("- - -")); for (i = 0; i < c.length; i++) { d.push({ value: c[i].value, text: c[i].text }); var b = a(document.createElement("option")).attr("value", c[i].value).text(c[i].text); l.select.append(b) } l.levels[l.levelsIterator] = d
                        } else l.next.button("disable"); l.options.afterForward.call()
                    }
                })
            })
        }, destroy: function () {
            this.select.unbind(".recursiveComboBox");
            this.back.unbind(".recursiveComboBox"); this.next.unbind(".recursiveComboBox"); this.back.button("destroy"); this.next.button("destroy"); this.text.html(""); this.select.val(""); this.hidden.val(""); this.levels = []; this.levelsIterator = 0; this.breadCrumb = []; this.breadCrumbIterator = 0; a.Widget.prototype.destroy.apply(this, arguments)
        }, fill: function (l) {
            this.select.html(""); this.select.append(a(document.createElement("option")).attr("value", "").text("- - -")); for (i = 0; i < l.length; i++) {
                var e = a(document.createElement("option")).attr("value",
                    l[i].value).text(l[i].text); this.select.append(e)
            }
        }, root: function () { return this.levels[0] }, _refreshBreadCrumb: function () { var a = ""; for (i = 0; i < this.breadCrumb.length; i++)a += this.breadCrumb[i] + (i + 1 != this.breadCrumb.length ? " - " : ""); this.text.html(a) }
    })
})(jQuery);
(function (a) { "function" === typeof define && define.amd ? define(["jquery"], a) : "undefined" !== typeof module && module.exports ? module.exports = a(require("jquery")) : a(jQuery) })(function (a, l) {
    var e = 0, h = !1, c = !1, d = !1, b = [], f = a("script:last").attr("src"), m = window.document, k = m.createElement("LI"), r, z; k.setAttribute("role", "treeitem"); r = m.createElement("I"); r.className = "jstree-icon jstree-ocl"; r.setAttribute("role", "presentation"); k.appendChild(r); r = m.createElement("A"); r.className = "jstree-anchor"; r.setAttribute("href",
        "#"); r.setAttribute("tabindex", "-1"); z = m.createElement("I"); z.className = "jstree-icon jstree-themeicon"; z.setAttribute("role", "presentation"); r.appendChild(z); k.appendChild(r); r = z = null; a.jstree = { version: "3.2.0", defaults: { plugins: [] }, plugins: {}, path: f && -1 !== f.indexOf("/") ? f.replace(/\/[^\/]+$/, "") : "", idregex: /[\\:&!^|()\[\]<>@*'+~#";.,=\- \/${}%?`]/g, root: "#" }; a.jstree.create = function (b, c) {
            var d = new a.jstree.core(++e), f = c; c = a.extend(!0, {}, a.jstree.defaults, c); f && f.plugins && (c.plugins = f.plugins); a.each(c.plugins,
                function (a, b) { "core" !== a && (d = d.plugin(b, c[b])) }); a(b).data("jstree", d); d.init(b, c); return d
        }; a.jstree.destroy = function () { a(".jstree:jstree").jstree("destroy"); a(m).off(".jstree") }; a.jstree.core = function (a) { this._id = a; this._cnt = 0; this._wrk = null; this._data = { core: { themes: { name: !1, dots: !1, icons: !1 }, selected: [], last_error: {}, working: !1, worker_queue: [], focused: null } } }; a.jstree.reference = function (b) {
            var c = null, d = null; !b || !b.id || b.tagName && b.nodeType || (b = b.id); if (!d || !d.length) try { d = a(b) } catch (e) { } if (!d ||
                !d.length) try { d = a("#" + b.replace(a.jstree.idregex, "\\$\x26")) } catch (f) { } d && d.length && (d = d.closest(".jstree")).length && (d = d.data("jstree")) ? c = d : a(".jstree").each(function () { var d = a(this).data("jstree"); if (d && d._model.data[b]) return c = d, !1 }); return c
        }; a.fn.jstree = function (b) {
            var c = "string" === typeof b, d = Array.prototype.slice.call(arguments, 1), e = null; if (!0 === b && !this.length) return !1; this.each(function () {
                var f = a.jstree.reference(this), h = c && f ? f[b] : null; e = c && h ? h.apply(f, d) : null; f || c || b !== l && !a.isPlainObject(b) ||
                    a.jstree.create(this, b); if (f && !c || !0 === b) e = f || !1; if (null !== e && e !== l) return !1
            }); return null !== e && e !== l ? e : this
        }; a.expr[":"].jstree = a.expr.createPseudo(function (b) { return function (b) { return a(b).hasClass("jstree") && a(b).data("jstree") !== l } }); a.jstree.defaults.core = { data: !1, strings: !1, check_callback: !1, error: a.noop, animation: 200, multiple: !0, themes: { name: !1, url: !1, dir: !1, dots: !0, icons: !0, stripes: !1, variant: !1, responsive: !1 }, expand_selected_onload: !0, worker: !0, force_text: !1, dblclick_toggle: !0 }; a.jstree.core.prototype =
        {
            plugin: function (b, c) { var d = a.jstree.plugins[b]; return d ? (this._data[b] = {}, d.prototype = this, new d(c, this)) : this }, init: function (b, c) {
                this._model = { data: {}, changed: [], force_full_redraw: !1, redraw_timeout: !1, default_state: { loaded: !0, opened: !1, selected: !1, disabled: !1 } }; this._model.data[a.jstree.root] = { id: a.jstree.root, parent: null, parents: [], children: [], children_d: [], state: { loaded: !1 } }; this.element = a(b).addClass("jstree jstree-" + this._id); this.settings = c; this._data.core.ready = !1; this._data.core.loaded = !1;
                this._data.core.rtl = "rtl" === this.element.css("direction"); this.element[this._data.core.rtl ? "addClass" : "removeClass"]("jstree-rtl"); this.element.attr("role", "tree"); this.settings.core.multiple && this.element.attr("aria-multiselectable", !0); this.element.attr("tabindex") || this.element.attr("tabindex", "0"); this.bind(); this.trigger("init"); this._data.core.original_container_html = this.element.find(" \x3e ul \x3e li").clone(!0); this._data.core.original_container_html.find("li").addBack().contents().filter(function () {
                    return 3 ===
                        this.nodeType && (!this.nodeValue || /^\s+$/.test(this.nodeValue))
                }).remove(); this.element.html("\x3cul class\x3d'jstree-container-ul jstree-children' role\x3d'group'\x3e\x3cli id\x3d'j" + this._id + "_loading' class\x3d'jstree-initial-node jstree-loading jstree-leaf jstree-last' role\x3d'tree-item'\x3e\x3ci class\x3d'jstree-icon jstree-ocl'\x3e\x3c/i\x3e\x3ca class\x3d'jstree-anchor' href\x3d'#'\x3e\x3ci class\x3d'jstree-icon jstree-themeicon-hidden'\x3e\x3c/i\x3e" + this.get_string("Loading ...") + "\x3c/a\x3e\x3c/li\x3e\x3c/ul\x3e");
                this.element.attr("aria-activedescendant", "j" + this._id + "_loading"); this._data.core.li_height = this.get_container_ul().children("li").first().height() || 24; this.trigger("loading"); this.load_node(a.jstree.root)
            }, destroy: function (a) { if (this._wrk) try { window.URL.revokeObjectURL(this._wrk), this._wrk = null } catch (b) { } a || this.element.empty(); this.teardown() }, teardown: function () {
                this.unbind(); this.element.removeClass("jstree").removeData("jstree").find("[class^\x3d'jstree']").addBack().attr("class", function () {
                    return this.className.replace(/jstree[^ ]*|$/ig,
                        "")
                }); this.element = null
            }, bind: function () {
                var b = "", c = null, d = 0; this.element.on("dblclick.jstree", function (a) { if (a.target.tagName && "input" === a.target.tagName.toLowerCase()) return !0; if (m.selection && m.selection.empty) m.selection.empty(); else if (window.getSelection) { a = window.getSelection(); try { a.removeAllRanges(), a.collapse() } catch (b) { } } }).on("mousedown.jstree", a.proxy(function (a) { a.target === this.element[0] && (a.preventDefault(), d = +new Date) }, this)).on("mousedown.jstree", ".jstree-ocl", function (a) { a.preventDefault() }).on("click.jstree",
                    ".jstree-ocl", a.proxy(function (a) { this.toggle_node(a.target) }, this)).on("dblclick.jstree", ".jstree-anchor", a.proxy(function (a) { if (a.target.tagName && "input" === a.target.tagName.toLowerCase()) return !0; this.settings.core.dblclick_toggle && this.toggle_node(a.target) }, this)).on("click.jstree", ".jstree-anchor", a.proxy(function (b) { b.preventDefault(); b.currentTarget !== m.activeElement && a(b.currentTarget).focus(); this.activate_node(b.currentTarget, b) }, this)).on("keydown.jstree", ".jstree-anchor", a.proxy(function (b) {
                        if (b.target.tagName &&
                            "input" === b.target.tagName.toLowerCase() || 32 !== b.which && 13 !== b.which && (b.shiftKey || b.ctrlKey || b.altKey || b.metaKey)) return !0; var c = null; this._data.core.rtl && (37 === b.which ? b.which = 39 : 39 === b.which && (b.which = 37)); switch (b.which) {
                                case 32: b.ctrlKey && (b.type = "click", a(b.currentTarget).trigger(b)); break; case 13: b.type = "click"; a(b.currentTarget).trigger(b); break; case 37: b.preventDefault(); this.is_open(b.currentTarget) ? this.close_node(b.currentTarget) : (c = this.get_parent(b.currentTarget)) && c.id !== a.jstree.root &&
                                    this.get_node(c, !0).children(".jstree-anchor").focus(); break; case 38: b.preventDefault(); (c = this.get_prev_dom(b.currentTarget)) && c.length && c.children(".jstree-anchor").focus(); break; case 39: b.preventDefault(); this.is_closed(b.currentTarget) ? this.open_node(b.currentTarget, function (a) { this.get_node(a, !0).children(".jstree-anchor").focus() }) : this.is_open(b.currentTarget) && (c = this.get_node(b.currentTarget, !0).children(".jstree-children")[0]) && a(this._firstChild(c)).children(".jstree-anchor").focus(); break;
                                case 40: b.preventDefault(); (c = this.get_next_dom(b.currentTarget)) && c.length && c.children(".jstree-anchor").focus(); break; case 106: this.open_all(); break; case 36: b.preventDefault(); (c = this._firstChild(this.get_container_ul()[0])) && a(c).children(".jstree-anchor").filter(":visible").focus(); break; case 35: b.preventDefault(), this.element.find(".jstree-anchor").filter(":visible").last().focus()
                            }
                    }, this)).on("load_node.jstree", a.proxy(function (b, c) {
                        c.status && (c.node.id !== a.jstree.root || this._data.core.loaded ||
                            (this._data.core.loaded = !0, this._firstChild(this.get_container_ul()[0]) && this.element.attr("aria-activedescendant", this._firstChild(this.get_container_ul()[0]).id), this.trigger("loaded")), this._data.core.ready || setTimeout(a.proxy(function () {
                                if (this.element && !this.get_container_ul().find(".jstree-loading").length) {
                                    this._data.core.ready = !0; if (this._data.core.selected.length) {
                                        if (this.settings.core.expand_selected_onload) {
                                            var b = [], c, g; c = 0; for (g = this._data.core.selected.length; c < g; c++)b = b.concat(this._model.data[this._data.core.selected[c]].parents);
                                            b = a.vakata.array_unique(b); c = 0; for (g = b.length; c < g; c++)this.open_node(b[c], !1, 0)
                                        } this.trigger("changed", { action: "ready", selected: this._data.core.selected })
                                    } this.trigger("ready")
                                }
                            }, this), 0))
                    }, this)).on("keypress.jstree", a.proxy(function (d) {
                        if (d.target.tagName && "input" === d.target.tagName.toLowerCase()) return !0; c && clearTimeout(c); c = setTimeout(function () { b = "" }, 500); var e = String.fromCharCode(d.which).toLowerCase(); d = this.element.find(".jstree-anchor").filter(":visible"); var f = d.index(m.activeElement) ||
                            0, q = !1; b += e; if (1 < b.length) { d.slice(f).each(a.proxy(function (c, d) { if (0 === a(d).text().toLowerCase().indexOf(b)) return a(d).focus(), q = !0, !1 }, this)); if (q) return; d.slice(0, f).each(a.proxy(function (c, d) { if (0 === a(d).text().toLowerCase().indexOf(b)) return a(d).focus(), q = !0, !1 }, this)); if (q) return } RegExp("^" + e.replace(/[-\/\\^$*+?.()|[\]{}]/g, "\\$\x26") + "+$").test(b) && (d.slice(f + 1).each(a.proxy(function (b, c) { if (a(c).text().toLowerCase().charAt(0) === e) return a(c).focus(), q = !0, !1 }, this)), q || d.slice(0, f + 1).each(a.proxy(function (b,
                                c) { if (a(c).text().toLowerCase().charAt(0) === e) return a(c).focus(), q = !0, !1 }, this)))
                    }, this)).on("init.jstree", a.proxy(function () { var a = this.settings.core.themes; this._data.core.themes.dots = a.dots; this._data.core.themes.stripes = a.stripes; this._data.core.themes.icons = a.icons; this.set_theme(a.name || "default", a.url); this.set_theme_variant(a.variant) }, this)).on("loading.jstree", a.proxy(function () {
                        this[this._data.core.themes.dots ? "show_dots" : "hide_dots"](); this[this._data.core.themes.icons ? "show_icons" : "hide_icons"]();
                        this[this._data.core.themes.stripes ? "show_stripes" : "hide_stripes"]()
                    }, this)).on("blur.jstree", ".jstree-anchor", a.proxy(function (b) { this._data.core.focused = null; a(b.currentTarget).filter(".jstree-hovered").mouseleave(); this.element.attr("tabindex", "0") }, this)).on("focus.jstree", ".jstree-anchor", a.proxy(function (b) {
                        var c = this.get_node(b.currentTarget); c && c.id && (this._data.core.focused = c.id); this.element.find(".jstree-hovered").not(b.currentTarget).mouseleave(); a(b.currentTarget).mouseenter(); this.element.attr("tabindex",
                            "-1")
                    }, this)).on("focus.jstree", a.proxy(function () { if (500 < +new Date - d && !this._data.core.focused) { d = 0; var a = this.get_node(this.element.attr("aria-activedescendant"), !0); a && a.find("\x3e .jstree-anchor").focus() } }, this)).on("mouseenter.jstree", ".jstree-anchor", a.proxy(function (a) { this.hover_node(a.currentTarget) }, this)).on("mouseleave.jstree", ".jstree-anchor", a.proxy(function (a) { this.dehover_node(a.currentTarget) }, this))
            }, unbind: function () { this.element.off(".jstree"); a(m).off(".jstree-" + this._id) }, trigger: function (a,
                b) { b || (b = {}); b.instance = this; this.element.triggerHandler(a.replace(".jstree", "") + ".jstree", b) }, get_container: function () { return this.element }, get_container_ul: function () { return this.element.children(".jstree-children").first() }, get_string: function (b) { var c = this.settings.core.strings; return a.isFunction(c) ? c.call(this, b) : c && c[b] ? c[b] : b }, _firstChild: function (a) { for (a = a ? a.firstChild : null; null !== a && 1 !== a.nodeType;)a = a.nextSibling; return a }, _nextSibling: function (a) {
                    for (a = a ? a.nextSibling : null; null !== a &&
                        1 !== a.nodeType;)a = a.nextSibling; return a
                }, _previousSibling: function (a) { for (a = a ? a.previousSibling : null; null !== a && 1 !== a.nodeType;)a = a.previousSibling; return a }, get_node: function (b, c) {
                    b && b.id && (b = b.id); var d; try {
                        if (this._model.data[b]) b = this._model.data[b]; else if ("string" === typeof b && this._model.data[b.replace(/^#/, "")]) b = this._model.data[b.replace(/^#/, "")]; else if ("string" === typeof b && (d = a("#" + b.replace(a.jstree.idregex, "\\$\x26"), this.element)).length && this._model.data[d.closest(".jstree-node").attr("id")]) b =
                            this._model.data[d.closest(".jstree-node").attr("id")]; else if ((d = a(b, this.element)).length && this._model.data[d.closest(".jstree-node").attr("id")]) b = this._model.data[d.closest(".jstree-node").attr("id")]; else if ((d = a(b, this.element)).length && d.hasClass("jstree")) b = this._model.data[a.jstree.root]; else return !1; c && (b = b.id === a.jstree.root ? this.element : a("#" + b.id.replace(a.jstree.idregex, "\\$\x26"), this.element)); return b
                    } catch (e) { return !1 }
                }, get_path: function (b, c, d) {
                    b = b.parents ? b : this.get_node(b); if (!b ||
                        b.id === a.jstree.root || !b.parents) return !1; var e, f, h = []; h.push(d ? b.id : b.text); e = 0; for (f = b.parents.length; e < f; e++)h.push(d ? b.parents[e] : this.get_text(b.parents[e])); h = h.reverse().slice(1); return c ? h.join(c) : h
                }, get_next_dom: function (b, c) {
                    var d; b = this.get_node(b, !0); if (b[0] === this.element[0]) { for (d = this._firstChild(this.get_container_ul()[0]); d && 0 === d.offsetHeight;)d = this._nextSibling(d); return d ? a(d) : !1 } if (!b || !b.length) return !1; if (c) {
                        d = b[0]; do d = this._nextSibling(d); while (d && 0 === d.offsetHeight); return d ?
                            a(d) : !1
                    } if (b.hasClass("jstree-open")) { for (d = this._firstChild(b.children(".jstree-children")[0]); d && 0 === d.offsetHeight;)d = this._nextSibling(d); if (null !== d) return a(d) } d = b[0]; do d = this._nextSibling(d); while (d && 0 === d.offsetHeight); return null !== d ? a(d) : b.parentsUntil(".jstree", ".jstree-node").nextAll(".jstree-node:visible").first()
                }, get_prev_dom: function (b, c) {
                    var d; b = this.get_node(b, !0); if (b[0] === this.element[0]) {
                        for (d = this.get_container_ul()[0].lastChild; d && 0 === d.offsetHeight;)d = this._previousSibling(d);
                        return d ? a(d) : !1
                    } if (!b || !b.length) return !1; if (c) { d = b[0]; do d = this._previousSibling(d); while (d && 0 === d.offsetHeight); return d ? a(d) : !1 } d = b[0]; do d = this._previousSibling(d); while (d && 0 === d.offsetHeight); if (null !== d) { for (b = a(d); b.hasClass("jstree-open");)b = b.children(".jstree-children").first().children(".jstree-node:visible:last"); return b } return (d = b[0].parentNode.parentNode) && d.className && -1 !== d.className.indexOf("jstree-node") ? a(d) : !1
                }, get_parent: function (b) {
                    return (b = this.get_node(b)) && b.id !== a.jstree.root ?
                        b.parent : !1
                }, get_children_dom: function (a) { a = this.get_node(a, !0); return a[0] === this.element[0] ? this.get_container_ul().children(".jstree-node") : a && a.length ? a.children(".jstree-children").children(".jstree-node") : !1 }, is_parent: function (a) { return (a = this.get_node(a)) && (!1 === a.state.loaded || 0 < a.children.length) }, is_loaded: function (a) { return (a = this.get_node(a)) && a.state.loaded }, is_loading: function (a) { return (a = this.get_node(a)) && a.state && a.state.loading }, is_open: function (a) { return (a = this.get_node(a)) && a.state.opened },
            is_closed: function (a) { return (a = this.get_node(a)) && this.is_parent(a) && !a.state.opened }, is_leaf: function (a) { return !this.is_parent(a) }, load_node: function (b, c) {
                var d, e, f, h, k; if (a.isArray(b)) return this._load_nodes(b.slice(), c), !0; b = this.get_node(b); if (!b) return c && c.call(this, b, !1), !1; if (b.state.loaded) {
                    b.state.loaded = !1; d = 0; for (e = b.children_d.length; d < e; d++) {
                        f = 0; for (h = b.parents.length; f < h; f++)this._model.data[b.parents[f]].children_d = a.vakata.array_remove_item(this._model.data[b.parents[f]].children_d,
                            b.children_d[d]); this._model.data[b.children_d[d]].state.selected && (k = !0, this._data.core.selected = a.vakata.array_remove_item(this._data.core.selected, b.children_d[d])); delete this._model.data[b.children_d[d]]
                    } b.children = []; b.children_d = []; k && this.trigger("changed", { action: "load_node", node: b, selected: this._data.core.selected })
                } b.state.failed = !1; b.state.loading = !0; this.get_node(b, !0).addClass("jstree-loading").attr("aria-busy", !0); this._load_node(b, a.proxy(function (a) {
                    b = this._model.data[b.id]; b.state.loading =
                        !1; b.state.loaded = a; b.state.failed = !b.state.loaded; for (var d = this.get_node(b, !0), e = 0, f = 0, q = this._model.data, h = !1, e = 0, f = b.children.length; e < f; e++)if (q[b.children[e]] && !q[b.children[e]].state.hidden) { h = !0; break } b.state.loaded && !h && d && d.length && !d.hasClass("jstree-leaf") && d.removeClass("jstree-closed jstree-open").addClass("jstree-leaf"); d.removeClass("jstree-loading").attr("aria-busy", !1); this.trigger("load_node", { node: b, status: a }); c && c.call(this, b, a)
                }, this)); return !0
            }, _load_nodes: function (a, b, c) {
                var d =
                    !0, e = function () { this._load_nodes(a, b, !0) }, f = this._model.data, h, k, l = []; h = 0; for (k = a.length; h < k; h++)!f[a[h]] || (f[a[h]].state.loaded || f[a[h]].state.failed) && c || (this.is_loading(a[h]) || this.load_node(a[h], e), d = !1); if (d) { h = 0; for (k = a.length; h < k; h++)f[a[h]] && f[a[h]].state.loaded && l.push(a[h]); b && !b.done && (b.call(this, l), b.done = !0) }
            }, load_all: function (b, c) {
                b || (b = a.jstree.root); b = this.get_node(b); if (!b) return !1; var d = [], e = this._model.data, f = e[b.id].children_d, h, k; b.state && !b.state.loaded && d.push(b.id); h = 0;
                for (k = f.length; h < k; h++)e[f[h]] && e[f[h]].state && !e[f[h]].state.loaded && d.push(f[h]); d.length ? this._load_nodes(d, function () { this.load_all(b, c) }) : (c && c.call(this, b), this.trigger("load_all", { node: b }))
            }, _load_node: function (b, c) {
                var d = this.settings.core.data; if (!d) return b.id === a.jstree.root ? this._append_html_data(b, this._data.core.original_container_html.clone(!0), function (a) { c.call(this, a) }) : c.call(this, !1); if (a.isFunction(d)) return d.call(this, b, a.proxy(function (d) {
                    !1 === d && c.call(this, !1); this["string" ===
                        typeof d ? "_append_html_data" : "_append_json_data"](b, "string" === typeof d ? a(a.parseHTML(d)).filter(function () { return 3 !== this.nodeType }) : d, function (a) { c.call(this, a) })
                }, this)); if ("object" === typeof d) {
                    if (d.url) return d = a.extend(!0, {}, d), a.isFunction(d.url) && (d.url = d.url.call(this, b)), a.isFunction(d.data) && (d.data = d.data.call(this, b)), a.ajax(d).done(a.proxy(function (d, e, f) {
                        if ((e = f.getResponseHeader("Content-Type")) && -1 !== e.indexOf("json") || "object" === typeof d) return this._append_json_data(b, d, function (a) {
                            c.call(this,
                                a)
                        }); if (e && -1 !== e.indexOf("html") || "string" === typeof d) return this._append_html_data(b, a(a.parseHTML(d)).filter(function () { return 3 !== this.nodeType }), function (a) { c.call(this, a) }); this._data.core.last_error = { error: "ajax", plugin: "core", id: "core_04", reason: "Could not load node", data: JSON.stringify({ id: b.id, xhr: f }) }; this.settings.core.error.call(this, this._data.core.last_error); return c.call(this, !1)
                    }, this)).fail(a.proxy(function (a) {
                        c.call(this, !1); this._data.core.last_error = {
                            error: "ajax", plugin: "core",
                            id: "core_04", reason: "Could not load node", data: JSON.stringify({ id: b.id, xhr: a })
                        }; this.settings.core.error.call(this, this._data.core.last_error)
                    }, this)); d = a.isArray(d) || a.isPlainObject(d) ? JSON.parse(JSON.stringify(d)) : d; if (b.id === a.jstree.root) return this._append_json_data(b, d, function (a) { c.call(this, a) }); this._data.core.last_error = { error: "nodata", plugin: "core", id: "core_05", reason: "Could not load node", data: JSON.stringify({ id: b.id }) }; this.settings.core.error.call(this, this._data.core.last_error); return c.call(this,
                        !1)
                } if ("string" === typeof d) { if (b.id === a.jstree.root) return this._append_html_data(b, a(a.parseHTML(d)).filter(function () { return 3 !== this.nodeType }), function (a) { c.call(this, a) }); this._data.core.last_error = { error: "nodata", plugin: "core", id: "core_06", reason: "Could not load node", data: JSON.stringify({ id: b.id }) }; this.settings.core.error.call(this, this._data.core.last_error) } return c.call(this, !1)
            }, _node_changed: function (a) { (a = this.get_node(a)) && this._model.changed.push(a.id) }, _append_html_data: function (b,
                c, d) {
                    b = this.get_node(b); b.children = []; b.children_d = []; c = c.is("ul") ? c.children() : c; var e = b.id, f = [], h = [], k = this._model.data, l = k[e]; b = this._data.core.selected.length; var m, r; c.each(a.proxy(function (b, c) { if (m = this._parse_model_from_html(a(c), e, l.parents.concat())) f.push(m), h.push(m), k[m].children_d.length && (h = h.concat(k[m].children_d)) }, this)); l.children = f; l.children_d = h; c = 0; for (r = l.parents.length; c < r; c++)k[l.parents[c]].children_d = k[l.parents[c]].children_d.concat(h); this.trigger("model", { nodes: h, parent: e });
                e !== a.jstree.root ? (this._node_changed(e), this.redraw()) : (this.get_container_ul().children(".jstree-initial-node").remove(), this.redraw(!0)); this._data.core.selected.length !== b && this.trigger("changed", { action: "model", selected: this._data.core.selected }); d.call(this, !0)
            }, _append_json_data: function (b, c, d, e) {
                if (null !== this.element) {
                    b = this.get_node(b); b.children = []; b.children_d = []; c.d && (c = c.d, "string" === typeof c && (c = JSON.parse(c))); a.isArray(c) || (c = [c]); var f = null, h = {
                        df: this._model.default_state, dat: c,
                        par: b.id, m: this._model.data, t_id: this._id, t_cnt: this._cnt, sel: this._data.core.selected
                    }, k = function (a, b) {
                        a.data && (a = a.data); var c = a.dat, d = a.par, g = [], e = [], f = [], h = a.df, q = a.t_id, k = a.t_cnt, l = a.m, m = l[d], u = a.sel, x, w, A, D = function (a, c, d) {
                            d = d ? d.concat() : []; c && d.unshift(c); var g = a.id.toString(), e, q, k; c = { id: g, text: a.text || "", icon: a.icon !== b ? a.icon : !0, parent: c, parents: d, children: a.children || [], children_d: a.children_d || [], data: a.data, state: {}, li_attr: { id: !1 }, a_attr: { href: "#" }, original: !1 }; for (e in h) h.hasOwnProperty(e) &&
                                (c.state[e] = h[e]); a && a.data && a.data.jstree && a.data.jstree.icon && (c.icon = a.data.jstree.icon); if (c.icon === b || null === c.icon || "" === c.icon) c.icon = !0; if (a && a.data && (c.data = a.data, a.data.jstree)) for (e in a.data.jstree) a.data.jstree.hasOwnProperty(e) && (c.state[e] = a.data.jstree[e]); if (a && "object" === typeof a.state) for (e in a.state) a.state.hasOwnProperty(e) && (c.state[e] = a.state[e]); if (a && "object" === typeof a.li_attr) for (e in a.li_attr) a.li_attr.hasOwnProperty(e) && (c.li_attr[e] = a.li_attr[e]); c.li_attr.id || (c.li_attr.id =
                                    g); if (a && "object" === typeof a.a_attr) for (e in a.a_attr) a.a_attr.hasOwnProperty(e) && (c.a_attr[e] = a.a_attr[e]); a && a.children && !0 === a.children && (c.state.loaded = !1, c.children = [], c.children_d = []); l[c.id] = c; e = 0; for (g = c.children.length; e < g; e++)q = D(l[c.children[e]], c.id, d), k = l[q], c.children_d.push(q), k.children_d.length && (c.children_d = c.children_d.concat(k.children_d)); delete a.data; delete a.children; l[c.id].original = a; c.state.selected && f.push(c.id); return c.id
                        }, r = function (a, c, d) {
                            d = d ? d.concat() : []; c && d.unshift(c);
                            var g = !1, e, m, u; do g = "j" + q + "_" + ++k; while (l[g]); c = { id: !1, text: "string" === typeof a ? a : "", icon: "object" === typeof a && a.icon !== b ? a.icon : !0, parent: c, parents: d, children: [], children_d: [], data: null, state: {}, li_attr: { id: !1 }, a_attr: { href: "#" }, original: !1 }; for (e in h) h.hasOwnProperty(e) && (c.state[e] = h[e]); a && a.id && (c.id = a.id.toString()); a && a.text && (c.text = a.text); a && a.data && a.data.jstree && a.data.jstree.icon && (c.icon = a.data.jstree.icon); if (c.icon === b || null === c.icon || "" === c.icon) c.icon = !0; if (a && a.data && (c.data =
                                a.data, a.data.jstree)) for (e in a.data.jstree) a.data.jstree.hasOwnProperty(e) && (c.state[e] = a.data.jstree[e]); if (a && "object" === typeof a.state) for (e in a.state) a.state.hasOwnProperty(e) && (c.state[e] = a.state[e]); if (a && "object" === typeof a.li_attr) for (e in a.li_attr) a.li_attr.hasOwnProperty(e) && (c.li_attr[e] = a.li_attr[e]); c.li_attr.id && !c.id && (c.id = c.li_attr.id.toString()); c.id || (c.id = g); c.li_attr.id || (c.li_attr.id = c.id); if (a && "object" === typeof a.a_attr) for (e in a.a_attr) a.a_attr.hasOwnProperty(e) && (c.a_attr[e] =
                                    a.a_attr[e]); if (a && a.children && a.children.length) { e = 0; for (g = a.children.length; e < g; e++)m = r(a.children[e], c.id, d), u = l[m], c.children.push(m), u.children_d.length && (c.children_d = c.children_d.concat(u.children_d)); c.children_d = c.children_d.concat(c.children) } a && a.children && !0 === a.children && (c.state.loaded = !1, c.children = [], c.children_d = []); delete a.data; delete a.children; c.original = a; l[c.id] = c; c.state.selected && f.push(c.id); return c.id
                        }; if (c.length && c[0].id !== b && c[0].parent !== b) {
                            w = 0; for (A = c.length; w < A; w++)c[w].children ||
                                (c[w].children = []), l[c[w].id.toString()] = c[w]; w = 0; for (A = c.length; w < A; w++)l[c[w].parent.toString()].children.push(c[w].id.toString()), m.children_d.push(c[w].id.toString()); w = 0; for (A = m.children.length; w < A; w++)x = D(l[m.children[w]], d, m.parents.concat()), e.push(x), l[x].children_d.length && (e = e.concat(l[x].children_d))
                        } else { w = 0; for (A = c.length; w < A; w++)if (x = r(c[w], d, m.parents.concat())) g.push(x), e.push(x), l[x].children_d.length && (e = e.concat(l[x].children_d)); m.children = g; m.children_d = e } w = 0; for (A = m.parents.length; w <
                            A; w++)l[m.parents[w]].children_d = l[m.parents[w]].children_d.concat(e); c = { cnt: k, mod: l, sel: u, par: d, dpc: e, add: f }; if ("undefined" === typeof window || "undefined" === typeof window.document) postMessage(c); else return c
                    }, l = function (b, c) {
                        if (null !== this.element) {
                            this._cnt = b.cnt; this._model.data = b.mod; if (c) {
                                var g, e, f = b.add, h = b.sel, k = this._data.core.selected.slice(), l = this._model.data; if (h.length !== k.length || a.vakata.array_unique(h.concat(k)).length !== h.length) {
                                    g = 0; for (e = h.length; g < e; g++)-1 === a.inArray(h[g], f) &&
                                        -1 === a.inArray(h[g], k) && (l[h[g]].state.selected = !1); g = 0; for (e = k.length; g < e; g++)-1 === a.inArray(k[g], h) && (l[k[g]].state.selected = !0)
                                }
                            } b.add.length && (this._data.core.selected = this._data.core.selected.concat(b.add)); this.trigger("model", { nodes: b.dpc, parent: b.par }); b.par !== a.jstree.root ? (this._node_changed(b.par), this.redraw()) : this.redraw(!0); b.add.length && this.trigger("changed", { action: "model", selected: this._data.core.selected }); d.call(this, !0)
                        }
                    }; if (this.settings.core.worker && window.Blob && window.URL &&
                        window.Worker) try {
                            null === this._wrk && (this._wrk = window.URL.createObjectURL(new window.Blob(["self.onmessage \x3d " + k.toString()], { type: "text/javascript" }))), !this._data.core.working || e ? (this._data.core.working = !0, f = new window.Worker(this._wrk), f.onmessage = a.proxy(function (a) { l.call(this, a.data, !0); try { f.terminate(), f = null } catch (b) { } this._data.core.worker_queue.length ? this._append_json_data.apply(this, this._data.core.worker_queue.shift()) : this._data.core.working = !1 }, this), h.par ? f.postMessage(h) : this._data.core.worker_queue.length ?
                                this._append_json_data.apply(this, this._data.core.worker_queue.shift()) : this._data.core.working = !1) : this._data.core.worker_queue.push([b, c, d, !0])
                        } catch (m) { l.call(this, k(h), !1), this._data.core.worker_queue.length ? this._append_json_data.apply(this, this._data.core.worker_queue.shift()) : this._data.core.working = !1 } else l.call(this, k(h), !1)
                }
            }, _parse_model_from_html: function (b, c, d) {
                d = d ? [].concat(d) : []; c && d.unshift(c); var e, f, h = this._model.data, k = {
                    id: !1, text: !1, icon: !0, parent: c, parents: d, children: [], children_d: [],
                    data: null, state: {}, li_attr: { id: !1 }, a_attr: { href: "#" }, original: !1
                }, m; for (m in this._model.default_state) this._model.default_state.hasOwnProperty(m) && (k.state[m] = this._model.default_state[m]); c = a.vakata.attributes(b, !0); a.each(c, function (b, c) { c = a.trim(c); if (!c.length) return !0; k.li_attr[b] = c; "id" === b && (k.id = c.toString()) }); c = b.children("a").first(); c.length && (c = a.vakata.attributes(c, !0), a.each(c, function (b, c) { c = a.trim(c); c.length && (k.a_attr[b] = c) })); c = b.children("a").first().length ? b.children("a").first().clone() :
                    b.clone(); c.children("ins, i, ul").remove(); c = c.html(); c = a("\x3cdiv /\x3e").html(c); k.text = this.settings.core.force_text ? c.text() : c.html(); c = b.data(); k.data = c ? a.extend(!0, {}, c) : null; k.state.opened = b.hasClass("jstree-open"); k.state.selected = b.children("a").hasClass("jstree-clicked"); k.state.disabled = b.children("a").hasClass("jstree-disabled"); if (k.data && k.data.jstree) for (m in k.data.jstree) k.data.jstree.hasOwnProperty(m) && (k.state[m] = k.data.jstree[m]); c = b.children("a").children(".jstree-themeicon");
                c.length && (k.icon = c.hasClass("jstree-themeicon-hidden") ? !1 : c.attr("rel")); k.state.icon !== l && (k.icon = k.state.icon); if (k.icon === l || null === k.icon || "" === k.icon) k.icon = !0; c = b.children("ul").children("li"); do m = "j" + this._id + "_" + ++this._cnt; while (h[m]); k.id = k.li_attr.id ? k.li_attr.id.toString() : m; c.length ? (c.each(a.proxy(function (b, c) { e = this._parse_model_from_html(a(c), k.id, d); f = this._model.data[e]; k.children.push(e); f.children_d.length && (k.children_d = k.children_d.concat(f.children_d)) }, this)), k.children_d =
                    k.children_d.concat(k.children)) : b.hasClass("jstree-closed") && (k.state.loaded = !1); k.li_attr["class"] && (k.li_attr["class"] = k.li_attr["class"].replace("jstree-closed", "").replace("jstree-open", "")); k.a_attr["class"] && (k.a_attr["class"] = k.a_attr["class"].replace("jstree-clicked", "").replace("jstree-disabled", "")); h[k.id] = k; k.state.selected && this._data.core.selected.push(k.id); return k.id
            }, _parse_model_from_flat_json: function (a, b, c) {
                c = c ? c.concat() : []; b && c.unshift(b); var d = a.id.toString(), e = this._model.data,
                    f = this._model.default_state, h, k; b = { id: d, text: a.text || "", icon: a.icon !== l ? a.icon : !0, parent: b, parents: c, children: a.children || [], children_d: a.children_d || [], data: a.data, state: {}, li_attr: { id: !1 }, a_attr: { href: "#" }, original: !1 }; for (h in f) f.hasOwnProperty(h) && (b.state[h] = f[h]); a && a.data && a.data.jstree && a.data.jstree.icon && (b.icon = a.data.jstree.icon); if (b.icon === l || null === b.icon || "" === b.icon) b.icon = !0; if (a && a.data && (b.data = a.data, a.data.jstree)) for (h in a.data.jstree) a.data.jstree.hasOwnProperty(h) && (b.state[h] =
                        a.data.jstree[h]); if (a && "object" === typeof a.state) for (h in a.state) a.state.hasOwnProperty(h) && (b.state[h] = a.state[h]); if (a && "object" === typeof a.li_attr) for (h in a.li_attr) a.li_attr.hasOwnProperty(h) && (b.li_attr[h] = a.li_attr[h]); b.li_attr.id || (b.li_attr.id = d); if (a && "object" === typeof a.a_attr) for (h in a.a_attr) a.a_attr.hasOwnProperty(h) && (b.a_attr[h] = a.a_attr[h]); a && a.children && !0 === a.children && (b.state.loaded = !1, b.children = [], b.children_d = []); e[b.id] = b; h = 0; for (d = b.children.length; h < d; h++)f = this._parse_model_from_flat_json(e[b.children[h]],
                            b.id, c), k = e[f], b.children_d.push(f), k.children_d.length && (b.children_d = b.children_d.concat(k.children_d)); delete a.data; delete a.children; e[b.id].original = a; b.state.selected && this._data.core.selected.push(b.id); return b.id
            }, _parse_model_from_json: function (a, b, c) {
                c = c ? c.concat() : []; b && c.unshift(b); var d = !1, e, f, h, k = this._model.data; f = this._model.default_state; do d = "j" + this._id + "_" + ++this._cnt; while (k[d]); b = {
                    id: !1, text: "string" === typeof a ? a : "", icon: "object" === typeof a && a.icon !== l ? a.icon : !0, parent: b,
                    parents: c, children: [], children_d: [], data: null, state: {}, li_attr: { id: !1 }, a_attr: { href: "#" }, original: !1
                }; for (e in f) f.hasOwnProperty(e) && (b.state[e] = f[e]); a && a.id && (b.id = a.id.toString()); a && a.text && (b.text = a.text); a && a.data && a.data.jstree && a.data.jstree.icon && (b.icon = a.data.jstree.icon); if (b.icon === l || null === b.icon || "" === b.icon) b.icon = !0; if (a && a.data && (b.data = a.data, a.data.jstree)) for (e in a.data.jstree) a.data.jstree.hasOwnProperty(e) && (b.state[e] = a.data.jstree[e]); if (a && "object" === typeof a.state) for (e in a.state) a.state.hasOwnProperty(e) &&
                    (b.state[e] = a.state[e]); if (a && "object" === typeof a.li_attr) for (e in a.li_attr) a.li_attr.hasOwnProperty(e) && (b.li_attr[e] = a.li_attr[e]); b.li_attr.id && !b.id && (b.id = b.li_attr.id.toString()); b.id || (b.id = d); b.li_attr.id || (b.li_attr.id = b.id); if (a && "object" === typeof a.a_attr) for (e in a.a_attr) a.a_attr.hasOwnProperty(e) && (b.a_attr[e] = a.a_attr[e]); if (a && a.children && a.children.length) {
                        e = 0; for (d = a.children.length; e < d; e++)f = this._parse_model_from_json(a.children[e], b.id, c), h = k[f], b.children.push(f), h.children_d.length &&
                            (b.children_d = b.children_d.concat(h.children_d)); b.children_d = b.children_d.concat(b.children)
                    } a && a.children && !0 === a.children && (b.state.loaded = !1, b.children = [], b.children_d = []); delete a.data; delete a.children; b.original = a; k[b.id] = b; b.state.selected && this._data.core.selected.push(b.id); return b.id
            }, _redraw: function () {
                var b = this._model.force_full_redraw ? this._model.data[a.jstree.root].children.concat([]) : this._model.changed.concat([]), c = m.createElement("UL"), d, e, f, h = this._data.core.focused; e = 0; for (f =
                    b.length; e < f; e++)(d = this.redraw_node(b[e], !0, this._model.force_full_redraw)) && this._model.force_full_redraw && c.appendChild(d); this._model.force_full_redraw && (c.className = this.get_container_ul()[0].className, c.setAttribute("role", "group"), this.element.empty().append(c)); null !== h && ((d = this.get_node(h, !0)) && d.length && d.children(".jstree-anchor")[0] !== m.activeElement ? d.children(".jstree-anchor").focus() : this._data.core.focused = null); this._model.force_full_redraw = !1; this._model.changed = []; this.trigger("redraw",
                        { nodes: b })
            }, redraw: function (a) { a && (this._model.force_full_redraw = !0); this._redraw() }, draw_children: function (b) {
                var c = this.get_node(b), d = !1, e = !1, f = !1; if (!c) return !1; if (c.id === a.jstree.root) return this.redraw(!0); b = this.get_node(b, !0); if (!b || !b.length) return !1; b.children(".jstree-children").remove(); b = b[0]; if (c.children.length && c.state.loaded) {
                    f = m.createElement("UL"); f.setAttribute("role", "group"); f.className = "jstree-children"; d = 0; for (e = c.children.length; d < e; d++)f.appendChild(this.redraw_node(c.children[d],
                        !0, !0)); b.appendChild(f)
                }
            }, redraw_node: function (b, c, d, e) {
                var f = this.get_node(b), h = !1, l = !1, r = !1, E = !1, s = !1, C = !1, t = "", C = this._model.data, B = !1, v = null, t = s = 0, y = !1, F = !1; if (!f) return !1; if (f.id === a.jstree.root) return this.redraw(!0); c = c || 0 === f.children.length; if (b = m.querySelector ? this.element[0].querySelector("#" + (-1 !== "0123456789".indexOf(f.id[0]) ? "\\3" + f.id[0] + " " + f.id.substr(1).replace(a.jstree.idregex, "\\$\x26") : f.id.replace(a.jstree.idregex, "\\$\x26"))) : m.getElementById(f.id)) b = a(b), d || (h = b.parent().parent()[0],
                    h === this.element[0] && (h = null), l = b.index()), c || !f.children.length || b.children(".jstree-children").length || (c = !0), c || (r = b.children(".jstree-children")[0]), B = b.children(".jstree-anchor")[0] === m.activeElement, b.remove(); else if (c = !0, !d) { h = f.parent !== a.jstree.root ? a("#" + f.parent.replace(a.jstree.idregex, "\\$\x26"), this.element)[0] : null; if (!(null === h || h && C[f.parent].state.opened)) return !1; l = a.inArray(f.id, null === h ? C[a.jstree.root].children : C[f.parent].children) } b = k.cloneNode(!0); t = "jstree-node "; for (E in f.li_attr) f.li_attr.hasOwnProperty(E) &&
                        "id" !== E && ("class" !== E ? b.setAttribute(E, f.li_attr[E]) : t += f.li_attr[E]); f.a_attr.id || (f.a_attr.id = f.id + "_anchor"); b.setAttribute("aria-selected", !!f.state.selected); b.setAttribute("aria-level", f.parents.length); b.setAttribute("aria-labelledby", f.a_attr.id); f.state.disabled && b.setAttribute("aria-disabled", !0); E = 0; for (s = f.children.length; E < s; E++)if (!C[f.children[E]].state.hidden) { y = !0; break } if (null !== f.parent && C[f.parent] && !f.state.hidden && (E = a.inArray(f.id, C[f.parent].children), F = f.id, -1 !== E)) for (E++,
                            s = C[f.parent].children.length; E < s && (C[C[f.parent].children[E]].state.hidden || (F = C[f.parent].children[E]), F === f.id); E++); f.state.hidden && (t += " jstree-hidden"); f.state.loaded && !y ? t += " jstree-leaf" : (t += f.state.opened && f.state.loaded ? " jstree-open" : " jstree-closed", b.setAttribute("aria-expanded", f.state.opened && f.state.loaded)); F === f.id && (t += " jstree-last"); b.id = f.id; b.className = t; t = (f.state.selected ? " jstree-clicked" : "") + (f.state.disabled ? " jstree-disabled" : ""); for (s in f.a_attr) !f.a_attr.hasOwnProperty(s) ||
                                "href" === s && "#" === f.a_attr[s] || ("class" !== s ? b.childNodes[1].setAttribute(s, f.a_attr[s]) : t += " " + f.a_attr[s]); t.length && (b.childNodes[1].className = "jstree-anchor " + t); if (f.icon && !0 !== f.icon || !1 === f.icon) !1 === f.icon ? b.childNodes[1].childNodes[0].className += " jstree-themeicon-hidden" : -1 === f.icon.indexOf("/") && -1 === f.icon.indexOf(".") ? b.childNodes[1].childNodes[0].className += " " + f.icon + " jstree-themeicon-custom" : (b.childNodes[1].childNodes[0].style.backgroundImage = "url(" + f.icon + ")", b.childNodes[1].childNodes[0].style.backgroundPosition =
                                    "center center", b.childNodes[1].childNodes[0].style.backgroundSize = "auto", b.childNodes[1].childNodes[0].className += " jstree-themeicon-custom"); this.settings.core.force_text ? b.childNodes[1].appendChild(m.createTextNode(f.text)) : b.childNodes[1].innerHTML += f.text; if (c && f.children.length && (f.state.opened || e) && f.state.loaded) { C = m.createElement("UL"); C.setAttribute("role", "group"); C.className = "jstree-children"; E = 0; for (s = f.children.length; E < s; E++)C.appendChild(this.redraw_node(f.children[E], c, !0)); b.appendChild(C) } r &&
                                        b.appendChild(r); if (!d) {
                                            h || (h = this.element[0]); E = 0; for (s = h.childNodes.length; E < s; E++)if (h.childNodes[E] && h.childNodes[E].className && -1 !== h.childNodes[E].className.indexOf("jstree-children")) { v = h.childNodes[E]; break } v || (v = m.createElement("UL"), v.setAttribute("role", "group"), v.className = "jstree-children", h.appendChild(v)); h = v; l < h.childNodes.length ? h.insertBefore(b, h.childNodes[l]) : h.appendChild(b); B && (s = this.element[0].scrollTop, t = this.element[0].scrollLeft, b.childNodes[1].focus(), this.element[0].scrollTop =
                                                s, this.element[0].scrollLeft = t)
                                        } f.state.opened && !f.state.loaded && (f.state.opened = !1, setTimeout(a.proxy(function () { this.open_node(f.id, !1, 0) }, this), 0)); return b
            }, open_node: function (b, c, d) {
                var e, f, h; if (a.isArray(b)) { b = b.slice(); e = 0; for (f = b.length; e < f; e++)this.open_node(b[e], c, d); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; d = d === l ? this.settings.core.animation : d; if (!this.is_closed(b)) return c && c.call(this, b, !1), !1; if (this.is_loaded(b)) e = this.get_node(b, !0), h = this, e.length && (d && e.children(".jstree-children").length &&
                    e.children(".jstree-children").stop(!0, !0), b.children.length && !this._firstChild(e.children(".jstree-children")[0]) && this.draw_children(b), d ? (this.trigger("before_open", { node: b }), e.children(".jstree-children").css("display", "none").end().removeClass("jstree-closed").addClass("jstree-open").attr("aria-expanded", !0).children(".jstree-children").stop(!0, !0).slideDown(d, function () { this.style.display = ""; h.trigger("after_open", { node: b }) })) : (this.trigger("before_open", { node: b }), e[0].className = e[0].className.replace("jstree-closed",
                        "jstree-open"), e[0].setAttribute("aria-expanded", !0))), b.state.opened = !0, c && c.call(this, b, !0), e.length || this.trigger("before_open", { node: b }), this.trigger("open_node", { node: b }), d && e.length || this.trigger("after_open", { node: b }); else { if (this.is_loading(b)) return setTimeout(a.proxy(function () { this.open_node(b, c, d) }, this), 500); this.load_node(b, function (a, b) { return b ? this.open_node(a, c, d) : c ? c.call(this, a, !1) : !1 }) }
            }, _open_to: function (b) {
                b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; var c, d, e = b.parents;
                c = 0; for (d = e.length; c < d; c += 1)c !== a.jstree.root && this.open_node(e[c], !1, 0); return a("#" + b.id.replace(a.jstree.idregex, "\\$\x26"), this.element)
            }, close_node: function (b, c) {
                var d, e, f, h; if (a.isArray(b)) { b = b.slice(); d = 0; for (e = b.length; d < e; d++)this.close_node(b[d], c); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root || this.is_closed(b)) return !1; c = c === l ? this.settings.core.animation : c; f = this; h = this.get_node(b, !0); h.length && (c ? h.children(".jstree-children").attr("style", "display:block !important").end().removeClass("jstree-open").addClass("jstree-closed").attr("aria-expanded",
                    !1).children(".jstree-children").stop(!0, !0).slideUp(c, function () { this.style.display = ""; h.children(".jstree-children").remove(); f.trigger("after_close", { node: b }) }) : (h[0].className = h[0].className.replace("jstree-open", "jstree-closed"), h.attr("aria-expanded", !1).children(".jstree-children").remove())); b.state.opened = !1; this.trigger("close_node", { node: b }); c && h.length || this.trigger("after_close", { node: b })
            }, toggle_node: function (b) {
                var c, d; if (a.isArray(b)) {
                    b = b.slice(); c = 0; for (d = b.length; c < d; c++)this.toggle_node(b[c]);
                    return !0
                } if (this.is_closed(b)) return this.open_node(b); if (this.is_open(b)) return this.close_node(b)
            }, open_all: function (b, c, d) {
                b || (b = a.jstree.root); b = this.get_node(b); if (!b) return !1; var e = b.id === a.jstree.root ? this.get_container_ul() : this.get_node(b, !0), f, h; if (!e.length) { e = 0; for (f = b.children_d.length; e < f; e++)this.is_closed(this._model.data[b.children_d[e]]) && (this._model.data[b.children_d[e]].state.opened = !0); return this.trigger("open_all", { node: b }) } d = d || e; h = this; e = this.is_closed(b) ? e.find(".jstree-closed").addBack() :
                    e.find(".jstree-closed"); e.each(function () { h.open_node(this, function (a, b) { b && this.is_parent(a) && this.open_all(a, c, d) }, c || 0) }); 0 === d.find(".jstree-closed").length && this.trigger("open_all", { node: this.get_node(d) })
            }, close_all: function (b, c) {
                b || (b = a.jstree.root); b = this.get_node(b); if (!b) return !1; var d = b.id === a.jstree.root ? this.get_container_ul() : this.get_node(b, !0), e = this, f; d.length && (d = this.is_open(b) ? d.find(".jstree-open").addBack() : d.find(".jstree-open"), a(d.get().reverse()).each(function () {
                    e.close_node(this,
                        c || 0)
                })); d = 0; for (f = b.children_d.length; d < f; d++)this._model.data[b.children_d[d]].state.opened = !1; this.trigger("close_all", { node: b })
            }, is_disabled: function (a) { return (a = this.get_node(a)) && a.state && a.state.disabled }, enable_node: function (b) {
                var c, d; if (a.isArray(b)) { b = b.slice(); c = 0; for (d = b.length; c < d; c++)this.enable_node(b[c]); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; b.state.disabled = !1; this.get_node(b, !0).children(".jstree-anchor").removeClass("jstree-disabled").attr("aria-disabled",
                    !1); this.trigger("enable_node", { node: b })
            }, disable_node: function (b) { var c, d; if (a.isArray(b)) { b = b.slice(); c = 0; for (d = b.length; c < d; c++)this.disable_node(b[c]); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; b.state.disabled = !0; this.get_node(b, !0).children(".jstree-anchor").addClass("jstree-disabled").attr("aria-disabled", !0); this.trigger("disable_node", { node: b }) }, hide_node: function (b, c) {
                var d, e; if (a.isArray(b)) {
                    b = b.slice(); d = 0; for (e = b.length; d < e; d++)this.hide_node(b[d], !0); this.redraw();
                    return !0
                } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; b.state.hidden || (b.state.hidden = !0, this._node_changed(b.parent), c || this.redraw(), this.trigger("hide_node", { node: b }))
            }, show_node: function (b, c) { var d, e; if (a.isArray(b)) { b = b.slice(); d = 0; for (e = b.length; d < e; d++)this.show_node(b[d], !0); this.redraw(); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; b.state.hidden && (b.state.hidden = !1, this._node_changed(b.parent), c || this.redraw(), this.trigger("show_node", { node: b })) }, hide_all: function (b) {
                var c;
                b = this._model.data; var d = []; for (c in b) b.hasOwnProperty(c) && c !== a.jstree.root && !b[c].state.hidden && (b[c].state.hidden = !0, d.push(c)); this._model.force_full_redraw = !0; this.redraw(); this.trigger("hide_all", { nodes: d }); return d
            }, show_all: function (b) { var c; b = this._model.data; var d = []; for (c in b) b.hasOwnProperty(c) && c !== a.jstree.root && b[c].state.hidden && (b[c].state.hidden = !1, d.push(c)); this._model.force_full_redraw = !0; this.redraw(); this.trigger("show_all", { nodes: d }); return d }, activate_node: function (a, b) {
                if (this.is_disabled(a)) return !1;
                b && "object" === typeof b || (b = {}); this._data.core.last_clicked = this._data.core.last_clicked && this._data.core.last_clicked.id !== l ? this.get_node(this._data.core.last_clicked.id) : null; this._data.core.last_clicked && !this._data.core.last_clicked.state.selected && (this._data.core.last_clicked = null); !this._data.core.last_clicked && this._data.core.selected.length && (this._data.core.last_clicked = this.get_node(this._data.core.selected[this._data.core.selected.length - 1])); if (this.settings.core.multiple && (b.metaKey ||
                    b.ctrlKey || b.shiftKey) && (!b.shiftKey || this._data.core.last_clicked && this.get_parent(a) && this.get_parent(a) === this._data.core.last_clicked.parent)) if (b.shiftKey) {
                        var c = this.get_node(a).id, d = this._data.core.last_clicked.id, e = this.get_node(this._data.core.last_clicked.parent).children, f = !1, h, k; h = 0; for (k = e.length; h < k; h += 1)e[h] === c && (f = !f), e[h] === d && (f = !f), this.is_disabled(e[h]) || !f && e[h] !== c && e[h] !== d ? this.deselect_node(e[h], !0, b) : this.select_node(e[h], !0, !1, b); this.trigger("changed", {
                            action: "select_node",
                            node: this.get_node(a), selected: this._data.core.selected, event: b
                        })
                    } else this.is_selected(a) ? this.deselect_node(a, !1, b) : this.select_node(a, !1, !1, b); else !this.settings.core.multiple && (b.metaKey || b.ctrlKey || b.shiftKey) && this.is_selected(a) ? this.deselect_node(a, !1, b) : (this.deselect_all(!0), this.select_node(a, !1, !1, b), this._data.core.last_clicked = this.get_node(a)); this.trigger("activate_node", { node: this.get_node(a), event: b })
            }, hover_node: function (a) {
                a = this.get_node(a, !0); if (!a || !a.length || a.children(".jstree-hovered").length) return !1;
                var b = this.element.find(".jstree-hovered"), c = this.element; b && b.length && this.dehover_node(b); a.children(".jstree-anchor").addClass("jstree-hovered"); this.trigger("hover_node", { node: this.get_node(a) }); setTimeout(function () { c.attr("aria-activedescendant", a[0].id) }, 0)
            }, dehover_node: function (a) { a = this.get_node(a, !0); if (!a || !a.length || !a.children(".jstree-hovered").length) return !1; a.children(".jstree-anchor").removeClass("jstree-hovered"); this.trigger("dehover_node", { node: this.get_node(a) }) }, select_node: function (b,
                c, d, e) {
                    var f, h; if (a.isArray(b)) { b = b.slice(); f = 0; for (h = b.length; f < h; f++)this.select_node(b[f], c, d, e); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; f = this.get_node(b, !0); b.state.selected || (b.state.selected = !0, this._data.core.selected.push(b.id), d || (f = this._open_to(b)), f && f.length && f.attr("aria-selected", !0).children(".jstree-anchor").addClass("jstree-clicked"), this.trigger("select_node", { node: b, selected: this._data.core.selected, event: e }), c || this.trigger("changed", {
                        action: "select_node",
                        node: b, selected: this._data.core.selected, event: e
                    }))
            }, deselect_node: function (b, c, d) {
                var e, f; if (a.isArray(b)) { b = b.slice(); e = 0; for (f = b.length; e < f; e++)this.deselect_node(b[e], c, d); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; e = this.get_node(b, !0); b.state.selected && (b.state.selected = !1, this._data.core.selected = a.vakata.array_remove_item(this._data.core.selected, b.id), e.length && e.attr("aria-selected", !1).children(".jstree-anchor").removeClass("jstree-clicked"), this.trigger("deselect_node",
                    { node: b, selected: this._data.core.selected, event: d }), c || this.trigger("changed", { action: "deselect_node", node: b, selected: this._data.core.selected, event: d }))
            }, select_all: function (b) {
                var c = this._data.core.selected.concat([]), d, e; this._data.core.selected = this._model.data[a.jstree.root].children_d.concat(); d = 0; for (e = this._data.core.selected.length; d < e; d++)this._model.data[this._data.core.selected[d]] && (this._model.data[this._data.core.selected[d]].state.selected = !0); this.redraw(!0); this.trigger("select_all",
                    { selected: this._data.core.selected }); b || this.trigger("changed", { action: "select_all", selected: this._data.core.selected, old_selection: c })
            }, deselect_all: function (a) {
                var b = this._data.core.selected.concat([]), c, d; c = 0; for (d = this._data.core.selected.length; c < d; c++)this._model.data[this._data.core.selected[c]] && (this._model.data[this._data.core.selected[c]].state.selected = !1); this._data.core.selected = []; this.element.find(".jstree-clicked").removeClass("jstree-clicked").parent().attr("aria-selected", !1); this.trigger("deselect_all",
                    { selected: this._data.core.selected, node: b }); a || this.trigger("changed", { action: "deselect_all", selected: this._data.core.selected, old_selection: b })
            }, is_selected: function (b) { return (b = this.get_node(b)) && b.id !== a.jstree.root ? b.state.selected : !1 }, get_selected: function (b) { return b ? a.map(this._data.core.selected, a.proxy(function (a) { return this.get_node(a) }, this)) : this._data.core.selected.slice() }, get_top_selected: function (b) {
                var c = this.get_selected(!0), d = {}, e, f, h, k; e = 0; for (f = c.length; e < f; e++)d[c[e].id] = c[e];
                e = 0; for (f = c.length; e < f; e++)for (h = 0, k = c[e].children_d.length; h < k; h++)d[c[e].children_d[h]] && delete d[c[e].children_d[h]]; c = []; for (e in d) d.hasOwnProperty(e) && c.push(e); return b ? a.map(c, a.proxy(function (a) { return this.get_node(a) }, this)) : c
            }, get_bottom_selected: function (b) { var c = this.get_selected(!0), d = [], e, f; e = 0; for (f = c.length; e < f; e++)c[e].children.length || d.push(c[e].id); return b ? a.map(d, a.proxy(function (a) { return this.get_node(a) }, this)) : d }, get_state: function () {
                var b = {
                    core: {
                        open: [], scroll: {
                            left: this.element.scrollLeft(),
                            top: this.element.scrollTop()
                        }, selected: []
                    }
                }, c; for (c in this._model.data) this._model.data.hasOwnProperty(c) && c !== a.jstree.root && (this._model.data[c].state.opened && b.core.open.push(c), this._model.data[c].state.selected && b.core.selected.push(c)); return b
            }, set_state: function (b, c) {
                if (b) {
                    if (b.core) {
                        var d, e; if (b.core.open) return a.isArray(b.core.open) && b.core.open.length ? this._load_nodes(b.core.open, function (a) { this.open_node(a, !1, 0); delete b.core.open; this.set_state(b, c) }, !0) : (delete b.core.open, this.set_state(b,
                            c)), !1; if (b.core.scroll) return b.core.scroll && b.core.scroll.left !== l && this.element.scrollLeft(b.core.scroll.left), b.core.scroll && b.core.scroll.top !== l && this.element.scrollTop(b.core.scroll.top), delete b.core.scroll, this.set_state(b, c), !1; if (b.core.selected) return d = this, this.deselect_all(), a.each(b.core.selected, function (a, b) { d.select_node(b, !1, !0) }), delete b.core.selected, this.set_state(b, c), !1; for (e in b) b.hasOwnProperty(e) && "core" !== e && -1 === a.inArray(e, this.settings.plugins) && delete b[e]; if (a.isEmptyObject(b.core)) return delete b.core,
                                this.set_state(b, c), !1
                    } return a.isEmptyObject(b) ? (b = null, c && c.call(this), this.trigger("set_state"), !1) : !0
                } return !1
            }, refresh: function (b, c) {
                this._data.core.state = !0 === c ? {} : this.get_state(); c && a.isFunction(c) && (this._data.core.state = c.call(this, this._data.core.state)); this._cnt = 0; this._model.data = {}; this._model.data[a.jstree.root] = { id: a.jstree.root, parent: null, parents: [], children: [], children_d: [], state: { loaded: !1 } }; this._data.core.selected = []; this._data.core.last_clicked = null; this._data.core.focused =
                    null; var d = this.get_container_ul()[0].className; b || (this.element.html("\x3cul class\x3d'" + d + "' role\x3d'group'\x3e\x3cli class\x3d'jstree-initial-node jstree-loading jstree-leaf jstree-last' role\x3d'treeitem' id\x3d'j" + this._id + "_loading'\x3e\x3ci class\x3d'jstree-icon jstree-ocl'\x3e\x3c/i\x3e\x3ca class\x3d'jstree-anchor' href\x3d'#'\x3e\x3ci class\x3d'jstree-icon jstree-themeicon-hidden'\x3e\x3c/i\x3e" + this.get_string("Loading ...") + "\x3c/a\x3e\x3c/li\x3e\x3c/ul\x3e"), this.element.attr("aria-activedescendant",
                        "j" + this._id + "_loading")); this.load_node(a.jstree.root, function (b, c) { c && (this.get_container_ul()[0].className = d, this._firstChild(this.get_container_ul()[0]) && this.element.attr("aria-activedescendant", this._firstChild(this.get_container_ul()[0]).id), this.set_state(a.extend(!0, {}, this._data.core.state), function () { this.trigger("refresh") })); this._data.core.state = null })
            }, refresh_node: function (b) {
                b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; var c = [], d = []; this._data.core.selected.concat([]);
                d.push(b.id); !0 === b.state.opened && c.push(b.id); this.get_node(b, !0).find(".jstree-open").each(function () { c.push(this.id) }); this._load_nodes(d, a.proxy(function (a) { this.open_node(c, !1, 0); this.select_node(this._data.core.selected); this.trigger("refresh_node", { node: b, nodes: a }) }, this))
            }, set_id: function (b, c) {
                b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; var d, e, f = this._model.data; c = c.toString(); f[b.parent].children[a.inArray(b.id, f[b.parent].children)] = c; d = 0; for (e = b.parents.length; d < e; d++)f[b.parents[d]].children_d[a.inArray(b.id,
                    f[b.parents[d]].children_d)] = c; d = 0; for (e = b.children.length; d < e; d++)f[b.children[d]].parent = c; d = 0; for (e = b.children_d.length; d < e; d++)f[b.children_d[d]].parents[a.inArray(b.id, f[b.children_d[d]].parents)] = c; d = a.inArray(b.id, this._data.core.selected); -1 !== d && (this._data.core.selected[d] = c); if (d = this.get_node(b.id, !0)) d.attr("id", c).children(".jstree-anchor").attr("id", c + "_anchor").end().attr("aria-labelledby", c + "_anchor"), this.element.attr("aria-activedescendant") === b.id && this.element.attr("aria-activedescendant",
                        c); delete f[b.id]; b.id = c; b.li_attr.id = c; f[c] = b; return !0
            }, get_text: function (b) { return (b = this.get_node(b)) && b.id !== a.jstree.root ? b.text : !1 }, set_text: function (b, c) { var d, e; if (a.isArray(b)) { b = b.slice(); d = 0; for (e = b.length; d < e; d++)this.set_text(b[d], c); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; b.text = c; this.get_node(b, !0).length && this.redraw_node(b.id); this.trigger("set_text", { obj: b, text: c }); return !0 }, get_json: function (b, c, d) {
                b = this.get_node(b || a.jstree.root); if (!b) return !1; c && c.flat &&
                    !d && (d = []); var e = { id: b.id, text: b.text, icon: this.get_icon(b), li_attr: a.extend(!0, {}, b.li_attr), a_attr: a.extend(!0, {}, b.a_attr), state: {}, data: c && c.no_data ? !1 : a.extend(!0, {}, b.data) }, f, h; c && c.flat ? e.parent = b.parent : e.children = []; if (!c || !c.no_state) for (f in b.state) b.state.hasOwnProperty(f) && (e.state[f] = b.state[f]); c && c.no_id && (delete e.id, e.li_attr && e.li_attr.id && delete e.li_attr.id, e.a_attr && e.a_attr.id && delete e.a_attr.id); c && c.flat && b.id !== a.jstree.root && d.push(e); if (!c || !c.no_children) for (f = 0, h =
                        b.children.length; f < h; f++)c && c.flat ? this.get_json(b.children[f], c, d) : e.children.push(this.get_json(b.children[f], c)); return c && c.flat ? d : b.id === a.jstree.root ? e.children : e
            }, create_node: function (b, c, d, e, f) {
                null === b && (b = a.jstree.root); b = this.get_node(b); if (!b) return !1; d = d === l ? "last" : d; if (!d.toString().match(/^(before|after)$/) && !f && !this.is_loaded(b)) return this.load_node(b, function () { this.create_node(b, c, d, e, !0) }); c || (c = { text: this.get_string("New node") }); "string" === typeof c && (c = { text: c }); c.text === l &&
                    (c.text = this.get_string("New node")); var h, k, m; b.id === a.jstree.root && ("before" === d && (d = "first"), "after" === d && (d = "last")); switch (d) { case "before": f = this.get_node(b.parent); d = a.inArray(b.id, f.children); b = f; break; case "after": f = this.get_node(b.parent); d = a.inArray(b.id, f.children) + 1; b = f; break; case "inside": case "first": d = 0; break; case "last": d = b.children.length; break; default: d || (d = 0) }d > b.children.length && (d = b.children.length); c.id || (c.id = !0); if (!this.check("create_node", c, b, d)) return this.settings.core.error.call(this,
                        this._data.core.last_error), !1; !0 === c.id && delete c.id; c = this._parse_model_from_json(c, b.id, b.parents.concat()); if (!c) return !1; f = this.get_node(c); h = []; h.push(c); h = h.concat(f.children_d); this.trigger("model", { nodes: h, parent: b.id }); b.children_d = b.children_d.concat(h); k = 0; for (m = b.parents.length; k < m; k++)this._model.data[b.parents[k]].children_d = this._model.data[b.parents[k]].children_d.concat(h); c = f; f = []; k = 0; for (m = b.children.length; k < m; k++)f[k >= d ? k + 1 : k] = b.children[k]; f[d] = c.id; b.children = f; this.redraw_node(b,
                            !0); e && e.call(this, this.get_node(c)); this.trigger("create_node", { node: this.get_node(c), parent: b.id, position: d }); return c.id
            }, rename_node: function (b, c) {
                var d, e; if (a.isArray(b)) { b = b.slice(); d = 0; for (e = b.length; d < e; d++)this.rename_node(b[d], c); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; d = b.text; if (!this.check("rename_node", b, this.get_parent(b), c)) return this.settings.core.error.call(this, this._data.core.last_error), !1; this.set_text(b, c); this.trigger("rename_node", {
                    node: b, text: c,
                    old: d
                }); return !0
            }, delete_node: function (b) {
                var c, d, e, f, h, k, l, m; if (a.isArray(b)) { b = b.slice(); c = 0; for (d = b.length; c < d; c++)this.delete_node(b[c]); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; c = this.get_node(b.parent); d = a.inArray(b.id, c.children); m = !1; if (!this.check("delete_node", b, c, d)) return this.settings.core.error.call(this, this._data.core.last_error), !1; -1 !== d && (c.children = a.vakata.array_remove(c.children, d)); e = b.children_d.concat([]); e.push(b.id); k = 0; for (l = e.length; k < l; k++) {
                    f =
                    0; for (h = b.parents.length; f < h; f++)d = a.inArray(e[k], this._model.data[b.parents[f]].children_d), -1 !== d && (this._model.data[b.parents[f]].children_d = a.vakata.array_remove(this._model.data[b.parents[f]].children_d, d)); this._model.data[e[k]].state.selected && (m = !0, d = a.inArray(e[k], this._data.core.selected), -1 !== d && (this._data.core.selected = a.vakata.array_remove(this._data.core.selected, d)))
                } this.trigger("delete_node", { node: b, parent: c.id }); m && this.trigger("changed", {
                    action: "delete_node", node: b, selected: this._data.core.selected,
                    parent: c.id
                }); k = 0; for (l = e.length; k < l; k++)delete this._model.data[e[k]]; -1 !== a.inArray(this._data.core.focused, e) && (this._data.core.focused = null, b = this.element[0].scrollTop, d = this.element[0].scrollLeft, c.id === a.jstree.root ? this.get_node(this._model.data[a.jstree.root].children[0], !0).children(".jstree-anchor").focus() : this.get_node(c, !0).children(".jstree-anchor").focus(), this.element[0].scrollTop = b, this.element[0].scrollLeft = d); this.redraw_node(c, !0); return !0
            }, check: function (b, c, d, e, f) {
                c = c && c.id ?
                    c : this.get_node(c); d = d && d.id ? d : this.get_node(d); var h = b.match(/^move_node|copy_node|create_node$/i) ? d : c, k = this.settings.core.check_callback; if (!("move_node" !== b && "copy_node" !== b || f && f.is_multi || c.id !== d.id && a.inArray(c.id, d.children) !== e && -1 === a.inArray(d.id, c.children_d))) return this._data.core.last_error = { error: "check", plugin: "core", id: "core_01", reason: "Moving parent inside child", data: JSON.stringify({ chk: b, pos: e, obj: c && c.id ? c.id : !1, par: d && d.id ? d.id : !1 }) }, !1; h && h.data && (h = h.data); return h && h.functions &&
                        (!1 === h.functions[b] || !0 === h.functions[b]) ? (!1 === h.functions[b] && (this._data.core.last_error = { error: "check", plugin: "core", id: "core_02", reason: "Node data prevents function: " + b, data: JSON.stringify({ chk: b, pos: e, obj: c && c.id ? c.id : !1, par: d && d.id ? d.id : !1 }) }), h.functions[b]) : !1 === k || a.isFunction(k) && !1 === k.call(this, b, c, d, e, f) || k && !1 === k[b] ? (this._data.core.last_error = {
                            error: "check", plugin: "core", id: "core_03", reason: "User config for core.check_callback prevents function: " + b, data: JSON.stringify({
                                chk: b, pos: e,
                                obj: c && c.id ? c.id : !1, par: d && d.id ? d.id : !1
                            })
                        }, !1) : !0
            }, last_error: function () { return this._data.core.last_error }, move_node: function (b, c, d, e, f, h, k) {
                var m, r, s, C, t, B, v, y, F, z; c = this.get_node(c); d = d === l ? 0 : d; if (!c) return !1; if (!d.toString().match(/^(before|after)$/) && !f && !this.is_loaded(c)) return this.load_node(c, function () { this.move_node(b, c, d, e, !0, !1, k) }); if (a.isArray(b)) if (1 === b.length) b = b[0]; else { h = 0; for (m = b.length; h < m; h++)if (t = this.move_node(b[h], c, d, e, f, !1, k)) c = t, d = "after"; this.redraw(); return !0 } b = b && b.id ?
                    b : this.get_node(b); if (!b || b.id === a.jstree.root) return !1; m = (b.parent || a.jstree.root).toString(); s = d.toString().match(/^(before|after)$/) && c.id !== a.jstree.root ? this.get_node(c.parent) : c; C = k ? k : this._model.data[b.id] ? this : a.jstree.reference(b.id); t = !C || !C._id || this._id !== C._id; r = C && C._id && m && C._model.data[m] && C._model.data[m].children ? a.inArray(b.id, C._model.data[m].children) : -1; C && C._id && (b = C._model.data[b.id]); if (t) return (t = this.copy_node(b, c, d, e, f, !1, k)) ? (C && C.delete_node(b), t) : !1; c.id === a.jstree.root &&
                        ("before" === d && (d = "first"), "after" === d && (d = "last")); switch (d) { case "before": d = a.inArray(c.id, s.children); break; case "after": d = a.inArray(c.id, s.children) + 1; break; case "inside": case "first": d = 0; break; case "last": d = s.children.length; break; default: d || (d = 0) }d > s.children.length && (d = s.children.length); if (!this.check("move_node", b, s, d, { core: !0, origin: k, is_multi: C && C._id && C._id !== this._id, is_foreign: !C || !C._id })) return this.settings.core.error.call(this, this._data.core.last_error), !1; if (b.parent === s.id) {
                            f =
                            s.children.concat(); t = a.inArray(b.id, f); -1 !== t && (f = a.vakata.array_remove(f, t), d > t && d--); t = []; B = 0; for (v = f.length; B < v; B++)t[B >= d ? B + 1 : B] = f[B]; t[d] = b.id; s.children = t; this._node_changed(s.id); this.redraw(s.id === a.jstree.root)
                        } else {
                            t = b.children_d.concat(); t.push(b.id); B = 0; for (v = b.parents.length; B < v; B++) { f = []; z = C._model.data[b.parents[B]].children_d; y = 0; for (F = z.length; y < F; y++)-1 === a.inArray(z[y], t) && f.push(z[y]); C._model.data[b.parents[B]].children_d = f } C._model.data[m].children = a.vakata.array_remove_item(C._model.data[m].children,
                                b.id); B = 0; for (v = s.parents.length; B < v; B++)this._model.data[s.parents[B]].children_d = this._model.data[s.parents[B]].children_d.concat(t); f = []; B = 0; for (v = s.children.length; B < v; B++)f[B >= d ? B + 1 : B] = s.children[B]; f[d] = b.id; s.children = f; s.children_d.push(b.id); s.children_d = s.children_d.concat(b.children_d); b.parent = s.id; t = s.parents.concat(); t.unshift(s.id); z = b.parents.length; b.parents = t; t = t.concat(); B = 0; for (v = b.children_d.length; B < v; B++)this._model.data[b.children_d[B]].parents = this._model.data[b.children_d[B]].parents.slice(0,
                                    -1 * z), Array.prototype.push.apply(this._model.data[b.children_d[B]].parents, t); if (m === a.jstree.root || s.id === a.jstree.root) this._model.force_full_redraw = !0; this._model.force_full_redraw || (this._node_changed(m), this._node_changed(s.id)); h || this.redraw()
                } e && e.call(this, b, s, d); this.trigger("move_node", { node: b, parent: s.id, position: d, old_parent: m, old_position: r, is_multi: C && C._id && C._id !== this._id, is_foreign: !C || !C._id, old_instance: C, new_instance: this }); return b.id
            }, copy_node: function (b, c, d, e, f, h, k) {
                var m,
                r, s, C, t, B; c = this.get_node(c); d = d === l ? 0 : d; if (!c) return !1; if (!d.toString().match(/^(before|after)$/) && !f && !this.is_loaded(c)) return this.load_node(c, function () { this.copy_node(b, c, d, e, !0, !1, k) }); if (a.isArray(b)) if (1 === b.length) b = b[0]; else { h = 0; for (m = b.length; h < m; h++)if (r = this.copy_node(b[h], c, d, e, f, !0, k)) c = r, d = "after"; this.redraw(); return !0 } b = b && b.id ? b : this.get_node(b); if (!b || b.id === a.jstree.root) return !1; m = (b.parent || a.jstree.root).toString(); t = d.toString().match(/^(before|after)$/) && c.id !== a.jstree.root ?
                    this.get_node(c.parent) : c; (B = k ? k : this._model.data[b.id] ? this : a.jstree.reference(b.id)) && B._id && (b = B._model.data[b.id]); c.id === a.jstree.root && ("before" === d && (d = "first"), "after" === d && (d = "last")); switch (d) { case "before": d = a.inArray(c.id, t.children); break; case "after": d = a.inArray(c.id, t.children) + 1; break; case "inside": case "first": d = 0; break; case "last": d = t.children.length; break; default: d || (d = 0) }d > t.children.length && (d = t.children.length); if (!this.check("copy_node", b, t, d, {
                        core: !0, origin: k, is_multi: B && B._id &&
                            B._id !== this._id, is_foreign: !B || !B._id
                    })) return this.settings.core.error.call(this, this._data.core.last_error), !1; s = B ? B.get_json(b, { no_id: !0, no_data: !0, no_state: !0 }) : b; if (!s) return !1; !0 === s.id && delete s.id; s = this._parse_model_from_json(s, t.id, t.parents.concat()); if (!s) return !1; r = this.get_node(s); b && b.state && !1 === b.state.loaded && (r.state.loaded = !1); f = []; f.push(s); f = f.concat(r.children_d); this.trigger("model", { nodes: f, parent: t.id }); s = 0; for (C = t.parents.length; s < C; s++)this._model.data[t.parents[s]].children_d =
                        this._model.data[t.parents[s]].children_d.concat(f); f = []; s = 0; for (C = t.children.length; s < C; s++)f[s >= d ? s + 1 : s] = t.children[s]; f[d] = r.id; t.children = f; t.children_d.push(r.id); t.children_d = t.children_d.concat(r.children_d); t.id === a.jstree.root && (this._model.force_full_redraw = !0); this._model.force_full_redraw || this._node_changed(t.id); h || this.redraw(t.id === a.jstree.root); e && e.call(this, r, t, d); this.trigger("copy_node", {
                            node: r, original: b, parent: t.id, position: d, old_parent: m, old_position: B && B._id && m && B._model.data[m] &&
                                B._model.data[m].children ? a.inArray(b.id, B._model.data[m].children) : -1, is_multi: B && B._id && B._id !== this._id, is_foreign: !B || !B._id, old_instance: B, new_instance: this
                        }); return r.id
            }, cut: function (b) { b || (b = this._data.core.selected.concat()); a.isArray(b) || (b = [b]); if (!b.length) return !1; var e = [], f, k, l; k = 0; for (l = b.length; k < l; k++)(f = this.get_node(b[k])) && f.id && f.id !== a.jstree.root && e.push(f); if (!e.length) return !1; h = e; d = this; c = "move_node"; this.trigger("cut", { node: b }) }, copy: function (b) {
                b || (b = this._data.core.selected.concat());
                a.isArray(b) || (b = [b]); if (!b.length) return !1; var e = [], f, k, l; k = 0; for (l = b.length; k < l; k++)(f = this.get_node(b[k])) && f.id && f.id !== a.jstree.root && e.push(f); if (!e.length) return !1; h = e; d = this; c = "copy_node"; this.trigger("copy", { node: b })
            }, get_buffer: function () { return { mode: c, node: h, inst: d } }, can_paste: function () { return !1 !== c && !1 !== h }, paste: function (a, b) {
                a = this.get_node(a); if (!(a && c && c.match(/^(copy_node|move_node)$/) && h)) return !1; this[c](h, a, b, !1, !1, !1, d) && this.trigger("paste", { parent: a.id, node: h, mode: c }); d = c =
                    h = !1
            }, clear_buffer: function () { d = c = h = !1; this.trigger("clear_buffer") }, edit: function (b, c, d) {
                var e, f, h, k, l, m, r, s, t = !1; b = this.get_node(b); if (!b) return !1; if (!1 === this.settings.core.check_callback) return this._data.core.last_error = { error: "check", plugin: "core", id: "core_07", reason: "Could not edit node because of check_callback" }, this.settings.core.error.call(this, this._data.core.last_error), !1; s = b; c = "string" === typeof c ? c : b.text; this.set_text(b, ""); b = this._open_to(b); s.text = c; e = this._data.core.rtl; f = this.element.width();
                this._data.core.focused = s.id; h = b.children(".jstree-anchor").focus(); k = a("\x3cspan\x3e"); l = c; m = a("\x3cdiv /\x3e", { css: { position: "absolute", top: "-200px", left: e ? "0px" : "-1000px", visibility: "hidden" } }).appendTo("body"); r = a("\x3cinput /\x3e", {
                    value: l, "class": "jstree-rename-input", css: { padding: "0", border: "1px solid silver", "box-sizing": "border-box", display: "inline-block", height: this._data.core.li_height + "px", lineHeight: this._data.core.li_height + "px", width: "150px" }, blur: a.proxy(function (c) {
                        c.stopImmediatePropagation();
                        c.preventDefault(); c = k.children(".jstree-rename-input").val(); var e = this.settings.core.force_text; "" === c && (c = l); m.remove(); k.replaceWith(h); k.remove(); l = e ? l : a("\x3cdiv\x3e\x3c/div\x3e").append(a.parseHTML(l)).html(); this.set_text(b, l); (c = !!this.rename_node(b, e ? a("\x3cdiv\x3e\x3c/div\x3e").text(c).text() : a("\x3cdiv\x3e\x3c/div\x3e").append(a.parseHTML(c)).html())) || this.set_text(b, l); this._data.core.focused = s.id; setTimeout(a.proxy(function () {
                            var a = this.get_node(s.id, !0); a.length && (this._data.core.focused =
                                s.id, a.children(".jstree-anchor").focus())
                        }, this), 0); d && d.call(this, s, c, t)
                    }, this), keydown: function (a) { var b = a.which; 27 === b && (t = !0, this.value = l); 27 !== b && 13 !== b && 37 !== b && 38 !== b && 39 !== b && 40 !== b && 32 !== b || a.stopImmediatePropagation(); if (27 === b || 13 === b) a.preventDefault(), this.blur() }, click: function (a) { a.stopImmediatePropagation() }, mousedown: function (a) { a.stopImmediatePropagation() }, keyup: function (a) { r.width(Math.min(m.text("pW" + this.value).width(), f)) }, keypress: function (a) { if (13 === a.which) return !1 }
                }); c =
                    { fontFamily: h.css("fontFamily") || "", fontSize: h.css("fontSize") || "", fontWeight: h.css("fontWeight") || "", fontStyle: h.css("fontStyle") || "", fontStretch: h.css("fontStretch") || "", fontVariant: h.css("fontVariant") || "", letterSpacing: h.css("letterSpacing") || "", wordSpacing: h.css("wordSpacing") || "" }; k.attr("class", h.attr("class")).append(h.contents().clone()).append(r); h.replaceWith(k); m.css(c); r.css(c).width(Math.min(m.text("pW" + r[0].value).width(), f))[0].select()
            }, set_theme: function (c, d) {
                if (!c) return !1; if (!0 ===
                    d) { var e = this.settings.core.themes.dir; e || (e = a.jstree.path + "/themes"); d = e + "/" + c + "/style.css" } d && -1 === a.inArray(d, b) && (a("head").append('\x3clink rel\x3d"stylesheet" href\x3d"' + d + '" type\x3d"text/css" /\x3e'), b.push(d)); this._data.core.themes.name && this.element.removeClass("jstree-" + this._data.core.themes.name); this._data.core.themes.name = c; this.element.addClass("jstree-" + c); this.element[this.settings.core.themes.responsive ? "addClass" : "removeClass"]("jstree-" + c + "-responsive"); this.trigger("set_theme",
                        { theme: c })
            }, get_theme: function () { return this._data.core.themes.name }, set_theme_variant: function (a) { this._data.core.themes.variant && this.element.removeClass("jstree-" + this._data.core.themes.name + "-" + this._data.core.themes.variant); (this._data.core.themes.variant = a) && this.element.addClass("jstree-" + this._data.core.themes.name + "-" + this._data.core.themes.variant) }, get_theme_variant: function () { return this._data.core.themes.variant }, show_stripes: function () { this._data.core.themes.stripes = !0; this.get_container_ul().addClass("jstree-striped") },
            hide_stripes: function () { this._data.core.themes.stripes = !1; this.get_container_ul().removeClass("jstree-striped") }, toggle_stripes: function () { this._data.core.themes.stripes ? this.hide_stripes() : this.show_stripes() }, show_dots: function () { this._data.core.themes.dots = !0; this.get_container_ul().removeClass("jstree-no-dots") }, hide_dots: function () { this._data.core.themes.dots = !1; this.get_container_ul().addClass("jstree-no-dots") }, toggle_dots: function () { this._data.core.themes.dots ? this.hide_dots() : this.show_dots() },
            show_icons: function () { this._data.core.themes.icons = !0; this.get_container_ul().removeClass("jstree-no-icons") }, hide_icons: function () { this._data.core.themes.icons = !1; this.get_container_ul().addClass("jstree-no-icons") }, toggle_icons: function () { this._data.core.themes.icons ? this.hide_icons() : this.show_icons() }, set_icon: function (b, c) {
                var d, e; if (a.isArray(b)) { b = b.slice(); d = 0; for (e = b.length; d < e; d++)this.set_icon(b[d], c); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; e = b.icon; b.icon = !0 ===
                    c || null === c || c === l || "" === c ? !0 : c; d = this.get_node(b, !0).children(".jstree-anchor").children(".jstree-themeicon"); !1 === c ? this.hide_icon(b) : (!0 === c || null === c || c === l || "" === c ? d.removeClass("jstree-themeicon-custom " + e).css("background", "").removeAttr("rel") : -1 === c.indexOf("/") && -1 === c.indexOf(".") ? (d.removeClass(e).css("background", ""), d.addClass(c + " jstree-themeicon-custom").attr("rel", c)) : (d.removeClass(e).css("background", ""), d.addClass("jstree-themeicon-custom").css("background", "url('" + c + "') center center no-repeat").attr("rel",
                        c)), !1 === e && this.show_icon(b)); return !0
            }, get_icon: function (b) { return (b = this.get_node(b)) && b.id !== a.jstree.root ? b.icon : !1 }, hide_icon: function (b) { var c, d; if (a.isArray(b)) { b = b.slice(); c = 0; for (d = b.length; c < d; c++)this.hide_icon(b[c]); return !0 } b = this.get_node(b); if (!b || b === a.jstree.root) return !1; b.icon = !1; this.get_node(b, !0).children(".jstree-anchor").children(".jstree-themeicon").addClass("jstree-themeicon-hidden"); return !0 }, show_icon: function (b) {
                var c, d; if (a.isArray(b)) {
                    b = b.slice(); c = 0; for (d = b.length; c <
                        d; c++)this.show_icon(b[c]); return !0
                } b = this.get_node(b); if (!b || b === a.jstree.root) return !1; c = this.get_node(b, !0); b.icon = c.length ? c.children(".jstree-anchor").children(".jstree-themeicon").attr("rel") : !0; b.icon || (b.icon = !0); c.children(".jstree-anchor").children(".jstree-themeicon").removeClass("jstree-themeicon-hidden"); return !0
            }
        }; a.vakata = {}; a.vakata.attributes = function (b, c) {
            b = a(b)[0]; var d = c ? {} : []; b && b.attributes && a.each(b.attributes, function (b, e) {
                -1 === a.inArray(e.name.toLowerCase(), ["style", "contenteditable",
                    "hasfocus", "tabindex"]) && null !== e.value && "" !== a.trim(e.value) && (c ? d[e.name] = e.value : d.push(e.name))
            }); return d
        }; a.vakata.array_unique = function (a) { var b = [], c, d, e = {}; c = 0; for (d = a.length; c < d; c++)e[a[c]] === l && (b.push(a[c]), e[a[c]] = !0); return b }; a.vakata.array_remove = function (a, b, c) { c = a.slice((c || b) + 1 || a.length); a.length = 0 > b ? a.length + b : b; a.push.apply(a, c); return a }; a.vakata.array_remove_item = function (b, c) { var d = a.inArray(c, b); return -1 !== d ? a.vakata.array_remove(b, d) : b }; a.jstree.plugins.changed = function (a,
            b) { var c = []; this.trigger = function (a, d) { var e, g; d || (d = {}); if ("changed" === a.replace(".jstree", "")) { d.changed = { selected: [], deselected: [] }; var f = {}; e = 0; for (g = c.length; e < g; e++)f[c[e]] = 1; e = 0; for (g = d.selected.length; e < g; e++)f[d.selected[e]] ? f[d.selected[e]] = 2 : d.changed.selected.push(d.selected[e]); e = 0; for (g = c.length; e < g; e++)1 === f[c[e]] && d.changed.deselected.push(c[e]); c = d.selected.slice() } b.trigger.call(this, a, d) }; this.refresh = function (a, d) { c = []; return b.refresh.apply(this, arguments) } }; var t = m.createElement("I");
    t.className = "jstree-icon jstree-checkbox"; t.setAttribute("role", "presentation"); a.jstree.defaults.checkbox = { visible: !0, three_state: !0, whole_node: !0, keep_selected_style: !0, cascade: "", tie_selection: !0 }; a.jstree.plugins.checkbox = function (b, c) {
        this.bind = function () {
            c.bind.call(this); this._data.checkbox.uto = !1; this._data.checkbox.selected = []; this.settings.checkbox.three_state && (this.settings.checkbox.cascade = "up+down+undetermined"); this.element.on("init.jstree", a.proxy(function () {
                this._data.checkbox.visible =
                this.settings.checkbox.visible; this.settings.checkbox.keep_selected_style || this.element.addClass("jstree-checkbox-no-clicked"); this.settings.checkbox.tie_selection && this.element.addClass("jstree-checkbox-selection")
            }, this)).on("loading.jstree", a.proxy(function () { this[this._data.checkbox.visible ? "show_checkboxes" : "hide_checkboxes"]() }, this)); if (-1 !== this.settings.checkbox.cascade.indexOf("undetermined")) this.element.on("changed.jstree uncheck_node.jstree check_node.jstree uncheck_all.jstree check_all.jstree move_node.jstree copy_node.jstree redraw.jstree open_node.jstree",
                a.proxy(function () { this._data.checkbox.uto && clearTimeout(this._data.checkbox.uto); this._data.checkbox.uto = setTimeout(a.proxy(this._undetermined, this), 50) }, this)); if (!this.settings.checkbox.tie_selection) this.element.on("model.jstree", a.proxy(function (a, b) { var c = this._model.data, d = b.nodes, e, g; e = 0; for (g = d.length; e < g; e++)c[d[e]].state.checked = c[d[e]].state.checked || c[d[e]].original && c[d[e]].original.state && c[d[e]].original.state.checked, c[d[e]].state.checked && this._data.checkbox.selected.push(d[e]) },
                    this)); if (-1 !== this.settings.checkbox.cascade.indexOf("up") || -1 !== this.settings.checkbox.cascade.indexOf("down")) this.element.on("model.jstree", a.proxy(function (b, c) {
                        var d = this._model.data, e = d[c.parent], g = c.nodes, f = [], h, k, l, m, r = this.settings.checkbox.cascade, u = this.settings.checkbox.tie_selection; if (-1 !== r.indexOf("down")) if (e.state[u ? "selected" : "checked"]) { h = 0; for (k = g.length; h < k; h++)d[g[h]].state[u ? "selected" : "checked"] = !0; this._data[u ? "core" : "checkbox"].selected = this._data[u ? "core" : "checkbox"].selected.concat(g) } else for (h =
                            0, k = g.length; h < k; h++)if (d[g[h]].state[u ? "selected" : "checked"]) { l = 0; for (m = d[g[h]].children_d.length; l < m; l++)d[d[g[h]].children_d[l]].state[u ? "selected" : "checked"] = !0; this._data[u ? "core" : "checkbox"].selected = this._data[u ? "core" : "checkbox"].selected.concat(d[g[h]].children_d) } if (-1 !== r.indexOf("up")) {
                                h = 0; for (k = e.children_d.length; h < k; h++)d[e.children_d[h]].children.length || f.push(d[e.children_d[h]].parent); f = a.vakata.array_unique(f); l = 0; for (m = f.length; l < m; l++)for (e = d[f[l]]; e && e.id !== a.jstree.root;) {
                                    h =
                                    g = 0; for (k = e.children.length; h < k; h++)g += d[e.children[h]].state[u ? "selected" : "checked"]; if (g === k) e.state[u ? "selected" : "checked"] = !0, this._data[u ? "core" : "checkbox"].selected.push(e.id), (h = this.get_node(e, !0)) && h.length && h.attr("aria-selected", !0).children(".jstree-anchor").addClass(u ? "jstree-clicked" : "jstree-checked"); else break; e = this.get_node(e.parent)
                                }
                            } this._data[u ? "core" : "checkbox"].selected = a.vakata.array_unique(this._data[u ? "core" : "checkbox"].selected)
                    }, this)).on(this.settings.checkbox.tie_selection ?
                        "select_node.jstree" : "check_node.jstree", a.proxy(function (b, c) {
                            var d = c.node, e = this._model.data, g = this.get_node(d.parent), f = this.get_node(d, !0), h, k, l, m = this.settings.checkbox.cascade, r = this.settings.checkbox.tie_selection; if (-1 !== m.indexOf("down")) for (this._data[r ? "core" : "checkbox"].selected = a.vakata.array_unique(this._data[r ? "core" : "checkbox"].selected.concat(d.children_d)), h = 0, k = d.children_d.length; h < k; h++)l = e[d.children_d[h]], l.state[r ? "selected" : "checked"] = !0, l && l.original && l.original.state && l.original.state.undetermined &&
                                (l.original.state.undetermined = !1); if (-1 !== m.indexOf("up")) for (; g && g.id !== a.jstree.root;) { h = d = 0; for (k = g.children.length; h < k; h++)d += e[g.children[h]].state[r ? "selected" : "checked"]; if (d === k) g.state[r ? "selected" : "checked"] = !0, this._data[r ? "core" : "checkbox"].selected.push(g.id), (l = this.get_node(g, !0)) && l.length && l.attr("aria-selected", !0).children(".jstree-anchor").addClass(r ? "jstree-clicked" : "jstree-checked"); else break; g = this.get_node(g.parent) } -1 !== m.indexOf("down") && f.length && f.find(".jstree-anchor").addClass(r ?
                                    "jstree-clicked" : "jstree-checked").parent().attr("aria-selected", !0)
                        }, this)).on(this.settings.checkbox.tie_selection ? "deselect_all.jstree" : "uncheck_all.jstree", a.proxy(function (b, c) { var d = this.get_node(a.jstree.root), e = this._model.data, g, f, h; g = 0; for (f = d.children_d.length; g < f; g++)(h = e[d.children_d[g]]) && h.original && h.original.state && h.original.state.undetermined && (h.original.state.undetermined = !1) }, this)).on(this.settings.checkbox.tie_selection ? "deselect_node.jstree" : "uncheck_node.jstree", a.proxy(function (b,
                            c) {
                                var d = c.node, e = this.get_node(d, !0), g, f, h, k = this.settings.checkbox.cascade, l = this.settings.checkbox.tie_selection; d && d.original && d.original.state && d.original.state.undetermined && (d.original.state.undetermined = !1); if (-1 !== k.indexOf("down")) for (g = 0, f = d.children_d.length; g < f; g++)h = this._model.data[d.children_d[g]], h.state[l ? "selected" : "checked"] = !1, h && h.original && h.original.state && h.original.state.undetermined && (h.original.state.undetermined = !1); if (-1 !== k.indexOf("up")) for (g = 0, f = d.parents.length; g <
                                    f; g++)h = this._model.data[d.parents[g]], h.state[l ? "selected" : "checked"] = !1, h && h.original && h.original.state && h.original.state.undetermined && (h.original.state.undetermined = !1), (h = this.get_node(d.parents[g], !0)) && h.length && h.attr("aria-selected", !1).children(".jstree-anchor").removeClass(l ? "jstree-clicked" : "jstree-checked"); h = []; g = 0; for (f = this._data[l ? "core" : "checkbox"].selected.length; g < f; g++)-1 !== k.indexOf("down") && -1 !== a.inArray(this._data[l ? "core" : "checkbox"].selected[g], d.children_d) || -1 !== k.indexOf("up") &&
                                        -1 !== a.inArray(this._data[l ? "core" : "checkbox"].selected[g], d.parents) || h.push(this._data[l ? "core" : "checkbox"].selected[g]); this._data[l ? "core" : "checkbox"].selected = a.vakata.array_unique(h); -1 !== k.indexOf("down") && e.length && e.find(".jstree-anchor").removeClass(l ? "jstree-clicked" : "jstree-checked").parent().attr("aria-selected", !1)
                        }, this)); if (-1 !== this.settings.checkbox.cascade.indexOf("up")) this.element.on("delete_node.jstree", a.proxy(function (b, c) {
                            for (var d = this.get_node(c.parent), e = this._model.data,
                                g, f, h, k = this.settings.checkbox.tie_selection; d && d.id !== a.jstree.root;) { g = h = 0; for (f = d.children.length; g < f; g++)h += e[d.children[g]].state[k ? "selected" : "checked"]; if (h === f) d.state[k ? "selected" : "checked"] = !0, this._data[k ? "core" : "checkbox"].selected.push(d.id), (g = this.get_node(d, !0)) && g.length && g.attr("aria-selected", !0).children(".jstree-anchor").addClass(k ? "jstree-clicked" : "jstree-checked"); else break; d = this.get_node(d.parent) }
                        }, this)).on("move_node.jstree", a.proxy(function (b, c) {
                            var d = c.is_multi, e = c.old_parent,
                            g = this.get_node(c.parent), f = this._model.data, h, k, l = this.settings.checkbox.tie_selection; if (!d) for (d = this.get_node(e); d && d.id !== a.jstree.root;) { h = e = 0; for (k = d.children.length; h < k; h++)e += f[d.children[h]].state[l ? "selected" : "checked"]; if (e === k) d.state[l ? "selected" : "checked"] = !0, this._data[l ? "core" : "checkbox"].selected.push(d.id), (e = this.get_node(d, !0)) && e.length && e.attr("aria-selected", !0).children(".jstree-anchor").addClass(l ? "jstree-clicked" : "jstree-checked"); else break; d = this.get_node(d.parent) } for (d =
                                g; d && d.id !== a.jstree.root;) {
                                    h = e = 0; for (k = d.children.length; h < k; h++)e += f[d.children[h]].state[l ? "selected" : "checked"]; if (e === k) d.state[l ? "selected" : "checked"] || (d.state[l ? "selected" : "checked"] = !0, this._data[l ? "core" : "checkbox"].selected.push(d.id), (e = this.get_node(d, !0)) && e.length && e.attr("aria-selected", !0).children(".jstree-anchor").addClass(l ? "jstree-clicked" : "jstree-checked")); else if (d.state[l ? "selected" : "checked"]) d.state[l ? "selected" : "checked"] = !1, this._data[l ? "core" : "checkbox"].selected = a.vakata.array_remove_item(this._data[l ?
                                        "core" : "checkbox"].selected, d.id), (e = this.get_node(d, !0)) && e.length && e.attr("aria-selected", !1).children(".jstree-anchor").removeClass(l ? "jstree-clicked" : "jstree-checked"); else break; d = this.get_node(d.parent)
                            }
                        }, this))
        }; this._undetermined = function () {
            if (null !== this.element) {
                var b, c, d, e, g = {}, f = this._model.data, h = this.settings.checkbox.tie_selection, k = this._data[h ? "core" : "checkbox"].selected, m = [], r = this; b = 0; for (c = k.length; b < c; b++)if (f[k[b]] && f[k[b]].parents) for (d = 0, e = f[k[b]].parents.length; d < e; d++)g[f[k[b]].parents[d]] ===
                    l && f[k[b]].parents[d] !== a.jstree.root && (g[f[k[b]].parents[d]] = !0, m.push(f[k[b]].parents[d])); this.element.find(".jstree-closed").not(":has(.jstree-children)").each(function () {
                        var h = r.get_node(this), k; if (h.state.loaded) for (b = 0, c = h.children_d.length; b < c; b++) {
                            if (k = f[h.children_d[b]], !k.state.loaded && k.original && k.original.state && k.original.state.undetermined && !0 === k.original.state.undetermined) for (g[k.id] === l && k.id !== a.jstree.root && (g[k.id] = !0, m.push(k.id)), d = 0, e = k.parents.length; d < e; d++)g[k.parents[d]] ===
                                l && k.parents[d] !== a.jstree.root && (g[k.parents[d]] = !0, m.push(k.parents[d]))
                        } else if (h.original && h.original.state && h.original.state.undetermined && !0 === h.original.state.undetermined) for (g[h.id] === l && h.id !== a.jstree.root && (g[h.id] = !0, m.push(h.id)), d = 0, e = h.parents.length; d < e; d++)g[h.parents[d]] === l && h.parents[d] !== a.jstree.root && (g[h.parents[d]] = !0, m.push(h.parents[d]))
                    }); this.element.find(".jstree-undetermined").removeClass("jstree-undetermined"); b = 0; for (c = m.length; b < c; b++)f[m[b]].state[h ? "selected" :
                        "checked"] || (k = this.get_node(m[b], !0)) && k.length && k.children(".jstree-anchor").children(".jstree-checkbox").addClass("jstree-undetermined")
            }
        }; this.redraw_node = function (b, d, e, g) {
            if (b = c.redraw_node.apply(this, arguments)) {
                var f, h, k = null; f = null; f = 0; for (h = b.childNodes.length; f < h; f++)if (b.childNodes[f] && b.childNodes[f].className && -1 !== b.childNodes[f].className.indexOf("jstree-anchor")) { k = b.childNodes[f]; break } k && (!this.settings.checkbox.tie_selection && this._model.data[b.id].state.checked && (k.className +=
                    " jstree-checked"), f = t.cloneNode(!1), this._model.data[b.id].state.checkbox_disabled && (f.className += " jstree-checkbox-disabled"), k.insertBefore(f, k.childNodes[0]))
            } e || -1 === this.settings.checkbox.cascade.indexOf("undetermined") || (this._data.checkbox.uto && clearTimeout(this._data.checkbox.uto), this._data.checkbox.uto = setTimeout(a.proxy(this._undetermined, this), 50)); return b
        }; this.show_checkboxes = function () { this._data.core.themes.checkboxes = !0; this.get_container_ul().removeClass("jstree-no-checkboxes") };
        this.hide_checkboxes = function () { this._data.core.themes.checkboxes = !1; this.get_container_ul().addClass("jstree-no-checkboxes") }; this.toggle_checkboxes = function () { this._data.core.themes.checkboxes ? this.hide_checkboxes() : this.show_checkboxes() }; this.is_undetermined = function (b) {
            b = this.get_node(b); var c = this.settings.checkbox.cascade, d; d = this.settings.checkbox.tie_selection; var e = this._data[d ? "core" : "checkbox"].selected, g = this._model.data; if (!b || !0 === b.state[d ? "selected" : "checked"] || -1 === c.indexOf("undetermined") ||
                -1 === c.indexOf("down") && -1 === c.indexOf("up")) return !1; if (!b.state.loaded && !0 === b.original.state.undetermined) return !0; c = 0; for (d = b.children_d.length; c < d; c++)if (-1 !== a.inArray(b.children_d[c], e) || !g[b.children_d[c]].state.loaded && g[b.children_d[c]].original.state.undetermined) return !0; return !1
        }; this.disable_checkbox = function (b) {
            var c, d; if (a.isArray(b)) { b = b.slice(); c = 0; for (d = b.length; c < d; c++)this.disable_checkbox(b[c]); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; c = this.get_node(b,
                !0); b.state.checkbox_disabled || (b.state.checkbox_disabled = !0, c && c.length && c.children(".jstree-anchor").children(".jstree-checkbox").addClass("jstree-checkbox-disabled"), this.trigger("disable_checkbox", { node: b }))
        }; this.enable_checkbox = function (b) {
            var c, d; if (a.isArray(b)) { b = b.slice(); c = 0; for (d = b.length; c < d; c++)this.enable_checkbox(b[c]); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; c = this.get_node(b, !0); b.state.checkbox_disabled && (b.state.checkbox_disabled = !1, c && c.length && c.children(".jstree-anchor").children(".jstree-checkbox").removeClass("jstree-checkbox-disabled"),
                this.trigger("enable_checkbox", { node: b }))
        }; this.activate_node = function (b, d) {
            if (a(d.target).hasClass("jstree-checkbox-disabled")) return !1; this.settings.checkbox.tie_selection && (this.settings.checkbox.whole_node || a(d.target).hasClass("jstree-checkbox")) && (d.ctrlKey = !0); if (this.settings.checkbox.tie_selection || !this.settings.checkbox.whole_node && !a(d.target).hasClass("jstree-checkbox")) return c.activate_node.call(this, b, d); if (this.is_disabled(b)) return !1; this.is_checked(b) ? this.uncheck_node(b, d) : this.check_node(b,
                d); this.trigger("activate_node", { node: this.get_node(b) })
        }; this.check_node = function (b, c) {
            if (this.settings.checkbox.tie_selection) return this.select_node(b, !1, !0, c); var d, e; if (a.isArray(b)) { b = b.slice(); d = 0; for (e = b.length; d < e; d++)this.check_node(b[d], c); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; d = this.get_node(b, !0); b.state.checked || (b.state.checked = !0, this._data.checkbox.selected.push(b.id), d && d.length && d.children(".jstree-anchor").addClass("jstree-checked"), this.trigger("check_node",
                { node: b, selected: this._data.checkbox.selected, event: c }))
        }; this.uncheck_node = function (b, c) {
            if (this.settings.checkbox.tie_selection) return this.deselect_node(b, !1, c); var d, e; if (a.isArray(b)) { b = b.slice(); d = 0; for (e = b.length; d < e; d++)this.uncheck_node(b[d], c); return !0 } b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; d = this.get_node(b, !0); b.state.checked && (b.state.checked = !1, this._data.checkbox.selected = a.vakata.array_remove_item(this._data.checkbox.selected, b.id), d.length && d.children(".jstree-anchor").removeClass("jstree-checked"),
                this.trigger("uncheck_node", { node: b, selected: this._data.checkbox.selected, event: c }))
        }; this.check_all = function () {
            if (this.settings.checkbox.tie_selection) return this.select_all(); this._data.checkbox.selected.concat([]); var b, c; this._data.checkbox.selected = this._model.data[a.jstree.root].children_d.concat(); b = 0; for (c = this._data.checkbox.selected.length; b < c; b++)this._model.data[this._data.checkbox.selected[b]] && (this._model.data[this._data.checkbox.selected[b]].state.checked = !0); this.redraw(!0); this.trigger("check_all",
                { selected: this._data.checkbox.selected })
        }; this.uncheck_all = function () {
            if (this.settings.checkbox.tie_selection) return this.deselect_all(); var a = this._data.checkbox.selected.concat([]), b, c; b = 0; for (c = this._data.checkbox.selected.length; b < c; b++)this._model.data[this._data.checkbox.selected[b]] && (this._model.data[this._data.checkbox.selected[b]].state.checked = !1); this._data.checkbox.selected = []; this.element.find(".jstree-checked").removeClass("jstree-checked"); this.trigger("uncheck_all", {
                selected: this._data.checkbox.selected,
                node: a
            })
        }; this.is_checked = function (b) { return this.settings.checkbox.tie_selection ? this.is_selected(b) : (b = this.get_node(b)) && b.id !== a.jstree.root ? b.state.checked : !1 }; this.get_checked = function (b) { return this.settings.checkbox.tie_selection ? this.get_selected(b) : b ? a.map(this._data.checkbox.selected, a.proxy(function (a) { return this.get_node(a) }, this)) : this._data.checkbox.selected }; this.get_top_checked = function (b) {
            if (this.settings.checkbox.tie_selection) return this.get_top_selected(b); var c = this.get_checked(!0),
                d = {}, e, g, f, h; e = 0; for (g = c.length; e < g; e++)d[c[e].id] = c[e]; e = 0; for (g = c.length; e < g; e++)for (f = 0, h = c[e].children_d.length; f < h; f++)d[c[e].children_d[f]] && delete d[c[e].children_d[f]]; c = []; for (e in d) d.hasOwnProperty(e) && c.push(e); return b ? a.map(c, a.proxy(function (a) { return this.get_node(a) }, this)) : c
        }; this.get_bottom_checked = function (b) {
            if (this.settings.checkbox.tie_selection) return this.get_bottom_selected(b); var c = this.get_checked(!0), d = [], e, g; e = 0; for (g = c.length; e < g; e++)c[e].children.length || d.push(c[e].id);
            return b ? a.map(d, a.proxy(function (a) { return this.get_node(a) }, this)) : d
        }; this.load_node = function (b, d) { var e, g, f; if (!a.isArray(b) && !this.settings.checkbox.tie_selection && (f = this.get_node(b)) && f.state.loaded) for (e = 0, g = f.children_d.length; e < g; e++)this._model.data[f.children_d[e]].state.checked && (this._data.checkbox.selected = a.vakata.array_remove_item(this._data.checkbox.selected, f.children_d[e])); return c.load_node.apply(this, arguments) }; this.get_state = function () {
            var a = c.get_state.apply(this, arguments);
            if (this.settings.checkbox.tie_selection) return a; a.checkbox = this._data.checkbox.selected.slice(); return a
        }; this.set_state = function (b, d) { var e = c.set_state.apply(this, arguments); if (e && b.checkbox) { if (!this.settings.checkbox.tie_selection) { this.uncheck_all(); var g = this; a.each(b.checkbox, function (a, b) { g.check_node(b) }) } delete b.checkbox; this.set_state(b, d); return !1 } return e }; this.refresh = function (a, b) { this.settings.checkbox.tie_selection || (this._data.checkbox.selected = []); return c.refresh.apply(this, arguments) }
    };
    a.jstree.defaults.conditionalselect = function () { return !0 }; a.jstree.plugins.conditionalselect = function (a, b) { this.activate_node = function (a, c) { this.settings.conditionalselect.call(this, this.get_node(a), c) && b.activate_node.call(this, a, c) } }; a.jstree.defaults.contextmenu = {
        select_node: !0, show_at_node: !0, items: function (b, c) {
            return {
                create: {
                    separator_before: !1, separator_after: !0, _disabled: !1, label: "Create", action: function (b) {
                        var c = a.jstree.reference(b.reference); b = c.get_node(b.reference); c.create_node(b, {},
                            "last", function (a) { setTimeout(function () { c.edit(a) }, 0) })
                    }
                }, rename: { separator_before: !1, separator_after: !1, _disabled: !1, label: "Rename", action: function (b) { var c = a.jstree.reference(b.reference); b = c.get_node(b.reference); c.edit(b) } }, remove: { separator_before: !1, icon: !1, separator_after: !1, _disabled: !1, label: "Delete", action: function (b) { var c = a.jstree.reference(b.reference); b = c.get_node(b.reference); c.is_selected(b) ? c.delete_node(c.get_selected()) : c.delete_node(b) } }, ccp: {
                    separator_before: !0, icon: !1, separator_after: !1,
                    label: "Edit", action: !1, submenu: {
                        cut: { separator_before: !1, separator_after: !1, label: "Cut", action: function (b) { var c = a.jstree.reference(b.reference); b = c.get_node(b.reference); c.is_selected(b) ? c.cut(c.get_top_selected()) : c.cut(b) } }, copy: { separator_before: !1, icon: !1, separator_after: !1, label: "Copy", action: function (b) { var c = a.jstree.reference(b.reference); b = c.get_node(b.reference); c.is_selected(b) ? c.copy(c.get_top_selected()) : c.copy(b) } }, paste: {
                            separator_before: !1, icon: !1, _disabled: function (b) { return !a.jstree.reference(b.reference).can_paste() },
                            separator_after: !1, label: "Paste", action: function (b) { var c = a.jstree.reference(b.reference); b = c.get_node(b.reference); c.paste(b) }
                        }
                    }
                }
            }
        }
    }; a.jstree.plugins.contextmenu = function (b, c) {
        this.bind = function () {
            c.bind.call(this); var b = 0, d = null, e, g; this.element.on("contextmenu.jstree", ".jstree-anchor", a.proxy(function (a, c) { a.preventDefault(); b = a.ctrlKey ? +new Date : 0; if (c || d) b = +new Date + 1E4; d && clearTimeout(d); this.is_loading(a.currentTarget) || this.show_contextmenu(a.currentTarget, a.pageX, a.pageY, a) }, this)).on("click.jstree",
                ".jstree-anchor", a.proxy(function (c) { this._data.contextmenu.visible && (!b || 250 < +new Date - b) && a.vakata.context.hide(); b = 0 }, this)).on("touchstart.jstree", ".jstree-anchor", function (b) { b.originalEvent && b.originalEvent.changedTouches && b.originalEvent.changedTouches[0] && (e = b.pageX, g = b.pageY, d = setTimeout(function () { a(b.currentTarget).trigger("contextmenu", !0) }, 750)) }).on("touchmove.vakata.jstree", function (a) {
                    d && a.originalEvent && a.originalEvent.changedTouches && a.originalEvent.changedTouches[0] && (50 < Math.abs(e -
                        a.pageX) || 50 < Math.abs(g - a.pageY)) && clearTimeout(d)
                }).on("touchend.vakata.jstree", function (a) { d && clearTimeout(d) }); a(m).on("context_hide.vakata.jstree", a.proxy(function () { this._data.contextmenu.visible = !1 }, this))
        }; this.teardown = function () { this._data.contextmenu.visible && a.vakata.context.hide(); c.teardown.call(this) }; this.show_contextmenu = function (b, c, d, e) {
            b = this.get_node(b); if (!b || b.id === a.jstree.root) return !1; var g = this.settings.contextmenu, f = this.get_node(b, !0).children(".jstree-anchor"), h = !1, h =
                !1; if (g.show_at_node || c === l || d === l) h = f.offset(), c = h.left, d = h.top + this._data.core.li_height; this.settings.contextmenu.select_node && !this.is_selected(b) && this.activate_node(b, e); h = g.items; a.isFunction(h) && (h = h.call(this, b, a.proxy(function (a) { this._show_contextmenu(b, c, d, a) }, this))); a.isPlainObject(h) && this._show_contextmenu(b, c, d, h)
        }; this._show_contextmenu = function (b, c, d, e) {
            var g = this.get_node(b, !0).children(".jstree-anchor"); a(m).one("context_show.vakata.jstree", a.proxy(function (b, c) {
                var d = "jstree-contextmenu jstree-" +
                    this.get_theme() + "-contextmenu"; a(c.element).addClass(d)
            }, this)); this._data.contextmenu.visible = !0; a.vakata.context.show(g, { x: c, y: d }, e); this.trigger("show_contextmenu", { node: b, x: c, y: d })
        }
    }; (function (a) {
        var b = !1, c = !1, d = !1, e = 0, f = 0, h = [], k = "", l = !1; a.vakata.context = {
            settings: { hide_onmouseleave: 0, icons: !0 }, _trigger: function (b) { a(m).triggerHandler("context_" + b + ".vakata", { reference: d, element: c, position: { x: e, y: f } }) }, _execute: function (b) {
                return (b = h[b]) && (!b._disabled || a.isFunction(b._disabled) && !b._disabled({
                    item: b,
                    reference: d, element: c
                })) && b.action ? b.action.call(null, { item: b, reference: d, element: c, position: { x: e, y: f } }) : !1
            }, _parse: function (b, e) {
                if (!b) return !1; e || (k = "", h = []); var f = "", l = !1, m; e && (f += "\x3cul\x3e"); a.each(b, function (b, e) {
                    if (!e) return !0; h.push(e); !l && e.separator_before && (f += "\x3cli class\x3d'vakata-context-separator'\x3e\x3ca href\x3d'#' " + (a.vakata.context.settings.icons ? "" : 'style\x3d"margin-left:0px;"') + "\x3e\x26#160;\x3c/a\x3e\x3c/li\x3e"); l = !1; f += "\x3cli class\x3d'" + (e._class || "") + (!0 === e._disabled ||
                        a.isFunction(e._disabled) && e._disabled({ item: e, reference: d, element: c }) ? " vakata-contextmenu-disabled " : "") + "' " + (e.shortcut ? " data-shortcut\x3d'" + e.shortcut + "' " : "") + "\x3e"; f += "\x3ca href\x3d'#' rel\x3d'" + (h.length - 1) + "'\x3e"; a.vakata.context.settings.icons && (f += "\x3ci ", e.icon && (f = -1 !== e.icon.indexOf("/") || -1 !== e.icon.indexOf(".") ? f + (" style\x3d'background:url(\"" + e.icon + "\") center center no-repeat' ") : f + (" class\x3d'" + e.icon + "' ")), f += "\x3e\x3c/i\x3e\x3cspan class\x3d'vakata-contextmenu-sep'\x3e\x26#160;\x3c/span\x3e");
                    f += (a.isFunction(e.label) ? e.label({ item: b, reference: d, element: c }) : e.label) + (e.shortcut ? ' \x3cspan class\x3d"vakata-contextmenu-shortcut vakata-contextmenu-shortcut-' + e.shortcut + '"\x3e' + (e.shortcut_label || "") + "\x3c/span\x3e" : "") + "\x3c/a\x3e"; e.submenu && (m = a.vakata.context._parse(e.submenu, !0)) && (f += m); f += "\x3c/li\x3e"; e.separator_after && (f += "\x3cli class\x3d'vakata-context-separator'\x3e\x3ca href\x3d'#' " + (a.vakata.context.settings.icons ? "" : 'style\x3d"margin-left:0px;"') + "\x3e\x26#160;\x3c/a\x3e\x3c/li\x3e",
                        l = !0)
                }); f = f.replace(/<li class\='vakata-context-separator'\><\/li\>$/, ""); e && (f += "\x3c/ul\x3e"); e || (k = f, a.vakata.context._trigger("parse")); return 10 < f.length ? f : !1
            }, _show_submenu: function (c) {
                c = a(c); if (c.length && c.children("ul").length) {
                    var d = c.children("ul"), e = c.offset().left + c.outerWidth(), f = c.offset().top, h = d.width(), k = d.height(), l = a(window).width() + a(window).scrollLeft(), m = a(window).height() + a(window).scrollTop(); if (b) c[0 > e - (h + 10 + c.outerWidth()) ? "addClass" : "removeClass"]("vakata-context-left");
                    else c[e + h + 10 > l ? "addClass" : "removeClass"]("vakata-context-right"); f + k + 10 > m && d.css("bottom", "-1px"); d.show()
                }
            }, show: function (m, r, s) {
                var t, v, y, F, z; c && c.length && c.width(""); switch (!0) { case !r && !m: return !1; case !!r && !!m: d = m; e = r.x; f = r.y; break; case !r && !!m: d = m; r = m.offset(); e = r.left + m.outerHeight(); f = r.top; break; case !!r && !m: e = r.x, f = r.y }m && !s && a(m).data("vakata_contextmenu") && (s = a(m).data("vakata_contextmenu")); a.vakata.context._parse(s) && c.html(k); h.length && (c.appendTo("body"), s = c, r = e, t = f, v = s.width(), y =
                    s.height(), F = a(window).width() + a(window).scrollLeft(), z = a(window).height() + a(window).scrollTop(), b && (r -= s.outerWidth() - a(m).outerWidth(), r < a(window).scrollLeft() + 20 && (r = a(window).scrollLeft() + 20)), r + v + 20 > F && (r = F - (v + 20)), t + y + 20 > z && (t = z - (y + 20)), c.css({ left: r, top: t }).show().find("a").first().focus().parent().addClass("vakata-context-hover"), l = !0, a.vakata.context._trigger("show"))
            }, hide: function () { l && (c.hide().find("ul").hide().end().find(":focus").blur().end().detach(), l = !1, a.vakata.context._trigger("hide")) }
        };
        a(function () {
            b = "rtl" === a("body").css("direction"); var d = !1; c = a("\x3cul class\x3d'vakata-context'\x3e\x3c/ul\x3e"); c.on("mouseenter", "li", function (b) { b.stopImmediatePropagation(); a.contains(this, b.relatedTarget) || (d && clearTimeout(d), c.find(".vakata-context-hover").removeClass("vakata-context-hover").end(), a(this).siblings().find("ul").hide().end().end().parentsUntil(".vakata-context", "li").addBack().addClass("vakata-context-hover"), a.vakata.context._show_submenu(this)) }).on("mouseleave", "li", function (b) {
                a.contains(this,
                    b.relatedTarget) || a(this).find(".vakata-context-hover").addBack().removeClass("vakata-context-hover")
            }).on("mouseleave", function (b) { a(this).find(".vakata-context-hover").removeClass("vakata-context-hover"); a.vakata.context.settings.hide_onmouseleave && (d = setTimeout(function (b) { return function () { a.vakata.context.hide() } }(this), a.vakata.context.settings.hide_onmouseleave)) }).on("click", "a", function (b) {
                b.preventDefault(); a(this).blur().parent().hasClass("vakata-context-disabled") || !1 === a.vakata.context._execute(a(this).attr("rel")) ||
                    a.vakata.context.hide()
            }).on("keydown", "a", function (b) {
                var d = null; switch (b.which) {
                    case 13: case 32: b.type = "mouseup"; b.preventDefault(); a(b.currentTarget).trigger(b); break; case 37: l && (c.find(".vakata-context-hover").last().closest("li").first().find("ul").hide().find(".vakata-context-hover").removeClass("vakata-context-hover").end().end().children("a").focus(), b.stopImmediatePropagation(), b.preventDefault()); break; case 38: l && (d = c.find("ul:visible").addBack().last().children(".vakata-context-hover").removeClass("vakata-context-hover").prevAll("li:not(.vakata-context-separator)").first(),
                        d.length || (d = c.find("ul:visible").addBack().last().children("li:not(.vakata-context-separator)").last()), d.addClass("vakata-context-hover").children("a").focus(), b.stopImmediatePropagation(), b.preventDefault()); break; case 39: l && (c.find(".vakata-context-hover").last().children("ul").show().children("li:not(.vakata-context-separator)").removeClass("vakata-context-hover").first().addClass("vakata-context-hover").children("a").focus(), b.stopImmediatePropagation(), b.preventDefault()); break; case 40: l &&
                            (d = c.find("ul:visible").addBack().last().children(".vakata-context-hover").removeClass("vakata-context-hover").nextAll("li:not(.vakata-context-separator)").first(), d.length || (d = c.find("ul:visible").addBack().last().children("li:not(.vakata-context-separator)").first()), d.addClass("vakata-context-hover").children("a").focus(), b.stopImmediatePropagation(), b.preventDefault()); break; case 27: a.vakata.context.hide(), b.preventDefault()
                }
            }).on("keydown", function (a) {
                a.preventDefault(); a = c.find(".vakata-contextmenu-shortcut-" +
                    a.which).parent(); a.parent().not(".vakata-context-disabled") && a.click()
            }); a(m).on("mousedown.vakata.jstree", function (b) { l && !a.contains(c[0], b.target) && a.vakata.context.hide() }).on("context_show.vakata.jstree", function (a, d) { c.find("li:has(ul)").children("a").addClass("vakata-context-parent"); b && c.addClass("vakata-context-rtl").css("direction", "rtl"); c.find("ul").hide().end() })
        })
    })(a); a.jstree.defaults.dnd = {
        copy: !0, open_timeout: 500, is_draggable: !0, check_while_dragging: !0, always_copy: !1, inside_pos: 0,
        drag_selection: !0, touch: !0, large_drop_target: !1, large_drag_target: !1
    }; a.jstree.plugins.dnd = function (b, c) {
        this.bind = function () {
            c.bind.call(this); this.element.on("mousedown.jstree touchstart.jstree", this.settings.dnd.large_drag_target ? ".jstree-node" : ".jstree-anchor", a.proxy(function (b) {
                if (this.settings.dnd.large_drag_target && a(b.target).closest(".jstree-node")[0] !== b.currentTarget || "touchstart" === b.type && (!this.settings.dnd.touch || "selected" === this.settings.dnd.touch && !a(b.currentTarget).closest(".jstree-node").children(".jstree-anchor").hasClass("jstree-clicked"))) return !0;
                var c = this.get_node(b.target), d = this.is_selected(c) && this.settings.dnd.drag_selection ? this.get_top_selected().length : 1, e = 1 < d ? d + " " + this.get_string("nodes") : this.get_text(b.currentTarget); this.settings.core.force_text && (e = a.vakata.html.escape(e)); if (c && c.id && c.id !== a.jstree.root && (1 === b.which || "touchstart" === b.type) && (!0 === this.settings.dnd.is_draggable || a.isFunction(this.settings.dnd.is_draggable) && this.settings.dnd.is_draggable.call(this, 1 < d ? this.get_top_selected(!0) : [c], b))) return this.element.trigger("mousedown.jstree"),
                    a.vakata.dnd.start(b, { jstree: !0, origin: this, obj: this.get_node(c, !0), nodes: 1 < d ? this.get_top_selected() : [c.id] }, '\x3cdiv id\x3d"jstree-dnd" class\x3d"jstree-' + this.get_theme() + " jstree-" + this.get_theme() + "-" + this.get_theme_variant() + " " + (this.settings.core.themes.responsive ? " jstree-dnd-responsive" : "") + '"\x3e\x3ci class\x3d"jstree-icon jstree-er"\x3e\x3c/i\x3e' + e + '\x3cins class\x3d"jstree-copy" style\x3d"display:none;"\x3e+\x3c/ins\x3e\x3c/div\x3e')
            }, this))
        }
    }; a(function () {
        var b = !1, c = !1, d = !1, e = !1, f =
            a('\x3cdiv id\x3d"jstree-marker"\x3e\x26#160;\x3c/div\x3e').hide(); a(m).on("dnd_start.vakata.jstree", function (a, c) { d = b = !1; c && c.data && c.data.jstree && f.appendTo("body") }).on("dnd_move.vakata.jstree", function (h, k) {
                e && clearTimeout(e); if (k && k.data && k.data.jstree && (!k.event.target.id || "jstree-marker" !== k.event.target.id)) {
                    d = k.event; var l = a.jstree.reference(k.event.target), m = !1, r = !1, s = !1, t, v, y, z, F, T, U, H, R, N, L, ha, ba, ca; if (l && l._data && l._data.dnd) if (f.attr("class", "jstree-" + l.get_theme() + (l.settings.core.themes.responsive ?
                        " jstree-dnd-responsive" : "")), k.helper.children().attr("class", "jstree-" + l.get_theme() + " jstree-" + l.get_theme() + "-" + l.get_theme_variant() + " " + (l.settings.core.themes.responsive ? " jstree-dnd-responsive" : "")).find(".jstree-copy").first()[k.data.origin && (k.data.origin.settings.dnd.always_copy || k.data.origin.settings.dnd.copy && (k.event.metaKey || k.event.ctrlKey)) ? "show" : "hide"](), k.event.target !== l.element[0] && k.event.target !== l.get_container_ul()[0] || 0 !== l.get_container_ul().children().length) {
                            if ((m =
                                l.settings.dnd.large_drop_target ? a(k.event.target).closest(".jstree-node").children(".jstree-anchor") : a(k.event.target).closest(".jstree-anchor")) && m.length && m.parent().is(".jstree-closed, .jstree-open, .jstree-leaf") && (r = m.offset(), s = k.event.pageY - r.top, y = m.outerHeight(), T = s < y / 3 ? ["b", "i", "a"] : s > y - y / 3 ? ["a", "i", "b"] : s > y / 2 ? ["i", "a", "b"] : ["i", "b", "a"], a.each(T, function (d, h) {
                                    switch (h) {
                                        case "b": t = r.left - 6; v = r.top; z = l.get_parent(m); F = m.parent().index(); break; case "i": ba = l.settings.dnd.inside_pos; ca = l.get_node(m.parent());
                                            t = r.left - 2; v = r.top + y / 2 + 1; z = ca.id; F = "first" === ba ? 0 : "last" === ba ? ca.children.length : Math.min(ba, ca.children.length); break; case "a": t = r.left - 6, v = r.top + y, z = l.get_parent(m), F = m.parent().index() + 1
                                    }U = !0; H = 0; for (R = k.data.nodes.length; H < R; H++)if (N = k.data.origin && (k.data.origin.settings.dnd.always_copy || k.data.origin.settings.dnd.copy && (k.event.metaKey || k.event.ctrlKey)) ? "copy_node" : "move_node", L = F, "move_node" === N && "a" === h && k.data.origin && k.data.origin === l && z === l.get_parent(k.data.nodes[H]) && (ha = l.get_node(z),
                                        L > a.inArray(k.data.nodes[H], ha.children) && (L -= 1)), U = U && (l && l.settings && l.settings.dnd && !1 === l.settings.dnd.check_while_dragging || l.check(N, k.data.origin && k.data.origin !== l ? k.data.origin.get_node(k.data.nodes[H]) : k.data.nodes[H], z, L, { dnd: !0, ref: l.get_node(m.parent()), pos: h, origin: k.data.origin, is_multi: k.data.origin && k.data.origin !== l, is_foreign: !k.data.origin })), !U) { l && l.last_error && (c = l.last_error()); break } "i" === h && m.parent().is(".jstree-closed") && l.settings.dnd.open_timeout && (e = setTimeout(function (a,
                                            b) { return function () { a.open_node(b) } }(l, m), l.settings.dnd.open_timeout)); if (U) return b = { ins: l, par: z, pos: "i" !== h || "last" !== ba || 0 !== F || l.is_loaded(ca) ? F : "last" }, f.css({ left: t + "px", top: v + "px" }).show(), k.helper.find(".jstree-icon").first().removeClass("jstree-er").addClass("jstree-ok"), c = {}, T = !0, !1
                                }), !0 === T)) return
                    } else {
                        U = !0; H = 0; for (R = k.data.nodes.length; H < R && (U = U && l.check(k.data.origin && (k.data.origin.settings.dnd.always_copy || k.data.origin.settings.dnd.copy && (k.event.metaKey || k.event.ctrlKey)) ? "copy_node" :
                            "move_node", k.data.origin && k.data.origin !== l ? k.data.origin.get_node(k.data.nodes[H]) : k.data.nodes[H], a.jstree.root, "last", { dnd: !0, ref: l.get_node(a.jstree.root), pos: "i", origin: k.data.origin, is_multi: k.data.origin && k.data.origin !== l, is_foreign: !k.data.origin }), U); H++); if (U) { b = { ins: l, par: a.jstree.root, pos: "last" }; f.hide(); k.helper.find(".jstree-icon").first().removeClass("jstree-er").addClass("jstree-ok"); return }
                    } b = !1; k.helper.find(".jstree-icon").removeClass("jstree-ok").addClass("jstree-er"); f.hide()
                }
            }).on("dnd_scroll.vakata.jstree",
                function (a, c) { c && c.data && c.data.jstree && (f.hide(), d = b = !1, c.helper.find(".jstree-icon").first().removeClass("jstree-ok").addClass("jstree-er")) }).on("dnd_stop.vakata.jstree", function (h, k) {
                    e && clearTimeout(e); if (k && k.data && k.data.jstree) {
                        f.hide().detach(); var l, m, r = []; if (b) {
                            l = 0; for (m = k.data.nodes.length; l < m; l++)r[l] = k.data.origin ? k.data.origin.get_node(k.data.nodes[l]) : k.data.nodes[l]; b.ins[k.data.origin && (k.data.origin.settings.dnd.always_copy || k.data.origin.settings.dnd.copy && (k.event.metaKey || k.event.ctrlKey)) ?
                                "copy_node" : "move_node"](r, b.par, b.pos, !1, !1, !1, k.data.origin)
                        } else l = a(k.event.target).closest(".jstree"), l.length && c && c.error && "check" === c.error && (l = l.jstree(!0)) && l.settings.core.error.call(this, c); b = d = !1
                    }
                }).on("keyup.jstree keydown.jstree", function (b, c) {
                    (c = a.vakata.dnd._get()) && c.data && c.data.jstree && (c.helper.find(".jstree-copy").first()[c.data.origin && (c.data.origin.settings.dnd.always_copy || c.data.origin.settings.dnd.copy && (b.metaKey || b.ctrlKey)) ? "show" : "hide"](), d && (d.metaKey = b.metaKey, d.ctrlKey =
                        b.ctrlKey, a.vakata.dnd._trigger("move", d)))
                })
    }); (function (a) {
        a.vakata.html = { div: a("\x3cdiv /\x3e"), escape: function (b) { return a.vakata.html.div.text(b).html() }, strip: function (b) { return a.vakata.html.div.empty().append(a.parseHTML(b)).text() } }; var b = !1, c = !1, d = !1, e = !1, f = !1, h = 0, k = !1, l = 0, r = 0, s = 0, t = 0, v = !1, y = !1, z = !1; a.vakata.dnd = {
            settings: { scroll_speed: 10, scroll_proximity: 20, helper_left: 5, helper_top: 10, threshold: 5, threshold_touch: 50 }, _trigger: function (b, c) {
                var d = a.vakata.dnd._get(); d.event = c; a(m).triggerHandler("dnd_" +
                    b + ".vakata", d)
            }, _get: function () { return { data: k, element: b, helper: f } }, _clean: function () { f && f.remove(); y && (clearInterval(y), y = !1); f = e = d = c = b = !1; h = 0; k = !1; t = s = r = l = 0; z = y = v = !1; a(m).off("mousemove.vakata.jstree touchmove.vakata.jstree", a.vakata.dnd.drag); a(m).off("mouseup.vakata.jstree touchend.vakata.jstree", a.vakata.dnd.stop) }, _scroll: function (b) {
                if (!v || !s && !t) return y && (clearInterval(y), y = !1), !1; if (!y) return y = setInterval(a.vakata.dnd._scroll, 100), !1; if (!0 === b) return !1; b = v.scrollTop(); var c = v.scrollLeft();
                v.scrollTop(b + t * a.vakata.dnd.settings.scroll_speed); v.scrollLeft(c + s * a.vakata.dnd.settings.scroll_speed); b === v.scrollTop() && c === v.scrollLeft() || a.vakata.dnd._trigger("scroll", v)
            }, start: function (h, s, t) {
                "touchstart" === h.type && h.originalEvent && h.originalEvent.changedTouches && h.originalEvent.changedTouches[0] && (h.pageX = h.originalEvent.changedTouches[0].pageX, h.pageY = h.originalEvent.changedTouches[0].pageY, h.target = m.elementFromPoint(h.originalEvent.changedTouches[0].pageX - window.pageXOffset, h.originalEvent.changedTouches[0].pageY -
                    window.pageYOffset)); e && a.vakata.dnd.stop({}); try { h.currentTarget.unselectable = "on", h.currentTarget.onselectstart = function () { return !1 }, h.currentTarget.style && (h.currentTarget.style.MozUserSelect = "none") } catch (A) { } l = h.pageX; r = h.pageY; k = s; d = !0; b = h.currentTarget; c = h.target; z = "touchstart" === h.type; !1 !== t && (f = a("\x3cdiv id\x3d'vakata-dnd'\x3e\x3c/div\x3e").html(t).css({ display: "block", margin: "0", padding: "0", position: "absolute", top: "-2000px", lineHeight: "16px", zIndex: "10000" })); a(m).on("mousemove.vakata.jstree touchmove.vakata.jstree",
                        a.vakata.dnd.drag); a(m).on("mouseup.vakata.jstree touchend.vakata.jstree", a.vakata.dnd.stop); return !1
            }, drag: function (b) {
                "touchmove" === b.type && b.originalEvent && b.originalEvent.changedTouches && b.originalEvent.changedTouches[0] && (b.pageX = b.originalEvent.changedTouches[0].pageX, b.pageY = b.originalEvent.changedTouches[0].pageY, b.target = m.elementFromPoint(b.originalEvent.changedTouches[0].pageX - window.pageXOffset, b.originalEvent.changedTouches[0].pageY - window.pageYOffset)); if (d) {
                    if (!e) if (Math.abs(b.pageX -
                        l) > (z ? a.vakata.dnd.settings.threshold_touch : a.vakata.dnd.settings.threshold) || Math.abs(b.pageY - r) > (z ? a.vakata.dnd.settings.threshold_touch : a.vakata.dnd.settings.threshold)) f && (f.appendTo("body"), h = f.outerWidth()), e = !0, a.vakata.dnd._trigger("start", b); else return; var c = !1, k = !1, q = !1, u = !1, y = !1, I = k = !1, K = !1, u = c = !1; s = t = 0; v = !1; a(a(b.target).parentsUntil("body").addBack().get().reverse()).filter(function () {
                            return /^auto|scroll$/.test(a(this).css("overflow")) && (this.scrollHeight > this.offsetHeight || this.scrollWidth >
                                this.offsetWidth)
                        }).each(function () { var c = a(this), d = c.offset(); this.scrollHeight > this.offsetHeight && (d.top + c.height() - b.pageY < a.vakata.dnd.settings.scroll_proximity && (t = 1), b.pageY - d.top < a.vakata.dnd.settings.scroll_proximity && (t = -1)); this.scrollWidth > this.offsetWidth && (d.left + c.width() - b.pageX < a.vakata.dnd.settings.scroll_proximity && (s = 1), b.pageX - d.left < a.vakata.dnd.settings.scroll_proximity && (s = -1)); if (t || s) return v = a(this), !1 }); !v && (c = a(m), k = a(window), q = c.height(), u = k.height(), y = c.width(), k = k.width(),
                            I = c.scrollTop(), K = c.scrollLeft(), q > u && b.pageY - I < a.vakata.dnd.settings.scroll_proximity && (t = -1), q > u && u - (b.pageY - I) < a.vakata.dnd.settings.scroll_proximity && (t = 1), y > k && b.pageX - K < a.vakata.dnd.settings.scroll_proximity && (s = -1), y > k && k - (b.pageX - K) < a.vakata.dnd.settings.scroll_proximity && (s = 1), t || s) && (v = c); v && a.vakata.dnd._scroll(!0); f && (c = parseInt(b.pageY + a.vakata.dnd.settings.helper_top, 10), u = parseInt(b.pageX + a.vakata.dnd.settings.helper_left, 10), q && c + 25 > q && (c = q - 50), y && u + h > y && (u = y - (h + 2)), f.css({
                                left: u +
                                    "px", top: c + "px"
                            })); a.vakata.dnd._trigger("move", b); return !1
                }
            }, stop: function (b) {
                "touchend" === b.type && b.originalEvent && b.originalEvent.changedTouches && b.originalEvent.changedTouches[0] && (b.pageX = b.originalEvent.changedTouches[0].pageX, b.pageY = b.originalEvent.changedTouches[0].pageY, b.target = m.elementFromPoint(b.originalEvent.changedTouches[0].pageX - window.pageXOffset, b.originalEvent.changedTouches[0].pageY - window.pageYOffset)); if (e) a.vakata.dnd._trigger("stop", b); else if ("touchend" === b.type && b.target ===
                    c) { var d = setTimeout(function () { a(b.target).click() }, 100); a(b.target).one("click", function () { d && clearTimeout(d) }) } a.vakata.dnd._clean(); return !1
            }
        }
    })(a); a.jstree.defaults.massload = null; a.jstree.plugins.massload = function (b, c) {
        this.init = function (a, b) { c.init.call(this, a, b); this._data.massload = {} }; this._load_nodes = function (b, d, e) {
            var f = this.settings.massload; return e && !a.isEmptyObject(this._data.massload) ? c._load_nodes.call(this, b, d, e) : a.isFunction(f) ? f.call(this, b, a.proxy(function (a) {
                if (a) for (var f in a) a.hasOwnProperty(f) &&
                    (this._data.massload[f] = a[f]); c._load_nodes.call(this, b, d, e)
            }, this)) : "object" === typeof f && f && f.url ? (f = a.extend(!0, {}, f), a.isFunction(f.url) && (f.url = f.url.call(this, b)), a.isFunction(f.data) && (f.data = f.data.call(this, b)), a.ajax(f).done(a.proxy(function (a, f, g) { if (a) for (var h in a) a.hasOwnProperty(h) && (this._data.massload[h] = a[h]); c._load_nodes.call(this, b, d, e) }, this)).fail(a.proxy(function (a) { c._load_nodes.call(this, b, d, e) }, this))) : c._load_nodes.call(this, b, d, e)
        }; this._load_node = function (b, d) {
            var e =
                this._data.massload[b.id]; return e ? this["string" === typeof e ? "_append_html_data" : "_append_json_data"](b, "string" === typeof e ? a(a.parseHTML(e)).filter(function () { return 3 !== this.nodeType }) : e, function (a) { d.call(this, a); delete this._data.massload[b.id] }) : c._load_node.call(this, b, d)
        }
    }; a.jstree.defaults.search = { ajax: !1, fuzzy: !1, case_sensitive: !1, show_only_matches: !1, show_only_matches_children: !1, close_opened_onclear: !0, search_leaves_only: !1, search_callback: !1 }; a.jstree.plugins.search = function (b, c) {
        this.bind =
        function () {
            c.bind.call(this); this._data.search.str = ""; this._data.search.dom = a(); this._data.search.res = []; this._data.search.opn = []; this._data.search.som = !1; this._data.search.smc = !1; this._data.search.hdn = []; this.element.on("search.jstree", a.proxy(function (b, c) {
                if (this._data.search.som && c.res.length) {
                    var d = this._model.data, e, f, g = []; e = 0; for (f = c.res.length; e < f; e++)d[c.res[e]] && !d[c.res[e]].state.hidden && (g.push(c.res[e]), g = g.concat(d[c.res[e]].parents), this._data.search.smc && (g = g.concat(d[c.res[e]].children_d)));
                    g = a.vakata.array_remove_item(a.vakata.array_unique(g), a.jstree.root); this._data.search.hdn = this.hide_all(); this.show_node(g)
                }
            }, this)).on("clear_search.jstree", a.proxy(function (a, b) { this._data.search.som && b.res.length && this.show_node(this._data.search.hdn) }, this))
        }; this.search = function (b, c, d, e, f, g) {
            if (!1 === b || "" === a.trim(b.toString())) return this.clear_search(); e = (e = this.get_node(e)) && e.id ? e.id : null; b = b.toString(); var h = this.settings.search, k = h.ajax ? h.ajax : !1, m = this._model.data, r = null, s = [], u = []; this._data.search.res.length &&
                !f && this.clear_search(); d === l && (d = h.show_only_matches); g === l && (g = h.show_only_matches_children); if (!c && !1 !== k) {
                    if (a.isFunction(k)) return k.call(this, b, a.proxy(function (c) { c && c.d && (c = c.d); this._load_nodes(a.isArray(c) ? a.vakata.array_unique(c) : [], function () { this.search(b, !0, d, e, f) }, !0) }, this), e); k = a.extend({}, k); k.data || (k.data = {}); k.data.str = b; e && (k.data.inside = e); return a.ajax(k).fail(a.proxy(function () {
                        this._data.core.last_error = {
                            error: "ajax", plugin: "search", id: "search_01", reason: "Could not load search parents",
                            data: JSON.stringify(k)
                        }; this.settings.core.error.call(this, this._data.core.last_error)
                    }, this)).done(a.proxy(function (c) { c && c.d && (c = c.d); this._load_nodes(a.isArray(c) ? a.vakata.array_unique(c) : [], function () { this.search(b, !0, d, e, f) }, !0) }, this))
                } f || (this._data.search.str = b, this._data.search.dom = a(), this._data.search.res = [], this._data.search.opn = [], this._data.search.som = d, this._data.search.smc = g); r = new a.vakata.search(b, !0, { caseSensitive: h.case_sensitive, fuzzy: h.fuzzy }); a.each(m[e ? e : a.jstree.root].children_d,
                    function (a, c) { var d = m[c]; d.text && (!h.search_leaves_only || d.state.loaded && 0 === d.children.length) && (h.search_callback && h.search_callback.call(this, b, d) || !h.search_callback && r.search(d.text).isMatch) && (s.push(c), u = u.concat(d.parents)) }); s.length && (u = a.vakata.array_unique(u), this._search_open(u), f ? (this._data.search.dom = this._data.search.dom.add(a(this.element[0].querySelectorAll("#" + a.map(s, function (b) {
                        return -1 !== "0123456789".indexOf(b[0]) ? "\\3" + b[0] + " " + b.substr(1).replace(a.jstree.idregex, "\\$\x26") :
                            b.replace(a.jstree.idregex, "\\$\x26")
                    }).join(", #")))), this._data.search.res = a.vakata.array_unique(this._data.search.res.concat(s))) : (this._data.search.dom = a(this.element[0].querySelectorAll("#" + a.map(s, function (b) { return -1 !== "0123456789".indexOf(b[0]) ? "\\3" + b[0] + " " + b.substr(1).replace(a.jstree.idregex, "\\$\x26") : b.replace(a.jstree.idregex, "\\$\x26") }).join(", #"))), this._data.search.res = s), this._data.search.dom.children(".jstree-anchor").addClass("jstree-search")); this.trigger("search", {
                        nodes: this._data.search.dom,
                        str: b, res: this._data.search.res, show_only_matches: d
                    })
        }; this.clear_search = function () {
            this.settings.search.close_opened_onclear && this.close_node(this._data.search.opn, 0); this.trigger("clear_search", { nodes: this._data.search.dom, str: this._data.search.str, res: this._data.search.res }); this._data.search.res.length && (this._data.search.dom = a(this.element[0].querySelectorAll("#" + a.map(this._data.search.res, function (b) {
                return -1 !== "0123456789".indexOf(b[0]) ? "\\3" + b[0] + " " + b.substr(1).replace(a.jstree.idregex,
                    "\\$\x26") : b.replace(a.jstree.idregex, "\\$\x26")
            }).join(", #"))), this._data.search.dom.children(".jstree-anchor").removeClass("jstree-search")); this._data.search.str = ""; this._data.search.res = []; this._data.search.opn = []; this._data.search.dom = a()
        }; this._search_open = function (b) {
            var c = this; a.each(b.concat([]), function (d, e) {
                if (e === a.jstree.root) return !0; try { e = a("#" + e.replace(a.jstree.idregex, "\\$\x26"), c.element) } catch (f) { } e && e.length && c.is_closed(e) && (c._data.search.opn.push(e[0].id), c.open_node(e, function () { c._search_open(b) },
                    0))
            })
        }; this.redraw_node = function (b, d, e, f) { if ((b = c.redraw_node.apply(this, arguments)) && -1 !== a.inArray(b.id, this._data.search.res)) { var g, h, k = null; g = 0; for (h = b.childNodes.length; g < h; g++)if (b.childNodes[g] && b.childNodes[g].className && -1 !== b.childNodes[g].className.indexOf("jstree-anchor")) { k = b.childNodes[g]; break } k && (k.className += " jstree-search") } return b }
    }; (function (a) {
        a.vakata.search = function (b, c, d) {
            d = d || {}; d = a.extend({}, a.vakata.search.defaults, d); !1 !== d.fuzzy && (d.fuzzy = !0); b = d.caseSensitive ? b : b.toLowerCase();
            var e = d.location, f = d.distance, h = d.threshold, k = b.length, l, m, r, s; 32 < k && (d.fuzzy = !1); d.fuzzy && (l = 1 << k - 1, m = function () { for (var a = {}, c = 0, c = 0; c < k; c++)a[b.charAt(c)] = 0; for (c = 0; c < k; c++)a[b.charAt(c)] |= 1 << k - c - 1; return a }(), r = function (a, b) { var c = a / k, d = Math.abs(e - b); return f ? c + d / f : d ? 1 : c }); s = function (a) {
                a = d.caseSensitive ? a : a.toLowerCase(); if (b === a || -1 !== a.indexOf(b)) return { isMatch: !0, score: 0 }; if (!d.fuzzy) return { isMatch: !1, score: 1 }; var c, f, g = a.length, q = h, s = a.indexOf(b, e), t, v, y = k + g, D, z, S = 1, ca = []; -1 !== s && (q = Math.min(r(0,
                    s), q), s = a.lastIndexOf(b, e + k), -1 !== s && (q = Math.min(r(0, s), q))); s = -1; for (c = 0; c < k; c++) { t = 0; for (v = y; t < v;)r(c, e + v) <= q ? t = v : y = v, v = Math.floor((y - t) / 2 + t); y = v; t = Math.max(1, e - v + 1); f = Math.min(e + v, g) + k; v = Array(f + 2); for (v[f + 1] = (1 << c) - 1; f >= t; f--)if (z = m[a.charAt(f - 1)], v[f] = 0 === c ? (v[f + 1] << 1 | 1) & z : (v[f + 1] << 1 | 1) & z | (D[f + 1] | D[f]) << 1 | 1 | D[f + 1], v[f] & l && (S = r(c, f - 1), S <= q)) if (q = S, s = f - 1, ca.push(s), s > e) t = Math.max(1, 2 * e - s); else break; if (r(c + 1, e) > q) break; D = v } return { isMatch: 0 <= s, score: S }
            }; return !0 === c ? { search: s } : s(c)
        }; a.vakata.search.defaults =
            { location: 0, distance: 100, threshold: 0.6, fuzzy: !1, caseSensitive: !1 }
    })(a); a.jstree.defaults.sort = function (a, b) { return this.get_text(a) > this.get_text(b) ? 1 : -1 }; a.jstree.plugins.sort = function (b, c) {
        this.bind = function () {
            c.bind.call(this); this.element.on("model.jstree", a.proxy(function (a, b) { this.sort(b.parent, !0) }, this)).on("rename_node.jstree create_node.jstree", a.proxy(function (a, b) { this.sort(b.parent || b.node.parent, !1); this.redraw_node(b.parent || b.node.parent, !0) }, this)).on("move_node.jstree copy_node.jstree",
                a.proxy(function (a, b) { this.sort(b.parent, !1); this.redraw_node(b.parent, !0) }, this))
        }; this.sort = function (b, c) { var d, e; if ((b = this.get_node(b)) && b.children && b.children.length && (b.children.sort(a.proxy(this.settings.sort, this)), c)) for (d = 0, e = b.children_d.length; d < e; d++)this.sort(b.children_d[d], !1) }
    }; var s = !1; a.jstree.defaults.state = { key: "jstree", events: "changed.jstree open_node.jstree close_node.jstree check_node.jstree uncheck_node.jstree", ttl: !1, filter: !1 }; a.jstree.plugins.state = function (b, c) {
        this.bind =
        function () { c.bind.call(this); var b = a.proxy(function () { this.element.on(this.settings.state.events, a.proxy(function () { s && clearTimeout(s); s = setTimeout(a.proxy(function () { this.save_state() }, this), 100) }, this)); this.trigger("state_ready") }, this); this.element.on("ready.jstree", a.proxy(function (a, c) { this.element.one("restore_state.jstree", b); this.restore_state() || b() }, this)) }; this.save_state = function () {
            var b = { state: this.get_state(), ttl: this.settings.state.ttl, sec: +new Date }; a.vakata.storage.set(this.settings.state.key,
                JSON.stringify(b))
        }; this.restore_state = function () { var b = a.vakata.storage.get(this.settings.state.key); if (b) try { b = JSON.parse(b) } catch (c) { return !1 } if (b && b.ttl && b.sec && +new Date - b.sec > b.ttl) return !1; b && b.state && (b = b.state); b && a.isFunction(this.settings.state.filter) && (b = this.settings.state.filter.call(this, b)); return b ? (this.element.one("set_state.jstree", function (c, d) { d.instance.trigger("restore_state", { state: a.extend(!0, {}, b) }) }), this.set_state(b), !0) : !1 }; this.clear_state = function () { return a.vakata.storage.del(this.settings.state.key) }
    };
    (function (a, b) { a.vakata.storage = { set: function (a, b) { return window.localStorage.setItem(a, b) }, get: function (a) { return window.localStorage.getItem(a) }, del: function (a) { return window.localStorage.removeItem(a) } } })(a); a.jstree.defaults.types = { "default": {} }; a.jstree.defaults.types[a.jstree.root] = {}; a.jstree.plugins.types = function (b, c) {
        this.init = function (b, d) {
            var e, f; if (d && d.types && d.types["default"]) for (e in d.types) if ("default" !== e && e !== a.jstree.root && d.types.hasOwnProperty(e)) for (f in d.types["default"]) d.types["default"].hasOwnProperty(f) &&
                d.types[e][f] === l && (d.types[e][f] = d.types["default"][f]); c.init.call(this, b, d); this._model.data[a.jstree.root].type = a.jstree.root
        }; this.refresh = function (b, d) { c.refresh.call(this, b, d); this._model.data[a.jstree.root].type = a.jstree.root }; this.bind = function () {
            this.element.on("model.jstree", a.proxy(function (b, c) {
                var d = this._model.data, e = c.nodes, f = this.settings.types, g, h, k = "default"; g = 0; for (h = e.length; g < h; g++)k = "default", d[e[g]].original && d[e[g]].original.type && f[d[e[g]].original.type] && (k = d[e[g]].original.type),
                    d[e[g]].data && d[e[g]].data.jstree && d[e[g]].data.jstree.type && f[d[e[g]].data.jstree.type] && (k = d[e[g]].data.jstree.type), d[e[g]].type = k, !0 === d[e[g]].icon && f[k].icon !== l && (d[e[g]].icon = f[k].icon); d[a.jstree.root].type = a.jstree.root
            }, this)); c.bind.call(this)
        }; this.get_json = function (b, d, e) {
            var f = this._model.data, g = d ? a.extend(!0, {}, d, { no_id: !1 }) : {}, g = c.get_json.call(this, b, g, e); if (!1 === g) return !1; if (a.isArray(g)) for (b = 0, e = g.length; b < e; b++)g[b].type = g[b].id && f[g[b].id] && f[g[b].id].type ? f[g[b].id].type : "default",
                d && d.no_id && (delete g[b].id, g[b].li_attr && g[b].li_attr.id && delete g[b].li_attr.id, g[b].a_attr && g[b].a_attr.id && delete g[b].a_attr.id); else g.type = g.id && f[g.id] && f[g.id].type ? f[g.id].type : "default", d && d.no_id && (g = this._delete_ids(g)); return g
        }; this._delete_ids = function (b) {
            if (a.isArray(b)) { for (var c = 0, d = b.length; c < d; c++)b[c] = this._delete_ids(b[c]); return b } delete b.id; b.li_attr && b.li_attr.id && delete b.li_attr.id; b.a_attr && b.a_attr.id && delete b.a_attr.id; b.children && a.isArray(b.children) && (b.children =
                this._delete_ids(b.children)); return b
        }; this.check = function (b, d, e, f, g) {
            if (!1 === c.check.call(this, b, d, e, f, g)) return !1; d = d && d.id ? d : this.get_node(d); e = e && e.id ? e : this.get_node(e); g = d && d.id ? g && g.origin ? g.origin : a.jstree.reference(d.id) : null; var h, k, m, r; g = g && g._model && g._model.data ? g._model.data : null; switch (b) {
                case "create_node": case "move_node": case "copy_node": if ("move_node" !== b || -1 === a.inArray(d.id, e.children)) {
                    h = this.get_rules(e); if (h.max_children !== l && -1 !== h.max_children && h.max_children === e.children.length) return this._data.core.last_error =
                        { error: "check", plugin: "types", id: "types_01", reason: "max_children prevents function: " + b, data: JSON.stringify({ chk: b, pos: f, obj: d && d.id ? d.id : !1, par: e && e.id ? e.id : !1 }) }, !1; if (h.valid_children !== l && -1 !== h.valid_children && -1 === a.inArray(d.type || "default", h.valid_children)) return this._data.core.last_error = { error: "check", plugin: "types", id: "types_02", reason: "valid_children prevents function: " + b, data: JSON.stringify({ chk: b, pos: f, obj: d && d.id ? d.id : !1, par: e && e.id ? e.id : !1 }) }, !1; if (g && d.children_d && d.parents) {
                            m =
                            k = 0; for (r = d.children_d.length; m < r; m++)k = Math.max(k, g[d.children_d[m]].parents.length); k = k - d.parents.length + 1
                        } if (0 >= k || k === l) k = 1; do { if (h.max_depth !== l && -1 !== h.max_depth && h.max_depth < k) return this._data.core.last_error = { error: "check", plugin: "types", id: "types_03", reason: "max_depth prevents function: " + b, data: JSON.stringify({ chk: b, pos: f, obj: d && d.id ? d.id : !1, par: e && e.id ? e.id : !1 }) }, !1; e = this.get_node(e.parent); h = this.get_rules(e); k++ } while (e)
                }
            }return !0
        }; this.get_rules = function (a) {
            a = this.get_node(a); if (!a) return !1;
            a = this.get_type(a, !0); a.max_depth === l && (a.max_depth = -1); a.max_children === l && (a.max_children = -1); a.valid_children === l && (a.valid_children = -1); return a
        }; this.get_type = function (b, c) { return (b = this.get_node(b)) ? c ? a.extend({ type: b.type }, this.settings.types[b.type]) : b.type : !1 }; this.set_type = function (b, c) {
            var d, e, f; if (a.isArray(b)) { b = b.slice(); d = 0; for (e = b.length; d < e; d++)this.set_type(b[d], c); return !0 } d = this.settings.types; b = this.get_node(b); if (!d[c] || !b) return !1; e = b.type; f = this.get_icon(b); b.type = c; (!0 ===
                f || d[e] && d[e].icon !== l && f === d[e].icon) && this.set_icon(b, d[c].icon !== l ? d[c].icon : !0); return !0
        }
    }; a.jstree.defaults.unique = { case_sensitive: !1, duplicate: function (a, b) { return a + " (" + b + ")" } }; a.jstree.plugins.unique = function (b, c) {
        this.check = function (b, d, e, f, g) {
            if (!1 === c.check.call(this, b, d, e, f, g)) return !1; d = d && d.id ? d : this.get_node(d); e = e && e.id ? e : this.get_node(e); if (!e || !e.children) return !0; var h = "rename_node" === b ? f : d.text, k = [], l = this.settings.unique.case_sensitive, m = this._model.data, r, s; r = 0; for (s = e.children.length; r <
                s; r++)k.push(l ? m[e.children[r]].text : m[e.children[r]].text.toLowerCase()); l || (h = h.toLowerCase()); switch (b) {
                    case "rename_node": return r = -1 === a.inArray(h, k) || d.text && d.text[l ? "toString" : "toLowerCase"]() === h, r || (this._data.core.last_error = { error: "check", plugin: "unique", id: "unique_01", reason: "Child with name " + h + " already exists. Preventing: " + b, data: JSON.stringify({ chk: b, pos: f, obj: d && d.id ? d.id : !1, par: e && e.id ? e.id : !1 }) }), r; case "create_node": return r = -1 === a.inArray(h, k), r || (this._data.core.last_error =
                        { error: "check", plugin: "unique", id: "unique_04", reason: "Child with name " + h + " already exists. Preventing: " + b, data: JSON.stringify({ chk: b, pos: f, obj: d && d.id ? d.id : !1, par: e && e.id ? e.id : !1 }) }), r; case "copy_node": return r = -1 === a.inArray(h, k), r || (this._data.core.last_error = { error: "check", plugin: "unique", id: "unique_02", reason: "Child with name " + h + " already exists. Preventing: " + b, data: JSON.stringify({ chk: b, pos: f, obj: d && d.id ? d.id : !1, par: e && e.id ? e.id : !1 }) }), r; case "move_node": return r = d.parent === e.id && (!g || !g.is_multi) ||
                            -1 === a.inArray(h, k), r || (this._data.core.last_error = { error: "check", plugin: "unique", id: "unique_03", reason: "Child with name " + h + " already exists. Preventing: " + b, data: JSON.stringify({ chk: b, pos: f, obj: d && d.id ? d.id : !1, par: e && e.id ? e.id : !1 }) }), r
                }return !0
        }; this.create_node = function (b, d, e, f, g) {
            if (!d || d.text === l) {
                null === b && (b = a.jstree.root); b = this.get_node(b); if (!b) return c.create_node.call(this, b, d, e, f, g); e = e === l ? "last" : e; if (!e.toString().match(/^(before|after)$/) && !g && !this.is_loaded(b)) return c.create_node.call(this,
                    b, d, e, f, g); d || (d = {}); var h, k, m, r, s, t = this._model.data, v = this.settings.unique.case_sensitive, y = this.settings.unique.duplicate; k = h = this.get_string("New node"); m = []; r = 0; for (s = b.children.length; r < s; r++)m.push(v ? t[b.children[r]].text : t[b.children[r]].text.toLowerCase()); for (r = 1; -1 !== a.inArray(v ? k : k.toLowerCase(), m);)k = y.call(this, h, ++r).toString(); d.text = k
            } return c.create_node.call(this, b, d, e, f, g)
        }
    }; var v = m.createElement("DIV"); v.setAttribute("unselectable", "on"); v.setAttribute("role", "presentation");
    v.className = "jstree-wholerow"; v.innerHTML = "\x26#160;"; a.jstree.plugins.wholerow = function (b, c) {
        this.bind = function () {
            c.bind.call(this); this.element.on("ready.jstree set_state.jstree", a.proxy(function () { this.hide_dots() }, this)).on("init.jstree loading.jstree ready.jstree", a.proxy(function () { this.get_container_ul().addClass("jstree-wholerow-ul") }, this)).on("deselect_all.jstree", a.proxy(function (a, b) { this.element.find(".jstree-wholerow-clicked").removeClass("jstree-wholerow-clicked") }, this)).on("changed.jstree",
                a.proxy(function (a, b) { this.element.find(".jstree-wholerow-clicked").removeClass("jstree-wholerow-clicked"); var c = !1, d, e; d = 0; for (e = b.selected.length; d < e; d++)(c = this.get_node(b.selected[d], !0)) && c.length && c.children(".jstree-wholerow").addClass("jstree-wholerow-clicked") }, this)).on("open_node.jstree", a.proxy(function (a, b) { this.get_node(b.node, !0).find(".jstree-clicked").parent().children(".jstree-wholerow").addClass("jstree-wholerow-clicked") }, this)).on("hover_node.jstree dehover_node.jstree", a.proxy(function (a,
                    b) { if ("hover_node" !== a.type || !this.is_disabled(b.node)) this.get_node(b.node, !0).children(".jstree-wholerow")["hover_node" === a.type ? "addClass" : "removeClass"]("jstree-wholerow-hovered") }, this)).on("contextmenu.jstree", ".jstree-wholerow", a.proxy(function (b) { b.preventDefault(); var c = a.Event("contextmenu", { metaKey: b.metaKey, ctrlKey: b.ctrlKey, altKey: b.altKey, shiftKey: b.shiftKey, pageX: b.pageX, pageY: b.pageY }); a(b.currentTarget).closest(".jstree-node").children(".jstree-anchor").first().trigger(c) }, this)).on("click.jstree",
                        ".jstree-wholerow", function (b) { b.stopImmediatePropagation(); var c = a.Event("click", { metaKey: b.metaKey, ctrlKey: b.ctrlKey, altKey: b.altKey, shiftKey: b.shiftKey }); a(b.currentTarget).closest(".jstree-node").children(".jstree-anchor").first().trigger(c).focus() }).on("click.jstree", ".jstree-leaf \x3e .jstree-ocl", a.proxy(function (b) { b.stopImmediatePropagation(); var c = a.Event("click", { metaKey: b.metaKey, ctrlKey: b.ctrlKey, altKey: b.altKey, shiftKey: b.shiftKey }); a(b.currentTarget).closest(".jstree-node").children(".jstree-anchor").first().trigger(c).focus() },
                            this)).on("mouseover.jstree", ".jstree-wholerow, .jstree-icon", a.proxy(function (a) { a.stopImmediatePropagation(); this.is_disabled(a.currentTarget) || this.hover_node(a.currentTarget); return !1 }, this)).on("mouseleave.jstree", ".jstree-node", a.proxy(function (a) { this.dehover_node(a.currentTarget) }, this))
        }; this.teardown = function () { this.settings.wholerow && this.element.find(".jstree-wholerow").remove(); c.teardown.call(this) }; this.redraw_node = function (b, d, e, f) {
            if (b = c.redraw_node.apply(this, arguments)) {
                var g = v.cloneNode(!0);
                -1 !== a.inArray(b.id, this._data.core.selected) && (g.className += " jstree-wholerow-clicked"); this._data.core.focused && this._data.core.focused === b.id && (g.className += " jstree-wholerow-hovered"); b.insertBefore(g, b.childNodes[0])
            } return b
        }
    }; if (m.registerElement && Object && Object.create) {
        f = Object.create(HTMLElement.prototype); f.createdCallback = function () {
            var b = { core: {}, plugins: [] }, c; for (c in a.jstree.plugins) a.jstree.plugins.hasOwnProperty(c) && this.attributes[c] && (b.plugins.push(c), this.getAttribute(c) && JSON.parse(this.getAttribute(c)) &&
                (b[c] = JSON.parse(this.getAttribute(c)))); for (c in a.jstree.defaults.core) a.jstree.defaults.core.hasOwnProperty(c) && this.attributes[c] && (b.core[c] = JSON.parse(this.getAttribute(c)) || this.getAttribute(c)); a(this).jstree(b)
        }; try { m.registerElement("vakata-jstree", { prototype: f }) } catch (y) { }
    } return a.fn.jstree
});
(function (a) {
    a.widget("ui.jstreeview", {
        options: { expanded: !1 }, _init: function () { }, _create: function () { this._buildToggle(); this._buildGridQuickSearch() }, _buildToggle: function () { var l = this; a(".ui-treeview-toggle", l.element).click(function () { l.options.expanded ? l._collapse() : l._expand() }) }, _collapse: function () { a(".ui-treeview-tree", this.element).jstree("close_all"); this.options.expanded = !1 }, _expand: function (l) {
            a(".ui-treeview-tree", this.element).jstree("open_all").on("open_all.jstree", function () {
                l instanceof
                Function && l()
            }); this.options.expanded = !0
        }, _buildGridQuickSearch: function () { var l = this; a(".ui-treeview-search", l.element).focus(function () { var e = a(this); l.options.expanded || (e.prop("disabled", !0).val("Aguarde para pesquisar...").addClass("ui-form-field-disabled"), l._expand(function () { e.prop("disabled", !1).val("").removeClass("ui-form-field-disabled") })) }).blur(function () { "" === a(this).val() && a(this).val("Pesquisar...") }).keyup(function (e) { l._doQuickSearch(a(this).val()) }) }, _doQuickSearch: function (l) {
            var e =
                this; a("ul \x3e li", e.element).each(function (h) { e._testResults(l, a(this).html()) || "" == l ? a(this).show() : a(this).hide() })
        }, _removeAccents: function (a) { return a = a.replace(/[àáâãäå]/g, "a").replace(/æ/g, "ae").replace(/ç/g, "c").replace(/[èéêë]/g, "e").replace(/[ìíîï]/g, "i").replace(/ñ/g, "n").replace(/[òóôõö]/g, "o").replace(/œ/g, "oe").replace(/[ùúûü]/g, "u").replace(/[ýÿ]/g, "y") }, _testResults: function (a, e) {
            return RegExp(this._removeAccents(a.toLowerCase()), "i").test(this._removeAccents(e.toLowerCase())) ? !0 :
                !1
        }
    })
})(jQuery);
(function (a) {
    a.widget("tg.quickSearch", {
        options: { table: "", label: "Pesquisar" }, _create: function () { var l = this; l.element.val(l.options.label).keyup(function (e) { l._doQuickSearch(a(this).val()); l._stripRows() }).focus(function () { a(this).val("") }).blur(function () { a(this).val(l.options.label) }) }, _doQuickSearch: function (l) { var e = this; a(e.options.table + " \x3e tbody \x3e tr").each(function (h) { e._testResults(l, a(this).html()) || "" == l ? a(this).show() : a(this).hide() }) }, _stripRows: function () {
            a(this.options.table + " \x3e tbody \x3e tr:visible").each(function (l) {
                a(this).removeClass("ui-table-odd ui-table-even");
                0 == l % 2 ? a(this).addClass("ui-table-odd") : a(this).addClass("ui-table-even")
            })
        }, _removeAccents: function (a) { return a = a.replace(/[àáâãäå]/g, "a").replace(/æ/g, "ae").replace(/ç/g, "c").replace(/[èéêë]/g, "e").replace(/[ìíîï]/g, "i").replace(/ñ/g, "n").replace(/[òóôõö]/g, "o").replace(/œ/g, "oe").replace(/[ùúûü]/g, "u").replace(/[ýÿ]/g, "y") }, _testResults: function (a, e) { return RegExp(this._removeAccents(a.toLowerCase()), "i").test(this._removeAccents(e.toLowerCase())) ? !0 : !1 }
    })
})(jQuery);