!(function (d) {
    "use strict";
    var a = function (t, i) {
        var e = this;
        if (((this.options = i), (this.$tableWrapper = null), (this.$tableScrollWrapper = d(t)), (this.$table = d(t).find("table")), 1 !== this.$table.length)) throw new Error("Exactly one table is expected in a .table-responsive div.");
        this.$tableScrollWrapper.attr("data-pattern", this.options.pattern),
            (this.id = this.$table.prop("id") || this.$tableScrollWrapper.prop("id") || "id" + Math.random().toString(16).slice(2)),
            (this.$tableClone = null),
            (this.$stickyTableHeader = null),
            (this.$thead = this.$table.find("thead")),
            (this.$hdrCells = this.$thead.find("tr").first().find("th")),
            (this.$bodyRows = this.$table.find("tbody, tfoot").find("tr")),
            (this.$btnToolbar = null),
            (this.$dropdownGroup = null),
            (this.$dropdownBtn = null),
            (this.$dropdownContainer = null),
            (this.$displayAllBtn = null),
            (this.$focusGroup = null),
            (this.$focusBtn = null),
            (this.displayAllTrigger = "display-all-" + this.id + ".responsive-table"),
            (this.idPrefix = this.id + "-col-"),
            (this.headerColIndices = {}),
            (this.headerRowIndices = {}),
            this.wrapTable(),
            this.createButtonToolbar(),
            this.buildHeaderCellIndices(),
            this.setupTableHeader(),
            this.setupBodyRows(),
            this.options.stickyTableHeader && this.createStickyTableHeader(),
            this.$dropdownContainer.is(":empty") && this.$dropdownGroup.hide(),
            d(window)
                .bind("orientationchange resize " + this.displayAllTrigger, function () {
                    e.$dropdownContainer.find("input").trigger("updateCheck"), d.proxy(e.updateSpanningCells(), e);
                })
                .trigger("resize");
    };
    (a.DEFAULTS = {
        pattern: "priority-columns",
        stickyTableHeader: !0,
        fixedNavbar: ".navbar-fixed-top",
        addDisplayAllBtn: !0,
        addFocusBtn: !0,
        focusBtnIcon: "glyphicon glyphicon-screenshot",
        mainContainer: window,
        i18n: { focus: "Focus", display: "Display", displayAll: "Display all" },
    }),
        (a.prototype.wrapTable = function () {
            this.$tableScrollWrapper.wrap('<div class="table-wrapper"/>'), (this.$tableWrapper = this.$tableScrollWrapper.parent());
        }),
        (a.prototype.createButtonToolbar = function () {
            var t = this;
            (this.$btnToolbar = d('[data-responsive-table-toolbar="' + this.id + '"]').addClass("btn-toolbar")),
                0 === this.$btnToolbar.length && (this.$btnToolbar = d('<div class="btn-toolbar" />')),
                (this.$dropdownGroup = d('<div class="btn-group dropdown-btn-group pull-right" />')),
                (this.$dropdownBtn = d('<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">' + this.options.i18n.display + ' <span class="caret"></span></button>')),
                (this.$dropdownContainer = d('<ul class="dropdown-menu"/>')),
                this.options.addFocusBtn &&
                    ((this.$focusGroup = d('<div class="btn-group focus-btn-group" />')),
                    (this.$focusBtn = d('<button type="button" class="btn btn-default">' + this.options.i18n.focus + "</button>")),
                    this.options.focusBtnIcon && this.$focusBtn.prepend('<span class="' + this.options.focusBtnIcon + '"></span> '),
                    this.$focusGroup.append(this.$focusBtn),
                    this.$btnToolbar.append(this.$focusGroup),
                    this.$focusBtn.click(function () {
                        d.proxy(t.activateFocus(), t);
                    }),
                    this.$bodyRows.click(function () {
                        d.proxy(t.focusOnRow(d(this)), t);
                    })),
                this.options.addDisplayAllBtn &&
                    ((this.$displayAllBtn = d('<button type="button" class="btn btn-default">' + this.options.i18n.displayAll + "</button>")),
                    this.$dropdownGroup.append(this.$displayAllBtn),
                    this.$table.hasClass("display-all") && this.$displayAllBtn.addClass("btn-primary"),
                    this.$displayAllBtn.click(function () {
                        d.proxy(t.displayAll(null, !0), t);
                    })),
                this.$dropdownGroup.append(this.$dropdownBtn).append(this.$dropdownContainer),
                this.$btnToolbar.append(this.$dropdownGroup),
                this.$tableScrollWrapper.before(this.$btnToolbar);
        }),
        (a.prototype.clearAllFocus = function () {
            this.$bodyRows.removeClass("unfocused"), this.$bodyRows.removeClass("focused");
        }),
        (a.prototype.activateFocus = function () {
            this.clearAllFocus(), this.$focusBtn && this.$focusBtn.toggleClass("btn-primary"), this.$table.toggleClass("focus-on");
        }),
        (a.prototype.focusOnRow = function (t) {
            if (this.$table.hasClass("focus-on")) {
                var i = d(t).hasClass("focused");
                this.clearAllFocus(), i || (this.$bodyRows.addClass("unfocused"), d(t).addClass("focused"));
            }
        }),
        (a.prototype.displayAll = function (t, i) {
            this.$displayAllBtn && this.$displayAllBtn.toggleClass("btn-primary", t),
                this.$table.toggleClass("display-all", t),
                this.$tableClone && this.$tableClone.toggleClass("display-all", t),
                i && d(window).trigger(this.displayAllTrigger);
        }),
        (a.prototype.preserveDisplayAll = function () {
            var t = "table-cell";
            d("html").hasClass("lt-ie9") && (t = "inline"), d(this.$table).find("th, td").css("display", t), this.$tableClone && d(this.$tableClone).find("th, td").css("display", t);
        }),
        (a.prototype.createStickyTableHeader = function () {
            var i = this;
            (i.$tableClone = i.$table.clone()),
                i.$tableClone.prop("id", this.id + "-clone"),
                i.$tableClone.find("[id]").each(function () {
                    d(this).prop("id", d(this).prop("id") + "-clone");
                }),
                i.$tableClone.wrap('<div class="sticky-table-header"/>'),
                (i.$stickyTableHeader = i.$tableClone.parent()),
                i.$stickyTableHeader.css("height", i.$thead.height() + 2),
                i.$table.before(i.$stickyTableHeader),
                d(this.options.mainContainer).bind("scroll", function () {
                    d.proxy(i.updateStickyTableHeader(), i);
                }),
                d(window).bind("resize", function (t) {
                    d.proxy(i.updateStickyTableHeader(), i);
                }),
                d(i.$tableScrollWrapper).bind("scroll", function () {
                    d.proxy(i.updateStickyTableHeader(), i);
                }),
                (i.useFixedSolution =
                    !e() ||
                    8 <=
                        (function () {
                            {
                                if (e()) {
                                    var t = parseFloat(("" + (/CPU.*OS ([0-9_]{1,5})|(CPU like).*AppleWebKit.*Mobile/i.exec(navigator.userAgent) || [0, ""])[1]).replace("undefined", "3_2").replace("_", ".").replace("_", ""));
                                    return t;
                                }
                                return 0;
                            }
                        })()),
                i.useFixedSolution ? i.$tableScrollWrapper.addClass("fixed-solution") : i.$tableScrollWrapper.addClass("absolute-solution");
        }),
        (a.prototype.updateStickyTableHeader = function () {
            var t,
                i = this,
                e = 0,
                o = i.$table.offset().top,
                a = d(this.options.mainContainer).scrollTop() - 1,
                s = i.$table.height() - i.$stickyTableHeader.height(),
                n = a + d(this.options.mainContainer).height() - d(document).height(),
                l = 0;
            d(i.options.fixedNavbar).length && (a += l = d(i.options.fixedNavbar).first().height());
            if (((t = this.options.mainContainer === window ? o < a && a < o + i.$table.height() : o <= 0 && -o < i.$table.height()), i.useFixedSolution)) {
                if (
                    (i.$stickyTableHeader.scrollLeft(i.$tableScrollWrapper.scrollLeft()),
                    (e = l - 1),
                    this.options.mainContainer === window && s < a - o
                        ? ((e -= a - o - s), i.$stickyTableHeader.addClass("border-radius-fix"))
                        : this.options.mainContainer !== window && s < -o
                        ? ((e -= -o - s), i.$stickyTableHeader.addClass("border-radius-fix"))
                        : i.$stickyTableHeader.removeClass("border-radius-fix"),
                    t)
                )
                    return void i.$stickyTableHeader.css({ visibility: "visible", top: e + "px", width: i.$tableScrollWrapper.innerWidth() + "px" });
                i.$stickyTableHeader.css({ visibility: "hidden", width: "auto" });
            } else {
                (e = this.options.mainContainer === window ? a - o - 1 : -o - 1) < 0 ? (e = 0) : s < e && (e = s),
                    this.options.mainContainer === window && 0 < n && (e -= n),
                    t
                        ? (i.$stickyTableHeader.css({ visibility: "visible" }), i.$stickyTableHeader.animate({ top: e + "px" }, 400), i.$thead.css({ visibility: "hidden" }))
                        : i.$stickyTableHeader.animate({ top: "0" }, 400, function () {
                              i.$thead.css({ visibility: "visible" }), i.$stickyTableHeader.css({ visibility: "hidden" });
                          });
            }
        }),
        (a.prototype.setupTableHeader = function () {
            var n = this;
            n.$hdrCells.each(function (t) {
                var i = d(this),
                    e = i.prop("id"),
                    o = i.text();
                if ((e || ((e = n.idPrefix + t), i.prop("id", e)), "" === o && (o = i.attr("data-col-name")), i.is("[data-priority]") && -1 !== i.data("priority"))) {
                    var a = d('<li class="checkbox-row"><input type="checkbox" name="toggle-' + e + '" id="toggle-' + e + '" value="' + e + '" /> <label for="toggle-' + e + '">' + o + "</label></li>"),
                        s = a.find("input");
                    n.$dropdownContainer.append(a),
                        a.click(function () {
                            s.prop("checked", !s.prop("checked")), s.trigger("change");
                        }),
                        d("html").hasClass("lt-ie9") &&
                            s.click(function () {
                                d(this).trigger("change");
                            }),
                        a.find("label").click(function (t) {
                            t.stopPropagation();
                        }),
                        a
                            .find("input")
                            .click(function (t) {
                                t.stopPropagation();
                            })
                            .change(function () {
                                var e = d(this),
                                    t = e.val(),
                                    i = n.$tableWrapper.find("#" + t + ", #" + t + "-clone, [data-columns~=" + t + "]");
                                n.$table.hasClass("display-all") &&
                                    (d.proxy(n.preserveDisplayAll(), n), n.$table.removeClass("display-all"), n.$tableClone && n.$tableClone.removeClass("display-all"), n.$displayAllBtn.removeClass("btn-primary")),
                                    i.each(function () {
                                        var t = d(this);
                                        if (e.is(":checked")) {
                                            if (!t.closest("thead").length && "none" !== t.css("display")) {
                                                var i = Math.min(parseInt(t.prop("colSpan")) + 1, t.attr("data-org-colspan"));
                                                t.prop("colSpan", i);
                                            }
                                            t.show();
                                        } else !t.closest("thead").length && 1 < parseInt(t.prop("colSpan")) ? t.prop("colSpan", parseInt(t.prop("colSpan")) - 1) : t.hide();
                                    });
                            })
                            .bind("updateCheck", function () {
                                "none" !== i.css("display") ? d(this).prop("checked", !0) : d(this).prop("checked", !1);
                            });
                }
            }),
                d.isEmptyObject(this.headerRowIndices) || n.setupRow(this.$thead.find("tr:eq(1)"), this.headerRowIndices);
        }),
        (a.prototype.setupBodyRows = function () {
            var t = this;
            t.$bodyRows.each(function () {
                t.setupRow(d(this), t.headerColIndices);
            });
        }),
        (a.prototype.setupRow = function (t, s) {
            var n = this;
            if (!t.data("setup")) {
                t.data("setup", !0);
                var l = 0;
                t.find("th, td").each(function () {
                    var t = d(this),
                        i = "",
                        e = t.prop("colSpan");
                    t.attr("data-org-colspan", e), 1 < e && t.addClass("spn-cell");
                    for (var o = l; o < l + e; o++) {
                        i = i + " " + n.idPrefix + s[o];
                        var a = n.$table.find("#" + n.idPrefix + s[o]).attr("data-priority");
                        a && t.attr("data-priority", a);
                    }
                    (i = i.substring(1)), t.attr("data-columns", i), (l += e);
                });
            }
        }),
        (a.prototype.buildHeaderCellIndices = function () {
            var s = this,
                n = {};
            (this.headerColIndices = {}), (this.headerRowIndices = {});
            var l = 0,
                r = 0;
            if (
                (this.$thead
                    .find("tr")
                    .first()
                    .find("th")
                    .each(function (t) {
                        for (var i = d(this), e = i.prop("colSpan"), o = i.prop("rowSpan"), a = 0; a < e; a++) (s.headerColIndices[l + t + a] = t), 0 <= l + t + a && (n[l + t + a - r] = r);
                        1 < o && r++, (l += e - 1);
                    }),
                2 < this.$thead.find("tr").length)
            )
                throw new Error("This plugin doesnt support more than two rows in thead.");
            2 === this.$thead.find("tr").length &&
                d(this.$thead.find("tr")[1])
                    .find("th")
                    .each(function (t) {
                        s.headerRowIndices[t] = s.headerColIndices[n[t] + t];
                    });
        }),
        (a.prototype.update = function () {
            (this.$bodyRows = this.$table.find("tbody, tfoot").find("tr")), this.setupBodyRows(), this.$tableClone.find("tbody, tfoot").remove();
            var t = this.$table.find("tbody, tfoot").clone();
            t.find("[id]").each(function () {
                d(this).prop("id", d(this).prop("id") + "-clone");
            }),
                t.appendTo(this.$tableClone),
                this.$dropdownContainer.find("input").trigger("change");
        }),
        (a.prototype.updateSpanningCells = function () {
            this.$table.find(".spn-cell").each(function () {
                for (var t = d(this), i = t.attr("data-columns").split(" "), e = i.length, o = 0, a = 0; a < e; a++) "none" === d("#" + i[a]).css("display") && o++;
                o !== e ? t.show() : t.hide(), t.prop("colSpan", Math.max(e - o, 1));
            });
        });
    var t = d.fn.responsiveTable;
    function e() {
        return !!(navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i));
    }
    (d.fn.responsiveTable = function (o) {
        return this.each(function () {
            var t = d(this),
                i = t.data("responsiveTable"),
                e = d.extend({}, a.DEFAULTS, t.data(), "object" == typeof o && o);
            "" !== e.pattern && (i || t.data("responsiveTable", (i = new a(this, e))), "string" == typeof o && i[o]());
        });
    }),
        (d.fn.responsiveTable.Constructor = a),
        (d.fn.responsiveTable.noConflict = function () {
            return (d.fn.responsiveTable = t), this;
        }),
        d(document).on("ready.responsive-table.data-api", function () {
            d(".table-responsive[data-pattern]").each(function () {
                var t = d(this);
                t.responsiveTable(t.data());
            });
        }),
        d(document).on("click.dropdown.data-api", ".dropdown-menu .checkbox-row", function (t) {
            t.stopPropagation();
        }),
        d(document).ready(function () {
            d("html").removeClass("no-js").addClass("js"),
                void 0 !== window.matchMedia || void 0 !== window.msMatchMedia || void 0 !== window.styleMedia ? d("html").addClass("mq") : d("html").addClass("no-mq"),
                "ontouchstart" in window ? d("html").addClass("touch") : d("html").addClass("no-touch");
        });
})(jQuery);
